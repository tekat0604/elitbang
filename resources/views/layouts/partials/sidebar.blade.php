<aside class="sidebar-dash">
  <div class="sidebar-dash-inner">
    <div class="text-center mb-4">
      <div class="profile-avatar mx-auto mb-2">
        <img src="{{ asset('assets/img/logo_surakarta.png') }}" alt="Logo Surakarta" class="h-100" />
      </div>
      <h6 class="mb-0 text-white">{{ auth()->user()->name ?? auth()->user()->username }}</h6>
      <small class="text-white-50">{{ config('unit') ?? '' }}</small>
    </div>

    <nav class="nav flex-column">
      <a
        class="nav-link py-2 mb-1 {{ request()->routeIs('dashboard') ? 'active' : '' }}"
        href="{{ route('dashboard') }}"
      >
        Dashboard
      </a>

      <a
        class="nav-link py-2 mb-1 {{ request()->routeIs('identitas*') ? 'active' : '' }}"
        href="{{ route('identitas') }}"
      >
        Data Diri
      </a>

      <a
        class="nav-link py-2 mb-1 {{ request()->routeIs('permohonan*') ? 'active' : '' }}"
        href="{{ route('permohonan') }}"
      >
        Permohonan
      </a>
    </nav>
  </div>
</aside>