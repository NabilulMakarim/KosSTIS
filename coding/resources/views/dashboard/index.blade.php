@extends('dashboard.layout.main')

@section('container')
    {{-- <section class="content">
  <div class="container-fluid"> --}}

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Welcome back, {{ auth()->user()->nama }}</h1>
    </div>


    {{-- TAMPILAN DASHBOARD ATAS --}}
    <div class="row mb-5">
        <div class="col-md-4">
            <div class="card">
                <h5 class="card-header">Jumlah Kost(Kamar) Terdaftar</h5>
                <div class="card-body d-flex justify-content-center">
                    <h1>{{ $kost->count() }}({{ $kamar->count() }})</h1>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <h5 class="card-header">Jumlah Kontrakan Terdaftar</h5>
                <div class="card-body d-flex justify-content-center">
                    <h1>{{ $kontrakan->count() }}</h1>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <h5 class="card-header">Jumlah Pengguna</h5>
                <div class="card-body d-flex justify-content-center">
                    <h1>{{ $penggunaBiasa->count() + $pengelola->count() }}</h1>
                </div>
            </div>
        </div>
    </div>

    {{-- TAMPILAN DASHBOARD BAWAH --}}
    @if (auth()->user()->is_admin == 2)
        <div class="row mb-3">
            <div class="col-md-12">

                <div class="card">
                    <h5 class="card-header text-center">Informasi Pengguna Terdaftar</h5>
                    <div class="card-body">

                        <div class="row mb-3  d-flex justify-content-evenly">

                            <div class="col-md-4">
                                <div class="card">
                                    <h5 class="card-header">Jumlah Pengguna Biasa</h5>
                                    <div class="card-body d-flex justify-content-center">
                                        <h1>{{ $penggunaBiasa->count() }}</h1>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card">
                                    <h5 class="card-header">Jumlah Pengelola</h5>
                                    <div class="card-body d-flex justify-content-center">
                                        <h1>{{ $pengelola->count() }}</h1>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    @else
        <div class="row mb-3">
            <div class="col-md-12">

                <div class="card">
                    <h5 class="card-header">Pengajuan yang Perlu di Proses</h5>
                    <div class="card-body">

                        <div class="row mb-3  d-flex justify-content-evenly">

                            <div class="col-md-4">
                                <a href="/dashboard/penambahan" class="text-decoration-none text-dark">
                                    <div class="card">
                                        <h5 class="card-header">Pengajuan Tambah Data</h5>
                                        <div class="card-body d-flex justify-content-center"
                                            @if ($penambahanKamar->count() + $penambahanKost->count() + $penambahanKontrakan->count() > 0) style="background-color: yellow" @endif>
                                            <h1>{{ $penambahanKamar->count() + $penambahanKost->count() + $penambahanKontrakan->count() }}
                                            </h1>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-4">
                                <a href="/dashboard/pembaharuan" class="text-decoration-none text-dark">
                                    <div class="card">
                                        <h5 class="card-header">Pengajuan Update Data</h5>
                                        <div class="card-body d-flex justify-content-center"
                                            @if ($pembaharuanKamar->count() + $pembaharuanKost->count() + $pembaharuanKontrakan->count() > 0) style="background-color: yellow" @endif>
                                            <h1>{{ $pembaharuanKamar->count() + $pembaharuanKost->count() + $pembaharuanKontrakan->count() }}
                                            </h1>
                                        </div>
                                    </div>
                                </a>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    @endif





    <div>
        {{-- <p>
            Jumlah Pengguna Total = {{ $penggunaBiasa->count() }}
          </p>
          <p>
            Jumlah Pengelola Total = {{ $pengelola->count() }}
          </p>
          <p>
            Jumlah Kost Terdaftar = {{ $kost->count() }}
          </p>
          <p>
            Jumlah Kontrakan Terdaftar = {{ $kontrakan->count() }}
          </p> --}}
        {{-- <p>
            Jumlah Pengajuan Penambahan Belum di Proses = {{ $penambahanKost + $penambahanKontrakan->count() }}
          </p>
          <p>
            Jumlah Pengajuan Pembaharuan Belum di Proses = {{ $pembaharuanKost + $pembaharuanKontrakan->count() }}
          </p> --}}
    </div>
    {{-- </div>
</div> --}}
@endsection
