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
        .label-col { width: 16%; }
        .colon-col { width: 2%; text-align: center; }
        .sign-container { width: 100%; margin-top: 30px; }
        .sign-left { width: 50%; float: left; text-align: center; }
        .sign-right { width: 50%; float: right; text-align: center; }
        .clear { clear: both; }
        .header-table { width: 100%; border-bottom: 3px solid #000; padding-bottom: 5px; margin-bottom: 15px; }
        .header-logo { width: 15%; text-align: center; vertical-align: middle; }
        .header-text { width: 85%; text-align: center; vertical-align: middle; }
        .header-text h3, .header-text h2, .header-text p { margin: 2px 0; }
        .header-text h2 { font-size: 14pt; font-weight: bold; }
        .header-text h3 { font-size: 12pt; font-weight: normal; }
        .letter-title { text-align: center; margin: 0 0 40px; }
        .letter-title p { margin: 0; }
        .letter-title .title { font-weight: bold; }
        .section { margin-bottom: 18px; }
        .section p { margin: 0 0 10px; }
        .identity-table { width: 100%; border-collapse: collapse; margin: 0; }
        .identity-table td { vertical-align: top; padding: 2px 0; }
        .identity-table .field { width: 16%; }
        .identity-table .colon { width: 3%; text-align: center; }
        .statement { margin: 20px 0 12px; text-align: justify; }
        .research-title { margin: 10px 0 20px; font-weight: bold; text-align: justify; }
        .signature { width: 48%; margin-left: auto; margin-top: 28px; text-align: center; }
        .signature .space { height: 72px; }
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
            <p class="title">SURAT KETERANGAN SELESAI PENELITIAN</p>
            <p>Nomor : ........................................</p>
        </div>

        <div class="section">
            <p>Yang bertanda tangan di bawah ini :</p>
            <table class="identity-table">
                <tr><td class="field">Nama</td><td class="colon">:</td><td>.................................................................</td></tr>
                <tr><td class="field">Jabatan</td><td class="colon">:</td><td>Kepala Bidang Riset</td></tr>
                <tr><td class="field">Instansi</td><td class="colon">:</td><td>Badan Riset dan Inovasi Daerah Kota Surakarta</td></tr>
            </table>
        </div>

        <div class="section">
            <p>Dengan ini menerangkan bahwa Mahasiswa :</p>
            <table class="identity-table">
                <tr><td class="field">Nama</td><td class="colon">:</td><td>.................................................................</td></tr>
                <tr><td class="field">NIM</td><td class="colon">:</td><td>.................................................................</td></tr>
                <tr><td class="field">Fakultas</td><td class="colon">:</td><td>.................................................................</td></tr>
                <tr><td class="field">Program Studi</td><td class="colon">:</td><td>.................................................................</td></tr>
                <tr><td class="field">Universitas</td><td class="colon">:</td><td>.................................................................</td></tr>
            </table>
        </div>

        <p class="statement">
            Telah selesai melakukan penelitian di Kota Surakarta selama .......... (...........) bulan,
            terhitung mulai tanggal ................................ sampai dengan ................................
            untuk memperoleh data dalam rangka penyusunan skripsi yang berjudul :
        </p>

        <p class="research-title">........................................................................................................................................................................</p>

        <p class="statement">
            Demikian surat keterangan ini dibuat dan diberikan kepada yang bersangkutan untuk dipergunakan seperlunya.
        </p>

        <div class="signature">
            <p>Surakarta, ................................</p>
            <p>Kepala Badan Riset dan Inovasi Daerah Kota<br>Surakarta</p>
            <div class="space"></div>
            <p><b><u>.................................................................</u></b><br>NIP. ........................................................</p>
        </div>
    </div>
</body>
</html>
