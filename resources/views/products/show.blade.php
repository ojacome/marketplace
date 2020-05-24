@extends('layouts.app')

@section('title','Producto')

@section('body-class', 'profile-page')

@section('content')

<div class="header header-filter" style="background-image: url('/img/examples/city.jpg');"></div>

<div class="main main-raised">
    <div class="profile-content">
        <div class="container">            

            <div class="row">
                <div class="profile">
                    <div class="avatar">
                        <img src="{{$product->featured_image_url}}" alt="Circle Image" class="img-circle img-responsive img-raised">
                    </div>                    

                    <div class="name">
                        <h3 class="title">{{$product->name}}</h3>
                        <h3 class="title">$ {{$product->price}}</h3>
                        <h6>{{$product->category->name}}</h6>
                    </div>
                </div>
            </div>
            <div class="description text-center">
                <p>{{$product->long_description}}</p>
            </div>

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

            <!-- alert de notificacion flash  -->
            @if (session('notification'))
                <div class="alert alert-success" role="alert">
                    {{ session('notification') }}
                </div>
            @endif  

            <!-- alert de notificacion flash  -->
            @if (session('alert'))
                <div class="alert alert-warning" role="alert">
                    {{ session('alert') }}
                </div>
            @endif  

            <hr>
            <div class="text-center">
            @if( auth()->check() && auth()->user()->cart->existeProducto($product->id) )                
                <a href="{{ url('/home') }}" class="btn btn-primary btn-round">
                    <i class="material-icons">arrow_forward</i> Producto en el carrito
                </a>                
            @else                
                <button class="btn btn-primary btn-round" data-toggle="modal" data-target="#modalAddToCart">
                    <i class="material-icons">add</i> Añadir al carrito
                </button>                
            @endif        
            </div>
            <hr>         

            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="profile-tabs">
                        <div class="nav-align-center">                            

                            <div class="tab-content gallery">
                                <div class="tab-pane active" id="studio">
                                    <div class="row">
                                        <div class="col-md-6">
                                            @foreach($imagesLeft as $image)
                                            <img src="{{ $image->url}}" class="img-rounded" />
                                            @endforeach
                                        </div>

                                        <div class="col-md-6">
                                            @foreach($imagesRight as $image)
                                            <img src="{{ $image->url}}" class="img-rounded" />
                                            @endforeach
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                    </div>
                    <!-- End Profile Tabs -->
                </div>
            </div>

        </div>
    </div>
</div>    
@include('includes.footer')

@endsection

<!-- Modal Core -->
<div class="modal fade" id="modalAddToCart" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Seleccione la cantidad</h4>
      </div>

      <form action="{{ url('/cart') }}" method="post">
        @csrf   
        <input type="hidden" name="product_id" value="{{$product->id}}">
        <div class="modal-body">   
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group label-floating">
                        <label class="control-label">Cantidad</label>
                        <input id="quantity" type="number" name="quantity" min="1" value="1" class="form-control" onchange="myFunction(this.value)">						
                    </div>
                </div>         
                <input type="hidden" id="price" value="{{ $product->price }}">
                <div class="col-sm-6">
                    <div class="form-group label-floating">
                        <label class="control-label">Total</label>
                        <input type="text" id="total" name="total" class="form-control" disabled value="$ {{$product->price }}">					
                    </div>
                </div>  
            </div>                      
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-info btn-simple">Guardar</button>
        </div>
      </form>
      
    </div>
  </div>
</div>

@section('scripts')
<script>
    function myFunction(val) {
        total.value = `$ ${val * price.value}`;             
    }   
</script>
@endsection