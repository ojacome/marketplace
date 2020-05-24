@extends('layouts.app')

@section('title','Carrito de compras')

@section('body-class', 'profile-page')

@section('content')
<div class="header header-filter" style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <h1 class="title text-center">Carrito de compras</h1>
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

                    @if (session('payStatus'))
                        <div class="alert alert-warning" role="alert">
                            {{ session('payStatus') }}
                        </div>
                    @endif                                                             

                    <p> Tu carrito de compras presenta {{auth()->user()->cart->details->count()}} producto(s).</p>                               
                    <hr>
                    
                    @if(auth()->user()->cart->details->count()>0)
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">imagen</th>
                                <th >Nombre</th>
                                <th class="text-right">Precio</th>
                                <th class="text-right">Cantidad</th>
                                <th class="text-right">Subtotal</th>
                                <th class="text-right">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(auth()->user()->cart->details as $detail)
                            <tr>
                                <td class="text-center">
                                    <img src="{{$detail->product->featured_image_url}}" alt="imagen {{$detail->product->name}}" height="50">
                                </td>
                                <td>
                                    <a href="{{ url('/products/'.$detail->product->id) }}" rel="tooltip" title="Ver">{{$detail->product->name}}</a>
                                </td>                                 
                                <td class="text-right">$ {{$detail->price}}</td>
                                <td class="text-right">{{$detail->quantity}}</td>
                                <td class="text-right">$ {{$detail->total }}</td>
                                <td class="td-actions text-right">
                                    <form method="post" action="{{ url('/cart') }}">
                                    @method('DELETE')
                                    @csrf                                    
                                        <input type="hidden" name="cart_detail_id" value="{{ $detail->id }}">

                                        <a href="{{ url('/products/'.$detail->product->id) }}" rel="tooltip" title="Ver" class="btn btn-info btn-simple btn-xs">
                                            <i class="fa fa-info"></i>
                                        </a>                                        
                                        																								
                                        <button type="submit" rel="tooltip" title="Eliminar" class="btn btn-danger btn-simple btn-xs" onclick="return confirm('¿Seguro que deseas eliminar este producto?');">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </form>                                           
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr >
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="warning text-right" >
                                    <h4 class="title">TOTAL</h1>
                                </td>
                                <td class="warning text-right">
                                    <h4>$ {{ auth()->user()->cart->calcularTotal() }}</h1>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                    
                    <div class="text-center">
                        <form  method="post" action="{{ url('/order') }}">
                        @csrf
                            <button class="btn btn-primary btn-round" >
                                <i class="material-icons">done</i> Continuar
                            </button>
                        </form>

                        <a class="btn btn-primary btn-round" href="{{ url('/paypal/pay')}}" >
                            <i class="material-icons">monetization_on</i> Pagar
                        </a>
                    </div> 
                    @endif
                    
	            </div>

	        </div>
</div>

@include('includes.footer')

@endsection