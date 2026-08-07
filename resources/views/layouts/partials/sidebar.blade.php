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
        $role = strtolower(trim($user->role ?? 'user'));
        $instansi = strtolower(trim($user->instansi ?? ''));

        if (in_array($role, ['user', 'super_admin', 'opd', 'uptd'])) {
            $userType = $role;
        } else {
            $userType = $role . '_' . $instansi;
        }

        $jumlahBelumDibaca = 0;
        if (in_array($role, ['opd', 'uptd'])) {
            $jumlahBelumDibaca = \App\Models\TembusanOpd::where('user_id', $user->id)
                ->where('is_read', false)
                ->count();
        }

        $jumlahPerluNomorSurat = 0;
        if ($userType === 'verifikator_brida') {
            $jmlRekomendasi = \App\Models\Permohonan::where('status_permohonan', 'disetujui')
                ->whereDoesntHave('suratIzin', function($query) {
                    $query->whereNotNull('file_path');
                })->count();
                
            $jmlSelesai = \App\Models\LaporanAkhir::where('status_laporan', 'disetujui')
                ->whereDoesntHave('suratSelesai', function($query) {
                    $query->whereNotNull('file_path');
                })->count();
                
            $jumlahPerluNomorSurat = $jmlRekomendasi + $jmlSelesai;
        }

        $menus = [
            'user' => [
                ['label' => 'Data Diri', 'route' => 'identitas', 'active' => 'identitas*'],
                ['label' => 'Permohonan', 'route' => 'permohonan', 'active' => 'permohonan*'],
                ['label' => 'Survei Kepuasan', 'route' => 'survei-kepuasan', 'active' => 'survei-kepuasan*'],
                ['label' => 'Laporan Akhir', 'route' => 'laporan-akhir', 'active' => 'laporan-akhir'],
            ],
            'verifikator_brida' => [
                ['label' => 'Verifikasi Pemohon', 'route' => 'verifikator.pemohon.list', 'active' => 'verifikator.pemohon*'],
                ['label' => 'Pengajuan Perizinan', 'route' => 'verifikator.brida.permohonan.list', 'active' => 'verifikator.brida.permohonan*'],
                ['label' => 'Terbitkan Surat', 'route' => 'verifikator.brida.penomoran', 'active' => 'verifikator.brida.penomoran*'],
                ['label' => 'Pengajuan Laporan Akhir', 'route' => 'verifikator.brida.laporan-akhir.list', 'active' => 'verifikator.brida.laporan-akhir*'],
                
            ],
            'verifikator_kesbangpol' => [
                ['label' => 'Pengajuan Perizinan', 'route' => 'verifikator.kesbangpol.permohonan.list', 'active' => 'verifikator.kesbangpol.permohonan*'],
            ],
            'tanda_tangan_brida' => [
                ['label' => 'Penandatanganan Surat', 'route' => 'penandatangan.brida.list', 'active' => 'penandatangan.brida*'],
            ],
            'tanda_tangan_kesbangpol' => [
                ['label' => 'Penandatanganan Surat', 'route' => 'penandatangan.kesbangpol.list', 'active' => 'penandatangan.kesbangpol*'],
            ],
            'super_admin' => [
                ['label' => 'Data Pengguna', 'route' => 'super-admin.akun-manual', 'active' => 'super-admin.akun-manual*'],
                ['label' => 'Data Penandatangan', 'route' => 'super-admin.data-instansi', 'active' => 'super-admin.data-instansi*'],
            ],
            'opd' => [
                ['label' => 'Surat Masuk', 'route' => 'instansi.surat-masuk.list', 'active' => 'instansi.surat-masuk*'],
            ],
            'uptd' => [
                ['label' => 'Surat Masuk', 'route' => 'instansi.surat-masuk.list', 'active' => 'instansi.surat-masuk*'],
            ],
        ];

        // 3. Ambil menu yang sesuai, jika tidak ada fallback ke array kosong
        $activeMenus = $menus[$userType] ?? [];
    @endphp

    <nav class="nav flex-column">
      <!-- Menu Dashboard -->
      <a class="nav-link py-2 mb-1 {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
        Dashboard
      </a>

      @foreach($activeMenus as $menu)
        <a class="nav-link py-2 mb-1 d-flex justify-content-between align-items-center {{ request()->routeIs($menu['active']) ? 'active' : '' }}" href="{{ route($menu['route']) }}">
          <span>{{ $menu['label'] }}</span>
          
          <!-- Tampilkan Badge jika menu adalah Surat Masuk dan ada yang belum dibaca -->
          @if($menu['route'] === 'instansi.surat-masuk.list' && $jumlahBelumDibaca > 0)
              <span class="badge bg-secondary rounded-pill">  {{ $jumlahBelumDibaca }}</span>
          @endif

          @if($menu['route'] === 'verifikator.brida.penomoran' && $jumlahPerluNomorSurat > 0)
              <span class="badge bg-secondary rounded-pill">{{ $jumlahPerluNomorSurat }}</span>
          @endif
        </a>
      @endforeach
    </nav>
  </div>
</aside>
