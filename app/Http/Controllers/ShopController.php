<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(){
        $categories = Category::whereNull('parent_id')->get();
        $products = Product::where('available', 1)->get();

        return view('shop.index', [
            'categories' => $categories,
            'products' => $products
        ]);
    }
}
