<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use App\Category;
use App\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index(){
        $products = Product::paginate(10);
        return view('admin.products.index')->with(compact('products'));//le pasamos a la vista los productos
    }

    public function create(){
        $categories = Category::orderBy('name')->get();
        return view('admin.products.create')->with(compact('categories'));
    }

    public function store(Request $request){
        // dd($request->all());

        //validaciones
        $messages = [
            'name.required' => 'Es necesario ingresar el nombre del producto.',
            'name.min' => 'El nombre del producto debe tener al menos 3 caracteres.',            
            'description.required' => 'Es necesario ingresar la descripcion del producto.',
            'description.max' => 'La descripción del producto debe tener menos de 200 caracteres.',
            'price.required' => 'Es necesario ingresar el precio del producto.',
            'price.numeric' => 'El precio del producto debe tener sólo dígitos.',
            'price.min' => 'El precio del producto debe ser mayor a cero.',
            'stock.required' => 'Es necesario ingresar el stock del producto.',
            'stock.numeric' => 'El stock del producto debe tener sólo dígitos.',
            'stock.min' => 'El stock del producto debe ser mayor a cero.'
        ];

        $rules = [
            'name' => 'required | min:3',
            'description' => 'required | max:200',
            'price' => 'required | numeric | min:0',
            'stock' => 'required | numeric | min:0'
        ];
        $this->validate($request, $rules, $messages);

        $product = new Product();
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->long_description = $request->input('long_description');
        $product->stock = $request->input('stock');
        $product->category_id = $request->category_id;
        $result = $product->save();//insert

        if($result){
            $notification = "Producto creado con éxito.";
        }
        return redirect('/admin/products')->with(compact('notification'));
    }
    
    //id es un párametro de ruta
    public function edit($id){        
        $categories = Category::orderBy('name')->get();
        $product = Product::find($id);//busca producto
        return view('admin.products.edit')->with(compact('product', 'categories'));
    }


    public function update(Request $request, $id){
        // dd($request->all());

        //validaciones
        $messages = [
            'name.required' => 'Es necesario ingresar el nombre del producto.',
            'name.min' => 'El nombre del producto debe tener al menos 3 caracteres.',            
            'description.required' => 'Es necesario ingresar la descripcion del producto.',
            'description.max' => 'La descripción del producto debe tener menos de 200 caracteres.',
            'price.required' => 'Es necesario ingresar el precio del producto.',
            'price.numeric' => 'El precio del producto debe tener sólo dígitos.',
            'price.min' => 'El precio del producto debe ser mayor a cero.',            
            'stock.required' => 'Es necesario ingresar el stock del producto.',
            'stock.numeric' => 'El stock del producto debe tener sólo dígitos.',
            'stock.min' => 'El stock del producto debe ser mayor a cero.'
        ];

        $rules = [
            'name' => 'required | min:3',
            'description' => 'required | max:200',
            'price' => 'required | numeric | min:0',
            'stock' => 'required | numeric | min:0'
        ];
        $this->validate($request, $rules, $messages);

        $product = Product::find($id);

        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->long_description = $request->input('long_description');
        $product->stock = $request->input('stock');
        $product->category_id = $request->category_id;
        $result = $product->save();//update

        if($result){
            $notification = "Cambios guardados con éxito.";
        }

        return redirect('/admin/products')->with(compact('notification'));
    }

    public function destroy($id){    
        //Product::where('product_id', $id)->delete();
        ProductImage::where('product_id', $id)->delete();
     
        $product = Product::find($id);
        $product->delete(); // DELETE
     
        return back();
        
    }
}
