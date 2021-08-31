    {{-- //[082130QD]load driver's orders when selected driver --}}
@extends('templates.layout_admin')
@section('content')
<div class="table-agile-info">
 <div class="panel panel-default">
    <div class="panel-heading">
      Order Table
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
            <th data-breakpoints="xs">adress</th>
            <th data-breakpoints="xs">Phone</th>
            <th data-breakpoints="xs">Email</th>
            <th data-breakpoints="xs">Total</th>
            <th data-breakpoints="xs">Status</th>
            <th data-breakpoints="xs"><form action="{{URL::to('map/'.$id)}}" method="GET">
                                @csrf
             <button onclick="" class="btn btn-primary ">show map</button> 
            </form>    
            </th>
         </tr>
        </thead>
        <tbody>
           @foreach($order as $od)
          <tr data-expanded="true">
            <td>{{$od->name}}</td>
            <td>{{$od->adress1}}</td>
            <td>{{$od->phone}}</td>
            <td>{{$od->email}}</td>
            <td>${{$od->order_total}}</td>
            <td>{{$od->order_status}}</td>
            <td>
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