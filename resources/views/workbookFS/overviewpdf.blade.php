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
				<a href="{{route('download_fs_pdf',[$form->id_feasibility,$fs->id_wb_proses,$fs->id_wb_kemas])}}" class="btn btn-warning btn-sm" type="button"><li class="fa fa-upload"></li> export excel</a>
				@if(auth()->user()->role->namaRule == 'pv_global')
				<a class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Kemabali" href="{{route('PengajuanFS_PDF',[$pdf->id_project_pdf,$formula->id])}}"><i class="fa fa-arrow-left"></i> Back</a>
				@elseif(auth()->user()->role->namaRule != 'pv_global')
				<a class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Kemabali" href="{{route('listPdfFs',$pdf->id_project_pdf)}}"><i class="fa fa-arrow-left"></i> Back</a>
				@endif
			</div>
		</div>
    <div class="row">
			<div class="x_panel">
        <div class="col-md-5">
          <table>
            <thead>
              <tr><th>Brand</th><td> : {{$pdf->id_brand}}</td></tr>
              <tr><th width="25%">PDf Number</th><td> : {{$pdf->pdf_number}}{{$pdf->ket_no}}</td></tr>
              <tr><th>Status</th><td> : {{$pdf->status_pdf}}</td></tr>
              <tr><th>Created</th><td> : {{$pdf->created_date}}</td></tr>
            </thead>
          </table>
        </div>
        <div class="col-md-7">
          <table>
            <thead>
              <tr><th>Background</td> <td> : {{$pdf->background}}</td></tr>
              <tr><th>Configuration</th><td>: 
                @if($pdf->kemas_eksis!=NULL)(
                  @if($pdf->kemas->tersier!=NULL)
                  {{ $pdf->kemas->tersier }}{{ $pdf->kemas->s_tersier }}
                  @endif

                  @if($pdf->kemas->sekunder1!=NULL)
                  X {{ $pdf->kemas->sekunder1 }}{{ $pdf->kemas->s_sekunder1}}
                  @endif

                  @if($pdf->kemas->sekunder2!=NULL)
                  X {{ $pdf->kemas->sekunder2 }}{{ $pdf->kemas->s_sekunder2 }}
                  @endif

                  @if($pdf->kemas->primer!=NULL)
                  X{{ $pdf->kemas->primer }}{{ $pdf->kemas->s_primer }}
                  @endif )
                @endif
              </td></tr>
              <tr><th width="25%">RTO</th><td>: {{$pdf->rto}}</td></tr>
              <tr><th>Sample Deadline</th><td>: {{$pdf->jangka}}-  {{$pdf->waktu}}</td></tr>
            </thead>
          </table>
        </div>
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
						<th width="40%">Project Name</th>
						<td>{{$pdf->project_name}}</td>
					</tr>
					<tr>
						<th>Product Name/Desc</th>
						<td>{{$pdf->background}}</td>
					</tr>
					<tr>
						<th>Formula Code</th>
						<td>{{$formula->formula}}</td>
					</tr>
					<tr>
						<th>Packaging configuration</th>
						<td>
							 @if($pdf->kemas_eksis!=NULL)(
                  @if($pdf->kemas->tersier!=NULL)
                 	{{ $pdf->kemas->tersier }}{{ $pdf->kemas->s_tersier }}
                  @endif

                  @if($pdf->kemas->sekunder1!=NULL)
                  X {{ $pdf->kemas->sekunder1 }}{{ $pdf->kemas->s_sekunder1}}
                  @endif

                  @if($pdf->kemas->sekunder2!=NULL)
                  X {{ $pdf->kemas->sekunder2 }}{{ $pdf->kemas->s_sekunder2 }}
                  @endif

                  @if($pdf->kemas->primer!=NULL)
                  X{{ $pdf->kemas->primer }}{{ $pdf->kemas->s_primer }}
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
						<td>{{$kemas->referensi}}</td>
					</tr>
					<tr>
						<th>Forecast (Rp/ month)</th>
						<td>{{$form->forecast}}</td>
					</tr>
					<tr>
						<th>Pricelist (Rp/ UOM)</th>
						<td>{{$form->Pricelist}}</td>
					</tr>
					<tr>
						<th>UoM</th>
						<td>{{$form->uom}}</td>
					</tr>
					<tr>
						<th>UoM per BOX</th>
						<td>{{ $pdf->kemas->tersier }}</td>
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
						<td></td>
					</tr>
					<tr>
						<th>Allergen impact to production line</th>
						<td>{{$all->lini_terdampak}}</td>
						<td></td>
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

@endsection
@section('s')
<link href="{{ asset('lib/advanced-datatable/css/jquery.dataTables.css') }}" rel="stylesheet" />
<script src="{{ asset('js/datatables.min.js')}}"></script>
@endsection