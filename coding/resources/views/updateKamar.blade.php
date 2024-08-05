@extends('layout.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Mengedit Data Kamar</h1>
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
        <h5 class="card-header">Update data kamar tipe harga {{ $kamar->harga }}</h5>
        <div class="card-body">
            <div class="col-lg-10 mx-auto mb-3">
                {{-- <div class="col-lg-8">
  <div class="pt-3 pb-2 mb-3">
    <h4 class="h4 text-center text-decoration-underline">Kamar tipe {{ $kamar->harga }}</h4>
  </div> --}}
                <form method="post" action="/ajukanUpdateKamar" class="mb-5" enctype="multipart/form-data">
                    {{-- otomatis langsung ke method store --}}
                    @method('post')
                    @csrf

                    <input type="hidden" name="kamar_id" value="{{ $kamar->id }}">
                    <input type="hidden" name="statusUpdateKamar" value=0>

                    {{-- //harga  --}}
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga Sewa Kamar Perbulan</label>
                        <div class="input-group">
                            {{-- <div class="input-group-text">Kontrakan</div> --}}
                            <input type="text" class="form-control @error('harga') is-invalid @enderror" id="harga"
                                name="harga" required autofocus value="{{ old('harga', $kamar->harga) }}">
                        </div>
                        @error('harga')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- //Ukuran kamar  --}}
                    <div class="mb-3">
                        <label for="ukuran" class="form-label">Ukuran Kamar (misal 3x3)</label>
                        <input type="text" class="form-control @error('ukuran') is-invalid @enderror" id="ukuran"
                            name="ukuran" required autofocus value="{{ old('ukuran', $kamar->ukuran) }}">
                        @error('ukuran')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- kamarMandi  --}}
                    <div class="mb-3">
                        <label for="kamarMandi" class="form-label">Jenis Kamar Mandi</label>
                        <select class="form-select" name="kamarMandi">
                            <option value="Luar" <?php if (old('kamarMandi', $kamar->kamarMandi) == 'Luar') {
                                echo 'selected';
                            } ?>>Luar</option>
                            <option value="Dalam" <?php if (old('kamarMandi', $kamar->kamarMandi) == 'Dalam') {
                                echo 'selected';
                            } ?>>Dalam</option>
                        </select>
                    </div>

                    {{-- //Durasi sewa --}}
                    <div class="mb-3">
                        <label for="durSewa" class="form-label">Durasi Sewa</label>
                        <input type="text" class="form-control @error('durSewa') is-invalid @enderror" id="durSewa"
                            name="durSewa" required autofocus value="{{ old('durSewa', $kamar->durSewa) }}">
                        @error('durSewa')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- //Fasilitas  --}}
                    <div class="mb-3">
                        <label for="fasilitasKamar" class="form-label">Fasilitas Kamar</label>
                        <input type="textarea" class="form-control @error('fasilitasKamar') is-invalid @enderror"
                            id="fasilitasKamar" name="fasilitasKamar" required autofocus
                            value="{{ old('fasilitasKamar', $kamar->fasilitasKamar) }}">
                        @error('fasilitasKamar')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- //Jumlah Kamar --}}
                    <div class="mb-3">
                        <label for="jumKam" class="form-label">Jumlah Kamar</label>
                        <input type="text" class="form-control @error('jumKam') is-invalid @enderror" id="jumKam"
                            name="jumKam" required autofocus value="{{ old('jumKam', $kamar->jumKam) }}">
                        @error('jumKam')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- //Jumlah Kosong --}}
                    <div class="mb-3">
                        <label for="jumKos" class="form-label">Jumlah Kamar Kosong</label>
                        <input type="text" class="form-control @error('jumKos') is-invalid @enderror" id="jumKos"
                            name="jumKos" required autofocus value="{{ old('jumKos', $kamar->jumKos) }}">
                        @error('jumKos')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- //Gambar  --}}
                    <div class="mb-3">
                        <label for="imageKamar" class="form-label">Gambar Kamar (optional)</label>
                        <input type="hidden" name="OldimageKamar" value="{{ $kamar->imageKamar }}">
                        @if ($kamar->imageKamar)
                            {{-- //jika gambar kamar ada di input sebelumnya --}}
                            <img src="{{ asset('storage/' . $kamar->imageKamar) }}"
                                class="img-preview img-fluid mb-3 col-sm-5 d-block" alt="{{ $kamar->imageKamar }}">
                        @else
                            <img class="img-preview img-fluid mb-3 col-sm-5">
                        @endif
                        <input class="form-control @error('imageKamar') is-invalid @enderror" type="file" id="imageKamar"
                            name="imageKamar" onchange="previewimageKamar()">
                        @error('imageKamar')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- //deskripsi --}}
                    <div class="mb-5">
                        <label for="deskripsiKamar" class="form-label">Deskripsi Kamar</label>
                        @error('deskripsiKamar')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <input id="deskripsiKamar" type="hidden" name="deskripsiKamar"
                            value="{{ old('deskripsiKamar', $kamar->deskripsiKamar) }}">
                        <trix-editor input="deskripsiKamar"></trix-editor>
                    </div>

                    <button type="submit" class="btn btn-warning">Ajukan Pembaharuan Data</button>
                </form>
                {{-- </div> --}}
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
