<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $primaryKey = 'category_id';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'parent_id'
    ];

    public function categories(){
        return $this->hasMany(Category::class, 'parent_id', 'category_id');
    }

    public function childrenCategories(){
        return $this->hasMany(Category::class, 'parent_id', 'category_id')->with('categories');
    }

    public function products(){
        return $this->belongsToMany(Product::class);
    }
}
