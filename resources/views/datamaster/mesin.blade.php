@extends('layout.tempvv')
@section('title', 'PRODEV|Mesin')
@section('content')

<div class="row">
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
</div>

<div class="row">
	<div class="col-md-6 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h3><li class="fa fa-cogs"></li> Mesin</h3>
			</div>
			<table id="datatable" class="table table-striped table-bordered">
				<thead>
					<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
						<td width="10px">No</td>
						<td>WorkCenter</td>
						<td>Kategori</td>
						<td>IO</td>
						<td>Mesin</td>
					</tr>
				</thead>
				<tbody>
					@php $no = 0; @endphp
					@foreach($mesin as $mesin)
					<tr>
						<td>{{++$no}}</td>
						<td>{{$mesin->workcenter}}</td>
						<td>{{$mesin->kategori}}</td>
						<td>{{$mesin->IO}}</td>
						<td>{{$mesin->nama_mesin	}}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	<div class="col-md-6 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h3><li class="fa fa-cogs"></li> Create New Mesin</h3>
			</div>
			<form class="form-horizontal form-label-left" method="POST" action="{{ route('addmesin') }}">
      <div class="card-block">
        <div class="x_content">
        	<?php $last = Date('j-F-Y'); ?>
          <input id="last" value="{{ $last }}" class="form-control col-md-12 col-xs-12" name="last" type="hidden">
          <div class="form-group row">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">Workcenter *</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
							<select name="workcenter" id="workcenter" class="form-control" required>
								<option disabled selected>->Select One<-</option>
								@foreach($ws as $ws)
								<option value="{{$ws->workcenter}}">{{$ws->workcenter}}</option>
								@endforeach
							</select>
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">kategori *</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
							<input id="kategori" class="form-control col-md-12 col-xs-12" name="kategori" type="text" required>
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">IO *</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
							<select name="io" id="io" class="form-control" required>
								<option disabled selected>->Select One<-</option>
								@foreach($IO as $io)
								<option value="{{$io->io}}">{{$io->io}}</option>
								@endforeach
							</select>
            </div>
          </div>
					<div class="form-group row">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">aktifitas</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
          		<input id="aktifitas" class="form-control col-md-12 col-xs-12" name="aktifitas" type="text">
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">Mesin *</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
							<input id="mesin" class="form-control col-md-12 col-xs-12" name="mesin" type="text" required>
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">Line</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
          		<input id="line" class="form-control col-md-12 col-xs-12" name="line" type="number">
            </div>
          </div><hr>
					<div class="card-block col-md-5 col-md-offset-5">
						<button type="reset" class="btn btn-warning btn-sm"><li class="fa fa-repeat"></li> Reset</button>
						<button type="submit" class="btn btn-primary btn-sm"><li class="fa fa-check"></li> Submit</button>
						{{ csrf_field() }}
					</div>
        </div>
      </div>
      </form>
		</div>
	</div>
</div>
@endsection
@section('s')
<link href="{{ asset('lib/advanced-datatable/css/jquery.dataTables.css') }}" rel="stylesheet" />
<script src="{{ asset('js/datatables.min.js')}}"></script>
@endsection