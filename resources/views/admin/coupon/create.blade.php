@extends('templates.layout_admin')
@section('content')
<div class="row">
        <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Blog
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
                <form class="form-horizontal bucket-form" action="{{route('coupon.store')}} " enctype='multipart/form-data' method="post">
                     @csrf
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Coupon Name </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="coupon_name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Start Day </label>
                        <div class="col-sm-6">
                            <input type="text" id="datepicker" class="form-control" name="start_day">
                        </div>
                    </div>
                    

                    <div class="form-group">
                        <label class="col-sm-3 control-label">End Day </label>
                        <div class="col-sm-6">
                            <input type="text"  id="datepicker2"  class="form-control" name="end_day">
                        </div>
                    </div>
                       <div class="form-group">
                        <label class="col-sm-3 control-label">Code</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="coupon_code">
                        </div>
                    </div>

                       <div class="form-group">
                     <label class="col-sm-3 control-label">Type</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="coupon_type">
                            	 <option value="percent">Percent</option>
                                <option value="amount">Amount</option>
                               </select>
                            </div>
                      </div>    
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Number</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="coupon_number">
                        </div>
                    </div>  
                     <div class="form-group">
                     <label class="col-sm-3 control-label">Status</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="coupon_status">
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
        <script>
  $( function() {
    $( "#datepicker" ).datepicker();
    $( "#datepicker2" ).datepicker();
  } );
  </script>
   <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection