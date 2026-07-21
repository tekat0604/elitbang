<?php

namespace App\Livewire\Verifikator\Brida;

use App\Models\Permohonan;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.sidebar_layout_livewire')]
#[Title('Daftar Antrean Permohonan - BRIDA')]
class PermohonanListBrida extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $user = Auth::user();

        if ($user->role !== 'verifikator' || $user->instansi !== 'brida') {
            abort(403, 'Akses Ditolak! Halaman ini khusus untuk Verifikator BRIDA.');
        }
    }

    public function render()
    {
        // Mengambil data permohonan beserta relasi pemohon dan layanannya
        $permohonanList = Permohonan::with(['pemohon', 'layanan'])
            ->orderBy('created_at', 'desc')
            ->paginate(10); // Menampilkan 10 data per halaman

        return view('livewire.verifikator.brida.permohonan-list-brida', [
            'permohonanList' => $permohonanList
        ]);
    }
}