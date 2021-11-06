<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CategoryController extends Controller
{
    public function index(){
        $products = Product::where('available', 1)->get();

        return view('shop.index', [
            'products' => $products
        ]);
    }

}
