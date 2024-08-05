@extends('dashboard.layout.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Pengajuan Pembaharuan</h1>
    </div>

    {{-- <form Aksi="/dashboard/kontrakans" method="get">
  <div class="col-lg-12">
    <div class="input-group mb-3">
      <input type="text" class="form-control" placeholder="Search .." name="search" value="{{ request('search') }}">
      <button class="btn btn-dark" type="submit">Search</button>
    </div>
  </div>
</form> --}}


    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show col-lg-12" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif




    <div class="row d-flex justify-content-center">

        {{-- KOST  --}}
        <div class="col-md-4">
            <div class="card">
                <h5 class="card-header">Kost</h5>
                <div class="card-body">
                    @if ($kosts->count() > 0)
                        <div class="table-responsive col-lg-12">
                            {{-- <a href="/dashboard/kosts/create" class="btn btn-primary mb-3">Tambahkan Kost</a> --}}
                            <table class="table table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col" class="col-lg-10">Nama Kost</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kosts as $kost)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>Kost {{ $kost->nama }}</td>
                                            <td class="col-md-2">
                                                <a href="/dashboard/pembaharuanKost/{{ $kost->id }}"
                                                    class="badge bg-secondary"><i class="fas fa-eye"></i></a>
                                                {{-- <a href="/dashboard/kosts/{{ $kost->id }}/edit" class="badge bg-warning"><span data-feather="edit" ></span></a> --}}
                                                {{-- <form Aksi="/dashboard/tolakKost/{{ $kost->id }}" method="post" class="d-inline">
                @method('delete')
                @csrf
                <button class="badge bg-danger border-0" onclick="return confirm('Apakah Anda yakin menolak pembaharuan data kost ini?')"><span data-feather="x-circle" ></span></button>
              </form> --}}
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="col-lg-12">
                            <p class="text-center fs-4">Tidak ada pengajuan pembaharuan kost</p>
                        </div>
                    @endif

                    <div class="d-flex justify-content-end col-lg-12">
                        {{ $kosts->links() }}
                    </div>
                </div>
            </div>
        </div>


        {{-- KONTRAKAN  --}}
        <div class="col-md-4">
            <div class="card">
                <h5 class="card-header">Kontrakan</h5>
                <div class="card-body">
                    @if ($kontrakans->count() > 0)
                        <div class="table-responsive col-lg-12">
                            {{-- <a href="/dashboard/kontrakans/create" class="btn btn-primary mb-3">Tambahkan Kontrakan</a> --}}
                            <table class="table table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col" class="col-lg-10">Nama</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kontrakans as $kontrakan)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>Kontrakan {{ $kontrakan->nama }}</td>
                                            <td class="col-md-2">
                                                <a href="/dashboard/pembaharuanKontrakan/{{ $kontrakan->id }}"
                                                    class="badge bg-secondary"><i class="fas fa-eye"></i></span></a>
                                                {{-- <form Aksi="/dashboard/terimaKontrakan/{{ $kontrakan->id }}" method="post" class="d-inline">
                  @csrf
                  <button class="badge bg-warning border-0" onclick="return confirm('Apakah Anda yakin menerima pembaharuan data kontrakan ini?')"><span data-feather="edit" ></span></button>
                </form>
                <form Aksi="/dashboard/tolakKontrakan/{{ $kontrakan->id }}" method="post" class="d-inline">
                  @method('delete')
                  @csrf
                  <button class="badge bg-danger border-0" onclick="return confirm('Apakah Anda yakin menolak pembaharuan data kontrakan ini?')"><span data-feather="x-circle" ></span></button>
                </form> --}}
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="col-lg-12">
                            <p class="text-center fs-4">Tidak ada pengajuan pembaharuan kontrakan</p>
                        </div>
                    @endif

                    <div class="d-flex justify-content-end col-lg-12">
                        {{ $kontrakans->links() }}
                    </div>

                </div>
            </div>
        </div>




        {{-- KAMAR  --}}
        <div class="col-md-4">
            <div class="card">
                <h5 class="card-header">Kamar</h5>
                <div class="card-body">
                    @if ($kamars->count() > 0)
                        <div class="table-responsive col-lg-12">
                            {{-- <a href="/dashboard/kontrakans/create" class="btn btn-primary mb-3">Tambahkan Kontrakan</a> --}}
                            <table class="table table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col" class="col-lg-10">Kamar</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kamars as $kamar)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>Kost {{ $kamar->nama }} tipe
                                                {{-- @if ($kamar->harga / 1000000 < 1) --}}
                                                {{ $kamar->harga / 1000 }}
                                                {{-- @else
                  {{ $kamar->harga/1000000 }}jt/bln
                @endif           --}}
                                            </td>
                                            <td class="col-md-2">
                                                <a href="/dashboard/pembaharuanKamar/{{ $kamar->id }}"
                                                    class="badge bg-secondary"><i class="fas fa-eye"></i></a>
                                                {{-- <form Aksi="/dashboard/terimaKontrakan/{{ $kontrakan->id }}" method="post" class="d-inline">
                  @csrf
                  <button class="badge bg-warning border-0" onclick="return confirm('Apakah Anda yakin menerima pembaharuan data kontrakan ini?')"><span data-feather="edit" ></span></button>
                </form>
                <form Aksi="/dashboard/tolakKontrakan/{{ $kontrakan->id }}" method="post" class="d-inline">
                  @method('delete')
                  @csrf
                  <button class="badge bg-danger border-0" onclick="return confirm('Apakah Anda yakin menolak pembaharuan data kontrakan ini?')"><span data-feather="x-circle" ></span></button>
                </form> --}}
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="col-lg-12">
                            <p class="text-center fs-4"> Tidak ada pengajuan pembaharuan kamar </p>
                        </div>
                    @endif

                    <div class="d-flex justify-content-end col-lg-12">
                        {{ $kamars->links() }}
                    </div>

                </div>
            </div>
        </div>

    </div>

@endsection
