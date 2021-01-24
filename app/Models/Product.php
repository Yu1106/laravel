<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function CartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function OrderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function checkQuantity($quantity)
    {
        if ($this->quantity < $quantity) {
            return false;
        }
        return true;
    }
}
