@extends('dashboard.layout.main')

@section('container')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container">
        {{-- <div class="row my-3"> --}}
        <div class="col-lg-12">
            <h2>Edit Pengajuan Penambahan Data Kost {{ $kost->nama }}</h2>

            <div class="mb-3">
                <a href="/dashboard/penambahan" class="btn btn-success"><i class="fas fa-chevron-circle-left"></i> Kembali</a>
            </div>


            {{-- <a href="/dashboard/kosts/{{ $post->slug }}/edit" class="btn btn-warning"><span data-feather="edit"></span> Edit</a>

        <form action="/dashboard/kosts/{{ $post->slug }}" method="post" class="d-inline"> --}}

            {{-- GA BISA UPDATE FOTO, YA MASA UPDATE FOTO KAN DIA BUKAN YANG NGISI --}}
            <form method="post" action="/dashboard/penambahanKost/update" class="mb-0" enctype="multipart/form-data">
                {{-- otomatis langsung ke method store (update ga sih ?) --}}
                @csrf

                <input type="hidden" name="kost_id" value="{{ $kost->id }}">
                <div class="mb-3">
                    @if ($kost->image)
                        <div style="max-height: 350px; overflow:hidden">
                            <img src="{{ asset('storage/' . $kost->image) }}" alt="{{ $kost->nama }}"
                                class="img-fluid mt-3">
                        </div>
                    @else
                        <div class="card align-items-center justify-content-center" style="height: 350px">
                            <h1 class="align-middle">Gambar tidak tersedia</h1>
                        </div>
                        {{-- <img src="/img/kosIlustrasi.png" alt="kost {{ $kost->nama }}" class="img-fluid mt-3"> --}}
                    @endif
                </div>


                {{-- //penambah  NANTI --}}
                {{-- <div class="mb-3">
                <label for="#" class="form-label fw-bold">Nama yang Mengajukan Penambahan Data</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="#" name="#" required
                        value="{{ $user->nama }}">
                </div>
            </div> --}}


                {{-- //nama  --}}
                <div class="mb-3">
                    <label for="nama" class="form-label fw-bold">Nama Kost</label>
                    <div class="input-group">
                        <div class="input-group-text">Kost</div>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                            name="nama" required value="{{ old('nama', $kost->nama) }}">
                    </div>
                </div>

                {{-- //area  --}}
                <div class="mb-3">
                    <label for="area" class="form-label">Area</label>
                    <select class="form-select" name="area">
                        <option value="Bonsay" <?php if (old('area', $kost->area) == 'Bonsay') {
                            echo 'selected';
                        } ?>>Bonsay</option>
                        <option value="Bonasut" <?php if (old('area', $kost->area) == 'Bonasut') {
                            echo 'selected';
                        } ?>>Bonasut</option>
                        <option value="Bonasel" <?php if (old('area', $kost->area) == 'Bonasel') {
                            echo 'selected';
                        } ?>>Bonasel</option>
                    </select>
                </div>


                {{-- //No Hp pemilik  --}}
                <div class="mb-3">
                    <label for="noHp" class="form-label fw-bold">Nomor HP pemilik</label>
                    <div class="input-group">
                        <div class="input-group-text">+62</div>
                        <input type="text" class="form-control @error('noHp') is-invalid @enderror" id="noHp"
                            name="noHp" required value="{{ old('noHp', $kost->noHp) }}">
                    </div>
                </div>


                {{-- //Gender  --}}
                <div class="mb-3">
                    <label for="gender" class="form-label">Gender</label>
                    <select class="form-select" name="gender">
                        <option value="Pria" <?php if (old('gender', $kost->gender) == 'Pria') {
                            echo 'selected';
                        } ?>>Pria</option>
                        <option value="Wanita" <?php if (old('gender', $kost->gender) == 'Wanita') {
                            echo 'selected';
                        } ?>>Wanita</option>
                        <option value="Campuran" <?php if (old('gender', $kost->gender) == 'Campuran') {
                            echo 'selected';
                        } ?>>Campuran</option>
                    </select>
                </div>

                {{-- //wifi  --}}
                <div class="mb-3">
                    <label for="wifi" class="form-label">Wifi</label>
                    <select class="form-select" name="wifi">
                        <option value="Ada" <?php if (old('wifi', $kost->wifi) == 'Ada') {
                            echo 'selected';
                        } ?>>Ada</option>
                        <option value="Belum Ada" <?php if (old('wifi', $kost->wifi) == 'Belum Ada') {
                            echo 'selected';
                        } ?>>Belum Ada</option>
                    </select>
                </div>

                {{-- //Tempat parkir  --}}
                <div class="mb-3">
                    <label for="parkir" class="form-label">Tempat parkir</label>
                    <select class="form-select" name="parkir">
                        <option value="Tersedia" <?php if (old('parkir', $kost->parkir) == 'Tersedia') {
                            echo 'selected';
                        } ?>>Tersedia</option>
                        <option value="Tidak Tersedia" <?php if (old('parkir', $kost->parkir) == 'Tidak Tersedia') {
                            echo 'selected';
                        } ?>>Tidak Tersedia</option>
                    </select>
                </div>

                {{-- //Fasilitas  --}}
                <div class="mb-3">
                    <label for="fasilitas" class="form-label fw-bold">Fasilitas Kost</label>
                    <input type="textarea" class="form-control @error('fasilitas') is-invalid @enderror" id="fasilitas"
                        name="fasilitas" required value="{{ old('fasilitas', $kost->fasilitas) }}">
                </div>

                {{-- Peta --}}
                <div class="mb-0">
                    <label for="#" class="form-label">Lokasi kost pada peta</label>

                    <div id="map" class="mb-3"></div>

                    <script>
                        //menampilkan map
                        var map = L.map('map').setView([{{ $kost->latitude }}, {{ $kost->longitude }}], 18);

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
                            draggable: 'true',
                        });

                        marker.on('dragend', function(event) {

                            var position = marker.getLatLng();
                            marker.setLatLng(position, {
                                draggable: 'true',
                            }).bindPopup(position).update();

                            var jarak = Math.round(map.distance([-6.231471797582685, 106.86668204054837], [position.lat, position
                                .lng
                            ]));

                            $("#latitude").val(position.lat);
                            $("#longitude").val(position.lng);
                            $("#jarak").val(jarak);


                        });
                        map.addLayer(marker);

                        // var bangunan = [a, b];

                        // let jarak = Math.round(map.distance(curLocation, bangunan));
                        // document.getElementById('jarak').innerHTML = jarak;

                        // $("#jarak").val(jarak);
                    </script>

                    {{-- //jarak  --}}
                    <div class="mb-3">
                        <label for="jarak" class="form-label fw-bold">Jarak (meter)</label>
                        <input type="textarea" class="form-control @error('jarak') is-invalid @enderror" id="jarak"
                            name="jarak" required value="{{ old('jarak', $kost->jarak) }}">
                    </div>

                    {{-- <div class="mb-3">
                <label for="#" class="form-label">Latitude</label> --}}
                    <input type="hidden" class="form-control" id="latitude" name="latitude" disable readonly required
                        autofocus value="{{ $kost->latitude }}">
                    {{-- </div> --}}

                    {{-- <div class="mb-3">
                  <label for="#" class="form-label">Longitude</label> --}}
                    <input type="hidden" class="form-control" id="longitude" name="longitude" disable readonly required
                        autofocus value="{{ $kost->longitude }}">
                    {{-- </div> --}}

                    {{--
    <div class="mb-3">
        <label for="#" class="form-label fw-bold">Latitude</label>
        <input type="text" class="form-control" id="latitude" name="latitude" required value="{{ old('latitude', $kost->latitude) }}">
    </div>

    <div class="mb-3">
        <label for="#" class="form-label fw-bold">Longitude</label>
        <input type="text" class="form-control" id="longitude" name="longitude" required value="{{ old('longitude', $kost->longitude) }}">
    </div> --}}


                    {{-- //deskripsi --}}
                    <div class="mb-4">
                        <label for="deskripsi" class="form-label">Deskripsi Kost</label>
                        @error('deskripsi')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <input id="deskripsi" type="hidden" name="deskripsi"
                            value="{{ old('deskripsi', $kost->deskripsi) }}">
                        <trix-editor input="deskripsi"></trix-editor>
                    </div>

                    <button type="submit" class="btn btn-primary mb-5">Simpan Data Hasil Perubahan</button>
            </form>


        </div>
    </div>
    </div>
    </div>


    <script>
        // const title = document.querySelector('#title');
        // const slug = document.querySelector('#slug');

        // title.addEventListener('change', function(){
        //   fetch('/dashboard/posts/checkSlug?title=' + title.value)
        //   .then((response) => response.json())
        //   .then((data) => slug.value = data.slug);
        // });


        // cara lain
        // title.addEventListener("keyup", function() {
        //     let preslug = title.value;
        //     preslug = preslug.replace(/ /g,"-");
        //     slug.value = preslug.toLowerCase();
        // });

        // hilangin fungsi fitur add attacment
        document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault();
        })

        function previewImage() {
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
