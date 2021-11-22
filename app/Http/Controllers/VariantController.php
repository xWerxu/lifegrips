<?php

namespace App\Http\Controllers;

use App\Http\Requests\VariantEditRequest;
use App\Http\Requests\VariantRequest;
use App\Models\Image;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VariantController extends Controller
{
    public function create($product_id){
        

        return view('admin.variants.create', [
            'product_id' => $product_id,
        ]);
    }

    public function postCreate(VariantRequest $request){
        $variant = new Variant();
        $variant->product_id = $request->product_id;

        $main_file = $request->file('main');
        $filename = Storage::disk('public')->put('produkty', $main_file);

        $variant->name = $request->name;
        $variant->on_stock = $request->on_stock;
        $variant->price = $request->price;
        if (Storage::disk('public')->exists($filename)){
            $variant->main_image = Storage::url($filename);
        }
        if (isset($request->available)){
            $variant->available = true;
        }else{
            $variant->available = false;
        }

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

        return redirect()->route('admin.product.edit', ['id' => $request->product_id]);

    }

    public function delete(Request $request){
        $variant = Variant::find($request->variant_id);
        $product_id = $variant->product_id;
        $test = "";

        $array = explode('produkty/', $variant->main_image);

        if (Storage::disk('public')->exists('produkty/' . $array[1])){
            if (Storage::disk('public')->delete('produkty/' . $array[1])){
                $test .= "\n gicior " . $variant->main_image;
            }else{
                $test .= "\n " . $variant->main_image;
            }
        }

        foreach ($variant->images as $image){
            $array = explode('produkty/', $image->path);
            if(Storage::disk('public')->exists('produkty/' . $array[1])){
                if (Storage::disk('public')->delete('produkty/' . $array[1])){
                    $test .= "\n gicior " . $image->path;
                }else{
                    $test .= "\n " . $image->path;
                }
            }
        }

        $variant->forceDelete();

        return redirect()->route('admin.product.edit', ['id' => $product_id])->with('success', $test);
    }

    public function edit($id){
        $variant = Variant::find($id);
        $product = Product::find($variant->product_id);

        return view('admin.variants.edit', [
            'variant' => $variant,
            'product' => $product
        ]);
    }

    public function postEdit(VariantEditRequest $request){
        $variant = Variant::find($request->variant_id);
        $variant->product_id = $request->product_id;

        if(isset($request->main)){
            $main_file = $request->file('main');
            $filename = Storage::disk('public')->put('produkty', $main_file);
            if (Storage::disk('public')->exists($filename)){
                $variant->main_image = Storage::url($filename);
            }
        }

        $variant->name = $request->name;
        $variant->on_stock = $request->on_stock;
        $variant->price = $request->price;
        if (isset($request->available)){
            $variant->available = true;
        }else{
            $variant->available = false;
        }

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

        if(isset($request->remove)){
            foreach($request->remove as $image_id){
                $image = Image::find($image_id);
                $array = explode('produkty/', $image->path);

                if (Storage::disk('public')->exists('produkty/' . $array[1])){
                    Storage::disk('public')->delete('produkty/' . $array[1]);
                }
        
                $image->forceDelete();
            }
        }

        return redirect()->route('admin.variant.edit', ['id' => $request->variant_id]);
    }
}
