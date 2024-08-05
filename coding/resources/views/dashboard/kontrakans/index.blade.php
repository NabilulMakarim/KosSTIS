@extends('dashboard.layout.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Kontrakan</h1>
    </div>



    <div class="row">
        <div class="col-lg-9">
            <form action="/dashboard/kontrakans" method="get">
                <div class="col-lg-12">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search Berdasarkan Nama Kontrakan..."
                            name="search" value="{{ request('search') }}">
                        <button class="btn btn-dark" type="submit">Search</button>
                    </div>
                </div>
            </form>
        </div>
        {{-- <div class="col-lg-3">
            <a href="/dashboard/kontrakans/create" class="btn btn-primary mb-3">Tambahkan Kontrakan</a>
        </div> --}}
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show col-lg-12" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <h5 class="card-header">Untuk mencari, masukkan alamat kontrakan</h5>
                <div class="card-body">
                    <form method="get" action="/dashboard/kontrakans" class="mb-0">
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

                        <button type="submit" class="btn btn-dark">Cari Kontrakan</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            @if ($kontrakans->count() > 0)
                <div class="table-responsive col-lg-12">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th scope="col-lg-1">#</th>
                                <th scope="col-lg-4">Nama Kontrakan</th>
                                <th scope="col-lg-2">Kelurahan</th>
                                <th scope="col-lg-1">RT</th>
                                <th scope="col-lg-1">RW</th>
                                <th scope="col-lg-1">No.</th>
                                <th scope="col-lg-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kontrakans as $kontrakan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>Kontrakan {{ $kontrakan->nama }}</td>
                                    <td>{{ $kontrakan->kelurahan }}</td>
                                    <td>{{ $kontrakan->rt }}</td>
                                    <td>{{ $kontrakan->rw }}</td>
                                    <td>{{ $kontrakan->no }}</td>
                                    <td class="col-md-2">
                                        <a href="/dashboard/kontrakans/show/{{ $kontrakan->id }}"
                                            class="badge bg-secondary"><i class="fas fa-eye"></i></a>
                                        <a href="/dashboard/kontrakans/edit/{{ $kontrakan->id }}"
                                            class="badge bg-warning text-white"><i class="fas fa-edit"></i></a>

                                        {{-- <button class="badge bg-danger border-0" data-toggle="modal" data-target="#hapus"><i
                                                class="fas fa-trash"></i></button> --}}
                                        <form action="/dashboard/kontrakans/delete/{{ $kontrakan->id }}" method="post"
                                            class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="badge bg-danger border-0"><i
                                                    class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Modal Hapus -->
                                <div class="modal fade" id="hapus" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Tindakan</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin <b>menghapus</b> data kontrakan ini ?
                                            </div>
                                            <div class="modal-footer">
                                                <form action="/dashboard/kontrakans/delete/{{ $kontrakan->id }}"
                                                    method="post" class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary">Iya</button>
                                                </form>

                                                <button type="button" class="btn btn-danger"
                                                    data-dismiss="modal">Batal</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            @else
                <div class="col-lg-8">
                    <p class="text-center fs-4">
                        Belum ada kontrakan yang ditambahkan <br>
                        <a href="/dashboard/kontrakans/create" class="btn btn-primary mt-3">Tambahkan Kontrakan</a>
                    </p>
                </div>
            @endif

            <div class="d-flex justify-content-end col-lg-9">
                {{ $kontrakans->links() }}
            </div>
        </div>

    </div>





@endsection
