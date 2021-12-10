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
        
        return view('user.profile', [
            'user' => $user
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

    public function adminIndex(Request $request){
        $page = $request->has('page') ? $request->get('page') : 1;
        $limit = $request->has('limit') ? $request->get('limit') : 25;
        $search = $request->has('q') ? $request->get('q') : '';

        $max = User::where('role', 'customer')->count();
        $pages = ceil($max/$limit);
        $limits = [25, 50, 100];

        $customers = User::where('role', 'customer')->where('email', 'like', '%'.$search.'%')->skip(($page - 1) * $limit)->get($limit);

        return view('admin.customers.index', [
            'customers' => $customers,
            'max' => $max,
            'pages' => $pages,
            'current_page' => $page,
            'current_limit' => $limit,
            'limits' => $limits,
            'q' => $search
        ]);
    }

    public function adminShow(Request $request, $id){
        $customer = User::where('id', $id)->where('role', 'customer')->first();
        if ($customer == null){
            return redirect()->route('admin.customer.index')->with('error', 'Nie ma takiego klienta');
        }

        $orders = $customer->orders;
        $orders->load('cart');

        return view('admin.customers.show', [
            'customer' => $customer,
            'orders' => $orders,
        ]);
    }

    public function employees(Request $request){
        $page = $request->has('page') ? $request->get('page') : 1;
        $limit = $request->has('limit') ? $request->get('limit') : 25;
        $search = $request->has('q') ? $request->get('q') : '';

        $max = User::where('role', 'customer')->count();
        $pages = ceil($max/$limit);
        $limits = [25, 50, 100];

        $customers = User::where('role', 'customer')->where('email', 'like', '%'.$search.'%')->skip(($page - 1) * $limit)->take($limit)->get();
        $employees = User::where('role', 'employee')->get();

        return view ('admin.employee.index', [
            'employees' => $employees,
            'customers' => $customers,
            'max' => $max,
            'pages' => $pages,
            'current_page' => $page,
            'current_limit' => $limit,
            'limits' => $limits,
            'q' => $search,
        ]);
    }

    public function updateEmployee(Request $request){
        $user = User::find($request->user_id);

        if (isset($request->employed)){
            $user->role = 'employee';
            $msg = 'Użytwkonik ' . $user->email . ' jest teraz pracownikiem';
        }
        elseif (isset($request->unemployed)){
            $user->role = 'customer';
            $msg = 'Użytkownik ' . $user->email . ' już nie jest pracownikiem';
        }
        $user->save();

        return redirect()->route('admin.employees.index')->with('success', $msg);
    }
}
