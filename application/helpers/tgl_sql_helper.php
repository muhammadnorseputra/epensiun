<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

// daftar bulan indonesia
function bulanIndo() {
    $BulanIndo = array(
        '01' => 'Januari',
        '02' => 'Februari',
        '03' => 'Maret',
        '04' => 'April',
        '05' => 'Mei',
        '06' => 'Juni',
        '07' => 'Juli',
        '08' => 'Agustus',
        '09' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember'
    );
    return $BulanIndo;
}

//membuat format tanggal Indonesia
function TanggalIndo($date) {
    $BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

    $tahun = substr($date, 0, 4);
    $bulan = substr($date, 5, 2);
    $tgl = substr($date, 8, 2);

    $result = $tgl . " " . $BulanIndo[(int) $bulan - 1] . " " . $tahun;
    return($result);
}

//Iki helper bulan indo to SQL
function bulanindoSQL($month) {

    $indo_month = array(
        '01' => 'Januari',
        '02' => 'Februari',
        '03' => 'Maret',
        '04' => 'April',
        '05' => 'Mei',
        '06' => 'Juni',
        '07' => 'Juli',
        '08' => 'Agustus',
        '09' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember'
    );

    //return $indo_month[$month];
    return array_search($month, $indo_month);
}

//Iki helper import data gae konvert format (TGL indo 24 Januari 2014 > SQL YYYY-MM-DD)
function indoSQL($date) {
    $hari = substr($date, 0, 2);
    //$bulan = substr($date, 3, -4);
    $tahun = substr($date, -4);

    $Array_bulan = explode(" ", $date);
    $bulan = ucwords(strtolower($Array_bulan[1]));

    return $tahun . '-' . bulanindoSQL($bulan) . '-' . $hari;
}

function formatToSQL($tanggal_awal) {
    $tanggal_terformat = DateTime::createFromFormat("d/m/Y", $tanggal_awal)->format("Y-m-d");
    return $tanggal_terformat;
}

function formatToSQLDateTime($tanggal_awal) {
    // Memformat tanggal
    $tanggal_terformat = DateTime::createFromFormat("d/m/Y H.i", $tanggal_awal)->format("Y-m-d H:i:s");
    return $tanggal_terformat;
}