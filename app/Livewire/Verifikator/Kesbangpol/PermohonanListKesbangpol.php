<?php

namespace App\Livewire\Verifikator\Kesbangpol;

use App\Models\Permohonan;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.sidebar_layout_livewire')]
#[Title('Daftar Antrean Permohonan - Kesbangpol')]
class PermohonanListKesbangpol extends Component
{
    use WithPagination;

    // Menggunakan tema bootstrap untuk pagination
    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $user = Auth::user();

        // Kunci eksklusif: Hanya Verifikator Kesbangpol yang boleh melihat daftar ini
        if ($user->role !== 'verifikator' || $user->instansi !== 'kesbangpol') {
            abort(403, 'Akses Ditolak! Halaman ini khusus untuk Verifikator Kesbangpol.');
        }
    }

    public function render()
    {
        // Mengambil data permohonan beserta relasi pemohon dan layanannya
        $permohonanList = Permohonan::with(['pemohon', 'layanan'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.verifikator.kesbangpol.permohonan-list-kesbangpol', [
            'permohonanList' => $permohonanList
        ]);
    }
}