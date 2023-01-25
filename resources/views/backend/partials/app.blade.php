<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Administrator | {{isset($title) ? $title : ''}}</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('backend') }}/vendors/feather/feather.css">
  <link rel="stylesheet" href="{{ asset('backend') }}/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="{{ asset('backend') }}/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  @stack('pluginscss')
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('backend') }}/css/vertical-layout-light/style.css">

  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('backend') }}/images/favicon.png" />
  @stack('css')
</head>

<body>
  <div class="container-scroller">
    <!-- partials/navbar user -->
    @auth()
    @include('backend.partials.user.navbar')
    @endauth()

    <!-- content view -->
    <div class="container-fluid page-body-wrapper {{ $class ?? '' }}">
      <!-- partials/sidebar user -->
      @auth()
      @include('backend.partials.user.sidebar')
      <div class="main-panel">
      @endauth
        @include('sweetalert::alert')
        @yield('content')
        <!-- partials/footer user -->
        @auth()
        @include('backend.partials.user.footer')
        <!-- partial -->
      </div>
      @endauth
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="{{ asset('backend') }}/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for page -->
  @stack('pluginsjs')
  <!-- End plugin js for page -->
  <!-- inject:js -->
  <script src="{{ asset('backend') }}/js/off-canvas.js"></script>
  <script src="{{ asset('backend') }}/js/hoverable-collapse.js"></script>
  <script src="{{ asset('backend') }}/js/template.js"></script>
  <script src="{{ asset('js/app.js') }}" rel="stylesheet"></script>
  <!-- endinject -->
  <!-- Custom js for page-->
  @stack('js')
  <!-- End custom js for page-->
</body>

</html>