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
        'main_image_id',
        'price'
    ];

    public function mainImage(){
        return $this->hasOne(Image::class);
    }
}
