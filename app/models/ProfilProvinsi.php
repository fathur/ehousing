<?php

/**
 * Project: ehousing-3.0
 * Date: 6/11/16
 * Time: 14:09
 */
class ProfilProvinsi extends Eloquent
{
    protected $table = 'ProfilProvinsi';
    protected $primaryKey = 'KodeProfilProv';

    public function provinsi()
    {
        return $this->belongsTo('Provinsi','KodeProv');
    }
}