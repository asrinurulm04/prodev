@extends('layout.tempvv')
@section('title', 'feasibility|Lab')
@section('content')

<div class="row">
  <div class="col-md-12 col-xs-12">
    <div class="x_panel">
      <div class="col-md-6"><h4><li class="fa fa-flask"></li> Workbook </h4></div>
      <div class="col-md-6" align="right">
        <a href="{{ route('datalab',[$pkp->id_project,$fs])}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-arrow-left"></li> Back</a>
      </div>
      @if($ws->id_project!=NULL)
      <div class="x_panel">
        <div class="col-md-5">
          <table>
            <thead>
              <tr><th>Brand</th><td> : {{$pkp->id_brand}}</td></tr>
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
              <tr><th width="25%">Launch Deadline</th><td>: {{$pkp->launch}} {{$pkp->years}}</td></tr>
              <tr><th>Sample Deadline</th><td>: {{$pkp->jangka}}-  {{$pkp->waktu}}</td></tr>
              <tr><th>PV</th><td> : {{$pkp->perevisi2->name}}</td></tr>
            </thead>
          </table>
        </div>
      </div>
      @elseif($ws->id_project_pdf!=NULL)
      <div class="x_panel">
        <div class="col-md-5">
          <table>
            <thead>
              <tr><th>Brand</th><td> : {{$pdf->id_brand}}</td></tr>
              <tr><th width="25%">PDf Number</th><td> : {{$pdf->pdf_number}}{{$pdf->ket_no}}</td></tr>
              <tr><th>Status</th><td> : {{$pdf->status_pdf}}</td></tr>
              <tr><th>Created</th><td> : {{$pdf->created_date}}</td></tr>
              <tr><th>PV</th><td> : {{$pdf->perevisi2->name}}</td></tr>
            </thead>
          </table>
        </div>
        <div class="col-md-7">
          <table>
            <thead>
              <tr><th>Background</td> <td> : {{$pdf->background}}</td></tr>
              <tr><th width="25%">RTO</th><td>: {{$pdf->rto}}</td></tr>
              <tr><th>Sample Deadline</th><td>: {{$pdf->jangka}}-  {{$pdf->waktu}}</td></tr>
            </thead>
          </table>
        </div>
      </div>
      @endif
    </div>
  </div>  
</div>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h3><li class="fa fa-glass"> DRAF input data kategori Item Desc analisa</li></h3>
        <small style="color:red">* gunakan (.) untuk pengganti (,)</small>
      </div>
      <br>
      <form method="POST" action="{{ route('adddesc') }}">
			<input type="hidden" class="form-control" name="project" id="project" value="{{$pkp->id_project}}">
			<input type="hidden" class="form-control" name="fs" id="fs" value="{{$fs}}">
      <div class="form-group row">
        <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12"> IO </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
					<select name="io" id="io" class="form-control">
            <option disabled selected>-> Select One <-</option>
            @foreach($io as $io)
            <option value="{{$io->io}}">{{$io->io}}</option>
            @endforeach
          </select>
        </div>
				<label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12"> Lokasi Analisa </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
					<input type="text" class="form-control" name="lokasi" id="lokasi" required>
        </div>
      </div><hr>
      <div class="form-group row">
        <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12"> Item Desc </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
					<input type="text" class="form-control" name="item" id="item" required>
        </div>
				<label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12"> Biaya analisa tahunan </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
					<input type="number" class="form-control" name="biaya_analisa_tahun" id="biaya_analisa_tahun" required>
        </div>
      </div>
			<div class="form-group row">
        <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12"> Total batch </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
					<input type="text" value="{{$ws->form->batch_size}}" class="form-control" name="total_batch" id="total_batch" readonly>
        </div>
				<label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12"> Biaya mikro analisa BB/batch </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
					<input type="number" class="form-control" name="mikro_analisa" id="mikro_analisa" required>
        </div>
      </div>
			<div class="form-group row">
        <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12"> para x spl (BB) per batch </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
					<input type="number" class="form-control" name="spl_batch" id="spl_batch" required>
        </div>
				<label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12"> biaya analisa swab per batch </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
					<input type="number" class="form-control" name="analisa_swab" id="analisa_swab" required>
        </div>
      </div>
			<div class="form-group row">
        <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12"> para x sampel (swab) per batch </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
					<input type="number" class="form-control" name="sample_swab" id="sample_swab" required>
        </div>
				<label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12"> biaya tahanan per batch </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
					<input type="number" class="form-control" name="biaya_tahanan" id="biaya_tahanan" required>
        </div>
      </div>
			<div class="form-group row">
        <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12"> Parameter mikro </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
					<input type="text" class="form-control" name="parameter_mikro" id="parameter_mikro" required>
        </div>
				<label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12"> Biaya kimia per batch </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
					<input type="number" class="form-control" name="kimia_batch" id="kimia_batch" required>
        </div>
      </div>
			<div class="form-group row">
        <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12"> para x sampel analisa rutin </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
					<input type="number" class="form-control" name="sample_analisa" id="sample_analisa" required>
        </div>
				<label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12"> Biaya analisa mikro rutin </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
					<input type="number" class="form-control" name="biaya_analisa" id="biaya_analisa" required>
        </div>
      </div>
			<div class="form-group row">
        <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12"> Jumlah sampel mikro/batch </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
					<input type="number" class="form-control" name="jlh_sample_mikro" id="jlh_sample_mikro" required>
        </div>
				<label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12"> Jumlah sampel mikro tahunan </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
					<input type="number" class="form-control" name="jlh_mikro_tahunan" id="jlh_mikro_tahunan" required>
        </div>
      </div><hr>
			<div class="col-md-6 col-md-offset-5">
        <button type="reset" class="btn btn-warning btn-sm"><li class="fa fa-repeat"></li> Reset</button>
        <button type="submit" class="btn btn-primary btn-sm"><li class="fa fa-check"></li> Submit</button>
        {{ csrf_field() }}
      </div>
    </div>
    </form>
  </div>
</div>
@endsection