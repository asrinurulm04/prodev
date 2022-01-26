@extends('layout.tempvv')
@section('title', 'PRODEV|Dasboard')
@section('content')

@if(auth()->user()->role->namaRule === 'user_rd_proses' || auth()->user()->role->namaRule === 'maklon' || auth()->user()->role->namaRule === 'lab' || auth()->user()->role->namaRule === 'kemas')
<div class="row top_tiles">
  <a href="{{route('FsPKP')}}" type="button">
  <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="x_panel ">
      <div class="tile-stats">
        <div class="icon"><i class="fa fa-file"></i></div>
        @if(auth()->user()->role->namaRule === 'user_rd_proses')
        <div class="count">{{$pkp_fs}}</div>
        @elseif(auth()->user()->role->namaRule != 'user_rd_proses')
        <div class="count">{{$pkp_fs1}}</div>
        @endif
        <h3>FS-PKP</h3>
        <p>Click To See Details...</p>
      </div>
    </div>
  </div>  
  </a>
  <a href="{{route('FsPDF')}}" type="button" >
  <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="x_panel ">
      <div class="tile-stats">
        <div class="icon"><i class="fa fa-file"></i></div>
        @if(auth()->user()->role->namaRule === 'user_rd_proses')
        <div class="count">{{$pdf_fs}}</div>
        @elseif(auth()->user()->role->namaRule != 'user_rd_proses')
        <div class="count">{{$pdf_fs1}}</div>
        @endif
        <h3>FS-PDF</h3>
        <p>Click To See Details...</p>
      </div>
    </div>
  </div>
  </a>
</div>
@else
<div class="row top_tiles">
  <a href="{{route('listprojectpkp')}}" type="button">
  <div class="col-md-4 col-sm-4 col-xs-12">
    <div class="x_panel ">
      <div class="tile-stats">
        <div class="icon"><i class="fa fa-file"></i></div>
        <div class="count">{{$pkp}}</div>
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
        <div class="count">{{$promo}}</div>
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
        <div class="count">{{$pdf}}</div>
        <h3>PDFe & PDFp</h3>
        <p> Data All PDF (Click To See Details)</a></p>
      </div>
    </div>
  </div>
  </a>
</div>
@endif
<div class="row"><br><br><br><br><br><br><br><br><br>
  <div class="x_panel">
    <center><h1><li class="fa fa-star-o"></li><b> Welcome To Product Development!!..</h1></center>
	</div>
</div>
@endsection