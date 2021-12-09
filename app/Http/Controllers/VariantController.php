<?php

namespace App\Http\Controllers;

use App\Http\Requests\VariantEditRequest;
use App\Http\Requests\VariantRequest;
use App\Models\Image;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as Imagee;

class VariantController extends Controller
{
    public function create($product_id){
        $product = Product::find($product_id);
        $categories = $product->categories;
        $categories->load('filters');

        $filters = [];
        foreach ($categories as $category){
            foreach ($category->filters as $filter){
                if (!isset($filters[$filter->id])){
                    $filters[$filter->id] = [
                        'name' => $filter->name,
                    ];
                }
            }
        }
                

        return view('admin.variants.create', [
            'product_id' => $product_id,
            'filters' => $filters
        ]);
    }

    public function postCreate(VariantRequest $request){
        $variant = new Variant();
        $variant->product_id = $request->product_id;

        $main_file = $request->file('main');
        $name = $main_file->hashName();
        $image_resized = Imagee::make($main_file->getRealPath());
        $image_resized->resize(350, 350)->encode('png', 90);
        Storage::disk('public')->put('produkty/' . $name, $image_resized->encoded);
        if(isset($main_file)){
            $variant->main_image = Storage::url('produkty/' . $name);
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
            foreach ($request->file('adds') as $add){
                $name = $add->hashName();
                $image_resized = Imagee::make($add->getRealPath());
                $image_resized->resize(350, 350)->encode('png', 90);
                Storage::disk('public')->put('produkty/' . $name, $image_resized->encoded);
                
                $image = new Image();
                $image->path = Storage::url('produkty/' . $name);
                $image->variant_id = $variant->id;

                $image->save();
            }
        }

        if (isset($request->filters)){
            foreach ($request->filters as $id => $value){
                if ($value == ""){
                    $variant->filters()->detach($id);
                }else{
                    $variant->filters()->attach($id, ['value' => $value]);
                }
                
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

        return redirect()->route('admin.product.edit', ['id' => $product_id])->with('success', 'Pomyslnie usunięto wariant' . $variant->name . '!');
    }

    public function edit($id){
        $variant = Variant::find($id);
        $product = Product::find($variant->product_id);

        $categories = $product->categories;
        $categories->load('filters');

        $filters = [];

        foreach ($variant->filters as $filter){
            $filters[$filter->id] = [
                'name' => $filter->name,
                'value' => $filter->pivot->value,
            ];
        }

        foreach ($categories as $category){
            foreach ($category->filters as $filter){
                if (!isset($filters[$filter->id])){
                    $filters[$filter->id] = [
                        'name' => $filter->name,
                        'value' => ''
                    ];
                }
            }
        }

        return view('admin.variants.edit', [
            'variant' => $variant,
            'product' => $product,
            'filters' => $filters
        ]);
    }

    public function postEdit(VariantEditRequest $request){
        $variant = Variant::find($request->variant_id);
        $variant->product_id = $request->product_id;

        if(isset($request->main)){
            $array = explode('produkty/', $variant->main_image);

            if (Storage::disk('public')->exists('produkty/' . $array[1])){
                Storage::disk('public')->delete('produkty/' . $array[1]);
            }



            $main_file = $request->file('main');
            $name = $main_file->hashName();
            $image_resized = Imagee::make($main_file->getRealPath());
            $image_resized->resize(350, 350)->encode('png', 90);
            Storage::disk('public')->put('produkty/' . $name, $image_resized->encoded);
            $variant->main_image = Storage::url('produkty/' . $name);
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
            foreach ($request->file('adds') as $add){
                $name = $add->hashName();
                $image_resized = Imagee::make($add->getRealPath());
                $image_resized->resize(350, 350)->encode('png', 90);
                Storage::disk('public')->put('produkty/' . $name, $image_resized->encoded);
                
                $image = new Image();
                $image->path = Storage::url('produkty/' . $name);
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

        if (isset($request->filters)){
            foreach ($request->filters as $id => $value){
                if ($value == ""){
                    $variant->filters()->detach($id);
                }else{
                    $variant->filters()->attach($id, ['value' => $value]);
                }
                
            }
        }

        return redirect()->route('admin.product.edit', ['id' => $request->product_id]);
    }
}
