<?php
/**
 * Project: ehousing-3.0
 * Date: 6/13/16
 * Time: 14:01
 */

namespace Front;


use Carbon\Carbon;
use Repositories\Feeds\FeedReader;
use Repositories\DataProvider\Provinsi as ProvinsiDataProvider;

class NasionalController extends \BaseController
{
    protected $title = 'Home';

    public function getDashboard()
    {
        try {
            $data = new ProvinsiDataProvider();

            $provinsiNews               = $data->setLimit(3)->getNews();
            $provinsiInformation        = $data->setLimit(3)->getInformasi();
            $provinsiPrograms           = $data->setLimit(10)->getPrograms();
            $provinsiFile               = $data->setLimit(3)->getFileByCategory(array());
            $provinsiHunian             = $data->setLimit(5)->getHunian();
            $provinsiKontakDeveloper    = $data->setLimit(5)->getContactDevelopers();
            $provinsiKontakArsitek      = $data->setLimit(5)->getContactArsitek();
            $provinsiKontakKontraktor   = $data->setLimit(5)->getContactContractor();
            $provinsiKontakTukang       = $data->setLimit(5)->getContactTukang();
            $provinsiKontakSupplier     = $data->setLimit(5)->getContactSupplier();

            $feedReader = new FeedReader();
            $feedReader->setUrl(array(
                'http://inside.kompas.com/getrss/propertiarsitektur',
                'http://inside.kompas.com/getrss/propertiberita',
                'http://inside.kompas.com/getrss/propertikawasanterpadu',
                'http://inside.kompas.com/getrss/propertihunian',
                'http://rss.detik.com/index.php/finance',
            ));

            $provinsiFeeds = $feedReader->generate();


            return \View::make('front.nasional.dashboard')
                ->with('news', $provinsiNews)
                ->with('information', $provinsiInformation)
                ->with('programs', $provinsiPrograms)
                ->with('files', $provinsiFile)
                ->with('feeds', $provinsiFeeds)
                ->with('hunian', $provinsiHunian)
                ->with('developers', $provinsiKontakDeveloper)
                ->with('arsitek', $provinsiKontakArsitek)
                ->with('kontraktor', $provinsiKontakKontraktor)
                ->with('tukang', $provinsiKontakTukang)
                ->with('supplier', $provinsiKontakSupplier);
        }
        catch(\Exception $e)
        {

        }
    }

    public function getProfile()
    {
        try {
            $tahun = \Input::get('tahun', Carbon::now()->subYear()->year);

            $data = ProvinsiDataProvider::create()
                ->setYear($tahun);

            $totalAnggaran      = $data->getTotalAnggaran();
            $totalBackLog       = $data->getTotalBacklog();
            $totalJumlahRumah   = $data->getTotalJumlahRumah();
            $totalAPBD          = $data->getTotalAPBD();

            // Weird
            $statistikBackLog   = ProvinsiDataProvider::create()
                ->setYear($tahun)
                ->getStatistikBacklog();

            $statistikAnggaran  = ProvinsiDataProvider::create()
                ->setYear($tahun)
                ->getStatistikAnggaran();

            $filterStatistic      = ProvinsiDataProvider::create()
                ->setYear($tahun)
                ->getStatistikAPBD();

            return \View::make('front.nasional.profile', compact(
                'totalAnggaran','totalBackLog','totalJumlahRumah','totalAPBD',
                'statistikAnggaran','statistikBackLog','filterStatistic'
            ))
                ->with('fields', \ProfilProvinsi::$fields)
                ->with('title', 'Profile Nasional ')
                ->with('kolom', 'TotalPenduduk');

        }
        catch (\Exception $e){

        }
    }
}