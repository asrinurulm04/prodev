@extends('layout.tempvv')
@section('title', 'feasibility|Proses')
@section('content')
<div class="row">
  <div class="col-md-5 col-sm-5 col-xs-12 form-panel">
    <div class="x_panel">
      <button class="btn btn-info btn-block btn-sm" data-toggle="modal" data-target="#NW1" type="button"><li class="fa fa-plus"></li><b> Use Tempale</b></button>
    </div>
    <!-- data oh yang dipilih -->
    <div class="x_panel">
      <div class="x_title">
        <h3><li class="fa fa-list"> Data OH</li></h3>
      </div>
      
      <!-- table pilih mesin -->
      <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{route('dataO')}}" method="post">
      <table id="datatable" class="Table table-striped table-bordered nowrap">
        <thead>
          <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
            <th></th>
            <th>Workcenter</th>
            <th width="35%">Activity</th>
            <th width="35%">Mesin</th>
          </tr>
        </thead>
        <tbody>
          @foreach($aktifitas as $ak)
          <tr>
            <input type="hidden" name="id" maxlength="45" required="required" value="{{ $ws }}">
            <td><input type="checkbox" id="oh" name="oh[]" value="{{ $ak->id }}"></td>
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

  <div class="col-md-7 col-sm-7 col-xs-12 form-panel">
    <div class="x_panel" style="min-height:660px">
      <div class="x_title">
        <h3><li class="fa fa-list"> Data Terpilih</li></h3>
      </div>
      <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{route('runtimeoh')}}" method="post">
      <table class="table table-hover table-bordered">
        <thead>
          <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
            <th></th>
            <th class="text-center" width="30%">Activity</th>
            <th class="text-center" width="5%">Workcenter</th>
            <th class="text-center" width="20%">Runtime</th>
            <th class="text-center" width="35%">Note</th>
          </tr>
        </thead>
        <tbody>
        @foreach($dataO as $dO)
          {!!csrf_field()!!}
          <tr>
            <input type="hidden" value="{{$dO->id}}" name="scores[{{$loop->index}}][id]">
            <td><a href="{{ route('destroyoh',$dO->id) }}" onclick="return confirm('Hapus Data ?')" class="btn btn-danger btn-sm"><i class="fa fa-trash" data-toggle="tooltip" title="Delete"></i></a></td>
            <td>{{ $dO->oh->aktifitas }}</td>
            <td class="text-center">{{ $dO->oh->workcenter }}</td>
            <td><input value="{{$dO->runtime}}" type="number" name="scores[{{$loop->index}}][runtime]" id="runtime" class="form-control"></td>
            <td><textarea value="{{$dO->note}}" name="scores[{{$loop->index}}][note]" id="note" rows="2" class="form-control">{{$dO->note}}</textarea></td>
          </tr>
        @endforeach
        </tbody>
      </table>
      <div class="col-md-6 col-md-offset-5">
        @if($hitung != '0')
        <button class="btn btn-primary btn-sm" type="submit"><li class="fa fa-check"></li> Submit</button>
        {{ csrf_field() }}
        @endif
        <a href="{{route('AllergenBaru',[$id,$ws])}}" class="btn btn-sm btn-info"><li class="fa fa-arrow-right"></li> Next</a>
      </div>
      </form>
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
                <a class="btn btn-success btn-sm" onclick="return confirm('Are you sure you want to use this template?')" href="{{route('useOH',[$WorkbookFs->id,$ws])}}"><i class="fa fa-check"></i></a>
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