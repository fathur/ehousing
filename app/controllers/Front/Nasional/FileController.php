<?php
/**
 * Project: ehousing-3.0
 * Date: 6/11/16
 * Time: 15:50
 */

namespace Front\Nasional;

use Carbon\Carbon;
use Datatables;
use Illuminate\Filesystem\FileNotFoundException;

/**
 * Class FileController
 * @package Front\Nasional
 */
class FileController extends \BaseController
{
    /**
     * @return $this
     * @author Fathur Rohman <fathur_rohman17@yahoo.co.id>
     */
    public function getKebijakan()
    {
        return \View::make('front.file.index')
            ->with('jenis',\Berkas::KEBIJAKAN)
            ->with('datatablesRoute', route('front.nasional.file.data'));

    }

    public function getPenelitian()
    {
        return \View::make('front.file.index')
            ->with('jenis',\Berkas::PENELITIAN)
            ->with('datatablesRoute', route('front.nasional.file.data'));
    }

    public function getInformasi()
    {
        return \View::make('front.file.index')
            ->with('jenis',\Berkas::INFORMASI)
            ->with('datatablesRoute', route('front.nasional.file.data'));

    }

    public function getStandarHargaMaterial()
    {
        return \View::make('front.file.index')
            ->with('jenis',\Berkas::STANDAR_HARGA_MATERIAL)
            ->with('datatablesRoute', route('front.nasional.file.data'));

    }

    public function data()
    {
        $jenisBerkas = \Input::get('jenis');

        $berkas = \Berkas::select(array(
            'file.*',
            'kota.NamaKota'

        ))
            ->leftJoin('kota','file.KodeKota','=','kota.KodeKota')
            ->where('file.ExpiryDate','>',Carbon::now());

        if(\Input::has('jenis') || $jenisBerkas != '' || !is_null($jenisBerkas))
        {
            $berkas->where('file.categoryfile', $jenisBerkas);
        }

        if(\Input::has('kota'))
        {
            $kota = (int) \Input::get('kota');


            if($kota != 0) {
                $berkas->where('kota.KodeKota', $kota);
            }
        }

        $datatables = Datatables::of($berkas)
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
            ->editColumn('NamaKota', function($data) {
                if(is_null($data->NamaKota))
                    return '-';

                return $data->NamaKota;
            })
            ->make(true);

        return $datatables;
    }

    /**
     * @param $type
     * @param $url
     * @return mixed
     * @author Fathur Rohman <fathur_rohman17@yahoo.co.id>
     */
    public function show($type, $url)
    {
        switch ($type) {
            case 'post':
            case 'posts':
                $location = 'post/' . $url;
                break;
            case 'profile':
                $location = 'profile/' . $url;
                break;
            case 'hunian':
                $location = 'hunian/' . $url;
                break;
            case 'kontak':
                $location = 'kontak/' . $url;
                break;
            default:
                $location = $url;
        }

        return \Image::make(storage_path('uploads/'. $location))->response();
    }

    /**
     * @param $url
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     * @author Fathur Rohman <fathur_rohman17@yahoo.co.id>
     */
    public function download($url)
    {
        if(file_exists(storage_path('uploads/file/'.$url))) {
            $download = \Response::download(storage_path('uploads/file/' . $url), $url);

            $berkas = \Berkas::where('url', $url)->first();
            $downloadCounter = $berkas->downloadcounter;
            $berkas->downloadcounter = (int)$downloadCounter + 1;
            $berkas->save();

            return $download;
        }

        \App::abort(404);
    }
}