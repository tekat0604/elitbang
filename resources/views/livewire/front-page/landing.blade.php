<div>
  <!-- Page Styles -->
  @section('page-style')
    @vite(['resources/assets/vendor/scss/pages/front-page-landing.scss'])
  @endsection
  <!-- Vendor Styles -->
  @section('vendor-style')
    @vite(['resources/assets/vendor/libs/animate-css/animate.scss'])
  @endsection
  <!-- Page Scripts -->
  @section('page-script')
    @vite(['resources/assets/js/front-page-landing.js'])
    @vite(['resources/assets/js/ui-modals.js'])
  @endsection
  <div data-bs-spy="scroll" class="scrollspy-example">
    <!-- Hero: Start -->
    <section id="hero-animation">
      <div id="landingHero" class="section-py landing-hero position-relative hero-gradient h-100">
        <div class="row">
          <div class="col-lg-10 mx-auto row container align-items-center justify-content-center">
            <div class="col-lg-5">
              <div class="hero-text-box position-relative px-lg-5 mb-12 mb-lg-0">
                <h1 class="text-primary display-6 fw-extrabold" style="line-height: 2.5rem">{{ config('title_nav') }}
                </h1>
                <h2 class="hero-sub-title h6 mb-6">
                  {{ config('deskripsi') }}
                </h2>
                <div class="d-flex align-items-center gap-3">
                  <div class="landing-hero-btn d-inline-block position-relative">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#alurPerizinan"
                      class="btn btn-secondary btn-lg">Alur Perizinan</a>
                  </div>
                  <div class="landing-hero-btn d-inline-block position-relative">
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Login Akun</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-7">
              <div class="row g-6">
                @forelse($layanan as $item)
                  <div class="col-xl-4 col-md-6 col-6">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#exLargeModal">
                      <div class="card h-100 layanan-box">
                        <div class="card-body text-center">
                          <div class="bg-primary rounded-pill d-inline-block p-3 text-white"
                            style="height: 75px; width: 75px;">
                            <img src="{{ asset('storage/layanan/' . $item->logo) }}" alt="logo" class="h-100"
                              data-speed="1" />
                          </div>
                          <h6 class="my-3">{{ $item->nama_layanan }}</h6>
                        </div>
                      </div>
                    </a>
                  </div>
                @empty
                  <div class="col-xl-12 col-md-12">
                    <div class="card">
                      <div class="card-body text-center layanan-box rounded-3">
                        <h6 class="my-3">Belum ada data layanan</h6>
                      </div>
                    </div>
                  </div>
                @endforelse
              </div>
            </div>
          </div>
    </section>
  </div>
  <div class="modal fade" id="alurPerizinan" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel4">Alur Perizinan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          @if (isset($alur) && $alur)
            <p class="text-dark">{!! $alur->deskripsi !!}</p>
            <img src="{{ asset('storage/layanan/' . $alur->gambar_alur) }}" alt="alur" class="img-fluid w-100"
              data-speed="1" />
          @else
            <p class="text-dark">Tidak ada alur perizinan yang tersedia.</p>
          @endif
        </div>
        <div class="modal-footer pt-4">
          <a href="{{ route('login') }}" class="btn btn-primary" data-bs-dismiss="modal">Mulai Mendaftar</a>
        </div>
    </div>
  </section>
</div>
<div class="modal fade" id="alurPerizinan" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel4">Alur Perizinan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="text-dark">{!! $alur->deskripsi !!}</p>
        <img src="{{ asset('storage/layanan/' . $alur->gambar_alur) }}" alt="alur" class="img-fluid w-100" data-speed="1" />
      </div>
      <div class="modal-footer pt-4">
        <button type="button" wire:navigate="{{ route('login') }}" class="btn btn-primary" data-bs-dismiss="modal">Mulai Mendaftar</button>
      </div>
    </div>
  </div>
</div>
