@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach($data as $key => $product)
            <div class="col-sm-3">
                <div class="card border-0 m-1 mb-4" style="width: 96%;">
                    <img src="{{ url('storage', $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                    <div class="card-body">
                        <h5 class="card-title d-inline-block">
                            {{ \Illuminate\Support\Str::limit($product->name, 12, '...') }}
                        </h5>
                        @if ($product->count > 0)
                        <span class="badge btn-warning ms-2 float-end">
                            Avaiable {{ $product->count }} Qty
                        </span>
                        @else
                            <span class="badge bg-danger ms-2 float-end">
                                Product Is Empty
                            </span>
                        @endif
                        <a class="text-warning d-block" style="text-decoration: none;" href="{{ route('order.show', $product->id) }}">Rp. {{ number_format($product->price) }}</a>
                        <a class="card-text text-secondary" style="text-decoration: none;" href="{{ route('order.show', $product->id) }}">{{ \Illuminate\Support\Str::limit($product->description, 25, '...') }}</a>
                        <div class="row mt-3">
                            <div class="col-sm-2 text-centar">
                                @if (Auth::user())
                                    @if (App\Models\Whistlist::where('user_id', '=', Auth::user()->id)->where('product_id', '=', $product->id)->count() > 0)
                                        <a href="{{ route('order.whistlist', $product->id) }}" class="btn btn-wishlist">
                                            <i class="bi bi-bag-check-fill text-primary"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('order.whistlist', $product->id) }}" class="btn btn-wishlist">
                                            <i class="bi bi-bag-check text-primary"></i>
                                        </a>
                                    @endif
                                @else
                                <a href="{{ route('order.whistlist', $product->id) }}" class="btn btn-wishlist">
                                    <i class="bi bi-bag-check text-primary"></i>
                                </a>
                                @endif
                            </div>
                            <div class="col-sm-10">
                                <a href="{{ route('order.show', $product->id) }}" class="btn btn-primary w-100">
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