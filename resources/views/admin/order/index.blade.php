@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card bg-white border-0 p-3">
            <table class="table" id="orderTable">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Client Name</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Price / Product</th>
                    <th scope="col">Price</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Order At</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $order)
                  <tr>
                    <th scope="row">{{ $key+1 }}</th>
                    <td>{{ Auth::user()->username }}</td>
                    <td>{{ App\Models\Product::find($order->product_id)->name }}</td>
                    <td>Rp. {{ number_format(App\Models\Product::find($order->product_id)->price) }}</td>
                    <td>Rp. {{ number_format($order->price) }}</td>
                    <td>{{ $order->count }} Qty</td>
                    <td>{{ date('d-m-Y', strtotime($order->created_at)) }}</td>
                    <td>
                        @if ($order->is_confirmed == 1) 
                            <span class="badge bg-success">Confirmed</span>
                        @else
                            <span class="badge bg-warning">Pendding</span>
                        @endif
                    </td>
                    <td>
                      @if ($order->is_confirmed == 0) 
                        <a href="{{ route('order.confirm', $order->id) }}" class="btn btn-primary">Confirm Now</a>
                      @else
                        <a href="{{ route('order.cancle', $order->id) }}" class="btn btn-warning">Remove Order</a>
                      @endif
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
        </div>
    </div>
@endsection

@section('javascript')
<script type="text/javascript">
    $(document).ready(function () {
        $('#orderTable').DataTable();
    });
</script>
@endsection