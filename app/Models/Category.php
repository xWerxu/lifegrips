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

    public function hasChildren(){
        if ($this->categories()->exists()){
            return true;
        }
        return false;
    }

    public function parent(){
        return $this->belongsTo(Category::class, 'parent_id', 'category_id')->first();
    }

    public function categories(){
        return $this->hasMany(Category::class, 'parent_id', 'category_id');
    }

    public function childrenCategories(){
        return $this->hasMany(Category::class, 'parent_id', 'category_id')->with('categories');
    }

    public function products(){
        return $this->belongsToMany(Product::class);
    }

    public function filters(){
        return $this->belongsToMany(Filter::class, 'category_filter', 'category_id', 'filter_id');
    }
}
