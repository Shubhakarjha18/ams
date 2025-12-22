<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="{{ asset('static/img/icons/icon-48x48.png') }}" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/" />

	<title>@yield('title', 'AMS' )</title>

	<link href="{{ asset('static/css/app.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<!-- SweetAlert2 CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
	<!-- Bootstrap 5.3 CSS -->
	<!-- 	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
 --> <!-- Font Awesome 6.5.2 -->
	<link
		rel="stylesheet"
		href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
		integrity="sha512-4CfQhLwPYmo3HQf3cTo10+cXnJx5OjGsXcq7VFLZF7YCEQp5jIhLzCL3G4H1g5O2Q8XnQj7Z6W5m1v3D09f4ZA=="
		crossorigin="anonymous"
		referrerpolicy="no-referrer" />


	@stack('css')
</head>

<body>
	<div class="wrapper">
		@include('backend.partials.sidebar')

		<div class="main">
			@include('backend.partials.navbar')

			<main class="content">
				<!-- @include('backend.partials.main') -->
				@yield('content')

			</main>

			<footer class="footer">
				@include('backend.partials.footer')
			</footer>
		</div>
	</div>

	<script src="{{ asset('static/js/app.js') }}"></script>
	<script src="{{ asset('static/js/main.js') }}"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js"></script>

	<!-- SweetAlert2 JS -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	@include('components.alerts')
	<!-- Bootstrap 5.3 JS Bundle -->
	<!-- 	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
 -->
	@stack('js')
</body>

</html>