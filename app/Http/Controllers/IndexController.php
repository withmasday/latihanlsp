<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Whistlist;
use Illuminate\Support\Facades\Auth;
use Throwable;


class IndexController extends Controller
{
    public function index()
    {
        $data = Product::all();
        return view('home', ['data' => $data]);
    }

    public function order($id)
    {
        try {
            if (!Auth::user()) {
                return redirect()->route('login')->with('error', 'You Must Sign In First!');
            }

            $data = Product::find($id);
            return view('client.order', ['data' => $data]);
         } catch (Throwable $e) {
            return redirect()->route('index')->with('error', $e);
         }    
    }

    public function whistlist($id) {
        try {
            if (!Auth::user()) {
                return redirect()->route('login')->with('error', 'You Must Sign In First!');
            }

            $query = Whistlist::where('user_id', '=', Auth::user()->id)
                                ->where('product_id', '=', $id)->first();
            if ($query) {
                return redirect()->route('index')->with('error', 'You was added this product to whistlist');
            }

            $whistlist = new Whistlist();
            $whistlist->user_id = Auth::user()->id;
            $whistlist->product_id = $id;
            $whistlist->save();

            return redirect()->route('index')->with('success', 'Add This Product To Whistlist Success');
        } catch (Throwable $e) {
            return redirect()->route('index')->with('error', $e);
        }
    }
    
    public function allWhistlist() {
        try {
            if (!Auth::user()) {
                return redirect()->route('login')->with('error', 'You Must Sign In First!');
            }

            $data = Whistlist::where('user_id', '=', Auth::user()->id)->get();
            return view('client.whistlist', ['data' => $data]);
        } catch (Throwable $e) {
            return redirect()->route('index')->with('error', $e);
        }
    }

    public function removeWhistlist($id) {
        try {
            if (!Auth::user()) {
                return redirect()->route('login')->with('error', 'You Must Sign In First!');
            }

            Whistlist::where('user_id', '=', Auth::user()->id)
                                ->where('product_id', '=', $id)->delete();
            return redirect()->route('order.allwhistlist')->with('success', 'Remove This Product From Whistlist Success');
        } catch (Throwable $e) {
            return redirect()->route('index')->with('error', $e);
        }
    }
}
