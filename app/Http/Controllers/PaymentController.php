<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(){
        $payments = Payment::all();

        return view('admin.payment.index', [
            'payments' => $payments
        ]);
    }

    public function create(PaymentRequest $request){
        $payment = new Payment();

        $payment->name = $request->name;
        $payment->fee = $request->fee;
        if (isset($request->available)){
            $payment->available = true;
        }else{
            $payment->available = false;
        }

        $payment->save();

        return redirect()->route('admin.payment.index')->with('success', 'Dodano opcję płatności ' . $payment->name . '!');
    }

    public function delete(Request $request){
        $payment = Payment::find($request->payment_id);

        $payment->delete();

        return redirect()->route('admin.payment.index')->with('success', 'Usunięto opcję płatności ' . $payment->name . '!');
    }

    public function update(PaymentRequest $request){
        $payment = Payment::find($request->payment_id);

        $payment->name = $request->name;
        $payment->fee = $request->fee;
        if (isset($request->available)){
            $payment->available = true;
        }else{
            $payment->available = false;
        }

        $payment->save();

        return redirect()->route('admin.payment.index')->with('success', 'Edytowano opcję płatności ' . $payment->name . '!');
    }

}
