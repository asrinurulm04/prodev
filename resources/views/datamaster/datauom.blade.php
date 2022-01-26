@extends('layout.tempvv')
@section('title', 'PRODEV|Data UOM')
@section('content')

<div class="row">
	<div class="col-md-6 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
    		<h3><li class="fa fa-file"> Data UOM</li></h3>
  		</div>
  		<div class="card-block">
    		<table id="datatable" class="Table table-bordered">
					<thead>
						<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
							<td class="text-center" width="15%px">No</td>
							<td class="text-center">UOM</td>
						</tr>
					</thead>
					<tbody>
          	@php $no = 0; @endphp 
						@foreach($uom as $data)
						<tr>
              <td class="text-center">{{ ++$no }}</td>
							<td>{{$data->primary_uom}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
  		</div>
		</div>
	</div>
	<div class="col-md-6 col-sm-12 col-xs-12">
		<div class="x_panel">
		<form class="form-horizontal form-label-left" method="POST" action="{{ route('uom') }}" novalidate>
			<div class="x_title">
    		<h3><li class="fa fa-file"> Create New UOM</li></h3>
  		</div>
  		<div class="card-block">
				<div class="form-group row">
      	  <label class="control-label text-bold col-md-1 col-sm-3 col-xs-12">UOM</label>
      	  <div class="col-md-11 col-sm-9 col-xs-12">
      	    <input type="text" required name="uom" id="uom" class="form-control col-md-12 col-xs-12">
      	  </div>
      	</div>
  		</div>
			<center><button type="submit" class="btn btn-primary btn-sm">Submit</button></center>
      {{ csrf_field() }}
		</div>
		</form>
	</div>
</div>		
@endsection
@section('s')
<link href="{{ asset('lib/advanced-datatable/css/jquery.dataTables.css') }}" rel="stylesheet" />
<script src="{{ asset('js/datatables.min.js')}}"></script>
@endsection