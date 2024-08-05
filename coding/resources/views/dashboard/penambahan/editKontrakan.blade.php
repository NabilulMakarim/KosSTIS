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
            <h2>Edit Pengajuan Penambahan Data Kontrakan {{ $kontrakan->nama }}</h2>


            <a href="/dashboard/penambahan" class="btn btn-success"><i class="fas fa-chevron-circle-left"></i> Kembali</a>

            {{-- <a href="/dashboard/kosts/{{ $post->slug }}/edit" class="btn btn-warning"><span data-feather="edit"></span> Edit</a>

        <form action="/dashboard/kosts/{{ $post->slug }}" method="post" class="d-inline"> --}}

            <form method="post" action="/dashboard/penambahanKontrakan/update" class="mb-0" enctype="multipart/form-data">
                {{-- otomatis langsung ke method store (update ga sih ?) --}}
                @csrf

                <input type="hidden" name="kontrakan_id" value="{{ $kontrakan->id }}">
                <div class="mb-3">
                    @if ($kontrakan->image)
                        <div style="max-height: 350px; overflow:hidden">
                            <img src="{{ asset('storage/' . $kontrakan->image) }}" alt="{{ $kontrakan->nama }}"
                                class="img-fluid mt-3">
                        </div>
                    @else
                        <img src="img/kontrakanIlustrasi.png" alt="kontrakan {{ $kontrakan->nama }}" class="img-fluid mt-3">
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
                    <label for="nama" class="form-label">Nama Kontrakan</label>
                    <div class="input-group">
                        <div class="input-group-text">Kontrakan</div>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                            name="nama" required autofocus value="{{ old('nama', $kontrakan->nama) }}">
                    </div>
                    @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                {{-- //No Hp pemilik  --}}
                <div class="mb-3">
                    <label for="noHp" class="form-label">Nomor HP pemilik</label>
                    <div class="input-group">
                        <div class="input-group-text">+62</div>
                        <input type="text" class="form-control @error('noHp') is-invalid @enderror" id="noHp"
                            name="noHp" required autofocus value="{{ old('noHp', $kontrakan->noHp) }}">
                    </div>
                    @error('noHp')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                {{-- //Gambar  --}}
                <div class="mb-3">
                    <label for="image" class="form-label">Gambar Kontrakan</label>
                    <input type="hidden" name="OldImage" value="{{ $kontrakan->image }}">
                    @if ($kontrakan->image)
                        {{-- //jika gambar kontrakan ada di input sebelumnya --}}
                        <img src="{{ asset('storage/' . $kontrakan->image) }}"
                            class="img-preview img-fluid mb-3 col-sm-5 d-block" alt="{{ $kontrakan->image }}">
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



                {{-- //harga  --}}
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga perbulan (misal: 800000)</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('harga') is-invalid @enderror" id="harga"
                            name="harga" required autofocus value="{{ old('harga', $kontrakan->harga) }}">
                        <div class="input-group-text">/bulan</div>
                    </div>
                    @error('harga')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- //Jumlah Kamar  --}}
                <div class="mb-3">
                    <label for="jumKam" class="form-label">Jumlah Kamar</label>
                    <input type="text" class="form-control @error('jumKam') is-invalid @enderror" id="jumKam"
                        name="jumKam" required autofocus value="{{ old('jumKam', $kontrakan->jumKam) }}">
                    @error('jumKam')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                {{-- //durasi Dewa  --}}
                <div class="mb-3">
                    <label for="durSewa" class="form-label">Durasi Sewa (dalam bulan)</label>
                    <input type="text" class="form-control @error('durSewa') is-invalid @enderror" id="durSewa"
                        name="durSewa" required autofocus value="{{ old('durSewa', $kontrakan->durSewa) }}">
                    @error('durSewa')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- //Fasilitas  --}}
                <div class="mb-3">
                    <label for="fasilitas" class="form-label">Fasilitas kontrakan</label>
                    <input type="textarea" class="form-control @error('fasilitas') is-invalid @enderror" id="fasilitas"
                        name="fasilitas" required autofocus value="{{ old('fasilitas', $kontrakan->fasilitas) }}">
                    @error('fasilitas')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- //Listrik  --}}
                <div class="mb-3">
                    <label for="listrik" class="form-label">Listrik</label>
                    <select class="form-select" name="listrik">
                        <option value="Sudah Termasuk" <?php if (old('listrik', $kontrakan->listrik) == 'Sudah Termasuk') {
                            echo 'selected';
                        } ?>>Sudah Termasuk</option>
                        <option value="Belum Termasuk" <?php if (old('listrik', $kontrakan->listrik) == 'Belum Termasuk') {
                            echo 'selected';
                        } ?>>Belum Termasuk</option>
                    </select>
                </div>

                {{-- //wifi  --}}
                <div class="mb-3">
                    <label for="wifi" class="form-label">Wifi</label>
                    <select class="form-select" name="wifi">
                        <option value="Ada" <?php if (old('wifi', $kontrakan->wifi) == 'Ada') {
                            echo 'selected';
                        } ?>>Ada</option>
                        <option value="Belum Ada" <?php if (old('wifi', $kontrakan->wifi) == 'Belum Ada') {
                            echo 'selected';
                        } ?>>Belum Ada</option>
                    </select>
                </div>

                {{-- //Tempat parkir  --}}
                <div class="mb-3">
                    <label for="parkir" class="form-label">Tempat parkir</label>
                    <select class="form-select" name="parkir">
                        <option value="Tersedia" <?php if (old('parkir', $kontrakan->parkir) == 'Tersedia') {
                            echo 'selected';
                        } ?>>Tersedia</option>
                        <option value="Tidak Tersedia" <?php if (old('parkir', $kontrakan->parkir) == 'Tidak Tersedia') {
                            echo 'selected';
                        } ?>>Tidak Tersedia</option>
                    </select>
                </div>










                {{-- //status  --}}
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" name="status">
                        <option value="1" <?php if (old('status', $kontrakan->status) == 1) {
                            echo 'selected';
                        } ?>>Tersedia</option>
                        <option value="0" <?php if (old('status', $kontrakan->status) == 0) {
                            echo 'selected';
                        } ?>>Sudah Terisi</option>
                    </select>
                </div>

                {{-- Peta --}}
                <div class="mb-3">
                    <label for="#" class="form-label">Lokasi kontrakan pada peta</label>

                    <div id="map" class="mb-3"></div>

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
                        <label for="#" class="form-label">Jarak (meter)</label>
                        <input type="text" class="form-control" id="jarak" name="jarak" disable readonly
                            required value="{{ $kontrakan->jarak }}">
                    </div>

                    {{-- <div class="mb-3">
                  <label for="#" class="form-label">Latitude</label> --}}
                    <input type="hidden" class="form-control" id="latitude" name="latitude" disable readonly required
                        autofocus value="{{ $kontrakan->latitude }}">
                    {{-- </div>  --}}

                    {{-- <div class="mb-3">
                  <label for="#" class="form-label">Longitude</label> --}}
                    <input type="hidden" class="form-control" id="longitude" name="longitude" disable readonly required
                        autofocus value="{{ $kontrakan->longitude }}">
                    {{-- </div>  --}}

                </div>

                {{-- //deskripsi --}}
                <div class="mb-4">
                    <label for="deskripsi" class="form-label">Deskripsi Kontrakan</label>
                    @error('deskripsi')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <input id="deskripsi" type="hidden" name="deskripsi"
                        value="{{ old('deskripsi', $kontrakan->deskripsi) }}">
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
