<?php

namespace App\Livewire\Verifikator\Brida;

use App\Models\LaporanAkhir;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.sidebar_layout_livewire')]
#[Title('Pengajuan Laporan Akhir - BRIDA')]
class LaporanAkhirListBrida extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function mount(): void
    {
        $user = Auth::user();

        if ($user->role !== 'verifikator' || $user->instansi !== 'brida') {
            abort(403, 'Akses Ditolak! Halaman ini khusus untuk Verifikator BRIDA.');
        }
    }

    public function render()
    {
        $laporanList = LaporanAkhir::with(['permohonan.pemohon', 'permohonan.layanan'])
            ->latest('tanggal_upload')
            ->paginate(10);

        return view('livewire.verifikator.brida.laporan-akhir-list-brida', compact('laporanList'));
    }
}
