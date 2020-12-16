@extends('pv.tempvv')
@section('title', 'Approval')
@section('judulhalaman','Edit Data Form')
@section('content')

<div class="row">
	<div class="col-md-6 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
    		<h3><li class="fa fa-file"> Data SES</li></h3>
  		</div>
  		<div class="card-block">
    		<table class="Table table-bordered">
					<thead>
						<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
							<td width="7%px">No</td>
							<td>SES</td>
						</tr>
					</thead>
					<tbody>
						@foreach($ses as $data)
						<tr>
							<td>{{$data->id}}</td>
							<td>{{$data->ses}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
  		</div>
		</div>
	</div>
	<div class="col-md-6 col-sm-12 col-xs-12">
		<div class="x_panel">
			<form class="form-horizontal form-label-left" method="POST" action="{{ route('ses') }}" novalidate>
			<div class="x_title">
    		<h3><li class="fa fa-file"> Create New SES</li></h3>
  		</div>
  		<div class="card-block">
				<div class="form-group row">
      	  <label class="control-label text-bold col-md-1 col-sm-3 col-xs-12">SES</label>
      	  <div class="col-md-11 col-sm-9 col-xs-12">
      	    <input type="text" required name="ses" id="ses" class="form-control col-md-12 col-xs-12">
      	  </div>
      	</div>
  		</div>
			<center><button type="submit" class="btn btn-primary btn-sm"><li class="fa fa-check"></li> Submit</button></center>
      {{ csrf_field() }}
		</div>
		</form>
	</div>
</div>		

@endsection