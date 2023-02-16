<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Throwable;

class OrderController extends Controller
{
    public function index() {
        $data = Order::where('user_id', '=', Auth::user()->id)->get();
        return view('client.orderindex', ['data' => $data]);
    }

    public function store(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'count' => 'required|numeric',
            ]);
    
            if ($validator->fails()) {
                return redirect()->route('index')->with('error', $validator->errors());
            }
            
            $product = Product::find($id);
            $newCount = $product->count - $request->count;

            if ($newCount <= 0) {
                return redirect()->route('order.show', $id)->with('error', 'Jumlah Barang Yang Di Minta Tidak Mencukupi Saat Ini');
            }

            $price = $product->price * $request->count;
            $order = new Order();
            $order->count = $request->count;
            $order->user_id = Auth::user()->id;
            $order->product_id = $id;
            $order->is_confirmed = false;
            $order->price = $price;
            $order->save();

            $product->count = $newCount;
            $product->update();
    
            return redirect()->route('order.orderindex')->with('success', 'Add New Product Success');
         } catch (Throwable $e) {
            return redirect()->route('order.show', $id)->with('error', $e);
         } 
    }

}
