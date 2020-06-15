@extends('admin.tempadmin')

@section('content')
<div  class="row">
  <div class="col-md-20">
    <div class="showback">
      <div class="row">
        <div class="col-md-6"><h4><i class="fa fa-search"></i> Pencarian Data Parameter</h4> </div>
        <div class="col-md-6 text-right"><h5><i class="fa fa-home"></i> / <a href="{{url('/pencariandatacemaran')}}">Pencemaran Data Parameter</a></h5></div>
      </div>
    </div>
  </div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="showback" style="border-radius:3px;">
			<a href="{{url('/datap')}}" class="btn btn-danger"><i class="fa fa-arrow-left"> Kembali</i></a><br><br>
			<table class="js-dynamitable table table-bordered table-hover">
				<thead>
					<tr>
		                <th style="width: 7%;">No
		                    <span class="js-sorter-desc glyphicon glyphicon-chevron-down pull-right"></span>
		                    <span class="js-sorter-asc  glyphicon glyphicon-chevron-up pull-right"></span>
		                </th>
		                <th class="text-center">Kategori
		                    <span class="js-sorter-desc glyphicon glyphicon-chevron-down pull-right"></span>
		                    <span class="js-sorter-asc  glyphicon glyphicon-chevron-up pull-right"></span>
		                </th>
		                <th class="text-center">Parameter
		                    <span class="js-sorter-desc glyphicon glyphicon-chevron-down pull-right"></span>
		                    <span class="js-sorter-asc  glyphicon glyphicon-chevron-up pull-right"></span>
		                </th>
		                <th class="text-center" style="width: 8%;">AKG
		                    <span class="js-sorter-desc glyphicon glyphicon-chevron-down pull-right"></span>
		                    <span class="js-sorter-asc  glyphicon glyphicon-chevron-up pull-right"></span>
		                </th>
		                <th class="text-center" style="width: 12%;">Satuan
		                    <span class="js-sorter-desc glyphicon glyphicon-chevron-down pull-right"></span>
		                    <span class="js-sorter-asc  glyphicon glyphicon-chevron-up pull-right"></span>
		                </th>
		                <th class="text-center">Keterangan
		                    <span class="js-sorter-desc glyphicon glyphicon-chevron-down pull-right"></span>
		                    <span class="js-sorter-asc  glyphicon glyphicon-chevron-up pull-right"></span>
		                </th>
		                <th class="text-center">
		                	Aksi
		                </th>
		            </tr>
		            <tr>
		                <th>
		                    <input  class="js-filter  form-control" type="text" value="">
		                </th>
		                <th>
		                    <select class="js-filter  form-control">
		                        <option value="">Semua</option>
		                        @foreach($tampil1	 as $datas)
		                        <option value="{{$datas->kategori}}">{{$datas->kategori}}</option>
		                    	@endforeach
		                    </select>
		                </th>
		                <th>
		                    <select class="js-filter  form-control">
		                        <option value="">Semua</option>
		                        @foreach($tampil	 as $data)
		                        <option value="{{$data->parameter}}">{{$data->parameter}}</option>
		                    	@endforeach
		                    </select>
		                </th>
		                <th><input class="js-filter  form-control" type="text" value=""></th>
		                <th>
		                    <select class="js-filter  form-control">
		                        <option value="">Semua</option>
		                        <option value="kkal">kkal</option>
		                        <option value="g">g</option>
		                        <option value="mg">mg</option>
		                        <option value="mcg">mcg</option>
		                        <option value="IU">IU</option>
		                    </select>
		                </th>
		                <th><input class="js-filter  form-control" type="text" value=""></th>
		                <th><div class="form-control"></div></th>
		            </tr>
				</thead>
				<tbody>
					@foreach($tampil as $data)
				<tr>
					<td class="text-center">{{$loop->iteration}}</td>
					<td class="text-center">{{$data->kategori}}</td>
					<td class="text-center">{{$data->parameter}}</td>
					<td class="text-center">{{$data->akg}}</td>
					<td class="text-center">{{$data->satuan}}</td>
					<td class="text-center">{{$data->keterangan}}</td>
					<td class="text-center">
						<a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                        <a href="{{ url('hapus/'.$data->id_p) }}" class="btn btn-danger btnHapus"><i class="fa fa-trash"></i></a>	
					</td>
				</tr>
				@endforeach
				</tbody>
			</table>

			//MYMODAL
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title" id="myModalLabel">Edit Parameter</h4>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                  </div>
                </div>
            </div>

		</div>
	</div>
</div>
<script src="{{asset('lib/jquery-1.11.3.min.js')}}"></script>
<script src="{{asset('lib/dynamitable.jquery.min.js')}}"></script>
@endsection