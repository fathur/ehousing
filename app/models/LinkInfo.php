<?php

/**
 * Project: ehousing-3.0
 * Date: 6/11/16
 * Time: 14:07
 */
class LinkInfo extends EhousingModel
{
    const IMB = 'IMB';
    const PBB = 'PBB';
    const TATA_RUANG = 'TR';
    const BPN = 'BPN';
    const MKM = 'MKM';

    protected $table = 'linkinfo';
    protected $primaryKey = 'LinkInfoId';
    protected $fillable = [
        'GrupLinkInfo','Judul','Deskripsi','LinkInfo','Region','KodeProvinsi','KodeKota',
        'CreateUid','ModUid','ExpiryDate'
    ];

    protected $appends = array('id');


    public function getIdAttribute()
    {
        return (int) $this->LinkInfoId;
    }

    public function provinsi()
    {
        return $this->belongsTo('Provinsi','KodeProvinsi');
    }

    public function kota()
    {
        return $this->belongsTo('Kota','KodeKota');
    }

    public function kecamatan()
    {
        return $this->belongsTo('Kecamatan','KodeKecamatan');
    }
}