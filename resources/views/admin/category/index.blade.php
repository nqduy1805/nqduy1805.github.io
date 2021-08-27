@extends('templates.layout_admin')
@section('content')
<div class="table-agile-info">
 <div class="panel panel-default">
    <div class="panel-heading">
     Category table
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
            <th data-breakpoints="xs"> Name</th>
            <th> Parent</th>
            <th data-breakpoints="xs">status</th>
            <th data-breakpoints="xs">                        
             <a href="{{route('category.create')}}" class="btn btn-primary ">Add</a>
</th>

         </tr>
        </thead>
        <tbody>
           @foreach($categoryad as $cgr)
          <tr data-expanded="true">
            <td>{{$cgr->category_name}}</td>
            <td>@if($cgr->category_parent==0){{'Category parent'}} @else {{$cgr->category->category_name}} @endif</td>
            <td>@if($cgr->category_status==0){{'on'}} @else {{'off'}} @endif</td>
            <td>
              <form action="{{route('category.destroy',[$cgr->id])}}" method="POST">
                                @method('DELETE')
                                @csrf
           <a href="{{route('category.edit',[$cgr->id])}}" class="btn btn-primary ">Edit</a>

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