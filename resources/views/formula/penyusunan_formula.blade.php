@extends('formula.tempformula')
@section('title', 'Workbook | Penyusunan Formula')
@section('judul', 'Workbook | Penyusunan Formula')
@section('content')

<div class="row">
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
</div>

<div class="row">
  @include('formerrors')
  <div class="col-md-3"></div>
  <div class="col-md-7">
    <div class="tabbable">
      <ul class="nav nav-tabs wizard">
        <li class="active"><a href=""><span class="nmbr">1</span>Registrasi</a></li>
        <li class="completed"><a href=""><span class="nmbr">2</span>Penyusunan</a></li>
        <li class="active"><a href=""><span class="nmbr">3</span>BB Alternatif</a></li>
        <li class="active"><a href=""><span class="nmbr">4</span>Summary</a></li>
      </ul>
    </div>
  </div>
</div>

@foreach($registrasi as $regis)
<div class="col-md-12 col-xs-12">
  <div class="x_panel">
		<div class="row">
			<div class="col-md-4 col-sm-4">
			<b>Nama Formula :</b> {{$regis->nama_formula}}
			</div>
			<div class="col-md-4 col-sm-4">
			<b>Alokasi Formula :</b> {{$regis->alokasi_formula}}
			</div>
			<div class="col-md-4 col-sm-4">
			<b>Lokasi Plant Produksi :</b> {{$regis->lokasi_plant}}
			</div>
		</div>		
	</div>
</div>

<form class="form-horizontal form-label-left" method="POST" action="{{ route('formula',$regis->id_registrasi) }}">
<div class="col-md-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h4><li class="fa fa-edit"></li> 1. Base Perhitungan Formula  </h4>
    </div>
    <div id="exTab2" class="container">	
			<ul class="nav nav-tabs  tabs" role="tablist">
				<li class="nav-item"><a class="nav-link active" href="#1" data-toggle="tab"><i class="fa fa-list"></i> Bahan Baku</a></li>
				<li class="nav-item"><a class="nav-link" href="#2" data-toggle="tab"><i class="fa fa-clipboard"></i> Total Batch Size</a></li>
			</ul><br>
			<input type="hidden" value="{{$regis->id_registrasi}}" name="regis" id="regis">
			<div class="tab-content ">
				<div class="tab-content ">
					<div class="tab-pane active" id="1">
						<div class="form-group row">
							<div class="col-md-3 col-sm-3 col-xs-12">
								<label for="middle-name"> Pilih Bahan Baku/WIP </label>
								<select name="bb" id="bb" class="form-control">
									<option value=""></option>
									@foreach($bahan as $bahan)
									<option value="{{$bahan->id}}">{{$bahan->nama_sederhana}}</option>
									@endforeach
								</select>
							</div>
							<div class="col-md-2 col-sm-2 col-xs-12">
								<label for="middle-name"> Principle </label>
								<select name="principle" id="principle" class="form-control" readonly>
									<option value=""></option>
								</select>
							</div>
							<div class="col-md-2 col-sm-2 col-xs-12">
								<label for="middle-name"> Allergen BB </label>
								<input type="text" name="Allergen" id="Allergen" class="form-control" required>
							</div>
							<div class="col-md-2 col-sm-2 col-xs-12">
								<label for="middle-name"> UOM BB </label>
								<input type="text" name="UOM" id="UOM" class="form-control" required>
							</div>
							<div class="col-md-3 col-sm-3 col-xs-12">
								<label for="middle-name"> Berat per-UOM BB (kg) </label>
								<input type="number" name="berat_uom" id="berat_uom" class="form-control" required>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-2 col-sm-3 col-xs-12">
								<label for="middle-name"> Qty BB per Serving (g) </label>
								<input type="number" name="bb_serving" id="bb_serving" class="form-control" required>
							</div>
							<div class="col-md-2 col-sm-3 col-xs-12">
								<label for="middle-name"> Qty BB per Batch (g) </label>
								<input type="number" name="bb_batch" id="bb_batch" class="form-control" required>
							</div>
							<div class="col-md-2 col-sm-3 col-xs-12">
								<label for="middle-name"> Persen Komposisi (%) </label>
								<input type="number" name="komposisi" id="komposisi" class="form-control" required>
							</div>
							<div class="col-md-2 col-sm-3 col-xs-12">
								<label for="middle-name"> Target Serving Size (g) </label>
								<input type="number" name="target_serving" id="target_serving" class="form-control" required>
							</div>
						</div>
					</div>
					<div class="tab-pane" id="2">
						<div class="form-group row">
							<div class="col-md-2 col-sm-2 col-xs-12">
								<label for="middle-name"> Total BB per Batch (g) </label>
								<input type="text" name="" id="batch2" class="form-control">
							</div>
							<div class="col-md-2 col-sm-2 col-xs-12">
								<label for="middle-name"> Persen Komposisi (%) </label>
								<input type="text" name="" id="komposisi2" class="form-control">
							</div>
							<div class="col-md-2 col-sm-2 col-xs-12">
								<label for="middle-name"> Target Serving Size (g) </label>
								<input type="text" name="" id="serving2" class="form-control">
							</div>
						</div>
					</div><hr>
					<div class="col-md-6 col-md-offset-5">
						<button type="button" class="btn btn-danger btn-sm"><li class="fa fa-ban"></li> Cencel</button>
						<button type="reset" class="btn btn-warning btn-sm"><li class="fa fa-repeat"></li> Reset</button>
						<button type="submit" class="btn btn-primary btn-sm"><li class="fa fa-check"></li> Set Base</button>
						{{ csrf_field() }}
					</div>
				</div>
			</div>
    </div>
  </div>
</div>
</form>


<form class="form-horizontal form-label-left" method="POST" action="{{ route('updateregis',[$regis->id_registrasi,$regis->id_pkp]) }}">
<div class="col-md-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h4><li class="fa fa-edit"></li> 2. Input Formula  </h4>
    </div>
    <div class="card-block">
			<div class="form-group row">
      	<label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12"> Rasio Batch Formula </label>
				<div class="col-md-2 col-sm-2 col-xs-12">
					@if($regis->rasio_batch_formula==null)
        	<input type="radio" name="rasio_formula" checked value="serving" id="radio_temp"> Qty BB per Serving
					@elseif($regis->rasio_batch_formula!=null)
						@if($regis->rasio_batch_formula=='serving')
						<input type="radio" name="rasio_formula" checked value="serving" id="radio_temp"> Qty BB per Serving
						@else
						<input type="radio" name="rasio_formula" value="serving" id="radio_temp"> Qty BB per Serving
						@endif
					@endif
				</div>
				<div class="col-md-2 col-sm-2 col-xs-12">
					@if($regis->rasio_batch_formula==null)
						<input type="radio" name="rasio_formula" value="batch" id="radio_cal"> Qty BB per Batch
					@elseif($regis->rasio_batch_formula!=null)
						@if($regis->rasio_batch_formula=='batch')
						<input type="radio" name="rasio_formula" checked value="batch" id="radio_cal"> Qty BB per Batch
						@else
						<input type="radio" name="rasio_formula" value="batch" id="radio_cal"> Qty BB per Batch
						@endif
					@endif
				</div>
				<div class="col-md-2 col-sm-2 col-xs-12">
					@if($regis->rasio_batch_formula==null)
						<input type="radio" name="rasio_formula" value="komposisi" id="radio_cal"> % Komposisi
					@elseif($regis->rasio_batch_formula!=null)
						@if($regis->rasio_batch_formula=='komposisi')
						<input type="radio" name="rasio_formula" checked value="komposisi" id="radio_cal"> % Komposisi
						@else
						<input type="radio" name="rasio_formula" value="komposisi" id="radio_cal"> % Komposisi
						@endif
					@endif
				</div>
      </div>
			
			<div class="form-group row">
        <label class="control-label col-md-2 col-sm-2 col-xs-12">Scale Ratio </label>
				<div class="col-md-3 col-sm-3 col-xs-12">
      	  <input type="number" class="form-control" value="{{$regis->scale_batch}}" name="scale" id="scale" required>
      	</div>
      </div><hr>

			<div class="form-group row">
        <label class="control-label col-md-1 col-sm-1 col-xs-12"></label>
				<div class="col-md-10 col-sm-10 col-xs-12">
					<table class="table table-striped table-bordered nowrap">
						<thead>
							<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
								<th>Tipe Lini</th>
								<th>Nama Lini</th>
								<th>IO Lini</th>
								<th>Kontribusi Allergen Lini</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><input type="text" class="form-control" name="" value="Persiapan (Internal)" readonly></td>
								<td><input type="text" class="form-control multiple" name="" value="{{$regis->lini_internal}}" readonly></td>
								<td><input type="text" class="form-control internal" name="" value="{{$regis->io_internal}}" readonly></td>
								<td><input type="text" class="form-control internal" name="" value="{{$regis->allergen_internal}}" readonly></td>
							</tr>
							<tr>
								<td><input type="text" class="form-control" name="" value="Persiapan (Maklon)" readonly></td>
								<td><input type="text" class="form-control multiple" name="" value="{{$regis->lini_maklon}}" readonly></td>
								<td><input type="text" class="form-control maklon" name="" value="{{$regis->io_maklon}}" readonly></td>
								<td><input type="text" class="form-control maklon" name="" value="{{$regis->allergen_maklon}}" readonly></td>
							</tr>
							<tr>
								<td><input type="text" class="form-control" name="" value="Proses" readonly></td>
								<td><input type="text" class="form-control multiple" name="" value="{{$regis->lini_proses}}" readonly></td>
								<td><input type="text" class="form-control multiple" name="" value="{{$regis->io_proses}}" readonly></td>
								<td><input type="text" class="form-control multiple" name="" value="{{$regis->allergen_proses}}" readonly></td>
							</tr>
						</tbody>
					</table>
				</div>
      </div>

			<div id="exTab2" class="container">	
				<ul class="nav nav-tabs  tabs" role="tablist">
					<li class="nav-item"><a class="nav-link active" href="#1" data-toggle="tab"><i class="fa fa-list"></i> Formula</a></li>
					<li class="nav-item"><a class="nav-link" href="#2" data-toggle="tab"><i class="fa fa-clipboard"></i> UOM BB</a></li>
				</ul><br>

				<div class="tab-content ">
					<div class="tab-content ">
						<div class="tab-pane active" id="1">
							<div class="form-group">
								<table class="table table-striped table-bordered nowrap">
									<thead>
										<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
											<th class="text-center">Nama Sederhana</th>
											<th class="text-center">Principal</th>
											<th class="text-center">Allergen BB</th>
											<th class="text-center" width="10%">Qty BB per Serving (g)</th>
											<th class="text-center" width="10%">Qty BB per Batch (g)</th>
											<th class="text-center" width="10%">Komposisi (%)</th>
											<th class="text-center">Lini Persiapan</th>
										</tr>
									</thead>
									<tbody>
										@php $no = 0; @endphp
										@foreach($formulas as $for)
										<tr>
											<td><input type="text" class="form-control" name="" readonly value="{{$for->bahans->nama_sederhana}}"></td>
											<td><input type="text" class="form-control" name="" readonly value="{{$for->bahans->principle}}"></td>
											<td><input type="text" class="form-control" name="" value="{{$for->allergen}}" readonly></td>
											<td><input type="text" class="form-control" name="" value="{{$for->bb_serving}}" readonly></td>
											<td><input type="text" class="form-control" name="" value="{{$for->bb_batch}}" readonly></td>
											<td><input type="text" class="form-control" name="" value="{{$for->komposisi}}" readonly></td>
											<td>
												<input type="hidden" name="scores[{{$loop->index}}][id]" value="{{$for->id_formula}}">
												<select class="form-control" name="scores[{{$loop->index}}][persiapan]">
													<option value="{{$for->lini_persiapan}}">{{$for->lini_persiapan}}</option>
													<option value="persiapan">persiapan</option>
													<option value="persiapan1">persiapan1</option>
													<option value="persiapan11">persiapan11</option>
												</select>
											</td>
										</tr>
										@endforeach
										<tr></tr>
										<tr style="font-weight: bold;color:black;background-color: #ddd;">
											<td colspan="3"> Total</td>
											<td><input type="number" class="form-control" name="" value="{{ $rjserving }}" readonly></td>
											<td><input type="number" class="form-control" name="" value="{{ $rjbatch }}" readonly></td>
											<td><input type="number" class="form-control" name="" value="{{ $rjkomposisi }}" readonly></td>
											<td  colspan="2"></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div class="tab-pane" id="2">
							<div class="form-group row">
								<div class="col-md-2 col-sm-2 col-xs-12">
									<label for="middle-name"> Total BB per Batch (g) </label>
									<input type="text" name="" class="form-control">
								</div>
								<div class="col-md-2 col-sm-2 col-xs-12">
									<label for="middle-name"> Persen Komposisi (%) </label>
									<input type="text" name="" class="form-control">
								</div>
								<div class="col-md-2 col-sm-2 col-xs-12">
									<label for="middle-name"> Target Serving Size (g) </label>
									<input type="text" name="" class="form-control">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="form-group row">
      	<label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12"> Catatan Task </label>
      	<div class="col-md-8 col-sm-8 col-xs-12">
      	  <input type="text" name="catatan" id="catatan" value="{{$regis->catatan}}" class="form-control col-md-12 col-xs-12" required>
      	</div>
    	</div>
    </div>
  </div>
</div>

@endforeach
<div class="col-md-12 col-xs-12">
  <div class="x_panel">
    <div class="card-block"><hr>
			<div class="col-md-6 col-md-offset-5">
				<button type="reset" class="btn btn-danger btn-sm"><li class="fa fa-ban"></li> Cencel</button>
				<button type="reset" class="btn btn-warning btn-sm"><li class="fa fa-repeat"></li> Reset</button>
				<button type="submit" class="btn btn-primary btn-sm"><li class="fa fa-check"></li> Submit</button>
				{{ csrf_field() }}
			</div>
    </div>
  </div>
</div>
</form>
@endsection

@section('s')
<script>
	$('#select').select2({
    placeholder: '-->Select One<--',
    allowClear: true
  });

	$(document).ready(function(){
    $('#bb').select2();
      // Get Pangan
      $('#bb').on('change', function(){
          var myId = $(this).val();
            if(myId){
              $.ajax({
              url: '{{URL::to('getbahan')}}/'+myId,
              type: "GET",
              dataType: "json",
              beforeSend: function(){ 
                  $('#loader').css("visibility", "visible");
              },

              success:function(data){
                console.log(data)
                  $('#principle').empty();
									console.log(data);
                  $.each(data, function(key, value){
                      $('#principle').append('<option value="'+ key +'">' + value + '</option>');
                  });
              console.log(data)
              },
              complete: function(){
                  $('#loader').css("visibility","hidden");
              }
          });

          }
          else{
              $('#principle').empty();
          }
      });
  });
</script>
@endsection