@extends('devnf.tempnp')
@section('title', 'nutfact')
@section('judulnya', 'DATA PENGAJUAN NUTFACT')
@section('content')

<div class="row">
  <div class="col-md-12"> 
    <div class="panel" style="border-radius:3px;">
      <div class="panel-body">
        <table class="table table-hover table-striped" id="Table">
          <thead>
            <tr>
              <th class="text-center">NO</th>
              <th class="text-center">FORMULA</th>
              <th class="text-center">WOORKBOOK</th>
              <th class="text-center">REVISI</th>
              <th class="text-center">TANGGAL MASUK</th>
              <th class="text-center">STATUS</th>
              <th class="text-center">AKSI</th>
            </tr>
          </thead>
          <tbody>
            @foreach($tampilkan as $data)
            <tr>
              <td class="text-center">{{$loop->iteration}}</td>
              <td class="text-center">{{$data->nama_produk}}</td>
              <td class="text-center">{{$data->Workbook->nama_project}}</td>
              <td class="text-center">{{$data->revisi}}</td>
              <td class="text-center">{{$data->updated_at}}</td>
              @if($data->status_nutfact=="proses")
              <td class="text-center"><button class="btn btn-link" data-toggle="tooltip" data-placement="top" title="Sedang diproses..."></a><span class="fa fa-rocket"></span></button></td>
              @else
              <td class="text-center"></td>
              @endif
              <td class="text-center">
                <div class="btn-group">
                  <a href="{{url('nutfactbayangan/'.$data->id)}}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="NUTFACT BAYANGAN"><i class="fa fa-bar-chart-o"></i></a>
                  <a href="{{url('datanutri/'.$data->id)}}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="INPUT HASIL ANALISA"><i class="fa fa-edit"></i></a>
                </div>
              </td>
            </tr>
            @endforeach()
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection