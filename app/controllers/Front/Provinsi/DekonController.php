<?php
/**
 * Created by PhpStorm.
 * User: akung
 * Date: 8/18/16
 * Time: 21:05
 */

namespace Front\Provinsi;


use BackOffice\AdminController;

class DekonController extends \BaseController
{
    public function provinsi()
    {
        $data = array(
            'administratif' => array(
                array(
                    'no' => 1,
                    'title' => 'Luas Wilayah',
                    'jumlah' => '...',
                    'satuan' => 'Ha',
                    'sumber' => '...'
                ),
                array(
                    'no' => 2,
                    'title' => 'Luas Wilayah Permukiman',
                    'jumlah' => '...',
                    'satuan' => 'Ha',
                    'sumber' => '...'
                ),
                array(
                    'no' => 3,
                    'title' => 'Persentase Luas Wilayah Permukiman terhadap Luas Wilayah (%)',
                    'jumlah' => '...',
                    'satuan' => '%',
                    'sumber' => '...'
                ),
                array(
                    'no' => 4,
                    'title' => 'Luas Lahan Rawan Bencana',
                    'jumlah' => '...',
                    'satuan' => 'Ha',
                    'sumber' => '...'
                ),
                array(
                    'no' => 5,
                    'title' => 'Jumlah Penduduk',
                    'jumlah' => '...',
                    'satuan' => 'Jiwa',
                    'sumber' => '...'
                ),
                array(
                    'no' => 6,
                    'title' => 'Jumlah Rumah Tangga',
                    'jumlah' => '...',
                    'satuan' => 'RT',
                    'sumber' => '...'
                ),
                array(
                    'no' => 7,
                    'title' => 'Jumlah Kepala Keluarga',
                    'jumlah' => '...',
                    'satuan' => 'KK',
                    'sumber' => '...'
                ),
                array(
                    'no' => 8,
                    'title' => 'Besaran PDRB Daerah Tahun 2015',
                    'jumlah' => '...',
                    'satuan' => 'Rp',
                    'sumber' => '...'
                ),
                array(
                    'no' => 9,
                    'title' => 'Jumlah tenaga kerja',
                    'jumlah' => '...',
                    'satuan' => 'Jiwa',
                    'sumber' => '...'
                ),array(
                    'no' => 10,
                    'title' => 'Jumlah Kepala Keluarga dengan Pendapatan/Pengeluaran sebesar:',
                    'jumlah' => null,
                    'satuan' => null,
                    'sumber' => null
                )
            ),
            'kelembagaan'   => array(
                array(
                    'no' => 1,
                    'keterangan' => 'Instansi / Dinas',
                    'uraian' => '...'
                ),
                array(
                    'no' => 2,
                    'keterangan' => 'Nama Bagian/Bidang',
                    'uraian' => '...'
                ),
                array(
                    'no' => 3,
                    'keterangan' => 'Alamat Kantor',
                    'uraian' => '...'
                ),
                array(
                    'no' => 4,
                    'keterangan' => 'Alamat E-mail ',
                    'uraian' => '...'
                ),
                array(
                    'no' => 5,
                    'keterangan' => 'Alamat website/situs',
                    'uraian' => '...'
                ),array(
                    'no' => 6,
                    'keterangan' => 'No. Telepon',
                    'uraian' => '...'
                ),
                array(
                    'no' => 7,
                    'keterangan' => 'No. Fax',
                    'uraian' => '...'
                )

            ),
            'stakeholder'   => array(
                array(
                    'no' => 1,
                    'asosiasi' => 'Perum Perumnas',
                    'jumlah' => '...'
                ),
                array(
                    'no' => 2,
                    'asosiasi' => 'REI',
                    'jumlah' => '...'
                ),
                array(
                    'no' => 3,
                    'asosiasi' => 'APERSI',
                    'jumlah' => '...'
                ),
                array(
                    'no' => 4,
                    'asosiasi' => '...',
                    'jumlah' => '...'
                ),
            ),
            'apbd-perumahan'   => array(),
            'backlog'   => array(),
            'layak-huni'   => array(),
        );

        return \View::make('front.dekon.provinsi', compact('data'))
            ->with('dekonTitle', 'Dekon Provinsi');
    }

    public function kabupaten()
    {
        return \View::make('front.dekon.kabupaten');

    }
}