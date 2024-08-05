@extends('layout.main')

@section('container')
    {{-- <h1>About</h1> --}}
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">About</h1>
      </div>
    <h3>{{ $name }}</h3>
    <img src="img/{{ $image }}" alt="{{ $name }}" width="200" class="img-thumbnail rounded-circle">
@endsection
