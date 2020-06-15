@extends('pv.tempvv')
@section('title', 'Calender Timeline')
@section('judulhalaman','Calender Timeline')
@section('content')

<div class="container x_panel">
  <div class="panel panel-primary">
    <div class="panel-heading">
    @if(auth()->user()->role->namaRule != 'manager')
      My Calender   <a class="btn btn-danger" href="{{route('listpromo')}}"><li class="fa fa-arrow-circle-left"></li> Back</a>
      @elseif(auth()->user()->role->namaRule == 'manager')
      My Calender   <a class="btn btn-danger" href="{{route('listpromoo')}}"><li class="fa fa-arrow-circle-left"></li> Back</a>
      @endif
    </div>
    <div class="panel-body" >
      {!! $calendar->calendar() !!}
      {!! $calendar->script() !!}
    </div>
  </div>
</div>    

@endsection