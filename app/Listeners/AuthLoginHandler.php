<?php

namespace App\Listeners;

use App\Models\CartItem;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class AuthLoginHandler
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(Login $event)
    {
        if ($cart = Auth::user()->cart){
            $session_cart = $this->request->session()->get('cart');
            if ($session_cart != null){
                foreach ($session_cart as $key => $item){
                    $cartItem = CartItem::where(['cart_id' => $cart->id, 'variant_id' => $key])->first();
                    if ($cartItem == null){
                        $newItem = new CartItem();
                        $newItem->cart_id = $cart->id;
                        $newItem->variant_id = $key;
                        $newItem->quantity = $item['quantity'];
                        $newItem->save();
                    }else{
                        $cartItem->quantity += $item['quantity'];
                        $cartItem->save();
                    }
                }
            }
        }
        else{
            $session_cart = $this->request->session()->get('cart');
            if ($session_cart != null){
                $cart = new Cart();
                $cart->client_id = Auth::user()->id;
                $cart->status = 0;
                $cart->save();
                foreach ($session_cart as $key => $item){
                    $newItem = new CartItem();
                    $newItem->cart_id = $cart->id;
                    $newItem->variant_id = $key;
                    $newItem->quantity = $item['quantity'];
                    $newItem->save();
                }
            }
        }
        $this->request->session()->forget('cart');
    }
}
