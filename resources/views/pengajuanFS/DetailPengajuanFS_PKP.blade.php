@extends('layout.tempvv')
@section('title', 'Request PKP')
@section('content')

<div class="row">
	<div class="col-md-12 col-xs-12">
    <div class="x_panel" align="right">
      <a type="button" href="{{ Route('lihatpkp',$pkp->id_project) }}" class="btn btn-info btn-sm"><li class="fa fa-eye"></li> PKP</a>
      <a href="{{ route('formula.detail',[$formula->id,$pkp->id_project,$formula->workbook_id]) }}" class="btn btn-sm btn-success" type="button" title="Show"><li class="fa fa-book"></li> Workbook</a>
      <a type="button" href="{{route('listPkpFs',$pkp->id_project)}}" class="btn btn-danger btn-sm"><li class="fa fa-arrow-left"></li> Back</a>
		</div>
	</div>
</div>
<form class="form-horizontal form-label-left" method="POST" action="{{route('overview')}}">
<?php $last = Date('j-F-Y'); ?>
<input id="create" value="{{ $last }}" class="form-control col-md-12 col-xs-12" type="hidden" name="create">
<input id="id_fs" value="{{ $fs }}" class="form-control col-md-12 col-xs-12" type="hidden" name="id_fs">
<input id="id_fs" value="{{ $pkp->id_project }}" class="form-control col-md-12 col-xs-12" type="hidden" name="id_project">

<div class="row">
  <div class="col-md-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h3><li class="fa fa-file"></li> Form Pengajuan FS</h3>
      </div>
      <div class="card-block">
        <div class="x_content">
          <div class="form-group row">
						<label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name" style="color:#31a9b8">Project Name</label>
            <div class="col-md-4 col-sm-4 col-xs-12">
              <input type="text" value="{{$pkp->project_name}}" class="form-control col-md-12 col-xs-12" readonly>
            </div>
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name" style="color:#31a9b8">Target Launching</label>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <input type="text" value="{{$pkp->launch}} {{$pkp->years}}" class="form-control col-md-12 col-xs-12" readonly>
            </div>
          </div>
          <div class="form-group row">
            <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12" style="color:#31a9b8">Idea</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
							 <input type="text" value="{{$pkp->idea}}" class="form-control col-md-12 col-xs-12" readonly>
            </div>
          </div>
          <div class="form-group row">
            <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12" style="color:#31a9b8">Product Name</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
							 <input type="text" value="{{$formula->formula}}" class="form-control col-md-12 col-xs-12" readonly>
            </div>
          </div>
          <div class="form-group row">
            <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12" style="color:#31a9b8">Product Type (BPOM)</label>
            <div class="col-md-2 col-sm-2 col-xs-12">
							 <input type="text" value="{{$pkp->katpangan->no_kategori}}" class="form-control col-md-12 col-xs-12" readonly>
            </div>
						<label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12" style="color:#31a9b8">Category</label>
						<div class="col-md-5 col-sm-5 col-xs-12">
							 <input type="text" value="{{$pkp->katpangan->pangan}}" class="form-control col-md-12 col-xs-12" readonly>
            </div>
          </div>
					@if($pkp->kemas_eksis!=NULL)
          <div class="form-group row">
            <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12" style="color:#31a9b8">Configuration</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
							 <input id="configuration" class="form-control col-md-12 col-xs-12" value="{{ $pkp->kemas->primer }}{{ $pkp->kemas->s_primer }} X {{ $pkp->kemas->sekunder1 }}{{ $pkp->kemas->s_sekunder1}} X {{ $pkp->kemas->sekunder2 }}{{ $pkp->kemas->s_sekunder2 }} X {{ $pkp->kemas->tersier }}{{ $pkp->kemas->s_tersier }}" readonly>
            </div>
          </div>
					@endif
          <div class="form-group row">
            <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12" style="color:#31a9b8">Forecast (Rp/ month)</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
							<input type="text" value="{{$fch}}" name="forecast" id="forecast" class="form-control col-md-12 col-xs-12">
            </div>
          </div>
          <div class="form-group row">
            <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12" style="color:#31a9b8">Pricelist (Rp/ UOM)</label>
            <div class="col-md-4 col-sm-4 col-xs-12">
							 <input type="text" value="{{$pkp->selling_price}}" name="pricelist" id="pricelist" class="form-control col-md-12 col-xs-12">
            </div>
						<label for="middle-name" class="control-label col-md-1 col-sm-1 col-xs-12" style="color:#31a9b8">UOM</label>
            <div class="col-md-4 col-sm-4 col-xs-12">
							 <input type="text" value="{{$pkp->UOM}}" name="uom" id="uom" class="form-control col-md-12 col-xs-12">
            </div>
          </div>
          <div class="form-group row">
            <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12" style="color:#31a9b8">Production Location</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
							 <input type="text" value="" name="location" id="location" class="form-control col-md-12 col-xs-12">
            </div>
          </div>
					<div class="form-group row">
            <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12" style="color:#31a9b8">UoM per BOX</label>
            <div class="col-md-4 col-sm-4 col-xs-12">
							 <input type="text" value="{{ $pkp->kemas->tersier }}" name="uom_box" id="uom_box" class="form-control col-md-12 col-xs-12">
            </div>
						<label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12" style="color:#31a9b8">BOX per BATCH</label>
            <div class="col-md-3 col-sm-3 col-xs-12">
							 <input type="text" value="" name="box_batch" id="box_batch" class="form-control col-md-12 col-xs-12">
            </div>
          </div>
					<div class="form-group row">
            <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12" style="color:#31a9b8">Mass per UOM (g)</label>
            <div class="col-md-4 col-sm-4 col-xs-12">
							 <input type="text" value="" name="mass_uom" id="mass_uom" class="form-control col-md-12 col-xs-12">
            </div>
						<label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12" style="color:#31a9b8">serving size (g)</label>
            <div class="col-md-3 col-sm-3 col-xs-12">
							 <input type="text" value="{{$formula->serving_size}}" name="serving_size" id="serving_size" class="form-control col-md-12 col-xs-12">
            </div>
          </div>
					<div class="form-group row">
            <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12" style="color:#31a9b8">servings/ UOM</label>
            <div class="col-md-4 col-sm-4 col-xs-12">
							 <input type="text" value="{{ $pkp->kemas->primer }}" name="serving_uom" id="serving_uom" class="form-control col-md-12 col-xs-12">
            </div>
						<label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12" style="color:#31a9b8">servings/ month</label>
            <div class="col-md-3 col-sm-3 col-xs-12">
							 <input type="text" value="" name="serving_month" id="serving_month" class="form-control col-md-12 col-xs-12">
            </div>
          </div>
					<div class="form-group row">
            <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12" style="color:#31a9b8">Batch/month</label>
            <div class="col-md-4 col-sm-4 col-xs-12">
							 <input type="text" value="" name="batch_month" id="batch_month" class="form-control col-md-12 col-xs-12">
            </div>
						<label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12" style="color:#31a9b8">Batch size (g)</label>
            <div class="col-md-3 col-sm-3 col-xs-12">
							 <input type="text" value="{{$formula->batch}}" name="batch_size" id="batch_size" class="form-control col-md-12 col-xs-12">
            </div>
          </div>
					<div class="form-group row">
            <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12" style="color:#31a9b8">Batch size granulation (kg)</label>
            <div class="col-md-4 col-sm-4 col-xs-12">
							 <input type="text" value="" name="batch_granulation" id="batch_granulation" class="form-control col-md-12 col-xs-12">
            </div>
						<label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12" style="color:#31a9b8">Yield (%)</label>
            <div class="col-md-3 col-sm-3 col-xs-12">
							 <input type="text" value="" name="yiels" id="yiels" class="form-control col-md-12 col-xs-12">
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
        <h3><li class="fa fa-edit"></li> Notes</h3>
      </div>
      <div class="card-block">
        <div class="x_content">
          <div class="form-group row">
						<label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name" style="color:#31a9b8">New Material ?</label>
            <div class="col-md-2 col-sm-2 col-xs-12">
							<select name="new_material" id="new_material" class="form-control">
								<option value="Yes">Yes</option>
								<option value="No">No</option>
							</select>
            </div>
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name" style="color:#31a9b8">New Machine ?</label>
            <div class="col-md-2 col-sm-2 col-xs-12">
							<select name="new_Machine" id="new_Machine" class="form-control">
								<option value="Yes">Yes</option>
								<option value="No">No</option>
							</select>
            </div>
            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name" style="color:#31a9b8">Trial ?</label>
            <div class="col-md-2 col-sm-2 col-xs-12">
							<select name="trial" id="trial" class="form-control">
								<option value="Yes">Yes</option>
								<option value="No">No</option>
							</select>
            </div>
          </div>
          <div class="form-group row">
            <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12" style="color:#31a9b8">Note</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
							<textarea name="" id="" rows="3" name="note" id="note" class="form-control col-md-12 col-xs-12"></textarea>
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
        <h3><li class="fa fa-paper-plane"></li> Sent</h3>
      </div>
      <div class="card-block">
        <div class="x_content">
          <div class="form-group row">
						<label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name" style="color:#31a9b8">Sent</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
							<h2><input type="radio" name="info" id="info" value="draf" checked> Save as Draf </h2>
							<h2><input type="radio" name="info" id="info" value="sent"> Save and send to PIC</h2>
            </div>
          </div>
          <div class="ln_solid"></div>
					<div class="col-md-6 col-md-offset-5">
            <button type="submit" class="btn btn-primary btn-sm"><li class="fa fa-check"></li> Submit </button>
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
	var forecast 					= document.getElementById('forecast').value;
	var pricelist 				= document.getElementById('pricelist').value;
	var uom_box 					= document.getElementById('uom_box').value;
	var serving_size 			= document.getElementById('serving_size').value;
	var serving_uom 			= document.getElementById('serving_uom').value;
	var batch_size 				= document.getElementById('batch_size').value;

	var mass_per_uom 			= serving_size * serving_uom;
  mass_per_uom     			= parseFloat(mass_per_uom.toFixed(3));
	var box_per_batch 		= (batch_size*1000)/mass_per_uom/uom_box;
  box_per_batch     		= parseFloat(box_per_batch.toFixed(3));
	var serving_per_month = forecast/pricelist*serving_uom;
  serving_per_month     = parseFloat(serving_per_month.toFixed(3));
	var batch_per_month 	= (serving_per_month*serving_size)/(batch_size*1000);
  batch_per_month     	= parseFloat(batch_per_month.toFixed(3));

	
	document.getElementById('mass_uom').value = mass_per_uom;
	document.getElementById('box_batch').value = box_per_batch;
	document.getElementById('serving_month').value = serving_per_month;
	document.getElementById('batch_month').value = batch_per_month;
</script>
@endsection