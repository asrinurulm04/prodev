<!DOCTYPE html>
<html lang="en">
<head>
	<title>LOGIN</title>
	<link href="{{ asset('img/prod.png') }}" rel="icon">
  <link href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
  <link href="{{ asset('build/css/custom.min.css') }}" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/mainn.css">
  <link href="{{ asset('css/asrul.css') }}" rel="stylesheet">
<!--===============================================================================================-->
</head>
<body background="{{asset('img/prodev')}}">

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

	<div class="limiter" style="background-image: url('img/image.jpg');">
		<div class="container-login100" >
			<div class="wrap-login100">
        <center><img class="img-fluid  d-block mx-auto" width="140px" src="img/pro.png" alt=""></center>
				<span class="login100-form-title p-b-34 p-t-27">
					Log in
				</span><br>
        <div id="login-page">
          <div class="container">
            <form class="form-login" method="POST" action="{{ url(action('LoginController@postLogin')) }}">
              <div class="login-wrap">
                <input data-toggle="tooltip" title="E-mail Or Username" type="text" autocomplete="off" class="form-control" id="inputEmailUser" name="inputEmailUser" {{ old('inputEmailUser') }} placeholder="E-mail Or Username" autofocus required><br>
                <input data-toggle="tooltip" title="Password" type="password" class="form-control" id="myInput" name="password" placeholder="Password" minlength="6" required>
                <p style="color:#ffff;"><input type="checkbox" onclick="myFunction()"> Show Password</p>
                <div class="container-login100-form-btn"><br><br><br>
                  <button class="login100-form-btn" type="submit"><i class="fa fa-lock"></i>&nbsp SIGN IN</button>
                  {{ csrf_field() }}
                  @include('formerrors')
                </div>
              </form><hr>
              <center><a style="color:#ffff;" data-toggle="modal" href="#myModal">Forgot Password?</a></center> 
              <div class="registration text-center" style="font-weight: bold;color:white">
                <label for=""> Don't have an account yet?</label>
                <a href="daftar" style="color:#01ffff">
                  Create an account
                </a>
              </div>
            </div>
          </div>
        </div>
			</div>
		</div>
	</div>
	
  <!-- Modal Forgot Password -->
  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Forgot Password ?</h4>           
        </div>
        <form method="POST" action="{{ route('reset_password_without_token') }}">
        <div class="modal-body">
          <p>Enter your e-mail address below to reset your password.</p>
          <input type="email" name="email" placeholder="Email" autocomplete="off" title="Email" required="required" class="form-control placeholder-no-fix">
          <br>
          <input type="text" name="username" placeholder="Username" autocomplete="off" title="Username" required="required" class="form-control placeholder-no-fix">
        </div>
        <div class="modal-footer">
          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
          <button class="btn btn-primary" type="submit">Submit</button>
          {{ csrf_field() }}
        </div>
        </form>
      </div>
    </div>
  </div>

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
  <script src="{{ asset('js/vendor/jquery-2.2.4.min.js') }}"></script>
  <!-- Bootstrap -->
  <script src="{{ asset('vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('build/js/custom.min.js') }}"></script>
  <script>
    function myFunction() {
      var x = document.getElementById("myInput");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })
  </script>
</body>
</html>