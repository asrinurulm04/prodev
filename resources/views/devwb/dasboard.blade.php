@extends('pv.tempvv')
@section('title', 'Dasboard')
@section('content')

<div class="row top_tiles">
  <a href="{{route('listprojectpkp')}}" type="button">
  <div class="col-md-4 col-sm-4 col-xs-12">
    <div class="x_panel ">
      <div class="tile-stats">
        <div class="icon"><i class="fa fa-file"></i></div>
        <div class="count">{{$pkp}}</div>
        <h3>PKP</h3>
        <p> Data Uncompleted <a href="{{Route('drafpkp')}}">(Click To See Details)</a></p>
      </div>
    </div>
  </div>  
  </a>
  <a href="{{route('listprojectpromo')}}" type="button">
  <div class="col-md-4 col-sm-4 col-xs-12">
    <div class="x_panel ">
      <div class="tile-stats">
        <div class="icon"><i class="fa fa-file"></i></div>
        <div class="count">{{$promo}}</div>
        <h3>PKP Promo</h3>
        <p> Data Uncompleted <a href="{{Route('drafpromo')}}">(Click To See Details)</a></p>
      </div>
    </div>
  </div>  
  </a>
  <a href="{{route('listprojectpdf')}}" type="button" >
  <div class="col-md-4 col-sm-4 col-xs-12">
    <div class="x_panel ">
      <div class="tile-stats">
        <div class="icon"><i class="fa fa-file"></i></div>
        <div class="count">{{$pdf}}</div>
        <h3>PDFe & PDFp</h3>
        <p> Data Uncompleted <a href="{{Route('drafpdf')}}">(Click To See Details)</a></p>
      </div>
    </div>
  </div>
  </a>
</div>
<div class="row"><br><br><br><br><br><br><br><br><br>
  <div class="x_panel">
    <center><h1><li class="fa fa-star-o"></li><b> Welcome To Product Development!!..</h1></center>
	</div>
</div>

@endsection