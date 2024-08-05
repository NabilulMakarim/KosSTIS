@extends('dashboard.layout.main')

@section('container')
    <div class="container">
        <div class="row my-0">
            <div class="col-lg-12">
                @if ($kost)
                    <h2>Data Kamar Tipe {{ $kamar->harga / 1000 }} Kost {{ $kost->nama }}</h2>
                @else
                    <h2>Data Kamar Tipe {{ $kamar->harga / 1000 }}</h2>
                @endif

                {{-- <a href="/dashboard/kamars" class="btn btn-success"><span data-feather="arrow-left"></span> Kembali</a> --}}

                {{-- <a href="/dashboard/kosts/{{ $post->slug }}/edit" class="btn btn-warning"><span data-feather="edit" ></span> Edit</a>

            <form action="/dashboard/kosts/{{ $post->slug }}" method="post" class="d-inline"> --}}


                <div class="mb-3">
                    @if ($kamar->imageKamar)
                        <div>
                            <img src="{{ asset('storage/' . $kamar->imageKamar) }}" alt="{{ $kamar->nama }}"
                                style="max-width: 100%; height: 350px;" class="rounded mx-auto d-block">
                        </div>
                    @else
                        <div class="card align-items-center justify-content-center" style="height: 350px">
                            <h1 class="align-middle">Gambar tidak tersedia</h1>
                        </div>
                    @endif
                </div>


                {{-- //penambah  NANTI --}}
                {{-- <div class="mb-3">
                    <label for="#" class="form-label fw-bold">Nama yang Mengajukan Penambahan Data</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="#" disable readonly name="#" required
                            value="Ini nama yang nambahin">
                    </div>
                </div> --}}


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
                    <label for="ukuran" class="form-label fw-bold">Ukuran Kamar (misal 3x3)</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('ukuran') is-invalid @enderror" id="ukuran"
                            name="ukuran" disable readonly required value="{{ old('ukuran', $kamar->ukuran) }}">
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
                    <label for="fasilitasKamar" class="form-label fw-bold">fasilitas Kamar</label>
                    <input type="textarea" class="form-control @error('fasilitasKamar') is-invalid @enderror"
                        id="fasilitasKamar" name="fasilitasKamar" disable readonly required
                        value="{{ old('fasilitasKamar', $kamar->fasilitasKamar) }}">
                </div>


                {{-- //deskripsi  --}}
                <div class="mb-3">
                    <label for="deskripsiKamar" class="form-label fw-bold">Deskripsi kamar</label>
                    <div class="card">
                        <div class="card-body" style="background-color: #E9ECEF">
                            {!! $kamar->deskripsiKamar !!}
                        </div>
                    </div>
                </div>

                {{-- <button type="submit" class="btn btn-primary">Ajukan Pembaharuan Data</button> --}}
                </form>

            </div>
        </div>
    </div>
@endsection
