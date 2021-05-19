@extends('pv.tempvv')
@section('title', 'PRODEV|Data Tambahan PKP')
@section('content')

@if (session('status'))
<div class="col-lg-12 col-md-12 col-sm-12">
  <div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{ session('status') }}
  </div>
</div>
@endif

<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
			<h3 class="jumbotron"><li class=" fa fa-upload"></li> File Upload (Max 2MB)</h3>
      <form method="post" action="{{url('uploadpromo')}}" enctype="multipart/form-data">
		  {{csrf_field()}}
			<div class="input-group control-group increment" >
      @foreach($id_pkp as $pkp)
			<input type="hidden" value="{{ $pkp->datapromoo->id_pkp_promo }}" name="id">
			<input type="hidden" value="{{ $pkp->turunan }}" name="turunan">
      @endforeach
				<input type="file" name="filename[]" class="form-control" multiple>
		  </div>
			<button type="submit" class="btn btn-primary btn-sm" style="margin-top:10px"> Submit</button>
	    </form>        
		</div>
	</div>
</div>

@foreach($coba as $promo)
<div class="col-md-4">
  <div class="x_panel">
    <div class="x_title">
			<h5><li class=" fa fa-file"> {{$promo->filename }}</li></h5>
    </div>
		<div class="card-body">
      <form class="form-horizontal form-label-left" method="POST" action="{{route('infogambarpromo')}}" novalidate>
      &nbsp&nbsp&nbsp<embed src="{{asset('data_file/'.$promo->filename)}}" width="110px" height="100px" type="">
        <input name="id" value="{{$promo->promo}}" type="hidden">
        <input name="informasi[{{$loop->index}}][pic]" value="{{$promo->id_pictures}}" type="hidden">
      <textarea name="informasi[{{$loop->index}}][info]" class="col-md-7" rows="4">{{$promo->informasi}}</textarea><br>
		<a href="{{ Route('destroydata',$promo->id_pictures) }}" type="button" class="btn btn-danger" data-toggle="tooltip" title="Delete"><li class="fa fa-trash-o"></li> Delete</a>
    </div>
  </div>
</div>
@endforeach

<div class="col-md-12">
  <div class="x_panel">
    @if($coba1>=1)
    <button class="btn btn-primary col-md-12 btn-sm" type="submit"><li class="fa fa-check"></li> Save And Finish</button>
    {{ csrf_field() }}
    </form>
    @else
    @foreach ($id as $pkp)
    <a href="{{route('rekappromo',$pkp->id_pkp_promo)}}" class="btn btn-primary col-md-12 btn-sm"><li class="fa fa-check"></li> Save And Finish</a>
    @endforeach
    </form>
    @endif
  </div>
</div>
@endsection