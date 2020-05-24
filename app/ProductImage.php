<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductImage extends Model
{
    use SoftDeletes;

    // $productImage->product
    public function product(){

        return $this->belongsTo(Product::class);
    }

    //accessor
    public function getUrlAttribute(){
        if(substr($this->image,0,4)=== "http"){
            return $this->image;
        }

        return '/images/products/'.$this->image;
    }
}
