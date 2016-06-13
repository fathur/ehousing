<?php
/**
 * Project: ehousing-3.0
 * Date: 6/11/16
 * Time: 15:50
 */

namespace Front\Provinsi;


use Carbon\Carbon;
use Datatables;

/**
 * Class FileController
 * @package Front\Provinsi
 */
class FileController extends \BaseController
{
    public function getAll($provinsiSlug)
    {
        $provinsi = \Provinsi::slug($provinsiSlug)->first();

        if(is_null($provinsi))
            \App::abort(404);

        return \View::make('front.file.index', compact('provinsi'))
            ->with('datatablesRoute', route('front.provinsi.file.data', array($provinsiSlug)));
    }
    /**
     * @param $provinsiSlug
     * @return $this
     * @author Fathur Rohman <fathur_rohman17@yahoo.co.id>
     */
    public function getKebijakan($provinsiSlug)
    {
        $provinsi = \Provinsi::slug($provinsiSlug)->first();

        if(is_null($provinsi))
            \App::abort(404);

        return \View::make('front.file.index', compact('provinsi'))
            ->with('jenis',\Berkas::KEBIJAKAN)
            ->with('datatablesRoute', route('front.provinsi.file.data', array($provinsiSlug)));

    }

    /**
     * @param $provinsiSlug
     * @return $this
     * @author Fathur Rohman <fathur_rohman17@yahoo.co.id>
     */
    public function getPenelitian($provinsiSlug)
    {
        $provinsi = \Provinsi::slug($provinsiSlug)->first();

        if(is_null($provinsi))
            \App::abort(404);

        return \View::make('front.file.index', compact('provinsi'))
            ->with('jenis',\Berkas::PENELITIAN)
            ->with('datatablesRoute', route('front.provinsi.file.data', array($provinsiSlug)));

    }

    /**
     * @param $provinsiSlug
     * @return $this
     * @author Fathur Rohman <fathur_rohman17@yahoo.co.id>
     */
    public function getInformasi($provinsiSlug)
    {
        $provinsi = \Provinsi::slug($provinsiSlug)->first();

        if(is_null($provinsi))
            \App::abort(404);

        return \View::make('front.file.index', compact('provinsi'))
            ->with('jenis',\Berkas::INFORMASI)
            ->with('datatablesRoute', route('front.provinsi.file.data', array($provinsiSlug)));

    }

    /**
     * @param $provinsiSlug
     * @return $this
     * @author Fathur Rohman <fathur_rohman17@yahoo.co.id>
     */
    public function getStandarHargaMaterial($provinsiSlug)
    {
        $provinsi = \Provinsi::slug($provinsiSlug)->first();

        if(is_null($provinsi))
            \App::abort(404);
        
        return \View::make('front.file.index', compact('provinsi'))
            ->with('jenis',\Berkas::STANDAR_HARGA_MATERIAL)
            ->with('datatablesRoute', route('front.provinsi.file.data', array($provinsiSlug)));

    }

    /**
     * @return null
     * @author Fathur Rohman <fathur_rohman17@yahoo.co.id>
     */
    public function data()
    {
        $jenisBerkas = \Input::get('jenis');
        $provinsiId = \Input::get('provinsi');

        $berkas = \Berkas::select(array(
            'file.*'
        ))
            ->where('file.ExpiryDate','>',Carbon::now());

        if(\Input::has('provinsi') || $provinsiId != '' || !is_null($provinsiId))
        {
            $berkas->where(function($query) use ($provinsiId, $jenisBerkas)
            {
                $query->where('file.KodeProvinsi', $provinsiId);

                if (!\Input::has('jenis') || $jenisBerkas == '')
                {
                    $query->orWhere('file.KodeProvinsi', '-');
                    $query->orWhereNull('file.KodeProvinsi');
                }
            });
        }

        if(\Input::has('jenis') || $jenisBerkas != '')
        {
            $berkas->where('file.categoryfile', $jenisBerkas);
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
            ->make(true);

        return $datatables;
    }
}