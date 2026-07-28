<?php

namespace App\Livewire\Penandatangan\Brida;

use App\Models\Permohonan;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.sidebar_layout_livewire')]
#[Title('Daftar Tanda Tangan - BRIDA')]
class TandaTanganList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $user = Auth::user();

        if ($user->role !== 'tanda_tangan' || $user->instansi !== 'brida') {
            abort(403, 'Akses ditolak! Halaman ini khusus untuk penandatangan BRIDA.');
        }
    }

    public function render()
    {
        return view('livewire.penandatangan.brida.tanda-tangan-list', [
            'permohonanList' => Permohonan::with(['pemohon', 'layanan'])
                ->where('status_permohonan', 'disetujui')
                ->whereHas('suratIzin', function ($query) {
                    $query->whereNotNull('file_surat_draft');
                })
                ->latest()
                ->paginate(10),
        ]);
    }
}
