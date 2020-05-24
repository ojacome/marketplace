@extends('layouts.app')

@section('title','Editar Categoría')

@section('body-class', 'profile-page')

@section('content')
<div class="header header-filter" style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');">
	<div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <h1 class="title text-center">Editar Categoría</h1>
            </div>
        </div>
    </div>
</div>

<div class="main main-raised">
			<div class="container">		    	
	        	<div class="section">	                

					<!-- alert de validaciones  -->
					@if($errors->any())
						<div class="alert alert-danger">
							<ul>
							@foreach ($errors->all() as $error)
								<li>{{$error}}</li>								
							@endforeach
							</ul>
						</div>
					@endif

					<form method="post" action="{{ url('/admin/categories/'.$category->id.'/update') }}">
					@csrf

					<div class="row">
						<div class="col-sm-6">
							<div class="form-group label-floating">
								<label class="control-label">Nombre de la categoría</label>
								<input type="text" name="name" class="form-control" value="{{ old('name', $category->name) }}">
							</div>
						</div>						
					</div>				

					<div class="form-group label-floating">
						<label class="control-label">Descripción</label>
						<textarea class="form-control" rows="5" name="description">{{old('description', $category->description)}}</textarea>
					</div>					

					<button class="btn btn-primary">Guardar cambios</button>
                    <a href="{{ url('/admin/categories') }}" class="btn btn-default">Cancelar</a>
					</form>
	            </div>

	        </div>
</div>

@include('includes.footer')

@endsection