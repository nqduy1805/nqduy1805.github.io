@extends('templates.layout_admin')
@section('content')
<div class="row">
        <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                User
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
                <form class="form-horizontal bucket-form" action="{{route('user.store')}}" method="post">
                     @csrf
                    <div class="form-group">
                        <label class="col-sm-3 control-label"> name  </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="name" required autocomplete="name"  class="ggg @error('name') is-invalid @enderror">
                        </div>
                    </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label"> email  </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="email"  required autocomplete="email" class="ggg @error('email') is-invalid @enderror">
                        </div>
                    </div>
                  <div class="form-group">
                        <label class="col-sm-3 control-label"> password  </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="password" required>
                        </div>
                    </div>
                    <div class="form-group">
                     <label class="col-sm-3 control-label">gender</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="gender" >
                                <option value="man">man</option>
                                <option value="women">women</option>
                                </select>
                        </div>
                      </div>
                        <div class="form-group">
                        <label class="col-sm-3 control-label"> address  </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="address" required>
                        </div>
                    </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label"> phone  </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="phone" required> 
                        </div>
                    </div>
                      <div class="form-group">
                     <label class="col-sm-3 control-label">role</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="role">
                                <option value="customers">customer</option>
                                <option value="author">author</option>
                                <option value="admin">admin</option>
                                <option value="customer_author">customer and author</option>
                                <option value="driver">driver</option>
                                </select>
                        </div>
                      </div>
                      <div class="form-group">
                     <label class="col-sm-3 control-label">Status</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="status">
                            	 <option value="on">On</option>
                                <option value="off">Off</option>
                               </select>
                            </div>
                      </div>  
                      <div class="position-center">
                      	<button type="submit" class="btn btn-info  ">Add</button>
                      </div>
                </form>
            </div>
        </section>

        </div>
        </div>
@endsection