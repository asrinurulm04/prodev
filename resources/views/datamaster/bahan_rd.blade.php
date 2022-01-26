@extends('layout.tempvv')
@section('title', 'PRODEV|Data Bahan Baku RD')
@section('content')

<div class="row">
  @if (session('status'))
  <div class="col-lg-12 col-md-12 col-sm-12">
    <div class="alert alert-success">
      <button type="button" class="close" data-dismiss="alert">×</button>
      {{ session('status') }}
    </div>
  </div>
  @elseif(session('error'))
  <div class="col-lg-12 col-md-12 col-sm-12">
    <div class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert">×</button>
      {{ session('error') }}
    </div>
  </div>
  @endif
</div>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h3><li class="fa fa-book"> List Bahan Baku Baru</li></h3>
      </div>
      <table id="datatable" class="table table-striped table-bordered" style="width:100%">
        <thead>
          <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
            <th width="5%">#</th>
            <th>Nama_Bahan </th>
            <th>Harga Satuan</th>
            <th>Supplier</th>
            <th>PIC</th>
            <th width="10%"></th>
          </tr>
        </thead>
        <tbody>
          @php $no = 0; @endphp 
          @foreach ($bahans as $bahan)
            <tr>
              <td>{{ ++$no }}</td>
              <td>{{ $bahan->nama_bahan }}</td>
              <td>{{ $bahan->harga_satuan }} {{ $bahan->curren->currency  }}</td>
              <td>{{ $bahan->supplier }}</td>
              <td>{{ $bahan->PIC }}</td>
              <td class="text-center">
                <a href="{{route('edit_bahan',$bahan->id)}}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Edit"><li class="fa fa-edit"></li></a>
                @if($bahan->status == 'active')
                <a class="btn btn-danger btn-sm" onclick="return confirm('NonAktif BahanBaku ?')" href="{{ route('nonactivebahan',$bahan->id) }}" data-toggle="tooltip" data-placement="top" title="NonActive"><i class="fa fa-minus"></i></a>
                @elseif($bahan->status == 'inactive')
                <a class="btn btn-success btn-sm" onclick="return confirm('Aktifkan BahanBaku ?')" href="{{ route('activebahan',$bahan->id) }}" data-toggle="tooltip" data-placement="top" title="Aktifkan"><i class="fa fa-check"></i></a>
                @endif
              </td>
            </tr>
          @endforeach
        </tbody>
	    </table>   
    </div>
  </div>
</div>
@endsection
@section('s')
<link href="{{ asset('lib/advanced-datatable/css/jquery.dataTables.css') }}" rel="stylesheet" />
<script src="{{ asset('js/datatables.min.js')}}"></script>
@endsection