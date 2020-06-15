@extends('pv.tempvv')
@section('title', 'Caledar')
@section('judulhalaman','Caledar')
@section('content')

<div class="panel panel-primary" >
  <div class="panel-heading">
    My Calender   <a class="btn btn-danger" href="{{route('lala')}}"><li class="fa fa-arrow-circle-left"></li> Back</a>
  </div>
  <div class="panel-body"   >
    {!! $calendar->calendar() !!}
    {!! $calendar->script() !!}
  </div>
</div>  

@endsection