@extends('dashboard.layout.main')

@section('container')
    <div class="container">
        <div class="row my-0">
            <div class="col-lg-12">
                <h2>Data Kost {{ $kost->nama }}</h2>

                <a href="/dashboard/kosts" class="btn btn-success"><span data-feather="arrow-left"></span> Kembali</a>

                {{-- <a href="/dashboard/kosts/{{ $post->slug }}/edit" class="btn btn-warning"><span data-feather="edit" ></span> Edit</a>

            <form action="/dashboard/kosts/{{ $post->slug }}" method="post" class="d-inline"> --}}


                <div class="mb-3">
                    @if ($kost->image)
                        <div>
                            <img src="{{ asset('storage/' . $kost->image) }}" alt="{{ $kost->nama }}"
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
          <input type="text" class="form-control" id="#" disable readonly name="#" required value="Ini nama yang nambahin">
        </div>
      </div> --}}


                {{-- //nama  --}}
                <div class="mb-3">
                    <label for="nama" class="form-label fw-bold">Nama Kost</label>
                    <div class="input-group">
                        <div class="input-group-text">Kost</div>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                            disable readonly name="nama" required value="{{ old('nama', $kost->nama) }}">
                    </div>
                </div>

                {{-- //rt  --}}
                <div class="mb-3">
                    <label for="rt" class="form-label fw-bold">RT</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('rt') is-invalid @enderror" id="rt" disable
                            readonly name="rt" required value="{{ old('rt', $kost->rt) }}">
                    </div>
                </div>

                {{-- //rw  --}}
                <div class="mb-3">
                    <label for="rw" class="form-label fw-bold">RW</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('rw') is-invalid @enderror" id="rw" disable
                            readonly name="rw" required value="{{ old('rw', $kost->rw) }}">
                    </div>
                </div>

                {{-- //no  --}}
                <div class="mb-3">
                    <label for="no" class="form-label fw-bold">Nomor Rumah</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('no') is-invalid @enderror" id="no" disable
                            readonly name="no" required value="{{ old('no', $kost->no) }}">
                    </div>
                </div>

                {{-- //kelurahan  --}}
                <div class="mb-3">
                    <label for="kelurahan" class="form-label fw-bold">Kelurahan</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('kelurahan') is-invalid @enderror" id="kelurahan"
                            disable readonly name="kelurahan" required value="{{ old('kelurahan', $kost->kelurahan) }}">
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
                    <div class="input-group-text">+62</div>
                    <input type="text" class="form-control @error('noHp') is-invalid @enderror" id="noHp"
                        name="noHp" disable readonly required value="{{ old('noHp', $kost->noHp) }}">
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

                {{-- //Fasilitas  --}}
                <div class="mb-3">
                    <label for="fasilitas" class="form-label fw-bold">Fasilitas Kost</label>
                    <input type="textarea" class="form-control @error('fasilitas') is-invalid @enderror" id="fasilitas"
                        name="fasilitas" disable readonly required value="{{ old('fasilitas', $kost->fasilitas) }}">
                </div>

                {{-- Peta --}}
                <div class="mb-3">
                    <label for="#" class="form-label fw-bold">Lokasi kost pada peta</label>

                    <div id="map"></div>

                    <script>
                        //menampilkan map
                        var map = L.map('map').setView([{{ $kost->latitude }}, {{ $kost->longitude }}], 17);

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

                {{-- //jarak  --}}
                <div class="mb-3">
                    <label for="jarak" class="form-label fw-bold">Jarak (meter)</label>
                    <input type="textarea" class="form-control @error('jarak') is-invalid @enderror" id="jarak"
                        name="jarak" disable readonly required value="{{ old('jarak', $kost->jarak) }}">
                </div>

                {{--         
    <div class="mb-3">
        <label for="#" class="form-label fw-bold">Latitude</label>
        <input type="text" class="form-control" id="latitude" name="latitude" disable readonly required value="{{ old('latitude', $kost->latitude) }}">
    </div>

    <div class="mb-3">
        <label for="#" class="form-label fw-bold">Longitude</label>
        <input type="text" class="form-control" id="longitude" name="longitude" disable readonly required value="{{ old('longitude', $kost->longitude) }}">
    </div> --}}


                {{-- //deskripsi  --}}
                <div class="mb-3">
                    <label for="deskripsi" class="form-label fw-bold">Deskripsi Kost</label>
                    <div class="card">
                        <div class="card-body" style="background-color: #E9ECEF">
                            {!! $kost->deskripsi !!}
                        </div>
                    </div>
                </div>

                {{-- <button type="submit" class="btn btn-primary">Ajukan Pembaharuan Data</button> --}}
                </form>



            </div>
        </div>
    </div>
@endsection
