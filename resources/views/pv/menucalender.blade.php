@extends('pv.tempvv')
@section('title', 'Draf')
@section('judulhalaman')
@section('content')

<br><br><br><br><br><br>
<div class="row" style="padding-right:320px;padding-left:320px">
  <div class="row top_tiles col-lg-10 col-md-12 col-sm-12 col-xs-12" >
    <a href="{{Route('allcalenderpkp')}}" type="button" style="font-weight: bold;color:white;background-color: #2a3f54;">
    <div class="tile-stats col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background-image:url(img/biru.jpg);">
      <div class="icon"><i class="fa fa-file"></i></div>
      <div class="count">PKP</div>
        <h3>Calendar</h3>
      <p> Click To See Details </p>
    </div>
  </a><br>
  </div>
</div>  
<div class="row" style="padding-right:320px;padding-left:320px">
  <div class="row top_tiles col-lg-10 col-md-12 col-sm-12 col-xs-12" >
    <a href="{{Route('allcalenderpdf')}}" type="button" style="font-weight: bold;color:white;background-color: #2a3f54;">
    <div class="tile-stats col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background-image:url(img/biru.jpg);">
      <div class="icon"><i class="fa fa-file"></i></div>
      <div class="count">PDF</div>
        <h3>Calendar</h3>
      <p> Click To See Details </p>
    </div>
  </a><br>
  </div>
</div> 
<div class="row" style="padding-right:320px;padding-left:320px">
  <div class="row top_tiles col-lg-10 col-md-12 col-sm-12 col-xs-12" >
    <a href="{{Route('allcalenderpromo')}}" type="button" style="font-weight: bold;color:white;background-color: #2a3f54;">
    <div class="tile-stats col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background-image:url(img/biru.jpg);">
      <div class="icon"><i class="fa fa-file"></i></div>
      <div class="count">PROMO</div>
        <h3>Calendar</h3>
      <p> Click To See Details </p>
    </div>
  </a><br>
  </div>
</div> 

@endsection