<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Keterangan Selesai Penelitian</title>
    <style>
        body { font-family: 'Times New Roman', Times, serif; font-size: 11pt; line-height: 1.3; }
        .header { text-align: center; border-bottom: 3px solid #000; padding-bottom: 5px; margin-bottom: 15px; }
        .header h3, .header h2, .header p { margin: 2px 0; }
        .header h2 { font-size: 14pt; font-weight: bold; }
        .header h3 { font-size: 12pt; font-weight: normal; }
        .content { margin-left: 20px; margin-right: 20px; }
        .table-meta, .table-data { width: 100%; border-collapse: collapse; }
        .table-meta td, .table-data td { vertical-align: top; padding: 2px 0; }
        .header-table { width: 100%; border-bottom: 3px solid #000; padding-bottom: 5px; margin-bottom: 15px; }
        .header-logo { width: 15%; text-align: center; vertical-align: middle; }
        .header-text { width: 85%; text-align: center; vertical-align: middle; }
        .header-text h3, .header-text h2, .header-text p { margin: 2px 0; }
        .header-text h2 { font-size: 14pt; font-weight: bold; }
        .header-text h3 { font-size: 12pt; font-weight: normal; }
        
        .letter-title { text-align: center; margin: 0 0 25px; }
        .letter-title .title { font-weight: bold; font-size: 12pt; margin-bottom: 2px; }
        .letter-title p { margin: 0; }
        .identity-table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        .identity-table td { vertical-align: top; padding: 3px 0; }
        .statement { margin: 15px 0 10px; text-align: justify; }
        .research-title { margin: 10px 0 20px; font-weight: bold; text-align: justify; text-transform: uppercase; }
    </style>
</head>
<body>
    <table class="header-table">
        <tr>
            <td class="header-logo">
                <img src="{{ public_path('assets/img/logo_surakarta.png') }}" alt="Logo Surakarta" width="80">
            </td>
            
            <td class="header-text">
                <h3><b>PEMERINTAH KOTA SURAKARTA</b></h3>
                <h2><b>BADAN RISET DAN INOVASI DAERAH</b></h2>
                <p style="font-size: 9pt;">
                    Jalan Jenderal Sudirman No.2 Kampung Baru, Pasar Kliwon, Telp: (0271) 636426<br>
                    Website http://brida.surakarta.go.id dan E-mail:<br>brida@surakarta.go.id; bridasurakarta@gmail.com<br>
                    <b>SURAKARTA</b><br><b>57111</b>
                </p>
            </td>
        </tr>
    </table>

    <div class="content">
        <div class="letter-title">
            <div class="title">SURAT KETERANGAN SELESAI PENELITIAN</div>
            <p>Nomor : {{ $surat->nomor_surat ?? $nomor_surat }}</p>
        </div>

        <p style="margin-bottom: 5px;">Yang bertanda tangan di bawah ini :</p>
        <table class="identity-table">
            <tr>
                <td style="width: 15%;">Nama</td>
                <td style="width: 3%; text-align: center;">:</td>
                <td style="width: 82%;">{{ $pejabat_brida->nama_kepala_instansi }}</td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td style="text-align: center;">:</td>
                <td>Kabid. Riset</td>
            </tr>
            <tr>
                <td>Instansi</td>
                <td style="text-align: center;">:</td>
                <td>Badan Riset dan Inovasi Daerah Kota Surakarta</td>
            </tr>
        </table>

        <p style="margin-bottom: 5px;">Dengan ini menerangkan bahwa {{ in_array($permohonan->jenjang_pendidikan, ['D3','D4','S1','S2','S3']) ? 'Mahasiswa' : 'Siswa/Pemohon' }} :</p>
        <table class="identity-table">
            <tr>
                <td style="width: 15%;">Nama</td>
                <td style="width: 3%; text-align: center;">:</td>
                <td style="width: 82%;">{{ $permohonan->pemohon->nama_lengkap }}</td>
            </tr>
            
            @if($permohonan->nim)
            <tr>
                <td>NIM</td>
                <td style="text-align: center;">:</td>
                <td>{{ $permohonan->nim }}</td>
            </tr>
            @endif
            
            @if($permohonan->fakultas)
            <tr>
                <td>Fakultas</td>
                <td style="text-align: center;">:</td>
                <td>{{ $permohonan->fakultas }}</td>
            </tr>
            @endif
            
            @if($permohonan->program_studi)
            <tr>
                <td>Program Studi</td>
                <td style="text-align: center;">:</td>
                <td>{{ $permohonan->program_studi }}</td>
            </tr>
            @endif
            
            <tr>
                <td>Universitas</td>
                <td style="text-align: center;">:</td>
                <td>{{ $permohonan->nama_instansi }}</td>
            </tr>
        </table>

        @php
            $start = \Carbon\Carbon::parse($permohonan->tgl_mulai);
            $end = \Carbon\Carbon::parse($permohonan->tgl_selesai);
            
            $diff = $start->diff($end);
            
            $bulan = ($diff->y * 12) + $diff->m;
            $hari = $diff->d;
            
            $durasiParts = [];
            if ($bulan > 0) {
                $durasiParts[] = $bulan . ' bulan';
            }
            if ($hari > 0) {
                $durasiParts[] = $hari . ' hari';
            }
            
            $durasiText = count($durasiParts) > 0 ? implode(' ', $durasiParts) : '1 hari';

            $namaLayanan = strtolower($permohonan->layanan->nama_layanan ?? 'penelitian');
            $jenisKegiatan = trim(str_replace('izin', '', $namaLayanan));
        @endphp

        <p class="statement">
            Telah selesai melakukan {{ $jenisKegiatan }} di Kota Surakarta selama {{ $durasiText }}, 
            terhitung mulai tanggal {{ $start->locale('id')->isoFormat('D MMMM Y') }} sampai dengan {{ $end->locale('id')->isoFormat('D MMMM Y') }} 
            {{ strtolower($permohonan->tujuan) }} yang berjudul :
        </p>

        <p class="research-title">
            {{ $permohonan->judul }}
        </p>

        <p class="statement">
            Demikian surat keterangan ini dibuat dan diberikan kepada yang bersangkutan untuk dipergunakan seperlunya.
        </p>

        <table style="width: 100%; margin-top: 40px; border-collapse: collapse;">
            <tr>
                <td style="width: 50%; vertical-align: top;"></td>
                <td style="width: 50%; text-align: center; vertical-align: top;">
                    Surakarta, {{ $tanggal_cetak }}<br>
                    Kepala Badan Riset dan Inovasi Daerah<br>
                    Kota Surakarta<br>
                    Kepala Bidang Riset<br>
                    
                    <div style="height: 80px; margin: 10px 0; position: relative;">
                        @if(isset($surat) && $surat->status_tte_brida === 'selesai')
                            <img src="{{ storage_path('app/ttd/ttd_brida.jpeg') }}" height="70" style="position: absolute; left: 50%; transform: translateX(-50%); top: 5px;">
                        @endif
                    </div>

                    <div>{{ $pejabat_brida->nama_kepala_instansi ?? 'Nama Pejabat Belum Diatur' }}</div><br>
                    NIP. {{ $pejabat_brida->nip ?? '-' }}
                </td>
            </tr>
        </table>

        @if(isset($qr_code))
        <div style="text-align: left; margin-top: 15px;">
            <img src="data:image/svg+xml;base64,{{ $qr_code }}" width="80" height="80" alt="QR Code Verifikasi">           
            <p style="font-size: 8pt; color: #555; margin-top: 5px;"><i>Dokumen ini telah ditandatangani secara elektronik. Scan QR Code untuk memverifikasi keaslian dokumen.</i></p>
        </div>
        @endif
    </div>
</body>
</html>
