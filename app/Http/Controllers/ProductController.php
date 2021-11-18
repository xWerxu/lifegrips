<?php

namespace App\Http\Controllers;

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

class ProductController extends Controller
{
    public function adminIndex(){
        $products = Product::all();

        return view('admin.products.index', [
            'products' => $products
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
        $test = "";

        foreach ($product->variants as $variant){
            $array = explode('produkty/', $variant->main_image);
            if(Storage::disk('public')->exists('produkty/' . $array[1])){
                if (Storage::disk('public')->delete('produkty/' . $array[1])){
                    $test .= "\n GICIOR " . $variant->main_image;
                }else{
                    $test .= "\n " . $variant->main_image;
                }
            }

            foreach ($variant->images as $image){
                $array = explode('produkty/', $image->path);
                if(Storage::disk('public')->exists('produkty/' . $array[1])){
                    if (Storage::disk('public')->delete('produkty/' . $array[1])){
                        $test .= "\n GICIOR" . $image->path;
                    }else{
                        $test .= "\n " . $image->path;
                    }
                }
            }

        }

        $product->forceDelete();

        return view('admin.panel', [
            'test' => $test
        ]);
        // return redirect()->route('admin.product.index')->with('success', 'Pomyślnie usunięto produkt i jego warianty!');
    }

    public function postCreate(ProductPostRequest $request){

        if (isset($request->main)) {
            $main_file            = $request->file('main');
            $filename = Storage::disk('public')->put('produkty', $main_file);
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
            if (Storage::disk('public')->exists($filename)){
                $variant->main_image = Storage::url($filename);
            }
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
            foreach ($request->adds as $add){
                $file = $add;
                $add_file = Storage::disk('public')->put('produkty', $file);
                $image = new Image();
                $image->path = Storage::url($add_file);
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
