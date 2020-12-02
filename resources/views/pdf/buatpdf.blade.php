@extends('pv.tempvv')
@section('title', 'Request PDF')
@section('judulhalaman','Form PDF')
@section('content')

@include('formerrors')
<div class="row">
  <div class="col-md-3"></div>
  <div class="col-md-8">
    <div class="tabbable">
      <ul class="nav nav-tabs wizard">
        <li class="active"><a href="" ><span class="nmbr">1</span>Information</a></li>
        <li class="completed"><a href=""><span class="nmbr">2</span>PDF</a></li>
        <li class="active"><a href=""><span class="nmbr">3</span>File & Image</a></li>
      </ul>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12 col-xs-12">
    <table class="table table-bordered">
      <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
        <td>Mandatory Information</td>
        <td>* : Filled by Marketing</td>
        <td>^ : Filled By PV</td>
        <td>** : Filled by Marketing Or PV</td>
      </tr>
    </table>
  </div>
</div>

<div class="">
  <form class="form-horizontal form-label-left" method="POST" action="{{ route('pos') }}" novalidate>
	<div class="row">
    <div class="col-sm-12">
      <div class="x_panel">
        <div class="x_title">
          <h3 style="color:#258039"><li class="fa fa-edit"></li> Packaging concept**</h3>
        </div>
        <div class="card-block">
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="last-name">Configuration <h5 style="color:red">*requaired</h5></label> 
            <input type="hidden" value="{{ $id_pdf->id_project_pdf }}" name="id">
            <input type="hidden" value="{{$eksis+1}}" name="kemas" id="kemas">
            <label class="control-label col-md-1 col-sm-2 col-xs-12"></label>
            <input type="radio" name="data" oninput="baru()" id="radio_baru"> New Configuration  &nbsp &nbsp
       			<input type="radio" name="data" oninput="eksis()" id="radio_eksis"> Configuration exists &nbsp &nbsp
       			<input type="radio" name="data" oninput="pilih()" id="radio_project"> Previous Project Configuration  &nbsp &nbsp
          </div><hr>
          <div id="lihat"></div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h3><li class="fa fa-file"></li> Project</h3>
        </div>
        <div class="card-block">
          <div class="form-group row">
            <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12" style="color:#258039"> &nbsp  &nbsp Age Range form** : </label>
            <div class="col-md-2 col-sm-3 col-xs-12">
              <input type="number"  name="dariumur" id="dariumur" class="form-control col-md-12 col-xs-12">
            </div>
            <div class="col-md-2 col-sm-3 col-xs-12">&nbsp &nbsp &nbsp &nbsp &nbsp 
              <input type="radio" name="data" oninput="plus()" id="radio_plus"> +
               <input type="radio" name="data" oninput="minus()" id="radio_minus"> -
               <input type="radio" name="data" oninput="to()" id="radio_to"> To
            </div>
            <div class="col-md-1 col-sm-3 col-xs-12" id="umur"></div>
            
            <label for="middle-name" class="control-label col-md-1 col-sm-2 col-xs-12" style="color:#258039">SES : </label>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <select class="form-control form-control-line" id="select" name="ses[]"   multiple="multiple">
                @foreach ($ses as $ses)
              <option value="{{$ses->ses}}">{{$ses->ses}}</option>   
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" style="color:#258039">Gender</label>
            <div class="col-md-4 col-sm-10 col-xs-12">
              <select  class="form-control form-control-line" name="gender" >
                <option disabled="" selected="">-- Select One --</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Male & Female">Male & Female</option>
              </select>
            </div>
            <label class="control-label col-md-1 col-sm-2 col-xs-12" style="color:#258039">Other**</label>
            <div class="col-md-4 col-sm-10 col-xs-12">
              <input  id="other" required class="form-control col-md-12 col-xs-12" type="text" name="other">
            </div>
          </div>
          <div class="ln_solid"></div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="x_panel">
        <div class="x_title">
          <h3><li class="fa fa-edit"></li> Product Concept</h3>
        </div>
        <div class="card-block">
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" style="color:#258039">Weight**</label>
            <div class="col-md-4 col-sm-9 col-xs-12">
              <input required id="weight" class="form-control col-md-12 col-xs-12" type="number" name="weight">
            </div>
            <label class="control-label col-md-1 col-sm-3 col-xs-12" style="color:#258039">unit**</label>
            <div class="col-md-4 col-sm-9 col-xs-12">
              <select required class="form-control form-control-line" name="serving" >
                <option disabled="" selected="">-- Select--</option>
                <option value="gram">Gram</option>
                <option value="ml">ML</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" style="color:#258039">Target price**</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input required id="target_price" class="form-control col-md-12 col-xs-12" type="number" name="target_price">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" style="color:#258039">Ingredient**</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <textarea name="ingredient" required id="ingredient" class="form-control col-md-12 col-xs-12" placeholder="Special Ingredient" rows="3"></textarea>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-12 col-sm-12 col-xs-12" style="overflow-x: scroll;">
              <table class="table table-bordered table-hover" id="tab_logic">
                <thead>
                  <tr>
                    <th class="text-center">Komponen</th>
                    <th class="text-center" width="15%">Klaim</th>
                    <th class="text-center" width="15%">Detail</th>
                    <th class="text-center">Note</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr id='addr0'>
                    <input type="hidden" value="{{$Ddetail}}" name="iddetail" id="iddetail">
                    <td>
                      <select class="form-control items komponen" id="komponen" name="komponen[]">
                        @foreach($komponen as $kp)
                        <option value="{{ $kp->id }}">{{ $kp->komponen }}</option>
                        @endforeach
                      </select>
                    </td>
                    <td>
                      <select name="klaim[]" class="form-control items" id="klaimm">
                      </select>
                    </td>
                    <td>
                      <select name="detail[]"  id="detaill" multiple="multiple" class="form-control items">          
                      </select>
                    </td>
                    <td><textarea type="text" class="form-control" name="ket[]" id="ket"></textarea></td>
                    <td class="text-center"><button class="tr_clone_add btn btn-info btn-sm" id="add_row" type="button"><li class="fa fa-plus"></li></button></td>
                  </tr>
                  <tr id='addr1'></tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="ln_solid"></div>
        </div>
      </div>
    </div>
  </div> 

  <div class="row">
    <div class="col-md-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h3><li class="fa fa-folder-open"></li> Data</h3>
        </div>
        <div class="card-block">
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" style="color:#258039">Background**</label>
          	<div class="col-md-9 col-sm-9 col-xs-12">
              <input required id="background" placeholder="Backgroung / Insight" class="form-control col-md-12 col-xs-12" type="text" name="background">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" style="color:#258039">Attractiveness**</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input required id="attractive" class="form-control col-md-12 col-xs-12" type="text" name="attractive">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" style="color:#258039">Target RTO**</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input required id="rto" class="form-control col-md-12 col-xs-12" type="date" name="rto">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-2 col-sm-9 col-xs-12" >
              <label class="control-label col-md-12 col-sm-3 col-xs-12" style="color:#258039">Sales Forecast**</label> 
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <table class="table table-bordered table-hover" id="tableklaim">
        				<tbody>
        				  <tr id='add0'>
                    <td><input type="number" value="0" name="forecast[]" class="form-control"></td>
                    <td>
                      <select requaired name="satuan[]"  id="detail1" class="form-control">
                        <option value='1 Month'>1 Month</option>
                        <option value='2 Month'>2 Month</option>
                        <option value='3 Month'>3 Month</option>
                      </select>
                    </td>
                    <td><input type="text" placeholder="Note" name="keterangan[]" class="form-control"></td>
                    <td>
                      <button id="add_data" type="button" class="btn btn-info btn-sm pull-left" title="Add"><li class="fa fa-plus"></li></button>
                    </td>
                  </tr>
        					<tr id='add1'></tr>
        				</tbody>
      				</table>
            </div>
          </div>
          <div class="ln_solid"></div>
        </div>
      </div>
    </div>
	</div>

  <?php $date = Date('j-F-Y'); ?>
  <input id="last_up" value="{{ $date }}" class="form-control col-md-12 col-xs-12" type="hidden" name="last_up">
  <div class="row">
    <div class="col-md-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h3><li class="fa fa-group"></li> Competitors</h3>
        </div>
        <div class="card-block">
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" style="color:#258039">Name**</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input required id="name_competitors" class="form-control col-md-12 col-xs-12" type="text" name="name_competitors">
            </div>
					</div>
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" style="color:#258039">Retailer Price**</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input required id="retailer_price" class="form-control col-md-12 col-xs-12" type="number" name="retailer_price">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" style="color:#258039">What's Special**</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input required id="special" class="form-control col-md-12 col-xs-12" placeholder="Special Ingredient" type="text" name="special">
            </div>
          </div>
          <div class="ln_solid"></div>
          <div class="col-md-6 col-md-offset-5">
            <button type="reset" class="btn btn-warning btn-sm"><li class="fa fa-repeat"></li> Reset</button>
            <button type="submit" class="btn btn-primary btn-sm"><li class="fa fa-check"></li> Submit</button>
            {{ csrf_field() }}
          </div>
        </div>
			</div>
		</div>
	</div>				
  </form>
</div>

@endsection
@section('s')
  
<script>

  $('.input').keyup(function(event) {
    // skip for arrow keys
    if(event.which >= 37 && event.which <= 40) return;

    // format number
    $(this).val(function(index, value) {
      return value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    });
  });

  function plus(){
    var plus = document.getElementById('radio_plus')

    if(plus.checked != true){
      document.getElementById('umur').innerHTML = "";
    }else{
      document.getElementById('umur').innerHTML =
        "<input type='text' readonly class='form-control' value='+' name='sampaiumur' id='sampaiumur'>"
    }
  }

  function minus(){
    var minus = document.getElementById('radio_minus')

    if(minus.checked != true){
      document.getElementById('umur').innerHTML = "";
    }else{
      document.getElementById('umur').innerHTML =
        "<input type='text' readonly class='form-control' value='-' name='sampaiumur' id='sampaiumur'>"
    }
  }

  function to(){
    var to = document.getElementById('radio_to')

    if(to.checked != true){
      document.getElementById('umur').innerHTML = "";
    }else{
      document.getElementById('umur').innerHTML =
        '<input type="number" name="sampaiumur" id="sampaiumur" class="form-control col-md-12 col-xs-12">'
    }
  }
</script>

<script>
  $(document).ready(function() {
    // delete baris proses
    $('#tableklaim').on('click', 'tr a', function(e) {
      e.preventDefault();
      $(this).parents('tr').remove();
  });

  var i = 1;
    $("#add_data").click(function() {
      $('#add' + i).html( "<td><input type='number' name='forecast[]' class='form-control'></td><td><select name='satuan[]'  class='form-control'>"+
      "<option disabled selected>--> Select One <--</option>"+
      "<option value='1 Month'>1 Month</option>"+
      "<option value='2 Month'>2 Month</option>"+
      "<option value='3 Month'>3 Month</option>"+
      "</select></td><td><input type='text' name='keterangan[]' class='form-control'></td>"+
      "<td><a hreaf='' class='btn btn-danger btn-sm' title='Delete'><li class='fa fa-trash'></li></a></td>");

      $('#tableklaim').append('<tr id="add' + (i + 1) + '"></tr>');
      i++;
    });
  });
</script>

<script>
  function baru(){
    var baru = document.getElementById('radio_baru')

    if(baru.checked != true){
      document.getElementById('lihat').innerHTML = "";
    }else{
      document.getElementById('lihat').innerHTML =
        "<div class='form-group'>"+
          "<label class='control-label col-md-2 col-sm-2 col-xs-12'>Configuration</label>&nbsp  &nbsp"+
       		"<input type='radio' name='gramasi' oninput='dua()' id='radio_dua'> 2 Dimensi &nbsp"+
       		"<input type='radio' name='gramasi' oninput='tiga()' id='radio_tiga'> 3 Dimensi &nbsp"+
      		"<input type='radio' name='gramasi' oninput='empat()' id='radio_empat'> 4 Dimensi &nbsp"+
					"<div id='tampil'></div>"+
				"</div>"+
        "<hr>"+
        "<h4><b><lable class='control-label col-md-2 col-sm-3 col-xs-12' for='first-name'>*Information</lable></b></h4>"+
        "<br><br>"+
        "<div class='form-group'>"+
          "<label class='control-label col-md-2 col-sm-3 col-xs-12' for='first-name'>Primary</label>"+
          "<div class='col-md-10 col-sm-10 col-xs-12'>"+
            "<textarea name='primary' id='primary' class='col-md-10 col-sm-10 col-xs-12' rows='1'></textarea>"+
          "</div>"+
        "</div>"+
        "<div class='form-group'>"+
          "<label class='control-label col-md-2 col-sm-3 col-xs-12' for='last-name'>Secondary</label>"+
          "<div class='col-md-10 col-sm-10 col-xs-12'>"+
            "<textarea name='secondary' id='secondary' class='col-md-10 col-sm-10 col-xs-12' rows='1'></textarea>"+
          "</div>"+
        "</div>"+
        "<div class='form-group'>"+
          "<label for='middle-name' class='control-label col-md-2 col-sm-3 col-xs-12'>Tertiary </label>"+
          "<div class='col-md-10 col-sm-10 col-xs-12'>"+
            "<textarea name='tertiary' id='tertiary' class='col-md-10 col-sm-10 col-xs-12' rows='1'></textarea>"+
          "</div>"+
        "</div>"+
        "<div class='form-group'>"+
          "<label for='middle-name' class='control-label col-md-2 col-sm-3 col-xs-12'>Additional data </label>"+
          "<div class='col-md-9 col-sm-9 col-xs-12'>"+
            "<table class='table table-bordered' id='tablekemas'>"+
              "<thead>"+
                "<tr>"+
                  "<td class='text-center'>Oracle</td>"+
                  "<td class='text-center'>KK Code</td>"+
                  "<td class='text-center'>Note</td>"+
                  "<td class='text-center'>Action</td>"+
                "</tr>"+
              "</thead>"+
              "<tbody>"+
                "<tr id='addrow0'>"+
                  "<td><input type='text' name='oracle[]' id='oracle' class='form-control'></td>"+
                  "<td><input type='text' name='kk[]' id='kk' class='form-control'></td>"+
                  "<td><input type='text' name='information[]' id='information' class='form-control'></td>"+
                  "<td><button id='add_kemas' type='button' class='btn btn-info btn-sm pull-left' title='Add'><li class='fa fa-plus'></li></button></td>"+
                "</tr>"+
                "<tr id='addrow1'></tr>"+
              "</tbody>"+
            "</table>"+
          "</div>"+
        "</div>"+
        "<div class='ln_solid'></div>"

      $(document).ready(function() {
        // delete baris proses
        $('#tablekemas').on('click', 'tr a', function(e) {
          e.preventDefault();
          $(this).parents('tr').remove();
        });

        var i = 1;
        $("#add_kemas").click(function() {
          $('#addrow' + i).html( "<td><input type='text' name='oracle[]' id='oracle' class='form-control'>"+
          "<td><input type='text' name='kk[]' id='kk' class='form-control'></td>"+
          "<td><input type='text' name='information[]' id='information' class='form-control'></td>"+
          "<td><a hreaf='' class='btn btn-danger btn-sm' title='Delete'><li class='fa fa-trash'></li></a></td>");

          $('#tablekemas').append('<tr id="addrow' + (i + 1) + '"></tr>');
          i++;
        });
      });
    }
  }

  function dua(){
    var dua = document.getElementById('radio_dua');

    if(dua.checked != true){
      document.getElementById('tampil').innerHTML = "";
    }else{
      document.getElementById('tampil').innerHTML = "<br><div class='panel panel-default'>"+
	      "<div class='panel-heading'><h5>Configuration</h5></div>"+
	        "<div class='panel-body'>"+
            "<div class='form-group'>"+
              "<div>"+
                "<input type='hidden' name='finance' maxlength='45' value='' class='form-control col-md-12 col-xs-12'>"+
              "</div>"+
              "<div class='col-md-1 col-sm-1 col-xs-12'>"+
                "<input name='tersier' id='tersier' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='text'>"+
              "</div>"+
              "<div class='col-md-2 col-sm-2 col-xs-12'>"+
                "<select class='form-control' name='s_tersier'>"+
                  "<option disabled='' selected=''>Tersier</option>"+
                  "<option value='D'>D</option>"+
                  "<option value='S'>S</option>"+
                  "<option value='G'>G</option>"+
                  "<option value='SB'>SB</option>"+
                  "<option value='O'>O</option>"+
							    "<option value='R'>R</option>"+
                  "<option value='P'>P</option>"+
                  "<option value='GST'>GST</option>"+
                  "<option value='BTL'>BTL</option>"+
                  "<option value='B'>B</option>"+
                "</select>"+
              "</div>"+
              "<div class='col-md-1 col-sm-1 col-xs-12'>"+
                "<input name='primer' id=primer' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='text'>"+
              "</div>"+
              "<div class='col-md-2 col-sm-2 col-xs-12'>"+
                "<select class='form-control' name='s_primer'>"+
                  "<option disabled='' selected=''>Primer</option>"+
                  "<option value='G'>G</option>"+
                  "<option value='ML'>ML</option>"+
                  "<option value='Tablet'>Tablet</option>"+
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
	      "<div class='panel-heading'><h5>Configuration</h5></div>"+
	        "<div class='panel-body'>"+
            "<div class='form-group'>"+
              "<div>"+
                "<input type='hidden' name='finance' maxlength='45' value='' class='form-control col-md-12 col-xs-12'>"+
              "</div>"+
              "<div class='col-md-1 col-sm-1 col-xs-12'>"+
                "<input name='tersier' id='tersier' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='text'>"+
              "</div>"+
              "<div class='col-md-2 col-sm-2 col-xs-12'>"+
                "<select class='form-control' name='s_tersier'>"+
                  "<option disabled='' selected=''>Tersier</option>"+
                  "<option value='D'>D</option>"+
                  "<option value='S'>S</option>"+
                  "<option value='G'>G</option>"+
                  "<option value='SB'>SB</option>"+
                  "<option value='O'>O</option>"+
							    "<option value='R'>R</option>"+
                  "<option value='P'>P</option>"+
                  "<option value='GST'>GST</option>"+
                  "<option value='BTL'>BTL</option>"+
                "<option value='B'>B</option>"+
                "</select>"+
              "</div>"+
              "<div class='col-md-1 col-sm-1 col-xs-12'>"+
                "<input name='sekunder1' id='sekunder1' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='text'>"+
              "</div>"+
              "<div class='col-md-2 col-sm-2 col-xs-12'>"+
                "<select class='form-control' name='s_sekunder1'>"+
                  "<option disabled='' selected=''>Sekunder 1</option>"+
                  "<option value='D'>D</option>"+
                  "<option value='S'>S</option>"+
                  "<option value='G'>G</option>"+
                  "<option value='SB'>SB</option>"+
                  "<option value='O'>O</option>"+
							    "<option value='R'>R</option>"+
                  "<option value='P'>P</option>"+
                  "<option value='GST'>GST</option>"+
                  "<option value='BTL'>BTL</option>"+
                "<option value='B'>B</option>"+
                "</select>"+
              "</div>"+
              "<div class='col-md-1 col-sm-1 col-xs-12'>"+
                "<input name='primer' id='primer1' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='text'>"+
              "</div>"+
              "<div class='col-md-2 col-sm-2 col-xs-12'>"+
                "<select class='form-control' name='s_primer'>"+
                  "<option disabled='' selected=''>Primer</option>"+
                  "<option value='G'>G</option>"+
                  "<option value='ML'>ML</option>"+
                  "<option value='Tablet'>Tablet</option>"+
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
	    "<div class='panel-heading'><h5>Configuration</h5></div>"+
	      "<div class='panel-body'>"+
          "<div class='form-group'>"+
            "<div class='col-md-1 col-sm-1 col-xs-12'>"+
              "<input name='tersier' id='tersier' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='text'>"+
            "</div>"+
            "<div class='col-md-2 col-sm-2 col-xs-12'>"+
              "<select class='form-control' name='s_tersier'>"+
                "<option disabled='' selected=''>Tersier</option>"+
                "<option value='D'>D</option>"+
                "<option value='S'>S</option>"+
                "<option value='G'>G</option>"+
                "<option value='SB'>SB</option>"+
                "<option value='O'>O</option>"+
							  "<option value='R'>R</option>"+
                "<option value='P'>P</option>"+
                "<option value='GST'>GST</option>"+
                "<option value='BTL'>BTL</option>"+
                "<option value='B'>B</option>"+
              "</select>"+
            "</div>"+
            "<div class='col-md-1 col-sm-1 col-xs-12'>"+
              "<input name='sekunder1' id='sekunder1' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='text'>"+
            "</div>"+
            "<div class='col-md-2 col-sm-2 col-xs-12'>"+
              "<select class='form-control' name='s_sekunder1'>"+
                "<option disabled='' selected=''>Sekunder 1</option>"+
                "<option value='D'>D</option>"+
                "<option value='S'>S</option>"+
                "<option value='G'>G</option>"+
                "<option value='SB'>SB</option>"+
                "<option value='O'>O</option>"+
							  "<option value='R'>R</option>"+
                "<option value='P'>P</option>"+
                "<option value='GST'>GST</option>"+
                "<option value='BTL'>BTL</option>"+
                "<option value='B'>B</option>"+
              "</select>"+
            "</div>"+ "<div class='col-md-1 col-sm-1 col-xs-12'>"+
              "<input name='sekunder2' id='sekunder2' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='text'>"+
            "</div>"+
            "<div class='col-md-2 col-sm-2 col-xs-12'>"+
              "<select class='form-control' name='s_sekunder2'>"+
                "<option disabled='' selected=''>Sekunder 2</option>"+
                "<option value='D'>D</option>"+
                "<option value='S'>S</option>"+
                "<option value='G'>G</option>"+
                "<option value='SB'>SB</option>"+
                "<option value='O'>O</option>"+
							  "<option value='R'>R</option>"+
                "<option value='P'>P</option>"+
                "<option value='GST'>GST</option>"+
                "<option value='BTL'>BTL</option>"+
                "<option value='B'>B</option>"+
              "</select>"+
            "</div>"+
            "<div class='col-md-1 col-sm-1 col-xs-12'>"+
              "<input name='primer' id='primer' class='date-picker form-control maxlength='4' col-md-12 col-xs-12' type='text'>"+
            "</div>"+
            "<div class='col-md-2 col-sm-2 col-xs-12'>"+
              "<select class='form-control' name='s_primer'>"+
                "<option disabled='' selected=''>Primer</option>"+
                "<option value='G'>G</option>"+
                "<option value='ML'>ML</option>"+
                "<option value='Tablet'>Tablet</option>"+
              "</select>"+
            "</div>"+
          "</div>"+
        "</div>"+
      "</div>"  ;
    }
  }

  var project = []
  <?php foreach($project as $key => $value) { ?>
  if(!project){
    project += [ { '<?php echo $key; ?>' : '<?php echo $value->kemas_eksis; ?>', } ];
  } else { project.push({ '<?php echo $key; ?>' : '<?php echo $value->kemas_eksis; ?>', }) }
  <?php } ?>

  var project1 = []
  <?php foreach($project as $key => $value) { ?>
  if(!project1){
    project1 += [ { '<?php echo $key; ?>' : '<?php echo $value->project_name; ?>', } ];
  } else { project1.push({ '<?php echo $key; ?>' : '<?php echo $value->project_name; ?>', }) }
  <?php } ?>

  var idkemas = []
  <?php foreach($kemas as $key => $value) { ?>
  if(!idkemas){
    idkemas += [ { '<?php echo $key; ?>' : '<?php echo $value->id_kemas; ?>', } ];
  } else { idkemas.push({ '<?php echo $key; ?>' : '<?php echo $value->id_kemas; ?>', }) }
  <?php } ?>
  var kemas = []
  <?php foreach($kemas as $key => $value) { ?>
  if(!kemas){
    kemas += [ { '<?php echo $key; ?>' : '<?php echo $value->primer; ?>', } ];
  } else { kemas.push({ '<?php echo $key; ?>' : '<?php echo $value->primer; ?>', }) }
  <?php } ?>
  var kemas1 = []
  <?php foreach($kemas as $key => $value) { ?>
  if(!kemas1){
    kemas1 += [ { '<?php echo $key; ?>' : '<?php echo $value->s_primer; ?>', } ];
  } else { kemas1.push({ '<?php echo $key; ?>' : '<?php echo $value->s_primer; ?>', }) }
  <?php } ?>
  var kemas2 = []
  <?php foreach($kemas as $key => $value) { ?>
  if(!kemas2){
    kemas2 += [ { '<?php echo $key; ?>' : '<?php echo $value->sekunder1; ?>', } ];
  } else { kemas2.push({ '<?php echo $key; ?>' : '<?php echo $value->sekunder1; ?>', }) }
  <?php } ?>
  var kemas3 = []
  <?php foreach($kemas as $key => $value) { ?>
  if(!kemas3){
    kemas3 += [ { '<?php echo $key; ?>' : '<?php echo $value->s_sekunder1; ?>', } ];
  } else { kemas3.push({ '<?php echo $key; ?>' : '<?php echo $value->s_sekunder1; ?>', }) }
  <?php } ?>
  var kemas4 = []
  <?php foreach($kemas as $key => $value) { ?>
  if(!kemas4){
    kemas4 += [ { '<?php echo $key; ?>' : '<?php echo $value->sekunder2; ?>', } ];
  } else { kemas4.push({ '<?php echo $key; ?>' : '<?php echo $value->sekunder2; ?>', }) }
  <?php } ?>
  var kemas5 = []
  <?php foreach($kemas as $key => $value) { ?>
  if(!kemas5){
    kemas5 += [ { '<?php echo $key; ?>' : '<?php echo $value->s_sekunder2; ?>', } ];
  } else { kemas5.push({ '<?php echo $key; ?>' : '<?php echo $value->s_sekunder2; ?>', }) }
  <?php } ?>
  var kemas6 = []
  <?php foreach($kemas as $key => $value) { ?>
  if(!kemas6){
    kemas6 += [ { '<?php echo $key; ?>' : '<?php echo $value->tersier; ?>', } ];
  } else { kemas6.push({ '<?php echo $key; ?>' : '<?php echo $value->tersier; ?>', }) }
  <?php } ?>
  var kemas7 = []
  <?php foreach($kemas as $key => $value) { ?>
  if(!kemas7){
    kemas7 += [ { '<?php echo $key; ?>' : '<?php echo $value->s_tersier; ?>', } ];
  } else { kemas7.push({ '<?php echo $key; ?>' : '<?php echo $value->s_tersier; ?>', }) }
  <?php } ?>

  var pilihan = '';
  for(var i = 0; i < Object.keys(project).length; i++){
  pilihan += '<option value="'+project[i][i]+'">'+project1[i][i]+'</option>';
  }

  var kemaseksis = '';
  for(var i = 0; i < Object.keys(kemas).length; i++){
  kemaseksis += '<option value="'+idkemas[i][i]+'">'+kemas[i][i]+''+kemas1[i][i]+' '+kemas2[i][i]+''+kemas3[i][i]+' '+kemas4[i][i]+''+kemas5[i][i]+' '+kemas6[i][i]+''+kemas7[i][i]+'</option>';
  }

  function pilih(){
    var eksis = document.getElementById('radio_project')

    if(eksis.checked != true){
      document.getElementById('lihat').innerHTML = "";
    }else{
      document.getElementById('lihat').innerHTML =
      "<div class='form-group'>"+
        "<div class='form-group'>"+
          "<label class='control-label col-md-2 col-sm-3 col-xs-12' for='first-name'>Configuration</label>"+
          "<div class='col-md-9 col-sm-10 col-xs-12'>"+
            '<select name="data_eksis" class="form-control" id="txtOccupation" >'+
            '<option value="" readonly selected>-->Select One<--</option>'+pilihan+'</select>'+
          "</div>"+
        "</div>"+"<div class='form-group'>"+
        "<hr>"+
      "</di>"
    }
  }

  function eksis(){
    var eksis = document.getElementById('radio_eksis')

    if(eksis.checked != true){
      document.getElementById('lihat').innerHTML = "";
    }else{
      document.getElementById('lihat').innerHTML =
      "<div class='form-group'>"+
        "<div class='form-group'>"+
          "<label class='control-label col-md-2 col-sm-3 col-xs-12' for='first-name'>Configuration</label>"+
          "<div class='col-md-9 col-sm-10 col-xs-12'>"+
            '<select name="data_eksis" class="form-control" id="eksis" >'+
              '<option value="" readonly selected>-->Select One<--</option>'+
              kemaseksis+
            '</select>'+
          "</div>"+
        "</div>"+"<div class='form-group'>"+
        "<hr>"+
      "</div>"
    }
  }
</script>

<script src="{{ asset('js/select2.min.js') }}"></script>
<script type="text/javascript">
  $('select').select2({
    placeholder: '-->Select One<--',
    allowClear: true
  });
</script>

<script>
  $(document).ready(function() {

    // delete baris proses
    $('#tab_logic').on('click', 'tr a', function(e) {
      e.preventDefault();
      $(this).parents('tr').remove();
    });
  
    var idkomponen = []
    <?php foreach($komponen as $key => $value) { ?>
      if(!idkomponen){
        idkomponen += [ { '<?php echo $key; ?>' : '<?php echo $value->id; ?>', } ];
      } else { idkomponen.push({ '<?php echo $key; ?>' : '<?php echo $value->id; ?>', }) }
    <?php } ?>

    var komponen = []
    <?php foreach($komponen as $key => $value) { ?>
      if(!komponen){
        komponen += [ { '<?php echo $key; ?>' : '<?php echo $value->komponen; ?>', } ];
      } else { komponen.push({ '<?php echo $key; ?>' : '<?php echo $value->komponen; ?>', }) }
    <?php } ?>

    var komponen1 = '';
      for(var i = 0; i < Object.keys(komponen).length; i++){
      komponen1 += '<option value="'+idkomponen[i][i]+'">'+komponen[i][i]+'</option>';
    }

    var i = 1;
    var a = {!! json_encode($Ddetail) !!};
    $("#add_row").click(function() {
      $('#addr' + i).html("<input type='hidden' value='"+(a+i)+"' name='iddetail' id='iddetail'><td><select class='form-control items' name='komponen[]' id='komponen"+(a+i)+"' >"+komponen1+
        "</select></td><td><select name='klaim[]' class='form-control items' id='klaimm"+(a+i)+"'>"+
        "</select></td><td><select name='detail[]' multiple='multiple' class='form-control items' id='detaill"+(a+i)+"'>"+
        "</select></td><td><textarea type='text' class='form-control' name='ket[]' id='ket'></textarea></td><td class='text-center'><a hreaf='' class='btn btn-danger btn-sm' title='Delete'><li class='fa fa-trash'></li></a></td>");

        var b = a+i;
        console.log(b);
        $('#komponen' + b).on('change', function(){
          var myId = $(this).val();
            if(myId){
              $.ajax({
                url: '{{URL::to('getdetail')}}/'+myId,
                type: "GET",
                dataType: "json",
                beforeSend: function(){
                $('#loader').css("visibility", "visible");
            },

            success:function(data){
              console.log(data)
                $('#detaill' + b).empty();
                $.each(data, function(key, value){
                  $('#detaill' + b).append('<option value="'+ key +'">' + value + '</option>');
                });
              console.log(data)
              },
              complete: function(){
                $('#loader').css("visibility","hidden");
            }
          });

          }
          else{
            $('#detaill' + b).empty();
          }
        });

        $('#komponen'+b).on('change', function(){
      var myId = $(this).val();
        if(myId){
          $.ajax({
          url: '{{URL::to('getkomponen')}}/'+myId,
          type: "GET",
          dataType: "json",
          beforeSend: function(){
              $('#loader').css("visibility", "visible");
          },

          success:function(data){
            console.log(data)
              $('#klaimm'+b).empty();
              $.each(data, function(key, value){
                  $('#klaimm'+b).append('<option value="'+ key +'">' + value + '</option>');
              });
          console.log(data)
          },
          complete: function(){
                $('#loader').css("visibility","hidden");
            }
        });

        }
        else{
            $('#klaimm'+b).empty();
        }
    });
      $('#tab_logic').append('<tr id="addr' + (i + 1) + '"></tr>');
      i++;
    });

    $('#komponen').on('change', function(){
      var myId = $(this).val();
        if(myId){
          $.ajax({
          url: '{{URL::to('getkomponen')}}/'+myId,
          type: "GET",
          dataType: "json",
          beforeSend: function(){
              $('#loader').css("visibility", "visible");
          },

          success:function(data){
            console.log(data)
              $('#klaimm').empty();
              $.each(data, function(key, value){
                  $('#klaimm').append('<option value="'+ key +'">' + value + '</option>');
              });
          console.log(data)
          },
          complete: function(){
                $('#loader').css("visibility","hidden");
            }
        });

        }
        else{
            $('#klaimm').empty();
        }
    });

    $('#komponen').on('change', function(){
      var myId = $(this).val();
        if(myId){
          $.ajax({
          url: '{{URL::to('getdetail')}}/'+myId,
          type: "GET",
          dataType: "json",
          beforeSend: function(){
              $('#loader').css("visibility", "visible");
          },

          success:function(data){
            console.log(data)
              $('#detaill').empty();
              $.each(data, function(key, value){
                  $('#detaill').append('<option value="'+ key +'">' + value + '</option>');
              });
          console.log(data)
          },
          complete: function(){
                $('#loader').css("visibility","hidden");
            }
        });

        }
        else{
            $('#katbpom').empty();
        }
    });

  });
</script>
@endsection