@extends('layout.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Riwayat Chat</h1>
</div>

<div class="container">
  <div class="col-lg-12">

    {{-- <div class="card">
      <h5 class="card-header">Kost</h5>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped table-hover align-middle">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Kost</th>
                <th scope="col">Konfirmasi Transaksi</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>Kost anggrek</td>
                <td class="col-md-2">
                  <button type="button" class="btn btn-success text-dark">Berhasil</button>
                  <button type="button" class="btn btn-danger text-dark">Gagal</button>
                </td>
                <td class="col-md-2">
                  <button type="button" class="btn btn-warning">Laporkan Kost</button>
                </td>
              </tr>
              <tr>
                <th scope="row">2</th>
                <td>Kost mawar</td>
                <td class="col-md-2">
                  <button type="button" class="btn btn-success text-dark">Berhasil</button>
                  <button type="button" class="btn btn-danger text-dark">Gagal</button>
                </td>
                <td class="col-md-2">
                  <button type="button" class="btn btn-warning">Laporkan Kost</button>
                </td>
              </tr>
              {{-- <tr>
                <th scope="row">3</th>
                <td colspan="2">Larry the Bird</td>
                <td>@twitter</td>
              </tr> --}}
            {{-- </tbody>
          </table>
        </div>
      </div>
    </div> --}}



    <div class="col-lg-8 m-auto">
      <form method="post" action="/dashboard/kosts" class="mb-5"> 
        {{--otomatis langsung ke method store --}}
         @csrf
 
       {{-- //kelurahan  --}}
       <div class="mb-3">
         <label for="kelurahan" class="form-label">Kelurahan</label>
         <select class="form-select" name="kelurahan">
           <option value="Bidara Cina" 
           <?php if (old('kelurahan') == "Bidara Cina") echo "selected";?>
           >Bidara Cina</option>
           <option value="Cipinang Cempedak" 
           <?php if (old('kelurahan') == "Cipinang Cempedak") echo "selected";?>
           >Cipinang Cempedak</option>
         </select>
       </div>
 
 
       {{-- //rt  --}}
       <div class="mb-3">
         <label for="rt" class="form-label">RT</label>
         <input type="text" class="form-control @error('rt') is-invalid @enderror" id="rt" name="rt" required autofocus value="{{ old('rt') }}">
         @error('rt')
             <div class="invalid-feedback">
               {{ $message }}
             </div>
         @enderror
       </div>
 
       {{-- //rw  --}}
       <div class="mb-3">
         <label for="rw" class="form-label">RW</label>
         <input type="text" class="form-control @error('rw') is-invalid @enderror" id="rw" name="rw" required autofocus value="{{ old('rw') }}">
         @error('rw')
             <div class="invalid-feedback">
               {{ $message }}
             </div>
         @enderror
       </div>
 
       {{-- //Nomor rumah  --}}
       <div class="mb-3">
         <label for="no" class="form-label">No.</label>
         <input type="text" class="form-control @error('no') is-invalid @enderror" id="no" name="no" required autofocus value="{{ old('no') }}">
         @error('no')
             <div class="invalid-feedback">
               {{ $message }}
             </div>
         @enderror
       </div>

       {{-- //harga  --}}
      <div class="mb-3">
        <label for="harga" class="form-label">Harga perbulan (misal: 800000)</label>
        <input type="text" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" required autofocus value="{{ old('harga') }}">
        @error('harga')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
        @enderror
      </div>
 
       <button type="submit" class="btn btn-primary">Cari Kost/Kontrakan Untuk Konfirmasi</button>
     </form>
 </div>

  </div>
</div>

@endsection



{{-- habis di sini --}}

@section('container')
<div>
  Polstat STIS
  <input id="titik_a" type="text">
  Kost/Kontrakan
  <input id="titik_b" type="text">
  Jalan
  <input id="jalan" type="text">
</div>
<div>
  Latitude
  <input id="latitude" name="latitude" type="text">
  Longitude
  <input id="longitude" name="longitude" type="text">
</div>

<div id="map"></div>

            <script>

              //menampilkan map
                var map = L.map('map').setView([-6.231531614034552,106.86686413870501], 18);

                L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', 
                {
                    maxZoom: 19,
                    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                }).addTo(map);

                //get coordinat location
                // var latInput = document.querySelector("[name=latitude]");
                // var lngInput = document.querySelector("[name=longitude]");

                // var curLocation = [-6.231953128043216,106.86546358928535];

                // map.attributionControl.setPrefix(false);

                // var marker = new L.marker(curLocation, {
                //   draggable : 'true',
                // });

                // marker.on('dragend', function(event) {
                //   var position = marker.getLatLng();
                //   marker.setLatLng(position, {
                //     draggable: 'true',
                //   }).bindPopup(position).update();

                //   $("#latitude").val(position.lat);
                //   $("#longitude").val(position.lng);
               
                // });
                // map.addLayer(marker);

            
                // Route Per Liedman
              var routeControl = L.Routing.control({
                  waypoints: [
                    L.latLng(-6.231531614034552, 106.86686413870501),
                    L.latLng(-6.231953128043216,106.86546358928535)
                  ],
                }).addTo(map);
            

              routeControl.on('routesfound', function(e) {
                
                console.log(e.routes[0]);

                var distance = e.routes[0].summary.totalDistance;
                var time = e.routes[0].summary.totalTime;

                document.getElementById("titik_a").value = e.routes[0].waypoints[0].latLng.lat +' ... '+ e.routes[0].waypoints[0].latLng.lng;
                document.getElementById("titik_b").value = e.routes[0].waypoints[1].latLng.lat +' ... '+ e.routes[0].waypoints[1].latLng.lng;
                document.getElementById("jalan").value = e.routes[0].name;
              });

            </script>


<div class="table-responsive col-lg-8">
  {{-- <a href="/dashboard/posts/create" class="btn btn-primary mb-3">Create new post</a> --}}
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Waktu</th>
          <th scope="col">Nama Kost/Kontrakan</th>
          <th scope="col">Gambar</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        {{-- @foreach ($posts as $post)
            
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $post->title }}</td>
          <td>{{ $post->category->name }}</td>
          <td>
            <a href="/dashboard/posts/{{ $post->slug }}" class="badge bg-info"><span data-feather="eye" ></span></a>
            <a href="/dashboard/posts/{{ $post->slug }}/edit" class="badge bg-warning"><span data-feather="edit" ></span></a>
            <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="d-inline">
              @method('delete')
              @csrf
              <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><span data-feather="x-circle" ></span></button>
            </form>
          </td>
        </tr>
        @endforeach --}}
 
      </tbody>
    </table>
  </div>


@endsection

@section('container')
<h1 class="mb-5">Riwayat Chat</h1>
    
    <div class="container">
        <div class="row">
            @foreach ($categories as $category)
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
            @endforeach
        </div>
    </div>

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