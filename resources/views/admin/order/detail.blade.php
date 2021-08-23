@extends('templates.layout_admin')
@section('content')
<div class="table-agile-info">
 <div class="panel panel-default">
    <div class="panel-heading">
     Detail Product Table

    </div>
    <div>
         @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
      <table class="table" ui-jq="footable" ui-options="{
        &quot;paging&quot;: {
          &quot;enabled&quot;: true
        },
        &quot;filtering&quot;: {
          &quot;enabled&quot;: true
        },
        &quot;sorting&quot;: {
          &quot;enabled&quot;: true
        }}">
        <thead>

          <tr>            
          	<th data-breakpoints="xs">Image</th>
            <th data-breakpoints="xs">Product Name</th>
            <th data-breakpoints="xs">Price</th>
            <th data-breakpoints="xs">Quantity</th>
            <th data-breakpoints="xs">Subtotal</th>
            <th data-breakpoints="xs">Size</th>
            <th data-breakpoints="xs">Pricec</th>
         </tr>
        </thead>
        <tbody>
           @foreach($order as $od)
          <tr data-expanded="true">
          	<td><image src="{{asset('image/product/'.$od->product->product_image)}}" width="40" heigh="40"></td>
            <td>{{$od->product->product_name}}</td>
            <td>${{$od->order_price}}</td>
            <td>{{$od->order_qty}}</td>
            <td>${{$od->order_subtotal}}</td>
            <td>{{$od->order_size}}</td>
            <td>${{$od->order_sale}}</td>
          </tr>
          @endforeach

        </tbody>
      </table>
      <a href="{{URL::to('complete/'.$od->order_id)}}" class="btn btn-primary ">Complete</a>

    </div>
  </div>
</div>

@endsection