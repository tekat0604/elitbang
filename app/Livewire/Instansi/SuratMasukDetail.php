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

    public function mount($id)
    {
        $this->permohonan = Permohonan::with(['pemohon', 'layanan', 'opdChild', 'suratIzin'])->findOrFail($id);
        $this->surat = $this->permohonan->suratIzin;

        $tembusan = TembusanOpd::where('permohonan_id', $this->permohonan->id)
            ->where('user_id', Auth::id())
            ->first();

        if ($tembusan && !$tembusan->is_read) {
            $tembusan->update(['is_read' => true]);

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
        }
    }
    public function render()
    {
        return view('livewire.instansi.surat-masuk-detail');
    }
}
