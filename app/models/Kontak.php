<?php

/**
 * Project: ehousing-3.0
 * Date: 6/11/16
 * Time: 14:06
 */
class Kontak extends EhousingModel
{
    protected $table = 'kontak';
    protected $primaryKey = 'KontakId';
    protected $fillable = [
        'JenisKontak','Nama','Deskripsi','Alamat','KodeKecamatan','NoTelp','NoHP',
        'Email','Website','IsCorporate','Kompetensi','IsActive','Image','Picture',
        'KodeProvinsi','KodeKota','TglRegistrasi','TglVerifikasi','Status'
    ];

    public function provinsi()
    {
        return $this->belongsTo('Provinsi','KodeProvinsi');
    }

    public function kecamatan()
    {
        return $this->belongsTo('Kecamatan','KodeKecamatan');
    }

    public function kota()
    {
        return $this->belongsTo('Kota','KodeKota');
    }
}