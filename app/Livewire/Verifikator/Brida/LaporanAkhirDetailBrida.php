<?php

namespace App\Livewire\Verifikator\Brida;

use App\Mail\NotifikasiRevisi;
use App\Models\LaporanAkhir;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.sidebar_layout_livewire')]
#[Title('Periksa Laporan Akhir - BRIDA')]
class LaporanAkhirDetailBrida extends Component
{
    public LaporanAkhir $laporan;
    public string $statusLaporan;
    public ?string $catatanRevisi = null;

    public function mount(int $id): void
    {
        $user = Auth::user();

        if ($user->role !== 'verifikator' || $user->instansi !== 'brida') {
            abort(403, 'Akses Ditolak! Halaman ini khusus untuk Verifikator BRIDA.');
        }

        $this->laporan = LaporanAkhir::with(['permohonan.pemohon', 'permohonan.layanan', 'permohonan.opdChild'])
            ->findOrFail($id);
        $this->statusLaporan = $this->laporan->status_laporan;
        $this->catatanRevisi = $this->laporan->catatan_revisi;
    }

    public function simpanVerifikasi()
    {
        $this->validate([
            'statusLaporan' => ['required', 'in:dikirim,diterima,revisi'],
            'catatanRevisi' => ['required_if:statusLaporan,revisi', 'nullable', 'string'],
        ], [
            'statusLaporan.required' => 'Keputusan verifikasi wajib dipilih.',
            'statusLaporan.in' => 'Pilihan keputusan tidak valid.',
            'catatanRevisi.required_if' => 'Catatan wajib diisi jika laporan perlu direvisi.',
        ]);

        if ($this->laporan->status_laporan !== 'dikirim') {
            session()->flash('error', 'Laporan ini telah diproses dan tidak dapat diubah kembali.');
            return redirect()->route('verifikator.brida.laporan-akhir.list');
        }

        $this->laporan->update([
            'status_laporan' => $this->statusLaporan,
            'catatan_revisi' => $this->statusLaporan === 'revisi' ? $this->catatanRevisi : null,
        ]);

        if ($this->statusLaporan === 'revisi' && $this->laporan->permohonan->pemohon?->email) {
            try {
                Mail::to($this->laporan->permohonan->pemohon->email)
                    ->send(new NotifikasiRevisi('Laporan Akhir Penelitian', 'BRIDA', $this->catatanRevisi));
            } catch (\Exception $e) {
                session()->flash('error', 'Keputusan tersimpan, tetapi email notifikasi revisi gagal dikirim.');
                return redirect()->route('verifikator.brida.laporan-akhir.list');
            }
        }

        session()->flash('success', 'Verifikasi laporan akhir berhasil disimpan.');
        return redirect()->route('verifikator.brida.laporan-akhir.list');
    }

    public function render()
    {
        return view('livewire.verifikator.brida.laporan-akhir-detail-brida');
    }
}
