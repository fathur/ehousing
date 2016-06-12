<?php

/**
 * Project: ehousing-3.0
 * Date: 6/11/16
 * Time: 14:09
 */
class ProfilProvinsi extends Eloquent
{
    public static $fields = array(
        "TotalPenduduk" => 'Total Penduduk',
        "TotalPria" => 'Total Pria',
        "TotalWanita" => 'Tota lWanita',
        "PctPertumbuhanPenduduk" => 'Persentasi Pertumbuhan Penduduk',
        "KepadatanPenduduk" => 'Kepadatan Penduduk',
        "TotalPendudukMiskinKota" => 'Total Penduduk Miskin Kota',
        "TotalPendudukMiskinDesa" => 'Total Penduduk Miskin Desa',
        "TotalAPBDProv" => 'Total APBD Prov',
        "TotalPADProv" => 'Total PAD Prov',
        "PajakDaerah" => 'Pajak Daerah',
        "RetribusiDaerah" => 'Retribusi Daerah',
        "KekayaanDaerahYgDipisah" => 'Kekayaan Daerah Yang Dipisah',
        "BacklogRumah" => 'Backlog Rumah',
        "JumlahRT" => 'Jumlah Rumah Tangga',
        "AnggaranKemenpera" => 'Anggaran Kemenpera',
        "LainLainPADYgSah" => 'Lain-Lain PAD Yang Sah');

    protected $table = 'ProfilProvinsi';
    protected $primaryKey = 'KodeProfilProv';

    public function provinsi()
    {
        return $this->belongsTo('Provinsi','KodeProv');
    }
}