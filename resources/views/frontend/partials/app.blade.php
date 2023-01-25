<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>News | {{isset($title) ? $title : ''}}</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('frontend') }}/img/favicon.png" rel="icon">
  <link href="{{ asset('frontend') }}/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
  
    <!-- Vendor CSS Files -->
    <link href="{{ asset('frontend') }}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ asset('frontend') }}/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="{{ asset('frontend') }}/vendor/aos/aos.css" rel="stylesheet">
  <link href="{{ asset('frontend') }}/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="{{ asset('frontend') }}/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="{{ asset('frontend') }}/vendor/remixicon/remixicon.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('frontend') }}/css/main.css" rel="stylesheet">
  @stack('css')
</head>

<body class="page-index">

  @include('frontend.partials.layouts.navbar')
  @yield('content')
  @include('frontend.partials.layouts.footer')

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset('frontend') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('frontend') }}/vendor/aos/aos.js"></script>
  <script src="{{ asset('frontend') }}/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="{{ asset('frontend') }}/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="{{ asset('frontend') }}/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="{{ asset('frontend') }}/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('frontend') }}/js/main.js"></script>
  @stack('js')

</body>

</html>