@extends('admin.tempadmin')

@section('content')
<div class="row">
	<div class="col-md-14">
		<div class="showback">
			<div class="row">
			  <div class="col-md-6"><h4><i class="fa fa-cube"></i> Data Nutfact</h4> </div>
			  <div class="col-md-6 text-right"><h5><i class="fa fa-home"></i> / <a href="{{url('/datanut')}}">Data Nutfact</a></h5></div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="showback" style="border-radius:3px;">
			<table class="table table-hover table-bordered table-responsive" id="Table">
				<thead>
					<tr>
						<th class="text-center" style="width: 5%;">No</th>
						<th class="text-center">Nama Produk</th>
						<th class="text-center">Jenis Produk</th>
						<th class="text-center">Tanggal di buat</th>
						<th class="text-center">Aksi</th>
					</tr>
				</thead>
					<tr>
						<td class="text-center"></td>
						<td class="text-center"></td>
						<td class="text-center"></td>
						<td class="text-center"></td>
						<td class="text-center">
							<div class="btn-group">
								<a href="" class="btn btn-info"><i class="fa fa-search"></i></a>
								<a href="#" class="btn btn-danger btnHapus"><i class="fa fa-trash"></i></a>
							</div>
						</td>
					</tr>
			</table>
		</div>
	</div>
</div>
@endsection