<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title')</title>
	<meta name="keywords" content="@yield('keywords')">
  <meta name="description" content="@yield('description')">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="format-detection" content="telephone=no">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="shortcut icon" href="{{URL::to('favicon.ico')}}">

	<!-- include css -->
	<link rel="stylesheet" type="text/css" href="{{URL::to('css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{URL::to('css/font-awesome.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{URL::to('css/custom.css')}}">

	<!-- include js -->
	<script type="text/javascript" src="{{URL::to('js/jquery.min.js')}}"></script>
	<script type="text/javascript" src="{{URL::to('js/bootstrap.min.js')}}"></script>

	<!-- Child style goes here -->
  @yield('stylesheet')
</head>

<body>
	<div id="page">
		<div class="header_container">
			<!-- Header -->
			@include('header')	
		</div>
		<!-- Include flash msg to show error, warning and other messages -->
		<div class="container">
			@include('flash::message')
		</div>
		<div class="page_container">
			<!-- Middle content -->
			@yield('content')
			<!-- Footer -->
			@include('footer')
		</div>
	</div>
   
	<!-- Child javascript goes here -->
	@yield('javascript')

</body>
</html>