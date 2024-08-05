@extends('dashboard.layout.main')

@section('container')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Pengajuan Pembaharuan Data Kamar {{ $kamar->harga }}</h2>
                <h6>Oleh : {{ $user->nama }}, {{ $user->nim }}</h6>

                <a href="/dashboard/pembaharuan" class="btn btn-success mb-3"><i class="fas fa-chevron-circle-left"></i>
                    Kembali</a>


                {{-- <a href="/dashboard/kosts/{{ $post->slug }}/edit" class="btn btn-warning"><span data-feather="edit" ></span> Edit</a>

            <form action="/dashboard/kosts/{{ $post->slug }}" method="post" class="d-inline"> --}}


            </div>
        </div>
    </div>


    <div class="row">

        <div class="col-md-6 mb-3">
            <div class="card">
                <h5 class="card-header">Data Lama</h5>
                <div class="card-body">
                    <div class="mb-3">
                        @if ($kamar->imageKamar)
                            <div>
                                <img src="{{ asset('storage/' . $kamar->imageKamar) }}" alt="{{ $kamar->nama }}"
                                    style="max-width: 100%; height: 350px;" class="rounded mx-auto d-block mt-3">
                            </div>
                        @else
                            <div class="card align-items-center justify-content-center mt-3" style="height: 350px">
                                <h1 class="align-middle">Gambar tidak tersedia</h1>
                            </div>
                        @endif
                    </div>

                    {{-- //harga  --}}
                    <div class="mb-3">
                        <label for="harga" class="form-label fw-bold">Harga perbulan (misal: 800000)</label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('harga') is-invalid @enderror" id="harga"
                                name="harga" disable readonly required value="{{ old('harga', $kamar->harga) }}">
                            <div class="input-group-text">/bulan</div>
                        </div>
                    </div>

                    {{-- //ukuran  --}}
                    <div class="mb-3">
                        <label for="ukuran" class="form-label fw-bold">Ukuran Kamar (meter)</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="ukuran" name="ukuran" disable readonly
                                required value="{{ $kamar->ukuran }}">
                        </div>
                    </div>

                    {{-- //kamarMandi  --}}
                    <div class="mb-3">
                        <label for="kamarMandi" class="form-label fw-bold">Jenis Kamar Mandi</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="kamarMandi" name="kamarMandi" disable readonly
                                required value="{{ $kamar->kamarMandi }}">
                        </div>
                    </div>

                    {{-- //Jumlah Kamar  --}}
                    <div class="mb-3">
                        <label for="jumKam" class="form-label fw-bold">Jumlah Kamar</label>
                        <input type="text" class="form-control @error('jumKam') is-invalid @enderror" id="jumKam"
                            name="jumKam" disable readonly required value="{{ old('jumKam', $kamar->jumKam) }}">
                    </div>

                    {{-- //Jumlah Kosog  --}}
                    <div class="mb-3">
                        <label for="jumKos" class="form-label fw-bold">Jumlah Kamar Kosong</label>
                        <input type="text" class="form-control @error('jumKos') is-invalid @enderror" id="jumKos"
                            name="jumKos" disable readonly required value="{{ old('jumKos', $kamar->jumKos) }}">
                    </div>


                    {{-- //durasi Dewa  --}}
                    <div class="mb-3">
                        <label for="durSewa" class="form-label fw-bold">Durasi Sewa (dalam bulan)</label>
                        <input type="text" class="form-control @error('durSewa') is-invalid @enderror" id="durSewa"
                            name="durSewa" disable readonly required value="{{ old('durSewa', $kamar->durSewa) }}">
                    </div>

                    {{-- //Fasilitas  --}}
                    <div class="mb-3">
                        <label for="fasilitasKamar" class="form-label fw-bold">Fasilitas Kamar</label>
                        <input type="textarea" class="form-control @error('fasilitasKamar') is-invalid @enderror"
                            id="fasilitasKamar" name="fasilitasKamar" disable readonly required
                            value="{{ old('fasilitasKamar', $kamar->fasilitasKamar) }}">
                    </div>


                    {{-- //deskripsi  --}}
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label fw-bold">Deskripsi kamar</label>
                        <div class="card">
                            <div class="card-body" style="background-color: #E9ECEF">
                                {!! $kamar->deskripsiKamar !!}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>



        {{-- DATA BARU  --}}

        <div class="col-md-6 mb-3">
            <div class="card">
                <h5 class="card-header">Data Baru</h5>
                <div class="card-body">

                    <div class="mb-3">
                        @if ($edit->imageKamar)
                            <div>
                                <img src="{{ asset('storage/' . $edit->imageKamar) }}" alt="{{ $edit->nama }}"
                                    style="max-width: 100%; height: 350px;" class="rounded mx-auto d-block mt-3">
                            </div>
                            <input class="form-control @error('imageKamar') is-invalid @enderror" type="hidden"
                                id="imageKamar" name="imageKamar" disable readonly required
                                value="{{ $edit->imageKamar }}">
                        @else
                            @if ($kamar->imageKamar)
                                <div>
                                    <img src="{{ asset('storage/' . $kamar->imageKamar) }}" alt="{{ $kamar->nama }}"
                                        style="max-width: 100%; height: 350px;" class="rounded mx-auto d-block mt-3">
                                </div>
                            @else
                                <div class="card align-items-center justify-content-center mt-3" style="height: 350px">
                                    <h1 class="align-middle">Gambar tidak tersedia</h1>
                                </div>
                            @endif

                            <input class="form-control @error('imageKamar') is-invalid @enderror" type="hidden"
                                id="imageKamar" name="imageKamar" disable readonly required
                                value="{{ $kamar->imageKamar }}">
                        @endif
                    </div>


                    {{-- //harga  --}}
                    <div class="mb-3">
                        <label for="harga" class="form-label fw-bold">Harga perbulan (misal: 800000)</label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('harga') is-invalid @enderror"
                                id="harga" name="harga" disable readonly required
                                value="{{ old('harga', $edit->harga) }}"
                                @if ($edit->harga != $kamar->harga) style="background-color: yellow" @endif>
                            <div class="input-group-text">/bulan</div>
                        </div>
                    </div>

                    {{-- //ukuran  --}}
                    <div class="mb-3">
                        <label for="ukuran" class="form-label fw-bold">Ukuran Kamar (misal 3x3)</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="ukuran" name="ukuran" disable readonly
                                required value="{{ $edit->ukuran }}"
                                @if ($edit->ukuran != $kamar->ukuran) style="background-color: yellow" @endif>
                        </div>
                    </div>

                    {{-- //kamarMandi  --}}
                    <div class="mb-3">
                        <label for="kamarMandi" class="form-label fw-bold">Jenis Kamar Mandi</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="kamarMandi" name="kamarMandi" disable
                                readonly required value="{{ $edit->kamarMandi }}"
                                @if ($edit->kamarMandi != $kamar->kamarMandi) style="background-color: yellow" @endif>
                        </div>
                    </div>

                    {{-- //Jumlah Kamar  --}}
                    <div class="mb-3">
                        <label for="jumKam" class="form-label fw-bold">Jumlah Kamar</label>
                        <input type="text" class="form-control @error('jumKam') is-invalid @enderror" id="jumKam"
                            name="jumKam" disable readonly required value="{{ old('jumKam', $edit->jumKam) }}"
                            @if ($edit->jumKam != $kamar->jumKam) style="background-color: yellow" @endif>
                    </div>

                    {{-- //Jumlah Kosog  --}}
                    <div class="mb-3">
                        <label for="jumKos" class="form-label fw-bold">Jumlah Kamar Kosong</label>
                        <input type="text" class="form-control @error('jumKos') is-invalid @enderror" id="jumKos"
                            name="jumKos" disable readonly required value="{{ old('jumKos', $edit->jumKos) }}"
                            @if ($edit->jumKos != $kamar->jumKos) style="background-color: yellow" @endif>
                    </div>


                    {{-- //durasi Dewa  --}}
                    <div class="mb-3">
                        <label for="durSewa" class="form-label fw-bold">Durasi Sewa (dalam bulan)</label>
                        <input type="text" class="form-control @error('durSewa') is-invalid @enderror" id="durSewa"
                            name="durSewa" disable readonly required value="{{ old('durSewa', $edit->durSewa) }}"
                            @if ($edit->durSewa != $kamar->durSewa) style="background-color: yellow" @endif>
                    </div>

                    {{-- //Fasilitas  --}}
                    <div class="mb-3">
                        <label for="fasilitasKamar" class="form-label fw-bold">Fasilitas Kamar</label>
                        <input type="textarea" class="form-control @error('fasilitasKamar') is-invalid @enderror"
                            id="fasilitasKamar" name="fasilitasKamar" disable readonly required
                            value="{{ old('fasilitasKamar', $edit->fasilitasKamar) }}"
                            @if ($edit->fasilitasKamar != $kamar->fasilitasKamar) style="background-color: yellow" @endif>
                    </div>


                    {{-- //deskripsi  --}}
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label fw-bold">Deskripsi kamar</label>
                        <div class="card">
                            <div class="card-body"
                                @if ($edit->deskripsiKamar == $kamar->deskripsiKamar) style="background-color: #E9ECEF"
                            @else
                                style="background-color: yellow" @endif>
                                {!! $edit->deskripsiKamar !!}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <div class="d-flex justify-content-evenly">
            <div class=" my-5">

                <h5>
                    <button class="btn btn-warning border-0" data-toggle="modal" data-target="#terima"><i
                            class="fas fa-check-circle"></i></span> Terima Pembaharuan Kamar</button>
                </h5>
            </div>

            <div class=" my-5">

                <h5>
                    <button class="btn btn-danger text-dark border-0" data-toggle="modal" data-target="#tolak"><i
                            class="fas fa-ban"></i> Tolak Pembaharuan Kamar</button>
                </h5>
            </div>

            <div class=" my-5">
                <a href="https://api.whatsapp.com/send?phone=62{{ $user->noHp }}&text=Selamat Pagi/Siang/Sore, benar dengan kak {{ $user->nama }}. Perkenalkan Saya Pengelola Web Kamaris ingin bertanya tentang data kamar {{ $kamar->nama }} yang sudah Kakak ajukan beberapa waktu yang lalu %0A%0A(Selanjutnya isi sendiri)"
                    target="_blank">
                    <h5>
                        <button class="btn btn-success text-dark border-0"><i class="fab fa-whatsapp"></i> Hubungi Pengaju
                            Data</button>
                    </h5>
                </a>
            </div>
            {{-- </div> --}}

        </div>

        <!-- Modal Terima -->
        <div class="modal fade" id="terima" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Tindakan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin <b>menerima</b> permintaan pembaharuan data kamar ini ?
                    </div>
                    <div class="modal-footer">
                        <form action="/dashboard/terimaPembaharuanKamar/{{ $kamar->id }}" method="post"
                            enctype="multipart/form-data" class="d-inline">
                            {{-- @method('post') --}}
                            @csrf
                            <button type="submit" class="btn btn-primary">Iya</button>
                        </form>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal Batal -->
        <div class="modal fade" id="tolak" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Tindakan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin <b>menolak</b> permintaan pembaharuan data kamar ini ?
                    </div>
                    <div class="modal-footer">
                        <form action="/dashboard/tolakPembaharuanKamar/{{ $kamar->id }}" method="post"
                            enctype="multipart/form-data" class="d-inline">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-primary">Iya</button>
                        </form>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="d-flex justify-content-evenly">
            <h5>
                <form action="/dashboard/terimaPembaharuanKamar/{{ $kamar->id }}" enctype="multipart/form-data" method="post" class="d-inline">
                    @csrf
                    <button class="badge bg-warning border-0" onclick="return confirm('Apakah Anda yakin menerima pembaharuan data kamar ini?')"><span data-feather="edit" ></span> Terima Pembaharuan Data Kamar</button>
                </form>
            </h5>

            <h5>
                <form action="/dashboard/tolakPembaharuanKamar/{{ $kamar->id }}" method="post" class="d-inline">
                    @method('delete')
                    @csrf
                    <button class="badge bg-danger border-0" onclick="return confirm('Apakah Anda yakin menolak pembaharuan data kamar ini?')"><span data-feather="x-circle" ></span> Tolak Pembaharuan Data Kamar</button>
                </form>
            </h5>
        </div> --}}

    </div>
    </div>
@endsection
