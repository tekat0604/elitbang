<?php

namespace App\Livewire\Verifikator;

use App\Models\Pemohon;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

#[Layout('layouts.sidebar_layout_livewire')]
#[Title('Daftar Verifikasi Pemohon')]
class PemohonList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';



    public function render()
    {
        // Mengambil data pemohon, urutkan yang pending di paling atas
        $pemohonList = Pemohon::orderByRaw("FIELD(status_verifikasi, 'pending', 'revisi', 'terverifikasi')")
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.verifikator.pemohon-list', [
            'pemohonList' => $pemohonList
        ]);
    }
}