<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRODEV | Product Development</title>

    <link href="img/prod.png" rel="icon">
    <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet">
  </head>

  <body>
    <div class="container">
      <div class="row">
        <div class="col-sm-8">
        <img src="img/404.gif" class="logo" alt="Company's logo" />
        </div>
        <div class="col-sm-4" style="margin-top: 200px;">
          <center><h1><b>MAAF!!</b></h1>
          <h3><b>Anda Tidak Memiliki Akses Ke Halaman Ini.</b></h3>
          @if(auth()->user()->role->namaRule === 'admin')
          <a class="btn btn-primary" href="{{ route('userapproval') }}"><i class="fa fa-back"></i>Kembali</a></li>
          @elseif(auth()->user()->role->namaRule === 'pv')
          <a class="btn btn-primary" href="{{ route('drafpkp') }}"><i class="fa fa-back"></i>Kembali</a></li>
          @elseif(auth()->user()->role->namaRule === 'NR')
          <a class="btn btn-primary" href="{{ route('drafpkp') }}"><i class="fa fa-back"></i>Kembali</a></li>
          @elseif(auth()->user()->role->namaRule === 'marketing')
          <a class="btn btn-primary" href="{{ route('drafpkp') }}"><i class="fa fa-back"></i>Kembali</a></li>
          @elseif(auth()->user()->role->namaRule === 'manager')
          <a class="btn btn-primary" href="{{ route('listpkprka') }}"><i class="fa fa-back"></i>Kembali</a></li>
          @endif
          </center>
        </div>  
      </div>
    </div>
    <script src="lib/jquery/jquery.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
