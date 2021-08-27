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
               <a href="{{URL::to('HOME')}}" >Back to shop<i class="fa fa-angle-right"></i></a>
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
                     <h2>Comments </h2>
                     <ol id="comments1" class="cart-items">
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
                        @foreach($category as $cg)
                        @if($cg->category_parent!=0&&$cg->category->category_name=="BLOG")
                        <li><a href="{{URL::to('all_blog/'.$cg->id)}}" >{{$cg->category_name}}</a></li>
                        @endif
                        @endforeach
                     </ul>
                  </div><!-- //CATEGORIES -->                  
                  <!-- WIDGET POPULAR POSTS -->
                  <div class="sidepanel widget_popular_posts">
                     <h3>POPULAR POSTS</h3>
                     <ul>
                        @foreach($blog_popular as $pp_bl)
                        <li class="widget_popular_post_item clearfix">
                           <a class="widget_popular_post_img"  href="{{asset('detail_blog/'.$pp_bl->id)}}" ><img src="{{asset('image/blog/'.$pp_bl->blog_image)}}" alt="" /></a>
                           <a class="widget_popular_post_title" href="{{asset('detail_blog/'.$pp_bl->id)}}">{{$pp_bl->blog_name}}</a>
                           <span class="widget_popular_post_date">{{$pp_bl->created_at->format('d M Y')}}</span>
                        </li>
                        @endforeach
                     </ul>
                  </div><!-- //WIDGET POPULAR POSTS -->
                  
                  <!-- WIDGET POPULAR TAGS -->
                  <div class="sidepanel widget_tags">
                     <h3>Popular Tags</h3>
                     @foreach($category as $cg)
                        @if($cg->category_parent!=0&&$cg->category->category_name=="BLOG")
                        <a href="{{URL::to('all_blog/'.$cg->id)}}" >{{$cg->category_name}}</a>
                        @endif
                        @endforeach
                  </div><!-- //WIDGET POPULAR TAGS -->
                  
                  <!-- WIDGET BEST SELLERS -->
                  <div class="sidepanel widget_best_sellers">
                     <h3>BEST SELLERS</h3>
                     
                     <ul class="tovar_items_small">
                        @foreach($best_seller as $b_sell)
                        <li class="clearfix">
                           <img href='{{asset('detail_product/'.$b_sell->product_id)}}'" class="tovar_item_small_img" src="{{asset('image/product/'.$b_sell->product->product_image)}}" alt="" />
                           <a href='{{asset('detail_product/'.$b_sell->product_id)}}'" class="tovar_item_small_title">{{$b_sell->product->product_name}}</a>
                           <span class="tovar_item_small_price">${{$b_sell->product->product_price}}</span>
                        </li>
                        @endforeach
                     </ul>
                  </div><!-- //WIDGET BEST SELLERS -->
                  
                  <!-- BANNERS WIDGET -->
                  <div class="widget_banners">
                     <a class="banner nobord margbot10" href="javascript:void(0);" ><img src="{{asset('frontend/images/tovar/bn1.jpg')}}" alt="" /></a>
                     <a class="banner nobord margbot10" href="javascript:void(0);" ><img src="{{asset('frontend/images/tovar/bn1.jpg')}}" alt="" /></a>
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