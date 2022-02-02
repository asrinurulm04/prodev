@extends('layout.tempvv')
@section('title', 'Workbook | Feasibility')
@section('content')

<div class="x_panel">
  <div class="x_title">
		<div class="row">
			<div class="col-md-10">
    		<h3><li class="fa fa-list"> Overview</li></h3><hr>
			</div>
			<div class="col-md-2">
				<a href="{{route('download_fs',[$form->id_feasibility,$fs->id_wb_proses,$fs->id_wb_kemas])}}" class="btn btn-warning btn-sm" type="button"><li class="fa fa-upload"></li> export excel</a>
				@if(auth()->user()->role->namaRule == 'pv_lokal')
				<a class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Kemabali" href="{{route('PengajuanFS_PKP',[$pkp->id_project,$formula->id])}}"><i class="fa fa-arrow-left"></i> Back</a>
				@elseif(auth()->user()->role->namaRule != 'pv_lokal')
				<a class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Kemabali" href="{{route('listPkpFs',$pkp->id_project)}}"><i class="fa fa-arrow-left"></i> Back</a>
				@endif
			</div>
		</div>
		<div class="" style="overflow-x: scroll;">
      <div id="exTab2" class="container"> 
        <section id="fancyTabWidget" class="tabs t-tabs">
					<ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
						<li class="nav-item"><a class="nav-link  active" href="#1" data-toggle="tab"><b> Overview </b></a></li>
            @if(auth()->user()->role->namaRule == 'pv_lokal' || auth()->user()->role->namaRule == 'pv_global' || auth()->user()->role->namaRule == 'manager' || auth()->user()->role->namaRule == 'user_rd_proses')
						<li class="nav-item"><a class="nav-link" href="#2" data-toggle="tab"><b> Bahan Baku Baru </b></a></li>
						<li class="nav-item"><a class="nav-link" href="#3" data-toggle="tab"><b> Detail Proses </b></a></li>
						<li class="nav-item"><a class="nav-link" href="#4" data-toggle="tab"><b> Detail Kemas </b></a></li>
						<li class="nav-item"><a class="nav-link" href="#5" data-toggle="tab"><b> Detail Lab</b></a></li>
						@endif
					</ul><br>
					<div class="tab-content ">
						<div class="tab-content ">
							<!-- Overview -->
							<div class="tab-pane active" id="1">
								<div class="row">
									<div class="col-md-10">
										<table>
											<tr><th width="15%">No.PKP</th><th>: {{$pkp->pkp_number}}{{$pkp->ket_no}}</th>
											<tr><th width="15%">Brand</th><th>: {{$pkp->id_brand}}</th>
											<tr><th width="15%">Idea</th><th>: {{$pkp->idea}}</th></tr>
											<tr><th width="15%">Formula</th><th>: {{$formula->formula}}</th></tr>
										</table>
									</div>
								</div>
								<div class="card-block">
									<div class="dt-responsive table-responsive"><br>
										<table class="table table-bordered">
											<thead>
												<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
													<th class="text-center" colspan="2">Project Overview</th>
												</tr>
												<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
													<th class="text-center">Information</th>
													<th class="text-center">Option</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<th width="40%">Target Launching</th>
													<td>{{$pkp->launch}} {{$pkp->years}}</td>
												</tr>
												<tr>
													<th>Project Name</th>
													<td>{{$pkp->project_name}}</td>
												</tr>
												<tr>
													<th>Product Name/Desc</th>
													<td>{{$pkp->idea}}</td>
												</tr>
												<tr>
													<th>Formula Code</th>
													<td>{{$formula->formula}}</td>
												</tr>
												<tr>
													<th>Product type (BPOM Category)</th>
													<td>({{$pkp->katpangan->no_kategori}}) {{$pkp->katpangan->pangan}}</td>
												</tr>
												<tr>
													<th>Packaging configuration</th>
													<td>
														@if($pkp->kemas_eksis!=NULL)(
																@if($pkp->kemas->tersier!=NULL)
																{{ $pkp->kemas->tersier }}{{ $pkp->kemas->s_tersier }}
																@endif

																@if($pkp->kemas->sekunder1!=NULL)
																X {{ $pkp->kemas->sekunder1 }}{{ $pkp->kemas->s_sekunder1}}
																@endif

																@if($pkp->kemas->sekunder2!=NULL)
																X {{ $pkp->kemas->sekunder2 }}{{ $pkp->kemas->s_sekunder2 }}
																@endif

																@if($pkp->kemas->primer!=NULL)
																X{{ $pkp->kemas->primer }}{{ $pkp->kemas->s_primer }}
																@endif )
															@endif
													</td>
												</tr>
												<tr>
													<th>Product reference :product characteristic</th>
													<td>{{$form->product_reference}}</td>
												</tr>
												<tr>
													<th>Product reference :packaging </th>
													<td>{{$kemas->sku->nama_sku}}</td>
												</tr>
												<tr>
													<th>Forecast (Rp/ month)</th>
													<td>{{$for}}</td>
												</tr>
												<tr>
													<th>Pricelist (Rp/ UOM)</th>
													<td>{{$pkp->selling_price}}</td>
												</tr>
												<tr>
													<th>UoM</th>
													<td>{{$pkp->UOM}}</td>
												</tr>
												<tr>
													<th>UoM per BOX</th>
													<td>{{ $pkp->kemas->tersier }}</td>
												</tr>
												<tr>
													<th>Gramasi per UOM (g)</th>
													<td>{{$form->gramasi_uom}}</td>
												</tr>
												<tr>
													<th>serving size (g)</th>
													<td>{{$form->serving_size}}</td>
												</tr>
												<tr>
													<th>serving/ UOM</th>
													<td>{{$form->serving_uom}}</td>
												</tr>
												<tr>
													<th>Batch size (g)</th>
													<td>{{$form->batch_size}}</td>
												</tr>
												<tr>
													<th>Batch size granulation (kg)</th>
													<td>{{$form->batch_granulation}}</td>
												</tr>
												<tr>
													<th>Yield (%)</th>
													<td>{{$form->Yield}}</td>
												</tr>
												<tr>
													<th>BOX per BATCH</th>
													<td>{{$form->box_batch}}</td>
												</tr>
												<tr>
													<th>UOM / month</th>
													<td>{{$form->uom_month}}</td>
												</tr>
												<tr>
													<th>Batches/month</th>
													<td>{{$form->Batch_month}}</td>
												</tr>
												<tr>
													<th>Production Location</th>
													<td>@foreach($lokasi as $lokasi)* {{$lokasi->IO}} <br>@endforeach</td>
												</tr>
												<tr>
													<th>Fillpack Location</th>
													<td>@foreach($lokasi2 as $lokasi2)* {{$lokasi2->IO}} <br>@endforeach</td>
												</tr>
												<tr>
													<th>Filling Machine</th>
													<td>@foreach($mesin as $mesin)* {{$mesin->nama_mesin}} <br>@endforeach</td>
												</tr>
												<tr>
													<th>Cost of Packaging (Rp/UOM)</th>
													<td>{{$forKemas->cost_uom}}</td>
												</tr>
												<tr>
													<th>Cost of Lab/Analysis (Rp/UOM)</th>
													<td>{{$analisa}}</td>
												</tr>
												<tr>
													<th>Maklon Fee (Rp/UOM)</th>
													<td>{{$maklon->biaya_maklon}}</td>
												</tr>
												<tr>
													<th>Transportation Fee (Rp/UOM)</th>
													<td>{{$maklon->biaya_transport}}</td>
												</tr>
												<tr>
													<th>Allergen information | contain</th>
													<td>{{$all->allergen_baru}}</td>
												</tr>
												<tr>
													<th>Allergen information | may contain (from the production line)</th>
													<td>{{$all->my_contain}}</td>
												</tr>
												<tr>
													<th>Allergen impact to production line</th>
													<td>{{$all->lini_terdampak}}</td>
												</tr>
												<tr>
													<th>New Raw Material?</th>
													<td>{{$form->new_raw_material}}</td>
												</tr>
												<tr>
													<th>Value of Unprocessed Raw Material per year</th>
													<td><?php $angka_format = number_format($form->material_per_year,2,",","."); echo "Rp. ".$angka_format;?></td>
												</tr>
												<tr>
													<th>New Packaging Material?</th>
													<td>{{$form->new_packaging_material}}</td>
												</tr>
												<tr>
													<th>Value of Unprocessed Packaging Material per year</th>
													<td><?php $angka_format = number_format($form->packaging_per_year,2,",","."); echo "Rp. ".$angka_format;?></td>
												</tr>
												<tr>
													<th>New Machine?</th>
													<td>{{$form->new_machine}}</td>
												</tr>
												<tr>
													<th>Need Trial before real packaging?</th>
													<td>{{$form->trial}}</td>
												</tr>
												<tr>
													<th>Reff EKP</th>
													<td>{{$form->ref_ekp}}</td>
												</tr>
												<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
													<th colspan="2">1. Seluruh runtime yang digunakan mengacu pada standar perhitungan costing, kecuali distate lain. Misal : runtime mixer meliput charging-discharge, tidak hanya mixing</th>
												</tr>
												<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
													<th colspan="2">2. Jumlah SDM  yang digunakan tiap proses mengacu pada standar, kecuali distate lain</th>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<!-- Bahan Baku Baru -->
							<div class="tab-pane" id="2">
								<div class="row">
									<div class="col-md-12">
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
									</div>
								</div>
							</div>
							<!-- Detail Proses -->
							<div class="tab-pane" id="3">
								<div class="row">
									<div class="col-md-12">
										<table class=" table table-sm table-responsive table-hover table-bordered" style="font-size: 11px;">
										  <thead>
												<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
													<th class="text-center">Mesin</th>
													<th class="text-center">IO</th>
													<th class="text-center" width="15%">Runtime (menit/batch granulasi)</th>
													<th class="text-center" width="20%">Runtime (menit/batch)</th>
													<th class="text-center">Note</th>
												</tr>
											</thead>
											<tbody>
												<tr>

												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<!-- Detail Kemas -->
							<div class="tab-pane" id="4">
								<div class="row">
									<div class="col-md-12">
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
										<!-- Informasi Kemas Baru -->
										<h4><li class="fa fa-file"></li> Informasi Kemas Baru</h4>
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
									</div>
								</div>
							</div>
							<!-- Detail Lab -->
							<div class="tab-pane" id="5">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group row">
											<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Item Desc </label>
											<div class="col-md-3 col-sm-3 col-xs-12">
												<input type="text" class="form-control" value="{{$iddesc->item_desc}}" name="item_desc" id="item_desc" readonly>
											</div>
											<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">PLANT </label>
											<div class="col-md-3 col-sm-3 col-xs-12">
												<input type="text" class="form-control" value="{{$iddesc->io}}" name="plant" id="plant" readonly>
											</div>
										</div>
										<div class="form-group row">
											<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Lokasi analisa</label>
											<div class="col-md-3 col-sm-3 col-xs-12">
												<input type="text" class="form-control" value="{{$iddesc->lokasi}}" name="lokasi" id="lokasi" readonly>
											</div>
											<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Total batch </label>
											<div class="col-md-3 col-sm-3 col-xs-12">
												<input type="text" class="form-control" value="{{ $fs->form->batch_size }}" name="batch" id="batch" readonly>
											</div>
										</div>
										<div class="form-group row">
											<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">para x spl (BB)/batch </label>
											<div class="col-md-3 col-sm-3 col-xs-12">
												<input type="text" class="form-control" value="{{$iddesc->spl_batch}}" name="spl_batch" id="spl_batch" readonly>
											</div>
											<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">para x sampel (swab)/batch </label>
											<div class="col-md-3 col-sm-3 col-xs-12">
												<input type="text" class="form-control" value="{{$iddesc->sample_swab}}" name="para_sample_batch" id="para_sample_batch" readonly>
											</div>
										</div>
										<div class="form-group row">
											<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Parameter mikro rilis</label>
											<div class="col-md-3 col-sm-3 col-xs-12">
												<input type="text" class="form-control" value="{{$iddesc->parameter_mikro}}" name="mikro_rilis" id="mikro_rilis" readonly>
											</div>
											<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Para x sampel analisa rutin</label>
											<div class="col-md-3 col-sm-3 col-xs-12">
												<input type="text" class="form-control" value="{{$iddesc->sample_analisa}}" name="sample_analisa_rutin" id="sample_analisa_rutin" readonly>
											</div>
										</div>
										<div class="form-group row">
											<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Jlh sampel mikro/batch</label>
											<div class="col-md-3 col-sm-3 col-xs-12">
												<input type="text" class="form-control" value="{{$iddesc->jlh_sample_mikro}}" name="sample_mikro_batch" id="sample_mikro_batch" readonly>
											</div>
											<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Jlh sampel mikro analisa/thn</label>
											<div class="col-md-3 col-sm-3 col-xs-12">
												<input type="text" class="form-control" value="{{$iddesc->jlh_mikro_tahunan}}" name="mikro_analisa_thn" id="mikro_analisa_thn" readonly>
											</div>
										</div>
										<div class="form-group row">
											<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Biaya analisa mikro rutin/sampel</label>
											<div class="col-md-3 col-sm-3 col-xs-12">
												<input type="text" class="form-control" value="{{$iddesc->biaya_analisa}}" name="analisa_mikro_rutin" id="analisa_mikro_rutin" readonly>
											</div>
											<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Biaya mikro rutin/batch</label>
											<div class="col-md-3 col-sm-3 col-xs-12">
												<input type="text" class="form-control" name="mikro_rutin_batch" id="mikro_rutin_batch" readonly>
											</div>
										</div>
										<div class="form-group row">
											<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Biaya mikro rutin/tahun</label>
											<div class="col-md-3 col-sm-3 col-xs-12">
												<input type="text" class="form-control" name="mikro_rutin_thn" id="mikro_rutin_thn" readonly>
											</div>
											<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Biaya analisa tahunan/sampel</label>
											<div class="col-md-3 col-sm-3 col-xs-12">
												<input type="text" class="form-control" value="{{$iddesc->biaya_analisa_tahun}}" name="biaya_analisa_tahunan" id="biaya_analisa_tahunan" readonly>
											</div>
										</div>
										<div class="form-group row">
											<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Biaya analisa tahunan/SKU</label>
											<div class="col-md-3 col-sm-3 col-xs-12">
												<input type="text" class="form-control" value="{{$iddesc->biaya_analisa_tahun}}" name="analisa_tahunan_sku" id="analisa_tahunan_sku" readonly>
											</div>
											<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Estimasi Biaya mikro analisa BB/batch</label>
											<div class="col-md-3 col-sm-3 col-xs-12">
												<input type="text" class="form-control" value="{{$iddesc->mikro_analisa}}" name="esimasi_mikro_analisa_batch" id="esimasi_mikro_analisa_batch" readonly>
											</div>
										</div>
										<div class="form-group row">
											<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Estimasi Biaya mikro analisa BB/tahun</label>
											<div class="col-md-3 col-sm-3 col-xs-12">
												<input type="text" class="form-control" name="esimasi_mikro_analisa_thn" id="esimasi_mikro_analisa_thn" readonly>
											</div>
											<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Estimasi biaya analisa swab/batch</label>
											<div class="col-md-3 col-sm-3 col-xs-12">
												<input type="text" class="form-control" value="{{$iddesc->analisa_swab}}" name="estimasi_analisa_swab" id="estimasi_analisa_swab" readonly>
											</div>
										</div>
										<div class="form-group row">
											<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Estimasi biaya analisa swab/tahun</label>
											<div class="col-md-3 col-sm-3 col-xs-12">
												<input type="text" class="form-control" name="analisa_swab_thn" id="analisa_swab_thn" readonly>
											</div>
											<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Estimasi biaya tahanan (resampling)/batch</label>
											<div class="col-md-3 col-sm-3 col-xs-12">
												<input type="text" class="form-control" value="{{$iddesc->biaya_tahanan}}" name="estimasi_tahanan_batch" id="estimasi_tahanan_batch" readonly>
											</div>
										</div>
										<div class="form-group row">
											<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Estimasi biaya tahanan (resampling/tahun)</label>
											<div class="col-md-3 col-sm-3 col-xs-12">
												<input type="text" class="form-control" name="estimasi_tahanan_thn" id="estimasi_tahanan_thn" readonly>
											</div>
											<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Estimasi biaya kimia/batch</label>
											<div class="col-md-3 col-sm-3 col-xs-12">
												<input type="text" class="form-control" value="{{$iddesc->kimia_batch}}" name="estimasi_kimia_batch" id="estimasi_kimia_batch" readonly>
											</div>
										</div>
										<div class="form-group row">
											<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Estimasi biaya analisa kimia/tahun</label>
											<div class="col-md-3 col-sm-3 col-xs-12">
												<input type="text" class="form-control" name="estimasi_kimia_thn" id="estimasi_kimia_thn" readonly>
											</div>
											<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Biaya total/SKU</label>
											<div class="col-md-3 col-sm-3 col-xs-12">
												<input type="text" class="form-control" name="biaya_total" id="biaya_total" readonly>
											</div>
										</div>
										<div class="form-group row">
											<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Biaya total analisa/batch</label>
											<div class="col-md-3 col-sm-3 col-xs-12">
												<input type="text" class="form-control" name="total_analisa" id="total_analisa" readonly>
											</div>
											<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Total Para x spl/batch</label>
											<div class="col-md-3 col-sm-3 col-xs-12">
												<input type="text" class="form-control" name="total_para_sample" id="total_para_sample" readonly>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- Selesai -->
						</div>
					</div>
        </section>
			</div>
    </div>
  </div>
</div>

@endsection
@section('s')
<link href="{{ asset('lib/advanced-datatable/css/jquery.dataTables.css') }}" rel="stylesheet" />
<script src="{{ asset('js/datatables.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {
      var total_batch                 = $( "#batch" ).val();
      var analisa_mikro_rutin         = $( "#analisa_mikro_rutin" ).val();
      var sample_mikro_batch          = $( "#sample_mikro_batch" ).val();
      var esimasi_mikro_analisa_batch = $( "#esimasi_mikro_analisa_batch" ).val();
      var estimasi_analisa_swab       = $( "#estimasi_analisa_swab" ).val();
      var estimasi_tahanan_batch      = $( "#estimasi_tahanan_batch" ).val();
      var estimasi_kimia_batch        = $( "#estimasi_kimia_batch" ).val();
      var para_sample_batch           = $( "#para_sample_batch" ).val();
      var sample_analisa_rutin        = $( "#sample_analisa_rutin" ).val();
      var biaya_analisa_tahunan       = $( "#biaya_analisa_tahunan" ).val();

      var biaya_mikro_rutin   = analisa_mikro_rutin * sample_mikro_batch;biaya_mikro_rutin = parseFloat(biaya_mikro_rutin.toFixed(3));
      var biaya_mikro_tahun   = biaya_mikro_rutin * total_batch;biaya_mikro_tahun = parseFloat(biaya_mikro_tahun.toFixed(3));
      var mikro_analisa_bb    = esimasi_mikro_analisa_batch * total_batch;mikro_analisa_bb = parseFloat(mikro_analisa_bb.toFixed(3));
      var swab_analisa_thn    = estimasi_analisa_swab * total_batch;swab_analisa_thn  = parseFloat(swab_analisa_thn.toFixed(3));
      var resampling_thn      = estimasi_tahanan_batch * total_batch;resampling_thn = parseFloat(resampling_thn.toFixed(3));
      var biaya_analisa_kimia = estimasi_kimia_batch * total_batch;biaya_analisa_kimia = parseFloat(biaya_analisa_kimia.toFixed(3));
      var nilai               = biaya_analisa_tahunan*1;
      var total_sku           = biaya_analisa_kimia + resampling_thn + swab_analisa_thn + mikro_analisa_bb + biaya_mikro_tahun + nilai;total_sku = parseFloat(total_sku.toFixed(3));
      var total_analisa       = total_sku / total_batch ;total_analisa = parseFloat(total_analisa.toFixed(3));
      var total_para          = (para_sample_batch*1) + (sample_analisa_rutin*1);
      
      $("#mikro_rutin_batch").val(biaya_mikro_rutin);
      $("#mikro_rutin_thn").val(biaya_mikro_tahun);
      $("#esimasi_mikro_analisa_thn").val(mikro_analisa_bb);
      $("#analisa_swab_thn").val(swab_analisa_thn);
      $("#estimasi_tahanan_thn").val(resampling_thn);
      $("#estimasi_kimia_thn").val(biaya_analisa_kimia);
      $("#biaya_total").val(total_sku);
      $("#total_analisa").val(total_analisa);
      $("#total_para_sample").val(total_para);
    })
</script>
@endsection