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
                <form class="form-horizontal bucket-form" action="{{route('product.update',[$product->id])}} " enctype='multipart/form-data' method="post">
                     @method('PUT')
                     @csrf

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Product Name </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="product_name" value="{{$product->product_name}}">
                        </div>
                    </div>
                       <div class="form-group">
                     <label class="col-sm-3 control-label">Category Name</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="category_id">
                             @foreach($category as $cgr)
                                @if($cgr->category_parent=='0')
                                <option value="{{$cgr->id}}">{{$cgr->category_name}}</option>
                                 @foreach($category as $cgr1)
                                 @if($cgr1->category_parent==$cgr->id)
                                 @if($cgr->id=$product->category_id)
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
                        <label class="col-sm-3 control-label">Product price</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control round-input" name="product_price" value="{{$product->product_price}}">
                        </div>
                    </div> 
                     <div class="form-group">
                        <label class="col-sm-3 control-label">Product quality</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control round-input" name="product_quality" value="{{$product->product_quality}}">
                        </div>
                    </div>

                       <div class="form-group">
                        <label class="col-sm-3 control-label">Product info</label>
                        <div class="col-sm-6">
                        <textarea class="wysihtml5 form-control" rows="5" name="product_info"  >{{$product->product_info}}</textarea>

                        </div>
                    </div>
                        <div class="form-group">
                        <label class="col-sm-3 control-label">Product introduce</label>
                        <div class="col-sm-6">
                             <textarea class="wysihtml5 form-control" rows="5" name="product_introduce"  >{{$product->product_introduce}}</textarea>

                        </div>
                    </div>
                            <div class="form-group">
                             <label class="col-sm-3 control-label">Image</label>
                                                <div class="col-sm-6">

                                    <input type="file" id="exampleInputFile" name="product_image">
                                    <p class="help-block">Example block-level help text here.</p>
                                </div>
                           </div>
                            <div class="form-group">
                             <label class="col-sm-3 control-label">Image 1</label>
                                                <div class="col-sm-6">

                                    <input type="file" id="exampleInputFile"  name="product_image1">
                                    <p class="help-block">Example block-level help text here.</p>
                                </div>
                           </div>
                            <div class="form-group">
                             <label class="col-sm-3 control-label" >Image 2</label>
                                                <div class="col-sm-6">

                                    <input type="file" id="exampleInputFile" name="product_image2">
                                    <p class="help-block">Example block-level help text here.</p>
                                </div>
                           </div>
                            <div class="form-group">
                             <label class="col-sm-3 control-label" >Image 3</label>
                                                <div class="col-sm-6">

                                    <input type="file" id="exampleInputFile" name="product_image3" value="{{$product->product_image3}}">
                                    <p class="help-block">Example block-level help text here.</p>
                                </div>
                           </div>
                 	  <div class="form-group">
                        <label class="col-sm-3 control-label">Size</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control round-input" name="product_size" value="{{$product->product_size}}">
                        </div>
                    </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Sale</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control round-input" name="product_sale" value="{{$product->product_sale}}">
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