@extends('templates.layout_admin')
@section('content')
<div class="row">
        <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Product
            </header>
             <div class="alert alert-success" role="alert">
                        </div>
             @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                     @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
            <div class="panel-body">
                <form class="form-horizontal bucket-form" action="{{route('blog.update',[$blog->id])}} " enctype='multipart/form-data' method="post">
                                                              @method('PUT')
                     @csrf
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Name </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="blog_name" value="{{$blog->blog_name}}">
                        </div>
                    </div>
                       <div class="form-group">
                     <label class="col-sm-3 control-label">Category</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="category_id">
                               @foreach($category as $cgr)
                                @if($cgr->category_parent=='0')
                                <option value="{{$cgr->id}}">{{$cgr->category_name}}</option>
                                 @foreach($category as $cgr1)
                                 @if($cgr1->category_parent==$cgr->id)
                                 @if($cgr->id=$blog->category_id)
                                <option selected value="{{$cgr1->id}}">-->{{$cgr1->category_name}}</option>
                                @else
                                <option value="{{$cgr1->id}}">-->{{$cgr1->category_name}}</option>
                                 @endif
                                 @endif
                                 @endforeach
                                @endif
                                @endforeach

                               </select>
                            </div>
                      </div>
                       <div class="form-group">
                        <label class="col-sm-3 control-label">blog summary</label>
                        <div class="col-sm-6">                        
                        <textarea class="wysihtml5 form-control" rows="5" width="400" name="blog_summary">{{$blog->blog_summary}}</textarea>
                        </div>
                    </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Content</label>
                        <div class="col-sm-6">
                        <textarea class="wysihtml5 form-control" rows="5" id="ckeditor" name="blog_content">{{$blog->blog_content}}</textarea>

                        </div>
                    </div> 
                     <div class="form-group">
                        <label class="col-sm-3 control-label">Author</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control round-input" name="blog_author" value="{{$blog->blog_author}}">
                        </div>
                    </div>
                            <div class="form-group">
                             <label class="col-sm-3 control-label">Image</label>
                                                <div class="col-sm-6">

                                    <input type="file" id="exampleInputFile" name="blog_image">
                                    <p class="help-block">Example block-level help text here.</p>
                                </div>
                           </div>
                           
                 	 
                      
                      <div class="position-center">
                      	<button type="submit" class="btn btn-info  ">Update</button>
                      </div>
                      

                </form>
            </div>
        </section>

        </div>
        </div>
@endsection