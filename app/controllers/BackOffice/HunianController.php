<?php
namespace BackOffice;

use Carbon\Carbon;
use Datatables;
use Response;

class HunianController extends AdminController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return \View::make('back.hunian.index')
            ->with('datatablesRoute', route('back-office.hunian.data'));
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $listHunian = \Referensi::where('refId', 'JHN')
            ->where(function($query) {
                $query->where('Flag','=',0);
                $query->orWhereNull('Flag');
            })
            ->orderBy('deskripsi', 'asc')
            ->lists('deskripsi', 'koderef');

		return \View::make('back.hunian.create', compact('listHunian'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$result = \Hunian::create(array(
			'JenisHunian' => \Input::get('JenisHunian'),
			'NamaHunian' => \Input::get('NamaHunian'),
			'TahunPembangunan' => \Input::get('TahunPembangunan'),
			'KodePengembang' => \Input::get('KodePengembang'),
			'Alamat' => \Input::get('Alamat'),
			'Koordinat' => \Input::get('Koordinat'),
			'Pengelola' => \Input::get('Pengelola'),
			'NoTelp' => \Input::get('NoTelp'),
			'NoHP_PIC' => \Input::get('NoHP_PIC'),
			'Email' => \Input::get('Email'),
			'Website' => \Input::get('Website'),
			// 'TahunSelesai',
			'JumlahUnit' => \Input::get('JumlahUnit'),
			'JumlahLantai' => \Input::get('JumlahLantai'),
			'LuasLahan' => \Input::get('LuasLahan'),
			'TingkatHunian' => \Input::get('TingkatHunian'),
			'KodeProvinsi' => \Input::get('KodeProvinsi'),
			'KodeKecamatan' => \Input::get('KodeKecamatan'),
			'KodeKota' => \Input::get('KodeKota'),
			// 'picture',
			// 'Harga',
			// 'Deskripsi',
			// 'StatusHunian',
			// 'LinkExternal2',
			// 'LinkExternal3',
			// 'LinkExternal4',
			// 'Tab2',
			// 'Tab3',
			// 'Tab4',
		));


        if($result)
            return \Redirect::route('back-office.hunian.edit', $result->HunianId)
                ->with('message', 'Data berhasil diubah')
                ->with('class', 'success');

        return \Redirect::route('back-office.hunian.create')
            ->with('message', 'Data gagal diubah')
            ->with('class', 'danger')
            ->withInput();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $data = \Hunian::with('provinsi','kota','kecamatan')->find($id);

        $listHunian = \Referensi::where('refId', 'JHN')
            ->where(function($query) {
                $query->where('Flag','=',0);
                $query->orWhereNull('Flag');
            })
            ->orderBy('deskripsi', 'asc')
            ->lists('deskripsi', 'koderef');

		return \View::make('back.hunian.edit', compact('data','listHunian'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$data = \Hunian::find($id);
        $data->JenisHunian = \Input::get('JenisHunian');
        $data->NamaHunian = \Input::get('NamaHunian');
        $data->KodePengembang = \Input::get('KodePengembang');
        $data->Alamat = \Input::get('Alamat');
        $data->KodeKecamatan = \Input::get('KodeKecamatan');
        $data->Koordinat = \Input::get('Koordinat');
        $data->Pengelola = \Input::get('Pengelola');
        $data->NoTelp = \Input::get('NoTelp');
        $data->NoHP_PIC = \Input::get('NoHP_PIC');
        $data->Email = \Input::get('Email');
        $data->Website = \Input::get('Website');
        $data->TahunPembangunan = \Input::get('TahunPembangunan');
        $data->JumlahUnit = \Input::get('JumlahUnit');
        $data->JumlahLantai = \Input::get('JumlahLantai');
        $data->LuasLahan = \Input::get('LuasLahan');
        $data->TingkatHunian = \Input::get('TingkatHunian');
        $data->KodeProvinsi = \Input::get('KodeProvinsi');
        $data->KodeKota = \Input::get('KodeKota');
        $data->save();

        return \Redirect::route('back-office.hunian.edit', array($data->HunianId))
            ->with('message', 'Data berhasil diubah')
            ->with('class', 'success');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$result = \Hunian::destroy($id);

        $redirect = \Redirect::route('back-office.hunian.index');

        if($result)
            $redirect->with('message','Data berhasil dihapus')
                ->with('class','success');
        else
            $redirect->with('message','Data gagal dihapus')
                ->with('class','danger');

        return $redirect;
	}

    public function data()
    {

        $hunian= \Hunian::select(array(
            'hunian.HunianId','hunian.NamaHunian','hunian.JenisHunian','hunian.Website',
            'kontak.Nama','hunian.Alamat','hunian.slug'
        ))
            ->where('hunian.ExpiryDate','>',Carbon::now());


        $hunian->join('kontak','kontak.KontakId','=','hunian.KodePengembang');

        $datatables = Datatables::of($hunian)
            ->editColumn('NamaHunian', function($data) {
                $html = "<div><a href='".route('back-office.hunian.edit', array($data->id))."'>".$data->NamaHunian."</a></div>";
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
