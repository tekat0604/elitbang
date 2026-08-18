<?php

namespace App\Livewire\SuperAdmin;

use App\Models\KategoriOpd;
use App\Models\Opd;
use App\Models\OpdChild;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.sidebar_layout_livewire')]
#[Title('Kelola Instansi - Superadmin')]
class InstansiManager extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    // State Tampilan & Filter
    public $viewMode = 'opd'; // Default tampilan adalah OPD
    public $filterKategori = ''; // Filter tabel OPD
    public $filterOpd = ''; // Filter tabel UPTD

    // State Modal Form
    public $is_edit = false;
    public $edit_id;
    public $nama_instansi;
    public $jenis_instansi = 'opd';
    public $kategori_id;
    public $nama_kategori_baru;
    public $opd_id;

    // Reset pagination ketika filter atau view mode berubah
    public function updatedViewMode()
    {
        $this->resetPage();
        $this->filterKategori = '';
        $this->filterOpd = '';
    }
    public function updatedFilterKategori()
    {
        $this->resetPage();
    }
    public function updatedFilterOpd()
    {
        $this->resetPage();
    }

    protected function rules()
    {
        $rules = [
            'jenis_instansi' => 'required|in:opd,uptd',
            'kategori_id' => 'required_if:jenis_instansi,opd',
            'nama_kategori_baru' => 'required_if:kategori_id,baru|nullable|string|max:255|unique:kategori_opd,kategori',
            'opd_id' => 'required_if:jenis_instansi,uptd',
        ];

        if ($this->jenis_instansi === 'opd') {
            $rules['nama_instansi'] = ['required', 'string', 'max:255', Rule::unique('opd', 'nama_opd')->ignore($this->edit_id)];
        } else {
            $rules['nama_instansi'] = ['required', 'string', 'max:255', Rule::unique('opd_child', 'nama')->ignore($this->edit_id)];
        }

        return $rules;
    }

    protected function messages()
    {
        return [
            'nama_instansi.required' => 'Nama instansi wajib diisi.',
            'nama_instansi.unique' => 'Nama instansi ini sudah terdaftar di sistem.',
            'jenis_instansi.required' => 'Jenis instansi wajib dipilih.',
            'kategori_id.required_if' => 'Kategori wajib dipilih untuk pembuatan OPD.',
            'nama_kategori_baru.required_if' => 'Nama kategori baru wajib diisi.',
            'nama_kategori_baru.unique' => 'Kategori tersebut sudah terdaftar.',
            'opd_id.required_if' => 'OPD Induk wajib dipilih untuk pembuatan UPTD.',
        ];
    }

    public function updatedJenisInstansi()
    {
        $this->resetValidation();
        $this->kategori_id = null;
        $this->opd_id = null;
        $this->nama_kategori_baru = null;
    }

    public function updatedKategoriId($value)
    {
        if ($value !== 'baru') {
            $this->nama_kategori_baru = null;
        }
    }

    // MEMBUKA MODAL TAMBAH BARU
    public function tambahBaru()
    {
        $this->reset(['nama_instansi', 'jenis_instansi', 'kategori_id', 'nama_kategori_baru', 'opd_id', 'edit_id']);
        $this->resetValidation();
        $this->is_edit = false;
        $this->jenis_instansi = $this->viewMode; // Samakan tipe form dengan view saat ini
        $this->dispatch('buka-modal-instansi');
    }

    // MEMBUKA MODAL EDIT OPD
    public function editOpd($id)
    {
        $this->resetValidation();
        $opd = Opd::findOrFail($id);
        $this->is_edit = true;
        $this->edit_id = $opd->id;
        $this->jenis_instansi = 'opd';
        $this->nama_instansi = $opd->nama_opd;
        $this->kategori_id = $opd->id_kategori;
        $this->dispatch('buka-modal-instansi');
    }

    // MEMBUKA MODAL EDIT UPTD
    public function editUptd($id)
    {
        $this->resetValidation();
        $uptd = OpdChild::findOrFail($id);
        $this->is_edit = true;
        $this->edit_id = $uptd->id;
        $this->jenis_instansi = 'uptd';
        $this->nama_instansi = $uptd->nama;
        $this->opd_id = $uptd->id_opd;
        $this->dispatch('buka-modal-instansi');
    }

    // FUNGSI SIMPAN DAN UPDATE TERPADU
    public function simpanInstansi()
    {
        $this->validate();
        $namaFormatSeragam = str($this->nama_instansi)->title();

        if ($this->jenis_instansi === 'opd') {
            $idKategoriFinal = $this->kategori_id;

            if ($this->kategori_id === 'baru') {
                $kategoriBaru = KategoriOpd::create(['kategori' => str($this->nama_kategori_baru)->title()]);
                $idKategoriFinal = $kategoriBaru->id;
            }

            if ($this->is_edit) {
                Opd::find($this->edit_id)->update(['nama_opd' => $namaFormatSeragam, 'id_kategori' => $idKategoriFinal]);
            } else {
                Opd::create(['nama_opd' => $namaFormatSeragam, 'id_kategori' => $idKategoriFinal]);
            }
        } else {
            $opdInduk = Opd::find($this->opd_id);
            if ($this->is_edit) {
                OpdChild::find($this->edit_id)->update([
                    'nama' => $namaFormatSeragam,
                    'id_opd' => $this->opd_id,
                    'id_kategori' => $opdInduk ? $opdInduk->id_kategori : null
                ]);
            } else {
                OpdChild::create([
                    'nama' => $namaFormatSeragam,
                    'id_opd' => $this->opd_id,
                    'id_kategori' => $opdInduk ? $opdInduk->id_kategori : null
                ]);
            }
        }

        $this->dispatch('tutup-modal-instansi');
        session()->flash('success', $this->is_edit ? 'Data instansi berhasil diperbarui.' : 'Data instansi berhasil ditambahkan.');
    }

    // FUNGSI HAPUS OPD
    public function hapusOpd($id)
    {
        $opd = Opd::find($id);
        if ($opd) {
            $opd->children()->delete(); // Hapus paksa semua UPTD anaknya
            $opd->delete(); // Hapus OPD Induknya
            session()->flash('success', 'Data OPD beserta seluruh UPTD yang bernaung di bawahnya telah dihapus.');
        }
    }

    // FUNGSI HAPUS UPTD
    public function hapusUptd($id)
    {
        $uptd = OpdChild::find($id);
        if ($uptd) {
            $uptd->delete();
            session()->flash('success', 'Data UPTD berhasil dihapus.');
        }
    }

    public function render()
    {
        $kategoriList = KategoriOpd::orderBy('kategori')->get();
        $opdList = Opd::orderBy('nama_opd')->get();

        $daftarOpd = collect();
        $daftarUptd = collect();

        if ($this->viewMode === 'opd') {
            $queryOpd = Opd::with('kategori')->latest();
            if ($this->filterKategori !== '') {
                $queryOpd->where('id_kategori', $this->filterKategori);
            }
            $daftarOpd = $queryOpd->paginate(10);
        } else {
            $queryUptd = OpdChild::with('opd')->latest();
            if ($this->filterOpd !== '') {
                $queryUptd->where('id_opd', $this->filterOpd);
            }
            $daftarUptd = $queryUptd->paginate(10);
        }

        return view('livewire.super-admin.instansi-manager', compact('daftarOpd', 'daftarUptd', 'kategoriList', 'opdList'));
    }
}
