<?php
/**
 * Project: ehousing-3.0
 * Date: 6/11/16
 * Time: 15:53
 */

namespace Front\Provinsi;



use Carbon\Carbon;
use Datatables;

class LinkController extends \BaseController
{
    public function getImb($provinsiSlug)
    {
        $provinsi = \Provinsi::slug($provinsiSlug)->first();
        return \View::make('front.link.index', compact('provinsi'))
            ->with('jenis', \LinkInfo::IMB);

    }

    public function getPbb($provinsiSlug)
    {
        $provinsi = \Provinsi::slug($provinsiSlug)->first();
        return \View::make('front.link.index', compact('provinsi'))
            ->with('jenis', \LinkInfo::PBB);
    }

    public function getTataRuang($provinsiSlug)
    {
        $provinsi = \Provinsi::slug($provinsiSlug)->first();
        return \View::make('front.link.index', compact('provinsi'))
            ->with('jenis', \LinkInfo::TATA_RUANG);
    }

    public function getBpn($provinsiSlug)
    {
        $provinsi = \Provinsi::slug($provinsiSlug)->first();
        return \View::make('front.link.index', compact('provinsi'))
            ->with('jenis', \LinkInfo::BPN);
    }


    public function data()
    {
        $jenisLink = \Input::get('jenis');
        $provinsiId = \Input::get('provinsi');

        $link = \LinkInfo::select(array(
            'linkinfo.*'
        ))
            ->where('linkinfo.ExpiryDate','>',Carbon::now());

        if(\Input::has('jenis') || $jenisLink != '' || !is_null($jenisLink))
        {
            $link->where('linkinfo.GrupLinkInfo', $jenisLink);
        }

        if(\Input::has('provinsi') || $provinsiId != '' || !is_null($provinsiId))
        {
            $link->where('linkinfo.KodeProvinsi', $provinsiId);
        }

        $datatables = Datatables::of($link)
            ->editColumn('LinkInfo', function($data) {
                return "<a href='{$data->LinkInfo}' target='_blank'>{$data->LinkInfo}</a>";
            })
            ->make(true);
        return $datatables;

    }
}