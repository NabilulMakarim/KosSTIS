@extends('layout.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tambah atau update data kamar pada Kost {{ $namaKost }}</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show col-lg-12" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="container">

        <div class="row">

            {{-- <div class="card">
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
              {{-- <tr>
                <th scope="row">3</th>
                <td colspan="2">Larry the Bird</td>
                <td>@twitter</td>
              </tr> --}}
            {{-- </tbody>
          </table>
        </div>
      </div>
    </div> --}}



            {{-- <div class="col-lg-8 m-auto"> --}}
            {{-- <div class="card col-md-4"> --}}
            <div class="col-md-4">
                <div class="card mb-3">
                    <h5 class="card-header">Harga Kamar</h5>
                    <div class="card-body">

                        <form method="get" action="/kosts/tambahUpdateKamar" class="mb-0">
                            {{-- otomatis langsung ke method store --}}
                            @csrf

                            {{-- //harga  --}}
                            <div class="mb-3">
                                <label for="harga" class="form-label">Harga perbulan (misal: 800000)<br>
                                    <small>
                                        <span>*Masukkan harga kamar dahulu untuk menambah kamar</span>
                                    </small></label>
                                <input type="text" class="form-control @error('harga') is-invalid @enderror"
                                    id="harga" name="harga" required autofocus value="{{ old('harga', $harga) }}">
                                @error('harga')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <input type="hidden" id="kost_id" name="kost_id" value={{ $kost_id }}>

                            <button type="submit" class="btn btn-dark">Masukkan Harga Kamar</button>
                        </form>
                    </div>
                </div>
            </div>


            <div class="col-md-8">
                <div class="card mb-5">
                    <h5 class="card-header">Hasil...</h5>
                    @if ($kamars->count() > 0)
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover align-middle">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="col-md-1">#</th>
                                            <th scope="col" class="col-md-8">Jenis Kamar</th>
                                            <th scope="col" class="col-md-3">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kamars as $kamar)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>Kamar tipe harga {{ $kamar->harga }}</td>
                                                @if ($kamar->statusUpdateKamar == 0)
                                                    <td class="col-md-3">
                                                        <a href="#" class="btn btn-secondary">Dalam Pengajuan</a>
                                            </tr>
                                        @else
                                            <td class="col-md-3">
                                                <a href="/kosts/editKamar/{{ $kamar->id }}"
                                                    class="btn btn-warning">Update</a>
                                                </tr>
                                        @endif
                    @endforeach
                    </table>
                </div>

                {{-- <div class="d-flex justify-content-end">
                      {{ $kamars->links() }}
                    </div> --}}
            </div>
        @else
            <p class="fst-italic m-auto my-3">
                ~Tidak ditemukan kamar dengan harga tersebut yang terdaftar pada kost ini~
            </p>

            @if ($harga)
                <div class="row d-flex justify-content-evenly mb-3">
                    <div class="col-lg-4">

                        {{-- <a href="/kontrakans/tambahKontrakan" class="btn btn-dark">Tambah Data Kontrakan</a> --}}

                        <form method="get" action="/kosts/tambahKamar" class="mb-0">
                            @csrf
                            <input type="hidden" id="harga" name="harga" value="{{ $harga }}">
                            <input type="hidden" id="kost_id" name="kost_id" value="{{ $kost_id }}">

                            <button type="submit" class="btn btn-dark">Tambah Kamar Baru</button>
                        </form>
                    </div>
                </div>
            @else
                <p class="fst-italic m-auto mb-3">
                    ~Untuk menambahkan kamar, silakan masukkan harga dahulu lalu pilih <b>Masukkan Harga Kamar</b>~
                </p>
            @endif
            @endif


        </div>
    </div>

    </div>
    </div>

@endsection
