@extends('templates.layout_admin')
@section('content')
<div class="row">
        <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Category
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
                <form class="form-horizontal bucket-form" action="{{route('category.update',[$categoryad->id])}}" method="post">
                	                      @method('PUT')

                     @csrf
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Category Name </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="category_name" value="{{$categoryad->category_name}}">
                        </div>
                    </div>
                    <div class="form-group">
                     <label class="col-sm-3 control-label">Category Parent</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="category_parent">

                                <option @if($categoryad->category_parent==0) {{'selected'}} @endif  value="0">Category Parent</option>
                                @foreach($category_parent as $cgr)
                                @if($cgr->category_parent=='0')
                                <option @if($categoryad->category_parent==$cgr->id) {{'selected'}} @endif value="{{$cgr->id}}">{{$cgr->category_name}}</option>
                                 @foreach($category_parent as $cgr1)
                                 @if($cgr1->category_parent==$cgr->id)
                                <option @if($categoryad->category_parent==$cgr1->id) {{'selected'}} @endif value="{{$cgr1->id}}">-->{{$cgr1->category_name}}</option>
                                 @endif
                                 @endforeach
                                @endif
                                @endforeach

                               </select>
                            </div>
                      </div>
                      <div class="form-group">
                     <label class="col-sm-3 control-label">Category Status</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="category_status">
                            	@if($categoryad->category_status==0)
                                <option selected value="0">on</option>
                                <option value="1">off</option>
                                @else 
                                <option  value="0">on</option>
                                <option selected value="1">off</option>
                                @endif
                                </select>
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