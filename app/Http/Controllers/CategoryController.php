<?php

namespace App\Http\Controllers;

use App\Models\Category;
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

    public function adminIndex(){
        $categories = Category::all();

        return view('admin.categories.index', [
            'categories' => $categories
        ]);
    }

    public function create(Request $request){
        $category = new Category;

        $category->name = $request->name;
        if ($request->parent_id != "null"){
            $category->parent_id = $request->parent_id;
        }

        $category->save();

        return redirect()->route('admin.category.index');
    }

}
