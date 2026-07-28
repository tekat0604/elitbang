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

        // 1. Buat "kunci identitas" unik. Contoh: 'verifikator_brida' atau 'user'
        $userType = $role === 'user' ? 'user' : $role . '_' . $instansi;

        // 2. Petakan menu berdasarkan kunci identitas tersebut
        $menus = [
            'user' => [
                ['label' => 'Data Diri', 'route' => 'identitas', 'active' => 'identitas*'],
                ['label' => 'Permohonan', 'route' => 'permohonan', 'active' => 'permohonan*'],
                ['label' => 'Survei Kepuasan', 'route' => 'survei-kepuasan', 'active' => 'survei-kepuasan*'],
            ],
            'verifikator_brida' => [
                ['label' => 'Verifikasi Pemohon', 'route' => 'verifikator.pemohon.list', 'active' => 'verifikator.pemohon*'],
                ['label' => 'Pengajuan Perizinan', 'route' => 'verifikator.brida.permohonan.list', 'active' => 'verifikator.brida.permohonan*'],
                ['label' => 'Terbitkan Surat', 'route' => 'verifikator.brida.penomoran', 'active' => 'verifikator.brida.penomoran*']
            ],
            'verifikator_kesbangpol' => [
                ['label' => 'Pengajuan Perizinan', 'route' => 'verifikator.kesbangpol.permohonan.list', 'active' => 'verifikator.kesbangpol.permohonan*'],
            ],
            'tanda_tangan_brida' => [
                ['label' => 'Pengajuan Perizinan', 'route' => 'penandatangan.brida.list', 'active' => 'penandatangan.brida*'],
            ],
            'tanda_tangan_kesbangpol' => [
                ['label' => 'Pengajuan Perizinan', 'route' => 'penandatangan.kesbangpol.list', 'active' => 'penandatangan.kesbangpol*'],
            ],
        ];

        // 3. Ambil menu yang sesuai, jika tidak ada fallback ke array kosong
        $activeMenus = $menus[$userType] ?? [];
    @endphp

    <nav class="nav flex-column">
      <!-- Menu Dashboard (Selalu Muncul untuk Semua) -->
      <a class="nav-link py-2 mb-1 {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
        Dashboard
      </a>

      <!-- Menu Dinamis (Muncul Berdasarkan Role & Instansi) -->
      @foreach($activeMenus as $menu)
        <a class="nav-link py-2 mb-1 {{ request()->routeIs($menu['active']) ? 'active' : '' }}" href="{{ route($menu['route']) }}">
          {{ $menu['label'] }}
        </a>
      @endforeach
    </nav>
  </div>
</aside>
