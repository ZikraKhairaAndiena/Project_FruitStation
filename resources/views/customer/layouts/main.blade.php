<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <meta http-equiv="X-UA-Compatible" content="ie=edge"> --}}
    <title>@yield('title','Fruit Station')</title>

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet" >
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet" >

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" >

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" >

</head>
<body class="d-flex flex-column h-100">
    @include('customer.layouts.header')

<!-- Begin page content -->
<main class="flex-shrink-0">
    <div class="container">
      @yield('content')
    </div>
</main>

@include('customer.layouts.footer')

<!-- yang baru -->
<!-- JavaScript Libraries -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"></script>
<link href="{{ asset('lib/easing/easing.min.js') }}" rel="stylesheet" >
<link href="{{ asset('lib/waypoints/waypoints.min.js') }}" rel="stylesheet" >
<link href="{{ asset('lib/lightbox/js/lightbox.min.js') }}" rel="stylesheet" >
<link href="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}" rel="stylesheet" >

<!-- Template Javascript -->
<link href="{{ asset('js/main.js') }}" rel="stylesheet" >
<style>
    .button-group .btn {
        margin-right: 5px;
    }

    .button-group .btn:last-child {
        margin-right: 0;
    }


    .rating-stars {
        display: flex;
        align-items: center;
    }
    .rating-stars .fa-star {
        font-size: 14px;
        margin-right: 2px; /* Adjust the margin as needed */
    }
</style>


</body>
</html>
