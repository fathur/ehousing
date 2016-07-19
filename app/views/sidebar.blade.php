<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <a href="{{ url('/') }}">
                        <span class="clear">
                            <span class="block m-t-xs">
                                <i class="fa fa-home"></i>
                                <strong class="font-bold">e-Housing KemenPUPR</strong>
                            </span>

                            @if(isset($region))
                                <span class='small'><i class='fa fa-circle' style='color:green'></i> {{{ $region->NamaProvinsi }}}</span>
                            @endif
                        </span>
                    </a>
                </div>
                <div class="logo-element">
                    <i class="fa fa-home"></i>
                </div>
            </li>

            {{ $sidemenu }}

        </ul>
    </div>
</nav>