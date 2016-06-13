<?php

/**
 * Project: ehousing-3.0
 * Date: 6/11/16
 * Time: 14:09
 */
class Provinsi extends EhousingModel implements \Cviebrock\EloquentSluggable\SluggableInterface
{
    use \Cviebrock\EloquentSluggable\SluggableTrait;

    protected $table = 'provinsi';
    protected $primaryKey = 'KodeProvinsi';
    protected $fillable = array(
        'KodeProvinsi',
        'NamaProvinsi'
    );
    protected $hidden = array(
        'CreateUid',
        'CreateDate',
        'ModUid',
        'ModDate',
        'ExpiryDate'
    );

    protected $appends = array('id');

    protected $sluggable = array(
        'build_from' => 'NamaProvinsi',
        'save_to'    => 'slug',
    );

    public function bantuanProgram()
    {
        return $this->hasMany('BantuanProgram','KodeProvinsi');
    }

    public function profil()
    {
        return $this->hasMany('ProfilProvinsi','KodeProv');
    }

    public function konfigurasiSitus()
    {
        return $this->hasOne('KonfigurasiSitus','KodeProvinsi');
    }

    public function getIdAttribute()
    {
        return (int) $this->KodeProvinsi;
    }

    public function scopeSlug($query, $slug)
    {
        return $query->where('slug', $slug);
    }

    public function scopeCode($query, $code)
    {
        return $query->where('KodeProvinsi', $code);
    }
}