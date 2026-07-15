@section('title', 'Reset Password')

@section('vendor-style')
@vite(['resources/assets/vendor/libs/@form-validation/form-validation.scss'])
@endsection

@section('page-style')
@vite(['resources/assets/vendor/scss/pages/page-auth.scss'])
@endsection

<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner py-6">
      <!-- Reset Password Card -->
      <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body">
          
          <!-- Logo Dinamis Aplikasi -->
          <div class="app-brand justify-content-center mb-6 text-center">
            <div class="mx-auto" style="max-width: 200px;">
              <img src="{{ asset('storage/setting/' . config('logo_branding')) }}" alt="logo" class="w-100" />
            </div>
          </div>
          <!-- /Logo -->

          <h4 class="mb-1 text-center">Buat Password Baru</h4>
          <p class="mb-6 text-center">Silakan masukkan password baru Anda</p>

          <!-- Alert Pesan Error Global -->
          @error('email')
            <div class="alert alert-danger alert-dismissible" role="alert">
              {{ $message }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @enderror

          <!-- Form Livewire -->
          <form class="mb-6" wire:submit="resetPassword">
            
            <!-- Hidden Input Token & Email dari Controller -->
            <input type="hidden" wire:model="token">
            <input type="hidden" wire:model="email">

            <!-- Input Password Baru -->
            <div class="mb-6 form-password-toggle">
              <label class="form-label" for="password">Password Baru</label>
              
              <div class="input-group input-group-merge" x-data="{ show: false }">
                <input x-bind:type="show ? 'text' : 'password'" 
                  class="form-control @error('password') is-invalid @enderror" 
                  id="password"
                  wire:model="password" 
                  placeholder="Minimal 6 karakter" 
                  autofocus />
                
                <!-- Ikon Mata -->
                <span class="input-group-text cursor-pointer" @click="show = !show">
                  <i class="icon-base ti" :class="show ? 'tabler-eye' : 'tabler-eye-off'"></i>
                </span>
              </div>
              
              @error('password') 
                <span class="invalid-feedback d-block">{{ $message }}</span> 
              @enderror
            </div>

            <!-- Input Konfirmasi Password -->
            <div class="mb-6 form-password-toggle">
              <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
              
              <div class="input-group input-group-merge" x-data="{ show2: false }">
                <input x-bind:type="show2 ? 'text' : 'password'" 
                  class="form-control" 
                  id="password_confirmation"
                  wire:model="password_confirmation" 
                  placeholder="Ulangi password baru" />
                
                <!-- Ikon Mata -->
                <span class="input-group-text cursor-pointer" @click="show2 = !show2">
                  <i class="icon-base ti" :class="show2 ? 'tabler-eye' : 'tabler-eye-off'"></i>
                </span>
              </div>
            </div>

            <!-- Tombol Submit -->
            <button class="btn btn-primary d-grid w-100" type="submit" wire:loading.attr="disabled">
                <span wire:loading.remove>Simpan Password Baru</span>
                <span wire:loading>Memproses...</span>
            </button>
          </form>

          <!-- Tombol Kembali -->
          <div class="text-center">
            <a href="{{ route('login') }}" class="d-flex align-items-center justify-content-center">
              <i class="icon-base ti tabler-chevron-left scaleX-n1-rtl me-1_5"></i>
              Batal & Kembali ke Login
            </a>
          </div>

        </div>
      </div>
      <!-- /Reset Password Card -->
    </div>
  </div>
</div>