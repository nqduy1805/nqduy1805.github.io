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
               <div class="col-lg-12 col-md-12 col-sm-12 padbot30">
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
                  @if($blog->count()>0)
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
                     
                     <a class="show_all_tovar" href="javascript:void(0);">show all</a>
                     
                  </div>
                  <!-- //PAGINATION -->
                  @else
                  <p>NO BLOG FOUND</p>
                  @endif
              
            </div><!-- //ROW -->
         </div><!-- //CONTAINER -->
      </section><!-- //BLOG BLOCK -->
      @endsection
