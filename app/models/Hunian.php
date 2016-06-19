<?php

/**
 * Project: ehousing-3.0
 * Date: 6/11/16
 * Time: 14:05
 */
class Hunian extends EhousingModel implements \Cviebrock\EloquentSluggable\SluggableInterface
{
    use \Cviebrock\EloquentSluggable\SluggableTrait;

    const RUSUN_SEWA = 'RS';
    const RUSUNAMI = 'RN';
    const RUSUNAMI_SUBSIDI = 'RNS';
    const RUMAH_SUBSIDI = 'RMS';
    const CONDOTEL = 'CDT';
    const APERTEMEN = 'APT';
    const HOTEL = 'HTL';

    protected $table = 'hunian';
    protected $primaryKey = 'HunianId';
    protected $fillable = [
        'JenisHunian','NamaHunian','KodePengembang','Alamat','KodeKecamatan',
        'Koordinat','Pengelola','NoTelp','NoHP_PIC','Email','Website',
        'TahunPembangunan','TahunSelesai','JumlahUnit','JumlahLantai','LuasLahan',
        'TingkatHunian','KodeProvinsi','KodeKota','picture','Harga','Deskripsi',
        'StatusHunian','LinkExternal2','LinkExternal3','LinkExternal4','Tab2',
        'Tab3', 'Tab4','slug',
        'CreateUid','ModUid'
    ];

    protected $appends = array('id');

    protected $sluggable = array(
        'build_from' => 'NamaHunian',
        'save_to'    => 'slug',
    );

    public function getIdAttribute()
    {
        return (int) $this->HunianId;
    }

    public function galeriHunian()
    {
        return $this->hasMany('GaleriHunian','HunianId');
    }

    public function referensi()
    {
        return $this->belongsTo('Referensi','JenisHunian');
    }

    public function kontak()
    {
        return $this->belongsTo('Kontak','KodePengembang');
    }

    public function provinsi()
    {
        return $this->belongsTo('Provinsi','KodeProvinsi');
    }

    public function kota()
    {
        return $this->belongsTo('Kota','KodeKota');
    }

    public function kecamatan()
    {
        return $this->belongsTo('Kecamatan','KodeKecamatan');
    }

    public function scopeSlug($query, $slug)
    {
        return $query->where('slug', $slug);
    }
}