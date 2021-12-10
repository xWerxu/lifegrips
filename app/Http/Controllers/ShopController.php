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
        $categories = Category::whereNull('parent_id')->get();
        $categories->load('categories');


        return view('shop.products', [
            'products' => $products,
            'categories' => $categories
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
