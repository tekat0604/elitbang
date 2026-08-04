<?php

namespace App\Livewire\Penandatangan\Brida;

use App\Models\Permohonan;
use App\Models\SuratIzin;
use App\Services\SuratIzinService;
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

    public $password = '';
    public $selectedPermohonanId = null;

    public function mount()
    {
        $user = Auth::user();

        if ($user->role !== 'tanda_tangan' || $user->instansi !== 'brida') {
            abort(403, 'Akses ditolak! Halaman ini khusus untuk penandatangan BRIDA.');
        }
    }

    public function openModal($id)
    {
        $this->selectedPermohonanId = $id;
        $this->reset('password');
    }

    public function prosesTandaTangan()
    {
        $this->validate([
            'password' => 'required'
        ]);

        $permohonan = Permohonan::findOrFail($this->selectedPermohonanId);
        $surat = SuratIzin::where('permohonan_id', $this->selectedPermohonanId)->first();

        if ($surat) {
            $surat->update(['status_tte_brida' => 'selesai']);

            SuratIzinService::generateAndSave($permohonan, $surat->nomor_surat);
        }

        $this->dispatch('close-modal-tanda-tangan');
        session()->flash('success', 'Tanda tangan berhasil dibubuhkan pada dokumen.');
    }

    public function render()
    {
        return view('livewire.penandatangan.brida.tanda-tangan-list', [
            'permohonanList' => Permohonan::with(['pemohon', 'layanan'])
                ->where('status_permohonan', 'disetujui')
                ->whereHas('suratIzin', function ($query) {
                    $query->whereNotNull('file_path')->where('status_tte_brida', '!=', 'selesai');
                })
                ->latest()
                ->paginate(10),
        ]);
    }
}
