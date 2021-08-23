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
                <form class="form-horizontal bucket-form" action="{{route('user.update',[$user->id])}}" method="post">
                	                      @method('PUT')
                     @csrf                   
               <div class="form-group">
                        <label class="col-sm-3 control-label"> name  </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="name" required autocomplete="name"  class="ggg @error('name') is-invalid @enderror" value="{{$user->name}}">
                        </div>
                    </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label"> email  </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="email"  required autocomplete="email" class="ggg @error('email') is-invalid @enderror" value="{{$user->email}}">
                        </div>
                    </div>
                    <div class="form-group">
                     <label class="col-sm-3 control-label">gender</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="gender" >
                                <option <?php if($user->gender=='man') echo 'selected' ?> value="man">man</option>
                                <option <?php if($user->gender=='women') echo 'selected' ?> value="women">women</option>
                                </select>
                        </div>
                      </div>
                        <div class="form-group">
                        <label class="col-sm-3 control-label"> address  </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="address" required value="{{$user->address}}">
                        </div>
                    </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label"> phone  </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="phone" required value="{{$user->phone}}">
                        </div>
                    </div>
                      <div class="form-group">
                     <label class="col-sm-3 control-label">role</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="role">
                                <option <?php if($user->role=='customer') echo 'selected' ?> value="on">customer</option>
                                <option <?php if($user->role=='author') echo 'selected' ?> value="off">author</option>
                                   <option <?php if($user->role=='admin') echo 'selected' ?> value="off">admin</option>
                       <option <?php if($user->role=='customer_author') echo 'selected' ?> value="customer_author">customer and author</option>

                                </select>
                        </div>
                      </div>
                      <div class="form-group">
                     <label class="col-sm-3 control-label">Status</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="status">
                            	 <option <?php if($user->role=='on') echo 'selected' ?> value="on">On</option>
                                <option <?php if($user->role=='off') echo 'selected' ?> value="off">Off</option>
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