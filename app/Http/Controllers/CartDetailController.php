<?php

namespace App\Http\Controllers;

use auth;
use App\Product;
use App\CartDetail;
use Illuminate\Http\Request;

class CartDetailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request){
        // dd($request);

        //validaciones
        $messages = [            
            'quantity.required' => 'Es necesario ingresar la cantidad del producto.',
            'quantity.numeric' => 'La cantidad debe tener sólo dígitos.',
            'quantity.min' => 'La cantidad debe ser mayor a cero.'
        ];

        $rules = [            
            'quantity' => 'required | numeric | min:0',
        ];
        $this->validate($request, $rules, $messages);
                
        $product = Product::find($request->product_id);

        // dd($product);
        if(auth()->user()->cart->existeProducto($product->id)){
            $alert = "Alerta: El producto ya existe en el carrito de compras.";
            return back()->with(compact('alert'));
        }
        
        if(!$product->existeStock($request->quantity)){
            $alert = "Estimado cliente: Por el momento no tenemos stock para la cantidad solicitada.";
            return back()->with(compact('alert'));
        }
        
        $product->stock = $product->actualizarStock($request->quantity);
        $product->save();

        $cartDetail = new CartDetail();
        $cartDetail->cart_id = auth()->user()->cart->id;
        $cartDetail->product_id = $product->id;
        $cartDetail->quantity = $request->quantity;
        $cartDetail->price = $product->price;
        $cartDetail->total = $cartDetail->calcularTotal();
        $result = $cartDetail->save();

        if($result){
            $notification = "Producto agregado al carrito de compras.";
        }
                     
        return back()->with(compact('notification'));
    }

    public function destroy(Request $request){
        $cartDetail = CartDetail::find($request->cart_detail_id);
        
        //validar que el cart_detail sea del usuario
        if($cartDetail->cart_id == auth()->user()->cart->id){
            $product = Product::find($cartDetail->product_id);
            $product->stock = $product->restoreStock($cartDetail->quantity);
            $product->save();

            $result = $cartDetail->delete();
        }        
        
        if($result){
            $notification = "El producto ha sido eliminado de manera correcta";
        }

        return back()->with(compact('notification'));
    }
}
