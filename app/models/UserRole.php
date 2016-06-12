<?php

/**
 * Project: ehousing-3.0
 * Date: 6/11/16
 * Time: 14:11
 */
class UserRole extends EhousingModel
{
    protected $table = 'userrole';
    protected $primaryKey = 'RoleId';
    protected $fillable = ['Nama'];

    public function module()
    {
        return $this->belongsToMany('Module','userpermission');

    }
}