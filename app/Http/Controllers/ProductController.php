<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Validator;

class ProductController extends Controller
{
    public function create(Request $request){
        $categories = Category::whereNull('parent_id')->get();

        return view('admin.products.create', [
            'categories' => $categories,
        ]);
    }

    public function postCreate(Request $request){
        // $post = $request->all();

        // $product_validation = new Product;
        // $validation = Validator::make($details,$product_validation->setRules());


        $destinationPath = '';
        $filename        = '';

        if (isset($request->main)) {
            $file            = $request->file('main');
            $destinationPath = public_path().'/obrazy/produkty';
            $filename        = now() . '_' . $file->extension();
            $file->move($destinationPath, $filename);

            $image = new Image();
            $image->path = $destinationPath . "/" . $filename;
            $image->save();
        }

        // if($validation->fails())
        //     return Redirect::to('/add_product')->withInput()->withErrors($validation);

        // else
        // {
            $product = new Product;
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
            if(isset($image)){
                $variant->main_image_id = $image->image_id;
            }

            $product->available = true;

            $product->save();

            $variant->product_id = $product->product_id;
            $variant->on_stock = $request->on_stock;

            $variant->save();

        // }


        return view('admin.products.index', [
            'post' => $image
        ]);
    }
}
