@extends('kemas.tempkemas')
@section('title', 'feasibility|Kemas')
@section('judulnya', 'List Feasibility')
@section('content')

<div class="x_panel">
  <div class="x_title">
		<h3><li class="fa fa-folder-o"> Data Kemas</li></h3>
	</div>
  <div class="card-block">
    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
		  <li class="nav-item"><a class="nav-link active"href="#1" data-toggle="tab" aria-expanded="true">Data kemas FBK</a></li>
		  <li class="nav-item"><a class="nav-link" href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Data Kemas HPP</a></li>
		  <li class="nav-item"><a class="nav-link" href="#tab_content3" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Configuration</a></li>
    </ul>
		<div id="myTabContent" class="tab-content"><br>
		
			<!-- pertama -->
			<div class="tab-pane active" id="1">
				<div class="panel panel-default">			
					<div class="panel-body badan">
						<label>PT NUTRIFOOD INDONESIA</label>
						<table ALIGN="right">
							@foreach($kemas as $kem)
								@if($kem->kode_sku != '')
								<tr>
									<th class="text-right">KODE FORM : {{ $kem->kode_sku }}</th>
								</tr>
								@endif
							@endforeach
						</table>

						<center> <h2>FORMULA BAHAN KEMAS</h2> </center>
						<center> <h2>( FBK )</h2> </center>
						@foreach($kemas as $kem)
							@if($kem->nama_sku != '')
								<button type="button" class=" btn-primary btn-lg" ALIGN="center">{{ $kem->keterangan }} </button>
								<br><br>
							@endif
						@endforeach

						<table class="col-md-7 col-sm-7 col-xs-12 table-hover table-bordered table-sm">
							<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
								<th class="text-center" width="20%">Nama</th>
								<th class="text-center" width="15%">jumlah kemasan sekunder</th>
								<th class="text-center" width="15%">jumlah kemasan primer</th>
								<th class="text-center" width="5%">gramasi</th>
							</tr>
							<tbody>
								@foreach($kemas as $kem)
								<tr>
									@if($kem->nama_sku != '')
									<td class="text-center">{{ $kem->nama_sku }}</td>
									@endif
									@if($kem->jumlah_kemasan != '')
									<td class="text-center">{{ $kem->jumlah_kemasan }}</td>
									@endif
									@if($kem->jumlah_primer != '')
									<td class="text-center">{{ $kem->jumlah_primer }}</td>
									@endif
									@if($kem->gramasi != '')
									<td class="text-center">{{ $kem->gramasi }}</td>
									@endif
								</tr>
								@endforeach
							</tbody>
						</table><br>

						<table class="col-md-6 col-sm- col-xs-12">
							@foreach($kemas as $kem)
							<tr>
								@if($kem->keterangan != '')
								<th width="10%">keterangan </th>
								<th width="45%">: {{$kem->keterangan }}</th>
								@endif
							<tr>
								@if($kem->keterangan != '')
								<th width="10%">No. Formula</th>
								<th width="45%">: {{ $kem->no_formula }}</th>
								@endif
							<tr>
								@if($kem->kode != '')
								<th width="10%">Kode Item</th>
								<th width="45%">: {{ $kem->kode }}</th>
								@endif
							<tr>
								@if($kem->formula_item != '')
								<th width="10%">Formula Item</th>
								<th width="45%">: {{ $kem->formula_item }}</th>
								@endif
							</tr>
							@endforeach <br><br><br>
						</table>

						<table ALIGN="right">
							@foreach($kemas as $kem)
								@if($kem->	tgl_berlaku != '')
									<tr><th class="text-right">Tanggal : {{ $kem->	tgl_berlaku }}</th></tr>
								@endif
								@if($kem->	jumlah_batch != '')
									<tr><th class="text-right">jumlah/batch : {{ $kem->	jumlah_batch }} g</th></tr>
								@endif
								@if($kem->jumlah_box_batch != '')
									<tr><th class="text-right">jumlah box : {{ $kem->jumlah_box_batch }} Box</th></tr>
								@endif
							@endforeach
						</table>

						<table class=" table table-sm table-responsive table-hover table-bordered" style="font-size: 11px;">
							<thead>
								<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
									<th rowspan="2" class="text-center" width="5%">kode item</th>
									<th rowspan="2" class="text-center">kode komputer</th>
									<th rowspan="2" class="text-center">Description</th>
									<th rowspan="2" class="text-center">Dimensi</th>
									<th rowspan="2" class="text-center">spek</th>
									<th rowspan="2" class="text-center" width="3%">line mesin</th>
									<th colspan="3" class="text-center">Net Quantity (PPIC)</th>
									<th rowspan="2" class="text-center">unit</th>
									<th colspan="3" class="text-center">Net Quantity (Uom)</th>
									<th rowspan="2" class="text-center">unit</th>
									<th rowspan="2" class="text-center">waste</th>
								</tr>
								<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
									<th class="text-center">dus</th>
									<th class="text-center">box</th>
									<th class="text-center">batch</th>
									<th class="text-center">dus</th>
									<th class="text-center">box</th>
									<th class="text-center">batch</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 0;?>
								@foreach($kemas as $kem)
								<?php $no++ ;?>
								<tr>
									<td class="text-right">{{ $kem->item_code }}</td>
									<td class="text-right">{{ $kem->kode_komputer }}</td>
									<td>{{ $kem->Description }}</td>
									<td class="text-center">{{ $kem->dimensi }}</td>
									<td class="text-right">{{ $kem->spek }}</td>
									<td class="text-right">{{ $kem->line_mesin }}</td>
									<td class="text-right">{{ $kem->dus_ppa }}</td>
									<td class="text-right">{{ $kem->box_ppa }}</td>
									<td class="text-right">{{ $kem->batch_ppa }}</td>
									<td class="text-center">{{ $kem->unit_ppa }}</td>
									<td class="text-right">{{ $kem->dus_net }}</td>
									<td class="text-right">{{ $kem->box_net }}</td>
									<td class="text-right">{{ $kem->batch_net }}</td>
									<td class="text-center">{{ $kem->unit_net }}</td>
									<td class="text-right">{{ $kem->waste }}%</td>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>

						<table ALIGN="right">
							<tr>
								<th class="text-center">Disetujui oleh</th>
							</tr>
							<tbody>
								@foreach($kemas as $kem)
								<tr class="text-center">
									@if($kem->user != '')
									<td class="text-center"><br><br><br><br>{{ $kem->user }}</td>
									@endif
								</tr>
								@endforeach
								<tr>
									<td class="text-center">R&D Packaging Manager</td>
								</tr>
							</tbody>
						</table>

						<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
							@foreach($dataF as $dF)
							<a href="{{ route('uploadkemas',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}" class="btn btn-danger" type="submit">Kembali</a>
							@endforeach
							<a href="{{ route('myFeasibility',$id_feasibility) }}" class="btn btn-info" type="submit">Selesai</a>
						</div>
					</div>
				</div>
			</div>

			<!-- HPP -->
			<div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
				<div class="panel panel-default">
					<div class="panel-body badan">
						<label>PT NUTRIFOOD INDONESIA</label>
						<table ALIGN="right">
							@foreach($kemas as $kem)
								@if($kem->kode_sku != '')
								<tr>
									<th class="text-right">KODE FORM : {{ $kem->kode_sku }}</th>
								</tr>
								@endif
							@endforeach
						</table>
							
						<center> <h2>FORMULA BAHAN KEMAS</h2> </center>
						<center> <h2>( HPP )</h2> </center>
						@foreach($kemas as $kem)
							@if($kem->nama_sku != '')
								<button type="button" class=" btn-primary btn-lg" ALIGN="center">{{ $kem->keterangan }} </button><br><br>
							@endif
						@endforeach
							
						<table class="col-md-7 col-sm-7 col-xs-12 table-hover table-bordered">
							<thead>
								<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
									<th class="text-center" width="20%">Nama</th>
									<th class="text-center" width="15%">jumlah kemasan sekunder</th>
									<th class="text-center" width="15%">jumlah kemasan primer</th>
									<th class="text-center" width="5%">gramasi</th>
								</tr>
							</thead>
							<tbody>
								@foreach($kemas as $kem)
								<tr>
									@if($kem->nama_sku != '')
									<td class="text-center">{{ $kem->nama_sku }}</td>
									@endif
									@if($kem->jumlah_kemasan != '')
									<td class="text-center">{{ $kem->jumlah_kemasan }}</td>
									@endif
									@if($kem->jumlah_primer != '')
									<td class="text-center">{{ $kem->jumlah_primer }}</td>
									@endif
									@if($kem->gramasi != '')
									<td class="text-center">{{ $kem->gramasi }}</td>
									@endif
								</tr>
								@endforeach
							</tbody>
						</table><br>
						
						<table class="col-md-6 col-sm- col-xs-12">
							@foreach($kemas as $kem)
							<tr>
								@if($kem->keterangan != '')
								<th width="10%">keterangan </th>
								<th width="45%">: {{$kem->keterangan }}</th>
								@endif
							<tr>
								@if($kem->no_formula != '')
								<th width="10%">No. Formula</th>
								<th width="45%">: {{ $kem->no_formula }}</th>
								@endif
							<tr>
								@if($kem->formula_item != '')
								<th width="10%">Formula Item</th>
								<th width="45%">: {{ $kem->formula_item }}</th>
								@endif
							</tr>
							@endforeach <br><br><br>
						</table>
						
						<table ALIGN="right">
							@foreach($kemas as $kem)
								@if($kem->	tgl_berlaku != '')
									<tr><th class="text-right">Tanggal : {{ $kem->	tgl_berlaku }}</th></tr>
								@endif
								@if($kem->	jumlah_batch != '')
									<tr><th class="text-right">jumlah/batch : {{ $kem->	jumlah_batch }} g</th></tr>
								@endif
								@if($kem->jumlah_box_batch != '')
									<tr><th class="text-right">jumlah box : {{ $kem->jumlah_box_batch }} Box</th></tr>
								@endif
							@endforeach
						</table>
						
						<table class="table table-sm table-responsive table-bordered" style="font-size: 12px;">
							<thead>
								<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
									<th rowspan="2" class="text-center" width="2%">No</th>
									<th rowspan="2" class="text-center" width="5%">kode item</th>
									<th rowspan="2" class="text-center">kode komputer</th>
									<th rowspan="2" class="text-center" width="30%">Description</th>
									<th rowspan="2" class="text-center">Dimensi</th>
									<th rowspan="2" class="text-center">supplier</th>
									<th rowspan="2" class="text-center">Min Order</th>
									<th rowspan="2" class="text-center">harga/UoM</th>
									<th rowspan="2" class="text-center">Cost Kemas</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 0;?>
								@foreach($kemas as $kem)
								<?php $no++ ;?>
								<tr>
									<td class="text-center">{{ $no }}</td>
									<td class="text-center">{{ $kem->item_code }}</td>
									<td class="text-center">{{ $kem->kode_komputer }}</td>
									<td class="text-center">{{ $kem->Description }}</td>
									<td class="text-center">{{ $kem->dimensi }}</td>
									<td class="text-center">{{ $kem->supplier }}</td>
									<td class="text-center">{{ $kem->min_order }}</td>
									<td class="text-center">{{ $kem->harga_uom }}</td>
									<td class="text-center">{{ $kem->cost }}</td>
								</tr>
								@endforeach
									
								@foreach($kemas as $kem)
									@if($kem->cost_box != '')
										<tr><td colspan="6"><th colspan="2">Cost Kemas/Box <th>: {{ $kem->cost_box }}</th></tr>
									@endif
									@if($kem->cost_dus != '')
										<tr><td colspan="6"><th colspan="2">Cost Kemas/Dus <th>: {{ $kem->cost_dus }}</th></tr>
									@endif
									@if($kem->cost_sachet != '')
										<tr><td colspan="6"><th colspan="2">Cost Kemas/Sachet <th>: {{ $kem->cost_sachet }}</th></tr>
									@endif
								@endforeach
							</tbody>
						</table>
						
						<table ALIGN="right">
							<tr>
								<th class="text-center">Disetujui oleh</th>
							</tr>
							<tbody>
								@foreach($kemas as $kem)
								<tr class="text-center">
									@if($kem->user != '')
									<td class="text-center"><br><br><br><br>{{ $kem->user }}</td>
									@endif
								</tr>
								@endforeach
								<tr>
									<td class="text-center">R&D Packaging Manager</td>
								</tr>
							</tbody>
						</table><br>
						<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
							<a href="{{ route('myFeasibility',$id) }}" class="btn btn-info" type="submit">selesai</a>
						</div>
					</div>
				</div>
			</div>    
			
			<!-- KOnfigurasi -->
			<div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
				<div class="panel panel-default">
					<div class="panel-body badan">
						<table class="table table-bordered">
							<thead>
								<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
									<td class="text-center">Keterangan</td>
									<td class="text-center">Konfigurasi</td>
									<td class="text-center">Konsep</td>
									<td class="text-center">Batch</td>
									<td class="text-center">Palet/batch</td>
									<td class="text-center">Box/palet</td>
									<td class="text-center">Box/layer</td>
									<td class="text-center">Kubikasi</td>
								</tr>
							</thead>
							<tbody>
								@foreach($konsep as $konsep)
								<tr>
									<td>{{$konsep->keterangan}}</td>
									<td class="text-center">
										@if($konsep->primer!=NULL)
										{{$konsep->primer}}{{$konsep->s_primer}}
										@endif
										@if($konsep->tersier!=NULL)
										X{{$konsep->tersier}}{{$konsep->s_tersier}}
										@endif	
										@if($konsep->tersier!=NULL)
										X{{$konsep->tersier2}}{{$konsep->s_tersier2}}
										@endif	
										@if($konsep->sekunder!=NULL)
										X{{$konsep->sekunder}}{{$konsep->s_sekunder}}
										@endif	
									</td>
									<td class="text-center">{{$konsep->konsep}}</td>
									<td class="text-right">{{$konsep->batch}}</td>
									<td class="text-right">{{$konsep->palet_batch}}</td>
									<td class="text-right">{{$konsep->box_palet}}</td>
									<td class="text-right">{{$konsep->box_layer}}</td>
									<td class="text-right">{{$konsep->kubikasi}}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
						<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
							<a href="{{ route('myFeasibility',$id) }}" class="btn btn-info" type="submit">selesai</a>
						</div>
					</div>
				</div>
			</div>  
		</div>
  </div>
</div>
@endsection