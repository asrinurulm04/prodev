@extends('layout.tempvv')
@section('title', 'PRODEV|Pengajuan')
@section('content')

<div class="row">
	<div class="col-md-12 col-xs-12">
    <div class="x_panel" align="right">
      <a href="{{ route('formula.detail',[$formula->id,$pkp->id_project,$formula->workbook_id]) }}" class="btn btn-sm btn-success" type="button" title="Show"><li class="fa fa-book"></li> Workbook</a>
      <a type="button" href="{{ Route('lihatpkp',[$pkp->id_project]) }}" class="btn btn-info btn-sm"><li class="fa fa-eye"></li> PKP</a>
      <a type="button" href="{{route('listPkpFs',$pkp->id_project)}}" class="btn btn-danger btn-sm"><li class="fa fa-arrow-left"></li> Back</a>
		</div>
	</div>
</div>
<form class="form-horizontal form-label-left" method="POST" action="{{route('detailoverview')}}">
<?php $last = Date('j-F-Y'); ?>
<input id="create" value="{{ $last }}" class="form-control col-md-12 col-xs-12" type="hidden" name="create">
<input id="id_fs" value="{{ $fs }}" class="form-control col-md-12 col-xs-12" type="hidden" name="id_fs">
<input id="id_fs" value="{{ $pkp->id_project }}" class="form-control col-md-12 col-xs-12" type="hidden" name="id_project">

<div class="row">
  <div class="col-md-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h3><li class="fa fa-file"></li> Form FS</h3>
      </div>
      <div class="card-block">
        <div class="x_content">
          <input type="hidden" name="type" id="type" value="PKP">
          <div class="form-group row">
            <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12" style="color:#31a9b8">Note PV</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <textarea name="" class="form-control col-md-12 col-sm-12 col-xs-12" id="" rows="2" readonly>{{$fs2->note}}</textarea>
            </div>
          </div>
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
						<label for="middle-name" class="control-label col-md-1 col-sm-1 col-xs-12" style="color:#31a9b8">Category</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
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
            <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12" style="color:#31a9b8">Pricelist (Rp/ UOM)</label>
            <div class="col-md-3 col-sm-3 col-xs-12">
							 <input type="text" value="{{$pkp->selling_price}}" name="pricelist" id="pricelist" class="form-control col-md-12 col-xs-12">
            </div>
						<label for="middle-name" class="control-label col-md-1 col-sm-1 col-xs-12" style="color:#31a9b8">UOM</label>
            <div class="col-md-2 col-sm-2 col-xs-12">
							 <input type="text" value="{{$pkp->UOM}}" name="uom" id="uom" class="form-control col-md-12 col-xs-12" readonly>
            </div>
						<label for="middle-name" class="control-label col-md-1 col-sm-1 col-xs-12" style="color:#31a9b8">UOM / month</label>
            <div class="col-md-2 col-sm-2 col-xs-12">
							@if($count=='1') <input type="text" class="form-control" value="{{$form->uom_month}}" name="uom_month" id="uom_month">
              @elseif($count=='0') <input type="text" name="uom_month" id="uom_month" class="form-control col-md-12 col-xs-12" readonly>
              @endif
            </div>
          </div>
          <div class="form-group row">
            <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12" style="color:#31a9b8">Gramasi/UOM (g)</label>
            <div class="col-md-2 col-sm-2 col-xs-12">
              @if($count=='1') <input type="text" class="form-control" value="{{$form->gramasi_uom}}" name="gramasi_uom" id="gramasi_uom">
              @elseif($count=='0') <input type="text" name="gramasi_uom" id="gramasi_uom" class="form-control col-md-12 col-xs-12">
              @endif
            </div>
            <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12" style="color:#31a9b8">Batch size granulation (kg)</label>
            <div class="col-md-2 col-sm-2 col-xs-12">
              @if($count=='1') <input type="text" value="{{$form->batch_granulation}}" name="batch_granulation" id="batch_granulation" class="form-control col-md-12 col-xs-12">
              @elseif($count=='0') <input type="text" name="batch_granulation" id="batch_granulation" class="form-control col-md-12 col-xs-12">
              @endif
            </div>
						<label for="middle-name" class="control-label col-md-1 col-sm-1 col-xs-12" style="color:#31a9b8">Yield (%)</label>
            <div class="col-md-2 col-sm-2 col-xs-12">
              @if($count=='1') <input type="text" value="{{$form->Yield}}" name="yield" id="yield" class="form-control col-md-12 col-xs-12">
              @elseif($count=='0') <input type="text" name="yield" id="yield" class="form-control col-md-12 col-xs-12">
              @endif
            </div>
          </div>
          <div class="form-group row">
            <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12" style="color:#31a9b8">Forecast (Rp/ month)</label>
            <div class="col-md-3 col-sm-3 col-xs-12">
							<input type="text" value="{{$fch}}" name="forecast" id="forecast" class="form-control col-md-12 col-xs-12">
            </div>
						<label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12" style="color:#31a9b8">Product reference</label>
            <div class="col-md-4 col-sm-4 col-xs-12">
							@if($count=='1') <input type="text" value="{{$form->product_reference}}" name="product_reference" id="product_reference" class="form-control col-md-12 col-xs-12">
              @elseif($count=='0') <input type="text" name="product_reference" id="product_reference" class="form-control col-md-12 col-xs-12">
              @endif
            </div>
          </div>
					<div class="form-group row">
            <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12" style="color:#31a9b8">UoM per BOX</label>
            <div class="col-md-4 col-sm-4 col-xs-12">
							 <input type="text" value="{{ $pkp->kemas->tersier }}" name="uom_box" id="uom_box" class="form-control col-md-12 col-xs-12" readonly>
            </div>
						<label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12" style="color:#31a9b8">BOX per BATCH</label>
            <div class="col-md-3 col-sm-3 col-xs-12">
              @if($count=='1') <input type="text" class="form-control" value="{{$form->box_batch}}" name="box_batch" id="box_batch" readonly>
              @elseif($count=='0') <input type="text" name="box_batch" id="box_batch" class="form-control col-md-12 col-xs-12" readonly>
              @endif
            </div>
          </div>
					<div class="form-group row">
            <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12" style="color:#31a9b8">servings/ UOM</label>
            <div class="col-md-4 col-sm-4 col-xs-12">
              @if($count=='1') <input type="text" class="form-control" value="{{$form->serving_uom}}" name="serving_uom" id="serving_uom" readonly>
              @elseif($count=='0')<td><input type="text" class="form-control" name="serving_uom" id="serving_uom" readonly></td>
              @endif
            </div>
						<label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12" style="color:#31a9b8">serving size (g)</label>
            <div class="col-md-3 col-sm-3 col-xs-12">
							 <input type="text" value="{{$formula->serving_size}}" name="serving_size" id="serving_size" class="form-control col-md-12 col-xs-12" readonly>
            </div>
          </div>
					<div class="form-group row">
            <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12" style="color:#31a9b8">Batch/month</label>
            <div class="col-md-4 col-sm-4 col-xs-12">
              @if($count=='1') <input type="text" class="form-control" value="{{$form->Batch_month}}" name="batch_month" id="batch_month" readonly>
              @elseif($count=='0') <input type="text" name="batch_month" id="batch_month" class="form-control col-md-12 col-xs-12" readonly>
              @endif
            </div>
						<label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12" style="color:#31a9b8">Batch size (g)</label>
            <div class="col-md-3 col-sm-3 col-xs-12">
							 <input type="text" value="{{$formula->batch}}" name="batch_size" id="batch_size" class="form-control col-md-12 col-xs-12">
            </div>
          </div>
          <div class="form-group row">
            <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12" style="color:#31a9b8">Reff EKP</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
							@if($count=='1') <input type="text" value="{{$form->ref_ekp}}" name="ref_ekp" id="ref_ekp" class="form-control col-md-12 col-xs-12">
              @elseif($count=='0') <input type="text" name="ref_ekp" id="ref_ekp" class="form-control col-md-12 col-xs-12">
              @endif
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
						<label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name" style="color:#31a9b8">New Raw Material ?</label>
            <div class="col-md-1 col-sm-1 col-xs-12">
							<select name="new_material" id="new_material" class="form-control">
                @if($count=='1') <option value="{{$form->new_raw_material}}">{{$form->new_raw_material}}</option>@endif
								<option value="Yes">Yes</option>
								<option value="No">No</option>
							</select>
            </div>
            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name" style="color:#31a9b8">New Packaging Material ?</label>
            <div class="col-md-1 col-sm-1 col-xs-12">
							<select name="new_pk_material" id="new_pk_material" class="form-control">
                @if($count=='1') <option value="{{$form->new_packaging_material}}">{{$form->new_packaging_material}}</option>@endif
								<option value="Yes">Yes</option>
								<option value="No">No</option>
							</select>
            </div>
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name" style="color:#31a9b8">New Machine ?</label>
            <div class="col-md-1 col-sm-1 col-xs-12">
							<select name="new_Machine" id="new_Machine" class="form-control">
                @if($count=='1') <option value="{{$form->new_machine}}">{{$form->new_machine}}</option>@endif
								<option value="Yes">Yes</option>
								<option value="No">No</option>
							</select>
            </div>
            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name" style="color:#31a9b8">Trial ?</label>
            <div class="col-md-1 col-sm-1 col-xs-12">
							<select name="trial" id="trial" class="form-control">
                @if($count=='1') <option value="{{$form->trial}}">{{$form->trial}}</option>@endif
								<option value="Yes">Yes</option>
								<option value="No">No</option>
							</select>
            </div>
          </div>
          <div class="form-group row">
            <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12" style="color:#31a9b8">Note</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              @if($count=='1') <textarea rows="3" value="{{$form->notes}}" name="note" id="note" class="form-control col-md-12 col-xs-12">{{$form->notes}}</textarea>
              @elseif($count=='0') <textarea rows="3" name="note" id="note" class="form-control col-md-12 col-xs-12"></textarea>
              @endif
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
            <button type="submit" onclick="return confirm('Are you sure??..')" class="btn btn-primary btn-sm"><li class="fa fa-check"></li> Submit </button>
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
<script type="text/javascript">
    $(document).ready(function() {
      $("#forecast, #pricelist, #uom_box,#serving_size,#batch_size,#yield,#gramasi_uom,#box_batch,#uom_month,#batch_month,#serving_uom").keyup(function() {
        var forecast 					= document.getElementById('forecast').value;
        var pricelist 				= document.getElementById('pricelist').value;
        var uom_box 					= document.getElementById('uom_box').value;
        var serving_size 			= document.getElementById('serving_size').value;
        var batch_size 				= document.getElementById('batch_size').value;
        var yield1 						= document.getElementById('yield').value;
        var gramasi_uom 			= document.getElementById('gramasi_uom').value;

        var yield2						= yield1/100;
        var box_per_batch 		= (batch_size*yield2*1000)/(uom_box*gramasi_uom);
        box_per_batch     		= parseFloat(box_per_batch.toFixed(3));
        var uom_per_month			= forecast/pricelist;
        uom_per_month     		= parseFloat(uom_per_month.toFixed(3));
        var batch_per_month 	= (uom_per_month*gramasi_uom)/(batch_size*yield2*1000);
        batch_per_month     	= parseFloat(batch_per_month.toFixed(3));
        var serving_per_uom 	= gramasi_uom * serving_size;
        serving_per_uom     	= parseFloat(serving_per_uom.toFixed(3));

        $("#box_batch").val(box_per_batch);
        $("#uom_month").val(uom_per_month);
        $("#batch_month").val(batch_per_month);
        $("#serving_uom").val(serving_per_uom);
      });
    });
</script>
@endsection