<?php
/**
 * Project: ehousing-3.0
 * Date: 7/4/16
 * Time: 22:12
 */

namespace BackOffice;


use Carbon\Carbon;
use Datatables;

class ChartController extends AdminController
{
    protected $identifier = 'chart';

    private $kinds = array(
        'apbd' => array(
            'name'  => 'Total APBD',
            'column' => 'TotalAPBDProv',
            'source_column' => 'total_apbd_prov'
        ),
        'pad' => array(
            'name'  => 'Total PAD',
            'column' => 'TotalPADProv',
            'source_column' => 'total_pad_prov'

        ),
        'pad-other' => array(
            'name'  => 'Lain-lain PAD yang Sah',
            'column' => 'LainLainPADYgSah',
            'source_column' => 'lain_lain_pad_yg_sah'

        ),
        'sum-penduduk' => array(
            'name'  => 'Total Penduduk',
            'column' => 'TotalPenduduk',
            'source_column' => 'total_penduduk'

        ),
        'sum-pria' => array(
            'name'  => 'Total Pria',
            'column' => 'TotalPria',
            'source_column' => 'total_pria'

        ),
        'sum-wanita' => array(
            'name'  => 'Total Wanita',
            'column' => 'TotalWanita',
            'source_column' => 'total_wanita'

        ),
        'pertumbuhan' => array(
            'name'  => 'Pct Pertumbuhan Penduduk',
            'column' => 'PctPertumbuhanPenduduk',
            'source_column' => 'pct_pertumbuhan_penduduk'

        ),
        'kepadatan' => array(
            'name'  => 'Kepadatan Penduduk',
            'column' => 'KepadatanPenduduk',
            'source_column' => 'kepadatan_penduduk'

        ),
        'miskin-kota' => array(
            'name'  => 'Total Penduduk Miskin (Kota)',
            'column' => 'TotalPendudukMiskinKota',
            'source_column' => 'total_penduduk_miskin_kota'

        ),
        'miskin-desa' => array(
            'name'  => 'Total Penduduk Miskin (Desa)',
            'column' => 'TotalPendudukMiskinDesa',
            'source_column' => 'total_penduduk_miskin_desa'

        ),
        'pajak' => array(
            'name'  => 'Pajak Daerah',
            'column' => 'PajakDaerah',
            'source_column' => 'pajak_daerah'

        ),
        'retribusi' => array(
            'name'  => 'Retribusi Daerah',
            'column' => 'RetribusiDaerah',
            'source_column' => 'retribusi_daerah'

        ),
        'kekayaan' => array(
            'name'  => 'Kekayaan Daerah yang Dipisah',
            'column' => 'KekayaanDaerahYgDipisah',
            'source_column' => 'kekayaan_daerah_yg_dipisah'

        ),
        'backlog' => array(
            'name'  => 'Backlog Rumah',
            'column' => 'BacklogRumah',
            'source_column' => 'backlog_rumah'

        ),
        'sum-rt' => array(
            'name'  => 'Jumlah RT',
            'column' => 'JumlahRT',
            'source_column' => 'jumlah_rt'

        ),
        'anggaran' => array(
            'name'  => 'Anggaran Kemenpera',
            'column' => 'AnggaranKemenpera',
            'source_column' => 'anggaran_kemenpera'

        ),
    );

    public function index($jenis)
    {
        return \View::make('back.chart.index', compact('jenis'))
            ->with('kinds', $this->kinds)
            ->with('datatablesRoute', route('back-office.chart.data'));

    }

    public function edit($jenis, $id)
    {
        $data = \ProfilProvinsi::select(array(
            'KodeProfilProv',
            'TahunBerlaku',
            "{$this->kinds[$jenis]['column']} AS jumlah",
        ))->with('source')->find($id);

        $sourceColumn = $this->kinds[$jenis]['source_column'];


        return \View::make('back.chart.edit', compact('data','jenis','sourceColumn'));

    }

    public function update($jenis, $id)
    {
        //dd($this->kinds[$jenis]['source_column']);

        $profil = \ProfilProvinsi::find($id);
        $profil->{$this->kinds[$jenis]['column']} = \Input::get('jumlah');
        $profil->save();

        $src = \ProfileProvinsiSource::where('profil_provinsi_id', $id);

        if($src->count() == 0)
        {
            $profil->source()->save(
                new \ProfileProvinsiSource(array(
                    $this->kinds[$jenis]['source_column'] => \Input::get('source.' . $this->kinds[$jenis]['source_column'])
                )
            ));

        } else {
            $profil->source()->update(array(
                $this->kinds[$jenis]['source_column'] => \Input::get('source.' . $this->kinds[$jenis]['source_column'])
            ));
        }

        return \Redirect::route('back-office.chart.index', array($jenis));
    }

    public function data()
    {
        $jenis = \Input::get('jenis');

        $profile = \ProfilProvinsi::select(array(
            'KodeProfilProv',
            'TahunBerlaku',
            "{$this->kinds[$jenis]['column']} AS jumlah",
            "{$this->kinds[$jenis]['source_column']} AS source"
        ))->leftJoin('profile_provinsi_sources','profile_provinsi_sources.profil_provinsi_id','=','ProfilProvinsi.KodeProfilProv');

        if(\Auth::user()->Region == 'Provinsi') {
            $profile->where('KodeProv', \Auth::user()->KodeProvinsi);
        }

        $datatables = Datatables::of($profile)
            ->editColumn('jumlah', function($data) {
                return number_format($data->jumlah, 2, ',', '.');
            })

            ->addColumn('action', function($data) use ($jenis) {

                return \View::make('back.action')
                    ->with('table', $this->identifier . '-datatables')
                    ->with('url', route('back-office.chart.destroy', array($jenis, $data->KodeProfilProv)))
                    ->with('edit_action', route('back-office.chart.edit', array($jenis, $data->KodeProfilProv)))
                    ->render();
            })
            ->make(true);

        return $datatables;
    }
}