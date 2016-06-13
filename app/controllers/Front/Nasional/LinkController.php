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
            ->with('datatablesRoute', route('front.nasional.link.data'));
    }

    public function getPbb()
    {
        return \View::make('front.link.index')
            ->with('jenis', \LinkInfo::PBB)
            ->with('datatablesRoute', route('front.nasional.link.data'));
    }

    public function getTataRuang()
    {
        return \View::make('front.link.index')
            ->with('jenis', \LinkInfo::TATA_RUANG)
            ->with('datatablesRoute', route('front.nasional.link.data'));
    }

    public function getBpn()
    {
        return \View::make('front.link.index')
            ->with('jenis', \LinkInfo::BPN)
            ->with('datatablesRoute', route('front.nasional.link.data'));
    }

    public function data()
    {
        $jenisLink = \Input::get('jenis');

        $link = \LinkInfo::select(array(
            'linkinfo.*'
        ))
            ->where('linkinfo.ExpiryDate','>',Carbon::now());

        if(\Input::has('jenis') || $jenisLink != '' || !is_null($jenisLink))
        {
            $link->where('linkinfo.GrupLinkInfo', $jenisLink);
        }



        $datatables = Datatables::of($link)
            ->editColumn('LinkInfo', function($data) {
                return "<a href='{$data->LinkInfo}' target='_blank'>{$data->LinkInfo}</a>";
            })
            ->make(true);
        return $datatables;

    }
}