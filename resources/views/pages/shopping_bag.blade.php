	@extends('templates.layout')

@section('content')

		<!-- BREADCRUMBS -->
		<section class="breadcrumb parallax margbot30"></section>
		<!-- //BREADCRUMBS -->
		
		<!-- PAGE HEADER -->
		<section class="page_header">
			
			<!-- CONTAINER -->
			<div class="container">
				<h3 class="pull-left"><b>Shopping bag</b></h3>
				
				<div class="pull-right">
					<a href="home" >Back to shop<i class="fa fa-angle-right"></i></a>
				</div>
			</div><!-- //CONTAINER -->
		</section><!-- //PAGE HEADER -->
		
		<!-- SHOPPING BAG BLOCK -->
		<section class="shopping_bag_block">
			
			<!-- CONTAINER -->
			<div class="container">
			
				<!-- ROW -->
				<div class="row">
					
					<!-- CART TABLE -->
					<div class="col-lg-9 col-md-9 padbot40">
						
						<table class="shop_table">
							<thead>
								<tr>
									<th class="product-thumbnail"></th>
									<th class="product-name">Item</th>
									<th class="product-price">Price</th>
									<th class="product-quantity">Quantity</th>
									<th class="product-subtotal">Total</th>
									<th class="product-remove"></th>
								</tr>
							</thead>
							<tbody>
                             @foreach($cart as $c)
                             @if(isset(Auth::user()->id))
									<tr class="cart_item">
									<td class="product-thumbnail"><a href="product-page.html" ><img src="{{asset('image/product/'.$c->product->product_image)}}" width="100px" alt="" /></a></td>
									<td class="product-name">
										<a href="product-page.html">{{$c->product->product_name}}</a>
										<ul class="variation">
											<li class="variation-Color">Color: <span>Brown</span></li>
											<li class="variation-Size">Size: <span>{{$c->order_size}}</span></li>
										</ul>
									</td>
	               <td ><a >$</a><span class=" saled_price product-price ">{{$c->order_sale}}</span>    $<span class="product-price- sale_price">{{$c->order_price}}</span></td>						
	               			<td class="product-quantity">
										<div class="tovar_size_select">
                     <div class="clearfix">
                       <p class="pull-left"> số lượng</p>
                                             </div>
                     <div class="buttons_added">
                       <input aria-label="quantity"    class="input-qty" max="999999" min="1" name="sl_sp"     type="number" value="{{$c->order_qty}}">
                     </div>
                     <input id="signup-token" name="_token" type="hidden" value="{{csrf_token()}}">
                      <input id="idcart" type="hidden" value="{{$c->id}}">
                   </div>
									</td>
									
									<td>$<span class="product-subtotal" >{{$c->order_qty*$c->order_price}}</span> </td>

									<td class="product-remove"><a href="javascript:void(0);" onclick="event.preventDefault();
                                       document.getElementById('product-remove').submit();" ><span>Delete</span> <i>X</i></a></td>
                  <form id="product-remove" action="{{URL::to('delete_bag/'.$c->id)}}" method="POST" class="d-none">
                   @csrf
                  </form>
								</tr>
                @else 
								<tr class="cart_item">
									<td class="product-thumbnail"><a href="product-page.html" ><img src="{{asset('image/product/'.$c->options->image)}}" width="100px" alt="" /></a></td>
									<td class="product-name">
										<a href="product-page.html">{{$c->name}}</a>
										<ul class="variation">
											<li class="variation-Color">Color: <span>Brown</span></li>
											<li class="variation-Size">Size: <span>{{$c->options->size}}</span></li>
										</ul>
									</td>
									<td ><a class="do">$</a><span class=" saled_price product-price ">{{$c->price}}</span>    $<span class="product-price sale_price">{{$c->weight}}</span></td>
									<td class="product-quantity">
										<div class="tovar_size_select">
                     <div class="clearfix">
                       <p class="pull-left"> số lượng</p>
                                             </div>
                     <div class="buttons_added">
                       <input aria-label="quantity"   class="input-qty" max="999999" min="1" name="sl_sp"                          type="number" value="{{$c->qty}}">
                     </div>
                      <input id="signup-token" name="_token" type="hidden" value="{{csrf_token()}}">
                      <input id="idcart" type="hidden" value="{{$c->rowId}}">
                   </div>
                 
									</td>
									
									<td >$<span class="product-subtotal">{{$c->qty*$c->price}}</span></td>

									<td class="product-remove"><a href="javascript:void(0);" onclick="event.preventDefault();
                    document.getElementById('product-remove').submit();" ><span>Delete</span> <i>X</i></a></td>


                  <form id="product-remove" action="{{URL::to('delete_bag/'.$c->rowId)}}" method="POST" class="d-none">
                   @csrf
                  </form>
								</tr>

								@endif
								    @endforeach					
							</tbody>
						</table>
					</div><!-- //CART TABLE -->
					<!-- SIDEBAR -->
					<div id="sidebar" class="col-lg-3 col-md-3 padbot50">
						
						<!-- BAG TOTALS -->
						<div class="sidepanel widget_bag_totals">
							<h3>BAG TOTALS </h3>
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
									  <td >-$<span class="total_cart3">{{$discount}}</span></td>
								</tr>
								<tr class="total clearfix">
								<th>Total</th>	
									  <td >$<span class="total_cart1">{{$total-$discount}}</span></td>
								</tr>
							</table>
							<form class="coupon_form" action="" method="get">
								<input type="text" name="coupon" value="Have a coupon?" onFocus="if (this.value == 'Have a coupon?') this.value = '';" onBlur="if (this.value == '') this.value = 'Have a coupon?';" />
								<input type="submit" value="Apply">
							</form>
							@if($cart->count()>0)
							<a class="btn active" href="checkout1" >Check out</a>
							@else
							<a class="btn active" href="home" >Check out</a>
							@endif
							<a class="btn inactive" href="home" >Continue shopping</a>
						</div><!-- //REGISTRATION FORM -->
					</div><!-- //SIDEBAR -->
				</div><!-- //ROW -->
			</div><!-- //CONTAINER -->
		</section><!-- //SHOPPING BAG BLOCK -->
		<script type="text/javascript">
           $('.input-qty').on('input',function(){
              var $quantity=$(this).val();
              var $parent=$(this).parents('tr');
              var $price=$parent.find('.saled_price').text();
              var $total_price=$parent.find('.product-subtotal');
              var $id=$parent.find('#idcart').val();
              var $token=$parent.find('#signup-token').val();
              var $subtotal=($quantity*Number($price)).toFixed(2);
              var $total_cart=$('.total_cart').text();
              var $discount=$('.total_cart3').text();
              $total_cart=(Number($total_cart)+$quantity*$price-Number($total_price.text())).toFixed(2);
             $.ajax({
             url:"update_bag",
             method:"POST",
             data:{quantity:$quantity,id:$id,subtotal:$subtotal,_token:$token}, 
                           success:function(data){
                    $total_price.text($subtotal);
                   $('.total_cart').text($total_cart);
                    $('.total_cart1').text(($total_cart-$discount).toFixed(2));
                      }}) })
           </script>
		@endsection