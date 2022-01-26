@extends('layout.tempvv')
@section('title', 'Request PDF')
@section('judulhalaman','Form PDF')
@section('content')

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

<div class="main">
@foreach($pdf as $pdf)
  @if($pdf->status_project=='draf')
  <form class="form-horizontal form-label-left" method="POST" action="{{ route('UpdatePdf1',['pdf_id' => $pdf->pdf_id, 'revisi' => $pdf->revisi, 'turunan' => $pdf->turunan]) }}" novalidate>
	@else
  <form class="form-horizontal form-label-left" method="POST" action="{{ route('UpdatePdf2',['pdf_id' => $pdf->pdf_id, 'revisi' => $pdf->revisi, 'turunan' => $pdf->turunan]) }}" novalidate>
  @endif
  <?php $date = Date('j-F-Y'); ?>
  <input id="last_up" value="{{ $date }}" class="form-control col-md-12 col-xs-12" type="hidden" name="last_up">

    <div class="col-md-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h3><li class="fa fa-folder-o"></li> Data</h3>
        </div>
        <div class="card-block">
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" style="color:#258039">Project Name</label>
            <div class="col-md-8 col-sm-8 col-xs-12">
              <input required value="{{ $pdf->project_name }}" id="name" class="form-control col-md-12 col-xs-12" type="text" name="name">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" style="color:#258039">Brand</label>
            <div class="col-md-8 col-sm-8 col-xs-12">
              <select name="brand" id="brand" class="form-control">
                <option value="{{$pdf->id_brand}}" readonly>{{$pdf->id_brand}}</option>
                @foreach($brand as $brand)
                <option value="{{$brand->brand}}">{{$brand->brand}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="ln_solid"></div>
        </div>
      </div>
    </div>
    <div class="col-sm-12">
      <div class="x_panel">
        <div class="x_title">
          <h3 style="color:#258039"><li class="fa fa-edit"></li> Packaging concept**</h3><h5 style="color:red">*requaired</h5>
          <input type="hidden" value="{{ $pdf->pdf_id }}" name="id">
        </div>
        <div>
          <div class="form-group row">
            <input type="hidden" value="{{$eksis+1}}" name="kemas" id="kemas">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="last-name">Configuration</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              @if($pdf->kemas_eksis!=NULL)
              <select name="data_eksis" id="data_eksis" class="form-control">
                <option value="{{$pdf->kemas_eksis}}" readonly>{{$pdf->kemas->nama}}
                (
                @if($pdf->kemas->primer!=NULL)
							  {{ $pdf->kemas->primer }}{{ $pdf->kemas->s_primer }}
							  @endif

							  @if($pdf->kemas->sekunder1!=NULL)
							  X {{ $pdf->kemas->sekunder1 }}{{ $pdf->kemas->s_sekunder1}}
							  @endif

								@if($pdf->kemas->sekunder2!=NULL)
								X {{ $pdf->kemas->sekunder2 }}{{ $pdf->kemas->s_sekunder2 }}
								@endif

								@if($pdf->kemas->tersier!=NULL)
								X {{ $pdf->kemas->tersier }}{{ $pdf->kemas->s_tersier }}
								@endif
                )
                </option>
              </select>
            </div>
       			<a type="buton" href="{{ Route('konfig',$pdf->id)}}" class="fa fa-trash btn btn-danger btn-sm" title="Remove the configuration and create a new configuration"></a>
            <div class="col-md-9 col-sm-9 col-xs-12">
            @elseif($pdf->kemas_eksis==NULL)
              <input type="hidden" value="{{$eksis+1}}" name="kemas" id="kemas">
              &nbsp&nbsp&nbsp&nbsp
              <input type="radio" name="data" oninput="baru()" id="radio_baru"> New Configuration  &nbsp &nbsp
       			  <input type="radio" name="data" oninput="eksis()" id="radio_eksis"> Configuration exists &nbsp &nbsp
       			  <input type="radio" name="data" oninput="pilih()" id="radio_project"> Previous Project Configuration  &nbsp &nbsp
            @endif
            </div>
          </div> 
          @if($pdf->primery	!=NULL)
          <div class="form-group row">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="last-name">Primary </label>
            <div class="col-md-8 col-sm-12 col-xs-12">
              <input name="primary" class="col-md-8 col-sm-12 col-xs-12 form-control" id="" value="{{$pdf->primery	}}">
            </div>
          </div>
          @endif
          @if($pdf->secondery!=NULL)
          <div class="form-group row">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="last-name">Secondary</label>
            <div class="col-md-8 col-sm-3 col-xs-12">
              <input name="secondary" class="col-md-8 col-sm-3 col-xs-12 form-control" id="" value="{{$pdf->secondery}}">
            </div>
          </div>
          @endif
          @if($pdf->Tertiary!=NULL)
          <div class="form-group row">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="last-name">Tertiary</label>
            <div class="col-md-8 col-sm-3 col-xs-12">
              <input name="tertiary" class="col-md-8 col-sm-3 col-xs-12 form-control" id="" value="{{$pdf->Tertiary}}">
            </div>
          </div>
          @endif 
          <div id="lihat"></div>
          @if($pdf->kemas_eksis!=NULL) 
          <div class="form-group row">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="last-name">Additional data (Optional)</label>
            <div class="col-md-8 col-sm-8 col-xs-12"><br>
              <table class="table table-bordered col-md-12 col-sm-12 col-xs-12" id="tablekemas">
                <thead>
                  <tr>
                    <td class="text-center">Oracle</td>
                    <td class="text-center">KK Code</td>
                    <td class="text-center">Note</td>
                    <td class="text-center" width="14%">Action</td>
                  </tr>
                </thead>
                <tbody>
                  <tr id='addrow0'>
                  @if($hitungkemaspdf>=1)
                    @foreach($kemaspdf as $kf)
                    <tr>
                      <td><input type="text" name="oracle[]" id="oracle" value="{{$kf->oracle}}" class="form-control"></td>
                      <td><input type="text" name="kk[]" id="kk" value="{{$kf->kk}}" class="form-control"></td>
                      <td><input type="text" name="information[]" id="information" value="{{$kf->information}}" class="form-control"></td>
                      <td class="text-center"><button id='add_kemas' type='button' class='btn btn-info btn-sm pull-left' title='Add'><li class='fa fa-plus'></li></button>
                      <a hreaf='' type="button" class='btn btn-danger btn-sm' title='Delete'><li class='fa fa-trash'></li></a></td>
                    </tr>
                    @endforeach
                  @elseif($hitungkemaspdf==0)
                  <tr>
                    <td><input type="text" name="oracle[]" id="oracle" class="form-control"></td>
                    <td><input type="text" name="kk[]" id="kk" class="form-control"></td>
                    <td><input type="text" name="information[]" id="information" class="form-control"></td>
                    <td class="text-center"><button id='add_kemas' type='button' class='btn btn-info btn-sm pull-left' title='Add'><li class='fa fa-plus'></li></button>
                    <a hreaf='' type="button" class='btn btn-danger btn-sm' title='Delete'><li class='fa fa-trash'></li></a></td>
                  </tr>
                  @endif
                  <tr id='addrow1'></tr>
                </tbody>
              </table>
            </div>
          </div>
          @endif
          <hr>
        </div>
      </div>
    </div>
    <div class="col-md-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h3><li class="fa fa-file"></li> Project</h3>
        </div>
        <div class="card-block">
        <input type="hidden" value="$pdf->datapdf->edit" name="edit" id="edit">
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" style="color:#258039">Age Range**</label>
            <div class="col-md-2 col-sm-3 col-xs-12">
              <input required value="{{ $pdf->dariusia }}" type="number"  name="dariumur" id="dariumur" class="form-control col-md-12 col-xs-12">
            </div>
            <div class="col-md-2 col-sm-3 col-xs-12">
              <input required value="{{ $pdf->sampaiusia }}" type="varchar" name="sampaiumur" id="sampaiumur" class="form-control col-md-12 col-xs-12">
            </div>
            <label class="control-label col-md-1 col-sm-2 col-xs-12" style="color:#258039">SES</label>
            <div class="col-md-4 col-sm-10 col-xs-12">
              <select class="form-control form-control-line items" id="select" name="ses[]"   multiple="multiple">
                @foreach($datases as $ses1)
                <option value="{{$ses1->ses}}" selected>{{$ses1->ses}}</option>
                @endforeach
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
                <option readonly selected>{{ $pdf->gender }}</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Male & Female">Male & Female</option>
              </select>
            </div>
            <label class="control-label col-md-1 col-sm-2 col-xs-12" style="color:#258039">Other**</label>
            <div class="col-md-4 col-sm-10 col-xs-12">
              <input required value="{{ $pdf->other }}" id="other" class="form-control col-md-12 col-xs-12" type="text" name="other">
            </div>
          </div>
          <div class="ln_solid"></div>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <div class="x_panel">
        <div class="x_title">
          <h3><li class="fa fa-edit"></li> Product Concept</h3>
        </div>
        <div class="card-block">
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" style="color:#258039">Weight**</label>
            <div class="col-md-2 col-sm-9 col-xs-12">
              <input required value="{{ $pdf->wight }}" id="weight" class="form-control col-md-12 col-xs-12" type="number" name="weight">
            </div>
            <div class="col-md-2 col-sm-9 col-xs-12">
              <select required class="form-control form-control-line" name="serving" >
                <option selected="" value="{{ $pdf->serving }}">{{ $pdf->serving }}</option>
                <option value="gram">Gram</option>
                <option value="ml">ML</option>
              </select>
            </div>
            <label class="control-label col-md-2 col-sm-3 col-xs-12" style="color:#258039">Target price**</label>
            <div class="col-md-3 col-sm-9 col-xs-12">
              <input required value="{{ $pdf->target_price }}" id="target_price" class="form-control col-md-12 col-xs-12" type="text" name="target_price">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" style="color:#258039">Ingredient**</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <textarea required value="{{ $pdf->ingredient }}" id="ingredient" class="form-control col-md-12 col-xs-12" placeholder="Special Ingredient" type="text" name="ingredient" rows="3">{{ $pdf->ingredient }}</textarea>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <table class="table table-bordered table-hover" id="table">
                <thead>
                  <tr>
                    <th class="text-center" >Komponen</th>
                    <th class="text-center" width="15%">Klaim</th>
                    <th class="text-center" width="25%">Detail</th>
                    <th class="text-center" width="20%">Note</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="tr_clone">
                  @foreach($dataklaim as $dk)
                    <td>
                      <select class="form-control items komponen"   name="komponen[]">
                        <option value="{{$dk->id_komponen}}">{{$dk->datakp->komponen}}</option>
                        @foreach($komponen as $kp)
                        <option value="{{ $kp->id }}">{{ $kp->komponen }}</option>
                        @endforeach
                      </select>
                    </td>
                    <td>
                      <select name="klaim[]" class="form-control items">
                        <option value="{{$dk->id_klaim}}">{{$dk->datakl->klaim}}</option>
                        <option readonly>--> Select One <--</option>
                      </select>
                    </td>
                    <td>
                      <select name="detail[]"  multiple="multiple" class="form-control items">
                        @foreach($datadetail as $dd)
                        @if($dd->id_klaim==$dk->id)
                        <option readonly selected value="{{$dd->id_detail}}">{{$dd->datadl->detail}}{{$dk->id_klaim}}</option>
                        @endif
                        @endforeach
                      </select>
                    </td>
                    <td><textarea type="text" class="form-control" name="ket[]" value="{{$dk->note}}" id="ket">{{$dk->note}}</textarea></td>
                    <td><a href="" class="btn btn-danger btn-sm"><li class="fa fa-trash"></li></a>
                    <button class="tr_clone_add btn btn-info btn-sm" type="button"><li class="fa fa-plus"></li></button>
                  </tr>
                  @endforeach
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
              <label style="color:red;">* Mandatory for CCT request</label>
            </div>
          </div>
          <div class="ln_solid"></div>
        </div>
      </div>
    </div>
    <div class="col-md-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h3><li class="fa fa-folder-open"></li> Data</h3>
        </div>
        <div class="card-block">
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" style="color:#258039">Background**</label>
          	<div class="col-md-9 col-sm-9 col-xs-12">
              <input required value="{{ $pdf->background }}" id="background" placeholder="Backgroung / Insight" class="form-control col-md-12 col-xs-12" type="text" name="background">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" style="color:#258039">Attractiveness**</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input required value="{{ $pdf->	attractiveness }}" id="attractive" class="form-control col-md-12 col-xs-12" type="text" name="attractive">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" style="color:#258039">Target RTO**</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input required value="{{ $pdf->rto }}" id="rto" class="form-control col-md-12 col-xs-12" type="date" name="rto">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-2 col-sm-9 col-xs-12" >
              <label class="control-label col-md-12 col-sm-3 col-xs-12" style="color:#258039">Sales Forecast</label> 
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <table class="table table-bordered table-hover" id="tabledata">
                <tbody>
                  <tr id='addrow0'>
                    @foreach($for as $for)
                    <td><input type="number"  value="{{$for->forecast}}" name="forecast[]" class="form-control"></td>
                    <td>
                      <select name="satuan[]"  id="detail1" class="form-control">
                        <option readonly value="{{$for->satuan}}">{{$for->satuan}}</option>
                        <option value="1st Month">1st Month</option>
                        <option value="2nd Month">2nd Month</option>
                        <option value="3rd Month">3rd Month</option>
                      </select>
                    </td>
                    <td><input type="text" name="keterangan[]" class="form-control" value="{{$for->keterangan}}"></td>
                    <td><a href="" type="button" class="btn btn-danger btn-sm"><li class="fa fa-trash"></li> Delete</a></td>
                  </tr>
                  @endforeach
                  @if($for2==0)
                  <tr id='addr0'>
                    <td><input type="number" value="0" name="forecast[]" class="form-control"></td>
                    <td>
                      <select name="satuan[]"  id="detail1" class="form-control">
                        <option value="1st Month">1st Month</option>
                        <option value="2nd Month">2nd Month</option>
                        <option value="3rd Month">3rd Month</option>
                      </select>
                    </td>
                    <td><input type="text" name="keterangan[]" class="form-control"></td>
                    <td>
                      <button class="btn btn-info btn-sm pull-left add_data" type="button"><li class="fa fa-plus"></li> Add Forecast</button>
                      <a href="" type="button" class="btn btn-danger btn-sm"><li class="fa fa-trash"></li> Delete</a>
                    </td>
                  </tr>
                  @endif
                  <tr id='addrow1'></tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="ln_solid"></div>
        </div>
      </div>
    </div>
    <div class="col-md-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h3><li class="fa fa-group"></li> Competitors</h3>
        </div>
        <div class="card-block">
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" style="color:#258039">Name**</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input required value="{{ $pdf->name }}" id="name_competitors" class="form-control col-md-12 col-xs-12" type="text" name="name_competitors">
            </div>
					</div>
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" style="color:#258039">Retailer Price**</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input required value="{{ $pdf->retailer_price }}" id="retailer_price" class="form-control col-md-12 col-xs-12" type="number" name="retailer_price">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" style="color:#258039">What's Special**</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input required value="{{ $pdf->special }}" id="special" class="form-control col-md-12 col-xs-12" placeholder="Special Ingredient" type="text" name="special">
            </div>
          </div>
          <input type="hidden" value="{{$pdf->datapdf->author1->email}}" name="pengirim1" id="pengirim1">
          @foreach($user as $user)
          @if($user->role_id=='5')
          <input type="hidden" value="{{$user->name}}" name="namatujuan[]" id="namatujuan">
          <input type="hidden" value="{{$user->email}}" name="emailtujuan[]" id="emailtujuan">
          @endif
          @endforeach
          <div class="ln_solid"></div>
          <div class="col-md-6 col-md-offset-5">
            <button type="reset" class="btn btn-warning btn-sm"><li class="fa fa-repeat"></li> Reset</button>
            <button type="submit" class="btn btn-primary btn-sm"><li class="fa fa-check"></li> Submit</button>
            {{ csrf_field() }}
          </div>
        </div>
			</div>
		</div>
  </form>
@endforeach
</div>
@endsection
@section('s')
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
<script src="{{ asset('js/select2/select2.min.js') }}"></script>
<script>
  $(document).ready(function() {
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
</script>
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
        "</select></td><td><textarea type='text' class='form-control' name='ket[]' id='ket'></textarea></td><td class='text-center'><a hreaf='' class='btn btn-danger btn-sm' title='Delete'><li class='fa fa-trash'></li></a></td>");

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
  var i = 1;
  $(".add_data").click(function() {
    $('#addrow' + i).html( "<td><input type='number' name='forecast[]' class='form-control'></td><td><select name='satuan[]'  class='form-control'>"+
      "<option disabled selected>--> Select One <--</option>"+       
      "<option value='1st Month'>1st Month</option>"+
      "<option value='2nd Month'>2nd Month</option>"+
      "<option value='3rd Month'>3rd Month</option>"+
    "</select></td><td><input type='text' name='keterangan[]' class='form-control'></td><td><a hreaf='' class='btn btn-danger btn-sm'><li class='fa fa-trash'></li> Delete</a></td>");

    $('#tabledata').append('<tr id="addrow' + (i + 1) + '"></tr>');
    i++;
  });
  });
</script>
<script type="text/javascript">
  $('.items').select2({
    placeholder: '-->Select One<--',
    allowClear: true
  });
</script>
<script>
  var kode_uom = []
  <?php foreach($uom as $key => $value) { ?>
  if(!kode_uom){
    kode_uom += [ { '<?php echo $key; ?>' : '<?php echo $value->kode; ?>', } ];
  } else { kode_uom.push({ '<?php echo $key; ?>' : '<?php echo $value->kode; ?>', }) }
  <?php } ?>

  var pilihan_uom = '';
  for(var i = 0; i < Object.keys(kode_uom).length; i++){
    pilihan_uom += '<option value="'+kode_uom[i][i]+'">'+kode_uom[i][i]+'</option>';
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

  function baru(){
    var baru = document.getElementById('radio_baru')

    if(baru.checked == true){
      document.getElementById('lihat').innerHTML =
      "<div class='form-group'>"+
        "<label class='control-label col-md-2 col-sm-2 col-xs-12'>Configuration</label>&nbsp  &nbsp"+
       	"<input type='radio' name='gramasi' oninput='dua()' id='radio_dua'> 2 Dimensi &nbsp"+
    		"<input type='radio' name='gramasi' oninput='tiga()' id='radio_tiga'> 3 Dimensi &nbsp"+
       	"<input type='radio' name='gramasi' oninput='empat()' id='radio_empat'> 4 Dimensi &nbsp"+
				"<div id='tampil'></div><hr>"+
			"</div>"+
      "<h4><b><lable class='control-label col-md-2 col-sm-3 col-xs-12' for='first-name'>Keterangan</lable></b></h4><br><br>"+
      "<div class='form-group'>"+
        "<label class='control-label col-md-2 col-sm-3 col-xs-12' for='first-name'>Primary</label>"+
        "<div class='col-md-10 col-sm-10 col-xs-12'>"+
          "<textarea name='primary' id='primary' class='col-md-12 col-sm-12 col-xs-12'></textarea>"+
        "</div>"+
      "</div>"+
      "<div class='form-group'>"+
        "<label class='control-label col-md-2 col-sm-3 col-xs-12' for='last-name'>Secondary</label>"+
        "<div class='col-md-10 col-sm-10 col-xs-12'>"+
          "<textarea name='secondary' id='secondary' class='col-md-12 col-sm-12 col-xs-12'></textarea>"+
        "</div>"+
      "</div>"+
      "<div class='form-group'>"+
        "<label for='middle-name' class='control-label col-md-2 col-sm-3 col-xs-12'>Tertiary </label>"+
        "<div class='col-md-10 col-sm-10 col-xs-12'>"+
          "<textarea name='tertiary' id='tertiary' class='col-md-12 col-sm-12 col-xs-12'></textarea>"+
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
    if(dua.checked == true){
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
                "<select class='form-control' name='s_tersier'><option disabled='' selected=''>Tersier</option>"+pilihan_uom+"</select>"+
              "</div>"+
              "<div class='col-md-1 col-sm-1 col-xs-12'>"+
                "<input name='primer' id=primer' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='text'>"+
              "</div>"+
              "<div class='col-md-2 col-sm-2 col-xs-12'>"+
                "<select class='form-control' name='s_primer'><option disabled='' selected=''>Primer</option>"+pilihan_uom_primer+"</select>"+
              "</div>"+
            "</div>"+
          "</div>"+
        "</div>"
    }
  }

  function tiga(){
    var tiga = document.getElementById('radio_tiga');
    if(tiga.checked == true){
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
                "<select class='form-control' name='s_tersier'><option disabled='' selected=''>Tersier</option>"+pilihan_uom+"</select>"+
              "</div>"+
              "<div class='col-md-1 col-sm-1 col-xs-12'>"+
                "<input name='sekunder1' id='sekunder1' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='text'>"+
              "</div>"+
              "<div class='col-md-2 col-sm-2 col-xs-12'>"+
                "<select class='form-control' name='s_sekunder1'><option disabled='' selected=''>Sekunder 1</option>"+pilihan_uom+"</select>"+
              "</div>"+
              "<div class='col-md-1 col-sm-1 col-xs-12'>"+
                "<input name='primer' id='primer1' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='text'>"+
              "</div>"+
              "<div class='col-md-2 col-sm-2 col-xs-12'>"+
                "<select class='form-control' name='s_primer'><option disabled='' selected=''>Primer</option>"+pilihan_uom_primer+"</select>"+
              "</div>"+
            "</div>"+
          "</div>"+
        "</div>"
    }
  }

  function empat(){
    var empat = document.getElementById('radio_empat');
    if(empat.checked == true){
      document.getElementById('tampil').innerHTML =
      "<br><div class='panel panel-default'>"+
	    "<div class='panel-heading'><h5>Configuration</h5></div>"+
	      "<div class='panel-body'>"+
          "<div class='form-group'>"+
            "<div class='col-md-1 col-sm-1 col-xs-12'>"+
              "<input name='tersier' id='tersier' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='text'>"+
            "</div>"+
            "<div class='col-md-2 col-sm-2 col-xs-12'>"+
              "<select class='form-control' name='s_tersier'<option disabled='' selected=''>Tersier</option>"+pilihan_uom+"</select>"+
            "</div>"+
            "<div class='col-md-1 col-sm-1 col-xs-12'>"+
              "<input name='sekunder1' id='sekunder1' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='text'>"+
            "</div>"+
            "<div class='col-md-2 col-sm-2 col-xs-12'>"+
              "<select class='form-control' name='s_sekunder1'><option disabled='' selected=''>Sekunder 1</option>"+pilihan_uom+"</select>"+
            "</div>"+ "<div class='col-md-1 col-sm-1 col-xs-12'>"+
              "<input name='sekunder2' id='sekunder2' class='date-picker form-control col-md-12 col-xs-12' maxlength='4' type='text'>"+
            "</div>"+
            "<div class='col-md-2 col-sm-2 col-xs-12'>"+
              "<select class='form-control' name='s_sekunder2'><option disabled='' selected=''>Sekunder 2</option>"+pilihan_uom+"</select>"+
            "</div>"+
            "<div class='col-md-1 col-sm-1 col-xs-12'>"+
              "<input name='primer' id='primer' class='date-picker form-control maxlength='4' col-md-12 col-xs-12' type='text'>"+
            "</div>"+
            "<div class='col-md-2 col-sm-2 col-xs-12'>"+
              "<select class='form-control' name='s_primer'><option disabled='' selected=''>Primer</option>"+pilihan_uom_primer+"</select>"+
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
    if(eksis.checked == true){
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
      "</div>"
    }
  }

  function eksis(){
    var eksis = document.getElementById('radio_eksis')
    if(eksis.checked == true){
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
@endsection