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

@if(!$isNasional)
<li>
    <a href="{{route('back-office.provinsi.setting.edit')}}">
        <i class="fa fa-cog"></i> <span class="nav-label">Konfigurasi Provinsi</span>
    </a>
</li>
@else
<li>
    <a href="{{route('back-office.nasional.setting.edit')}}">
        <i class="fa fa-cog"></i> <span class="nav-label">Konfigurasi Nasional</span>
    </a>
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
        <i class="fa fa-history"></i> <span class="nav-label">Saran, Kritik, Kontak Admin</span>
    </a>
</li>

<li>
    <a href="{{url('/')}}">
        <i class="fa fa-home"></i><span class="nav-label">Visit Home Page</span>
    </a>
</li>