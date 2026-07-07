<?php

namespace App\Livewire\FileView;

use Illuminate\Support\Facades\Storage;

use Livewire\Component;

class Display extends Component
{
    // public function displayFileFe($path, $filename) {
    //     $safeFile = basename($filename);
    //     $url = storage_path("app/$path/$safeFile");
    //     if (file_exists($url)) {
    //         return response()->file($url);
    //     }
    //     abort(404);
    // }
    // public function displayFileBe($path, $filename) {
    //     $safeFile = basename($filename);
    //     $url = storage_path("app/$path/$safeFile");
    //     if (file_exists($url)) {
    //         return response()->file($url);
    //     }
    //     abort(404);
    // }
    // public function downloadFile($path, $filename)
    // {
    //     $safeFile = basename($filename);
    //     $url = storage_path("app/$path/$safeFile");
    //     if (file_exists($url)) {
    //         return response()->download($url);
    //     }
    //     abort(404);
    // }
    public function displayFileFe($path, $filename)
    {
        $allowedPaths = [
            'setting',
        ];

        if (!in_array($path, $allowedPaths)) {
            abort(403);
        }

        $safeFilename = basename($filename);
        $fullPath = storage_path("app/$path/$safeFilename");

        if (!file_exists($fullPath)) {
            abort(404);
        }

        return response()->file($fullPath);
    }
    public function displayFileBe($path, $filename)
    {
        $allowedPaths = [
            'download_dokfile',
            'infografis_file',
            'layanan_dokfile',
            'layanan_instansi',
            'logo_sosmed',
            'logo_support',
            'news_dokfile',
            'penghargaan_dokfile',
            'ppid_dokfile',
            'ppid_icon',
            'setting',
            'slider_dokfile',
            'ppid_cover',
            'skdip',
            'support_ppid',
            'tentang_dokfile'
        ];
        if (!in_array($path, $allowedPaths)) {
            abort(403, 'Unauthorized folder access.');
        }

        $safeFilename = basename($filename);
        $fullPath = $path . '/' . $safeFilename;

        if (!Storage::disk('local')->exists($fullPath)) {
            abort(404, 'File not found.');
        }

        return Storage::disk('local')->response($fullPath);
    }
    public function downloadFile($path, $filename)
    {
        $allowedPaths = [
            'download_dokfile',
            'infografis_file',
            'layanan_dokfile',
            'layanan_instansi',
            'logo_sosmed',
            'logo_support',
            'news_dokfile',
            'penghargaan_dokfile',
            'ppid_dokfile',
            'ppid_icon',
            'setting',
            'slider_dokfile',
            'ppid_cover',
            'skdip',
            'support_ppid',
            'tentang_dokfile'
        ];
        if (!in_array($path, $allowedPaths)) {
            abort(403, 'Unauthorized folder access.');
        }

        $safeFilename = basename($filename);
        $fullPath = $path . '/' . $safeFilename;

        if (!Storage::disk('local')->exists($fullPath)) {
            abort(404, 'File not found.');
        }

        return Storage::disk('local')->download($fullPath, "unduhan-$safeFilename");
    }

    public function render()
    {
        return <<<'HTML'
        <div>
            {{-- If your happiness depends on money, you will never be happy with yourself. --}}
        </div>
        HTML;
    }
}
