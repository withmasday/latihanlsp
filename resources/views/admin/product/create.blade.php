@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card border-0 p-3">
            <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data" accept-charset="utf-8">
                @csrf
                <h5>ADD NEW PRODUCT</h5>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3 mt-3">
                            <label class="mb-2">Product Name</label>
                            <input type="text" class="border-0 form-control" name="name" />
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="mb-3 mt-3">
                            <label class="mb-2">Product Count</label>
                            <input type="number" class="border-0 form-control" name="count" />
                            @error('count')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="mb-3 mt-3">
                            <label class="mb-2">Product Price</label>
                            <input type="number" class="border-0 form-control" name="price" />
                            @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="mb-3 mt-3">
                            <label class="mb-2">Product Image</label>
                            <input type="file" class="form-control" name="image" />
                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="mb-3 mt-3">
                            <label class="mb-2">Product Description</label>
                            <textarea class="border-0 form-control" name="description" rows="8"></textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <a href="{{ route('dashboard') }}" class="btn btn-warning px-5 py-2">Kembali</a>
                    </div>
                    <div class="col-sm-6 text-end">
                        <button type="submit" class="btn btn-primary px-5 py-2">
                            <i class="bi bi-plus-lg me-2"></i> Add New</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
