<?php
/**
 * Project: ehousing-3.0
 * Date: 6/11/16
 * Time: 15:50
 */

namespace Front\Provinsi;


use Carbon\Carbon;
use Datatables;

class FileController extends \BaseController
{
    public function getKebijakan($provinsiSlug)
    {
        $provinsi = \Provinsi::slug($provinsiSlug)->first();
        return \View::make('front.file', compact('provinsi'))
            ->with('jenis',\Berkas::KEBIJAKAN);

    }

    public function getPenelitian($provinsiSlug)
    {
        $provinsi = \Provinsi::slug($provinsiSlug)->first();
        return \View::make('front.file', compact('provinsi'))
            ->with('jenis',\Berkas::PENELITIAN);
    }

    public function getInformasi($provinsiSlug)
    {
        $provinsi = \Provinsi::slug($provinsiSlug)->first();
        return \View::make('front.file', compact('provinsi'))
            ->with('jenis',\Berkas::INFORMASI);
    }

    public function getStandarHargaMaterial($provinsiSlug)
    {
        $provinsi = \Provinsi::slug($provinsiSlug)->first();
        return \View::make('front.file', compact('provinsi'))
            ->with('jenis',\Berkas::STANDAR_HARGA_MATERIAL);
    }

    public function data()
    {
        $jenisBerkas = \Input::get('jenis');
        $provinsiId = \Input::get('provinsi');

        $berkas = \Berkas::select(array(
            'file.*'
        ))
            ->where('file.ExpiryDate','>',Carbon::now());

        if(\Input::has('jenis') || $jenisBerkas != '' || !is_null($jenisBerkas))
        {
            // $berkas->where('file.categoryfile', $jenisBerkas);
        }

        if(\Input::has('provinsi') || $provinsiId != '' || !is_null($provinsiId))
        {
            // $berkas->where('file.KodeProvinsi', $provinsiId);
        }

        $datatables = Datatables::of($berkas)
            ->editColumn('filename', function($data) {
                $html = "<a href='#'>{$data->filename}</a>";
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
            ->make(true);

        return $datatables;
    }
}