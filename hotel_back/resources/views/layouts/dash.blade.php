<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="shortcut icon" href="{{ asset('hotel.ico') }}">
  <title>HOTEL_MANAGEMENT</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('admin_lte/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('admin_lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('admin_lte/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<!-- Site wrapper -->
<div class="wrapper">
            <!-- LEFT_NAV_BAR -->

            @include('inc.left-top')
           
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    
 
    <!-- Main content -->
    <div class="content">
      <div class="container ml-0">
        <!-- EVERYTHING WILL BE HERE -->
     
        @yield('content')



        <!-- EVERYTHING WILL BE HERE -->
      </div>
    </div>
    <!-- /.content -->

<!-- /.content-wrapper -->



<!-- ./wrapper -->
<!-- jQuery -->
<script src="{{ asset('admin_lte/plugins/jquery/jquery.min.js')}} "></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('admin_lte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('admin_lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admin_lte/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('admin_lte/dist/js/demo.js')}}></script>

</body>

</html>