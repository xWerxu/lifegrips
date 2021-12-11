<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Coupon;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Do formularza:
     *  -variant_id -> id variantu
     *  -quantity -> ilość produktów
     */
    public function addToCart(Request $request){
        $variant = Variant::findOrFail($request->variant_id);

        if(Auth::check()){
            $logged = true;
            $user = Auth::user();
            $cart = $user->cart;
            if($cart == null){
                $cart = new Cart();
                $cart->client_id = $user->id;
                $cart->status = 0;
                $cart->save();
            }
            $found = false;
            foreach ($cart->items as $cart_item){
                if ($cart_item->variant_id == $variant->id){
                    $item = CartItem::find($cart_item->id);
                    $item->quantity += $request->quantity;
                    $found = true;
                    $item->save();
                    break;
                }
            }
            if ($found == false){
                $item = new CartItem();
                $item->variant_id = $variant->id;
                $item->cart_id = $cart->id;
                $item->quantity = $request->quantity;
                $item->save();
            }

            $cart->refresh();
            $cart->load('items');
            $items_count = count($cart->items);

            $array = [
                'cart' => $cart,
                'logged' => $logged,
                'items_count' => $items_count
            ];

            return json_encode($array);
            

        }else{
            $logged = false;
            $cart = $request->session()->get('cart');
        
            if(isset($cart[$request->variant_id])){
                $cart[$request->variant_id]['quantity'] += $request->quantity;
            }else{
                $cart[$request->variant_id] = [
                    'name' => $variant->name,
                    'image' => $variant->main_image,
                    'price' => $variant->price,
                    'quantity' => $request->quantity
                ];
            }

            $count = 0;
            foreach ($cart as $item){
                $count++;
            }

            $request->session()->put('cart', $cart);
            $items_count = count($request->session()->get('cart'));


            $array = [
                'cart' => $cart,
                'logged' => $logged,
                'items_count' => $items_count
            ];

            return json_encode($array);
        }
    }

    /**
     * Do formularza:
     *  - item_id
     *      -> w przypadku zalogowanego klienta cartItem->id
     *      -> niezalogowany: klucz arraya zawierającego informacje o itemie
     *        
     */
    public function removeItem(Request $request){
        if (Auth::check()){
            $logged = true;
            $item = CartItem::find($request->item_id);
            $item->forceDelete();
            $cart = Auth::user()->cart;
            $cart->load('items');
            $items_count = count($cart->items);
        }else{
            $logged = false;
            $cart = $request->session()->get('cart');
            if (array_key_exists($request->item_id, $cart)){
                unset($cart[$request->item_id]);
            }
            $request->session()->put('cart', $cart);
            $items_count = count($request->session()->get('cart'));
        }

        $array = [
            'cart' => $cart,
            'logged' => $logged,
            'items_count' => $items_count
        ];

        return json_encode($array);
    }

    public function updateCart(Request $request){
        $array = $request->quantity;
        $coupon = Coupon::where('coupon', $request->coupon)->first();

        if (Auth::check()){
            foreach ($array as $id => $quantity){
                $cart = Auth::user()->cart;
                $item = CartItem::find($id);
                $item->quantity = $quantity;
                if ($coupon != null){
                    $cart->coupon_id = $coupon->id; 
                    $cart->save();
                }
                $item->save();
            }
        }else{
            $cart = $request->session()->get('cart');
            foreach ($array as $id => $quantity){
                $cart[$id]['quantity'] = $quantity;
            }
            if ($coupon != null){
                 $request->session()->put('coupon', $coupon->coupon);
            }
            $request->session()->put('cart', $cart);
        }
        

        return redirect()->route('cart');
    }

    public function index(Request $request){
        if(Auth::check()){
            $cart = Auth::user()->cart;
            $coupon = null;
        }else{
            $cart = $request->session()->get('cart');
            $coupon = $request->session()->get('coupon');
        }

        return view('shop.cart', [
            'cart' => $cart,
            'coupon' => $coupon
        ]);
    }
}
