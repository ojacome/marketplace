<?php

namespace App\Http\Controllers\Admin;

use File;
use App\Product;
use App\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImageController extends Controller
{
    public function index($id){
        $product= Product::find($id);
        $images = $product->images()->orderBy('featured','desc')->get();

        return view('admin.products.images.index')->with(compact('product','images'));
    }

    public function store(Request $request, $id){

        //validaciones
        $messages = [
            'photo.max' => 'La imagen debe ser menor de 1 MB.'
        ];
        $rules = [
            'photo' => 'max:1024'            
        ];
        $this->validate($request, $rules, $messages);

        //guardar img en nuestro proyecto
        $file = $request->file('photo');//obtiene el archivo o imagen del request
        $path = public_path().'/images/products';
        $fileName = uniqid().$file->getClientOriginalName();
        $moved = $file->move($path, $fileName);

        //si la img se guardo correctamente se procede a guardar ruta en base
        if($moved){
            //crear registro en tabla product_images
            $productImage = new ProductImage();
            $productImage->image = $fileName;
            // $productImage->featured = ;
            $productImage->product_id = $id;
            $productImage->save(); //INSERT
        }        

        return back();
    }

    public function destroy(Request $request){
        
        $deleted = true;
        $productImage = ProductImage::find($request->image_id);

        //si es una imagen de la nube no hay que borrar archivo, solo registro de base
        if(substr($productImage->image,0,4) !== "http"){
            //eliminar el archivo
            $fullPath = public_path().'/images/products/'.$productImage->image;
            $deleted = File::delete($fullPath);
        }
        
        //si la imagen se eliminó correctamente se procese a eliminar de base
        if($deleted){
            //eliminar el registro en product_images
            $productImage->delete();
        }

        return back();
    }

    public function select($id, $image){
        ProductImage::where('product_id',$id)->update([
            'featured' => false
            ]);

        $productImage = ProductImage::find($image);
        $productImage->featured = true;
        $productImage->save();

        return back();
    }
}
