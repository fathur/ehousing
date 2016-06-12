<?php
/**
 * Project: ehousing-3.0
 * Date: 6/11/16
 * Time: 15:51
 */

namespace Front\Provinsi;


use Carbon\Carbon;
use Datatables;

class HunianController extends \BaseController
{
    public function getRusunSewa($provinsiSlug) {
        $provinsi = \Provinsi::slug($provinsiSlug)->first();
        return \View::make('front.hunian', compact('provinsi'))
            ->with('jenis',\Hunian::RUSUN_SEWA);
    }

    public function getRusunami($provinsiSlug){
        $provinsi = \Provinsi::slug($provinsiSlug)->first();
        return \View::make('front.hunian', compact('provinsi'))
            ->with('jenis',\Hunian::RUSUNAMI);
    }

    public function getRusunamiSubsidi($provinsiSlug){
        $provinsi = \Provinsi::slug($provinsiSlug)->first();
        return \View::make('front.hunian', compact('provinsi'))
            ->with('jenis',\Hunian::RUSUNAMI_SUBSIDI);
    }

    public function getRumahSubsidi($provinsiSlug){
        $provinsi = \Provinsi::slug($provinsiSlug)->first();
        return \View::make('front.hunian', compact('provinsi'))
            ->with('jenis',\Hunian::RUMAH_SUBSIDI);
    }

    public function getCondotel($provinsiSlug){
        $provinsi = \Provinsi::slug($provinsiSlug)->first();
        return \View::make('front.hunian', compact('provinsi'))
            ->with('jenis',\Hunian::CONDOTEL);
    }

    public function getApartemen($provinsiSlug){
        $provinsi = \Provinsi::slug($provinsiSlug)->first();
        return \View::make('front.hunian', compact('provinsi'))
            ->with('jenis',\Hunian::APERTEMEN);
    }

    public function getHotel($provinsiSlug){
        $provinsi = \Provinsi::slug($provinsiSlug)->first();
        return \View::make('front.hunian', compact('provinsi'))
            ->with('jenis',\Hunian::HOTEL);
    }

    public function data()
    {
        $jenisHunian = \Input::get('jenis');
        $provinsiId = \Input::get('provinsi');

        $hunian= \Hunian::select(array(
            'hunian.HunianId','hunian.NamaHunian','hunian.JenisHunian','hunian.Website',
            'kontak.Nama','hunian.Alamat'
        ))
            ->where('hunian.ExpiryDate','>',Carbon::now());

        if(\Input::has('jenis') || $jenisHunian != '' || !is_null($jenisHunian))
        {
            $hunian->where('hunian.JenisHunian', $jenisHunian);
        }

        if(\Input::has('provinsi') || $provinsiId != '' || !is_null($provinsiId))
        {
            $hunian->where('hunian.KodeProvinsi', $provinsiId);
        }

        $hunian->join('kontak','kontak.KontakId','=','hunian.KodePengembang');

        $datatables = Datatables::of($hunian)
            ->editColumn('NamaHunian', function($data){
                $html = "<div><a href='".url('hunian/'. \Str::slug($data->NamaHunian))."'>".$data->NamaHunian."</a></div>";
                $html .= "<small>{$data->Alamat}</small>";

                return $html;
            })
            ->editColumn('Website', function($data) {
                return "<a href='{$data->Website}' target='_blank'>".$data->Website.'</a>';
            })
            ->make(true);

        return $datatables;
    }
}