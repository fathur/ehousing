<?php

/**
 * Project: ehousing-3.0
 * Date: 6/11/16
 * Time: 14:08
 */
class Module extends EhousingModel
{
    protected $table = 'module';
    protected $primaryKey = 'ModuleId';
    protected $fillable = ['KodeProvinsi'];

    public function provinsi()
    {
        return $this->belongsTo('Provinsi','KodeProvinsi');
    }

    public function userPermission()
    {
        return $this->belongsToMany('UserRole','userpermission');
    }
}