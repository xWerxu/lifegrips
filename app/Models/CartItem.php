<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $table = 'cart_item';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'variant_id',
        'cart_id',
        'quantity'
    ];

    public function variant(){
        return $this->hasOne(Variant::class, 'id', 'variant_id');
    }
}
