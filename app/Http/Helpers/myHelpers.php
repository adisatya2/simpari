<?php

use App\Models\IadpDetail;
use App\Models\IadpHeader;
use App\Models\IdoPostOperasi;
use App\Models\IskDetail;
use App\Models\IskHeader;
use App\Models\PhlebitisDetail;
use App\Models\PhlebitisHeader;
use App\Models\VapDetail;
use App\Models\VapHeader;

function format_uang_rp($angka)
{
    return "Rp " . number_format($angka, 0, ',', '.') . ",-";
}

function format_angka($angka)
{
    return number_format($angka, 0, ',', '.');
}

function penyebut($nilai)
{
    $nilai = abs($nilai);
    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($nilai < 12) {
        $temp = " " . $huruf[$nilai];
    } else if ($nilai < 20) {
        $temp = penyebut($nilai - 10) . " belas";
    } else if ($nilai < 100) {
        $temp = penyebut($nilai / 10) . " puluh" . penyebut($nilai % 10);
    } else if ($nilai < 200) {
        $temp = " seratus" . penyebut($nilai - 100);
    } else if ($nilai < 1000) {
        $temp = penyebut($nilai / 100) . " ratus" . penyebut($nilai % 100);
    } else if ($nilai < 2000) {
        $temp = " seribu" . penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
        $temp = penyebut($nilai / 1000) . " ribu" . penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
        $temp = penyebut($nilai / 1000000) . " juta" . penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
        $temp = penyebut($nilai / 1000000000) . " milyar" . penyebut(fmod($nilai, 1000000000));
    } else if ($nilai < 1000000000000000) {
        $temp = penyebut($nilai / 1000000000000) . " trilyun" . penyebut(fmod($nilai, 1000000000000));
    }
    return $temp;
}

function terbilang($nilai)
{
    if ($nilai < 0) {
        $hasil = "minus " . trim(penyebut($nilai));
    } else {
        $hasil = trim(penyebut($nilai));
    }
    return $hasil;
}

function tanggal_indonesia($tgl, $tampil_hari = true)
{
    $nama_hari = array(
        'Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu',
    );
    $nama_bulan = array(
        1 =>
        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember',
    );

    $tahun = substr($tgl, 0, 4);
    $bulan = $nama_bulan[(int) substr($tgl, 5, 2)];
    $tanggal = substr($tgl, 8, 2);
    $text = '';

    if ($tampil_hari) {
        $urutan_hari = date('w', mktime(0, 0, 0, substr($tgl, 5, 2), $tanggal, $tahun));
        $hari = $nama_hari[$urutan_hari];
        $text .= "$hari, $tanggal $bulan $tahun";
    } else {
        $text .= "$tanggal $bulan $tahun";
    }

    return $text;
}

function hitung_umur($tanggal_lahir, $tahun = true, $bulan = true, $hari = true)
{
    $birthDate = new DateTime($tanggal_lahir);
    $today = new DateTime("today");
    if ($birthDate > $today) {
        exit("0 tahun 0 bulan 0 hari");
    }
    $y = $today->diff($birthDate)->y;
    $m = $today->diff($birthDate)->m;
    $d = $today->diff($birthDate)->d;
    $result = '';
    if ($tahun) {
        $result .= $y . " tahun";
    }
    if ($bulan) {
        $result .= " " . $m . " bulan";
    }
    if ($hari) {
        $result .= " " . $d . " hari";
    }
    //return $y . " tahun " . $m . " bulan " . $d . " hari";
    return $result;
}

function hitung_umur2($tanggal_lahir, $tanggal_batas, $tahun = true, $bulan = true, $hari = true)
{
    $birthDate = new DateTime($tanggal_lahir);
    $batas = new DateTime($tanggal_batas);
    if ($birthDate > $batas) {
        exit("0 tahun 0 bulan 0 hari");
    }
    $y = $batas->diff($birthDate)->y;
    $m = $batas->diff($birthDate)->m;
    $d = $batas->diff($birthDate)->d;
    $result = '';
    if ($tahun) {
        $result .= $y . " tahun";
    }
    if ($bulan) {
        $result .= " " . $m . " bulan";
    }
    if ($hari) {
        $result .= " " . $d . " hari";
    }
    //return $y . " tahun " . $m . " bulan " . $d . " hari";
    return $result;
}

function selisih_hari($tgl1, $tgl2)
{
    $tanggal1 = new DateTime($tgl1);
    $tanggal2 = new DateTime($tgl2);
    $selisih = $tanggal2->diff($tanggal1)->d;

    return $selisih;
}

function tambah_nol_didepan($value, $threshold = null)
{
    return sprintf("%0" . $threshold . "s", $value);
}

function max_phlebitis_header($noreg)
{
    $max = PhlebitisHeader::with(['detail_list'])->where('no_registrasi', '=', $noreg)->max('pemasangan_ke');

    return $max + 1;
}

function max_phlebitis_detail($id)
{
    $max = PhlebitisDetail::where('id_header', '=', $id)->max('observasi_ke');

    return $max + 1;
}

function max_isk_header($noreg)
{
    $max = IskHeader::where('no_registrasi', '=', $noreg)->max('pemasangan_ke');

    return $max + 1;
}

function max_isk_detail($id)
{
    $max = IskDetail::where('id_header', '=', $id)->max('observasi_ke');

    return $max + 1;
}

function max_iadp_header($noreg)
{
    $max = IadpHeader::where('no_registrasi', '=', $noreg)->max('pemasangan_ke');

    return $max + 1;
}

function max_iadp_detail($id)
{
    $max = IadpDetail::where('id_header', '=', $id)->max('observasi_ke');

    return $max + 1;
}

function max_vap_header($noreg)
{
    $max = VapHeader::where('no_registrasi', '=', $noreg)->max('pemasangan_ke');

    return $max + 1;
}

function max_vap_detail($id)
{
    $max = VapDetail::where('id_header', '=', $id)->max('observasi_ke');

    return $max + 1;
}

function max_ido_detail($id)
{
    $max = IdoPostOperasi::where('id_header', '=', $id)->max('observasi_ke');

    return $max + 1;
}
