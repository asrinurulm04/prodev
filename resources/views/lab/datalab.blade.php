@extends('layout.tempvv')
@section('title', 'feasibility|Lab')
@section('content')

<div class="row">
  <div class="col-md-12 col-xs-12">
    <div class="x_panel">
      <div class="col-md-6"><h4><li class="fa fa-flask"></li> Workbook </h4></div>
      <div class="col-md-6" align="right">
        @if($ws->id_project!=NULL)<a href="{{ route('listPkpFs',$pkp->id_project)}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-arrow-left"></li> Back</a>
        @elseif($ws->id_project_pdf!=NULL)<a href="{{ route('listPdfFs',$pdf->id_project_pdf)}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-arrow-left"></li> Back</a>
        @endif
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
              <tr><th>PV</th><td> : {{$pkp->perevisi2->name}}</td></tr>
            </thead>
          </table>
        </div>
        <div class="col-md-7">
          <table>
            <thead>
              <tr><th>Idea</td> <td> : {{$pkp->idea}}</td></tr>
              <tr><th width="25%">Launch Deadline</th><td>: {{$pkp->launch}} {{$pkp->years}}</td></tr>
              <tr><th>Sample Deadline</th><td>: {{$pkp->jangka}}-  {{$pkp->waktu}}</td></tr>
              <tr><th>BPOM</th><td> : {{$pkp->katpangan->no_kategori}} ({{$pkp->katpangan->pangan}})</td></tr>
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
        <h3><li class="fa fa-list"> Item Desc</li></h3>
      </div><br>
      <form class="" method="POST" action="{{route('item')}}">
      <div class='form-group row'>
        <input type="hidden" value="{{$fs}}" name="id" id="id">
        <label class='control-label col-md-3 col-sm-3 col-xs-12'>Item</label>
        <div class='col-md-9 col-sm-9 col-xs-12'>
          <select class='form-control form-control-line' name='item' id='item'>
            <option disabled selected>-->Select One<--</option>
            @foreach($desc as $desc)
            <option value="{{$desc->id}}">{{$desc->item_desc}} ({{$desc->io}})</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class='ln_solid'></div>
      @if($ws->status_lab=='ajukan')
      <input type="hidden" id="batch" value="{{ $ws->form->batch_size }}">
      <div class="form-group row">
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Item Desc </label>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <input type="text" class="form-control" name="item_desc" id="item_desc" readonly>
        </div>
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">PLANT </label>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <input type="text" class="form-control" name="plant" id="plant" readonly>
        </div>
      </div>
      <div class="form-group row">
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Lokasi analisa</label>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <input type="text" class="form-control" name="lokasi" id="lokasi" readonly>
        </div>
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Total batch </label>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <input type="text" class="form-control" value="{{ $ws->form->batch_size }}" name="batch" id="batch" readonly>
        </div>
      </div>
      <div class="form-group row">
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">para x spl (BB)/batch </label>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <input type="text" class="form-control" name="spl_batch" id="spl_batch" readonly>
        </div>
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">para x sampel (swab)/batch </label>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <input type="text" class="form-control" name="para_sample_batch" id="para_sample_batch" readonly>
        </div>
      </div>
      <div class="form-group row">
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Parameter mikro rilis</label>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <input type="text" class="form-control" name="mikro_rilis" id="mikro_rilis" readonly>
        </div>
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Para x sampel analisa rutin</label>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <input type="text" class="form-control" name="sample_analisa_rutin" id="sample_analisa_rutin" readonly>
        </div>
      </div>
      <div class="form-group row">
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Jlh sampel mikro/batch</label>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <input type="text" class="form-control" name="sample_mikro_batch" id="sample_mikro_batch" readonly>
        </div>
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Jlh sampel mikro analisa/thn</label>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <input type="text" class="form-control" name="mikro_analisa_thn" id="mikro_analisa_thn" readonly>
        </div>
      </div>
      <div class="form-group row">
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Biaya analisa mikro rutin/sampel</label>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <input type="text" class="form-control" name="analisa_mikro_rutin" id="analisa_mikro_rutin" readonly>
        </div>
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Biaya mikro rutin/batch</label>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <input type="text" class="form-control" name="mikro_rutin_batch" id="mikro_rutin_batch" readonly>
        </div>
      </div>
      <div class="form-group row">
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Biaya mikro rutin/tahun</label>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <input type="text" class="form-control" name="mikro_rutin_thn" id="mikro_rutin_thn" readonly>
        </div>
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Biaya analisa tahunan/sampel</label>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <input type="text" class="form-control" name="biaya_analisa_tahunan" id="biaya_analisa_tahunan" readonly>
        </div>
      </div>
      <div class="form-group row">
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Biaya analisa tahunan/SKU</label>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <input type="text" class="form-control" name="analisa_tahunan_sku" id="analisa_tahunan_sku" readonly>
        </div>
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Estimasi Biaya mikro analisa BB/batch</label>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <input type="text" class="form-control" name="esimasi_mikro_analisa_batch" id="esimasi_mikro_analisa_batch" readonly>
        </div>
      </div>
      <div class="form-group row">
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Estimasi Biaya mikro analisa BB/tahun</label>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <input type="text" class="form-control" name="esimasi_mikro_analisa_thn" id="esimasi_mikro_analisa_thn" readonly>
        </div>
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Estimasi biaya analisa swab/batch</label>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <input type="text" class="form-control" name="estimasi_analisa_swab" id="estimasi_analisa_swab" readonly>
        </div>
      </div>
      <div class="form-group row">
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Estimasi biaya analisa swab/tahun</label>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <input type="text" class="form-control" name="analisa_swab_thn" id="analisa_swab_thn" readonly>
        </div>
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Estimasi biaya tahanan (resampling)/batch</label>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <input type="text" class="form-control" name="estimasi_tahanan_batch" id="estimasi_tahanan_batch" readonly>
        </div>
      </div>
      <div class="form-group row">
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Estimasi biaya tahanan (resampling/tahun)</label>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <input type="text" class="form-control" name="estimasi_tahanan_thn" id="estimasi_tahanan_thn" readonly>
        </div>
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Estimasi biaya kimia/batch</label>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <input type="text" class="form-control" name="estimasi_kimia_batch" id="estimasi_kimia_batch" readonly>
        </div>
      </div>
      <div class="form-group row">
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Estimasi biaya analisa kimia/tahun</label>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <input type="text" class="form-control" name="estimasi_kimia_thn" id="estimasi_kimia_thn" readonly>
        </div>
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Biaya total/SKU</label>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <input type="text" class="form-control" name="biaya_total" id="biaya_total" readonly>
        </div>
      </div>
      <div class="form-group row">
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Biaya total analisa/batch</label>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <input type="text" class="form-control" name="total_analisa" id="total_analisa" readonly>
        </div>
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Total Para x spl/batch</label>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <input type="text" class="form-control" name="total_para_sample" id="total_para_sample" readonly>
        </div>
      </div>
      @elseif($ws->status_lab!='ajukan')
      <div class="form-group row">
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Item Desc </label>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <input type="text" class="form-control" value="{{$iddesc->item_desc}}" name="item_desc" id="item_desc" readonly>
        </div>
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">PLANT </label>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <input type="text" class="form-control" value="{{$iddesc->io}}" name="plant" id="plant" readonly>
        </div>
      </div>
      <div class="form-group row">
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Lokasi analisa</label>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <input type="text" class="form-control" value="{{$iddesc->lokasi}}" name="lokasi" id="lokasi" readonly>
        </div>
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Total batch </label>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <input type="text" class="form-control" value="{{ $ws->form->batch_size }}" name="batch" id="batch" readonly>
        </div>
      </div>
      <div class="form-group row">
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">para x spl (BB)/batch </label>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <input type="text" class="form-control" value="{{$iddesc->spl_batch}}" name="spl_batch" id="spl_batch" readonly>
        </div>
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">para x sampel (swab)/batch </label>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <input type="text" class="form-control" value="{{$iddesc->sample_swab}}" name="para_sample_batch" id="para_sample_batch" readonly>
        </div>
      </div>
      <div class="form-group row">
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Parameter mikro rilis</label>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <input type="text" class="form-control" value="{{$iddesc->parameter_mikro}}" name="mikro_rilis" id="mikro_rilis" readonly>
        </div>
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Para x sampel analisa rutin</label>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <input type="text" class="form-control" value="{{$iddesc->sample_analisa}}" name="sample_analisa_rutin" id="sample_analisa_rutin" readonly>
        </div>
      </div>
      <div class="form-group row">
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Jlh sampel mikro/batch</label>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <input type="text" class="form-control" value="{{$iddesc->jlh_sample_mikro}}" name="sample_mikro_batch" id="sample_mikro_batch" readonly>
        </div>
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Jlh sampel mikro analisa/thn</label>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <input type="text" class="form-control" value="{{$iddesc->jlh_mikro_tahunan}}" name="mikro_analisa_thn" id="mikro_analisa_thn" readonly>
        </div>
      </div>
      <div class="form-group row">
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Biaya analisa mikro rutin/sampel</label>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <input type="text" class="form-control" value="{{$iddesc->biaya_analisa}}" name="analisa_mikro_rutin" id="analisa_mikro_rutin" readonly>
        </div>
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Biaya mikro rutin/batch</label>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <input type="text" class="form-control" name="mikro_rutin_batch" id="mikro_rutin_batch" readonly>
        </div>
      </div>
      <div class="form-group row">
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Biaya mikro rutin/tahun</label>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <input type="text" class="form-control" name="mikro_rutin_thn" id="mikro_rutin_thn" readonly>
        </div>
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Biaya analisa tahunan/sampel</label>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <input type="text" class="form-control" value="{{$iddesc->biaya_analisa_tahun}}" name="biaya_analisa_tahunan" id="biaya_analisa_tahunan" readonly>
        </div>
      </div>
      <div class="form-group row">
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Biaya analisa tahunan/SKU</label>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <input type="text" class="form-control" value="{{$iddesc->biaya_analisa_tahun}}" name="analisa_tahunan_sku" id="analisa_tahunan_sku" readonly>
        </div>
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Estimasi Biaya mikro analisa BB/batch</label>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <input type="text" class="form-control" value="{{$iddesc->mikro_analisa}}" name="esimasi_mikro_analisa_batch" id="esimasi_mikro_analisa_batch" readonly>
        </div>
      </div>
      <div class="form-group row">
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Estimasi Biaya mikro analisa BB/tahun</label>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <input type="text" class="form-control" name="esimasi_mikro_analisa_thn" id="esimasi_mikro_analisa_thn" readonly>
        </div>
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Estimasi biaya analisa swab/batch</label>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <input type="text" class="form-control" value="{{$iddesc->analisa_swab}}" name="estimasi_analisa_swab" id="estimasi_analisa_swab" readonly>
        </div>
      </div>
      <div class="form-group row">
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Estimasi biaya analisa swab/tahun</label>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <input type="text" class="form-control" name="analisa_swab_thn" id="analisa_swab_thn" readonly>
        </div>
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Estimasi biaya tahanan (resampling)/batch</label>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <input type="text" class="form-control" value="{{$iddesc->biaya_tahanan}}" name="estimasi_tahanan_batch" id="estimasi_tahanan_batch" readonly>
        </div>
      </div>
      <div class="form-group row">
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Estimasi biaya tahanan (resampling/tahun)</label>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <input type="text" class="form-control" name="estimasi_tahanan_thn" id="estimasi_tahanan_thn" readonly>
        </div>
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Estimasi biaya kimia/batch</label>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <input type="text" class="form-control" value="{{$iddesc->kimia_batch}}" name="estimasi_kimia_batch" id="estimasi_kimia_batch" readonly>
        </div>
      </div>
      <div class="form-group row">
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Estimasi biaya analisa kimia/tahun</label>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <input type="text" class="form-control" name="estimasi_kimia_thn" id="estimasi_kimia_thn" readonly>
        </div>
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Biaya total/SKU</label>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <input type="text" class="form-control" name="biaya_total" id="biaya_total" readonly>
        </div>
      </div>
      <div class="form-group row">
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Biaya total analisa/batch</label>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <input type="text" class="form-control" name="total_analisa" id="total_analisa" readonly>
        </div>
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Total Para x spl/batch</label>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <input type="text" class="form-control" name="total_para_sample" id="total_para_sample" readonly>
        </div>
      </div>
      @endif
      @if($ws->status_lab!='selesai')
      <center>
        <hr>
        @if($ws->id_project!=NULL)
        <a href="{{route('AddItem',[$pkp->id_project,$fs])}}" class="btn btn-warning btn-sm" type="button"> <li class="fa fa-plus"></li> New Desc</a>
        @elseif($ws->id_project_pdf!=NULL)
        <a href="{{route('AddItem',[$pdf->id_project_pdf,$fs])}}" class="btn btn-warning btn-sm" type="button"> <li class="fa fa-plus"></li> New Desc</a>
        @endif
        <button type="submit" onclick="return confirm('Yakin Dengan Data Yang Anda Pilih??')" class="btn btn-primary btn-sm"><li class="fa fa-check"></li> Use Item Desc</button>
        {{ csrf_field() }}
      </center>  
      @endif
      </form>
    </div>
  </div>
</div>
<!-- /page content -->

@endsection
@section ('s')
<link href="{{ asset('lib/advanced-datatable/css/jquery.dataTables.css') }}" rel="stylesheet" />
<script src="{{ asset('js/datatables.min.js')}}"></script>
<script src="{{asset('/js/jquery.cookie.js')}}" charset="utf-8"></script>
<script>
  $(document).ready(function(){
    var total_batch         = $("#batch").val();
     // Get Item
    $('#item').on('change', function(){
      var myId = $(this).val();
      if(myId){
        $.ajax({
          url: '{{URL::to('getitemdesc')}}/'+myId,
          type: "GET",
          dataType: "json",
          beforeSend: function(){
            $('#loader').css("visibility", "visible");
          },
          success:function(data){
            $('#itemdesc').empty();
            $.each(data, function(index, element){
              var biaya_mikro_rutin   = element.biaya_analisa * element.jlh_sample_mikro;biaya_mikro_rutin = parseFloat(biaya_mikro_rutin.toFixed(3));
              var biaya_mikro_tahun   = biaya_mikro_rutin * total_batch;biaya_mikro_tahun = parseFloat(biaya_mikro_tahun.toFixed(3));
              var mikro_analisa_bb    = element.mikro_analisa * total_batch;mikro_analisa_bb = parseFloat(mikro_analisa_bb.toFixed(3));
              var swab_analisa_thn    = element.analisa_swab * total_batch;swab_analisa_thn  = parseFloat(swab_analisa_thn.toFixed(3));
              var resampling_thn      = element.biaya_tahanan * total_batch;resampling_thn = parseFloat(resampling_thn.toFixed(3));
              var biaya_analisa_kimia = element.kimia_batch * total_batch;biaya_analisa_kimia = parseFloat(biaya_analisa_kimia.toFixed(3));
              var total_sku           = biaya_analisa_kimia + resampling_thn + swab_analisa_thn + mikro_analisa_bb + biaya_mikro_tahun + element.biaya_analisa_tahun;
              var total_analisa       = total_sku / total_batch ;total_analisa = parseFloat(total_analisa.toFixed(3));
              var total_para          = element.sample_swab + element.sample_analisa ;total_para   = parseFloat(total_para.toFixed(3));

              $("#item_desc").val(element.item_desc);
              $("#plant").val(element.io);
              $("#lokasi").val(element.lokasi);
              $("#spl_batch").val(element.spl_batch);
              $("#para_sample_batch").val(element.sample_swab);
              $("#mikro_rilis").val(element.parameter_mikro);
              $("#sample_analisa_rutin").val(element.sample_analisa);
              $("#sample_mikro_batch").val(element.jlh_sample_mikro);
              $("#mikro_analisa_thn").val(element.jlh_mikro_tahunan);
              $("#analisa_mikro_rutin").val(element.biaya_analisa);
              $("#mikro_rutin_batch").val(biaya_mikro_rutin);
              $("#mikro_rutin_thn").val(biaya_mikro_tahun);
              $("#biaya_analisa_tahunan").val(element.biaya_analisa_tahun);
              $("#analisa_tahunan_sku").val(element.biaya_analisa_tahun);
              $("#esimasi_mikro_analisa_batch").val(element.mikro_analisa);
              $("#esimasi_mikro_analisa_thn").val(mikro_analisa_bb);
              $("#estimasi_analisa_swab").val(element.analisa_swab);
              $("#analisa_swab_thn").val(swab_analisa_thn);
              $("#estimasi_tahanan_batch").val(element.biaya_tahanan);
              $("#estimasi_tahanan_thn").val(resampling_thn);
              $("#estimasi_kimia_batch").val(element.kimia_batch);
              $("#estimasi_kimia_thn").val(biaya_analisa_kimia);
              $("#biaya_total").val(total_sku);
              $("#total_analisa").val(total_analisa);
              $("#total_para_sample").val(total_para);
            });
          },
          complete: function(){
            $('#loader').css("visibility","hidden");
          }
        });
      }else{
        $('#itemdesc').empty();
      }
    });
  });
</script>
<script type="text/javascript">
    $(document).ready(function() {
      var total_batch                 = $( "#batch" ).val();
      var analisa_mikro_rutin         = $( "#analisa_mikro_rutin" ).val();
      var sample_mikro_batch          = $( "#sample_mikro_batch" ).val();
      var esimasi_mikro_analisa_batch = $( "#esimasi_mikro_analisa_batch" ).val();
      var estimasi_analisa_swab       = $( "#estimasi_analisa_swab" ).val();
      var estimasi_tahanan_batch      = $( "#estimasi_tahanan_batch" ).val();
      var estimasi_kimia_batch        = $( "#estimasi_kimia_batch" ).val();
      var para_sample_batch           = $( "#para_sample_batch" ).val();
      var sample_analisa_rutin        = $( "#sample_analisa_rutin" ).val();
      var biaya_analisa_tahunan       = $( "#biaya_analisa_tahunan" ).val();

      var biaya_mikro_rutin   = analisa_mikro_rutin * sample_mikro_batch;biaya_mikro_rutin = parseFloat(biaya_mikro_rutin.toFixed(3));
      var biaya_mikro_tahun   = biaya_mikro_rutin * total_batch;biaya_mikro_tahun = parseFloat(biaya_mikro_tahun.toFixed(3));
      var mikro_analisa_bb    = esimasi_mikro_analisa_batch * total_batch;mikro_analisa_bb = parseFloat(mikro_analisa_bb.toFixed(3));
      var swab_analisa_thn    = estimasi_analisa_swab * total_batch;swab_analisa_thn  = parseFloat(swab_analisa_thn.toFixed(3));
      var resampling_thn      = estimasi_tahanan_batch * total_batch;resampling_thn = parseFloat(resampling_thn.toFixed(3));
      var biaya_analisa_kimia = estimasi_kimia_batch * total_batch;biaya_analisa_kimia = parseFloat(biaya_analisa_kimia.toFixed(3));
      var nilai               = biaya_analisa_tahunan*1;
      var total_sku           = biaya_analisa_kimia + resampling_thn + swab_analisa_thn + mikro_analisa_bb + biaya_mikro_tahun + nilai;total_sku = parseFloat(total_sku.toFixed(3));
      var total_analisa       = total_sku / total_batch ;total_analisa = parseFloat(total_analisa.toFixed(3));
      var total_para          = (para_sample_batch*1) + (sample_analisa_rutin*1);
      
      $("#mikro_rutin_batch").val(biaya_mikro_rutin);
      $("#mikro_rutin_thn").val(biaya_mikro_tahun);
      $("#esimasi_mikro_analisa_thn").val(mikro_analisa_bb);
      $("#analisa_swab_thn").val(swab_analisa_thn);
      $("#estimasi_tahanan_thn").val(resampling_thn);
      $("#estimasi_kimia_thn").val(biaya_analisa_kimia);
      $("#biaya_total").val(total_sku);
      $("#total_analisa").val(total_analisa);
      $("#total_para_sample").val(total_para);
    })
</script>
@endsection