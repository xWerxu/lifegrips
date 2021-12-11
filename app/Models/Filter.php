<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filter extends Model
{
    use HasFactory;

    protected $table = 'filter';

    protected $id = 'id';

    protected $fillable = [
        'name'
    ];

    public function categories(){
        return $this->belongsToMany(Category::class, 'category_filter', 'filter_id', 'category_id');
    }

    public function variants(){
        return $this->belongsToMany(Variant::class, 'filter_variant', 'filter_id', 'variant_id')
        ->withPivot('value');
    }

    public function filteredVariants($values){
        return $this->belongsToMany(Variant::class, 'filter_variant', 'filter_id', 'variant_id')
        ->withPivot('value')->wherePivotIn('value', $values)->get();
    }
}
