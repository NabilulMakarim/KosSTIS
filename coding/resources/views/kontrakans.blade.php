@extends('layout.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Kontrakan</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show col-lg-12" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row d-flex align-items-start">
        <div class="col-md-6">
            <form action="/kontrakans" method="get">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Cari berdasarkan nama kontrakan..."
                        name="search" value="{{ request('search') }}">
                    <button class="btn btn-dark" type="submit">Search</button>
                </div>
            </form>
        </div>

        <div class="col-md-4 mb-3">
            <a href="/kontrakans/tambahUpdateKontrakan" class="btn btn-dark">Tambah atau Update Data Kontrakan</a>
        </div>
    </div>


    {{-- // Pencarian  --}}

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
                            <form method="get" action="/kontrakans" class="mb-5 row g-3">
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

                                <div class="row"></div>
                                <div class="col-lg-5">
                                    <label for="hargaMin" class="form-label fw-bold">Harga Minimal</label>
                                    <input type="range" class="form-range" min="1000000" max="5000000" step="500000"
                                        name="hargaMin" id="getHargaMin" onchange="rangeMin()" value="<?php if (request('hargaMin') == 0) {
                                            echo '1000000';
                                        } else {
                                            echo request('hargaMin');
                                        } ?>">
                                </div>

                                <div class="col-lg-1">
                                    <label for="putHargaMin" class="form-label fw-bold"></label>
                                    <input class="col-lg-12" type="text" id="putHargaMin"
                                        placeholder="<?php if (request('hargaMin') == 0) {
                                            echo '1000000';
                                        } else {
                                            echo request('hargaMin');
                                        } ?>">
                                </div>


                                <div class="col-lg-5">
                                    <label for="customRange3" class="form-label fw-bold">Harga Maksimal</label>
                                    <input type="range" class="form-range" min="1000000" max="5000000" step="500000"
                                        name="hargaMaks" id="getHargaMaks" onchange="rangeMaks()"
                                        value="<?php if (request('hargaMaks') == 0) {
                                            echo '5000000';
                                        } else {
                                            echo request('hargaMaks');
                                        } ?>">
                                </div>

                                <div class="col-lg-1">
                                    <label for="customRange3" class="form-label fw-bold"></label>
                                    <input class="col-lg-12" type="text" id="putHargaMaks"
                                        placeholder="<?php if (request('hargaMaks') == 0) {
                                            echo '5000000';
                                        } else {
                                            echo request('hargaMaks');
                                        } ?>">
                                </div>
                        </div>

                        {{-- Jarak kost ke kampus  --}}
                        {{-- <div class="row">
                            <div class="col-lg-5">
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
                            </div>
                        </div> --}}

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
                                <select id="inputState" class="form-select" name="parkir">
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
                                <label class="form-label fw-bold">Listrik</label>
                                <select id="inputState" class="form-select" name="listrik">
                                    <option value="T" <?php if (request('listrik') == 'T') {
                                        echo 'selected';
                                    } ?>>-Tidak ditentukan-</option>
                                    <option value="Sudah Termasuk" <?php if (request('listrik') == 'Sudah Termasuk') {
                                        echo 'selected';
                                    } ?>>Sudah Termasuk</option>
                                    <option value="Belum Termasuk" <?php if (request('listrik') == 'Belum Termasuk') {
                                        echo 'selected';
                                    } ?>>Belum Termasuk</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label fw-bold">Dapur</label>
                                <select id="inputState" class="form-select" name="ringkasan">
                                    <option value="" <?php if (request('ringkasan') == '') {
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


    @if ($kontrakans->count() > 0)
        <div class="container">
            <div class="row">
                @foreach ($kontrakans as $kontrakan)
                    @if ($kontrakan->status == 1)
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                @if ($kontrakan->image)
                                    {{-- kalau fotonya dari upload --}}
                                    <img src="{{ asset('storage/' . $kontrakan->image) }}"
                                        alt="kontrakan {{ $kontrakan->nama }}" class="img-fluid">
                                @else
                                    {{-- kalau ga di upload --}} <img src="img/kontrakanIlustrasi.png" class="img-fluid"
                                        style="height: 208px; overflow:hidden" alt="{{ $kontrakan->nama }}">
                                @endif


                                @php
                                    $i = 0;
                                    $rataan = 0;
                                @endphp

                                @foreach ($ratings as $rate)
                                    @if ($rate->kontrakan_id == $kontrakan->id)
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



                                <div class="card-body">

                                    <i class="bi bi-star-fill" style="color: yellow;"></i>
                                    @if ($i == 0)
                                        {{ $rataan }}
                                    @else
                                        {{ $rataan }}({{ $i }})
                                    @endif

                                    {{-- //Nama kontrakan --}}
                                    <h5 class="card-title">Kontrakan {{ $kontrakan->nama }}</h5>

                                    {{-- //Alamat --}}
                                    <p class="mb-0">
                                        <small>
                                            Kelurahan {{ $kontrakan->kelurahan }},
                                            RT {{ $kontrakan->rt }},
                                            RW {{ $kontrakan->rw }},
                                            No.{{ $kontrakan->no }}, Jatinegara, Jakarta Timur
                                        </small>
                                    </p>

                                    {{-- area  --}}
                                    <p class="card-text fw-bold mb-0">
                                        <small>
                                            @if ($kontrakan->area == 'Bobobo')
                                                Area lainnya
                                            @else
                                                {{ $kontrakan->area }}
                                            @endif

                                            @if ($kontrakan->wifi == 'Ada')
                                                <i class="bi bi-wifi"></i>
                                            @endif
                                            @if ($kontrakan->parkir == 'Tersedia')
                                                <i class="bi bi-car-front-fill"></i>
                                            @endif
                                            @if ($kontrakan->listrik == 'Sudah Termasuk')
                                                <i class="bi bi-lightning-fill"></i>
                                            @endif
                                            @if ($kontrakan->parkir == 'Tersedia')
                                                <i class="bi bi-cup-hot-fill"></i>
                                            @endif
                                        </small>
                                    </p>
                                    <p class="card-text mb-1">
                                        <small>
                                            <b>{{ $kontrakan->jarak }} meter</b> radius dari kampus
                                        </small>
                                    </p>

                                    {{-- fasilitas --}}
                                    <p class="card-text">
                                        <small class="text-muted">
                                            {{ $kontrakan->fasilitas }}
                                        </small>
                                    </p>

                                    {{-- ringkasan kamar --}}
                                    {{-- <p class="card-text">
                                        <small class="text-muted">
                                            {{ $kontrakan->ringkasan }}
                                        </small>
                                    </p> --}}


                                    {{-- //Harga kontrakan --}}
                                    <h6>
                                        @if ($kontrakan->harga / 1000000 < 1)
                                            <span class="fs-2">{{ $kontrakan->harga / 1000 }}rb</span>/bln
                                        @else
                                            <span class="fs-2">{{ $kontrakan->harga / 1000000 }}jt</span>/bln
                                        @endif
                                        </h5>

                                        {{-- //Button  --}}
                                        <div class="d-md-flex justify-content-md-end mb-0">
                                            <a href="/kontrakans/{{ $kontrakan->id }}" class="btn btn-dark text-end"
                                                target="_blank">Lihat Detail</a>
                                        </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    @else
        <p class="text-center fs-4">Tidak ada kontrakan yang ditemukan</p>
    @endif

    {{-- Kontrakans pakai s karena yang diambil adalah data banyak kontrakan yang dibuat sebagai pagination  --}}
    <div class="d-flex justify-content-end">
        {{ $kontrakans->links() }}
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
