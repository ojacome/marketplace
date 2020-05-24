@extends('layouts.app')

@section('title','Listado de categorias')

@section('body-class', 'profile-page')

@section('content')
<div class="header header-filter" style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');">    
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <h1 class="title text-center">Categorías</h1>
            </div>
        </div>
    </div>
</div>

<div class="main main-raised">
    <div class="container">
                                            
        <!-- alert de notificacion flash  -->
        @if (session('notification'))
            <div class="alert alert-success" role="alert">
                {{ session('notification') }}
            </div>
        @endif                     

        <div class="team">
            <div class="row">
                <div class="text-center">
                    <a href="{{ url('/admin/categories/create')}}" type="button" class="btn btn-primary btn-round">Nueva Categoría</a>
                </div>

                <hr>

                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="col-md-2 ">Nombre</th>
                            <th class="col-md-5 ">Descripcion</th>
                            <th class="text-right">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td class="text-center">{{$category->id}}</td>
                            <td>{{$category->name}}</td>
                            <td>{{$category->description}}</td>                                        
                            <td class="td-actions text-right">
                                <form method="post" action="{{ url('/admin/categories/'.$category->id) }}">
                                @csrf
                                @method('DELETE')
                                    <a href="#" rel="tooltip" title="Ver" class="btn btn-info btn-simple btn-xs">
                                        <i class="fa fa-info"></i>
                                    </a>

                                    <a href="{{ url('/admin/categories/'.$category->id.'/edit') }}" rel="tooltip" title="Editar" class="btn btn-success btn-simple btn-xs">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                                                                                                                    
                                    <button type="submit" rel="tooltip" title="Eliminar" class="btn btn-danger btn-simple btn-xs" onclick="return confirm('¿Seguro que deseas eliminar ésta categoría?');">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </form>                                           
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>	
                <div class="text-center">
                    {{$categories->links()}}	                
                </div>
            </div>
        </div>
                
    </div>
</div>

@include('includes.footer')

@endsection