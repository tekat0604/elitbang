<?php

namespace App\Livewire\Verifikator\Brida;

use App\Models\Permohonan;
use App\Models\SuratIzin;
use App\Services\SuratIzinService;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.sidebar_layout_livewire')]
#[Title('Antrean Terbitkan Surat - BRIDA')]
class PenomoranSurat extends Component
{
    public $nomor_surat;
    public $permohonan_id_terpilih;

    // untuk buat baru atau edit yang telah ada
    public function pilihPermohonan($id)
    {
        $this->permohonan_id_terpilih = $id;

        // Cek apakah sudah pernah input nomor
        $surat = SuratIzin::where('permohonan_id', $id)->first();

        if ($surat) {
            $this->nomor_surat = $surat->nomor_surat; // Munculkan nomor lama untuk diedit
        } else {
            $this->nomor_surat = '000.9.2/' . $id . '.PM/VI/' . date('Y'); // Format default
        }
    }

    // Simpan nomor surat
    public function simpanNomor()
    {
        // Cari ID surat saat ini agar validasi unique tidak error saat proses edit
        $suratId = SuratIzin::where('permohonan_id', $this->permohonan_id_terpilih)->value('id');

        $this->validate([
            'nomor_surat' => 'required|string|unique:surat_izin,nomor_surat,' . $suratId
        ], [
            'nomor_surat.required' => 'Nomor surat wajib diisi!',
            'nomor_surat.unique' => 'Nomor surat ini sudah pernah digunakan!'
        ]);

        // Gunakan updateOrCreate agar fleksibel (Bikin baru jika belum ada, Update jika sudah ada)
        SuratIzin::updateOrCreate(
            ['permohonan_id' => $this->permohonan_id_terpilih],
            ['nomor_surat' => $this->nomor_surat]
        );

        $this->reset(['nomor_surat', 'permohonan_id_terpilih']);
        $this->dispatch('close-modal');
    }

    //  ubah ke pdf
    public function terbitkanSurat($permohonan_id)
    {
        $permohonan = Permohonan::with(['pemohon', 'pembimbing', 'opdChild'])->find($permohonan_id);
        $surat = SuratIzin::where('permohonan_id', $permohonan_id)->first();

        if ($permohonan && $surat) {
            SuratIzinService::generateAndSave($permohonan, $surat->nomor_surat);
            session()->flash('success', 'Surat Izin berhasil diterbitkan dan masuk antrean Pejabat!');
        }
    }

    public function render()
    {
        $antrean = Permohonan::with(['pemohon', 'suratIzin'])
            ->where('status_permohonan', 'disetujui')
            ->orderByRaw('(SELECT count(*) FROM surat_izin WHERE surat_izin.permohonan_id = permohonan.id) ASC')
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('livewire.verifikator.brida.penomoran-surat', compact('antrean'));
    }
}