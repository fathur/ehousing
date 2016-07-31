<?php
/**
 * Project: ehousing-3.0
 * Date: 6/11/16
 * Time: 15:53
 */

namespace Front\Provinsi;


use Carbon\Carbon;
use Datatables;

class KontakController extends \BaseController
{
    public function getDeveloper($provinsiSlug)
    {
        $provinsi = \Provinsi::slug($provinsiSlug)->first();

        if(is_null($provinsi))
            \App::abort(404);

        $listCities = \Kota::where('KodeProvinsi','=',$provinsi->KodeProvinsi)->lists('NamaKota','KodeKota');
        $listCities = array(0 => 'Semua') + $listCities;

        return \View::make('front.kontak.index', compact('provinsi','listCities'))
            ->with('jenis',\Kontak::DEVELOPER)
            ->with('kontakTitle', 'Daftar Kontak - Developer')
            ->with('datatablesRoute', route('front.provinsi.kontak.data', array($provinsiSlug)));

    }

    public function getKontraktor($provinsiSlug)
    {
        $provinsi = \Provinsi::slug($provinsiSlug)->first();

        if(is_null($provinsi))
            \App::abort(404);

        $listCities = \Kota::where('KodeProvinsi','=',$provinsi->KodeProvinsi)->lists('NamaKota','KodeKota');
        $listCities = array(0 => 'Semua') + $listCities;

        return \View::make('front.kontak.index', compact('provinsi','listCities'))
            ->with('jenis',\Kontak::KONTRAKTOR)
            ->with('kontakTitle', 'Daftar Kontak - Kontraktor')
            ->with('datatablesRoute', route('front.provinsi.kontak.data', array($provinsiSlug)));
    }

    public function getSupplier($provinsiSlug)
    {
        $provinsi = \Provinsi::slug($provinsiSlug)->first();

        if(is_null($provinsi))
            \App::abort(404);

        $listCities = \Kota::where('KodeProvinsi','=',$provinsi->KodeProvinsi)->lists('NamaKota','KodeKota');
        $listCities = array(0 => 'Semua') + $listCities;

        return \View::make('front.kontak.index', compact('provinsi','listCities'))
            ->with('jenis',\Kontak::SUPPLIER)
            ->with('kontakTitle', 'Daftar Kontak - Supplier')
            ->with('datatablesRoute', route('front.provinsi.kontak.data', array($provinsiSlug)));
    }

    public function getTukang($provinsiSlug)
    {
        $provinsi = \Provinsi::slug($provinsiSlug)->first();

        if(is_null($provinsi))
            \App::abort(404);

        $listCities = \Kota::where('KodeProvinsi','=',$provinsi->KodeProvinsi)->lists('NamaKota','KodeKota');
        $listCities = array(0 => 'Semua') + $listCities;

        return \View::make('front.kontak.index', compact('provinsi','listCities'))
            ->with('jenis',\Kontak::TUKANG)
            ->with('kontakTitle', 'Daftar Kontak - Tukang')
            ->with('datatablesRoute', route('front.provinsi.kontak.data', array($provinsiSlug)));
    }

    public function getArsitek($provinsiSlug)
    {
        $provinsi = \Provinsi::slug($provinsiSlug)->first();

        if(is_null($provinsi))
            \App::abort(404);

        $listCities = \Kota::where('KodeProvinsi','=',$provinsi->KodeProvinsi)->lists('NamaKota','KodeKota');
        $listCities = array(0 => 'Semua') + $listCities;

        return \View::make('front.kontak.index', compact('provinsi','listCities'))
            ->with('jenis',\Kontak::ARSITEK)
            ->with('kontakTitle', 'Daftar Kontak - Arsitek')
            ->with('datatablesRoute', route('front.provinsi.kontak.data', array($provinsiSlug)));
    }

    /**
     * @param $provinsiSlug
     * @return null
     * @author Fathur Rohman <fathur_rohman17@yahoo.co.id>
     */
    public function data($provinsiSlug)
    {
        $jenisKontak = \Input::get('jenis');
        $provinsiId = \Input::get('provinsi');

        $kontak= \Kontak::select(array(
            'kontak.*',
            'kota.NamaKota'
        ))
            ->leftJoin('kota','kontak.KodeKota','=','kota.KodeKota')
            ->where('kontak.ExpiryDate','>',Carbon::now());

        if(\Input::has('jenis') || $jenisKontak != '' || !is_null($jenisKontak))
        {
            $kontak->where('kontak.JenisKontak', $jenisKontak);
        }

        if(\Input::has('provinsi') || $provinsiId != '' || !is_null($provinsiId))
        {
            $kontak->where('kontak.KodeProvinsi', $provinsiId);
        }

        if(\Input::has('kota'))
        {
            $kota = (int) \Input::get('kota');


            if($kota != 0) {
                $kontak->where('kota.KodeKota', $kota);
            }
        }

        $datatables = Datatables::of($kontak)
            ->editColumn('Nama', function($data) use ($provinsiSlug) {
                $html = "<div><a href='".route('front.provinsi.kontak.show', array($provinsiSlug, $data->slug))."'>{$data->Nama}</a></div>";
                $html .= "<small>{$data->Alamat}</small>";
                return $html;
            })
            ->editColumn('Email', function($data) {
                if($data->Email == '' || is_null($data->Email))
                    $email = '-';
                else
                    $email = "<a href='mailto:{$data->Email}'>{$data->Email}</a>";

                if($data->Website == '' || is_null($data->Website))
                    $web = '-';
                else
                    $web = $data->Website;

                return "<div>{$email}</div><small>{$web}</small>";
            })
            ->editColumn('TglVerifikasi', function($data) {
                if(is_null($data->TglVerifikasi) || $data->TglVerifikasi == '')
                    return "<span class='label label-danger'>Belum terverifikasi</span>";
                else
                    return "<span class='label label-success'>Terverifikasi</span>";
            })
            ->editColumn('NamaKota', function($data) {
                if(is_null($data->NamaKota))
                    return '-';

                return $data->NamaKota;
            })
            ->make(true);

        return $datatables;
    }

    public function show($provinsiSlug, $kontakSlug)
    {
        $provinsi = \Provinsi::slug($provinsiSlug)->first();

        $kontak = \Kontak::with('hunian')
            ->slug($kontakSlug)
            ->first();

        // return \Response::json($kontak);

        if(!is_null($kontak)) {

            return \View::make('front.kontak.show', compact('kontak','provinsi'));
        }

        \App::abort(404);
    }
}