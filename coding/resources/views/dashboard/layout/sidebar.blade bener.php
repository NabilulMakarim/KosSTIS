<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="/dashboard">
              <span data-feather="command" class="align-text-bottom"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            {{-- tanda bintang untuk tulisan My Posts masih nyala meski masuk ke sub nya my posts --}}
            <a class="nav-link {{ Request::is('dashboard/kosts*') ? 'active' : '' }}" href="/dashboard/kosts">
              <span data-feather="codepen" class="align-text-bottom"></span>
              Kost
            </a>
          </li>
          <li class="nav-item">
            {{-- tanda bintang untuk tulisan My Posts masih nyala meski masuk ke sub nya my posts --}}
            <a class="nav-link {{ Request::is('dashboard/kamars*') ? 'active' : '' }}" href="/dashboard/kamars">
              <span data-feather="inbox" class="align-text-bottom"></span>
              Kamar
            </a>
          </li>
          <li class="nav-item">
            {{-- tanda bintang untuk tulisan My Posts masih nyala meski masuk ke sub nya my posts --}}
            <a class="nav-link {{ Request::is('dashboard/kontrakans*') ? 'active' : '' }}" href="/dashboard/kontrakans">
              <span data-feather="home" class="align-text-bottom"></span>
              Kontrakan
            </a>
          </li>
        </ul>

        @if (auth()->user()->is_admin === 1)
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Pengelola</span>
        </h6>
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/penambahan*') ? 'active' : '' }}" href="/dashboard/penambahan">
              <span data-feather="grid" class="align-text-bottom"></span>
              Pengajuan Tambah
              {{-- @if ($penambahanKost + $penambahanKontrakan->count() > 0)
                  <span class="badge bg-danger">{{ $penambahanKost + $penambahanKontrakan->count() > 0 }}</span>
              @else
              else
              @endif --}}
            </a>

          </li>

          <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/pembaharuan*') ? 'active' : '' }}" href="/dashboard/pembaharuan">
              <span data-feather="grid" class="align-text-bottom"></span>
              Pengajuan Update
            </a>
          </li>
        </ul>
        @endif

        @if (auth()->user()->is_admin === 2)
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Admin</span>
        </h6>
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/penggunas*') ? 'active' : '' }}" href="/dashboard/penggunas">
              <span data-feather="grid" class="align-text-bottom"></span>
              Info Pengguna
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/pengelolas*') ? 'active' : '' }}" href="/dashboard/pengelolas">
              <span data-feather="grid" class="align-text-bottom"></span>
              Info Pengelola
            </a>
          </li>
        </ul>
        @endif

        {{-- @can('admin')   --}}
        @if (auth()->user()->is_admin === 10)
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Administrator</span>
        </h6>
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/categories*') ? 'active' : '' }}" href="/dashboard/categories">
              <span data-feather="grid" class="align-text-bottom"></span>
              Post Categories
            </a>
          </li>
        </ul>
        @endif
        {{-- @endcan --}}

      </div>
    </nav>
  </div>
</div>