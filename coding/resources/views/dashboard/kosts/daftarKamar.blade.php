@extends('dashboard.layout.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Daftar kamar pada kost {{ $kost->nama }}</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show col-lg-12" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('danger'))
        <div class="alert alert-danger alert-dismissible fade show col-lg-12" role="alert">
            {{ session('danger') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-3">
            <form method="get" action="/dashboard/kosts/createKamar" class="mb-3">
                @csrf
                <input type="hidden" id="kost_id" name="kost_id" value="{{ $kost->id }}">

                <button type="submit" class="btn btn-primary">Tambah Kamar</i></button>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            {{-- kost di sini adalah informasi kamar tiap kost  --}}
            @if ($kamars->count() > 0)
                <div class="table-responsive col-lg-12">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th scope="col-lg-1">#</th>
                                <th scope="col-lg-4">Harga Kamar</th>
                                {{-- <th scope="col-lg-2">Kelurahan</th>
                                <th scope="col-lg-1">RT</th>
                                <th scope="col-lg-1">RW</th>
                                <th scope="col-lg-1">No.</th> --}}
                                <th scope="col-lg-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kamars as $kamar)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $kamar->harga }}</td>
                                    {{-- <td>{{ $kamar->kelurahan }}</td>
                                    <td>{{ $kamar->rt }}</td>
                                    <td>{{ $kamar->rw }}</td>
                                    <td>{{ $kamar->no }}</td> --}}
                                    <td class="col-md-2">
                                        <a href="/dashboard/kosts/detailKamar/{{ $kamar->id }}"
                                            class="badge bg-secondary"><i class="fas fa-eye"></i></a>
                                        <a href="/dashboard/kosts/editKamar/{{ $kamar->id }}"
                                            class="badge bg-warning text-white"><i class="fas fa-edit"></i></a>

                                        {{-- <button class="badge bg-danger border-0" data-toggle="modal" data-target="#hapus"><i
                                                class="fas fa-trash"></i></button> --}}
                                        <form action="/dashboard/kosts/deleteKamar/{{ $kamar->id }}" method="post"
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
                                                Apakah Anda yakin <b>menghapus</b> data kamar ini ?
                                            </div>
                                            <div class="modal-footer">
                                                <form action="/dashboard/kamars/delete/{{ $kamar->id }}" method="post"
                                                    class="d-inline">
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
                <div class="col-lg-9">
                    <p class="text-center fs-4">Belum ada kamar kost yang ditambahkan</p>
                </div>
            @endif

            <div class="d-flex justify-content-end col-lg-9">
                {{ $kamars->links() }}
            </div>
        </div>
    </div>

@endsection
