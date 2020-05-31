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
							<h4>Inicia Sesión</h4>													
							<div class="social-line">
								<label >con</label>
								<a href="{{ url('/auth/redirect/facebook') }}" class="btn btn-simple btn-just-icon">
									<i class="fa fa-facebook-square"></i>
								</a>
								<!-- <a href="#pablo" class="btn btn-simple btn-just-icon">
									<i class="fa fa-twitter"></i>
								</a> -->
								<a href="{{ url('/auth/redirect/google') }}" class="btn btn-simple btn-just-icon">
									<i class="fa fa-google-plus"></i>
								</a>
							</div>
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
							<button type="submit" class="btn btn-simple btn-primary btn-lg">Ingresar</button>						

							<!-- <div class="or-container">
								<div class="line-separator"></div>
								<div class="or-label">or</div>
								<div class="line-separator"></div>
							</div>
												
							<a class="btn btn-simple btn-primary " href="{{ url('/auth/redirect/google') }}">
							<img width="20px"  alt="Google sign-in" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/512px-Google_%22G%22_Logo.svg.png" />
							Ingresar con Google
							</a>

							<a class="btn btn-simple btn-primary " href="{{ url('/auth/redirect/facebook') }}">
							<img width="20px" alt="Facebook sign-in" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/51/Facebook_f_logo_%282019%29.svg/220px-Facebook_f_logo_%282019%29.svg.png" />
							Ingresar con Facebook
							</a>							 -->
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>

	@include('includes.footer')

</div>
@endsection