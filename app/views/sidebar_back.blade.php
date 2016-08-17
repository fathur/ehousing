<li>
    <a href="#">
        <i class="fa fa-home"></i> <span class="nav-label">Hunian</span><span class="fa arrow"></span>
    </a>
    <ul class="nav nav-second-level collapse">
        <li><a href="{{route('back-office.hunian.index')}}">Daftar Hunian</a></li>
        <li><a href="{{route('back-office.hunian.create')}}">Tambah Hunian</a></li>
    </ul>
</li>

@if($isNasional)
<li>
    <a href="#"><i class="fa fa-bars"></i> <span class="nav-label">Kategori Post</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">

        <li><a href="{{route('back-office.kategori.index')}}">Daftar Kategori </a></li>
        <li><a href="{{route('back-office.kategori.create')}}">Tambah Kategori Post </a></li>
    </ul>
</li>
@endif

<li>
    <a href="#"><i class="fa fa-book"></i> <span class="nav-label">Post</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">

        <li><a href="{{route('back-office.post.index')}}">Daftar </a></li>
        <li><a href="{{route('back-office.post.create')}}">Tambah Post </a></li>
    </ul>
</li>

{{--<li>--}}
    {{--<a href="#"><i class="fa fa-phone"></i> <span class="nav-label">Kontak</span><span class="fa arrow"></span></a>--}}
    {{--<ul class="nav nav-second-level collapse">--}}
        {{--<li><a href="{{route('back-office.kontak.index')}}">Daftar Kontak</a></li>--}}
        {{--<li><a href="{{route('back-office.kontak.create')}}">Tambah Kontak</a></li>--}}
    {{--</ul>--}}
{{--</li>--}}
<li>
    <a href="#"><i class="fa fa-list"></i> <span class="nav-label">Link Informasi</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li><a href="{{route('back-office.link.index')}}">Daftar Link Informasi</a></li>
        <li><a href="{{route('back-office.link.create')}}">Tambah Link Informasi</a></li>
    </ul>
</li>
<li>
    <a href="#"><i class="fa fa-file"></i> <span class="nav-label">File Management</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li><a href="{{route('back-office.file.index')}}">Daftar File</a></li>
        <li><a href="{{route('back-office.file.create')}}">Upload File</a></li>
    </ul>
</li>
<li>
    <a href="#"><i class="fa fa-user"></i> <span class="nav-label">User</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li><a href="{{route('back-office.user.index')}}">Daftar User</a></li>
        <li><a href="{{route('back-office.user.create')}}">Tambah User</a></li>
    </ul>
</li>
{{--<li>--}}
    {{--<a href="#"><i class="fa fa-user"></i> <span class="nav-label">Pengajuan</span><span class="fa arrow"></span></a>--}}
    {{--<ul class="nav nav-second-level collapse">--}}
        {{--<li><a href="{{route('back-office.pengajuan.index')}}">Daftar Pengajuan</a></li>--}}
    {{--</ul>--}}
{{--</li>--}}

@if(!$isNasional)
<li>
    <a href="{{route('back-office.provinsi.setting.edit')}}">
        <i class="fa fa-cog"></i> <span class="nav-label">Konfigurasi Provinsi</span>
    </a>
</li>
<li>
    <a href="#">
        <i class="fa fa-bar-chart"></i>
        <span class="nav-label">Grafik</span>
        <span class="fa arrow"></span>
    </a>
    <ul class="nav nav-second-level collapse">
        <li><a href="{{route('back-office.chart.index', array('apbd'))}}">Total APBD</a></li>
        <li><a href="{{route('back-office.chart.index', array('pad'))}}">Total PAD</a></li>
        <li><a href="{{route('back-office.chart.index', array('pad-other'))}}">Lain-lain PAD yang Sah</a></li>
        <li><a href="{{route('back-office.chart.index', array('sum-penduduk'))}}">Total Penduduk</a></li>
        <li><a href="{{route('back-office.chart.index', array('sum-pria'))}}">Total Pria</a></li>
        <li><a href="{{route('back-office.chart.index', array('sum-wanita'))}}">Total Wanita</a></li>
        <li><a href="{{route('back-office.chart.index', array('pertumbuhan'))}}">Pct Pertumbuhan Penduduk</a></li>
        <li><a href="{{route('back-office.chart.index', array('kepadatan'))}}">Kepadatan Penduduk</a></li>
        <li><a href="{{route('back-office.chart.index', array('miskin-kota'))}}">Total Penduduk Miskin (Kota)</a></li>
        <li><a href="{{route('back-office.chart.index', array('miskin-desa'))}}">Total Penduduk Miskin (Desa)</a></li>
        <li><a href="{{route('back-office.chart.index', array('pajak'))}}">Pajak Daerah</a></li>
        <li><a href="{{route('back-office.chart.index', array('retribusi'))}}">Retribusi Daerah</a></li>
        <li><a href="{{route('back-office.chart.index', array('kekayaan'))}}">Kekayaan Daerah yang Dipisah</a></li>
        <li><a href="{{route('back-office.chart.index', array('backlog'))}}">Backlog Rumah</a></li>
        <li><a href="{{route('back-office.chart.index', array('sum-rt'))}}">Jumlah RT</a></li>
        <li><a href="{{route('back-office.chart.index', array('anggaran'))}}">Anggaran Kemenpera</a></li>
    </ul>
</li>
@endif


{{--//log aktifitas hanya berlaku untuk user role nasional saja --}}
@if($isNasional)
<li>
    <a href="#">
        <i class="fa fa-history"></i> <span class="nav-label">Log Aktifitas</span>
    </a>
</li>
@endif

<li>
    <a href="{{route('back-office.hubungi-kami.index')}}">
        <i class="fa fa-history"></i> <span class="nav-label">Pengaduan Masyarakat</span>
    </a>
</li>

<li>
    <a href="{{url('/')}}">
        <i class="fa fa-home"></i><span class="nav-label">Visit Home Page</span>
    </a>
</li>