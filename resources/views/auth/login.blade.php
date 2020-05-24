@extends('layouts.app')

<!-- section para login y lo paso como argumento en app.blade -->
@section('body-class','signup-page')

@section('content')
<div class="header header-filter" style="background-image: url('{{ asset('img/city.jpg')}}'); background-size: cover; background-position: top center;">
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
				<div class="card card-signup">
					<form class="form "method="POST" action="{{ route('login') }}">
				@csrf
						<div class="header header-primary text-center">
							<h4>Inicio de Sesión</h4>
							<!-- <div class="social-line">
								<a href="#pablo" class="btn btn-simple btn-just-icon">
									<i class="fa fa-facebook-square"></i>
								</a>
								<a href="#pablo" class="btn btn-simple btn-just-icon">
									<i class="fa fa-twitter"></i>
								</a>
								<a href="#pablo" class="btn btn-simple btn-just-icon">
									<i class="fa fa-google-plus"></i>
								</a>
							</div> -->
						</div>
						<p class="text-divider">Ingresa tus datos</p>
						<div class="content">							

							<div class="input-group">
								<span class="input-group-addon">
									<i class="material-icons">email</i>
								</span>                                        
								<input id="email" type="email" placeholder="Email..." class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

								@error('email')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>

							<div class="input-group">
								<span class="input-group-addon">
									<i class="material-icons">lock_outline</i>
								</span>                                        
								<input id="password" placeholder="Password..." type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">								
								<span class="input-group-addon">
									<button class="btn btn-primary btn-simple" type="button" onclick="mostrarContrasena()">
										<i class="material-icons" id="show_password">visibility</i>
									</button>
								</span>
																								
								@error('password')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>

							<!-- If you want to add a checkbox to this form, uncomment this code -->
							<div class="checkbox">
								<label>
									<input type="checkbox"  name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
									Recordar sesión
								</label>
							</div>

							<div class="form-group text-center">
								<a href="{{ route('password.request') }}">
									{{ __('Forgot Your Password?') }}
								</a>									
							</div>
							
						</div>
						<div class="footer text-center">
							<button type="submit" class="btn btn-simple btn-primary btn-lg">Ingresar</a>
						</div>
						
						

					</form>
				</div>
			</div>
		</div>
	</div>

	@include('includes.footer')

</div>
@endsection