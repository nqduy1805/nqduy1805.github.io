@extends('templates.layout_admin')
@section('content')
<div class="table-agile-info">
 <div class="panel panel-default">
    <div class="panel-heading">
      Tracking page Table
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
            <th data-breakpoints="xs">Page</th>
            <th data-breakpoints="xs">Time</th>
            <th data-breakpoints="xs">Times</th>
         </tr>
        </thead>
        <tbody>
           @foreach($pagetraking as $us)
          <tr data-expanded="true">
            <td>{{$us->page}}</td>
            <td>{{$us->time}}</td>
            <td>{{$us->times}}</td>

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