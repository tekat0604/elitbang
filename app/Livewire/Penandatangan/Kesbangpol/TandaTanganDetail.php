<?php

namespace App\Livewire\Penandatangan\Kesbangpol;

use App\Models\Permohonan;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.sidebar_layout_livewire')]
#[Title('Detail Tanda Tangan - Kesbangpol')]
class TandaTanganDetail extends Component
{
    public Permohonan $permohonan;
    public string $mode = 'detail';

    public function mount($id, $mode = 'detail')
    {
        $user = Auth::user();

        if ($user->role !== 'tanda_tangan' || $user->instansi !== 'kesbangpol') {
            abort(403, 'Akses ditolak! Halaman ini khusus untuk penandatangan Kesbangpol.');
        }

        abort_unless(in_array($mode, ['detail', 'surat'], true), 404);
        $this->mode = $mode;

        $this->permohonan = Permohonan::with(['pemohon', 'layanan', 'pembimbing', 'anggota', 'opd', 'opdChild.opd', 'opdChild.kategori', 'suratIzin'])
            ->where('status_permohonan', 'disetujui')
            ->whereHas('suratIzin', function ($query) {
                $query->whereNotNull('file_path');
            })
            ->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.penandatangan.kesbangpol.tanda-tangan-detail');
    }
}
