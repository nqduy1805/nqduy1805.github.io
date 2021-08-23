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
						<li class="done_step2">1. Shipping Address</li>
						<li class="done_step">2. Delivery</li>
						<li class="active_step">3. Payment</li>
						<li class="last">4. Confirm Orded</li>
					</ul>
					  
					<div class="checkout_payment clearfix">
						<form  action="{{URL::to('checkout4')}}" method="get">

						<div class="payment_method padbot70">
							<p class="checkout_title">payment Method</p>

							<ul class="clearfix">
								<li>
									<input id="ridio1" type="radio" name="radio" value="Visa" hidden />
									<label for="ridio1">Visa<br><img src="{{asset('frontend/images/visa.jpg')}}" alt="" /></label>
								</li>
								<li>
									<input id="ridio2" type="radio" name="radio" value="Master Card" hidden />
									<label for="ridio2">Master Card<br><img src="{{asset('frontend/images/master_card.jpg')}}" alt="" /></label>
								</li>
								<li>
									<input id="ridio3" type="radio" name="radio" value="PayPal"  hidden />
									<label for="ridio3">PayPal<br><img src="{{asset('frontend/images/paypal.jpg')}}" alt="" /></label>
								</li>
								<li>
									<input id="ridio4" type="radio" name="radio" value="Discover" hidden />
									<label for="ridio4">Discover<br><img src="{{asset('frontend/images/discover.jpg')}}" alt="" /></label>
								</li>
								<li>
									<input id="ridio5" type="radio" name="radio" value="Skrill" hidden />
									<label for="ridio5">Skrill<br><img src="{{asset('frontend/images/skrill.jpg')}}" alt="" /></label>
								</li>
							</ul>
						</div>
						
						<div class="credit_card_number padbot80">
							<p class="checkout_title">Credit Card Number</p>
							
							
								<input type="text" name="card_number" value="Number" onFocus="if (this.value == 'Number') this.value = '';" onBlur="if (this.value == '') this.value = 'Number';" />
								
						</div>
						
						<div class="clear"></div>
						
						<div class="checkout_delivery_note"><i class="fa fa-exclamation-circle"></i>Express delivery options are available for in-stock items only.</div>
						<a><input type='submit' class="btn active pull-right checkout_block_btn" name='' value='Continue'>	</a>
						<a class="btn inactive" href="checkout2" >Go to previous step</a>

										</form>

					</div>
				</div><!-- //CHECKOUT BLOCK -->
			</div><!-- //CONTAINER -->
		</section><!-- //CHECKOUT PAGE -->
		
	
		@endsection
