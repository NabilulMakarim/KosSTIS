@extends('dashboard.layout.main')

@section('container')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Pengajuan Pembaharuan Data Kost {{ $kost->nama }}</h2>
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
                        @if ($kost->image)
                            <div>
                                <img src="{{ asset('storage/' . $kost->image) }}" alt="{{ $kost->nama }}"
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
                        <label for="nama" class="form-label fw-bold">Nama Kost</label>
                        <div class="input-group">
                            <div class="input-group-text">Kost</div>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                disable readonly name="nama" required value="{{ old('nama', $kost->nama) }}">
                        </div>
                    </div>


                    {{-- //area  --}}
                    <div class="mb-3">
                        <label for="area" class="form-label fw-bold">Area</label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('area') is-invalid @enderror" id="area"
                                disable readonly name="area" required value="{{ old('area', $kost->area) }}">
                        </div>
                    </div>


                    {{-- //No Hp pemilik  --}}
                    <div class="mb-3">
                        <label for="noHp" class="form-label fw-bold">Nomor HP pemilik</label>
                        <div class="input-group">
                            <div class="input-group-text">+62</div>
                            <input type="text" class="form-control @error('noHp') is-invalid @enderror" id="noHp"
                                name="noHp" disable readonly required value="{{ old('noHp', $kost->noHp) }}">
                        </div>
                    </div>


                    {{-- //gender  --}}
                    <div class="mb-3">
                        <label for="gender" class="form-label fw-bold">Gender Penghuni Kost</label>
                        <input type="text" class="form-control" id="gender" name="gender" disable readonly required
                            value="{{ $kost->gender }}">
                    </div>

                    {{-- //wifi  --}}
                    <div class="mb-3">
                        <label for="wifi" class="form-label fw-bold">Wifi</label>
                        <input type="textarea" class="form-control @error('wifi') is-invalid @enderror" id="wifi"
                            name="wifi" disable readonly required value="{{ old('wifi', $kost->wifi) }}">
                    </div>

                    {{-- //parkir  --}}
                    <div class="mb-3">
                        <label for="parkir" class="form-label fw-bold">Tempat parkir</label>
                        <input type="textarea" class="form-control @error('parkir') is-invalid @enderror" id="parkir"
                            name="parkir" disable readonly required value="{{ old('parkir', $kost->parkir) }}">
                    </div>

                    {{-- //jarak  --}}
                    <div class="mb-3">
                        <label for="jarak" class="form-label fw-bold">Jarak (meter)</label>
                        <input type="textarea" class="form-control @error('jarak') is-invalid @enderror" id="jarak"
                            name="jarak" disable readonly required value="{{ old('jarak', $kost->jarak) }}">
                    </div>

                    {{-- //Fasilitas  --}}
                    <div class="mb-3">
                        <label for="fasilitas" class="form-label fw-bold">Fasilitas Kost</label>
                        <input type="textarea" class="form-control @error('fasilitas') is-invalid @enderror" id="fasilitas"
                            name="fasilitas" disable readonly required value="{{ old('fasilitas', $kost->fasilitas) }}">
                    </div>

                    {{-- Peta --}}
                    <div class="mb-3">
                        <label for="#" class="form-label fw-bold">Lokasi kost pada peta</label>

                        <div id="map2"></div>

                        <script>
                            //menampilkan map
                            var map = L.map('map2').setView([{{ $kost->latitude }}, {{ $kost->longitude }}], 17);

                            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                maxZoom: 19,
                                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                            }).addTo(map);

                            //get coordinat location
                            var latInput = document.querySelector("[name=latitude]");
                            var lngInput = document.querySelector("[name=longitude]");

                            var curLocation = [{{ $kost->latitude }}, {{ $kost->longitude }}];

                            map.attributionControl.setPrefix(false);

                            var marker = new L.marker(curLocation, {
                                draggable: 0,
                            });

                            map.addLayer(marker);
                        </script>
                    </div>


                    <div class="mb-3">
                        <label for="#" class="form-label fw-bold">Latitude</label>
                        <input type="text" class="form-control" id="latitude" name="latitude" disable readonly required
                            value="{{ old('latitude', $kost->latitude) }}">
                    </div>

                    <div class="mb-3">
                        <label for="#" class="form-label fw-bold">Longitude</label>
                        <input type="text" class="form-control" id="longitude" name="longitude" disable readonly
                            required value="{{ old('longitude', $kost->longitude) }}">
                    </div>


                    {{-- //deskripsi  --}}
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label fw-bold">Deskripsi Kost</label>
                        <div class="card">
                            <div class="card-body" style="background-color: #E9ECEF">
                                {!! $kost->deskripsi !!}
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
                            @if ($kost->image)
                                <div>
                                    <img src="{{ asset('storage/' . $kost->image) }}" alt="{{ $kost->nama }}"
                                        style="max-width: 100%; height: 350px;" class="rounded mx-auto d-block mt-3">
                                </div>
                            @else
                                <div class="card align-items-center justify-content-center mt-3" style="height: 350px">
                                    <h1 class="align-middle">Gambar tidak tersedia</h1>
                                </div>
                            @endif

                            <input class="form-control @error('image') is-invalid @enderror" type="hidden"
                                id="image" name="image" disable readonly required value="{{ $kost->image }}">
                        @endif
                    </div>


                    {{-- //nama  --}}
                    <div class="mb-3">
                        <label for="nama" class="form-label fw-bold">Nama Kost</label>
                        <div class="input-group">
                            <div class="input-group-text">Kost</div>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                disable readonly name="nama" required value="{{ old('nama', $edit->nama) }}"
                                @if ($edit->nama != $kost->nama) style="background-color: yellow" @endif>
                        </div>
                    </div>


                    {{-- //area  --}}
                    <div class="mb-3">
                        <label for="area" class="form-label fw-bold">Area</label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('area') is-invalid @enderror"
                                id="area" disable readonly name="area" required
                                value="{{ old('area', $edit->area) }}"
                                @if ($edit->area != $kost->area) style="background-color: yellow" @endif>
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
                                @if ($edit->noHp != $kost->noHp) style="background-color: yellow" @endif>
                        </div>
                    </div>


                    {{-- //gender  --}}
                    <div class="mb-3">
                        <label for="gender" class="form-label fw-bold">Gender Penghuni Kost</label>
                        <input type="text" class="form-control" id="gender" name="gender" disable readonly
                            required value="{{ $edit->gender }}"
                            @if ($edit->gender != $kost->gender) style="background-color: yellow" @endif>
                    </div>

                    {{-- //wifi  --}}
                    <div class="mb-3">
                        <label for="wifi" class="form-label fw-bold">Wifi</label>
                        <input type="textarea" class="form-control @error('wifi') is-invalid @enderror" id="wifi"
                            name="wifi" disable readonly required value="{{ old('wifi', $edit->wifi) }}"
                            @if ($edit->wifi != $kost->wifi) style="background-color: yellow" @endif>
                    </div>

                    {{-- //parkir  --}}
                    <div class="mb-3">
                        <label for="parkir" class="form-label fw-bold">Tempat parkir</label>
                        <input type="textarea" class="form-control @error('parkir') is-invalid @enderror" id="parkir"
                            name="parkir" disable readonly required value="{{ old('parkir', $edit->parkir) }}"
                            @if ($edit->parkir != $kost->parkir) style="background-color: yellow" @endif>
                    </div>

                    {{-- //jarak  --}}
                    <div class="mb-3">
                        <label for="jarak" class="form-label fw-bold">Jarak (meter)</label>
                        <input type="textarea" class="form-control @error('jarak') is-invalid @enderror" id="jarak"
                            name="jarak" disable readonly required value="{{ old('jarak', $edit->jarak) }}"
                            @if ($edit->jarak != $kost->jarak) style="background-color: yellow" @endif>
                    </div>

                    {{-- //Fasilitas  --}}
                    <div class="mb-3">
                        <label for="fasilitas" class="form-label fw-bold">Fasilitas Kost</label>
                        <input type="textarea" class="form-control @error('fasilitas') is-invalid @enderror"
                            id="fasilitas" name="fasilitas" disable readonly required
                            value="{{ old('fasilitas', $edit->fasilitas) }}"
                            @if ($edit->fasilitas != $kost->fasilitas) style="background-color: yellow" @endif>
                    </div>

                    {{-- Peta --}}
                    <div class="mb-3">
                        <label for="#" class="form-label fw-bold">Lokasi edit pada peta</label>

                        <div id="map"></div>

                        <script>
                            //menampilkan map
                            var map = L.map('map').setView([{{ $edit->latitude }}, {{ $edit->longitude }}], 17);

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
                            @if ($edit->latitude != $kost->latitude) style="background-color: yellow" @endif>
                    </div>

                    <div class="mb-3">
                        <label for="#" class="form-label fw-bold">Longitude</label>
                        <input type="text" class="form-control" id="longitude" name="longitude" disable readonly
                            required value="{{ old('longitude', $edit->longitude) }}"
                            @if ($edit->longitude != $kost->longitude) style="background-color: yellow" @endif>
                    </div>

                    {{-- //deskripsi  --}}
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label fw-bold">Deskripsi kost</label>
                        <div class="card">
                            <div class="card-body"
                                @if ($edit->deskripsi == $kost->deskripsi) style="background-color: #E9ECEF"
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
                            class="fas fa-check-circle"></i></span> Terima Pembaharuan Kost</button>
                </h5>

            </div>

            <div class=" my-5">

                <h5>
                    <button class="btn btn-danger text-dark border-0" data-toggle="modal" data-target="#tolak"><i
                            class="fas fa-ban"></i> Tolak Pembaharuan Kost</button>
                </h5>

            </div>

            <div class=" my-5">
                <a href="https://api.whatsapp.com/send?phone=62{{ $user->noHp }}&text=Selamat Pagi/Siang/Sore, benar dengan kak {{ $user->nama }}. Perkenalkan Saya Pengelola Web KoStis ingin bertanya tentang data kost {{ $kost->nama }} yang sudah Kakak ajukan beberapa waktu yang lalu %0A%0A(Selanjutnya isi sendiri)"
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
                        Apakah Anda yakin <b>menerima</b> permintaan pembaharuan data kost ini ?
                    </div>
                    <div class="modal-footer">
                        <form action="/dashboard/terimaPembaharuanKost/{{ $kost->id }}" method="post"
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
                        Apakah Anda yakin <b>menolak</b> permintaan pembaharuan data kost ini ?
                    </div>
                    <div class="modal-footer">
                        <form action="/dashboard/tolakPembaharuanKost/{{ $kost->id }}" method="post"
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
                <form action="/dashboard/terimaPembaharuanKost/{{ $kost->id }}" enctype="multipart/form-data" method="post" class="d-inline">
                    @csrf
                    <button class="badge bg-warning border-0" onclick="return confirm('Apakah Anda yakin menerima pembaharuan data kost ini?')"><span data-feather="edit" ></span> Terima Pembaharuan Data Kost</button>
                </form>
            </h5>

            <h5>
                <form action="/dashboard/tolakPembaharuanKost/{{ $kost->id }}" method="post" class="d-inline">
                    @method('delete')
                    @csrf
                    <button class="badge bg-danger border-0" onclick="return confirm('Apakah Anda yakin menolak pembaharuan data kost ini?')"><span data-feather="x-circle" ></span> Tolak Pembaharuan Data Kost</button>
                </form>
            </h5>
        </div> --}}

    </div>
@endsection
