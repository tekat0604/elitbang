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

      @if(auth()->user()->role === 'user' || empty(auth()->user()->role))
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

        <a
          class="nav-link py-2 mb-1 {{ request()->routeIs('survei-kepuasan') ? 'active' : '' }}"
          href="{{ route('survei-kepuasan') }}"
        >
          Survei Kepuasan Masyarakat
        </a>

      @elseif(auth()->user()->role === 'verifikator' && auth()->user()->instansi === 'brida')
        <a
            class="nav-link py-2 mb-1 {{ request()->routeIs('verifikator.pemohon*') ? 'active' : '' }}"
            href="{{ route('verifikator.pemohon.list') }}"
        >
            Verifikasi Pemohon
        </a>

        <a
            class="nav-link py-2 mb-1 {{ request()->routeIs('verifikator.brida.permohonan*') ? 'active' : '' }}"
            href="{{ route('verifikator.brida.permohonan.list') }}"
          >
            Pengajuan Perizinan
          </a>

      @elseif(auth()->user()->role === 'verifikator' && auth()->user()->instansi === 'kesbangpol')
        <a
            class="nav-link py-2 mb-1 {{ request()->routeIs('verifikator.kesbangpol.permohonan*') ? 'active' : '' }}"
            href="{{ route('verifikator.kesbangpol.permohonan.list') }}" 
          >
            Pengajuan Perizinan
          </a>
      @endif
    </nav>
  </div>
</aside>
