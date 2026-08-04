<?php

namespace App\Livewire;

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
            'linkDokumen' => ['required', 'url', 'max:2048'],
        ];
    }

    protected function messages(): array
    {
        return [
            'permohonanId.required' => 'Silakan pilih permohonan penelitian.',
            'linkDokumen.required' => 'Link dokumen laporan wajib diisi.',
            'linkDokumen.url' => 'Masukkan link dokumen yang valid.',
        ];
    }

    public function submit(): void
    {
        $this->validate();
        $pemohonId = auth()->user()->pemohon?->id;

        if (!$pemohonId) {
            abort(403, 'Data pemohon tidak ditemukan.');
        }

        if ($this->laporanId) {
            $laporan = LaporanAkhir::whereKey($this->laporanId)
                ->where('status_laporan', 'revisi')
                ->whereHas('permohonan', fn ($query) => $query->where('pemohon_id', $pemohonId))
                ->firstOrFail();

            $laporan->update([
                'file_laporan' => $this->linkDokumen,
                'tanggal_upload' => now(),
                'status_laporan' => 'dikirim',
                'catatan_revisi' => null,
            ]);

            session()->flash('success', 'Laporan akhir berhasil diunggah ulang dan dikirim kembali ke BRIDA.');
        } else {
            $permohonan = Permohonan::whereKey($this->permohonanId)
                ->where('pemohon_id', $pemohonId)
                ->where('status_permohonan', 'disetujui')
                ->has('surveiKepuasan')
                ->doesntHave('laporanAkhir')
                ->first();

            if (!$permohonan) {
                $this->addError('permohonanId', 'Permohonan tidak valid, survei kepuasan belum diisi, atau laporan akhir sudah pernah dikirim.');
                return;
            }

            LaporanAkhir::create([
                'permohonan_id' => $permohonan->id,
                'file_laporan' => $this->linkDokumen,
                'tanggal_upload' => now(),
                'status_laporan' => 'dikirim',
            ]);

            session()->flash('success', 'Laporan akhir berhasil dikirim dan menunggu verifikasi BRIDA.');
        }

        $this->resetForm();
    }

    public function revisi(int $laporanId): void
    {
        $laporan = LaporanAkhir::whereKey($laporanId)
            ->where('status_laporan', 'revisi')
            ->whereHas('permohonan', fn ($query) => $query->where('pemohon_id', auth()->user()->pemohon?->id))
            ->firstOrFail();

        $this->laporanId = $laporan->id;
        $this->permohonanId = $laporan->permohonan_id;
        $this->linkDokumen = '';
        $this->resetValidation();
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

        $permohonanList = auth()->user()->pemohon?->permohonan()
            ->with('layanan')
            ->where('status_permohonan', 'disetujui')
            ->has('surveiKepuasan')
            ->doesntHave('laporanAkhir')
            ->latest()
            ->get() ?? collect();

        $perluSurvei = auth()->user()->pemohon?->permohonan()
            ->where('status_permohonan', 'disetujui')
            ->doesntHave('surveiKepuasan')
            ->doesntHave('laporanAkhir')
            ->exists() ?? false;

        $laporanList = LaporanAkhir::with(['permohonan.layanan'])
            ->whereHas('permohonan', fn ($query) => $query->where('pemohon_id', $pemohonId))
            ->latest('tanggal_upload')
            ->get();

        return view('livewire.content.pages-laporan-akhir', compact('permohonanList', 'laporanList', 'perluSurvei'));
    }
}
