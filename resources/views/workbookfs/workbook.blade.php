@extends('layout.tempvv')
@section('title', 'Workbook | Feasibility')
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
		<div class="row">
			<div class="col-md-10">
    		<h3><li class="fa fa-list"> List Workbook Kemas</li></h3><hr>
			</div>
			<div class="col-md-2">
				@if($ws=='0')
				<a class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="tambah Data" href=""><li class="fa fa-plus"></li> Add</a>
				@endif
				<a class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Kemabali" href="{{route('listPkpFs',$pkp->id_project)}}"><i class="fa fa-arrow-left"></i> Back</a></th></tr>
			</div>
		</div>
    <div class="row">
			<div class="col-md-10">
				<table>
					<tr><th width="15%">No.PKP</th><th width="45%">: {{$pkp->pkp_number}}{{$pkp->ket_no}}</th>
					<tr><th width="15%">Brand</th><th width="45%">: {{$pkp->id_brand}}</th>
					<tr><th width="15%">Idea</th><th width="45%">: {{$pkp->idea}}</th></tr>
				</table>
			</div>
		</div>
  </div>
  <div class="card-block">
    <div class="dt-responsive table-responsive"><br>
      <table id="datatable" class="table table-striped table-bordered">
        <thead>
          <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
            <th class="text-center" width="5%">Versi</th>
            <th class="text-center" width="25%">Name</th>
            <th class="text-center" width="25%">Note</th>
            <th class="text-center" width="25%">Status</th>
            <th class="text-center" width="15%">Action</th>
          </tr>
        </thead>
        <tbody>
					@foreach($list as $list)
					<tr>
						<td class="text-center">{{$list->opsi}}</td>
						<td>{{$list->name}}</td>
						<td>{{$list->note}}</td>
						<td>{{$list->status}}</td>
						<td class="text-center">
							<a href="" class="btn btn-primary btn-sm" title="Edit"><li class="fa fa-edit"></li></a>
							<button class="btn btn-success btn-sm" title="Update"><li class="fa fa-arrow-circle-up"></li></button>
							<button class="btn btn-dark btn-sm" data-toggle="modal" data-target="#sent" title="Up"><i class="fa fa-paper-plane"></i></a></button>
						</td>
					</tr>
					@endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>


<!-- modal -->
<div class="modal" id="sent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">                 
        <h3 class="modal-title" id="exampleModalLabel">Sent
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button></h3>
      </div>
      <div class="modal-body">
        <div class=" row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <Table class="table table-bordered">
							<thead>
								<th class="text-center" width="12%">Revisi</th>
								<th class="text-center" width="75%">Note</th>
								<th class="text-center" width="13%">Action</th>
							</thead>
							<tbody>
								@foreach($fs as $fs)
								<tr>
									<td class="text-center">{{$fs->revisi}}.{{$fs->revisi_kemas}}.{{$fs->revisi_proses}}.{{$fs->revisi_produk}}</td>
									<td>{{$fs->note}}</td>
									<td class="text-center"><a href="" class="btn btn-sm btn-primary" type="button"><li class="fa fa-check"></li> Tetapkan</a></td>
								</tr>
								@endforeach
							</tbody>
						</Table>
          </div>
        </div><br>
      </div>
    </div>
  </div>
</div>
<!-- Modal Selesai -->

@endsection
@section('s')
<link href="{{ asset('lib/advanced-datatable/css/jquery.dataTables.css') }}" rel="stylesheet" />
<script src="{{ asset('js/datatables.min.js')}}"></script>
@endsection