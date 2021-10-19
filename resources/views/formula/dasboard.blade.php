@extends('layout.tempvv')
@section('title', 'PRODEV|Dasboard')
@section('content')

<div class="row top_tiles">
  @if(auth()->user()->role->namaRule === 'user_rd_proses' || auth()->user()->role->namaRule === 'maklon' || auth()->user()->role->namaRule === 'lab')
  <a href="{{route('FsPKP')}}" type="button">
  @else
  <a href="{{route('listprojectpkp')}}" type="button">
  @endif
  <div class="col-md-4 col-sm-4 col-xs-12">
    <div class="x_panel ">
      <div class="tile-stats">
        <div class="icon"><i class="fa fa-file"></i></div>
        @if(auth()->user()->role->namaRule === 'user_rd_proses')
        <div class="count">{{$pkp_fs}}</div>
        @else
        <div class="count">{{$pkp}}</div>
        @endif
        <h3>PKP</h3>
        <p> Data All PKP (Click To See Details)</a></p>
      </div>
    </div>
  </div>  
  </a>
  <a href="{{route('listprojectpromo')}}" type="button">
  <div class="col-md-4 col-sm-4 col-xs-12">
    <div class="x_panel ">
      <div class="tile-stats">
        <div class="icon"><i class="fa fa-file"></i></div>
        @if(auth()->user()->role->namaRule === 'user_rd_proses')
        <div class="count">{{$promo_fs}}</div>
        @else
        <div class="count">{{$promo}}</div>
        @endif
        <h3>PKP Promo</h3>
        <p> Data All PROMO (Click To See Details)</a></p>
      </div>
    </div>
  </div>  
  </a>
  <a href="{{route('listprojectpdf')}}" type="button" >
  <div class="col-md-4 col-sm-4 col-xs-12">
    <div class="x_panel ">
      <div class="tile-stats">
        <div class="icon"><i class="fa fa-file"></i></div>
        @if(auth()->user()->role->namaRule === 'user_rd_proses')
        <div class="count">{{$pdf_fs}}</div>
        @else
        <div class="count">{{$pdf}}</div>
        @endif
        <h3>PDFe & PDFp</h3>
        <p> Data All PDF (Click To See Details)</a></p>
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