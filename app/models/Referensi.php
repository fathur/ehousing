<?php

/**
 * Project: ehousing-3.0
 * Date: 6/11/16
 * Time: 14:10
 */
class Referensi extends EhousingModel
{
    const JENIS_HUNIAN = 'JHN';
    const JENIS_KONTAK = 'CON';
    const JENIS_LINK_INFO = 'GL0';

    protected $table = 'referensi';
    protected $primaryKey = 'KodeRef';

    public function hunian()
    {
        return $this->hasMany('Hunian','JenisHunian');
    }

    public function berkas()
    {
        return $this->hasMany('Berkas', 'categoryfile');
    }
}