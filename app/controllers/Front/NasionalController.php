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

    public function getEhousing()
    {
        $data = \KonfigurasiSitus::where('KodeProvinsi', 0)->first();

        return \View::make('front.nasional.ehousing', compact('data'))
            ->with('title', 'Profil Ehousing');
    }

    public function getStatistik()
    {
        $years = \ProfilProvinsi::select(array(
            \DB::raw('DISTINCT(TahunBerlaku) AS tahun')
        ))->orderBy('tahun','asc')->lists('tahun','tahun');


        $years = array_filter($years, function($var){

            if($var != '')
                return $var;
        });

        $kolom = \Input::get('kolom', 'TotalPenduduk');
        $tahun = \Input::get('tahun', min($years));


        //select sum(pp.BacklogRumah) as jumlah, p.NamaProvinsi
        //from ProfilProvinsi pp
        //left join provinsi p on p.KodeProvinsi = pp.KodeProv
        //group by pp.KodeProv
        //order by jumlah desc
        //limit 10;
        $topTenBacklog = \ProfilProvinsi::select(array(
            \DB::raw('SUM(BacklogRumah) AS jumlah'),
            'provinsi.NamaProvinsi'
        ))->leftJoin('provinsi','provinsi.KodeProvinsi','=','ProfilProvinsi.KodeProv')
            ->groupBy('ProfilProvinsi.KodeProv')
            ->orderBy('jumlah','desc')
            ->take(10)
            ->get();

        $mapBacklog = array();
        foreach ($topTenBacklog as $item) {
            array_push($mapBacklog, array(
                'name'  => $item->NamaProvinsi,
                'y'     => (int) $item->jumlah
            ));
        }

        $dataBacklog = json_encode($mapBacklog);

        $topTenAnggaran = \ProfilProvinsi::select(array(
            \DB::raw('SUM(AnggaranKemenpera) AS jumlah'),
            'provinsi.NamaProvinsi'
        ))->leftJoin('provinsi','provinsi.KodeProvinsi','=','ProfilProvinsi.KodeProv')
            ->groupBy('ProfilProvinsi.KodeProv')
            ->orderBy('jumlah','desc')
            ->take(10)
            ->get();

        $mapAnggaran = array();
        foreach ($topTenAnggaran as $item) {
            array_push($mapAnggaran, array(
                'name'  => $item->NamaProvinsi,
                'y'     => (int) $item->jumlah
            ));
        }

        $dataAnggaran = json_encode($mapAnggaran);




        $filterStatistic = $this->loadDataStatistik($kolom, $tahun);
        $dataFilter = $this->loadDataStatistik($kolom, $tahun, null, false);


        return \View::make('front.nasional.statistik', compact('dataBacklog','dataAnggaran','filterStatistic','dataFilter'))
            ->with('fields', \ProfilProvinsi::$fields)
            ->with('years', $years);
    }

    /**
     * @param $kolom
     * @param $tahun
     * @param null $take
     */
    private function loadDataStatistik($kolom, $tahun = null, $take = null, $json = true)
    {
        $dataRaw = \ProfilProvinsi::select(array(
            \DB::raw("SUM({$kolom}) AS jumlah"),
            'provinsi.NamaProvinsi'
        ))->leftJoin('provinsi','provinsi.KodeProvinsi','=','ProfilProvinsi.KodeProv')
            ->groupBy('ProfilProvinsi.KodeProv')
            ->orderBy('jumlah','desc');

        if(!is_null($tahun))
            $dataRaw->where('TahunBerlaku','=',$tahun);

         $dataRaw = $dataRaw->get();

        $map = array();
        foreach ($dataRaw as $item) {
            array_push($map, array(
                'name' => $item->NamaProvinsi,
                'y' => (int)$item->jumlah
            ));
        };

        if($json)
            return json_encode($map);

        return $map;
    }
}