<?php

namespace App\Livewire\Penandatangan\Brida;

use App\Models\Permohonan;
use App\Models\LaporanAkhir;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.sidebar_layout_livewire')]
#[Title('Detail Tanda Tangan - BRIDA')]
class TandaTanganDetail extends Component
{
    public $permohonan;
    public $laporan;
    public string $tipe_surat;
    public string $mode = 'detail';

    public function mount($id, $tipe = 'rekomendasi', $mode = 'detail')
    {
        $user = Auth::user();

        if ($user->role !== 'tanda_tangan' || $user->instansi !== 'brida') {
            abort(403, 'Akses ditolak! Halaman ini khusus untuk penandatangan BRIDA.');
        }

        abort_unless(in_array($mode, ['detail', 'surat'], true), 404);
        $this->mode = $mode;
        $this->tipe_surat = $tipe;

        if ($tipe === 'rekomendasi') {
            $this->permohonan = Permohonan::with(['pemohon', 'layanan', 'pembimbing', 'anggota', 'opd', 'opdChild.opd', 'opdChild.kategori', 'suratIzin'])
                ->findOrFail($id);
        } else {
            $this->laporan = LaporanAkhir::with(['permohonan.pemohon', 'permohonan.layanan', 'suratSelesai'])
                ->findOrFail($id);
            // Salin relasi permohonan agar view tidak perlu diubah secara drastis
            $this->permohonan = $this->laporan->permohonan;
        }
    }

    public function render()
    {
        return view('livewire.penandatangan.brida.tanda-tangan-detail');
    }
}