@extends('layout.tempvv')
@section('title', 'Workbook | Feasibility')
@section('content')

<div class="x_panel">
  <div class="x_title">
		<div class="row">
			<div class="col-md-11">
    		<h3><li class="fa fa-list"> Informasi Revisi </li></h3><hr>
			</div>
			<div class="col-md-1">
				@if($info=='PKP')
				<a class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Kemabali" href="{{route('listPkpFs',$project->id_project)}}"><i class="fa fa-arrow-left"></i> Back</a></th></tr>
				@elseif($info=='PDF')
				<a class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Kemabali" href="{{route('listPdfFs',$project->pdf_id)}}"><i class="fa fa-arrow-left"></i> Back</a></th></tr>
				@endif
			</div>
		</div>
    <div class="row">
			<div class="col-md-10">
				<table>
					@if($info=='PKP')
					<tr><th width="15%">PKP Number</th><th width="45%">: {{$project->pkp_number}}{{$project->ket_no}}</th>
					<tr><th width="15%">Idea</th><th width="45%">: {{$project->idea}}</th></tr>
					<tr><th width="15%">Brand</th><th width="45%">: {{$project->id_brand}}</th>
					@elseif($info=='PDF')
					<tr><th width="15%">PDF Number</th><th width="45%">: {{$project->datapdf->pdf_number}}{{$project->datapdf->ket_no}}</th>
					<tr><th width="15%">Idea</th><th width="45%">: {{$project->background}}</th></tr>
					<tr><th width="15%">Brand</th><th width="45%">: {{$project->datapdf->id_brand}}</th>
					@endif
				</table>
			</div>
		</div>
  </div>
  <div class="card-block">
    <div class="dt-responsive table-responsive"><br>
      <table id="datatable" class="table table-striped table-bordered">
        <thead>
          <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
						<th class="text-center" width="5%">#</th>
            <th class="text-center" width="8%">Revision</th>
            <th class="text-center" width="15%">Name</th>
            <th class="text-center" width="25%">Note</th>
            <th class="text-center" width="15%">Update Date</th>
            <th class="text-center" width="25%">Info</th>
          </tr>
        </thead>
        <tbody>
					@php $no = 0; @endphp
					@foreach($report as $report)
					<tr>
						<td class="text-center">{{++$no}}</td>
            <td class="text-center">
              {{$report->revisi}}.
              @if($report->revisi_proses!=NULL) {{$report->revisi_proses}}.
              @elseif($report->revisi_proses==NULL) X.
              @endif

              @if($report->revisi_kemas!=NULL) {{$report->revisi_kemas}}.
              @elseif($report->revisi_kemas==NULL) X.
              @endif

              @if($report->revisi_lab!=NULL) {{$report->revisi_lab}}
              @elseif($report->revisi_lab==NULL) X
              @endif
            </td>
						<td>{{$report->user->name}}</td>
						<td>{{$report->Note}}</td>
						<td>{{$report->update_date}}</td>
						<td>
							@if($report->kemas=='yes') <input type="checkbox" checked disabled> Kemas <br>
							@elseif($report->kemas=='no') <input type="checkbox" disabled> Kemas <br>
							@endif 
							
							@if($report->proses=='yes') <input type="checkbox" checked disabled> Proses <br>
							@elseif($report->proses=='no') <input type="checkbox" disabled> Proses <br>
							@endif
							
							@if($report->lab=='yes') <input type="checkbox" checked disabled> Lab <br>
							@elseif($report->lab=='no') <input type="checkbox" disabled> Lab <br>
							@endif
							
							@if($report->maklon=='yes') <input type="checkbox" checked disabled> Maklon <br>
							@elseif($report->maklon=='no') <input type="checkbox" disabled> Maklon <br>
							@endif
						</td>
					</tr>
					@endforeach
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