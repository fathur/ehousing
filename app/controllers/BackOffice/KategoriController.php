<?php
/**
 * Project: ehousing-3.0
 * Date: 6/15/16
 * Time: 09:36
 */

namespace BackOffice;


use Carbon\Carbon;
use Datatables;
use Response;
use View;

class KategoriController extends AdminController
{
    protected $identifier = 'kategori';

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return \View::make('back.kategori.index')
            ->with('datatablesRoute', route('back-office.kategori.data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return \View::make('back.kategori.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $result = \Kategori::create(array(
            'NamaKategori' => \Input::get('NamaKategori'),
            'ExpiryDate' => '9999-12-31 00:00:00'
        ));


        if($result)
            return \Redirect::route('back-office.kategori.edit', $result->KategoriId)
                ->with('message', 'Data berhasil diubah')
                ->with('class', 'success');

        return \Redirect::route('back-office.kategori.create')
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
        $data = \Kategori::find($id);

        return \View::make('back.kategori.edit', compact('data'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $data = \Kategori::find($id);
        $data->NamaKategori =  \Input::get('NamaKategori');
        $data->save();

        return \Redirect::route('back-office.kategori.edit', array($data->KategoriId))
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
        return \Kategori::destroy($id);
    }

    public function data()
    {

        $data = \Kategori::select(array(
            'kategori.*'
        ))->where('kategori.ExpiryDate','>',Carbon::now());

        $datatables = Datatables::of($data)
            ->addColumn('action', function($data){

                return View::make('back.action')
                    ->with('table', $this->identifier)
                    ->with('url', route('back-office.kategori.destroy', array($data->id)))
                    ->with('edit_action', route('back-office.kategori.edit', array($data->id)))
                    ->render();
            })
            ->make(true);

        return $datatables;
    }
}