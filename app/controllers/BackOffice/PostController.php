<?php
/**
 * Project: ehousing-3.0
 * Date: 6/11/16
 * Time: 15:56
 */

namespace BackOffice;


use Carbon\Carbon;
use Datatables;
use Response;

class PostController extends AdminController
{
    protected $identifier = 'post';

    protected $rules = array(
        'Judul'	=> 'required',
        'KategoriId' => 'required',
        'Region' => 'required'
    );

    protected $messages = array(
        'Judul.required'	=> 'Judul tidak boleh kosong',
        'KategoriId.required'	=> 'Kategori tidak boleh kosong',
        'Region.required'	=> 'Region tidak boleh kosong',

    );

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return \View::make('back.post.index')
            ->with('datatablesRoute', route('back-office.post.data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $listCategories = \Kategori::lists('NamaKategori','KategoriId');
        $listProvinces = \Provinsi::lists('NamaProvinsi','KodeProvinsi');

        array_unshift($listCategories, '- Pilih Kategori -');
        array_unshift($listProvinces, '- Pilih Provinsi -');

        return \View::make('back.post.create', compact('listCategories','listProvinces'));
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
            return \Redirect::route('back-office.post.create')
                ->withErrors($validator)
                ->with('class', 'danger')
                ->withInput();
        }

        if(\Input::hasFile('userfile'))
        {
            $file = \Input::file('userfile');
            $destination = storage_path('uploads/post/');
            $newName = $file->getClientOriginalName();

            if($file->isValid())
            {
                $file->move($destination, $newName);
            }
        }
        else
        {
            $newName = null;
        }

        $postData = array(
            'Judul' => \Input::get('Judul'),
            'KategoriId' => \Input::get('KategoriId'),
            'IsiPost' => \Input::get('IsiPost'),
            'Foto' => $newName,
            'PostStatus' => \Input::has('PostStatus') ? true : false,
            'PublishDate' => \Input::get('PublishDate'),
            'ShareSocmed' => \Input::has('ShareSocmed') ? true : false,
            'JumlahVisit' => \Input::get('JumlahVisit'),
            'IzinKomentar' => \Input::has('IzinKomentar') ? true : false,

            'ExpiryDate'	=> \EhousingModel::DEFAULT_EXPIRY_DATE,
            'CreateUid'		=> \Auth::user()->id
        );

        // Menentukan apakah menggunakan kode provinsi atau tidak
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

        $result = \Post::create($postData);

        $this->flushPostCache();

        if($result)
            return \Redirect::route('back-office.post.edit', $result->PostId)
                ->with('message', 'Data berhasil disimpan')
                ->with('class', 'success');

        return \Redirect::route('back-office.post.create')
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
        $data = \Post::find($id);

        $listCategories = \Kategori::lists('NamaKategori','KategoriId');
        $listProvinces = \Provinsi::lists('NamaProvinsi','KodeProvinsi');
        $regions = array(
            'Nasional' => 'Nasional',
            'Provinsi' => 'Provinsi',
        );

        return \View::make('back.post.edit', compact('data','listCategories','listProvinces','regions'));
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
            return \Redirect::route('back-office.post.edit', array($id))
                ->withErrors($validator)
                ->with('class', 'danger')
                ->withInput();
        }

        if(\Input::hasFile('userfile'))
        {
            $file = \Input::file('userfile');
            $destination = storage_path('uploads/post/');
            $newName = $file->getClientOriginalName();

            if($file->isValid())
            {
                $file->move($destination, $newName);
            }
        }
        else
        {
            $newName = \Input::get('Foto');
        }

        $data = \Post::find($id);
        // do something here
        $data->Judul = \Input::get('Judul');
        $data->KategoriId = \Input::get('KategoriId');
        $data->IsiPost = \Input::get('IsiPost');
        $data->Foto = $newName;
        $data->PostStatus = \Input::has('PostStatus') ? true : false;
        $data->PublishDate = \Input::get('PublishDate');
        $data->ShareSocmed = \Input::has('ShareSocmed') ? true : false;
        $data->JumlahVisit = \Input::get('JumlahVisit');
        $data->IzinKomentar = \Input::has('IzinKomentar') ? true : false;

        if(\Auth::user()->Region == 'Provinsi') {
            $data->KodeProvinsi = \Auth::user()->KodeProvinsi;
            $data->Region = 'Provinsi';

        }
        else {
            $data->KodeProvinsi = \Input::get('KodeProvinsi');
            $data->Region = \Input::get('Region');

        }

        $data->ModUid = \Auth::user()->id;

        $this->flushPostCache();

        if($data->save()) {

            return \Redirect::route('back-office.post.edit', array($id))
                ->with('message', 'Data berhasil diubah')
                ->with('class', 'success');
        }

        return \Redirect::route('back-office.post.edit', array($id))
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
        $this->flushPostCache();

        return \Post::destroy($id);
    }

    public function data()
    {

        $data = \Post::select(array(
            'post.*', 'kategori.NamaKategori','user.Nama AS user_nama'
        ))->leftJoin('kategori','kategori.KategoriId','=','post.KategoriId')
            ->leftJoin('user','user.UserId','=','post.CreateUid')
            ->where('post.ExpiryDate','>',Carbon::now());

        if(\Auth::user()->Region == 'Provinsi')
        {
            $data->where('post.KodeProvinsi', \Auth::user()->KodeProvinsi);
        }

        $datatables = Datatables::of($data)
            ->addColumn('action', function($data){

                return \View::make('back.action')
                    ->with('table', $this->identifier . '-datatables')
                    ->with('url', route('back-office.post.destroy', array($data->id)))
                    ->with('edit_action', route('back-office.post.edit', array($data->id)))
                    ->render();
            })
            ->make(true);

        return $datatables;
    }

    protected function flushPostCache()
    {
        \Cache::flush();
    }
}