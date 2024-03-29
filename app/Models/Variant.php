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

    public function product(){
        return $this->hasOne(Product::class, 'product_id', 'product_id');
    }

    public function filters(){
        return $this->belongsToMany(Filter::class, 'filter_variant', 'variant_id', 'filter_id')
        ->withPivot('value');
    }
}
