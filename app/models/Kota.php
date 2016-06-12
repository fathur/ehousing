<?php

/**
 * Project: ehousing-3.0
 * Date: 6/11/16
 * Time: 14:07
 */
class Kota extends EhousingModel
{
    protected $table = 'kota';
    protected $primaryKey = 'KodeKota';
    protected $fillable = [
        'KodeProvinsi','NamaKota'
    ];

    public function provinsi()
    {
        return $this->belongsTo('Provinsi','KodeProvinsi');
    }
}