<!DOCTYPE html>
<html>
<head>
    <title>Revisi {{ $jenis }}</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; }
        .catatan { background: #fff3cd; border-left: 5px solid #ffc107; padding: 15px; margin: 20px 0; border-radius: 4px; }
        .btn { display: inline-block; padding: 10px 20px; background-color: #0d6efd; color: #fff; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <h2 style="color: #d9534f;">Pemberitahuan Revisi Data</h2>
        <p>Halo,</p>
        <p>Mohon maaf, pengajuan <strong>{{ $jenis }}</strong> Anda dikembalikan oleh pihak <strong>{{ $instansi }}</strong> karena memerlukan beberapa perbaikan.</p>
        
        <div class="catatan">
            <strong>Catatan Revisi:</strong><br>
            {{ $catatan }}
        </div>

        <p>Silakan login ke aplikasi untuk memperbaiki data Anda agar proses verifikasi dapat dilanjutkan.</p>
        
        <p>Terima kasih,<br><strong>Tim e-Litbang</strong></p>
    </div>
</body>
</html>