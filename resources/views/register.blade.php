<!DOCTYPE html>
<html lang="en">
  <head>
    <title>REGISTER</title>
    <link href="{{ asset('img/prod.png') }}" rel="icon">
    <link href="{{ asset('css/asrul.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/bootstrap/dist/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('build/css/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/mainn.css">
  <!--===============================================================================================-->
  </head>
  <body>
    <div class="limiter">
      <div class="container-login100" style="background-image: url('img/image.jpg');">
        <div class="login100"><br><br>
          <span class="login100-form-title p-b-34 p-t-27">Register Now</span>
          <br><br>
          <div class="container">
            <form class="form-login" method="post" action="{{ route('add') }}">
            <div class="login-wrap">
              <input data-toggle="tooltip" title="your name" class="form-control" autocomplete="off" id="name" name="name" placeholder="Name" minlength="2" autofocus required/>
              <br>
              <input data-toggle="tooltip" title="username" class="form-control" autocomplete="off" id="username" name="username" placeholder="username" minlength="1" required/>
              <br>
              <input data-toggle="tooltip" title="password" class="form-control" id="myInput" name="password" placeholder="password" type="password" minlength="8" required/>
              <p style="color:#ffff;"><input type="checkbox" onclick="myFunction()"> Show Password</p>
              <input data-toggle="tooltip" title="confirmation password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="confirm_password" type="password" required/>
              <br>
              <input data-toggle="tooltip" title="email" class="form-control" autocomplete="off" id="email" name="email" placeholder="E-mail (@nutrifood.co.id)" value="{{ old('email') }}" type="email" required/>
              <br>
              <div class="row">
                <div class="col-md-6">
                  <select id="departement" name="departement" class="form-control" >
                    @foreach($depts as $dept)
                    <option value="{{  $dept->id }}" {{ old('departement') == $dept->id ? 'selected' : '' }}>{{ $dept->dept }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-6">
                  <select class="form-control" id="role" name="role">
                    @foreach($roles as $role)
                    <option value="{{  $role->id }}" {{ old('role') == $role->id ? 'selected' : '' }}>{{ $role->role }}</option>
                    @endforeach
                  </select>
                </div>
              </div><br>
              <div class="container-login100-form-btn">
                <button class="login100-form-btn btn-block" type="submit"><i class="fa fa-lock"></i> SIGN IN</button>
                {{ csrf_field() }} 
              </div>
              @include('formerrors')
              </form><br><br>
              <div class="registration text-center" style="font-weight: bold;color:white">Already Have account aa?<br/>
                <a href="{{ route('signin') }}" style="color:#01ffff">login</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="dropDownSelect1"></div>
    
    <script src="vendor/bootstrap/js/bootstrapp.min.js"></script>
    <script src="js/mainn.js"></script>
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