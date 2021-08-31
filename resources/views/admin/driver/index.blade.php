{{-- [082130QD]load driver list--}}
@extends('templates.layout_admin')
@section('content')
<div class="table-agile-info">
 <div class="panel panel-default">
    <div class="panel-heading">
      User Table
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
            <th data-breakpoints="xs">Email</th>
            <th data-breakpoints="xs">Address</th>
            <th data-breakpoints="xs">Phone</th>
            <th data-breakpoints="xs">Role</th>
            <th data-breakpoints="xs">Status</th>
            <th data-breakpoints="xs">                        
             <a href="{{route('user.create')}}" class="btn btn-primary ">Add</a>
            </th>     
          </tr>
        </thead>
        <tbody>
           @foreach($user as $use)
          <tr data-expanded="true">
            <td>{{$use->name}}</td>
            <td>{{$use->email}}</td>
            <td>{{$use->address}}</td>
            <td>{{$use->phone}}</td>
            <td>{{$use->role}}</td>
           <td>{{$use->status}}</td>

            <td>
             <form action="{{URL::to('driver/'.$use->id)}}" method="GET">
                                @csrf
                <a href="{{route('user.edit',[$use->id])}}" class="btn btn-primary ">Edit</a>

             <button class="btn btn-danger">Orders</button> 
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