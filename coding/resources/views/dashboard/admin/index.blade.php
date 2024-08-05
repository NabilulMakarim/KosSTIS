@extends('dashboard.layout.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Ubah Data Admin</h1>
    </div>

    <div class="row justify-content-center">
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show col-md-5 text-center" role="alert">
                {{ session('success') }}
                {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
            </div>
        @endif
        @if (session()->has('failed'))
            <div class="alert alert-danger alert-dismissible fade show col-md-5 text-center" role="alert">
                {{ session('failed') }}
                {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
            </div>
        @endif
    </div>

    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <form action="/dashboard/perbaharuiAdmin" method="post">
                        @csrf
                        {{-- //Password Lama  --}}
                        <div class="mb-2">
                            <label for="passwordLama" class="form-label">Password Lama</label>
                            <div class="input-group">
                                <input type="password" class="form-control @error('passwordLama') is-invalid @enderror"
                                    id="passwordLama" name="passwordLama" required autofocus
                                    value="{{ old('passwordLama') }}">
                            </div>
                            @error('passwordLama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- //Password Baru  --}}
                        <div class="mb-2">
                            <label for="passwordBaru" class="form-label">Password Baru</label>
                            <div class="input-group">
                                <input type="password" class="form-control @error('passwordBaru') is-invalid @enderror"
                                    id="passwordBaru" name="passwordBaru" required autofocus
                                    value="{{ old('passwordBaru') }}">
                            </div>
                            @error('passwordBaru')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- //noHp  --}}
                        <div class="mb-2">
                            <label for="noHp" class="form-label">Nomor Handphone</label>

                            <div class="input-group">
                                <div class="input-group-text">+62</div>
                                <input type="text" class="form-control @error('noHp') is-invalid @enderror"
                                    id="noHp" name="noHp" required autofocus
                                    value="{{ old('noHp', $admin->noHp) }}">
                            </div>
                            @error('noHp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button class="w-100 btn btn-lg btn-primary mt-2" type="submit">Perbaharui Data Admin</button>
                        <p>
                            <span class="small" style="color: red">
                                *Bila hanya ingin mengubah No. Handphone, isikan password lama dan password baru dengan
                                isian yang sama dan sesuai
                            </span>
                        </p>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
