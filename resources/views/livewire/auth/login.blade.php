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
      <!-- Login -->
      <div class="card shadow-lg border-0 rounded-4 mx-auto" style="width: 100%; max-width: 420px;">
        <div class="card-body">
          <!-- Logo -->
          <div class="app-brand justify-content-center mb-6 text-center">
                <div class="mx-auto" style="max-width: 200px;">
                    <img src="{{ asset('storage/setting/' . config('logo_branding')) }}" alt="logo" class="w-100" data-speed="1" />
                </div>
          </div>
          <!-- /Logo -->
          <p class="mb-6 text-center">Silahkan login untuk mengajukan permohonan</p>

          @error('login_failed')
            <div class="alert alert-danger alert-dismissible" role="alert">
              {{ $message }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @enderror

          <form class="mb-4" wire:submit="login">
            
            <div class="mb-6">
              <label for="email" class="form-label">Email atau Username</label>
              <input type="text" class="form-control @error('email_username') is-invalid @enderror" 
                wire:model="email_username" 
                placeholder="Masukan email atau username anda" autofocus />
              
              @error('email_username') 
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

            <div class="my-4">
              <div class="d-flex justify-content-end">
                <a href="{{ url('auth/forgot-password-basic') }}">
                  <p class="mb-0">Lupa Password?</p>
                </a>
              </div>
            </div>

            <div class="mb-4">
              <button class="btn btn-primary d-grid w-100" type="submit" wire:loading.attr="disabled">
                <span wire:loading.remove>Login</span>
                <span wire:loading>login</span>
              </button>
            </div>
          </form>

        

         <hr>
  <p class="text-center">
            <span>Atau login disini</span>
          </p>
          <div class="d-flex justify-content-center">
            <button type="button" class="btn rounded btn-facebook waves-effect waves-light w-100"><i class="icon-base ti tabler-brand-google icon-xs me-2"></i> Akun Gmail</button>
          </div>
        </div>
      </div>
      <!-- /Login -->
    </div>
  </div>
</div>
