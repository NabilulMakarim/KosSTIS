{{-- @if (auth()->user()->is_admin == !0)
    <div>
        <a href="/dashboard">Menuju dashboard</a>
    </div>
@else --}}



@extends('layout.main')

@section('container')
    <div class="pricing-header p-0 pb-md-0 mx-auto text-center">
        <h1 class="display-4 fw-normal">KoStis</h1>
        <p class="fs-5 text-muted">Cari Kost dan Kontrakan di sekitar STIS lebih mudah dengan KoStis.</p>
        <p class="fs-5 text-muted">Bantu tambah dan perbaharui data demi informasi yang lebih <i>up-to-date</i>.</p>
        <p class="fs-5 text-muted">Jangan lupa pula untuk melakukan konfirmasi pada menu konfirmasi jika telah selesai
            bertransaksi dengan pemilik kost atau kontrakan.</p>
    </div>
    <main>
        <div class="row row-cols-1 row-cols-md-4 mb-3 text-center">
            <div class="col mb-3">
                <div class="card mb-0 rounded-3 shadow-sm">
                    <div class="card-header py-3">
                        <h4 class="my-0 fw-normal">Cari Kost</h4>
                    </div>
                    <div class="card-body">

                        <img src="img/kos.png" class="card-img img-fluid mx-auto d-block mb-3"
                            style="max-height: 160px;  overflow:hidden" alt="Cari Kost">
                        <a href="/kosts">
                            <button type="button" class="w-100 btn btn-lg btn-outline-secondary">Menu Kost</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col mb-3">
                <div class="card mb-0 rounded-3 shadow-sm">
                    <div class="card-header py-3">
                        <h4 class="my-0 fw-normal">Cari Kontrakan</h4>
                    </div>
                    <div class="card-body">
                        <img src="img/kontrakan.png" class="card-img img-fluid mx-auto d-block mb-3"
                            style="max-height: 160px;  overflow:hidden" alt="Cari Kost">
                        <a href="/kontrakans">
                            <button type="button" class="w-100 btn btn-lg btn-outline-secondary">Menu Kontrakan</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col mb-3">
                <div class="card mb-0 rounded-3 shadow-sm">
                    <div class="card-header py-3">
                        <h4 class="my-0 fw-normal">Konfirmasi</h4>
                    </div>
                    <div class="card-body">
                        <img src="img/konfirmasi.png" class="card-img img-fluid mx-auto d-block mb-3"
                            style="height: 153px;  overflow:hidden" alt="Cari Kost">
                        <a href="/konfirmasi">
                            <button type="button" class="w-100 btn btn-lg btn-outline-secondary">Konfirmasi</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col mb-3">
                <div class="card mb-0 rounded-3 shadow-sm">
                    <div class="card-header py-3">
                        <h4 class="my-0 fw-normal">Hubungi Admin</h4>
                    </div>
                    <div class="card-body">
                        <h2 class="card-title pricing-card-title"><i class="bi bi-info-circle"></i></h2>
                        <ul class="list-unstyled mt-3">
                            <li>Ada pertanyaan ?</li>
                            <li>Memiliki saran ?</li>
                            <li style="margin-bottom: 44px">Memberikan keluhan ?</li>
                            {{-- <li>Help center access</li> --}}
                        </ul>
                        <a href="https://api.whatsapp.com/send?phone=62{{ $admin->noHp }}&text=Selamat Pagi/Siang/Sore, benar admin KoStis ? %0A%0A(Selanjutnya isi sendiri tentang pertanyaan, saran, atau keluhannya)"
                            target="_blank">
                            <button type="button" class="w-100 btn btn-lg btn-outline-secondary"><i
                                    class="bi bi-whatsapp"></i> Hubungi Admin</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </main>

    {{-- 

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0"
                                class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                                aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                                aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="https://source.unsplash.com/800x500?Bedroom" class="d-block w-100" alt="..."
                                    style="height: 500px; overflow:hidden">
                                <div class="carousel-caption d-none d-md-block" style="background-color: black">
                                    <h5>First slide label</h5>
                                    <p>Some representative placeholder content for the first slide.</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="https://source.unsplash.com/800x500?Bedroom" class="d-block w-100" alt=""
                                    style="height: 500px; overflow:hidden">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Second slide label</h5>
                                    <p>Some representative placeholder content for the second slide.</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="https://source.unsplash.com/800x500?House" class="d-block w-100" alt=""
                                    style="height: 500px; overflow:hidden">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Third slide label</h5>
                                    <p>Some representative placeholder content for the third slide.</p>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div> --}}
@endsection


{{-- @endif --}}
