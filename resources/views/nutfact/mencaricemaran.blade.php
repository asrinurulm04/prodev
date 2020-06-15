@extends('admin.tempadmin')

@section('content')
<div  class="row">
  <div class="col-md-14">
    <div class="showback">
      <div class="row">
        <div class="col-md-6"><h4><i class="fa fa-search"></i> Pencarian Data Cemaran</h4> </div>
        <div class="col-md-6 text-right"><h5><i class="fa fa-home"></i> / <a href="{{url('/pencariandatacemaran')}}">Pencemaran Data Cemaran</a></h5></div>
      </div>
    </div>
  </div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="showback" style="border-radius:3px;">
			<a href="{{url('/datac')}}" class="btn btn-danger"><i class="fa fa-arrow-left"> Kembali</i></a><br><br>
			<table class="js-dynamitable table table-bordered table-hover" id="Table">
				<thead>
					<tr>
		                <th class="text-center" style="width: 7%;">No
		                    <span class="js-sorter-desc glyphicon glyphicon-chevron-down pull-right"></span>
		                    <span class="js-sorter-asc  glyphicon glyphicon-chevron-up pull-right"></span>
		                 </th>
		                <th class="text-center">Jenis Cemaran
		                    <span class="js-sorter-desc glyphicon glyphicon-chevron-down pull-right"></span>
		                    <span class="js-sorter-asc  glyphicon glyphicon-chevron-up pull-right"></span>
		                 </th>
		                <th class="text-center">Cemaran
		                    <span class="js-sorter-desc glyphicon glyphicon-chevron-down pull-right"></span>
		                    <span class="js-sorter-asc  glyphicon glyphicon-chevron-up pull-right"></span>
		                 </th>
		                <th class="text-center">Jenis Makanan
		                    <span class="js-sorter-desc glyphicon glyphicon-chevron-down pull-right"></span>
		                    <span class="js-sorter-asc  glyphicon glyphicon-chevron-up pull-right"></span>
		                </th>
		                <th class="text-center">Batas Maksimum
		                    <span class="js-sorter-desc glyphicon glyphicon-chevron-down pull-right"></span>
		                    <span class="js-sorter-asc  glyphicon glyphicon-chevron-up pull-right"></span>
		                </th>
		            </tr>
		            <tr>
		                <th>
		                    <input  class="js-filter  form-control" type="text" value="">
		                </th>
		                <th>
		                    <select class="js-filter  form-control">
		                        <option value="">Semua</option>
		                        @foreach($tampil2 as $data)
		                        <option value="{{$data->cemaran}}">{{$data->cemaran}}</option>
		                    	@endforeach
		                    </select>
		                </th>
		                <th>
		                	<select class="js-filter  form-control">
		                        <option value="">Semua</option>
		                        @foreach($tampil1 as $c)
		                        <option value="{{$data->parameter}}">{{$c->parameter}}</option>
		                    	@endforeach
		                    </select>
		                </th>
		                <th><input class="js-filter  form-control" type="text" value=""></th>
		                <th><input class="js-filter  form-control" type="text" value=""></th>
		            </tr>
				</thead>
				@foreach($tampilkan as $datas)
				<tbody>
					<td class="text-center">{{$loop->iteration}}</td>
					<td class="text-center">{{$datas->jenis->cemaran}}</td>
					<td class="text-center">{{$datas->para->parameter}}</td>
					<td class="text-center">{{$datas->makanan->jenis_makanan}}</td>
					<td class="text-center">{{$datas->makanan->batas_max}}</td>
				</tbody>
				@endforeach
			</table>
		</div>
	</div>
</div>
<script src="asset/lib/jquery-1.11.3.min.js"></script>
<script src="asset/lib/dynamitable.jquery.min.js"></script>
@endsection