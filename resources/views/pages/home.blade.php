@extends('templates.layout')

@section('content')
				<!-- BREADCRUMBS -->
				<!-- BREADCRUMBS -->
		<section class="breadcrumb parallax margbot30"></section>
		<!-- //BREADCRUMBS -->
					
			<!-- CONTAINER -->
<img src="frontend/images/slide/bestseller_1702_1920X658 (1).png" alt="" />			

		<!-- TOVAR SECTION -->
		<section class="tovar_section">
			
			<!-- CONTAINER -->
			<div class="container">
				<h2>NEW PRODUCT</h2>

				<!-- ROW -->
				<div class="row">
					
					<!-- TOVAR WRAPPER -->
					<div class="tovar_wrapper" data-appear-top-offset='-100' data-animated='fadeInUp'>
						@foreach($product as $pr)
						<!-- TOVAR1 -->
						<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 col-ss-12 padbot40">
							<div class="tovar_item tovar_sale_{{$pr->product_sale}}" >
								<div class="tovar_img">
									<div class="tovar_img_wrapper">
										<img class="img"  src="{{asset('image/product/'.$pr->product_image)}}" alt="" />
										<img  onclick="location='{{asset('detail_product/'.$pr->id)}}'" class="img_h" src="{{asset('image/product/'.$pr->product_image1)}}" alt="" />
									</div>
									<div class="tovar_item_btns">
										<div class="open-project-link"><a class="quickview open-project tovar_view" href="javascript:void(0);" data-product_id="{{$pr->id}}" >QUICK VIEW</a></div>
										<a class="add_bag" href="javascript:void(0);"  ><i class="fa fa-shopping-cart"></i></a>
										<a class="add_lovelist" href="javascript:void(0);" ><i class="fa fa-heart"></i></a>
									</div>
								</div>
								<div class="tovar_description clearfix">
									<a class="tovar_title" href="{{asset('detail_product/'.$pr->id)}}" >{{$pr->product_name}}</a>
										<a class="tovar_title"  > </a>
									<span class="tovar_price sale_price">${{$pr->product_price}}</span>
									<span class="tovar_price saled_price " >${{$pr->product_price*(100-$pr->product_sale)/100}}</span>
								</div>
							</div>
						</div><!-- //TOVAR1 -->
						@endforeach
					</div><!-- //TOVAR WRAPPER -->
				</div><!-- //ROW -->

				

			
			</div><!-- //CONTAINER -->
		</section><!-- //TOVAR SECTION -->
		
@endsection