@extends('layout.tempvv')
@section('title', 'feasibility|Proses')
@section('content')

<div class="x_panel">
  <div class="col-md-6"> <h3><li class="fa fa-cogs"> Workbook</li></h3></div>
</div>

<div class="row">
  <div class="col-md-6">
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
        <form id="demo-form2" data-parsley-validate class="form" action="/mss" method="post">
        <table id="datatable" class="Table table-striped table-bordered nowrap">
          <thead>
            <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
              <th></th>
              <th>workcenter</th>
              <th class="hidden-phone">Gedung</th>
              <th class="hidden-phone">Nama mesin</th>
              <th class="hidden-phone">kategori</th>
            </tr>
          </thead>
          <tbody>
            @foreach($mesins as $mesin)
            <tr>
              <td width="5%"><input type="checkbox" id="pmesin" name="pmesin[]" value="{{ $mesin->id_data_mesin }}"></td>
              <td>{{ $mesin->workcenter }}</td>
              <td>{{ $mesin->IO }}</td>
              <td>{{ $mesin->nama_mesin }}</td>
              <td>{{ $mesin->kategori }}</td>
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
  <div class="col-md-6">                                 
    <div class="card-block x_panel">
      <div class="x_title">
        <h3><li class="fa fa-folder-o"> Data Terpilih</li></h3>
      </div>
      <div class="form-panel" style="min-height:460px">
      <!-- data yang dipilih -->
      <table class="table table-hover table-bordered">
        <thead>
          <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
            <th></th>
            <th class="text-center">mesin</th>
            <th class="text-center">kategori</th>
            <th class="text-center">Runtime</th>
            <th class="text-center">Note</th>
          </tr>
        </thead>
        <tbody>
          @foreach($Mdata as $dM)
          <tr>
            <td>
              <form action="" method="post">
                {{csrf_field()}}
                <button type="submit" class="btn btn-danger fa fa-trash-o"></button>
                <input type="hidden" name="_method" value="DELETE">
              </form>
            </td>
            <td>{{ $dM->nama_mesin }}</td>
            <td class="text-center">{{ $dM->kategori }}</td>
            <td></td>
            <td></td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <!-- data selesai -->
        
      </div><br>
    </div>
  </div>
</div>

@endsection
@section('s')
<link href="{{ asset('lib/advanced-datatable/css/jquery.dataTables.css') }}" rel="stylesheet" />
<script src="{{ asset('js/datatables.min.js')}}"></script>
@endsection