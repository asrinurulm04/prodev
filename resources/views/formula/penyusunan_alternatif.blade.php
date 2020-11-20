@extends('formula.tempformula')
@section('title', 'Workbook | Penyusunan BB Alternatif')
@section('judul', 'Workbook | Penyusunan BB Alternatif')
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
        <li class="active"><a href=""><span class="nmbr">2</span>Penyusunan</a></li>
        <li class="completed"><a href=""><span class="nmbr">3</span>BB Alternatif</a></li>
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
		</div><hr>
    <div class="card-block">
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
    </div>
  </div>
</div>

<div class="col-md-12 col-xs-12">
  <div class="x_panel">
    <div class="card-block"><br>
			<div class="form-group row">
				<label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12"> 1. Jenis Batch Formula </label>
			</div>
			<div class="form-group row">
				<div class="col-md-3 col-sm-3 col-xs-12">
        	<input type="radio" name="data" oninput="template()" id="radio_temp"> Menyerupai Komposisi Formula Eksis
				</div>
				<div class="col-md-3 col-sm-3 col-xs-12">
					<select name="" id="" class="form-control">
						<option value=""></option>
					</select>
				</div>
      </div>
			<div class="form-group row">
				<div class="col-md-3 col-sm-3 col-xs-12">
        	<input type="radio" name="data" oninput="template()" id="radio_temp"> Base Formula Baru
				</div>
      </div><br>
			<div class="form-group row">
				<label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12"> 2. Pemilihan BB Alternatif </label>
			</div>
				<div class="tab-content ">
					<div class="tab-content ">
						<div class="tab-pane active" id="1">
							<div class="form-group">
								<table class="table table-striped table-bordered nowrap">
									<thead>
										<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
											<th>#</th>
											<th class="text-center">Nama Sederhana BB</th>
											<th class="text-center">Catatan review BB Alternatif</th>
											<th class="text-center">Uji Aplikasi BB</th>
											<th class="text-center">Alergen BB</th>
											<th class="text-center"></th>
										</tr>
									</thead>
									<tbody>
										@php $no = 1; @endphp
										@foreach($formulas as $for)
										<tr>
											<td>{{$no++}}</td>
											<td><input type="text" class="form-control" name="" readonly value="{{$for->bahans->nama_sederhana}}"></td>
											<td><input type="text" class="form-control" name="" id=""></td>
											<td><input type="checkbox" checked class="form-control" name="" id=""></td>
											<td><input type="text" class="form-control" name="" value="{{$for->allergen}}" readonly></td>
											<td class="text-center"><button class="btn btn-primary btn-sm" type="button"><li class="fa fa-plus"></li></button></td>
										</tr>
										@endforeach
										<tr></tr>
									</tbody>
								</table>
							</div>
						</div>
						<div class="tab-pane" id="2">
							<div class="form-group row">
								<div class="col-md-2 col-sm-2 col-xs-12">
									<label for="middle-name"> Total BB per Batch (g) </label>
									<input type="text" name="" id="" class="form-control">
								</div>
								<div class="col-md-2 col-sm-2 col-xs-12">
									<label for="middle-name"> Persen Komposisi (%) </label>
									<input type="text" name="" id="" class="form-control">
								</div>
								<div class="col-md-2 col-sm-2 col-xs-12">
									<label for="middle-name"> Target Serving Size (g) </label>
									<input type="text" name="" id="" class="form-control">
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
@endsection