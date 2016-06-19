<?php

/**
 * Project: ehousing-3.0
 * Date: 6/11/16
 * Time: 14:06
 */
class Kategori extends EhousingModel
{
    protected $table = 'kategori';
    protected $primaryKey = 'KategoriId';
    protected $fillable = [
        'NamaKategori','ExpiryDate',
        'CreateUid','ModUid'
    ];

    protected $appends = array('id');

    public function getIdAttribute()
    {
        return (int) $this->KategoriId;
    }
}