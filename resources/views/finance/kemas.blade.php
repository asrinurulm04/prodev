@extends('finance.tempfinance')
@section('title', 'feasibility|Finance')
@section('judulnya', 'List Feasibility')
@section('content')

<div class="x_content">
  <div class="" role="tabpanel" data-example-id="togglable-tabs">
    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
      <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Data kemas FBK</a></li>
      <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Data Kemas HPP</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">

			<!-- FILLING -->
			<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
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

						<table class="col-md-7 col-sm-7 col-xs-12 table-hover table-bordered">
							<tr>
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

						<table class="col-md-5 col-sm- col-xs-12">
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
								@if($kem->keterangan != '')
								<th width="10%">Kode Item</th>
								<th width="45%">: {{ $kem->item_code }}</th>
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

						<table class="table table-responsive table-hover table-bordered">
							<thead>
								<tr>
									<th rowspan="2" class="text-center" width="2%">No</th>
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

								<tr>
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
									<td class="text-center">{{ $no }}</td>
									<td class="text-center">{{ $kem->item_code }}</td>
									<td class="text-center">{{ $kem->kode_komputer }}</td>
									<td class="text-center">{{ $kem->Description }}</td>
									<td class="text-center">{{ $kem->dimensi }}</td>
									<td class="text-center">{{ $kem->spek }}</td>
									<td class="text-center">{{ $kem->line_mesin }}</td>
									<td class="text-center">{{ $kem->dus_ppa }}</td>
									<td class="text-center">{{ $kem->box_ppa }}</td>
									<td class="text-center">{{ $kem->batch_ppa }}</td>
									<td class="text-center">{{ $kem->unit_ppa }}</td>
									<td class="text-center">{{ $kem->dus_net }}</td>
									<td class="text-center">{{ $kem->box_net }}</td>
									<td class="text-center">{{ $kem->batch_net }}</td>
									<td class="text-center">{{ $kem->unit_net }}</td>
									<td class="text-center">{{ $kem->waste }}%</td>
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
							<a href="{{ route('finance',['id_feasibility' => $id_feasibility, 'id' => $id]) }}" class="btn btn-danger" type="submit">kembali</a>
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
								<button type="button" class=" btn-primary btn-lg" ALIGN="center">{{ $kem->keterangan }} </button>
								<br><br>
							@endif
						@endforeach
						
						<table class="col-md-7 col-sm-7 col-xs-12 table-hover table-bordered">
							<tr>
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
					
						<table class="col-md-5 col-sm- col-xs-12">
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
					
						<table class="table table-responsive table-bordered">
							<thead>
								<tr>
									<th rowspan="2" class="text-center" width="2%">No</th>
									<th rowspan="2" class="text-center" width="5%">kode item</th>
									<th rowspan="2" class="text-center">kode komputer</th>
									<th rowspan="2" class="text-center">Description</th>
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
										<tr><td><td><td><td><td><td><th colspan="2">Cost Kemas/Box <th>: {{ $kem->cost_box }}</th></tr>
									@endif
									@if($kem->cost_dus != '')
										<tr><td><td><td><td><td><td><th colspan="2">Cost Kemas/Dus <th>: {{ $kem->cost_dus }}</th></tr>
									@endif
									@if($kem->cost_sachet != '')
										<tr><td><td><td><td><td><td><th colspan="2">Cost Kemas/Sachet <th>: {{ $kem->cost_sachet }}</th></tr>
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
						</table>
						<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-6">
							<a href="{{ route('finance',['id_feasibility' => $id_feasibility, 'id' => $id]) }}" class="btn btn-danger" type="submit">kembali</a>
						</div>
					</div>
				</div>
			</div>          
		</div>
	</div>
</div>

@endsection