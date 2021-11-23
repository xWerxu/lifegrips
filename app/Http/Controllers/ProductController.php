<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductEditRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\Variant;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductPostRequest;
use Intervention\Image\Facades\Image as Imagee;

class ProductController extends Controller
{
    public function adminIndex(Request $request){
        $page = $request->has('page') ? $request->get('page') : 1;
        $limit = $request->has('limit') ? $request->get('limit') : 10;

        $max = Product::count();
        $pages = ceil($max/$limit);
        $limits = [10, 25, 50];

        $products = Product::all()->skip(($page - 1) * $limit)  ->take($limit);

        return view('admin.products.index', [
            'products' => $products,
            'max' => $max,
            'pages' => $pages,
            'current_page' => $page,
            'current_limit' => $limit,
            'limits' => $limits
        ]);
    }

    public function create(Request $request){
        $categories = Category::whereNull('parent_id')->get();

        return view('admin.products.create', [
            'categories' => $categories,
        ]);
    }

    public function delete(Request $request){
        $product = Product::find($request->product_id);

        $product->categories()->detach();

        foreach ($product->variants as $variant){
            $array = explode('produkty/', $variant->main_image);
            if(Storage::disk('public')->exists('produkty/' . $array[1])){
                if (Storage::disk('public')->delete('produkty/' . $array[1])){
                    Storage::disk('public')->delete('produkty/' . $array[1]);
                }
            }

            foreach ($variant->images as $image){
                $array = explode('produkty/', $image->path);
                if(Storage::disk('public')->exists('produkty/' . $array[1])){
                    Storage::disk('public')->delete('produkty/' . $array[1]);
                }
            }

        }

        $product->forceDelete();

        return redirect()->route('admin.product.index')->with('success', 'Pomyślnie usunięto produkt i jego warianty!');
    }

    public function edit($id){
        $product = Product::find($id);
        $categories = Category::whereNull('parent_id')->get();

        $selected_cats = $product->categories;
        $selected = [];
        foreach ($selected_cats as $cat){
            array_push($selected, $cat->category_id);
        }

        return view('admin.products.edit', [
            'product' => $product,
            'categories' => $categories,
            'selected' => $selected
        ]);
    }

    public function postEdit(ProductEditRequest $request){
        $product = Product::find($request->product_id);

        $product->description = $request->description;
        $product->main_variant = $request->main_variant;
        if (isset($request->available)){
            $product->available = true;
        }else{
            $product->available = false;
        }

        $parents = [];

        foreach ($request->categories as $category_id){
            $category = Category::find($category_id);
            if (!in_array($category->parent_id, $parents)){
                array_push($parents, $category->parent_id);
            }
        }

        $variant = Variant::find($request->main_variant);

        $categories = array_merge($parents, $request->categories);

        $product->categories()->sync($categories);

        $product->save();


        return redirect()->route('admin.product.index')->with('success', 'Pomyślnie edytowano produkt ' . $variant->name . '!');
    }

    public function postCreate(ProductPostRequest $request){

        if (isset($request->main)) {
            $main_file            = $request->file('main');
            $name = $main_file->hashName();
            $image_resized = Imagee::make($main_file->getRealPath());
            $image_resized->resize(600, 600)->encode('png', 90);
            Storage::disk('public')->put('produkty/' . $name, $image_resized->encoded);
        }

        $product = new Product();
        $variant = new Variant();
        
        $product->description = $request->description;
        if(isset($request->available)){
            $product->available = true;
            $variant->available = true;
        }else{
            $product->available  = false;
            $variant->available = false;
        }

        $variant->name = $request->name;
        $variant->price = $request->price;
        if(isset($main_file)){
            // if (Storage::disk('public')->exists($filename)){
            //     $variant->main_image = Storage::url($filename);
            // }
            $variant->main_image = Storage::url('produkty/' . $name);
        }

        $product->available = true;
        $product->main_variant = $variant->id;

        $product->save();

        $parents = [];

        foreach ($request->categories as $category_id){
            $category = Category::find($category_id);
            if (!in_array($category->parent_id, $parents)){
                array_push($parents, $category->parent_id);
            }
        }

        $categories = array_merge($parents, $request->categories);

        $product->categories()->attach($categories);

        $variant->product_id = $product->product_id;
        $variant->on_stock = $request->on_stock;

        $variant->save();

        if(isset($request->adds)){
            foreach ($request->file('adds') as $add){
                $name = $add->hashName();
                $image_resized = Imagee::make($add->getRealPath());
                $image_resized->resize(600, 600)->encode('png', 90);
                Storage::disk('public')->put('produkty/' . $name, $image_resized->encoded);
                
                $image = new Image();
                $image->path = Storage::url('produkty/' . $name);
                $image->variant_id = $variant->id;

                $image->save();
            }
        }

        $product->main_variant = $variant->id;
        $product->save();   


        return redirect()->route('admin.product.index');return view('admin.products.index', [
            'post' => $parents
        ]);
    }
}
