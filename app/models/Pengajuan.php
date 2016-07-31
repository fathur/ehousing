<?php

/**
 * Project: ehousing-3.0
 * Date: 6/11/16
 * Time: 14:09
 */
class Pengajuan extends Eloquent
{

    const UPDATED_AT = 'ModDate';
    const CREATED_AT = 'CreateDate';


    protected $table = 'pengajuan';
    protected $primaryKey = 'KodePengajuan';

    protected $appends = array('id');

    public function getIdAttribute()
    {
        return (int) $this->KodePengajuan;
    }
}