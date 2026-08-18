<?php

namespace App\Livewire\Instansi;

use App\Models\Permohonan;
use App\Models\TembusanOpd;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.sidebar_layout_livewire')]
#[Title('Detail Surat Masuk')]
class SuratMasukDetail extends Component
{
    public $permohonan;
    public $surat;
    public $tembusanOpd; // 💡 Variabel untuk menyimpan data tembusan milik OPD saat ini
    public $statusPenyaluran = 'menunggu';

    public function mount($id)
    {
        $this->permohonan = Permohonan::with([
            'pemohon',
            'layanan',
            'opd',
            'opdChild.kategori',
            'pembimbing',
            'anggota',
            'suratIzin'
        ])->findOrFail($id);

        $this->surat = $this->permohonan->suratIzin;

        // Ambil data tembusan khusus
        $this->tembusanOpd = TembusanOpd::where('permohonan_id', $this->permohonan->id)
            ->where('user_id', Auth::id())
            ->first();

        if ($this->tembusanOpd) {
            // Ubah status menjadi terbaca
            if (!$this->tembusanOpd->is_read) {
                $this->tembusanOpd->update(['is_read' => true]);
            }

            // Tarik status penyaluran dari database
            $this->statusPenyaluran = $this->tembusanOpd->status_penyaluran;
        }
    }

    // fungsi menolak penyaluran surat ke UPTD
    public function tolakPenyaluran()
    {
        if ($this->statusPenyaluran !== 'menunggu') {
            session()->flash('error', 'Keputusan sudah final dan tidak dapat diubah.');
            return;
        }
        if ($this->tembusanOpd) {
            $this->tembusanOpd->update(['status_penyaluran' => 'ditolak']);
            $this->statusPenyaluran = 'ditolak';

            session()->flash('error', 'Penyaluran surat ke UPTD telah dibatalkan/ditolak.');
        }
    }

    // Fungsi untuk Menyalurkan
    public function salurkanKeUptd()
    {
        if ($this->statusPenyaluran !== 'menunggu') {
            session()->flash('error', 'Keputusan sudah final dan tidak dapat diubah.');
            return;
        }
        $adminUptdList = User::where('role', 'uptd')
            ->where('id_opd_child', $this->permohonan->id_opd_child)
            ->get();

        foreach ($adminUptdList as $adminUptd) {
            TembusanOpd::firstOrCreate(
                [
                    'permohonan_id' => $this->permohonan->id,
                    'user_id' => $adminUptd->id,
                ],
                [
                    'level_distribusi' => 'uptd',
                    'is_read' => false,
                ]
            );
        }

        if ($this->tembusanOpd) {
            $this->tembusanOpd->update(['status_penyaluran' => 'disalurkan']);
            $this->statusPenyaluran = 'disalurkan';
        }

        session()->flash('success', 'Surat berhasil disalurkan ke UPTD terkait.');
    }

    public function render()
    {
        return view('livewire.instansi.surat-masuk-detail');
    }
}