<?php

/**
 * Project: ehousing-3.0
 * Date: 6/11/16
 * Time: 14:11
 */
class UserConfirmationLostPassword extends Eloquent
{
    protected $table = 'userconfirmationlostpassword';
    protected $primaryKey = 'ConfirmId';
    protected $fillable = [
        'UserId','UserEmail','ConfirmCode','ConfirmDateTime'
    ];

    public function user()
    {
        return $this->belongsTo('User','UserId');
    }
}