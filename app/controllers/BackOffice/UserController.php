<?php
namespace BackOffice;

use Carbon\Carbon;
use Datatables;
use Illuminate\Http\Response;

class UserController extends AdminController {

	protected $identifier = 'user';

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return \View::make('back.user.index')
			->with('datatablesRoute', route('back-office.user.data'));

	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$data = \User::with('provinsi')->find($id);
		$regions = array(
			'Provinsi'	=> 'Provinsi',
			'Nasional'	=> 'Nasional'
		);

		$statuses = array(
			'Non-Active' => 'Non Active',
			'Active' => 'Active',
			'Pending' => 'Pending',
		);

		return \View::make('back.user.edit', compact('data','regions','statuses'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$data = \User::find($id);
		$data->UserName = \Input::get('UserName');
		$data->Nama = \Input::get('Nama');
		$data->Email = \Input::get('Email');
		$data->UserStatus = \Input::get('UserStatus');
		$data->Region = \Input::get('Region');
		$data->KodeProvinsi = \Input::get('KodeProvinsi');
		$data->save();

		return \Redirect::route('back-office.user.edit', array($data->UserId))
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
		//
	}

	public function data()
	{
		$data = \User::select(array(
			'user.*','provinsi.NamaProvinsi'
		))->leftJoin('provinsi','provinsi.KodeProvinsi','=','user.KodeProvinsi')
			->where('user.ExpiryDate','>',Carbon::now());

		if(\Input::has('provinsi'))
		{
			$data->where('KodeProvinsi', \Input::get('provinsi'));
		}

		$datatables = Datatables::of($data)
			->editColumn('NamaProvinsi', function($data) {
				if($data->Region == 'Provinsi') {
					return $data->NamaProvinsi;
				}
				else {
					return '-';
				}
			})
			->addColumn('action', function($data){

				return \View::make('back.user.action')
					->with('table', $this->identifier)
					->with('url', route('back-office.user.destroy', array($data->id)))
					->with('edit_action', route('back-office.user.edit', array($data->id)))
					->render();
			})
			->make(true);

		return $datatables;

	}

}
