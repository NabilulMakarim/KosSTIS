@extends('layout.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Kost</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show col-lg-12" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row d-flex align-items-start">

        <div class="col-md-6">
            <form action="/kosts" method="get">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Cari berdasarkan nama kost..." name="search"
                        value="{{ request('search') }}">
                    <button class="btn btn-dark" type="submit">Search</button>
                </div>
            </form>
        </div>

        <div class="col-md-5 mb-3">
            <a href="/kosts/tambahUpdateKost" class="btn btn-dark">Tambah atau Update Data Kost dan Kamar</a>
        </div>

    </div>

    <div class="card mb-3">
        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        Filter Pencarian
                    </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                    data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">

                        <div class="col-lg-12">
                            <form method="get" action="/kosts" class="mb-5 row g-3">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Area</label>
                                        <select id="inputState" class="form-select" name="area">
                                            <option value="Bo" <?php if (request('area') == 'Bo') {
                                                echo 'selected';
                                            } ?>>-Tidak ditentukan-</option>
                                            <option value="Bonsay" <?php if (request('area') == 'Bonsay') {
                                                echo 'selected';
                                            } ?>>Bonsay</option>
                                            <option value="Bonasut" <?php if (request('area') == 'Bonasut') {
                                                echo 'selected';
                                            } ?>>Bonasut</option>
                                            <option value="Bonasel" <?php if (request('area') == 'Bonasel') {
                                                echo 'selected';
                                            } ?>>Bonasel</option>
                                            <option value="Bobobo" <?php if (request('area') == 'Bobobo') {
                                                echo 'selected';
                                            } ?>>Lainnya</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Tipe Kost</label>
                                        <select id="inputState" class="form-select" name="gender">
                                            <option value="Pria" <?php if (request('gender') == 'Pria') {
                                                echo 'selected';
                                            } ?>>Pria</option>
                                            <option value="Wanita" <?php if (request('gender') == 'Wanita') {
                                                echo 'selected';
                                            } ?>>Wanita</option>
                                            <option value="Campuran" <?php if (request('gender') == 'Campuran') {
                                                echo 'selected';
                                            } ?>>Campuran</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row"></div>
                                <div class="col-lg-5">
                                    <label for="hargaMin" class="form-label fw-bold">Harga Minimal</label>
                                    <input type="range" class="form-range" min="400000" max="2000000" step="100000"
                                        name="hargaMin" id="getHargaMin" onchange="rangeMin()" value="<?php if (request('hargaMin') == 0) {
                                            echo '400000';
                                        } else {
                                            echo request('hargaMin');
                                        } ?>">
                                </div>

                                <div class="col-lg-1">
                                    <label for="putHargaMin" class="form-label fw-bold"></label>
                                    <input class="col-lg-12" type="text" id="putHargaMin"
                                        placeholder="<?php if (request('hargaMin') == 0) {
                                            echo '400000';
                                        } else {
                                            echo request('hargaMin');
                                        } ?>">
                                </div>


                                <div class="col-lg-5">
                                    <label for="customRange3" class="form-label fw-bold">Harga Maksimal</label>
                                    <input type="range" class="form-range" min="400000" max="2000000" step="100000"
                                        name="hargaMaks" id="getHargaMaks" onchange="rangeMaks()"
                                        value="<?php if (request('hargaMaks') == 0) {
                                            echo '2000000';
                                        } else {
                                            echo request('hargaMaks');
                                        } ?>">
                                </div>

                                <div class="col-lg-1">
                                    <label for="customRange3" class="form-label fw-bold"></label>
                                    <input class="col-lg-12" type="text" id="putHargaMaks"
                                        placeholder="<?php if (request('hargaMaks') == 0) {
                                            echo '2000000';
                                        } else {
                                            echo request('hargaMaks');
                                        } ?>">
                                </div>
                        </div>

                        <div class="row">
                            {{-- <div class="col-lg-5">
                                <label for="customRange3" class="form-label fw-bold">Radius Maksimal dari Kampus
                                    (meter)</label>
                                <input type="range" class="form-range" min="0" max="2000" step="50"
                                    name="jarak" id="getJarak" onchange="rangeJarak()" value="<?php if (request('jarak') == 0) {
                                        echo '2000';
                                    } else {
                                        echo request('jarak');
                                    } ?>">
                            </div>

                            <div class="col-lg-1">
                                <label for="customRange3" class="form-label fw-bold"></label>
                                <input class="col-lg-12" type="text" id="putJarak"
                                    placeholder="<?php if (request('jarak') == 0) {
                                        echo '2000';
                                    } else {
                                        echo request('jarak');
                                    } ?>">
                            </div> --}}

                            {{-- urutan  --}}
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Urutkan hasil</label>
                                <select id="inputState" class="form-select" name="urut">
                                    <option value="harga" <?php if (request('urut') == 'harga') {
                                        echo 'selected';
                                    } ?>>Harga Terendah</option>
                                    <option value="jarak" <?php if (request('urut') == 'jarak') {
                                        echo 'selected';
                                    } ?>>Jarak Terdekat</option>
                                    <option value="nama" <?php if (request('urut') == 'nama') {
                                        echo 'selected';
                                    } ?>>Nama Kost</option>
                                </select>
                            </div>
                        </div>

                        <hr>
                        <div class="row">
                            <label class="form-label fw-bold">
                                <h3>Fasilitas</h3>
                            </label>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label class="form-label fw-bold">Wifi</label>
                                <select id="inputState" class="form-select" name="wifi">
                                    <option value="A" <?php if (request('wifi') == 'A') {
                                        echo 'selected';
                                    } ?>>-Tidak ditentukan-</option>
                                    <option value="Ada" <?php if (request('wifi') == 'Ada') {
                                        echo 'selected';
                                    } ?>>Ada</option>
                                    <option value="Belum Ada" <?php if (request('wifi') == 'Belum Ada') {
                                        echo 'selected';
                                    } ?>>Belum Ada</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label fw-bold">Parkir</label>
                                <select id="inputState2" class="form-select" name="parkir">
                                    <option value="T" <?php if (request('parkir') == 'T') {
                                        echo 'selected';
                                    } ?>>-Tidak ditentukan-</option>
                                    <option value="Tersedia" <?php if (request('parkir') == 'Tersedia') {
                                        echo 'selected';
                                    } ?>>Tersedia</option>
                                    <option value="Tidak Tersedia" <?php if (request('parkir') == 'Tidak Tersedia') {
                                        echo 'selected';
                                    } ?>>Tidak Tersedia</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label fw-bold">Jenis Kamar Mandi</label>
                                <select id="inputState3" class="form-select" name="kamarMandi">
                                    <option value="A" <?php if (request('kamarMandi') == 'A') {
                                        echo 'selected';
                                    } ?>>-Tidak ditentukan-</option>
                                    <option value="Luar" <?php if (request('kamarMandi') == 'Luar') {
                                        echo 'selected';
                                    } ?>>Luar</option>
                                    <option value="Dalam" <?php if (request('kamarMandi') == 'Dalam') {
                                        echo 'selected';
                                    } ?>>Dalam</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label fw-bold">Dapur Bersama</label>
                                <select id="inputState4" class="form-select" name="ringkasan">
                                    <option value="T" <?php if (request('ringkasan') == 'T') {
                                        echo 'selected';
                                    } ?>>-Tidak ditentukan-</option>
                                    <option value="Tersedia" <?php if (request('ringkasan') == 'Tersedia') {
                                        echo 'selected';
                                    } ?>>Tersedia</option>
                                    <option value="Tidak Tersedia" <?php if (request('ringkasan') == 'Tidak Tersedia') {
                                        echo 'selected';
                                    } ?>>Tidak Tersedia</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-dark">Terapkan Filter</button>
                        </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>

    @if ($kamarKosts->count() > 0)
        <div class="container">
            <div class="row">
                @foreach ($kamarKosts as $kamarKost)
                    @if ($kamarKost->jumKos > 0)
                        <div class="col-md-3 mb-3">
                            <div class="card">

                                @if ($kamarKost->imageKamar)
                                    {{-- kalau fotonya dari upload --}}
                                    <img src="{{ asset('storage/' . $kamarKost->imageKamar) }}"
                                        alt="kamar kost {{ $kamarKost->nama }}" class="img-fluid"
                                        style="height: 208px; overflow:hidden">
                                    {{-- style itu tambahan  --}}
                                @else
                                    {{-- kalau ga di upload ambil ke img --}}
                                    <img src="img/kosIlustrasi.png" class="img-fluid"
                                        style="height: 208px; overflow:hidden" alt="{{ $kamarKost->nama }}">
                                @endif


                                <div class="card-body">
                                    {{-- gender, rating, sisa kamar --}}
                                    @if ($kamarKost->gender == 'Pria')
                                        <button type="button" class="btn btn-dark btn-sm"
                                            disabled>{{ $kamarKost->gender }}</button>
                                    @elseif ($kamarKost->gender == 'Wanita')
                                        <button type="button" class="btn btn-warning btn-sm"
                                            disabled>{{ $kamarKost->gender }}</button>
                                    @else
                                        <button type="button" class="btn btn-dark btn-sm"
                                            disabled>{{ $kamarKost->gender }}</button>
                                    @endif


                                    @php
                                        $i = 0;
                                        $rataan = 0;
                                    @endphp

                                    @foreach ($ratings as $rate)
                                        @if ($rate->kamar_id == $kamarKost->id)
                                            @php
                                                $rataan = $rataan + $rate->rating;
                                                $i = $i + 1;
                                            @endphp
                                        @endif
                                    @endforeach

                                    @if ($i > 0)
                                        @php
                                            $rataan = $rataan / $i;
                                        @endphp
                                    @else
                                        @php
                                            $rataan = '-';
                                        @endphp
                                    @endif

                                    <i class="bi bi-star-fill" style="color: yellow;"></i>
                                    @if ($i == 0)
                                        {{ $rataan }}
                                    @else
                                        {{ $rataan }}({{ $i }})
                                    @endif


                                    <small>
                                        <span style="color: red"> Sisa {{ $kamarKost->jumKos }} kamar</span>
                                    </small>

                                    {{-- //Nama kamarKost --}}
                                    <h5 class="card-title">Kost {{ $kamarKost->nama }} tipe
                                        {{ $kamarKost->harga / 1000 }}
                                    </h5>



                                    {{-- //Alamat --}}
                                    <p class="mb-0">
                                        <small>
                                            Kelurahan {{ $kamarKost->kelurahan }},
                                            RT {{ $kamarKost->rt }},
                                            RW {{ $kamarKost->rw }},
                                            No.{{ $kamarKost->no }}, Jatinegara, Jakarta Timur
                                        </small>
                                    </p>


                                    {{-- area  --}}
                                    <p class="card-text fw-bold mb-0">
                                        <small>
                                            @if ($kamarKost->area == 'Bobobo')
                                                Area lainnya
                                            @else
                                                {{ $kamarKost->area }}
                                            @endif

                                            @if ($kamarKost->wifi == 'Ada')
                                                <i class="bi bi-wifi"></i>
                                            @endif
                                            @if ($kamarKost->parkir == 'Tersedia')
                                                <i class="bi bi-car-front-fill"></i>
                                            @endif
                                            @if ($kamarKost->kamarMandi == 'Dalam')
                                                <i class="bi bi-badge-wc-fill"></i>
                                            @endif
                                            @if ($kamarKost->ringkasan == 'Tersedia')
                                                <i class="bi bi-cup-hot-fill"></i>
                                            @endif
                                        </small>
                                    </p>

                                    <p class="card-text mb-1">
                                        <small>
                                            <b>{{ $kamarKost->jarak }} meter</b> radius dari kampus
                                        </small>
                                    </p>

                                    {{-- fasilitas --}}
                                    <p class="card-text">
                                        <small class="text-muted">
                                            {{ $kamarKost->fasilitasKamar }}, {{ $kamarKost->fasilitas }}
                                        </small>
                                    </p>

                                    {{-- ringkasan kamar --}}
                                    {{-- <p class="card-text">
                                        <small class="text-muted">
                                            {{ $kamarKost->ringkasanKamar }}
                                        </small>
                                    </p> --}}

                                    {{-- //Harga kamarKost --}}
                                    <h6>
                                        {{-- <a href="/posts/{{ $post->slug }}" class="text-decoration-none">{{ $post->title }}</a> --}}
                                        @if ($kamarKost->harga / 1000000 < 1)
                                            <span class="fs-2">{{ $kamarKost->harga / 1000 }}rb</span>/bln
                                        @else
                                            <span class="fs-2">{{ $kamarKost->harga / 1000000 }}jt</span>/bln
                                        @endif
                                    </h6>

                                    {{-- //Button  --}}
                                    <div class="d-md-flex justify-content-md-end mb-0">
                                        <form method="get" action="/kosts/singleKost" class="mb-0" target="_blank">
                                            @csrf
                                            <div>
                                                <input type="hidden" id="idKamar" name="idKamar"
                                                    value="{{ $kamarKost->id }}">
                                            </div>
                                            <button type="submit" class="btn btn-dark">Lihat Detail</button>
                                        </form>
                                    </div>


                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    @else
        <p class="text-center fs-4 fst-italic">~Tidak ada kamar kost yang ditemukan~</p>
    @endif

    <div class="d-flex justify-content-end">
        {{ $kamarKosts->links() }}
    </div>


    <script>
        function rangeMin() {
            var get = document.getElementById("getHargaMin").value;
            document.getElementById("putHargaMin").value = get;
        }

        function rangeMaks() {
            var get = document.getElementById("getHargaMaks").value;
            document.getElementById("putHargaMaks").value = get;
        }

        function rangeJarak() {
            var get = document.getElementById("getJarak").value;
            document.getElementById("putJarak").value = get;
        }
    </script>
@endsection
