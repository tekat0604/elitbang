<!doctype html>
@php
use Illuminate\Support\Str;
use App\Helpers\Helpers;

$configData = $configData ?? Helpers::appClasses();

$menuFixed =
$configData['layout'] === 'vertical'
? $menuFixed ?? ''
: ($configData['layout'] === 'front'
? ''
: $configData['headerType']);
$navbarType =
$configData['layout'] === 'vertical'
? $configData['navbarType']
: ($configData['layout'] === 'front'
? 'layout-navbar-fixed'
: '');
$isFront = ($isFront ?? '') == true ? 'Front' : '';
$contentLayout = isset($container) ? ($container === 'container-xxl' ? 'layout-compact' : 'layout-wide') : '';

// Get skin name from configData - only applies to admin layouts
$isAdminLayout = !Str::contains($configData['layout'] ?? '', 'front');
$skinName = $isAdminLayout ? $configData['skinName'] ?? 'default' : 'default';

// Get semiDark value from configData - only applies to admin layouts
$semiDarkEnabled = $isAdminLayout && filter_var($configData['semiDark'] ?? false, FILTER_VALIDATE_BOOLEAN);
// set color dari database
$themeCSS = \App\Helpers\Helpers::generateThemeColorsCSS();
@endphp


<html lang="{{ session()->get('locale') ?? app()->getLocale() }}"
class="{{ $navbarType ?? '' }} {{ $contentLayout ?? '' }} {{ $menuFixed ?? '' }} {{ $menuCollapsed ?? '' }} {{ $footerFixed ?? '' }} {{ $customizerHidden ?? '' }}"
dir="{{ $configData['textDirection'] }}" data-skin="{{ $skinName }}" data-assets-path="{{ asset('/assets') . '/' }}"
data-base-url="{{ url('/') }}" data-framework="laravel" data-template="{{ $configData['layout'] }}-menu-template"
data-bs-theme="{{ $configData['theme'] }}" @if ($isAdminLayout && $semiDarkEnabled) data-semidark-menu="true" @endif>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>E-Litbang</title>
    <meta content="" name="perizinan penelitian Kota Surakarta">
    <meta content="" name="perizinan penelitian Kota Surakarta">

    <!-- Favicon -->
    <link href="{{ asset('displayFileFe/' . config('logo_nav')) }}" rel="icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @include('layouts/sections/stylesFront')
    <style>
    {!! $themeCSS !!}
    </style>
    <!-- Include Scripts for customizer, helper, analytics, config -->
    <!-- js -->
    @include('layouts/sections/scriptsIncludesFront')
    @livewireStyles
    @stack('style')
</head>

<body>

  @hasSection('content')
      @yield('content')
  @else
      @if(isset($slot))
          {{ $slot }}
      @endif
  @endif
  @include('layouts/sections/scriptsFront' . $isFront)
  @livewireScripts
  @stack('script')

  @isset($scripts)
  {{ $scripts }}
  @endisset

  <script>
      document.addEventListener('DOMContentLoaded', function () {
          window.addEventListener('ErrorEvent', function(event) {
              Swal.fire({
                  icon: 'error',
                  title: 'Proses Gagal',
                  text: event.detail.message,
                  showClass: {
                      popup: 'animate__animated animate__tada'
                  },
                  customClass: {
                      confirmButton: 'btn btn-primary waves-effect waves-light'
                  },
                  buttonsStyling: false,
                  showConfirmButton: false,
                  allowOutsideClick: false,
                  timer: 2000
              });
          });

          window.addEventListener('SuccessEvent', function(event) {
              Swal.fire({
                  icon: 'success',
                  title: 'Proses Berhasil',
                  text: event.detail.message,
                  showClass: {
                      popup: 'animate__animated animate__tada'
                  },
                  customClass: {
                      confirmButton: 'btn btn-primary waves-effect waves-light'
                  },
                  buttonsStyling: false,
                  showConfirmButton: false,
                  allowOutsideClick: false,
                  timer: 2000
              });
          });
      });
  </script>

</body>
</html>