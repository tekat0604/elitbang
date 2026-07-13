@extends('layouts.login_layout')

@section('content')
<div class="landing-login">
  <div class="authentication-wrapper authentication-basic">
    <div class="authentication-inner py-4">
      <div class="card shadow-lg border-0 rounded-4 mx-auto" style="width: 100%; max-width: 420px;">
        <div class="card-body text-center">
          <div class="app-brand justify-content-center mb-4 text-center">
            <div class="mx-auto" style="max-width: 200px;">
              <img src="{{ asset('storage/setting/' . config('logo_branding')) }}" alt="logo" class="w-100" />
            </div>
          </div>
          <h4 class="mb-2">Dashboard</h4>
          <p class="mb-4">Selamat datang, {{ auth()->user()->name ?? auth()->user()->username ?? auth()->user()->email }}.</p>

          <div class="mb-4">
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="btn btn-danger d-grid w-100">Logout</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
