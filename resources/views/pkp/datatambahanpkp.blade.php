@extends('pv.tempvv')
@section('title', 'Data Tambahan PKP')
@section('judulhalaman','Data Tambahan PKP')
@section('content')

<div class="row">
  <div class="col-md-3"></div>
  <div class="col-md-8">
    <div class="tabbable">
      <ul class="nav nav-tabs wizard">
        <li class="active"><a href="" ><span class="nmbr">1</span>Information</a></li>
        <li class="active"><a href=""><span class="nmbr">2</span>PKP</a></li>
        <li class="completed"><a href=""><span class="nmbr">3</span>Upload File</a></li>
      </ul>
    </div>
  </div>
</div>
<br>

@if (count($errors) > 0)
<div class="alert alert-danger">
  <strong>Whoops!</strong> There were some problems with your input.<br><br>
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

@if(session('success'))
<div class="alert alert-success">
  {{ session('success') }}
</div>
@endif

<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
			<h3 class="jumbotron"><li class=" fa fa-upload"></li> File Upload (Max 2MB)</h3>
      <form method="post" action="{{url('uploadpkp')}}" enctype="multipart/form-data">
		  {{csrf_field()}}
			<div class="input-group control-group increment" >
        <input type="hidden" value="{{ $id_pkp->id_project }}" name="id">
        @foreach($turunan as $turun)
        <input type="hidden" value="{{ $turun->turunan }}" name="turunan">
        @endforeach
				<input type="file" name="filename[]" class="form-control col-md-11 col-sm-12 col-xs-12" multiple>
		  </div>
			<button type="submit" class="btn btn-primary btn-sm" style="margin-top:10px"><li class="fa fa-check"></li> Submit</button>
	    </form>
		</div>
	</div>
</div>

@foreach($coba as $pkpp)
<div class="col-md-4">
  <div class="x_panel">
    <div class="x_title">
			<h5><li class=" fa fa-file"> {{$pkpp->filename}}</li></h5>
    </div>
		<div class="card-body">
      <form class="form-horizontal form-label-left" method="POST" action="{{route('infogambar')}}" novalidate>
      &nbsp&nbsp&nbsp<embed src="{{asset('data_file/'.$pkpp->filename)}}" width="110px" height="100px" type="">
      <input name="informasi[{{$loop->index}}][pic]" value="{{$pkpp->id_pictures}}" type="hidden">
      <textarea name="informasi[{{$loop->index}}][info]" class="col-md-7" rows="4">{{$pkpp->informasi}}</textarea><br>
      <input type="hidden" value="{{$pkpp->pkp_id}}" name="pkp">
		  <a href="{{ Route('destroydata',$pkpp->id_pictures) }}" type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Delete"><li class="fa fa-trash-o"></li> Delete</a>
      <a href="{{asset('data_file/'.$pkpp->filename)}}" class="btn btn-warning btn-sm" download="{{$pkpp->filename}}" title="Download file"><li class="fa fa-download"></li> DOwnload File</a>
    </div>
  </div>
</div>
@endforeach

@if($coba1>=1)
<div class="col-md-12">
  <div class="x_panel">
    <button class="btn btn-primary col-md-12 btn-sm" type="submit"><li class="fa fa-check"></li> Save And Finish</button>
    {{ csrf_field() }}
  </form>
  </div>
</div>
@else
<div class="col-md-12">
  <div class="x_panel">
    @foreach ($pkp as $pkp)
    <a href="{{route('rekappkp',$pkp->id_project)}}" class="btn btn-primary col-md-12 btn-sm"><li class="fa fa-check"></li> Save And Finish</a>
    @endforeach
  </form>
  </div>
</div>
@endif
@endsection
