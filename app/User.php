<?php

namespace App;

use App\Cart;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function carts(){

        return $this->hasMany(Cart::class);
    }

    //accessor cart
    public function getCartAttribute(){

        $cart = $this->carts()->where('status', 'Active')->first();

        if($cart)
            return $cart;

        $cart = new Cart();
        $cart->status = 'Active';
        $cart->user_id = $this->id;
        $cart->save();

        return $cart;
    }

    //accessor cart
    public function getOrdersAttribute(){

        $orders = $this->carts()->where('status','<>' ,'Active')->latest('updated_at')->get();

        // dd($orders);
        return $orders;
    }
}
