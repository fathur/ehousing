<?php
/**
 * Project: ehousing-3.0
 * Date: 6/11/16
 * Time: 15:53
 */

namespace Front\Provinsi;



use Carbon\Carbon;
use Datatables;

class LinkController extends \BaseController
{
    public function getImb($provinsiSlug)
    {
        $provinsi = \Provinsi::slug($provinsiSlug)->first();

        if(is_null($provinsi))
            \App::abort(404);

        $listCities = \Kota::where('KodeProvinsi','=',$provinsi->KodeProvinsi)->lists('NamaKota','KodeKota');
        $listCities = array(0 => 'Semua') + $listCities;


        return \View::make('front.link.index', compact('provinsi','listCities'))
            ->with('jenis', \LinkInfo::IMB)
            ->with('linkTitle', 'Daftar Link - IMB')
            ->with('datatablesRoute', route('front.provinsi.link.data', array($provinsiSlug)));

    }

    public function getPbb($provinsiSlug)
    {
        $provinsi = \Provinsi::slug($provinsiSlug)->first();

        if(is_null($provinsi))
            \App::abort(404);

        $listCities = \Kota::where('KodeProvinsi','=',$provinsi->KodeProvinsi)->lists('NamaKota','KodeKota');
        $listCities = array(0 => 'Semua') + $listCities;


        return \View::make('front.link.index', compact('provinsi','listCities'))
            ->with('jenis', \LinkInfo::PBB)
            ->with('linkTitle', 'Daftar Link - PBB')
            ->with('datatablesRoute', route('front.provinsi.link.data', array($provinsiSlug)));

    }

    public function getTataRuang($provinsiSlug)
    {
        $provinsi = \Provinsi::slug($provinsiSlug)->first();

        if(is_null($provinsi))
            \App::abort(404);

        $listCities = \Kota::where('KodeProvinsi','=',$provinsi->KodeProvinsi)->lists('NamaKota','KodeKota');
        $listCities = array(0 => 'Semua') + $listCities;


        return \View::make('front.link.index', compact('provinsi','listCities'))
            ->with('jenis', \LinkInfo::TATA_RUANG)
            ->with('linkTitle', 'Daftar Link - Tata Ruang')
            ->with('datatablesRoute', route('front.provinsi.link.data', array($provinsiSlug)));

    }

    public function getBpn($provinsiSlug)
    {
        $provinsi = \Provinsi::slug($provinsiSlug)->first();

        if(is_null($provinsi))
            \App::abort(404);

        $listCities = \Kota::where('KodeProvinsi','=',$provinsi->KodeProvinsi)->lists('NamaKota','KodeKota');
        $listCities = array(0 => 'Semua') + $listCities;


        return \View::make('front.link.index', compact('provinsi','listCities'))
            ->with('jenis', \LinkInfo::BPN)
            ->with('linkTitle', 'Daftar Link - BPN')
            ->with('datatablesRoute', route('front.provinsi.link.data', array($provinsiSlug)));

    }

    public function getPermukiman($provinsiSlug)
    {
        $provinsi = \Provinsi::slug($provinsiSlug)->first();

        if(is_null($provinsi))
            \App::abort(404);

        $listCities = \Kota::where('KodeProvinsi','=',$provinsi->KodeProvinsi)->lists('NamaKota','KodeKota');
        $listCities = array(0 => 'Semua') + $listCities;


        return \View::make('front.link.index', compact('provinsi','listCities'))
            ->with('jenis', \LinkInfo::MKM)
            ->with('linkTitle', 'Daftar Link - Permukiman')
            ->with('datatablesRoute', route('front.provinsi.link.data', array($provinsiSlug)));

    }


    public function data()
    {
        $jenisLink = \Input::get('jenis');
        $provinsiId = \Input::get('provinsi');

        $link = \LinkInfo::select(array(
            'linkinfo.*',
            'kota.NamaKota'

        ))
            ->leftJoin('kota','linkinfo.KodeKota','=','kota.KodeKota')
            ->where('linkinfo.ExpiryDate','>',Carbon::now());

        if(\Input::has('jenis') || $jenisLink != '' || !is_null($jenisLink))
        {
            $link->where('linkinfo.GrupLinkInfo', $jenisLink);
        }

        if(\Input::has('provinsi') || $provinsiId != '' || !is_null($provinsiId))
        {
            $link->where('linkinfo.KodeProvinsi', $provinsiId);
        }

        if(\Input::has('kota'))
        {
            $kota = (int) \Input::get('kota');


            if($kota != 0) {
                $link->where('kota.KodeKota', $kota);
            }
        }

        $datatables = Datatables::of($link)
            ->editColumn('LinkInfo', function($data) {
                return "<a href='{$data->LinkInfo}' target='_blank'>{$data->LinkInfo}</a>";
            })
            ->editColumn('NamaKota', function($data) {
                if(is_null($data->NamaKota))
                    return '-';

                return $data->NamaKota;
            })
            ->make(true);

        return $datatables;

    }
}