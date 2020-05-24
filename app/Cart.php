<?php

namespace App;

use App\CartDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use SoftDeletes;

    
    public function details(){

        return $this->hasMany(CartDetail::class);
    }

    public function existeProducto($id){     

        $productAlreadyExists = $this->details()->where('product_id', $id)->exists(); 
        
        return $productAlreadyExists;        
    }

    public function calcularTotal(){        
        $total = 0;

        foreach($this->details as $detail){
            $total += $detail->total;  
        }

        return $total;
    }
}
