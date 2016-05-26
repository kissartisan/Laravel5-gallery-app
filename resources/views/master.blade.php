<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>My Gallery App</title>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.css">
	<link rel="stylesheet" type="text/css" href="{{ url(elixir('css/all.css')) }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/lightbox.css') }}">
	<script>
		var baseUrl = "{{ url('/') }}";
	</script>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
	@yield('header')

	<div class="container">
		@if(Session::has('flash_message'))
			<div class="promptCard card green medium-pad white-text center">
				{{ Session::get('flash_message') }}
			</div>
		@endif

		@if(Session::has('flash_error'))
			<div class="promptCard card error medium-pad white-text center">
				{{ Session::get('flash_error') }}
			</div>
		@endif

		@yield('content')
	</div>

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
	<script tyee="text/javascript" src="{{ asset('js/vendor/vendor.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/vendor/lightbox.min.js') }}"></script>
	<script tyee="text/javascript" src="{{ url(elixir('js/all.js')) }}"></script>

	<script type="text/javascript">
		$(".promptCard").fadeIn().delay(3000).slideToggle();
		$(".button-collapse").sideNav();
	</script>
</body>
</html>