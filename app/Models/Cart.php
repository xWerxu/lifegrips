<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'cart';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'client_id',
        'status',
        'coupon_id'
    ];

    public function items(){
        return $this->hasMany(CartItem::class, 'cart_id', 'id');
    }

    public function client(){
        return $this->hasOne(User::class, 'id', 'client_id');
    }

    public function coupon(){
        return $this->hasOne(Coupon::class, 'id', 'coupon_id');
    }
}
