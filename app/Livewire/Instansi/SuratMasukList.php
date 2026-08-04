<?php

namespace App\Livewire\Instansi;

use App\Models\TembusanOpd;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.sidebar_layout_livewire')]
#[Title('Surat Masuk')]
class SuratMasukList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $suratMasuk = TembusanOpd::with(['permohonan.pemohon', 'permohonan.layanan'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.instansi.surat-masuk-list', compact('suratMasuk'));
    }
}
