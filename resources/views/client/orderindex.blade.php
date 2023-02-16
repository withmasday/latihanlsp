@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card bg-white border-0 p-3">
            <table class="table" id="orderTable">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Price / Product</th>
                    <th scope="col">Price</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Order At</th>
                    <th scope="col">Confirmed At</th>
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $order)
                  <tr>
                    <th scope="row">{{ $key+1 }}</th>
                    <td>{{ App\Models\Product::find($order->product_id)->name }}</td>
                    <td>Rp. {{ number_format(App\Models\Product::find($order->product_id)->price) }}</td>
                    <td>Rp. {{ number_format($order->price) }}</td>
                    <td>{{ $order->count }} Qty</td>
                    <td>{{ date('d-m-Y', strtotime($order->created_at)) }}</td>
                    
                    @if (strtotime($order->updated_at) === strtotime($order->created_at))
                        <td> Just Waiting... </td>
                    @else
                        <td>{{ date('d-m-Y', strtotime($order->updated_at)) }}</td>
                    @endif
                    <td>
                        @if ($order->is_confirmed == 1) 
                            <span class="badge bg-success">Confirmed</span>
                        @else
                            <span class="badge bg-warning">Pendding</span>
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