<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $table = 'coupon';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'coupon',
        'shipment',
        'promotion',
        'available',
    ];
}
