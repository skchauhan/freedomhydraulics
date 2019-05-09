<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>freedomhydraulics</title>
  <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">

	<div class="wrapper"> 	
	  <!-- /.navbar -->
	  @include('nav-menu')

	  <!-- Main Sidebar Container -->
	  <aside class="main-sidebar sidebar-dark-primary elevation-4">
	    <!-- Brand Logo -->
	    <a href="index3.html" class="brand-link">
	      <img src="https://adminlte.io/themes/dev/AdminLTE/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
	           style="opacity: .8">
	      <span class="brand-text font-weight-light">AdminLTE 3</span>
	    </a>

	    @include('sidebar')
	    <!-- /.sidebar -->
	  </aside>

	  <!-- Content Wrapper. Contains page content -->
	  <div class="content-wrapper">

	  	@yield('content')

	  </div>
	  <!-- /.content-wrapper -->

	  <!-- Control Sidebar -->
	  <aside class="control-sidebar control-sidebar-dark">
	    <!-- Control sidebar content goes here -->
	    <div class="p-3">
	      <h5>Title</h5>
	      <p>Sidebar content</p>
	    </div>
	  </aside>
	  <!-- /.control-sidebar -->

	  @include('footer')
	</div>
<!-- ./wrapper -->

<script src="{{ asset('public/js/app.js') }}" defer></script>
</body>
</html>
