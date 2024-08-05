@extends('layout.main')

@section('container')
    <div class="container mt-5 d-flex justify-content-center">
        <a href="https://api.whatsapp.com/send?phone=62{{ $noHp }}&text=Selamat Pagi/Siang/Sore benar dengan kost {{ $nama }} yang beralamatkan di Kelurahan {{ $kelurahan }}, RT.{{ $rt }}, RW.{{ $rw }}, No.{{ $no }} ? %0A%0A(Selanjutnya isi sendiri dan mohon alamat kost jangan dihapus)"
            target="_blank" class="btn btn-success"><i class="bi bi-whatsapp"></i> Hubungi Pemilik </a>

    </div>
@endsection
