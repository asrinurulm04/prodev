@extends('mesin.tempmesin')
@section('title', 'feasibility|Inputor')
@section('judulnya', 'List Feasibility')
@section('content')

<div class="row">
  <div class="col-md-6">

    <!-- filter data -->
    <div class="x_panel">
      <div class="x_title">
        <h3><li class="fa fa-filter"> Filter Mesin</li></h3>
      </div>
      <div class="card-block">
        <div>
          <div>
            <form id="clear">
            <!--workcenter-->
            <div class="col-md-4 pl-1">
              <div class="form-group" id="filter_col1" data-column="1">
                <label>workcenter</label>
                <select name="workcenter" class="form-control column_filter" id="col1_filter">
                  <option></option>
                  <option>ciawi</option>
                  <option>sentul</option>
                  <option>cibitung</option>
                  <option>maklon</option>
                </select>
              </div>
            </div>

            <!--Data-->
            <div class="col-md-4 pl-1">
              <div class="form-group" id="filter_col1" data-column="2">
                <label>IO</label>
                <select name="gedung" class="form-control column_filter" id="col2_filter" >
                  <option></option>
                  <option>PLA</option>
                  <option>PLB</option>
                  <option>PLE</option>
                  <option>PLG</option>
                </select>
              </div>
            </div>

            <!--Kategori-->
            <div class="col-md-4 pl-1">
              <div class="form-group" id="filter_col1" data-column="4">
                <label>Kategori</label>
                <select name="kategori" class="form-control column_filter" id="col4_filter" >
                  <option></option>
                  <option>mixing</option>
                  <option>filling</option>
                  <option>packing</option>
                  <option>granulasi</option>
                </select>
              </div>
            </div>

            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- filter data selesai -->

    <div class="card-block x_panel">
      <div class="x_title">
        <h3><li class="fa fa-list"> Data Mesin</li></h3>
      </div>
      <div class="form-panel">

        <!-- table pilih mesin -->
        <!-- <p><label><input type="checkbox" id="checkAllpkp1"/> Check all</label></p> -->
        <form id="demo-form2" data-parsley-validate class="form" action="/mss" method="post">
        <table id="ex" class="Table table-striped table-bordered nowrap">
          <thead>
            <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
              <th></th>
              <th>workcenter</th>
              <th class="hidden-phone">IO</th>
              <th class="hidden-phone">Nama mesin</th>
              <th class="hidden-phone">Type Activity</th>
            </tr>
          </thead>
          <tbody>
            <div class="col-md-1 col-sm-1 col-xs-12">
              <input type="hidden" name="finance" maxlength="45" required="required" value="{{$fe->id_feasibility}}" class="form-control col-md-7 col-xs-12">
            </div>
            <?php $no = 1 ; ?>
            @foreach($mesins as $mesin)
            <tr>
              <input type="hidden" name="standar" maxlength="45" required="required" value="{{ $mesin->standar_sdm}}" class="form-control col-md-7 col-xs-12">
              <input type="hidden" name="rate" maxlength="45" required="required" value="{{ $mesin->rate_mesin }}" class="form-control col-md-7 col-xs-12">
              <input type="hidden" name="sdm" id="sdm{{$no}}" maxlength="45" value="10" class="form-control col-md-7 col-xs-12">
              <input type="hidden" name="std" id="std{{$no}}" maxlength="45" value="{{ $mesin->standar_sdm }}" class="form-control col-md-7 col-xs-12">
              <input type="hidden" name="rate" id="rate{{$no}}" maxlength="45" value="{{ $mesin->rate_mesin }}" class="form-control col-md-7 col-xs-12">
              <td width="5%"><input type="checkbox" id="pmesin" class="data1" name="pmesin[]" value="{{ $mesin->id_data_mesin }}"></td>
              <td>{{ $mesin->workcenter }}</td>
              <td>{{ $mesin->IO }}</td>
              <td>{{ $mesin->nama_mesin }} <input type="hidden" name="jlh_line" id="line{{$no}}" maxlength="45" value="{{ $mesin->jlh_line }}" class="form-control col-md-7 col-xs-12">
              </td>
              <td>{{ $mesin->kategori }}</td>
                  @if($mesin->kategori == "filling")
                  <input type="hidden" name="hasil" id="hasil{{$no}}">
                  <input type="hidden" name="jumlah" id="jumlah{{$no}}">
                    @foreach($formulas as $formula)
                    <input type="hidden" value="{{ $formula->batch}}" id="batch" >
                    @endforeach
                    @foreach($konsep as $kp)
                    <input type="hidden"  maxlength="100" value="{{ $kp->sekunder}}" id="sekunder">
                    <input type="hidden"  maxlength="100" value="{{ $kp->tersier}}" id="tersier">
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
        @foreach($dataF as $dF)
        <a href="{{ route('reference',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}" class="btn btn-danger btn-sm" type="button">Cancel</a>
        @endforeach
        <button type="submit" class="btn btn-primary btn-sm"> Submit</button>
        {{ csrf_field() }}
        </form>
      </center>
    </div>
  </div>

<!---------------------------------------------------------------------------------------------------->

  <!-- Data Mesin -->
  <div class="col-md-6">                                 
    <div class="x_panel">
      <div class="x_title">
        <h3><li class="fa fa-folder-o"> Data Terpilih</li></h3>
      </div>

      <!-- data yang dipilih -->
      <table class="Table table-hover table-bordered">
        <thead>
          <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
            <th class="text-center">mesin</th>
            <th class="text-center">Type Activity</th>
            <th class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($Mdata as $dM)
          <tr>
            <td>{{ $dM->nama_mesin }}</td>
            <td class="text-center">{{ $dM->kategori }}</td>
            <td class="text-center">
              <form action="{{ route('mesin.destroy', $dM->id_mesin) }}" method="post">
                {{csrf_field()}}
                @if($dM->kategori=='Filling')
                  @foreach($dataF as $dF)<a href="{{ route('mesinfilling',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}" title="Next" class="btn btn-sm btn-primary btn-sm" type="button"><li class="fa fa-folder-open"></li></a>@endforeach
                @elseif($dM->kategori=='Packing')
                  @foreach($dataF as $dF)<a href="{{ route('mesinpacking',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}" title="Next" class="btn btn-sm btn-primary btn-sm" type="button"><li class="fa fa-folder-open"></li></a>@endforeach
                @elseif($dM->kategori=='Mixing')
                  @foreach($dataF as $dF)<a href="{{ route('mesinmixing',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}" title="Next" class="btn btn-sm btn-primary btn-sm" type="button"><li class="fa fa-folder-open"></li></a>@endforeach
                @elseif($dM->kategori=='Kirim Maklon')
                  @foreach($dataF as $dF)<a href="{{ route('mesinmixing',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}" title="Next" class="btn btn-sm btn-primary btn-sm" type="button"><li class="fa fa-folder-open"></li></a>@endforeach
                @elseif($dM->kategori=='Maklon lain')
                  @foreach($dataF as $dF)<a href="{{ route('mesinmixing',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}" title="Next" class="btn btn-sm btn-primary btn-sm" type="button"><li class="fa fa-folder-open"></li></a>@endforeach
                @endif
                <button type="submit" class="btn btn-danger btn-sm" title="Delete"><li class=" fa fa-trash-o"></li></button>
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
</div>

<script>

var x = document.getElementById("line{{$no}}").value;
var batch = document.getElementById('batch').value;
var sekunder = document.getElementById('sekunder').value;
var tersier = document.getElementById('tersier').value;

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

// PKP
$("#checkAllpkp").change(function () {
    $(".data").prop('checked', $(this).prop("checked"));
  });

  $("#checkAllpkp1").change(function () {
    $(".data1").prop('checked', $(this).prop("checked"));
  });
</script>

@endsection
