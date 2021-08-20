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
            <th data-breakpoints="xs">  Category name </th>
            <th data-breakpoints="xs">image</th>
            <th data-breakpoints="xs">Summary</th>
            <th data-breakpoints="xs">                        
             <a href="{{route('blog.create')}}" class="btn btn-primary ">Add</a>
</th>
         </tr>
        </thead>
        <tbody>
           @foreach($blog as $bl)
          <tr data-expanded="true">
            <td>{{$bl->blog_name}}</td>
            <td>{{$bl->category->category_name}}</td>
            <td><image src="{{asset('image/blog/'.$bl->blog_image)}}" width="100" heigh="100"></td>
             <td>{{$bl->blog_summary}}</td>
            <td>
            <form action="{{route('blog.destroy',[$bl->id])}}" method="POST">
                                @method('DELETE')
                                @csrf
                <a href="{{route('blog.edit',[$bl->id])}}" class="btn btn-primary ">Edit</a>
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