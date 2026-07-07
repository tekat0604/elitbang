<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2021-09-07 06:36:38 --> 404 Page Not Found: Faviconico/index
ERROR - 2021-09-07 07:05:29 --> 404 Page Not Found: Robotstxt/index
ERROR - 2021-09-07 07:05:31 --> 404 Page Not Found: Adstxt/index
ERROR - 2021-09-07 09:33:47 --> 404 Page Not Found: Uploads/bpbd.apk
ERROR - 2021-09-07 09:58:04 --> 404 Page Not Found: Uploads/bpbd.apk
ERROR - 2021-09-07 10:05:28 --> Severity: Notice --> Undefined index: HTTP_REFERER /var/www/html/surakarta/bpbd/application/views/frontend/berita_v2/detail.php 43
ERROR - 2021-09-07 10:19:01 --> 404 Page Not Found: Uploads/bpbd.apk
ERROR - 2021-09-07 10:23:06 --> Severity: Notice --> Undefined index: HTTP_REFERER /var/www/html/surakarta/bpbd/application/views/frontend/berita_v2/detail.php 43
ERROR - 2021-09-07 10:36:23 --> 404 Page Not Found: Uploads/bpbd.apk
ERROR - 2021-09-07 10:36:55 --> 404 Page Not Found: Uploads/bpbd.apk
ERROR - 2021-09-07 11:12:40 --> 404 Page Not Found: Robotstxt/index
ERROR - 2021-09-07 13:13:57 --> 404 Page Not Found: Faviconico/index
ERROR - 2021-09-07 13:40:41 --> 404 Page Not Found: Faviconico/index
ERROR - 2021-09-07 13:50:31 --> 404 Page Not Found: Robotstxt/index
ERROR - 2021-09-07 14:02:31 --> 404 Page Not Found: Faviconico/index
ERROR - 2021-09-07 14:04:50 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 14:24:27 --> 404 Page Not Found: Uploads/bpbd.apk
ERROR - 2021-09-07 14:24:30 --> 404 Page Not Found: Uploads/bpbd.apk
ERROR - 2021-09-07 14:24:34 --> 404 Page Not Found: Uploads/bpbd.apk
ERROR - 2021-09-07 14:24:36 --> 404 Page Not Found: Uploads/bpbd.apk
ERROR - 2021-09-07 14:39:53 --> 404 Page Not Found: Faviconico/index
ERROR - 2021-09-07 14:45:08 --> 404 Page Not Found: Uploads/bpbd.apk
ERROR - 2021-09-07 14:45:10 --> 404 Page Not Found: Uploads/bpbd.apk
ERROR - 2021-09-07 14:45:11 --> 404 Page Not Found: Uploads/bpbd.apk
ERROR - 2021-09-07 14:45:11 --> 404 Page Not Found: Uploads/bpbd.apk
ERROR - 2021-09-07 14:45:11 --> 404 Page Not Found: Uploads/bpbd.apk
ERROR - 2021-09-07 14:45:11 --> 404 Page Not Found: Uploads/bpbd.apk
ERROR - 2021-09-07 14:45:11 --> 404 Page Not Found: Uploads/bpbd.apk
ERROR - 2021-09-07 14:45:12 --> 404 Page Not Found: Uploads/bpbd.apk
ERROR - 2021-09-07 14:45:12 --> 404 Page Not Found: Uploads/bpbd.apk
ERROR - 2021-09-07 14:45:12 --> 404 Page Not Found: Uploads/bpbd.apk
ERROR - 2021-09-07 14:51:16 --> 404 Page Not Found: admin/Ppid/select_kategori
ERROR - 2021-09-07 14:51:16 --> Query error: Table 'surakarta_bpbd.kategori_ppid' doesn't exist - Invalid query: SELECT `ppid`.`id`, `ppid`.`id_kategori`, `kategori_ppid`.`nama_kategori` as `kategori`, `ppid`.`judul`, `ppid`.`konten`, `ppid`.`image`, `ppid`.`tanggal`
FROM `ppid`
LEFT JOIN `kategori_ppid` ON `kategori_ppid`.`id` = `ppid`.`id_kategori`
WHERE `ppid`.`id_periode` = '2'
AND `ppid`.`aktif` = '1'
AND `ppid`.`dihapus_pada` IS NULL
ORDER BY `ppid`.`id` DESC
ERROR - 2021-09-07 14:51:16 --> 404 Page Not Found: admin/Ppid/select_kategori
ERROR - 2021-09-07 14:52:10 --> 404 Page Not Found: admin/Ppid/select_kategori
ERROR - 2021-09-07 14:52:39 --> 404 Page Not Found: admin/Ppid/select_kategori
ERROR - 2021-09-07 14:52:44 --> Query error: Table 'surakarta_bpbd.kategori_ppid' doesn't exist - Invalid query: SELECT `id`, `nama_kategori` AS `kategori`
FROM `kategori_ppid`
WHERE `aktif` = '1'
AND `dihapus_pada` IS NULL
ERROR - 2021-09-07 14:52:44 --> Query error: Table 'surakarta_bpbd.kategori_ppid' doesn't exist - Invalid query: SELECT `id`, `nama_kategori` AS `kategori`
FROM `kategori_ppid`
WHERE `aktif` = '1'
AND `dihapus_pada` IS NULL
ERROR - 2021-09-07 14:52:44 --> Query error: Table 'surakarta_bpbd.kategori_ppid' doesn't exist - Invalid query: SELECT `ppid`.`id`, `ppid`.`id_kategori`, `kategori_ppid`.`nama_kategori` as `kategori`, `ppid`.`judul`, `ppid`.`konten`, `ppid`.`image`, `ppid`.`tanggal`
FROM `ppid`
LEFT JOIN `kategori_ppid` ON `kategori_ppid`.`id` = `ppid`.`id_kategori`
WHERE `ppid`.`id_periode` = '2'
AND `ppid`.`aktif` = '1'
AND `ppid`.`dihapus_pada` IS NULL
ORDER BY `ppid`.`id` DESC
ERROR - 2021-09-07 14:52:49 --> Query error: Table 'surakarta_bpbd.kategori_ppid' doesn't exist - Invalid query: SELECT `id`, `nama_kategori` AS `kategori`
FROM `kategori_ppid`
WHERE `aktif` = '1'
AND `dihapus_pada` IS NULL
ERROR - 2021-09-07 14:53:45 --> Query error: Unknown column 'ppid.image' in 'field list' - Invalid query: SELECT `ppid`.`id`, `ppid`.`id_kategori`, `kategori_ppid`.`nama_kategori` as `kategori`, `ppid`.`judul`, `ppid`.`konten`, `ppid`.`image`, `ppid`.`tanggal`
FROM `ppid`
LEFT JOIN `kategori_ppid` ON `kategori_ppid`.`id` = `ppid`.`id_kategori`
WHERE `ppid`.`id_periode` = '2'
AND `ppid`.`aktif` = '1'
AND `ppid`.`dihapus_pada` IS NULL
ORDER BY `ppid`.`id` DESC
ERROR - 2021-09-07 14:53:50 --> Query error: Unknown column 'ppid.image' in 'field list' - Invalid query: SELECT `ppid`.`id`, `ppid`.`id_kategori`, `kategori_ppid`.`nama_kategori` as `kategori`, `ppid`.`judul`, `ppid`.`konten`, `ppid`.`image`, `ppid`.`tanggal`
FROM `ppid`
LEFT JOIN `kategori_ppid` ON `kategori_ppid`.`id` = `ppid`.`id_kategori`
WHERE `ppid`.`id_periode` = '2'
AND `ppid`.`aktif` = '1'
AND `ppid`.`dihapus_pada` IS NULL
ORDER BY `ppid`.`id` DESC
ERROR - 2021-09-07 15:00:11 --> 404 Page Not Found: Robotstxt/index
ERROR - 2021-09-07 15:03:07 --> Severity: Notice --> Undefined index: image /var/www/html/surakarta/bpbd/application/controllers/admin/Ppid.php 79
ERROR - 2021-09-07 15:03:07 --> Query error: Unknown column 'image' in 'field list' - Invalid query: INSERT INTO `ppid` (`id_kategori`, `id_periode`, `judul`, `konten`, `image`, `tanggal`, `aktif`) VALUES ('1', '2', 'ertreter', 'rtertert', '', '2021-09-07', '1')
ERROR - 2021-09-07 15:03:07 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /var/www/html/surakarta/bpbd/system/core/Exceptions.php:271) /var/www/html/surakarta/bpbd/system/core/Common.php 570
ERROR - 2021-09-07 15:03:19 --> Severity: Notice --> Undefined index: image /var/www/html/surakarta/bpbd/application/controllers/admin/Ppid.php 79
ERROR - 2021-09-07 15:03:19 --> Query error: Unknown column 'image' in 'field list' - Invalid query: INSERT INTO `ppid` (`id_kategori`, `id_periode`, `judul`, `konten`, `image`, `tanggal`, `aktif`) VALUES ('1', '2', 'ertreter', 'rtertert', '', '2021-09-07', '1')
ERROR - 2021-09-07 15:03:19 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /var/www/html/surakarta/bpbd/system/core/Exceptions.php:271) /var/www/html/surakarta/bpbd/system/core/Common.php 570
ERROR - 2021-09-07 15:03:48 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 15:22:14 --> Query error: Unknown column 'id_kategori' in 'field list' - Invalid query: UPDATE `menu` SET `id_kategori` = '1', `judul` = 'RKT Setda 2020', `konten` = 'dasfsa', `image` = '', `tanggal` = '2021-09-07', `diubah_pada` = '2021-09-07 15:22:14'
WHERE `id` = '1'
ERROR - 2021-09-07 15:22:25 --> Severity: Notice --> Undefined index: file /var/www/html/surakarta/bpbd/application/controllers/admin/Ppid.php 117
ERROR - 2021-09-07 15:22:25 --> Query error: Unknown column 'id_kategori' in 'field list' - Invalid query: UPDATE `menu` SET `id_kategori` = NULL, `judul` = NULL, `konten` = NULL, `image` = '', `tanggal` = '2021-09-07', `diubah_pada` = '2021-09-07 15:22:25'
WHERE `id` IS NULL
ERROR - 2021-09-07 15:22:25 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /var/www/html/surakarta/bpbd/system/core/Exceptions.php:271) /var/www/html/surakarta/bpbd/system/core/Common.php 570
ERROR - 2021-09-07 15:22:54 --> Query error: Unknown column 'image' in 'field list' - Invalid query: UPDATE `ppid` SET `id_kategori` = '1', `judul` = 'RKT Setda 2020', `konten` = 'dasfsa', `image` = '', `tanggal` = '2021-09-07', `diubah_pada` = '2021-09-07 15:22:54'
WHERE `id` = '1'
ERROR - 2021-09-07 15:24:02 --> 404 Page Not Found: Robotstxt/index
ERROR - 2021-09-07 15:24:03 --> 404 Page Not Found: Tugas_dan_fungsi/index
ERROR - 2021-09-07 15:29:35 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 15:33:16 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 15:36:05 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 15:39:58 --> 404 Page Not Found: admin/Kategori/index
ERROR - 2021-09-07 15:48:36 --> 404 Page Not Found: admin/Kategori/index
ERROR - 2021-09-07 15:48:39 --> 404 Page Not Found: admin/Kategori/index
ERROR - 2021-09-07 16:11:15 --> Query error: Unknown column 'kategori' in 'field list' - Invalid query: UPDATE `kategori_ppid` SET `kategori` = 'Informasi Wajib Berkala', `diubah_pada` = '2021-09-07 16:11:15'
WHERE `id` = '1'
ERROR - 2021-09-07 16:11:27 --> Query error: Unknown column 'kategori' in 'field list' - Invalid query: UPDATE `kategori_ppid` SET `kategori` = NULL, `diubah_pada` = '2021-09-07 16:11:27'
WHERE `id` IS NULL
ERROR - 2021-09-07 16:13:07 --> 404 Page Not Found: admin/Kategori/index
ERROR - 2021-09-07 16:40:07 --> 404 Page Not Found: Ppid/kategori
ERROR - 2021-09-07 16:40:48 --> 404 Page Not Found: Ppid/kategori
ERROR - 2021-09-07 16:47:03 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 16:47:03 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 16:49:17 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 16:49:17 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 17:01:24 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 17:01:24 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 17:21:06 --> 404 Page Not Found: Ppid/get_data
ERROR - 2021-09-07 17:21:22 --> 404 Page Not Found: Ppid/get_data
ERROR - 2021-09-07 17:21:28 --> 404 Page Not Found: Ppid/get_ppid
ERROR - 2021-09-07 17:21:29 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 17:21:30 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 17:25:44 --> 404 Page Not Found: Ppid/get_data
ERROR - 2021-09-07 17:34:01 --> 404 Page Not Found: Ppid/get_ppid
ERROR - 2021-09-07 17:34:01 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 17:34:03 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 17:35:25 --> 404 Page Not Found: Ppid/get_ppid
ERROR - 2021-09-07 17:37:05 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 17:37:07 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 17:37:10 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 17:37:12 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 17:41:53 --> Severity: error --> Exception: syntax error, unexpected '$this' (T_VARIABLE), expecting function (T_FUNCTION) or const (T_CONST) /var/www/html/surakarta/bpbd/application/controllers/Ppid.php 38
ERROR - 2021-09-07 17:41:55 --> Severity: error --> Exception: syntax error, unexpected '$this' (T_VARIABLE), expecting function (T_FUNCTION) or const (T_CONST) /var/www/html/surakarta/bpbd/application/controllers/Ppid.php 38
ERROR - 2021-09-07 17:42:24 --> Severity: error --> Exception: syntax error, unexpected '$this' (T_VARIABLE), expecting function (T_FUNCTION) or const (T_CONST) /var/www/html/surakarta/bpbd/application/controllers/Ppid.php 38
ERROR - 2021-09-07 17:43:07 --> Severity: error --> Exception: syntax error, unexpected '$this' (T_VARIABLE), expecting function (T_FUNCTION) or const (T_CONST) /var/www/html/surakarta/bpbd/application/controllers/Ppid.php 38
ERROR - 2021-09-07 17:44:56 --> Severity: error --> Exception: syntax error, unexpected '$this' (T_VARIABLE), expecting function (T_FUNCTION) or const (T_CONST) /var/www/html/surakarta/bpbd/application/controllers/Ppid.php 38
ERROR - 2021-09-07 17:45:53 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 17:45:53 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 17:46:15 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 17:46:15 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 17:46:17 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 17:46:18 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 17:46:20 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 17:46:20 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 17:46:50 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 17:46:50 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 17:46:52 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 17:46:52 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 17:46:55 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 17:46:55 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 17:53:58 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 17:53:59 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 17:56:50 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 17:56:50 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 17:56:55 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 17:56:56 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 17:56:59 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 17:56:59 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 17:57:01 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 17:57:02 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 18:43:32 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 18:43:32 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 18:47:55 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 18:47:55 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 18:48:03 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 18:48:03 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 19:19:35 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 19:19:35 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 19:19:38 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 19:19:39 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 19:19:42 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 19:19:42 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 19:19:45 --> 404 Page Not Found: Faviconico/index
ERROR - 2021-09-07 20:14:31 --> 404 Page Not Found: Robotstxt/index
ERROR - 2021-09-07 20:41:43 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 20:41:43 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 20:45:59 --> 404 Page Not Found: Robotstxt/index
ERROR - 2021-09-07 20:47:59 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 20:47:59 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 20:48:04 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 20:48:04 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 22:52:06 --> Severity: Notice --> Undefined index: image /var/www/html/surakarta/bpbd/application/controllers/Lapor.php 92
ERROR - 2021-09-07 22:52:06 --> Severity: Notice --> Undefined offset: 1 /var/www/html/surakarta/bpbd/application/controllers/Lapor.php 109
ERROR - 2021-09-07 23:01:18 --> 404 Page Not Found: Ppid/detail
ERROR - 2021-09-07 23:11:19 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 23:11:19 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 23:12:19 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 23:12:19 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 23:12:47 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 23:12:47 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 23:15:37 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 23:15:37 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 23:15:40 --> 404 Page Not Found: Faviconico/index
ERROR - 2021-09-07 23:17:31 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 23:17:31 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 23:54:11 --> 404 Page Not Found: Assets_frontend/assets
ERROR - 2021-09-07 23:54:11 --> 404 Page Not Found: Assets_frontend/assets
