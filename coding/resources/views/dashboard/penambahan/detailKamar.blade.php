@extends('dashboard.layout.main')

@section('container')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Pengajuan Penambahan Data Kamar Tipe {{ $kamar->harga / 1000 }} Pada Kost {{ $kost->nama }}</h2>
                <h6>Oleh : {{ $user->nama }}, {{ $user->nim }}</h6>


                <a href="/dashboard/penambahan" class="btn btn-success"><i class="fas fa-chevron-circle-left"></i> Kembali</a>

                {{-- <a href="/dashboard/kamars/{{ $post->slug }}/edit" class="btn btn-warning"><span data-feather="edit"></span> Edit</a>

      <form action="/dashboard/kamars/{{ $post->slug }}" method="post" class="d-inline"> --}}


                <div class="mb-3">
                    @if ($kamar->imageKamar)
                        <div>
                            <img src="{{ asset('storage/' . $kamar->imageKamar) }}" alt="{{ $kamar->nama }}"
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


                {{-- //harga  --}}
                <div class="mb-3">
                    <label for="harga" class="form-label fw-bold">Harga perbulan (misal: 800000)</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('harga') is-invalid @enderror" id="harga"
                            name="harga" disable readonly required value="{{ old('harga', $kamar->harga) }}">
                        <div class="input-group-text">/bulan</div>
                    </div>
                </div>

                {{-- //ukuran  --}}
                <div class="mb-3">
                    <label for="ukuran" class="form-label fw-bold">Ukuran Kamar (misal 3x3)</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('ukuran') is-invalid @enderror" id="ukuran"
                            name="ukuran" disable readonly required value="{{ old('ukuran', $kamar->ukuran) }}">
                    </div>
                </div>

                {{-- //kamarMandi  --}}
                <div class="mb-3">
                    <label for="kamarMandi" class="form-label fw-bold">Jenis Kamar Mandi</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="kamarMandi" name="kamarMandi" disable readonly
                            required value="{{ $kamar->kamarMandi }}">
                    </div>
                </div>

                {{-- //Jumlah Kamar  --}}
                <div class="mb-3">
                    <label for="jumKam" class="form-label fw-bold">Jumlah Kamar</label>
                    <input type="text" class="form-control @error('jumKam') is-invalid @enderror" id="jumKam"
                        name="jumKam" disable readonly required value="{{ old('jumKam', $kamar->jumKam) }}">
                </div>

                {{-- //Jumlah Kosog  --}}
                <div class="mb-3">
                    <label for="jumKos" class="form-label fw-bold">Jumlah Kamar Kosong</label>
                    <input type="text" class="form-control @error('jumKos') is-invalid @enderror" id="jumKos"
                        name="jumKos" disable readonly required value="{{ old('jumKos', $kamar->jumKos) }}">
                </div>


                {{-- //durasi Dewa  --}}
                <div class="mb-3">
                    <label for="durSewa" class="form-label fw-bold">Durasi Sewa (dalam bulan)</label>
                    <input type="text" class="form-control @error('durSewa') is-invalid @enderror" id="durSewa"
                        name="durSewa" disable readonly required value="{{ old('durSewa', $kamar->durSewa) }}">
                </div>

                {{-- //Fasilitas  --}}
                <div class="mb-3">
                    <label for="fasilitasKamar" class="form-label fw-bold">fasilitas Kamar</label>
                    <input type="textarea" class="form-control @error('fasilitasKamar') is-invalid @enderror"
                        id="fasilitasKamar" name="fasilitasKamar" disable readonly required
                        value="{{ old('fasilitasKamar', $kamar->fasilitasKamar) }}">
                </div>


                {{-- //deskripsi  --}}
                <div class="mb-3">
                    <label for="deskripsiKamar" class="form-label fw-bold">Deskripsi kamar</label>
                    <div class="card">
                        <div class="card-body" style="background-color: #E9ECEF">
                            {!! $kamar->deskripsiKamar !!}
                        </div>
                    </div>
                </div>

                {{-- <button type="submit" class="btn btn-primary">Ajukan Pembaharuan Data</button> --}}
                </form>

                <div class="d-flex justify-content-evenly mb-5">
                    <div class=" my-5">
                        <h5>
                            <button class="btn btn-primary border-0" data-toggle="modal" data-target="#terima"><i
                                    class="fas fa-check-circle"></i></span> Terima Penambahan Kamar</button>
                        </h5>
                    </div>

                    <div class=" my-5">
                        <h5>
                            <button class="btn btn-danger text-dark border-0" data-toggle="modal" data-target="#tolak"><i
                                    class="fas fa-ban"></i> Tolak Penambahan Kamar</button>
                        </h5>
                    </div>

                    <div class=" my-5">
                        <a href="https://api.whatsapp.com/send?phone=62{{ $user->noHp }}&text=Selamat Pagi/Siang/Sore, benar dengan kak {{ $user->nama }}. Perkenalkan Saya Pengelola Web Kamaris ingin bertanya tentang data kamar dengan harga {{ $kamar->harga }} pada kamar {{ $kamar->nama }} yang sudah Kakak ajukan beberapa waktu yang lalu %0A%0A(Selanjutnya isi sendiri)"
                            target="_blank">
                            <h5>
                                <button class="btn btn-success text-dark border-0"><i class="fab fa-whatsapp"></i> Hubungi
                                    Pengaju Data</button>
                            </h5>
                        </a>
                    </div>

                    <div class=" my-5">
                        <a href="/dashboard/penambahanKamar/edit/{{ $kamar->id }}">
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
                    Apakah Anda yakin <b>menerima</b> permintaan penambahan data kamar ini ?
                </div>
                <div class="modal-footer">
                    <form action="/dashboard/terimaKamar/{{ $kamar->id }}" method="post" class="d-inline">
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
                    Apakah Anda yakin <b>menolak</b> permintaan penambahan data kamar ini ?
                </div>
                <div class="modal-footer">
                    <form action="/dashboard/tolakKamar/{{ $kamar->id }}" method="post" class="d-inline">
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
