<?php
/**
 * Project: ehousing-3.0
 * Date: 6/11/16
 * Time: 15:53
 */

namespace Front\Nasional;


use Carbon\Carbon;
use Datatables;

class KontakController extends \BaseController
{
    public function getDeveloper()
    {
        return \View::make('front.kontak.index')
            ->with('jenis',\Kontak::DEVELOPER)
            ->with('datatablesRoute', route('front.nasional.kontak.data'));
    }

    public function getKontraktor()
    {
        return \View::make('front.kontak.index')
            ->with('jenis',\Kontak::KONTRAKTOR)
            ->with('datatablesRoute', route('front.nasional.kontak.data'));
    }

    public function getSupplier()
    {
        return \View::make('front.kontak.index')
            ->with('jenis',\Kontak::SUPPLIER)
            ->with('datatablesRoute', route('front.nasional.kontak.data'));
    }

    public function getTukang()
    {
        return \View::make('front.kontak.index')
            ->with('jenis',\Kontak::TUKANG)
            ->with('datatablesRoute', route('front.nasional.kontak.data'));
    }

    public function getArsitek()
    {
        return \View::make('front.kontak.index')
            ->with('jenis',\Kontak::ARSITEK)
            ->with('datatablesRoute', route('front.nasional.kontak.data'));
    }

    public function data()
    {
        $jenisKontak = \Input::get('jenis');

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

        $datatables = Datatables::of($kontak)
            ->editColumn('Nama', function($data) {
                $html = "<div><a href='".route('front.nasional.kontak.show', array($data->slug))."'>{$data->Nama}</a></div>";
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

    public function show($kontakSlug)
    {

        $kontak = \Kontak::with('hunian')
            ->slug($kontakSlug)
            ->first();

        // return \Response::json($kontak);

        if(!is_null($kontak)) {

            return \View::make('front.kontak.show', compact('kontak'))
                ->with('type','nasional');
        }

        \App::abort(404);
    }
}