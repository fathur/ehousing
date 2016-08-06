<?php
namespace BackOffice;

use Carbon\Carbon;
use Datatables;
use View;

class KontakController extends AdminController {

	protected $title = 'Kontak';

	protected $identifier = 'kontak';


	protected $rules = array(
		'Nama'	=> 'required',
		'JenisKontak'	=> 'required|exists:referensi,koderef',
		'Alamat'	=> 'required',
		// 'KodeProvinsi'	=> 'required|integer|exists:provinsi,KodeProvinsi',

	);

	protected $messages = array(
		'Nama.required'	=> 'Nama kontak tidak boleh kosong',
		'JenisKontak.required'	=> 'Jenis kontak tidak boleh kosong',
		'Alamat.required'		=> 'Alamat tidak boleh kosong',
		'KodeProvinsi.required'	=> 'Provinsi tidak boleh kosong',


	);
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
		// dd(\Auth::user()->KodeProvinsi);
		$jenisKontak = \Referensi::where('refId', \Referensi::JENIS_KONTAK)
			->where('KodeRef','<>',\Referensi::JENIS_KONTAK)
			->orderBy('deskripsi', 'asc')
			->lists('deskripsi', 'koderef');

		return \View::make('back.kontak.create', compact('jenisKontak'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = \Validator::make(\Input::all(), $this->rules, $this->messages);

		if($validator->fails()) {
			return \Redirect::route('back-office.kontak.create')
				->withErrors($validator)
				->with('class', 'danger')
				->withInput();
		}

		if(\Input::hasFile('userfile'))
		{
			$file = \Input::file('userfile');

			$destination = storage_path('uploads/kontak/');
			$newName = $file->getClientOriginalName();

			if($file->isValid())
			{
				$file->move($destination, $newName);
			}
		}
		else
		{
			$newName = \Input::get('Picture');
		}
		$dataPost = array(
			'JenisKontak' => \Input::get('JenisKontak'),
			'Nama' => \Input::get('Nama'),
			'Deskripsi' => \Input::get('Deskripsi'),
			'Alamat' => \Input::get('Alamat'),
			'KodeKecamatan' => \Input::get('KodeKecamatan'),
			'NoTelp' => \Input::get('NoTelp'),
			'NoHP' => \Input::get('NoHP'),
			'Email' => \Input::get('Email'),
			'Website' => \Input::get('Website'),
			'IsCorporate' => \Input::get('IsCorporate') == '1' ? true: false, // todo: issue here
			'Kompetensi' => \Input::get('Kompetensi'),
			'IsActive' => true, //\Input::has('IsActive') ? true : false,
			'Image' => \Input::get('Image'),
			'Picture' => \Input::get('Picture'),
			'KodeKota' => \Input::get('KodeKota'),
			'TglRegistrasi' => \Input::get('TglRegistrasi'),
			'TglVerifikasi' => \Input::get('TglVerifikasi'),
			'Status' => \Input::get('Status'),

			'ExpiryDate'	=> \EhousingModel::DEFAULT_EXPIRY_DATE,
			'CreateUid'		=> \Auth::user()->id
		);

		if(!is_null($newName)) {
			$dataPost['Picture'] = $newName;
		}

		if(\Auth::user()->Region == 'Provinsi') {

			$dataPost['KodeProvinsi'] = \Auth::user()->KodeProvinsi;
		}
		// Nasional
		else {

			$dataPost['KodeProvinsi'] = \Input::get('KodeProvinsi');

		}

		// dd(\Input::all());
		$result = \Kontak::create($dataPost);

		$this->flushKontakCache();

		if($result)
			return \Redirect::route('back-office.kontak.edit', $result->KontakId)
				->with('message', 'Data berhasil disimpan')
				->with('class', 'success');

		return \Redirect::route('back-office.kontak.create')
			->with('message', 'Data gagal disimpan')
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

		$jenisKontak = \Referensi::where('refId', \Referensi::JENIS_KONTAK)
			->orderBy('deskripsi', 'asc')
			->lists('deskripsi', 'koderef');

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

		$validator = \Validator::make(\Input::all(), $this->rules, $this->messages);

		if($validator->fails()) {
			return \Redirect::route('back-office.kontak.edit', array($id))
				->withErrors($validator)
				->with('class', 'danger')
				->withInput();
		}

		if(\Input::hasFile('userfile'))
		{
			$file = \Input::file('userfile');
			$destination = storage_path('uploads/kontak/');
			$newName = $file->getClientOriginalName();

			if($file->isValid())
			{
				$file->move($destination, $newName);
			}
		}
		else
		{
			$newName = \Input::get('Picture');
		}


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
		$data->IsCorporate = \Input::get('IsCorporate') == '1' ? true: false; // todo: issue here
		$data->Kompetensi = \Input::get('Kompetensi');
		$data->IsActive = \Input::get('IsActive');
		$data->Image = \Input::get('Image');
		$data->Picture = \Input::get('Picture');
		$data->KodeKota = \Input::get('KodeKota');
		$data->TglRegistrasi = \Input::get('TglRegistrasi');
		$data->TglVerifikasi = \Input::get('TglVerifikasi');
		$data->Status = \Input::get('Status');

		if(!is_null($newName))
			$data->Picture = $newName;

		if(\Auth::user()->Region == 'Provinsi') {
			$data->KodeProvinsi = \Auth::user()->KodeProvinsi;
		}
		else {
			$data->KodeProvinsi = \Input::get('KodeProvinsi');
		}

		$data->ModUid = \Auth::user()->id;

		$this->flushKontakCache();

		if($data->save()) {

			return \Redirect::route('back-office.kontak.edit', array($id))
				->with('message', 'Data berhasil diubah')
				->with('class', 'success');
		}

		return \Redirect::route('back-office.kontak.edit', array($id))
			->with('message', 'Data gagal diubah')
			->with('class', 'danger')
			->withInput();
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->flushKontakCache();

		return \Kontak::destroy($id);
	}

	public function data()
	{

		$data = \Kontak::select(array(
			'kontak.*'
		))->where('kontak.ExpiryDate','>',Carbon::now());

		if(\Auth::user()->Region == 'Provinsi')
		{
			$data->where('kontak.KodeProvinsi', \Auth::user()->KodeProvinsi);
		}

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

		if(\Auth::user()->Region == 'Provinsi')
		{
			$kontak->where('kontak.KodeProvinsi', \Auth::user()->KodeProvinsi);
		}

        return $kontak->get();
	}

	protected function flushKontakCache()
	{
		\Cache::flush();
	}
}
