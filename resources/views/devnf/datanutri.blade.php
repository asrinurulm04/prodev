@extends('devwb.tempwb')
@section('title', 'Bayangan')
@section('judulnya', 'NUTRITION FACT')
@section('content')

<style type="text/css">
	.panel-actions {
		margin-top: 20px;
		margin-bottom: 0;
		text-align: right;
	}

	.panel-actions a {
		color:#333;
	}

	.panel-fullscreen {
		display: block;
		z-index: 9999;
		position: fixed;
		width: 100%;
		height: 100%;
		top: 0;
		right: 0;
		left: 0;
		bottom: 	0;
		overflow: auto;	
	}

	.bg{
		background-color:dodgerblue;
	}

	.nav-link{
		color:white;
		font-size:12px;
		font-weight:bold;	
	}

	.nav-link:hover{
		color:white;
	}

	.nav-item:hover{
		border-radius:5px ;
		background-color:rgba(0,0,0,0.3);
		color:white;
	}
</style>

<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<div class="row">
	<div class="col-md-14">
		<div class="panel">
			<div class="panel-body">
				{{--DATA FORMULA YANG DIPILIH--}}
				@foreach($data as $datas)
				<dl class="row" style="margin-left:2%;">
					<dt class="col-sm-1"><b>Workbook</b></dt>
					<dd class="col-sm-2"><b>:</b> {{$datas->Workbook->nama_project}}</dd>
					<dt class="col-sm-1"><b>Formula</b></dt>
					<dd class="col-sm-2"><b>:</b> {{$datas->nama_produk}}</dd>
					<br>
					<dt class="col-sm-1"><b>Kode Formula</b> </dt>
					<dd class="col-sm-2"><b>:</b> {{$datas->kode_formula}}</dd>
					<dt class="col-sm-1"><b>Revisi</b> </dt>
					<dd class="col-sm-2"><b>:</b> {{$datas->revisi}}</dd>
					<br>
					<dt class="col-sm-1"><b>Versi</b> </dt>
					<dd class="col-sm-2"><b>:</b> {{$datas->versi}}.0</dd>
					<dt class="col-sm-1"><b>Masuk</b></dt>
					<dd class="col-sm-2"><b>:</b> {{$datas->updated_at}}</dd>
				</dl>
			</div>
		</div>	
		<div class="panel">
			<div class="panel-heading bg">
				<ul class="nav nav-pills nav-justified" id="pills-tab" role="tablist">
					<li class="nav-item">
						<a class="nav-link	" href="{{url('datapn')}}" onclick="return confirm('Apakah Anda Yakin ?')"> <b>KEMBALI</b></a>
					</li>
					<li class="nav-item">
					  <a class="nav-link active" id="pills-ha-tab" data-toggle="pill" href="#pills-ha" role="tab" aria-controls="pills-ha" aria-selected="false"><b>HASIL ANALISA</b></a>
					</li>
					<li class="nav-item">
					  <a class="nav-link" id="pills-hak-tab" data-toggle="pill" href="#pills-hak" role="tab" aria-controls="pills-hak" aria-selected="false"><b>PERHITUNGAN HAK</b></a>
					</li>
					<li class="nav-item">
				    <a class="nav-link" id="pills-akg-tab" data-toggle="pill" href="#pills-akg" role="tab" aria-controls="pills-akg" aria-selected="false"><b>PERHITUNGAN AKG</b></a>
					</li>
					<!-- <li class="nav-item">
				    <a class="nav-link" id="pills-btp-tab" data-toggle="pill" href="#pills-btp" role="tab" aria-controls="pills-btp" aria-selected="false"><b>PERHITUNGAN BTP</b></a>
					</li> -->
					<li class="nav-item">
					  <a class="nav-link" id="pills-nutfact-tab" data-toggle="pill" href="#pills-nutfact" role="tab" aria-controls="pills-nutfact" aria-selected="false"><b>NUTRITION FACT</b></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="{{url('datapn')}}" onclick="return confirm('Apakah Anda Yakin ?')"> <b>SELESAI</b></a>
					</li>
				</ul>
			</div>
			<div class="panel-body">
				<div class="btn-group col-md-12">	
					<div class="col-md-12"><br>
						<div class="tab-content" id="pills-tabContent">
							<!-- INPUT HASIL ANALISA -->
						  <div class="tab-pane fade" id="pills-ha" role="tabpanel" aria-labelledby="pills-ha-tab">	
								@endforeach
								<div class="panel panel-default">
						  		<div class="panel-heading">
										HASIL ANALISA
										<ul class="list-inline panel-actions">
					            <li><a href="#" id="panel-fullscreen5" role="button" title="Toggle fullscreen"><i class="glyphicon glyphicon-resize-full"></i></a></li>
					          </ul>
									</div>
						  		<div class="panel-body">
										<form action="{{ url('datanutri/'.$datas->id) }}" method="post" enctype="multipart/form-data">
					          {{ csrf_field() }}
						  			<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<div class="col-md-5">
														<label class="col-md-12 control-label pull-right" style="margin-top: 5px;">Serving Size&nbsp:</label>
													</div>
							            <div class="col-md-3">
							              <input type="text" class="form-control pull-left" id="ss" value="{{$datas->serving}}" readonly />
							            </div>
							            <div class="col-md-1 pull-left" style="margin-top: 5px;">gram</div>
							          </div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
							            <label class="col-md-6 control-label" style="margin-top: 5px;">Serving Size (liquid) :</label>
							            <div class="col-md-3">
							              <input type="text" class="form-control" id="ssl" />
							            </div>
							            <div class="col-md-1" style="margin-top: 5px;">ml</div>
							          </div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
							            <label class="col-md-4 control-label" style="margin-top: 5px;">Berat Jenis :</label>
							            <div class="col-md-3">
							              <input type="text" class="form-control" id="bj" value="{{$datas->bj}}" readonly/>
							            </div>
							            <div class="col-md-1" style="margin-top: 5px;">gr/ml</div>
							          </div>
											</div>
										</div><br><br>
										<div class="row">
											<div class="col-md-12">
												<table class="table table-hover">
													<thead>
														<tr>
															<th class="text-center">Parameter</th>
															<th class="text-center">Per Serving</th>
															<th class="text-center">Hasil Analisa</th>
															<th class="text-center">Unit</th>
															<th class="text-center">AKG</th>
															<th class="text-center">%AKG/100g</th>	
														</tr>
													</thead>
													<tbody>
														<?php $i=1;?>
														@foreach($tampil as $data)
														<tr>
															<td class="text-left" >{{$data->parameter}}</td>
															<td class="text-center" style="width: 17%;">
																<input type="number" name="per_serving[{{$i}}]" class="form-control" id="ps{{$i}}" readonly >
															</td>
															<td class="text-right" style="width: 15%;">
																<div class="form-group"><input type="text" pattern="[0-9.]+" name="hasil_analisa[{{$i}}]" class="form-control" autofocus="on" id="ha{{$i}}" autocomplete="off" onfocus="mulaiHitung{{$i}}();" onblur="stopHitung{{$i}}();" value=""></div>
															</td>
															<td class="text-center">%</td>
															@if($data->akg=="0")
															<td class="text-center">
																<span id="akg{{$i}}">-</span>
															</td>
															@else
															<td  class="text-center">
																<span id="akg{{$i}}">{{$data->get_akg->nilai}}</span>
															</td>
															@endif
															<td  class="text-right" style="width: 17%;">
																<input type="number" name="akg[{{$i}}]" class="form-control" id="akgg{{$i}}" readonly>
															</td>
															<input type="hidden" name="parameter[{{$i}}]" value="{{$data->id_p}}">
														</tr>
														<script type="text/javascript">
															function mulaiHitung{{$i}}(){
																otomatis = setInterval("hitung{{$i}}()",1);
																}

																function hitung{{$i}}(){
																	var ss   = document.getElementById('ss').value;
																	var ssl  = document.getElementById('ssl').value;
																	var bj   = document.getElementById('bj').value;
																	var ha   = document.getElementById('ha{{$i}}').value;
																	var ps   = document.getElementById('ps{{$i}}').value;
																	var akg  = document.getElementById('akg{{$i}}').innerHTML;

																	var hitung  =(ss/bj);
																	var hitung1 = (ss * 1) / 100;
																	var hitung2 = (hitung1 * ha);
																	var hitung3 = (ha / akg * 100);
																	hitung2     = hitung2.toFixed(2);
																	hitung3		= hitung3.toFixed(1);
																	hitung      = hitung.toFixed(2);
																	document.getElementById('ssl').value = hitung;
																	document.getElementById('ps{{$i}}').value = hitung2;
																	document.getElementById('akgg{{$i}}').value = hitung3;
																}
																function stopHitung(){
																	clearInterval(otomatis);
																}
														</script>
														<?php $i++ ?>
														@endforeach
														<input type="hidden" name="jumlah_data" value="{{$i}}">
													</tbody>
													
												</table>
												<hr style="border-color: #d4d7db;">
												<button type="submit" onclick="return confirm('Apakan Anda Yakin ?')" class="btn btn-block btn-lg btn-success" name="simpan">Simpan</button>
											</div>
										</div>
										</form>
						  		</div>
						  	</div>
							</div>
							
							<!-- PERHITUNGAN HAK -->
						  <div class="tab-pane fade" id="pills-hak" role="tabpanel" aria-labelledby="pills-hak-tab">
						  	<div class="col-md-12">
								  <div class="panel panel-info">
										<div class="panel-heading">
											PERHITUNGAN HAK 
											<ul class="list-inline panel-actions">
												<li><a href="#" id="panel-fullscreen6" role="button" title="Toggle fullscreen"><i class="glyphicon glyphicon-resize-full"></i></a></li>
											</ul>
										</div>
										<div class="panel-body">
											<div class="col-md-4">
												<h4><b>Takaran Saji :</b></h4>
											</div>
											<div class="col-md-1"><input type="text" name="ts" class="form-control" readonly value="{{$datas->serving}} g"></div><br><br>
											<table class="table table-bordered table-hover table-condensed">
												<thead>
													<tr>
														<th class="text-center">Nama Zat Gizi</th>
														<th class="text-center">Jumlah</th>
														<th class="text-center">Satuan</th>
														<th class="text-center">Hasil Analisa</th>
													</tr>
												</thead>
												<tbody>
													@foreach($lemak as $l)			
													<tr>
														<td class="text-left">Energi Total</td>
														<td class="text-right">{{$l->per_serving*4*9}}</td>
														<td class="text-center">kkal</td>
														<td class="text-right"></td>
													</tr>
													@endforeach
													@foreach($lemak as $l)
													<tr>
														<td class="text-left">Energi Dari Lemak</td>
														<td class="text-right">{{$l->per_serving*9}}</td>
														<td class="text-center">kkal</td>
														<td class="text-right"></td>
													</tr>
													@endforeach
													@foreach($jenuh as $j)
													<tr>
														<td class="text-left">Energi Dari Lemak Jenuh</td>
														<td class="text-right">{{$j->per_serving*9}}</td>
														<td class="text-center">kkal</td>
														<td class="text-right"></td>
													</tr>
													@endforeach
													@foreach($analisa as $data)
													<tr>
														<td class="text-left">{{$data->get_parame->parameter}}</td>
														<td class="text-right">{{$data->per_serving}}</td>
														<td class="text-center">{{$data->get_parame->satuan}}</td>
														<td class="text-right">{{round($data->hasil_analisa)}} %	</td>
													</tr>
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
							
							<!-- PERHITUNGAN AKG -->
							<div class="tab-pane fade" id="pills-akg" role="tabpanel" aria-labelledby="pills-akg-tab">
								<div class="col-md-12">
									<div class="panel panel-info">
										<div class="panel-heading">
											PERHITUNGAN AKG
											<ul class="list-inline panel-actions">
												<li><a href="#" id="panel-fullscreen7" role="button" title="Toggle fullscreen"><i class="glyphicon glyphicon-resize-full"></i></a></li>
											</ul>
										</div>
										<div class="panel-body"><br><br>
											<table class="table table-hover table-bordered table-condensed">
												<thead>
													<tr>
														<th class="text-center">Nama Zat Gizi</th>
														<th class="text-center">Jumlah</th>
														<th class="text-center">Per</th>
														<th class="text-center">Pembulatan</th>
														<th class="text-center">Satuan</th>
														<th class="text-center">AKG</th>
														<th class="text-center">% AKG</th>
														<th class="text-center">% AKG (ROUNDED)</th>
													</tr>
												</thead>
												<tbody>
													@foreach($lemak as $l)
													<tr>
														<td class="text-left">Energi Total</td>
														<td class="text-right">{{$l->per_serving*4*9}}</td>
														<td class="text-center">kkal</td>
														<td class="text-right">0</td>
														<td class="text-center">kkal</td>
														<td class="text-right"></td>
														<td class="text-right"></td>
														<td class="text-right"></td>
													</tr>
													@endforeach
													@foreach($lemak as $l)
													<tr>
														<td class="text-left">Energi Dari Lemak</td>
														<td class="text-right">{{$l->per_serving*9}}</td>
														<td class="text-center">kkal</td>
														<td class="text-right">0</td>
														<td class="text-center">kkal</td>
														<td class="text-right"></td>
														<td class="text-right"></td>
														<td class="text-right"></td>
													</tr>
													@endforeach
													@foreach($jenuh as $j)
													<tr>
														<td class="text-left">Energi Dari Lemak Jenuh</td>
														<td class="text-right">{{$j->per_serving*9}}</td>
														<td class="text-center">kkal</td>
														<td class="text-right">0</td>
														<td class="text-center">kkal</td>
														<td class="text-right"></td>
														<td class="text-right"></td>
														<td class="text-right"></td>
													</tr>
													@endforeach
													@foreach($analisa as $data)																																								
													<tr>
														<td class="text-left">{{$data->get_parame->parameter}}</td>
														<td class="text-right"><span ></span>{{number_format($data->per_serving)}}</td>
														<td class="text-center">{{$data->get_parame->satuan}}</td>
														<td class="text-right"><span ></span>{{round(number_format($data->per_serving))}}</td>
														<td class="text-center">{{$data->get_parame->satuan}}</td>
														@if($data->get_parame->akg=="0")
														<td class="text-center">-</td>
														<td class="text-center">-</td>
														<td class="text-center">-</td>	
														@else
														<td class="text-right"><span>{{round($data->get_parame->akg)}}</span></td>
														<td class="text-right">{{number_format($data->hasil_analisa / $data->get_parame->akg /100,3)}}<span id="hasil"></span> %</td>
														<td class="text-right">{{round($data->hsail_analisa	 / $data->get_parame->akg /100)}}<span id="hasil"></span> %</td>
														@endif
													</tr>
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>

							<!-- PERHITUNGAN BTP -->
						  <div class="tab-pane fade" id="pills-btp" role="tabpanel" aria-labelledby="pills-btp-tab">
								<div class="panel panel-default">
					  			<div class="panel-heading">
					  				PERHITUNGAN BTP
					  				<ul class="list-inline panel-actions">
				              <li><a href="#" id="panel-fullscreen8" role="button" title="Toggle fullscreen"><i class="glyphicon glyphicon-resize-full"></i></a></li>
				            </ul>
					  			</div>
						  		<div class="panel-body">
						  			<table class="table table-bordered">
											<thead>
												<tr>
													<th colspan="5" class="text-center">BTP Carry Over as Bahan Baku</th>
													<th colspan="3" class="text-center">BTP Carry Over as End Product</th>
													<th rowspan="2" class="text-center">Keterangan</th>
												</tr>
												<tr>
													<th class="text-center">Nama Bahan Baku</th>
													<th class="text-center">g/100g(%)</th>
													<th class="text-center">BTP</th>
													<th class="text-center">jumlah (ppm)</th>
													<th class="text-center">limit</th>
													<th class="text-center">as it is</th>
													<th class="text-center">rtc</th>
													<th class="text-center">limit</th>
												</tr>
											</thead>
											<tbody>
											</tbody>
										</table>
						  		</div>
						  	</div>
						  </div>
							<div class="tab-pane fade" id="pills-nutfact" role="tabpanel" aria-labelledby="pills-nutfact-tab">                                                  
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection