<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<title>Travel Ideas</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('css/layout.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet" >
	<link href="//code.jquery.com/ui/1.8.24/themes/base/jquery-ui.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
	<script type="text/javascript" src="{{asset('js/jquery-3.3.1.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/jquery-ui.js')}}"></script>

</head>

<body>
	<nav id="navigationbar" class="navbar navbar-expand-md navbar-light navbar-laravel">
		<div id="navigationcontainer">
			<!-- Left Side Of Navbar -->
			<ul id="leftnav" class="navbar-nav mr-auto">
				<li><a href="/">Home</a></li>
				<li><a href="/ideas/myidea">My Ideas</a></li>
				<li><a href="/ideas/create">Create</a></li>
			</ul>

			<!-- Right Side Of Navbar -->
			<ul id="rightnav" class="navbar-nav ml-auto">
				<!-- Authentication Links -->
				@guest
					<li class="nav-item">
						<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
					</li>
					@if (Route::has('register'))
						<li class="nav-item">
							<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
						</li>
					@endif
				@else
					<li class="nav-item dropdown">
						<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							{{ Auth::user()->name }} <span class="caret"></span>
						</a>

						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="{{ route('logout') }}"
								onclick="event.preventDefault();
												document.getElementById('logout-form').submit();">
								{{ __('Logout') }}
							</a>

							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								@csrf
							</form>
						</div>
					</li>
				@endguest
			</ul>
		</div>
	</nav>

	<article id="create_content">
		@include('inc.messages')
		@yield('content')
	</article>

	<footer>
		<section id="footersection">
			<img src="{{asset('img/Forest.webp')}}" alt=""/>
			<h1>
				About
			</h1>
			<p>
				This website is designed for a group of friends to share travel ideas, their past travel experiences and comments/thoughts within their circle.
			</p>
			<p id="copyright">
				Copyright © 2019, Andy and Izzy. All rights reserved.
			</p>
		</section>
	</footer>


</body>
</html>

