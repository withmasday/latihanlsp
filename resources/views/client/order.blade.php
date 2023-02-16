@extends('layouts.app')

@section('content')
    <form method="POST" class="container" action="{{ route('order.create', $data->id) }}">
        @csrf
        <div class="card border-0">
            <div class="row">
                <div class="col-sm-5">
                    <img src="{{ url('storage', $data->image) }}" class="w-100 h-100 rounded-start" />
                </div>
                <div class="col-sm-7 p-3">
                    <h3 class="d-inline-block">{{ \Illuminate\Support\Str::limit($data->name, 50, '...') }}</h3>
                    @if ($data->count > 0)
                        <span class="badge btn-warning me-2 float-end">
                            Avaiable {{ $data->count }} Qty
                        </span>
                    @else
                        <span class="badge bg-danger me-2 float-end">
                            Product Is Empty
                        </span>
                    @endif

                    <div class="mt-3">
                        <h6 class="text-warning text-bold">Rp. {{ number_format($data->price) }}</h6>
                        <p class="text-secondary">{{ $data->description }}</p>
                    </div>

                    <div class="mt-3">
                        <label class="d-block">Count </label>
                        <input type="number" class="form-controll border-0 bg-white border-bottom border-2 text-dark" style="width: 50px;" name="count"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="fixed-bottom mb-3 container">
            <div class="row">
                <div class="col-sm-2">
                    <a href="{{ route('index') }}" class="btn btn-warning w-100 py-2">Kembali</a>
                </div>
                <div class="col-sm-8"></div>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-primary w-100 py-2">Order Now</button>
                </div>
            </div>
        </div>
    </form>
@endsection
