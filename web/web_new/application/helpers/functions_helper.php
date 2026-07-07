<?php

function get_cuaca($kode)
{
    $return = [];
    switch ($kode) {
        case '0':
            $return['ket'] = 'Cerah';
            $return['img'] = base_url('assets_frontend/cuaca/round/cerah-o.png');
            break;
        case '100':
            $return['ket'] = 'Cerah';
            $return['img'] = base_url('assets_frontend/cuaca/round/cerah-o.png');
            break;
        case '1':
            $return['ket'] = 'Cerah Berawan';
            $return['img'] = base_url('assets_frontend/cuaca/round/cerah-berawan-o.png');
            break;
        case '101':
            $return['ket'] = 'Cerah Berawan';
            $return['img'] = base_url('assets_frontend/cuaca/round/cerah-berawan-o.png');
            break;
        case '2':
            $return['ket'] = 'Cerah Berawan';
            $return['img'] = base_url('assets_frontend/cuaca/round/cerah-berawan-o.png');
            break;
        case '102':
            $return['ket'] = 'Cerah Berawan';
            $return['img'] = base_url('assets_frontend/cuaca/round/cerah-berawan-o.png');
            break;
        case '3':
            $return['ket'] = 'Berawan';
            $return['img'] = base_url('assets_frontend/cuaca/round/berawan-o.png');
            break;
        case '103':
            $return['ket'] = 'Berawan';
            $return['img'] = base_url('assets_frontend/cuaca/round/berawan-o.png');
            break;

        case '4':
            $return['ket'] = 'Berawan Tebal';
            $return['img'] = base_url('assets_frontend/cuaca/round/berawan-o.png');
            break;
        case '104':
            $return['ket'] = 'Berawan Tebal';
            $return['img'] = base_url('assets_frontend/cuaca/round/berawan-o.png');
            break;

        case '5':
            $return['ket'] = 'Udara Kabur';
            $return['img'] = base_url('assets_frontend/cuaca/round/udara-kabur-o.png');
            break;
        case '10':
            $return['ket'] = 'Asap';
            $return['img'] = base_url('assets_frontend/cuaca/round/asap-o.png');
            break;
        case '45':
            $return['ket'] = 'Kabut';
            $return['img'] = base_url('assets_frontend/cuaca/round/kabut-o.png');
            break;

        case '60':
            $return['ket'] = 'Hujan Ringan';
            $return['img'] = base_url('assets_frontend/cuaca/round/hujan-ringan-o.png');
            break;
        case '61':
            $return['ket'] = 'Hujan Sedang';
            $return['img'] = base_url('assets_frontend/cuaca/round/hujan-sedang-o.png');
            break;
        case '63':
            $return['ket'] = 'Hujan Lebat';
            $return['img'] = base_url('assets_frontend/cuaca/round/hujan-lebat-o.png');
            break;

        case '80':
            $return['ket'] = 'Hujan Lokal';
            $return['img'] = base_url('assets_frontend/cuaca/round/hujan-sedang-o.png');
            break;

        case '95':
            $return['ket'] = 'Hujan Petir';
            $return['img'] = base_url('assets_frontend/cuaca/round/hujan-petir-o.png');
            break;
        case '97':
            $return['ket'] = 'Hujan Petir';
            $return['img'] = base_url('assets_frontend/cuaca/round/hujan-petir-o.png');
            break;
        default:
            $return['ket'] = '';
            $return['img'] = '';
    }
    return $return;
}

function get_profil_website()
{
    $CI = &get_instance();
    $get = $CI->db->get('profil_website')->row();
    return $get;
}

function count_message()
{
    $CI = &get_instance();
    $count = $CI->db->select("COUNT(CASE WHEN `read`!='1' then 1 end) as belum_dibaca, COUNT(CASE WHEN created_balasan is null then 1 end) as belum_dibalas")->where('YEAR(created)', $CI->tahun)->get('tabel_lapor')->row();
    return $count;
}

function fadeIn($id)
{
    $hasil = $id % 2;
    if ($hasil == '0') {
        $data = 'fadeInRight';
    } else {
        $data = 'fadeInLeft';
    }
    return $data;
}

function tanggal_format($date = null)
{
    $result = '-';
    if (@$date) {
        $BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

        $tahun = substr($date, 0, 4);
        $bulan = substr($date, 5, 2);
        $tgl   = substr($date, 8, 2);
        $result = $tgl . " " . $BulanIndo[(int)$bulan - 1] . " " . $tahun;
    }
    return $result;
}

function get_website()
{
    $return = 0;
    $CI = &get_instance();
    $get = $CI->db->select('*')->where(['aktif' => '1', 'dihapus_pada is NULL'])->get('frontend_website')->row();
    $return = $get;

    return $return;
}

function get_sosmed()
{
    $return = 0;
    $CI = &get_instance();
    $get = $CI->db->select('*')->where(['dihapus_pada is NULL'])->get('frontend_sosmed')->row();
    $return = $get;

    return $return;
}

function slug($text)
{
    // replace non letter or digits by -
    $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
    // trim
    $text = trim($text, '-');
    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    // lowercase
    $text = strtolower($text);
    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);
    if (empty($text)) {
        return 'n-a';
    }
    return $text;
}

function generateRandomString($_length = null)
{
    if (@$_length && $_length > 5) {
        $length = $_length;
    } else {
        $length = 8;
    }
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function custom_id($id)
{
    $str = generateRandomString() . $id;
    return $str;
}

function real_id($str = null)
{
    $return = '';
    if (@$str) {
        $get = substr($str, 8);
        if ($get != '') {
            $return = $get;
        }
    }
    return $return;
}

function validateDate($date, $_format = NULL)
{
    $format = 'Y-m-d';
    if (@$_format) {
        $format = $_format;
    }
    $d = DateTime::createFromFormat($format, $date);
    // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
    return $d && $d->format($format) === $date;
}

function strToHex($string)
{
    $hex = '';
    for ($i = 0; $i < strlen($string); $i++) {
        $ord = ord($string[$i]);
        $hexCode = dechex($ord);
        $hex .= substr('0' . $hexCode, -2);
    }
    return $hex;
}

function hexToStr($hex)
{
    $string = '';
    for ($i = 0; $i < strlen($hex) - 1; $i += 2) {
        $string .= chr(hexdec($hex[$i] . $hex[$i + 1]));
    }
    return $string;
}

function replace_link_http($url)
{
    $output = preg_replace("#^[^:/.]*[:/]+#i", "", $url);
    return $output;
}

function check_field_exist($tb_name, $field)
{
    $CI = &get_instance();
    $get = $CI->db->query("SHOW COLUMNS FROM $tb_name LIKE '$field'")->row();
    if ($get == false) {
        $return = FALSE;
    } else {
        $return = TRUE;
    }
    return $return;
}

function get_kategori_berita()
{
    $CI = &get_instance();
    $get = $CI->db->select('a.id,a.nama_kategori_menu as kategori')->where("a.aktif='1'")->where("(a.id_menu_utama=3 AND a.id in (SELECT x.id_kategori_menu FROM menu x WHERE x.id_menu_utama=3))")->get('kategori_menu a')->result();
    return $get;
}

function get_page_ppid()
{
    $CI = &get_instance();
    $list_data = $CI->db->select('*')->from('page_ppid')->where('aktif', '1')->where('dihapus_pada', NULL)->order_by("id", "ASC")->get()->result();
    return  $list_data;
}

function get_kategori_ppid()
{
    $CI = &get_instance();
    $list_data = $CI->db->select('*')->from('kategori_ppid')->where('aktif', '1')->where('dihapus_pada', NULL)->order_by("id", "ASC")->get()->result();
    return  $list_data;
}

function get_menu_ppid()
{
    $CI = &get_instance();
    $list_data = $CI->db->select('menu.id, menu.judul')
        ->from('menu')
        ->where('menu.id_menu_utama', '9')
        ->where('menu.aktif', '1')
        ->where('menu.dihapus_pada', NULL)
        ->order_by("menu.id", "ASC")
        ->get()->result();
    return  $list_data;
}
