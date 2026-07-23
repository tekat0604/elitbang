<?php

namespace App\Livewire\Verifikator\Brida;

use Livewire\Component;
use App\Models\Permohonan;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifikasiRevisi;


#[Layout('layouts.sidebar_layout_livewire')]
#[Title('Verifikasi Permohonan - BRIDA')]
class PermohonanDetailBrida extends Component
{
    public Permohonan $permohonan;
    public $status_brida;
    public $catatan_brida;

    public function mount($id)
    {
        $user = Auth::user();
        if ($user->role !== 'verifikator' || $user->instansi !== 'brida') {
            abort(403, 'Akses ditolak! Verifikasi ini adalah khusus untuk BRIDA.');
        }

        $this->permohonan = Permohonan::with(['pemohon', 'layanan', 'anggota', 'pembimbing'])->findOrFail($id);
        $this->status_brida = $this->permohonan->status_brida;
        $this->catatan_brida = $this->permohonan->catatan_brida;
    }
    protected function messages()
    {
        return [
            'status_brida.required' => 'Keputusan verifikasi wajib dipilih.',
            'status_brida.in' => 'Pilihan keputusan tidak valid.',
            'catatan_brida.required_if' => 'Catatan wajib diisi jika Anda meminta revisi.',
        ];
    }

    public function simpanVerifikasi()
    {
        $this->validate([
            'status_brida' => 'required|in:pending,revisi,disetujui,ditolak',
            'catatan_brida' => 'required_if:status_brida,revisi|nullable|string'
        ]);

        $this->permohonan->status_brida = $this->status_brida;
        $this->permohonan->catatan_brida = $this->status_brida === 'disetujui' ? null : $this->catatan_brida;

        $status_kesbang = $this->permohonan->status_kesbangpol;

        if ($this->status_brida === 'ditolak' || $status_kesbang === 'ditolak') {
            $this->permohonan->status_permohonan = 'ditolak';
        } elseif ($this->status_brida === 'revisi' || $status_kesbang === 'revisi') {
            $this->permohonan->status_permohonan = 'revisi';
        } elseif ($this->status_brida === 'disetujui' && $status_kesbang === 'disetujui') {
            $this->permohonan->status_permohonan = 'disetujui';
        } else {
            $this->permohonan->status_permohonan = 'proses_verifikasi';
        }

        $this->permohonan->save();

        // Fitur Kirim Email Jika Revisi
        if ($this->status_brida === 'revisi') {
            if ($this->permohonan->pemohon && $this->permohonan->pemohon->email) {
                try {
                    Mail::to($this->permohonan->pemohon->email)
                        ->send(new NotifikasiRevisi('Permohonan Izin Penelitian (Data Teknis)', 'BRIDA', $this->catatan_brida));
                } catch (\Exception $e) {
                    session()->flash('error', 'Keputusan tersimpan, tetapi sistem gagal mengirim email notifikasi ke pemohon.');
                    return redirect()->route('verifikator.brida.permohonan.list');
                }
            }
        }

        session()->flash('success', 'Keputusan teknis BRIDA berhasil disimpan!');

        return redirect()->route('verifikator.brida.permohonan.list');
    }
    public function render()
    {
        return view('livewire.verifikator.brida.permohonan-detail-brida');
    }
}
