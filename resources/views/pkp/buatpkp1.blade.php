@extends('pv.tempvv')
@section('title', 'Request PKP')
@section('judulhalaman','Request PKP')
@section('content')

<div class="row">
  <div class="col-md-3 col-sm-3 col-xs-12"></div>
  <div class="col-md-8 col-sm-8 col-xs-12">
    <div class="tabbable">
      <ul class="nav nav-tabs wizard">
        <li class="active"><a href="" ><span class="nmbr">1</span> Information</a></li>
        <li class="completed"><a href=""><span class="nmbr">2</span> PKP</a></li>
        <li class="active"><a href=""><span class="nmbr">3</span> File</a></li>
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

<form class="form-horizontal form-label-left" method="POST" action="{{ route('tippp') }}">
<div class="row">
  <div class="col-md-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h3><li class="fa fa-file"></li> Background</h3>
      </div>
      <div class="card-block">
        <div class="x_content">
          <div class="form-group row">
            <input type="hidden" value="{{ $id_pkp->id_project }}" name="id">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name" * style="color:#31a9b8">Idea*</label>
            <div class="col-md-9 col-sm-8 col-xs-12">
              <textarea name="idea" id="idea" class="form-control col-md-12 col-xs-12" ></textarea>
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="last-name" style="color:#31a9b8">Target Market</label>
            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="last-name" style="color:#31a9b8">Gender*:</label>
            <div class="col-md-4 col-sm-3 col-xs-12">
              <select id="gender"  name="gender" class="form-control" >
                <option disabled selected>-- Select Gender --</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="Male dan Female">Male & Female</option>
              </select>
            </div>
            <label for="middle-name" class="control-label col-md-1 col-sm-1 col-xs-12" style="color:#31a9b8">SES* </label>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <select placeholder="SES" class="form-control form-control-line items" name="ses[]"   multiple="multiple">
                <option disabled="">-- Select One --</option>
                @foreach($ses as $ses)
                <option value="{{$ses->ses}}">{{$ses->ses}}</option>
                @endforeach
              </select>
            </div><br><br><br>
            <div class="form-group row">
              <label for="middle-name" class="control-label col-md-1 col-sm-2 col-xs-12"></label>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
              <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12" style="color:#31a9b8"> &nbsp  &nbsp Remarks SES* : </label>
              <div class="col-md-8 col-sm-7 col-xs-12">
                <input type="text"  name="remarks_ses" id="remarks_ses" class="form-control col-md-12 col-xs-12">
              </div>
            </div>
            <div class="form-group row">
              <label for="middle-name" class="control-label col-md-1 col-sm-2 col-xs-12"></label>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
              <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12" style="color:#31a9b8"> &nbsp  &nbsp Age Range form* : </label>
              <div class="col-md-2 col-sm-2 col-xs-12">
                <input type="number"  name="dariumur" id="dariumur" class="form-control col-md-12 col-xs-12">
              </div>
              <div class="col-md-2 col-sm-3 col-xs-12">&nbsp &nbsp &nbsp &nbsp &nbsp 
                <input type="radio" name="data" oninput="plus()" id="radio_plus"> + &nbsp /  
     			      <input type="radio" name="data" oninput="minus()" id="radio_minus"> - &nbsp /  
     			      <input type="radio" name="data" oninput="to()" id="radio_to"> To 
              </div>
              <div class="col-md-2 col-sm-2 col-xs-12" id="umur"></div>
            </div>
          </div>
          <?php $last = Date('j-F-Y'); ?>
          <input id="last_up" value="{{ $last }}" class="form-control col-md-12 col-xs-12" type="hidden" name="last_up">
          <div class="form-group row">
            <label for="middle-name" class="control-label col-md-2 col-sm-3 col-xs-12" style="color:#31a9b8">Uniqueness of Idea* </label>
            <div class="col-md-4 col-sm-3 col-xs-12">
              <select class="form-control form-control-line" name="uniq_idea" >
                <option disabled="" selected="">-- Select One --</option>
                @foreach($idea as $idea)
                <option value="{{ $idea->uniqueness_of_idea }}">{{ $idea->uniqueness_of_idea }}</option>
                @endforeach
              </select>
            </div>
            <label class="control-label col-md-1 col-sm-1 col-xs-12" style="color:#31a9b8">Estimated*</label>
            <div class="col-md-4 col-sm-4 col-xs-12">
              <select class="form-control form-control-line" name="estimated" >
                <option disabled="" selected="">-- Select Estimated potential market --</option>
                @foreach($market as $market)
                <option value="{{ $market->estimasi_market }}">{{ $market->estimasi_market }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name" style="color:#31a9b8">reason*</label>
            <div class="col-md-9 col-sm-8 col-xs-12">
              <textarea name="reason" id="reason" class="form-control col-md-12 col-xs-12" ></textarea>
            </div>
          </div>
          <div class="ln_solid"></div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h3><li class="fa fa-search"></li> Market Analysis</h3>
      </div>
      <div class="card-block">
        <div class="x_content">
          <div class="form-group row">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" style="color:#31a9b8">Launch* </label> &nbsp
      		  <input type="radio" name="data" oninput="template()" id="radio_temp"> Launch periode  &nbsp &nbsp
     			  <input type="radio" name="data" oninput="kalender()" id="radio_cal"> Launch date &nbsp &nbsp
          </div>
          <div id="tampilkan"></div>
          <div class="form-group row">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" style="color:#31a9b8">Aisle Placement*</label>
            <div class="col-md-9 col-sm-8 col-xs-12">
              <input type="text" placeholder="Aisle Placement" name="aisle" id="aisle" class="form-control col-md-12 col-xs-12">
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" style="color:#31a9b8">Comperitor*</label>
            <div class="col-md-4 col-sm-8 col-xs-12">
              <input type="text" placeholder="Comperitor" name="competitor" id="" class="form-control col-md-12 col-xs-12">
            </div>
            <label class="control-label col-md-1 col-sm-3 col-xs-12" style="color:#31a9b8">Competitiveness*</label>
            <div class="col-md-4 col-sm-8 col-xs-12">
              <input type="text" placeholder="Competitive Advantage" name="Competitive" id="" class="form-control col-md-12 col-xs-12">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-12 col-sm-12 col-xs-12" style="overflow-x: scroll;">
              <table class="table table-bordered table-hover" id="tabledata">
                <thead>
                  <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                    <th colspan="2" width="25%" class="text-center">Forecast</th>
                    <th class="text-center">Configuration Concept</th>
                    <th width="10%" class="text-center">UOM</th>
                    <th width="10%" class="text-center">NFI Price</th>
                    <th width="10%" class="text-center">Costumer Price</th>
                    <th width="5%"></th>
                  </tr>
                </thead>
        				<tbody>
        				  <tr id='tr_clone'>
                    <td><input type="number" name="forecast[]" min="0" step="0.0001" width="10%" class="form-control" required></td>
                    <td>
                      <select name="satuan[]" class="form-control items">
                        <option value="1 Month">1 Month</option>
                        <option value="2 Month">2 Month</option>
                        <option value="3 Month">3 Month</option>
                      </select>
                    </td>
                    <td class="text-center">
                      <input type="hidden" value="{{$eksis}}" name="kemas" id="kemas">
                      <input type="radio" name="gramasi1[]" required id="rad1" value="pertama1" class="rad"/> 2 Dimensi &nbsp
                      <input type="radio" name="gramasi1[]" required id="rad1" value="kedua1" class="rad"/> 3 Dimensi &nbsp
                      <input type="radio" name="gramasi1[]" required id="rad1" value="ketiga1" class="rad"/> 4 Dimensi &nbsp
					            <div id='tampil1'></div>
                    <td>
                      <select name="uom[]" id="UOM" class="form-control">
                        @foreach($data_uom as $data)
                        <option value="{{$data->kode}}">{{$data->kode}}</option>
                        @endforeach
                      </select>
                    </td>
                    <td><input type="number" required class="form-control" name="price[]" id="price"></td>
                    <td><input type="number" required class="form-control" name="costumer[]" id="costumer"></td>
                    <td>
                      <button id="add_data" type="button" class="btn btn-info btn-sm pull-left tr_clone_add"><li class="fa fa-plus"></li></button>
                    </td>
                  </tr>
        					<tr id='addrow1'></tr>
        				</tbody>
      				</table>
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" style="color:#31a9b8">Remarks Forecast*</label>
            <div class="col-md-9 col-sm-8 col-xs-12">
              <textarea name="remarks_forecash" id="remarks_forecash" class="form-control col-md-12 col-xs-12" rows="2"></textarea>
            </div>
          </div>
          <div class="ln_solid"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h3><li class="fa fa-star"></li> Product Features</h3>
      </div>
      <div class="card-block">
        <div class="x_content">
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" style="color:#31a9b8">Product Form*</label>
            <div class="col-md-9 col-sm-8 col-xs-12">
              <select  id="product" name="product" class="form-control" >
                <option disabled selected>-- Select one --</option>
                <option value="powder">Powder</option>
                <option value="solid">Solid</option>
                <option value="paste">Paste</option>
                <option value="liquid">Liquid</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" style="color:#31a9b8">Remarks Product Form*</label>
            <div class="col-md-9 col-sm-8 col-xs-12">
              <textarea name="remarks_product_form" id="remarks_product_form" class="form-control col-md-12 col-xs-12" rows="2"></textarea>
            </div>
          </div>
          @if(auth()->user()->role->namaRule == 'pv_lokal' || auth()->user()->role->namaRule == 'admin')
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" style="color:#cf3721">AKG^</label>
            <div class="col-md-9 col-sm-8 col-xs-12">
              <select name="akg" id="akg" class="form-control" required>
                <option value=""></option>
                @foreach($tarkon as $tr)
                <option value="{{ $tr->id_tarkon}}">{{$tr->tarkon}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" style="color:#cf3721">No category BPOM^</label>
            <div class="col-md-2 col-sm-4 col-xs-12">
              <select class="form-control"  id="bpom" name="bpom" required>
                <option value=""></option>
                @foreach($pangan as $dp)
                <option value="{{ $dp->id_pangan }}">{{ $dp->no_kategori }}</option>
                @endforeach
              </select>
            </div>
            <label class="control-label col-md-0 col-sm-0" style="color:#cf3721"></label>
            <div class="col-md-3 col-sm-4 col-xs-12">
              <select name="katbpom"  id="katbpom" class="form-control">
                <option value=""></option>
                @foreach($pangan as $kat)
                <option value="{{$kat->id_pangan}}">{{$kat->kategori}}</option>
                @endforeach
              </select>
            </div>
            <label class="control-label col-md-1 col-sm-3 col-xs-12" style="color:#cf3721">category</label>
            <div class="col-md-3 col-sm-8 col-xs-12">
              <select name="olahan"  id="olahan" class="form-control">
              </select>
            </div>
          </div>
          @endif
          <div id="lihat"></div>
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" style="color:#31a9b8">prefered flavour (varian/rasa)*</label>
            <div class="col-md-9 col-sm-8 col-xs-12">
              <textarea id="prefered" class="form-control col-md-12 col-xs-12" type="text" name="prefered"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" style="color:#258039">Serving Suggestion (gr/ml)**</label>
            <div class="col-md-9 col-sm-8 col-xs-12">
              <textarea  id="suggestion" class="form-control col-md-12 col-xs-12" type="text" name="suggestion"></textarea>
            </div>
          </div>	
          <div class="form-group">
            <label  class="control-label col-md-2 col-sm-3 col-xs-12" style="color:#31a9b8">Mandatory Ingredient*</label>
            <div class="col-md-9 col-sm-8 col-xs-12">
              <textarea id="ingredient"  class="form-control col-md-12 col-xs-12" placeholder="" type="text" name="ingredient"></textarea>
            </div>
          </div>	
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" style="color:#31a9b8">Product Benefits*</label>
            <div class="col-md-9 col-sm-8 col-xs-12">
              <textarea  id="benefits" class="form-control col-md-12 col-xs-12" type="text" name="benefits"></textarea>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-12 col-sm-12 col-xs-12" style="overflow-x: scroll;">
              <table class="table table-bordered table-hover" id="tab_logic">
        				<thead>
                  <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
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
          <input type="hidden" value="{{ Auth::user()->email }}" name="pengirim1" id="pengirim1">
          @foreach($teams as $teams)
            <input type="hidden" value="{{$teams->user->name}}" name="namatujuan[]" id="namatujuan">
            <input type="hidden" value="{{$teams->user->email}}" name="emailtujuan[]" id="emailtujuan">
          @endforeach
          <div class="col-md-6 col-md-offset-5 col-sm-offset-3">
            <button type="reset" class="btn btn-danger btn-sm">Reset</button>
            <button type="submit" class="btn btn-primary btn-sm">Submit And Next</button>
            {{ csrf_field() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</form>

@endsection
@section('s')
<script>
  
  $(document).ready(function() {

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
        "</select></td><td><textarea type='text' class='form-control' name='ket[]' id='ket'></textarea></td><td></td>");

        var b = a+i;
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
                $('#detaill' + b).empty();
                $.each(data, function(key, value){
                  $('#detaill' + b).append('<option value="'+ key +'">' + value + '</option>');
                });
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
              $('#klaimm'+b).empty();
              $.each(data, function(key, value){
                $('#klaimm'+b).append('<option value="'+ key +'">' + value + '</option>');
              });
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
              $('#klaimm').empty();
              $.each(data, function(key, value){
                  $('#klaimm').append('<option value="'+ key +'">' + value + '</option>');
              });
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
              $('#detaill').empty();
              $.each(data, function(key, value){
                  $('#detaill').append('<option value="'+ key +'">' + value + '</option>');
              });
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

<script>
  $(document).ready(function() {
    // delete baris proses
    $('#tabledata').on('click', 'tr a', function(e) {
    e.preventDefault();
        $(this).parents('tr').remove();
    });
  });

  var uom = []
  <?php foreach($uom as $key => $value) { ?>
  if(!uom){
    uom += [ { '<?php echo $key; ?>' : '<?php echo $value->primary_uom; ?>', } ];
  } else { uom.push({ '<?php echo $key; ?>' : '<?php echo $value->primary_uom; ?>', }) }
  <?php } ?>

  var kode_uom = []
  <?php foreach($uom as $key => $value) { ?>
  if(!kode_uom){
    kode_uom += [ { '<?php echo $key; ?>' : '<?php echo $value->kode; ?>', } ];
  } else { kode_uom.push({ '<?php echo $key; ?>' : '<?php echo $value->kode; ?>', }) }
  <?php } ?>

  var pilihan_uom = '';
  for(var i = 0; i < Object.keys(uom).length; i++){
    pilihan_uom += '<option value="'+kode_uom[i][i]+'">'+uom[i][i]+'</option>';
  }

  var uom_primer = []
  <?php foreach($uom_primer as $key => $value) { ?>
  if(!uom_primer){
    uom_primer += [ { '<?php echo $key; ?>' : '<?php echo $value->kode; ?>', } ];
  } else { uom_primer.push({ '<?php echo $key; ?>' : '<?php echo $value->kode; ?>', }) }
  <?php } ?>

  var pilihan_uom_primer = '';
  for(var i = 0; i < Object.keys(uom_primer).length; i++){
    pilihan_uom_primer += '<option value="'+uom_primer[i][i]+'">'+uom_primer[i][i]+'</option>';
  }

  var data_uom = []
  <?php foreach($data_uom as $key => $value) { ?>
    if(!data_uom){
      data_uom += [ { '<?php echo $key; ?>' : '<?php echo $value->kode; ?>', } ];
    } else { data_uom.push({ '<?php echo $key; ?>' : '<?php echo $value->kode; ?>', }) }
  <?php } ?>

  var datauom = '';
    for(var i = 0; i < Object.keys(data_uom).length; i++){
      datauom += '<option value="'+data_uom[i][i]+'">'+data_uom[i][i]+'</option>';
  }

  var i = 1;
  $("#add_data").click(function() {
    $('#addrow' + i).html( 
    "<td><input type='number' required name='forecast[]' class='form-control'></td>"+
    "<td>"+
      "<select name='satuan[]' class='form-control items'>"+
        "<option value='1 Month'>1 Month</option>"+
        "<option value='2 Month'>2 Month</option>"+
        "<option value='3 Month'>3 Month</option>"+
      "</select>"+
    "</td>"+
    "<td class='text-center'>"+
      "<input type='hidden' value='{{$eksis+1}}' name='kemas' id='kemas'>"+
      '<input type="radio" name="gramasi'+(i+1)+'[]" required id="rad'+(i+1)+'" value="pertama'+(i+1)+'" class="rad"/> 2 Dimensi &nbsp'+
      '<input type="radio" name="gramasi'+(i+1)+'[]" required id="rad'+(i+1)+'" value="kedua'+(i+1)+'" class="rad"/> 3 Dimensi &nbsp'+
      '<input type="radio" name="gramasi'+(i+1)+'[]" required id="rad'+(i+1)+'" value="ketiga'+(i+1)+'" class="rad"/> 4 Dimensi &nbsp'+
			"<div id='tampil"+(i+1)+"'></div>"+
    "<td>"+
      "<select name='uom[]' id='UOM' class='form-control'>"+datauom+"</select>"+
    "</td>"+
    "<td><input type='number' class='form-control' required name='price[]' id='price'></td>"+
    "<td><input type='number' class='form-control' required name='costumer[]' id='costumer'></td>)"+
    "<td><a hreaf='' class='btn btn-danger btn-sm'><li class='fa fa-trash'></li></a></td>");

      $(function(){
				$(":radio.rad").click(function(){
					if($(this).val() == "pertama"+i){
						document.getElementById('tampil'+i).innerHTML =
            "<table class='table'>"+
              "<tr>"+
                "<td><input name='tersier[]' id='tersier' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number' ></td>"+
                "<td>"+
                  "<select class='form-control' name='s_tersier[]' required>"+pilihan_uom+"</select>"+
                "</td>"+
              "</tr>"+
              "<tr hidden>"+
                "<td><input name='sekunder1[]' id='sekunder1' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number'></td>"+
                "<td><input name='s_sekunder1[]' id='s_sekunder1' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number'></td>"+
              "</tr>"+
              "<tr hidden>"+
                "<td><input name='sekunder2[]' id='sekunder2' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number'>"+
                "<td><input name='s_sekunder2[]' id='s_sekunder2' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number'>"+
              "</tr>"+
              "<tr>"+
                "<td><input name='primer[]' id='primer' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number'></td>"+
                "<td>"+
                  "<select class='form-control' name='s_primer[]'>"+pilihan_uom_primer+"</select>"+
                "</td>"+
              "</tr>"+
            "</table>"+
            "<h4><b><lable class='control-label col-md-2 col-sm-3 col-xs-12' for='first-name'>*Information</lable></b></h4>"+
            "<br><br>"+
            "<div class='form-group'>"+
              "<label class='control-label col-md-2 col-sm-3 col-xs-12' for='first-name'>Primary</label>"+
              "<div class='col-md-10 col-sm-10 col-xs-12'>"+
                "<input name='primary[]' id='primary' class='form-control col-md-12 col-xs-12' type='text' required>"+
              "</div>"+
            "</div>"+
            "<div class='form-group'>"+
              "<label class='control-label col-md-2 col-sm-3 col-xs-12' for='last-name'>Secondary</label>"+
              "<div class='col-md-10 col-sm-10 col-xs-12'>"+
                "<input name='secondary[]' id='secondary' class='form-control col-md-12 col-xs-12' type='text' required>"+
              "</div>"+
            "</div>"+
            "<div class='form-group'>"+
              "<label for='middle-name' class='control-label col-md-2 col-sm-3 col-xs-12'>Tertiary </label>"+
              "<div class='col-md-10 col-sm-10 col-xs-12'>"+
                "<input name='tertiary[]' id='tertiary' class='form-control col-md-12 col-xs-12' type='text' required>"+
              "</div>"+
            "</div>"+
            "<div class='ln_solid'></div>"
					}

          if($(this).val() == "kedua"+i){
						document.getElementById('tampil'+i).innerHTML =
            "<table class='table'>"+
              "<tr>"+
                "<td><input name='tersier[]' id='tersier' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number' ></td>"+
                "<td>"+
                  "<select class='form-control' name='s_tersier[]' required>"+pilihan_uom+"</select>"+
                "</td>"+
              "</tr>"+
              "<tr>"+
                "<td><input name='sekunder1[]' id='sekunder1' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number' required></td>"+
                "<td>"+
                  "<select class='form-control' name='s_sekunder1[]' required>"+pilihan_uom+"</select>"+
                "</td>"+
              "</tr>"+
              "<tr hidden>"+
                "<td><input name='sekunder2[]' id='sekunder2' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number'>"+
                "<td><input name='s_sekunder2[]' id='s_sekunder2' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number'>"+
              "</tr>"+
              "<tr>"+
                "<td><input name='primer[]' id='primer' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number'></td>"+
                "<td>"+
                  "<select class='form-control' name='s_primer[]'>"+pilihan_uom_primer+"</select>"+
                "</td>"+
              "</tr>"+
            "</table>"+
            "<h4><b><lable class='control-label col-md-2 col-sm-3 col-xs-12' for='first-name'>*Information</lable></b></h4>"+
            "<br><br>"+
            "<div class='form-group'>"+
              "<label class='control-label col-md-2 col-sm-3 col-xs-12' for='first-name'>Primary</label>"+
              "<div class='col-md-10 col-sm-10 col-xs-12'>"+
                "<input name='primary[]' id='primary' class='form-control col-md-12 col-xs-12' type='text' required>"+
              "</div>"+
            "</div>"+
            "<div class='form-group'>"+
              "<label class='control-label col-md-2 col-sm-3 col-xs-12' for='last-name'>Secondary</label>"+
              "<div class='col-md-10 col-sm-10 col-xs-12'>"+
                "<input name='secondary[]' id='secondary' class='form-control col-md-12 col-xs-12' type='text' required>"+
              "</div>"+
            "</div>"+
            "<div class='form-group'>"+
              "<label for='middle-name' class='control-label col-md-2 col-sm-3 col-xs-12'>Tertiary </label>"+
              "<div class='col-md-10 col-sm-10 col-xs-12'>"+
                "<input name='tertiary[]' id='tertiary' class='form-control col-md-12 col-xs-12' type='text' required>"+
              "</div>"+
            "</div>"+
            "<div class='ln_solid'></div>"
					}

          if($(this).val() == "ketiga"+i){
						document.getElementById('tampil'+i).innerHTML =
            "<table class='table'>"+
              "<tr>"+
                "<td><input name='tersier[]' id='tersier' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number' ></td>"+
                "<td>"+
                  "<select class='form-control' name='s_tersier[]' required>"+pilihan_uom+"</select>"+
                "</td>"+
              "</tr>"+
              "<tr>"+
                "<td><input name='sekunder1[]' id='sekunder1' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number' required></td>"+
                "<td>"+
                  "<select class='form-control' name='s_sekunder1[]' required>"+pilihan_uom+"</select>"+
                "</td>"+
              "</tr>"+
              "<tr>"+
                "<td><input name='sekunder2[]' id='sekunder2' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number' required>"+
                "<td>"+
                  "<select class='form-control' name='s_sekunder2[]' required>"+pilihan_uom+"</select>"+
                "</td>"+
              "</tr>"+
              "<tr>"+
                "<td><input name='primer[]' id='primer' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number'></td>"+
                "<td>"+
                  "<select class='form-control' name='s_primer[]'>"+pilihan_uom_primer+"</select>"+
                "</td>"+
              "</tr>"+
            "</table>"+
            "<h4><b><lable class='control-label col-md-2 col-sm-3 col-xs-12' for='first-name'>*Information</lable></b></h4>"+
            "<br><br>"+
            "<div class='form-group'>"+
              "<label class='control-label col-md-2 col-sm-3 col-xs-12' for='first-name'>Primary</label>"+
              "<div class='col-md-10 col-sm-10 col-xs-12'>"+
                "<input name='primary[]' id='primary' class='form-control col-md-12 col-xs-12' type='text' required>"+
              "</div>"+
            "</div>"+
            "<div class='form-group'>"+
              "<label class='control-label col-md-2 col-sm-3 col-xs-12' for='last-name'>Secondary</label>"+
              "<div class='col-md-10 col-sm-10 col-xs-12'>"+
                "<input name='secondary[]' id='secondary' class='form-control col-md-12 col-xs-12' type='text' required>"+
              "</div>"+
            "</div>"+
            "<div class='form-group'>"+
              "<label for='middle-name' class='control-label col-md-2 col-sm-3 col-xs-12'>Tertiary </label>"+
              "<div class='col-md-10 col-sm-10 col-xs-12'>"+
                "<input name='tertiary[]' id='tertiary' class='form-control col-md-12 col-xs-12' type='text' required>"+
              "</div>"+
            "</div>"+
            "<div class='ln_solid'></div>"
					}
				});
			});

    $('#tabledata').append('<tr id="addrow' + (i + 1) + '"></tr>');
    i++;
  });

  $(function(){
				$(":radio.rad").click(function(){
					if($(this).val() == "pertama1"){
						document.getElementById('tampil1').innerHTML =
            "<table class='table'>"+
              "<tr>"+
                "<td><input name='tersier[]' id='tersier' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number' ></td>"+
                "<td>"+
                  "<select class='form-control' name='s_tersier[]' required>"+pilihan_uom+"</select>"+
                "</td>"+
              "</tr>"+
              "<tr hidden>"+
                "<td><input name='sekunder1[]' id='sekunder1' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number'></td>"+
                "<td><input name='s_sekunder1[]' id='s_sekunder1' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number'></td>"+
              "</tr>"+
              "<tr hidden>"+
                "<td><input name='sekunder2[]' id='sekunder2' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number'>"+
                "<td><input name='s_sekunder2[]' id='s_sekunder2' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number'>"+
              "</tr>"+
              "<tr>"+
                "<td><input name='primer[]' id='primer' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number'></td>"+
                "<td>"+
                  "<select class='form-control' name='s_primer[]'>"+pilihan_uom_primer+"</select>"+
                "</td>"+
              "</tr>"+
            "</table>"+
            "<h4><b><lable class='control-label col-md-2 col-sm-3 col-xs-12' for='first-name'>*Information</lable></b></h4>"+
            "<br><br>"+
            "<div class='form-group'>"+
              "<label class='control-label col-md-2 col-sm-3 col-xs-12' for='first-name'>Primary</label>"+
              "<div class='col-md-10 col-sm-10 col-xs-12'>"+
                "<input name='primary[]' id='primary' class='form-control col-md-12 col-xs-12' type='text' required>"+
              "</div>"+
            "</div>"+
            "<div class='form-group'>"+
              "<label class='control-label col-md-2 col-sm-3 col-xs-12' for='last-name'>Secondary</label>"+
              "<div class='col-md-10 col-sm-10 col-xs-12'>"+
                "<input name='secondary[]' id='secondary' class='form-control col-md-12 col-xs-12' type='text' required>"+
              "</div>"+
            "</div>"+
            "<div class='form-group'>"+
              "<label for='middle-name' class='control-label col-md-2 col-sm-3 col-xs-12'>Tertiary </label>"+
              "<div class='col-md-10 col-sm-10 col-xs-12'>"+
                "<input name='tertiary[]' id='tertiary' class='form-control col-md-12 col-xs-12' type='text' required>"+
              "</div>"+
            "</div>"+
            "<div class='ln_solid'></div>"
					}

          if($(this).val() == "kedua1"){
						document.getElementById('tampil1').innerHTML =
            "<table class='table'>"+
              "<tr>"+
                "<td><input name='tersier[]' id='tersier' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number' ></td>"+
                "<td>"+
                  "<select class='form-control' name='s_tersier[]' required>"+pilihan_uom+"</select>"+
                "</td>"+
              "</tr>"+
              "<tr>"+
                "<td><input name='sekunder1[]' id='sekunder1' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number' required></td>"+
                "<td>"+
                  "<select class='form-control' name='s_sekunder1[]' required>"+pilihan_uom+"</select>"+
                "</td>"+
              "</tr>"+
              "<tr hidden>"+
                "<td><input name='sekunder2[]' id='sekunder2' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number'>"+
                "<td><input name='s_sekunder2[]' id='s_sekunder2' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number'>"+
              "</tr>"+
              "<tr>"+
                "<td><input name='primer[]' id='primer' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number'></td>"+
                "<td>"+
                  "<select class='form-control' name='s_primer[]'>"+pilihan_uom_primer+"</select>"+
                "</td>"+
              "</tr>"+
            "</table>"+
            "<h4><b><lable class='control-label col-md-2 col-sm-3 col-xs-12' for='first-name'>*Information</lable></b></h4>"+
            "<br><br>"+
            "<div class='form-group'>"+
              "<label class='control-label col-md-2 col-sm-3 col-xs-12' for='first-name'>Primary</label>"+
              "<div class='col-md-10 col-sm-10 col-xs-12'>"+
                "<input name='primary[]' id='primary' class='form-control col-md-12 col-xs-12' type='text'required>"+
              "</div>"+
            "</div>"+
            "<div class='form-group'>"+
              "<label class='control-label col-md-2 col-sm-3 col-xs-12' for='last-name'>Secondary</label>"+
              "<div class='col-md-10 col-sm-10 col-xs-12'>"+
                "<input name='secondary[]' id='secondary' class='form-control col-md-12 col-xs-12' type='text'required>"+
              "</div>"+
            "</div>"+
            "<div class='form-group'>"+
              "<label for='middle-name' class='control-label col-md-2 col-sm-3 col-xs-12'>Tertiary </label>"+
              "<div class='col-md-10 col-sm-10 col-xs-12'>"+
                "<input name='tertiary[]' id='tertiary' class='form-control col-md-12 col-xs-12' type='text'required>"+
              "</div>"+
            "</div>"+
            "<div class='ln_solid'></div>"
					}

          if($(this).val() == "ketiga1"){
						document.getElementById('tampil1').innerHTML =
            "<table class='table'>"+
              "<tr>"+
                "<td><input name='tersier[]' id='tersier' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number' ></td>"+
                "<td>"+
                  "<select class='form-control' name='s_tersier[]' required>"+pilihan_uom+"</select>"+
                "</td>"+
              "</tr>"+
              "<tr>"+
                "<td><input name='sekunder1[]' id='sekunder1' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number' required></td>"+
                "<td>"+
                  "<select class='form-control' name='s_sekunder1[]' required>"+pilihan_uom+"</select>"+
                "</td>"+
              "</tr>"+
              "<tr>"+
                "<td><input name='sekunder2[]' id='sekunder2' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number' required>"+
                "<td>"+
                  "<select class='form-control' name='s_sekunder2[]' required>"+pilihan_uom+"</select>"+
                "</td>"+
              "</tr>"+
              "<tr>"+
                "<td><input name='primer[]' id='primer' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='number'></td>"+
                "<td>"+
                  "<select class='form-control' name='s_primer[]'>"+pilihan_uom_primer+"</select>"+
                "</td>"+
              "</tr>"+
            "</table>"+
            "<h4><b><lable class='control-label col-md-2 col-sm-3 col-xs-12' for='first-name'>*Information</lable></b></h4>"+
            "<br><br>"+
            "<div class='form-group'>"+
              "<label class='control-label col-md-2 col-sm-3 col-xs-12' for='first-name'>Primary</label>"+
              "<div class='col-md-10 col-sm-10 col-xs-12'>"+
                "<input name='primary[]' id='primary' class='form-control col-md-12 col-xs-12' type='text' required>"+
              "</div>"+
            "</div>"+
            "<div class='form-group'>"+
              "<label class='control-label col-md-2 col-sm-3 col-xs-12' for='last-name'>Secondary</label>"+
              "<div class='col-md-10 col-sm-10 col-xs-12'>"+
                "<input name='secondary[]' id='secondary' class='form-control col-md-12 col-xs-12' type='text' required>"+
              "</div>"+
            "</div>"+
            "<div class='form-group'>"+
              "<label for='middle-name' class='control-label col-md-2 col-sm-3 col-xs-12'>Tertiary </label>"+
              "<div class='col-md-10 col-sm-10 col-xs-12'>"+
                "<input name='tertiary[]' id='tertiary' class='form-control col-md-12 col-xs-12' type='text' required>"+
              "</div>"+
            "</div>"+
            "<div class='ln_solid'></div>"
					}
				});
			});
</script>

<script>

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

<script type="text/javascript">
  $('.items').select2({
    placeholder: '-->Select One<--',
    allowClear: true
  });

  $(document).ready(function(){
     // Get BPOM
    $('#bpom').on('change', function(){
      var myId = $(this).val();
      if(myId){
        $.ajax({
          url: '{{URL::to('getpangan')}}/'+myId,
          type: "GET",
          dataType: "json",
          beforeSend: function(){
            $('#loader').css("visibility", "visible");
          },
          success:function(data){
            $('#katbpom').empty();
            $.each(data, function(key, value){
              $('#katbpom').append('<option value="'+ key +'">' + value + '</option>');
            });
          },
          complete: function(){
            $('#loader').css("visibility","hidden");
          }
        });
      }else{
        $('#katbpom').empty();
      }
    });

    $('#katbpom').on('change', function(){
      var myId = $(this).val();
      if(myId){
        $.ajax({
          url: '{{URL::to('getkatpangan')}}/'+myId,
          type: "GET",
          dataType: "json",
          beforeSend: function(){
            $('#loader').css("visibility", "visible");
          },
          success:function(data){
            $('#bpom').empty();
            $.each(data, function(key, value){
              $('#bpom').append('<option value="'+ key +'">' + value + '</option>');
            });
          },
          complete: function(){
            $('#loader').css("visibility","hidden");
          }
        });
      }else{
        $('#bpom').empty();
      }
    });

    // get Olahan
    $('#bpom').on('change', function(){
      var myId = $(this).val();
      if(myId){
        $.ajax({
          url: '{{URL::to('getolahan')}}/'+myId,
          type: "GET",
          dataType: "json",
          beforeSend: function(){
            $('#loader').css("visibility", "visible");
          },
          success:function(data){
            $('#olahan').empty();
            $.each(data, function(key, value){
              $('#olahan').append('<option value="'+ key +'">' + value + '</option>');
            });
          },
          complete: function(){
            $('#loader').css("visibility","hidden");
          }
        });
      }else{
        $('#katbpom').empty();
      }
    });
  });

  function template(){
    var template = document.getElementById('radio_temp')

    if(template.checked != true){
      document.getElementById('tampilkan').innerHTML = "";
    }else{
      document.getElementById('tampilkan').innerHTML =
      "<hr>"+
            "<div class='form-group row'>"+
            "  <label class='control-label col-md-2 col-sm-3 col-xs-12'>Launch</label>"+
            "  <div class='col-md-4 col-sm-9 col-xs-12'>"+
            "    <select class='form-control form-control-line' name='launch'>"+
            "      <option disabled='' selected=''>-- Launch Deadline --</option>"+
            "      <option>Q1</option>"+
            "      <option>Q2</option>"+
            "      <option>Q3</option>"+
            "      <option>Q4</option>"+
            "      <option>S1</option>"+
            "      <option>S2</option>"+
            "    </select>"+
            "  </div>"+
            "  <div class='col-md-4 col-sm-9 col-xs-12'>"+
            "    <input type='number' placeholder='Years' name='tahun' id='tahun' class='form-control col-md-12 col-xs-12'>"+
            "  </div>"+
            "</div>"+
          "<div class='ln_solid'></div>"
    }
  }

  function kalender(){
    var baru = document.getElementById('radio_cal')

    if(baru.checked != true){
      document.getElementById('tampilkan').innerHTML = "";
    }else{
      document.getElementById('tampilkan').innerHTML =
      "<hr>"+
            "<div class='form-group row'>"+
            "  <label class='control-label col-md-2 col-sm-3 col-xs-12'>Launch</label>"+
            "  <div class='col-md-9 col-sm-12 col-xs-12'>"+
            "    <input type='date' name='tanggal' id='tanggal' class='form-control col-md-12 col-xs-12'>"+
            "  </div>"+
            "</div>"+
          "<div class='ln_solid'></div>"
    }
  }
</script>
<script src="{{ asset('js/asrul.js') }}"></script>
@endsection