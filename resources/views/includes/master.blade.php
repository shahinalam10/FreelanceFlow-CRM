<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>@yield('title') | FreelanceFlow -CRM</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{asset('backendAsset')}}/assets/img/favicon.png" rel="icon">
  <link href="{{asset('backendAsset')}}/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('backendAsset')}}/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{asset('backendAsset')}}/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="{{asset('backendAsset')}}/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="{{asset('backendAsset')}}/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="{{asset('backendAsset')}}/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="{{asset('backendAsset')}}/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="{{asset('backendAsset')}}/assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!--font awesome cdn-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Template Main CSS File -->
  <link href="{{asset('backendAsset')}}/assets/css/style.css" rel="stylesheet">
</head>

<body>

    @include('includes.header')

    @include('includes.sidebar')

    @yield('content')

    @include('includes.footer')

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{asset('backendAsset')}}/assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="{{asset('backendAsset')}}/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{asset('backendAsset')}}/assets/vendor/chart.js/chart.umd.js"></script>
  <script src="{{asset('backendAsset')}}/assets/vendor/echarts/echarts.min.js"></script>
  <script src="{{asset('backendAsset')}}/assets/vendor/quill/quill.min.js"></script>
  <script src="{{asset('backendAsset')}}/assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="{{asset('backendAsset')}}/assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="{{asset('backendAsset')}}/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('backendAsset')}}/assets/js/main.js"></script>

</body>
</html>