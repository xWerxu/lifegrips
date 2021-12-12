<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Variant;
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

    public function showOrder($id){
        $order = Order::findOrFail($id);

        return view('user.order', [
            'order' => $order
        ]);
    }

    public function showArticle($id){
        $article = Article::findOrFail($id);
        $article->load('products');

        return view('shop.article', [
            'article' => $article
        ]);
    }

    public function product($id){
        $variant = Variant::find($id);
        $product = $variant->product;
        $product->load('variants');
        $product->load('categories');

        return view('shop.product', [
            'product' => $product,
            'variant' => $variant,
        ]);
    }

    public function category(Request $request, $id){
        $category = Category::find($id);
        $filters = $category->filters;

        // if (isset($request->pivot)){
        //     foreach ($request->pivot as $key => $value){
        //         $products = 
        //     }
        // }
    }
}
