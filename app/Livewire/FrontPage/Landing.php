<?php

namespace App\Livewire\FrontPage;

use App\Models\Alur;
use App\Models\Layanan;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.front_layout')]
class Landing extends Component
{
    public function render()
    {
        $getlayanan     = Layanan::get();
        $getAlur        = Alur::first();
        return view('livewire.front-page.landing', [
            'layanan'   => $getlayanan,
            'alur'      => $getAlur,
        ]);
    }
}
