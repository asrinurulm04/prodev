<!DOCTYPE html>
<html lang="en">
<head>

<title>My Profile</title>
<link href="{{ asset('img/prod.png') }}" rel="icon">
<link href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendors/nprogress/nprogress.css') }}" rel="stylesheet">
<link href="{{ asset('build/css/custom.min.css') }}" rel="stylesheet">
</head>
<body class="nav-md">

<!-- top navigation -->
<div class="top_nav">
  <div class="nav_menu">
    <nav>
      <ul class="nav navbar-nav navbar-right">
        <li class="">
          <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <img src="img/prod.png" alt="">{{ Auth::user()->name }}
            <span class=" fa fa-angle-down"></span>
          </a>
          <ul class="dropdown-menu dropdown-usermenu pull-right">
            <li><a href="{{ route('MyProfile') }}"> Profile</a></li>
            <li><a href="{{ route('signout') }}"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
</div>
<!-- /top navigation -->

<!-- page content -->
<div class="col-md-12" >
  <ul class="breadcrumb">
    <li class="breadcrumb-item" style="padding-left:1150px">
      <a href="{{route('lala')}}" title="Home"> <i class="fa fa-home"></i> </a>
    </li>
    <li class="breadcrumb-item"><a href="#!">Profile settings</a>
    </li>
  </ul>
</div>
<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2>Profile Setting</small></h2>
      <div class="clearfix"></div>
    </div>
    @if (session('status'))
    <div class="col-lg-12 col-md-12 col-sm-12">
      <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{ session('status') }}
      </div>
    </div>
    @elseif(session('error'))
    <div class="col-lg-12 col-md-12 col-sm-12">
      <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{ session('error') }}
      </div>
    </div>
    @endif
    <div class="x_content">
      <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
        <div class="profile_img">
          <div id="crop-avatar">
            <!-- Current avatar -->
            <a href="{{route('lala')}}"><img class="img-responsive avatar-view" src="../img/prodev.png" alt="Avatar" title="Change the avatar"></a>
          </div>
        </div>
        <h3 class="text-center">{{ Auth::user()->name }}</h3>
        <h6 class="text-center">Last update : {{ $users->updated_at}}</h6>
      </div>
      <div class="col-md-9 col-sm-10 col-xs-12">
        <div class="" role="tabpanel" data-example-id="togglable-tabs">
          <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
            <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Profile settings</a>
            </li>
            <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Edit Profile {{ Auth::user()->name }}</a>
            </li>
          </ul>
          <div id="myTabContent" class="tab-content">
            <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
              <div class="col-md-9 profile-text mt mb centered" valign="center">
                <div class="right-divider hidden-sm hidden-xs">
                  <div class="form-group row">
                    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name" >Name</label>
                    <div class="col-md-9 col-sm-10 col-xs-12">
                        <input disabled class="form-control" id="name" name="name" placeholder="nama" value="{{ $users->name }}" type="text" minlength="2" autofocus required/>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name" >Username</label>
                    <div class="col-md-9 col-sm-10 col-xs-12">
                        <input disabled class="form-control" id="username" name="username" placeholder="username" value="{{ $users->username }}" type="text" minlength="6" maxlength="12" required/>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name" >Email</label>
                    <div class="col-md-9 col-sm-10 col-xs-12">
                      <input disabled class="form-control" id="email" name="email" placeholder="E-mail" value="{{ $users->email }}" type="email" required/>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name" >Role</label>
                    <div class="col-md-9 col-sm-10 col-xs-12">
                      <input disabled class="form-control" id="email" name="role" placeholder="role" value="{{ $users->role->namaRule}}" type="email" required/>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name" >Departement</label>
                    <div class="col-md-9 col-sm-10 col-xs-12">
                      <input disabled class="form-control" id="email" name="dept" placeholder="dept" value="{{ $users->departement->dept}}" type="email" required/>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
              <div class="col-md-7 centered">
                <div class="col-lg-11 etailed">
                  <div class="form">
                    <form class="cmxform form-horizontal style-form" method="POST" action="{{ route('updateprof') }}">
                    <div class="form-group row">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" >Name</label>
                      <div class="col-md-9 col-sm-10 col-xs-12">
                        <input class="form-control" id="name" name="name" placeholder="nama" value="{{ $users->name }}" type="text" minlength="2" autofocus required/>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" >Username</label>
                      <div class="col-md-9 col-sm-10 col-xs-12">
                          <input class="form-control" id="username" name="username" placeholder="username" value="{{ $users->username }}" type="text" minlength="2" required/>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" >Passwoad</label>
                      <div class="col-md-9 col-sm-10 col-xs-12">
                          <input class="form-control" id="myInput" name="password" placeholder="password" type="password" minlength="8" required/>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" ></label>
                      <div class="col-md-9 col-sm-10 col-xs-12">
                        <input type="checkbox" onclick="myFunction()">Show Password
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" >Confirm password</label>
                      <div class="col-md-9 col-sm-10 col-xs-12">
                          <input class="form-control" id="password_confirmation" name="password_confirmation" placeholder="confirm_password" type="password" required/>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" >Email</label>
                      <div class="col-md-9 col-sm-10 col-xs-12">
                          <input class="form-control" id="email" name="email" placeholder="E-mail@Nutrifood.co.id" value="{{ $users->email }}" type="email" required/>
                      </div>
                    </div>
                      <button class="btn btn-theme btn-info" type="submit"><i class="fa fa-edit"></i> Save </button>
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        @include('formerrors')
                    </form>
                  </div>   
                </div>
              </div>
            </div>
          </div>     
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->

<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel text-right">
    Created By Asrul :)
  </div>
  <div class="clearfix"></div>
</div>

<!-- jQuery -->
<script src="../vendors/jquery/dist/jquery.min.js"></script>
<script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../vendors/fastclick/lib/fastclick.js"></script>
<script src="../vendors/nprogress/nprogress.js"></script>
<script>
function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
<script src="../build/js/custom.min.js"></script>
  </body>
</html>