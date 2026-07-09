# Data Dictionary Sistem Perizinan E-Litbang

Dokumen ini berisi struktur tabel database, tipe data, _constraints_, dan keterangan fungsi masing-masing kolom berdasarkan alur pendaftaran izin penelitian/kegiatan.

---

## 1. Tabel `users`

Tabel ini khusus untuk autentikasi sistem (Login/Register)

| Nama Kolom                  | Tipe Data            | Constraints          | Keterangan                                                       |
| :-------------------------- | :------------------- | :------------------- | :--------------------------------------------------------------- |
| `id`                        | `unsignedBigInteger` | `PRIMARY KEY`        | ID unik pengguna                                                 |
| `name`                      | `string`             | `NOT NULL`           | Nama tampilan pengguna (bisa dari akun Google)                   |
| `username`                  | `string`             | `UNIQUE, NULLABLE`   | Username alternatif untuk login manual                           |
| `email`                     | `string`             | `UNIQUE, NOT NULL`   | Email utama untuk login dan notifikasi                           |
| `email_verified_at`         | `timestamp`          | `NULLABLE`           | Penanda waktu jika email sudah diverifikasi                      |
| `password`                  | `string`             | `NULLABLE`           | Password (kosong jika login via Google)                          |
| `google_id`                 | `string`             | `UNIQUE, NULLABLE`   | ID unik dari Google OAuth (Socialite)                            |
| `avatar`                    | `string`             | `NULLABLE`           | Tautan foto profil dari Google                                   |
| `role`                      | `enum`               | `DEFAULT('pemohon')` | Hak akses: `pemohon`, `kesbangpol`, `brida`, `opd`, `superadmin` |
| `remember_token`            | `string(100)`        | `NULLABLE`           | Token untuk fitur "Remember Me" saat login                       |
| `created_at` / `updated_at` | `timestamps`         | `NULLABLE`           | Catatan waktu otomatis saat akun dibuat/diubah                   |

## 2. Tabel `pemohon`

Menyimpan profil detail pengguna yang mendaftar. Data ini wajib diisi dan diverifikasi oleh Kesbangpol sebelum pemohon dapat mengajukan permohonan izin.

| Nama Kolom                  | Tipe Data            | Constraints          | Keterangan                                                              |
| :-------------------------- | :------------------- | :------------------- | :---------------------------------------------------------------------- | --- |
| `id`                        | `unsignedBigInteger` | `PRIMARY KEY`        | ID unik profil pemohon                                                  |
| `user_id`                   | `unsignedBigInteger` | `FOREIGN KEY`        | Relasi ke tabel `users`                                                 |
| `nik`                       | `string(16)`         | `UNIQUE, NOT NULL`   | Nomor Induk Kependudukan / Paspor                                       |
| `no_hp`                     | `string(20)`         | `NOT NULL`           | Nomor telepon/WhatsApp aktif                                            |
| `kewarganegaraan`           | `string`             | `NOT NULL`           | Status WNI atau WNA                                                     |
| `instansi`                  | `string`             | `NOT NULL`           | Asal institusi (Universitas/Perusahaan)                                 |
| `nim_nip`                   | `string`             | `NULLABLE`           | Nomor Induk Mahasiswa atau NIP                                          |
| `provinsi`                  | `string`             | `NOT NULL`           | Nama Provinsi domisili pemohon                                          |
| `kota_kabupaten`            | `string`             | `NOT NULL`           | Nama Kabupaten atau Kota domisili                                       |
| `kecamatan`                 | `string`             | `NOT NULL`           | Nama Kecamatan domisili                                                 |
| `kelurahan_desa`            | `string`             | `NOT NULL`           | Nama Kelurahan atau Desa domisili                                       |
| `alamat`                    | `text`               | `NOT NULL`           | Detail jalan, nomor rumah, RT/RW, gang, dll.                            |
| `identitas`                 | `string`             | `NOT NULL`           | tempat file KTP/KTM/SIM yang diunggah                                   |
| `status_verifikasi`         | `enum`               | `DEFAULT('pending')` | Status dari Kesbangpol: `pending`, `terverifikasi`, `revisi`, `ditolak` |
| `catatan_verifikasi`        | `text`               | `NULLABLE`           | Pesan/alasan dari Kesbangpol jika data direvisi atau ditolak            |
| `created_at` / `updated_at` | `timestamps`         | `NULLABLE`           | Waktu profil dibuat dan terakhir diubah                                 |     |

## 3. Tabel `layanan`

Tabel referensi untuk pilihan jenis izin.

| Nama Kolom                  | Tipe Data            | Constraints   | Keterangan                                |
| :-------------------------- | :------------------- | :------------ | :---------------------------------------- |
| `id`                        | `unsignedBigInteger` | `PRIMARY KEY` | ID unik layanan                           |
| `nama_layanan`              | `string`             | `NOT NULL`    | Nama layanan (Izin Penelitian, Izin KKN)  |
| `slug_layanan`              | `string`             | `NOT NULL`    | URL ramah mesin pencari (izin-penelitian) |
| `logo`                      | `string`             | `NOT NULL`    | Path atau nama file gambar ikon layanan   |
| `deskripsi`                 | `text`               | `NULLABLE`    | Penjelasan singkat mengenai layanan       |
| `created_at` / `updated_at` | `timestamps`         | `NULLABLE`    | Catatan waktu pembuatan data layanan      |

## 4. Tabel `permohonan`

Tabel transaksi utama untuk mencatat "Isian Data Penelitian" dari form permohonan.

| Nama Kolom          | Tipe Data            | Constraints        | Keterangan                                                    |
| :------------------ | :------------------- | :----------------- | :------------------------------------------------------------ |
| `id`                | `unsignedBigInteger` | `PRIMARY KEY`      | ID unik permohonan izin                                       |
| `pemohon_id`        | `unsignedBigInteger` | `FOREIGN KEY`      | Relasi ke tabel `pemohon` (Siapa yang mengajukan)             |
| `jenis_layanan_id`  | `unsignedBigInteger` | `FOREIGN KEY`      | Relasi ke tabel `jenis_layanan`                               |
| `judul`             | `string`             | `NOT NULL`         | Judul Penelitian/Kegiatan                                     |
| `tujuan`            | `text`               | `NOT NULL`         | Tujuan dilakukan penelitian                                   |
| `lokasi`            | `string`             | `NOT NULL`         | Lokasi / Dinas / Objek tempat penelitian                      |
| `tgl_mulai`         | `date`               | `NOT NULL`         | Tanggal kegiatan dimulai                                      |
| `tgl_selesai`       | `date`               | `NOT NULL`         | Tanggal kegiatan berakhir                                     |
| `status_permohonan` | `enum`               | `DEFAULT('draft')` | Status: `draft`, `diajukan`, `revisi`, `disetujui`, `ditolak` |

## 4. Tabel `permohonan`

Tabel transaksi utama untuk mencatat "Isian Data Penelitian" dari form permohonan, mencakup alur verifikasi berjenjang hingga penerbitan surat ber-TTE.

| Nama Kolom                  | Tipe Data (Laravel)  | Constraints           | Keterangan                                                                           |
| :-------------------------- | :------------------- | :-------------------- | :----------------------------------------------------------------------------------- | --------------------------- |
| `id`                        | `unsignedBigInteger` | `PRIMARY KEY`         | ID unik permohonan izin                                                              |
| `pemohon_id`                | `unsignedBigInteger` | `FOREIGN KEY`         | Relasi ke tabel `pemohon` (Siapa yang mengajukan)                                    |
| `layanan_id`                | `unsignedBigInteger` | `FOREIGN KEY`         | Relasi ke tabel `layanan`                                                            |
| `judul`                     | `string`             | `NOT NULL`            | Judul Penelitian/Kegiatan                                                            |
| `tujuan`                    | `text`               | `NOT NULL`            | Tujuan dilakukan penelitian                                                          |
| `lokasi`                    | `string`             | `NOT NULL`            | Lokasi / Dinas / Objek tempat penelitian                                             |
| `tgl_mulai`                 | `date`               | `NOT NULL`            | Tanggal kegiatan dimulai                                                             |
| `tgl_selesai`               | `date`               | `NOT NULL`            | Tanggal kegiatan berakhir                                                            |
| `jenjang_pendidikan`        | `string`             | `NOT NULL`            | Pilihan S1/S2/S3/D3/D4/SMA/SMP                                                       |
| `bidang_penelitian`         | `string`             | `NOT NULL`            | Pilihan: Kesehatan, Lingkungan Hidup, Budaya, dll                                    |
| `rumpun_penelitian`         | `string`             | `NOT NULL`            | Pilihan: Ekonomi, Sosial Budaya, Hukum, dll                                          |
| `jenis_pengajuan'           | 'enum'               | 'DEFAULT('Personal')` | `NOT NULL`                                                                           | Pilihan: personal, kelompok |
| `jumlah_anggota'            | 'integer'            | 'DEFAULT(1)`          | NOT NULL                                                                             | jumlah anggota              |
| `nama_instansi_tujuan`      | `string`             | `NOT NULL`            | Nama instansi tempat penelitian dilakukan                                            |
| `alamat_instansi_tujuan`    | `text`               | `NOT NULL`            | Alamat lengkap instansi tujuan penelitian                                            |
| `status_permohonan`         | `enum`               | `DEFAULT('draft')`    | Status global: `draft`, `diajukan`, `proses_brida`, `revisi`, `disetujui`, `ditolak` |
| `status_kesbangpol`         | `enum`               | `DEFAULT('pending')`  | Status spesifik Kesbangpol: `pending`, `revisi`, `disetujui`, `ditolak`              |
| `catatan_kesbangpol`        | `text`               | `NULLABLE`            | Pesan/alasan dari Kesbangpol jika data direvisi atau ditolak                         |
| `status_brida`              | `enum`               | `DEFAULT('pending')`  | Status spesifik BRIDA: `pending`, `revisi`, `disetujui`, `ditolak`                   |
| `catatan_brida`             | `text`               | `NULLABLE`            | Pesan/alasan dari BRIDA jika data direvisi atau ditolak                              |
| `file_surat_izin`           | `string`             | `NULLABLE`            | Menyimpan _file_ dokumen PDF yang sudah memiliki TTE                                 |
| `qr_code`                   | `string`             | `NULLABLE`            | Menyimpan _link_ atau _hash_ QR Code pembuktian validitas izin                       |
| `created_at` / `updated_at` | `timestamps`         | `NULLABLE`            | Catatan waktu otomatis saat permohonan dibuat/diubah                                 |

## 6. Tabel `dokumen_syarat`

Menyimpan lampiran _file_ yang wajib diunggah (seperti KTP, Surat Pengantar Kampus, Proposal).

| Nama Kolom        | Tipe Data            | Constraints          | Keterangan                                          |
| :---------------- | :------------------- | :------------------- | :-------------------------------------------------- |
| `id`              | `unsignedBigInteger` | `PRIMARY KEY`        | ID unik dokumen                                     |
| `permohonan_id`   | `unsignedBigInteger` | `FOREIGN KEY`        | Relasi ke tabel `permohonan`                        |
| `jenis_dokumen`   | `string`             | `NOT NULL`           | Label dokumen (KTP, Proposal, Surat Pengantar)      |
| `tautan`          | `text`               | `NOT NULL`           | Tempat penyimpanan file                             |
| `status_validasi` | `enum`               | `DEFAULT('pending')` | Verifikasi admin: `pending`, `valid`, `tidak_valid` |
| `catatan_revisi`  | `text`               | `NULLABLE`           | Pesan dari verifikator jika dokumen ditolak/revisi  |

## 7. Tabel `laporan_akhir`

Menyimpan _file_ laporan kegiatan setelah masa penelitian atau KKN selesai, sesuai alur pelaporan.

| Nama Kolom           | Tipe Data            | Constraints          | Keterangan                                                 |
| :------------------- | :------------------- | :------------------- | :--------------------------------------------------------- |
| `id`                 | `unsignedBigInteger` | `PRIMARY KEY`        | ID unik laporan                                            |
| `permohonan_id`      | `unsignedBigInteger` | `FOREIGN KEY`        | Relasi ke tabel `permohonan`                               |
| `file_laporan`       | `string`             | `NOT NULL`           | Lokasi file PDF laporan yang diunggah                      |
| `tanggal_upload`     | `datetime`           | `NOT NULL`           | Waktu sistem saat user mengunggah laporan                  |
| `status_laporan`     | `enum`               | `DEFAULT('dikirim')` | Status verifikasi laporan: `dikirim`, `diterima`, `revisi` |
| `catatan_revisi`     | `text`               | `NULLABLE`           | Pesan dari verifikator jika laporan ditolak/revisi         |
| `file_surat_selesai` | `string`             | `NULLABLE`           | tempat file pdf surat selesai`                             |

---

## 8. Tabel pembimbing_permohonan

Diperlukan karena kolom penanggung jawab/pembimbing bisa di isi lebih dari 1 pembimbing.

| Nama Kolom        | Tipe Data            | Constraints   | Keterangan                                 |
| :---------------- | :------------------- | :------------ | :----------------------------------------- |
| `id`              | `unsignedBigInteger` | `PRIMARY KEY` | `ID unik`                                  |
| `permohonan_id`   | `unsignedBigInteger` | `FOREIGN KEY` | `Relasi ke tabel permohonan`               |
| `nama_pembimbing` | `string`             | `NOT NULL`    | `Nama lengkap penanggung jawab/pembimbing` |

---

## 9. Tabel tembusan_opd

Diperlukan karena alur mensyaratkan akan ada level OPD, dan ada tembusan.

| Nama Kolom      | Tipe Data            | Constraints      | Keterangan                                      |
| :-------------- | :------------------- | :--------------- | :---------------------------------------------- |
| `id`            | `unsignedBigInteger` | `PRIMARY KEY`    | `ID unik`                                       |
| `permohonan_id` | `unsignedBigInteger` | `FOREIGN KEY`    | `Relasi ke tabel permohonan`                    |
| `user_id        | `unsignedBigInteger` | `FOREIGN KEY`    | `Relasi ke tabel users (dengan role 'opd')`     |
| `is_read`       | `boolean`            | `DEFAULT(false)` | `Status apakah OPD sudah membaca/mengecek data` |

---

## 10. Tabel survei_kepuasan

Diperlukan karena pemohon diarahkan untuk mengisi SKM (survey kepuasan masyarakat).

| Nama Kolom      | Tipe Data            | Constraints   | Keterangan                   |
| :-------------- | :------------------- | :------------ | :--------------------------- |
| `id`            | `unsignedBigInteger` | `PRIMARY KEY` | `ID survei kepuasan`         |
| `permohonan_id` | `unsignedBigInteger` | `FOREIGN KEY` | `Relasi ke tabel permohonan` |
| `nilai`         | `interger`           | `NOT NULL`    | `Nilai rating`               |
| `ulasan`        | `text`               | `NULLABLE`    | `kritik saran`               |

## Pemetaan Relasi Antar Tabel (Database Relationships)

Berikut adalah daftar relasi kardinalitas antar tabel di dalam arsitektur database E-Litbang:

1. **`users` ↔ `pemohon` (One-to-One)**

   - Satu entitas akun _user_ hanya dapat memiliki tepat satu profil pemohon, dan sebaliknya.

2. **`pemohon` ↔ `permohonan` (One-to-Many)**

   - Satu pemohon dapat mengajukan banyak permohonan izin di waktu yang berbeda.

3. **`jenis_layanan` ↔ `permohonan` (One-to-Many)**

   - Satu kategori layanan dapat dimiliki/dipilih oleh banyak permohonan.

4. **`permohonan` ↔ `anggota_permohonan` (One-to-Many)**

   - Satu dokumen permohonan kelompok dapat menampung banyak data anggota (baris data akan bertambah ke bawah dinamis).

5. **`permohonan` ↔ `dokumen_syarat` (One-to-Many)**

   - Satu permohonan memiliki banyak lampiran syarat yang harus diunggah secara terpisah.

6. **`permohonan` ↔ `laporan_akhir` (One-to-One)**

   - Satu permohonan izin yang telah selesai hanya menghasilkan satu dokumen laporan akhir.

7. **`permohonan ↔ pembimbing_permohonan (One-to-Many)**

   - Satu permohonan bisa mendaftarkan lebih dari satu dosen pembimbing/penanggung jawab.

8. **`permohonan ↔ tembusan_opd (One-to-Many)**

   - Satu permohonan penelitian bisa ditembuskan ke banyak instansi/OPD sekaligus.

9. **`permohonan ↔ survei_kepuasan (One-to-One)**

   - Satu permohonan izin yang telah di-TTE hanya bisa mengisi satu kali survei kepuasan masyarakat.
