<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ArticleController extends Controller
{
    public function index(){
        $articles = Article::all();

        return view('admin.article.index', [
            'articles' => $articles
        ]);
    }

    public function create(){
        $products = Product::where('available', 1)->get();

        return view('admin.article.create', [
            'products' => $products
        ]);
    }

    public function postCreate(ArticleRequest $request){
        $article = new Article();

        $image = $request->file('image');
        $name = $image->hashName();
        $image_resized = Image::make($image->getRealPath());
        $image_resized->resize(500, 300)->encode('png', 90);
        Storage::disk('public')->put('bannery/' . $name, $image_resized->encoded);
        $article->image = Storage::url('bannery/' . $name);

        $article->title = $request->title;
        $article->background_color = $request->background_color;
        $article->short_description = $request->short_description;
        $article->content = $request->content;
        $article->background_products = $request->background_products;
        $article->image_position = $request->image_position;

        if (isset($request->published)){
            $article->published = true;
        }else{
            $article->published = false;
        }

        $article->save();

        if (isset($request->products)){
            $article->products()->attach($request->products);
        }

        return redirect()->route('admin.article.index')->with('success', 'Pomyślnie utworzono artykuł ' . $article->title);
    }

    public function delete(Request $request){
        $article = Article::find($request->article_id);

        $article->products()->detach();

        $array = explode('bannery/', $article->image);
        if (Storage::disk('public')->exists('bannery/' . $array[1])){
            Storage::disk('public')->delete('bannery/' . $array[1]);
        }

        $article->delete();

        return redirect()->route('admin.article.index')->with('success', 'Usunięto artykuł ' . $article->title);
    }

    public function edit($id){
        $article = Article::find($id);
        $products = Product::where('available', 1)->get();

        $selected_products = $article->products;
        $selected = [];
        foreach ($selected_products as $product){
            array_push($selected, $product->product_id);
        }

        return view('admin.article.edit', [
            'article' => $article,
            'products' => $products,
            'selected' => $selected,
        ]);
    }

    public function update(Request $request){
        $article = Article::find($request->article_id);

        if ($request->hasFile('image')){
            $array = explode('bannery/', $article->image);
            if (Storage::disk('public')->exists('bannery/' . $array[1])){
                Storage::disk('public')->delete('bannery/' . $array[1]);
            }

            $image = $request->file('image');
            $name = $image->hashName();
            $image_resized = Image::make($image->getRealPath());
            $image_resized->resize(500, 300)->encode('png', 90);
            Storage::disk('public')->put('bannery/' . $name, $image_resized->encoded);
            $article->image = Storage::url('bannery/' . $name);
        }
        
        $article->title = $request->title;
        $article->background_color = $request->background_color;
        $article->short_description = $request->short_description;
        $article->content = $request->content;
        $article->background_products = $request->background_products;
        $article->image_position = $request->image_position;

        if (isset($request->published)){
            $article->published = true;
        }else{
            $article->published = false;
        }

        if (isset($request->products)){
            $article->products()->sync($request->products);
        }else{
            $article->products()->detach();
        }

        $article->save();

        return redirect()->route('admin.article.index')->with('success', 'Pomyślnie edytowano artykuł ' . $article->title);
    }
}
