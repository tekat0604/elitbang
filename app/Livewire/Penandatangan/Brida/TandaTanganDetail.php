<?php

namespace App\Livewire\Penandatangan\Brida;

use App\Models\Permohonan;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.sidebar_layout_livewire')]
#[Title('Detail Tanda Tangan - BRIDA')]
class TandaTanganDetail extends Component
{
    public Permohonan $permohonan;
    public string $mode = 'detail';

    public function mount($id, $mode = 'detail')
    {
        $user = Auth::user();

        if ($user->role !== 'tanda_tangan' || $user->instansi !== 'brida') {
            abort(403, 'Akses ditolak! Halaman ini khusus untuk penandatangan BRIDA.');
        }

        abort_unless(in_array($mode, ['detail', 'surat'], true), 404);
        $this->mode = $mode;

        $this->permohonan = Permohonan::with(['pemohon', 'layanan', 'pembimbing', 'anggota', 'opdChild.opd', 'opdChild.kategori'])
            ->where('status_permohonan', 'disetujui')
            ->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.penandatangan.brida.tanda-tangan-detail');
    }
}
