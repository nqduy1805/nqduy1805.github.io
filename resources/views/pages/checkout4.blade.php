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
						<li class="done_step2">2. Delivery</li>
						<li class="done_step">3. Payment</li>
						<li class="active_step last">4. Confirm Orded</li>
					</ul>
				</div><!-- //CHECKOUT BLOCK -->
					
				<!-- ROW -->
				<div class="row">
					<div class="col-lg-9 col-md-9 padbot60">
						<div class="checkout_confirm_orded clearfix">
							<div class="checkout_confirm_orded_bordright clearfix">
								<div class="billing_information">
									<p class="checkout_title margbot10">Billing information</p>
									
									<div class="billing_information_content margbot40">
										<span>{{$order->name}}</span>
										<span>{{$order->adress1}}</span>
										<span>{{$order->phone}}</span>
										<span>{{$order->email}}</span>
									</div>
									
									<p class="checkout_title margbot10">Shipping adress</p>
									
										<div class="billing_information_content margbot40">
										<span>{{$order->name}}</span>
										<span>{{$order->adress1}}</span>
										<span>{{$order->phone}}</span>
										<span>{{$order->email}}</span>
									</div>
								</div>
								
								<div class="payment_delivery">
									<p class="checkout_title margbot10">Payment and delivery</p>
									
									<p><span>Payment:
									<span> {{$order->payment}} PayPal</p>
									@if($order->payment=='Visa')
									<img src="{{asset('frontend/images/visa.jpg')}}" alt="" />
									@elseif($order->payment=='Master Card')
                                    <img src="{{asset('frontend/images/master_card.jpg')}}" alt="" />
                                    @elseif($order->payment=='PayPal')
                                    <img src="{{asset('frontend/images/paypal.jpg')}}" alt="" />	
                                    @elseif($order->payment=='Discover')
                                    <img src="{{asset('frontend/images/discover.jpg')}}" alt="" />
                                    @elseif($order->payment=='Skrill')
                                    <img src="{{asset('frontend/images/Skrill.jpg')}}" alt="" />
                                    @endif
									<p><span>Delivery:
									</span>{{$order->delivery}} Express</p>
									@if($order->delivery=='Standard')
									<img src="{{asset('frontend/images/standard_post.jpg')}}" alt="" />
									@elseif($order->delivery=='Excluseve')
									<img src="{{asset('frontend/images/excluseve_post.jpg')}}" alt="" />
									@elseif($order->delivery=='Premium')<img src="{{asset('frontend/images/premium_post.jpg')}}" alt="" />
									@elseif($order->delivery=='VIP')<img src="{{asset('frontend/images/vip_post.jpg')}}" alt="" />
									@endif
								</div>
							</div>
							
							<div class="checkout_confirm_orded_products">
								<p class="checkout_title">Products</p>
								<ul class="cart-items">
									@foreach($cart as $pr)
									<li class="clearfix">
										@if(Auth::user())
										<img class="cart_item_product"  src="{{asset('image/product/'.$pr->product->product_image)}}"   alt="" />
										<a href="product-page.html" class="cart_item_title">{{$pr->product->product_name}}</a>
										<span class="cart_item_price">${{$pr->order_sale}}</span>
										@else 
										<img class="cart_item_product" 	src="{{asset('image/product/'.$pr->options->image)}}"  alt="" />
										<a href="product-page.html" class="cart_item_title">{{$pr->name}}</a>
										<span class="cart_item_price">${{$pr->weight}}</span>
										@endif
									</li>
									@endforeach
								</ul>
							</div>
						</div>
					</div>
					
					<div class="col-lg-3 col-md-3 padbot60">
						
						<!-- BAG TOTALS -->
						<div class="sidepanel widget_bag_totals your_order_block">
							<h3>Your Order</h3>
								<table class="bag_total">
								<tr class="cart-subtotal clearfix">
									<th>Sub total </th>
									  <td >$<span class="total_cart">{{$total}}</span></td>
								</tr>
								<tr class="shipping clearfix">
									<th>SHIPPING</th>	
									<td>Free</td>
								</tr>
								<tr class="shipping clearfix">
									<th>discount</th>	
									  <td >-$<span class="total_cart">{{$discount}}</span></td>
								</tr>
								<tr class="total clearfix">
								<th>Total</th>	
									  <td >$<span class="total_cart1">{{$total-$discount}}</span></td>
								</tr>
							</table>
							<a class="btn active" href="checkout5" >Place Order</a>
							<a class="btn inactive" href="checkout3" >Go to previous step</a>
						</div><!-- //REGISTRATION FORM -->
					</div><!-- //SIDEBAR -->
				</div><!-- //ROW -->
			</div><!-- //CONTAINER -->
		</section><!-- //CHECKOUT PAGE -->
		@endsection
