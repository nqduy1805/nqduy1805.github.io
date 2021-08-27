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
            <th data-breakpoints="xs">Ip</th>
            <th data-breakpoints="xs">City</th>
            <th data-breakpoints="xs">Region</th>
            <th data-breakpoints="xs">Country</th>
            <th data-breakpoints="xs">Access number</th>
            <th data-breakpoints="xs">Status</th>
            <th data-breakpoints="xs"></th>
         </tr>
        </thead>
        <tbody>
           @foreach($user as $us)
          <tr data-expanded="true">
            <td>{{$us['ip']}}</td>
            <td>{{$us['City']}}</td>
            <td>{{$us['Region']}}</td>
            <td>{{$us['Country']}}</td>
            <td></td>
            <td></td>
            <td>
            <form action="{{URL::to('detail_order/'.$us->id)}}" method="GET">
                                @csrf
             <button onclick="" class="btn btn-primary ">Detail</button> 
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