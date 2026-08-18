<?php

namespace App\Livewire\Penandatangan\Brida;

use App\Models\Permohonan;
use App\Models\SuratIzin;
use App\Models\LaporanAkhir;
use App\Models\SuratSelesai;
use App\Services\SuratIzinService;
use App\Services\SuratSelesaiService;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

#[Layout('layouts.sidebar_layout_livewire')]
#[Title('Daftar Tanda Tangan - BRIDA')]
class TandaTanganList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $password = '';
    public $selectedId = null;
    public $selectedTipe = null;

    public function mount()
    {
        $user = Auth::user();

        if ($user->role !== 'tanda_tangan' || $user->instansi !== 'brida') {
            abort(403, 'Akses ditolak! Halaman ini khusus untuk penandatangan BRIDA.');
        }
    }

    public function openModal($id, $tipe)
    {
        $this->selectedId = $id;
        $this->selectedTipe = $tipe;
        $this->reset('password');
    }

    public function prosesTandaTangan()
    {
        $this->validate([
            'password' => 'required'
        ]);

        if ($this->selectedTipe === 'rekomendasi') {
            $permohonan = Permohonan::findOrFail($this->selectedId);
            $surat = SuratIzin::where('permohonan_id', $this->selectedId)->first();

            if ($surat) {
                $surat->update(['status_tte_brida' => 'selesai']);
                SuratIzinService::generateAndSave($permohonan, $surat->nomor_surat);
            }
        } else {
            $laporan = LaporanAkhir::findOrFail($this->selectedId);
            $surat = SuratSelesai::where('laporan_akhir_id', $this->selectedId)->first();

            if ($surat) {
                $surat->update(['status_tte_brida' => 'selesai']);
                SuratSelesaiService::generateAndSave($laporan, $surat->nomor_surat);
            }
        }

        $this->dispatch('close-modal-tanda-tangan');
        session()->flash('success', 'Tanda tangan elektronik berhasil dibubuhkan pada dokumen.');
    }

    public function render()
    {
        // 1. Ambil Antrean Surat Rekomendasi
        $rekomendasi = Permohonan::with(['pemohon', 'layanan', 'suratIzin'])
            ->where('status_permohonan', 'disetujui')
            ->whereHas('suratIzin', function ($query) {
                $query->whereNotNull('file_path');
            })
            ->get()
            ->map(function ($item) {
                return (object) [
                    'id' => $item->id,
                    'tipe' => 'rekomendasi',
                    'jenis_surat' => 'Surat Izin Rekomendasi',
                    'tgl_pengajuan' => $item->created_at,
                    'nama_pemohon' => $item->pemohon->nama_lengkap ?? '-',
                    'layanan' => $item->layanan->nama_layanan ?? '-',
                    'instansi' => $item->nama_instansi,
                    'status_tte' => $item->suratIzin->status_tte_brida ?? 'pending',
                    'qr_code_link' => $item->suratIzin->qr_code_link ?? '',
                ];
            });

        // 2. Ambil Antrean Surat Selesai
        $selesai = LaporanAkhir::with(['permohonan.pemohon', 'permohonan.layanan', 'suratSelesai'])
            ->where('status_laporan', 'disetujui')
            ->whereHas('suratSelesai', function ($query) {
                $query->whereNotNull('file_path');
            })
            ->get()
            ->map(function ($item) {
                return (object) [
                    'id' => $item->id,
                    'tipe' => 'selesai',
                    'jenis_surat' => 'Surat Selesai Penelitian',
                    'tgl_pengajuan' => $item->tanggal_upload,
                    'nama_pemohon' => $item->permohonan->pemohon->nama_lengkap ?? '-',
                    'layanan' => $item->permohonan->layanan->nama_layanan ?? '-',
                    'instansi' => $item->permohonan->nama_instansi,
                    'status_tte' => $item->suratSelesai->status_tte_brida ?? 'pending',
                    'qr_code_link' => $item->suratSelesai->qr_code_link ?? '',
                ];
            });

        // 3. Gabungkan dan Paginasi
        $antrean = $rekomendasi->concat($selesai)->sortByDesc('tgl_pengajuan');

        $page = Paginator::resolveCurrentPage() ?: 1;
        $perPage = 10;
        $paginatedItems = new LengthAwarePaginator(
            $antrean->forPage($page, $perPage),
            $antrean->count(),
            $perPage,
            $page,
            ['path' => Paginator::resolveCurrentPath()]
        );

        return view('livewire.penandatangan.brida.tanda-tangan-list', [
            'permohonanList' => $paginatedItems
        ]);
    }
}