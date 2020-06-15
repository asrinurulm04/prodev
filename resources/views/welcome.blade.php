<!DOCTYPE html>
<html lang="en">

  <head>
    <title>PRODEV - Project Development</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/creative.min.css" rel="stylesheet">
    <link href="css/asrul.css" rel="stylesheet">
    <link href="img/prod.png" rel="icon">

  </head>
  <body>
    <header class="masthead text-center text-white d-flex">
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-8 mx-auto">
            <img class="img-fluid mb-5 d-block mx-auto" src="img/prodev.png" alt="">
            <hr>
          </div>
          <div class="col-lg-8 mx-auto">
          <img class="img-fluid mb-5 d-block mx-auto" src="img/awal.png" alt="">
            @if( auth()->check() )
            <center><a href="signout" class="btn-aul btn-success" style="color:silver">LOGOUT</a></center>
            @else
            <center><a href="signin" class="btn-aul btn-success" style="color:silver">LOGIN</a></center>
            @endif
          </div>
        </div>
      </div>
    </header>
  </body>
</html>
