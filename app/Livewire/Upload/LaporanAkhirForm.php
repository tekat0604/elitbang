<?php

namespace App\Livewire\Upload;

use App\Models\LaporanAkhir;
use App\Models\Permohonan;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.sidebar_layout_livewire')]
#[Title('Laporan Akhir Penelitian')]
class LaporanAkhirForm extends Component
{
    public ?int $permohonanId = null;
    public string $linkDokumen = '';
    public ?int $laporanId = null;

    protected function rules(): array
    {
        return [
            'permohonanId' => ['required', 'integer'],
            'linkDokumen' => ['required', 'url', 'regex:/drive\.google\.com/', 'max:2048'],
        ];
    }

    protected function messages(): array
    {
        return [
            'permohonanId.required' => 'Silakan pilih permohonan penelitian.',
            'linkDokumen.required' => 'Link dokumen laporan wajib diisi.',
            'linkDokumen.url' => 'Masukkan link dokumen yang valid.',
            'linkDokumen.regex' => 'Link harus berasal dari Google Drive (drive.google.com).',
        ];
    }

    public function submit(): void
    {
        $this->validate();
        $pemohonId = auth()->user()->pemohon?->id;

        abort_if(!$pemohonId, 403, 'Data pemohon tidak ditemukan.');

        if ($this->laporanId) {
            // Logika Revisi
            $laporan = LaporanAkhir::whereKey($this->laporanId)
                ->where('status_laporan', 'revisi')
                ->whereHas('permohonan', fn($query) => $query->where('pemohon_id', $pemohonId))
                ->firstOrFail();

            $laporan->update([
                'file_laporan' => $this->linkDokumen,
                'tanggal_upload' => now(),
                'status_laporan' => 'pending',
                'catatan_revisi' => null,
            ]);

            session()->flash('success', 'Laporan akhir berhasil diunggah ulang dan dikirim kembali ke BRIDA.');
        } else {
            // Logika Buat Baru (Harus Disetujui, Surat Final, dan Sudah Survei)
            $permohonan = Permohonan::whereKey($this->permohonanId)
                ->where('pemohon_id', $pemohonId)
                ->where('status_permohonan', 'disetujui')
                ->whereHas('suratIzin', function ($query) {
                    $query->where('status_tte_kesbangpol', 'selesai')
                        ->where('status_tte_brida', 'selesai');
                })
                ->has('surveiKepuasan')
                ->doesntHave('laporanAkhir')
                ->first();

            if (!$permohonan) {
                $this->addError('permohonanId', 'Permohonan tidak valid. Pastikan surat telah terbit dan survei telah diisi.');
                return;
            }

            LaporanAkhir::create([
                'permohonan_id' => $permohonan->id,
                'file_laporan' => $this->linkDokumen,
                'tanggal_upload' => now(),
                'status_laporan' => 'pending',
            ]);

            session()->flash('success', 'Laporan akhir berhasil dikirim dan menunggu verifikasi BRIDA.');
        }

        $this->resetForm();
        $this->dispatch('close-modal-laporan');
    }

    public function revisi(int $laporanId): void
    {
        $laporan = LaporanAkhir::whereKey($laporanId)
            ->where('status_laporan', 'revisi')
            ->whereHas('permohonan', fn($query) => $query->where('pemohon_id', auth()->user()->pemohon?->id))
            ->firstOrFail();

        $this->laporanId = $laporan->id;
        $this->permohonanId = $laporan->permohonan_id;
        $this->linkDokumen = $laporan->file_laporan;
        $this->resetValidation();

        $this->dispatch('open-modal-laporan');
    }

    public function batalRevisi(): void
    {
        $this->resetForm();
    }

    private function resetForm(): void
    {
        $this->reset(['permohonanId', 'linkDokumen', 'laporanId']);
        $this->resetValidation();
    }

    public function render()
    {
        $pemohonId = auth()->user()->pemohon?->id;
        $baseQuery = Permohonan::where('pemohon_id', $pemohonId)->where('status_permohonan', 'disetujui');

        // 1. Cek: Disetujui tapi TTE Surat belum selesai (Menunggu Pejabat)
        $menungguSurat = (clone $baseQuery)->whereDoesntHave('suratIzin', function ($query) {
            $query->where('status_tte_kesbangpol', 'selesai')
                ->where('status_tte_brida', 'selesai');
        })->exists();

        // 2. Cek: Surat Final sudah terbit, tapi belum isi Survei
        $perluSurvei = (clone $baseQuery)->whereHas('suratIzin', function ($query) {
            $query->where('status_tte_kesbangpol', 'selesai')
                ->where('status_tte_brida', 'selesai');
        })->doesntHave('surveiKepuasan')->exists();

        // 3. Cek: Lulus semua syarat, siap untuk dibuatkan Laporan
        $permohonanList = (clone $baseQuery)->with('layanan')
            ->whereHas('suratIzin', function ($query) {
                $query->where('status_tte_kesbangpol', 'selesai')
                    ->where('status_tte_brida', 'selesai');
            })
            ->has('surveiKepuasan')
            ->doesntHave('laporanAkhir')
            ->latest()
            ->get();

        $laporanList = LaporanAkhir::with(['permohonan.layanan'])
            ->whereHas('permohonan', fn($query) => $query->where('pemohon_id', $pemohonId))
            ->latest('tanggal_upload')
            ->get();

        return view('livewire.content.pages-laporan-akhir', compact(
            'permohonanList',
            'laporanList',
            'perluSurvei',
            'menungguSurat'
        ));
    }
}