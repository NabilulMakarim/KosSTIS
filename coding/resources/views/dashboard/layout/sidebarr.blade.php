<!-- SIDEBAR -->
<aside class="main-sidebar sidebar-dark-success elevation-4">

    <!-- LOGO ROHIS -->
    <a href="/dashboard" class="brand-link text-decoration-none">
        <span class="brand-text font-weight-light mx-1"><i class="fab fa-megaport"></i>&emsp;<b>KoStis
                Dashboard</b></span>
    </a>

    <div class="sidebar">

        <!-- SIDEBAR FITUR -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-header">DASHBOARD</li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page"
                        href="/dashboard">
                        <span>
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                        </span>

                        &emsp;
                        Beranda
                    </a>
                    {{-- <hr style="color: aliceblue"> --}}
                </li>

                @if (auth()->user()->is_admin == 2)
                    <li class="nav-header">ADMIN</li>
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('dashboard/admin*') ? 'active' : '' }}"
                                href="/dashboard/admin">
                                <span> <i class="nav-icon fas fa-user-cog"></i></span>
                                &emsp;

                                Ubah Data Admin
                            </a>
                            {{-- <hr style="color: aliceblue"> --}}

                        </li>

                    </ul>
                    <li class="nav-header">USER</li>
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('dashboard/penggunas*') ? 'active' : '' }}"
                                href="/dashboard/penggunas">
                                <span> <i class="nav-icon fas fa-users"></i></span>
                                &emsp;

                                Info Pengguna
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('dashboard/pengelolas*') ? 'active' : '' }}"
                                href="/dashboard/pengelolas">
                                <span> <i class="nav-icon fas fa-users-cog"></i></span>
                                &emsp;

                                Info Pengelola
                            </a>
                            {{-- <hr style="color: aliceblue"> --}}

                        </li>

                    </ul>
                @endif

                @if (auth()->user()->is_admin == 1)
                    <li class="nav-header">PENGELOLA</li>
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('dashboard/penambahan*') ? 'active' : '' }}"
                                href="/dashboard/penambahan">
                                <span>
                                    <i class=" nav-icon far fa-plus-square"></i>
                                </span>
                                &emsp;

                                Pengajuan Tambah
                                {{-- @if ($penambahanKost + $penambahanKontrakan->count() > 0)
                        <span class="badge bg-danger">{{ $penambahanKost + $penambahanKontrakan->count() > 0 }}</span>
                    @else
                    else
                    @endif --}}
                            </a>

                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('dashboard/pembaharuan*') ? 'active' : '' }}"
                                href="/dashboard/pembaharuan">
                                <span><i class="nav-icon fas fa-edit"></i></span>
                                &emsp;

                                Pengajuan Update
                            </a>
                            {{-- <hr style="color: aliceblue"> --}}
                        </li>
                    </ul>
                    <li class="nav-header">KOST & KONTRAKAN</li>
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            {{-- tanda bintang untuk tulisan My Posts masih nyala meski masuk ke sub nya my posts --}}
                            <a class="nav-link {{ Request::is('dashboard/kosts*') ? 'active' : '' }}"
                                href="/dashboard/kosts">
                                <span> <i class="nav-icon fas fa-person-booth"></i></span>
                                &emsp;
                                Kost
                            </a>
                        </li>

                        {{-- <li class="nav-item">
                            <a class="nav-link {{ Request::is('dashboard/kamars*') ? 'active' : '' }}"
                                href="/dashboard/kamars">
                                <span> <i class="nav-icon fas fa-bed"></i></span>
                                &emsp;
                                Kamar
                            </a>
                        </li> --}}

                        <li class="nav-item">
                            {{-- tanda bintang untuk tulisan My Posts masih nyala meski masuk ke sub nya my posts --}}
                            <a class="nav-link {{ Request::is('dashboard/kontrakans*') ? 'active' : '' }}"
                                href="/dashboard/kontrakans">
                                <i class="nav-icon fas fa-home"></i>
                                &emsp;
                                Kontrakan
                            </a>
                            {{-- <hr style="color: aliceblue"> --}}

                        </li>



                    </ul>
                @endif
            </ul>
        </nav>
    </div>
</aside>
