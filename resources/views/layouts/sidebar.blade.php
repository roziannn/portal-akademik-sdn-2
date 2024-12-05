<aside class="main-sidebar">
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src={{ asset('img/default/tutwuri.png') }} class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ auth()->user()->email }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i
                            class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                <a href="/admin/dashboard">
                    <i class="fa fa-table"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="{{ Request::is('admin/data-user') ? 'active' : '' }}">
                <a href="/admin/data-user">
                    <i class="fa fa-users"></i> <span> Data User Account</span>
                </a>
            </li>
            <li class="{{ Request::is('admin/data-guru') ? 'active' : '' }}">
                <a href="/admin/data-guru">
                    <i class="fa fa-book"></i> <span>Data Guru</span>
                </a>
            </li>
            <li class="{{ Request::is('admin/data-kurikulum') ? 'active' : '' }}">
                <a href="/admin/data-kurikulum">
                    <i class="fa fa-book"></i> <span>Data Kurikulum</span>
                </a>
            </li>
            <li class="{{ Request::is('admin/data-mata-pelajaran') ? 'active' : '' }}">
                <a href="/admin/data-mata-pelajaran">
                    <i class="fa fa-book"></i> <span>Data Mata Pelajaran</span>
                </a>
            </li>
            </li>
            @if (auth()->user()->roles == 'ADMIN')
                <li class="header">DASHBOARD</li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-gear"></i> <span>Pengaturan</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="add-new-user"><i class="fa fa-user"></i> Pengguna</a></li>
                        <li><a href="master-pegawai"><i class="fa fa-book"></i> Master Pegawai</a></li>
                    </ul>
                </li>
        </ul>
        @endif
    </section>
</aside>
