<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $table = 'article';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'published',
        'background_color',
        'title',
        'image',
        'short_description',
        'content',
        'background_products'
    ];

    public function products(){
        return $this->belongsToMany(Product::class, 'articles_products', 'article_id', 'product_id')->with('mainVariant');
    }
}
