@extends('pv.tempvv')
@section('title', 'PRODEV|Data Tambahan PDF')
@section('content')

<div class="row">
  <div class="col-md-3"></div>
  <div class="col-md-8">
    <div class="tabbable">
      <ul class="nav nav-tabs wizard">
        <li class="active"><a href="" ><span class="nmbr">1</span>Information</a></li>
        <li class="active"><a href=""><span class="nmbr">2</span>PDF</a></li>
        <li class="completed"><a href=""><span class="nmbr">3</span>Upload File</a></li>
      </ul>
    </div>
  </div>
</div>

@if (session('status'))
<div class="col-lg-12 col-md-12 col-sm-12">
  <div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{ session('status') }}
  </div>
</div>
@elseif(session('error'))
<div class="col-lg-12 col-md-12 col-sm-12">
  <div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{ session('error') }}
  </div>
</div>
@endif

<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
			<h3 class="jumbotron"><li class=" fa fa-upload"></li> File Upload (Max 2MB)</h3>
      <form method="post" action="{{url('uploadpdf')}}" enctype="multipart/form-data">
		  {{csrf_field()}}
			<div class="input-group control-group increment" >
        <input type="hidden" value="{{ $id_pdf->id_project_pdf }}" name="id">
        @foreach($turunan as $turun)
        <input type="hidden" value="{{$turun->turunan}}" name="turunan">
        @endforeach
				<input type="file" name="filename[]" class="form-control" multiple>
		  </div>
			<button type="submit" class="btn btn-primary btn-sm" style="margin-top:10px"><li class=" fa fa-check"></li> Submit</button>
	    </form>        
		</div>
	</div>
</div>

@foreach($coba as $pdf)
<div class="col-md-4">
  <div class="x_panel">
    <div class="x_title">
			<h5><li class=" fa fa-file"> {{$pdf->filename}}</li></h5>
    </div>
		<div class="card-body">
      <form class="form-horizontal form-label-left" method="POST" action="{{route('infogambarpdf')}}" novalidate>
      <input name="id" value="{{$pdf->pdf_id}}" type="hidden">
      <input name="informasi[{{$loop->index}}][pic]" value="{{$pdf->id_pictures}}" type="hidden">
      <textarea name="informasi[{{$loop->index}}][info]" class="col-md-10" rows="4">{{$pdf->informasi}}</textarea><br>
		  &nbsp&nbsp<a href="{{ Route('destroydata',$pdf->id_pictures) }}" type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Delete"><li class="fa fa-trash-o"></li></a>
      <br>&nbsp&nbsp<a href="{{asset('data_file/'.$pdf->filename)}}" class="btn btn-warning btn-sm" download="{{$pdf->filename}}" title="Download file"><li class="fa fa-download"></li></a>
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
    @foreach ($turunan as $pdf)
    <a href="{{route('rekappdf',$pdf->pdf_id)}}" class="btn btn-primary col-md-12 btn-sm"><li class="fa fa-check"></li> Save And Finish</a>
    @endforeach
  </form>
  </div>
</div>
@endif
@endsection