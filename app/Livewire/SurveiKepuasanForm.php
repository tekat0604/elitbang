<?php

namespace App\Livewire;

use App\Models\Permohonan;
use App\Models\SurveiKepuasan;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.sidebar_layout_livewire')]
class SurveiKepuasanForm extends Component
{
    public ?int $permohonanId = null;
    public ?int $nilai = null;
    public string $ulasan = '';

    public function submit(): void
    {
        $validated = $this->validate([
            'permohonanId' => ['required', 'integer'],
            'nilai' => ['required', 'integer', 'between:1,4'],
            'ulasan' => ['nullable', 'string', 'max:2000'],
        ], [
            'permohonanId.required' => 'Silakan pilih permohonan.',
            'nilai.required' => 'Silakan pilih penilaian Anda.',
        ]);

        $permohonan = $this->permohonanMilikPengguna($validated['permohonanId']);

        if (! $permohonan) {
            $this->addError('permohonanId', 'Permohonan yang dipilih tidak tersedia.');
            return;
        }

        DB::transaction(function () use ($validated, $permohonan): void {
            SurveiKepuasan::updateOrCreate(
                ['permohonan_id' => $permohonan->id],
                ['nilai' => $validated['nilai'], 'ulasan' => $validated['ulasan'] ?: null]
            );
        });

        $this->reset(['permohonanId', 'nilai', 'ulasan']);
        session()->flash('success', 'Terima kasih. Survei Kepuasan Masyarakat berhasil dikirim.');
    }

    public function render()
    {
        $permohonan = auth()->user()->pemohon
            ?->permohonan()
            ->with('layanan')
            ->latest()
            ->get() ?? collect();

        return view('livewire.content.pages-survei-kepuasan', compact('permohonan'));
    }

    private function permohonanMilikPengguna(int $id): ?Permohonan
    {
        return auth()->user()->pemohon
            ?->permohonan()
            ->whereKey($id)
            ->first();
    }
}
