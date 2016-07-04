<?php
/**
 * Project: ehousing-3.0
 * Date: 7/4/16
 * Time: 22:12
 */

namespace BackOffice;


use Carbon\Carbon;
use Datatables;

class ChartController extends AdminController
{
    protected $identifier = 'chart';

    public function index($jenis)
    {
        return \View::make('back.chart.index', compact('jenis'))
            ->with('kinds', \ProfileProvinsiSource::$kinds)
            ->with('datatablesRoute', route('back-office.chart.data'));

    }

    public function edit($jenis, $id)
    {
        $data = \ProfilProvinsi::select(array(
            'KodeProfilProv',
            'TahunBerlaku',
            \ProfileProvinsiSource::$kinds[$jenis]['column']." AS jumlah",
        ))->with('source')->find($id);

        $sourceColumn = \ProfileProvinsiSource::$kinds[$jenis]['source_column'];


        return \View::make('back.chart.edit', compact('data','jenis','sourceColumn'));

    }

    public function update($jenis, $id)
    {
        //dd($this->kinds[$jenis]['source_column']);

        $profil = \ProfilProvinsi::find($id);
        $profil->{\ProfileProvinsiSource::$kinds[$jenis]['column']} = \Input::get('jumlah');
        $profil->save();

        $src = \ProfileProvinsiSource::where('profil_provinsi_id', $id);

        if($src->count() == 0)
        {
            $profil->source()->save(
                new \ProfileProvinsiSource(array(
                    \ProfileProvinsiSource::$kinds[$jenis]['source_column'] => \Input::get('source.' . \ProfileProvinsiSource::$kinds[$jenis]['source_column'])
                )
            ));

        } else {
            $profil->source()->update(array(
                \ProfileProvinsiSource::$kinds[$jenis]['source_column'] => \Input::get('source.' . \ProfileProvinsiSource::$kinds[$jenis]['source_column'])
            ));
        }

        return \Redirect::route('back-office.chart.index', array($jenis));
    }

    public function data()
    {
        $jenis = \Input::get('jenis');

        $profile = \ProfilProvinsi::select(array(
            'KodeProfilProv',
            'TahunBerlaku',
            \ProfileProvinsiSource::$kinds[$jenis]['column']." AS jumlah",
            \ProfileProvinsiSource::$kinds[$jenis]['source_column']." AS source"
        ))->leftJoin('profile_provinsi_sources','profile_provinsi_sources.profil_provinsi_id','=','ProfilProvinsi.KodeProfilProv');

        if(\Auth::user()->Region == 'Provinsi') {
            $profile->where('KodeProv', \Auth::user()->KodeProvinsi);
        }

        $datatables = Datatables::of($profile)
            ->editColumn('jumlah', function($data) {
                return number_format($data->jumlah, 2, ',', '.');
            })

            ->addColumn('action', function($data) use ($jenis) {

                return \View::make('back.action')
                    ->with('table', $this->identifier . '-datatables')
                    ->with('url', route('back-office.chart.destroy', array($jenis, $data->KodeProfilProv)))
                    ->with('edit_action', route('back-office.chart.edit', array($jenis, $data->KodeProfilProv)))
                    ->render();
            })
            ->make(true);

        return $datatables;
    }
}