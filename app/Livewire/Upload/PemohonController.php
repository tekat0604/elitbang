<?php

namespace App\Livewire\Upload;

use App\Models\Pemohon;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Title;

#[Layout('layouts.sidebar_layout_livewire')]
#[Title('Form Data Pemohon')]
class PemohonController extends Component
{
    use WithFileUploads;

    public array $provinces = [];
    public array $regencies = [];
    public array $districts = [];
    public array $villages = [];

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
        $this->provinces = $this->loadProvinces();
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

        $this->regencies = $this->loadRegenciesForProvince($this->provinsi);
        $this->districts = $this->loadDistrictsForRegency($this->kota_kabupaten);
        $this->villages = $this->loadVillagesForDistrict($this->kecamatan);

    }

    public function updatedProvinsi(): void
    {
        $this->kota_kabupaten = null;
        $this->kecamatan = null;
        $this->kelurahan_desa = null;
        $this->regencies = $this->loadRegenciesForProvince($this->provinsi);
        $this->districts = [];
        $this->villages = [];
    }

    public function updatedKotaKabupaten(): void
    {
        $this->kecamatan = null;
        $this->kelurahan_desa = null;
        $this->districts = $this->loadDistrictsForRegency($this->kota_kabupaten);
        $this->villages = [];
    }

    public function updatedKecamatan(): void
    {
        $this->kelurahan_desa = null;
        $this->villages = $this->loadVillagesForDistrict($this->kecamatan);
    }

    private function loadProvinces(): array
    {
        $csvPath = database_path('data/provinces.csv');

        if (! is_readable($csvPath) || ($handle = fopen($csvPath, 'r')) === false) {
            return [];
        }

        fgetcsv($handle); // Header: code,name
        $provinces = [];

        while (($row = fgetcsv($handle)) !== false) {
            if (count($row) < 2) {
                continue;
            }

            $provinces[trim($row[0])] = preg_replace('/\s+/', ' ', trim($row[1]));
        }

        fclose($handle);

        return $provinces;
    }

    private function loadRegenciesForProvince(?string $provinceName): array
    {
        $provinceCode = array_search($provinceName, $this->provinces, true);
        $csvPath = database_path('data/regencies.csv');

        if ($provinceCode === false || ! is_readable($csvPath) || ($handle = fopen($csvPath, 'r')) === false) {
            return [];
        }

        $provinceCode = (string) $provinceCode;

        fgetcsv($handle); // Header: kode_kabkota,nama_kabkota,kode_provinsi
        $regencies = [];

        while (($row = fgetcsv($handle)) !== false) {
            if (count($row) < 3 || trim($row[2]) !== $provinceCode) {
                continue;
            }

            $regencies[trim($row[0])] = preg_replace('/\s+/', ' ', trim($row[1]));
        }

        fclose($handle);

        return $regencies;
    }

    private function loadDistrictsForRegency(?string $regencyName): array
    {
        $regencyCode = array_search($regencyName, $this->regencies, true);
        $csvPath = database_path('data/districts.csv');

        if ($regencyCode === false || ! is_readable($csvPath) || ($handle = fopen($csvPath, 'r')) === false) {
            return [];
        }

        $regencyCode = (string) $regencyCode;
        fgetcsv($handle); // Header: kode_kabkota,kode_provinsi,kode_kecamatan,nama_kecamatan
        $districts = [];

        while (($row = fgetcsv($handle)) !== false) {
            if (count($row) < 4 || trim($row[0]) !== $regencyCode) {
                continue;
            }

            $districts[trim($row[2])] = preg_replace('/\s+/', ' ', trim($row[3]));
        }

        fclose($handle);

        return $districts;
    }

    private function loadVillagesForDistrict(?string $districtName): array
    {
        $districtCode = array_search($districtName, $this->districts, true);
        $csvPath = database_path('data/villages.csv');

        if ($districtCode === false || ! is_readable($csvPath) || ($handle = fopen($csvPath, 'r')) === false) {
            return [];
        }

        $districtCode = (string) $districtCode;
        fgetcsv($handle); // Header: kode_kabkota,kode_provinsi,kode_kecamatan,kode_desa_kelurahan,nama_desa_kelurahan
        $villages = [];

        while (($row = fgetcsv($handle)) !== false) {
            if (count($row) < 5 || trim($row[2]) !== $districtCode) {
                continue;
            }

            $villages[trim($row[3])] = preg_replace('/\s+/', ' ', trim($row[4]));
        }

        fclose($handle);

        return $villages;
    }
    protected function rules()
    {
        $pemohon = Auth::user()->pemohon;

        return [
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'jenis_identitas' => ['required', 'string', 'in:ktp,ktm,passport,sim'],
            'nomor_identitas' => ['required', 'string', 'min:7', 'max:16', Rule::unique('pemohon', 'nomor_identitas')->ignore($pemohon?->id)],
            'no_hp' => ['required', 'string', 'regex:/^[0-9]+$/', 'min:10', 'max:13'],
            'email' => ['required', 'email', 'max:255'],
            'kewarganegaraan' => ['required', 'string', 'min:4', 'max:50'],
            'tanggal_lahir' => ['required', 'date', 'before_or_equal:today'],
            'provinsi' => ['required', 'string', 'max:50', Rule::in(array_values($this->provinces))],
            'kota_kabupaten' => ['required', 'string', 'max:50', Rule::in(array_values($this->regencies))],
            'kecamatan' => ['required', 'string', 'max:50', Rule::in(array_values($this->districts))],
            'kelurahan_desa' => ['required', 'string', 'max:50', Rule::in(array_values($this->villages))],
            'alamat' => ['required', 'string', 'max:255'],
            'path_identitas' => ['required', 'image', 'max:1024'], //maksimal 1 mb
        ];
    }

    protected function messages()
    {
        return [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'jenis_identitas.required' => 'Jenis identitas wajib diisi.',
            'jenis_identitas.in' => 'Jenis identitas tidak valid.',
            'nomor_identitas.required' => 'Nomor identitas wajib diisi.',
            'nomor_identitas.min' => 'Nomor identitas minimal 7 karakter',
            'nomor_identitas.max' => 'Nomor identitas maksimal 16 karakter',
            'nomor_identitas.unique' => 'Nomor identitas sudah terdaftar.',
            'no_hp.required' => 'Nomor handphone wajib diisi.',
            'no_hp.regex' => 'Nomor handphone hanya boleh berisi angka.',
            'no_hp.min' => 'Nomor handphone minimal 10 digit',
            'no_hp.max' => 'Nomor handphone maksimal 13 digit',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email salah.',
            'email.max' => 'Email maksimal 255 karakter',
            'kewarganegaraan.required' => 'Kewarganegaraan wajib diisi.',
            'kewarganegaraan.min' => 'Kewarganegaraan minimal 4 karakter',
            'kewarganegaraan.max' => 'Kewarganegaraan maksimal 50 karakter',
            'tanggal_lahir.required' => 'tanggal lahir wajib diisi.',
            'tanggal_lahir.date' => 'Format tanggal lahir salah.',
            'tanggal_lahir.before_or_equal' => 'Tanggal lahir tidak dapat melebihi hari ini.',
            'provinsi.required' => 'Provinsi wajib diisi.',
            'provinsi.max' => 'provinsi maksimal 50 karakter',
            'provinsi.in' => 'Provinsi yang dipilih tidak valid.',
            'kota_kabupaten.required' => 'Kota atau Kabupaten wajib diisi.',
            'kota_kabupaten.max' => 'Kota atau Kabupaten maksimal 50 karakter',
            'kota_kabupaten.in' => 'Kabupaten atau kota yang dipilih tidak valid.',
            'kecamatan.required' => 'Kecamatan wajib diisi.',
            'kecamatan.max' => 'Kecamatan maksimal 50 karakter',
            'kecamatan.in' => 'Kecamatan yang dipilih tidak valid.',
            'kelurahan_desa.required' => 'Kelurahan wajib diisi.',
            'kelurahan_desa.max' => 'Kelurahan atau desa maksimal 50 karakter',
            'kelurahan_desa.in' => 'Kelurahan atau desa yang dipilih tidak valid.',
            'alamat.required' => 'Alamat wajib diisi.',
            'alamat.max' => 'Alamat maksimal 255 karakter',
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

            session()->flash('success', 'Data revisi berhasil dikirim ulang ke BRIDA.');
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

            session()->flash('success', 'Data identitas berhasil disimpan dan menunggu verifikasi BRIDA');
        }

        return redirect()->route('identitas');

    }
    public function render()
    {
        return view('livewire.content.pages-pemohon-form');
    }
}
