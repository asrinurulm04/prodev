@extends('pv.tempvv')
@section('title', 'Request PKP Promo')
@section('judulhalaman','Form PKP Promo')
@section('content')

<div class="row">
  <div class="col-md-2"></div>
  <div class="col-md-10">
    <div class="tabbable">
      <ul class="nav nav-tabs wizard">
        <li class="active"><a href="" ><span class="nmbr">1</span>Information</a></li>
        <li class="completed"><a href=""><span class="nmbr">2</span>Data</a></li>
        <li class="active"><a href=""><span class="nmbr">3</span>Products</a></li>
        <li class="active"><a href=""><span class="nmbr">4</span>File & Image</a></li>
      </ul>
    </div>
  </div>
</div>
<br>

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
  @foreach($data as $data)
  @if($data->datapromoo->status_project=='draf')
  <form class="form-horizontal form-label-left" method="POST" action="{{Route('editdatapromo',['id_pkp_promoo' => $data->id_pkp_promoo,'revisi' => $data->revisi,'turunan' => $data->turunan])}}" novalidate>
  @else
  <form class="form-horizontal form-label-left" method="POST" action="{{Route('editdatapromo2',['id_pkp_promoo' => $data->id_pkp_promoo,'revisi' => $data->revisi,'turunan' => $data->turunan])}}" novalidate>
  @endif
  <input type="hidden" value="{{ $data->datapromoo->id_pkp_promo}}" name="id_promo" id="id_promo">
  <?php $date = Date('j-F-Y'); ?>
  <input id="last_up" value="{{ $date }}" class="form-control col-md-12 col-xs-12" type="hidden" name="last_up">
  <div class="row">
    <div class="col-md-12">
      <div class="x_panel">
        <div class="x_title">
          <h3><li class="fa fa-puzzle-piece"></li> PKP Promo</h3>
        </div>
        <div class="card-block">
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12"></label>
            <div class="col-md-10 col-sm-9 col-xs-12">
            <table class="table table-bordered table-hover" id="tabledata">
              <thead>
                <tr style="font-weight: bold;color:white;">
                  <th class="text-center" style="color:#258039">Promo Idea**</th>
                  <th class="text-center" style="color:#258039">Dimension**</th>
                  <th width="13%"></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($idea as $idea)
                <tr>
                  <td><input value="{{$idea->promo_idea}}" required="required" id="promo_idea" class="form-control col-md-12 col-xs-12" type="text" name="promo_idea[]"></td>
                  <td><input value="{{$idea->dimension}}" required="required" id="dimension" class="form-control col-md-12 col-xs-12" type="text" name="dimension[]"></td>
                  <td class="text-center">
                    <button id="add_data" type="button" class="btn btn-info btn-sm pull-left tr_clone_add add_data"><li class="fa fa-plus"></li> </button>
                    <a href="" class="btn btn-danger btn-sm"><li class="fa fa-trash"></li></a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" style="color:#258039">Application**</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input required value="{{ $data->application }}" id="application" class="form-control col-md-12 col-xs-12" type="text" name="application">
            </div>
          </div>
					<div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" style="color:#258039">Promo Readiness**</label>
            <div class="col-md-3 col-sm-9 col-xs-12">
              <input required value="{{ $data->promo_readiness }}" id="promo" class="form-control col-md-12 col-xs-12" type="date" name="promo">
            </div>
            <div class="col-md-3 col-sm-9 col-xs-12">
                <input required value="{{ $data->promo_readiness2 }}" id="promo2" class="form-control col-md-12 col-xs-12" type="date" name="promo2">
              </div>
            <label class="control-label col-md-1 col-sm-3 col-xs-12" style="color:#258039">RTO**</label>
            <div class="col-md-3 col-sm-9 col-xs-12">
              <input required value="{{ $data->rto }}" id="rto" class="form-control col-md-12 col-xs-12" type="date" name="rto">
            </div>
          </div>
          <div class="ln_solid"></div>
          <input type="hidden" value="{{$data->datapromoo->author1->email}}" name="pengirim1" id="pengirim1">
          @foreach($user as $user)
          @if($user->role_id=='14')
          <input type="hidden" value="{{$user->name}}" name="namatujuan[]" id="namatujuan">
          <input type="hidden" value="{{$user->email}}" name="emailtujuan[]" id="emailtujuan">
          @endif
          @endforeach
          <center><button class="btn btn-primary" type="submit"><li class="fa fa-plus"></li> Submit And Next</button></center>
          {{ csrf_field() }}
        </div>
      </div>
    </div>
  </div>	
</form>
</div>
@endforeach
@endsection

@section('s')
<script>
    $(document).ready(function() {
  
      $('#tabledata').on('click', 'tr a', function(e) {
  
          e.preventDefault();
          var lenRow = $('#tabledata tbody tr').length;
          if (lenRow == 1 || lenRow <= 1) {
              alert("Tidak bisa hapus semua baris!!");
          } else {
              $(this).parents('tr').remove();
          }
      });
  
    var i = 1;
    $(".add_data").click(function() {
      $('#addrow' + i).html(
        "<td><input required='required' id='promo_idea' class='form-control col-md-12 col-xs-12' type='text' name='promo_idea[]'></td>"+
        "<td><input required='required' id='dimension' class='form-control col-md-12 col-xs-12' type='text' name='dimension[]'></td>"+
        "<td><a href='' class='btn btn-danger btn-sm'><li class='fa fa-trash'></li></a>"+
        "</td>");
  
      $('#tabledata').append('<tr id="addrow' + (i + 1) + '"></tr>');
      i++;
    });
    });
  
  </script>
@endsection