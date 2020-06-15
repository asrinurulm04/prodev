@extends('admin.tempadmin')

@section('content')
<div  class="row">
  <div class="col-md-14">
    <div class="showback">
      <div class="row">
        <div class="col-md-6"><h4><i class="fa fa-cubes"></i> Data Cemaran</h4> </div>
        <div class="col-md-6 text-right"><h5><i class="fa fa-home"></i> / <a href="{{url('/databtp')}}">Data Cemaran</a></h5></div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="showback" style="border-radius:3px;">
      <a href="{{url('inputc')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a><br><br>
      <table class="table table-bordered table-hover table-striped" id="Table">
        <thead>
          <tr>
            <th class="text-center" style="width: 5%;">No</th>
            <th class="text-center">Jenis Cemaran</th>
            <th class="text-center">Cemaran</th>
            <th class="text-center">jenis Makanan</th>
            <th class="text-center">Batas Maksimum</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($tampilkan as $data)
          <tr>
            <td class="text-center">{{$loop->iteration}}</td>
            <td class="text-center">{{$data->jenis->cemaran}}</td>
            <td class="text-center">{{$data->para->parameter}}</td>
            <td class="text-center">{{$data->makanan->jenis_makanan}}</td>
            <td class="text-center">{{$data->makanan->batas_max}}</td>
            <td class="text-center">
              <a href="{{ url('editcemaran/'.$data->id_tc)}}"  class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
              <a href="#" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="hapus"><i class="fa fa-trash"></i></a> 
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection