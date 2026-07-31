<?php

namespace App\Livewire\SuperAdmin;

use App\Models\User;
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
    public $user_id, $name, $email, $role, $instansi, $password;
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
        'role.string' => 'Role harus berupa string.',
        'role.enum' => 'Role tidak valid.',
        'instansi.string' => 'Instansi harus berupa string.',
        'password.required' => 'Password wajib diisi.',
        'password.min' => 'Password minimal 8 karakter.',
        'password.regex' => 'Password harus mengandung huruf besar, angka, dan karakter khusus.',
    ];

    public function mount()
    {
        $user = Auth::user();

        // Pengecekan role super_admin tetap dipertahankan
        if ($user->role !== 'super_admin') {
            abort(403, 'Akses ditolak! Halaman ini khusus untuk super admin.');
        }
    }
    public function updated($property)
    {
        if (in_array($property, ['searchNama', 'searchEmail', 'searchRole', 'searchInstansi'])) {
            $this->resetPage();
        }
    }

    public function render()
    {
        // Membangun query dengan kondisi filter
        $query = User::query();

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

        return view('livewire.super-admin.akun-manual', compact('users'));
    }

    public function resetFields()
    {
        $this->reset(['user_id', 'name', 'email', 'role', 'instansi', 'password']);
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
            'role' => 'required|string|enum:user,admin,verifikator,tanda_tangan,super_admin',
            'instansi' => 'nullable|string',
            'password' => ['required', 'min:8', 'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/'],
        ];

        $this->validate($rules);

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'instansi' => $this->instansi,
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

        $this->isEditMode = true;
        $this->isModalOpen = true;
    }

    public function update()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->user_id,
            'role' => 'required|string',
            'instansi' => 'nullable|string',
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
            'instansi' => $this->instansi,
        ]);

        // Update password hanya jika kolom password diisi
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