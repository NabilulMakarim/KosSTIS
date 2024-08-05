@extends('layout.main')

@section('container')
    <div class="row justify-content-center">

        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show col-md-4 text-center" role="alert">
                {{ session('success') }}
                {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
            </div>
        @endif

        @if (session()->has('loginError'))
            <div class="alert alert-danger alert-dismissible fade show col-md-4 text-center" role="alert">
                {{ session('loginError') }}
                {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
            </div>
        @endif
    </div>

    <div class="row justify-content-center">
        {{-- <div class="col-md-4"> --}}





        <div class="col-md-4">
            <div class="card">
                <h5 class="card-header text-center">Silakan Login</h5>
                <div class="card-body">
                    {{-- <main class="form-signin w-100 m-auto">
            <h1 class="h3 mb-3 fw-normal text-center">Silakan Login</h1> --}}
                    <form action="/login" method="post">
                        @csrf

                        {{-- //username  --}}
                        <div class="mb-2">
                            <label for="username" class="form-label">Username</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="username" name="username" required autofocus
                                    value="{{ old('username') }}">
                            </div>
                            {{-- @error('username')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                @enderror --}}
                        </div>

                        {{-- //Password  --}}
                        <div class="mb-2">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="password" required
                                    autofocus value="{{ old('password') }}">
                            </div>
                            {{-- @error('password')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                @enderror --}}
                        </div>
                        {{--               
              <div class="form-floating">
                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="E-mail" autofocus required value="{{ old('username') }}">
                <label for="username">Username</label>
                @error('username')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="form-floating">
                <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                <label for="password">Password</label>
              </div> --}}


                        <button class="w-100 btn btn-lg btn-primary my-3" type="submit">Login</button>
                    </form>
                    <small class="d-block mt-3 text-center">Belum memiliki akun? <a href="/register">Daftar
                            sekarang</a></small>

                    {{-- ini test --}}
                    {{-- test --}}

                    {{-- <a href="https://api.whatsapp.com/send?phone=6283159309886&text=Hallo%20Agan%20Baik" target="_blank">test</a> --}}

                    </main>
                </div>
            </div>
        </div>
    </div>
@endsection
