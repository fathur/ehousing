<?php
/**
 * Project: ehousing-3.0
 * Date: 6/14/16
 * Time: 22:50
 */

namespace BackOffice;


class ProvinsiController extends AdminController
{
    public function getFromName()
    {
        $q = strtolower(\Input::get('q'));

        return \Provinsi::whereRaw(\DB::raw("LOWER(NamaProvinsi) LIKE '%{$q}%'"))->get();
    }
}