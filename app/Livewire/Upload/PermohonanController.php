<?php

namespace App\Livewire\Upload;

use App\Models\Permohonan;
use App\Models\PembimbingPermohonan;
use App\Models\AnggotaPermohonan;
use App\Models\Layanan;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

#[Layout('layouts.sidebar_layout_livewire')]
#[Title('Form Data Permohonan')]
class PermohonanController extends Component
{
    public $currentStep = 1;

    // --- TAMBAHAN UNTUK MODE REVISI ---
    public $permohonan_id = null;
    public $isEditMode = false;

    public $layanan_id;
    public $nama_layanan_terpilih;
    public $isPenelitian = false;
    public $judul, $jenjang_pendidikan, $bidang_penelitian, $rumpun_penelitian;
    public $nama_instansi_tujuan, $alamat_instansi_tujuan;
    public $lokasi, $tgl_mulai, $tgl_selesai;
    public $jenis_pengajuan = 'Personal';
    public $pembimbing = [];
    public $anggota = [];
    public $link_pengantar_kampus, $link_proposal;

    // Menangkap parameter
    public function mount($layanan_slug = null, $id = null)
    {
        $pemohon = Auth::user()->pemohon;

        if (!$pemohon || $pemohon->status_verifikasi !== 'terverifikasi') {
            session()->flash('error', 'Akses Ditolak! Identitas Anda harus diverifikasi oleh BRIDA.');
            return redirect()->route('permohonan');
        }

        if ($id) {
            $this->isEditMode = true;
            $permohonan = Permohonan::with(['layanan', 'pembimbing', 'anggota'])->findOrFail($id);

            // Keamanan tambahan untuk revisi
            if ($permohonan->pemohon_id !== $pemohon->id || $permohonan->status_permohonan !== 'revisi') {
                session()->flash('error', 'Akses Ilegal! Data tidak dalam masa revisi atau bukan milik Anda.');
                return redirect()->route('permohonan');
            }

            $this->permohonan_id = $permohonan->id;
            $this->layanan_id = $permohonan->layanan_id;
            $this->nama_layanan_terpilih = $permohonan->layanan->nama_layanan;
            $this->isPenelitian = $permohonan->layanan->slug_layanan === 'izin-penelitian';

            // Suntik data lama ke form
            $this->judul = $permohonan->judul;
            $this->lokasi = $permohonan->lokasi;
            $this->tgl_mulai = $permohonan->tgl_mulai;
            $this->tgl_selesai = $permohonan->tgl_selesai;
            $this->jenjang_pendidikan = $permohonan->jenjang_pendidikan;
            $this->bidang_penelitian = $permohonan->bidang_penelitian;
            $this->rumpun_penelitian = $permohonan->rumpun_penelitian;
            $this->jenis_pengajuan = $permohonan->jenis_pengajuan;
            $this->nama_instansi_tujuan = $permohonan->nama_instansi_tujuan;
            $this->alamat_instansi_tujuan = $permohonan->alamat_instansi_tujuan;
            $this->link_pengantar_kampus = $permohonan->link_pengantar_kampus;
            $this->link_proposal = $permohonan->link_proposal;

            // Suntik array dinamis
            foreach ($permohonan->pembimbing as $p) {
                $this->pembimbing[] = ['nama_pembimbing' => $p->nama_pembimbing];
            }
            if (empty($this->pembimbing))
                $this->addPembimbing();

            foreach ($permohonan->anggota as $a) {
                $this->anggota[] = ['nama_anggota' => $a->nama_anggota, 'nik' => $a->nik];
            }

        } elseif ($layanan_slug) {
            $layanan = Layanan::where('slug_layanan', $layanan_slug)->first();

            if (!$layanan) {
                session()->flash('error', "Jenis izin tidak ditemukan.");
                return redirect()->route('permohonan.pilih-jenis');
            }

            $this->layanan_id = $layanan->id;
            $this->nama_layanan_terpilih = $layanan->nama_layanan;
            $this->isPenelitian = $layanan->slug_layanan === 'izin-penelitian';

            // Tambah baris kosong default untuk pembimbing
            $this->addPembimbing();
        }
    }

    public function nextStep()
    {
        $this->validateStep();
        $this->currentStep++;
    }
    public function prevStep()
    {
        $this->currentStep--;
    }

    public function addPembimbing()
    {
        $this->pembimbing[] = ['nama_pembimbing' => ''];
    }
    public function removePembimbing($index)
    {
        unset($this->pembimbing[$index]);
        $this->pembimbing = array_values($this->pembimbing);
    }

    public function addAnggota()
    {
        $this->anggota[] = ['nama_anggota' => '', 'nik' => ''];
    }
    public function removeAnggota($index)
    {
        unset($this->anggota[$index]);
        $this->anggota = array_values($this->anggota);
    }

    public function updatedJenisPengajuan($value)
    {
        if ($value === 'Personal') {
            $this->anggota = [];
        } else {
            if (empty($this->anggota))
                $this->addAnggota();
        }
    }

    protected function messages()
    {
        return [
            'judul.required' => 'Judul penelitian atau kegiatan wajib diisi.',
            'jenjang_pendidikan.required' => 'Silakan pilih jenjang pendidikan.',
            'jenjang_pendidikan.in' => 'Jenjang pendidikan tidak valid.',
            'bidang_penelitian.required' => 'Bidang penelitian wajib diisi.',
            'rumpun_penelitian.required' => 'Rumpun penelitian wajib diisi.',
            'nama_instansi_tujuan.required' => 'Nama instansi atau universitas asal wajib diisi.',
            'alamat_instansi_tujuan.required' => 'Alamat instansi asal wajib diisi.',

            'lokasi.required' => 'Lokasi penelitian (OPD/Instansi) wajib diisi.',
            'tgl_mulai.required' => 'Tanggal mulai kegiatan wajib diisi.',
            'tgl_mulai.date' => 'Format tanggal mulai salah.',
            'tgl_mulai.after' => 'Tanggal mulai tidak boleh hari ini atau lebih awal dari hari ini.',
            'tgl_selesai.required' => 'Tanggal selesai kegiatan wajib diisi.',
            'tgl_selesai.date' => 'Format tanggal selesai salah.',
            'tgl_selesai.after' => 'Tanggal selesai tidak boleh hari ini atau lebih awal dari hari ini.',
            'tgl_selesai.after_or_equal' => 'Tanggal selesai tidak boleh lebih awal dari tanggal mulai.',

            'pembimbing.*.nama_pembimbing.required' => 'Nama pembimbing tidak boleh kosong.',
            'anggota.*.nama_anggota.required' => 'Nama anggota tidak boleh kosong.',
            'anggota.*.nik.required' => 'NIK anggota tidak boleh kosong.',
            'anggota.*.nik.min' => 'NIK anggota minimal 14 karakter.',
            'anggota.*.nik.max' => 'NIK anggota maksimal 18 karakter.',
            'anggota.*.nik.distinct' => 'Terdapat NIK yang ganda',

            'link_pengantar_kampus.required' => 'Link Google Drive surat pengantar wajib diisi.',
            'link_pengantar_kampus.url' => 'Format tidak valid. Pastikan diawali dengan http:// atau https://',
            'link_proposal.required' => 'Link Google Drive proposal wajib diisi.',
            'link_proposal.url' => 'Format tidak valid. Pastikan diawali dengan http:// atau https://',
        ];
    }

    public function validateStep()
    {
        if ($this->currentStep == 1) {
            $this->validate([
                'judul' => 'required|string|max:255',
                'jenjang_pendidikan' => 'required|string|in:SMA,D3,D4,S1,S2,S3',
                'bidang_penelitian' => 'required|string',
                'rumpun_penelitian' => 'required|string',
                'nama_instansi_tujuan' => 'required|string',
                'alamat_instansi_tujuan' => 'required|string',
            ]);
        } elseif ($this->currentStep == 2) {
            $rules = [
                'lokasi' => 'required|string',
                'tgl_mulai' => 'required|date|after:today',
                'tgl_selesai' => 'required|date|after:today|after_or_equal:tgl_mulai',
                'jenis_pengajuan' => 'required|in:Personal,Kelompok',
                'pembimbing.*.nama_pembimbing' => 'required|string',
            ];

            if ($this->jenis_pengajuan === 'Kelompok') {
                $rules['anggota.*.nama_anggota'] = 'required|string';
                $rules['anggota.*.nik'] = 'required|string|min:14|max:18|distinct';
            }
            $this->validate($rules);
        }
    }

    public function submitForm()
    {
        $rules = ['link_pengantar_kampus' => 'required|url'];
        if ($this->isPenelitian) {
            $rules['link_proposal'] = 'required|url';
        }
        $this->validate($rules);

        $pemohon = Auth::user()->pemohon;
        if (!$pemohon || $pemohon->status_verifikasi !== 'terverifikasi') {
            return abort(403, 'Akses Ilegal: Identitas Anda belum terverifikasi oleh BRIDA.');
        }

        DB::transaction(function () use ($pemohon) {

            $dataPermohonan = [
                'pemohon_id' => $pemohon->id,
                'layanan_id' => $this->layanan_id,
                'judul' => $this->judul,
                'lokasi' => $this->lokasi,
                'tgl_mulai' => $this->tgl_mulai,
                'tgl_selesai' => $this->tgl_selesai,
                'jenjang_pendidikan' => $this->jenjang_pendidikan,
                'bidang_penelitian' => $this->bidang_penelitian,
                'rumpun_penelitian' => $this->rumpun_penelitian,
                'jenis_pengajuan' => $this->jenis_pengajuan,
                'jumlah_anggota' => count($this->anggota) + 1,
                'nama_instansi_tujuan' => $this->nama_instansi_tujuan,
                'alamat_instansi_tujuan' => $this->alamat_instansi_tujuan,
                'link_pengantar_kampus' => $this->link_pengantar_kampus,
                'link_proposal' => $this->link_proposal,
                'status_permohonan' => 'diajukan', // Set ulang ke diajukan
                'status_kesbangpol' => 'pending', // Set ulang ke pending
                'status_brida' => 'pending', // Set ulang ke pending
            ];

            if ($this->isEditMode) {
                // jika edit lalu update
                $permohonan = Permohonan::findOrFail($this->permohonan_id);
                $permohonan->update($dataPermohonan);

                // Hapus data pembimbing dan anggota lama
                $permohonan->pembimbing()->delete();
                $permohonan->anggota()->delete();

            } else {
                // jika user baru
                $permohonan = Permohonan::create($dataPermohonan);
            }

            // Simpan Pembimbing Baru / Revisi
            foreach ($this->pembimbing as $p) {
                if (!empty($p['nama_pembimbing'])) {
                    PembimbingPermohonan::create([
                        'permohonan_id' => $permohonan->id,
                        'nama_pembimbing' => $p['nama_pembimbing']
                    ]);
                }
            }

            // Simpan Anggota Baru / Revisi
            if ($this->jenis_pengajuan === 'Kelompok') {
                foreach ($this->anggota as $a) {
                    if (!empty($a['nama_anggota'])) {
                        AnggotaPermohonan::create([
                            'permohonan_id' => $permohonan->id,
                            'nama_anggota' => $a['nama_anggota'],
                            'nik' => $a['nik']
                        ]);
                    }
                }
            }
        });

        $pesan = $this->isEditMode ? 'Revisi permohonan berhasil dikirim kembali.' : 'Permohonan izin berhasil diajukan dan menunggu verifikasi.';
        session()->flash('success', $pesan);
        return redirect()->route('permohonan');
    }

    public function render()
    {
        return view('livewire.content.pages-permohonan-form');
    }
}