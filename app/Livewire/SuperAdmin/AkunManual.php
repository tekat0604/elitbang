<?php

namespace App\Livewire\SuperAdmin;

use App\Models\User;
use App\Models\Opd;
use App\Models\OpdChild;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.sidebar_layout_livewire')]
#[Title('Data Pengguna')]
class AkunManual extends Component
{
    use WithPagination;

    // Variabel Form Modal
    public $user_id, $name, $email, $role, $instansi, $password, $id_opd, $id_opd_child;
    public $isModalOpen = false;
    public $isEditMode = false;

    // Variabel Filter/Pencarian Kolom
    public $searchNama = '';
    public $searchEmail = '';
    public $searchRole = '';
    public $searchInstansi = '';

    protected $messages = [
        'name.required' => 'Nama lengkap wajib diisi.',
        'name.string' => 'Nama lengkap harus berupa string.',
        'name.max' => 'Nama lengkap maksimal 255 karakter.',
        'email.required' => 'Email wajib diisi.',
        'email.email' => 'Format email salah.',
        'email.max' => 'Email maksimal 255 karakter.',
        'email.unique' => 'Email sudah terdaftar.',
        'email.regex' => 'Email tidak boleh mengandung karakter khusus.',
        'role.required' => 'Role wajib diisi.',
        'role.in' => 'Role tidak valid.',
        'password.required' => 'Password wajib diisi.',
        'password.min' => 'Password minimal 8 karakter.',
        'password.regex' => 'Password harus mengandung huruf besar, angka, dan karakter khusus.',
    ];

    public function mount()
    {
        $user = Auth::user();

        if ($user->role !== 'super_admin') {
            abort(403, 'Akses ditolak! Halaman ini khusus untuk super admin.');
        }
    }

    public function updated($property)
    {
        if (in_array($property, ['searchNama', 'searchEmail', 'searchRole', 'searchInstansi'])) {
            $this->resetPage();
        }

        // Reset pilihan instansi/OPD jika role diubah di form
        if ($property === 'role') {
            $this->instansi = null;
            $this->id_opd = null;
            $this->id_opd_child = null;
        }
    }

    public function render()
    {
        // Membangun query dengan kondisi filter dan memuat relasi
        $query = User::with(['opd', 'opdChild']);

        if (!empty($this->searchNama)) {
            $query->where('name', 'like', '%' . $this->searchNama . '%');
        }

        if (!empty($this->searchEmail)) {
            $query->where('email', 'like', '%' . $this->searchEmail . '%');
        }

        if (!empty($this->searchRole)) {
            $query->where('role', $this->searchRole);
        }

        if (!empty($this->searchInstansi)) {
            $query->where('instansi', $this->searchInstansi);
        }

        $users = $query->latest()->paginate(10);

        // Mengambil data master OPD dan UPTD untuk dropdown di modal form
        $opds = Opd::orderBy('nama_opd', 'asc')->get();
        $opdChildren = OpdChild::orderBy('nama', 'asc')->get();

        return view('livewire.super-admin.akun-manual', compact('users', 'opds', 'opdChildren'));
    }

    public function resetFields()
    {
        $this->reset(['user_id', 'name', 'email', 'role', 'instansi', 'id_opd', 'id_opd_child', 'password']);
        $this->isEditMode = false;
    }

    public function openModal()
    {
        $this->resetFields();
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->resetFields();
    }

    public function store()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email|regex:/^[^<>&]*$/',
            'role' => 'required|string|in:user,admin,verifikator,tanda_tangan,super_admin,opd,uptd',
            'instansi' => 'nullable|string',
            'id_opd' => 'nullable|exists:opd,id',
            'id_opd_child' => 'nullable|exists:opd_child,id',
            'password' => ['required', 'min:8', 'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/'],
        ];

        $this->validate($rules);

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            // Simpan data instansi secara selektif sesuai role yang dipilih
            'instansi' => in_array($this->role, ['verifikator', 'tanda_tangan']) ? $this->instansi : null,
            'id_opd' => $this->role === 'opd' ? $this->id_opd : null,
            'id_opd_child' => $this->role === 'uptd' ? $this->id_opd_child : null,
            'password' => Hash::make($this->password),
        ]);

        session()->flash('message', 'Akun pengguna berhasil dibuat.');
        $this->closeModal();
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        $this->user_id = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
        $this->instansi = $user->instansi;
        $this->id_opd = $user->id_opd;
        $this->id_opd_child = $user->id_opd_child;

        $this->isEditMode = true;
        $this->isModalOpen = true;
    }

    public function update()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->user_id,
            'role' => 'required|string|in:user,admin,verifikator,tanda_tangan,super_admin,opd,uptd',
            'instansi' => 'nullable|string',
            'id_opd' => 'nullable|exists:opd,id',
            'id_opd_child' => 'nullable|exists:opd_child,id',
        ];

        if (!empty($this->password)) {
            $rules['password'] = ['required', 'min:8', 'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/'];
        }

        $this->validate($rules);

        $user = User::findOrFail($this->user_id);

        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'instansi' => in_array($this->role, ['verifikator', 'tanda_tangan']) ? $this->instansi : null,
            'id_opd' => $this->role === 'opd' ? $this->id_opd : null,
            'id_opd_child' => $this->role === 'uptd' ? $this->id_opd_child : null,
        ]);

        if ($this->password) {
            $user->update(['password' => Hash::make($this->password)]);
        }

        session()->flash('message', 'Data pengguna berhasil diperbarui.');
        $this->closeModal();
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();
        session()->flash('message', 'Akun pengguna berhasil dihapus.');
    }
}