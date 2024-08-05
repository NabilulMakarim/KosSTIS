<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/">KoStis</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        @auth
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="/">Home
                            {{-- <span class="sr-only">(current)</span> --}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('kosts*') ? 'active' : '' }}" href="/kosts">Kost</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('kontrakans*') ? 'active' : '' }}"
                            href="/kontrakans">Kontrakan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('konfirmasi*') ? 'active' : '' }}"
                            href="/konfirmasi">Konfirmasi</a>
                        {{-- 
              <form method="get" action="/konfirmasi" class="mb-5">
                @csrf
                <div>
                  <input type="hidden" id="kelurahan" name="kelurahan" value="a">
                </div>
                <div>
                    <input type="hidden" id="rt" name="rt" value=1>
                </div>
                <div>
                    <input type="hidden" id="rw" name="rw" value=1>
                </div>
                <div>
                    <input type="hidden" id="no" name="no" value=1>
                </div>
                <button type="submit" class="btn btn-dark">Konfirmasi Transaksi</button>
              </form> --}}
                    </li>
                    {{-- <li class="nav-item">
              <a class="nav-link {{ Request::is('about') ? 'active' : '' }}" href="/about">About</a>
            </li> --}}




                </ul>

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-wrap" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Selamat datang kembali, {{ auth()->user()->nama }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            {{-- @can('admin') --}}
                            @if (auth()->user()->is_admin != 0)
                                <li><a class="dropdown-item text-end" href="/dashboard"><i class="bi bi-house-gear"></i>
                                        Kelola Data
                                        Kost/Kontrakan</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                            @else
                                @if (auth()->user()->tempat_id)
                                    <li><a class="dropdown-item text-end" href="/profil"> Tempat Tinggal Saya <i
                                                class="bi bi-house-gear"></i></a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                @endif
                            @endif
                            {{-- @endcan --}}
                            <li class="ms-auto">
                                <form action="/logout" method="post">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-end"> Logout <i
                                            class="bi bi-box-arrow-left"></i></button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
