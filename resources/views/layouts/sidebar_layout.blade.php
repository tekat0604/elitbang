@extends('layouts.login_layout')

@section('page-style')
  <style>
    
    .sidebar-wrapper {
      display: flex; 
    }

    :root {
      --sidebar-width: 280px;
    }

    @media (min-width: 768px) {
      .sidebar-layout-row {
        flex-wrap: nowrap; 
      }

      .sidebar-wrapper {
        flex: 0 0 var(--sidebar-width); 
        max-width: var(--sidebar-width);
        width: var(--sidebar-width);
      }

      .sidebar-layout-main {
        flex: 1 1 auto;  
        min-width: 0;    
      }
    }

    .sidebar-dash {
      background: linear-gradient(180deg, #ef233c, #c1121f);
      color: #fff;
      width: 100%;
      min-height: 100vh;
      padding: 2rem 1rem;
    }

    .sidebar-dash-inner {
      position: sticky;
      top: 1.5rem;
      max-height: calc(100vh - 3rem);
      overflow-y: auto;
    }

    .sidebar-dash .nav-link {
      color: rgba(255, 255, 255, 0.95);
      transition: background-color .15s ease, color .15s ease;
    }

    .sidebar-dash .nav-link:hover,
    .sidebar-dash .nav-link:focus,
    .sidebar-dash .nav-link.active {
      color: #000 !important;
      background-color: rgba(255, 255, 255, .85);
      border-radius: .5rem;
    }

    .profile-avatar {
      width: 84px;
      height: 84px;
      border-radius: 8px;
      overflow: hidden;
    }

    .card-dash {
      border-radius: 12px;
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
    }

    .badge-accent {
      background: #fff;
      color: var(--bs-primary);
      font-weight: 600;
      padding: .35rem .65rem;
      border-radius: 999px;
    }

    @media (max-width: 767.98px) {
      .sidebar-dash {
        min-height: auto;
        padding: 1rem;
      }

      .sidebar-dash-inner {
        position: static;      
        max-height: none;
        overflow-y: visible;
      }

      .sidebar-dash .nav {
        flex-direction: row !important;
        gap: .5rem;
        flex-wrap: wrap;
      }

      .sidebar-dash .nav-link {
        padding: .5rem .75rem;
        border-radius: .5rem;
        background-color: rgba(255, 255, 255, .12);
      }

      .profile-avatar {
        width: 56px;
        height: 56px;
      }
    }
  </style>
@endsection

@section('content')
  <div class="container-fluid p-0">
    <div class="row g-0 sidebar-layout-row">
      <!-- lebar tetap, sama di semua halaman -->
      <div class="col-12 sidebar-wrapper">
        @include('layouts.partials.sidebar')
      </div>

      <!-- Konten halaman -->
      <div class="col-12 sidebar-layout-main p-4">
        @yield('main-content')
      </div>
    </div>
  </div>
@endsection