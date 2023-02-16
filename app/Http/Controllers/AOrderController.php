<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Throwable;

class AOrderController extends Controller
{
    public function index() {
        try {
            $data = Order::all();
            return view('admin.order.index', ['data' => $data]);
        } catch (Throwable $e) {
            return redirect()->route('dashboard')->with('error', $e);
        }
    }

    public function confirm($id) {
        try {
            $confirm = Order::find($id);
            $confirm->is_confirmed = true;
            $confirm->save();
            return redirect()->route('admin.order.index')->with('success', 'Confirm This Order Product Successfully');
        } catch (Throwable $e) {
            return redirect()->route('dashboard')->with('error', $e);
        }
    }

    public function cancle($id) {
        try {
            $confirm = Order::find($id);
            $confirm->is_confirmed = false;
            $confirm->save();
            return redirect()->route('admin.order.index')->with('success', 'Confirm This Order Product Successfully');
        } catch (Throwable $e) {
            return redirect()->route('dashboard')->with('error', $e);
        }
    }
}
