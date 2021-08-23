
	@extends('templates.layout')

@section('content')


		<!-- BREADCRUMBS -->
		<section class="breadcrumb parallax margbot30"></section>
		<!-- //BREADCRUMBS -->
		
		
		<!-- PAGE HEADER -->
		<section class="page_header">
			
			<!-- CONTAINER -->
			<div class="container border0 margbot0">
				<h3 class="pull-left"><b>Checkout</b></h3>
				
				<div class="pull-right">
					<a href="shopping_bag" >Back shopping bag<i class="fa fa-angle-right"></i></a>
				</div>
			</div><!-- //CONTAINER -->
		</section><!-- //PAGE HEADER -->
		
	
		<!-- CHECKOUT PAGE -->
		<section class="checkout_page">
			
			<!-- CONTAINER -->
			<div class="container">

				<!-- CHECKOUT BLOCK -->
				<div class="checkout_block">
					<ul class="checkout_nav">
						<li class="done_step">1. Shipping Address</li>
						<li class="active_step">2. Delivery</li>
						<li>3. Payment</li>
						<li class="last">4. Confirm Orded</li>
					</ul>
					
					<div class="checkout_delivery clearfix">
			         <form  action="{{URL::to('checkout3')}}" method="get">

						<p class="checkout_title">SHIPPING METHOD</p>
						<ul>                
							<li>
								<input id="ridio1" type="radio" name="radio" value="Standard" hidden />
								<label for="ridio1">Standard International Post <b>Free  (3-6 week)</b><img src="{{asset('frontend/images/standart_post.jpg')}}" alt="" /></label>
							</li>
							<li>
								<input id="ridio2" type="radio" name="radio"  value="Excluseve" hidden />
								<label for="ridio2">Excluseve International Post <b>Postage $ 10 (2-4 week)</b><img src="{{asset('frontend/images/excluseve_post.jpg')}}" alt="" /></label>
							</li>
							<li>
								<input id="ridio3" type="radio" name="radio" value="Premium" hidden />
								<label for="ridio3">Premium Post <b>Postage $ 50 (1-2 week)</b><img src="{{asset('frontend/images/premium_post.jpg')}}" alt="" /></label>
							</li>
							<li>
								<input id="ridio4" type="radio" name="radio" value="VIP" hidden />
								<label for="ridio4">For VIP clients <b>$ 100 (3 days)</b><img src="{{asset('frontend/images/vip_post.jpg')}}" alt="" /></label>
							</li>
						</ul>
						<div class="checkout_delivery_note"><i class="fa fa-exclamation-circle"></i>Express delivery options are available for in-stock items only.</div>
						<a><input type='submit' class="btn active pull-right checkout_block_btn" name='' value='Continue'>	</a>
						<a class="btn inactive" href="checkout1" >Go to previous step</a>

					</form>
					</div>
				</div><!-- //CHECKOUT BLOCK -->
			</div><!-- //CONTAINER -->
		</section><!-- //CHECKOUT PAGE -->
		
	@endsection
