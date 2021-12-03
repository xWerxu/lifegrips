<?php

namespace App\Http\Controllers;

use App\Http\Requests\CouponRequest;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index(){
        $coupons = Coupon::all();

        return view('admin.coupon.index', [
            'coupons' => $coupons
        ]);
    }

    public function create(CouponRequest $request){
        $coupon = new Coupon();

        $coupon->coupon = $request->coupon;
        $coupon->promotion = $request->promotion;
        if (isset($request->available)){
            $coupon->available = true;
        }else{
            $coupon->available = false;
        }
        if (isset($request->shipment)){
            $coupon->shipment = true;
        }else{
            $coupon->shipment = false;
        }

        $coupon->save();

        return redirect()->route('admin.coupon.index')->with('success', 'Dodano kupon rabatowy ' . $coupon->name . '!');
    }

    public function delete(Request $request){
        $coupon = Coupon::find($request->coupon_id);

        $coupon->delete();

        return redirect()->route('admin.coupon.index')->with('success', 'Usunięto kupon rabatowy ' . $coupon->name . '!');
    }

    public function update(CouponRequest $request){
        $coupon = Coupon::find($request->coupon_id);

        $coupon->coupon = $request->coupon;
        $coupon->promotion = $request->promotion;
        if (isset($request->available)){
            $coupon->available = true;
        }else{
            $coupon->available = false;
        }
        if (isset($request->shipment)){
            $coupon->shipment = true;
        }else{
            $coupon->shipment = false;
        }

        $coupon->save();

        return redirect()->route('admin.coupon.index')->with('success', 'Edytowano kupon rabatowy ' . $coupon->name . '!');
    }

}
