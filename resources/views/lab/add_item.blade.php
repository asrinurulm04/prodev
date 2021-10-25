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
					<input type="number" class="form-control" name="total_batch" id="total_batch" required>
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
      <div class="x_title">
        <h4><li class="fa fa-bookmark"> Data</li></h4>
      </div>
      <div class="form-group row">
        <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12"> Biaya mikro rutin/batch </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
					<input type="text" class="form-control" name="biaya_mikro_rutin" id="biaya_mikro_rutin" readonly>
        </div>
				<label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12"> Biaya mikro rutin/thn </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
					<input type="text" class="form-control" name="biaya_mikro_tahun" id="biaya_mikro_tahun" readonly>
        </div>
      </div>
      <div class="form-group row">
        <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12"> Biaya analisa tahunan/SKU </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
					<input type="text" class="form-control" name="analisa_tahunan_sku" id="analisa_tahunan_sku" readonly>
        </div>
				<label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12"> Biaya mikro analisa BB/thn </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
					<input type="text" class="form-control" name="mikro_analisa_bb" id="mikro_analisa_bb" readonly>
        </div>
      </div>
			<div class="form-group row">
        <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12"> Biaya analisa swab/thn </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
					<input type="text" class="form-control" name="swab_analisa_thn" id="swab_analisa_thn" readonly>
        </div>
				<label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12"> Biaya tahanan (resampling/thn) </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
					<input type="text" class="form-control" name="resampling_thn" id="resampling_thn" readonly>
        </div>
      </div>
			<div class="form-group row">
        <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12"> Biaya analisa kimia/thn </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
					<input type="text" class="form-control" name="biaya_analisa_kimia" id="biaya_analisa_kimia" readonly>
        </div>
				<label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12"> Biaya total/SKU </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
					<input type="text" class="form-control" name="total_sku" id="total_sku" readonly>
        </div>
      </div>
			<div class="form-group row">
        <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12"> Biaya total analisa/batch </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
					<input type="text" class="form-control" name="total_analisa" id="total_analisa" readonly>
        </div>
				<label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12"> Total Para x spl/batch </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
					<input type="text" class="form-control" name="total_para" id="total_para" readonly>
        </div>
      </div>
      <hr>
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

@section ('s')
<script src="{{asset('/js/jquery.cookie.js')}}" charset="utf-8"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#biaya_analisa, #jlh_sample_mikro, #total_batch,#biaya_analisa_tahun,#mikro_analisa_bb,#total_sku,#total_analisa,#sample_swab,#sample_analisa,#total_para,#mikro_analisa,#analisa_swab,#swab_analisa_thn,#biaya_tahanan,#resampling_thn,#kimia_batch,#biaya_analisa_kimia").keyup(function() {
            var biaya_analisa  = $("#biaya_analisa").val();
            var jlh_sample_mikro = $("#jlh_sample_mikro").val();
            var total_batch = $("#total_batch").val();
            var biaya_analisa_tahun = $("#biaya_analisa_tahun").val();
            var mikro_analisa = $("#mikro_analisa").val();
            var analisa_swab  = $("#analisa_swab").val();
            var biaya_tahanan  = $("#biaya_tahanan").val();
            var kimia_batch  = $("#kimia_batch").val();
            var sample_swab  = $("#sample_swab").val();
            var sample_analisa  = $("#sample_analisa").val();

            var total         = parseInt(biaya_analisa) * parseInt(jlh_sample_mikro);
            total  		        = parseFloat(total.toFixed(3));
            var total2        = parseInt(total) * parseInt(total_batch);
            total2  		      = parseFloat(total2.toFixed(3));
            var total3        = parseInt(mikro_analisa) * parseInt(total_batch);
            total3        		= parseFloat(total3.toFixed(3));
            var total4        = parseInt(analisa_swab) * parseInt(total_batch);
            total4  		      = parseFloat(total4.toFixed(3));
            var total5        = parseInt(biaya_tahanan) * parseInt(total_batch);
            total5  		      = parseFloat(total5.toFixed(3));
            var total6        = parseInt(kimia_batch) * parseInt(total_batch);
            total6  		      = parseFloat(total6.toFixed(3));
            var total7        = parseInt(total6) + parseInt(total5) + parseInt(total4) + parseInt(total3) + parseInt(total2) + parseInt(biaya_analisa_tahun);
            total7  		      = parseFloat(total7.toFixed(3));
            var total8        = parseInt(total7) / parseInt(total_batch) ;
            total8  		      = parseFloat(total8.toFixed(3));
            var total9        = parseInt(sample_swab) + parseInt(sample_analisa) ;
            total9  		      = parseFloat(total9.toFixed(3));
            $("#biaya_mikro_rutin").val(total);
            $("#biaya_mikro_tahun").val(total2);
            $("#analisa_tahunan_sku").val(biaya_analisa_tahun);
            $("#mikro_analisa_bb").val(total3);
            $("#swab_analisa_thn").val(total4);
            $("#resampling_thn").val(total5);
            $("#biaya_analisa_kimia").val(total6);
            $("#total_sku").val(total7);
            $("#total_analisa").val(total8);
            $("#total_para").val(total9);
        });
    });
</script>
@endsection