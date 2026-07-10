<?php

namespace App\Livewire\Auth;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.login_layout')]
class Login extends Component
{
    public $email_username = '';
    public $password = '';

    protected function rules()
    {
        return [
            'email_username' => ['required', 'string', 'min:6', 'regex:/^[^<>&]*$/'],
            'password' => ['required', 'string', 'min:6'],
        ];
    }

    protected function messages()
    {
        return [
            'email_username.required' => 'Email atau Username wajib diisi.',
            'email_username.string' => 'Email atau Username harus berupa string.',
            'email_username.min' => 'Email atau Username minimal 6 karakter.',
            'email_username.regex' => 'Format Email tidak valid.',
            'password.required' => 'Password wajib diisi.',
            'password.string' => 'Password harus berupa string.',
            'password.min' => 'Password minimal 6 karakter.',
        ];
    }

    public function login()
    {
        $this->validate();

        $fieldType = filter_var($this->email_username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (Auth::attempt([$fieldType => $this->email_username, 'password' => $this->password])) {
            session()->regenerate();
            return redirect()->intended('/');
        }

        $this->addError('login_failed', 'Email, username, atau password tidak ditemukan.');
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
