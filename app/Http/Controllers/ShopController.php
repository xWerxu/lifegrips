<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Filter;
use App\Models\FilterVariant;
use App\Models\Order;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request){
        $page = $request->has('page') ? $request->get('page') : 1;
        $limit = $request->has('limit') ? $request->get('limit') : 10;
        $q = $request->has('q') ? $request->get('q') : '';
        $limits = [9, 15, 30];

        $variants = Variant::where('available', 1)->where('name', 'like', '%'.$q.'%')->pluck('id')->toArray();
        $max = Product::where('available', 1)->whereIn('main_variant', $variants)->count();
        $products = Product::where('available', 1)->whereIn('main_variant', $variants)->skip(($page - 1) * $limit)->take($limit)->get();
        $pages = ceil($max/$limit);

        $products->load('mainVariant');
        $categories = Category::whereNull('parent_id')->get();
        $categories->load('categories');


        return view('shop.products', [
            'products' => $products,
            'categories' => $categories,
            'max' => $max,
            'pages' => $pages,
            'current_page' => $page,
            'current_limit' => $limit,
            'limits' => $limits,
            'test' => $variants,
            'q' => $q
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
        $display_variants = false;

        if(isset($request->filters)){
            $display_variants = true;

            $page = false;
            $limit = false;
            $max = false;
            $pages = false;
            $limits = false;

            $tmp = [];
            $i = 0;
            foreach($request->filters as $id => $filter){
                $filterVariant = FilterVariant::where('filter_id', $id)->whereIn('value', $filter['values'])->get();
                $filterVariant->load('variant');
                foreach($filterVariant as $fw){
                    if (!isset($tmp[$fw->variant_id])){
                        $tmp[$fw->variant_id] = 1;
                    }else{
                        $tmp[$fw->variant_id] += 1;
                    }
                }
                $i++;
            }

            $ids = [];
            foreach ($tmp as $id => $count){
                if ($count == $i){
                    array_push($ids, $id);
                }
            }
            $products = Variant::whereIn('id', $ids)->get();

            
        }
        else{
            $page = $request->has('page') ? $request->get('page') : 1;
            $limit = $request->has('limit') ? $request->get('limit') : 10;

            $max = $category->products->count();
            $pages = ceil($max/$limit);
            $limits = [9, 15, 30];

            $products = $category->products->skip(($page - 1) * $limit)->take($limit);
        }

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
            'display_variants' => $display_variants,
            'max' => $max,
            'pages' => $pages,
            'current_page' => $page,
            'current_limit' => $limit,
            'limits' => $limits,
        ]);
    }
}
