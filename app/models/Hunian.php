<?php

/**
 * Project: ehousing-3.0
 * Date: 6/11/16
 * Time: 14:05
 */
class Hunian extends EhousingModel
{
    protected $table = 'hunian';
    protected $primaryKey = 'HunianId';
    protected $fillable = [
        'JenisHunian','NamaHunian','KodePengembang','Alamat','KodeKecamatan',
        'Koordinat','Pengelola','NoTelp','NoHP_PIC','Email','Website',
        'TahunPembangunan','TahunSelesai','JumlahUnit','JumlahLantai','LuasLahan',
        'TingkatHunian','KodeProvinsi','KodeKota','picture','Harga','Deskripsi',
        'StatusHunian','LinkExternal2','LinkExternal3','LinkExternal4','Tab2',
        'Tab3', 'Tab4'
    ];

    protected $appends = array('id');

    public function getIdAttribute()
    {
        return (int) $this->HunianId;
    }

    public function galeriHunian()
    {
        return $this->hasMany('GaleriHunian','HunianId');
    }

    public function referensi()
    {
        return $this->belongsTo('Referensi','JenisHunian');
    }
}