<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = [
        'booking_id',
        'rating',
        'comment',
    ];

    // public function product()
    // {
    //     return $this->belongsTo(Product::class);
    // }

    // public function cart()
    // {
    //     return $this->belongsTo(Cart::class);
    // }

    // public function getBy($cartId, $productId, $productSize)
    // {
    //     return CartProduct::whereCartId($cartId)->whereProductId($productId)->whereProductSize($productSize)->first();
    // }


    // public function getTotalPriceAttribute()
    // {
    //     return $this->product->sale ? $this->product->sale_price * $this->product_quantity : $this->product->price * $this->product_quantity;
    // }
}
