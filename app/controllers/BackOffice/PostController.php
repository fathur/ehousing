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

        return \View::make('back.post.create', compact('listCategories','listProvinces'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {

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

        $result = \Post::create(array(
            'Judul' => \Input::get('Judul'),
            'KategoriId' => \Input::get('KategoriId'),
            'IsiPost' => \Input::get('IsiPost'),
            'Foto' => $newName,
            'PostStatus' => \Input::has('PostStatus') ? true : false,
            'ExpiryDate' => \Input::get('ExpiryDate'),
            'PublishDate' => \Input::get('PublishDate'),
            'ShareSocmed' => \Input::has('ShareSocmed') ? true : false,
            'JumlahVisit' => \Input::get('JumlahVisit'),
            'IzinKomentar' => \Input::has('IzinKomentar') ? true : false,
            'Region' => \Input::get('Region'),
            'KodeProvinsi' => \Input::get('KodeProvinsi')
        ));


        if($result)
            return \Redirect::route('back-office.post.edit', $result->PostId)
                ->with('message', 'Data berhasil diubah')
                ->with('class', 'success');

        return \Redirect::route('back-office.post.create')
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
        $data = \Post::find($id);
        // do something here
        $data->save();

        return \Redirect::route('back-office.post.edit', array($data->PostId))
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
        return \Post::destroy($id);
    }

    public function data()
    {

        $data = \Post::select(array(
            'post.*', 'kategori.NamaKategori','user.Nama AS user_nama'
        ))->leftJoin('kategori','kategori.KategoriId','=','post.KategoriId')
            ->leftJoin('user','user.UserId','=','post.CreateUid')
            ->where('post.ExpiryDate','>',Carbon::now());

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
}