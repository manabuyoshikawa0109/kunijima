<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>くにじまテニスコート</title>

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- fontawesome -->
    <link rel="stylesheet" href="/common/plugins/fontawesome/css/all.css" >

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="/common/plugins/deskapp/vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="/common/plugins/deskapp/vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="/common/plugins/deskapp/src/plugins/datatables/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="/common/plugins/deskapp/src/plugins/datatables/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="/common/plugins/deskapp/vendors/styles/style.css">
    <link rel="stylesheet" type="text/css" href="/common/assets/css/custom.css?{{ $now->format('YmdHis') }}">

    @stack('links')

</head>
<body>
    @yield('inner_body')

	<!-- <div class="mobile-menu-overlay"></div> -->

	<!-- js -->
	<script src="/common/plugins/deskapp/vendors/scripts/core.js"></script>
	<script src="/common/plugins/deskapp/vendors/scripts/script.min.js"></script>
	<script src="/common/plugins/deskapp/vendors/scripts/process.js"></script>
	<script src="/common/plugins/deskapp/vendors/scripts/layout-settings.js"></script>
	<!-- <script src="/common/plugins/deskapp/src/plugins/apexcharts/apexcharts.min.js"></script> -->
	<script src="/common/plugins/deskapp/src/plugins/datatables/js/jquery.dataTables.min.js"></script>
	<script src="/common/plugins/deskapp/src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
	<script src="/common/plugins/deskapp/src/plugins/datatables/js/dataTables.responsive.min.js"></script>
	<script src="/common/plugins/deskapp/src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
	<!-- <script src="/common/plugins/deskapp/vendors/scripts/dashboard.js"></script> -->

    @stack('scripts')

</body>
</html>
