@extends('pv.tempvv')
@section('title', 'Dashboard')
@section('judulhalaman','Dashboard')
@section('content')

<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <h2><li class="fa fa-star-o"></li><b> Dashboard</h2>
  </div>
</div>    

<a href="{{Route('promo')}}" type="button">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel ">
      <div class="tile-stats">
        <div class="icon"><i class="fa fa-file"></i></div>
        <div class="count">{{$promo1}}</div>
        <h3>PKP Promo</h3>
        <p>belum selesai <a href="{{Route('drafpromo')}}">(Click To See Details)</a></p>
      </div>
    </div>
  </div>  
</a>

<div class="col-md-12 col-sm-4 col-xs-12">
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

{!! Charts::scripts() !!}
{!! $pie3->script() !!}
@endsection