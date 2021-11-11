<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index(){
        $products = Product::where('available', 1)->get();

        return view('shop.index', [
            'products' => $products
        ]);
    }

    public function adminIndex(){
        $categories = Category::all(); $mains = Category::whereNull('parent_id')->get(); $mains = Category::whereNull('parent_id')->get();

        $mains = DB::table('categories')->whereNull('parent_id')->get();

        return view('admin.categories.index', [
            'categories' => $categories,
            'mains' => $mains
        ]);
    }

    public function create(Request $request){
        $category = new Category;

        $category->name = $request->name;
        if ($request->parent_id != "null"){
            $category->parent_id = $request->parent_id;
        }

        $category->save();

        return redirect()->route('admin.category.index')->with('success', 'Dodano kategorię ' . $category->name . "!");
    }

    public function delete(Request $request){
        $category = Category::find($request->category_id);

        if ($category->categories()->exists()){
            return redirect()->route('admin.category.index')->with('error', 'Nie można usunąć kategorii '. $category->name . ', ponieważ posiada ona kategorie podrzędne!');
        }

        $category->forceDelete();

        return redirect()->route('admin.category.index')->with('success', 'Usunięto kategorię ' . $category->name . '!');
    }

    public function update(Request $request){
        $category = Category::find($request->category_id);
        
        $category->name = $request->name;
        if ($request->parent_id && $request->parent_id != "null"){
            $category->parent_id = $request->parent_id;
        }else{
            $category->parent_id = null;
        }

        $category->save();

        return redirect()->route('admin.category.index')->with('success', 'Pomyślnie edytowano kategorię ' . $request->name . '!');
    }

}
