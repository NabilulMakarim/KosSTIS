@extends('dashboard.layout.main')

@section('container')
    {{-- <section class="content">
  <div class="container-fluid"> --}}

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Riwayat pengguna menghubungi pemilik</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show col-lg-12" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- TAMPILAN DASHBOARD ATAS --}}
    <div class="row mb-5">
        <div class="col-md-6">
            <div class="card">
                <h5 class="card-header">Jumlah riwayat hubungi</h5>
                <div class="card-body d-flex justify-content-center">
                    <h1>{{ $riwayatTotal }}</h1>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <h5 class="card-header">Hapus riwayat hubungi bulan lalu</h5>
                <div class="card-body d-flex justify-content-center">
                    {{-- <h1>{{ $kontrakan->count() }}</h1> --}}
                    <form action="/dashboard/konfirmasi/hapusBulan" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus riwayat bulan
                            lalu</button>
                    </form>
                </div>
            </div>
            {{-- </div> --}}

            {{-- <div class="col-md-4"> --}}
            <div class="card">
                <h5 class="card-header">Hapus semua riwayat hubungi</h5>
                <div class="card-body d-flex justify-content-center">
                    {{-- <h1>{{ $penggunaBiasa->count() + $pengelola->count() }}</h1> --}}
                    {{-- <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</a> --}}
                    <form action="/dashboard/konfirmasi/hapusAll" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus semua
                            riwayat</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    {{-- TAMPILAN DASHBOARD BAWAH --}}
    {{-- @if (auth()->user()->is_admin == 2)
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
    @endif --}}
@endsection
