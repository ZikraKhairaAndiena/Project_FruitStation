<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <meta http-equiv="X-UA-Compatible" content="ie=edge"> --}}
    <title>@yield('title','Sistem Informasi Admin Fruit Station')</title>

    <!-- Custom fonts for this template-->
    {{-- <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"> --}}
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet" >

    <link rel="stylesheet" href="path/to/styles.css">


    <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</head>
<body>

        <style>
            .custom-margin-right {
                margin-right: 8px; /* Atur sesuai dengan jarak yang Anda inginkan */
            }

            .btn-custom-green {
                background-color: #14b8b8;  /* Green color - more intense */
                border-color: #14b8b8;  /* Match the border with the background */
            }

            .btn-custom-green i {
                color: white;  /* Set icon color to white */
                font-size: 1.5rem;  /* Adjust icon size */
            }

            .btn-custom-green:hover {
                background-color: #004d00;  /* Slightly darker green on hover */
                border-color: #004d00;
            }

        </style>




    <div class="container-fluid">
        <div class="row">

            <!-- Sidebar -->
            <div class="col-md-2">
                @include('dashboard.layouts.sidebar')
            </div>

            <!-- Main Content -->
            <div class="col-md-10">
                <main class="px-4">
                    @include('dashboard.layouts.header')

                    <!-- Konten utama -->
                    @yield('content')
                </main>
            </div>

        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <link href="{{ asset('vendor/jquery/jquery.min.js') }}" rel="stylesheet" >
    <link href="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}" rel="stylesheet" >

    <!-- Core plugin JavaScript-->
    <link href="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}" rel="stylesheet" >

    <!-- Custom scripts for all pages-->
    <link href="{{ asset('js/sb-admin-2.min.js') }}" rel="stylesheet" >

    <!-- Page level plugins -->
    <link href="{{ asset('vendor/chart.js/Chart.min.js') }}" rel="stylesheet" >

    <!-- Page level custom scripts -->
    <link href="{{ asset('js/demo/chart-area-demo.js') }}" rel="stylesheet" >
    <link href="{{ asset('js/demo/chart-pie-demo.js') }}" rel="stylesheet" >


        <!-- Link Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">

        <!-- Link Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



</body>
</html>
