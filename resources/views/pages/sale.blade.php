
    	@extends('templates.layout')

@section('content')

    <section class="breadcrumb parallax margbot30"></section>
    
    <!-- BANNER SECTION -->
    <section class="banner_section"> 
      
      <!-- CONTAINER -->
      <div class="container"> 
        
        <!-- ROW -->
        <div class="row">
          <div class="top_sale_banners center">
            <div class="col"><a class="banner nobord margbot30" href="javascript:void(0);" ><<img src="{{asset('frontend/images/slide/bestseller_1702_1920X658 (1).png')}}" alt=""></a></div>
          </div>
        </div>
        <!-- //ROW --> 
      </div>
      <!-- //CONTAINER --> 
    </section>
    <!-- //BANNER SECTION -->
    
    <section class="portfolio">
      <div class="container">
        <div>
          <button class="btn btn-default filter-button" data-filter="all">Tất cả</button>
          <button class="btn btn-default filter-button" data-filter="50">50%</button>
          <button class="btn btn-default filter-button" data-filter="20">20%</button>
          <button class="btn btn-default filter-button" data-filter="10">10%</button>
        </div>
        </br>
        <!-- ROW -->
        <div class="row"> 
          
          <!-- TOVAR WRAPPER -->
          <div class="tovar_wrapper" data-appear-top-offset='-100' data-animated='fadeInUp'> 
            @foreach($product as $pr)
                        <!-- TOVAR1 -->
            <div class="col-lg-3 col-xs-6 padbot40 filter center 50 ">
              <div class="tovar_item tovar_sale_{{$pr->product_sale}}">
                <div class="tovar_img"  onclick="location='{{asset('detail_product/'.$pr->id)}}'">
                  <div class="tovar_img_wrapper"> <img class="img"  src="{{asset('image/product/'.$pr->product_image)}}" alt="50" /> <img class="img_h"  src="{{asset('image/product/'.$pr->product_image1)}}" alt="" /> </div>
                  <div class="tovar_item_btns">
                    <div class="open-project-link"><a onclick="location='{{asset('detail_product/'.$pr->id)}}'" class="open-project tovar_view" href="javascript:void(0);" data-url="!projects" >Xem nhanh</a></div>
                    <a class="add_bag" href="javascript:void(0);" ><i class="fa fa-shopping-cart"></i></a> </div>
                </div>
                <div class="tovar_description clearfix"> <a class="tovar_title" href="product-PK.php?id_sanpham=1" >{{$pr->product_name}}</a> <span class="tovar_price">${{$pr->product_price}}</span> </div>
              </div>
            </div>    
			   <!-- //TOVAR1 --> 
             @endforeach
          </div>
          <!-- //TOVAR WRAPPER --> 
        </div>
        <!-- //ROW --> 
		   <hr>
            <div class="clearfix"> 
              <!-- PAGINATION -->
              <ul class="pagination">
				   <li><a href="javascript:void(0);" >...</a></li>
				                  <li><a href="?trang=0 " href="javascript:void(0);" >0</a></li>                 <li><a href="?trang=1 " href="javascript:void(0);" >1</a></li>                 <li><a href="?trang=2 " href="javascript:void(0);" >2</a></li>                 <li><a href="?trang=3 " href="javascript:void(0);" >3</a></li>                 <li><a href="?trang=4 " href="javascript:void(0);" >4</a></li>                 <li><a href="?trang=5 " href="javascript:void(0);" >5</a></li>                 <li><a href="?trang=6 " href="javascript:void(0);" >6</a></li>                 <li><a href="javascript:void(0);" >...</a></li>
              </ul>
              <!-- //PAGINATION -->
              <a  class="show_all_tovar" href="javascript:void(0);"  >Hiển thị tất cả</a> </div>
            <hr>
      </div>
    </section>
   

	 <script>
	$(document).ready(function(){
	$(".filter-button").click(function(){
		var value=$(this).attr('data-filter');
		if(value=="all")
	$('.filter').show('1000');
		else
			{
				$(".filter").not('.'+value).hide('3000');
				$(".filter").filter('.'+value).show('3000');
			}
	});
		if($(".filter-button").removeClass("active"))
			{
				$(this).removeClass("active");
			}
		$(this).addClass("active");
	});		
	</script>
@endsection