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

<div class="container-xxl landing-login">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner py-6">
      <!-- Login -->
      <div class="card">
        <div class="card-body">
          <!-- Logo -->
          <div class="app-brand justify-content-center mb-6">
                <div style="width: 200px;">
                    <img src="{{ asset('storage/setting/' . config('logo_branding')) }}" alt="logo" class="w-100" data-speed="1" />
                </div>
          </div>
          <!-- /Logo -->
          <p class="mb-6 text-center">Silahkan login untuk mengajukan permohonan</p>

          <form id="formAuthentication" class="mb-4" action="{{ url('/') }}" method="GET">
            <div class="mb-6 form-control-validation">
              <label for="email" class="form-label">Email or Username</label>
              <input type="text" class="form-control" id="email" name="email-username"
                placeholder="Enter your email or username" autofocus />
            </div>
            <div class="mb-6 form-password-toggle form-control-validation">
              <label class="form-label" for="password">Password</label>
              <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" name="password"
                  placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                  aria-describedby="password" />
                <span class="input-group-text cursor-pointer"><i class="icon-base ti tabler-eye-off"></i></span>
              </div>
            </div>
            <div class="my-8">
              <div class="d-flex justify-content-end">
                <a href="{{ url('auth/forgot-password-basic') }}">
                  <p class="mb-0">Lupa Password?</p>
                </a>
              </div>
            </div>
            <div class="mb-6">
              <button class="btn btn-primary d-grid w-100" type="submit">Login</button>
            </div>
          </form>

        

         <hr>
  <p class="text-center">
            <span>Anda bisa Login cepat menggunakan platform dibawah ini</span>
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
