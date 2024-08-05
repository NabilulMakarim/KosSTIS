@extends('layout.main')

@section('container')
    {{-- <h1 class="mb-3 text-center"> {{ $title }}</h1> --}}

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Menambahkan Data Kontrakan Baru</h1>
    </div>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card col-md-9 mx-auto mb-5">
        <h5 class="card-header">Tambah data kontrakan</h5>
        <div class="card-body">
            <div class="col-lg-10 mx-auto mb-3">
                {{-- <div class="col-lg-8"> --}}
                <form method="post" action="/kontrakans/tambahUpdateKontrakan" class="mb-0" enctype="multipart/form-data">
                    {{-- otomatis langsung ke method store --}}
                    @csrf

                    <input type="hidden" id="statusPengajuan" name="statusPengajuan" value=0>
                    {{-- <input type="hidden" id="status" name="status" value=1> --}}

                    {{-- //nama  --}}
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Kontrakan</label>
                        <div class="input-group">
                            <div class="input-group-text">Kontrakan</div>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                name="nama" required autofocus value="{{ old('nama') }}">
                        </div>
                        @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>



                    {{-- //kelurahan  --}}
                    <div class="mb-3">
                        <label for="kelurahan" class="form-label">Kelurahan</label>
                        <input type="text" class="form-control @error('kelurahan') is-invalid @enderror" id="kelurahan"
                            name="kelurahan" disable readonly required value="{{ $kelurahan }}">
                    </div>


                    {{-- //rt  --}}
                    <div class="mb-3">
                        <label for="rt" class="form-label">RT</label>
                        <input type="text" class="form-control @error('rt') is-invalid @enderror" id="rt"
                            name="rt" disable readonly required value="{{ $rt }}">
                        @error('rt')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- //rw  --}}
                    <div class="mb-3">
                        <label for="rw" class="form-label">RW</label>
                        <input type="text" class="form-control @error('rw') is-invalid @enderror" id="rw"
                            name="rw" disable readonly required value="{{ $rw }}">
                        @error('rw')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- //Nomor rumah  --}}
                    <div class="mb-3">
                        <label for="no" class="form-label">No.</label>
                        <input type="text" class="form-control @error('no') is-invalid @enderror" id="no"
                            name="no" disable readonly required value="{{ $no }}">
                        @error('no')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- //status  --}}
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" name="status">
                            <option value="0" <?php if (old('status') == 0) {
                                echo 'selected';
                            } ?>>Sedang disewa</option>
                            <option value="1" <?php if (old('status') == 1) {
                                echo 'selected';
                            } ?>>Tersedia</option>
                        </select>
                    </div>


                    {{-- //harga  --}}
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga perbulan (misal: 1800000)</label>
                        <input type="text" class="form-control @error('harga') is-invalid @enderror" id="harga"
                            name="harga" required autofocus value="{{ old('harga') }}">
                        @error('harga')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- //durasi Dewa  --}}
                    <div class="mb-3">
                        <label for="durSewa" class="form-label">Durasi Sewa (dalam bulan)</label>
                        <input type="text" class="form-control @error('durSewa') is-invalid @enderror" id="durSewa"
                            name="durSewa" required autofocus value="{{ old('durSewa') }}">
                        @error('durSewa')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- //Fasilitas  --}}
                    <div class="mb-3">
                        <label for="fasilitas" class="form-label">Fasilitas Kontrakan</label>
                        <input type="textarea" class="form-control @error('fasilitas') is-invalid @enderror" id="fasilitas"
                            name="fasilitas" required autofocus value="{{ old('fasilitas') }}">
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
                            <option value="Sudah Termasuk" <?php if (old('listrik') == 'Sudah Termasuk') {
                                echo 'selected';
                            } ?>>Sudah Termasuk</option>
                            <option value="Belum Termasuk" <?php if (old('listrik') == 'Belum Termasuk') {
                                echo 'selected';
                            } ?>>Belum Termasuk</option>
                        </select>
                    </div>

                    {{-- //wifi  --}}
                    <div class="mb-3">
                        <label for="wifi" class="form-label">Wifi</label>
                        <select class="form-select" name="wifi">
                            <option value="Ada" <?php if (old('wifi') == 'Ada') {
                                echo 'selected';
                            } ?>>Ada</option>
                            <option value="Belum Ada" <?php if (old('wifi') == 'Belum Ada') {
                                echo 'selected';
                            } ?>>Belum Ada</option>
                        </select>
                    </div>

                    {{-- //Tempat parkir  --}}
                    <div class="mb-3">
                        <label for="parkir" class="form-label">Tempat parkir</label>
                        <select class="form-select" name="parkir">
                            <option value="Tersedia" <?php if (old('parkir') == 'Tersedia') {
                                echo 'selected';
                            } ?>>Tersedia</option>
                            <option value="Tidak Tersedia" <?php if (old('parkir') == 'Tidak Tersedia') {
                                echo 'selected';
                            } ?>>Tidak Tersedia</option>
                        </select>
                    </div>

                    {{-- //Dapur  --}}
                    <div class="mb-3">
                        <label for="ringkasan" class="form-label">Dapur</label>
                        <select class="form-select" name="ringkasan">
                            <option value="Tersedia" <?php if (old('ringkasan') == 'Tersedia') {
                                echo 'selected';
                            } ?>>Tersedia</option>
                            <option value="Tidak Tersedia" <?php if (old('ringkasan') == 'Tidak Tersedia') {
                                echo 'selected';
                            } ?>>Tidak Tersedia</option>
                        </select>
                    </div>

                    {{-- //Jumlah Kamar  --}}
                    <div class="mb-3">
                        <label for="jumKam" class="form-label">Jumlah Kamar</label>
                        <input type="text" class="form-control @error('jumKam') is-invalid @enderror" id="jumKam"
                            name="jumKam" required autofocus value="{{ old('jumKam') }}">
                        @error('jumKam')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- //No Hp pemilik  --}}
                    <div class="mb-3">
                        <label for="noHp" class="form-label">Nomor HP pemilik kontrakan</label>
                        <div class="input-group">
                            <div class="input-group-text">+62</div>
                            <input type="text" class="form-control @error('noHp') is-invalid @enderror" id="noHp"
                                name="noHp" required autofocus value="{{ old('noHp') }}">
                        </div>
                        @error('noHp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    {{-- //Jumlah Kamar Kosong  --}}
                    {{-- <div class="mb-3">
          <label for="jumKos" class="form-label">Jumlah Kamar Kosong</label>
          <input type="text" class="form-control @error('jumKos') is-invalid @enderror" id="jumKos" name="jumKos" required autofocus value="{{ old('jumKos') }}">
          @error('jumKos')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
          @enderror
        </div> --}}



                    {{-- //Gambar  --}}
                    <div class="mb-3">
                        <label for="image" class="form-label">Gambar Kontrakan (optional)</label>
                        <img class="img-preview img-fluid mb-3 col-sm-5">
                        <input class="form-control @error('image') is-invalid @enderror" type="file" id="image"
                            name="image" onchange="previewImage()">
                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- //deskripsi --}}
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Informasi lain terkait kontrakan</label>
                        @error('deskripsi')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <input id="deskripsi" type="hidden" name="deskripsi" value="{{ old('deskripsi') }}">
                        <trix-editor input="deskripsi"></trix-editor>
                    </div>

                    {{-- Peta --}}
                    <div class="mb-3">
                        <label for="#" class="form-label">Lokasi kontrakan pada peta</label>

                        <div class="mb-3">
                            <div id="map" class="mb-1"></div>
                            <small>
                                Keterangan : <br>
                                <table>
                                    <tr>
                                        <td>
                                            <div
                                                style="background-color: peru; border: 1px solid #17202A; height: 12px; margin: 0px 0px; padding: 0px;  width: 12px;">
                                            </div>
                                        </td>
                                        <td> = Bidara Cina</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div
                                                style="background-color: blueviolet; border: 1px solid #17202A; height: 12px; margin: 0px 0px; padding: 0px;  width: 12px;">
                                            </div>
                                        </td>
                                        <td> = Balimester </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div
                                                style="background-color: lime; border: 1px solid #17202A; height: 12px; margin: 0px 0px; padding: 0px;  width: 12px;">
                                            </div>
                                        </td>
                                        <td> = Cipinang Cempedak </td>
                                    </tr>
                                </table>
                            </small>
                        </div>

                        <script>
                            //menampilkan map
                            var map = L.map('map').setView([-6.231531614034552, 106.86686413870501], 18);

                            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                maxZoom: 19,
                                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                            }).addTo(map);

                            //get coordinat location
                            var latInput = document.querySelector("[name=latitude]");
                            var lngInput = document.querySelector("[name=longitude]");
                            var distance = document.querySelector("[name=jarak]");


                            var curLocation = [-6.231471797582685, 106.86668204054837];

                            map.attributionControl.setPrefix(false);

                            var marker = new L.marker(curLocation, {
                                draggable: 'true',
                            });

                            marker.on('dragend', function(event) {

                                var position = marker.getLatLng();
                                marker.setLatLng(position, {
                                    draggable: 'true',
                                }).bindPopup(position).update();

                                var jarak = Math.round(map.distance(curLocation, [position.lat, position.lng]));

                                $("#latitude").val(position.lat);
                                $("#longitude").val(position.lng);
                                $("#jarak").val(jarak);


                            });
                            map.addLayer(marker);

                            // var bangunan = [a, b];

                            // let jarak = Math.round(map.distance(curLocation, bangunan));
                            // document.getElementById('jarak').innerHTML = jarak;

                            // $("#jarak").val(jarak);

                            var myStyle = {
                                "color": "#ff7800",
                                // "weight": 5,
                                "opacity": 0.1
                            };


                            var myStyleBidaraCina = {
                                "color": "#ffffff",
                                // "weight": 5,
                                "opacity": 0.1
                            };


                            // create a red polygon from an array of LatLng points
                            var batas = [
                                [
                                    -6.22519983899646, 106.86383112799496

                                ],
                                [
                                    -6.226363526895355,
                                    106.86441178976077
                                ],
                                [
                                    -6.227382542686826,
                                    106.86479252761819
                                ],
                                [
                                    -6.2287218175761865,
                                    106.86461680245287
                                ],
                                [
                                    -6.229566141294342,
                                    106.8637967516845
                                ],
                                [
                                    -6.23090541061265,
                                    106.86326957619167
                                ],
                                [
                                    -6.2317206163506285,
                                    106.86408962696004
                                ],
                                [
                                    -6.232768736152821,
                                    106.86537827816613
                                ],
                                [
                                    -6.234399140571568,
                                    106.86619832893439
                                ],
                                [
                                    -6.23462033656628,
                                    106.86587616613576
                                ],
                                [
                                    -6.235027936707127,
                                    106.86523184053124
                                ],
                                [
                                    -6.235697564822573,
                                    106.86546614075161
                                ],
                                [
                                    -6.236833019237096,
                                    106.86640334162854
                                ],
                                [
                                    -6.238230498217902,
                                    106.86687194206786
                                ],
                                [
                                    -6.238929236310739,
                                    106.86693051712297
                                ],
                                [
                                    -6.239220376908321,
                                    106.8665497792656
                                ],
                                [
                                    -6.239016578507247,
                                    106.8663154790467
                                ],
                                [
                                    -6.23761910162213,
                                    106.86552471580518
                                ],
                                [
                                    -6.237095046829992,
                                    106.86543685322323
                                ],
                                [
                                    -6.2367456766767475,
                                    106.86514397794929
                                ],
                                [
                                    -6.2368912476025855,
                                    106.86426535212598
                                ],
                                [
                                    -6.237939357070417,
                                    106.86338672630251
                                ],
                                [
                                    -6.240938103139371,
                                    106.86265453811757
                                ],
                                [
                                    -6.242859620725099,
                                    106.86262525058925
                                ],
                                [
                                    -6.246236816366448,
                                    106.87521888738803
                                ],
                                [
                                    -6.238976264694841,
                                    106.87800290397246
                                ],
                                [
                                    -6.224890251786491,
                                    106.87430475560996
                                ],
                                [
                                    -6.224658061670439,
                                    106.8710717133676
                                ],
                                [
                                    -6.224774157149227,
                                    106.86881389631452
                                ],
                                [
                                    -6.224774157149227,
                                    106.86628358427703
                                ],
                                [
                                    -6.22519983899646,
                                    106.86383112799496
                                ]
                            ];

                            var bidaraCina = [
                                [
                                    -6.226792232226757,
                                    106.8704764542208
                                ],
                                [
                                    -6.226944538626938,
                                    106.86806976102457
                                ],
                                [
                                    -6.226524309996421,
                                    106.8671875575501
                                ],
                                [
                                    -6.225734656411731,
                                    106.86694123756516
                                ],
                                [
                                    -6.2247337668419505,
                                    106.86630535407568
                                ],
                                [
                                    -6.225172265166137,
                                    106.86382415475077
                                ],
                                [
                                    -6.226323328362298,
                                    106.86441229040099
                                ],
                                [
                                    -6.227346493529865,
                                    106.8647982544224
                                ],
                                [
                                    -6.228735703269834,
                                    106.86463263914453
                                ],
                                [
                                    -6.229539615232781,
                                    106.86376881490867
                                ],
                                [
                                    -6.230873375545826,
                                    106.86327257545355
                                ],
                                [
                                    -6.2327436545271695,
                                    106.86538887471681
                                ],
                                [
                                    -6.234388006028823,
                                    106.8661975612348
                                ],
                                [
                                    -6.235027474665259,
                                    106.86524184080378
                                ],
                                [
                                    -6.2356304015224,
                                    106.86546239167143
                                ],
                                [
                                    -6.236818567158906,
                                    106.86639954257004
                                ],
                                [
                                    -6.238188849787136,
                                    106.86687740278654
                                ],
                                [
                                    -6.238956206494322,
                                    106.8669509197411
                                ],
                                [
                                    -6.239211991813704,
                                    106.8665098180038
                                ],
                                [
                                    -6.2389927472620315,
                                    106.8662708878976
                                ],
                                [
                                    -6.2376590075959655,
                                    106.86549895985695
                                ],
                                [
                                    -6.237110894420326,
                                    106.86544382213901
                                ],
                                [
                                    -6.236708944393499,
                                    106.8651129958356
                                ],
                                [
                                    -6.236891648989797,
                                    106.8642491715998
                                ],
                                [
                                    -6.237896523126793,
                                    106.86334858888665
                                ],
                                [
                                    -6.240911133980546,
                                    106.86261341932322
                                ],
                                [
                                    -6.2428112434246685,
                                    106.86261341932322
                                ],
                                [
                                    -6.244640795476059,
                                    106.86935160981199
                                ],
                                [
                                    -6.2420464226152745,
                                    106.87034408872222
                                ],
                                [
                                    -6.240657879749307,
                                    106.87032570948355
                                ],
                                [
                                    -6.239123172020129,
                                    106.86993974523972
                                ],
                                [
                                    -6.229939695738338,
                                    106.86974740603313
                                ],
                                [
                                    -6.226792232226757,
                                    106.8704764542208
                                ]
                            ];

                            var balimester = [
                                [
                                    -6.224741494388766,
                                    106.86631152164591
                                ],
                                [
                                    -6.2257724887235355,
                                    106.86697063186884
                                ],
                                [
                                    -6.226521835060723,
                                    106.86716934886118
                                ],
                                [
                                    -6.226970247572375,
                                    106.86806618049658
                                ],
                                [
                                    -6.226925777061808,
                                    106.86804222567469
                                ],
                                [
                                    -6.226791129762361,
                                    106.8704802609148
                                ],
                                [
                                    -6.226611599976323,
                                    106.87475434738298
                                ],
                                [
                                    -6.224876142213617,
                                    106.87428780977643
                                ],
                                [
                                    -6.224636768278941,
                                    106.87105214572387
                                ],
                                [
                                    -6.224756455259524,
                                    106.8685388624827
                                ],
                                [
                                    -6.224741494388766,
                                    106.86631152164591
                                ]
                            ];

                            var cipinangCempedak = [
                                [
                                    -6.22678390901406,
                                    106.87047513153857
                                ],
                                [
                                    -6.229913909317773,
                                    106.86971004593704
                                ],
                                [
                                    -6.239142235883108,
                                    106.86992059100277
                                ],
                                [
                                    -6.240645390410279,
                                    106.87032254509302
                                ],
                                [
                                    -6.242015350273931,
                                    106.87036082643397
                                ],
                                [
                                    -6.244622069562965,
                                    106.86934637087631
                                ],
                                [
                                    -6.2462013165435195,
                                    106.87520341617483
                                ],
                                [
                                    -6.23897099248174,
                                    106.87797881586471
                                ],
                                [
                                    -6.226609599361652,
                                    106.87473818471085
                                ],
                                [
                                    -6.22678390901406,
                                    106.87047513153857
                                ]
                            ];

                            var polygon = L.polygon(batas, {
                                style: myStyle
                            }).addTo(map);

                            var polygon2 = L.polygon(bidaraCina, {
                                color: 'peru',
                                stroke: false
                            }).addTo(map);

                            var polygon3 = L.polygon(balimester, {
                                color: 'blueviolet',
                                stroke: false
                            }).addTo(map);

                            var polygon4 = L.polygon(cipinangCempedak, {
                                color: 'lime',
                                stroke: false
                            }).addTo(map);
                        </script>

                        <div class="mb-5">
                            <label for="#" class="form-label">Jarak (meter)</label>
                            <input type="text" class="form-control" id="jarak" name="jarak" disable readonly
                                required value="">
                        </div>

                        {{-- <div class="mb-3">
            <label for="#" class="form-label">Latitude</label> --}}
                        <input type="hidden" class="form-control" id="latitude" name="latitude" disable readonly
                            required autofocus value="">
                        {{-- </div> --}}

                        {{-- <div class="mb-3">
            <label for="#" class="form-label">Longitude</label> --}}
                        <input type="hidden" class="form-control" id="longitude" name="longitude" disable readonly
                            required autofocus value="">
                        {{-- </div> --}}
                    </div>

                    <button type="submit" class="btn btn-primary">Ajukan Penambahan Data Kontrakan</button>




                    {{-- <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" required autofocus value="{{ old('title') }}">
        @error('title')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="slug" class="form-label">Slug</label>
        <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" required value="{{ old('slug') }}">
        {{-- tambahakan disable readonly jika slug ingin tidak bisa diedit --}}
                    {{-- @error('slug')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror --}}
                    {{-- </div>
      <div class="mb-3">
        <label for="category" class="form-label">Category</label>
        <select class="form-select" name="category_id">
          @foreach ($categories as $category)
            @if (old('category_id') == $category->id)
              <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
            @else
              <option value="{{ $category->id }}">{{ $category->name }}</option>             
          @endif
          @endforeach
        </select>
      </div> --}}
                    {{-- <div class="mb-3">
        <label for="image" class="form-label">Post Image</label>
        <img class="img-preview img-fluid mb-3 col-sm-5">
        <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
        @error('image')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div> --}}
                    {{-- <div class="mb-3">
        <label for="body" class="form-label">Body</label>
        @error('body')
          <p class="text-danger">{{ $message }}</p>
        @enderror
        <input id="body" type="hidden" name="body" value="{{ old('body') }}">
        <trix-editor input="body"></trix-editor>
      </div>
      <button type="submit" class="btn btn-primary">Create Post</button> --}}
                </form>
            </div>
        </div>
    </div>


    <script>
        const title = document.querySelector('#title');
        const slug = document.querySelector('#slug');

        title.addEventListener('change', function() {
            fetch('/dashboard/posts/checkSlug?title=' + title.value)
                .then((response) => response.json())
                .then((data) => slug.value = data.slug);
        });


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
