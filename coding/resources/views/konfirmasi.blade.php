@extends('layout.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Riwayat Transaksi</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show col-lg-12" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- @php
        $kosts = [];
        $kontrakan = [];
    @endphp --}}

    <div class="container">

        {{-- @if (auth()->user()->tempat_id)
            <div class="row mb-3">
                <h5 class="text-center">Anda sudah memiliki tempat tinggal. Apakah Anda berpindah kost atau kontrakan ?</h5>
            </div>
        @else --}}
        @if ($kosts->count() > 0 or $kontrakans->count() > 0)
            @if ($kosts->count() > 0)
                <div class="row mb-3">
                    <div class="card mb-3" style="padding: 0px">
                        <h5 class="card-header">Kost</h5>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover align-middle">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama Kost</th>
                                            <th scope="col">Harga</th>
                                            <th scope="col">Alamat</th>
                                            <th scope="col">Tanggal</th>
                                            <th scope="col">Konfirmasi Transaksi</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kosts as $kost)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>Kost {{ $kost->nama }}</td>
                                                <td>{{ $kost->harga }}</td>
                                                <td>
                                                    {{ $kost->kelurahan }},
                                                    RT {{ $kost->rt }},
                                                    RW {{ $kost->rw }},
                                                    No.{{ $kost->no }}
                                                </td>
                                                <td>{{ date('d-m-Y', strtotime($kost->updated_at)) }}</td>
                                                <td class="col-md-2">

                                                    <form action="konfirmasiKost" method="post" class="d-inline">
                                                        @method('post')
                                                        @csrf
                                                        <input type="hidden" id="id" name="id"
                                                            value={{ $kost->id }}>
                                                        <input type="hidden" id="kamar_id" name="kamar_id"
                                                            value={{ $kost->kamar_id }}>
                                                        <input type="hidden" id="jumKos" name="jumKos"
                                                            value={{ $kost->jumKos }}>
                                                        <button type="submit"
                                                            class="btn btn-success  text-dark">Berhasil</button>
                                                    </form>

                                                    <form action="/konfirmasi/deleteKost" method="post" class="d-inline">
                                                        @method('delete')
                                                        @csrf
                                                        <input type="hidden" id="id" name="id"
                                                            value={{ $kost->id }}>
                                                        <button type="submit"
                                                            class="btn btn-danger text-dark">Gagal</button>
                                                    </form>
                                                </td>
                                                <td class="col-md-2">
                                                    <a href="https://api.whatsapp.com/send?phone=62{{ $admin->noHp }}&text=Selamat Pagi/Siang/Sore benar Admin web KoStis ? %0A%0ASaya ingin melaporkan kost dengan nama kost {{ $kost->nama }} yang beralamatkan di Kelurahan {{ $kost->kelurahan }}, RT.{{ $kost->rt }}, RW.{{ $kost->rw }}, No.{{ $kost->no }} %0A%0A
                                            (Selanjutnya isi sendiri tentang laporan yang ingin disampaikan)
"
                                                        target="_blank" class="btn btn-warning"> Laporkan</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        {{ $kosts->links() }}
                    </div>
                </div>
            @endif
            @if ($kontrakans->count() > 0)
                <div class="row mb-3">
                    <div class="card mb-3" style="padding: 0px">
                        <h5 class="card-header">Kontrakan</h5>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover align-middle">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama Kontrakan</th>
                                            <th scope="col">Alamat</th>
                                            <th scope="col">Tanggal</th>
                                            <th scope="col">Konfirmasi Transaksi</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kontrakans as $kontrakan)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>Kontrakan {{ $kontrakan->nama }}</td>
                                                <td>
                                                    {{ $kontrakan->kelurahan }},
                                                    RT {{ $kontrakan->rt }},
                                                    RW {{ $kontrakan->rw }},
                                                    No.{{ $kontrakan->no }}
                                                </td>
                                                <td>{{ date('d-m-Y', strtotime($kontrakan->updated_at)) }}</td>
                                                <td class="col-md-2">

                                                    <form action="konfirmasiKontrakan" method="post" class="d-inline">
                                                        @method('post')
                                                        @csrf
                                                        <input type="hidden" id="id" name="id"
                                                            value={{ $kontrakan->id }}>
                                                        <input type="hidden" id="kontrakan_id" name="kontrakan_id"
                                                            value={{ $kontrakan->kontrakan_id }}>
                                                        <button type="submit"
                                                            class="btn btn-success  text-dark">Berhasil</button>
                                                    </form>

                                                    <form action="/konfirmasi/deleteKontrakan" method="post"
                                                        class="d-inline">
                                                        @method('delete')
                                                        @csrf
                                                        <input type="hidden" id="id" name="id"
                                                            value={{ $kontrakan->id }}>
                                                        <button type="submit"
                                                            class="btn btn-danger text-dark">Gagal</button>
                                                    </form>
                                                </td>
                                                <td class="col-md-2">
                                                    <a href="https://api.whatsapp.com/send?phone=62{{ $admin->noHp }}&text=Selamat Pagi/Siang/Sore benar Admin web KoStis ? %0A%0ASaya ingin melaporkan kontrakan dengan nama kontrakan {{ $kontrakan->nama }} yang beralamatkan di Kelurahan {{ $kontrakan->kelurahan }}, RT.{{ $kontrakan->rt }}, RW.{{ $kontrakan->rw }}, No.{{ $kontrakan->no }} %0A%0A
                                            (Selanjutnya isi sendiri tentang laporan yang ingin disampaikan)
"
                                                        target="_blank" class="btn btn-warning"> Laporkan</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        {{ $kontrakans->links() }}
                    </div>
                </div>
            @endif
        @else
            <div class="row mb-3">
                <h5 class="text-center">Anda belum memiliki riwayat menghubungi kost atau kontrakan</h5>
            </div>
        @endif
        {{-- @endif --}}


    </div>
@endsection
