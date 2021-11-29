<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function makeOrder(Request $request){
        if (Auth::check()){
            $cart = Auth::user()->cart;
        }else{
            $cart = $request->session()->get('cart');
        }

        $payments = Payment::where('available', 1)->get();
        $shipments = Shipment::where('available', 1)->get();


        return view('shop.order.make_order', [
            'cart' => $cart,
            'payments' => $payments,
            'shipments' => $shipments
        ]);
    }

    public function postOrder(Request $request){
        $cart = null;
        if (Auth::check()){
            $cart = Auth::user()->cart;
        }
        if ($cart == null){
            $cart = new Cart();
            $cart->save();
            $session_cart = $request->session()->get('cart');
            foreach ($session_cart as $key =>$item){
                $cart_item = new CartItem();
                $cart_item->variant_id = $key;
                $cart_item->cart_id = $cart->id;
                $cart_item->quantity = $item['quantity'];
                $cart_item->save();
            }
        }
        $order = new Order();
        $order->cart_id = $cart->id;
        $order->shipment_id = $request->shipment;
        $order->status = 0;
        $order->total_price = 1;
        $order->payment_id = $request->payment;
        $order->city = $request->city;
        $order->zip = $request->postal_code;
        $order->address = $request->address;
        $order->mail = $request->email;
        $order->phone = $request->phone_number;

        $order->save();

        $cart->status = 1;
        $cart->save();
        }
}
