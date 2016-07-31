<?php
/**
 * Created by PhpStorm.
 * User: akung
 * Date: 7/31/16
 * Time: 09:58
 */

namespace BackOffice;


use Carbon\Carbon;
use Datatables;
use View;

class CallUsController extends AdminController
{
    public function index()
    {
        return \View::make('back.hubungi.index')
            ->with('datatablesRoute', route('back-office.hubungi-kami.data'));
    }

    public function update($id)
    {
        $pengajuan = \Pengajuan::find($id);
        $pengajuan->statusid = \Input::get('statusid');
        $pengajuan->save();

        return \Redirect::route('back-office.hubungi-kami.index');
    }

    public function edit($id)
    {
        $data = \Pengajuan::find($id);
        $statuses = array(
            'NEW' => 'New',
            'ONPROGRESS' => 'On Progress',
            'CLOSE' => 'Closed',
        );
        //dd($data->toArray());
        return View::make('back.hubungi.edit', compact('data','statuses'));
    }

    public function data()
    {
        $pengajuan = \Pengajuan::select(array(
            'pengajuan.*',
            'provinsi.NamaProvinsi'
        ))
            ->leftJoin('provinsi','provinsi.KodeProvinsi','=','pengajuan.KodeProvinsi')
            ->where('pengajuan.ExpiryDate','>',Carbon::now());

        if(\Auth::user()->Region == 'Provinsi')
        {
            $pengajuan->where('pengajuan.KodeProvinsi', \Auth::user()->KodeProvinsi);
        }


        $datatables = Datatables::of($pengajuan)

            ->addColumn('action', function($data){

                return View::make('back.hubungi.action')
                    ->with('table', $this->identifier . '-datatables')
                    ->with('edit_action', route('back-office.hubungi-kami.edit', array($data->KodePengajuan)))
                    ->render();
            })
            ->editColumn('Email',function($data) {
                return "<a href='mailto:{$data->Email}'>{$data->Email}</a>";
            })
            ->editColumn('KlasifikasiPengajuan', function($data) {
                switch ($data->KlasifikasiPengajuan) {
                    /*
                     * <option value="KRS">Ketertarikan Rusun</option>
                     * <option value="ADU">Pengaduan</option>
                     * <option value="PEM">Pengajuan Mitra</option>
                     * <option value="MNT">Permintaan Informasi atau Data</option>
                     * <option value="TNY">Pertanyaan</option>
                     * <option value="USU">Usulan</option>
                     * */

                    case 'KRS':
                        return 'Ketertarikan Rusun';
                        break;

                    case 'ADU':
                        return 'Pengaduan';

                        break;

                    case 'PEM':
                        return 'Pengajuan Mitra';

                        break;

                    case 'MNT':
                        return 'Permintaan Informasi atau Data';

                        break;

                    case 'TNY':
                        return 'Pertanyaan';

                        break;

                    case 'USU':
                        return 'Usulan';

                        break;

                }
            })
            ->editColumn('statusid', function($data) {
                switch ($data->statusid) {
                    case 'NEW':
                        return "<span class='label label-danger'>New</span>";
                        break;
                    case 'ONPROGRESS':
                        return "<span class='label label-warning'>On Progress</span>";

                        break;
                    case 'CLOSE':
                        return "<span class='label label-success'>Closed</span>";
                        break;
                    default:
                        return "<span class='label label-danger'>New</span>";

                }
            })
            ->make(true);

        return $datatables;
    }
}