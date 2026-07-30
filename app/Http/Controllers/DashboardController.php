<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Permohonan;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $isPemohon = strtolower(trim($user->role ?? 'user')) === 'user';
        $statistikPermohonan = null;

        if ($isPemohon) {
            $queryPermohonan = Permohonan::query()
                ->where('pemohon_id', $user->pemohon?->id);

            $statistikPermohonan = [
                'diajukan' => (clone $queryPermohonan)
                    ->whereIn('status_permohonan', ['diajukan', 'proses_verifikasi', 'revisi', 'disetujui', 'ditolak'])
                    ->count(),
                'pending' => (clone $queryPermohonan)
                    ->whereIn('status_permohonan', ['diajukan', 'proses_verifikasi'])
                    ->count(),
                'disetujui' => (clone $queryPermohonan)
                    ->where('status_permohonan', 'disetujui')
                    ->count(),
                'perlu_tindakan' => (clone $queryPermohonan)
                    ->whereIn('status_permohonan', ['ditolak', 'revisi'])
                    ->count(),
            ];
        }

        return view('livewire.content.pages-dashboard', compact('isPemohon', 'statistikPermohonan'));
    }
}