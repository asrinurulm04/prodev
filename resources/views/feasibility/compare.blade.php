@extends('layout.tempvv')
@section('title', 'Formula')
@section('content')

<div class="x_panel"> 
  <div class="x_panel">
    <div class="col-md-6"><h4><i class="fa fa-balance-scale" aria-hidden="true"> Compare</i></h4></div>
    <div class="col-md-6" align="right">
			@if($data=='PKP')<a href="{{route('destroyCompare',[$data,$project->id_project])}}" class="btn btn-sm btn-danger" type="button"><li class="fa fa-arrow-left"></li> Back</a> </td>
			@elseif($data=='PDF')<a href="{{route('destroyCompare',[$data,$project->pdf_id])}}" class="btn btn-sm btn-danger" type="button"><li class="fa fa-arrow-left"></li> Back</a> </td>@endif
    </div>
  </div>
	@if($data=='PKP')
	<form class="form-horizontal form-label-left" method="POST" action="{{ route('addcompare',$project->id_project) }}">
	@elseif($data=='PDF')
	<form class="form-horizontal form-label-left" method="POST" action="{{ route('addcompare',$project->pdf_id) }}">
	@endif
  <div class="form-group row">
  	<label class="control-label col-md-1 col-sm-1 col-xs-12">Compare</label>
		@if($data=='PKP')<input type="hidden" name="data" value="PKP">
		@elseif($data=='PDF')<input type="hidden" name="data" value="PDF">@endif
    <div class="col-md-3 col-sm-3 col-xs-12">
      <select name="fs1" id="fs1" class="form-control" required="required">
        <option disabled selected>-->Select One<--</option>
				@foreach($fs as $fs)
				<option value="{{$fs->id}}">{{$fs->revisi}}.{{$fs->revisi_proses}}.{{$fs->revisi_kemas}}.{{$fs->revisi_lab}}</option>
				@endforeach
      </select>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-12">
      <select name="fs2" id="fs2" class="form-control" required="required">
        <option disabled selected>-->Select One<--</option>
				@foreach($fs2 as $fs2)
				<option value="{{$fs2->id}}">{{$fs2->revisi}}.{{$fs2->revisi_proses}}.{{$fs2->revisi_kemas}}.{{$fs2->revisi_lab}}</option>
				@endforeach
      </select>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-12">
      <select name="fs3" id="fs3" class="form-control">
        <option disabled selected>-->Select One<--</option>
				@foreach($fs3 as $fs3)
				<option value="{{$fs3->id}}">{{$fs3->revisi}}.{{$fs3->revisi_proses}}.{{$fs3->revisi_kemas}}.{{$fs3->revisi_lab}}</option>
				@endforeach
      </select>
    </div>
		<div class="col-md-2 col-sm-2 col-xs-12">
			<button type="submit" class="btn btn-primary btn-sm"><li class="fa fa-balance-scale"></li> Compare FS</button>
			{{ csrf_field() }}
		</div>
  </div>
	</form>

  <div class="card-block">
    <div class="dt-responsive table-responsive"><br>
      <table class="table table-bordered">
				<thead>
					<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
						<th class="text-center" colspan="4">Project Overview</th>
					</tr>
					<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
						<th class="text-center" width="25%">Information</th>
						<th class="text-center" width="25%">Option 1</th>
						<th class="text-center" width="25%">Option 2</th>
						<th class="text-center" width="25%">Option 3</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th width="25%">Target Launching</th>
						@if($data=='PKP')<td colspan="3">{{$project->launch}} {{$project->years}}</td>
						@elseif($data=='PDF')<td colspan="3">{{$project->rto}}</td>@endif
					</tr>
					<tr>
						<th>Project Name</th>
						@if($data=='PKP')<td colspan="3">{{$project->project_name}}</td>
						@elseif($data=='PDF')<td colspan="3">{{$project->datapdf->project_name}}</td>@endif
					</tr>
					<tr>
						<th>Project Number</th>
						@if($data=='PKP')<td colspan="3">{{$project->pkp_number}}{{$project->ket_no}}</td>
						@elseif($data=='PDF')<td colspan="3">{{$project->datapdf->pdf_number}}{{$project->datapdf->ket_no}}</td>@endif
					</tr>
					<tr>
						<th>Product Name/Desc</th>
						@if($data=='PKP')<td colspan="3">{{$project->idea}}</td>
						@elseif($data=='PDF')<td colspan="3">{{$project->background}}</td>@endif
					</tr>
					@if($data=='PKP')
					<tr>
						<th>Product type (BPOM Category)</th>
						<td colspan="3">({{$project->katpangan->no_kategori}}) {{$project->katpangan->pangan}}</td>
					</tr>
					@endif
					<tr>
						<th>Packaging configuration</th>
						<td colspan="3">
							 @if($project->kemas_eksis!=NULL)(
                  @if($project->kemas->tersier!=NULL)
                  {{ $project->kemas->tersier }}{{ $project->kemas->s_tersier }}
                  @endif

                  @if($project->kemas->sekunder1!=NULL)
                  X {{ $project->kemas->sekunder1 }}{{ $project->kemas->s_sekunder1}}
                  @endif

                  @if($project->kemas->sekunder2!=NULL)
                  X {{ $project->kemas->sekunder2 }}{{ $project->kemas->s_sekunder2 }}
                  @endif

                  @if($project->kemas->primer!=NULL)
                  X{{ $project->kemas->primer }}{{ $project->kemas->s_primer }}
                  @endif )
                @endif
						</td>
					</tr>
					<tr>
						<th>Formula Code</th>
						<td>@if($cm1!=NULL){{$cm1->formula}}@endif</td>
						<td>@if($cm2!=NULL){{$cm2->formula}}@endif</td>
						<td>@if($cm3!=NULL){{$cm3->formula}}@endif</td>
					</tr>
					<tr>
						<th>Revisi Feasibility</th>
						<td>@if($cm1!=NULL){{$cm1->revisi}}.{{$cm1->revisi_proses}}.{{$cm1->revisi_kemas}}.{{$cm1->revisi_lab}}@endif</td>
						<td>@if($cm2!=NULL){{$cm2->revisi}}.{{$cm2->revisi_proses}}.{{$cm2->revisi_kemas}}.{{$cm2->revisi_lab}}@endif</td>
						<td>@if($cm3!=NULL){{$cm3->revisi}}.{{$cm3->revisi_proses}}.{{$cm3->revisi_kemas}}.{{$cm3->revisi_lab}}@endif</td>
					</tr>
					<tr>
						<th>Product reference :product characteristic</th>
						<td>@if($cm1!=NULL){{$cm1->product_reference}}@endif</td>
						<td>@if($cm2!=NULL){{$cm2->product_reference}}@endif</td>
						<td>@if($cm3!=NULL){{$cm3->product_reference}}@endif</td>
					</tr>
					<tr>
						<th>Product reference :packaging </th>
						<td>@if($cm1!=NULL) @foreach($kemas as $kemas) @if($kemas->id_feasibility==$cm1->fs1) {{$kemas->sku->nama_sku}} @endif @endforeach @endif</td>
						<td>@if($cm2!=NULL) @foreach($kemas2 as $kemas2) @if($kemas2->id_feasibility==$cm2->fs2) {{$kemas->sku->nama_sku}} @endif @endforeach @endif</td>
						<td>@if($cm3!=NULL) @foreach($kemas3 as $kemas3) @if($kemas3->id_feasibility==$cm3->fs3) {{$kemas->sku->nama_sku}} @endif @endforeach @endif</td>
					</tr>
					<tr>
						<th>Forecast (Rp/ month)</th>
						<td>@if($cm1!=NULL){{$cm1->forecast}}@endif</td>
						<td>@if($cm2!=NULL){{$cm2->forecast}}@endif</td>
						<td>@if($cm3!=NULL){{$cm3->forecast}}@endif</td>
					</tr>
					<tr>
						<th>Pricelist (Rp/ UOM)</th>
						@if($data=='PKP')
						<td>@if($cm1!=NULL){{$project->selling_price}}@endif</td>
						<td>@if($cm2!=NULL){{$project->selling_price}}@endif</td>
						<td>@if($cm3!=NULL){{$project->selling_price}}@endif</td>
						@elseif($data=='PDF')
						<td>@if($cm1!=NULL){{$project->target_price}}@endif</td>
						<td>@if($cm2!=NULL){{$project->target_price}}@endif</td>
						<td>@if($cm3!=NULL){{$project->target_price}}@endif</td>
						@endif
					</tr>
					<tr>
						<th>UoM</th>
						<td>@if($cm1!=NULL){{$cm1->uom}}@endif</td>
						<td>@if($cm2!=NULL){{$cm2->uom}}@endif</td>
						<td>@if($cm3!=NULL){{$cm3->uom}}@endif</td>
					</tr>
					<tr>
						<th>UoM per BOX</th>
						<td>@if($cm1!=NULL){{$cm1->uom_box}}@endif</td>
						<td>@if($cm2!=NULL){{$cm2->uom_box}}@endif</td>
						<td>@if($cm3!=NULL){{$cm3->uom_box}}@endif</td>
					</tr>
					<tr>
						<th>Gramasi per UOM (g)</th>
						<td>@if($cm1!=NULL){{$cm1->gramasi_uom}}@endif</td>
						<td>@if($cm2!=NULL){{$cm2->gramasi_uom}}@endif</td>
						<td>@if($cm3!=NULL){{$cm3->gramasi_uom}}@endif</td>
					</tr>
					<tr>
						<th>serving size (g)</th>
						<td>@if($cm1!=NULL){{$cm1->serving_size}}@endif</td>
						<td>@if($cm2!=NULL){{$cm2->serving_size}}@endif</td>
						<td>@if($cm3!=NULL){{$cm3->serving_size}}@endif</td>
					</tr>
					<tr>
						<th>serving/ UOM</th>
						<td>@if($cm1!=NULL){{$cm1->serving_uom}}@endif</td>
						<td>@if($cm2!=NULL){{$cm2->serving_uom}}@endif</td>
						<td>@if($cm3!=NULL){{$cm3->serving_uom}}@endif</td>
					</tr>
					<tr>
						<th>Batch size (g)</th>
						<td>@if($cm1!=NULL){{$cm1->batch_size}}@endif</td>
						<td>@if($cm2!=NULL){{$cm2->batch_size}}@endif</td>
						<td>@if($cm3!=NULL){{$cm3->batch_size}}@endif</td>
					</tr>
					<tr>
						<th>Batch size granulation (kg)</th>
						<td>@if($cm1!=NULL){{$cm1->batch_granulation}}@endif</td>
						<td>@if($cm2!=NULL){{$cm2->batch_granulation}}@endif</td>
						<td>@if($cm3!=NULL){{$cm3->batch_granulation}}@endif</td>
					</tr>
					<tr>
						<th>Yield (%)</th>
						<td>@if($cm1!=NULL){{$cm1->Yield}}@endif</td>
						<td>@if($cm2!=NULL){{$cm2->Yield}}@endif</td>
						<td>@if($cm3!=NULL){{$cm3->Yield}}@endif</td>
					</tr>
					<tr>
						<th>BOX per BATCH</th>
						<td>@if($cm1!=NULL){{$cm1->box_batch}}@endif</td>
						<td>@if($cm2!=NULL){{$cm2->box_batch}}@endif</td>
						<td>@if($cm3!=NULL){{$cm3->box_batch}}@endif</td>
					</tr>
					<tr>
						<th>UOM / month</th>
						<td>@if($cm1!=NULL){{$cm1->serving_uom}}@endif</td>
						<td>@if($cm2!=NULL){{$cm2->serving_uom}}@endif</td>
						<td>@if($cm3!=NULL){{$cm3->serving_uom}}@endif</td>
					</tr>
					<tr>
						<th>Batches/month</th>
						<td>@if($cm1!=NULL){{$cm1->serving_uom}}@endif</td>
						<td>@if($cm2!=NULL){{$cm2->serving_uom}}@endif</td>
						<td>@if($cm3!=NULL){{$cm3->serving_uom}}@endif</td>
					</tr>
					<tr>
						<th>Production Location</th>
						<td>
							@if($cm1!=NULL)
								@foreach($lokasi1 as $lokasi) @if($lokasi->id_feasibility==$cm1->fs1)* {{$lokasi->IO}} <br> @endif @endforeach
							@endif
						</td>
						<td>
							@if($cm2!=NULL)
								@foreach($lokasi1a as $lokasi) @if($lokasi->id_feasibility==$cm2->fs2)* {{$lokasi->IO}} <br> @endif @endforeach
							@endif
						</td>
						<td>
							@if($cm3!=NULL)
								@foreach($lokasi1b as $lokasi) @if($lokasi->id_feasibility==$cm3->fs3)* {{$lokasi->IO}} <br> @endif @endforeach
							@endif
						</td>
					</tr>
					<tr>
						<th>Fillpack Location</th>
						<td>
							@if($cm1!=NULL)
								@foreach($lokasi2 as $lokasi2) @if($lokasi2->id_feasibility==$cm1->fs1)* {{$lokasi2->IO}} <br> @endif @endforeach
							@endif
						</td>
						<td>
							@if($cm2!=NULL)
								@foreach($lokasi2a as $lokasi2) @if($lokasi2->id_feasibility==$cm2->fs2)* {{$lokasi2->IO}} <br> @endif @endforeach
							@endif
						</td>
						<td>
							@if($cm3!=NULL)
								@foreach($lokasi2b as $lokasi2) @if($lokasi2->id_feasibility==$cm3->fs3)* {{$lokasi2->IO}} <br> @endif @endforeach
							@endif
						</td>
					</tr>
					<tr>
						<th>Filling Machine</th>
						<td>
							@if($cm1!=NULL)
								@foreach($mesin as $mesin) @if($mesin->id_feasibility==$cm1->fs1)* {{$mesin->nama_mesin}} <br> @endif @endforeach
							@endif
						</td>
						<td>
							@if($cm2!=NULL)
								@foreach($mesin2 as $mesin) @if($mesin->id_feasibility==$cm2->fs2)* {{$mesin->nama_mesin}} <br> @endif @endforeach
							@endif
						</td>
						<td>
							@if($cm3!=NULL)
								@foreach($mesin3 as $mesin) @if($mesin->id_feasibility==$cm3->fs3)* {{$mesin->nama_mesin}} <br> @endif @endforeach
							@endif
						</td>
					</tr>
					<tr>
						<th>Cost of Packaging (Rp/UOM)</th>
						<td>
							@if($cm1!=NULL)
								@foreach($forKemas as $forKemas) 
									@if($forKemas->id==$cm1->fs1) 
										{{$forKemas->cost_uom}}
									@endif
								@endforeach
							@endif
						</td>
						<td>
							@if($cm2!=NULL)
								@foreach($forKemas2 as $forKemas2) 
									@if($forKemas2->id==$cm2->fs2) 
										{{$forKemas2->cost_uom}}
									@endif
								@endforeach
							@endif
						</td>
						<td>
							@if($cm3!=NULL)
								@foreach($forKemas3 as $forKemas3) 
									@if($forKemas3->id==$cm3->fs3) 
										{{$forKemas3->cost_uom}}
									@endif
								@endforeach
							@endif
						</td>
					</tr
					<tr>
						<th>Cost of Lab/Analysis (Rp/UOM)</th>
						<td>
							@if($cm1!=NULL)
								@foreach($datalab as $datalab) 
									@if($datalab->id_fs==$cm1->fs1) 
										{{(($datalab->kimia_batch * $cm1->batch) + ($datalab->biaya_tahanan * $cm1->batch) + ($datalab->analisa_swab * $cm1->batch) + ($datalab->mikro_analisa * $cm1->batch) + (($datalab->biaya_analisa * $datalab->jlh_sample_mikro)* $cm1->batch) + $datalab->biaya_analisa_tahun) / $cm1->batch }}
									@endif
								@endforeach
							@endif
						</td>
						<td>
							@if($cm2!=NULL)
								@foreach($datalab2 as $datalab2) 
									@if($datalab2->id_fs==$cm2->fs2) 
										{{(($datalab->kimia_batch * $cm2->batch) + ($datalab->biaya_tahanan * $cm2->batch) + ($datalab->analisa_swab * $cm2->batch) + ($datalab->mikro_analisa * $cm2->batch) + (($datalab->biaya_analisa * $datalab->jlh_sample_mikro)* $cm2->batch) + $datalab->biaya_analisa_tahun) / $cm2->batch }}
									@endif
								@endforeach
							@endif
						</td>
						<td>
							@if($cm3!=NULL)
								@foreach($datalab3 as $datalab3) 
									@if($datalab3->id_fs==$cm3->fs3) 
										{{(($datalab->kimia_batch * $cm3->batch) + ($datalab->biaya_tahanan * $cm3->batch) + ($datalab->analisa_swab * $cm3->batch) + ($datalab->mikro_analisa * $cm3->batch) + (($datalab->biaya_analisa * $datalab->jlh_sample_mikro)* $cm3->batch) + $datalab->biaya_analisa_tahun) / $cm3->batch }}
									@endif
								@endforeach
							@endif
						</td>
					</tr>
					<tr>
						<th>Maklon Fee (Rp/UOM)</th>
						<td>@if($cm1!=NULL){{$cm1->biaya_maklon}}@endif</td>
						<td>@if($cm2!=NULL){{$cm2->biaya_maklon}}@endif</td>
						<td>@if($cm3!=NULL){{$cm3->biaya_maklon}}@endif</td>
					</tr>
					<tr>
						<th>Transportation Fee (Rp/UOM)</th>
						<td>@if($cm1!=NULL){{$cm1->biaya_transport}}@endif</td>
						<td>@if($cm2!=NULL){{$cm2->biaya_transport}}@endif</td>
						<td>@if($cm3!=NULL){{$cm3->biaya_transport}}@endif</td>
					</tr>
					<tr>
						<th>Allergen information | contain</th>
						<td>@if($cm1!=NULL) @foreach($all as $all) @if($all->id_feasibility==$cm1->fs1) {{$all->allergen_baru}} @endif @endforeach @endif</td>
						<td>@if($cm2!=NULL) @foreach($all2 as $all2) @if($all2->id_feasibility==$cm2->fs2) {{$all2->allergen_baru}} @endif @endforeach @endif</td>
						<td>@if($cm3!=NULL) @foreach($all3 as $all3) @if($all3->id_feasibility==$cm3->fs3) {{$all3->allergen_baru}} @endif @endforeach @endif</td>
					</tr>
					<tr>
						<th>Allergen information | may contain (from the production line)</th>
						<td>@if($cm1!=NULL) @foreach($all4 as $all4) @if($all4->id_feasibility==$cm1->fs1) {{$all4->my_contain}} @endif @endforeach @endif</td>
						<td>@if($cm2!=NULL) @foreach($all5 as $all5) @if($all5->id_feasibility==$cm2->fs2) {{$all5->my_contain}} @endif @endforeach @endif</td>
						<td>@if($cm3!=NULL) @foreach($all6 as $all6) @if($all6->id_feasibility==$cm3->fs3) {{$all6->my_contain}} @endif @endforeach @endif</td>
					</tr>
					<tr>
						<th>Allergen impact to production line</th>
						<td>@if($cm1!=NULL) @foreach($all7 as $all7) @if($all7->id_feasibility==$cm1->fs1) {{$all7->lini_terdampak}} @endif @endforeach @endif</td>
						<td>@if($cm2!=NULL) @foreach($all8 as $all8) @if($all8->id_feasibility==$cm2->fs2) {{$all8->lini_terdampak}} @endif @endforeach @endif</td>
						<td>@if($cm3!=NULL) @foreach($all9 as $all9) @if($all9->id_feasibility==$cm3->fs3) {{$all9->lini_terdampak}} @endif @endforeach @endif</td>
					</tr>
					<tr>
						<th>New Raw Material?</th>
						<td>@if($cm1!=NULL){{$cm1->new_raw_material}}@endif</td>
						<td>@if($cm2!=NULL){{$cm2->new_raw_material}}@endif</td>
						<td>@if($cm3!=NULL){{$cm3->new_raw_material}}@endif</td>
					</tr>
					<tr>
						<th>Value of Unprocessed Raw Material per year</th>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<th>New Packaging Material?</th>
						<td>@if($cm1!=NULL){{$cm1->new_packaging_material}}@endif</td>
						<td>@if($cm2!=NULL){{$cm2->new_packaging_material}}@endif</td>
						<td>@if($cm3!=NULL){{$cm3->new_packaging_material}}@endif</td>
					</tr>
					<tr>
						<th>Value of Unprocessed Packaging Material</th>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<th>New Machine?</th>
						<td>@if($cm1!=NULL){{$cm1->new_machine}}@endif</td>
						<td>@if($cm2!=NULL){{$cm2->new_machine}}@endif</td>
						<td>@if($cm3!=NULL){{$cm3->new_machine}}@endif</td>
					<tr>
						<th>Need Trial before real packaging?</th>
						<td>@if($cm1!=NULL){{$cm1->trial}}@endif</td>
						<td>@if($cm2!=NULL){{$cm2->trial}}@endif</td>
						<td>@if($cm3!=NULL){{$cm3->trial}}@endif</td>
					</tr>
					<tr>
						<th>Reff EKP</th>
						<td>@if($cm1!=NULL){{$cm1->ref_ekp}}@endif</td>
						<td>@if($cm2!=NULL){{$cm2->ref_ekp}}@endif</td>
						<td>@if($cm3!=NULL){{$cm3->ref_ekp}}@endif</td>
					</tr>
					<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
						<th colspan="4">1. Seluruh runtime yang digunakan mengacu pada standar perhitungan costing, kecuali distate lain. Misal : runtime mixer meliput charging-discharge, tidak hanya mixing</th>
					</tr>
					<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
						<th colspan="4">2. Jumlah SDM  yang digunakan tiap proses mengacu pada standar, kecuali distate lain</th>
					</tr>
				</tbody>
			</table>
    </div>
  </div>
</div>
@endsection