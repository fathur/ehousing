<?php

/**
 * Project: ehousing-3.0
 * Date: 6/11/16
 * Time: 14:06
 */
class Kecamatan extends EhousingModel
{
    protected $table ='kecamatan';
    protected $primaryKey = 'KodeKecamatan';
    protected $fillable = [
        'KodeKota','NamaKecamatan'
    ];

    public function kota()
    {
        return $this->belongsTo('Kota','KodeKota');
    }
}