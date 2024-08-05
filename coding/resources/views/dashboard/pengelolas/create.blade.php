@extends('dashboard.layout.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Menambahkan Akun Pengelola Baru</h1>
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

    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <form action="/dashboard/pengelolas" method="post">
                        @csrf
                        <input type="hidden" id="statusPengajuan" name="statusPengajuan" value=0>
                        {{-- <input type="hidden" id="status" name="status" value=1> --}}

                        {{-- //nama  --}}
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Pengelola</label>
                            <div class="input-group">
                                {{-- <div class="input-group-text">Kontrakan</div> --}}
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    id="nama" name="nama" required autofocus value="{{ old('nama') }}">
                            </div>
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- //email  --}}
                        <div class="mb-3">
                            <label for="email" class="form-label">email</label>
                            <div class="input-group">
                                {{-- <div class="input-group-text">Kontrakan</div> --}}
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" required autofocus value="{{ old('email') }}">
                            </div>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- //Username  --}}
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <div class="input-group">
                                {{-- <div class="input-group-text">Kontrakan</div> --}}
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                    id="username" name="username" required autofocus value="{{ old('username') }}">
                            </div>
                            @error('username')
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
                                    id="noHp" name="noHp" required autofocus value="{{ old('noHp') }}">
                            </div>
                            @error('noHp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>




                        {{-- //password  --}}
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                {{-- <div class="input-group-text">Kontrakan</div> --}}
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" required autofocus value="{{ old('password') }}">
                            </div>
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Buat Akun Pengelola</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
