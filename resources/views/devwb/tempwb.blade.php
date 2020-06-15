<!DOCTYPE html>
<html lang="en">
<head>
	<title>@yield('title')</title>
  <!-- Favicon icon -->
  <link href="{{ asset('img/prod.png') }}" rel="icon" type="image/x-icon">
  <link rel="stylesheet" type="text/css" href="../bower_components/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/pages/waves/css/waves.min.css" type="text/css" media="all">
  <link rel="stylesheet" type="text/css" href="../assets/icon/themify-icons/themify-icons.css">
  <link rel="stylesheet" href="../assets/pages/waves/css/waves.min.css" type="text/css" media="all">
  <link rel="stylesheet" type="text/css" href="../assets/icon/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="../assets/icon/icofont/css/icofont.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/jquery.mCustomScrollbar.css">
</head>
<body>
  <!-- Pre-loader start -->
  <div class="theme-loader">
    <div class="loader-track">
      <div class="preloader-wrapper">
        <div class="spinner-layer spinner-blue">
          <div class="circle-clipper left">
            <div class="circle"></div>
          </div>
          <div class="gap-patch">
            <div class="circle"></div>
          </div>
          <div class="circle-clipper right">
            <div class="circle"></div>
          </div>
        </div>
        <div class="spinner-layer spinner-red">
        	<div class="circle-clipper left">
          	<div class="circle"></div>
        	</div>
        	<div class="gap-patch">
          	<div class="circle"></div>
        	</div>
        	<div class="circle-clipper right">
          	<div class="circle"></div>
        	</div>
      	</div>
                
      	<div class="spinner-layer spinner-yellow">
        	<div class="circle-clipper left">
          	<div class="circle"></div>
        	</div>
        	<div class="gap-patch">
          	<div class="circle"></div>
        	</div>
        	<div class="circle-clipper right">
          	<div class="circle"></div>
        	</div>
      	</div>
                
        <div class="spinner-layer spinner-green">
          <div class="circle-clipper left">
            <div class="circle"></div>
          </div>
          <div class="gap-patch">
            <div class="circle"></div>
          </div>
          <div class="circle-clipper right">
            <div class="circle"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Pre-loader end -->
  <div id="pcoded" class="pcoded">
    <div class="pcoded-overlay-box"></div>
    <div class="pcoded-container navbar-wrapper">
      <nav class="navbar header-navbar pcoded-header">
        <div class="navbar-wrapper">
          <div class="navbar-logo">
            <a class="mobile-menu waves-effect waves-light" id="mobile-collapse" href="#!"> <i class="ti-menu"></i> </a>
            <a href="index.html"> PRODEV </a>
            <a class="mobile-options waves-effect waves-light"> <i class="ti-more"></i></a>
          </div>         
          <div class="navbar-container container-fluid">
            <ul class="nav-left">
              <li><div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a></div></li>
              <li><a href="#!" onclick="javascript:toggleFullScreen()" class="waves-effect waves-light"><i class="ti-fullscreen"></i></a></li>
            </ul>
            <ul class="nav-right">
              <li class="user-profile header-notification">
                <a href="#!" class="waves-effect waves-light">
                  <img src="../img/prod.png" alt="..." class="img-circle profile_img">
                  <span>
                    @if( auth()->check() )
                      {{ Auth::user()->name }}
                    @endif
                  </span>
                  <i class="ti-angle-down"></i>
                </a>
                <ul class="show-notification profile-notification">
                  <li class="waves-effect waves-light">
                    <a href="{{ route('MyProfile') }}">
                      <i class="ti-user"></i> Profile
                    </a>
                  </li>
                  <li class="waves-effect waves-light">
                    <a href="{{ route('signout') }}">
                      <i class="ti-layout-sidebar-left"></i> Logout
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- Sidebar inner chat end-->
      <div class="pcoded-main-container">
        <div class="pcoded-wrapper">
          <nav class="pcoded-navbar">
          <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
          <div class="pcoded-inner-navbar main-menu">
            <div class="">
              <div class="main-menu-header">
                <img src="../img/prod.png" alt="..." class="img-circle profile_img">
                <div class="user-details">
                  <span id="more-details">
                    @if( auth()->check() )
                      {{ Auth::user()->name }}
                    @endif
                  </span>
                </div>
              </div>
            </div>
            <div class="pcoded-navigation-label">Navigation</div>
            <ul class="pcoded-item pcoded-left-item">
              <li class="">
                <a href="{{ route('MyProfile') }}" class="waves-effect waves-dark">
                  <span class="pcoded-micon"><i class="ti-layout-cta-right"></i><b>N</b></span>
                  <span class="pcoded-mtext">Profil</span>
                  <span class="pcoded-mcaret"></span>
                </a>
              </li>
              <li class="">
                <a href="{{ route('MyProfile') }}" class="waves-effect waves-dark">
                  <span class="pcoded-micon"><i class="ti-layout-cta-right"></i><b>N</b></span>
                  <span class="pcoded-mtext">Workbook</span>
                  <span class="pcoded-mcaret"></span>
                </a>
              </li>
              <li class="">
                <a href="{{ route('MyProfile') }}" class="waves-effect waves-dark">
                  <span class="pcoded-micon"><i class="ti-layout-cta-right"></i><b>N</b></span>
                  <span class="pcoded-mtext">Nutfact</span>
                  <span class="pcoded-mcaret"></span>
                </a>
              </li>
            </ul>
          </div>
        	</nav>
        	<div class="pcoded-content">
            <!-- Page-header start -->
            <div class="page-header">
              <div class="page-block">
                <div class="row align-items-center">
                  <div class="col-md-8">
                    <div class="page-header-title">
                      <h2 class="m-b-10">@yield('judulhalaman')</h2>
                    </div>
                  </div>
                  <div class="col-md-4">
                    @yield('halaman')
                  </div>
                </div>
              </div>
            </div>
            <div class="pcoded-inner-content">
              <div class="main-body">
                <div class="page-wrapper">
                  <div class="page-body">
                    <div class="row">
                      <div class="col-sm-12">
                        @yield('content')
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div id="styleSelector"></div>
	          </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript" src="../bower_components/jquery/js/jquery.min.js"></script>
  <script type="text/javascript" src="../bower_components/jquery-ui/js/jquery-ui.min.js"></script>
  <script type="text/javascript" src="../bower_components/jquery-ui/js/jquery-ui.min.js"></script>
  <script type="text/javascript" src="../bower_components/popper.js/js/popper.min.js"></script>
  <script type="text/javascript" src="../bower_components/bootstrap/js/bootstrap.min.js"></script>
  <script src="../assets/pages/waves/js/waves.min.js"></script>
  <script type="text/javascript" src="../bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>
  <script src="../files/assets/pages/waves/js/waves.min.js"></script>
  <script type="text/javascript" src="../bower_components/modernizr/js/modernizr.js"></script>
  <script type="text/javascript" src="../bower_components/modernizr/js/css-scrollbars.js"></script>
  <script src="../assets/js/pcoded.min.js"></script>
  <script src="../assets/js/vertical/vertical-layout.min.js"></script>
  <script type="text/javascript" src="../assets/js/script.js"></script>

</body>
</html>