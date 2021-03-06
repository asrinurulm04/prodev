@extends('layout.tempvv')
@section('title', 'PRODEV|Request PKP Promo')
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

<div class="">
@foreach($pkp as $pkp)
<form class="form-horizontal form-label-left" method="POST" action="{{ route('datapromo1') }}" novalidate>
  <input type="hidden" value="{{ $pkp->id_pkp_promo}}" name="id_promo" id="id_promo">
  @endforeach
    <div class="col-md-12">
      <div class="x_panel">
        <div class="x_title">
          <h3><li class="fa fa-puzzle-piece"> PKP Promo</li></h3>
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
									<th width="6%"></th>
      					</tr>
      				</thead>
      				<tbody>
    						<tr>
									<td><input required="required" id="promo_idea" class="form-control col-md-12 col-xs-12" type="text" name="promo_idea[]"></td>
									<td><input required="required" id="dimension" class="form-control col-md-12 col-xs-12" type="text" name="dimension[]"></td>
									<td><button id="add_data" type="button" class="btn btn-info btn-sm pull-left tr_clone_add"><li class="fa fa-plus"></li> </button></td>
								</tr>
        			</tbody>
            </table>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" style="color:#258039">Application**</label>
            <div class="col-md-10 col-sm-9 col-xs-12">
              <input required="required" id="application" class="form-control col-md-12 col-xs-12" type="text" name="application">
            </div>
          </div>
          <?php $date = Date('j-F-Y'); ?>
          <input id="last_up" value="{{ $date }}" class="form-control col-md-12 col-xs-12" type="hidden" name="last_up">
					<div class="form-group">
            <label class="control-label col-md-2 col-sm-3 col-xs-12" style="color:#258039">Promo Readiness**</label>
            <div class="col-md-3 col-sm-9 col-xs-12">
              <input required="required" id="promo" class="form-control col-md-12 col-xs-12" type="date" name="promo">
            </div>
            <div class="col-md-3 col-sm-9 col-xs-12">
                <input required="required" id="promo1" class="form-control col-md-12 col-xs-12" type="date" name="promo1">
              </div>
            <label class="control-label col-md-1 col-sm-3 col-xs-12" style="color:#258039">RTO**</label>
            <div class="col-md-3 col-sm-9 col-xs-12">
              <input required="required" id="rto" class="form-control col-md-12 col-xs-12" type="date" name="rto">
            </div>
          </div>
          <div class="ln_solid"></div>
          <center><button class="btn btn-primary btn-sm" type="submit"><li class="fa fa-check"></li> Submit And Next</button></center>
          {{ csrf_field() }}
        </div>
      </div>
    </div>	
</form>
</div>
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
    $("#add_data").click(function() {
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