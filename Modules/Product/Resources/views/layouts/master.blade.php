<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Module Product</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href=" {{  asset('plugins/sweetalert2/sweetalert2.min.css') }}">
        <style>
            .error{color:red}
        </style>   
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
			<a class="navbar-brand" href="#">Navbar</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
			</button>
			@php 
				$route = Route::currentRouteName();
			@endphp
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item {{ $route == 'index' ? 'active' : '' }}">
						<a class="nav-link" href="{{ route('index') }}">List Products</span></a>
					</li>
					<li class="nav-item {{ $route == 'create' ? 'active' : '' }}">
						<a class="nav-link" href="{{ route('create') }}">Upload</span></a>
					</li>
					<li class="nav-item {{ $route == 'product.map' ? 'active' : '' }}">
						<a class="nav-link" href="{{ route('product.map') }}">Map Fields</a>
					</li>
					<li class="nav-item {{ $route == 'product.download' ? 'active' : '' }}">
						<a class="nav-link" href="{{ route('product.download') }}">Download Sample</a>
					</li>
				</ul>
			</div>
		</nav>
        @yield('content')
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
        <script src="{{ asset('js/admin_custom.js') }}"></script>
        @yield('js')
    </body>
</html>
