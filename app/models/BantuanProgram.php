<?php

/**
 * Project: ehousing-3.0
 * Date: 6/11/16
 * Time: 14:04
 */
class BantuanProgram extends EhousingModel
{
    protected $table = 'bantuanprogram';
    protected $primaryKey = 'ProgramId';
    protected $fillable = [
        'JenisProgram',
        'Nama',
        'Deskripsi',
        'Lampiran',
        'KodeProvinsi',
        'CreateUid','ModUid'
    ];

    public function provinsi()
    {
        return $this->belongsTo('Provinsi','KodeProvinsi');
    }
}