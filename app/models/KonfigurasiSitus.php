<?php

/**
 * Project: ehousing-3.0
 * Date: 6/11/16
 * Time: 14:06
 */
class KonfigurasiSitus extends EhousingModel
{

    const UPDATED_AT = 'modifydate';


    protected $table = 'konfigurasisitus';
    protected $primaryKey = 'KodeKonfSitus';
    protected $fillable = [
        'Nama','Deskripsi','Tagline','Alamat1','Alamat2','Alamat3','Logo','tentang_kami',
        'VisiMisi','StukturOrg','Email','KodeProvinsi','NamaGubernur',
        'NamaWakilGubernur','PeriodeJabatan','KelembagaanPerkim','LetakGeografis',
        'Kabupaten','Kota','NamaCP','NoTelpCP','EmailCP','TotalLuas','Daratan',
        'Lautan','Website','JumlahVisit','ibukota',
        'CreateUid','ModUid'
    ];

    public function provinsi()
    {
        return $this->belongsTo('Provinsi','KodeProvinsi');
    }

    public function kabupaten()
    {
        return $this->belongsTo('Kabupaten','Kabupaten');
    }

    public function kota()
    {
        return $this->belongsTo('Kota','Kota');
    }
}