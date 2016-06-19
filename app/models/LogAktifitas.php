<?php

/**
 * Project: ehousing-3.0
 * Date: 6/11/16
 * Time: 14:07
 */
class LogAktifitas extends Eloquent
{
    protected $table = 'logaktifitas';
    protected $primaryKey = 'IdLog';
    protected $fillable = [
        'UserId','Aktifitas','Waktu',
        'CreateUid','ModUid'
    ];

    public function user()
    {
        return $this->belongsTo('User','UserId');
    }
}