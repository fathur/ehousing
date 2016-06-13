<?php

/**
 * Project: ehousing-3.0
 * Date: 6/11/16
 * Time: 14:05
 */
class Berkas extends EhousingModel
{
    const KEBIJAKAN = 'PK';
    const PENELITIAN = 'HPK';
    const INFORMASI = 'INF';
    const STANDAR_HARGA_MATERIAL = 'SHM';

    const UPDATED_AT = 'modifieddate';

    protected $table = 'file';
    protected $primaryKey = 'fileid';
    protected $fillable = [
        'filename','url','file_size','description','categoryfile','publisheddate',
        'module','refkey','fileext','filecontent','downloadcounter','sharecounter',
        'raw_name','KodeProvinsi','Judul',
    ];

    protected $appends = array('id');

    public function getIdAttribute()
    {
        return (int) $this->fileid;
    }

    public function provinsi()
    {
        return $this->belongsTo('Provinsi','KodeProvinsi');
    }

    public function referensi()
    {
        return $this->belongsTo('Referensi','categoryfile');
    }
}