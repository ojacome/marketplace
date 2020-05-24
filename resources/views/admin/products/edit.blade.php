@extends('layouts.app')

@section('title','Editar Producto')

@section('body-class', 'profile-page')

@section('content')
<div class="header header-filter" style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');">
	<div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <h1 class="title text-center">Editar Producto</h1>
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

					<form method="post" action="{{ url('/admin/products/'.$product->id.'/update') }}">
					@csrf

					<div class="row">
						<div class="col-sm-4">
							<div class="form-group label-floating">
								<label class="control-label">Nombre del producto</label>
								<input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}">
							</div>
						</div>

						<div class="col-sm-4">
							<div class="form-group label-floating">
                                <label class="control-label">Precio del producto</label>
						        <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $product->price) }}">
							</div>
						</div>

						<div class="col-sm-4">
							<div class="form-group label-floating">
                                <label class="control-label">STOCK</label>
						        <input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock) }}">
							</div>
						</div>
					</div>
					
					<div class="row">
						
						<div class="col-sm-4">
							<div class="form-group label-floating">
								<label class="control-label">Categoría del producto</label>
								
								<select class="form-control" name="category_id" >									
									@foreach($categories as $category)
									<option value="{{ $category->id }}" 
										@if($category->id == old('category_id', $product->category->id))
										selected
										@endif>
										{{ $category->name }}
									</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="col-sm-8">
							<div class="form-group label-floating">
								<label class="control-label">Descripción corta</label>
								<input type="text" name="description" class="form-control" value="{{ old('description', $product->description)}}">
							</div>	
						</div>
					</div>																

					<div class="form-group label-floating">
						<label class="control-label">Especificaciones</label>
						<textarea class="form-control" rows="5" name="long_description">{{old('long_description', $product->long_description)}}</textarea>
					</div>					

					<button class="btn btn-primary">Guardar cambios</button>
                    <a href="{{ url('/admin/products') }}" class="btn btn-default">Cancelar</a>
					</form>
	            </div>

	        </div>
</div>

@include('includes.footer')

@endsection