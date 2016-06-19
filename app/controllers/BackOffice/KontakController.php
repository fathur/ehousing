<?php
namespace BackOffice;

use Carbon\Carbon;
use Datatables;
use View;

class KontakController extends AdminController {

	protected $title = 'Kontak';
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return \View::make('back.kontak.index')
			->with('datatablesRoute', route('back-office.kontak.data'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$jenisKontak = array(
			'ARS' => 'Desain &amp; Arsitek',
			'DEV' => 'Developer',
			'KON' => 'Kontraktor',
			'SUP' => 'Supplier',
			'CON' => 'Tipe Kontak',
			'TUK' => 'Tukang',
		);
		return \View::make('back.kontak.create', compact('jenisKontak'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// dd(\Input::all());
		$result = \Kontak::create(array(
			'JenisKontak' => \Input::get('JenisKontak'),
			'Nama' => \Input::get('Nama'),
			'Deskripsi' => \Input::get('Deskripsi'),
			'Alamat' => \Input::get('Alamat'),
			'KodeKecamatan' => \Input::get('KodeKecamatan'),
			'NoTelp' => \Input::get('NoTelp'),
			'NoHP' => \Input::get('NoHP'),
			'Email' => \Input::get('Email'),
			'Website' => \Input::get('Website'),
			'IsCorporate' => \Input::get('IsCorporate'),
			'Kompetensi' => \Input::get('Kompetensi'),
			'IsActive' => true, //\Input::has('IsActive') ? true : false,
			'Image' => \Input::get('Image'),
			'Picture' => \Input::get('Picture'),
			'KodeProvinsi' => \Input::get('KodeProvinsi'),
			'KodeKota' => \Input::get('KodeKota'),
			'TglRegistrasi' => \Input::get('TglRegistrasi'),
			'TglVerifikasi' => \Input::get('TglVerifikasi'),
			'Status' => \Input::get('Status'),
		));


		if($result)
			return \Redirect::route('back-office.kontak.edit', $result->KontakId)
				->with('message', 'Data berhasil diubah')
				->with('class', 'success');

		return \Redirect::route('back-office.kontak.create')
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
		$data = \Kontak::with('provinsi','kota','kecamatan')
			->find($id);
		$jenisKontak = array(
			'ARS' => 'Desain &amp; Arsitek',
			'DEV' => 'Developer',
			'KON' => 'Kontraktor',
			'SUP' => 'Supplier',
			'CON' => 'Tipe Kontak',
			'TUK' => 'Tukang',
		);
		return \View::make('back.kontak.edit', compact('data','jenisKontak'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$data = \Kontak::find($id);
		$data->JenisKontak = \Input::get('JenisKontak');
		$data->Nama = \Input::get('Nama');
		$data->Deskripsi = \Input::get('Deskripsi');
		$data->Alamat = \Input::get('Alamat');
		$data->KodeKecamatan = \Input::get('KodeKecamatan');
		$data->NoTelp = \Input::get('NoTelp');
		$data->NoHP = \Input::get('NoHP');
		$data->Email = \Input::get('Email');
		$data->Website = \Input::get('Website');
		$data->IsCorporate = \Input::get('IsCorporate');
		$data->Kompetensi = \Input::get('Kompetensi');
		$data->IsActive = \Input::get('IsActive');
		$data->Image = \Input::get('Image');
		$data->Picture = \Input::get('Picture');
		$data->KodeProvinsi = \Input::get('KodeProvinsi');
		$data->KodeKota = \Input::get('KodeKota');
		$data->TglRegistrasi = \Input::get('TglRegistrasi');
		$data->TglVerifikasi = \Input::get('TglVerifikasi');
		$data->Status = \Input::get('Status');
		$data->save();

		return \Redirect::route('back-office.kontak.edit', array($data->KontakId))
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
		return \Kontak::destroy($id);
	}

	public function data()
	{

		$data = \Kontak::select(array(
			'kontak.*'
		))->where('kontak.ExpiryDate','>',Carbon::now());

		$datatables = Datatables::of($data)
			->addColumn('action', function($data){

				return View::make('back.action')
					->with('table', $this->identifier . '-datatables')
					->with('url', route('back-office.kontak.destroy', array($data->id)))
					->with('edit_action', route('back-office.kontak.edit', array($data->id)))
					->render();
			})
			->make(true);

		return $datatables;
	}

	public function getFromName()
	{
        $q = strtolower(\Input::get('q'));
        $jenis = \Input::get('type');

        $kontak = \Kontak::whereRaw(\DB::raw("LOWER(Nama) LIKE '%{$q}%'"));

        if(!is_null($jenis))
        {
            $kontak->where('JenisKontak', $jenis);
        }

        return $kontak->get();
	}
}
