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
            <img src="../img/prodev.png" alt="">
          </a>
        </li>
      </ul>
    </nav>
  </div>
</div>
<!-- /top navigation -->

<!-- page content -->
<div class="col-md-12" >
  
</div>
<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel" >
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
    <div class="x_content" style="min-height:470px">
      <div class="col-md-4 col-sm-3 col-xs-12 profile_left">
        <div class="profile_img">
          <div id="crop-avatar">
            <!-- Current avatar -->
            <a href=""><img class="img-responsive avatar-view" src="../img/prodev.png" alt="Avatar" title="Change the avatar"></a>
          </div>
        </div>
      </div>
      <div class="col-md-8 col-sm-10 col-xs-12">
        <div class="" role="tabpanel" data-example-id="togglable-tabs">
          <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
            <li role="presentation" class="active"><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Edit Profile </a>
            </li>
          </ul>
          <div id="myTabContent" class="tab-content">
                  <div class="form">
                    @foreach($user as $users)
                    <form class="cmxform form-horizontal style-form" method="POST" action="{{ route('forgotpass') }}">
                    <input type="hidden" value="{{$users->id}}" name="id" id="id">
                    <div class="form-group row">
                      <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name" >Name</label>
                      <div class="col-md-9 col-sm-10 col-xs-12">
                        <input class="form-control" id="name" readonly name="name" placeholder="nama" value="{{ $users->name }}" type="text" minlength="2" autofocus required/>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name" >Username</label>
                      <div class="col-md-9 col-sm-12 col-xs-12">
                          <input class="form-control" readonly id="username" name="username" placeholder="username" value="{{ $users->username }}" type="text" minlength="2" required/>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name" >Passwoad</label>
                      <div class="col-md-9 col-sm-12 col-xs-12">
                          <input class="form-control" id="myInput" name="password" placeholder="password" type="password" minlength="8" required/>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name" ></label>
                      <div class="col-md-9 col-sm-10 col-xs-12">
                        <input type="checkbox" onclick="myFunction()">Show Password
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name" >Confirm password</label>
                      <div class="col-md-9 col-sm-10 col-xs-12">
                          <input class="form-control" id="password_confirmation" name="password_confirmation" placeholder="confirm_password" type="password" required/>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name" >Email</label>
                      <div class="col-md-9 col-sm-10 col-xs-12">
                        <input readonly class="form-control" id="email" name="email" placeholder="E-mail@Nutrifood.co.id" value="{{ $users->email }}" type="email" required/>
                      </div>
                    </div>
                      <center>
                      <button class="btn btn-theme btn-info" type="submit"><i class="fa fa-edit"></i> Save </button>
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        @include('formerrors')
                      </center>
                    </form>
                    @endforeach
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