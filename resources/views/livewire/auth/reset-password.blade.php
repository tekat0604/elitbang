<div class="landing-login">
  <div class="authentication-wrapper authentication-basic">
    <div class="authentication-inner py-4">
      <div class="card shadow-lg border-0 rounded-4 mx-auto" style="width: 100%; max-width: 420px;">
        <div class="card-body">
          <h4 class="mb-1 text-center">Buat Password Baru</h4>
          <p class="mb-6 text-center">Silakan masukkan password baru Anda</p>

          <form class="mb-4" wire:submit="resetPassword">
            
            <input type="hidden" wire:model="token">
            <input type="hidden" wire:model="email">

            <div class="mb-4 form-password-toggle">
              <label class="form-label" for="password">Password Baru</label>
              <input type="password" class="form-control @error('password') is-invalid @enderror" 
                wire:model="password" placeholder="Minimal 6 karakter" autofocus />
              @error('password') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
            </div>

            <div class="mb-6 form-password-toggle">
              <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
              <input type="password" class="form-control" 
                wire:model="password_confirmation" placeholder="Ulangi password baru" />
            </div>

            <button class="btn btn-primary d-grid w-100" type="submit" wire:loading.attr="disabled">
                <span wire:loading.remove>Simpan Password</span>
                <span wire:loading>Memproses...</span>
            </button>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>