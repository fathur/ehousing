<?php
namespace BackOffice;

class SitusController extends AdminController {


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function edit()
	{
		$kodeProvinsi = \Auth::user()->KodeProvinsi;

		if (\Auth::user()->Region == 'Provinsi') {

			$data = \KonfigurasiSitus::where('KodeProvinsi', $kodeProvinsi)->first();

			return \View::make('back.situs.edit', compact('data'));
		}

		\App::abort(404);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update()
	{
		$kodeProvinsi = \Auth::user()->KodeProvinsi;

		if (\Auth::user()->Region == 'Provinsi') {

			$data = \KonfigurasiSitus::where('KodeProvinsi', $kodeProvinsi)->first();


			if(\Input::hasFile('userfile'))
			{
				$file = \Input::file('userfile');
				$destination = storage_path('uploads/profile/');
				$newName = $file->getClientOriginalName();

				if($file->isValid())
				{
					$file->move($destination, $newName);
				}
			}
			else
			{
				$newName = \Input::get('Logo');
			}

			if(\Input::hasFile('StrukturOrg'))
			{
				$fileStruktur = \Input::file('StrukturOrg');
				$destinationStruktur = storage_path('uploads/profile/');
				$strukturName = $fileStruktur->getClientOriginalName();

				if($fileStruktur->isValid())
				{
					$fileStruktur->move($destinationStruktur, $strukturName);
				}

				$data->StrukturOrg =  $strukturName;

			}


			$data->Nama =  \Input::get('Nama');
			$data->Deskripsi =  \Input::get('Deskripsi');
			$data->tentang_kami =  \Input::get('tentang_kami');
			$data->ibukota =  \Input::get('ibukota');
			// $data->Tagline =  \Input::get('Tagline');
			$data->Alamat1 =  \Input::get('Alamat1');
			$data->Alamat2 =  \Input::get('Alamat2');
			$data->Alamat3 =  \Input::get('Alamat3');
			$data->Logo =  $newName;
			$data->VisiMisi =  \Input::get('VisiMisi');
			$data->Email =  \Input::get('Email');
			// $data->KodeProvinsi =  \Input::get('KodeProvinsi');
			$data->NamaGubernur =  \Input::get('NamaGubernur');
			$data->NamaWakilGubernur =  \Input::get('NamaWakilGubernur');
			$data->PeriodeJabatan =  \Input::get('PeriodeJabatan');
			$data->KelembagaanPerkim =  \Input::get('KelembagaanPerkim');
			$data->LetakGeografis =  \Input::get('LetakGeografis');
			// $data->Kabupaten =  \Input::get('Kabupaten');
			// $data->Kota =  \Input::get('Kota');
			$data->NamaCP =  \Input::get('NamaCP');
			$data->NoTelpCP =  \Input::get('NoTelpCP');
			$data->EmailCP =  \Input::get('EmailCP');
			$data->TotalLuas =  \Input::get('TotalLuas');
			$data->Daratan =  \Input::get('Daratan');
			$data->Lautan =  \Input::get('Lautan');
			$data->Website =  \Input::get('Website');
			// $data->JumlahVisit =  \Input::get('JumlahVisit');

			if($data->save()) {

				return \Redirect::route('back-office.provinsi.setting.edit')
					->with('message', 'Data berhasil diubah')
					->with('class', 'success');
			}

			return \Redirect::route('back-office.provinsi.setting.edit')
				->with('message', 'Data gagal diubah')
				->with('class', 'danger')
				->withInput();
		}

		\App::abort(404);
	}
}
