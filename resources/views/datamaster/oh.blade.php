@extends('layout.tempvv')
@section('title', 'PRODEV|Mesin')
@section('content')

<div class="row">
	<div class="col-md-6 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h3><li class="fa fa-cogs"></li> OH</h3>
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
					@foreach($oh as $oh)
					<tr>
						<td>{{++$no}}</td>
						<td>{{$oh->workcenter}}</td>
						<td>{{$oh->type}}</td>
						<td>{{$oh->aktifitas}}</td>
						<td>{{$oh->mesin	}}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	<div class="col-md-6 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h3><li class="fa fa-cogs"></li> Create New OH</h3>
			</div>
			<form class="form-horizontal form-label-left" method="POST" action="{{ route('add_principal') }}">
      <div class="card-block">
        <div class="x_content">
        	<?php $last = Date('j-F-Y'); ?>
          <input id="last" value="{{ $last }}" class="form-control col-md-12 col-xs-12" name="last" type="hidden">
          <div class="form-group row">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">workcenter</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
          		<input id="name" class="form-control col-md-12 col-xs-12" name="name" type="text">
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">type</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
							<input id="name" class="form-control col-md-12 col-xs-12" name="name" type="text">
            </div>
          </div>
					<div class="form-group row">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">aktifitas</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
          		<input id="name" class="form-control col-md-12 col-xs-12" name="name" type="text">
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">Mesin</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
							<input id="name" class="form-control col-md-12 col-xs-12" name="name" type="text">
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">Line</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
          		<input id="email" class="form-control col-md-12 col-xs-12" name="email" type="text">
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