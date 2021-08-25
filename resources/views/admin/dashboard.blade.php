@extends('templates.layout_admin')
@section('content')
<div class="container-fluid">
			<style type="text/css">
				p.title_thongke {
				    text-align: center;
				    font-size: 20px;
				    font-weight: bold;
				}
			</style>
<div class="row">
		<p class="title_thongke">Sales order statistics</p>
		<form autocomplete="off">
			@csrf

			<div class="col-md-2">
				<p>from date: <input type="text" id="datepicker" class="form-control"></p>


			</div>

			<div class="col-md-2">
				<p>to date: <input type="text" id="datepicker2" class="form-control"></p>
			
			</div>

			<div class="col-md-2">
				<p>
					filter: 
					<select class="dashboard-filter form-control" >
						<option value="0">--Chọn--</option>
						<option value="thismonth">this month</option>
						<option value="lastmonth">last month</option>
						<option value="week">week</option>
						<option value="year">year</option>
					</select>
				</p>
			</div>
		   <div class="col-md-2">
		   	<p></br>
           <input type="button" id="btn-dashboard-filter" class="btn btn-primary btn-sm" value="filter"></p>
			</div>
		</form>

		<div class="col-md-12">
			<div id="myfirstchart" style="height: 250px;"></div>
		</div>

</div>

<div class="row">
	<style type="text/css">
		table.table.table-bordered.table-dark {
		    background: #32383e;
		}
		table.table.table-bordered.table-dark tr th {
		    color: #fff;
		}
	</style>

<p class="title_thongke">Statistical access | Total online: {{ $Total_user_online}}</p>

<table class="table table-bordered table-dark">
  <thead>
    <tr>
      <th scope="col"></th>
      <th scope="col">Total day</th>
      <th scope="col">Total week</th>
      <th scope="col">Total last month</th>
      <th scope="col">Total this month</th>
      <th scope="col">Total one year</th>
      <th scope="col">Total access</th>
    </tr>
  </thead>
  <tbody>
     <tr>
      <td>Access</td>
      <td>{{$Total_access_day}}</td>
      <td>{{$Total_access_week}}</td>
      <td>{{$Total_access_last_month}}</td>
      <td>{{$Total_access_this_month}}</td>
      <td>{{$Total_access_year}}</td>
      <td>{{$Total_access}}</td>

    </tr>
    <tr>
       <td>User</td>
      <td>{{$Total_user_day}}</td>
      <td>{{$Total_user_week}}</td>
      <td>{{$Total_user_last_month}}</td>
      <td>{{$Total_user_this_month}}</td>
      <td>{{$Total_user_year}}</td>
      <td>{{$Total_user}}</td>

    </tr>
   
  </tbody>
</table>

</div>

<div class="row">

	<div class="col-md-4 col-xs-12">
		<p class="title_thongke">Statistics of total products, articles, orders</p>
		<div id="donut"></div>	
	</div>

	<!--------------------------->

	<div class="col-md-4 col-xs-12">
		<h3>Most Viewed Posts</h3>

		<ol class="list_views">
			@foreach($post_views as $post)
			<li>
				<a target="_blank" href="{{url('detail_blog/'.$post->id)}}">{{$post->blog_name}} | <span style="color:black">{{$post->blog_view}}</span></a>
			</li>
			@endforeach

		</ol>
		
	</div>

	<div class="col-md-4 col-xs-12">
		<style type="text/css">
			ol.list_views {
			    margin: 10px 0;
			    color: #fff;
			}
			ol.list_views a {
			    color: orange;
			    font-weight: 400;
			}
		</style>
		<h3>Products with the most views</h3>

		<ol class="list_views">
			@foreach($product_views as $pro)
			<li>
				<a target="_blank" href="{{url('detail_product/'.$pro->id)}}">{{$pro->product_name}} | <span style="color:black">{{$pro->product_view}}</span></a>
			</li>
			@endforeach

		</ol>

	</div>
</div>
</div>
                     <input id="signup-token" name="_token" type="hidden" value="{{csrf_token()}}">
<script>
  $( function() {
    $( "#datepicker" ).datepicker({dateFormat: 'dd/mm/yy'});
    $( "#datepicker2" ).datepicker({dateFormat: 'dd/mm/yy'});
  } );
  </script>
   <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script>
	$(document).ready(function() {
	    //CHARTS
		chartthismonthsorder();
		var chart = new Morris.Bar({
            element: 'myfirstchart',
  xkey: 'date',
  ykeys: ['revenue','profit','total_order'],
  labels: ['revenue','profit','total_order'],
    hideHover: 'auto',

        });
	   function chartthismonthsorder(){
        var $token=$('#signup-token').val();
       $.ajax({
             url:"{{URL::to('chartthismonth')}}",
             method:"POST",
             dataType:"JSON",
             data:{_token:$token}, 
                           success:function(data){
                        chart.setData(data);
                      }
                  });
	   }
	   $('#btn-dashboard-filter').click(function(){
        var $token=$('#signup-token').val();
	   	var from_date=$('#datepicker').val();
	    var to_date=$('#datepicker2').val();
	    $.ajax({
             url:"{{URL::to('filter_by_date')}}",
             method:"POST",
             dataType:"JSON",
             data:{from_date:from_date,to_date:to_date,_token:$token}, 
                           success:function(data){
                        chart.setData(data);
                      }
                  });
	});
	     $('.dashboard-filter').change(function(){
        var dashboard_value = $(this).val();
        var $token=$('#signup-token').val();
        $.ajax({
             url:"{{URL::to('dashboard_filter')}}",
             method:"POST",
             data:{dashboard_value:dashboard_value,_token:$token}, 
                           success:function(data){
                        chart.setData(data);
                      }
                  });
    });
	   	});

	</script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script type="text/javascript">
	var colorDanger = "#FF1744";
Morris.Donut({
  element: 'donut',
  resize: true,
  colors: [
    '#26C6DA',
    '#ce616a',
    '#f5b942',
    '#006064'
  ],
  //labelColor:"#cccccc", // text color
  //backgroundColor: '#333333', // border color
  data: [
    {label:"Product", value:{{$Total_product}}, color:colorDanger},
    {label:"Blog", value:{{$Total_blog}}},
    {label:"Order", value:{{$Total_order}}},
    {label:"User", value:{{$Total_user}}},
  ]
});

</script>
@endsection