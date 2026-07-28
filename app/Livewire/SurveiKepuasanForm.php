<?php

namespace App\Livewire;

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
    public $nilai;
    public $ulasan;

    // Penanda jika survei berhasil dikirim
    public bool $isSubmitted = false;

    public function mount()
    {
        $butuhSurvei = $this->getPendingSurveys();

        // Jika hanya ada 1 surat yang butuh disurvei, pilih otomatis
        if ($butuhSurvei->count() === 1) {
            $this->permohonanId = $butuhSurvei->first()->id;
        }
    }

    protected function rules()
    {
        return [
            'permohonanId' => ['required', 'integer'],
            'nilai' => ['required', 'integer', 'between:1,4'],
            'ulasan' => ['nullable', 'string', 'max:2000'],
        ];
    }

    protected function messages()
    {
        return [
            'permohonanId.required' => 'Silakan pilih permohonan yang akan dinilai.',
            'permohonanId.integer' => 'Pilihan permohonan tidak valid.',
            'nilai.required' => 'Silakan pilih penilaian Anda.',
            'nilai.integer' => 'Format penilaian tidak valid.',
            'nilai.between' => 'Penilaian harus berada dalam rentang 1 hingga 4.',
            'ulasan.string' => 'Ulasan harus berupa teks.',
            'ulasan.max' => 'Ulasan maksimal 2000 karakter.',
        ];
    }

    private function getPendingSurveys()
    {
        return auth()->user()->pemohon
                ?->permohonan()
            ->with('layanan')
            ->where('status_permohonan', 'disetujui')
            ->whereHas('suratIzin', function ($query) {
                $query->whereNotNull('file_surat_final');
            })
            ->doesntHave('surveiKepuasan') // Belum mengisi survei
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
            $this->addError('permohonanId', 'Permohonan tidak valid, belum selesai, atau survei sudah diisi.');
            return;
        }

        DB::transaction(function () use ($permohonan) {
            SurveiKepuasan::create([
                'permohonan_id' => $permohonan->id,
                'nilai' => $this->nilai,
                'ulasan' => $this->ulasan ?: null
            ]);
        });

        // Hentikan proses, sembunyikan form, dan tampilkan ucapan terima kasih (tanpa redirect)
        $this->isSubmitted = true;
    }

    public function render()
    {
        return view('livewire.content.pages-survei-kepuasan', [
            'permohonanList' => $this->getPendingSurveys()
        ]);
    }
}