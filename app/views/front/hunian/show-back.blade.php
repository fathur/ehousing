
<div class="col-md-8">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Profile Detail</h5>
        </div>

        <div class="ibox-content">

            <dl class="dl-horizontal">
                <dt>Jenis Hunian:</dt> <dd><span class="label label-primary">{{{ ($hunian->referensi->Deskripsi) ? $hunian->referensi->Deskripsi : '-' }}}</span></dd>
            </dl>
            <dl class="dl-horizontal">
                <dt>Deskripsi :</dt> <dd>{{{ ($hunian->referensi->Deskripsi) ? $hunian->referensi->Deskripsi : '-' }}}</dd>
                <dt>Alamat :</dt> <dd> {{{ ($hunian->Alamat) ? $hunian->Alamat : '-' }}}</dd>
                <dt>Website :</dt> <dd> {{{ ($hunian->Website) ? $hunian->Website : '-' }}}</dd>
                <dt>Email :</dt> <dd> {{{ ($hunian->Email) ? $hunian->Email : '-' }}}</dd>
                <dt>Tgl Registrasi :</dt> <dd>07th Dec 2015 </dd>
                <dt>Nama Pengembang :</dt>
                <dd>
                    @if(isset($hunian->kontak->Nama))
                        <a href="#">{{{ $hunian->kontak->Nama }}}</a>
                    @else
                    @endif
                </dd>
            </dl>
            <div class="row">
                <div class="col-lg-5">
                    <dl class="dl-horizontal">
                        <dt>Pengelola :</dt> <dd> {{{ ($hunian->Pengelola) ? $hunian->Pengelola : '-' }}}</dd>
                        <dt>Telp Kantor :</dt> <dd>{{{ ($hunian->NoTelp) ? $hunian->NoTelp : '-'}}} </dd>
                        <dt>Telp PIC :</dt> <dd> {{{ ($hunian->NoHP_PIC) ? $hunian->NoHP_PIC : '-' }}}</dd>
                        <dt>Thn Pembangunan :</dt> <dd> {{{ ($hunian->TahunPembangunan) ? $hunian->TahunPembangunan : '-' }}}</dd>
                        <dt>Thn Selesai :</dt> <dd> {{{ ($hunian->TahunSelesai) ? $hunian->TahunSelesai : '-' }}}</dd>
                    </dl>
                </div>
                <div class="col-lg-7" id="cluster_info">
                    <dl class="dl-horizontal">
                        <dt>Jumlah Unit :</dt> <dd> {{{ ($hunian->JumlahUnit) ? $hunian->JumlahUnit : '-' }}}</dd>
                        <dt>Jumlah Lantai :</dt> <dd> {{{ ($hunian->JumlahLantai) ? $hunian->JumlahLantai : '-' }}}</dd>
                        <dt>Luas Lahan :</dt> <dd> {{{ ($hunian->LuasLahan) ? $hunian->LuasLahan : '-' }}}</dd>
                        <dt>Tingkat Hunian :</dt> <dd> {{{ ($hunian->TingkatHunian) ? $hunian->TingkatHunian : '-' }}}</dd>
                        <dt>Status :</dt> <dd> {{{ ($hunian->Status) ? $hunian->Status : '- }}}</dd>
                    </dl>
                </div>
            </div>
            <dl class="dl-horizontal">
                <dt>Harga Mulai :</dt> <dd> {{{ ($hunian->Harga) ? "Rp.".number_format($hunian->Harga) : '-' }}}</dd>
            </dl>
            <div class="row m-t-sm">
                <div class="col-lg-12">
                    <div class="panel blank-panel">
                        <div class="panel-heading">
                            <div class="panel-options">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab1" data-toggle="tab">Website</a></li>
                                    @if(!empty($hunian->Tab2))
                                        <li class=""><a href="#tab2" data-toggle="tab">{{{$hunian->Tab2}}}</a></li>
                                    @endif

                                    @if(!empty($hunian->Tab3))
                                        <li class=""><a href="#tab3" data-toggle="tab">{{{$hunian->Tab3}}}</a></li>
                                    @endif

                                    @if(!empty($hunian->Tab4))
                                        <li class=""><a href="#tab3" data-toggle="tab">{{{$hunian->Tab4}}}</a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="tab-content">
                                <h2>Official Website</h2>
                                <div class="tab-pane active" id="tab1">
                                    @if(!empty($hunian->Website))
                                        <iframe style="border:0;width:100%;height:500px;margin:0;padding:0;overflow-x: hidden;"
                                                align="center"
                                                name="frame1"
                                                scrolling="auto"
                                                src="{{{ $hunian->Website }}}"></iframe>
                                    @else
                                        <div class="alert alert-info">Tidak ditemukan data.</div>
                                    @endif
                                </div>

                                @if(!empty($hunian->LinkExternal2))
                                    <div class="tab-pane" id="tab2">
                                        <iframe style="border:0;width:100%;height:500px;margin:0;padding:0;overflow-x: hidden;"
                                                align="center"
                                                name="frame1"
                                                scrolling="auto"
                                                src="{{{ $hunian->LinkExternal2 }}}"></iframe>
                                    </div>
                                @endif

                                @if(!empty($hunian->LinkExternal3))
                                    <div class="tab-pane" id="tab2">
                                        <iframe style="border:0;width:100%;height:500px;margin:0;padding:0;overflow-x: hidden;"
                                                align="center"
                                                name="frame1"
                                                scrolling="auto"
                                                src="{{{ $hunian->LinkExternal3 }}}"></iframe>
                                    </div>
                                @endif

                                @if(!empty($hunian->LinkExternal4))
                                    <div class="tab-pane" id="tab2">
                                        <iframe style="border:0;width:100%;height:500px;margin:0;padding:0;overflow-x: hidden;"
                                                align="center"
                                                name="frame1"
                                                scrolling="auto"
                                                src="{{{ $hunian->LinkExternal4 }}}"></iframe>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>