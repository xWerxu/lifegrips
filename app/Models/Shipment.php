<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;
    
    protected $table= 'shipment';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'price',
        'payment',
        'available',
    ];
}
