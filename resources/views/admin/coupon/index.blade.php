{{-- 082120QD Create user index--}}
@extends('templates.layout_admin')
@section('content')
<div class="table-agile-info">
 <div class="panel panel-default">
    <div class="panel-heading">
      Coupon Table
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
            <th data-breakpoints="xs">Name</th>
            <th data-breakpoints="xs">Start day</th>
            <th data-breakpoints="xs">End day</th>
            <th data-breakpoints="xs">Code</th>
            <th data-breakpoints="xs">Type</th>
            <th data-breakpoints="xs">Number</th>
            <th data-breakpoints="xs">Status</th>
            <th data-breakpoints="xs">                        
             <a href="{{route('coupon.create')}}" class="btn btn-primary ">Add</a>
            </th>           </tr>
        </thead>
        <tbody>
           @foreach($coupon as $cop)
          <tr data-expanded="true">
            <td>{{$cop->coupon_name}}</td>
            <td>{{$cop->start_day}}</td>
            <td>{{$cop->end_day}}</td>
            <td>{{$cop->coupon_code}}</td>
            <td>{{$cop->coupon_type}}</td>
            <td>{{$cop->coupon_number}}</td>
            <td>{{$cop->coupon_status}}</td>
            <td>
              <form action="{{route('coupon.destroy',[$cop->id])}}" method="POST">
                                @method('DELETE')
                                @csrf
                <a href="{{route('coupon.edit',[$cop->id])}}" class="btn btn-primary ">Edit</a>

             <button onclick="return confirm('You want to delete ?');" class="btn btn-danger">Delete</button> 
                                </form>       
            </td>

          </tr>
          @endforeach

        </tbody>
      </table>
    </div>
  </div>
     <div class="clearfix">
              <!-- PAGINATION -->
              <ul class="pagination position-center">
                <li><a href="javascript:void(0);" >...</a></li>
                <?php  if(isset($_GET['page'])&&$_GET['page']>4) 
                               $page=$_GET['page'];
                               else  
                               $page=3;
                      for($i=$page-2;$i<$page+3;$i++){ ?>
                <li class="{{Request::get('page')=="$i" ? "active":""}}"><a href="{{ request()->fullUrlWithQuery(['page' => "$i"]) }} " >{{$i}}</a></li>
                <?php  } ?>
                          <li><a href="javascript:void(0);" >...</a></li>
              </ul><!-- //PAGINATION -->
                            
            </div>
</div>

@endsection