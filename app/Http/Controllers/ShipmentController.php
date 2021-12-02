<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShipmentRequest;
use App\Models\Shipment;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    public function index(){
        $shipments = Shipment::all();

        return view('admin.shipment.index', [
            'shipments' => $shipments
        ]);
    }

    public function create(ShipmentRequest $request){
        $shipment = new Shipment();

        $shipment->name = $request->name;
        $shipment->price = $request->price;
        if (isset($request->available)){
            $shipment->available = true;
        }else{
            $shipment->available = false;
        }

        $shipment->save();

        return redirect()->route('admin.shipment.index')->with('success', 'Dodano opcję dostawy ' . $shipment->name . '!');
    }

    public function delete(Request $request){
        $shipment = Shipment::find($request->shipment_id);

        $shipment->delete();

        return redirect()->route('admin.shipment.index')->with('success', 'Usunięto opcję dostawy ' . $shipment->name . '!');
    }

    public function update(ShipmentRequest $request){
        $shipment = Shipment::find($request->shipment_id);

        $shipment->name = $request->name;
        $shipment->price = $request->price;
        if (isset($request->available)){
            $shipment->available = true;
        }else{
            $shipment->available = false;
        }

        $shipment->save();

        return redirect()->route('admin.shipment.index')->with('success', 'Edytowano opcję dostawy ' . $shipment->name . '!');
    }
}
