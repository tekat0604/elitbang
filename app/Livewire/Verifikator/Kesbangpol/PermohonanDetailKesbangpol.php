<?php

namespace App\Livewire\Verifikator\Kesbangpol;

use Livewire\Component;
use App\Models\Permohonan;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifikasiRevisi;
use App\Services\SuratIzinService;

#[Layout('layouts.sidebar_layout_livewire')]
#[Title('Verifikasi Substantif - Kesbangpol')]
class PermohonanDetailKesbangpol extends Component
{
    public Permohonan $permohonan;
    public $status_kesbangpol;
    public $catatan_kesbangpol;

    public function mount($id)
    {
        $user = Auth::user();
        // Kunci akses khusus untuk Kesbangpol
        if ($user->role !== 'verifikator' || $user->instansi !== 'kesbangpol') {
            abort(403, 'Akses ditolak! Verifikasi ini khusus untuk Kesbangpol.');
        }

        $this->permohonan = Permohonan::with(['pemohon', 'layanan'])->findOrFail($id);
        $this->status_kesbangpol = $this->permohonan->status_kesbangpol;
        $this->catatan_kesbangpol = $this->permohonan->catatan_kesbangpol;
    }

    protected function messages()
    {
        return [
            'status_kesbangpol.required' => 'Keputusan verifikasi wajib dipilih.',
            'status_kesbangpol.in' => 'Pilihan keputusan tidak valid.',
            'catatan_kesbangpol.required_if' => 'Catatan wajib diisi jika Anda meminta revisi.',
        ];
    }

    public function simpanVerifikasi()
    {
        $this->validate([
            'status_kesbangpol' => 'required|in:pending,revisi,disetujui,ditolak',
            'catatan_kesbangpol' => 'required_if:status_kesbangpol,revisi|nullable|string'
        ]);

        $this->permohonan->status_kesbangpol = $this->status_kesbangpol;
        $this->permohonan->catatan_kesbangpol = $this->status_kesbangpol === 'disetujui' ? null : $this->catatan_kesbangpol;

        $status_brida = $this->permohonan->status_brida;

        if ($this->status_kesbangpol === 'ditolak' || $status_brida === 'ditolak') {
            $this->permohonan->status_permohonan = 'ditolak';
        } elseif ($this->status_kesbangpol === 'revisi' || $status_brida === 'revisi') {
            $this->permohonan->status_permohonan = 'revisi';
        } elseif ($this->status_kesbangpol === 'disetujui' && $status_brida === 'disetujui') {
            $this->permohonan->status_permohonan = 'disetujui';
            $this->permohonan->save();

            SuratIzinService::generateAndSave($this->permohonan);
        } else {
            $this->permohonan->status_permohonan = 'proses_verifikasi';
        }

        $this->permohonan->save();

        if ($this->status_kesbangpol === 'revisi') {
            if ($this->permohonan->pemohon && $this->permohonan->pemohon->email) {
                try {
                    Mail::to($this->permohonan->pemohon->email)
                        ->send(new NotifikasiRevisi('Permohonan Izin Penelitian (Substantif)', 'Kesbangpol', $this->catatan_kesbangpol));
                } catch (\Exception $e) {
                    session()->flash('error', 'Keputusan tersimpan, tetapi gagal mengirim email ke pemohon.');

                    return redirect()->route('verifikator.kesbangpol.permohonan.list');
                }
            }
        }

        session()->flash('success', 'Keputusan substantif Kesbangpol berhasil disimpan!');

        // Redirect langsung ke halaman List
        return redirect()->route('verifikator.kesbangpol.permohonan.list');
    }

    public function render()
    {
        return view('livewire.verifikator.kesbangpol.permohonan-detail-kesbangpol');
    }
}