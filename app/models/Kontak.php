<?php

/**
 * Project: ehousing-3.0
 * Date: 6/11/16
 * Time: 14:06
 */
class Kontak extends EhousingModel implements \Cviebrock\EloquentSluggable\SluggableInterface
{
    use \Cviebrock\EloquentSluggable\SluggableTrait;

    const DEVELOPER = 'dev';
    const KONTRAKTOR = 'kon';
    const SUPPLIER = 'sup';
    const TUKANG = 'tuk';
    const ARSITEK = 'ars';

    protected $table = 'kontak';
    protected $primaryKey = 'KontakId';
    protected $fillable = [
        'JenisKontak','Nama','Deskripsi','Alamat','KodeKecamatan','NoTelp','NoHP',
        'Email','Website','IsCorporate','Kompetensi','IsActive','Image','Picture',
        'KodeProvinsi','KodeKota','TglRegistrasi','TglVerifikasi','Status','slug',
        'CreateUid','ModUid'
    ];

    protected $appends = array('id');

    protected $sluggable = array(
        'build_from' => 'Nama',
        'save_to'    => 'slug',
    );

    public function getIdAttribute()
    {
        return (int) $this->KontakId;
    }

    public function provinsi()
    {
        return $this->belongsTo('Provinsi','KodeProvinsi');
    }

    public function kecamatan()
    {
        return $this->belongsTo('Kecamatan','KodeKecamatan');
    }

    public function kota()
    {
        return $this->belongsTo('Kota','KodeKota');
    }

    public function hunian()
    {
        return $this->hasMany('Hunian', 'KodePengembang');
    }

    public function scopeSlug($query, $slug)
    {
        return $query->where('slug', $slug);
    }
}