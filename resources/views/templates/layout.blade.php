
<!DOCTYPE html>
<html lang="en">
<head>
		<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

	<meta charset="utf-8">
	<title>Glammy | Modern eCommerce html Template </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	
	<link rel="shortcut icon" href="{{asset('frontend/images/favicon.ico')}}">
    
	<!-- CSS -->
	<link href="{{asset('frontend/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('frontend/css/flexslider.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('frontend/css/fancySelect.css')}}" rel="stylesheet" media="screen, projection" />
	<link href="{{asset('frontend/css/animate.css')}}" rel="stylesheet" type="text/css" media="all" />
	<link href="{{asset('frontend/css/style.css')}}" rel="stylesheet" type="text/css" />
    
	<!-- FONTS -->
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
	<link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	
</head>
<body>

<!-- PRELOADER -->
<!-- //PRELOADER -->

	<!-- PAGE -->
	<div id="page">
	
			<!-- HEADER -->
		<header>
			
			<!-- TOP INFO -->
			<div class="top_info">
				
				<!-- CONTAINER -->
				<div class="container clearfix">
					<ul class="secondary_menu">
						<?php if(isset(Auth::user()->id)){?>
						<li><a href="my-account.html" >Hi {{Auth::user()->name}}</a></li>
						<li><a class="dropdown-item" href="{{ route('logout') }}"
                             onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                             Logout</a>
                                     <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                        </li>
						<?php } else { ?>
						<li><a href="{{URL::to('login')}}" >Login</a></li>
						<li><a href="{{URL::to('register')}}" >Register</a></li>
						<?php }?>
					</ul>
                 
                                 
					<div class="live_chat"><a href="javascript:void(0);" ><i class="fa fa-comment-o"></i> Chat ngay!</a></div>
					
					<div class="phone_top">Liên hệ <a href="#" >092.433.0534</a></div>
				</div><!-- //CONTAINER -->
			</div><!-- TOP INFO -->
			
			
			<!-- MENU BLOCK -->
			<div class="menu_block">
			
				<!-- CONTAINER -->
				<div class="container clearfix">
					
					<!-- LOGO -->
					<div class="logo">
						<a href="{{URL::to('home')}}" ><img src="{{asset('frontend/images/logo.png')}}" alt="" /></a>
					</div><!-- //LOGO -->
					
					
					<!-- SEARCH FORM -->
					<div class="top_search_form">
						<a class="top_search_btn" href="javascript:void(0);" ><i class="fa fa-search"></i></a>
						<form method="get" action="">
							<input type="text" name="search" value="Search" onFocus="if (this.value == 'Search') this.value = '';" onBlur="if (this.value == '') this.value = 'Search';" />
						</form>
					</div><!-- SEARCH FORM -->
					
					
					<!-- SHOPPING BAG -->
                      @if(isset(Auth::user()->id))

                      	<div class="shopping_bag">
						<a class="shopping_bag_btn" href="javascript:void(0);" ><i class="fa fa-shopping-cart"></i><p>Shopping bag</p><span>{{$cart->count()}}</span></a>
						<div class="cart">
							<ul class="cart-items">
                             <?php foreach($cart as $cr){ ?>
								<li class="clearfix">
									<img class="cart_item_product" src="{{asset('image/product/'.$cr->product->product_image)}}" alt="" />
									<a href="product-page.html" class="cart_item_title">{{$cr->product->product_name}}</a>
									<span class="cart_item_price">{{$cr->order_qty}} × ${{$cr->order_price}}</span>
									<a href="javascript:void(0);" onclick="event.preventDefault();
                                       document.getElementById('product-remove1').submit();" ><span>Delete</span> <i>X</i></a>
								</li>
                                    <form id="product-remove1" action="{{URL::to('delete_bag/'.$cr->id)}}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                  <?php  } ?>

							</ul>
							<div class="cart_total">
								<div class="clearfix"><span class="cart_subtotal">bag subtotal: <b>${{$total}}</b></span></div>
								<a class="btn active" href="{{URL::to('shopping_bag')}}">Detail bag</a>
							</div>
						</div>
					</div><!-- //SHOPPING BAG -->
                       @else
					<div class="shopping_bag">
						<a class="shopping_bag_btn" href="javascript:void(0);" ><i class="fa fa-shopping-cart"></i><p>Shopping bag</p><span>{{Cart::count()}}</span></a>
						<div class="cart">
							<ul class="cart-items">
                            @foreach($cart as $cr)
								<li class="clearfix">
									<img class="cart_item_product" src="{{asset('image/product/'.$cr->options->image)}}" alt="" />
									<a href="product-page.html" class="cart_item_title">{{$cr->name}}</a>
									<span class="cart_item_price">{{$cr->qty}} × ${{$cr->price}}</span>
									<a href="javascript:void(0);" onclick="event.preventDefault();
                                       document.getElementById('product-remove1').submit();" ><span>Delete</span> <i>X</i></a>
								</li>
                                    <form id="product-remove1" action="{{URL::to('delete_bag/'.$cr->rowId)}}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                  @endforeach
							</ul>
							<div class="cart_total">
								<div class="clearfix"><span class="cart_subtotal">bag subtotal: <b>{{$total}}</b></span></div>
								<a class="btn active" href="{{URL::to('shopping_bag')}}">Detail bag</a>
							</div>
						</div>
					</div><!-- //SHOPPING BAG -->
					@endif

					<!-- LOVE LIST -->
					<div class="love_list">
						<a class="love_list_btn" href="javascript:void(0);" ><i class="fa fa-heart-o"></i><p>Love list</p><span>0</span></a>
						<div class="cart">
							<ul class="cart-items">
								<li>Cart is empty</li>
							</ul>
							<div class="cart_total">
								<div class="clearfix"><span class="cart_subtotal">bag subtotal: <b>$0</b></span></div>
								<a class="btn active" href="checkout.html">Checkout</a>
							</div>
						</div>
					</div><!-- //LOVE LIST -->

					<!-- MENU -->
					<ul class="navmenu center">
						<li class="sub-menu first"><a href="{{URl::to('home')}}" >Home</a>
						</li>
						@foreach($category as $cgr)
						@if($cgr->category_parent==0)
						<li class="sub-menu"><a href="javascript:void(0);" >{{$cgr->category_name}}</a>
							<!-- MEGA MENU -->
							<ul class="mega_menu megamenu_col1 clearfix">
								<li class="col">
									<ol>
										@foreach($category as $cr)
										@if($cr->category_parent==$cgr->id)
										@if($cgr->category_name=='BLOG')
										<li><a href="{{asset('all_blog/'.$cr->id)}}">{{$cr->category_name}}</a></li>
										@else
										<li><a href="{{asset('all_product/'.$cr->id)}}">{{$cr->category_name}}</a></li>
										@endif
										@endif
										@endforeach										
									</ol>
								</li>
							</ul><!-- //MEGA MENU -->
						</li>
						@endif
					    @endforeach
						<li class="last sale_menu"><a href="{{URL::to('sale')}}" >SALE</a></li>
					</ul><!-- //MENU -->
				</div><!-- //MENU BLOCK -->
			</div><!-- //CONTAINER -->
		</header><!-- //HEADER -->
		

		<!-- HEADER -->
		@yield('content')
	
					<!-- BANNER SECTION -->
		<section class="banner_section">
			
			<!-- CONTAINER -->
			<div class="container">
				
				<!-- ROW -->
				<div class="row">
										<div class="banner_wrapper" data-appear-top-offset='-100' data-animated='fadeInUp'>

					<!-- BANNER WRAPPER -->
						<!-- BANNER -->
						<div class="col-lg-9 col-md-9">
							<a class="banner type4 margbot40" href="javascript:void(0);" ><img src="{{asset('frontend/images/tovar/bn3.jpg')}}" alt="" /></a>
						</div><!-- //BANNER -->
						
						<!-- BANNER -->
						<div class="col-lg-3 col-md-3">
							<a class="banner nobord margbot40" href="javascript:void(0);" ><img src="{{asset('frontend/images/tovar/bn2.png')}}" alt="" /></a>
						</div><!-- //BANNER -->
					</div><!-- //BANNER WRAPPER -->
				</div><!-- //ROW -->
			</div><!-- //CONTAINER -->
		</section><!-- //BANNER SECTION -->
		
		
		<!-- NEW ARRIVALS -->
		<section class="new_arrivals padbot50">
			
			<!-- CONTAINER -->
			<div class="container">
				<h2>TÚI XÁCH</h2>
				
				<!-- JCAROUSEL -->
				<div class="jcarousel-wrapper">
					
					<!-- NAVIGATION -->
					<div class="jCarousel_pagination">
						<a href="javascript:void(0);" class="jcarousel-control-prev" ><i class="fa fa-angle-left"></i></a>
						<a href="javascript:void(0);" class="jcarousel-control-next" ><i class="fa fa-angle-right"></i></a>
					</div><!-- //NAVIGATION -->
					
					<div class="jcarousel" data-appear-top-offset='-100' data-animated='fadeInUp'>
						<ul>
							<li>
								<!-- TOVAR -->
								<div class="tovar_item_new">
									<div class="tovar_img">
										<img src="{{asset('frontend/images/product/den_txn419_8_7bb54f17965241bb86d23c3bf7c7bea1_grande.jpg')}}" alt="" />
										<div class="open-project-link"><a class="open-project tovar_view" href="javascript:void(0);" data-url="!projects/women/1.html" >Xem</a></div>
									</div>
									<div class="tovar_description clearfix">
										<a class="tovar_title" href="product-page.html" >Moonglow paisley silk tee</a>
										<span class="tovar_price">$98.00</span>
									</div>
								</div><!-- //TOVAR -->
							</li>
							<li>
								<!-- TOVAR -->
								<div class="tovar_item_new">
									<div class="tovar_img">
										<img src="{{asset('frontend/images/product/den_txn419_8_7bb54f17965241bb86d23c3bf7c7bea1_grande.jpg')}}" alt="" />
										<div class="open-project-link">
											<a class="open-project tovar_view" href="javascript:void(0);" data-url="!projects/women/1.html" >quick view</a>
										</div>
									</div>
									<div class="tovar_description clearfix">
										<a class="tovar_title" href="product-page.html" >PEASANT TOP IN SUCKERED STRIPE</a>
										<span class="tovar_price">$78.00</span>
									</div>
								</div><!-- //TOVAR -->
							</li>
							<li>
								<!-- TOVAR -->
								<div class="tovar_item_new">
									<div class="tovar_img">
										<img src="{{asset('frontend/images/product/nau_txn430_7_1389338b7d1f4540b471b9c5ed6e6822_grande.jpg')}}" alt="" />
										<div class="open-project-link">
											<a class="open-project tovar_view" href="javascript:void(0);" data-url="!projects/women/1.html" >quick view</a>
										</div>
									</div>
									<div class="tovar_description clearfix">
										<a class="tovar_title" href="product-page.html" >EMBROIDERED BIB PEASANT TOP</a>
										<span class="tovar_price">$88.00</span>
									</div>
								</div><!-- //TOVAR -->
							</li>
							<li>
								<!-- TOVAR -->
								<div class="tovar_item_new">
									<div class="tovar_img">
										<img src="{{asset('frontend/images/product/den_txn444_8_95ca7d0d02fe4c659718961e0c5b45f9_grande.jpg')}}" alt="" />
										<div class="open-project-link">
											<a class="open-project tovar_view" href="javascript:void(0);" data-url="!projects/women/1.html" >quick view</a>
										</div>
									</div>
									<div class="tovar_description clearfix">
										<a class="tovar_title" href="product-page.html" >SILK POCKET BLOUSE</a>
										<span class="tovar_price">$98.00</span>
									</div>
								</div><!-- //TOVAR -->
							</li>
							<li>
								<!-- TOVAR -->
								<div class="tovar_item_new">
									<div class="tovar_img">
										<img src="{{asset('frontend/images/product/kem_txn464_7_41a236ed47f941ec97438e85e0cefedd_grande.jpg')}}" alt="" />
										<div class="open-project-link">
											<a class="open-project tovar_view" href="javascript:void(0);" data-url="!projects/women/1.html" >quick view</a>
										</div>
									</div>
									<div class="tovar_description clearfix">
										<a class="tovar_title" href="product-page.html" >SWISS-DOT TUXEDO SHIRT</a>
										<span class="tovar_price">$65.00</span>
									</div>
								</div><!-- //TOVAR -->
							</li>
							<li>
								<!-- TOVAR -->
								<div class="tovar_item_new">
									<div class="tovar_img">
										<img src="{{asset('frontend/images/product/kem_txn435_7_63692dd4847249b69e77f766255f2940_grande.jpg')}}" alt="" />
										<div class="open-project-link">
											<a class="open-project tovar_view" href="javascript:void(0);" data-url="!projects/women/1.html" >quick view</a>
										</div>
									</div>
									<div class="tovar_description clearfix">
										<a class="tovar_title" href="product-page.html" >STRETCH PERFECT SHIRT</a>
										<span class="tovar_price">$72.00</span>
									</div>
								</div><!-- //TOVAR -->
							</li>
							<li>
								<!-- TOVAR -->
								<div class="tovar_item_new">
									<div class="tovar_img">
										<img src="{{asset('frontend/images/product/den_txn419_8_7bb54f17965241bb86d23c3bf7c7bea1_grande.jpg')}}" alt="" />
										<div class="open-project-link">
											<a class="open-project tovar_view" href="javascript:void(0);" data-url="!projects/women/1.html" >quick view</a>
										</div>
									</div>
									<div class="tovar_description clearfix">
										<a class="tovar_title" href="product-page.html" >Moonglow paisley silk tee</a>
										<span class="tovar_price">$98.00</span>
									</div>
								</div><!-- //TOVAR -->
							</li>
							<li>
								<!-- TOVAR -->
								<div class="tovar_item_new">
									<div class="tovar_img">
										<img src="{{asset('frontend/images/product/kem_txn427_7_0ce7d15a1fee4a1e8cd89ed68ebf84ba_grande.jpg')}}"alt="" />
										<div class="open-project-link">
											<a class="open-project tovar_view" href="javascript:void(0);" data-url="!projects/women/1.html" >quick view</a>
										</div>
									</div>
									<div class="tovar_description clearfix">
										<a class="tovar_title" href="product-page.html" >PEASANT TOP IN SUCKERED STRIPE</a>
										<span class="tovar_price">$78.00</span>
									</div>
								</div><!-- //TOVAR -->
							</li>
							<li>
								<!-- TOVAR -->
								<div class="tovar_item_new">
									<div class="tovar_img">
										<img src="{{asset('frontend/images/product/kem_txn473_7_4de7731b80f443318945221f622fe995_grande.jpg')}}" alt="" />
										<div class="open-project-link">
											<a class="open-project tovar_view" href="javascript:void(0);" data-url="!projects/women/1.html" >quick view</a>
										</div>
									</div>
									<div class="tovar_description clearfix">
										<a class="tovar_title" href="product-page.html" >EMBROIDERED BIB PEASANT TOP</a>
										<span class="tovar_price">$88.00</span>
									</div>
								</div><!-- //TOVAR -->
							</li>
							<li>
							
							</li>
						</ul>
					</div>
				</div><!-- //JCAROUSEL -->
			</div><!-- //CONTAINER -->
		</section><!-- //NEW ARRIVALS -->
		


		<!-- FOOTER -->
		<footer>
			
			<!-- CONTAINER -->
			<div class="container" data-animated='fadeInUp'>
				
				<!-- ROW -->
				<div class="row">
					
					<div class="col-lg-2 col-md-2 col-sm-3 col-xs-6 col-ss-12 padbot30">
						<h4>Contacts</h4>
						<div class="foot_address"><span>Glammy Shop</span>55 Ney York 6515, Grand Tower</div>
						<div class="foot_phone"><a href="tel:1 800 888 2828" >1 800 888 2828</a></div>
						<div class="foot_mail"><a href="mailto:info@glamyshop.com" >info@glamyshop.com</a></div>
						<div class="foot_live_chat"><a href="javascript:void(0);" ><i class="fa fa-comment-o"></i> Live chat</a></div>
					</div>
					
					<div class="col-lg-2 col-md-2 col-sm-3 col-xs-6 col-ss-12 padbot30">
						<h4>Information</h4>
						<ul class="foot_menu">
							<li><a href="about.html" >About us</a></li>
							<li><a href="javascript:void(0);" >Delivery</a></li>
							<li><a href="javascript:void(0);" >Privacy police</a></li>
							<li><a href="blog.html" >Blog</a></li>
							<li><a href="faq.html" >Faqs</a></li>
							<li><a href="contacts.html" >Countact us</a></li>
						</ul>
					</div>
					
					<div class="respond_clear_480"></div>
					
					<div class="col-lg-4 col-md-4 col-sm-6 padbot30">
						<h4>About shop</h4>
						<p>We ask for your name, telephone number, home address, email address and age for competitions, prize draws or newsletter sign ups. When a purchase is made on our site, in addition to the above, we also ask for delivery address, and payment method details.</p>
						<p>We may obtain information about your usage of our website to help us develop and improve it further through online surveys and other requests.</p>
					</div>
					
					<div class="col-lg-4 col-md-4 padbot30">
						<h4>Newsletter</h4>
						<form class="newsletter_form clearfix" action="javascript:void(0);" method="get">
							<input type="text" name="newsletter" value="Enter E-mail & Get 10% off" onFocus="if (this.value == 'Enter E-mail & Get 10% off') this.value = '';" onBlur="if (this.value == '') this.value = 'Enter E-mail & Get 10% off';" />
							<input class="btn newsletter_btn" type="submit" value="SIGN UP">
						</form>
						
						<h4>we are in social networks</h4>
						<div class="social">
							<a href="javascript:void(0);" ><i class="fa fa-twitter"></i></a>
							<a href="javascript:void(0);" ><i class="fa fa-facebook"></i></a>
							<a href="javascript:void(0);" ><i class="fa fa-google-plus"></i></a>
							<a href="javascript:void(0);" ><i class="fa fa-pinterest-square"></i></a>
							<a href="javascript:void(0);" ><i class="fa fa-tumblr"></i></a>
							<a href="javascript:void(0);" ><i class="fa fa-instagram"></i></a>
						</div>
					</div>
				</div><!-- //ROW -->
			</div><!-- //CONTAINER -->
			
			<!-- COPYRIGHT -->
			<div class="copyright">
				
				<!-- CONTAINER -->
				<div class="container clearfix">
					<div class="foot_logo"><a href="index.html" ><img src="{{asset('frontend/images/foot_logo.png')	}}" alt="" /></a></div>
					
					<div class="copyright_inf">
						<span>Glammy Shop© 2014</span> |
						<span>Theme by Anna Balashova</span> |
						<a class="back_top" href="javascript:void(0);" >Back to Top <i class="fa fa-angle-up"></i></a>
					</div>
				</div><!-- //CONTAINER -->
			</div><!-- //COPYRIGHT -->
		</footer><!-- //FOOTER -->
	</div><!-- //PAGE -->

<!-- TOVAR MODAL CONTENT -->
<div id="modal-body" class="clearfix" style="">
   <div id="tovar_content" style="opacity: 1;"><div class="tover_view_page element_fade_in">
   <div class="tover_view_header clearfix">
      <p>Quick view</p>
      <a id="tover_view_page_close" href="javascript:void(0);">Close<i>X</i></a>
   </div>
   
   <div class="clearfix">
       <div class="tovar_view_fotos clearfix">
                <div id="slider2" class="flexslider">
                  <ul class="slides">
                    <li><a href="javascript:void(0);" ><img class="src_image" src="" alt="" /></a></li>
                    <li><a href="javascript:void(0);" ><img class="src_image1" src="" alt="" /></a></li>
                    <li><a href="javascript:void(0);" ><img class="src_image2" src="" alt="" /></a></li>
                    <li><a href="javascript:void(0);" ><img class="src_image3" src="" alt="" /></a></li>
                  </ul>
                </div>
                <div id="carousel2" class="flexslider">
                  <ul class="slides">
                    <li><a href="javascript:void(0);" ><img class="src_image" src="" alt="" /></a></li>
                    <li><a href="javascript:void(0);" ><img class="src_image1" src="" alt="" /></a></li>
                    <li><a href="javascript:void(0);" ><img class="src_image2" src="" alt="" /></a></li>
                    <li><a href="javascript:void(0);" ><img class="src_image3" src="" alt="" /></a></li>
                  </ul>
                </div>
              </div>
       
      <div class="tovar_view_description">
      	 <form class="form-horizontal bucket-form" action="{{URL::TO('add_bag/0')}} " enctype='multipart/form-data' method="POST">
              @csrf
                <input id="prod_id" name="product_id" type="hidden" value="">
                <div class="tovar_view_title">Handy Sweetest Clutch</div>
                <div class="tovar_article">88-305-676</div>
                <div class="clearfix tovar_brend_price">
                  <div class="pull-left tovar_brend">Việt Nam</div>
                  <div class="pull-right tovar_view_price">999.000đ</div>
                </div>
               
                <div class="tovar_size_select">
                  <div class="clearfix">
                    <p class="pull-left">Chọn số lượng</p>
                    <span>Quantity & Size</span> </div>
                  <div class="buttons_added">
                    <input aria-label="quantity" class="input-qty" max="999999" min="1" name="quantity" type="number" value="1">
                  </div>               
                </div>
                <div class="tovar_view_btn">
                  	 <select class="basic" name='size'>
			           	</select>
                  <a class="add_bag" href="javascript:void(0);" ><i class="fa fa-shopping-cart"></i>Add to bag</a>
           </div>
      </form>
         <div class="tovar_shared clearfix">
            <p>Share item with friends</p>
            <ul>
               <li><a class="facebook" href="javascript:void(0);"><i class="fa fa-facebook"></i></a></li>
               <li><a class="twitter" href="javascript:void(0);"><i class="fa fa-twitter"></i></a></li>
               <li><a class="linkedin" href="javascript:void(0);"><i class="fa fa-linkedin"></i></a></li>
               <li><a class="google-plus" href="javascript:void(0);"><i class="fa fa-google-plus"></i></a></li>
               <li><a class="tumblr" href="javascript:void(0);"><i class="fa fa-tumblr"></i></a></li>
            </ul>
         </div>
      </div>
   </div>
</div></div>
   <div class="close_block"></div>
</div>
   ><!-- TOVAR MODAL CONTENT -->
                     <input id="signup-token" name="_token" type="hidden" value="{{csrf_token()}}">
<script type="text/javascript">
	$('.quickview').click(function(){
		var product_id=$(this).data('product_id');
        var $token=$('#signup-token').val();
          $.ajax({
             url:"{{URL::to('quickview')}}",
             method:"POST",
             data:{product_id:product_id,_token:$token}, 
                   success:function(data){
                 $('#prod_id').val(product_id);
                 $('.tovar_view_title').text(data.product_name);
                 $('.tovar_article').text(data._id);
                 $('.tovar_view_price').text(data.product_price);
                 $('.src_image').attr('src', ' https://localhost/mongo/public/image/product/'+data.product_image);
                 $('.src_image1').attr('src', 'https://localhost/mongo/public/image/product/'+data.product_image1);
                 $('.src_image2').attr('src', 'https://localhost/mongo/public/image/product/'+data.product_image2);
                 $('.src_image3').attr('src', 'https://localhost/mongo/public/image/product/'+data.product_image3);
                 }}) })
</script>
	<!-- SCRIPTS -->
	<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js')}}"></script><![endif]-->
    <!--[if IE]><html class="ie" lang="en"> <![endif]-->
	
	<script src="{{asset('frontend/js/jquery.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('frontend/js/bootstrap.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('frontend/js/jquery.sticky.js')}}" type="text/javascript"></script>
	<script src="{{asset('frontend/js/parallax.js')}}" type="text/javascript"></script>
	<script src="{{asset('frontend/js/jquery.flexslider-min.js')}}" type="text/javascript"></script>
	<script src="{{asset('frontend/js/jquery.jcarousel.js')}}" type="text/javascript"></script>
	<script src="{{asset('frontend/js/jqueryui.custom.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('frontend/js/fancySelect.js')}}"></script>
	<script src="{{asset('frontend/js/animate.js')}}" type="text/javascript"></script>
	<script src="{{asset('frontend/js/myscript.js')}}" type="text/javascript"></script>
	<script type="text/javascript">
		
	</script>
</body>
</html>