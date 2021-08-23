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
                <form class="form-horizontal bucket-form" action="{{route('coupon.update',[$coupon->id])}}" method="post">
                	                      @method('PUT')
                     @csrf                   
                 <div class="form-group">
                        <label class="col-sm-3 control-label">Coupon Name </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="coupon_name" value="{{$coupon->coupon_name}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Start Day </label>
                        <div class="col-sm-6">
                            <input type="text" id="datepicker" class="form-control" name="start_day" value="{{$coupon->start_day}}">
                        </div>
                    </div>
                    

                    <div class="form-group">
                        <label class="col-sm-3 control-label">End Day </label>
                        <div class="col-sm-6">
                            <input type="text"  id="datepicker2"  class="form-control" name="end_day" value="{{$coupon->end_day}}">
                        </div>
                    </div>
                       <div class="form-group">
                        <label class="col-sm-3 control-label">Code</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="coupon_code" value="{{$coupon->coupon_code}}">
                        </div>
                    </div>

                       <div class="form-group">
                     <label class="col-sm-3 control-label">Type</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="coupon_type">
                            	 <option <?php if($coupon->coupon_type=='percent') echo 'selected' ?> value="percent">Percent</option>
                                <option <?php if($coupon->coupon_type=='amount') echo 'selected' ?> value="amount">Amount</option>
                               </select>
                            </div>
                      </div>    
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Number</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="coupon_number" value="{{$coupon->coupon_number}}">
                        </div>
                    </div>  
                     <div class="form-group">
                     <label class="col-sm-3 control-label">Status</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="coupon_status">
                            	 <option <?php if($coupon->coupon_status=='on') echo 'selected' ?> value="on">On</option>
                                <option <?php if($coupon->coupon_status=='off') echo 'selected' ?> value="off">Off</option>
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