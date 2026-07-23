<?php

namespace App\Livewire\Penandatangan\Kesbangpol;

use App\Models\Permohonan;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.sidebar_layout_livewire')]
#[Title('Daftar Tanda Tangan - Kesbangpol')]
class TandaTanganList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $user = Auth::user();

        if ($user->role !== 'tanda_tangan' || $user->instansi !== 'kesbangpol') {
            abort(403, 'Akses ditolak! Halaman ini khusus untuk penandatangan Kesbangpol.');
        }
    }

    public function render()
    {
        return view('livewire.penandatangan.kesbangpol.tanda-tangan-list', [
            'permohonanList' => Permohonan::with(['pemohon', 'layanan'])
                ->where('status_permohonan', 'disetujui')
                ->latest()
                ->paginate(10),
        ]);
    }
}
