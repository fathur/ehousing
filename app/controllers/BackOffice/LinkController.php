<?php
namespace BackOffice;

use Carbon\Carbon;
use Datatables;
use LinkInfo;
use View;

class LinkController extends AdminController
{

	protected $title      = 'Link';
	protected $identifier = 'link';

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return \View::make('back.link.index')
			->with('datatablesRoute', route('back-office.link.data'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

		$linkGroups = \Referensi::where('RefId', \Referensi::JENIS_LINK_INFO)
			->where('Flag', '0')
			->where('ExpiryDate', '>', Carbon::now())
			->orderBy('Deskripsi', 'asc')
			->lists('Deskripsi', 'KodeRef');

		return \View::make('back.link.create', compact('linkGroups'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$dataPost = [
			'GrupLinkInfo' => \Input::get('GrupLinkInfo'),
			'Judul'        => \Input::get('Judul'),
			'Deskripsi'    => \Input::get('Deskripsi'),
			'LinkInfo'     => \Input::get('LinkInfo'),
			'ExpiryDate'	=> \EhousingModel::DEFAULT_EXPIRY_DATE
		];

		// Provinsi
		if (\Auth::user()->Region == 'Provinsi') {
			$postData['KodeProvinsi'] = \Auth::user()->KodeProvinsi;
			$postData['Region'] = 'Provinsi';

		} // Nasional
		else {
			$postData['KodeProvinsi'] = \Input::get('KodeProvinsi');
			$postData['Region'] = 'Nasional';

		}

		// dd(\Input::all());
		$result = \LinkInfo::create($dataPost);

		if ($result)
			return \Redirect::route('back-office.link.edit', $result->LinkInfoId)
				->with('message', 'Data berhasil diubah')
				->with('class', 'success');

		return \Redirect::route('back-office.link.create')
			->with('message', 'Data gagal diubah')
			->with('class', 'danger')
			->withInput();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function edit($id)
	{
		$data = LinkInfo::with('provinsi')->find($id);
		$linkGroups = \Referensi::where('RefId', \Referensi::JENIS_LINK_INFO)
			->where('Flag', '0')
			->where('ExpiryDate', '>', Carbon::now())
			->orderBy('Deskripsi', 'asc')
			->lists('Deskripsi', 'KodeRef');

		return \View::make('back.link.edit', compact('data', 'linkGroups'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function update($id)
	{
		$data = \LinkInfo::find($id);
		// ...
		$data->GrupLinkInfo = \Input::get('GrupLinkInfo');
		$data->Judul = \Input::get('Judul');
		$data->Deskripsi = \Input::get('Deskripsi');
		$data->LinkInfo = \Input::get('LinkInfo');

		if (\Auth::user()->Region == 'Provinsi') {
			$data->KodeProvinsi = \Auth::user()->KodeProvinsi;
			$data->Region = 'Provinsi';

		} else {
			$data->KodeProvinsi = \Input::get('KodeProvinsi');
			$data->Region = 'Nasional';

		}

		$data->save();

		return \Redirect::route('back-office.link.edit', [$data->LinkInfoId])
			->with('message', 'Data berhasil diubah')
			->with('class', 'success');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		return \LinkInfo::destroy($id);
	}

	public function data()
	{

		$data = \LinkInfo::select([
			'linkinfo.*'
		])->where('linkinfo.ExpiryDate', '>', Carbon::now());

		if (\Auth::user()->Region == 'Provinsi') {
			$data->where('linkinfo.KodeProvinsi', \Auth::user()->KodeProvinsi);
		}

		$datatables = Datatables::of($data)
			->editColumn('LinkInfo', function ($data) {
				return "<a href='{$data->LinkInfo}' target='_blank'>{$data->LinkInfo}</a>";
			})
			->addColumn('action', function ($data) {

				return View::make('back.action')
					->with('table', $this->identifier . '-datatables')
					->with('url', route('back-office.link.destroy', [$data->id]))
					->with('edit_action', route('back-office.link.edit', [$data->id]))
					->render();
			})
			->make(true);

		return $datatables;
	}

}
