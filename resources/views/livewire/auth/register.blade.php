@section('vendor-style')
@vite(['resources/assets/vendor/libs/@form-validation/form-validation.scss'])
@endsection

@section('page-style')
@vite(['resources/assets/vendor/scss/pages/page-auth.scss'])
@endsection

@section('vendor-script')
@vite(['resources/assets/vendor/libs/@form-validation/popular.js',
'resources/assets/vendor/libs/@form-validation/bootstrap5.js',
'resources/assets/vendor/libs/@form-validation/auto-focus.js'])
@endsection

@section('page-script')
@vite(['resources/assets/js/pages-auth.js'])
@endsection

<div class="landing-login">
  <div class="authentication-wrapper authentication-basic">
    <div class="authentication-inner py-4">
      <div class="card shadow-lg border-0 rounded-4 mx-auto" style="width: 100%; max-width: 420px;">
        <div class="card-body">
          <div class="app-brand justify-content-center mb-6 text-center">
                <div class="mx-auto" style="max-width: 200px;">
                    <img src="{{ asset('storage/setting/' . config('logo_branding')) }}" alt="logo" class="w-100" data-speed="1" />
                </div>
          </div>
          <p class="mb-6 text-center">Silahkan buat akun untuk mengajukan permohonan</p>

          <form class="mb-4" wire:submit="register">
            <div class="mb-6">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control @error('username') is-invalid @enderror"
                wire:model="username"
                placeholder="Masukan username anda" autofocus />

              @error('username') 
                  <span class="invalid-feedback d-block">{{ $message }}</span> 
              @enderror
            </div>

            <div class="mb-6">
              <label for="email" class="form-label">Email</label>
              <input type="text" class="form-control @error('email') is-invalid @enderror"
                wire:model="email"
                placeholder="Masukan email anda" />

              @error('email') 
                  <span class="invalid-feedback d-block">{{ $message }}</span> 
              @enderror
            </div>

            <div class="mb-6 form-password-toggle">
              <label class="form-label" for="password">Password</label>

              <div class="input-group input-group-merge" x-data="{ show: false }">
                <input x-bind:type="show ? 'text' : 'password'"
                  class="form-control @error('password') is-invalid @enderror"
                  wire:model="password"
                  placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />

                <span class="input-group-text cursor-pointer" @click="show = !show">
                  <i class="icon-base ti" :class="show ? 'tabler-eye' : 'tabler-eye-off'"></i>
                </span>
              </div>

              @error('password') 
                  <span class="invalid-feedback d-block">{{ $message }}</span> 
              @enderror
            </div>

            <div class="mb-4">
              <button class="btn btn-primary d-grid w-100" type="submit" wire:loading.attr="disabled">
                <span wire:loading.remove>Daftar</span>
                <span wire:loading>Processing...</span>
              </button>
            </div>
          </form>

          <div class="text-center">
            <span>Sudah punya akun?</span>
            <a href="{{ route('login') }}"> Login di sini</a>
          </div>
        </div>
      </div>
      <!-- /Register -->
    </div>
  </div>
</div>
