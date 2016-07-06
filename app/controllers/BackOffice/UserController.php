<?php
namespace BackOffice;

use Carbon\Carbon;
use Datatables;
use Illuminate\Http\Response;

class UserController extends AdminController {

	protected $identifier = 'user';

    protected $regions = array(
            'Provinsi'	=> 'Provinsi',
            'Nasional'	=> 'Nasional'
        );

    protected $statuses = array(
            'Non-Active'    => 'Non Active',
            'Active'        => 'Active',
            'Pending'       => 'Pending',
        );



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
        return \View::make('back.user.create')
            ->with('regions', $this->regions)
            ->with('statuses', $this->statuses);

	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $rules = array(
            'UserPassword'          => 'required',
            'UserPasswordConfirm'   => 'required',
        );

		$validator = \Validator::make(\Input::all(), $rules);

        if(!$validator->fails())
        {
			$postData = array(
				'UserName' => \Input::get('UserName'),
				'Nama' => \Input::get('Nama'),
				'UserPassword' => \Hash::make(\Input::get('UserPassword')),
				'Email' => \Input::get('Email'),
				'UserStatus' => \Input::get('UserStatus'),
				'Region' => \Input::get('Region'),
				'KodeProvinsi' => \Input::get('KodeProvinsi')

			);

			// Provinsi
			if(\Auth::user()->Region == 'Provinsi')
			{
				array_push($postData, array(
					'KodeProvinsi' => \Auth::user()->KodeProvinsi,
					'Region' => 'Provinsi',
				));
			}
			// Nasional
			else
			{
				array_push($postData, array(
					'KodeProvinsi' => \Input::get('KodeProvinsi'),
					'Region' => \Input::get('Region'),
				));
			}

            $result = \User::create($postData);

            if($result)
                return \Redirect::route('back-office.user.edit', $result->UserId)
                    ->with('message', 'Data berhasil diubah')
                    ->with('class', 'success');
        }

        return \Redirect::route('back-office.user.create')
            ->with('message', 'Data gagal diubah')
            ->with('class', 'danger')
            ->withInput();
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

		return \View::make('back.user.edit', compact('data'))
            ->with('regions', $this->regions)
            ->with('statuses', $this->statuses);
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

		if(\Auth::user()->Region == 'Provinsi') {
			$data->KodeProvinsi = \Auth::user()->KodeProvinsi;
			$data->Region = 'Provinsi';

		}
		else {
			$data->KodeProvinsi = \Input::get('KodeProvinsi');
			$data->Region = \Input::get('Region');

		}

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
			$data->where('user.KodeProvinsi', \Input::get('provinsi'));
		}

		if(\Auth::user()->Region == 'Provinsi')
		{
			$data->where('user.KodeProvinsi', \Auth::user()->KodeProvinsi);
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
					->with('table', $this->identifier . '-datatables')
					->with('url', route('back-office.user.destroy', array($data->id)))
					->with('edit_action', route('back-office.user.edit', array($data->id)))
					->render();
			})
			->make(true);

		return $datatables;

	}

}
