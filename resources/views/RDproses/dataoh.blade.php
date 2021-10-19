@extends('layout.tempvv')
@section('title', 'feasibility|Proses')
@section('content')
<div class="row">
  <div class="col-md-6 col-sm-6 col-xs-12 form-panel">
    <div class="x_panel">
      <button class="btn btn-info btn-block btn-sm" data-toggle="modal" data-target="#NW1" type="button"><li class="fa fa-plus"></li><b> Use Tempale</b></button>
    </div>
    <!-- data oh yang dipilih -->
    <div class="x_panel">
      <div class="x_title">
        <h3><li class="fa fa-list"> Data OH</li></h3>
      </div>
      
      <!-- table pilih mesin -->
      <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="/ohh" method="post">
      <table id="datatable" class="Table table-striped table-bordered nowrap">
        <thead>
          <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
            <th></th>
            <th>Workcenter</th>
            <th width="15%">Type</th>
            <th width="35%">Activity</th>
            <th width="35%">Mesin</th>
          </tr>
        </thead>
        <tbody>
          @foreach($aktifitas as $ak)
          <tr>
            <input type="hidden" name="rateoh" maxlength="45" required="required" value="{{ $ak->harga_OH }}" class="form-control col-md-7 col-xs-12">
            <td><input type="checkbox" id="oh" name="oh[]" value="{{ $ak->id_aktifitasOH }}"></td>
            <td>{{ $ak->type }}</td>
            <td>{{ $ak->workcenter }}</td>
            <td>{{ $ak->aktifitas }}</td>
            <td>{{ $ak->mesin }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4">                        
        <a href="" class="btn btn-danger btn-sm" type="button"><li class="fa fa-ban"></li> Cancel</a>
        <button type="submit" class="btn btn-primary btn-sm"><li class="fa fa-check"></li> Submit</button>
        {{ csrf_field() }}
      </div>
      </form>
    </div>
  </div>
  <!-- data selesai -->

  <div class="col-md-6 col-sm-6 col-xs-12 form-panel">
    <div class="x_panel" style="min-height:660px">
      <div class="x_title">
        <h3><li class="fa fa-list"> Data Terpilih</li></h3>
      </div>
      <table class="table table-hover table-bordered">
        <thead>
          <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
            <th class="text-center">Mesin</th>
            <th class="text-center">Workcenter</th>
            <th class="text-center">Runtime</th>
            <th class="text-center">Note</th>
          </tr>
        </thead>
        <tbody>
        @foreach($dataO as $dO)
          <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="/updatemss/{{$dO->id_oh}}" method="post">
            {!!csrf_field()!!}
            <tr>
              <td>{{ $dO->dataoh->direct_activity }}</td>
              <td class="text-center">{{ $dO->dataoh->kategori }}</td>
              <td class="text-center"><a href="{{ route('delete', $dO->id_oh) }}" class="btn btn-danger fa fa-trash-o" data-toggle="tooltip" data-placement="top" title="Hapus"></a></td>
            </tr>
          </form>
        @endforeach
        </tbody>
      </table>
    </div>
    </header>
  </div>
</div>

@endsection
@section('s')
<link href="{{ asset('lib/advanced-datatable/css/jquery.dataTables.css') }}" rel="stylesheet" />
<script src="{{ asset('js/datatables.min.js')}}"></script>
@endsection