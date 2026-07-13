@extends('layouts.login_layout')

@section('vendor-style')
  @vite(['resources/assets/vendor/libs/apex-charts/apex-charts.scss'])
@endsection

@section('page-style')
  <style>
    .sidebar-dash {
      background: linear-gradient(180deg, var(--bs-primary), rgba(0, 0, 0, 0.08));
      color: #fff;
      min-height: 100vh;
      padding: 2rem 1rem;
    }

    .sidebar-dash .nav-link {
      color: rgba(255, 255, 255, 0.95);
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
  </style>
@endsection

@section('vendor-script')
  @vite(['resources/assets/vendor/libs/apex-charts/apexcharts.js'])
@endsection


@section('content')
  <div class="container-fluid">
    <div class="row g-4">
      <!-- Sidebar -->
      <div class="col-md-3 d-none d-md-block">
        <aside class="sidebar-dash">
          <div class="text-center mb-4">
            <div class="profile-avatar mx-auto mb-2">
              <img src="{{ asset('assets/img/logo_surakarta.png') }}" alt="Logo Surakarta" class="h-100" data-speed="1" />
            </div>
            <h6 class="mb-0">{{ auth()->user()->name ?? auth()->user()->username }}</h6>
            <small class="text-white-50">{{ config('unit') ?? '' }}</small>
          </div>

          <nav class="nav flex-column">
            <a class="nav-link py-2 mb-1" href="{{ url('/') }}"><i class="ti ti-home me-2"></i> Dashboard</a>
            <a class="nav-link py-2 mb-1"
              href="{{ \Illuminate\Support\Facades\Route::has('pengguna.data.diri')
                  ? route('pengguna.data.diri')
                  : url('pages/profile-user') }}">
              <i class="ti ti-user me-2"></i> Data Diri
            </a>
            <a class="nav-link py-2 mb-1"
              href="{{ \Illuminate\Support\Facades\Route::has('pengguna.permohonan.index')
                  ? route('pengguna.permohonan.index')
                  : url('permohonan') }}">
              <i class="ti ti-file-text me-2"></i> Permohonan
            </a>
          </nav>
        </aside>
      </div>

      <!-- Main content -->
      <div class="col-md-9">
        <div class="row g-4">
          <div class="col-12">
            <div class="card card-dash p-3">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <h4 class="mb-1">Dashboard</h4>
                  <small class="text-body-secondary">Selamat datang,
                    {{ auth()->user()->name ?? auth()->user()->username }}</small>
                </div>
                <div>
                  <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-link p-0 fw-semibold text-danger text-decoration-none">
                      Logout
                    </button>
                  </form>
                </div>
              </div>
              <div class="mt-3">
                <div id="chart-overview"></div>
              </div>
            </div>
          </div>


        </div>
      </div>
    </div>
  </div>
  </div>
  </div>
  </div>
@endsection
