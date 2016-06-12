<?php

/**
 * Project: ehousing-3.0
 * Date: 6/11/16
 * Time: 14:05
 */
class GaleriHunian extends EhousingModel
{
    protected $table = 'galerihunian';
    protected $primaryKey = 'GaleriHunianId';
    protected $fillable = [
        'HunianId',
        'Foto'
    ];

    protected $hidden = [
        'CreateDate'
    ];

    public function hunian()
    {
        return $this->belongsTo('Hunian','HunianId');
    }
}