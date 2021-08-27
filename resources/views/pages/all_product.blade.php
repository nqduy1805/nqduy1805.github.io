@extends('templates.layout')

@section('content')
			<!-- BREADCRUMBS -->
   <section class="breadcrumb margbot30"> 
      
      <!-- CONTAINER -->
      <div> </div>
      <!-- //CONTAINER --> 
      
    </section>		<!-- //BREADCRUMBS -->
    
   		<!-- SHOP BLOCK -->
		<section class="shop">
			<!-- CONTAINER -->
			<div class="container">			
				<!-- ROW -->
				<div class="row">
					<form id="form_filter" action="" method="get">
					<input type="hidden" name="size" value="<?php if(isset($_GET['size'])) echo $_GET['size']; ?>"/>
					<input type="hidden" name="search" value="<?php if(isset($_GET['search'])) echo $_GET['search']; ?>"/>
					<!-- SIDEBAR -->
					<div id="sidebar" class="col-lg-3 col-md-3 col-sm-3 padbot50">
					
						<!-- CATEGORIES -->
						<div class="sidepanel widget_categories">
							<h3>{{$category_page->category->category_name}} Categories {{$select_ft}} a</h3>
							<ul>
								@foreach($category as $cag)
								@if($category_page->category_parent==$cag->category_parent)
								<li class="active"><a  href="{{ request()->fullUrlWithQuery(['category_id' => $cag->id]) }} " >{{$cag->category_name}}</a></li>
								@endif
								@endforeach
							</ul>
						</div><!-- //CATEGORIES -->
						<!-- PRICE RANGE -->
						<div class="sidepanel widget_pricefilter">
							<h3>Filter by price</h3>
							<div id="price-range" class="clearfix">
								<label for="amount">Range:</label>
								<input type="text" name="amount_price" id="amount"/>
								<div class="padding-range"><div id="slider-range"></div></div>
							</div>
						</div><!-- //PRICE RANGE -->
						<!-- SHOP BY SIZE -->
						<div class="sidepanel widget_sized">
							<h3>SHOP BY SIZE</h3>
							@if($category_page->category->category_name=="SHOES")
							<ul>
								<li class="{{Request::get('size')=="35" ? "active":""}}"><a href="{{ request()->fullUrlWithQuery(['size' => '35']) }} " >35</a></li>
								<li class="{{Request::get('size')=="36" ? "active":""}}"><a href="{{ request()->fullUrlWithQuery(['size' => '36']) }} " >36</a></li>
								<li class="{{Request::get('size')=="37" ? "active":""}}"><a href="{{ request()->fullUrlWithQuery(['size' => '37']) }} " >37</a></li>
								<li class="{{Request::get('size')=="38"? "active":""}}"><a href="{{ request()->fullUrlWithQuery(['size' => '38']) }} "  >38</a></li>
								<li class="{{Request::get('size')=="39"? "active":""}}"><a href="{{ request()->fullUrlWithQuery(['size' => '39']) }} "  >39</a></li>
			             	<li class="{{Request::get('size')=="40"? "active":""}}"><a href="{{ request()->fullUrlWithQuery(['size' => '40']) }} "  >40</a></li>
								<li class="{{Request::get('size')=="41" ? "active":""}}"><a href="{{ request()->fullUrlWithQuery(['size' => '41']) }} "  >41</a></li>
								<li class="{{Request::get('size')=="42" ? "active":""}}"><a href="{{ request()->fullUrlWithQuery(['size' => '42']) }} "  >42</a></li>
							</ul>
							@else 
							<li class="{{Request::get('size')=="XS" ? "active":""}}"><a href="{{ request()->fullUrlWithQuery(['size' => 'XS']) }} " >XS</a></li>
								<li class="{{Request::get('size')=="S"? "active":""}}"><a href="{{ request()->fullUrlWithQuery(['size' => 'S']) }} "  >S</a></li>
								<li class="{{Request::get('size')=="M"? "active":""}}"><a href="{{ request()->fullUrlWithQuery(['size' => 'M']) }} "  >M</a></li>
			             	<li class="{{Request::get('size')=="L"? "active":""}}"><a href="{{ request()->fullUrlWithQuery(['size' => 'L']) }} "  >L</a></li>
								<li class="{{Request::get('size')=="XL" ? "active":""}}"><a href="{{ request()->fullUrlWithQuery(['size' => 'XL']) }} "  >XL</a></li>
							@endif
						</div><!-- //SHOP BY SIZE -->
						<!-- SHOP BY COLOR -->
						<div class="sidepanel widget_brands">
							<h3>SHOP BY BRANDS</h3>
							<input class="filter_checkbox" {{Request::get('brand0')=="on" ? "checked":""}} type="checkbox" name="brand0" id="categorymanufacturer1" /><label for="categorymanufacturer1">VERSACE <span>(24)</span></label>
							<input class="filter_checkbox" {{Request::get('brand1')=="on" ? "checked":""}} type="checkbox" name="brand1" id="categorymanufacturer2" /><label for="categorymanufacturer2">J CREW <span>(35)</span></label>
							<input class="filter_checkbox" {{Request::get('brand2')=="on" ? "checked":""}} type="checkbox" name="brand2" id="categorymanufacturer3" /><label for="categorymanufacturer3">Calvin KlEin <span>(48)</span></label>
							<input class="filter_checkbox" {{Request::get('brand3')=="on" ? "checked":""}} type="checkbox" name="brand3" id="categorymanufacturer4" /><label for="categorymanufacturer4">Tommy hilfiger <span>(129)</span></label>
							<input class="filter_checkbox" {{Request::get('brand4')=="on" ? "checked":""}} type="checkbox" name="brand4" id="categorymanufacturer5" /><label for="categorymanufacturer5">Ralph Lauren <span>(69)</span></label>
						</div><!-- //SHOP BY BRANDS -->
						<!-- BANNERS WIDGET -->
						<div class="widget_banners">
							<a class="banner nobord margbot10" href="javascript:void(0);" ><img src="{{asset('frontend/images/tovar/bn1.jpg')}}" alt="" /></a>
							<a class="banner nobord margbot10" href="javascript:void(0);" ><img src="{{asset('frontend/images/tovar/bn1.jpg')}}"alt="" /></a>
							
						</div><!-- //BANNERS WIDGET -->
					</div><!-- //SIDEBAR -->
					<!-- SHOP PRODUCTS -->
					<div class="col-lg-9 col-sm-9 col-sm-9 padbot20">
						<!-- SHOP BANNER -->
						<div class="banner_block margbot15">
							<a class="banner nobord" href="javascript:void(0);" ><img src="{{asset('frontend/images/slide/slideshow_5.jpg')}}" alt="" /></a>
						</div><!-- //SHOP BANNER -->
						
						<!-- SORTING TOVAR PANEL -->
						<div class="sorting_options clearfix">
							<!-- COUNT TOVAR ITEMS -->
							<div class="count_tovar_items">
								<p>{{$category_page->category_name}}</p>
								<span>{{$product->count()}} Items</span>
							</div><!-- //COUNT TOVAR ITEMS -->
							<!-- TOVAR FILTER -->
							<div class="product_sort">
								<p >SORT BY</p>
								<select class="basic" name="select_ft" id="select_f" onchange="select_filter()" >
									<option {{Request::get('select_ft')=="ASC" ? "selected":""}} class="select_f" value="ASC">Low to High</option>
									<option {{Request::get('select_ft')=="DESC" ? "selected":""}} class="select_f" value="DESC">High to Low</option>
									<option {{Request::get('select_ft')=="ODESC" ? "selected":""}} class="select_f" value="ODESC">Newest to Oldest</option>
									<option {{Request::get('select_ft')=="NASC" ? "selected":""}} class="select_f" value="NASC">Oldest to Newest</option>
								</select>
							</div><!-- //TOVAR FILTER -->

							<!-- PRODUC SIZE -->
							<div id="toggle-sizes">
								<a class="view_box active" href="javascript:void(0);"><i class="fa fa-th-large"></i></a>
								<a class="view_full" href="javascript:void(0);"><i class="fa fa-th-list"></i></a>
							</div><!-- //PRODUC SIZE -->
						</div><!-- //SORTING TOVAR PANEL -->
					</form>
						<!-- ROW -->
						<div class="row shop_block">
								@foreach($product as $pr)
							<!-- TOVAR1 -->
							<div class="tovar_wrapper col-lg-4 col-md-4 col-sm-6 col-xs-6 col-ss-12 padbot40">
								<div class="tovar_item clearfix tovar_sale_{{$pr->product_sale}}">
									<div class="tovar_img">
										<div class="tovar_img_wrapper"  onclick="location='{{asset('detail_product/'.$pr->id)}}'">
											<img class="img" src="{{asset('image/product/'.$pr->product_image)}}" alt="" />
											<img class="img_h"  src="{{asset('image/product/'.$pr->product_image1)}}" alt="" />
										</div>
										<div class="tovar_item_btns">
											<div class="open-project-link"><a class="quickview open-project tovar_view" href="javascript:void(0);" data-product_id="{{$pr->id}}"  ><span>quick</span> view</a></div>
											<a class="add_lovelist" href="javascript:void(0);" ><i class="fa fa-heart"></i></a>
										</div>
									</div>
									<div class="tovar_description clearfix">
										<a class="tovar_title" href="{{asset('detail_product/'.$pr->id)}}" >{{$pr->product_name}}</a>
										<a class="tovar_title"  > </a>
										<span class="tovar_price sale_price">${{$pr->product_price}}</span>
										<span class="tovar_price saled_price " >${{$pr->product_price*(100-$pr->product_sale)/100}}</span>
									</div>
									<div class="tovar_content">{{$pr->product_info}}</div>
								</div>
							</div><!-- //TOVAR1 -->
							@endforeach
						</div><!-- //ROW -->
						
						<hr>
						@if($product->count()>0)
						<div class="clearfix">
							<!-- PAGINATION -->
							<ul class="pagination">
								<li><a href="javascript:void(0);" >...</a></li>
								<?php  if(isset($_GET['page'])&&$_GET['page']>4) 
                               $page=$_GET['page'];
                               else  
                               $page=4;
				              for($i=$page-3;$i<$page+4;$i++){ ?>
								<li class="{{Request::get('page')=="$i" ? "active":""}}"><a href="{{ request()->fullUrlWithQuery(['page' => "$i"]) }} " >{{$i}}</a></li>
								<?php  } ?>
                         	<li><a href="javascript:void(0);" >...</a></li>
							</ul><!-- //PAGINATION -->
							
							<a class="show_all_tovar" href="javascript:void(0);" >show all</a>
							
						</div>
						<!-- //PAGINATION -->
						@else
						<p>NO PRODUCT FOUND</p>
						@endif
						<hr>
						
						<div class="padbot60 services_section_description">
							
						</div>
						
						<!-- SHOP BANNER -->

					</div><!-- //SHOP PRODUCTS -->
				</div><!-- //ROW -->
			</div><!-- //CONTAINER -->
		</section><!-- //SHOP -->
		<script type="text/javascript">
	$('#slider-range').on('mouseup',function(){$('#form_filter').submit();})
	$('.filter_checkbox').on('input',function(){$('#form_filter').submit();})
	$('.basic').on('change',function(){$('#form_filter').submit();})
	function select_filter() {
  document.getElementById("form_filter").submit();}
	$(function() {$( "#slider-range" ).slider({ range: true, min: 0, max: 2000, values: [<?php if(isset($_GET['amount_price'])){ $amount_price=$_GET['amount_price'];$amount_price=str_replace('$', '', $amount_price); $amount_price=str_replace('-', ',', $amount_price);echo $amount_price;} else echo '0,2000'?>], slide: function( event, ui ) { $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] ); } }); $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) + " - $" + $( "#slider-range" ).slider( "values", 1 ) ); });
</script>
@endsection	