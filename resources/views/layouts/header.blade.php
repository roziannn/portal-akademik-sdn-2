<header class="main-header">
    <!-- Logo -->
    <a href="/" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><img src={{ asset('img/default/tutwuri.png') }}></span>
        <!-- logo for regular state and mobile devices -->
        <h4 class="logo-lg"><b>PORTAL AKADEMIK <br> SDN 2 MELATI KIDUL</b></h4>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        {{-- nav menu custom --}}
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src={{ asset('img/default/tutwuri.png') }} class="user-image" alt="User Image">
                        <span class="hidden-xs">{{ auth()->user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- Menu Footer-->
                        <li class="user-header">
                            <img src={{ asset('public/img/default/tutwuri.png') }} class="img-circle" alt="User Image">
                            <p>
                                {{ auth()->user()->nama }}
                                <small> {{ auth()->user()->roles }}</small>
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat btn-xs">Ubah Kata Sandi</a>
                            </div>
                            <div class="pull-right">
                                <form action="/logout" method="post">
                                    @csrf
                                    <button class="btn btn-primary btn-xs" type="submit"><i class="fa fa-sign-out"></i>
                                        <span>Logout</span></button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
