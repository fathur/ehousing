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

		// dd(\Input::all());
		$result = \Berkas::create(array(
			// ...
			'filename' => $file->getClientOriginalName(),
			'url' => $newName,
			'file_size' => $file->getSize(),
			'raw_name' => $file->getClientOriginalName(),
			'fileext' => $file->getExtension(),
			'description' => \Input::get('description'),
			'categoryfile' => \Input::get('categoryfile'),
			'Judul' => \Input::get('Judul')
		));


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
		$data = \Berkas::find($id);

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
			->addColumn('action', function($data){

				return View::make('back.action')
					->with('table', $this->identifier . '-datatables')
					->with('url', route('back-office.file.destroy', array($data->id)))
					->with('edit_action', route('back-office.file.edit', array($data->id)))
					->render();
			})
			->make(true);

		return $datatables;
	}
}
