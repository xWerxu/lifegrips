<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'first_name',
        'second_name',
        'cart_id',
        'shipment_id',
        'status',
        'total_price',
        'completed_date',
        'payment_id',
        'city',
        'zip',
        'address',
        'mail',
        'phone',
    ];

    public function cart(){
        return $this->hasOne(Cart::class, 'id', 'cart_id');
    }

    public function shipment(){
        return $this->hasOne(Shipment::class, 'id', 'shipment_id');
    }

    public function payment(){
        return $this->hasOne(Payment::class, 'id', 'payment_id');
    }
}
