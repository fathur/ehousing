<?php

namespace BackOffice;

use Carbon\Carbon;
use Datatables;
use Symfony\Component\HttpFoundation\File\Exception\UploadException;
use View;
use File as Berkas;

class FileController extends AdminController {

	protected $title = 'File';
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return \View::make('back.file.index')
			->with('datatablesRoute', route('back-office.file.data'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$categories = \Referensi::where('RefId','KPU')
			->orderBy('deskripsi','asc')
			->lists('Deskripsi','KodeRef');

		array_unshift($categories, '- Pilih Satu -');

		return \View::make('back.file.create', compact('categories'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if(\Input::hasFile('filename'))
		{
			$file = \Input::file('filename');
			$destination = storage_path('uploads/file/');
			$newName = $file->getClientOriginalName();

			if($file->isValid())
			{
				$file->move($destination, $newName);
			}
		}
		else
		{
			throw new UploadException('Nothing to upload');
		}

		$postData = array(
			// ...
			'filename' => $file->getClientOriginalName(),
			'url' => $newName,
			'file_size' => $file->getSize(),
			'raw_name' => $file->getClientOriginalName(),
			'fileext' => $file->getClientOriginalExtension(),
			'description' => \Input::get('description'),
			'categoryfile' => \Input::get('categoryfile'),
			'KodeKota' => \Input::get('KodeKota'),
			'Judul' => \Input::get('Judul'),
			'ExpiryDate' => '9999-12-31 00:00:00'
		);

		// Provinsi
		if(\Auth::user()->Region == 'Provinsi') {

			$postData['KodeProvinsi'] = \Auth::user()->KodeProvinsi;
		}
		// Nasional
		else {

			$postData['KodeProvinsi'] = \Input::get('KodeProvinsi');
		}


		// dd(\Input::all());
		$result = \Berkas::create($postData);


		if($result)
			return \Redirect::route('back-office.file.edit', $result->fileid)
				->with('message', 'Data berhasil diubah')
				->with('class', 'success');

		return \Redirect::route('back-office.file.create')
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
		$data = \Berkas::with('kota','provinsi')
			->find($id);

		$categories = \Referensi::where('RefId','KPU')
			->orderBy('deskripsi','asc')
			->lists('Deskripsi','KodeRef');

		array_unshift($categories, '- Pilih Satu -');

		return \View::make('back.file.edit', compact('data','categories'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$data = \Berkas::find($id);

		if(\Input::hasFile('filename'))
		{
			$file = \Input::file('filename');
			$destination = storage_path('uploads/file/');
			$newName = $file->getClientOriginalName();

			if($file->isValid())
			{
				$file->move($destination, $newName);
			}


			$data->filename = $file->getClientOriginalName();
			$data->url = $newName;
			$data->file_size = $file->getSize();
			$data->raw_name = $file->getClientOriginalName();
			$data->fileext = $file->getClientOriginalExtension();
		}



		// ...
		// $data->filename = \Input::get('filename');
		// $data->url = \Input::get('url');
		// $data->file_size = \Input::get('file_size');
		$data->description = \Input::get('description');
		$data->categoryfile = \Input::get('categoryfile');
		// $data->publisheddate = \Input::get('publisheddate');
        // $data->module = \Input::get('module');
		// $data->refkey = \Input::get('refkey');
		// $data->fileext = \Input::get('fileext');
		// $data->filecontent = \Input::get('filecontent');
		// $data->downloadcounter = \Input::get('downloadcounter');
		// $data->sharecounter = \Input::get('sharecounter');
        // $data->raw_name = \Input::get('raw_name');
		// $data->KodeProvinsi = \Input::get('KodeProvinsi');
		$data->Judul = \Input::get('Judul');
		$data->KodeKota = \Input::get('KodeKota');

		if(\Auth::user()->Region == 'Provinsi') {
			$data->KodeProvinsi = \Auth::user()->KodeProvinsi;
		}
		else {
			$data->KodeProvinsi = \Input::get('KodeProvinsi');
		}

		$data->save();

		return \Redirect::route('back-office.file.edit', array($data->fileid))
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
		return \Berkas::destroy($id);
	}

	public function data()
	{

		$data = \Berkas::select(array(
			'file.*'
		))->where('file.ExpiryDate','>',Carbon::now());

		if(\Auth::user()->Region == 'Provinsi')
		{
			$data->where('file.KodeProvinsi', \Auth::user()->KodeProvinsi);
		}

		$datatables = Datatables::of($data)
			->editColumn('filename', function($data) {
				$html = "<a href='".route('front.file.download', array($data->url))."'>{$data->filename}</a>";
				return $html;
			})
			->editColumn('description', function($data) {
				if($data->description == '' || is_null($data->description))
				{
					return '-';
				}

				return $data->description;
			})
			->editColumn('categoryfile', function($data) {
				if($data->categoryfile == '' || is_null($data->categoryfile))
				{
					return '-';
				}

				return $data->categoryfile;
			})
			->editColumn('downloadcounter', function($data) {
				if($data->downloadcounter == '' || is_null($data->downloadcounter))
				{
					return 0;
				}

				return $data->downloadcounter;
			})
			->editColumn('file_size', function($data){
				return $this->formatBytes($data->file_size);
			})
			->addColumn('action', function($data){

				return View::make('back.file.action')
					->with('idfile', $data->fileid)
					->with('table', $this->identifier . '-datatables')
					->with('url', route('back-office.file.destroy', array($data->id)))
					->with('edit_action', route('back-office.file.edit', array($data->id)))
					->render();
			})
			->make(true);

		return $datatables;
	}

	public function download($id)
	{
		$file = \Berkas::find($id);

		return \Response::download(storage_path('uploads/file/'. $file->url));
	}


	private function formatBytes($bytes, $precision = 2) {
		$sz = 'BKMGTP';
		$factor = floor((strlen($bytes) - 1) / 3);
		return sprintf("%.{$precision}f ", $bytes / pow(1024, $factor), 'B') . @$sz[$factor] . 'B';
	}
}
