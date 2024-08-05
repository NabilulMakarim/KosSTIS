@extends('layout.main')

@section('container')

    @foreach ($ratings as $rate)
        @php
            $rataan = $rataan + $rate->rating;
        @endphp
    @endforeach

    @if ($ratings->count() > 0)
        @php
            $rataan = $rataan / $ratings->count();
        @endphp
    @else
        @php
            $rataan = '-';
        @endphp
    @endif

    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-9">
                <div class="mb-3">
                    <h2 class="mb-0">Kontrakan {{ $kontrakan->nama }} </h2>
                    <small><span>Rating <i class="bi bi-star-fill" style="color: yellow;"></i>{{ $rataan }} dari
                            {{ $ratings->count() }} rating masuk</small>
                </div>


                <div class="col d-flex justify-content-start">
                    <div class="mb-3">
                        <form method="post" action="/kontrakans/hubungiPemilik" class="mb-0">
                            @csrf
                            <input type="hidden" id="kontrakan_id" name="kontrakan_id" value={{ $kontrakan->id }}>
                            <input type="hidden" id="nama" name="nama" value="{{ $kontrakan->nama }}">
                            <input type="hidden" id="kelurahan" name="kelurahan" value="{{ $kontrakan->kelurahan }}">
                            <input type="hidden" id="rt" name="rt" value="{{ $kontrakan->rt }}">
                            <input type="hidden" id="rw" name="rw" value="{{ $kontrakan->rw }}">
                            <input type="hidden" id="no" name="no" value="{{ $kontrakan->no }}">
                            <input type="hidden" id="noHp" name="noHp" value="{{ $kontrakan->noHp }}">

                            <button type="submit" class="btn btn-success"><i class="bi bi-whatsapp"></i> Hubungi
                                Pemilik</button>
                        </form>
                    </div>
                    &emsp;
                    {{-- <!-- Button trigger modal -->
                    <div class="mb-3">
                        @if ($rating)
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#ModalHapus"><i class="bi bi-star"></i>
                                Hapus Rating
                            </button>
                        @else
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal"><i class="bi bi-star"></i>
                                Beri Rating
                            </button>
                        @endif
                    </div>
                    &emsp; --}}
                    <div class="mb-3">
                        <a href="https://api.whatsapp.com/send?phone=62{{ $admin->noHp }}&text=Selamat Pagi/Siang/Sore benar Admin web KoStis ? %0A%0ASaya ingin melaporkan kontrakan dengan nama kontrakan {{ $kontrakan->nama }} yang beralamatkan di Kelurahan {{ $kontrakan->kelurahan }}, RT.{{ $kontrakan->rt }}, RW.{{ $kontrakan->rw }}, No.{{ $kontrakan->no }} %0A%0A
                          (Selanjutnya isi sendiri tentang laporan yang ingin disampaikan)"
                            target="_blank" class="btn btn-warning"><i class="bi bi-exclamation-circle"></i></i>
                            Laporkan
                            Kontrakan</a>
                    </div>
                </div>



                <!-- Modal Beri Rating-->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Beri Rating Pada Kontrakan
                                    {{ $kontrakan->nama }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <form action="/kontrakan/rating" method="post">
                                    @csrf
                                    {{-- user id  --}}
                                    <input type="hidden" id="user_id" name="user_id" value={{ auth()->user()->id }}>
                                    <input type="hidden" id="kontrakan_id" name="kontrakan_id" value={{ $kontrakan->id }}>

                                    <div class="row">
                                        {{-- COBA RATING AND COMMENT  --}}
                                        <div class="rating-css">
                                            <div class="star-icon">
                                                <input type="radio" value="1" name="rating" checked id="rating1">
                                                <label for="rating"class="bi bi-star-fill"></label>
                                                <input type="radio" value="2" name="rating" id="rating2">
                                                <label for="rating2"class="bi bi-star-fill"></label>
                                                <input type="radio" value="3" name="rating" id="rating3">
                                                <label for="rating3"class="bi bi-star-fill"></label>
                                                <input type="radio" value="4" name="rating" id="rating4">
                                                <label for="rating4"class="bi bi-star-fill"></label>
                                                <input type="radio" value="5" name="rating" id="rating5">
                                                <label for="rating5"class="bi bi-star-fill"></label>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Beri Rating</button>
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Batal</button>

                                </form>


                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Hapus Rating -->
                <div class="modal fade" id="ModalHapus" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Hapus Rating Anda Sebelumnya Pada
                                    Kontrakan
                                    {{ $kontrakan->nama }} ?</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <form action="/kontrakan/hapusRating" method="post">
                                    @csrf
                                    {{-- user id  --}}
                                    <input type="hidden" id="user_id" name="user_id" value={{ auth()->user()->id }}>
                                    <input type="hidden" id="kontrakan_id" name="kontrakan_id"
                                        value={{ $kontrakan->id }}>

                                    <button type="submit" class="btn btn-danger">Hapus Rating</button>
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Batal</button>

                                </form>



                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    {{-- //Gambar  --}}
                    @if ($kontrakan->image)
                        <div>
                            <img src="{{ asset('storage/' . $kontrakan->image) }}" alt="{{ $kontrakan->nama }}"
                                style="max-width: 100%; height: 350px;" class="rounded mx-auto d-block">
                        </div>
                    @else
                        <div class="card align-items-center justify-content-center" style="height: 350px">
                            <h1 class="align-middle">Gambar tidak tersedia</h1>
                        </div>
                    @endif
                </div>


                {{-- Isi tabel  --}}
                <div class="card">
                    <div class="card-header fw-bold">
                        Informasi Kontrakan Lebih Lanjut
                    </div>
                    <div class="card-body">

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Variabel</th>
                                    <th scope="col">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Nama Kontrakan</td>
                                    <td>Kontrakan {{ $kontrakan->nama }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Alamat</td>
                                    <td>Kelurahan {{ $kontrakan->kelurahan }}, RT.{{ $kontrakan->rt }},
                                        RW.{{ $kontrakan->rw }}, No.{{ $kontrakan->no }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>Area</td>
                                    <td>{{ $kontrakan->area }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">4</th>
                                    <td>Jarak Radius ke Kampus</td>
                                    <td>{{ $kontrakan->jarak }} meter</td>
                                </tr>
                                <tr>
                                    <th scope="row">5</th>
                                    <td>Durasi minimal sewa</td>
                                    <td>{{ $kontrakan->durSewa }} bulan</td>
                                </tr>
                                <tr>
                                    <th scope="row">6</th>
                                    <td>Wifi</td>
                                    <td>{{ $kontrakan->wifi }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">7</th>
                                    <td>Tempat Parkir</td>
                                    <td>{{ $kontrakan->parkir }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">8</th>
                                    <td>Dapur</td>
                                    <td>{{ $kontrakan->ringkasan }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">9</th>
                                    <td>Listrik</td>
                                    <td>{{ $kontrakan->listrik }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">10</th>
                                    <td>Jumlah Kamar</td>
                                    <td>{{ $kontrakan->jumKam }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">11</th>
                                    <td>Fasilitas Lain</td>
                                    <td>{{ $kontrakan->fasilitas }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">12</th>
                                    <td>Harga</td>
                                    <td>{{ $kontrakan->harga }} per bulan</td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="card-header fw-bold">
                            Lokasi Kontrakan dan Kampus
                        </div>

                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="card">
                                    <div id="map"></div>
                                </div>
                            </div>
                        </div>

                        <div class="card-header fw-bold">
                            Deskripsi Tentang Kontrakan
                        </div>

                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="card">
                                    {!! $kontrakan->deskripsi !!}
                                </div>
                            </div>
                        </div>

                        <div class="card-header fw-bold">
                            Komentar Mereka
                        </div>

                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="card">
                                    @if ($reviews->count() > 0)
                                        @foreach ($reviews as $review)
                                            <div>
                                                <b class="mb-0">{{ $review->username }}</b>
                                                <small>
                                                    {!! $review->comment !!}
                                                </small>
                                                <hr>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="text-center my-3">
                                            <i>~Belum ada komentar~</i>
                                        </div>
                                        <hr>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        //menampilkan map
        var map = L.map('map').setView([-6.231531614034552, 106.86686413870501], 16);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        // menampilkan titik
        var awal = [-6.231531614034552, 106.86686413870501];
        var akhir = [<?php echo $kontrakan->latitude; ?>,
            <?php echo $kontrakan->longitude; ?>
        ];

        var stisIcon = L.icon({
            // iconUrl: '<?php echo asset('storage/post-images/universityMarker.png'); ?>',
            iconUrl: '/img/universityMarker.png',
            // shadowUrl: 'leaf-shadow.png',

            iconSize: [25, 40], // size of the icon
            iconAnchor: [13,
                40
            ], // point of the icon which will correspond to marker's location (mengatur posisi icon)

        });

        // marker kampus 
        L.marker(awal, {
            icon: stisIcon
        }).addTo(map);
        // L.marker(awal).addTo(map);
        L.marker(akhir).addTo(map);
    </script>

@endsection
