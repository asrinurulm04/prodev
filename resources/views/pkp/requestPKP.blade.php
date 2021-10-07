@extends('layout.tempvv')
@section('title', 'PRODEV|Request PKP')
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

<div class="x_panel">
  <div class="btn-group col-md-12 col-sm-12 col-xs-12">
    <button class="btn btn-info btn-block btn-sm" data-toggle="modal" data-target="#NW1" type="button"><li class="fa fa-plus"></li><b> Use Tempale</b></button>
  </div>
</div>

<div class="row">
  <div class="col-md-12 col-xs-12">
    <table class="table table-bordered">
      <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
        <td>Mandatory Information</td><td>* : Filled by Marketing</td><td>^ : Filled By PV</td><td>** : Filled by Marketing Or PV</td>
      </tr>
    </table>
  </div>
</div>

<form class="form-horizontal form-label-left" method="POST" action="{{ route('datapkp') }}">
<div class="row">
  <div class="col-md-6 col-xs-12">
    <div class="x_panel" style="min-height:265px">
      <div class="x_title">
        <h3><li class="fa fa-file-archive-o"> </li> Project</h3>
      </div>
      <div class="card-block">
        <div class="form-group row">
          <label class="control-label col-md-3 col-sm-2 col-xs-12" style="color:#258039">Project Name**</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input id="name" class="form-control col-md-12 col-xs-12" onkeyup="this.value = this.value.toUpperCase()" type="text" name="name">
          </div>
        </div>
        <div class="form-group row">
          <label class="control-label col-md-3 col-sm-2 col-xs-12" style="color:#258039">Brand**</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <select id="brand" name="brand" class="form-control" >
              @foreach($brand as $brand)
              <option value="{{  $brand->brand }}">{{  $brand->brand }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label class="control-label col-md-3 col-sm-2 col-xs-12" style="color:#258039">Type**</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <select id="type" name="type" class="form-control" >
              <option value="1">Maklon</option>
              <option value="2">Internal</option>
              <option value="3">Maklon/Internal</option>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label class="control-label col-md-3 col-sm-2 col-xs-12" style="color:#258039"> Revision</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input readonly type="text" value="0.0.0" class="form-control col-md-12 col-xs-12">
            <input id="author" value="{{ Auth::user()->id }}" class="form-control col-md-12 col-xs-12" type="hidden" name="author">
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-md-6 col-xs-12">
    <div class="x_panel" style="min-height:265px">
      <div class="x_title">
        <h3><li class="fa fa-file-archive-o"></li> Project</h3>
      </div>
      <div class="card-block">
        <div class="x_content">
          <?php $last = Date('j-F-Y'); ?>
          <div class="form-group row">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" style="color:#258039">Create </label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input id="last" value="{{ $last }}" class="form-control col-md-12 col-xs-12" name="last" required="required" type="text" readonly>
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" style="color:#258039">Jenis**</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
     			    <input type="radio" name="jenis" oninput="baku1()" checked Value="Baku" id="radio_umum1"> PKP Baku &nbsp &nbsp
     			    <input type="radio" name="jenis" oninput="kemas1()" value="Kemas" id="radio_kemas1"> PKP Kemas &nbsp &nbsp
      		    <input type="radio" name="jenis" oninput="umum()" value="Umum" id="radio_umum"> PKP Umum  &nbsp &nbsp
            </div>
          </div>
          <div id="tampilkan"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="x_panel">
  <div class="card-block col-md-6 col-sm-offset-5 col-md-offset-5">
    <button type="reset" class="btn btn-warning btn-sm"><li class="fa fa-repeat"></li> Reset</button>
    <button type="submit" class="btn btn-primary btn-sm"><li class="fa fa-check"></li> Submit</button>
    {{ csrf_field() }}
  </div>
</div>
</form>

<!-- Template -->
<div class="modal" id="NW1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Template PKP
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> </h3>
      </div>
      <div class="modal-body">
        <table id="datatable" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
              <td class="text-center" width="5%">No</td>
              <td class="text-center">PKP Number</td>
              <td class="text-center">Brand</td>
              <td class="text-center">Author</td>
              <td class="text-center">Type</td>
              <td class="text-center">Status</td>
              <td></td>
            </tr>
          </thead>
          @php $nol = 0; @endphp
          @foreach($pkp1 as $pkp)
            <tr>
              <th class="text-center">{{ ++$nol }}</th>
              <th>{{ $pkp->pkp_number }}{{ $pkp->ket_no }}</th>
              <th class="text-center">{{ $pkp->id_brand }}</th>
              <th>{{ $pkp->author1->name }}</th>
              <th class="text-center">{{ $pkp->jenis }}</th>
              <th class="text-center">{{ $pkp->status_pkp }}</th>
              <th width="21%" class="text-center">
                <a class="btn btn-success btn-sm" onclick="return confirm('Are you sure you want to use this template?')" href="{{Route('temppkpumum',[$pkp->id_pkp,$pkp->revisi,$pkp->turunan,$pkp->revisi_kemas])}}" title="Umum"><i class="fa fa-check"></i> U</a>
                <a class="btn btn-warning btn-sm" onclick="return confirm('Are you sure you want to use this template?')" href="{{Route('temppkpbaku',[$pkp->id_pkp,$pkp->revisi,$pkp->turunan,$pkp->revisi_kemas])}}" title="Baku"><i class="fa fa-check"></i> B</a>
                <a class="btn btn-primary btn-sm" onclick="return confirm('Are you sure you want to use this template?')" href="{{Route('temppkpkemas',[$pkp->id_pkp,$pkp->revisi,$pkp->turunan,$pkp->revisi_kemas])}}" title="Kemas"><i class="fa fa-check"></i> K</a>
              </th>
            </tr>
          @endforeach
        </table>
      </div>
    </div>
  </div>
</div>
<!-- Selesai -->
@endsection
@section('s')
<link href="{{ asset('lib/advanced-datatable/css/jquery.dataTables.css') }}" rel="stylesheet" />
<script src="{{ asset('js/datatables.min.js')}}"></script>
<script>
  var kemas = []
  <?php foreach($kemas_eksis as $key => $value) { ?>
  if(!kemas){
    kemas += [ { '<?php echo $key; ?>' : '<?php echo $value->project_name; ?>', } ];
  } else { kemas.push({ '<?php echo $key; ?>' : '<?php echo $value->project_name; ?>', }) }
  <?php } ?>

  var id_kemas = []
  <?php foreach($kemas_eksis as $key => $value) { ?>
  if(!id_kemas){
    id_kemas += [ { '<?php echo $key; ?>' : '<?php echo $value->id_project; ?>', } ];
  } else { id_kemas.push({ '<?php echo $key; ?>' : '<?php echo $value->id_project; ?>', }) }
  <?php } ?>
    
  var pkp = []
  <?php foreach($pkp_eksis as $key => $value) { ?>
  if(!pkp){
    pkp += [ { '<?php echo $key; ?>' : '<?php echo $value->project_name; ?>', } ];
  } else { pkp.push({ '<?php echo $key; ?>' : '<?php echo $value->project_name; ?>', }) }
  <?php } ?>

  var jenis = []
  <?php foreach($pkp_eksis as $key => $value) { ?>
  if(!jenis){
    jenis += [ { '<?php echo $key; ?>' : '<?php echo $value->no_kemas; ?>', } ];
  } else { jenis.push({ '<?php echo $key; ?>' : '<?php echo $value->no_kemas; ?>', }) }
  <?php } ?>

  var id_pkp = []
  <?php foreach($pkp_eksis as $key => $value) { ?>
  if(!id_pkp){
    id_pkp += [ { '<?php echo $key; ?>' : '<?php echo $value->id_project; ?>', } ];
  } else { id_pkp.push({ '<?php echo $key; ?>' : '<?php echo $value->id_project; ?>', }) }
  <?php } ?>

  var baku = []
  <?php foreach($baku_eksis as $key => $value) { ?>
  if(!baku){
    baku += [ { '<?php echo $key; ?>' : '<?php echo $value->project_name; ?>', } ];
  } else { baku.push({ '<?php echo $key; ?>' : '<?php echo $value->project_name; ?>', }) }
  <?php } ?>

  var id_baku = []
  <?php foreach($baku_eksis as $key => $value) { ?>
  if(!id_baku){
    id_baku += [ { '<?php echo $key; ?>' : '<?php echo $value->id_project; ?>', } ];
  } else { id_baku.push({ '<?php echo $key; ?>' : '<?php echo $value->id_project; ?>', }) }
  <?php } ?>

  var pilihan_kemas = '';
  for(var i = 0; i < Object.keys(kemas).length; i++){
    pilihan_kemas += '<option value="'+id_kemas[i][i]+'">'+kemas[i][i]+'_'+jenis[i][i]+'</option>';
  }

  var pilihan_baku = '';
  for(var i = 0; i < Object.keys(baku).length; i++){
    pilihan_baku += '<option value="'+id_baku[i][i]+'">'+baku[i][i]+'</option>';
  }

  var pilihan_pkp = '';
  for(var i = 0; i < Object.keys(pkp).length; i++){
    pilihan_pkp += '<option value="'+id_pkp[i][i]+'">'+pkp[i][i]+'_'+jenis[i][i]+'</option>';
  }

  function umum(){
    var umum = document.getElementById('radio_umum')
    if(umum.checked == true){
      document.getElementById('tampilkan').innerHTML =
      "<div class='form-group row'>"+
        "<label class='control-label col-md-2 col-sm-3 col-xs-12'>Project</label>"+
        "<div class='col-md-9 col-sm-9 col-xs-12'>"+
  	      "<input type='radio' name='umum' value='New' oninput='pkp_new()' id='radio_new'> New  &nbsp &nbsp"+
  	      "<input type='radio' name='umum' value='Eksis' oninput='kemas_eksis()' id='radio_kemas_eksis'> Kemas Eksis  &nbsp &nbsp"+
  	      "<input type='radio' name='umum' value='Eksis' oninput='baku_eksis()' id='radio_baku_eksis'> Baku Eksis &nbsp &nbsp"+
        "</div>"+
      "</div>"+
    "<div id='lihat'></div>"
    }
  }

  function kemas1(){
    var kemas1 = document.getElementById('radio_kemas1')
      document.getElementById('tampilkan').innerHTML =
      "<div class='form-group row'>"+
        "<label class='control-label col-md-2 col-sm-3 col-xs-12'>Project</label>"+
        "<div class='col-md-9 col-sm-9 col-xs-12'>"+
  	      "<input type='radio' name='kemas' value='New' oninput='pkp_new()' id='radio_new'> New  &nbsp &nbsp"+
  	      "<input type='radio' name='kemas' value='Eksis' oninput='pkp_eksis()' id='radio_pkp_eksis'> Add versions for existing projects  &nbsp &nbsp"+
        "</div>"+
      "</div>"+
    "<div id='lihat'></div>"
  }

  function baku1(){
    var baku1 = document.getElementById('radio_baku1')
      document.getElementById('tampilkan').innerHTML = "";
  }

  function kemas_eksis(){
    var kemas_eksis = document.getElementById('radio_kemas_eksis')
    if(kemas_eksis.checked == true){
      document.getElementById('lihat').innerHTML =
      "<div class='form-group row'>"+
        "<label class='control-label col-md-2 col-sm-3 col-xs-12'></label>"+
        "<div class='col-md-9 col-sm-9 col-xs-12'>"+
          "<select class='form-control form-control-line select' name='eksis'>"+
            "<option disabled='' selected=''>--> Project PKP Kemas <--</option>"+pilihan_kemas+"</select>"+
        "</div>"+
      "</div>"
    }
    
    $('.select').select2({
      allowClear: true
    });
  }

  function pkp_eksis(){
    var pkp_eksis = document.getElementById('radio_pkp_eksis')
    if(pkp_eksis.checked == true){
      document.getElementById('lihat').innerHTML =
      "<div class='form-group row'>"+
        "<label class='control-label col-md-2 col-sm-3 col-xs-12'></label>"+
        "<div class='col-md-9 col-sm-9 col-xs-12'>"+
          "<select class='form-control form-control-line select' name='eksis'>"+
            "<option disabled='' selected=''>--> Project PKP <--</option>"+pilihan_pkp+"</select>"+
        "</div>"+
      "</div>"
    }
    
    $('.select').select2({
      allowClear: true
    });
  }

  function pkp_new(){
    var pkp_new = document.getElementById('radio_new')
      document.getElementById('lihat').innerHTML = "";
  }

  function baku_eksis(){
    var baku_eksis = document.getElementById('radio_baku_eksis')
    if(baku_eksis.checked == true){
      document.getElementById('lihat').innerHTML =
      "<div class='form-group row'>"+
        "<label class='control-label col-md-2 col-sm-3 col-xs-12'></label>"+
        "<div class='col-md-9 col-sm-9 col-xs-12'>"+
          "<select class='form-control form-control-line select' name='eksis'>"+
            "<option disabled='' selected=''>--> Project PKP Baku <--</option>"+pilihan_baku+"</select>"+
        "</div>"+
      "</div>"
    }
    
    $('.select').select2({
      allowClear: true
    });
  }

</script>
@endsection