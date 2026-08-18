<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Auth\Events\Registered;

#[Layout('layouts.login_layout')]
class Register extends Component
{
  public $email = '';
  public $username = '';
  public $password = '';

  protected function rules()
  {
    return [
      'email' => ['required', 'email', 'max:255', 'unique:users,email', 'regex:/^[^<>&]*$/'],
      'username' => ['required', 'string', 'min:6', 'max:255', 'unique:users,username', 'regex:/^[^<>&]*$/'],
      'password' => ['required', 'min:8', 'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/'],
    ];
  }

  protected function messages()
  {
    return [
      'email.required' => 'Email wajib diisi.',
      'email.email' => 'Email tidak valid.',
      'email.unique' => 'Email sudah terdaftar.',
      'email.max' => 'Email maksimal 255 karakter.',
      'email.regex' => 'Email tidak boleh mengandung karakter khusus.',
      'username.required' => 'Username wajib diisi.',
      'username.string' => 'Username harus berupa teks.',
      'username.min' => 'Username minimal 6 karakter.',
      'username.max' => 'Username maksimal 255 karakter.',
      'username.unique' => 'Username sudah digunakan.',
      'password.required' => 'Password wajib diisi.',
      'password.min' => 'Password minimal 8 karakter.',
      'password.regex' => 'Password harus mengandung minimal huruf besar, angka, dan karakter khusus.',
    ];
  }

  public function register()
  {
    $this->validate();

    $user = User::create([
      'name' => $this->username,
      'username' => $this->username,
      'email' => $this->email,
      'password' => $this->password,
    ]);

    event(new Registered($user));

    session()->flash('success', 'Registrasi berhasil! Silakan cek email Anda untuk verifikasi sebelum login.');
    return redirect()->route('login');
  }

  public function render()
  {
    return view('livewire.auth.register');
  }
}
