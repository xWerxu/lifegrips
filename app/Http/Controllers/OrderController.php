<?php

namespace App\Http\Controllers;

use App\Http\Requests\MakeOrderRequest;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;

class OrderController extends Controller
{
    public function makeOrder(Request $request){
        $total_price = 0;
        $free_shipment = 0;
        if (Auth::check()){
            $cart = Auth::user()->cart;
            $coupon = $cart->coupon;
            if ($coupon != null){
                $free_shipment = $coupon->shipment;
            }
            foreach ($cart->items as $item){
                $total_price += $item->quantity * $item->variant->price;
            }
        }else{
            $cart = $request->session()->get('cart');
            $tmp = $request->session()->get('coupon');
            foreach ($cart as $item){
                $total_price += $item['quantity'] * $item['price'];
            }
            if ($tmp != null){
                $coupon = Coupon::where('coupon', $tmp);
                if ($coupon != null){
                    $free_shipment = $coupon->shipment;
                }
            }else{
                $coupon = null;
            }
        }

        $payments = Payment::where('available', 1)->get();
        $shipments = Shipment::where('available', 1)->get();


        return view('shop.order.make_order', [
            'cart' => $cart,
            'payments' => $payments,
            'shipments' => $shipments,
            'coupon' => $coupon,
            'total_price' => $total_price,
            'free_shipment' => $free_shipment
        ]);
    }

    public function postOrder(MakeOrderRequest $request){
        $cart = null;
        $total_price = 0;
        if (Auth::check()){
            $cart = Auth::user()->cart;
            foreach ($cart->items as $item){
                $variant = $item->variant;
                $total_price += $variant->price * $item->quantity;
            }
        }
        if ($cart == null){
            $cart = new Cart();
            $tmp = $request->session()->get('coupon');
            $coupon = Coupon::where('coupon', $tmp);
            if ($coupon != null){
                $cart->coupon_id = $coupon->id;
            }
            $cart->save();
            $session_cart = $request->session()->get('cart');
            foreach ($session_cart as $key =>$item){
                $cart_item = new CartItem();
                $cart_item->variant_id = $key;
                $cart_item->cart_id = $cart->id;
                $cart_item->quantity = $item['quantity'];
                $cart_item->save();
                $total_price += $item['price'] * $item['quantity'];
            }
        }

        $cart_coupon = $cart->coupon;
        if ($cart_coupon != null && $cart_coupon->promotion > 0){
            $total_price = ($total_price / 100) * (100 - $cart_coupon->promotion);
        }

        $total_price = number_format($total_price, 2);

        $order = new Order();
        $order->first_name = $request->first_name;
        $order->last_name = $request->last_name;
        $order->cart_id = $cart->id;
        $order->shipment_id = $request->shipment;
        $order->status = 0;
        $order->total_price = $total_price;
        $order->payment_id = $request->payment;
        $order->city = $request->city;
        $order->zip = $request->postal_code;
        $order->address = $request->address;
        $order->mail = $request->email;
        $order->phone = $request->phone_number;

        $order->save();

        $cart->status = 1;
        $cart->save();

        $total = $cart->total_price;
        if ($cart_coupon != null && $cart_coupon->shipment =  1){
            $shipment_price = 0;
        }else{
            $shipment_price = $order->shipment->price;
        }

        return view('shop.order.thank_you', [
            'order' => $order,
            'shipment_price' => $shipment_price
        ]);
        
        }

        public function adminIndex(Request $request){
            $page = $request->has('page') ? $request->get('page') : 1;
            $limit = $request->has('limit') ? $request->get('limit') : 10;

            $max = Order::count();
            $pages = ceil($max/$limit);
            $limits = [25, 50, 100];

            $orders = Order::all()->skip(($page - 1) * $limit)->take($limit);

            return view('admin.order.index', [
                'orders' => $orders,
                'max' => $max,
                'pages' => $pages,
                'current_page' => $page,
                'current_limit' => $limit,
                'limits' => $limits
            ]); 
        }

        public function edit($id){
            $order = Order::findOrFail($id);

            if ($order->status == 0){
                return view('admin.order.edit', [
                    'order' => $order
                ]);
            }

            return view('admin.order.show', [
                'order' => $order
            ]);
        }

        public function update(Request $request, $id){
            $order = Order::findOrFail($id);
            if (isset($request->action) && $request->action == "cancel"){
                $order->status = 2;
                $order->save();
                return redirect()->route('admin.order.edit', ['id' => $id])->with('success', 'Anulowano zamówienie.');
            }
            $cart = $order->cart;
            $items = $request->item;
            $total_price = 0;
            foreach ($request->item as $item_id => $quantity){
                $cartItem = CartItem::find($item_id);
                $variant = $cartItem->variant;
                if ($quantity > $variant->on_stock){
                    return redirect()->route('admin.order.edit', ['id' => $id])->with('quantityError', 'Zamówiona ilość produktu ' . $variant->name . ' nie może być większa niż ilość tego produktu w magazynie!');
                }
                $cartItem->quantity = $quantity;
                $cartItem->save();
                $variant->on_stock -= $quantity;
                $variant->save();
                $total_price += $variant->price * $cartItem->quantity;
            }

            $cart_coupon = $cart->coupon;
            if ($cart_coupon != null && $cart_coupon->promotion > 0){
                $total_price = ($total_price / 100) * (100 - $cart_coupon->promotion);
            }

            $total_price = number_format($total_price, 2);
            $order->total_price = $total_price;
            $order->status = 1;
            $order->save();

            return redirect()->route('admin.order.edit', ['id' => $id])->with('success', 'Zatwierdzono zamówienie.');
        }
}
