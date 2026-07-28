<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use App\Models\PejabatInstansi;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.sidebar_layout_livewire')]
#[Title('Data Instansi')]
class DataInstansi extends Component
{
    public $pejabat_id;
    public $nama_kepala_instansi;
    public $nip;
    public $instansi_name;

    // Status Modal
    public $isModalOpen = false;

    public function mount()
    {
        $user = Auth::user();

        if ($user->role !== 'admin') {
            abort(403, 'Akses ditolak! Halaman ini khusus untuk admin.');
        }
    }

    public function render()
    {
        // Hanya memanggil Kesbangpol dan Brida
        $dataInstansi = PejabatInstansi::whereIn('instansi', ['kesbangpol', 'brida'])->get();

        return view('livewire.admin.data-instansi', compact('dataInstansi'));
    }

    public function edit($id)
    {
        $pejabat = PejabatInstansi::findOrFail($id);

        $this->pejabat_id = $id;
        $this->nama_kepala_instansi = $pejabat->nama_kepala_instansi;
        $this->nip = $pejabat->nip;
        $this->instansi_name = $pejabat->instansi;

        $this->openModal();
    }

    public function update()
    {
        // Validasi input
        $this->validate([
            'nama_kepala_instansi' => 'required|string|max:255',
            'nip' => 'required|string|max:50',
        ]);

        if ($this->pejabat_id) {
            $pejabat = PejabatInstansi::findOrFail($this->pejabat_id);
            $pejabat->update([
                'nama_kepala_instansi' => $this->nama_kepala_instansi,
                'nip' => $this->nip,
            ]);

            session()->flash('message', 'Data instansi berhasil diperbarui!');
            $this->closeModal();
        }
    }

    public function openModal()
    {
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        // Kosongkan form setelah modal ditutup
        $this->reset(['pejabat_id', 'nama_kepala_instansi', 'nip', 'instansi_name']);
    }
}