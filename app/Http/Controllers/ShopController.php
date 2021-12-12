<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Filter;
use App\Models\FilterVariant;
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
        $variant = Variant::findOrFail($id);
        $product = $variant->product;
        $product->load('variants');
        $product->load('categories');

        return view('shop.product', [
            'product' => $product,
            'variant' => $variant,
        ]);
    }

    public function category(Request $request, $id){
        $category = Category::findOrFail($id);
        $filters = $category->filters;
        $products = $category->products;

        // if(isset($request->filters)){
        //     $products = [];
        //     foreach($request->filters as $id => $filter){
        //         $filterVariant = FilterVariant::where('filter_id', $id)->whereIn('value', $filter['values'])->get();
        //         $filterVariant->load('variant');
        //         foreach($filterVariant as $fw){
        //             array_push($products, $fw->variant);
        //         }
        //     }
        // }

        $array = [];
        $filters->load('filterVariant');
        foreach ($category->filters as $filter){
            $array[$filter->id]['name'] = $filter->name;
            foreach ($filter->filterVariant as $filterVariant){
                if (!isset($array[$filter->id]['values'])){
                    $array[$filter->id]['values'][0] = $filterVariant->value;
                }else{
                    if (!in_array($filterVariant->value, $array[$filter->id]['values'])){
                    array_push($array[$filter->id]['values'], $filterVariant->value);
                    }
                }
                
            }
        }

        return view ('shop.category', [
            'category' => $category,
            'filters' => $array,
            'products' => $products,
        ]);
    }
}
