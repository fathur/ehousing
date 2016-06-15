<?php
/**
 * Project: ehousing-3.0
 * Date: 6/14/16
 * Time: 22:51
 */

namespace BackOffice;


class KabupatenController extends AdminController
{
    public function getFromName()
    {
        $q = strtolower(\Input::get('q'));

        $results = \Kota::whereRaw(\DB::raw("LOWER(NamaKota) LIKE '%{$q}%'"));

        if(!is_null(\Input::get('provinsi')))
        {
            $results->where('KodeProvinsi', \Input::get('provinsi'));
        }

        return $results->get();
    }
}