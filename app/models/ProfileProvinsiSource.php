<?php

/**
 * Project: ehousing-3.0
 * Date: 7/4/16
 * Time: 23:31
 */
class ProfileProvinsiSource extends Eloquent
{

    protected $fillable = array('total_apbd_prov','total_pad_prov','lain_lain_pad_yg_sah','total_penduduk','total_pria',
        'total_wanita','pct_pertumbuhan_penduduk','kepadatan_penduduk','total_penduduk_miskin_kota',
        'total_penduduk_miskin_desa','pajak_daerah','retribusi_daerah','kekayaan_daerah_yg_dipisah','backlog_rumah',
        'jumlah_rt','anggaran_kemenpera');

    public function profilProvinsi()
    {
        return $this->belongsTo('ProfilProvinsi','profile_provinsi_id');
    }
}