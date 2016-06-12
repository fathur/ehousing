<?php

/**
 * Project: ehousing-3.0
 * Date: 6/11/16
 * Time: 14:07
 */
class LinkInfo extends EhousingModel
{
    protected $table = 'linkinfo';
    protected $primaryKey = 'LinkInfoId';
    protected $fillable = [
        'GroupLinkInfo','Judul','Deskripsi','LinkInfo','Region','KodeProvinsi'
    ];

    public function provinsi()
    {
        return $this->belongsTo('Provinsi','KodeProvinsi');
    }
}