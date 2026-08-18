<?php

namespace App\Livewire\Upload;

use App\Models\Permohonan;
use App\Models\SurveiKepuasan;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.sidebar_layout_livewire')]
#[Title('Form Survei Kepuasan')]
class SurveiKepuasanForm extends Component
{
    public $permohonanId;
    public bool $konfirmasiSurvei = false;

    public bool $isSubmitted = false;

    public function mount()
    {
        $butuhSurvei = $this->getPendingSurveys();

        if ($butuhSurvei->count() === 1) {
            $this->permohonanId = $butuhSurvei->first()->id;
        }
    }

    protected function rules()
    {
        return [
            'permohonanId' => ['required', 'integer'],
            'konfirmasiSurvei' => ['accepted'],
        ];
    }

    protected function messages()
    {
        return [
            'permohonanId.required' => 'Silakan pilih permohonan yang akan dinilai.',
            'konfirmasiSurvei.accepted' => 'Anda harus mengonfirmasi bahwa Anda telah mengisi survei di atas untuk dapat melanjutkan.',
        ];
    }

    private function getPendingSurveys()
    {
        return auth()->user()->pemohon
                ?->permohonan()
            ->with('layanan')
            ->where('status_permohonan', 'disetujui')
            ->whereHas('suratIzin', function ($query) {
                $query->whereNotNull('file_path');
            })
            ->doesntHave('surveiKepuasan')
            ->latest()
            ->get() ?? collect();
    }

    public function submit()
    {
        $this->validate();

        $permohonan = auth()->user()->pemohon
                ?->permohonan()
            ->where('status_permohonan', 'disetujui')
            ->whereHas('suratIzin')
            ->doesntHave('surveiKepuasan')
            ->whereKey($this->permohonanId)
            ->first();

        if (!$permohonan) {
            $this->addError('permohonanId', 'Permohonan tidak valid, belum selesai, atau survei sudah dikonfirmasi.');
            return;
        }

        DB::transaction(function () use ($permohonan) {
            SurveiKepuasan::create([
                'permohonan_id' => $permohonan->id,
                'keterangan' => 'Telah mengonfirmasi pengisian survei eksternal (Kesbangpol & BRIDA)'
            ]);
        });

        $this->isSubmitted = true;
    }

    public function render()
    {
        return view('livewire.content.pages-survei-kepuasan', [
            'permohonanList' => $this->getPendingSurveys()
        ]);
    }
}