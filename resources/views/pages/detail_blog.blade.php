   @extends('templates.layout')

@section('content')
      <!-- BREADCRUMBS -->
      <section class="breadcrumb parallax margbot30"></section>
      <!-- //BREADCRUMBS -->
      
      
      <!-- PAGE HEADER -->
      <section class="page_header">
         
         <!-- CONTAINER -->
         <div class="container">
            <h3 class="pull-left"><b>Blog Post</b></h3>
            
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
               <div class="col-lg-9 col-md-9 col-sm-9">
                  
                  <article class="post blog_post clearfix margbot20" data-appear-top-offset='-100' data-animated='fadeInUp'>
                     <div class="post_title" href="blog-post.html" >{{$blog->blog_name}}</div>
                     <ul class="post_meta">
                        <li><i class="fa fa-user"></i><a href="javascript:void(0);" >{{$blog->blog_author}}</a></li>
                        <li><i class="fa fa-comments"></i>Commetcs <span class="sep">|</span> 15</li>
                        <li><i class="fa fa-eye"></i>views <span class="sep">|</span> {{ $blog->blog_view}}</li>
                     </ul>
                     <div class="post_large_image">
                        <div class="recent_post_date">15<span>dec</span></div>
                        <img src="{{asset('image/blog/'.$blog->blog_image)}}" alt="" />
                     </div>
                     
                     <div class="blog_post_content">
                       {!!$blog->blog_content!!}
                     </div>
                     
                  </article>
                  
                  <div class="shared_tags_block clearfix" data-appear-top-offset='-100' data-animated='fadeInUp'>
                     <div class="pull-left post_tags">
                        <a href="javascript:void(0);" >DRESS</a>
                        <a href="javascript:void(0);" >Sweaters</a>
                        <a href="javascript:void(0);" >MATERNITY</a>
                        <a href="javascript:void(0);" >SHIRTS & TOPS</a>
                     </div>
                     
                     <div class="pull-right tovar_shared clearfix">
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
                  
                  
                  <!-- COMMENTS -->
                  <div id="comments" data-appear-top-offset='-100' data-animated='fadeInUp'>
                     <h2>Comments (3)</h2>
                     <ol id="comments1">
                     </ol>
                  </div><!-- //COMMENTS -->
                  <!-- LEAVE A COMMENT -->
                  <div id="comment_form" data-appear-top-offset='-100' data-animated='fadeInUp'>
                     <h2>Leave a Comment</h2>
                     <div class="comment_form_wrapper">
                        <form action="javascript:void(0);" method="post">
                           <input type="text" id="name_comment" name="name" value="Name" onFocus="if (this.value == 'Name') this.value = '';" onBlur="if (this.value == '') this.value = 'Name';" />
                           <textarea  id="review-textarea" name="message" onFocus="if (this.value == 'Your comment') this.value = '';" onBlur="if (this.value == '') this.value = 'Your comment';">Your comment</textarea>
                           <div class="clear"></div>
                           <span class="comment_note">Your email address will not be published. Required fields are marked *</span>
                           <input type="submit" class="dark-blue big" value="Send comment" />
                           <div class="clear"></div>
                        </form>
                     </div>
                  </div><!-- //LEAVE A COMMENT -->
            
            

                  <article class="post margbot40 clearfix" data-appear-top-offset='-100' data-animated='fadeInUp'>
                     <a class="post_image pull-left" href="blog-post.html" >
                        <div class="recent_post_date">24<span>feb</span></div>
                        <img src="{{asset('frontend/images/blog/5.jpg')}}" alt="" />
                     </a>
                     <a class="post_title" href="blog-post.html" >DIY Beauty: The Best Use of Valentine's Day Roses</a>
                     <div class="post_content">The beauty of self-hosted WordPress, is that you can build your site however you like, want to add forums to your website? Done. Want to add a ecommerce to your blog? Done. The beauty of self-hosted WordPress, is that you can build your site however you like, want to add forums to your website? Done. Want to add a ecommerce to your blog? Done.</div>
                     <ul class="post_meta">
                        <li><i class="fa fa-user"></i><a href="javascript:void(0);" >Anna Balashova</a></li>
                        <li><i class="fa fa-comments"></i>Commetcs <span class="sep">|</span> 15</li>
                        <li><i class="fa fa-eye"></i>views <span class="sep">|</span> 259</li>
                     </ul>
                  </article>
                  
                  <article class="post margbot40 clearfix" data-appear-top-offset='-100' data-animated='fadeInUp'>
                     <a class="post_image pull-left" href="blog-post.html" >
                        <div class="recent_post_date">08<span>Oct</span></div>
                        <img src="{{asset('frontend/images/blog/6.jpg')}}" alt="" />
                     </a>
                     <a class="post_title" href="blog-post.html" >Editor's Style: Dobrina Zhekova's Touch of Sparkle</a>
                     <div class="post_content">The beauty of self-hosted WordPress, is that you can build your site however you like, want to add forums to your website? Done. Want to add a ecommerce to your blog? Done. The beauty of self-hosted WordPress, is that you can build your site however you like, want to add forums to your website? Done. Want to add a ecommerce to your blog? Done.</div>
                     <ul class="post_meta">
                        <li><i class="fa fa-user"></i><a href="javascript:void(0);" >Anna Balashova</a></li>
                        <li><i class="fa fa-comments"></i>Commetcs <span class="sep">|</span> 15</li>
                        <li><i class="fa fa-eye"></i>views <span class="sep">|</span> 259</li>
                     </ul>
                  </article>
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
                        <li><a href="javascript:void(0);" >Sweaters</a></li>
                        <li><a href="javascript:void(0);" >SHIRTS &amp; TOPS</a></li>
                        <li><a href="javascript:void(0);" >KNITS &amp; TEES</a></li>
                        <li><a href="javascript:void(0);" >PANTS</a></li>
                        <li><a href="javascript:void(0);" >DENIM</a></li>
                        <li><a href="javascript:void(0);" >DRESSES</a></li>
                        <li><a href="javascript:void(0);" >Maternity</a></li>
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
                        <li class="widget_popular_post_item clearfix">
                           <a class="widget_popular_post_img" href="blog-post.html" ><img src="{{asset('frontend/images/blog/popular1.jpg')}}" alt="" /></a>
                           <a class="widget_popular_post_title" href="blog-post.html" >New Fashion Vintage Double Breasted Trench Long</a>
                           <span class="widget_popular_post_date">13 January 2014</span>
                        </li>
                        <li class="widget_popular_post_item clearfix">
                           <a class="widget_popular_post_img" href="blog-post.html" ><img src="{{asset('frontend/images/blog/popular2.jpg')}}" alt="" /></a>
                           <a class="widget_popular_post_title" href="blog-post.html" >In the Kitchen with…The New Potato</a>
                           <span class="widget_popular_post_date">10 January 2014</span>
                        </li>
                        <li class="widget_popular_post_item clearfix">
                           <a class="widget_popular_post_img" href="blog-post.html" ><img src="{{asset('frontend/images/blog/popular3.jpg')}}" alt="" /></a>
                           <a class="widget_popular_post_title" href="blog-post.html" >2013 Hot Women thicken fleece Warm Coat Lady</a>
                           <span class="widget_popular_post_date">5 January 2014</span>
                        </li>
                     </ul>
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
                     
                     <ul class="tovar_items_small">
                        <li class="clearfix">
                           <img class="tovar_item_small_img" src="{{asset('frontend/images/tovar/women/1.jpg')}}" alt="" />
                           <a href="product-page.html" class="tovar_item_small_title">Embroidered bib peasant top</a>
                           <span class="tovar_item_small_price">$88.00</span>
                        </li>
                        <li class="clearfix">
                           <img class="tovar_item_small_img" src="{{asset('frontend/images/tovar/women/2.jpg')}}" alt="" />
                           <a href="product-page.html" class="tovar_item_small_title">Merino tippi sweater in geometric</a>
                           <span class="tovar_item_small_price">$67.00</span>
                        </li>
                        <li class="clearfix">
                           <img class="tovar_item_small_img" src="{{asset('frontend/images/tovar/women/3.jpg')}}" alt="" />
                           <a href="product-page.html" class="tovar_item_small_title">Merino triple-stripe elbow-patch sweater</a>
                           <span class="tovar_item_small_price">$94.00</span>
                        </li>
                     </ul>
                  </div><!-- //WIDGET BEST SELLERS -->
                  
                  <!-- BANNERS WIDGET -->
                  <div class="widget_banners">
                     <a class="banner nobord margbot10" href="javascript:void(0);" ><img src="{{asset('frontend/images/tovar/banner10.jpg')}}" alt="" /></a>
                     <a class="banner nobord margbot10" href="javascript:void(0);" ><img src="{{asset('frontend/images/tovar/banner9.jpg')}}" alt="" /></a>
                     <a class="banner nobord margbot10" href="javascript:void(0);" ><img src="{{asset('frontend/images/tovar/banner8.jpg')}}" alt="" /></a>
                  </div><!-- //BANNERS WIDGET -->
               </div><!-- //SIDEBAR -->
            </div><!-- //ROW -->
         </div><!-- //CONTAINER -->
      </section><!-- //BLOG BLOCK -->
            <input id="signup-token" name="_token" type="hidden" value="{{csrf_token()}}">
                 <input id="blog_id" name="blog_id" type="hidden" value="{{ $blog->id}}">
                  <script type="text/javascript">
   $(document).ready(function(){
      load_comment();
      function load_comment(){
         var blog_id=$('#blog_id').val();
        var $token=$('#signup-token').val();
          var comment=$('#review-textarea').val();
           var name=$('#name_comment').val();
      $.ajax({
             url:"{{URL::to('load_comment_blog')}}",
             method:"POST",
             data:{blog_id:blog_id,comment:comment,name:name,_token:$token}, 
                           success:function(data){
                              $('#comments1').html(data);
                      }})  ;  }
      $('.dark-blue').click(function(){
            var blog_id=$('#blog_id').val();
        var $token=$('#signup-token').val();
                 var comment=$('#review-textarea').val();
           var name=$('#name_comment').val();   
  $.ajax({
             url:"{{URL::to('send_comment_blog')}}",
             method:"POST",
             data:{blog_id:blog_id,comment:comment,name:name,_token:$token}, 
                           success:function(data){
                             load_comment();
                             $('#review-textarea').val('');
                      }});
      })
   })
</script>
   @endsection