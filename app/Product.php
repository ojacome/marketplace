<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    
    // $product->category
    public function category(){

        return $this->belongsTo(Category::class);
    }

    // $product->images
    public function images(){

        return $this->hasMany(ProductImage::class);
    }

    // $product->featured_image_url
    public function getFeaturedImageUrlAttribute(){

        $featuredImage = $this->images()->where('featured',true)->first();
        
            if(!$featuredImage){
                $featuredImage = $this->images()->first();
            }
    
            if($featuredImage){
                return $featuredImage->url; //accessor en ProductImage
            }
        

        //imagen por defecto
        return '/images/products/no_image.png';
    }

    public function existeStock($quantity){

        if($quantity <= $this->stock)
            return true;
        else
            return false;
    }

    public function actualizarStock($quantity){

        return $this->stock - $quantity; 
    }

    public function restoreStock($quantity){

        return $this->stock + $quantity; 
    }
}
