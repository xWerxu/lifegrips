<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $primaryKey = 'product_id';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'description',
        'manufacturer_id',
        'main_image_id',
        'price'
    ];

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function images(){
        return $this->belongsToMany(Image::class, 'products_images', 'product_id', 'image_id');
    }

    public function main_image(){
        return $this->hasOne(Image::class, 'main_image_id', 'image_id');
    }
}
