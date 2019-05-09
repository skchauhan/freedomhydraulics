@php
	if(!empty($_GET['lang'])) {
		session(['cur_lang' => $_GET['lang']]);
	}
@endphp

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
  <title>{{ config('app.name', 'Laravel') }}</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('public/css/custom.css') }}" rel="stylesheet">
  <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>
<body>

	<div class="wrapper"> 	
	  <!-- /.navbar -->
	  @include('nav-menu')

	  <!-- Main Sidebar Container -->
	  <aside class="main-sidebar sidebar-dark-primary elevation-4">
	    <!-- Brand Logo -->
	    <a href="{{ url('/admin') }}" class="brand-link">
	      {{-- <img src="https://adminlte.io/themes/dev/AdminLTE/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
	           style="opacity: .8"> --}}
	      <span class="brand-text font-weight-light">Freedom Hydraulics</span>
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

<script type="text/javascript">
	var language = <?php echo json_encode($language); ?>;
</script>
<script src="{{ asset('public/js/app.js') }}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-show-password/1.0.3/bootstrap-show-password.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.11.2/ckeditor.js"></script>
<script src="{{ asset('public/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('public/js/custom.js') }}"></script>
</body>
</html>
