@extends('layout.main')

@section('container')
    <div class="row justify-content-center">
        {{-- <div class="col-lg-4"> --}}
        {{-- <main class="form-registration w-100 m-auto justify-content-center"> --}}
        <div class="col-md-5">
            <div class="card">
                <h5 class="card-header">Form Pendaftaran</h5>
                <div class="card-body">

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- <h1 class="mb-2 fw-normal text-center">Form Pendaftaran</h1> --}}
                    <form action="/register" method="post">
                        {{-- langsung ke RegisterControler --}}
                        @csrf
                        {{-- //nama  --}}
                        <div class="mb-2">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <div class="input-group">
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    id="nama" name="nama" required autofocus value="{{ old('nama') }}">
                            </div>
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="row">
                            {{-- //nim  --}}
                            <div class="mb-2 col-md-6">
                                <label for="nim" class="form-label">NIM<span class="small" style="color: red">
                                        (-) bila tidak memiliki
                                    </span></label>
                                <input type="text" class="form-control @error('nim') is-invalid @enderror" id="nim"
                                    name="nim" required autofocus value="{{ old('nim') }}">
                                @error('nim')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- //noHp  --}}
                            <div class="mb-2  col-md-6">
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
                        </div>


                        {{-- //email  --}}
                        <div class="mb-2">
                            <label for="email" class="form-label">E-mail</label>
                            <div class="input-group">
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" required autofocus value="{{ old('email') }}">
                            </div>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- //username  --}}
                        <div class="mb-2">
                            <label for="username" class="form-label">Username</label>
                            <div class="input-group">
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                    id="username" name="username" required autofocus value="{{ old('username') }}">
                            </div>
                            @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- //Password  --}}
                        <div class="mb-2">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" required autofocus value="{{ old('password') }}">
                            </div>
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- <div class="form-floating">
                    <label for="name">Username</label>
                    <input type="text" name="nama" class="form-control rounded-top @error('nama') is-invalid @enderror" id="nama" placeholder="nama" autofocus required value="{{ old('nama') }}">
                    <label for="nama">Nama Lengkap</label>
                    @error('nama')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                  </div>
                  <div class="form-floating">
                    <input type="text" name="username" class="form-control  @error('username') is-invalid @enderror" id="username" placeholder="Username" required value="{{ old('username') }}">
                    <label for="username">Username</label>
                    @error('username')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                  </div>
                  <div class="form-floating">
                    <input type="email" name="email" class="form-control  @error('email') is-invalid @enderror" id="email" placeholder="email" required value="{{ old('email') }}">
                    <label for="email">Email</label>
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                  </div>
                  <div class="form-floating">
                    <div class="input-group">
                      <input type="text" name="noHp" class="form-control  @error('noHp') is-invalid @enderror" id="noHp" placeholder="noHp" required value="{{ old('noHp') }}">
                      <label for="noHp">Nomor Handphone</label>
                    </div>
                    @error('noHp')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                  </div>
                  <div class="form-floating">
                    <input type="password" name="password" class="form-control rounded-bottom  @error('password') is-invalid @enderror" id="password" placeholder="password" required>
                    <label for="password">Password</label>
                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror</div> --}}



                        <button class="w-100 btn btn-lg btn-primary mt-2" type="submit">Daftar</button>
                    </form>

                    <small class="d-block mt-2 text-center">Sudah memiliki akun? <a href="/login">Login</a></small>

                    {{-- </main> --}}
                </div>
            </div>
        </div>
        {{-- </div>    --}}
    </div>
@endsection
