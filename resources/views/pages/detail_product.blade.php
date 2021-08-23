@extends('templates.layout')
@section('content')
			
				<!-- BREADCRUMBS -->
		<section class="breadcrumb parallax margbot30"></section>
		<!-- //BREADCRUMBS -->
		
		
		<!-- TOVAR DETAILS -->
		<section class="tovar_details padbot70">
			
			<!-- CONTAINER -->
			<div class="container">
				
				<!-- ROW -->
				<div class="row">
					
					<!-- SIDEBAR TOVAR DETAILS -->
					<div class="col-lg-3 col-md-3 sidebar_tovar_details">
						<h3><b>other sweaters</b></h3>
						<ul class="tovar_items_small clearfix">
							@foreach($other_product as $opr)
							<li class="clearfix">
								<img onclick="location='{{asset('detail_product/'.$opr->id)}}'"class="tovar_item_small_img" src="{{asset('image/product/'.$opr->product_image)}}" alt="" />
								<a href="{{asset('detail_product/'.$opr->id)}}" class="tovar_item_small_title">{{$opr->product_name}}</a>
								<span class="tovar_item_small_price">{{$opr->product_price}}</span>
							</li>
							@endforeach
						</ul>
					</div><!-- //SIDEBAR TOVAR DETAILS -->
					
					<!-- TOVAR DETAILS WRAPPER -->
					<div class="col-lg-9 col-md-9 tovar_details_wrapper clearfix">
						<div class="tovar_details_header clearfix margbot35">
							<h3 class="pull-left"><b>Sweaters</b></h3>
							
							<div class="tovar_details_pagination pull-right">
								<a class="fa fa-angle-left" href="javascript:void(0);" ></a>
								<span>2 of 34</span>
								<a class="fa fa-angle-right" href="javascript:void(0);" ></a>
							</div>
						</div>
						
						<!-- CLEARFIX -->
						<div class="clearfix padbot40">
							<div class="tovar_view_fotos clearfix">
								<div id="slider2" class="flexslider">
									<ul class="slides">
										<li><a href="javascript:void(0);" ><img src="{{asset('image/product/'.$product->product_image)}}" alt="" /></a></li>
										<li><a href="javascript:void(0);" ><img src="{{asset('image/product/'.$product->product_image1)}}" alt="" /></a></li>
										<li><a href="javascript:void(0);" ><img src="{{asset('image/product/'.$product->product_image2)}}" alt="" /></a></li>
										<li><a href="javascript:void(0);" ><img src="{{asset('image/product/'.$product->product_image3)}}" alt="" /></a></li>
									</ul>
								</div>
								<div id="carousel2" class="flexslider">
									<ul class="slides">
										<li><a href="javascript:void(0);" ><img src="{{asset('image/product/'.$product->product_image)}}" alt="" /></a></li>
										<li><a href="javascript:void(0);" ><img src="{{asset('image/product/'.$product->product_image1)}}" alt="" /></a></li>
										<li><a href="javascript:void(0);" ><img src="{{asset('image/product/'.$product->product_image2)}}" alt="" /></a></li>
										<li><a href="javascript:void(0);" ><img src="{{asset('image/product/'.$product->product_image3)}}" alt="" /></a></li>
									</ul>
								</div>
							</div>
						 <form class="form-horizontal bucket-form" action="{{URL::TO('add_bag/'.$product->id)}} " enctype='multipart/form-data' method="POST">
              @csrf
							<div class="tovar_view_description">
								<div class="tovar_view_title">{{$product->product_name}}</div>
								<div class="tovar_article1">{{$product->id}}</div>
								<div class="clearfix tovar_brend_price">
									<div class="pull-left tovar_brend">{{$product->category->category_name}}</div>
									<div class="pull-right tovar_view_price sale_price">${{$product->product_price}}</div>
									<div class="pull-right tovar_view_price saled_price">${{$product->product_price*(100-$product->product_sale)/100}}</div>
								</div>
							
								<div class="tovar_size_select">
									<div class="clearfix">
										<p class="pull-left">Select SIZE</p>
										<span>Size & Fit</span>
									</div>
								 <select class="basic" name='size'>
								 	@foreach($size as $si)
			           	 <option  value='{{$si}}'>{{$si}}</option>
			           	 @endforeach
			           	</select>
								</div>
								<div class="tovar_view_btn">
							<div class="tovar_size_select">
                  <div class="clearfix">
                    <p class="pull-left">Chọn số lượng</p>
                    </div>
                  <div class="buttons_added">
                    <input aria-label="quantity" class="input-qty" max="999999" min="1" name="quantity" type="number" value="1">
                  </div>
                  
                </div>
						
									<a><input type='submit' class="add_bag" name='' value='Add to bag'>	</a>	
									<a class="add_lovelist" href="javascript:void(0);" ><i class="fa fa-heart"></i></a>
								</div>
							</form>
								<div class="tovar_shared clearfix">
									<p>Share item with friends</p>
									<ul>
										<li><a class="facebook" href="javascript:void(0);" ><i class="fa fa-facebook"></i></a></li>
										<li><a class="twitter" href="javascript:void(0);" ><i class="fa fa-twitter"></i></a></li>
										<li><a class="linkedin" href="javascript:void(0);" ><i class="fa fa-linkedin"></i></a></li>
										<li><a class="google-plus" href="javascript:void(0);" ><i class="fa fa-google-plus"></i></a></li>
										<li><a class="tumblr" href="javascript:void(0);" ><i class="fa fa-tumblr"></i></a></li>
									</ul>
								</div>
							</div>
						</div><!-- //CLEARFIX -->
						
						<!-- TOVAR INFORMATION -->
						<div class="tovar_information">
							<ul class="tabs clearfix">
								<li class="current">Details</li>
								<li>Information</li>
								<li>Reviews</li>
							</ul>
							<div class="box visible">
								{{$product->product_info}}
							</div>
							<div class="box">
								{{$product->product_introduce}}
							</div>
							<div class="box">
								<ul class="comments">
									<li>
										<div class="clearfix">
											<p class="pull-left"><strong><a href="javascript:void(0);" >John Doe</a></strong></p>
											<span class="date">2013-10-09 09:23</span>
											
										</div>
										<p>comment</p>
									</li>
								</ul>
								
								<h3>WRITE A REVIEW</h3>
								<p>Now please write a (short) review....(min. 200, max. 2000 characters)</p>
								<div class="clearfix">
                  <input type="text" id="name_comment" name="name" placeholder="NAME">
									<textarea id="review-textarea" name="comment" placeholder="COMMENT"></textarea>									
									<input type="submit" class="dark-blue big" value="Submit a review">
								</div>
							</div>
						</div><!-- //TOVAR INFORMATION -->
					</div><!-- //TOVAR DETAILS WRAPPER -->
				</div><!-- //ROW -->
			</div><!-- //CONTAINER -->
		</section><!-- //TOVAR DETAILS -->
<input id="signup-token" name="_token" type="hidden" value="{{csrf_token()}}">
<script type="text/javascript">
	$(document).ready(function(){
		load_comment();
		function load_comment(){
			var product_id=$('.tovar_article1').text();
        var $token=$('#signup-token').val();
          var comment=$('#review-textarea').val();
           var name=$('#name_comment').val();
      $.ajax({
             url:"{{URL::to('load_comment')}}",
             method:"POST",
             data:{product_id:product_id,comment:comment,name:name,_token:$token}, 
                           success:function(data){
                           	$('.comments').html(data);
                      }})	;	}
      $('.dark-blue').click(function(){
      		var product_id=$('.tovar_article1').text();
        var $token=$('#signup-token').val();
                var comment_content=$('.comment').val();
                 var comment=$('#review-textarea').val();
           var name=$('#name_comment').val();	
  $.ajax({
             url:"{{URL::to('send_comment')}}",
             method:"POST",
             data:{product_id:product_id,comment:comment,name:name,_token:$token}, 
                           success:function(data){
		                       load_comment();
                      }});
      })
	})
</script>
@endsection