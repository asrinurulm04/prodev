@extends('layout.tempvv')
@section('title', 'feasibility|Lab')
@section('content')

<div class="row">
  <div class="col-md-12 col-xs-12">
    <div class="x_panel">
      <div class="col-md-6"><h4><li class="fa fa-flask"></li> Workbook </h4></div>
      <div class="col-md-6" align="right">
        <a href="{{ route('datalab',$pkp->id_project)}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-arrow-left"></li> Back</a>
      </div>
      <div class="x_panel">
        <div class="col-md-5">
          <table>
            <thead>
              <tr><th>Brand</th><td> : {{$pkp->id_brand}}</td></tr>
              <tr><th>Type PKP</th><td> :
                @if($pkp->type==1)Maklon
                @elseif($pkp->type==2)Internal
                @elseif($pkp->type==3)Maklon/Internal
                @endif
              </td></tr>
              <tr><th width="25%">PKP Number</th><td> : {{$pkp->pkp_number}}{{$pkp->ket_no}}</td></tr>
              <tr><th>Status</th><td> : {{$pkp->status_project}}</td></tr>
              <tr><th>Created</th><td> : {{$pkp->created_date}}</td></tr>
            </thead>
          </table>
        </div>
        <div class="col-md-7">
          <table>
            <thead>
              <tr><th>Idea</td> <td> : {{$pkp->idea}}</td></tr>
              <tr><th>Configuration</th><td>: 
                @if($pkp->kemas_eksis!=NULL)(
                  @if($pkp->kemas->tersier!=NULL)
                {{ $pkp->kemas->tersier }}{{ $pkp->kemas->s_tersier }}
                  @endif

                  @if($pkp->kemas->sekunder1!=NULL)
                  X {{ $pkp->kemas->sekunder1 }}{{ $pkp->kemas->s_sekunder1}}
                  @endif

                  @if($pkp->kemas->sekunder2!=NULL)
                  X {{ $pkp->kemas->sekunder2 }}{{ $pkp->kemas->s_sekunder2 }}
                  @endif

                  @if($pkp->kemas->primer!=NULL)
                  X{{ $pkp->kemas->primer }}{{ $pkp->kemas->s_primer }}
                  @endif )
                @endif
              </td></tr>
              <tr><th width="25%">Launch Deadline</th><td>: {{$pkp->launch}} {{$pkp->years}}</td></tr>
              <tr><th>Sample Deadline</th><td>: {{$pkp->jangka}}-  {{$pkp->waktu}}</td></tr>
              <tr><th>PV</th><td> : {{$pkp->perevisi2->name}}</td></tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>  
</div>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h3><li class="fa fa-glass"> DRAF input data kategori Item Desc analisa</li></h3>
      </div>
      <br>
      <div class="form-group row">
        <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12"> IO </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
					<input type="text" class="form-control" name="" id="" required>
        </div>
				<label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12"> Lokasi Analisa </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
					<input type="text" class="form-control" name="" id="" required>
        </div>
      </div><hr>
      <div class="form-group row">
        <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12"> Item Desc </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
					<input type="text" class="form-control" name="" id="" required>
        </div>
				<label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12"> Biaya analisa tahunan </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
					<input type="text" class="form-control" name="" id="" required>
        </div>
      </div>
			<div class="form-group row">
        <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12"> Total batch </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
					<input type="text" class="form-control" name="" id="" required>
        </div>
				<label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12"> Biaya mikro analisa BB / batch </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
					<input type="text" class="form-control" name="" id="" required>
        </div>
      </div>
			<div class="form-group row">
        <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12"> para x spl (BB) per batch </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
					<input type="text" class="form-control" name="" id="" required>
        </div>
				<label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12"> biaya analisa swab per batch </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
					<input type="text" class="form-control" name="" id="" required>
        </div>
      </div>
			<div class="form-group row">
        <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12"> para x sampel (swab) per batch </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
					<input type="text" class="form-control" name="" id="" required>
        </div>
				<label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12"> biaya tahanan per batch </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
					<input type="text" class="form-control" name="" id="" required>
        </div>
      </div>
			<div class="form-group row">
        <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12"> Parameter mikro </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
					<input type="text" class="form-control" name="" id="" required>
        </div>
				<label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12"> Estimasi biaya kimia per batch </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
					<input type="text" class="form-control" name="" id="" required>
        </div>
      </div>
			<div class="form-group row">
        <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12"> para x sampel analisa rutin </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
					<input type="text" class="form-control" name="" id="" required>
        </div>
				<label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12"> Biaya analisa mikro rutin </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
					<input type="text" class="form-control" name="" id="" required>
        </div>
      </div>
			<div class="form-group row">
        <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12"> Jumlah sampel mikro/batch </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
					<input type="text" class="form-control" name="" id="" required>
        </div>
				<label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12"> Jumlah sampel mikro tahunan </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
					<input type="text" class="form-control" name="" id="" required>
        </div>
      </div><hr>
			<div class="col-md-6 col-md-offset-5">
        <button type="reset" class="btn btn-warning btn-sm"><li class="fa fa-repeat"></li> Reset</button>
        <button type="submit" class="btn btn-primary btn-sm"><li class="fa fa-check"></li> Submit</button>
        {{ csrf_field() }}
      </div>
    </div>
  </div>
</div>
<!-- /page content -->

@endsection

@section ('s')
<script src="{{asset('/js/jquery.cookie.js')}}" charset="utf-8"></script>
@endsection