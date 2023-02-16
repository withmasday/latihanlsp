<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Throwable;
use App\Models\Product;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $data = Product::all();
        return view('admin.product.index', ['data' => $data]);
    }

    public function create()
    {
        return view('admin.product.create');
    }

    public function store(Request $request)
    {
     try {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'count' => 'required|numeric',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('product.create')->with('error', $validator->errors());
        }

        $filename = $request->file('image')->store('image', 'public');
        
        $product = new Product();
        $product->name = $request->name;
        $product->count = $request->count;
        $product->price = $request->price;
        $product->image = $filename;
        $product->description = $request->description;
        $product->save();

        return redirect()->route('product.index')->with('success', 'Add New Product Success');
     } catch (Throwable $e) {
        return redirect()->route('product.create')->with('error', $e);
     } 
    }

    public function show($id)
    {
        try {
            $data = Product::find($id);
            return view('admin.product.show', ['data' => $data]);
         } catch (Throwable $e) {
            return redirect()->route('product.index')->with('error', $e);
         }    
    }

    public function edit($id)
    {
        try {
            $data = Product::find($id);
            return view('admin.product.edit', ['data' => $data]);
         } catch (Throwable $e) {
            return redirect()->route('product.index')->with('error', $e);
         }    
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'count' => 'required|numeric',
                'price' => 'required|numeric',
            ]);
    
            if ($validator->fails()) {
                return redirect()->route('product.edit')->with('error', $validator->errors());
            }

            $product = Product::find($id);
            if ($request->file('image')) {
                if (File::exists($product->image)) {
                    File::delete($product->image);
                }

                $filename = $request->file('image')->store('image', 'public');
            } else {
                $filename = $product->image;
            }

            $product->name = $request->name;
            $product->count = $request->count;
            $product->price = $request->price;
            $product->image = $filename;
            $product->description = $request->description;
            $product->update();
    
            return redirect()->route('product.index')->with('success', 'Update Product Success');
         } catch (Throwable $e) {
            return redirect()->route('product.edit')->with('error', $e);
         }    
    }

    public function destroy($id)
    {
        try {
            $data = Product::find($id);
            if ($data) {
                $data->delete();
                return redirect()->route('product.index')->with('success', 'Delete Product Success');
            }
            return redirect()->route('product.index')->with('error', 'Delete Product Failed');
        } catch (Throwable $e) {
            return redirect()->route('product.index')->with('error', $e);
        }
    }
}
