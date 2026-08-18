<?php

namespace App\Livewire\Verifikator\Brida;

use App\Models\Permohonan;
use App\Models\SuratIzin;
use App\Models\LaporanAkhir;
use App\Models\SuratSelesai;
use App\Services\SuratIzinService;
use App\Services\SuratSelesaiService;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.sidebar_layout_livewire')]
#[Title('Antrean Terbitkan Surat - BRIDA')]
class PenomoranSurat extends Component
{
    public $nomor_surat;
    public $target_id_terpilih;
    public $tipe_surat_terpilih;

    public function pilihTarget($id, $tipe)
    {
        $this->target_id_terpilih = $id;
        $this->tipe_surat_terpilih = $tipe;

        if ($tipe === 'rekomendasi') {
            // Cek langsung ke tabel SuratIzin
            $surat = SuratIzin::where('permohonan_id', $id)->first();
            $this->nomor_surat = $surat ? $surat->nomor_surat : '';
        } else {
            // Cek langsung ke tabel SuratSelesai
            $suratSelesai = SuratSelesai::where('laporan_akhir_id', $id)->first();
            $this->nomor_surat = $suratSelesai ? $suratSelesai->nomor_surat : '';
        }
    }

    public function simpanNomor()
    {
        // 1. Validasi Unik yang Mengarah ke Tabel yang Benar
        if ($this->tipe_surat_terpilih === 'rekomendasi') {
            $suratId = SuratIzin::where('permohonan_id', $this->target_id_terpilih)->value('id');
            $ruleUnique = 'unique:surat_izin,nomor_surat,' . $suratId;
        } else {
            $suratSelesaiId = SuratSelesai::where('laporan_akhir_id', $this->target_id_terpilih)->value('id');
            $ruleUnique = 'unique:surat_selesai,nomor_surat,' . $suratSelesaiId;
        }

        $this->validate([
            'nomor_surat' => 'required|string|' . $ruleUnique
        ], [
            'nomor_surat.required' => 'Nomor surat wajib diisi!',
            'nomor_surat.unique' => 'Nomor surat ini sudah pernah digunakan!'
        ]);

        // 2. Simpan Data & Kunci Edit Jika Sudah Diterbitkan
        if ($this->tipe_surat_terpilih === 'rekomendasi') {

            $surat = SuratIzin::where('permohonan_id', $this->target_id_terpilih)->first();
            if ($surat && !empty($surat->file_path)) {
                session()->flash('error', 'Akses ditolak! Surat izin sudah diterbitkan dan tidak bisa diedit.');
                $this->dispatch('close-modal');
                return;
            }

            SuratIzin::updateOrCreate(
                ['permohonan_id' => $this->target_id_terpilih],
                ['nomor_surat' => $this->nomor_surat]
            );

        } else {

            $suratSelesai = SuratSelesai::where('laporan_akhir_id', $this->target_id_terpilih)->first();
            if ($suratSelesai && !empty($suratSelesai->file_path)) {
                session()->flash('error', 'Akses ditolak! Surat keterangan selesai sudah diterbitkan dan tidak bisa diedit.');
                $this->dispatch('close-modal');
                return;
            }

            SuratSelesai::updateOrCreate(
                ['laporan_akhir_id' => $this->target_id_terpilih],
                ['nomor_surat' => $this->nomor_surat]
            );

        }

        $this->reset(['nomor_surat', 'target_id_terpilih', 'tipe_surat_terpilih']);
        session()->flash('success', 'Nomor surat berhasil disimpan!');
        $this->dispatch('close-modal');
    }

    public function terbitkanSurat($id, $tipe)
    {
        if ($tipe === 'rekomendasi') {
            $permohonan = Permohonan::with(['pemohon', 'pembimbing', 'opdChild'])->find($id);
            $surat = SuratIzin::where('permohonan_id', $id)->first();

            if ($permohonan && $surat) {
                SuratIzinService::generateAndSave($permohonan, $surat->nomor_surat);
                session()->flash('success', 'Surat Rekomendasi berhasil diterbitkan!');
            }
        } else {
            $laporan = LaporanAkhir::with(['permohonan.pemohon', 'suratSelesai'])->find($id);

            if ($laporan && $laporan->suratSelesai && $laporan->suratSelesai->nomor_surat) {
                SuratSelesaiService::generateAndSave($laporan, $laporan->suratSelesai->nomor_surat);
                session()->flash('success', 'Surat Keterangan Selesai berhasil diterbitkan!');
            }
        }
    }

    public function render()
    {
        $antreanRekomendasi = Permohonan::with(['pemohon', 'suratIzin'])
            ->where('status_permohonan', 'disetujui')
            ->get()
            ->map(function ($item) {
                return (object) [
                    'id' => $item->id,
                    'tipe' => 'rekomendasi',
                    'tgl_acc' => $item->updated_at,
                    'nama_pemohon' => $item->pemohon->nama_lengkap ?? '-',
                    'judul' => $item->judul,
                    'nomor_surat' => $item->suratIzin->nomor_surat ?? null,
                    'file_path' => $item->suratIzin->file_path ?? null,
                    'qr_code_link' => $item->suratIzin->qr_code_link ?? null,
                    'tgl_terbit' => $item->suratIzin && !empty($item->suratIzin->file_path) ? $item->suratIzin->updated_at : null,
                ];
            });

        $antreanSelesai = LaporanAkhir::with(['permohonan.pemohon', 'suratSelesai'])
            ->where('status_laporan', 'disetujui')
            ->get()
            ->map(function ($item) {
                return (object) [
                    'id' => $item->id,
                    'tipe' => 'selesai',
                    'tgl_acc' => $item->updated_at,
                    'nama_pemohon' => $item->permohonan->pemohon->nama_lengkap ?? '-',
                    'judul' => $item->permohonan->judul,
                    'nomor_surat' => $item->suratSelesai->nomor_surat ?? null,
                    'file_path' => $item->suratSelesai->file_path ?? null,
                    'qr_code_link' => $item->suratSelesai->qr_code_link ?? null,
                    'tgl_terbit' => $item->suratSelesai && !empty($item->suratSelesai->file_path) ? $item->suratSelesai->updated_at : null,
                ];
            });

        $antrean = $antreanRekomendasi->concat($antreanSelesai)->sortByDesc('tgl_acc');

        return view('livewire.verifikator.brida.penomoran-surat', compact('antrean'));
    }
}