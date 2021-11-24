<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    use HasFactory;

    protected $table = 'variants';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'product_id',
        'name',
        'on_stock',
        'available',
        'main_image',
        'price'
    ];

    public function images(){
        return $this->hasMany(Image::class, 'variant_id', 'id');
    }
}
