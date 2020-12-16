@extends('feasibility.tempfeasibility')
@section('title', 'Workbook | Feasibility')
@section('judulnya', 'List Feasibility')
@section('content')

@if (session('status'))
<div class="row">
  <div class="col-md-12">
    <div class="alert alert-success" style="margin:20px">
      <button type="button" class="close" data-dismiss="alert">×</button>
      {{ session('status') }}
    </div>
  </div>
</div>
@endif

<div class="x_panel">
  <div class="x_title">
    @if(auth()->user()->role->namaRule === 'kemas')
    <h3><li class="fa fa-list"> List Workbook Kemas</li></h3><hr>
    @elseif(auth()->user()->role->namaRule === 'lab')
    <h3><li class="fa fa-list"> List Workbook Lab</li></h3><hr>
    @elseif(auth()->user()->role->namaRule === 'maklon')
    <h3><li class="fa fa-list"> List Workbook Maklon</li></h3><hr>
    @endif
    <div class="row">
			<div class="col-md-5">
				<table>
					<tr><th width="15%">Nama Produk </th><th width="45%">: {{ $myFormula->datapkpp->project_name}}</th>
					<tr><th width="15%">Tanggal Terima</th><th width="45%">: {{ $myFormula->updated_at }}</th>
					<tr><th width="15%">No.PKP</th><th width="45%">: {{ $myFormula->datapkpp->pkp_number }}{{$myFormula->datapkpp->ket_no}}</th>
					<tr><th width="15%">Idea</th><th width="45%">: {{ $myFormula->idea }}</th></tr>
				</table>
			</div>
			<div class="col-md-5">
				<table>
					<tr><th width="15%">Brand </th><th width="45%">: {{ $myFormula->datapkpp->id_brand}}</th>
					<tr><th width="15%">Packaging Concept</th><th width="45%">: 
						@if($myFormula->kemas_eksis!=NULL)
            
							@if($myFormula->kemas->tersier!=NULL)
							{{ $myFormula->kemas->tersier }}{{ $myFormula->kemas->s_tersier }}
							@elseif($myFormula->tersier==NULL)
							@endif

							@if($myFormula->kemas->sekunder1!=NULL)
							X {{ $myFormula->kemas->sekunder1 }}{{ $myFormula->kemas->s_sekunder1}}
							@elseif($myFormula->kemas->sekunder1==NULL)
							@endif

							@if($myFormula->kemas->sekunder2!=NULL)
							X {{ $myFormula->kemas->sekunder2 }}{{ $myFormula->kemas->s_sekunder2 }}
							@elseif($myFormula->sekunder2==NULL)
							@endif

							@if($myFormula->kemas->primer!=NULL)
							X{{ $myFormula->kemas->primer }}{{ $myFormula->kemas->s_primer }}
							@elseif($myFormula->kemas->primer==NULL)
							@endif
            
            @elseif($myFormula->primer==NULL)
            @endif
					</th>
					<tr><th width="15%">Target konsumen</th><th width="45%">: {{ $myFormula->tarkon->tarkon }}</th>
					<tr><th width="15%">Formula</th><th width="45%">: </th></tr>
				</table>
			</div>
			<div class="col-md-2">
				<table>
					<tr><th>
					@if(auth()->user()->role->namaRule === 'kemas')
						@if($hitungkemas==0)
						<a class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="tambah Data" href="{{ route('workbook.kemas',$for->id_formula) }}"><li class="fa fa-plus"></li> Add Kemas</a>
						@endif
					@elseif(auth()->user()->role->namaRule === 'lab')
						@if($hitunglab==0)
						<a class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="tambah Data" href="{{ route('workbook.lab',$for->id_formula) }}"><li class="fa fa-plus"></li> Add Lab</a>
						@endif
					@elseif(auth()->user()->role->namaRule === 'maklon')
						@if($hitungmaklon==0)
						<a class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="tambah Data" href="{{ route('workbook.maklon',$for->id_formula) }}"><li class="fa fa-plus"></li> Add Maklon</a>
						@endif
					@endif
					@if(auth()->user()->role->namaRule === 'kemas')
					<a class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Kemabali" href="{{ route('rekappkp',$myFormula->id_pkp) }}"><i class="fa fa-ban"></i> Cencel</a></th></tr>
					@elseif(auth()->user()->role->namaRule != 'kemas')
						@if(auth()->user()->role->namaRule != 'pv_global' && auth()->user()->role->namaRule != 'pv_lokal')
						<a class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Kemabali" href="{{ route('rekappkp',$myFormula->id_pkp) }}"><i class="fa fa-ban"></i> Cencel</a></th></tr>
						@elseif(auth()->user()->role->namaRule == 'pv_global' || auth()->user()->role->namaRule == 'pv_lokal')
						<a class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Kemabali" href="{{ route('rekappkp',$myFormula->id_pkp) }}"><i class="fa fa-ban"></i> Cencel</a></th></tr>
						@endif
					@endif
				</table>
			</div>
		</div>
  </div>
  <div class="card-block">
    <div class="dt-responsive table-responsive"><br>
      <table id="multi-colum-dt" class="Table table-striped table-bordered nowrap">
        <thead>
          <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
            <th class="text-center" width="5%">Versi</th>
						@if(auth()->user()->role->namaRule == 'kemas')
            <th class="text-center">Status Kemas</th>
						@elseif(auth()->user()->role->namaRule == 'lab')
            <th class="text-center">Status Lab</th>
						@elseif(auth()->user()->role->namaRule == 'maklon')
            <th class="text-center">Status Maklon</th>
						@endif
            <th class="text-center" width="45%">Note</th>
            <th class="text-center" width="15%">Action</th>
          </tr>
        </thead>
        <tbody>
				@if(auth()->user()->role->namaRule == 'kemas')
					@foreach($datakemas as $kemas)
					<tr>
						<td class="text-center">{{$kemas->revisi}}.{{$kemas->turunan}}</td>
						<td>{{$kemas->status}}</td>
						<td>{{$kemas->note}}</td>
						<td class="text-center">
							<a href="" class="btn btn-primary btn-sm" title="Edit"><li class="fa fa-edit"></li></a>
							<button class="btn btn-success btn-sm" title="Update"><li class="fa fa-arrow-circle-up"></li></button>
							<a href="" class="btn btn-dark btn-sm" title="Sent"><li class="fa fa-paper-plane"></li></a>
						</td>
					</tr>
					@endforeach
				@elseif(auth()->user()->role->namaRule == 'lab')
					@foreach($datalab as $lab)
					<tr>
						<td class="text-center">{{$lab->revisi}}.{{$lab->turunan}}</td>
						<td>{{$lab->status}}</td>
						<td>{{$lab->note}}</td>
						<td class="text-center">
							<a href="{{ route('datalab',[$lab->id_formula,$lab->id_wb_lab]) }}" class="btn btn-primary btn-sm" title="Edit"><li class="fa fa-edit"></li></a>
							<button class="btn btn-success btn-sm" title="Update"><li class="fa fa-arrow-circle-up"></li></button>
							<a href="" class="btn btn-dark btn-sm" title="Sent"><li class="fa fa-paper-plane"></li></a>
						</td>
					</tr>
					@endforeach
				@elseif(auth()->user()->role->namaRule == 'maklon')
					@foreach($datamaklon as $maklon)
					<tr>
						<td class="text-center">{{$maklon->revisi}}.{{$maklon->turunan}}</td>
						<td>{{$maklon->status}}</td>
						<td>{{$maklon->note}}</td>
						<td class="text-center">
							<a href="" class="btn btn-primary btn-sm" title="Edit"><li class="fa fa-edit"></li></a>
							<button class="btn btn-success btn-sm" title="Update"><li class="fa fa-arrow-circle-up"></li></button>
							<a href="" class="btn btn-dark btn-sm" title="Sent"><li class="fa fa-paper-plane"></li></a>
						</td>
					</tr>
					@endforeach
				@endif
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection