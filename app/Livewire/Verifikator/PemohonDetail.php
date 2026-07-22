<?php

namespace App\Livewire\Verifikator;

use App\Models\Pemohon;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Mail\NotifikasiRevisi;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;


#[Layout('layouts.sidebar_layout_livewire')]
#[Title('Detail Verifikasi Pemohon')]
class PemohonDetail extends Component
{
    public Pemohon $pemohon;
    public $status_verifikasi;
    public $catatan_verifikasi;

    public function mount($id)
    {
        $user = Auth::user();
        if ($user->role !== 'verifikator' || $user->instansi !== 'brida') {
            abort(403, 'Akses ditolak! Verifikasi ini adalah khusus untuk BRIDA.');
        }

        $this->pemohon = Pemohon::findOrFail($id);
        $this->status_verifikasi = $this->pemohon->status_verifikasi;
        $this->catatan_verifikasi = $this->pemohon->catatan_verifikasi;
    }

    protected function rules()
    {
        return [
            'status_verifikasi' => ['required', 'in:pending,terverifikasi,revisi'],
            // Catatan WAJIB diisi JIKA statusnya revisi
            'catatan_verifikasi' => ['required_if:status_verifikasi,revisi', 'nullable', 'string', 'max:500'],
        ];
    }

    protected function messages()
    {
        return [
            'status_verifikasi.required' => 'Pilih keputusan verifikasi terlebih dahulu.',
            'catatan_verifikasi.required_if' => 'Catatan wajib diisi jika Anda memilih status Revisi',
        ];
    }

    public function simpanVerifikasi()
    {
        // cek apakah sudah terverifikasi 
        if ($this->pemohon->status_verifikasi === 'terverifikasi') {
            session()->flash('error', 'Data ini sudah diverifikasi dan tidak dapat diubah lagi.');
            return redirect()->route('verifikator.pemohon.list');
        }
        // cek apakah sedang dalam proses revisi
        if ($this->pemohon->status_verifikasi === 'revisi') {
            session()->flash('error', 'Tindakan Ditolak! Pemohon sedang dalam proses memperbaiki data.');
            return redirect()->route('verifikator.pemohon.list');
        }

        $this->validate();

        // simpan perubahan
        $this->pemohon->update([
            'status_verifikasi' => $this->status_verifikasi,
            'catatan_verifikasi' => ($this->status_verifikasi === 'terverifikasi') ? null : $this->catatan_verifikasi,
        ]);

        // kirim ke email setelah di update
        if ($this->status_verifikasi === 'revisi') {
            // Mengambil email dari relasi tabel User (pastikan model Pemohon punya fungsi user())
            $emailTujuan = $this->pemohon->user->email;

            // Kirim email notifikasi
            Mail::to($emailTujuan)->send(new NotifikasiRevisi(
                'Profil Identitas', // identitas
                'BRIDA',            // Instansi yang memverifikasi profil
                $this->catatan_verifikasi
            ));
        }

        session()->flash('success', 'Status verifikasi berhasil diperbarui!');
        return redirect()->route('verifikator.pemohon.list');
    }

    public function render()
    {
        return view('livewire.verifikator.pemohon-detail');
    }
}