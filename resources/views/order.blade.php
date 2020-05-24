@extends('layouts.app')

@section('title','Historial de compras')

@section('body-class', 'profile-page')

@section('content')
<div class="header header-filter" style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <h1 class="title text-center">Historial de compras</h1>
            </div>
        </div>
    </div>
</div>

<div class="main main-raised">
    <div class="container">		    	
        <div class="section">	                                		

            @if (session('payStatus'))
                    <div class="alert alert-success" role="alert">
                    {{ session('payStatus') }}
                </div>
            @endif 
            
        	@if(auth()->user()->orders->count()>0)                                                                                                          
            <table class="table">
                <thead>
                    <tr>                        
                        <th class="text-center">N° Pedido</th>
                        <th class="text-center">Estado</th>
                        <th class="text-center">Fecha y hora</th>
                        <th class="text-center">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(auth()->user()->orders as $order)
                    <tr>          
                        <td class="text-center">{{$order->id}}</td>              
                        <td class="text-center">{{$order->status}}</td>                                 
                        <td class="text-center">{{$order->updated_at}}</td>
                        <td class="text-center">$ {{$order->total}}</td>
                        
                        <td class="td-actions text-right">
                            <a href="#" rel="tooltip" title="Ver" class="btn btn-info btn-simple btn-xs">
                                    <i class="fa fa-info"></i>
                            </a>                                          
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>   
            @else
                <p> Estimado cliente... No tienes compras por el momento.</p>  
                <p> Conoce todos nuestros productos hacieno clic    
                    <a class="btn btn-primary btn-simple" href="{{ url('/#categories') }}">aquí</a>         
                </p>                                                   
            @endif                                                            
        </div>
    </div>
</div>

@include('includes.footer')

@endsection