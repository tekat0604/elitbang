@php
use Illuminate\Support\Facades\Route;
$currentRouteName = Route::currentRouteName();
$activeRoutes = ['front-pages-pricing', 'front-pages-payment', 'front-pages-checkout', 'front-pages-help-center'];
$activeClass = in_array($currentRouteName, $activeRoutes) ? 'active' : '';
@endphp

@section('vendor-script')
@vite(['resources/assets/vendor/js/dropdown-hover.js', 'resources/assets/vendor/js/mega-dropdown.js'])
@endsection

<!-- Navbar: Start -->
<nav class="layout-navbar shadow-none py-3">
    <div class="navbar w-100  d-flex justify-content-center align-items-center">
      <div class="logo_branding py-3">
          <img src="{{ asset('storage/setting/' . config('logo_branding')) }}" alt="logo" class="h-100" data-speed="1" />
      </div>
    </div>
</nav>
<!-- Navbar: End -->