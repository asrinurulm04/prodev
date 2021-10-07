@extends('layout.tempvv')
@section('title', 'PRODEV|Dashboard')
@section('content')

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <h2><li class="fa fa-star-o"></li><b> Dashboard</h2>
    </div>
  </div>
</div>    
<div class="row top_tiles">
  @if(auth()->user()->role->namaRule == 'pv_lokal')
  <div class="col-md-4 col-sm-4 col-xs-12">
    <div class="x_panel ">
    <a href="{{Route('formpkp')}}">
      <div class="tile-stats">
        <div class="icon"><i class="fa fa-file"></i></div>
        <div class="count">{{$pkp1}}</div>
        <h3>PKP</h3>
        <p> <a href="{{Route('drafpkp')}}">{{$hitungpkp}} Data Uncompleted </a></p>
      </div>
    </div>
  </a>
  </div>  
  <a href="{{Route('promo')}}">
  <div class="col-md-4 col-sm-4 col-xs-12">
    <div class="x_panel ">
      <div class="tile-stats">
        <div class="icon"><i class="fa fa-file"></i></div>
        <div class="count">{{$promo1}}</div>
        <h3>PKP Promo</h3>
        <p><a href="{{Route('drafpromo')}}">{{$hitungpromo}} Data Uncompleted</a></p>
      </div>
    </div>
  </div>  
  </a>
  <a href="{{Route('datapengajuan')}}">
  <div class="col-md-4 col-sm-4 col-xs-12">
    <div class="x_panel ">
      <div class="tile-stats">
        <div class="icon"><i class="fa fa-comments-o"></i></div>
        <div class="count">{{$pengajuan}}</div>
        <h3>Revision Request</h3>
        <p>Click To Details..</p>
      </div>
    </div>
  </div>
  </a>
  @elseif(auth()->user()->role->namaRule == 'pv_global')
  <a href="{{Route('formpdf')}}">
  <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="x_panel ">
      <div class="tile-stats">
        <div class="icon"><i class="fa fa-file"></i></div>
        <div class="count">{{$pdf1}}</div>
        <h3>PDFe & PDFp</h3>
        <p><a href="{{Route('drafpdf')}}">{{$hitungpdf}} Data Uncompleted (Click To Details..)</a></p>
      </div>
    </div>
  </div>
  </a>
  <a href="{{Route('datapengajuan')}}">
  <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="x_panel ">
      <div class="tile-stats">
        <div class="icon"><i class="fa fa-comments-o"></i></div>
        <div class="count">{{$pengajuan}}</div>
        <h3>Revision Request</h3>
        <p>Click To Details..</p>
      </div>
    </div>
  </div>
  </a>
  @endif
</div>

<div class="row">
  @if(auth()->user()->role->namaRule == 'pv_lokal')
  <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>PKP</h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div  style="height:400px;">{!!$pie->html() !!}</div>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>PKP Promo</h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div style="height:400px;">{!!$pie3->html() !!}</div>
      </div>
    </div>
  </div>
  @elseif(auth()->user()->role->namaRule == 'pv_global')
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>PDF</h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div style="height:400px;">{!!$pie2->html() !!}</div>
      </div>
    </div>
  </div>
  @endif
</div>

{!! Charts::scripts() !!}
{!! $pie->script() !!}
{!! $pie2->script() !!}
{!! $pie3->script() !!}
@endsection