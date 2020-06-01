<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
	<link rel="icon" type="image/png" href="../assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>@yield('title','Tienda Virtual')</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

	<!--     Fonts and icons     -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
	<script src="https://kit.fontawesome.com/484708320b.js" crossorigin="anonymous"></script>

	<!-- CSS Files -->
    <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('css/material-kit.css')}}" rel="stylesheet"/>

	@yield('styles')
</head>

<body class="@yield('body-class')">
	<nav class="navbar navbar-transparent navbar-fixed-top navbar-color-on-scroll">
    	<div class="container">
        	<!-- Brand and toggle get grouped for better mobile display -->
        	<div class="navbar-header">
        		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example">
            		<span class="sr-only">Toggle navigation</span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
				</button>
				
        		<a class="navbar-brand" href="{{ url('/') }}">{{config('app.name')}}</a>
        	</div>

        	<div class="collapse navbar-collapse" id="navigation-example">
        		<ul class="nav navbar-nav navbar-right">
                        @guest
                            <li><a href="{{ route('login') }}">{{ __('Inicia sesión') }}</a></li>
                            @if (Route::has('register'))
                                <li>
                                    <a href="{{ route('register') }}">{{ __('Regístrate') }}</a>
                                </li>
                            @endif
							@else
							<li>
								<a  href="{{ url('/home') }}" role="button">
									<i class="material-icons">
										@if(auth()->user()->admin)
										dashboard
										@else
										shopping_cart
										@endif
									</i>
                                </a>
							</li>

                            <li class="dropdown">								
                                <a id="navbarDropdown" class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"  aria-expanded="false" >
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">

									@if(auth()->user()->admin)									

									<li>
										<a href="{{ url('/admin/products') }}">Gestionar productos</a>
									</li>

									<li>
										<a href="{{ url('/admin/categories') }}">Gestionar categorias</a>
									</li>
									@else 
									<li>
										<a href="{{ url('/order') }}">Compras</a>
									</li>
									@endif
									
                                    <li>
                                        <a  href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Cerrar Sesion') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
		            <!-- <li>
		                <a href="https://twitter.com/CreativeTim" target="_blank" class="btn btn-simple btn-white btn-just-icon">
							<i class="fa fa-twitter"></i>
						</a>
		            </li>
		            <li>
		                <a href="https://www.facebook.com/CreativeTim" target="_blank" class="btn btn-simple btn-white btn-just-icon">
							<i class="fa fa-facebook-square"></i>
						</a>
		            </li>
					<li>
		                <a href="https://www.instagram.com/CreativeTimOfficial" target="_blank" class="btn btn-simple btn-white btn-just-icon">
							<i class="fa fa-instagram"></i>
						</a>
		            </li> -->
        		</ul>
        	</div>
    	</div>
    </nav>

    <div class="wrapper">
        @yield('content')
    </div>
	
	<a href="https://wa.me/593969786985/?text=Hola!" class="whatsapp" target="_blank"> <i class="fa fa-whatsapp whatsapp-icon"></i></a>
	<a href="https://m.me/olmedo.jacome" class="messenger" target="_blank"> <i class="fab fa-facebook-messenger messenger-icon"></i></a>
	
</body>




	<!--   Core JS Files   -->
	<script src="{{ asset('js/jquery.min.js')}}" type="text/javascript"></script>
	<script src="{{ asset('js/bootstrap.min.js')}}" type="text/javascript"></script>
	<script src="{{ asset('js/material.min.js')}}"></script>

	<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
	<script src="{{ asset('js/nouislider.min.js')}}" type="text/javascript"></script>

	<!--  Plugin for the Datepicker, full documentation here: http://www.eyecon.ro/bootstrap-datepicker/ -->
	<script src="{{ asset('js/bootstrap-datepicker.js')}}" type="text/javascript"></script>

	<!-- Control Center for Material Kit: activating the ripples, parallax effects, scripts from the example pages etc -->
	<script src="{{ asset('js/material-kit.js')}}" type="text/javascript"></script>

	@yield('scripts')
</html>
