@extends('dashboard.layout.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Mengedit Data Kost</h1>
    </div>

    <a href="/dashboard/kosts" class="btn btn-success"><span data-feather="arrow-left"></span> Kembali</a>


    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="col-lg-8">
        <form method="post" action="/dashboard/kosts/update/{{ $kost->id }}" class="mb-0" enctype="multipart/form-data">
            {{-- otomatis langsung ke method store (update ga sih ?) --}}
            @csrf

            <input type="hidden" name="kost_id" value="{{ $kost->id }}">

            {{-- nama  --}}
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Kost</label>
                <div class="input-group">
                    <div class="input-group-text">Kost</div>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                        name="nama" required autofocus value="{{ old('nama', $kost->nama) }}">
                </div>
                @error('nama')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- //area  --}}
            <div class="mb-3">
                <label for="area" class="form-label">Area</label>
                <select class="form-select" name="area">
                    {{-- @foreach ($categories as $category)
                @if (old('category_id') == $category->id)
                  <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                @else
                  <option value="{{ $category->id }}">{{ $category->name }}</option>             
              @endif
              @endforeach --}}
                    {{-- <option selected></option> --}}
                    <option value="Bonsay" <?php if (old('area', $kost->area) == 'Bonsay') {
                        echo 'selected';
                    } ?>>Bonsay</option>
                    <option value="Bonasut" <?php if (old('area', $kost->area) == 'Bonasut') {
                        echo 'selected';
                    } ?>>Bonasut</option>
                    <option value="Bonasel" <?php if (old('area', $kost->area) == 'Bonasel') {
                        echo 'selected';
                    } ?>>Bonasel</option>
                    <option value="Bobobo" <?php if (old('area', $kost->area) == 'Bobobo') {
                        echo 'selected';
                    } ?>>Lainnya</option>
                </select>
            </div>

            {{-- //kelurahan  --}}
            <div class="mb-3">
                <label for="kelurahan" class="form-label">Kelurahan</label>
                <select class="form-select" name="kelurahan">
                    <option value="Bidara Cina" <?php if (old('kelurahan', $kost->kelurahan) == 'Bidara Cina') {
                        echo 'selected';
                    } ?>>Bidara Cina</option>
                    <option value="Cipinang Cempedak" <?php if (old('kelurahan', $kost->kelurahan) == 'Cipinang Cempedak') {
                        echo 'selected';
                    } ?>>Cipinang Cempedak</option>
                    <option value="Balimester" <?php if (old('kelurahan', $kost->kelurahan) == 'Balimester') {
                        echo 'selected';
                    } ?>>Balimester</option>
                </select>
            </div>


            {{-- //rt  --}}
            <div class="mb-3">
                <label for="rt" class="form-label">RT <small style="color: red">(isikan tanpa 0 di
                        depan)</small></label>
                <input type="text" class="form-control @error('rt') is-invalid @enderror" id="rt" name="rt"
                    required autofocus value="{{ old('rt', $kost->rt) }}">
                @error('rt')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- //rw  --}}
            <div class="mb-3">
                <label for="rw" class="form-label">RW <small style="color: red">(isikan tanpa 0 di
                        depan)</small></label>
                <input type="text" class="form-control @error('rw') is-invalid @enderror" id="rw" name="rw"
                    required autofocus value="{{ old('rw', $kost->rw) }}">
                @error('rw')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- //Nomor rumah  --}}
            <div class="mb-3">
                <label for="no" class="form-label">No. <small style="color: red">(isikan tanpa 0 di
                        depan)</small></label>
                <input type="text" class="form-control @error('no') is-invalid @enderror" id="no" name="no"
                    required autofocus value="{{ old('no', $kost->no) }}">
                @error('no')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- //No Hp pemilik  --}}
            <div class="mb-3">
                <label for="noHp" class="form-label">Nomor HP pemilik kost</label>
                <div class="input-group">
                    <div class="input-group-text">+62</div>
                    <input type="text" class="form-control @error('noHp') is-invalid @enderror" id="noHp"
                        name="noHp" required autofocus value="{{ old('noHp', $kost->noHp) }}">
                </div>
                @error('noHp')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
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

            {{-- //Dapur : Sementara pakai variabel ringkasan  --}}
            <div class="mb-3">
                <label for="ringkasan" class="form-label">Dapur bersama</label>
                <select class="form-select" name="ringkasan">
                    <option value="Tersedia" <?php if (old('ringkasan', $kost->ringkasan) == 'Tersedia') {
                        echo 'selected';
                    } ?>>Tersedia</option>
                    <option value="Tidak Tersedia" <?php if (old('ringkasan', $kost->ringkasan) == 'Tidak Tersedia') {
                        echo 'selected';
                    } ?>>Tidak Tersedia</option>
                </select>
            </div>


            {{-- //Gambar  --}}
            <div class="mb-3">
                <label for="image" class="form-label">Gambar Kamar (optional)</label>
                <input type="hidden" name="OldImage" value="{{ $kost->image }}">

                @if ($kost->image)
                    {{-- //jika gambar kost ada di input sebelumnya --}}
                    <img src="{{ asset('storage/' . $kost->image) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block"
                        alt="{{ $kost->image }}">
                @else
                    <img class="img-preview img-fluid mb-3 col-sm-5">
                @endif
                <input class="form-control @error('image') is-invalid @enderror" type="file" id="image"
                    name="image" onchange="previewImage()">
                @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- //Fasilitas  --}}
            <div class="mb-3">
                <label for="fasilitas" class="form-label">Fasilitas Kost Bersama</label>
                <input type="textarea" class="form-control @error('fasilitas') is-invalid @enderror" id="fasilitas"
                    name="fasilitas" required autofocus value="{{ old('fasilitas', $kost->fasilitas) }}">
                @error('fasilitas')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- //deskripsi --}}
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Informasi lain terkait kost</label>
                @error('deskripsi')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                <input id="deskripsi" type="hidden" name="deskripsi" value="{{ old('deskripsi', $kost->deskripsi) }}">
                <trix-editor input="deskripsi"></trix-editor>
            </div>

            {{-- Peta --}}
            <div class="mb-3">
                <label for="#" class="form-label">Lokasi kost pada peta</label>

                <div id="map"></div>

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

                <div class="mb-3">
                    <label for="#" class="form-label">jarak (meter)</label>
                    <input type="text" class="form-control" id="jarak" name="jarak" disable readonly required
                        value="{{ $kost->jarak }}">
                </div>

                <div class="mb-3">
                    <label for="#" class="form-label">Latitude</label>
                    <input type="text" class="form-control" id="latitude" name="latitude" disable readonly required
                        autofocus value="{{ $kost->latitude }}">
                </div>

                <div class="mb-3">
                    <label for="#" class="form-label">Longitude</label>
                    <input type="text" class="form-control" id="longitude" name="longitude" disable readonly required
                        autofocus value="{{ $kost->longitude }}">
                </div>

            </div>

            <button type="submit" class="btn btn-primary mb-3">Perbaharui Data Kost</button>

        </form>
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
