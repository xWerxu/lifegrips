<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request){
        $variant = Variant::findOrFail($request->variant_id);

        if(Auth::check()){
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

            return response($cart->items->count());
            

        }else{
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

            return response($count);
        }
    }
}
