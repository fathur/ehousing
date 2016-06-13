<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <a href="{{ url('/') }}">
                            <span class="clear">
								<span class="block m-t-xs">
                                    <i class="fa fa-home"></i>
                                    <strong class="font-bold">e-housing KemenPUPR</strong>
                                </span>
							</span>
                    </a>
                </div>
                <div class="logo-element">
                    <i class="fa fa-home"></i>
                </div>
            </li>

            {{ $sidemenu }}

            <li>
                <a href="#">
                    <i class="fa fa-building"></i>
						<span class="nav-label">
							Hubungi Kami
						</span>
                </a>
            </li>

        </ul>
    </div>
</nav>