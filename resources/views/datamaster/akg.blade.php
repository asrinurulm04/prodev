@extends('pv.tempvv')
@section('title', 'AKG')
@section('content')

<div class="row">
	<div class="x_panel">
		<div class="x_title">
      <h3><li class="fa fa-file-archive-o"></li> AKG NOMOR 9 TAHUN 2016 TENTANG ACUAN LABEL GIZI</h3>
    </div>
  	<div class="card-block">
			<a href="{{route('exportAkg')}}" class="btn btn-info btn-sm"><li class="fa fa-download"></li> Export Data AKG</a>
			@if(auth()->user()->role->namaRule == 'admin')
			<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#akg"><i class="fa fa-plus"></i> Add Data AKG</button>
			<!-- modal -->
			<div class="modal" id="akg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">                 
							<h3 class="modal-title" id="exampleModalLabel">Add Data Akg
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button></h3>
						</div>
						<div class="modal-body">
							<form class="form-horizontal form-label-left" method="POST" action="{{route('tambahakg')}}" novalidate>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-2 col-sm-3 col-xs-12">Zat Gizi</label>
										<div class="col-md-4 col-sm-9 col-xs-12">
											<input class="form-control col-md-12 col-xs-12" type="text" name="gizi">
										</div>
										<label class="control-label col-md-2 col-sm-3 col-xs-12">Satuan</label>
										<div class="col-md-4 col-sm-4 col-xs-12">
											<input required="required" class="form-control col-md-12 col-xs-12" type="text" name="satuan">
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-2 col-sm-3 col-xs-12">Umum</label>
										<div class="col-md-4 col-sm-4 col-xs-12">
											<input required="required" class="form-control col-md-12 col-xs-12" type="number" name="umum">
										</div>
										<label class="control-label col-md-2 col-sm-3 col-xs-12">Bayi</label>
										<div class="col-md-4 col-sm-4 col-xs-12">
											<input required="required" class="form-control col-md-12 col-xs-12" type="number" name="bayi">
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-2 col-sm-3 col-xs-12">Anak 7-23 Bln</label>
										<div class="col-md-4 col-sm-4 col-xs-12">
											<input required="required" class="form-control col-md-12 col-xs-12" type="number" name="anak7">
										</div>
										<label class="control-label col-md-2 col-sm-3 col-xs-12">Anak 2-5 thn</label>
										<div class="col-md-4 col-sm-9 col-xs-12">
											<input required="required" class="form-control col-md-12 col-xs-12" type="number" name="anak2">
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-2 col-sm-3 col-xs-12">Ibu Hamil</label>
										<div class="col-md-4 col-sm-9 col-xs-12">
											<input required="required" class="form-control col-md-12 col-xs-12" type="number" name="ibuh">
										</div>
										<label class="control-label col-md-2 col-sm-3 col-xs-12">Ibu Menyusui</label>
										<div class="col-md-4 col-sm-9 col-xs-12">
											<input required="required" class="form-control col-md-12 col-xs-12" type="number" name="ibum">
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
						<td>Zat Gizi</td>
						<td>Satuan</td>
						<td>Umum</td>
						<Td>Bayi</Td>
						<td>Anak 7-23 Bulan</td>
						<td>Anak 2-5 tahun</td>
						<td>Ibu Hamil</td>
						<td>Ibu Menyusui</td>
						<td></td>
					</tr>
				</thead>
				<tbody>
					@php
						$no = 0;
					@endphp
					@foreach($akg as $akg)
					<tr>
						<td class="text-center">{{++$no}}</td>
						<td>{{$akg->zat_gizi}}</td>
						<td class="text-center">{{$akg->satuan}}</td>
						<td class="text-right">{{$akg->umum}}</td>
						<td class="text-right">{{$akg->bayi}}</td>
						<td class="text-right">{{$akg->anak7_23bulan}}</td>
						<td class="text-right">{{$akg->anak2_5tahun}}</td>
						<td class="text-right">{{$akg->ibu_hamil}}</td>
						<td class="text-right">{{$akg->ibu_menyusui}}</td>
						<td><button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModal{{ $akg->id_akg }}" data-toggle="tooltip" data-placement="top" title="Edit"><li class="fa fa-edit "></li></button></td>
						<!-- modal -->
							<div class="modal" id="exampleModal{{ $akg->id_akg }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">                 
											<h3 class="modal-title" id="exampleModalLabel">Edit Data {{$akg->zat_gizi}}
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button></h3>
										</div>
										<div class="modal-body">
												<form class="form-horizontal form-label-left" method="POST" action="{{ Route('editakg',$akg->id_akg)}}" novalidate>
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label class="control-label col-md-2 col-sm-3 col-xs-12">Zat Gizi</label>
														<div class="col-md-4 col-sm-9 col-xs-12">
															<input disabled value="{{$akg->zat_gizi}}" class="form-control col-md-12 col-xs-12" type="text" name="gizi">
														</div>
														<label class="control-label col-md-2 col-sm-3 col-xs-12">Satuan</label>
														<div class="col-md-4 col-sm-4 col-xs-12">
															<input value="{{$akg->satuan}}" required="required" class="form-control col-md-12 col-xs-12" type="text" name="satuan">
														</div>
													</div><br><br>
													<div class="form-group">
														<label class="control-label col-md-2 col-sm-3 col-xs-12">Umum</label>
														<div class="col-md-4 col-sm-4 col-xs-12">
															<input value="{{$akg->umum}}" required="required" class="form-control col-md-12 col-xs-12" type="text" name="umum">
														</div>
														<label class="control-label col-md-2 col-sm-3 col-xs-12">Bayi</label>
														<div class="col-md-4 col-sm-4 col-xs-12">
															<input value="{{$akg->bayi}}" required="required" class="form-control col-md-12 col-xs-12" type="text" name="bayi">
														</div>
													</div><br><br>
													<div class="form-group">
														<label class="control-label col-md-2 col-sm-3 col-xs-12">Anak 7-23 Bln</label>
														<div class="col-md-4 col-sm-4 col-xs-12">
															<input value="{{$akg->anak7_23bulan}}" required="required" class="form-control col-md-12 col-xs-12" type="text" name="anak7">
														</div>
														<label class="control-label col-md-2 col-sm-3 col-xs-12">Anak 2-5 thn</label>
														<div class="col-md-4 col-sm-9 col-xs-12">
															<input value="{{$akg->anak2_5tahun}}" required="required" class="form-control col-md-12 col-xs-12" type="text"  name="anak2">
														</div>
													</div><br><br>
													<div class="form-group">
														<label class="control-label col-md-2 col-sm-3 col-xs-12">Ibu Hamil</label>
														<div class="col-md-4 col-sm-9 col-xs-12">
															<input value="{{$akg->ibu_hamil}}" required="required" class="form-control col-md-12 col-xs-12" type="text"  name="ibuh">
														</div>
														<label class="control-label col-md-2 col-sm-3 col-xs-12">Ibu Menyusui</label>
														<div class="col-md-4 col-sm-9 col-xs-12">
															<input value="{{$akg->ibu_menyusui}}" required="required" class="form-control col-md-12 col-xs-12" type="text"  name="ibum">
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
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>	
@endsection