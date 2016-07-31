<?php
/**
 * Created by PhpStorm.
 * User: akung
 * Date: 7/31/16
 * Time: 03:18
 */

namespace Front\Nasional;


use Carbon\Carbon;

class CallUsController extends \BaseController
{
    public function index()
    {
        $jenis = \Referensi::where('RefId', 'AJU')
            ->where('KodeRef','<>','AJU')
            ->orderBy('Deskripsi','asc')
            ->lists('Deskripsi','KodeRef');


        $provinces = \Provinsi::where('ExpiryDate','>',Carbon::now())
            ->lists('NamaProvinsi','KodeProvinsi');

        $provinces = array( 0 => '- pilih satu -') + $provinces;


        return \View::make('front.nasional.call', compact('jenis','provinces'));
    }

    public function store()
    {
        $pengajuan = new \Pengajuan();
        $pengajuan->Nama = \Input::get('Nama');
        $pengajuan->Alamat = \Input::get('Alamat');
        $pengajuan->KodeProvinsi = \Input::get('KodeProvinsi');
        $pengajuan->NoTelp = \Input::get('NoTelp');
        $pengajuan->NoHP = \Input::get('NoHP');
        $pengajuan->Email = \Input::get('Email');
        $pengajuan->KlasifikasiPengajuan = \Input::get('KlasifikasiPengajuan');
        $pengajuan->Deskripsi = \Input::get('Deskripsi');
        //$pengajuan->Jawaban = \Input::get('Jawaban');
/*
        $pengajuan->filename = \Input::get('filename');
        $pengajuan->raw_name = \Input::get('raw_name');
        $pengajuan->url = \Input::get('url');
        $pengajuan->file_size = \Input::get('file_size');
        $pengajuan->fileext = \Input::get('fileext');
        */
        $pengajuan->statusid = 'NEW';
        $pengajuan->ExpiryDate = '9999-12-31 00:00:00';

        if($pengajuan->save())
        {
            return \Redirect::route('front.nasional.call.index')
                ->with('status', 'Permintaan Anda berhasil disimpan.')
                ->with('class', 'success');
        }

        return \Redirect::route('front.nasional.call.index')
            ->with('status', 'Permintaan Anda gagal disimpan.')
            ->with('class', 'danger');
    }
}