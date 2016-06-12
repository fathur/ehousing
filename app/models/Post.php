<?php

/**
 * Project: ehousing-3.0
 * Date: 6/11/16
 * Time: 14:09
 */
class Post extends EhousingModel
{
    protected $table = 'post';
    protected $primaryKey = 'PostId';

    protected $appends = ['id'];


    public function getIdAttribute()
    {
        return (int) $this->PostId;
    }
}