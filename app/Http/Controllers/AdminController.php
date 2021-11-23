<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index (){
        $user = Auth()->user();
        $cart = $user->cart->items;

        return view('admin.panel', [
            'test' => $cart
        ]);
    }
}
