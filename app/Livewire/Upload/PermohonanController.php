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
use App\Models\KategoriOpd;
use App\Models\Opd;
use App\Models\OpdChild;

#[Layout('layouts.sidebar_layout_livewire')]
#[Title('Form Data Permohonan')]
class PermohonanController extends Component
{
    public $currentStep = 1;

    public $permohonan_id = null;
    public $isEditMode = false;

    public $layanan_id;
    public $nama_layanan_terpilih;
    public $isPenelitian = false;
    public $judul, $jenjang_pendidikan, $bidang_penelitian, $rumpun_penelitian;
    public $nama_instansi, $alamat_instansi;
    public $tgl_mulai, $tgl_selesai;
    public $kategori_id, $opd_id, $opd_child_id;
    public $daftar_kategori = [];
    public $daftar_opd = [];
    public $daftar_child = [];
    public $jenis_pengajuan = '';
    public $pembimbing = [];
    public $anggota = [];
    public $link_pengantar_kampus, $link_proposal;

    public function mount($layanan_slug = null, $id = null)
    {
        $pemohon = Auth::user()->pemohon;

        if (!$pemohon || $pemohon->status_verifikasi !== 'terverifikasi') {
            session()->flash('error', 'Akses Ditolak! Identitas Anda harus diverifikasi oleh BRIDA.');
            return redirect()->route('permohonan');
        }

        $this->daftar_kategori = KategoriOpd::all();

        if ($id) {
            $this->isEditMode = true;
            $permohonan = Permohonan::with(['layanan', 'pembimbing', 'anggota'])->findOrFail($id);
            $sedangRevisi = ($permohonan->status_brida === 'revisi' || $permohonan->status_kesbangpol === 'revisi');

            if ($permohonan->pemohon_id !== $pemohon->id || !$sedangRevisi) {
                session()->flash('error', 'Akses Ilegal! Data tidak dalam masa revisi atau bukan milik Anda.');
                return redirect()->route('permohonan');
            }

            $this->permohonan_id = $permohonan->id;
            $this->layanan_id = $permohonan->layanan_id;
            $this->nama_layanan_terpilih = $permohonan->layanan->nama_layanan;
            $this->isPenelitian = $permohonan->layanan->slug_layanan === 'izin-penelitian';

            // Suntik data lama
            $this->judul = $permohonan->judul;
            $this->tgl_mulai = $permohonan->tgl_mulai;
            $this->tgl_selesai = $permohonan->tgl_selesai;
            $this->jenjang_pendidikan = $permohonan->jenjang_pendidikan;
            $this->bidang_penelitian = $permohonan->bidang_penelitian;
            $this->rumpun_penelitian = $permohonan->rumpun_penelitian;
            $this->jenis_pengajuan = $permohonan->jenis_pengajuan;
            $this->nama_instansi = $permohonan->nama_instansi;
            $this->alamat_instansi = $permohonan->alamat_instansi;
            $this->link_pengantar_kampus = $permohonan->link_pengantar_kampus;
            $this->link_proposal = $permohonan->link_proposal;

            // NAPAK TILAS OPD UNTUK MEMUNCULKAN DROPDOWN
            $this->opd_child_id = $permohonan->id_opd_child;
            $child = OpdChild::find($permohonan->id_opd_child);
            if ($child) {
                $this->kategori_id = $child->id_kategori;
                $this->opd_id = $child->id_opd;

                // Isi kembali array dropdown agar opsi-opsinya muncul di Blade
                $this->daftar_opd = Opd::where('id_kategori', $this->kategori_id)->get();
                $this->daftar_child = OpdChild::where('id_opd', $this->opd_id)->get();
            }

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

    public function updatedKategoriId($value)
    {
        $this->daftar_opd = Opd::where('id_kategori', $value)->get();
        $this->opd_id = null;
        $this->opd_child_id = null;
        $this->daftar_child = [];
    }

    public function updatedOpdId($value)
    {
        $this->daftar_child = OpdChild::where('id_opd', $value)->get();
        $this->opd_child_id = null;
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
        if ($value === 'personal') {
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
            'bidang_penelitian.required' => 'Bidang penelitian wajib diisi.',
            'rumpun_penelitian.required' => 'Rumpun penelitian wajib diisi.',
            'nama_instansi.required' => 'Nama instansi atau universitas asal wajib diisi.',
            'alamat_instansi.required' => 'Alamat instansi asal wajib diisi.',

            'kategori_id.required' => 'Kategori instansi wajib diisi.',
            'opd_id.required' => 'Instansi wajib diisi.',
            'opd_child_id.required' => 'Lokasi wajib diisi.',
            'tgl_mulai.required' => 'Tanggal mulai kegiatan wajib diisi.',
            'tgl_mulai.after_or_equal' => 'Tanggal mulai tidak boleh lewat dari hari ini.',
            'tgl_selesai.required' => 'Tanggal selesai kegiatan wajib diisi.',
            'tgl_selesai.after_or_equal' => 'Tanggal selesai tidak boleh lebih awal dari tanggal mulai.',

            'jenis_pengajuan.required' => 'Jenis pengajuan wajib diisi.',
            'jenis_pengajuan.in' => 'Jenis pengajuan tidak valid.',

            'pembimbing.*.nama_pembimbing.required' => 'Nama pembimbing tidak boleh kosong.',
            'anggota.required' => 'Daftar anggota tidak boleh kosong untuk pengajuan kelompok.',
            'anggota.min' => 'Minimal harus ada 1 anggota tambahan dalam kelompok.',
            'anggota.*.nama_anggota.required' => 'Nama anggota tidak boleh kosong.',
            'anggota.*.nik.required' => 'NIK anggota tidak boleh kosong.',
            'anggota.*.nik.min' => 'NIK anggota minimal 14 karakter.',
            'anggota.*.nik.max' => 'NIK anggota maksimal 18 karakter.',
            'anggota.*.nik.distinct' => 'Terdapat NIK yang ganda',
            'anggota.*.nik.not_in' => 'NIK anggota tidak boleh sama dengan NIK pengusul.',

            'link_pengantar_kampus.required' => 'Link Google Drive wajib diisi.',
            'link_pengantar_kampus.regex' => 'Link harus berasal dari Google Drive (drive.google.com).',
            'link_proposal.required' => 'Link Google Drive proposal wajib diisi.',
            'link_proposal.regex' => 'Link harus berasal dari Google Drive (drive.google.com).',
        ];
    }

    public function validateStep()
    {
        if ($this->currentStep == 1) {
            $this->validate([
                'judul' => 'required|string|max:255',
                'jenjang_pendidikan' => 'required|string|in:SMA,D3,D4,S1,S2,S3',
                'bidang_penelitian' => 'required|string|in:Ekonomi,Sosial,Pemerintahan,Kependudukan,Pembangunan,Kesehatan,Lingkungan Hidup,Budaya,Politik',
                'rumpun_penelitian' => 'required|string|in:Ekonomi,Sosial,Budaya,Hukum,Kesehatan,Pemerintah dan Politik,Pendidikan,Lingkungan Hidup,Teknik dan Pembangunan,Agama,Kependudukan,Ketenagakerjaan,Digital dan Teknologi,Transportasi dan Perhubungan,Lainnya',
                'nama_instansi' => 'required|string',
                'alamat_instansi' => 'required|string',
            ]);
        } elseif ($this->currentStep == 2) {
            $rules = [
                'kategori_id' => 'required',
                'opd_id' => 'required',
                'opd_child_id' => 'required',
                'tgl_mulai' => 'required|date|after_or_equal:today',
                'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
                'jenis_pengajuan' => 'required|in:personal,kelompok',
                'pembimbing.*.nama_pembimbing' => 'required|string',
            ];

            if ($this->jenis_pengajuan === 'kelompok') {
                $pemohon = Auth::user()->pemohon;
                $nikKetua = $pemohon ? $pemohon->nomor_identitas : '';

                $rules['anggota'] = 'required|array|min:1';
                $rules['anggota.*.nama_anggota'] = 'required|string';
                $rules['anggota.*.nik'] = 'required|string|min:14|max:18|distinct|not_in:' . $nikKetua;
            }
            $this->validate($rules);
        }
    }

    public function submitForm()
    {
        $rules = [
            'link_pengantar_kampus' => ['required', 'url', 'regex:/drive\.google\.com/']
        ];
        if ($this->isPenelitian) {
            $rules['link_proposal'] = ['required', 'url', 'regex:/drive\.google\.com/'];
        }
        $this->validate($rules);

        $pemohon = Auth::user()->pemohon;
        if (!$pemohon || $pemohon->status_verifikasi !== 'terverifikasi') {
            return abort(403, 'Akses Ilegal: Identitas Anda belum terverifikasi oleh BRIDA.');
        }

        DB::transaction(function () use ($pemohon) {

            if ($this->isEditMode) {
                // Ambil data permohonan lama
                $permohonan = Permohonan::findOrFail($this->permohonan_id);

                // Hanya reset ke pending jika status sebelumnya adalah revisi
                $statusBridaBaru = ($permohonan->status_brida === 'revisi') ? 'pending' : $permohonan->status_brida;
                $statusKesbangpolBaru = ($permohonan->status_kesbangpol === 'revisi') ? 'pending' : $permohonan->status_kesbangpol;

                $dataPermohonan = [
                    'pemohon_id' => $pemohon->id,
                    'layanan_id' => $this->layanan_id,
                    'judul' => $this->judul,
                    'id_opd_child' => $this->opd_child_id,
                    'tgl_mulai' => $this->tgl_mulai,
                    'tgl_selesai' => $this->tgl_selesai,
                    'jenjang_pendidikan' => $this->jenjang_pendidikan,
                    'bidang_penelitian' => $this->bidang_penelitian,
                    'rumpun_penelitian' => $this->rumpun_penelitian,
                    'jenis_pengajuan' => $this->jenis_pengajuan,
                    'jumlah_anggota' => count($this->anggota) + 1,
                    'nama_instansi' => $this->nama_instansi,
                    'alamat_instansi' => $this->alamat_instansi,
                    'link_pengantar_kampus' => $this->link_pengantar_kampus,
                    'link_proposal' => $this->link_proposal,
                    'status_permohonan' => 'proses_verifikasi',
                    'status_kesbangpol' => $statusKesbangpolBaru, // Aman jika sudah disetujui sebelumnya
                    'status_brida' => $statusBridaBaru,         // Aman jika sudah disetujui sebelumnya
                ];

                $permohonan->update($dataPermohonan);
                $permohonan->pembimbing()->delete();
                $permohonan->anggota()->delete();

            } else {
                // Jika pengajuan baru
                $dataPermohonan = [
                    'pemohon_id' => $pemohon->id,
                    'layanan_id' => $this->layanan_id,
                    'judul' => $this->judul,
                    'id_opd_child' => $this->opd_child_id,
                    'tgl_mulai' => $this->tgl_mulai,
                    'tgl_selesai' => $this->tgl_selesai,
                    'jenjang_pendidikan' => $this->jenjang_pendidikan,
                    'bidang_penelitian' => $this->bidang_penelitian,
                    'rumpun_penelitian' => $this->rumpun_penelitian,
                    'jenis_pengajuan' => $this->jenis_pengajuan,
                    'jumlah_anggota' => count($this->anggota) + 1,
                    'nama_instansi' => $this->nama_instansi,
                    'alamat_instansi' => $this->alamat_instansi,
                    'link_pengantar_kampus' => $this->link_pengantar_kampus,
                    'link_proposal' => $this->link_proposal,
                    'status_permohonan' => 'diajukan',
                    'status_kesbangpol' => 'pending',
                    'status_brida' => 'pending',
                ];

                $permohonan = Permohonan::create($dataPermohonan);
            }

            foreach ($this->pembimbing as $p) {
                if (!empty($p['nama_pembimbing'])) {
                    PembimbingPermohonan::create([
                        'permohonan_id' => $permohonan->id,
                        'nama_pembimbing' => $p['nama_pembimbing']
                    ]);
                }
            }

            if ($this->jenis_pengajuan === 'kelompok') {
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