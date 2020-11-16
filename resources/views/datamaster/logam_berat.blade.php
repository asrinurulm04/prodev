@extends('pv.tempvv')
@section('title', 'Logam Berat')
@section('content')

<div class="row">
	<div class="x_panel">
		<div class="x_title">
			<h3><li class="fa fa-file"></li> Logam Berat</h3>
		</div>
		@if(auth()->user()->role->namaRule == 'admin')
		<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#sku"><i class="fa fa-plus"></i> Add Data Logam Berat</button>
		<!-- modal -->
		<div class="modal" id="sku" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">                 
						<h3 class="modal-title" id="exampleModalLabel">Add data Logam Berat
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button></h3>
					</div>
					<div class="modal-body">
						<form class="form-horizontal form-label-left" method="POST" action="{{route('tambaharsen')}}" novalidate>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Makanan</label>
									<div class="col-md-9 col-sm-9 col-xs-12">
										<input id="" class="form-control col-md-12 col-xs-12" type="text" name="jenis">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12">Batasan Maksimum</label>
									<div class="col-md-9 col-sm-9 col-xs-12">
										<input id="" class="form-control col-md-12 col-xs-12" type="text" name="maksimum">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Submit</button>
						{{ csrf_field() }}
					</div>
					</form>
				</div>
			</div>
		</div>
		<!-- modal selesai -->
		@endif
		<table class="Table table-bordered">
			<thead>
				<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
					<td width="10px">No</td>
					<td>Jenis Makanan</td>
          <td>Arsen (As)</td>
          <td>Timbal (Pb)</td>
          <td>Merkuri (Hg)</td>
          <td>Kadmium (Cd)</td>
          <td>Logam</td>
					@if(auth()->user()->role->namaRule == 'admin')
					<td></td>
					@endif
				</tr>
			</thead>
			<tbody>
				@php
					$no = 0;
				@endphp
				@foreach($logam as $logam)
				<tr>
					<td>{{++$no}}</td>
					<td>{{$logam->pangan}}</td>
          <td>{{$logam->arsen}}</td>
          <td>{{$logam->timbal}}</td>
          <td>{{$logam->merkuri	}}</td>
          <td>{{$logam->kadmium}}</td>
          <td>{{$logam->logam}}</td>
					@if(auth()->user()->role->namaRule == 'admin')
					<td><button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModal{{ $logam->id_logam_berat  }}" data-toggle="tooltip" data-placement="top" title="Edit"><li class="fa fa-edit "></li></button></td>
					<!-- modal -->
					<div class="modal" id="exampleModal{{ $logam->id_logam_berat }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">                 
									<h3 class="modal-title" id="exampleModalLabel">Edit Data
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button></h3>
								</div>
								<div class="modal-body">
								<form class="form-horizontal form-label-left" method="POST" action="{{Route('editsrsen',$logam->id_logam_berat )}}" novalidate>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12">jenis makanan</label>
												<div class="col-md-9 col-sm-9 col-xs-12">
													<input id="jenis" disabled value="{{$logam->jenis_makanan}}" class="form-control col-md-12 col-xs-12" type="text" name="jenis">
												</div>
											</div><br><br>
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12">batasan maksimum</label>
												<div class="col-md-9 col-sm-9 col-xs-12">
													<input id="batasan" value="{{$logam->batasan_maksimum}}" class="form-control col-md-12 col-xs-12" type="text" name="batasan">
												</div>
											</div><br><br>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Submit</button>
									{{ csrf_field() }}
								</div>
								</form>
							</div>
						</div>
					</div>
					<!-- modal selesai -->
					@endif
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection