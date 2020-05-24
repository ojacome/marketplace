<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    
    public static $messages = [
        'name.required' => 'Es necesario ingresar el nombre de la categoría.',
        'name.min' => 'El nombre de la categoría debe tener al menos 3 caracteres.',                        
        'description.max' => 'La descripción debe tener menos de 200 caracteres.'
    ];

    public static $rules = [
        'name' => 'required | min:3',
        'description' => 'max:200',            
    ];

    protected $fillable = ['name', 'description'];

    // $category->products
    public function products(){

        return $this->hasMany(Product::class);
    }

    public function getFeaturedImageUrlAttribute(){

        $featuredProduct = $this->products()->first();

        return $featuredProduct->featured_image_url;
    }
}
