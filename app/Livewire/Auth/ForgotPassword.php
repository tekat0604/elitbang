<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Password;

#[Layout('layouts.login_layout')]
class ForgotPassword extends Component
{
    public $email = '';
    public $statusMessage = '';

    protected function rules()
    {
        return [
            'email' => ['required', 'email', 'max:255', 'regex:/^[^<>&]*$/'],
        ];
    }

    protected function messages()
    {
        return [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Email tidak valid.',
        ];
    }

    public function sendResetLink()
    {
        $this->validate();

        $status = Password::broker()->sendResetLink(['email' => $this->email]);

        if ($status === Password::RESET_LINK_SENT) {
            $this->email = '';
            $this->statusMessage = 'Silakan cek email anda';

        } else {
            $this->addError('email', 'Email tidak ditemukan');
        }

    }
    public function render()
    {
        return view('livewire.auth.forgot-password');
    }
}
