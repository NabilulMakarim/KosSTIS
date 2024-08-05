@extends('dashboard.layout.main')

@section('container')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Pengajuan Penambahan Data Kontrakan {{ $kontrakan->nama }}</h2>
                <h6>Oleh : {{ $user->nama }}, {{ $user->nim }}</h6>


                <a href="/dashboard/penambahan" class="btn btn-success"><i class="fas fa-chevron-circle-left"></i> Kembali</a>

                {{-- <a href="/dashboard/kontrakans/{{ $post->slug }}/edit" class="btn btn-warning"><span data-feather="edit" ></span> Edit</a>

            <form action="/dashboard/kontrakans/{{ $post->slug }}" method="post" class="d-inline"> --}}


                <div class="mb-3">
                    @if ($kontrakan->image)
                        <div>
                            <img src="{{ asset('storage/' . $kontrakan->image) }}" alt="{{ $kontrakan->nama }}"
                                style="max-width: 100%; height: 350px;" class="rounded mx-auto d-block mt-3">
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
          <input type="text" class="form-control" id="#" disable readonly name="#" required value="{{ $user->nama }}">
        </div>
      </div> --}}


                {{-- //nama  --}}
                <div class="mb-3">
                    <label for="nama" class="form-label fw-bold">Nama Kontrakan</label>
                    <div class="input-group">
                        <div class="input-group-text">Kontrakan</div>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                            disable readonly name="nama" required value="{{ old('nama', $kontrakan->nama) }}">
                    </div>
                </div>

                {{-- //rt  --}}
                <div class="mb-3">
                    <label for="rt" class="form-label fw-bold">RT</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('rt') is-invalid @enderror" id="rt" disable
                            readonly name="rt" required value="{{ old('rt', $kontrakan->rt) }}">
                    </div>
                </div>

                {{-- //rw  --}}
                <div class="mb-3">
                    <label for="rw" class="form-label fw-bold">RW</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('rw') is-invalid @enderror" id="rw" disable
                            readonly name="rw" required value="{{ old('rw', $kontrakan->rw) }}">
                    </div>
                </div>

                {{-- //no  --}}
                <div class="mb-3">
                    <label for="no" class="form-label fw-bold">Nomor Rumah</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('no') is-invalid @enderror" id="no" disable
                            readonly name="no" required value="{{ old('no', $kontrakan->no) }}">
                    </div>
                </div>

                {{-- //kelurahan  --}}
                <div class="mb-3">
                    <label for="kelurahan" class="form-label fw-bold">Kelurahan</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('kelurahan') is-invalid @enderror" id="kelurahan"
                            disable readonly name="kelurahan" required
                            value="{{ old('kelurahan', $kontrakan->kelurahan) }}">
                    </div>
                </div>

                {{-- //area  --}}
                <div class="mb-3">
                    <label for="area" class="form-label fw-bold">Area</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('area') is-invalid @enderror" id="area"
                            disable readonly name="area" required value="{{ old('area', $kontrakan->area) }}">
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

                {{-- //Fasilitas  --}}
                <div class="mb-3">
                    <label for="fasilitas" class="form-label fw-bold">Fasilitas kontrakan</label>
                    <input type="textarea" class="form-control @error('fasilitas') is-invalid @enderror" id="fasilitas"
                        name="fasilitas" disable readonly required value="{{ old('fasilitas', $kontrakan->fasilitas) }}">
                </div>

                {{-- //Listrik  --}}
                <div class="mb-3">
                    <label for="listrik" class="form-label fw-bold">Listrik kontrakan</label>
                    <input type="textarea" class="form-control @error('listrik') is-invalid @enderror" id="listrik"
                        name="listrik" disable readonly required value="{{ old('listrik', $kontrakan->listrik) }}">
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

                {{-- //Durasi Sewa  --}}
                <div class="mb-3">
                    <label for="durSewa" class="form-label fw-bold">Durasi Sewa kontrakan</label>
                    <input type="textarea" class="form-control @error('durSewa') is-invalid @enderror" id="durSewa"
                        name="durSewa" disable readonly required value="{{ old('durSewa', $kontrakan->durSewa) }}">
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
                        var map = L.map('map').setView([{{ $kontrakan->latitude }}, {{ $kontrakan->longitude }}], 17);

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

                {{-- //jarak  --}}
                <div class="mb-3">
                    <label for="jarak" class="form-label fw-bold">Jarak (meter)</label>
                    <input type="textarea" class="form-control @error('jarak') is-invalid @enderror" id="jarak"
                        name="jarak" disable readonly required value="{{ old('jarak', $kontrakan->jarak) }}">
                </div>

                {{-- <div class="mb-3">
        <label for="#" class="form-label fw-bold">Latitude</label>
        <input type="text" class="form-control" id="latitude" name="latitude" disable readonly required value="{{ old('latitude', $kontrakan->latitude) }}">
    </div>

    <div class="mb-3">
        <label for="#" class="form-label fw-bold">Longitude</label>
        <input type="text" class="form-control" id="longitude" name="longitude" disable readonly required value="{{ old('longitude', $kontrakan->longitude) }}">
    </div> --}}


                {{-- //deskripsi  --}}
                <div class="mb-3">
                    <label for="deskripsi" class="form-label fw-bold">Deskripsi kontrakan</label>
                    <div class="card">
                        <div class="card-body" style="background-color: #E9ECEF">
                            {!! $kontrakan->deskripsi !!}
                        </div>
                    </div>
                </div>

                {{-- <button type="submit" class="btn btn-primary">Ajukan Pembaharuan Data</button> --}}
                </form>

                <div class="d-flex justify-content-evenly mb-5">
                    <div class=" my-5">
                        <h5>
                            <button class="btn btn-primary border-0" data-toggle="modal" data-target="#terima"><i
                                    class="fas fa-check-circle"></i></span> Terima Penambahan Kontrakan</button>
                        </h5>
                    </div>

                    <div class=" my-5">
                        <h5>
                            <button class="btn btn-danger text-dark border-0" data-toggle="modal" data-target="#tolak"><i
                                    class="fas fa-ban"></i> Tolak Penambahan Kontrakan</button>
                        </h5>

                        </form>
                    </div>

                    <div class=" my-5">
                        <a href="https://api.whatsapp.com/send?phone=62{{ $user->noHp }}&text=Selamat Pagi/Siang/Sore, benar dengan kak {{ $user->nama }}. Perkenalkan Saya Pengelola Web KoStis ingin bertanya tentang data kontrakan {{ $kontrakan->nama }} yang sudah Kakak ajukan beberapa waktu yang lalu %0A%0A(Selanjutnya isi sendiri)"
                            target="_blank">
                            <h5>
                                <button class="btn btn-success text-dark border-0"><i class="fab fa-whatsapp"></i> Hubungi
                                    Pengaju Data</button>
                            </h5>
                        </a>
                    </div>

                    <div class=" my-5">
                        <a href="/dashboard/penambahanKontrakan/edit/{{ $kontrakan->id }}">
                            <h5>
                                <button class="btn btn-warning border-0"><i class="fas fa-edit"></i> Edit Data</button>
                            </h5>
                        </a>
                    </div>

                </div>

            </div>
        </div>
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
                    Apakah Anda yakin <b>menerima</b> permintaan penambahan data kontrakan ini ?
                </div>
                <div class="modal-footer">
                    <form action="/dashboard/terimaKontrakan/{{ $kontrakan->id }}" method="post" class="d-inline">
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
                    Apakah Anda yakin <b>menolak</b> permintaan penambahan data kontrakan ini ?
                </div>
                <div class="modal-footer">
                    <form action="/dashboard/tolakKontrakan/{{ $kontrakan->id }}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-primary">Iya</button>
                    </form>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
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
