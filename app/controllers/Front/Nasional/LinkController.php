<?php
/**
 * Project: ehousing-3.0
 * Date: 6/11/16
 * Time: 15:53
 */

namespace Front\Nasional;


use Carbon\Carbon;
use Datatables;

class LinkController extends \BaseController
{
    public function getImb()
    {
        return \View::make('front.link.index')
            ->with('jenis', \LinkInfo::IMB)
            ->with('linkTitle', 'Daftar Link - IMB')
            ->with('datatablesRoute', route('front.nasional.link.data'));
    }

    public function getPbb()
    {
        return \View::make('front.link.index')
            ->with('jenis', \LinkInfo::PBB)
            ->with('linkTitle', 'Daftar Link - PBB')
            ->with('datatablesRoute', route('front.nasional.link.data'));
    }

    public function getTataRuang()
    {
        return \View::make('front.link.index')
            ->with('jenis', \LinkInfo::TATA_RUANG)
            ->with('linkTitle', 'Daftar Link - Tata Ruang')
            ->with('datatablesRoute', route('front.nasional.link.data'));
    }

    public function getBpn()
    {
        return \View::make('front.link.index')
            ->with('jenis', \LinkInfo::BPN)
            ->with('linkTitle', 'Daftar Link - BPN')
            ->with('datatablesRoute', route('front.nasional.link.data'));
    }

    public function getPermukiman()
    {
        return \View::make('front.link.index')
            ->with('jenis', \LinkInfo::MKM)
            ->with('linkTitle', 'Daftar Link - Permukiman')
            ->with('datatablesRoute', route('front.nasional.link.data'));
    }

    public function data()
    {
        $jenisLink = \Input::get('jenis');

        $link = \LinkInfo::select(array(
            'linkinfo.*',
            'kota.NamaKota'

        ))
            ->leftJoin('kota','linkinfo.KodeKota','=','kota.KodeKota')
            ->where('linkinfo.ExpiryDate','>',Carbon::now());

        if(\Input::has('jenis') || $jenisLink != '' || !is_null($jenisLink))
        {
            $link->where('linkinfo.GrupLinkInfo', $jenisLink);
        }



        $datatables = Datatables::of($link)
            ->editColumn('LinkInfo', function($data) {
                return "<a href='{$data->LinkInfo}' target='_blank'>{$data->LinkInfo}</a>";
            })
            ->editColumn('NamaKota', function($data) {
                if(is_null($data->NamaKota))
                    return '-';

                return $data->NamaKota;
            })
            ->make(true);
        return $datatables;

    }
}