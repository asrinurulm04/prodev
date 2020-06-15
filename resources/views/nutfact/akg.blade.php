@extends('admin.tempadmin')

@section('content')
<div class="row">
	<div class="col-md-14">
		<div class="showback">
			<div class="row">
			  <div class="col-md-6"><h4><i class="fa fa-cube"></i> Data AKG</h4> </div>
			  <div class="col-md-6 text-right"><h5><i class="fa fa-home"></i> / <a href="{{url('/akg')}}">Data Parameter</a></h5></div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="showback" style="border-radius:3px;">
			<a href="{{url('inputp')}}" class="btn btn-primary"><i class="fa fa-plus"></i> &nbsp Tambah</a><br><br>
			<table class="table table-hover table-bordered table-condensed" id="Table">
				<thead>
					<tr>
						<th class="text-center" style="width: 5%;">No</th>
						<th class="text-center">Zat GIzi</th>
						<th class="text-center">Taget Konsumen</th>
						<th class="text-center">Nilai</th>
						<th class="text-center">Satuan</th>
						<th class="text-center">Keterangan</th>
						<th class="text-center">Aksi</th>
					</tr>
				</thead>
				@foreach($tampilkan as $data)
				<tr>
					<td class="text-center">{{$loop->iteration}}</td>
					<td class="text-center">{{$data->zat_gizi}}</td>
					<td class="text-center">{{$data->get_tarkon->tarkon}}</td>
					<td class="text-center">{{$data->nilai}}</td>
					<td class="text-center">{{$data->satuan}}</td>
					<td class="text-center">{{$data->keterangan}}</td>
					<td class="text-center">
						<a href="{{ url('editparameter/'.$data->id_p)}}"  class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
            			<a href="{{ url('hapus/'.$data->id_p) }}" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash"></i></a>	
					</td>
				</tr>
				@endforeach
      		</table>
    	</div>
	</div>
</div>
@endsection