<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Keaslian Dokumen - Pemkot Surakarta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f4f7fa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .verification-card { max-width: 500px; margin: 40px auto; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); overflow: hidden; }
        .header-success { background-color: #198754; color: white; padding: 40px 20px; text-align: center; }
        .check-icon { font-size: 70px; margin-bottom: 15px; text-shadow: 0 4px 10px rgba(0,0,0,0.2); }
        .table-info-surat td { padding: 10px 0; vertical-align: top; }
        .label-cell { width: 40%; color: #6c757d; font-weight: 500; }
    </style>
</head>
<body>
    <div class="container px-3">
        <div class="card verification-card border-0">
            <div class="header-success">
                <i class="fas fa-check-circle check-icon"></i>
                <h3 class="fw-bold mb-1">DOKUMEN VALID</h3>
                <p class="mb-0 text-white-50" style="font-size: 0.95rem;">
                    Terverifikasi oleh Sistem Pemerintah Kota Surakarta
                </p>
            </div>
            <div class="card-body p-4 bg-white">
                <h5 class="fw-bold border-bottom pb-3 mb-3 text-dark">
                    <i class="fas fa-file-alt me-2 text-primary"></i> Detail Surat
                </h5>
                <table class="table table-borderless table-info-surat mb-4">
                    <tr>
                        <td class="label-cell">Nomor Surat</td>
                        <td>: <span class="fw-bold text-dark">{{ $surat->nomor_surat ?? 'Belum ada nomor' }}</span></td>
                    </tr>
                    <tr>
                        <td class="label-cell">Perihal</td>
                        <td>: {{ $surat->permohonan->layanan->nama_layanan ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="label-cell">Nama Pemohon</td>
                        <td>: <span class="fw-semibold">{{ $surat->permohonan->pemohon->nama_lengkap ?? '-' }}</span></td>
                    </tr>
                    <tr>
                        <td class="label-cell">Instansi / Asal</td>
                        <td>: {{ $surat->permohonan->nama_instansi ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="label-cell">Tanggal Disetujui</td>
                        <td>: {{ \Carbon\Carbon::parse($surat->updated_at)->locale('id')->isoFormat('D MMMM Y') }}</td>
                    </tr>
                </table>
                <div class="alert alert-success border-0 bg-success bg-opacity-10 text-success-emphasis mb-0 rounded-4" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-shield-alt fs-3 me-3 text-success"></i>
                        <div>
                            <p class="mb-0" style="font-size: 0.85rem;">
                                <strong>Keaslian Terjamin.</strong> Dokumen ini telah ditandatangani secara elektronik oleh <b>Kepala BRIDA</b> dan <b>Kesbangpol</b> Kota Surakarta. Dokumen cetak yang isinya berbeda dengan data di atas dinyatakan <b>TIDAK SAH</b>.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-light text-center py-3 border-0">
                <small class="text-muted">
                    &copy; {{ date('Y') }} Badan Riset dan Inovasi Daerah (BRIDA) Surakarta
                </small>
            </div>
        </div>
    </div>
</body>
</html>