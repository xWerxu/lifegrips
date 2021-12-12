<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Filter;
use App\Models\FilterVariant;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index (){

        $waiting_orders = Order::where('status', 0)->get();
        $last_orders = Order::orderBy('created_at', 'desc')->take(10)->get();
        $this_month = Order::where('created_at', '>', Carbon::now()->startOfMonth())
        ->where('created_at', '<', Carbon::now()->endOfMonth())
        ->count();
        $all_orders = Order::all()->count();

        $last_customers = User::where('role', 'customer')->orderBy('created_at')->take(5)->get();


        return view('admin.panel', [
            'waiting_orders' => $waiting_orders,
            'last_orders' => $last_orders,
            'this_month' => $this_month,
            'last_customers' => $last_customers,
            'all_orders' => $all_orders,
        ]);
    }
}
