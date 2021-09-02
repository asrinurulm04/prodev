@extends('pv.tempvv')
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

<div class="row">
  <div class="col-md-3"></div>
  <div class="col-md-9">
    <div class="tabbable">
      <ul class="nav nav-tabs wizard">
        <li class="active"><a href=""><span class="nmbr">1</span>Data</a></li>
        <li class="completed"><a href=""><span class="nmbr">2</span>Products</a></li>
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

<div class="row">
  <div class="col-md-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h3><li class="fa fa-file-archive-o"></li> Products And Allocation</h3>
      </div>
      <div class="card-block">
        <div class="x_content">
          <div class="col-md-12 col-xs-12">
						<div class="form-group">
							<div class="col-md-12 col-sm-12 col-xs-12" style="overflow-x: scroll;">
  							<form class="form-horizontal form-label-left" method="POST" action="{{Route('allocation')}}"> 
								<br>
								@foreach($promo as $promo)
								<input type="hidden" value="{{ $promo->datapromoo->id_pkp_promo }}" name="promo" id="promo">
								<input type="hidden" value="{{ $promo->turunan }}" name="turunan" id="turunan">
								<input type="hidden" value="{{ $promo->revisi }}" name="revisi" id="revisi">
								@endforeach
          			<table class="table table-bordered table-hover" id="tabledata">
      						<thead>
        						<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
        					    <th class="text-center" max-width="10%">Product SKU Name**</th>
        					    <th class="text-center" style="min-width:200px">Allocation**</th>
											<th class="text-center" style="min-width:200px">Satuan**</th>
        					    <th class="text-center" style="min-width:200px">Remarks**</th>
        					    <th class="text-center">Start**</th>
											<th class="text-center">End**</th>
											<th class="text-center">RTO**</th>
											<th style="min-width:100px"></th>
      						  </tr>
      						</thead>
      						<tbody>
        						<tr>
        					    <td>
												<select name='sku[]' required style="width:280px;" class="form-control items">
													@foreach($sku as $sku1)
													<option class="col-md-12 col-xs-12" value="{{$sku1->id}}">{{$sku1->nama_sku}}</option>
													@endforeach
												</select>
											</td>
      						    <td><input type="number" required name='pcs[]' placeholder='Allocation ' class="form-control" /></td>
											<td><select require name="opsi[]" id="opsi" class="form-control">
												<option value="pcs">PCS</option>
												<option value="forecast">forecast</option>
											</select></td>
        						  <td><textarea rows="4" type="text" required name='remarks[]' placeholder='Remarks' class="form-control" ></textarea></td>
        						  <td><input type="date" required name='start[]' placeholder='Start' title="start" class="form-control" /></td>
											<td><input type="date" required name='end[]' placeholder='End' title="End" class="form-control" /></td>
											<td><input type="date" required name='rto[]' placeholder='rto' class="form-control" /></td>
											<td class="text-center">
												<button id="add_data" type="button" class="btn btn-info btn-sm pull-left tr_clone_add"><li class="fa fa-plus"></li> </button>
												<a href="" class="btn btn-danger btn-sm"><li class="fa fa-trash"></li></a>
											</td>
										</tr>
        					</tbody>
      					</table>
            	</div>
							<center><button type="submit" class="btn btn-primary btn-sm"><li class="fa fa-check"></li> Submit</button></center>
      				{{ csrf_field() }}				
  						</form>
          	</div>		
          </div>
        </div>
    	</div>
  	</div> 
	</div>  
</div>

@if($hitung!=0)
<div class="">     
  <div class="row">
    <div class="col-md-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h3><li class="fa fa-file-archive-o"></li> Data Products And Allocation</h3>
        </div>
        <div class="card-block">
          <div class="x_content">
            <div class="col-md-12 col-xs-12">
							<table class="table table-bordered table-hover" >
        				<thead>
								<!-- auliya ahmad kurniawan -->
        					<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
										<th class="text-center">No</th>
        						<th class="text-center">Product SKU Name</th>
        						<th class="text-center">Allocation</th>
        						<th class="text-center">Remarks</th>
        						<th class="text-center">Start</th>
        						<th class="text-center">End</th>
										<th class="text-center">RTO</th>
										<th class="text-center" width="10%">Action</th>
        					</tr>
        				</thead>
        				<tbody>
								@php $nol = 0; @endphp
								@foreach($allocation as $all)
								@php ++$nol; @endphp
									<tr>
										<td>{{$nol}}</td>
										<td>{{$all->sku->nama_sku}}</td>
										<td>{{$all->allocation}} {{$all->opsi}}</td>
										<td>{{$all->remarks}}</td>
										<td>{{$all->start}}</td>
										<td>{{$all->end}}</td>
										<td>{{$all->rto}}</td>
										<td class="text-center">
											<a href="{{Route('deletedatastep4',['id_pkp_promo' => $all->id_pkp_promo, 'turunan' => $all->turunan])}}" type="button" class="btn btn-danger btn-sm" title="Delete"><li class="fa fa-trash-o"></li></a>
											<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModal{{ $all->id_product_allocation }}" data-toggle="tooltip" data-placement="top" title="Edit"><li class="fa fa-edit "></li></button>
											<!-- modal -->
											<div class="modal" id="exampleModal{{$all->id_product_allocation}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
											  <div class="modal-dialog modal-lg" role="document">
											    <div class="modal-content">
											      <div class="modal-header">                 
											        <h3 class="modal-title" id="exampleModalLabel">Edit Data 
											        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
											          <span aria-hidden="true">&times;</span>
											        </button></h3>
											      </div>
											      <div class="modal-body">
											      <form class="form-horizontal form-label-left" method="POST" action="{{Route('editdatastep4',['id_product_allocation' => $all->id_product_allocation, 'turunan' => $all->turunan])}}" novalidate>
											        <div class="form-group row">
																<table class="table table-bordered table-hover" >
											        		<thead>											
											        			<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
											        				<th class="text-center">Product SKU Name</th>
											        				<th class="text-center">Allocation</th>
											        				<th class="text-center">Remarks</th>
											        				<th class="text-center">Start & End</th>
																			<th class="text-center">RTO</th>
											        			</tr>
											        		</thead>
											        		<tbody>
																		<tr>
																			<td><select required name="product" id="product" class="form-control">
																				<option value="{{$all->product_sku}}">{{$all->sku->nama_sku}}</option>
																				@foreach($sku as $sku2)
																				<option class="col-md-12 col-xs-12" value="{{$sku2->id}}">{{$sku2->nama_sku}}</option>
																				@endforeach
																			</select></td>
																			<td><input required type="text" class="form-control col-md-12 col-xs-12" name="allocation" id="allocation" value="{{$all->allocation}}">
																			<br><br><select required require name="opsi" id="opsi" class="form-control">
																				<option value="{{$all->opsi}}" readonly>{{$all->opsi}}</option>
																				<option value="pcs">PCS</option>
																				<option value="forecast">forecast</option>
																			</select></td>
																			<td><textarea required rows="3" cols="60" type="text" class="form-control col-md-12 col-xs-12" name="remarks" id="remarks" value="{{$all->remarks}}">{{$all->remarks}}</textarea></td>
																		  <td><input required type="date" class="form-control col-md-12 col-xs-12" title="start" name="start" id="start" value="{{$all->start}}">
																			<br><br><input required type="date" class="form-control col-md-12 col-xs-12" name="end" title="End" id="end" value="{{$all->end}}"></td>
																			<td><input required type="date" class="form-control" name="rto" id="rto" value="{{$all->rto}}"></td>
											        			</tr>
											        		</tbody>
											      		</table>
											        </div>
											      </div>
											      <div class="modal-footer">
											        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-check"></i> Save</button>
											        {{ csrf_field() }}
											      </div>
											      </form>
											    </div>
											  </div>
											</div>
											<!-- modal selesai -->
										</td>
        					</tr>
								@endforeach
        				</tbody>
      				</table>
							<center><a href="{{Route('uploadpkppromo',['id_pkp_promo' => $promo->datapromoo->id_pkp_promo, ' revisi' => $promo->revisi, ' turunan' => $promo->turunan])}}" type="button" class="btn btn-warning btn-sm"><li class="fa fa-hand-o-right"></li> Next</a></center>
            </div>
          </div>
    		</div>
  		</div> 
		</div>
	</div>
</div> 
@endif
@endsection

@section('s')
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
<script src="{{ asset('js/select2/select2.min.js') }}"></script>
<script>
	$('.items').select2({
    placeholder: '-->Select One<--',
    allowClear: true
  });

  $('.input').keyup(function(event) {
    if(event.which >= 37 && event.which <= 40) return;
    // format number
    $(this).val(function(index, value) {
      return value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    });
  });
</script>

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

		var idsku = []
		<?php foreach($sku as $key => $value) { ?>
			if(!idsku){
				idsku += [ { '<?php echo $key; ?>' : '<?php echo $value->id; ?>', } ];
			} else { idsku.push({ '<?php echo $key; ?>' : '<?php echo $value->id; ?>', }) }
		<?php } ?>

		var namasku = []
		<?php foreach($sku as $key => $value) { ?>
			if(!namasku){
				namasku += [ { '<?php echo $key; ?>' : '<?php echo $value->nama_sku; ?>', } ];
			} else { namasku.push({ '<?php echo $key; ?>' : '<?php echo $value->nama_sku; ?>', }) }
		<?php } ?>

		var sku1 = '';
			for(var i = 0; i < Object.keys(namasku).length; i++){
			sku1 += '<option value="'+idsku[i][i]+'">'+namasku[i][i]+'</option>';
		}

		var i = 1;
		$("#add_data").click(function() {
			$('#addrow' + i).html( "<td>"+
				"<select name='sku[]' style='width:280px;' class='form-control items'>"+sku1+"</select>"+
				"</td>"+
				"<td><input type='text' name='pcs[]' placeholder='Allocation ' class='form-control data' /></td>"+
				"<td><select require name='opsi[]' id='opsi' class='form-control'>"+
					"<option value='pcs'>PCS</option>"+
					"<option value='forecast'>forecast</option>"+
				"</select></td>"+
				"<td><textarea rows='4' type='text' required name='remarks[]' placeholder='Remarks' class='form-control' ></textarea></td>"+
				"<td><input type='date' required name='start[]' placeholder='Start' title='start' class='form-control' /></td>"+
				"<td><input type='date' required name='end[]' placeholder='End' title='End' class='form-control' /></td>"+
				"<td><input type='date' required name='rto[]' placeholder='rto' class='form-control' /></td>"+
				"<td><a href='' class='btn btn-danger btn-sm'><li class='fa fa-trash'></li></a>"+
				"</td>");

			$('#tabledata').append('<tr id="addrow' + (i + 1) + '"></tr>');
			i++;
		});
  });
</script>
@endsection