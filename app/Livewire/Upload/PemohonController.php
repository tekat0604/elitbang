<?php

namespace App\Livewire\Upload;

use App\Models\Pemohon;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.login_layout')]
class PemohonController extends Component
{
    use WithFileUploads;
    public $nama_lengkap;
    public $jenis_identitas;
    public $nomor_identitas;
    public $no_hp;
    public $email;
    public $kewarganegaraan;
    public $tanggal_lahir;
    public $provinsi;
    public $kota_kabupaten;
    public $kecamatan;
    public $kelurahan_desa;
    public $alamat;
    public $path_identitas;

    public function mount()
    {
        $pemohon = Auth::user()->pemohon;

        if ($pemohon) {
            if (in_array($pemohon->status_verifikasi, ['pending', 'terverifikasi'])) {
                return redirect()->route('identitas')->with('info', 'Data Anda tidak dapat diubah');

            }

            if ($pemohon->status_verifikasi === 'revisi') {
                $this->nama_lengkap = $pemohon->nama_lengkap;
                $this->jenis_identitas = $pemohon->jenis_identitas;
                $this->nomor_identitas = $pemohon->nomor_identitas;
                $this->no_hp = $pemohon->no_hp;
                $this->email = $pemohon->email;
                $this->kewarganegaraan = $pemohon->kewarganegaraan;
                $this->tanggal_lahir = $pemohon->tanggal_lahir;
                $this->provinsi = $pemohon->provinsi;
                $this->kota_kabupaten = $pemohon->kota_kabupaten;
                $this->kecamatan = $pemohon->kecamatan;
                $this->kelurahan_desa = $pemohon->kelurahan_desa;
                $this->alamat = $pemohon->alamat;
            }
        } else {
            $this->email = Auth::user()->email;
            $this->nama_lengkap = Auth::user()->name;
        }


    }
    protected function rules()
    {
        return [
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'jenis_identitas' => ['required', 'string', 'in:ktp,ktm,passport,sim'],
            'nomor_identitas' => ['required', 'string', 'unique:pemohon,nomor_identitas'],
            'no_hp' => ['required', 'string'],
            'email' => ['required', 'email', 'max:255'],
            'kewarganegaraan' => ['required', 'string'],
            'tanggal_lahir' => ['required', 'date'],
            'provinsi' => ['required', 'string'],
            'kota_kabupaten' => ['required', 'string'],
            'kecamatan' => ['required', 'string'],
            'kelurahan_desa' => ['required', 'string'],
            'alamat' => ['required', 'string'],
            'path_identitas' => ['required', 'image', 'max:1024'], //maksimal 1 mb
        ];
    }

    protected function messages()
    {
        return [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'jenis_identitas.required' => 'Jenis identitas wajib diisi.',
            'nomor_identitas.required' => 'Nomor identitas wajib diisi.',
            'nomor_identitas.unique' => 'Nomor identitas telah terdaftar dalam sistem',
            'no_hp.required' => 'Nomor handphone wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'kewarganegaraan.required' => 'Kewarganegaraan wajib diisi.',
            'tanggal_lahir.required' => 'tanggal lahir wajib diisi.',
            'provinsi.required' => 'Provinsi wajib diisi.',
            'kota_kabupaten.required' => 'Kota atau Kabupaten wajib diisi.',
            'kecamatan.required' => 'Kecamatan wajib diisi.',
            'kelurahan_desa.required' => 'Kelurahan wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
            'path_identitas.required' => 'File wajib diisi.',
            'path_identitas.image' => 'File harus berupa gambar (JPG/PNG)',
            'path_identitas.max' => 'Ukuran file maksimal 1 MB',

        ];
    }

    public function uploadDokumenDataDiri()
    {
        $this->validate();

        $path = $this->path_identitas->store('identitas', 'public');
        $pemohon = Auth::user()->pemohon;

        if ($pemohon) {
            $pemohon->update([
                'nama_lengkap' => $this->nama_lengkap,
                'jenis_identitas' => $this->jenis_identitas,
                'nomor_identitas' => $this->nomor_identitas,
                'no_hp' => $this->no_hp,
                'email' => $this->email,
                'kewarganegaraan' => $this->kewarganegaraan,
                'tanggal_lahir' => $this->tanggal_lahir,
                'provinsi' => $this->provinsi,
                'kota_kabupaten' => $this->kota_kabupaten,
                'kecamatan' => $this->kecamatan,
                'kelurahan_desa' => $this->kelurahan_desa,
                'alamat' => $this->alamat,
                'path_identitas' => $path,
                'status_verifikasi' => 'pending',
                'catatan_verifikasi' => null,
            ]);

            session()->flash('success', 'Data revisi berhasil dikirim ulang ke Kesbangpol.');
        } else {
            Pemohon::create([
                'user_id' => Auth::id(),
                'nama_lengkap' => $this->nama_lengkap,
                'jenis_identitas' => $this->jenis_identitas,
                'nomor_identitas' => $this->nomor_identitas,
                'no_hp' => $this->no_hp,
                'email' => $this->email,
                'kewarganegaraan' => $this->kewarganegaraan,
                'tanggal_lahir' => $this->tanggal_lahir,
                'provinsi' => $this->provinsi,
                'kota_kabupaten' => $this->kota_kabupaten,
                'kecamatan' => $this->kecamatan,
                'kelurahan_desa' => $this->kelurahan_desa,
                'alamat' => $this->alamat,
                'path_identitas' => $path,
                'status_verifikasi' => 'pending',
            ]);

            session()->flash('success', 'Data identitas berhasil disimpan dan menunggu verifikasi Kesbangpol');
        }

        return redirect()->route('identitas');

    }
    public function render()
    {
        return view('livewire.content.pages-pemohon-form');
    }
}
