@extends('finance.tempfinance')
@section('title', 'feasibility|Finance')
@section('judulnya', 'List Feasibility')
@section('content')

<div class="col-md-6 col-sm-6 col-xs-12 form-panel">
  <!-- filter data -->
  <div class="panel panel-default">
	  <div class="panel-heading">
      <h2>* Data Mesin</h2>
    </div>
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

          <!--Data-->
          <div class="col-md-4 pl-1">
            <div class="form-group" id="filter_col1" data-column="2">
              <label>IO</label>
              <select name="kategori" class="form-control column_filter" id="col2_filter" >
                <option></option>
                <option>PRA</option>
                <option>PRB</option>
                <option>GRA</option>
                <option>GRB</option>
              </select>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- filter data selesai -->
</div>

<!---------------------------------------------------------------------------------------------------->
<div class="col-md-6 col-sm-6 col-xs-12 form-panel">
  <!-- data yang dipilih -->
  <table class="table table-hover table-bordered">
    <thead>
      <tr>
        <th class="text-center">mesin</th>
        <th class="text-center">kategori</th>
        <th class="text-center">IO</th>
        <th class="text-center">Aksi</th>
      </tr>       
    </thead>
    <tbody>
      @if(!empty($reference))  
      @foreach($reference as $dM)
      <!-- <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="/updatemss/{{$dM->id_mesin}}" method="post"> -->
      <!-- {!!csrf_field()!!} -->
      <tr>
        <td>{{ $dM->nama_mesin }}</td>
        <td class="text-center">{{ $dM->kategori }}</td>
        <td class="text-center">{{ $dM->IO }}</td>
        <td>
          <form action="{{ route('mesin.destroy', $dM->id_mesin) }}" method="post">
            {{csrf_field()}}
            <button type="submit" class="btn btn-danger fa fa-trash-o"></button>
            <input type="hidden" name="_method" value="DELETE">
          </form>
        </td>
      </tr>
      <!-- </form>/ -->
      @endforeach

      @endif
    </tbody>
  </table>
  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">         
    @foreach($dataF as $dF)
      <a href="{{ route('finance',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}" class="btn btn-primary" type="button">Selesai</a>
    @endforeach
  </div>
  <!-- data selesai -->
</div>

<header>
  <div class="table-responsive  form-panel">
    <!-- tambah mesin baru -->
    <p><button class="btn btn-primary fa fa-plus" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"> Tambah Data Mesin</button></p>
    <div class="collapse" id="collapseExample">
      <div class="panel panel-default">
        <div class="panel-heading"><h2>* Tambah Data</h2></div>
          <div class="panel-body">
            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{ route('DM') }}" method="post">
              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Kategori</label>
                <div class="col-md-5 col-sm-5 col-xs-12">
                  <input type="text" name="kategori" maxlength="45" required class="form-control col-md-7 col-xs-12">
                </div>
                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="last-name">Harga</label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="text" name="rate" maxlength="100" name="last-name" required class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Workcenter</label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <select class="form-control" name="workcenter" id="workcenter">
                    <option value="0" disable="true" selected="true">--><--</option>
                    @foreach ($messin as $key => $value)
                    <option>{{$value->workcenter}}</option>
                    @endforeach
                  </select>
                </div>
                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="last-name">IO</label>
                <div class="col-md-5 col-sm-5 col-xs-12">
                  <input type="text" name="aktifitas" maxlength="8" name="last-name" required class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Mesin</label>
                <div class="col-md-10 col-sm-10 col-xs-12">
                  <input type="text" name="Nkategori" maxlength="8" name="last-name" required class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                  <button class="btn btn-warning" type="reset">Reset</button>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal2">Submit</button>
                  {{-- Modal --}}
                  <div class="modal" id="myModal2">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                          <h4>Yakin Dengan Data Yang Anda Masukan??</h4>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-success">Submit</button>
                          {{ csrf_field() }}
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- modal selesai -->
                </div>
              </div>
            </form>
          </div>
      </div>
    </div>
    <!-- tambah data selesai -->

    <!-- table pilih mesin -->
    <form id="demo-form2" data-parsley-validate class="form" action="/mss" method="post">
      <table id="ex" class="Table">
        <thead>
          <tr>
            <th></th>
            <th>workcenter</th>
            <th class="hidden-phone">IO</th>
            <th class="hidden-phone">Nama mesin</th>
            <th class="hidden-phone">kategori</th>
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
            <input type="hidden" name="jlh_line" id="line{{$no}}" maxlength="45" value="{{ $mesin->jlh_line }}" class="form-control col-md-7 col-xs-12">
            <input type="hidden" name="sdm" id="sdm{{$no}}" maxlength="45" value="10" class="form-control col-md-7 col-xs-12">
            <input type="hidden" name="std" id="std{{$no}}" maxlength="45" value="{{ $mesin->standar_sdm }}" class="form-control col-md-7 col-xs-12">
            <input type="hidden" name="rate" id="rate{{$no}}" maxlength="45" value="{{ $mesin->rate_mesin }}" class="form-control col-md-7 col-xs-12">
            <td width="5%"><input type="checkbox" id="pmesin" name="pmesin[]" value="{{ $mesin->id_data_mesin }}"></td>
            <td>{{ $mesin->workcenter }}</td>
            <td>{{ $mesin->IO }}</td>
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
                
            @endif
            </td>
          </tr>
          <?php $no++ ; ?>
          @endforeach
        </tbody>
      </table>
      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4">  
        @foreach($dataF as $dF)      
          <a href="{{ route('finance',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}" class="btn btn-danger" type="button">Cancel</a>                
        @endforeach
        <button type="submit" class="btn btn-primary">Submit</button>
        {{ csrf_field() }}
      </div>
    </form>
  </div>
</header>

@endsection