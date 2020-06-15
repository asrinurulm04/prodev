@extends('kemas.tempkemas')
@section('title', 'feasibility|Kemas')
@section('judulnya', 'Konsep Kemas')
@section('content')

<div class="x_panel">
  <div class="card-block">
    <div class="row">
	    <div class="col-md-6 col-sm-6 col-xs-12 content-panel">
		    @foreach($formulas as $formula)
  		  <table>
	  		  <tr><th width="15%">Nama Produk </th><th width="45%">: {{ $formula->nama_produk}}</th>
		  	  <tr><th width="15%">Tanggal Terima</th><th width="45%">: {{ $formula->updated_at }}</th>
			    <tr><th width="15%">No.PKP</th><th width="45%">: {{ $formula->workbook->NO_PKP }}</th>
		    </table>
		    @endforeach
  	  </div>
      <div class="col-md-6 col-sm-6 col-xs-12 content-panel">
		    @foreach($formulas as $formula)
		    <table>
		    	<tr><th width="10%">Kode Formula </th><th width="45%">: {{ $formula->kode_formula}}</th>
		    	<tr><th width="10%">Versi</th><th width="45%">: {{ $formula->versi }}</th>
		  	  <tr><th width="10%">Description</th><th width="45%">: {{ $formula->workbook->deskripsi }}</th></tr>
		    </table>
		    @endforeach
	    </div>
    </div>  
  </div>
</div>

<div class="row">
  <div class="col-md-8 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h3><li class="fa fa-file"> Konsep Kemas</li></h3>
      </div>
      <div>
        <form id="demo-form2"  class="form-horizontal form-label-left" action="{{ route('insertkonsep',$id_feasibility) }}" method="post">
        <div class="form-group row">
          <label class="control-label col-md-1 col-sm-3 col-xs-12">konsep</label>
          <div class="col-md-4 col-sm-9 col-xs-12">
            <select class="form-control col-md-4 col-sm-10 col-xs-12" name="konsepkemas" required>
              <option>Tradisional</option>
              <option>Modern</option>
            </select>
          </div>
          <label class="control-label col-md-1 col-sm-3 col-xs-12">renceng</label>
          <div class="col-md-4 col-sm-9 col-xs-12">
            <select class="form-control col-md-4 col-sm-3 col-xs-12" name="ren">
              <option>10</option>
              <option>8</option>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label class="control-label col-md-1 col-sm-2 col-xs-12">Konfig</label>&nbsp
          <input type="radio" name="gramasi" oninput="dua()" id="radio_dua">&nbsp 2 Dimensi &nbsp
          <input type="radio" name="gramasi" oninput="tiga()" id="radio_tiga">&nbsp 3 Dimensi &nbsp
           <input type="radio" name="gramasi" oninput="empat()" id="radio_empat">&nbsp 4 Dimensi 
        </div>
        <div id="tampil"></div>
        <div class="form-group row"><br>
          <div class="col-sm-6">  
            <input type="number" name="BP" maxlength="8" name="last-name" placeholder="Box/Palet" required class="form-control">
          </div>
          <div class="col-sm-6">
            <input type="number" name="BL" maxlength="8" name="last-name" placeholder="Box/Layer" required class="form-control">
          </div>
        </div>

        <div class="form-group row">
          <div class="col-sm-6">
            <input type="number" class="form-control" placeholder="Palet/Batch" name="PB" required >
          </div>
          <div class="col-sm-6">
            <input type="text" class="form-control" placeholder="Kubikasi/m^3" name="kubikasi" required>
          </div>
        </div>

        <div class="ln_solid"></div>
        <div class="form-group"><br>
          <center>
            @if($count_konsep == 0)
              <a href="{{ route('myFeasibility',$id) }}" class="btn btn-danger" type="submit">Cancel</a>
              <button class="btn btn-warning" type="reset">Reset</button>
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal2">Submit</button>
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
            @elseif($count_konsep == 1)
            @endif
          </center>
        </div>
      </div>
    </div>
  </div>

  <!-- summary 4 data -->
  <div class="col-md-4 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h3><li class="fa fa-list"> Summary</li></h3>
      </div>
    
      <div class="card card-block">
        <div class="panel-body"  id="empatdata">
          <?php $no = 1 ; ?>
          <div class="form-group">
            @foreach($konsep as $kp)
            <div class="col-md-3 col-sm-2 col-xs-12">
              <input value="{{ $kp->primer }}" id="primer" class="form-control2 col-md-7 col-xs-12" readonly>
              <input id="runtime" value="{{ $kp->s_primer }}" name="runtime" class="form-control1 col-md-6 col-sm-6 col-xs-12" readonly>
            </div>
            <div class="col-md-3 col-sm-2 col-xs-12">
              <input value="{{ $kp->tersier2 }}" id="tersier2" class="form-control2 col-md-7 col-xs-12" readonly>
              <input id="runtime" value="{{ $kp->s_tersier2 }}" name="runtime" class="form-control1 col-md-6 col-sm-6 col-xs-12" readonly>
            </div>
            <div class="col-md-3 col-sm-2 col-xs-12">
              <input value="{{ $kp->sekunder }}" id="sekunder" class="form-control2 col-md-7 col-xs-12" readonly>
              <input id="runtime" value="{{ $kp->s_sekunder }}" name="runtime" class="form-control1 col-md-6 col-sm-6 col-xs-12" readonly>
            </div>
            <div class="col-md-3 col-sm-2 col-xs-12">
              <input value="{{ $kp->tersier }}" id="tersier" class="form-control2 col-md-7 col-xs-12" readonly>
              <input id="runtime" value="{{ $kp->s_tersier }}" name="runtime" class="form-control1 col-md-6 col-sm-6 col-xs-12" readonly>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-12">
              <input type="hidden" id="ren" value="{{ $kp->renceng }}" name="runtime" class="form-control1 col-md-6 col-sm-6 col-xs-12" readonly>
            </div>
            @endforeach
          </div><br>
          <div class="form-group row">
            <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name">Batch size/KG</label>
            <div class="col-md-8 col-sm-9 col-xs-12">
              @foreach($formulas as $formula)
              <input type="text" value="{{ $formula->batch}}" id="batch" name="batch" class="form-control" readonly>
              @endforeach
            </div>
          </div>
	        <div class="form-group row">
            <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name">sachet</label>
            <div class="col-md-8 col-sm-9 col-xs-12">
              <input type="number" value="" id="sachet" name="sachet" class="form-control col-md-7 col-xs-12" readonly>
            </div>
          </div>
	        <div class="form-group row">
            <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name">Renceng</label>
            <div class="col-md-8 col-sm-9 col-xs-12">
              <input type="number" value="" id="renceng" name="renceng" class="form-control col-md-7 col-xs-12" readonly>
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name">O</label>
            <div class="col-md-8 col-sm-9 col-xs-12">
              <input type="number" value="" id="outer" name="outer" class="form-control col-md-7 col-xs-12" readonly>
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name">pack</label>
            <div class="col-md-8 col-sm-9 col-xs-12">
              <input type="number" value="" id="pack" name="pack" class="form-control col-md-7 col-xs-12" readonly>
            </div>
          </div>
	        <div class="form-group row">
            <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name">Box</label>
            <div class="col-md-8 col-sm-9 col-xs-12">
              <input type="number" value="" id="box" name="box" class="form-control col-md-7 col-xs-12" readonly>
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5"><br>
            @foreach($dataF as $dF)
            <a href="{{ route('uploadkemas',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}" class="btn btn-info" type="button">Selesai</a>
            @endforeach
          </div>
	      </div>
        <?php $no++ ; ?>
      </div>
	  </div>
    </form>
  </div>

  <!-- summary 3 data -->
  <div class="col-md-4 col-xs-12" >
    <div class="x_panel">
		  <div class="panel-body"  id="tigadata">
        <?php $no = 1 ; ?>
        <div class="form-group">
          @foreach($konsep as $kp)
          <div class="col-md-3 col-sm-2 col-xs-12">
            <input value="{{ $kp->primer }}" id="primer3" class="form-control2 col-md-7 col-xs-12" readonly>
            <input id="runtime" value="{{ $kp->s_primer }}" name="runtime" class="form-control1 col-md-6 col-sm-6 col-xs-12" readonly>
          </div>
          <div class="col-md-3 col-sm-2 col-xs-12">
            <input value="{{ $kp->sekunder }}" id="sekunder3" class="form-control2 col-md-7 col-xs-12" readonly>
            <input id="runtime" value="{{ $kp->s_sekunder }}" name="runtime" class="form-control1 col-md-6 col-sm-6 col-xs-12" readonly>
          </div>
          <div class="col-md-3 col-sm-2 col-xs-12">
            <input value="{{ $kp->tersier }}" id="tersier3" class="form-control2 col-md-7 col-xs-12" readonly>
            <input id="runtime" value="{{ $kp->s_tersier }}" name="runtime" class="form-control1 col-md-6 col-sm-6 col-xs-12" readonly>
          </div>
          <div class="col-md-2 col-sm-2 col-xs-12">
            <input type="hidden" id="ren3" value="{{ $kp->renceng }}" name="runtime" class="form-control1 col-md-6 col-sm-6 col-xs-12" readonly>
          </div>
          @endforeach
        </div><br><br><br><br>
        <div class="form-group row">
          <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name">Batch size/KG</label>
          @foreach($formulas as $formula)<div class="col-md-8 col-sm-9 col-xs-12">
            <input type="text" value="{{ $formula->batch}}" id="batch3" name="batch" class="form-control" readonly>
          </div>@endforeach
        </div>
        <div class="form-group row">
          <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name">sachet</label>
          <div class="col-md-8 col-sm-9 col-xs-12">
            <input type="number" value="" id="sachet3" name="sachet" class="form-control col-md-7 col-xs-12" readonly>
          </div>
        </div>
        <div class="form-group row">
          <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name">Renceng</label>
          <div class="col-md-8 col-sm-9 col-xs-12">
            <input type="number" value="" id="renceng3" name="renceng" class="form-control col-md-7 col-xs-12" readonly>
          </div>
        </div>
        <div class="form-group row">
          <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name">pack</label>
          <div class="col-md-8 col-sm-9 col-xs-12">
            <input type="number" value="" id="pack3" name="pack" class="form-control col-md-7 col-xs-12" readonly>
          </div>
        </div>
        <div class="form-group row">
          <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name">Box</label>
          <div class="col-md-8 col-sm-9 col-xs-12">
            <input type="number" value="" id="box3" name="box" class="form-control col-md-7 col-xs-12" readonly>
          </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5"><br>
          @foreach($dataF as $dF)
            <a href="{{ route('uploadkemas',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}" class="btn btn-info" type="button">Selesai</a>
          @endforeach
        </div>
	    </div>
      <?php $no++ ; ?>
  	</div>
    </form>
  </div>

  <!-- summary 2 Data -->
  <div class="col-md-4 col-xs-12" >
	  <div class="x_panel">
		  <div class="panel-body"  id="duadata">
        <?php $no = 1 ; ?>
        <div class="form-group">
          @foreach($konsep as $kp)
          <div class="col-md-3 col-sm-2 col-xs-12">
            <input value="{{ $kp->primer }}" id="primer3" class="form-control2 col-md-7 col-xs-12" readonly>
            <input id="runtime" value="{{ $kp->s_primer }}" name="runtime" class="form-control1 col-md-6 col-sm-6 col-xs-12" readonly>
          </div>
          <div class="col-md-3 col-sm-2 col-xs-12">
            <input value="{{ $kp->sekunder }}" id="sekunder3" class="form-control2 col-md-7 col-xs-12" readonly>
            <input id="runtime" value="{{ $kp->s_sekunder }}" name="runtime" class="form-control1 col-md-6 col-sm-6 col-xs-12" readonly>
          </div>
          <div class="col-md-3 col-sm-2 col-xs-12">
            <input value="{{ $kp->tersier }}" id="tersier3" class="form-control2 col-md-7 col-xs-12" readonly>
            <input id="runtime" value="{{ $kp->s_tersier }}" name="runtime" class="form-control1 col-md-6 col-sm-6 col-xs-12" readonly>
          </div>
          <div class="col-md-2 col-sm-2 col-xs-12">
            <input type="hidden" id="ren3" value="{{ $kp->renceng }}" name="runtime" class="form-control1 col-md-6 col-sm-6 col-xs-12" readonly>
          </div>
          @endforeach
        </div><br><br><br><br>
        <div class="form-group row">
          <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name">Batch size/KG</label>
          @foreach($formulas as $formula)<div class="col-md-8 col-sm-9 col-xs-12">
            <input type="text" value="{{ $formula->batch}}" id="batch3" name="batch" class="form-control" readonly>
          </div>@endforeach
        </div>
        <div class="form-group row">
          <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name">sachet</label>
          <div class="col-md-8 col-sm-9 col-xs-12">
            <input type="number" value="" id="sachet3" name="sachet" class="form-control col-md-7 col-xs-12" readonly>
          </div>
        </div>
        <div class="form-group row">
          <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name">Renceng</label>
          <div class="col-md-8 col-sm-9 col-xs-12">
            <input type="number" value="" id="renceng3" name="renceng" class="form-control col-md-7 col-xs-12" readonly>
          </div>
        </div>
        <div class="form-group row">
          <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name">pack</label>
          <div class="col-md-8 col-sm-9 col-xs-12">
            <input type="number" value="" id="pack3" name="pack" class="form-control col-md-7 col-xs-12" readonly>
          </div>
        </div>
        <div class="form-group row">
          <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name">Box</label>
          <div class="col-md-8 col-sm-9 col-xs-12">
            <input type="number" value="" id="box3" name="box" class="form-control col-md-7 col-xs-12" readonly>
          </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5"><br>
          @foreach($dataF as $dF)
            <a href="{{ route('uploadkemas',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}" class="btn btn-info" type="button">Selesai</a>
          @endforeach
        </div>
	    </div>
      <?php $no++ ; ?>
  	</div>
    </form>
  </div>
</div>

<script>
  var batch = document.getElementById('batch').value;
  var primer = document.getElementById('primer').value;
  var sekunder = document.getElementById('sekunder').value;
  var tersier = document.getElementById('tersier').value;
  var tersier2 = document.getElementById('tersier2').value;
  var ren = document.getElementById('ren').value;

  var pertama = ((batch*1000)/tersier);
  pertama = pertama.toFixed(0);
  // console.log(pertama);
  document.getElementById('sachet').value = pertama;
  var kedua = (pertama/ren);
  kedua = kedua.toFixed(0);
  document.getElementById('renceng').value = kedua;
  var bagi = (sekunder/ren);
  var ketiga = (kedua/bagi);
  ketiga = ketiga.toFixed(0);
  document.getElementById('outer').value = ketiga;
  var keempat = (ketiga/tersier2);
  keempat = keempat.toFixed(0);
  document.getElementById('pack').value = keempat;
  var kelima = (keempat/primer);
  kelima = kelima.toFixed(0);
  document.getElementById('box').value = kelima;
</script>

<script>
  var batch3 = document.getElementById('batch3').value;
  var primer3 = document.getElementById('primer3').value;
  var sekunder3 = document.getElementById('sekunder3').value;
  var tersier3 = document.getElementById('tersier3').value;
  var ren3 = document.getElementById('ren3').value;

  var pertama = ((batch3*1000)/tersier3);
  pertama = pertama.toFixed(0);
  // console.log(pertama);
  document.getElementById('sachet3').value = pertama;
  var kedua = (pertama/ren3);
  kedua = kedua.toFixed(0);
  document.getElementById('renceng3').value = kedua;
  var bagi = (sekunder/ren3);
  var ketiga = (kedua/bagi);
  ketiga = ketiga.toFixed(0);
  document.getElementById('pack3').value = ketiga;
  var keempat = (keempat/primer);
  keempat = keempat.toFixed(0);
  document.getElementById('box3').value = keempat;
</script>

<script>
  document.getElementById('tigadata').style.display = "none";
  document.getElementById('empatdata').style.display = "none";
  document.getElementById('duadata').style.display = "none";

  function dua(){
    var dua = document.getElementById('radio_dua');
    if(dua.checked != true){
      document.getElementById('tampil').innerHTML = "";
    }else{
      document.getElementById('duadata').style.display = "unset";
      document.getElementById('tigadata').style.display = "none";
      document.getElementById('empatdata').style.display = "none";
      document.getElementById('tampil').innerHTML = "<br><div class='panel panel-default'>"+
        "<div class='x_panel'>"+
          "<div class='x_title'>"+
           " <h3><li class='fa fa-file'> Konfigurasi Kemas</li></h3>"+
          "</div>"+
          "<div class='card-block'>"+
          "<div class='form-group row'>"+
          "<div>"+
            "<input type='hidden' name='finance' maxlength='45' value='{{$fe->id_feasibility}}' class='form-control col-md-7 col-xs-12'>"+
          "</div>"+
          "<div class='col-md-2 col-sm-1 col-xs-12'>"+
            "<input name='d' class='date-picker form-control' type='text'>"+
          "</div>"+
          "<div class='col-md-2 col-sm-2 col-xs-12'>"+
            "<select class='form-control' name='primer'>"+
              "<option>D</option>"+
              "<option>S</option>"+
              "<option>G</option>"+
              "<option>SB</option>"+
              "<option>O</option>"+
							"<option>R</option>"+
              "<option>P</option>"+
              "<option>GST</option>"+
              "<option>BTL</option>"+
            "</select>"+
          "</div>"+

          "<div class='col-md-2 col-sm-1 col-xs-12'>"+
            "<input name='g' class='date-picker form-control' type='text'>"+
          "</div>"+
          "<div class='col-md-2 col-sm-2 col-xs-12'>"+
            "<select class='form-control' name='tersier'>"+
              "<option>D</option>"+
              "<option>S</option>"+
              "<option>G</option>"+
              "<option>SB</option>"+
              "<option>O</option>"+
							"<option>R</option>"+
              "<option>P</option>"+
              "<option>GST</option>"+
              "<option>BTL</option>"+
            "</select>"+
          "</div>"+
          "<input name='t' value='1' class='date-picker form-control col-md-7 col-xs-12' type='hidden'>"+
          "<div class='col-md-1 col-sm-1 col-xs-12'>"+
            "<input name='s' class='date-picker form-control col-md-1 col-sm-2 col-xs-12' type='hidden'>"+
          "</div>"+
          "</div>"+
          "</div>"+
      "</div>"
    }
  }

  function tiga(){
    var tiga = document.getElementById('radio_tiga');

    if(tiga.checked != true){
      document.getElementById('tampil').innerHTML = "";
    }else{
      document.getElementById('duadata').style.display = "none";
      document.getElementById('tigadata').style.display = "unset";
      document.getElementById('empatdata').style.display = "none";

      document.getElementById('tampil').innerHTML = "<br><div class='panel panel-default'>"+
        "<div class='x_panel'>"+
          "<div class='x_title'>"+
            "<h3><li class='fa fa-file'> Konfigurasi Kemas</li></h3>"+
          "</div>"+
          "<div class='card-block'>"+
            "<div class='form-group row'>"+
              "<div>"+
                "<input type='hidden' name='finance' maxlength='45' value='{{$fe->id_feasibility}}' class='form-control col-md-7 col-xs-12'>"+
              "</div>"+
              "<div class='col-md-1 col-sm-1 col-xs-12'>"+
                "<input name='d' class='date-picker form-control col-md-1 col-sm-2 col-xs-12' type='text'>"+
              "</div>"+
              "<div class='col-md-2 col-sm-2 col-xs-12'>"+
                "<select class='form-control' name='primer'>"+
                  "<option>D</option>"+
                  "<option>S</option>"+
                  "<option>G</option>"+
                  "<option>SB</option>"+
                  "<option>O</option>"+
						    	"<option>R</option>"+
                  "<option>P</option>"+
                  "<option>GST</option>"+
                  "<option>BTL</option>"+
                "</select>"+
              "</div>"+

              "<div class='col-md-1 col-sm-1 col-xs-12'>"+
                "<input name='s' class='date-picker form-control col-md-7 col-xs-12' type='text'>"+
              "</div>"+
              "<div class='col-md-2 col-sm-2 col-xs-12'>"+
                "<select class='form-control' name='sekunder'>"+
                  "<option>D</option>"+
                  "<option>S</option>"+
                  "<option>G</option>"+
                  "<option>SB</option>"+
                  "<option>O</option>"+
                  "<option>R</option>"+
                  "<option>P</option>"+
                  "<option>GST</option>"+
                  "<option>BTL</option>"+
                "</select>"+
              "</div>"+
              "<input name='t' value='1' class='date-picker form-control col-md-7 col-xs-12' type='hidden'>"+
              "<div class='col-md-1 col-sm-1 col-xs-12'>"+
                "<input name='g' class='date-picker form-control col-md-1 col-sm-2 col-xs-12' type='text'>"+
              "</div>"+
              "<div class='col-md-2 col-sm-2 col-xs-12'>"+
                "<select class='form-control' name='tersier'>"+
                  "<option>D</option>"+
                  "<option>S</option>"+
                  "<option>G</option>"+
                  "<option>SB</option>"+
                  "<option>O</option>"+
                  "<option>R</option>"+
                  "<option>P</option>"+
                  "<option>GST</option>"+
                  "<option>BTL</option>"+
                "</select>"+
              "</div>"+
            "</div>"+
          "</div>"+
        "</div>"
    }
  }

  function empat(){
    var empat = document.getElementById('radio_empat');

    if(empat.checked != true){
      document.getElementById('tampil').innerHTML = "";
    }else{
      document.getElementById('empatdata').style.display = "unset";
      document.getElementById('tigadata').style.display = "none";
      document.getElementById('duadata').style.display = "none";

      document.getElementById('tampil').innerHTML =
      "<div class='x_panel'>"+
        "<div class='x_title'>"+
          "<h3><li class='fa fa-file'> Konfigurasi Kemas</li></h3>"+
        "</div>"+
        "<div class='card-block'>"+
          "<div class='form-group row'>"+
            "<div>"+
              "<input type='hidden' name='finance' maxlength='45' value='{{$fe->id_feasibility}}' class='form-control col-md-7 col-xs-12'>"+
            "</div>"+
            "<div class='col-md-1 col-sm-1 col-xs-12'>"+
              "<input name='d' class='date-picker form-control col-md-1 col-sm-2 col-xs-12' type='text'>"+
            "</div>"+
            "<div class='col-md-2 col-sm-2 col-xs-12'>"+
              "<select class='form-control' name='primer'>"+
                "<option>D</option>"+
                "<option>S</option>"+
                "<option>G</option>"+
                "<option>SB</option>"+
                "<option>O</option>"+
							  "<option>R</option>"+
                "<option>P</option>"+
                "<option>GST</option>"+
                "<option>BTL</option>"+
              "</select>"+
            "</div>"+
            "<div class='col-md-1 col-sm-1 col-xs-12'>"+
              "<input name='t' class='date-picker form-control col-md-7 col-xs-12' type='text'>"+
            "</div>"+
            "<div class='col-md-2 col-sm-2 col-xs-12'>"+
              "<select class='form-control' name='tersier2'>"+
                "<option>D</option>"+
                "<option>S</option>"+
                "<option>G</option>"+
                "<option>SB</option>"+
                "<option>O</option>"+
							  "<option>R</option>"+
                "<option>P</option>"+
                "<option>GST</option>"+
                "<option>BTL</option>"+
              "</select>"+
            "</div>"+ 
            "<div class='col-md-1 col-sm-1 col-xs-12'>"+
              "<input name='s' class='date-picker form-control col-md-7 col-xs-12' type='text'>"+
            "</div>"+
            "<div class='col-md-2 col-sm-2 col-xs-12'>"+
              "<select class='form-control' name='sekunder'>"+
                "<option>D</option>"+
                "<option>S</option>"+
                "<option>G</option>"+
                "<option>SB</option>"+
                "<option>O</option>"+
							  "<option>R</option>"+
                "<option>P</option>"+
                "<option>GST</option>"+
                "<option>BTL</option>"+
              "</select>"+
            "</div>"+
            "<div class='col-md-1 col-sm-1 col-xs-12'>"+
              "<input name='g' class='date-picker form-control col-md-1 col-sm-2 col-xs-12' type='text'>"+
            "</div>"+
            "<div class='col-md-2 col-sm-2 col-xs-12'>"+
              "<select class='form-control' name='tersier'>"+
                "<option>D</option>"+
                "<option>S</option>"+
                "<option>G</option>"+
                "<option>SB</option>"+
                "<option>O</option>"+
							  "<option>R</option>"+
                "<option>P</option>"+
                "<option>GST</option>"+
                "<option>BTL</option>"+
              "</select>"+
            "</div>"+
          "</div>"+
        "</div>"+
      "</div>"  ;
    }
  }
</script>
@endsection