@extends('layout.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Konfirmasi Transaksi</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show col-lg-12" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="container">

        <div class="row">

            <div class="card">
                <h5 class="card-header">Kost</h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Kost</th>
                                    <th scope="col">Konfirmasi Transaksi</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Kost anggrek</td>
                                    <td class="col-md-2">
                                        <button type="button" class="btn btn-success text-dark">Berhasil</button>
                                        <button type="button" class="btn btn-danger text-dark">Gagal</button>
                                    </td>
                                    <td class="col-md-2">
                                        <button type="button" class="btn btn-warning">Laporkan Kost</button>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Kost mawar</td>
                                    <td class="col-md-2">
                                        <button type="button" class="btn btn-success text-dark">Berhasil</button>
                                        <button type="button" class="btn btn-danger text-dark">Gagal</button>
                                    </td>
                                    <td class="col-md-2">
                                        <button type="button" class="btn btn-warning">Laporkan Kost</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- <div class="col-lg-8 m-auto"> --}}
{{-- <div class="card col-md-4"> --}}


{{-- INI YANG VERSI 2 --}}
<div class="col-md-4">
    <div class="card mb-3">
        <h5 class="card-header">Cari...</h5>
        <div class="card-body">

            <form method="get" action="/konfirmasi" class="mb-0">
                {{-- otomatis langsung ke method store --}}
                @csrf


                {{-- //kelurahan  --}}
                <div class="mb-3">
                    <label for="kelurahan" class="form-label">Kelurahan</label>
                    <select class="form-select" name="kelurahan">
                        <option value="Bidara Cina" <?php if ($kelurahan == 'Bidara Cina') {
                            echo 'selected';
                        } ?>>Bidara Cina</option>
                        <option value="Cipinang Cempedak" <?php if ($kelurahan == 'Cipinang Cempedak') {
                            echo 'selected';
                        } ?>>Cipinang Cempedak</option>
                        <option value="Balimester" <?php if ($kelurahan == 'Balimester') {
                            echo 'selected';
                        } ?>>Balimester</option>
                    </select>
                </div>


                {{-- //rt  --}}
                <div class="mb-3">
                    <label for="rt" class="form-label">RT <span class="small" style="color: red">
                            (isikan tanpa angka 0 di depan)
                        </span></label>
                    <input type="text" class="form-control @error('rt') is-invalid @enderror" id="rt"
                        name="rt" required autofocus value="<?php if ($rt) {
                            echo $rt;
                        } ?>">
                    @error('rt')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- //rw  --}}
                <div class="mb-3">
                    <label for="rw" class="form-label">RW <span class="small" style="color: red">
                            (isikan tanpa angka 0 di depan)
                        </span></label>
                    <input type="text" class="form-control @error('rw') is-invalid @enderror" id="rw"
                        name="rw" required autofocus value="<?php if ($rw) {
                            echo $rw;
                        } ?>">
                    @error('rw')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- //Nomor rumah  --}}
                <div class="mb-3">
                    <label for="no" class="form-label">No. <span class="small" style="color: red">
                            (isikan tanpa angka 0 di depan)
                        </span></label>
                    <input type="text" class="form-control @error('no') is-invalid @enderror" id="no"
                        name="no" required autofocus value="<?php if ($no) {
                            echo $no;
                        } ?>">
                    @error('no')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-dark">Cari Kost/Kontrakan Untuk Konfirmasi</button>
            </form>
        </div>
    </div>
</div>


<div class="col-md-8">
    <div class="card mb-5">
        <h5 class="card-header">Hasil...</h5>
        @if ($no & $rt & $kelurahan & $rw)
            @if ($kosts->count() > 0)
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead>
                                <tr>
                                    <th scope="col" class="col-md-1">#</th>
                                    <th scope="col" class="col-md-8">Nama Kost</th>
                                    <th scope="col" class="col-md-3">Konfirmasi Transaksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kosts as $kost)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>Kost {{ $kost->nama }}</td>
                                        {{-- <td>
                                    @if ($kost->harga / 1000000 < 1)
                                        <span>{{ $kost->harga/1000 }}rb</span>/bln
                                    @else
                                        <span>{{ $kost->harga/1000000 }}jt</span>/bln
                                    @endif    
                                </td> --}}
                                        <td class="col-md-3">
                                            {{-- action pada form akan menuju ke web.php dan method itu post jika ada perubahan dan get jika cuma mengambil --}}

                                            {{-- <form action="konfirmasiKost/{{ $kost->id }}" method="post" class="d-inline">
                                        @method('post')
                                        @csrf
                                        <button type="submit" class="btn btn-success text-dark" onclick="return confirm('Apakah Anda yakin melakukan konfirmasi transaksi pada kost ini ?')">Konfirmasi</button>
                                    </form> --}}

                                            <form method="get" action="/konfirmasiKost" class="mb-0">
                                                @csrf
                                                {{-- <div> --}}
                                                <input type="hidden" id="kost_id" name="kost_id"
                                                    value="{{ $kost->id }}">
                                                <input type="hidden" id="kelurahan" name="kelurahan"
                                                    value="{{ $kelurahan }}">
                                                <input type="hidden" id="rt" name="rt"
                                                    value="{{ $rt }}">
                                                <input type="hidden" id="rw" name="rw"
                                                    value="{{ $rw }}">
                                                <input type="hidden" id="no" name="no"
                                                    value="{{ $no }}">
                                                {{-- </div> --}}
                                                <button type="submit" class="btn btn-dark"><i class="bi bi-eye"></i>
                                                    Lihat Kamar</button>
                                            </form>

                                    </tr>
                                @endforeach
                        </table>
                    </div>

                    <div class="d-flex justify-content-end">
                        {{ $kosts->links() }}
                    </div>
                </div>
            @elseif ($kontrakans->count() > 0)
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead>
                                <tr>
                                    <th scope="col" class="col-md-1">#</th>
                                    <th scope="col" class="col-md-8">Nama Kontrakan</th>
                                    <th scope="col" class="col-md-3">Konfirmasi Transaksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kontrakans as $kontrakan)
                                    {{-- @if ($kontrakan->status !== 0) --}}
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>Kontrakan {{ $kontrakan->nama }}</td>
                                        <td class="col-md-3">
                                            {{-- action pada form akan menuju ke web.php dan method itu post jika ada perubahan dan get jika cuma mengambil --}}
                                            <form action="konfirmasiKontrakan/{{ $kontrakan->id }}" method="post"
                                                class="d-inline">
                                                @method('post')
                                                @csrf
                                                <button type="submit" class="btn btn-success"><i
                                                        class="bi bi-check-circle"></i> Konfirmasi</button>
                                            </form>
                                    </tr>
                                    {{-- @endif --}}
                                @endforeach
                        </table>
                    </div>

                    <div class="d-flex justify-content-end">
                        {{ $kontrakans->links() }}
                    </div>
                </div>
            @else
                <p class="fst-italic m-auto my-3 text-center">
                    ~ Tidak ditemukan kost maupun kontrakan untuk dikonfirmasi pada alamat yang dimasukkan,
                    silakan lakukan pencarian alamat dahulu ~
                </p>
            @endif
        @else
            <p class="fst-italic m-auto my-3">
                ~ Lakukan pencarian alamat dahulu ~
            </p>

        @endif



    </div>
</div>

</div>
</div>

{{-- @endsection --}}
