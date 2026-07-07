<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-09-22 00:11:03 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2020-09-22 08:08:36 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2020-09-22 09:12:32 --> 404 Page Not Found: admin/Korban_bencana/index
ERROR - 2020-09-22 09:12:38 --> 404 Page Not Found: admin/Rekapitulasi/index
ERROR - 2020-09-22 09:37:17 --> 404 Page Not Found: admin/Korban_bencana/index
ERROR - 2020-09-22 09:37:21 --> 404 Page Not Found: admin/Rekapitulasi/index
ERROR - 2020-09-22 10:19:29 --> 404 Page Not Found: Uploads/lapor
ERROR - 2020-09-22 10:19:39 --> 404 Page Not Found: Uploads/lapor
ERROR - 2020-09-22 10:20:02 --> 404 Page Not Found: Uploads/lapor
ERROR - 2020-09-22 10:20:03 --> 404 Page Not Found: Uploads/lapor
ERROR - 2020-09-22 10:20:07 --> 404 Page Not Found: Uploads/lapor
ERROR - 2020-09-22 10:20:09 --> 404 Page Not Found: Uploads/lapor
ERROR - 2020-09-22 10:21:28 --> 404 Page Not Found: admin/Peta_new/index
ERROR - 2020-09-22 10:21:35 --> 404 Page Not Found: admin/Peta_new/index
ERROR - 2020-09-22 10:22:01 --> 404 Page Not Found: admin/Rekapitulasi/index
ERROR - 2020-09-22 10:22:05 --> 404 Page Not Found: admin/Peta_new/index
ERROR - 2020-09-22 10:22:19 --> 404 Page Not Found: admin/Peta_new/index
ERROR - 2020-09-22 10:24:17 --> 404 Page Not Found: admin/Peta_new/index
ERROR - 2020-09-22 10:24:52 --> 404 Page Not Found: admin/Peta_new/index
ERROR - 2020-09-22 10:25:08 --> 404 Page Not Found: admin/Peta_new/index
ERROR - 2020-09-22 10:25:12 --> 404 Page Not Found: admin/Peta_new/index
ERROR - 2020-09-22 10:26:53 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /var/www/html/sukoharjo/bpbd/application/controllers/admin/Korban_bencana.php:20) /var/www/html/sukoharjo/bpbd/system/core/Common.php 570
ERROR - 2020-09-22 10:26:53 --> Severity: Error --> Call to undefined method Korban_bencana::Korban_bencana() /var/www/html/sukoharjo/bpbd/application/controllers/admin/Korban_bencana.php 20
ERROR - 2020-09-22 10:27:28 --> 404 Page Not Found: admin/Rekapitulasi/index
ERROR - 2020-09-22 15:44:50 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /var/www/html/sukoharjo/bpbd/application/controllers/admin/Korban_bencana.php:20) /var/www/html/sukoharjo/bpbd/system/core/Common.php 570
ERROR - 2020-09-22 15:44:50 --> Severity: Error --> Call to undefined method Korban_bencana::Korban_bencana() /var/www/html/sukoharjo/bpbd/application/controllers/admin/Korban_bencana.php 20
ERROR - 2020-09-22 15:45:48 --> Query error: Unknown column 'ref_kelurahan.kelurahan_id' in 'on clause' - Invalid query: SELECT `korban_bencana`.`id`, `korban_bencana`.`nik`, `korban_bencana`.`nama_lengkap`, `korban_bencana`.`id_kecamatan`, `ref_kecamatan`.`kecamatan_nama` as `kecamatan`, `korban_bencana`.`id_kelurahan`, `ref_kelurahan`.`kelurahan_nama` as `kelurahan`, `korban_bencana`.`rt`, `korban_bencana`.`rw`, `korban_bencana`.`image`, `korban_bencana`.`tanggal`
FROM `korban_bencana`
LEFT JOIN `ref_kecamatan` ON `ref_kecamatan`.`kecamatan_id` = `korban_bencana`.`id_kecamatan`
LEFT JOIN `ref_kelurahan` ON `ref_kelurahan`.`kelurahan_id` = `korban_bencana`.`id_kelurahan`
WHERE `korban_bencana`.`id_periode` = '1'
AND `korban_bencana`.`aktif` = '1'
AND `korban_bencana`.`dihapus_pada` IS NULL
ORDER BY `korban_bencana`.`id` DESC
ERROR - 2020-09-22 18:15:46 --> 404 Page Not Found: admin/Berita/select_kategori_berita
ERROR - 2020-09-22 18:16:26 --> 404 Page Not Found: admin/Berita/select_kategori_berita
ERROR - 2020-09-22 18:16:49 --> 404 Page Not Found: admin/Berita/select_kategori_berita
ERROR - 2020-09-22 18:22:53 --> 404 Page Not Found: admin/Berita/select_kategori_berita
ERROR - 2020-09-22 18:23:49 --> 404 Page Not Found: admin/Berita/select_kategori_berita
ERROR - 2020-09-22 21:22:06 --> 404 Page Not Found: admin/Berita/select_kategori_berita
