<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Filter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index (){
        $user = Auth()->user();
        $cart = $user->cart;

        // $test=Category::find(2);
        // $filters = $test->filters;
        // foreach ($filters as $filter){
        //     $products = $filter->variants;
        // }

            // $filter = Filter::find(1);
            // $products = count($filter->filteredVariants(['Czerwony']));

        // $test = Filter::all();
        // $test->load('categories');

        return view('admin.panel', [
            // 'products' => $products
        ]);
    }
}
