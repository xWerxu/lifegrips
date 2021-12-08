<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(){
        $products = Product::where('available', 1)->get();

        $articles = Article::where('published', 1)->get();
        $articles->load('products');

        return view('shop.index', [
            'products' => $products,
            'articles' => json_encode($articles)
        ]);
    }

    public function product($id){
        $product = Product::find($id);
        $product->load('mainVariant');
        $product->load('variants');
        $product->load('categories');

        return view('shop.product', [
            'product' => json_encode($product)
        ]);
    }
}
