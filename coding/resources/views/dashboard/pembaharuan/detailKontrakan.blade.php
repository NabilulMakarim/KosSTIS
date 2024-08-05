@extends('dashboard.layout.main')

@section('container')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Pengajuan Pembaharuan Data Kontrakan {{ $kontrakan->nama }}</h2>
                <h6>Oleh : {{ $user->nama }}, {{ $user->nim }}</h6>

                <a href="/dashboard/pembaharuan" class="btn btn-success mb-3"><i class="fas fa-chevron-circle-left"></i>
                    Kembali</a>


                {{-- <a href="/dashboard/kontrakans/{{ $post->slug }}/edit" class="btn btn-warning"><span data-feather="edit" ></span> Edit</a>

            <form action="/dashboard/kontrakans/{{ $post->slug }}" method="post" class="d-inline"> --}}


            </div>
        </div>
    </div>


    <div class="row">

        <div class="col-md-6 mb-3">
            <div class="card">
                <h5 class="card-header">Data Lama</h5>
                <div class="card-body">
                    <div class="mb-3">
                        @if ($kontrakan->image)
                            <div>
                                <img src="{{ asset('storage/' . $kontrakan->image) }}" alt="{{ $kontrakan->nama }}"
                                    style="max-width: 100%; height: 350px;" class="rounded mx-auto d-block mt-3">
                            </div>
                        @else
                            <div class="card align-items-center justify-content-center mt-3" style="height: 350px">
                                <h1 class="align-middle">Gambar tidak tersedia</h1>
                            </div>
                        @endif
                    </div>

                    {{-- //nama  --}}
                    <div class="mb-3">
                        <label for="nama" class="form-label fw-bold">Nama Kontrakan</label>
                        <div class="input-group">
                            <div class="input-group-text">Kontrakan</div>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                disable readonly name="nama" required value="{{ old('nama', $kontrakan->nama) }}">
                        </div>
                    </div>

                    {{-- //No Hp pemilik  --}}
                    <div class="mb-3">
                        <label for="noHp" class="form-label fw-bold">Nomor HP pemilik</label>
                        <div class="input-group">
                            <div class="input-group-text">+62</div>
                            <input type="text" class="form-control @error('noHp') is-invalid @enderror" id="noHp"
                                name="noHp" disable readonly required value="{{ old('noHp', $kontrakan->noHp) }}">
                        </div>
                    </div>

                    {{-- //harga  --}}
                    <div class="mb-3">
                        <label for="harga" class="form-label fw-bold">Harga perbulan (misal: 800000)</label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('harga') is-invalid @enderror" id="harga"
                                name="harga" disable readonly required value="{{ old('harga', $kontrakan->harga) }}">
                            <div class="input-group-text">/bulan</div>
                        </div>
                    </div>

                    {{-- //Jumlah Kamar  --}}
                    <div class="mb-3">
                        <label for="jumKam" class="form-label fw-bold">Jumlah Kamar</label>
                        <input type="text" class="form-control @error('jumKam') is-invalid @enderror" id="jumKam"
                            name="jumKam" disable readonly required value="{{ old('jumKam', $kontrakan->jumKam) }}">
                    </div>


                    {{-- //durasi Dewa  --}}
                    <div class="mb-3">
                        <label for="durSewa" class="form-label fw-bold">Durasi Sewa (dalam bulan)</label>
                        <input type="text" class="form-control @error('durSewa') is-invalid @enderror" id="durSewa"
                            name="durSewa" disable readonly required value="{{ old('durSewa', $kontrakan->durSewa) }}">
                    </div>

                    {{-- //wifi  --}}
                    <div class="mb-3">
                        <label for="wifi" class="form-label fw-bold">Wifi</label>
                        <input type="textarea" class="form-control @error('wifi') is-invalid @enderror" id="wifi"
                            name="wifi" disable readonly required value="{{ old('wifi', $kontrakan->wifi) }}">
                    </div>

                    {{-- //parkir  --}}
                    <div class="mb-3">
                        <label for="parkir" class="form-label fw-bold">Tempat parkir</label>
                        <input type="textarea" class="form-control @error('parkir') is-invalid @enderror" id="parkir"
                            name="parkir" disable readonly required value="{{ old('parkir', $kontrakan->parkir) }}">
                    </div>

                    {{-- //jarak  --}}
                    <div class="mb-3">
                        <label for="jarak" class="form-label fw-bold">Jarak (meter)</label>
                        <input type="textarea" class="form-control @error('jarak') is-invalid @enderror" id="jarak"
                            name="jarak" disable readonly required value="{{ old('jarak', $kontrakan->jarak) }}">
                    </div>

                    {{-- //Fasilitas  --}}
                    <div class="mb-3">
                        <label for="fasilitas" class="form-label fw-bold">Fasilitas kontrakan</label>
                        <input type="textarea" class="form-control @error('fasilitas') is-invalid @enderror" id="fasilitas"
                            name="fasilitas" disable readonly required
                            value="{{ old('fasilitas', $kontrakan->fasilitas) }}">
                    </div>

                    {{-- //Listrik  --}}
                    <div class="mb-3">
                        <label for="listrik" class="form-label fw-bold">Listrik kontrakan</label>
                        <input type="textarea" class="form-control @error('listrik') is-invalid @enderror" id="listrik"
                            name="listrik" disable readonly required value="{{ old('listrik', $kontrakan->listrik) }}">
                    </div>

                    {{-- //status  --}}
                    <div class="mb-3">
                        <label for="status" class="form-label fw-bold">Status kontrakan</label>
                        <input type="textarea" class="form-control @error('status') is-invalid @enderror" id="status"
                            name="status" disable readonly required
                            @if ($kontrakan->status == 0) value="Sudah Terisi"
                        @else
                            value="Tersedia" @endif>
                    </div>

                    {{-- Peta --}}
                    <div class="mb-3">
                        <label for="#" class="form-label fw-bold">Lokasi kontrakan pada peta</label>

                        <div id="map"></div>

                        <script>
                            //menampilkan map
                            var map = L.map('map').setView([{{ $kontrakan->latitude }}, {{ $kontrakan->longitude }}], 18);

                            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                maxZoom: 19,
                                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                            }).addTo(map);

                            //get coordinat location
                            var latInput = document.querySelector("[name=latitude]");
                            var lngInput = document.querySelector("[name=longitude]");

                            var curLocation = [{{ $kontrakan->latitude }}, {{ $kontrakan->longitude }}];

                            map.attributionControl.setPrefix(false);

                            var marker = new L.marker(curLocation, {
                                draggable: 0,
                            });

                            map.addLayer(marker);
                        </script>
                    </div>


                    <div class="mb-3">
                        <label for="#" class="form-label fw-bold">Latitude</label>
                        <input type="text" class="form-control" id="latitude" name="latitude" disable readonly
                            required value="{{ old('latitude', $kontrakan->latitude) }}">
                    </div>

                    <div class="mb-3">
                        <label for="#" class="form-label fw-bold">Longitude</label>
                        <input type="text" class="form-control" id="longitude" name="longitude" disable readonly
                            required value="{{ old('longitude', $kontrakan->longitude) }}">
                    </div>


                    {{-- //deskripsi  --}}
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label fw-bold">Deskripsi kontrakan</label>
                        <div class="card">
                            <div class="card-body" style="background-color: #E9ECEF">
                                {!! $kontrakan->deskripsi !!}
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
                        @if ($edit->image)
                            <div>
                                <img src="{{ asset('storage/' . $edit->image) }}" alt="{{ $edit->nama }}"
                                    style="max-width: 100%; height: 350px;" class="rounded mx-auto d-block mt-3">
                            </div>
                            <input class="form-control @error('image') is-invalid @enderror" type="hidden"
                                id="image" name="image" disable readonly required value="{{ $edit->image }}">
                        @else
                            @if ($kontrakan->image)
                                <div>
                                    <img src="{{ asset('storage/' . $kontrakan->image) }}" alt="{{ $kontrakan->nama }}"
                                        style="max-width: 100%; height: 350px;" class="rounded mx-auto d-block mt-3">
                                </div>
                            @else
                                <div class="card align-items-center justify-content-center mt-3" style="height: 350px">
                                    <h1 class="align-middle">Gambar tidak tersedia</h1>
                                </div>
                            @endif

                            <input class="form-control @error('image') is-invalid @enderror" type="hidden"
                                id="image" name="image" disable readonly required value="{{ $kontrakan->image }}">
                        @endif
                    </div>

                    {{-- //nama  --}}
                    <div class="mb-3">
                        <label for="nama" class="form-label fw-bold">Nama Kontrakan</label>
                        <div class="input-group">
                            <div class="input-group-text">Kontrakan</div>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                id="nama" disable readonly name="nama" required value="{{ $edit->nama }}"
                                @if ($edit->nama != $kontrakan->nama) style="background-color: yellow" @endif>
                        </div>
                    </div>

                    {{-- //No Hp pemilik  --}}
                    <div class="mb-3">
                        <label for="noHp" class="form-label fw-bold">Nomor HP pemilik</label>
                        <div class="input-group">
                            <div class="input-group-text">+62</div>
                            <input type="text" class="form-control @error('noHp') is-invalid @enderror"
                                id="noHp" name="noHp" disable readonly required
                                value="{{ old('noHp', $edit->noHp) }}"
                                @if ($edit->noHp != $kontrakan->noHp) style="background-color: yellow" @endif>
                        </div>

                    </div>

                    {{-- //harga  --}}
                    <div class="mb-3">
                        <label for="harga" class="form-label fw-bold">Harga perbulan (misal: 800000)</label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('harga') is-invalid @enderror"
                                id="harga" name="harga" disable readonly required
                                value="{{ old('harga', $edit->harga) }}"
                                @if ($edit->harga != $kontrakan->harga) style="background-color: yellow" @endif>
                            <div class="input-group-text">/bulan</div>
                        </div>
                    </div>

                    {{-- //Jumlah Kamar  --}}
                    <div class="mb-3">
                        <label for="jumKam" class="form-label fw-bold">Jumlah Kamar</label>
                        <input type="text" class="form-control @error('jumKam') is-invalid @enderror" id="jumKam"
                            name="jumKam" disable readonly required value="{{ old('jumKam', $edit->jumKam) }}"
                            @if ($edit->jumKam != $kontrakan->jumKam) style="background-color: yellow" @endif>
                    </div>


                    {{-- //durasi Dewa  --}}
                    <div class="mb-3">
                        <label for="durSewa" class="form-label fw-bold">Durasi Sewa (dalam bulan)</label>
                        <input type="text" class="form-control @error('durSewa') is-invalid @enderror" id="durSewa"
                            name="durSewa" disable readonly required value="{{ old('durSewa', $edit->durSewa) }}"
                            @if ($edit->durSewa != $kontrakan->durSewa) style="background-color: yellow" @endif>
                    </div>

                    {{-- //wifi  --}}
                    <div class="mb-3">
                        <label for="wifi" class="form-label fw-bold">Wifi</label>
                        <input type="textarea" class="form-control @error('wifi') is-invalid @enderror" id="wifi"
                            name="wifi" disable readonly required value="{{ old('wifi', $edit->wifi) }}"
                            @if ($edit->wifi != $kontrakan->wifi) style="background-color: yellow" @endif>
                    </div>

                    {{-- //parkir  --}}
                    <div class="mb-3">
                        <label for="parkir" class="form-label fw-bold">Tempat parkir</label>
                        <input type="textarea" class="form-control @error('parkir') is-invalid @enderror" id="parkir"
                            name="parkir" disable readonly required value="{{ old('parkir', $edit->parkir) }}"
                            @if ($edit->parkir != $kontrakan->parkir) style="background-color: yellow" @endif>
                    </div>

                    {{-- //jarak  --}}
                    <div class="mb-3">
                        <label for="jarak" class="form-label fw-bold">Jarak (meter)</label>
                        <input type="textarea" class="form-control @error('jarak') is-invalid @enderror" id="jarak"
                            name="jarak" disable readonly required value="{{ old('jarak', $edit->jarak) }}"
                            @if ($edit->jarak != $kontrakan->jarak) style="background-color: yellow" @endif>
                    </div>

                    {{-- //Fasilitas  --}}
                    <div class="mb-3">
                        <label for="fasilitas" class="form-label fw-bold">Fasilitas kontrakan</label>
                        <input type="textarea" class="form-control @error('fasilitas') is-invalid @enderror"
                            id="fasilitas" name="fasilitas" disable readonly required
                            value="{{ old('fasilitas', $edit->fasilitas) }}"
                            @if ($edit->fasilitas != $kontrakan->fasilitas) style="background-color: yellow" @endif>
                    </div>

                    {{-- //Listrik  --}}
                    <div class="mb-3">
                        <label for="listrik" class="form-label fw-bold">Listrik kontrakan</label>
                        <input type="textarea" class="form-control @error('listrik') is-invalid @enderror"
                            id="listrik" name="listrik" disable readonly required
                            value="{{ old('listrik', $edit->listrik) }}"
                            @if ($edit->listrik != $kontrakan->listrik) style="background-color: yellow" @endif>
                    </div>

                    {{-- //status  --}}
                    <div class="mb-3">
                        <label for="status" class="form-label fw-bold">Status kontrakan</label>
                        <input type="textarea" class="form-control @error('status') is-invalid @enderror" id="status"
                            name="status" disable readonly required
                            @if ($edit->status == 0) value="Sudah Terisi"
                        @else
                            value="Tersedia" @endif
                            @if ($edit->status != $kontrakan->status) style="background-color: yellow" @endif>
                    </div>

                    {{-- Peta --}}
                    <div class="mb-3">
                        <label for="#" class="form-label fw-bold">Lokasi kontrakan pada peta</label>

                        <div id="map2"></div>

                        <script>
                            //menampilkan map
                            var map = L.map('map2').setView([{{ $edit->latitude }}, {{ $edit->longitude }}], 18);

                            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                maxZoom: 19,
                                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                            }).addTo(map);

                            //get coordinat location
                            var latInput = document.querySelector("[name=latitude]");
                            var lngInput = document.querySelector("[name=longitude]");

                            var curLocation = [{{ $edit->latitude }}, {{ $edit->longitude }}];

                            map.attributionControl.setPrefix(false);

                            var marker = new L.marker(curLocation, {
                                draggable: 0,
                            });

                            map.addLayer(marker);
                        </script>
                    </div>


                    <div class="mb-3">
                        <label for="#" class="form-label fw-bold">Latitude</label>
                        <input type="text" class="form-control" id="latitude" name="latitude" disable readonly
                            required value="{{ old('latitude', $edit->latitude) }}"
                            @if ($edit->latitude != $kontrakan->latitude) style="background-color: yellow" @endif>
                    </div>

                    <div class="mb-3">
                        <label for="#" class="form-label fw-bold">Longitude</label>
                        <input type="text" class="form-control" id="longitude" name="longitude" disable readonly
                            required value="{{ old('longitude', $edit->longitude) }}"
                            @if ($edit->longitude != $kontrakan->longitude) style="background-color: yellow" @endif>
                    </div>


                    {{-- //deskripsi  --}}
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label fw-bold">Deskripsi kontrakan</label>
                        <div class="card">
                            <div class="card-body"
                                @if ($edit->deskripsi == $kontrakan->deskripsi) style="background-color: #E9ECEF"
                            @else
                                style="background-color: yellow" @endif>
                                {!! $edit->deskripsi !!}
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
                            class="fas fa-check-circle"></i></span> Terima Pembaharuan Kontrakan</button>
                </h5>
            </div>

            <div class=" my-5">
                <h5>
                    <button class="btn btn-danger text-dark border-0" data-toggle="modal" data-target="#tolak"><i
                            class="fas fa-ban"></i> Tolak Pembaharuan Kontrakan</button>
                </h5>
            </div>

            <div class=" my-5">
                <a href="https://api.whatsapp.com/send?phone=62{{ $user->noHp }}&text=Selamat Pagi/Siang/Sore, benar dengan kak {{ $user->nama }}. Perkenalkan Saya Pengelola Web Kontrakanis ingin bertanya tentang data kontrakan {{ $kontrakan->nama }} yang sudah Kakak ajukan beberapa waktu yang lalu %0A%0A(Selanjutnya isi sendiri)"
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
                        Apakah Anda yakin <b>menerima</b> permintaan pembaharuan data kontrakan ini ?
                    </div>
                    <div class="modal-footer">
                        <form action="/dashboard/terimaPembaharuanKontrakan/{{ $kontrakan->id }}" method="post"
                            class="d-inline">
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
                        Apakah Anda yakin <b>menolak</b> permintaan pembaharuan data kontrakan ini ?
                    </div>
                    <div class="modal-footer">
                        <form action="/dashboard/tolakPembaharuanKontrakan/{{ $kontrakan->id }}" method="post"
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
                <form action="/dashboard/terimaPembaharuanKontrakan/{{ $kontrakan->id }}" enctype="multipart/form-data" method="post" class="d-inline">
                    @csrf
                    <button class="badge bg-warning border-0" onclick="return confirm('Apakah Anda yakin menerima pembaharuan data kontrakan ini?')"><span data-feather="edit" ></span> Terima Pembaharuan Data Kontrakan</button>
                </form>
            </h5>

            <h5>
                <form action="/dashboard/tolakPembaharuanKontrakan/{{ $kontrakan->id }}" method="post" class="d-inline">
                    @method('delete')
                    @csrf
                    <button class="badge bg-danger border-0" onclick="return confirm('Apakah Anda yakin menolak pembaharuan data kontrakan ini?')"><span data-feather="x-circle" ></span> Tolak Pembaharuan Data Kontrakan</button>
                </form>
            </h5>
        </div> --}}

    </div>
@endsection
