<!DOCTYPE html>
@php
  use Illuminate\Support\Str;
  use App\Helpers\Helpers;
  $configData = $configData ?? Helpers::appClasses();
  $themeCSS = \App\Helpers\Helpers::generateThemeColorsCSS();
  $isFront = true;

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

  // Generate primary color CSS if color is set
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
    <title>{{ config('title_nav') }}</title>
    <meta content="" name="{{ config('akronim') }}">
    <meta content="" name="{{ config('deskripsi') }}">

    <!-- Favicon -->
    <link href="{{ asset('displayFileFe/' . config('logo_nav')) }}" rel="icon">

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
@livewire('fe.part.header.menu.menu')
    @yield('content')
    @if(isset($slot))
        {{ $slot }}
    @endif
@livewire('fe.part.footer.footer')


  <!-- Include Scripts -->
  <!-- $isFront is used to append the front layout scripts only on the front layout otherwise the variable will be blank -->
  @include('layouts/sections/scripts' . $isFront)
</body>

</html>