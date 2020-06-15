@extends('mesin.tempmesin')

@section('title', 'feasibility|Inputor')

@section('judulnya', 'List Feasibility')

@section('content')
<div class="col-md-6 col-sm-6 col-xs-12 form-panel">

  <!-- filter data -->
  <div class="panel panel-default">
	  <div class="panel-heading">
      <h2>* Data Aktifitas</h2>
    </div>
  <div>
    <div>
    <form id="clear">
                  
    <!--workcenter-->
    <div class="col-md-6 pl-1">
      <div class="form-group" id="filter_col1" data-column="1">
        <label>workcenter</label>
        <select name="workcenter" class="form-control column_filter" id="col1_filter">
          <option></option>
          <option>ciawi</option>
          <option>sentul</option>
          <option>cibitung</option>
          <option>gabungan</option>
          <option>maklon</option>
        </select>
      </div>
    </div>
                  
    <!--Kategori-->
    <div class="col-md-6 pl-1">
      <div class="form-group" id="filter_col1" data-column="3">
        <label>Kategori</label>
        <select name="kategori" class="form-control column_filter" id="col3_filter" >
          <option></option>
          <option>OTHER</option>
          <option>MAKLON KRM</option>
          <option>MAKLON LAIN</option>
          <option>MAKLON JASA</option>
          <option>OTHER_STORAGE FG</option>
          <option>OTHER_PERSIAPAN BK</option>
          <option>OTHER_QC NFI</option>
          <option>OTHER_STORAGE FG</option>
        </select>
      </div>
    </div>

    <!--Data-->
    <!-- <div class="col-md-4 pl-1">
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
    </div> -->
    </form>
    </div>
  </div>
  </div>
  <!-- filter data selesai -->
</div>

<!---------------------------------------------------------------------------------------------------->

  <div class="col-md-6 col-sm-6 col-xs-12 form-panel">

  <!-- data yang dipilih -->
  <table class="Table table-hover table-bordered">
    <thead>
      <tr>
        <th class="text-center">aktifitas</th>
        <th class="text-center">kategori</th>
        <th class="text-center">Aksi</th>
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
  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">                  
  @foreach($dataF as $dF)<a href="{{ route('activitymesin',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}" class="btn btn-primary" type="button">Selesai</a>
    @endforeach</div>
    
  </div>
  </div>
  <!-- data selesai -->

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
                </select>
              </div>
              <label class="control-label col-md-1 col-sm-1 col-xs-12" for="last-name">IO</label>
              <div class="col-md-5 col-sm-5 col-xs-12">
                <input type="text" name="aktifitas" name="last-name" required class="form-control col-md-7 col-xs-12">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Mesin</label>
              <div class="col-md-10 col-sm-10 col-xs-12">
                <input type="text" name="Nkategori" name="last-name" required class="form-control col-md-7 col-xs-12">
              </div>
            </div>

            <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                  <button class="btn btn-warning" type="reset">Reset</button>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal2">Submit</button>
                  <!-- The Modal -->
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
                </div>
              </div>
          </form>
        </div>
      </div>
    </div>
    <!-- tambah data selesai -->

    <!-- table pilih mesin -->
    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="/ohh" method="post">
      <table id="ex" class="Table">
        <thead>
          <tr>
            <th></th>
            <th>workcenter</th>
            <th>Activity</th>
            <th width="10%">kategori</th>
          </tr>
        </thead>
        <tbody>
              <div class="col-md-1 col-sm-1 col-xs-12">
                <input type="hidden" name="finance" maxlength="45" required="required" value="{{$fe->id_feasibility}}" class="form-control col-md-7 col-xs-12">
              </div>
              @foreach($aktifitas as $ak)
                            <tr>
                            <input type="hidden" name="rateoh" maxlength="45" required="required" value="{{ $ak->harga_OH }}" class="form-control col-md-7 col-xs-12">
                              <td><input type="checkbox" id="oh" name="oh[]" value="{{ $ak->id_aktifitasOH }}"></td>
                              <td>{{ $ak->workcenter }}</td>
                              <td>{{ $ak->direct_activity }}</td>
                              <td>{{ $ak->kategori }}</td>
                            </tr>
                            @endforeach
            </tbody>
          </table>
          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4">                        
            <a href="{{ route('myFeasibility',$id_feasibility) }}" class="btn btn-danger" type="button">Cancel</a>
              <button type="submit" class="btn btn-primary">Submit</button>
              {{ csrf_field() }}
          </div>
        </form>
      </div>
      </header>
    </div>
  </div>
</div>

@endsection