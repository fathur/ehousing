<?php

/**
 * Project: ehousing-3.0
 * Date: 6/11/16
 * Time: 14:05
 */
class HunianDetail extends Eloquent
{
    protected $primaryKey = 'HunianDetailId';
    protected $table = 'HunianDetail';
    protected $fillable = [
        'HunianId','Realisasi','Rencana','Bulan','Tahun','KodeProvinsi','KontakId',
        'CreateUid','ModUid'
    ];

    public function provinsi()
    {
        return $this->belongsTo('Provinsi','KodeProvinsi');
    }

    public function kontak()
    {
        return $this->belongsTo('Kontak','KontakId');
    }
}