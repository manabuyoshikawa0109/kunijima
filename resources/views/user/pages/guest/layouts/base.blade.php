<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>くにじまテニスコート || ご利用案内</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="/favicon.ico" rel="icon">
    <link href="{{ asset('user/assets/img/kunijima_outdoor.jpg') }}" rel="apple-touch-icon">

    <!-- CSS -->
    <link rel="stylesheet" href="/user/assets/css/home.css?{{ (now())->format('YmdHis') }}">

    <!-- fontawesome -->
    <link rel="stylesheet" href="/common/plugins/fontawesome/css/all.css" >

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="/user/plugins/sailor/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/user/plugins/sailor/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="/user/plugins/sailor/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="/user/plugins/sailor/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="/user/plugins/sailor/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="/user/plugins/sailor/vendor/venobox/venobox.css" rel="stylesheet">
    <link href="/user/plugins/sailor/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link rel="stylesheet" href="/user/plugins/sailor/css/style.css">

    <!-- Table Hightlight CSS File -->
    <link rel="stylesheet" type="text/css" href="/user/plugins/table_highlight/vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="/user/plugins/table_highlight/vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="/user/plugins/table_highlight/vendor/perfect-scrollbar/perfect-scrollbar.css">
	<link rel="stylesheet" type="text/css" href="/user/plugins/table_highlight/css/util.css">
	<link rel="stylesheet" type="text/css" href="/user/plugins/table_highlight/css/main.css">

    @stack('links')

    <!-- =======================================================
    * Template Name: Sailor - v2.3.1
    * Template URL: https://bootstrapmade.com/sailor-free-bootstrap-theme/
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
</head>

<body>

    {{-- ヘッダー --}}
    @include('user.pages.guest.common.header')
    {{-- コンテンツ毎に変わる内容を読み込み --}}
    @yield('content')
    {{-- フッター --}}
    @include('user.pages.guest.common.footer')

    <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

    <!-- Vendor JS Files -->
    <script src="/user/plugins/sailor/vendor/jquery/jquery.min.js"></script>
    <script src="/user/plugins/sailor/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/user/plugins/sailor/vendor/jquery.easing/jquery.easing.min.js"></script>
    <script src="/user/plugins/sailor/vendor/php-email-form/validate.js"></script>
    <script src="/user/plugins/sailor/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="/user/plugins/sailor/vendor/venobox/venobox.min.js"></script>
    <script src="/user/plugins/sailor/vendor/waypoints/jquery.waypoints.min.js"></script>
    <script src="/user/plugins/sailor/vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="/user/plugins/table_highlight/vendor/bootstrap/js/popper.js"></script>
	<script src="/user/plugins/table_highlight/vendor/select2/select2.min.js"></script>

    <!-- Template Main JS File -->
    <script src="/user/plugins/sailor/js/main.js"></script>
    <!-- Table Hightlight JS File -->
	<script src="/user/plugins/table_highlight/js/main.js"></script>

    @stack('scripts')

</body>

</html>
