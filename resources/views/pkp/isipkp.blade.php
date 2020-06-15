@extends('pv.tempvv')
@section('title', 'Request PKP')
@section('judulhlaman','Request PKP')
@section('content')

@if (session('status'))
<div class="col-lg-12 col-md-12 col-sm-12">
  <div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{ session('status') }}
  </div>
</div>
@elseif(session('error'))
<div class="col-lg-12 col-md-12 col-sm-12">
  <div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{ session('error') }}
  </div>
</div>
@endif

<div class="">
  <form class="form-horizontal form-label-left" method="POST" action="{{ route('datapkp') }}" novalidate>
  <div class="row">
    <div class="card col-md-12 col-sm-12 col-xs-12">
      <div class="card-header">
        <h5>Project</h5>
      </div>
      <div class="card-block">
        <div class="x_content">
          <div class="form-group row">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Idea*</label>
            <div class="col-md-10 col-sm-10 col-xs-12">
              <textarea name="idea" id="idea" class="col-md-11 col-sm-12 col-xs-12" required></textarea>
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="last-name">Target Market*</label>
            <label class="control-label col-md-1 col-sm-3 col-xs-12" for="last-name">Gender:</label>
            <div class="col-md-8 col-sm-3 col-xs-12">
              <select id="gender" required name="gender" class="form-control" >
                <option disabled selected>-- Select Gender --</option>
                <option value="m">Male</option>
                <option value="f">Female</option>
                <option value="mf">Male dan Female</option>
              </select>
            </div><br><br><br>
            <div class="form-group row"><label for="middle-name" class="control-label col-md-4 col-sm-3 col-xs-12"></label>
              <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12">Umur : </label>
              <div class="col-md-3 col-sm-3 col-xs-12">
                <input type="number" required="required" name="dariumur" id="dariumur" class="form-control col-md-12 col-xs-12">
              </div>
              <div class="col-md-3 col-sm-3 col-xs-12">
                <input type="number"required name="sampaiumur" id="sampaiumur" class="form-control col-md-12 col-xs-12">
              </div>
            </div>
            <div class="form-group row">
              <label for="middle-name" class="control-label col-md-3 col-sm-2 col-xs-12">SES : </label>
              <div class="col-md-8 col-sm-6 col-xs-12">
                <input id="ses" class="form-control col-md-12 col-xs-12" type="text" name="ses" required>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="middle-name" class="control-label col-md-2 col-sm-3 col-xs-12">Uniqueness of Idea* </label>
            <div class="col-md-9 col-sm-6 col-xs-12">
              <select class="form-control form-control-line" name="uniq_idea" required>
                <option disabled="" selected="">-- Select One --</option>
                @foreach($idea as $idea)
                <option value="{{ $idea->id_uniqueness_idea }}">{{ $idea->uniqueness_of_idea }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">Estimated*</label>
            <div class="col-md-9 col-sm-6 col-xs-12">
              <select class="form-control form-control-line" name="estimated" required>
                <option disabled="" selected="">-- Select One --</option>
                @foreach($market as $market)
                <option value="{{ $market->id_estimasi_market }}">{{ $market->estimasi_market }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">reason*</label>
            <div class="col-md-10 col-sm-10 col-xs-12">
              <textarea name="reason" id="reason" class="col-md-11 col-sm-12 col-xs-12" required></textarea>
            </div>
          </div>
          <div class="ln_solid"></div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="card col-md-6 col-sm-12 col-xs-12">
      <div class="card-header">
        <h5>Project</h5>
      </div>
      <div class="card-block">
        <div class="x_content">
          <div class="form-group row">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">Launch *</label>
            <div class="col-md-7 col-sm-9 col-xs-12">
              <select class="form-control form-control-line" name="launch">
                <option disabled="" selected="">-- Launch Deadline --</option>
                <option>Q1</option>
                <option>Q2</option>
                <option>Q3</option>
                <option>Q4</option>
                <option>S1</option>
                <option>S2</option>
              </select>
            </div>
            <div class="col-md-3 col-sm-9 col-xs-12">
              <input type="number" placeholder="Years" name="tahun" id="tahun" class="form-control col-md-12 col-xs-12">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <input type="date"  name="tanggal" id="tanggal" class="form-control col-md-12 col-xs-12">
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Aisle Placement*</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input type="number" required name="aisle" id="aisle" class="form-control col-md-12 col-xs-12">
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Sales Forecast*</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input type="number" required name="sales" id="sales" class="form-control col-md-12 col-xs-12">
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Selling Price*</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input type="number" required name="Selling_price" id="Selling_price" class="form-control col-md-12 col-xs-12">
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Consumer price*</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input type="number" required name="consumer_price" id="consumer_price" class="form-control col-md-12 col-xs-12">
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Competitor*</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input type="number" required placeholder="Main competitor" name="main" id="main" class="form-control col-md-12 col-xs-12">
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Competitive*</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input type="number" required name="analysis" placeholder="Competitive analysis" id="analysis" class="form-control col-md-12 col-xs-12">
            </div>
          </div>
          <div class="ln_solid"></div>
        </div>
      </div>
    </div>

    <div class="card col-md-6 col-sm-12 col-xs-12">
      <div class="card-header">
        <h5>Project</h5>
      </div>
      <div class="card-block">
        <div class="x_content">
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Form*</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <select required id="product" name="product" class="form-control" >
                <option disabled selected>-- Select one --</option>
                <option value="powder">Powder</option>
                <option value="solid">Solid</option>
                <option value="paste">Paste</option>
                <option value="liquid">Liquid</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Konfigurasi </label>&nbsp
            <input type="radio" name="gramasi" oninput="dua()" id="radio_dua"> 2 Dimensi
            <input type="radio" name="gramasi" oninput="tiga()" id="radio_tiga"> 3 Dimensi
            <input type="radio" name="gramasi" oninput="empat()" id="radio_empat"> 4 Dimensi
            <div id="tampil"></div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Primary</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <textarea name="primary" id="primary" class="col-md-12 col-sm-9 col-xs-12"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Secondary</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <textarea name="secondary" id="secondary" class="col-md-12 col-sm-9 col-xs-12"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">teriery</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <textarea name="teriery" id="teriery" class="col-md-12 col-sm-9 col-xs-12"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Kategori BPOM*</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input required type="number" name="bpom" id="bpom" class="form-control col-md-7 col-xs-12">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">AKG*</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input required type="number" name="akg" id="akg" class="form-control col-md-7 col-xs-12">
            </div>
          </div>
          <div class="ln_solid"></div>
        </div>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header">
      <h5>Data Form</h5>
    </div>
  <div class="card-block">
    <div class="form-group">
      <label class="control-label col-md-2 col-sm-3 col-xs-12">prefered flavour*</label>
      <div class="col-md-9 col-sm-9 col-xs-12">
        <input required id="prefered" class="form-control col-md-12 col-xs-12" type="text" name="prefered">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-2 col-sm-3 col-xs-12">Product Benefits*</label>
      <div class="col-md-9 col-sm-9 col-xs-12">
        <input required id="benefits" class="form-control col-md-12 col-xs-12" type="text" name="benefits">
      </div>
    </div>
    <div class="form-group">
      <label  class="control-label col-md-2 col-sm-3 col-xs-12">Mandatory Ingredient*</label>
      <div class="col-md-9 col-sm-9 col-xs-12">
        <input id="ingredient" required="required" class="form-control col-md-12 col-xs-12" placeholder="" type="text" name="ingredient">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-2 col-sm-3 col-xs-12"> Document*</label>
      <div class="col-md-9 col-sm-9 col-md-12">
        <label for="">File ( docx,xls,pdf,jpg )</label>
				<input type="file" class="form-control" name="file">
				<p class="text-danger">{{ $errors->first('file') }}</p>
      </div>
    </div>
    <div class="col-md-12">
      <div class="box-result-picture">
      <!-- <span>Result</span> -->
        <div class="row pkp-image">
        </div>
      </div>
    </div>
    <div class="col-md-6 col-md-offset-5">
      <button type="reset" class="btn btn-danger">Reset</button>
      <button type="submit" class="btn btn-primary">Submit</button>
      {{ csrf_field() }}
    </div>
  </div>
</div>
</form>

<script>

  function dua(){
    var dua = document.getElementById('radio_dua');

    if(dua.checked != true){
      document.getElementById('tampil').innerHTML = "";
    }else{
      document.getElementById('tampil').innerHTML = "<br><div class='panel panel-default'>"+
	    "<div class='panel-heading'><h2>Konfigurasi Kemas</h2></div>"+
	      "<div class='panel-body'>"+
          "<div class='form-group'>"+
            "<div class='col-md-1 col-sm-1 col-xs-12'>"+
              "<input name='primer' id='primer' class='date-picker form-control col-md-1 col-sm-2 col-xs-12' type='text'>"+
            "</div>"+
            "<div class='col-md-2 col-sm-2 col-xs-12'>"+
              "<select class='form-control' name='s_primer'>"+
                "<option value='D'>D</option>"+
                "<option value='S'>S</option>"+
                "<option value='G'>G</option>"+
                "<option value='SB'>SB</option>"+
                "<option value='O'>O</option>"+
							  "<option value='R'>R</option>"+
                "<option value='P'>P</option>"+
                "<option value='GST'>GST</option>"+
                "<option value='BTL'>BTL</option>"+
              "</select>"+
            "</div>"+
            "<div class='col-md-1 col-sm-1 col-xs-12'>"+
              "<input name='tersier' id='tersier' class='date-picker form-control col-md-7 col-xs-12' type='text'>"+
            "</div>"+
            "<div class='col-md-2 col-sm-2 col-xs-12'>"+
              "<select class='form-control' name='s_tersier'>"+
                "<option value='D'>D</option>"+
                "<option value='S'>S</option>"+
                "<option value='G'>G</option>"+
                "<option value='SB'>SB</option>"+
                "<option value='O'>O</option>"+
						  	"<option value='R'>R</option>"+
                "<option value='P'>P</option>"+
                "<option value='GST'>GST</option>"+
                "<option value='BTL'>BTL</option>"+
              "</select>"+
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
      document.getElementById('tampil').innerHTML = "<br><div class='panel panel-default'>"+
	    "<div class='panel-heading'><h2>Konfigurasi Kemas</h2></div>"+
	      "<div class='panel-body'>"+
          "<div class='form-group'>"+
            "<div class='col-md-1 col-sm-1 col-xs-12'>"+
              "<input name='primer' id='primer' class='date-picker form-control col-md-1 col-sm-2 col-xs-12' type='text'>"+
            "</div>"+
            "<div class='col-md-2 col-sm-2 col-xs-12'>"+
              "<select class='form-control' name='s_primer'>"+
                "<option value='D'>D</option>"+
                "<option value='S'>S</option>"+
                "<option value='G'>G</option>"+
                "<option value='SB'>SB</option>"+
                "<option value='O'>O</option>"+
				  			"<option value='R'>R</option>"+
                "<option value='P'>P</option>"+
                "<option value='GST'>GST</option>"+
                "<option value='BTL'>BTL</option>"+
              "</select>"+
            "</div>"+
            "<div class='col-md-1 col-sm-1 col-xs-12'>"+
              "<input name='sekunder1' id='sekunder1' class='date-picker form-control col-md-7 col-xs-12' type='text'>"+
            "</div>"+
            "<div class='col-md-2 col-sm-2 col-xs-12'>"+
              "<select class='form-control' name='s_sekunder1'>"+
                "<option value='D'>D</option>"+
                "<option value='S'>S</option>"+
                "<option value='G'>G</option>"+
                "<option value='SB'>SB</option>"+
                "<option value='O'>O</option>"+
				  			"<option value='R'>R</option>"+
                "<option value='P'>P</option>"+
                "<option value='GST'>GST</option>"+
                "<option value='BTL'>BTL</option>"+
              "</select>"+
            "</div>"+
            "<input name='t' value='1' class='date-picker form-control col-md-7 col-xs-12' type='hidden'>"+
            "<div class='col-md-1 col-sm-1 col-xs-12'>"+
              "<input name='tersier' id='tersier' class='date-picker form-control col-md-1 col-sm-2 col-xs-12' type='text'>"+
            "</div>"+
            "<div class='col-md-2 col-sm-2 col-xs-12'>"+
              "<select class='form-control' name='s_tersier'>"+
                "<option value='D'>D</option>"+
                "<option value='S'>S</option>"+
                "<option value='G'>G</option>"+
                "<option value='SB'>SB</option>"+
                "<option value='O'>O</option>"+
	  						"<option value='R'>R</option>"+
                "<option value='P'>P</option>"+
                "<option value='GST'>GST</option>"+
                "<option value='BTL'>BTL</option>"+
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
      document.getElementById('tampil').innerHTML =
      "<br><div class='panel panel-default'>"+
	    "<div class='panel-heading'><h2>Konfigurasi Kemas</h2></div>"+
	      "<div class='panel-body'>"+
          "<div class='form-group'>"+
            "<div class='col-md-1 col-sm-1 col-xs-12'>"+
              "<input name='primer' id='primer' class='date-picker form-control col-md-1 col-sm-2 col-xs-12' type='text'>"+
            "</div>"+
            "<div class='col-md-2 col-sm-2 col-xs-12'>"+
              "<select class='form-control' name='s_primer'>"+
                "<option value='D'>D</option>"+
                "<option value='S'>S</option>"+
                "<option value='G'>G</option>"+
                "<option value='SB'>SB</option>"+
                "<option value='O'>O</option>"+
				  			"<option value='R'>R</option>"+
                "<option value='P'>P</option>"+
                "<option value='GST'>GST</option>"+
                "<option value='BTL'>BTL</option>"+
              "</select>"+
            "</div>"+
            "<div class='col-md-1 col-sm-1 col-xs-12'>"+
              "<input name='sekunder1' id='sekunder1' class='date-picker form-control col-md-7 col-xs-12' type='text'>"+
            "</div>"+
            "<div class='col-md-2 col-sm-2 col-xs-12'>"+
              "<select class='form-control' name='s_sekunder1'>"+
                "<option value='D'>D</option>"+
                "<option value='S'>S</option>"+
                "<option value='G'>G</option>"+
                "<option value='SB'>SB</option>"+
                "<option value='O'>O</option>"+
				  			"<option value='R'>R</option>"+
                "<option value='P'>P</option>"+
                "<option value='GST'>GST</option>"+
                "<option value='BTL'>BTL</option>"+
              "</select>"+
            "</div>"+ 
            "<div class='col-md-1 col-sm-1 col-xs-12'>"+
              "<input name='sekunder2' id='sekunder2' class='date-picker form-control col-md-7 col-xs-12' type='text'>"+
            "</div>"+
            "<div class='col-md-2 col-sm-2 col-xs-12'>"+
              "<select class='form-control' name='s_sekunder2'>"+
                "<option value='D'>D</option>"+
                "<option value='S'>S</option>"+
                "<option value='G'>G</option>"+
                "<option value='SB'>SB</option>"+
                "<option value='O'>O</option>"+
				  			"<option value='R'>R</option>"+
                "<option value='P'>P</option>"+
                "<option value='GST'>GST</option>"+
                "<option value='BTL'>BTL</option>"+
              "</select>"+
            "</div>"+
            "<div class='col-md-1 col-sm-1 col-xs-12'>"+
              "<input name='tersier' id='tersier' class='date-picker form-control col-md-1 col-sm-2 col-xs-12' type='text'>"+
            "</div>"+
            "<div class='col-md-2 col-sm-2 col-xs-12'>"+
              "<select class='form-control' name='s_tersier'>"+
                "<option value='D'>D</option>"+
                "<option value='S'>S</option>"+
                "<option value='G'>G</option>"+
                "<option value='SB'>SB</option>"+
                "<option value='O'>O</option>"+
				  			"<option value='R'>R</option>"+
                "<option value='P'>P</option>"+
                "<option value='GST'>GST</option>"+
                "<option value='BTL'>BTL</option>"+
              "</select>"+
            "</div>"+
          "</div>"+
        "</div>"+
      "</div>"  ;
    }
  }
</script>

@endsection
