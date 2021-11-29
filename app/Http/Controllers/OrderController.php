<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function makeOrder(Request $request){
        $user = null;
        if (Auth::check()){
            $user = Auth::user();
            $cart = $user->cart;
        }else{
            $cart = $request->session()->get('cart');
        }


        return view('shop.order.make_order', [
            'user' => $user,
            'cart' => $cart
        ]);
    }
}
