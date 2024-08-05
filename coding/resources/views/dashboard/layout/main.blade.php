<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('template/plugins/fontawesome-free/css/all.min.css') }}">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('template/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">

    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Select Multiple -->
    <link rel="stylesheet" href="{{ asset('template/plugins/select2/css/select2.min.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('template/dist/css/adminlte.min.css') }}">

    <!-- jsGrid -->

    {{-- <link rel="stylesheet" href="{{ asset('template/plugins/jsgrid/jsgrid.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/plugins/jsgrid/jsgrid-theme.min.css') }}"> --}}



    <!-- DataTables -->

    {{-- <link rel="stylesheet" href="{{ asset('template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}"> --}}




    {{-- J Query --}}
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>



    <!-- Custom styles for this template -->
    {{-- <link href="/css/dashboard.css" rel="stylesheet" /> --}}
    <link rel="stylesheet" href="/css/rating.css" />

    {{-- Trix Editor --}}
    <link rel="stylesheet" type="text/css" href="/css/trix.css">
    <script type="text/javascript" src="/js/trix.js"></script>

    {{-- buat leaflet --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
        integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
        integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>

    {{-- routing map with Per liedman --}}
    <link rel="stylesheet" href="/css/leaflet-routing-machine.css" />
    <script src="/js/leaflet-routing-machine.js"></script>

    <style>
        trix-toolbar [data-trix-button-group="file-tools"] {
            display: none;
        }

        #map {
            height: 500px;
        }

        #map2 {
            height: 500px;
        }
    </style>
</head>


<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- NAVBAR -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- NAVBAR KANAN - PROFIL -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <form action="/logout" method="post">
                        @csrf
                        <button type="submit" class="btn btn-outline-secondary"><i class="fas fa-sign-out-alt"></i>
                            <span class="ml-2">
                                {{ auth()->user()->nama }}, Logout
                            </span></button>
                    </form>
                </li>
            </ul>

        </nav>

        <!-- SIDEBAR -->
        @include('dashboard.layout.sidebarr')




        <!-- BAGIAN KONTEN -->
        <div class="content-wrapper">

            <!-- JUDUL KONTEN -->
            {{-- <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Sub Judul</h1>
                        </div>
                    </div>
                </div>
            </div> --}}

            <!-- RENDERING KONTEN -->
            <div class="mx-3">

                @yield('container')
            </div>



        </div>

        <!-- FOOTER -->
        <footer class="main-footer">
            <strong>KoStis &copy; 2023</strong>
            <div class="float-right d-none d-sm-inline-block">
                <b>POLITEKNIK STATISTIKA STIS</b>
            </div>
        </footer>
    </div>

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ asset('template/plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap 4 -->
    <script src="{{ asset('template/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    {{-- Boostrap core CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- SweetAlert2 -->
    <script src="{{ asset('template/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

    <!-- jsGrid -->
    <script src="{{ asset('template/plugins/jsgrid/demos/db.js') }}"></script>
    <script src="{{ asset('template/plugins/jsgrid/jsgrid.min.js') }}"></script>

    <!-- DataTables  & Plugins -->
    <script src="{{ asset('template/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('template/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('template/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('template/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <!-- AdminLTE -->
    <script src="{{ asset('template/dist/js/adminlte.js') }}"></script>

    <!-- OPTIONAL SCRIPTS -->
    <script src="{{ asset('template/plugins/chart.js') }}/Chart.min.js') }}"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('template/dist/js/demo.js') }}"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('template/dist/js/pages/dashboard3.js') }}"></script>

    <!-- jQuery Knob -->
    <script src="{{ asset('template/plugins/jquery-knob/jquery.knob.min.js') }}"></script>

    <!-- Sparkline -->
    <script src="{{ asset('template/plugins/sparklines/sparkline.js') }}"></script>

    <!-- Select Multiple -->
    <script src="{{ asset('template/plugins/select2/js/select2.full.min.js') }}"></script>





    {{-- JS DARI TEMPLATE LAMA  --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"
        integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous">
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>

    {{-- untuk chart --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script> --}}

    <script src="/js/dashboard.js"></script>


    <!-- JS MANUAL -->
    {{-- <script src="{{ asset('template/js/jsGrid.js') }}"></script>
    <script src="{{ asset('template/js/dataTable.js') }}"></script>
    <script src="{{ asset('template/js/presensi.js') }}"></script>
    <script src="{{ asset('template/js/multipleSelect.js') }}"></script>
    <script src="{{ asset('template/js/sweetAlert.js') }}"></script>
    <script src="{{ asset('template/js/keuangan.js') }}"></script>
    <script src="{{ asset('template/js/importData.js') }}"></script> --}}
</body>

</html>
