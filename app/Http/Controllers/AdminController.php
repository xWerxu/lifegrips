<?php

namespace App\Http\Controllers;

use App\Models\Filter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index (){
        $user = Auth()->user();
        $cart = $user->cart;

        $test = Filter::all();
        $test->load('categories');

        return view('admin.panel', [
            'test' => $test
        ]);
    }
}
