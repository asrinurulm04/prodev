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
				<a href="{{route('download_fs',[$pkp->id_project,$form->id_feasibility])}}" class="btn btn-warning btn-sm" type="button"><li class="fa fa-upload"></li> export excel</a>
				@if(auth()->user()->role->namaRule == 'pv_lokal')
				<a class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Kemabali" href="{{route('PengajuanFS_PKP',[$pkp->id_project,$formula->id])}}"><i class="fa fa-arrow-left"></i> Back</a>
				@elseif(auth()->user()->role->namaRule != 'pv_lokal')
				<a class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Kemabali" href="{{route('listPkpFs',$pkp->id_project)}}"><i class="fa fa-arrow-left"></i> Back</a>
				@endif
			</div>
		</div>
    <div class="row">
			<div class="col-md-10">
				<table>
					<tr><th width="15%">No.PKP</th><th width="45%">: {{$pkp->pkp_number}}{{$pkp->ket_no}}</th>
					<tr><th width="15%">Brand</th><th width="45%">: {{$pkp->id_brand}}</th>
					<tr><th width="15%">Idea</th><th width="45%">: {{$pkp->idea}}</th></tr>
					<tr><th width="15%">Formula</th><th width="45%">: {{$formula->formula}}</th></tr>
				</table>
			</div>
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
						<td></td>
					</tr>
					<tr>
						<th>New Packaging Material?</th>
						<td>{{$form->new_packaging_material}}</td>
					</tr>
					<tr>
						<th>Value of Unprocessed Packaging Material</th>
						<td></td>
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

@endsection
@section('s')
<link href="{{ asset('lib/advanced-datatable/css/jquery.dataTables.css') }}" rel="stylesheet" />
<script src="{{ asset('js/datatables.min.js')}}"></script>
@endsection