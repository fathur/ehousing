<?php
/**
 * Project: ehousing-3.0
 * Date: 6/11/16
 * Time: 15:51
 */

namespace Front\Provinsi;


use Carbon\Carbon;
use Datatables;

/**
 * Class HunianController
 * @package Front\Provinsi
 */
class HunianController extends \BaseController
{
    /**
     * @param $provinsiSlug
     * @return $this
     * @author Fathur Rohman <fathur_rohman17@yahoo.co.id>
     */
    public function getRusunSewa($provinsiSlug) {
        $provinsi = \Provinsi::slug($provinsiSlug)->first();

        if(is_null($provinsi))
            \App::abort(404);

        $listCities = \Kota::where('KodeProvinsi','=',$provinsi->KodeProvinsi)->lists('NamaKota','KodeKota');
        $listCities = array(0 => 'Semua') + $listCities;

        return \View::make('front.hunian.index', compact('provinsi','listCities'))
            ->with('jenis',\Hunian::RUSUN_SEWA)
            ->with('hunianTitle', 'Daftar Hunian - Rusun Sewa')
            ->with('datatablesRoute', route('front.provinsi.hunian.data', array($provinsiSlug)));
    }

    /**
     * @param $provinsiSlug
     * @return $this
     * @author Fathur Rohman <fathur_rohman17@yahoo.co.id>
     */
    public function getRusunami($provinsiSlug){
        $provinsi = \Provinsi::slug($provinsiSlug)->first();

        if(is_null($provinsi))
            \App::abort(404);


        $listCities = \Kota::where('KodeProvinsi','=',$provinsi->KodeProvinsi)->lists('NamaKota','KodeKota');
        $listCities = array(0 => 'Semua') + $listCities;

        return \View::make('front.hunian.index', compact('provinsi','listCities'))
            ->with('jenis',\Hunian::RUSUNAMI)
            ->with('hunianTitle', 'Daftar Hunian - Rusunami')

            ->with('datatablesRoute', route('front.provinsi.hunian.data', array($provinsiSlug)));
    }

    /**
     * @param $provinsiSlug
     * @return $this
     * @author Fathur Rohman <fathur_rohman17@yahoo.co.id>
     */
    public function getRusunamiSubsidi($provinsiSlug){
        $provinsi = \Provinsi::slug($provinsiSlug)->first();

        if(is_null($provinsi))
            \App::abort(404);


        $listCities = \Kota::where('KodeProvinsi','=',$provinsi->KodeProvinsi)->lists('NamaKota','KodeKota');
        $listCities = array(0 => 'Semua') + $listCities;

        return \View::make('front.hunian.index', compact('provinsi','listCities'))
            ->with('jenis',\Hunian::RUSUNAMI_SUBSIDI)
            ->with('hunianTitle', 'Daftar Hunian - Rusunami Subsidi')
            ->with('datatablesRoute', route('front.provinsi.hunian.data', array($provinsiSlug)));
    }

    /**
     * @param $provinsiSlug
     * @return $this
     * @author Fathur Rohman <fathur_rohman17@yahoo.co.id>
     */
    public function getRumahSubsidi($provinsiSlug){
        $provinsi = \Provinsi::slug($provinsiSlug)->first();

        if(is_null($provinsi))
            \App::abort(404);


        $listCities = \Kota::where('KodeProvinsi','=',$provinsi->KodeProvinsi)->lists('NamaKota','KodeKota');
        $listCities = array(0 => 'Semua') + $listCities;

        return \View::make('front.hunian.index', compact('provinsi','listCities'))
            ->with('jenis',\Hunian::RUMAH_SUBSIDI)
            ->with('hunianTitle', 'Daftar Hunian - Rumah Subsidi')
            ->with('datatablesRoute', route('front.provinsi.hunian.data', array($provinsiSlug)));
    }

    /**
     * @param $provinsiSlug
     * @return $this
     * @author Fathur Rohman <fathur_rohman17@yahoo.co.id>
     */
    public function getCondotel($provinsiSlug){
        $provinsi = \Provinsi::slug($provinsiSlug)->first();

        if(is_null($provinsi))
            \App::abort(404);


        $listCities = \Kota::where('KodeProvinsi','=',$provinsi->KodeProvinsi)->lists('NamaKota','KodeKota');
        $listCities = array(0 => 'Semua') + $listCities;

        return \View::make('front.hunian.index', compact('provinsi','listCities'))
            ->with('jenis',\Hunian::CONDOTEL)
            ->with('hunianTitle', 'Daftar Hunian - Condotel')
            ->with('datatablesRoute', route('front.provinsi.hunian.data', array($provinsiSlug)));
    }

    /**
     * @param $provinsiSlug
     * @return $this
     * @author Fathur Rohman <fathur_rohman17@yahoo.co.id>
     */
    public function getApartemen($provinsiSlug){
        $provinsi = \Provinsi::slug($provinsiSlug)->first();

        if(is_null($provinsi))
            \App::abort(404);


        $listCities = \Kota::where('KodeProvinsi','=',$provinsi->KodeProvinsi)->lists('NamaKota','KodeKota');
        $listCities = array(0 => 'Semua') + $listCities;

        return \View::make('front.hunian.index', compact('provinsi','listCities'))
            ->with('jenis',\Hunian::APERTEMEN)
            ->with('hunianTitle', 'Daftar Hunian - Apartemen')
            ->with('datatablesRoute', route('front.provinsi.hunian.data', array($provinsiSlug)));
    }

    /**
     * @param $provinsiSlug
     * @return $this
     * @author Fathur Rohman <fathur_rohman17@yahoo.co.id>
     */
    public function getHotel($provinsiSlug){
        $provinsi = \Provinsi::slug($provinsiSlug)->first();

        if(is_null($provinsi))
            \App::abort(404);

        $listCities = \Kota::where('KodeProvinsi','=',$provinsi->KodeProvinsi)->lists('NamaKota','KodeKota');
        $listCities = array(0 => 'Semua') + $listCities;

        return \View::make('front.hunian.index', compact('provinsi','listCities'))
            ->with('jenis',\Hunian::HOTEL)
            ->with('hunianTitle', 'Daftar Hotel')
            ->with('datatablesRoute', route('front.provinsi.hunian.data', array($provinsiSlug)));
    }

    /**
     * @return null
     * @author Fathur Rohman <fathur_rohman17@yahoo.co.id>
     */
    public function data($provinsiSlug)
    {


        $jenisHunian = \Input::get('jenis');
        $provinsiId = \Input::get('provinsi');



        $hunian= \Hunian::select(array(
            'hunian.HunianId','hunian.NamaHunian','hunian.JenisHunian','hunian.Website',
            'hunian.nama_pengembang',
            // 'kontak.Nama',
            'hunian.Alamat','hunian.slug',
            'kota.NamaKota'
        ))
            ->leftJoin('kota','hunian.KodeKota','=','kota.KodeKota')
            ->where('hunian.ExpiryDate','>',Carbon::now());

        if(\Input::has('jenis') || $jenisHunian != '' || !is_null($jenisHunian))
        {
            $hunian->where('hunian.JenisHunian', $jenisHunian);
        }

        if(\Input::has('provinsi') || $provinsiId != '' || !is_null($provinsiId))
        {
            $hunian->where('hunian.KodeProvinsi', $provinsiId);
        }

        if(\Input::has('kota'))
        {
            $kota = (int) \Input::get('kota');


            if($kota != 0) {
                $hunian->where('kota.KodeKota', $kota);
            }
        }

        // $hunian->join('kontak','kontak.KontakId','=','hunian.KodePengembang');


        $datatables = Datatables::of($hunian)
            ->editColumn('NamaHunian', function($data) use ($provinsiSlug) {
                $html = "<div><a href='".route('front.provinsi.hunian.show', array($provinsiSlug, $data->slug))."'>".$data->NamaHunian."</a></div>";
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

    /**
     * @param $provinsiSlug
     * @param $hunianSlug
     * @return \Illuminate\View\View
     * @author Fathur Rohman <fathur_rohman17@yahoo.co.id>
     */
    public function show($provinsiSlug, $hunianSlug)
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
                ->with('latitude', isset($coordinat[0]) ? $coordinat[0] : '-')
                ->with('longitude', isset($coordinat[1]) ? $coordinat[1] : '-');
        }

        \App::abort(404);
    }
}