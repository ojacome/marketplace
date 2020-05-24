@extends('layouts.app')

@section('title','Imágenes de productos')

@section('body-class', 'profile-page')

@section('content')
<div class="header header-filter" style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');">   
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <h1 class="title text-center">Imágenes de {{$product->name}}</h1>
            </div>
        </div>
    </div>
</div>

<div class="main main-raised">
    <div class="container">
        
        <div class="section ">            
            
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

            <form action="" method="post" enctype="multipart/form-data"> <!-- como no le indicamos action será la misma ruta q se encuentra -->
            @csrf
                <input type="file" name="photo" required> 

                <button type="submit" class="btn btn-primary btn-round">
                Subir imagen
                </button>

                <a href="{{ url('/admin/products') }}" type="button" class="btn btn-default btn-round">
                Volver
                </a>
            </form>                        
            
            <hr>

            <div class="row text-center">
            @foreach($images as $image)
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <img src="{{$image->url}}" alt="imagen de {{$product->name}}" width="250" height="250">

                            <form method="post" action="">
                            @csrf
                            @method('DELETE')
                                <input type="hidden" name="image_id" value="{{ $image->id }}">
                                
                                <button type="submit" class="btn btn-danger btn-round" onclick="return confirm('¿Seguro que deseas eliminar esta imagen?');">
                                Eliminar 
                                </button>

                                @if($image->featured)
                                    <button type="button" class="btn btn-primary btn-fab btn-fab-mini btn-round" rel="tooltip" title="DESTACADA">
                                        <i class="material-icons">favorite</i>
                                    </button>
                                @else
                                    <a href="{{ url('/admin/products/'.$product->id.'/images/select/'.$image->id) }}" rel="tooltip" title="Destacar imagen" class="btn btn-default btn-fab btn-fab-mini btn-round" onclick="return confirm('¿Seguro que deseas destacar esta imagen?');">
                                        <i class="material-icons">favorite</i>
                                    </a>
                                @endif
                                
                            </form>
                            
                        </div>
                    </div>
                </div>
            @endforeach
            </div>           
        </div>        
    </div>
</div>

@include('includes.footer')

@endsection