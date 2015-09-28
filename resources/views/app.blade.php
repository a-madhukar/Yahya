<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Event Management System</title>

	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">

	

	<link href="{{ asset('/css/custom.css') }}" rel="stylesheet">

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<link href='/css/animate.css' rel='stylesheet' type='text/css'>


	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-inverse navbar-static" id="top">
		<div class="container-fluid" id="navbar-container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				@if(Auth::guest())
					<a class="navbar-brand" href="{{url('/')}}">E.M.S</a>
				@else
					<a class="navbar-brand" href="{{url('home')}}">E.M.S</a>
				@endif
				
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
				@if(Auth::check())
					@if(Auth::user()->type == 1)
					<li class="dropdown">
					 <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Activities <span class="caret"></span></a>
					 <ul class="dropdown-menu">
			            <li><a href="{{url('activity/create')}}">Add New Activity</a></li>
			            <li role="separator" class="divider"></li>
			            <li><a href="{{url('activity')}}">View Activities</a></li>
			            <li role="separator" class="divider"></li>
			            
			          </ul>
         			</li> 

         			<li class="dropdown">
					 <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Events <span class="caret"></span></a>
					 <ul class="dropdown-menu">
			            <li><a href="{{url('event/create')}}">Add New Event</a></li>
			            <li role="separator" class="divider"></li>
			            <li><a href="{{url('event')}}">View Events</a></li>
			            <li role="separator" class="divider"></li>
			            
			          </ul>
         			</li> 

         			<li class="dropdown">
					 <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Special Events <span class="caret"></span></a>
					 <ul class="dropdown-menu">
			            <li><a href="{{url('special/create')}}">Add New Special Event</a></li>
			            <li role="separator" class="divider"></li>
			            <li><a href="{{url('special')}}">View Special Events</a></li>
			            <li role="separator" class="divider"></li>
			           
			          </ul>
         			</li> 
     				@endif
     			@endif

     			@if(Auth::check())
     				@if(Auth::user()->type==2)
     					<li><a href="{{url('subscribe')}}">Subscribe</a></li>
     				@endif
     			@endif
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="{{ url('authenticate/signin') }}">Login</a></li>
						<li><a href="{{ url('authenticate/signup') }}">Sign Up</a></li>
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->first_name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>

	@if(Session::has('signUpSuccess'))
		<div class="container padding">
			<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					{{Session::get('signUpSuccess')}}
			</div>
		</div>
	@elseif(Session::has('loginSuccessful'))
		<div class="container padding">
			<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					{{Session::get('loginSuccessful')}}
			</div>
		</div>
	@elseif(Session::has('loginUnSuccessful'))
		<div class="container padding">
			<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					{{Session::get('loginUnsuccessful')}}
			</div>
		</div>
	@elseif(Session::has('incorrect'))
		<div class="container padding">
			<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					{{Session::get('incorrect')}}
			</div>
		</div>
	@endif

	
	

	@yield('content')

	<!-- Scripts -->
	<!--<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>-->
	<script src="/js/jquery.min.js"></script>
	<script src="/js/bootstrap.min.js"></script>
	<script src="/js/angular.min.js"></script>
	<script src="/js/custom.js"></script>
	
</body>
</html>
