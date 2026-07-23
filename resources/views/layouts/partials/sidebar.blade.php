<aside class="sidebar-dash">
  <div class="sidebar-dash-inner">
    <div class="text-center mb-4">
      <div class="profile-avatar mx-auto mb-2">
        <img src="{{ asset('assets/img/logo_surakarta.png') }}" alt="Logo Surakarta" class="h-100" />
      </div>
      <h6 class="mb-0 text-white">{{ auth()->user()->name ?? auth()->user()->username }}</h6>
      <small class="text-white-50">{{ config('unit') ?? '' }}</small>
    </div>

    @php
        $user = auth()->user();
        $role = $user->role ?: 'user'; // Default ke 'user' jika kosong
        $instansi = $user->instansi;

        $userType = $role === 'user' ? 'user' : $role . '_' . $instansi;

        $menus = [
            'user' => [
                ['label' => 'Data Diri', 'route' => 'identitas', 'active' => 'identitas*'],
                ['label' => 'Permohonan', 'route' => 'permohonan', 'active' => 'permohonan*'],
            ],
            'verifikator_brida' => [
                ['label' => 'Verifikasi Pemohon', 'route' => 'verifikator.pemohon.list', 'active' => 'verifikator.pemohon*'],
                ['label' => 'Pengajuan Perizinan', 'route' => 'verifikator.brida.permohonan.list', 'active' => 'verifikator.brida.permohonan*'],
            ],
            'verifikator_kesbangpol' => [
                ['label' => 'Pengajuan Perizinan', 'route' => 'verifikator.kesbangpol.permohonan.list', 'active' => 'verifikator.kesbangpol.permohonan*'],
            ],
            'tanda_tangan_brida' => [
                ['label' => 'Pengajuan Perizinan', 'route' => 'tte.brida.list', 'active' => 'tte.brida*'],
            ],
            'tanda_tangan_kesbangpol' => [
                ['label' => 'Pengajuan Perizinan', 'route' => 'tte.kesbangpol.list', 'active' => 'tte.kesbangpol*'],
            ],
        ];

        $activeMenus = $menus[$userType] ?? [];
    @endphp

    <nav class="nav flex-column">
      <a class="nav-link py-2 mb-1 {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
        Dashboard
      </a>

      @foreach($activeMenus as $menu)
        <a class="nav-link py-2 mb-1 {{ request()->routeIs($menu['active']) ? 'active' : '' }}" href="{{ route($menu['route']) }}">
          {{ $menu['label'] }}
        </a>
      @endforeach
    </nav>
  </div>
</aside>