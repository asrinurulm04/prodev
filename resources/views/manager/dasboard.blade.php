@extends('manager.tempmanager')
@section('title', 'Dashboard')
@section('judulhalaman','Dashboard')
@section('content')

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <h2><li class="fa fa-star-o"></li><b> Dashboard</h2>
    </div>
  </div>
</div>    
<div class="row top_tiles">
  <a href="{{route('listpkprka')}}" type="button">
    <div class="col-md-4 col-sm-4 col-xs-12">
      <div class="x_panel ">
        <div class="tile-stats">
          <div class="icon"><i class="fa fa-file"></i></div>
          @if(Auth::user()->departement->dept!='RKA')
          <div class="count">{{$hitungppkp}}</div>
          @else
          <div class="count">{{$hitungppkp1}}</div>
          @endif
          <h3>PKP</h3>
          <p>Click To See Details...</p>
        </div>
      </div>
    </div>  
  </a>
  <a href="{{route('listpromoo')}}" type="button">
    <div class="col-md-4 col-sm-4 col-xs-12">
      <div class="x_panel ">
        <div class="tile-stats">
          <div class="icon"><i class="fa fa-file"></i></div>
          @if(Auth::user()->departement->dept!='RKA')
          <div class="count">{{$hitungppromo}}</div>
          @else
          <div class="count">{{$hitungppromo1}}</div>
          @endif
          <h3>PKP Promo</h3>
          <p>Click To See Details...</p>
        </div>
      </div>
    </div>  
  </a>
  <a href="{{route('listpdfrka')}}" type="button" >
    <div class="col-md-4 col-sm-4 col-xs-12">
      <div class="x_panel ">
        <div class="tile-stats">
          <div class="icon"><i class="fa fa-file"></i></div>
          @if(Auth::user()->departement->dept!='RKA')
          <div class="count">{{$hitungppdf}}</div>
          @else
          <div class="count">{{$hitungppdf1}}</div>
          @endif
          <h3>PDFe & PDFp</h3>
          <p>Click To See Details...</p>
        </div>
      </div>
    </div>
  </a>
</div>

@if(Auth::user()->departement->dept!='RKA')
<div class="row">
  <div class="col-md-4 col-sm-4 col-xs-12">
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
  <div class="col-md-4 col-sm-4 col-xs-12">
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
  <div class="col-md-4 col-sm-4 col-xs-12">
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
</div>
@elseif(Auth::user()->departement->dept=='RKA')
<div class="row">
  <div class="col-md-4 col-sm-4 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>PKP</h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div  style="height:400px;">{!!$chart1->html() !!}</div>
      </div>
    </div>
  </div>
  <div class="col-md-4 col-sm-4 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>PKP Promo</h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div style="height:400px;">{!!$chart3->html() !!}</div>
      </div>
    </div>
  </div>
  <div class="col-md-4 col-sm-4 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>PDF</h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div style="height:400px;">{!!$chart2->html() !!}</div>
      </div>
    </div>
  </div>
</div>

@endif
{!! Charts::scripts() !!}
{!! $pie->script() !!}
{!! $pie2->script() !!}
{!! $pie3->script() !!}
{!! $chart1->script() !!}
{!! $chart2->script() !!}
{!! $chart3->script() !!}
@endsection