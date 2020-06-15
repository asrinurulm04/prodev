@extends('lab.templab')
@section('title', 'feasibility|Lab')
@section('judulnya', 'Data Lab')
@section('content')

<div class="row">
  <div class="col-md-3 col-sm-3 col-xs-12">
    <div class="card">
      <div class="card-header">
        <h5>SUMMARY</h5>
      </div>
      <div class="card-block">
      @foreach($formulas as $formula)
      <div class="form-group row">
        <label class="control-label col-md-5 col-sm-5 col-xs-12" for="last-name"><b>Nama produk</b></label>
        <input value="{{ $formula->nama_produk}}" class="form-control2 col-md-7 col-xs-12" readonly>
      </div>
      <div class="form-group row">
        <label class="control-label col-md-5 col-sm-5 col-xs-12" for="last-name"><b>Tanggal terima</b></label>
        <input value="{{ $formula->updated_at }}" class="form-control2 col-md-7 col-xs-12" readonly>
      </div>
      <div class="form-group row">
        <label class="control-label col-md-5 col-sm-5 col-xs-12" for="last-name"><b>No.PKP</b></label>
        <input value="{{ $formula->workbook->NO_PKP }}" class="form-control2 col-md-7 col-xs-12" readonly>
      </div>
      <div class="form-group row">
        <label class="control-label col-md-5 col-sm-5 col-xs-12" for="last-name"><b>Description</b></label>
        <input value="{{ $formula->workbook->deskripsi }}" class="form-control2 col-md-7 col-xs-12" readonly>
      </div>
        @endforeach
      </div>
    </div>
  </div>

  <div class="col-md-9 col-sm-9 col-xs-12 card">
    <div class="card-header">
      <h5>Analisa</h5>
    </div>
		<div class="card-block">
      <div class="form-group row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          @if($count_lab == 0)
          <form action="{{ route('labb') }}" method="post">
          <table id="myTable" class="table table-hover table-bordered">
            <th class="text-center">Jenis Mikroba</th>
            <th class="text-center">Harian</th>
            <th class="text-center" width="15%">Jumlah Analisa</th>
            <th class="text-center">Tahunan</th>
            <th class="text-center" width="15%">Jumlah Analisa</th>
            <th class="text-center">Input kode</th>
            <th class="text-center">rate</th>
            <input type="hidden" name="cek_lab" maxlength="45" id="lab" required="required" value="{{count($lab)}}" class="form-control col-md-7 col-xs-12">
            @foreach($lab as $key => $labs)
            <tr>
              <div class="col-md-1 col-sm-1 col-xs-12">
                <input type="hidden" name="finance" maxlength="45" required="required" value="{{$fe->id_feasibility}}" class="form-control col-md-7 col-xs-12">
              </div>
              <td><input name="mikro_{{ $key }}" class="form-control1" type="text" id="txtName" value="{{ $labs->jenis_mikroba }}" /></td>
              <td><input name="hari_{{ $key }}" value="ya" type="checkbox" id="txt" checked class="form-control1" /><label for="txt"></td>
              <td><input name="jlhAH_{{ $key }}" class="form-control" type="text"/></td>
              <td><input name="tahun_{{ $key }}" value="ya" type="checkbox" id="txtGender" checked class="form-control1" /><label for="txtGender"></label></td>
              <td><input name="jlhAT_{{ $key }}" class="form-control" type="text"/></td>
              <td>
                <select class="form-control" name="kode_{{ $key }}" id="kode">
                  <option value="">---</option>
                  @foreach ($analisa as $keys => $value)
                  <option value="{{$value->kode_analisa}}">{{$value->kode_analisa}}</option>
                  @endforeach
                </select>
              </td>
              <td><input name="rate_{{ $key }}" class="form-control" type="text" id="txtName"/></td>
            </tr>
            @endforeach
          </table>
        </div>
      </div>
      <div class="form-group">
        <center>
          <a href="{{ route('myFeasibility',$id) }}" class="btn btn-danger" type="submit">Cancel</a>
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
          <!-- modal selesai -->
        </center>  
      </div>
    </div>
    </form>
    <button id="btnAdd" class="button-add btn btn-info btn-sm fa fa-plus" onclick="insertRow();"> Tambah Analisa</button><br>
  </div>

  @elseif($count_lab != 0)
    <table id="myTable" class="table table-hover table-bordered">
      <tr>
        <th class="text-center">Jenis Mikroba</th>
        <th class="text-center" width="10%">harian</th>
        <th class="text-center" width="10%">jumlah analisa</th>
        <th class="text-center" width="10%">tahunan</th>
        <th class="text-center" width="10%">jumlah analisa</th>
        <th class="text-center">Input kode</th>
        <th class="text-center">rate</th>
      </tr>
      <form action="{{ route('labb') }}" method="post">
      @foreach($dataL as $dL)
      <tr>
        <div class="col-md-1 col-sm-1 col-xs-12">
          <input type="hidden" name="finance" maxlength="45" required="required" value="{{$fe->id_feasibility}}" class="form-control col-md-7 col-xs-12">
        </div>
        <td><input class="form-control1" type="text" id="txtName" value="{{ $dL->jenis_mikroba }}" readonly /></td>
        <td><input type="text" id="txtGender" checked class="form-control1 text-center" value="{{ $dL->harian }}" readonly /></td>
        <td><input id="kode" class="form-control" type="text" id="txtAge" value="{{ $dL->jlh_analisaharian }}" readonly  /></td>
        <td><input type="text" id="txt" checked class="form-control1 text-center" value="{{ $dL->tahunan }}" readonly /></td>
        <td><input id="kode" class="form-control" type="text" id="txtAge" value="{{ $dL->jlh_analisatahunan }}" readonly  /></td>
        <td><input id="kode" class="form-control" type="text" id="txtAge" value="{{ $dL->kode_analisa }}" readonly  /></td>
        <td><input class="form-control" type="number" id="txtOccupation" value="{{ $dL->rate }}" readonly /></td>
      </tr>
      @endforeach
    </table>

    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
      <a href="{{ route('myFeasibility',$id) }}" class="btn btn-info" type="submit">Selesai</a>
    </div>
  @endif
</div>
<!-- /page content -->

@endsection

@section ('s')
<script src="{{asset('/js/jquery.cookie.js')}}" charset="utf-8"></script>
<script>
  $(document).ready(function(){
	  // console.log(analisis[1][1])
  })
  $('#btnAdd').click(function(e) {
		var analisis = []
		<?php foreach($analisa as $key => $value) { ?>
		if(!analisis){
			analisis += [
				{
					'<?php echo $key; ?>' : '<?php echo $value->kode_analisa; ?>',
				}
			];
		} else {
			analisis.push({
				'<?php echo $key; ?>' : '<?php echo $value->kode_analisa; ?>',
			})
		}

		<?php } ?>

    var kode_analisa = [];
    var pilihan = '';
    for(var i = 0; i < Object.keys(analisis).length; i++){
		  pilihan += '<option value="'+analisis[i][i]+'">'+analisis[i][i]+'</option>';
	  }

    $('#myTable tr:last').after(
        '<tr><td><input type="text" name="mikro_'+$("tr:last")[0].rowIndex+'" class="form-control" id="txtName' + $("tr:last")[0].rowIndex + '" /><td><input type="checkbox" name="tahun_'+$("tr:last")[0].rowIndex+'" class="form-control1" value="Ya" checked id="txtGender' + $("tr:last")[0].rowIndex + '" /></td><td><input type="number" name="jlhAH_'+$("tr:last")[0].rowIndex+'" class="form-control" id="txtAge' + $("tr:last")[0].rowIndex + '" /></td><td><input type="checkbox" name="hari_'+$("tr:last")[0].rowIndex+'" class="form-control1" value="Ya" checked id="txt' + $("tr:last")[0].rowIndex + '" /></td><td><input type="number" name="jlhAT_'+$("tr:last")[0].rowIndex+'" class="form-control" id="txtAge' + $("tr:last")[0].rowIndex + '" /></td><td><select name="kode_'+$("tr:last")[0].rowIndex+'" class="form-control" id="txtOccupation' + $("tr:last")[0].rowIndex + '" >'+pilihan+'</select></td><td><input type="number" name="rate_'+$("tr:last")[0].rowIndex+'" class="form-control" id="txtAge' + $("tr:last")[0].rowIndex + '" /></td></tr>'
		);
    $('#lab').val($('tr:last')[0].rowIndex);
  });
</script>

@endsection