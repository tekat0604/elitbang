<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-10-03 08:59:52 --> 404 Page Not Found: admin/Rekapitulasi/index
ERROR - 2020-10-03 11:51:03 --> Query error: Unknown column 'tabel_lapor.deleted_at' in 'where clause' - Invalid query: SELECT `ref_kategori_bencana`.`id` AS `id_kategori`, `ref_kategori_bencana`.`nama_kategori_bencana` AS `kategori`, (select count(*) from korban_bencana 
        where id_kategori=ref_kategori_bencana.id AND tabel_lapor.deleted_at is NULL  
        GROUP BY id_kategori) AS total_laporan
FROM `ref_kategori_bencana`
WHERE `ref_kategori_bencana`.`aktif` = '1'
AND `ref_kategori_bencana`.`dihapus_pada` is NULL
ERROR - 2020-10-03 11:51:03 --> Query error: Unknown column 'tabel_lapor.deleted_at' in 'where clause' - Invalid query: SELECT `ref_kategori_bencana`.`id` AS `id_kategori`, `ref_kategori_bencana`.`nama_kategori_bencana` AS `kategori`, (select count(*) from korban_bencana 
        where id_kategori=ref_kategori_bencana.id AND tabel_lapor.deleted_at is NULL  
        GROUP BY id_kategori) AS total_laporan
FROM `ref_kategori_bencana`
WHERE `ref_kategori_bencana`.`aktif` = '1'
AND `ref_kategori_bencana`.`dihapus_pada` is NULL
ERROR - 2020-10-03 11:53:43 --> Query error: Unknown column 'korban_bencana.deleted_at' in 'where clause' - Invalid query: SELECT `ref_kategori_bencana`.`id` AS `id_kategori`, `ref_kategori_bencana`.`nama_kategori_bencana` AS `kategori`, (select count(*) from korban_bencana 
        where id_kategori=ref_kategori_bencana.id AND korban_bencana.deleted_at is NULL  
        GROUP BY id_kategori) AS total_laporan
FROM `ref_kategori_bencana`
WHERE `ref_kategori_bencana`.`aktif` = '1'
AND `ref_kategori_bencana`.`dihapus_pada` is NULL
ERROR - 2020-10-03 11:53:43 --> Query error: Unknown column 'korban_bencana.deleted_at' in 'where clause' - Invalid query: SELECT `ref_kategori_bencana`.`id` AS `id_kategori`, `ref_kategori_bencana`.`nama_kategori_bencana` AS `kategori`, (select count(*) from korban_bencana 
        where id_kategori=ref_kategori_bencana.id AND korban_bencana.deleted_at is NULL  
        GROUP BY id_kategori) AS total_laporan
FROM `ref_kategori_bencana`
WHERE `ref_kategori_bencana`.`aktif` = '1'
AND `ref_kategori_bencana`.`dihapus_pada` is NULL
