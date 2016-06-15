<?php
/**
 * Project: ehousing-3.0
 * Date: 6/14/16
 * Time: 22:50
 */

namespace BackOffice;


class KecamatanController extends AdminController
{
    public function getFromName()
    {
        $q = strtolower(\Input::get('q'));
        $kota = \Input::get('kota');

        $results = \Kecamatan::whereRaw(\DB::raw("LOWER(NamaKecamatan) LIKE '%{$q}%'"));

        if(!is_null($kota))
        {
            $results->where('KodeKota', $kota);
        }

        return $results->get();
    }
}