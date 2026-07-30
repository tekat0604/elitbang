<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.sidebar_layout_livewire')]
#[Title('Laporan Akhir Penelitian')]
class LaporanAkhirForm extends Component
{
    public ?int $permohonanId = null;
    public string $linkDokumen = '';
    public bool $isSubmitted = false;

    protected function rules(): array
    {
        return [
            'permohonanId' => ['required', 'integer'],
            'linkDokumen' => ['required', 'url', 'max:2048'],
        ];
    }

    protected function messages(): array
    {
        return [
            'permohonanId.required' => 'Silakan pilih permohonan penelitian.',
            'linkDokumen.required' => 'Link dokumen laporan wajib diisi.',
            'linkDokumen.url' => 'Masukkan link dokumen yang valid.',
        ];
    }

    public function submit(): void
    {
        $this->validate();

        // Front-end saja: penyimpanan laporan dan verifikasi BRIDA akan ditambahkan pada tahap berikutnya.
        $this->isSubmitted = true;
    }

    public function render()
    {
        $permohonanList = auth()->user()->pemohon?->permohonan()
            ->with('layanan')
            ->where('status_permohonan', 'disetujui')
            ->latest()
            ->get() ?? collect();

        return view('livewire.content.pages-laporan-akhir', compact('permohonanList'));
    }
}
