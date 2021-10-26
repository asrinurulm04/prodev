@extends('layout.tempvv')
@section('title', 'feasibility|Proses')
@section('content')

<div class="x_panel">
  <div class="col-md-6"> <h3><li class="fa fa-cogs"> Workbook</li></h3></div>
</div>

<div class="row">
  <div class="col-md-5">
    <div class="x_panel">
      <div class="card-block">
        <button class="btn btn-info btn-block btn-sm" data-toggle="modal" data-target="#NW1" type="button"><li class="fa fa-plus"></li><b> Use Tempale</b></button>
      </div>
    </div>
    <div class="x_panel">
      <div class="x_title">
        <h3><li class="fa fa-list"> Data Mesin</li></h3>
      </div>
      <!-- table pilih mesin -->
        <form id="demo-form2" data-parsley-validate class="form" action="{{route('Mdata')}}" method="post">
        <table id="datatable" class="Table table-striped table-bordered nowrap">
          <thead>
            <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
              <th></th>
              <th>workcenter</th>
              <th class="hidden-phone">Gedung</th>
              <th class="hidden-phone">Nama mesin</th>
            </tr>
          </thead>
          <tbody>
            @foreach($mesins as $mesin)
            <tr>
              <input type="hidden" value="{{$ws}}" name="id_ws" id="id_ws">
              <td width="5%"><input type="checkbox" id="pmesin" name="pmesin[]" value="{{ $mesin->id_data_mesin }}"></td>
              <td>{{ $mesin->workcenter }}</td>
              <td>{{ $mesin->IO }}</td>
              <td>{{ $mesin->nama_mesin }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <center>
        <a href="{{route('workbookfs',$id)}}" class="btn btn-sm btn-danger"><li class="fa fa-ban"></li> Cencel</a>
        <button type="submit" class="btn btn-primary btn-sm"><li class="fa fa-check"></li> Submit</button>
        {{ csrf_field() }}
        </form>
        </center>
    </div>
  </div>

<!---------------------------------------------------------------------------------------------------->

  <!-- Data Mesin -->
  <div class="col-md-7">                                 
    <div class="card-block x_panel">
      <div class="x_title">
        <h3><li class="fa fa-folder-o"> Data Terpilih</li></h3>
      </div>
      <div class="form-panel" style="min-height:460px">
      <!-- data yang dipilih -->
      <form id="demo-form2" data-parsley-validate class="form" action="{{route('runtime')}}" method="post">
      <table class="table table-hover table-bordered">
        <thead>
          <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
            <th></th>
            <th class="text-center" width="30%">mesin</th>
            <th class="text-center" width="15%">kategori</th>
            <th class="text-center" width="20%">Runtime</th>
            <th class="text-center" width="35%">Note</th>
          </tr>
        </thead>
        <tbody>
          @foreach($Mdata as $dM)
          <tr>
            <input type="hidden" value="{{$dM->id_mesin}}" name="scores[{{$loop->index}}][id]">
            <td><a href="{{ route('destroymesin',$dM->id_mesin) }}" onclick="return confirm('Hapus Data ?')" class="btn btn-danger btn-sm"><i class="fa fa-trash" data-toggle="tooltip" title="Delete"></i></a></td>
            <td>{{ $dM->nama_mesin }}</td>
            <td class="text-center">{{ $dM->kategori }}</td>
            <td><input value="{{$dM->runtime}}" type="number" name="scores[{{$loop->index}}][runtime]" id="runtime" class="form-control"></td>
            <td><textarea value="{{$dM->note}}" name="scores[{{$loop->index}}][note]" id="note" rows="2" class="form-control">{{$dM->note}}</textarea></td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <!-- data selesai -->
      <div class="col-md-6 col-md-offset-5">
      @if($hitung != '0')
      <button class="btn btn-primary btn-sm" type="submit"><li class="fa fa-check"></li> Submit</button>
      {{ csrf_field() }}
      @endif
      <a href="{{route('dataOH',[$id,$ws])}}" class="btn btn-sm btn-info"><li class="fa fa-arrow-right"></li> Next</a>
      </div>
      </form>
      </div><br>
    </div>
  </div>
</div>

<!-- Template -->
<div class="modal" id="NW1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Template PKP
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> </h3>
      </div>
      <div class="modal-body">
        <table id="datatable" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
              <td class="text-center" width="5%">No</td>
              <td class="text-center">Note</td>
              <td></td>
            </tr>
          </thead>
          @php $nol = 0; @endphp
          @foreach($WorkbookFs as $WorkbookFs)
            <tr>
              <th class="text-center">{{ ++$nol }}</th>
              <th>{{ $WorkbookFs->id }}</th>
              <th width="21%" class="text-center">
                <a class="btn btn-success btn-sm" onclick="return confirm('Are you sure you want to use this template?')" href="{{route('useMesin',[$WorkbookFs->id,$ws])}}"><i class="fa fa-check"></i></a>
              </th>
            </tr>
          @endforeach
        </table>
      </div>
    </div>
  </div>
</div>
<!-- Selesai -->
@endsection
@section('s')
<link href="{{ asset('lib/advanced-datatable/css/jquery.dataTables.css') }}" rel="stylesheet" />
<script src="{{ asset('js/datatables.min.js')}}"></script>
@endsection