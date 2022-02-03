@extends('layout.tempvv')
@section('title', 'feasibility|Kemas')
@section('judulnya', 'List Feasibility')
@section('content')

<div class="x_panel">
  <div class="col-md-6"><h4><li class="fa fa-star"></li> Project Name </h4></div>
  <div class="col-md-6" align="right">
    @if(auth()->user()->role->namaRule == 'kemas')
			<button class="btn btn-info btn-sm" data-toggle="modal" data-target="#NW1" type="button"><li class="fa fa-check"></li> Finish</button>
			@if($wb->fs->id_project != '')
			<a href="{{ route('datamesin',[$pkp->id_project,$fs,$ws])}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-arrow-left"></li> Back</a>
			@elseif($wb->fs->id_project_pdf != '')
			<a href="{{ route('datamesin',[$pdf->pdf_id,$fs,$ws])}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-arrow-left"></li> Back</a>
			@endif
		@elseif(auth()->user()->role->namaRule != 'kemas')
			@if($wb->fs->id_project != '')
			<a href="{{ route('listPkpFs',[$pkp->id_project])}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-arrow-left"></li> Back</a>
			@elseif($wb->fs->id_project_pdf != '')
			<a href="{{ route('listPdfFs',[$pdf->pdf_id])}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-arrow-left"></li> Back</a>
			@endif
		@endif
	</div><br><br><hr>
  <div class="card-block">
    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
		  <li class="nav-item"><a class="nav-link active"href="#1" data-toggle="tab" aria-expanded="true">Data kemas FBK</a></li>
		  <li class="nav-item"><a class="nav-link" href="#tab_content3" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Configuration</a></li>
		  <li class="nav-item"><a class="nav-link" href="#tab_content4" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Form BK</a></li>
    </ul>
		<div id="myTabContent" class="tab-content"><br>
			<!-- pertama -->
			<div class="tab-pane active" id="1">
				<div class="panel panel-default">			
					<div class="panel-body badan">
						<label>PT NUTRIFOOD INDONESIA</label>

						<center> <h2>FORMULA BAHAN KEMAS</h2> </center>
						<center> <h2>( FBK )</h2> </center>
						<button type="button" class=" btn-primary btn-lg" ALIGN="center">{{ $myFormula->formula }}</button><br><br>

						<table class="col-md-7 col-sm-7 col-xs-12 table-hover table-bordered table-sm">
							<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
								<th class="text-center" width="20%">Nama</th>
								<th class="text-center" width="15%">jumlah kemasan sekunder</th>
								<th class="text-center" width="15%">jumlah kemasan primer</th>
								<th class="text-center" width="5%">kemasan gramasi</th>
							</tr>
							<tbody>
								<tr>
									<td class="text-center">{{ $myFormula->formula }}</td>
									@if($wb->fs->id_project != '')
									<td class="text-center">{{$pkp->kemas->tersier}}{{ $pkp->kemas->s_tersier }}</td>
									<td class="text-center">{{$pkp->kemas->sekunder1}}{{ $pkp->kemas->s_sekunder1 }}</td>
									<td class="text-center">{{$pkp->kemas->primer}}{{ $pkp->kemas->s_primer }}</td>
									@elseif($wb->fs->id_project_pdf != '')
									<td class="text-center">{{$pdf->kemas->tersier}}{{ $pdf->kemas->s_tersier }}</td>
									<td class="text-center">{{$pdf->kemas->sekunder1}}{{ $pdf->kemas->s_sekunder1 }}</td>
									<td class="text-center">{{$pdf->kemas->primer}}{{ $pdf->kemas->s_primer }}</td>
									@endif
								</tr>
							</tbody>
						</table><br>

						<table class="col-md-6 col-sm- col-xs-12">
							<tr>
								<th width="10%">keterangan </th>
								<th width="45%">: {{$konsep->keterangan }}</th>
							</tr>
							<tr>
								<th width="10%">Formula</th>
								<th width="45%">: {{ $myFormula->formula }}</th>
							</tr>
							<tr>
								<th width="10%">IO / Produksi</th>
								<th width="45%">: @foreach($lokasi as $lokasi2) {{$lokasi2->IO}}, @endforeach</th>
							</tr><br><br><br>
						</table>

						<table ALIGN="right">
							<tr><th class="text-right">Tanggal : {{ $konsep->created_date }}</th></tr>
							<tr><th class="text-right">Batch/Yield : {{ $konsep->batch_yield }} g</th></tr>
							<tr><th class="text-right">Net Batch : {{ $konsep->batch_size }} g</th></tr>
							<tr><th class="text-right">jumlah Box/Batch : {{ $konsep->jumlah_box }} Box</th></tr>
						</table>

						<table class=" table table-sm table-responsive table-hover table-bordered" style="font-size: 11px;">
							<thead>
								<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
									<th rowspan="2" class="text-center" width="5%">kode item</th>
									<th rowspan="2" class="text-center">kode komputer</th>
									<th rowspan="2" class="text-center">Description</th>
									<th rowspan="2" class="text-center">Dimensi / Jml Pemakaian</th>
									<th rowspan="2" class="text-center">Spek</th>
									<th rowspan="2" class="text-center">Supplier</th>
									<th rowspan="2" class="text-center">Harga / UoM</th>
									<th rowspan="2" class="text-center">Min. Order</th>
									<th rowspan="2" class="text-center">Cost Kemas</th>
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
								@foreach($kemas as $kem)
								<tr>
									<td class="text-right">{{ $kem->item_code }}</td>
									<td class="text-right">{{ $kem->kode_komputer }}</td>
									<td>{{ $kem->Description }}</td>
									<td class="text-center">{{ $kem->jlh_pemakaian }}</td>
									<td class="text-center">{{ $kem->spek }}</td>
									<td class="text-center">{{ $kem->supplier }}</td>
									<td class="text-right">{{ $kem->harga_uom }}</td>
									<td class="text-right">{{ $kem->min_order }}</td>
									<td class="text-right">{{ $kem->cost_kemas }}</td>
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

						<table ALIGN="right" class="table-bordered">
							<tbody>
							<tr>
								<th class="text-center">Dibuat oleh</th>
								</tr><br><br><br><br><br>
								<tr class="text-center">
									<td class="text-center"><br><br><br><br></td>
								</tr>
								<tr>
									<td class="text-center">R&D Packaging Manager</td>
								</tr>
							</tbody>
						</table><br>
						<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
						</div>
					</div>
				</div>
			</div>
			
			<!-- Konfigurasi -->
			<div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
				<div class="panel panel-default">
					<div class="panel-body badan">
						<table class="table table-bordered">
							<thead>
								<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
									<th class="text-center">Keterangan</th>
									<th class="text-center">Batch Size</th>
									<th class="text-center">Box/palet</th>
									<th class="text-center">Kubikasi/batch</th>
									<th class="text-center">Batch/Yield</th>
									<th class="text-center">Referensi</th>
									<th class="text-center">Jml box/batch</th>
								</tr>
							</thead>
								<tr>
									<td>{{$konsep->keterangan}}</td>
									<td>{{$konsep->batch_size}}</td>
									<td>{{$konsep->box_palet}}</td>
									<td>{{$konsep->kubikasi}}</td>
									<td>{{$konsep->batch_yield}}</td>
									<td>{{$konsep->referensi}}</td>
									<td>{{$konsep->jumlah_box}}</td>
								</tr>
							</tbody>
						</table>
						<h4><li class="fa fa-cogs"></li> Informasi Mesin Filling Dan Packing</h4>
						<table class="table table-hover table-bordered">
							<thead>
								<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
									<th class="text-center" width="30%">mesin</th>
									<th class="text-center" width="15%">kategori</th>
									<th class="text-center" width="15%">SDM (jika berbeda dengan eksis)</th>
									<th class="text-center" width="20%">Runtime (menit)</th>
									<th class="text-center" width="35%">Note</th>
								</tr>
							</thead>
							<tbody>
								@foreach($Mdata as $dM)
								<tr>
									<td>{{ $dM->nama_mesin }}</td>
									<td class="text-center">{{ $dM->kategori }}</td>
									<td class="text-center">{{ $dM->sdm }}</td>
									<td class="text-center">{{$dM->runtime}} Menit</td>
									<td>{{$dM->note}}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
						<!-- informasi data mesin manual -->
						<h4><li class="fa fa-cogs"></li> Informasi Data Manual</h4>
						<table class="table table-hover table-bordered">
							<thead>
								<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
									<th class="text-center" width="30%">Manual</th>
									<th class="text-center" width="15%">SDM</th>
									<th class="text-center" width="20%">Runtime (menit)</th>
									<th class="text-center" width="35%">Note</th>
								</tr>
							</thead>
							<tbody>
								@foreach($manual as $manual)
								<tr>
									<td>{{ $manual->manual }}</td>
									<td class="text-center">{{ $manual->sdm }}</td>
									<td class="text-center">{{$manual->runtime}} Menit</td>
									<td>{{$manual->note}}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
						<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5"></div>
					</div>
				</div>
			</div>  
			<!-- Form BK baru -->
			<div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="profile-tab">
				<div class="panel panel-default">			
					<div class="panel-body badan">
						<table class=" table table-sm table-responsive table-hover table-bordered" style="font-size: 11px;">
							<thead>
								<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
									<th rowspan="2" class="text-center">Nama BB</th>
									<th rowspan="2" class="text-center">Supplier</th>
									<th colspan="3" class="text-center">Price</th>
									<th colspan="2" class="text-center">Quantity order</th>
									<th rowspan="2" class="text-center">Shelf life</th>
									<th rowspan="2" class="text-center">Usage/ Batch</th>
									<th rowspan="2" class="text-center">Usage/ month</th>
									<th rowspan="2" class="text-center">DOI</th>
									<th colspan="2" class="text-center">Potential Scrap</th>
								</tr>
								<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
									<th class="text-center">CURRENCY</th>
									<th class="text-center">PRICE/Unit</th>
									<th class="text-center">Unit</th>
									<th class="text-center">MOQ</th>
									<th class="text-center">Unit</th>
									<th class="text-center">currency</th>
									<th class="text-center">value</th>
								</tr>
							</thead>
							<tbody>
          			@php $nom = 0; @endphp
								@foreach($kemasNew as $new)
								@if($new->status=='New')
          			@php ++$nom; @endphp
								<tr>
									<td class="text-right">{{ $new->Description }}</td>
									<td class="text-right">{{ $new->supplier }}</td>
									<td>IDR</td>
									<td class="text-center">{{ $new->harga_uom }}</td>
									<td class="text-center">{{ $new->unit_order }}</td>
									<td class="text-center">{{ $new->min_order }}</td>
									<td class="text-right">{{ $new->unit_order }}</td>
									<td class="text-right">{{ $new->shelf_life }}</td>
									<td class="text-right">{{ $new->batch_net }}</td>
									<td class="text-right">{{ $form->Batch_month * $new->batch_net }}</td>
									<td class="text-right">{{ $new->min_order / ( $form->Batch_month * $new->batch_net ) }}</td>
									<td class="text-right">IDR</td>
									<td class="text-right">
										@if( ($new->min_order / ( $form->Batch_month * $new->batch_net )) >= $new->shelf_life )
										<input type="text" value="<?php $angka_format = number_format(($new->min_order * $new->harga_uom) - ($new->harga_uom * ( ($form->Batch_month * $new->batch_net) * $new->shelf_life ) ),2,",","."); echo "Rp. ".$angka_format;?>" readonly>
										<input id="nilai{{$nom}}" type="hidden" value="{{($new->min_order * $new->harga_uom) - ($new->harga_uom * ( ($form->Batch_month * $new->batch_net) * $new->shelf_life ) )}}" readonly>
										@else
										<input type="text" value="<?php $angka_format = number_format(0,2,",","."); echo "Rp. ".$angka_format;?>">
										<input type="hidden" id="nilai{{$nom}}" value="0">
										@endif
									</td>
									</td>
								</tr>
								@endif
								@endforeach
							</tbody>
						</table>
						<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
						</div>
					</div>
					
					<div class="panel-body hidden">
						<table class=" table table-sm table-responsive table-hover table-bordered" style="font-size: 11px;">
							<thead>
								<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
									<th rowspan="2" class="text-center">Nama BB</th>
									<th rowspan="2" class="text-center">Supplier</th>
									<th colspan="2" class="text-center">Price</th>
									<th rowspan="2" class="text-center">Quantity order</th>
									<th rowspan="2" class="text-center">Shelf life</th>
									<th rowspan="2" class="text-center">Usage/ Batch</th>
									<th rowspan="2" class="text-center">Usage/ month</th>
									<th rowspan="2" class="text-center">DOI</th>
									<th colspan="3" class="text-center">Potential Scrap</th>
								</tr>
								<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
									<th class="text-center">CURRENCY</th>
									<th class="text-center">PRICE/Unit</th>
									<th class="text-center">currency</th>
									<th class="text-center">value</th>
									<th class="text-center">value/year</th>
								</tr>
							</thead>
							<tbody>
          			@php $no = 0; @endphp
								@foreach($fortail as $new)
          			@php ++$no; @endphp
								<tr>
									<td class="text-right">{{ $new->nama_bahan}}</td>
									<td class="text-right">{{ $new->supplier }}</td>
									<td>IDR</td>
									<td class="text-center">{{ $new->harga_satuan }}</td>
									<td class="text-center">{{ $new->qty_order }}</td>
									<td class="text-center">{{ $new->shelf_life }}</td>
									<td class="text-right">{{ $new->per_batch }}</td>
									<td class="text-right">{{ $form->Batch_month * $new->per_batch }}</td>
									<td class="text-right">{{ $new->qty_order / ( $form->Batch_month * $new->per_batch ) }}</td>
									<td class="text-right">IDR</td>
									<td class="text-right">
										@if( ($new->qty_order / ( $form->Batch_month * $new->per_batch )) >= $new->shelf_life )
										<input type="text" value="<?php $angka_format = number_format(($new->qty_order * $new->harga_satuan) - ($new->harga_satuan * ( (($form->Batch_month * $new->batch_net) * $new->shelf_life ) * ( 75/100 ) ) ),2,",","."); echo "Rp. ".$angka_format;?>" readonly>
										@else
										<input type="text" value="<?php $angka_format = number_format(0,2,",","."); echo "Rp. ".$angka_format;?>">
										@endif
									</td>
									<td class="text-right">
										@if( ($new->qty_order / ( $form->Batch_month * $new->per_batch )) >= $new->shelf_life )
										<input type="text" value="<?php $angka_format = number_format((12 / ($new->shelf_life * (75/100)) * ($new->qty_order * $new->harga_satuan) - ($new->harga_satuan * ( (($form->Batch_month * $new->batch_net) * $new->shelf_life ) * ( 75/100 ) ) ) ) ,2,",","."); echo "Rp. ".$angka_format;?>" readonly>
										<input id="nilaibb{{$no}}" type="hidden" value="{{ (12 / ($new->shelf_life * (75/100)) * ($new->qty_order * $new->harga_satuan) - ($new->harga_satuan * ( (($form->Batch_month * $new->batch_net) * $new->shelf_life ) * ( 75/100 ) ) ) )}}" readonly>
										@else
										<input type="text" value="<?php $angka_format = number_format(0,2,",","."); echo "Rp. ".$angka_format;?>">
										<input type="hidden" id="nilaibb{{$no}}" value="0">
										@endif
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
						<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
						</div>
					</div>
				</div>
			</div>  
		</div>
  </div>
</div>

<!-- Template -->
<div class="modal" id="NW1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Note
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> </h3>
      </div>
      <form class="form-horizontal form-label-left" method="POST" action="{{ route('judul') }}">
      <div class="modal-body">
        <div class="form-group row">
					@if($wb->fs->id_project != '')
          <input type="hidden" value="{{$pkp->id_project}}" name="id" id="id">
					@elseif($wb->fs->id_project_pdf != '')
          <input type="hidden" value="{{$pdf->pdf_id}}" name="id" id="id">
					@endif
          <input type="hidden" value="{{$ws}}" name="ws" id="ws">
          <input type="hidden" value="{{$wb->id_feasibility}}" name="fs" id="fs">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" style="color:#31a9b8">Judul Workbook</label>
          <div class="col-md-9 col-sm-8 col-xs-12">
            <input type="text" name="judul" value="WB Kemas-{{$wb->opsi}}" id="judul" class="form-control col-md-12 col-xs-12" readonly>
          </div>
        </div>
				<input type="hidden" id="hasil" name="hasil" readonly>
				<input type="hidden" id="hasilbaku" name="hasilbaku" readonly>
        <div class="form-group row">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" style="color:#31a9b8">Remarks</label>
          <div class="col-md-9 col-sm-8 col-xs-12">
            <textarea name="remarks" value="{{$wb->note}}" id="remarks" cols="0" rows="3" class="form-control">{{$wb->note}}</textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-check"></i> Submit</button>
          {{ csrf_field() }}
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Selesai -->
@endsection
@section('s')
<script type="text/javascript">
  var i = {{ $nom }} ;
  var total  = 0;
  var y;
    for(y=1;y<=i;y++){
			potential 		= parseFloat($('#nilai'+y).val());
     	total   			= total + potential;
      $("#hasil").val(total);
    }
</script>

<script type="text/javascript">
	jumlahbb 			= $('#nilaibb1').val();
	console.log(jumlahbb);
  var j = {{ $no }} ;
  var total  = 0;
  var y;
    for(y=1;y<=j;y++){
			jumlahbb 			= parseFloat($('#nilaibb'+y).val());
     	total   			= total + jumlahbb;
      $("#hasilbaku").val(total);
    }
</script>
@endsection