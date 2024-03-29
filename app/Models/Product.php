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
        'description',
        'available',
        'main_variant'
    ];

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function mainVariant(){
        return $this->hasOne(Variant::class, 'id', 'main_variant');
    }

    public function variants(){
        return $this->hasMany(Variant::class, 'product_id');
    }
}
