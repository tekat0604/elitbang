@section('title', 'Lupa Password')

@section('vendor-style')
@vite(['resources/assets/vendor/libs/@form-validation/form-validation.scss'])
@endsection

@section('page-style')
@vite(['resources/assets/vendor/scss/pages/page-auth.scss'])
@endsection

<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner py-6">
      <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body">
          
          <div class="app-brand justify-content-center mb-6 text-center">
            <div class="mx-auto" style="max-width: 200px;">
              <img src="{{ asset('storage/setting/' . config('logo_branding')) }}" alt="logo" class="w-100" />
            </div>
          </div>
          <h4 class="mb-1 text-center">Lupa Password?</h4>
          <p class="mb-6 text-center">Masukkan email Anda dan kami akan mengirimkan instruksi untuk mereset password</p>

          @if($statusMessage)
            <div class="alert alert-success alert-dismissible" role="alert">
              {{ $statusMessage }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif

          <form id="formAuthentication" class="mb-6" wire:submit="sendResetLink">
            
            <div class="mb-6 form-control-validation">
              <label for="email" class="form-label">Email</label>
              
              <input type="text" 
                class="form-control @error('email') is-invalid @enderror" 
                id="email" 
                wire:model="email" 
                placeholder="Masukkan email Anda"
                autofocus />
              
              @error('email') 
                  <span class="invalid-feedback d-block">{{ $message }}</span> 
              @enderror
            </div>
            
            <button class="btn btn-primary d-grid w-100" type="submit" wire:loading.attr="disabled">
              <span wire:loading.remove>Kirim Tautan Reset</span>
              <span wire:loading>Memproses...</span>
            </button>

          </form>

          <div class="text-center">
            <a href="{{ route('login') }}" class="d-flex align-items-center justify-content-center">
              <i class="icon-base ti tabler-chevron-left scaleX-n1-rtl me-1_5"></i>
              Kembali ke Halaman Login
            </a>
          </div>

        </div>
      </div>
      </div>
  </div>
</div>