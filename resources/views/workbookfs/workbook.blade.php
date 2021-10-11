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
    <h3><li class="fa fa-list"> List Workbook Kemas</li></h3><hr>
    <div class="row">
			<div class="col-md-5">
				<table>
					<tr><th width="15%">Nama Produk </th><th width="45%">: </th>
					<tr><th width="15%">Tanggal Terima</th><th width="45%">: </th>
					<tr><th width="15%">No.PKP</th><th width="45%">:</th>
					<tr><th width="15%">Idea</th><th width="45%">:</th></tr>
				</table>
			</div>
			<div class="col-md-5">
				<table>
					<tr><th width="15%">Brand </th><th width="45%">: </th>
					<tr><th width="15%">Packaging Concept</th><th width="45%">: 
					</th>
					<tr><th width="15%">Target konsumen</th><th width="45%">: </th>
					<tr><th width="15%">Formula</th><th width="45%">: </th></tr>
				</table>
			</div>
			<div class="col-md-2">
				<table>
					<tr><th>
						<a class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="tambah Data" href=""><li class="fa fa-plus"></li> Add Kemas</a>
						<a class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Kemabali" href=""><i class="fa fa-ban"></i> Cencel</a></th></tr>
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
            <th class="text-center" width="45%">Note</th>
            <th class="text-center" width="15%">Action</th>
          </tr>
        </thead>
        <tbody>
					<tr>
						<td class="text-center"></td>
						<td></td>
						<td></td>
						<td class="text-center">
							<a href="" class="btn btn-primary btn-sm" title="Edit"><li class="fa fa-edit"></li></a>
							<button class="btn btn-success btn-sm" title="Update"><li class="fa fa-arrow-circle-up"></li></button>
							<a href="" class="btn btn-dark btn-sm" title="Sent"><li class="fa fa-paper-plane"></li></a>
						</td>
					</tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection