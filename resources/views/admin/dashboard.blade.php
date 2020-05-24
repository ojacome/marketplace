@extends('layouts.app')

@section('title','Dashboard')

@section('body-class', 'profile-page')

@section('content')
<div class="header header-filter" style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <h1 class="title text-center">Dashboard</h1>
            </div>
        </div>
    </div>
</div>

<div class="main main-raised">
    <div class="container">		    	
        <div class="section">
                            
            @if (session('notification'))
                <div class="alert alert-success" role="alert">
                    {{ session('notification') }}
                </div>
            @endif                                     
            
            <ul class="nav nav-pills nav-pills-primary" role="tablist">
                <li>
                    <a href="{{ url('/admin/products') }}" >
                        <i class="material-icons">desktop_mac</i>
                        Gestionar productos
                    </a>
                </li>                        
                <li>
                    <a href="{{ url('/admin/categories') }}" >
                        <i class="material-icons">category</i>
                        Gestionar Categorías
                    </a>
                </li>
            </ul>                             
            
        </div>

    </div>
</div>

@include('includes.footer')

@endsection