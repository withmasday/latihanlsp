@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach($data as $key => $product)
            <div class="col-sm-3">
                <div class="card border-0 m-1 mb-4" style="width: 96%;">
                    <img src="{{ url('storage', App\Models\Product::find($product->product_id)->image) }}" class="card-img-top" alt="{{ App\Models\Product::find($product->product_id)->name }}">
                    <div class="card-body">
                        <h5 class="card-title d-inline-block">
                            {{ \Illuminate\Support\Str::limit(App\Models\Product::find($product->product_id)->name, 12, '...') }}
                        </h5>
                        @if (App\Models\Product::find($product->product_id)->count > 0)
                        <span class="badge btn-warning ms-2 float-end">
                            Avaiable {{ App\Models\Product::find($product->product_id)->count }} Qty
                        </span>
                        @else
                            <span class="badge bg-danger ms-2 float-end">
                                Product Is Empty
                            </span>
                        @endif
                        <a class="text-warning d-block" style="text-decoration: none;" href="{{ route('order.show', $product->product_id) }}">Rp. {{ number_format(App\Models\Product::find($product->product_id)->price) }}</a>
                        <a class="card-text text-secondary" style="text-decoration: none;" href="{{ route('order.show', $product->product_id) }}">{{ \Illuminate\Support\Str::limit(App\Models\Product::find($product->product_id)->description, 25, '...') }}</a>
                        <div class="row mt-3">
                            <div class="col-sm-2 text-centar">
                                @if (Auth::user())
                                    <a href="{{ route('order.removewhistlist', $product->product_id) }}" class="btn btn-danger p-1 px-2">
                                        <i class="bi bi-trash"></i>
                                    </a>

                                @endif
                            </div>
                            <div class="col-sm-10">
                                <a href="{{ route('order.show', $product->product_id) }}" class="btn btn-primary w-100">
                                    Order Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection