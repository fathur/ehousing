<?php

/**
 * Project: ehousing-3.0
 * Date: 6/11/16
 * Time: 14:09
 */
class Post extends EhousingModel implements \Cviebrock\EloquentSluggable\SluggableInterface
{
    use \Cviebrock\EloquentSluggable\SluggableTrait;

    protected $table = 'post';
    protected $primaryKey = 'PostId';

    protected $fillable = array(
        'Judul','KategoriId','IsiPost','Foto','PostStatus',
        'ExpiryDate','PublishDate','ShareSocmed','JumlahVisit',
        'IzinKomentar','Region','KodeProvinsi',
        'CreateUid','ModUid'
    );

    protected $appends = array('id');

    protected $sluggable = array(
        'build_from' => 'Judul',
        'save_to'    => 'slug',
        'on_update'  => true,
    );


    public function getIdAttribute()
    {
        return (int) $this->PostId;
    }

    public function user()
    {
        return $this->belongsTo('User','CreateUid');
    }

    public function kategori()
    {
        return $this->belongsTo('Kategori','KategoriId');
    }

    public function provinsi()
    {
        return $this->belongsTo('Provinsi','KodeProvinsi');
    }

    public function scopeSlug($query, $slug)
    {
        return $query->where('slug', $slug);
    }
}