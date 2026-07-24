<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Izin Penelitian</title>
    <style>
        body { font-family: 'Times New Roman', Times, serif; font-size: 11pt; line-height: 1.3; }
        .header { text-align: center; border-bottom: 3px solid #000; padding-bottom: 5px; margin-bottom: 15px; }
        .header h3, .header h2, .header p { margin: 2px 0; }
        .header h2 { font-size: 14pt; font-weight: bold; }
        .header h3 { font-size: 12pt; font-weight: normal; }
        .content { margin-left: 20px; margin-right: 20px; }
        .table-meta, .table-data { width: 100%; border-collapse: collapse; }
        .table-meta td, .table-data td { vertical-align: top; padding: 2px 0; }
        .label-col { width: 15%; }
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
    </style>
</head>
<body>
    <table class="header-table">
        <tr>
            <td class="header-logo">
                <img src="{{ public_path('assets/img/logo_surakarta.png') }}" alt="Logo Surakarta" width="80">
            </td>
            
            <td class="header-text">
                <h3>PEMERINTAH KOTA SURAKARTA</h3>
                <h2>BADAN RISET DAN INOVASI DAERAH</h2>
                <p style="font-size: 9pt;">
                    Jalan Jenderal Sudirman No.2 Kampung Baru, Pasar Kliwon, Telp: (0271) 636426<br>
                    Website http://brida.surakarta.go.id dan E-mail: brida@surakarta.go.id; bridasurakarta@gmail.com<br>
                    SURAKARTA 57111
                </p>
            </td>
        </tr>
    </table>

    <div class="content">
        <table class="table-meta">
            <tr>
                <td class="label-col">Nomor</td>
                <td class="colon-col">:</td>
                <td>{{ $nomor_surat }}</td>
            </tr>
            <tr>
                <td>Perihal</td>
                <td>:</td>
                <td>Pengabdian masyarakat</td>
            </tr>
            <tr>
                <td>Dasar</td>
                <td>:</td>
                <td>Surat Izin Rekomendasi Dari Instansi Pemohon</td>
            </tr>
            <tr>
                <td>Mengingat</td>
                <td>:</td>
                <td>
                    <ol style="margin-top: 0; padding-left: 15px;">
                        <li>Peraturan Menteri Dalam Negeri Republik Indonesia Nomor 07 Tahun 2014 tentang Perubahan atas Peraturan Menteri Dalam Negeri Republik Indonesia Nomor 64 Tahun 2011 tentang Pedoman Penerbitan Rekomendasi Penelitian</li>
                        <li>Peraturan Wali Kota Surakarta Nomor 13 Tahun 2023 tentang Kedudukan, Susunan Organisasi, Tugas dan Fungsi Serta Tata Kerja Badan Daerah</li>
                    </ol>
                </td>
            </tr>
            <tr><td colspan="3"><br>Diijinkan Kepada :</td></tr>
        </table>

        <table class="table-data">
            <tr>
                <td style="width: 25%;">Nama</td>
                <td class="colon-col">:</td>
                <td>{{ $permohonan->pemohon->nama_lengkap }}</td>
            </tr>
            <tr>
                <td>No Identitas</td>
                <td>:</td>
                <td>{{ $permohonan->pemohon->nomor_identitas }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td>{{ $permohonan->pemohon->alamat }}</td>
            </tr>
            <tr>
                <td>Instansi</td>
                <td>:</td>
                <td>{{ $permohonan->nama_instansi }}</td>
            </tr>
            <tr>
                <td>Alamat Instansi</td>
                <td>:</td>
                <td>{{ $permohonan->alamat_instansi }}</td>
            </tr>
            <tr>
                <td>Judul</td>
                <td>:</td>
                <td>{{ $permohonan->judul }}</td>
            </tr>
            <tr>
                <td>Lokasi</td>
                <td>:</td>
                <td>{{ $permohonan->opdChild->nama ?? '-' }}</td>
            </tr>
            <tr>
                <td>Penanggung Jawab<br>(Dosen pembimbing)</td>
                <td>:</td>
                <td>
                    @foreach($permohonan->pembimbing as $dosen)
                        {{ $dosen->nama_pembimbing }}{{ !$loop->last ? ', ' : '' }}
                    @endforeach
                </td>
            </tr>
            <tr>
                <td>Waktu</td>
                <td>:</td>
                <td>{{ \Carbon\Carbon::parse($permohonan->tgl_mulai)->translatedFormat('d F Y') }} - {{ \Carbon\Carbon::parse($permohonan->tgl_selesai)->translatedFormat('d F Y') }}</td>
            </tr>
        </table>

        <div class="sign-container">
            <div class="sign-left">
                <br>
                <p>Telah Diverifikasi Oleh :<br>
                a.n. Kepala Badan Kesatuan Bangsa dan Politik<br>Kota Surakarta<br>
                plh. Kepala Bidang Politik Dalam Negeri dan<br>Organisasi Kemasyarakatan</p>
                <br><br><br>
                <p><b><u>Rosy Edi Harsiwi, S.H.</u></b><br>NIP: 19840430 201101 2 010</p>
            </div>
            
            <div class="sign-right">
                <p>Surakarta, {{ $tanggal_cetak }}<br><br>
                a.n Kepala Badan Riset dan Inovasi Daerah<br>Kota Surakarta<br>
                Kepala Bidang Riset</p>
                <br><br><br><br>
                <p><b><u>Mohamad Rudiyanto, S.Sos., M.Si.</u></b><br>NIP: 19760506 199703 1 004</p>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</body>
</html>