<?php
/**
 * Project: ehousing-3.0
 * Date: 6/11/16
 * Time: 18:07
 */

namespace Front;

use Carbon\Carbon;
use Provinsi;
use Repositories\DataProvider\PostNotFoundException;
use Repositories\DataProvider\Provinsi as ProvinsiDataProvider;
use Repositories\DataProvider\ProvinsiNotFoundException;
use Repositories\Feeds\FeedReader;

class ProvinsiController extends \BaseController
{
    protected $title = 'Home';

    /**
     * @param $provinsiSlug
     * @return $this|\Illuminate\Http\Response|string
     * @throws \Exception
     * @throws \Repositories\DataProvider\FileNotFoundException
     * @author Fathur Rohman <fathur_rohman17@yahoo.co.id>
     */
    public function getDashboard($provinsiSlug)
    {
        try {

            $provinsi = Provinsi::slug($provinsiSlug)->first();

            if(is_null($provinsi))
                \App::abort(404);

            $data = new ProvinsiDataProvider($provinsi->id);

            $provinsiDetail             = $data->getDetail();
            $provinsiNews               = $data->setLimit(3)->getNews();
            $provinsiInformation        = $data->setLimit(3)->getInformasi();
            $provinsiPrograms           = $data->setLimit(10)->getPrograms();
            $provinsiFile               = $data->setLimit(3)->getFileByCategory(array());
            $provinsiHunian             = $data->setLimit(5)->getHunian();
            $provinsiHunianRusunSewa             = $data->setLimit(5)->getHunianRusunSewa();
            $provinsiHunianRusunami             = $data->setLimit(5)->getHunianRusunami();
            $provinsiHunianRusunamiSubsidi             = $data->setLimit(5)->getHunianRusunamiSubsidi();
            $provinsiHunianRumahSubsidi             = $data->setLimit(5)->getHunianRumahSubsidi();
            $provinsiHunianApartemen             = $data->setLimit(5)->getHunianApartemen();
            $provinsiKontakDeveloper    = $data->setLimit(5)->getContactDevelopers();
            $provinsiKontakArsitek      = $data->setLimit(5)->getContactArsitek();
            $provinsiKontakKontraktor   = $data->setLimit(5)->getContactContractor();
            $provinsiKontakTukang       = $data->setLimit(5)->getContactTukang();
            $provinsiKontakSupplier     = $data->setLimit(5)->getContactSupplier();
            // return \Response::json($provinsiFile->toArray());

            $feedReader = new FeedReader();
            $feedReader->setUrl(array(
                'http://inside.kompas.com/getrss/propertiarsitektur',
                'http://inside.kompas.com/getrss/propertiberita',
                'http://inside.kompas.com/getrss/propertikawasanterpadu',
                'http://inside.kompas.com/getrss/propertihunian',
                'http://rss.detik.com/index.php/finance',

            ));

            $provinsiFeeds = $feedReader->generate();

            // return \Response::json($provinsiPublikasi->toArray());

            return \View::make('front.provinsi.dashboard')
                ->with('provinsi', $provinsiDetail)
                ->with('news', $provinsiNews)
                ->with('information', $provinsiInformation)
                ->with('programs', $provinsiPrograms)
                ->with('files', $provinsiFile)
                ->with('feeds', $provinsiFeeds)
                ->with('hunian', $provinsiHunian)
                ->with('hunianRusunSewa', $provinsiHunianRusunSewa)
                ->with('hunianRusunamiSubsidi', $provinsiHunianRusunamiSubsidi)
                ->with('hunianRumahSubsidi', $provinsiHunianRumahSubsidi)
                ->with('hunianRusunami', $provinsiHunianRusunami)
                ->with('hunianApartemen', $provinsiHunianApartemen)
                ->with('developers', $provinsiKontakDeveloper)
                ->with('arsitek', $provinsiKontakArsitek)
                ->with('kontraktor', $provinsiKontakKontraktor)
                ->with('tukang', $provinsiKontakTukang)
                ->with('supplier', $provinsiKontakSupplier);
        }
        catch (ProvinsiNotFoundException $e) {

            return \Response::view('errors.404', array(
                'message' => $e->getMessage()
            ), 404);

        }
        catch (PostNotFoundException $e)
        {
            return $e->getMessage();
        }

        // return \Response::json($provinsi->toArray());
    }

    /**
     * @param $provinsiSlug
     * @return $this|\Illuminate\Http\Response
     * @author Fathur Rohman <fathur_rohman17@yahoo.co.id>
     */
    public function getProfile($provinsiSlug)
    {
        try {
            $tahun = \Input::get('tahun', Carbon::now()->subYear()->year);

            $provinsi = Provinsi::slug($provinsiSlug)->first();

            if(is_null($provinsi))
                \App::abort(404);

            $data = ProvinsiDataProvider::create($provinsi->id)
                ->setYear($tahun);

            $provinsiDetail     = $data->getDetail();
            $totalAnggaran      = $data->getTotalAnggaran();
            $totalBackLog       = $data->getTotalBacklog();
            $totalJumlahRumah   = $data->getTotalJumlahRumah();
            $totalAPBD          = $data->getTotalAPBD();

            // Weird
            $statistikBackLog   = ProvinsiDataProvider::create($provinsi->id)
                                    ->setYear($tahun)
                                    ->getStatistikBacklog();

            $statistikBackLogSrc   = ProvinsiDataProvider::create($provinsi->id)
                ->setYear($tahun)
                ->getStatistikSourceBacklog();


            $statistikAnggaran  = ProvinsiDataProvider::create($provinsi->id)
                                    ->setYear($tahun)
                                    ->getStatistikAnggaran();

            $statistikAnggaranSrc   = ProvinsiDataProvider::create($provinsi->id)
                ->setYear($tahun)
                ->getStatistikSourceAnggaran();

            $filterStatistic      = ProvinsiDataProvider::create($provinsi->id)
                                    ->setYear($tahun)
                                    ->getStatistikAPBD();

            $filterStatisticSrc   = ProvinsiDataProvider::create($provinsi->id)
                ->setYear($tahun)
                ->getStatistikSourceAPBD();




            // return \Response::json(ProvinsiDataProvider::getStatistik($provinsi->id, 'TotalAPBDProv')->showResults());

            return \View::make('front.provinsi.profile', compact(
                    'totalAnggaran','totalBackLog','totalJumlahRumah','totalAPBD',
                    'statistikAnggaran','statistikBackLog','filterStatistic',
                    'statistikBackLogSrc','statistikAnggaranSrc','filterStatisticSrc'
                ))
                ->with('fields', \ProfilProvinsi::$fields)
                ->with('title', 'Profile Provinsi '. $provinsi->NamaProvinsi)
                ->with('provinsi', $provinsiDetail)
                ->with('kolom', 'TotalPenduduk');

        }
        catch (ProvinsiNotFoundException $e)
        {
            return \Response::view('errors.404', array(
                'message' => $e->getMessage()
            ), 404);
        }

    }

    public function getStatistik($provinsiSlug)
    {
        $tahun = \Input::get('tahun', Carbon::now()->subYear()->year);
        $kolom = \Input::get('kolom','TotalPenduduk');

        $provinsi = Provinsi::slug($provinsiSlug)->first();

        if(is_null($provinsi))
            return \Response::view('errors.404', array(), 404);

        $data = ProvinsiDataProvider::create($provinsi->id)
            ->setYear($tahun);

        $provinsiDetail     = $data->getDetail();
        $totalAnggaran      = $data->getTotalAnggaran();
        $totalBackLog       = $data->getTotalBacklog();
        $totalJumlahRumah   = $data->getTotalJumlahRumah();
        $totalAPBD          = $data->getTotalAPBD();

        // Weird
        $statistikBackLog   = ProvinsiDataProvider::create($provinsi->id)
            ->setYear($tahun)
            ->getStatistikBacklog();

        $statistikBackLogSrc   = ProvinsiDataProvider::create($provinsi->id)
            ->setYear($tahun)
            ->getStatistikSourceBacklog();

        $statistikAnggaran  = ProvinsiDataProvider::create($provinsi->id)
            ->setYear($tahun)
            ->getStatistikAnggaran();

        $statistikAnggaranSrc   = ProvinsiDataProvider::create($provinsi->id)
            ->setYear($tahun)
            ->getStatistikSourceAnggaran();

        $filterStatistic      = ProvinsiDataProvider::create($provinsi->id)
            ->setYear($tahun)
            ->getStatistik($kolom);

        $filterStatisticSrc   = ProvinsiDataProvider::create($provinsi->id)
            ->setYear($tahun)
            ->getStatistikSource($kolom);

        return \View::make('front.provinsi.statistik', compact(
            'totalAnggaran','totalBackLog','totalJumlahRumah','totalAPBD',
            'statistikAnggaran','statistikBackLog','filterStatistic','fields',
            'kolom',
            'statistikBackLogSrc','statistikAnggaranSrc','filterStatisticSrc'

        ))

            ->with('fields', \ProfilProvinsi::$fields)
            ->with('title', 'Profile Provinsi '. $provinsi->NamaProvinsi)
            ->with('provinsi', $provinsiDetail);
    }

    public function getEhousing($provinsiSlug)
    {
        $provinsi = Provinsi::slug($provinsiSlug)->first();

        if(is_null($provinsi))
            \App::abort(404);

        $dataProvinsi = new ProvinsiDataProvider($provinsi->id);
        $data = $dataProvinsi->getDetail();

        // return \Response::json($data);

        return \View::make('front.provinsi.ehousing', compact('data'))
            ->with('title', 'Profil Ehousing');
    }
}