@extends('mesin.tempmesin')

@section('title','Feasibility|inputor')

@section('content')
<div clas="row">

<div class="col-md-8 col-sm-8 form-panel">
  <div>
    <div>
      <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{route('ubahdatamaster')}}" method="post">
      <table id="ex" class="Table  table-hover table-bordered">
        <thead>
          <tr>
            <th width="5%">ID</th>
            <th>workcenter</th>
            <th class="hidden-phone">Nama mesin</th>
            <th class="hidden-phone">gedung</th>
            <th class="hidden-phone">kategori</th>
            <th class="hidden-phone" width="10">rate</th>
          </tr>
        </thead>
        <tbody>
          @foreach($mesins as $key=>$mesin)
          <tr>
            <td width="10%"><input name="no[]"  maxlength="45" value="{{ $mesin->id_data_mesin }}" class="form-control1" readonly> </td>
            <td>{{ $mesin->workcenter }}</td>
            <td>{{ $mesin->nama_mesin }}</td>
            <td>{{ $mesin->gedung }}</td>
            <td>{{ $mesin->kategori }}</td>
            <td><input type="number" name="rate[]" value="{{ $mesin->rate_mesin }}" class="form-control"> </td>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4">
      @foreach($dataF as $dF)
        <a href="{{ route('reference',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}" class="btn btn-danger" type="button">Cancel</a>
      @endforeach
        <button type="submit" class="btn btn-primary">Submit</button>
          {{ csrf_field() }}
      </div>
      </form>
    </div>
  </div>
</div>

<div class="col-md-3 col-sm-4 col-xs-12 form-panel">

  <!-- filter data -->
  <div class="panel panel-default">
	  <div class="panel-heading">
      <h2>* Filter Data</h2>
    </div>
    <div>
      <div>
        <form id="clear">
        <div class="foem-group">
          <!--workcenter-->
          <div class="col-md-12 pl-1">
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
          </div>
          <!--Data-->
          <div class="col-md-12 pl-1">
            <div class="form-group" id="filter_col1" data-column="3">
              <label>GEDUNG</label>
              <select name="gedung" class="form-control column_filter" id="col3_filter" >
                <option></option>
                <option>CIAWI</option>
                <option>PROD NS</option>
                <option>PROD DAIRY</option>
                <option>PROD SENTUL</option>
              </select>
            </div>
          </div>

          <!--Kategori-->
          <div class="col-md-12 pl-1">
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
  <!-- filter data selesai -->
</div>

</div>
    @endsection
