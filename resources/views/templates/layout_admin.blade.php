
<!DOCTYPE html>
<head>
<title>Admin</title>

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="{{asset('backend/css/bootstrap.min.css')}}" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{asset('backend/css/style.css')}}" rel='stylesheet' type='text/css' />
<link href="{{asset('backend/css/style-responsive.css')}}" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="{{asset('backend/css/font.css')}}" type="text/css')}}"/>
<link href="{{asset('backend/css/font-awesome.css')}}" rel="stylesheet"> 
<link rel="stylesheet" href="{{asset('backend/css/morris.css')}}" type="text/css')}}"/>
<!-- calendar -->
<link rel="stylesheet" href="{{asset('backend/css/monthly.css')}}">
<!-- //calendar -->
<!-- //font-awesome icons -->
<script src="{{asset('backend/js/jquery2.0.3.min.js')}}"></script>
<script src="{{asset('backend/js/raphael-min.js')}}"></script>
<script src="{{asset('backend/js/morris.js')}}"></script>
</head>
<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">
    <a href="index.html" class="logo">
        ADMIN
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->

<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        <li>
            <input type="text" class="form-control search" placeholder=" Search">
        </li>
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="">
                <span class="username">DUY</span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                <li>
                  <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                                      <i class="fa fa-key"></i>  {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form></li>
            </ul>
        </li>
        <!-- user login dropdown end -->
       
    </ul>
    <!--search & user info end-->
</div>
</header>
<!--header end-->
<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">  
             <li class="sub-menu">
                    <a href="{{URL::to('dashboard')}}">
                        <i class="fa fa-dashboard"></i>
                        <span>Dash Board</span>
                    </a>
                </li>              
                <li class="sub-menu">
                    <a href="{{route('category.index')}}">
                        <i class="fa fa-dashboard"></i>
                        <span>Category</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{route('category.index')}}">Table</a></li>
                        <li><a href="{{route('category.create')}}">Create</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="{{route('product.index')}}">
                        <i class="fa fa-book"></i>
                        <span>Product</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{route('product.index')}}">Table</a></li>
                        <li><a href="{{route('product.create')}}">Create</a></li>
                        <li><a href="{{URL::to('qtymanagement')}}">Product</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="{{route('blog.index')}}">
                        <i class="fa fa-th"></i>
                        <span>Blog</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{route('blog.index')}}">Table</a></li>
                        <li><a href="{{route('blog.create')}}">Create</a></li>
                    </ul>
                </li>
                 <li class="sub-menu">
                    <a href="{{route('order.index')}}">
                        <i class="fa fa-bullhorn"></i>
                        <span>Order</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{route('order.index')}}">Table</a></li>
                    </ul>
                </li>
                 <li class="sub-menu">
                    <a href="{{route('coupon.index')}}">
                        <i class="fa fa-tasks"></i>
                        <span>Coupon</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{route('coupon.index')}}">Table</a></li>
                        <li><a href="{{route('coupon.create')}}">Create</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="{{route('user.index')}}">
                        <i class="fa fa-tasks"></i>
                        <span>User</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{route('user.index')}}">Table</a></li>
                        <li><a href="{{route('user.create')}}">Create</a></li>
                    </ul>
                </li>
               <li class="sub-menu">
                    <a href="{{route('user.index')}}">
                        <i class="fa fa-tasks"></i>
                        <span>Traking</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('traking/user')}}">User</a></li>
                        <li><a href="{{URL::to('traking/product')}}">Product</a></li>
                        <li><a href="{{URL::to('traking/blog')}}">Blog</a></li>
                    </ul>
                </li>
                  <li class="sub-menu">
                    <a href="{{route('user.index')}}">
                        <i class="fa fa-tasks"></i>
                        <span>Driver</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('driver/user')}}">List</a></li>
                    </ul>
                </li>
            </ul>            </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
		@yield('content')
             {{session()->put('page',substr(URL::current(),31));}}
          <input id="signup-token" name="_token" type="hidden" value="{{csrf_token()}}">

</section>
</section>
<!--main content end-->
</section>
<script src="{{asset('backend/js/bootstrap.js')}}"></script>
<script src="{{asset('backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('backend/js/scripts.js')}}"></script>
<script src="{{asset('backend/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('backend/js/jquery.nicescroll.js')}}"></script>

<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="{{asset('backend/js/flot-chart/excanvas.min.js')}}"></script><![endif]-->
<script src="{{asset('backend/js/jquery.scrollTo.js')}}"></script>
<!-- morris JavaScript -->	

<!-- calendar -->
	<script type="text/javascript" src="{{asset('backend/js/monthly.js')}}"></script>
	<script type="text/javascript">
		$(window).load( function() {

			$('#mycalendar').monthly({
				mode: 'event',
				
			});

			$('#mycalendar2').monthly({
				mode: 'picker',
				target: '#mytarget',
				setWidth: '250px',
				startHidden: true,
				showTrigger: '#mytarget',
				stylePast: true,
				disablePast: true
			});

		switch(window.location.protocol) {
		case 'http:':
		case 'https:':
		// running on a server, should be good.
		break;
		case 'file:':
		alert('Just a heads-up, events will not work when run locally.');
		}

		});
	</script>
	<!-- //calendar -->
    <script text="text/javascript">
    $(document).ready(function() {
    timepage();
    function timepage(){
        var $token=$('#signup-token').val();
       $.ajax({
             url:"{{URL::to('tracking_page')}}",
             method:"POST",
             data:{_token:$token}, 
                           success:function(data){
                      }
                  });
       }
    });
</script>   
</body>
</html>
