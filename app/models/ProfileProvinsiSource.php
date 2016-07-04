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

    public static $kinds = array(
        'apbd' => array(
            'name'  => 'Total APBD',
            'column' => 'TotalAPBDProv',
            'source_column' => 'total_apbd_prov'
        ),
        'pad' => array(
            'name'  => 'Total PAD',
            'column' => 'TotalPADProv',
            'source_column' => 'total_pad_prov'

        ),
        'pad-other' => array(
            'name'  => 'Lain-lain PAD yang Sah',
            'column' => 'LainLainPADYgSah',
            'source_column' => 'lain_lain_pad_yg_sah'

        ),
        'sum-penduduk' => array(
            'name'  => 'Total Penduduk',
            'column' => 'TotalPenduduk',
            'source_column' => 'total_penduduk'

        ),
        'sum-pria' => array(
            'name'  => 'Total Pria',
            'column' => 'TotalPria',
            'source_column' => 'total_pria'

        ),
        'sum-wanita' => array(
            'name'  => 'Total Wanita',
            'column' => 'TotalWanita',
            'source_column' => 'total_wanita'

        ),
        'pertumbuhan' => array(
            'name'  => 'Pct Pertumbuhan Penduduk',
            'column' => 'PctPertumbuhanPenduduk',
            'source_column' => 'pct_pertumbuhan_penduduk'

        ),
        'kepadatan' => array(
            'name'  => 'Kepadatan Penduduk',
            'column' => 'KepadatanPenduduk',
            'source_column' => 'kepadatan_penduduk'

        ),
        'miskin-kota' => array(
            'name'  => 'Total Penduduk Miskin (Kota)',
            'column' => 'TotalPendudukMiskinKota',
            'source_column' => 'total_penduduk_miskin_kota'

        ),
        'miskin-desa' => array(
            'name'  => 'Total Penduduk Miskin (Desa)',
            'column' => 'TotalPendudukMiskinDesa',
            'source_column' => 'total_penduduk_miskin_desa'

        ),
        'pajak' => array(
            'name'  => 'Pajak Daerah',
            'column' => 'PajakDaerah',
            'source_column' => 'pajak_daerah'

        ),
        'retribusi' => array(
            'name'  => 'Retribusi Daerah',
            'column' => 'RetribusiDaerah',
            'source_column' => 'retribusi_daerah'

        ),
        'kekayaan' => array(
            'name'  => 'Kekayaan Daerah yang Dipisah',
            'column' => 'KekayaanDaerahYgDipisah',
            'source_column' => 'kekayaan_daerah_yg_dipisah'

        ),
        'backlog' => array(
            'name'  => 'Backlog Rumah',
            'column' => 'BacklogRumah',
            'source_column' => 'backlog_rumah'

        ),
        'sum-rt' => array(
            'name'  => 'Jumlah RT',
            'column' => 'JumlahRT',
            'source_column' => 'jumlah_rt'

        ),
        'anggaran' => array(
            'name'  => 'Anggaran Kemenpera',
            'column' => 'AnggaranKemenpera',
            'source_column' => 'anggaran_kemenpera'

        ),
    );

    public function profilProvinsi()
    {
        return $this->belongsTo('ProfilProvinsi','profile_provinsi_id');
    }
}