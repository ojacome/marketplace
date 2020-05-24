<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{

    public function index(){
        $categories = Category::orderBy('name')->paginate(10);
        return view('admin.categories.index')->with(compact('categories'));
    }

    public function create(){
        return view('admin.categories.create');
    }

    public function store(Request $request){
        // dd($request->all());

        //validaciones       
        $this->validate($request, Category::$rules, Category::$messages);        

        $category = new Category();
        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $result = $category->save();//insert

        if($result){
            $notification = "Categoría creada con éxito";
        }

        return redirect('/admin/categories')->with(compact('notification'));
    }
    
    //id es un párametro de ruta
    public function edit($id){        
        $category = Category::findOrFail($id);//excepcion 404 cuando no se encuentra el modelo 
        return view('admin.categories.edit')->with(compact('category'));
    }

    //utilizo cast para buscar la categoria
    public function update(Request $request, Category $category){
        // dd($request->all());
        
        //validaciones       
        $this->validate($request, Category::$rules, Category::$messages);        

        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $result = $category->save();//update

        if($result){
            $notification = "Cambios guardados con éxito.";
        }

        return redirect('/admin/categories')->with(compact('notification'));
    }

    public function destroy($id){    
        //Product::where('product_id', $id)->delete();
        // ProductImage::where('product_id', $id)->delete();
     
        $category = Category::findOrFail($id);
        $category->delete(); // DELETE
     
        return back();
        
    }
}
