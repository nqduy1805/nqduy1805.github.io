  @extends('templates.layout')

@section('content')
  <!-- BREADCRUMBS -->
      <section class="breadcrumb parallax margbot30"></section>
      <!-- //BREADCRUMBS -->
      
      
      <!-- PAGE HEADER -->
      <section class="page_header">
         
         <!-- CONTAINER -->
         <div class="container">
            <h3 class="pull-left"><b>Blog</b></h3>
            
            <div class="pull-right">
               <a href="women.html" >Back to shop<i class="fa fa-angle-right"></i></a>
            </div>
         </div><!-- //CONTAINER -->
      </section><!-- //PAGE HEADER -->
      
      
      <!-- BLOG BLOCK -->
      <section class="blog">
         
         <!-- CONTAINER -->
         <div class="container">
         
            <!-- ROW -->
            <div class="row">
               
               <!-- BLOG LIST -->
               <div class="col-lg-9 col-md-9 col-sm-9 padbot30">
                  <?php $i=1 ?>
                                    @foreach($blog as $bl)
                      @if($i===1)

                  <article class="post large_image clearfix margbot30" data-appear-top-offset='-100' data-animated='fadeInUp'>
                     <a class="post_title" href="blog-post.html" >{{$bl->blog_name}}</a>
                     <ul class="post_meta">
                        <li><i class="fa fa-user"></i><a href="javascript:void(0);" >{{ $bl->blog_author}}</a></li>
                        <li><i class="fa fa-comments"></i>Commetcs <span class="sep">|</span> 15</li>
                        <li><i class="fa fa-eye"></i>views <span class="sep">|</span> {{ $bl->blog_view}}</li>
                     </ul>
                     <a class="post_large_image" href="{{URL::to('detail_blog/'.$bl->id)}}" >
                        <div class="recent_post_date">{{$bl->created_at->format('d')}}<span>{{$bl->created_at->format('M')}}</span></div>
                        <img src="{{asset('image/blog/'.$bl->blog_image)}}" alt="" />
                     </a>
                  </article>
                      @else
                  <article class="post margbot40 clearfix" data-appear-top-offset='-100' data-animated='fadeInUp'>
                     <a class="post_image pull-left "  href="{{URL::to('detail_blog/'.$bl->id)}}" >
                        <div class="recent_post_date">{{$bl->created_at->format('d')}}<span>{{$bl->created_at->format('M')}}</span></div>
                        <img src="{{asset('image/blog/'.$bl->blog_image)}}" alt="" />
                     </a>
                     <a class="post_title" href="blog-post.html" >{{ $bl->blog_name}}</a>
                     <div class="post_content">{!!$bl->blog_summary!!}</div>
                     <ul class="post_meta">
                        <li><i class="fa fa-user"></i><a href="javascript:void(0);" >{{ $bl->blog_author}}</a></li>
                        <li><i class="fa fa-comments"></i>Commetcs <span class="sep">|</span> 15</li>
                        <li><i class="fa fa-eye"></i>views <span class="sep">|</span> {{ $bl->blog_view}}</li>
                     </ul>
                  </article>
                  @endif
                                    <?php $i=2 ?>
                  @endforeach

                  
                  <hr>
                  
                  <!-- PAGINATION -->
                  <ul class="pagination clearfix">
                     <li><a href="javascript:void(0);" >1</a></li>
                     <li><a href="javascript:void(0);" >2</a></li>
                     <li class="active"><a href="javascript:void(0);" >3</a></li>
                     <li><a href="javascript:void(0);" >4</a></li>
                     <li><a href="javascript:void(0);" >5</a></li>
                     <li><a href="javascript:void(0);" >6</a></li>
                     <li><a href="javascript:void(0);" >...</a></li>
                  </ul><!-- //PAGINATION -->
               </div><!-- //BLOG LIST -->
               <!-- SIDEBAR -->
               <div id="sidebar" class="col-lg-3 col-md-3 col-sm-3 padbot50">
                  
                  <!-- WIDGET SEARCH -->
                  <div class="sidepanel widget_search">
                     <form class="search_form" action="javascript:void(0);" method="get" name="search_form">
                        <input type="text" name="Search..." value="Search..." onFocus="if (this.value == 'Search...') this.value = '';" onBlur="if (this.value == '') this.value = 'Search...';" />
                     </form>
                  </div><!-- //WIDGET SEARCH -->
                  
                  <!-- CATEGORIES -->
                  <div class="sidepanel widget_categories">
                     <h3>BLOG CATEGORIES</h3>
                     <ul>
                        @foreach($category as $cgr_bl)
                         @if($cgr_bl->category_parent=="611a8fe9224500007c006beb")
                        <li><a href="javascript:void(0);" >{{$cgr_bl->category_name}}</a></li>
                        @endif
                        @endforeach
                     </ul>
                  </div><!-- //CATEGORIES -->
                                 <!-- NEWSLETTER FORM WIDGET -->
                  <div class="sidepanel widget_newsletter">
                     <div class="newsletter_wrapper">
                        <h3>NEWSLETTER</h3>
                        <form class="newsletter_form clearfix" action="javascript:void(0);" method="get">
                           <input type="text" name="newsletter" value="Enter E-mail & Get 10% off" onFocus="if (this.value == 'Enter E-mail & Get 10% off') this.value = '';" onBlur="if (this.value == '') this.value = 'Enter E-mail & Get 10% off';" />
                           <input class="btn newsletter_btn" type="submit" value="Sign up & get 10% off">
                        </form>
                     </div>
                  </div><!-- //NEWSLETTER FORM WIDGET -->
                  <!-- WIDGET POPULAR POSTS -->
                  <div class="sidepanel widget_popular_posts">
                     <h3>POPULAR POSTS</h3>
                     <ul>
                        @foreach($blog_popular as $blog_ppl)
                        <li class="widget_popular_post_item clearfix">
                           <a class="widget_popular_post_img" href="blog-post.html" ><img src="{{asset('image/blog/'.$blog_ppl->blog_image)}}" alt="" /></a>
                           <a class="widget_popular_post_title" href="blog-post.html" >{{$blog_ppl->blog_name}}</a>
                           <span class="widget_popular_post_date">{{$blog_ppl->created_at->format('d M Y')}}</span>
                        </li>
                     </ul>
                     @endforeach
                  </div><!-- //WIDGET POPULAR POSTS -->
                  
                  <!-- WIDGET POPULAR TAGS -->
                  <div class="sidepanel widget_tags">
                     <h3>Popular Tags</h3>
                     
                     <a href="javascript:void(0);" >DRESS</a>
                     <a href="javascript:void(0);" >Sweaters</a>
                     <a href="javascript:void(0);" >MATERNITY</a>
                     <a href="javascript:void(0);" >SHIRTS & TOPS</a>
                     <a href="javascript:void(0);" >BEAUTY</a>
                     <a href="javascript:void(0);" >SHOP</a>
                     <a href="javascript:void(0);" >Jackets & Blazers</a>
                     <a href="javascript:void(0);" >Outerwear</a>
                  </div><!-- //WIDGET POPULAR TAGS -->
                  
                  <!-- WIDGET BEST SELLERS -->
                  <div class="sidepanel widget_best_sellers">
                     <h3>BEST SELLERS</h3>
                     @foreach($best_seller as $best_sell)
                     <ul class="tovar_items_small">
                        <li class="clearfix">
                           <img class="tovar_item_small_img" src="{{asset('image/product/'.$best_sell->product->product_image)}}" alt="" />
                           <a href="product-page.html" class="tovar_item_small_title">{{$best_sell->product->product_name}}</a>
                           <span class="tovar_item_small_price">${{$best_sell->product->product_price}}</span>
                        </li>
                     </ul>
                     @endforeach
                  </div><!-- //WIDGET BEST SELLERS -->
                  
                  <!-- BANNERS WIDGET -->
                  <div class="widget_banners">
                  <a class="banner nobord margbot10" href="javascript:void(0);" ><img src="{{asset('frontend/images/tovar/bn1.jpg')}}" alt=""></a>                 
                  <a class="banner nobord margbot10" href="javascript:void(0);" ><img src="{{asset('frontend/images/tovar/bn1.jpg')}}"alt=""></a>
                  </div><!-- //BANNERS WIDGET -->
               </div><!-- //SIDEBAR -->
            </div><!-- //ROW -->
         </div><!-- //CONTAINER -->
      </section><!-- //BLOG BLOCK -->
      @endsection
