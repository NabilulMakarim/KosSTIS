{{-- @if (auth()->user()->is_admin == !0)
    <div>
        <a href="/dashboard">Menuju dashboard</a>
    </div>
@else --}}



@extends('layout.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Selamat Datang di Web KoKo STIS</h1>
    </div>
    {{-- <h1 class="mb-5 text-center"></h1> --}}

    <div class="container mb-3">
        <div class="row">


            {{-- <div id="map"></div>

            <script>
                var map = L.map('map').setView([51.505, -0.09], 13);
                L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', 
                {
                    maxZoom: 19,
                    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                }).addTo(map);
            </script> --}}
            <div class="col-md-4 mb-4">
                <a href="/kosts">
                    <div class="card text-bg-dark">
                        <img src="https://source.unsplash.com/500x500?Bedroom" class="card-img img-fluid mx-auto d-block"
                            alt="Cari Kost">
                        <div class="card-img-overlay d-flex align-items-center p-0">
                            <h5 class="text-white card-title text-center flex-fill p-4 fs-3"
                                style="background-color: rgba(0, 0, 0.7)"> Cari Kost</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="/kontrakans">
                    <div class="card text-bg-dark">
                        <img src="https://source.unsplash.com/500x500?House" class="card-img" alt="Cari Kontrakan">
                        <div class="card-img-overlay d-flex align-items-center p-0">
                            <h5 class="text-white card-title text-center flex-fill p-4 fs-3"
                                style="background-color: rgba(0, 0, 0.7)"> Cari Kontrakan</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="/konfirmasi">
                    <div class="card text-bg-dark">
                        <img src="https://source.unsplash.com/500x500?Car" class="card-img" alt="Konfirmasi Kost/Kontrakan">
                        <div class="card-img-overlay d-flex align-items-center p-0">
                            <h5 class="text-white card-title text-center flex-fill p-4 fs-3"
                                style="background-color: rgba(0, 0, 0.7)"> Konfirmasi Kost/Kontrakan</h5>
                        </div>
                    </div>
                </a>
            </div>

            {{-- @foreach ($categories as $category)
                <div class="col-md-4">
                    <a href="/blog?category={{ $category->slug }}">
                    <div class="card text-bg-dark">
                        <img src="https://source.unsplash.com/500x500?{{ $category->name }}" class="card-img" alt="{{ $category->name }}">
                        <div class="card-img-overlay d-flex align-items-center p-0">
                        <h5 class="text-white card-title text-center flex-fill p-4 fs-3" style="background-color: rgba(0, 0, 0.7)"> {{ $category->name }}</h5>
                        </div>
                    </div>
                    </a>
                </div>
            @endforeach --}}
        </div>
    </div>

    <div class="position-relative">
        <div class="ms-auto  p-2 bd-highlight col-md-4 position-absolute top-100 start-100 translate-middle">
            <a href="https://api.whatsapp.com/send?phone=6283159309886&text=Selamat Pagi/Siang/Sore Admin, Saya menghubungi lewat web KoStis "
                target="_blank" class="btn btn-success"><i class="bi bi-whatsapp"></i> Hubungi Admin </a>
        </div>
    </div>
    </div>
    {{-- 
    <div class="position-relative">
        <button type="button" class="position-absolute top-100 start-100 translate-middle btn btn-succes"><i class="bi bi-whatsapp" style="background-color: rgb(85, 236, 97)">Admin</i></button>
        <div class="position-absolute top-100 start-100 translate-middle btn btn-succes"></div>
      </div> --}}

    {{-- @foreach ($categories as $category)

<ul>
    <li>
        <h2>
            <a href="/categories/{{ $category->slug }}">{{ $category->name }}</a>
        </h2>
    </li>
</ul>
@endforeach --}}
@endsection


{{-- @endif --}}
