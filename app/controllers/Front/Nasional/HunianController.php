<?php
/**
 * Project: ehousing-3.0
 * Date: 6/11/16
 * Time: 15:51
 */

namespace Front\Nasional;


use Carbon\Carbon;
use Datatables;

class HunianController extends \BaseController
{
    public function getRusunSewa(){

        //$listCities =

        return \View::make('front.hunian.index')
            ->with('jenis',\Hunian::RUSUN_SEWA)
            ->with('hunianTitle', 'Daftar Hunian - Rusunawa')
            ->with('datatablesRoute', route('front.nasional.hunian.data'));

    }

    public function getRusunami(){
        return \View::make('front.hunian.index')
            ->with('jenis',\Hunian::RUSUNAMI)
            ->with('hunianTitle', 'Daftar Hunian - Rusunami')

            ->with('datatablesRoute', route('front.nasional.hunian.data'));
    }

    public function getRusunamiSubsidi(){
        return \View::make('front.hunian.index')
            ->with('jenis',\Hunian::RUSUNAMI_SUBSIDI)
            ->with('hunianTitle', 'Daftar Hunian - Rumah Khusus')
            ->with('datatablesRoute', route('front.nasional.hunian.data'));
    }

    public function getRumahSubsidi(){
        return \View::make('front.hunian.index')
            ->with('jenis',\Hunian::RUMAH_SUBSIDI)
            ->with('hunianTitle', 'Daftar Hunian - Rumah Umum dan Komersial')
            ->with('datatablesRoute', route('front.nasional.hunian.data'));
    }

    public function getCondotel(){
        return \View::make('front.hunian.index')
            ->with('jenis',\Hunian::CONDOTEL)
            ->with('hunianTitle', 'Daftar Hunian - Condotel')
            ->with('datatablesRoute', route('front.nasional.hunian.data'));
    }

    public function getApartemen(){
        return \View::make('front.hunian.index')
            ->with('jenis',\Hunian::APERTEMEN)
            ->with('hunianTitle', 'Daftar Hunian - Apartemen')
            ->with('datatablesRoute', route('front.nasional.hunian.data'));
    }

    public function getHotel(){
        return \View::make('front.hunian.index')
            ->with('jenis',\Hunian::HOTEL)
            ->with('hunianTitle', 'Daftar Hotel')
            ->with('datatablesRoute', route('front.nasional.hunian.data'));
    }

    public function data()
    {
        $jenisHunian = \Input::get('jenis');

        $hunian= \Hunian::select(array(
            'hunian.HunianId','hunian.NamaHunian','hunian.JenisHunian','hunian.Website',
            'hunian.nama_pengembang',
            //'kontak.Nama',
            'hunian.Alamat','hunian.slug',
            'kota.NamaKota'
        ))
            ->leftJoin('kota','hunian.KodeKota','=','kota.KodeKota')
            ->where('hunian.ExpiryDate','>',Carbon::now());

        if(\Input::has('jenis') || $jenisHunian != '' || !is_null($jenisHunian))
        {
            $hunian->where('hunian.JenisHunian', $jenisHunian);
        }

        // $hunian->join('kontak','kontak.KontakId','=','hunian.KodePengembang');

        $datatables = Datatables::of($hunian)
            ->editColumn('NamaHunian', function($data) {
                $html = "<div><a href='".route('front.nasional.hunian.show', array($data->slug))."'>".$data->NamaHunian."</a></div>";
                $html .= "<small>{$data->Alamat}</small>";

                return $html;
            })
            ->editColumn('Website', function($data) {
                return "<a href='{$data->Website}' target='_blank'>".$data->Website.'</a>';
            })
            ->editColumn('NamaKota', function($data) {
                if(is_null($data->NamaKota))
                    return '-';

                return $data->NamaKota;
            })
            ->make(true);

        return $datatables;
    }

    public function show($hunianSlug)
    {
        $hunian = \Hunian::with('referensi','kontak')
            ->slug($hunianSlug)
            ->first();

        // return \Response::json($hunian);

        if(!is_null($hunian)) {

            if(!empty($hunian->Koordinat))
                $coordinat = explode(',', $hunian->Koordinat);
            else
                $coordinat = array(0,0);

            return \View::make('front.hunian.show', compact('hunian'))
                ->with('latitude', $coordinat[0])
                ->with('longitude', $coordinat[1]);
        }

        \App::abort(404);
    }
}