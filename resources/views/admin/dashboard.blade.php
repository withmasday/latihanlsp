@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-3 mt-3">
            <div class="col-sm-5">
                <h5 class="d-inline-block">DAFTAR PRODUK</h5>
                <span class="badge btn-primary d-inline ms-2">{{ count(App\Models\Product::all()) }}</span>
            </div>
            <div class="col-sm-7 text-end">
                <a href="{{ route('product.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg me-2"></i> New Product</a>
            </div>
        </div>
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
                        <a class="text-warning d-block" style="text-decoration: none;" href="{{ route('product.show', $product->id) }}">Rp. {{ number_format($product->price) }}</a>
                        <a class="card-text text-secondary" style="text-decoration: none;" href="{{ route('product.show', $product->id) }}">{{ \Illuminate\Support\Str::limit($product->description, 25, '...') }}</a>
                        <div class="row mt-3">
                            <div class="col-sm-2 text-centar">
                                <a href="{{ route('product.destroy', $product->id) }}" class="btn btn-wishlist">
                                    <i class="bi bi-trash-fill text-danger"></i>
                                </a>
                            </div>
                            <div class="col-sm-10">
                                <a href="{{ route('product.edit', $product->id)}}" class="btn btn-primary w-100">
                                    Edit Product
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