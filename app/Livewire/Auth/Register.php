<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\Attributes\Layout;

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
      'password' => ['required', 'string', 'min:6'],
    ];
  }

  protected function messages()
  {
    return [
      'email.required' => 'Email wajib diisi.',
      'email.email' => 'Email tidak valid.',
      'email.unique' => 'Email sudah terdaftar.',
      'email.max' => 'Email maksimal 255 karakter.',
      'username.required' => 'Username wajib diisi.',
      'username.string' => 'Username harus berupa teks.',
      'username.min' => 'Username minimal 6 karakter.',
      'username.max' => 'Username maksimal 255 karakter.',
      'username.unique' => 'Username sudah digunakan.',
      'password.required' => 'Password wajib diisi.',
      'password.string' => 'Password harus berupa teks.',
      'password.min' => 'Password minimal 6 karakter.',
    ];
  }

  public function register()
  {
    $this->validate();

    User::create([
      'name' => $this->username,
      'username' => $this->username,
      'email' => $this->email,
      'password' => $this->password,
    ]);

    return redirect()->route('login');
  }

  public function render()
  {
    return view('livewire.auth.register');
  }
}
