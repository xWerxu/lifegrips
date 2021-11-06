<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class UsersController extends Controller
{
    public function index(){
        $user = Auth::user();
        $product = Product::find(1);
        $test = $product->images()->get();

        $category = Category::find(1);
        $test = $category->products()->get();
        
        return view('user.profile', [
            'user' => $user,
            'test' => $test
        ]);
    }

    public function update(Request $request){
        $user = Auth::user();
        
        $user_model = User::find($user->id);

        $user_model->first_name = $request->first_name;
        $user_model->last_name = $request->last_name;
        $user_model->phone_number = $request->phone_number;
        $user_model->city = $request->city;
        $user_model->address = $request->address;
        $user_model->postal_code = $request->postal_code;

        $user_model->save();

        return redirect()->route('user.profile');
    }
}
