@extends('admin.tempadmin')

@section("content")
<div class="row">
	<div class="col-md-14">
		<div class="showback">
			<div class="row">
			  <div class="col-md-6"><h4><i class="fa fa-cube"></i> Data BTP Carry Over</h4> </div>
			  <div class="col-md-6 text-right"><h5><i class="fa fa-home"></i> / <a href="{{url('/databtp')}}">Data BTP Carry Over</a></h5></div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="showback" style="border-radius:3px;">
			<a href="{{url('inputbtp')}}" class="btn btn-primary"><i class="fa fa-plus"></i> &nbsp Tambah</a><br><br>
			<table class="table table-hover table-bordered" id="Table">
				<thead>
					<tr>
						<th class="text-center" style="width: 5%;">No</th>
						<th class="text-center">Bahan Baku</th>
			            <th class="text-center">Nama Sederhana</th>
			            <th class="text-center">Nama Bahan di Form B</th>
			            <th class="text-center">BTP Carry Over</th>
			            <th class="text-center">Wajib dicantum</th>
			            <th class="text-center">Aksi</th>
					</tr>
				</thead>
				<tr>
					<td class="text-center"></td>
					<td class="text-center"></td>
					<td class="text-center"></td>
					<td class="text-center"></td>
					<td class="text-center"></td>
					<td class="text-center"></td>
		            <td class="text-center">
		                <a href="{{url('editbtp/'.$data->id_btp)}}"  class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
	                    <a href="{{url('hapusbtp/'.$data->id_btp)}}" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="hapus"><i class="fa fa-trash"></i></a> 
		            </td>
				</tr>
			</table>
		</div>
	</div>
</div>
@endsection