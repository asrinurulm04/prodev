@extends('layout.tempvv')
@section('title', 'feasibility|Proses')
@section('content')

<div class="x_panel">
  <div class="col-md-6"> <h3><li class="fa fa-cogs"> Workbook</li></h3></div>
  <div class="col-md-6" align="right">
    <a href="{{route('workbookfs',[$fs->id_project,$fs->id_formula])}}" align="left" class="btn btn-sm btn-danger"><li class="fa fa-arrow-left"></li> Back</a>
  </div>
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
        <h3><li class="fa fa-folder-o"> Data Terpilih</li></h3>
      </div>

      <!-- data yang dipilih -->
      <table class="table table-hover table-bordered">
        <thead>
          <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
            <th class="text-center">mesin</th>
            <th class="text-center">kategori</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($Mdata as $dM)
          <tr>
            <td>{{ $dM->nama_mesin }}</td>
            <td class="text-center">{{ $dM->kategori }}</td>
            <td>
              <form action="" method="post">
                {{csrf_field()}}
                <button type="submit" class="btn btn-danger fa fa-trash-o"></button>
                <input type="hidden" name="_method" value="DELETE">
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <!-- data selesai -->
    </div>
  </div>

<!---------------------------------------------------------------------------------------------------->

  <!-- Data Mesin -->
  <div class="col-md-6">                                 
    <div class="card-block x_panel">
      <div class="x_title">
        <h3><li class="fa fa-list"> Data Mesin</li></h3>
      </div>
      <div class="form-panel">

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
            <div class="col-md-1 col-sm-1 col-xs-12">
              <input type="hidden" name="finance" maxlength="45" required="required" value="" class="form-control col-md-7 col-xs-12">
            </div>
            <?php $no = 1 ; ?>
            @foreach($mesins as $mesin)
            <tr>
              <input type="hidden" name="standar" maxlength="45" required="required" value="{{ $mesin->standar_sdm}}" class="form-control col-md-7 col-xs-12">
              <input type="hidden" name="rate" maxlength="45" required="required" value="{{ $mesin->rate_mesin }}" class="form-control col-md-7 col-xs-12">
              <input type="hidden" name="jlh_line" id="line{{$no}}" maxlength="45" value="{{ $mesin->jlh_line }}" class="form-control col-md-7 col-xs-12">
              <input type="hidden" name="sdm" id="sdm{{$no}}" maxlength="45" value="10" class="form-control col-md-7 col-xs-12">
              <input type="hidden" name="std" id="std{{$no}}" maxlength="45" value="{{ $mesin->standar_sdm }}" class="form-control col-md-7 col-xs-12">
              <input type="hidden" name="rate" id="rate{{$no}}" maxlength="45" value="{{ $mesin->rate_mesin }}" class="form-control col-md-7 col-xs-12">
              <td width="5%"><input type="checkbox" id="pmesin" name="pmesin[]" value="{{ $mesin->id_data_mesin }}"></td>
              <td>{{ $mesin->workcenter }}</td>
              <td>{{ $mesin->gedung }}</td>
              <td>{{ $mesin->nama_mesin }}</td>
              <td>{{ $mesin->kategori }}</td>
                  @if($mesin->kategori == "filling")
                  <input type="hidden" name="hasil" id="hasil{{$no}}">
                  <input type="hidden" name="jumlah" id="jumlah{{$no}}">
                    @foreach($formulas as $formula)
                    <input type="hidden" value="{{ $formula->batch}}" id="batch{{$no}}" >
                    @endforeach
                    @foreach($konsep as $kp)
                    <input type="hidden"  maxlength="100" value="{{ $kp->sekunder}}" id="sekunder{{$no}}">
                    <input type="hidden"  maxlength="100" value="{{ $kp->tersier}}" id="tersier{{$no}}">
                    @endforeach
                  @endif
              </td>
            </tr>
            <?php $no++ ; ?>
            @endforeach
          </tbody>
        </table>
      </div><br>
      <center>
        
        <button type="submit" class="btn btn-primary">Submit</button>
        {{ csrf_field() }}
        </form>
      </center>
    </div>
  </div>
</div>

@endsection
@section('s')
<link href="{{ asset('lib/advanced-datatable/css/jquery.dataTables.css') }}" rel="stylesheet" />
<script src="{{ asset('js/datatables.min.js')}}"></script>
<script>
var line = document.getElementById('line{{$no}}').value;
var batch = document.getElementById('batch{{$no}}').value;
var sekunder = document.getElementById('sekunder{{$no}}').value;
var tersier = document.getElementById('tersier{{$no}}').value;

var jawab = (batch * 1000)/tersier;
var jawab2 = (jawab/line);
var total = (jawab2/sekunder);
console.log(total);
document.getElementById('hasil{{$no}}').value = total;

var sdm = document.getElementById('sdm{{$no}}').value;
var std = document.getElementById('std{{$no}}').value;
var rate = document.getElementById('rate{{$no}}').value;

var hasil = (sdm/std);
var hasil2 = (hasil * total);
var hasil3 = (hasil2/60);
var hasil4 = (hasil3 * rate);
console.log(hasil4);
document.getElementById('jumlah{{$no}}').value = hasil4;
</script>

@endsection
