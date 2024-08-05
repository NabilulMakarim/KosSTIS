@extends('layout.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tambah atau update data kontrakan</h1>
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
                    <h5 class="card-header">Masukkan Alamat Kontrakan Dahulu</h5>
                    <div class="card-body">

                        <form method="get" action="/kontrakans/tambahUpdateKontrakan" class="mb-0">
                            {{-- otomatis langsung ke method store --}}
                            @csrf

                            {{-- //kelurahan  --}}
                            <div class="mb-3">
                                <label for="kelurahan" class="form-label">Kelurahan</label>
                                <select class="form-select" name="kelurahan">
                                    <option value="Balimester" <?php if (old('kelurahan', $kelurahan) == 'Balimester') {
                                        echo 'selected';
                                    } ?>>Balimester</option>
                                    <option value="Bidara Cina" <?php if (old('kelurahan', $kelurahan) == 'Bidara Cina') {
                                        echo 'selected';
                                    } ?>>Bidara Cina</option>
                                    <option value="Cipinang Cempedak" <?php if (old('kelurahan', $kelurahan) == 'Cipinang Cempedak') {
                                        echo 'selected';
                                    } ?>>Cipinang Cempedak</option>
                                </select>
                            </div>


                            {{-- //rt  --}}
                            <div class="mb-3">
                                <label for="rt" class="form-label">RT <span class="small">
                                        (isikan tanpa angka 0 di depan)
                                    </span></label>
                                <input type="text" class="form-control @error('rt') is-invalid @enderror" id="rt"
                                    name="rt" required autofocus value="{{ old('rt', $rt) }}">
                                @error('rt')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- //rw  --}}
                            <div class="mb-3">
                                <label for="rw" class="form-label">RW <span class="small">
                                        (isikan tanpa angka 0 di depan)
                                    </span></label>
                                <input type="text" class="form-control @error('rw') is-invalid @enderror" id="rw"
                                    name="rw" required autofocus value="{{ old('rw', $rw) }}">
                                @error('rw')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- //Nomor rumah  --}}
                            <div class="mb-3">
                                <label for="no" class="form-label">No. <span class="small">
                                        (isikan tanpa angka 0 di depan)
                                    </span></label>
                                <input type="text" class="form-control @error('no') is-invalid @enderror" id="no"
                                    name="no" required autofocus value="{{ old('no', $no) }}">
                                @error('no')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- //harga  --}}
                            {{-- <div class="mb-3">
                    <label for="harga" class="form-label">Harga perbulan (misal: 800000)</label>
                    <input type="text" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" required autofocus value="{{ old('harga') }}">
                    @error('harga')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div> --}}

                            <button type="submit" class="btn btn-dark">Cari Kontrakan</button>
                        </form>
                    </div>
                </div>
            </div>


            <div class="col-md-8">
                <div class="card mb-5">
                    <h5 class="card-header">Hasil...</h5>
                    @if ($kontrakans->count() > 0)
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover align-middle">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="col-md-1">#</th>
                                            <th scope="col" class="col-md-8">Nama Kontrakan</th>
                                            <th scope="col" class="col-md-3">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kontrakans as $kontrakan)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>Kontrakan {{ $kontrakan->nama }}</td>
                                                @if ($kontrakan->statusUpdate == 0)
                                                    <td class="col-md-3">
                                                        <a href="#" class="btn btn-secondary">Dalam Pengajuan</a>
                                            </tr>
                                        @else
                                            <td class="col-md-3">
                                                <a href="/kontrakans/editKontrakan/{{ $kontrakan->id }}"
                                                    class="btn btn-warning">Update</a>
                                                </tr>
                                        @endif
                    @endforeach
                    </table>
                </div>

                <div class="d-flex justify-content-end">
                    {{ $kontrakans->links() }}
                </div>
            </div>
        @else
            <p class="fst-italic m-auto my-3">
                ~Tidak ditemukan kontrakan dengan alamat tersebut~
            </p>

            @if ($no)
                <div class="row d-flex justify-content-evenly mb-3">
                    <div class="col-lg-4">

                        {{-- <a href="/kontrakans/tambahKontrakan" class="btn btn-dark">Tambah Data Kontrakan</a> --}}

                        <form method="get" action="/kontrakans/tambahKontrakan" class="mb-0">
                            @csrf
                            <div>
                                <input type="hidden" id="kelurahan" name="kelurahan" value="{{ $kelurahan }}">
                            </div>
                            <div>
                                <input type="hidden" id="rt" name="rt" value="{{ $rt }}">
                            </div>
                            <div>
                                <input type="hidden" id="rw" name="rw" value="{{ $rw }}">
                            </div>
                            <div>
                                <input type="hidden" id="no" name="no" value="{{ $no }}">
                            </div>
                            <button type="submit" class="btn btn-dark">Tambah Data Kontrakan</button>
                        </form>
                    </div>
                </div>
            @else
                <p class="fst-italic m-auto mb-3">
                    ~Silakan Masukkan Alamat~
                </p>
            @endif
            @endif


        </div>
    </div>

    </div>
    </div>

@endsection
