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
					<div class="tab-content ">
						<div class="tab-content ">
							<!-- Overview -->
							<div class="tab-pane active">
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