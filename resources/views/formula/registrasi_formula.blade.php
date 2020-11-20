@extends('formula.tempformula')
@section('title', 'Workbook | Registrasi Formula')
@section('judul', 'Workbook | Registrasi Formula')
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
        <li class="completed"><a href=""><span class="nmbr">1</span>Registrasi</a></li>
        <li class="active"><a href=""><span class="nmbr">2</span>Penyusunan</a></li>
        <li class="active"><a href=""><span class="nmbr">3</span>BB Alternatif</a></li>
        <li class="active"><a href=""><span class="nmbr">4</span>Summary</a></li>
      </ul>
    </div>
  </div>
</div>

<form class="form-horizontal form-label-left" method="POST" action="{{ route('new_registrasi') }}">
<div class="col-md-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h4><li class="fa fa-edit"></li> A. Identitas Product  </h4>
    </div>
    <div class="card-block">
    	<div class="form-group row">
      	<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12"> Company </label>
      	<div class="col-md-7 col-sm-7 col-xs-12">
      	  <input type="text" name="company" id="company" value="Nutrifood" class="form-control col-md-12 col-xs-12" readonly>
      	</div>
    	</div>

			<div class="form-group row">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Category </label>
				<div class="col-md-2 col-sm-2 col-xs-12">
        	<input type="radio" name="categori" id="finish" checked value="finish_good"> Finished Goods
				</div>
				<div class="col-md-1 col-sm-1 col-xs-12">
					<input type="radio" name="categori" id="wip" value="wip"> WIP
				</div>
				<div class="col-md-4 col-sm-4 col-xs-12">
      	  <select class="form-control" disabled name="data_category" id="data_category">
						<option value="premix">premix</option>
					</select>
      	</div>
      </div>
			@foreach($pkp as $pkp)
			<input type="hidden" value="{{$pkp->id}}" name="pkp" id="pkp">
			<div class="form-group row">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Brand </label>
				<div class="col-md-2 col-sm-2 col-xs-12">
      	  <input type="text" name="brand" value="{{$pkp->datapkpp->id_brand}}" id="brand" class="form-control" readonly>
      	</div>
				<div class="col-md-2 col-sm-2 col-xs-12">
      	  <select class="form-control" name="subbrand" id="subbrand" required>
						<option value="">--> Sub Brand <--</option>
						@foreach($subbrand as $sub)
						@if($sub->brand==$pkp->datapkpp->id_brand)
						<option value="{{$sub->id}}">{{$sub->subbrand}}</option>
						@endif
						@endforeach
					</select>
      	</div>
        <label class="control-label col-md-1 col-sm-1 col-xs-12">Product Form </label>
				<div class="col-md-2 col-sm-2 col-xs-12">
      	  <input type="text" name="product_form" value="{{$pkp->product_form}}" id="product_form" class="form-control" readonly>
      	</div>
      </div>
			@endforeach
			
			<div class="form-group row">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Alokasi Formula </label>
				<div class="col-md-1 col-sm-1 col-xs-12">
        	<input type="radio" name="alokasi" id="alokasi" checked value="local"> Local
				</div>
				<div class="col-md-1 col-sm-1 col-xs-12">
					<input type="radio" name="alokasi" id="alokasi" value="export"> Export
				</div>
				<div class="col-md-1 col-sm-1 col-xs-12">
					<input type="radio" name="alokasi" id="alokasi" value="gabungan"> Gabungan
				</div>
      </div>

			<!-- <div class="form-group row">
        <label class="control-label col-md-3 col-sm-3 col-xs-12"> </label>
				<div class="col-md-5 col-sm-5 col-xs-12">
        	<input type="checkbox" name="penetapan_target" id="penetapan_target" value="yes"> Tetapkan Target Serving Size
				</div>
      </div>
			 -->
			<div class="form-group row">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Sering Size </label>
				<div class="col-md-1 col-sm-1 col-xs-12">
					<input type="number" name="serving_size" id="serving_size" class="form-control" required>
				</div>
				<div class="col-md-2 col-sm-2 col-xs-12">
      	  <select class="form-control" name="satuan" id="satuan" title="Satuan" required>
						<option value="">-->Satuan<--</option>
						<option value="gram">Gram</option>
						<option value="ml">ml</option>
					</select>
      	</div>
				<div class="col-md-2 col-sm-2 col-xs-12">
					<input type="number" name="berat_jenis" id="berat_jenis"  placeholder="Berat Jenis (g/ml)" class="form-control" title="Berat Jenis (g/ml)">
				</div>
				<div class="col-md-2 col-sm-2 col-xs-12">
					<input type="number" name="jlh_air_serving" id="jlh_air_serving"  placeholder="Jlh Air Serving (ml)" class="form-control" title="Jumlah Air Serving (ml)">
				</div>
      </div>

    	<div class="form-group row">
      	<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12"> Nama Formula Product </label>
      	<div class="col-md-7 col-sm-7 col-xs-12">
      	  <input type="text" name="nama_formula" id="nama_formula" class="form-control col-md-12 col-xs-12" required>
      	</div>
    	</div>
    </div>
  </div>
</div>

<div class="col-md-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h4><li class="fa fa-edit"></li> B. Identitas Formula  </h4>
    </div>
    <div class="card-block">
			<div class="form-group row">
      	<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12"> Rasio Batch Formula </label>
				<div class="col-md-1 col-sm-1 col-xs-12">
        	<input type="radio" name="rasio" checked id="utuh" value="utuh"> Utuh
				</div>
				<div class="col-md-1 col-sm-1 col-xs-12">
					<input type="radio" name="rasio" id="koma" value="koma"> Koma
				</div>
				<div class="col-md-2 col-sm-2 col-xs-12">
      	  <select class="form-control" disabled name="batch_koma" id="batch_koma">
						<option value="" disabled selected> (< 1 Batch )</option>
					</select>
      	</div>
				<div class="col-md-1 col-sm-1 col-xs-12">
					<input type="radio" name="rasio" id="multiple" value="multiple"> Multiple
				</div>
				<div class="col-md-2 col-sm-2 col-xs-12" >
      	  <select class="form-control" disabled name="batch_multiple" id="batch_multiple">
						<option value="" disabled selected> (> 1 Batch )</option>
					</select>
      	</div>
      </div>
			
			<div class="form-group row">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Lokasi Plant Produksi </label>
				<div class="col-md-2 col-sm-2 col-xs-12">
      	  <select class="form-control" name="plat_produksi" id="plat_produksi">
						<option value="maklon">Maklon</option>
					</select>
      	</div>
      </div>
			<div class="form-group row">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Lokasi Proses Persiapan </label>
				<div class="col-md-2 col-sm-2 col-xs-12">
					<input type="checkbox" name="lokasi" id="internal" value="internal" > Gudang Internal
				</div>
				<div class="col-md-2 col-sm-2 col-xs-12">
					<input type="checkbox" name="lokasi" id="maklon" value="maklon" > Gudang Maklons
				</div>
      </div>
			<hr>
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
								<td><input type="text" class="form-control" name="" id="" value="Persiapan (Internal)" readonly></td>
								<td>
									<select name="lini_internal" id="lini_internal" required class="form-control internal">
										<option value="Gudang B">Gudang B</option>
									</select>
								</td>
								<td><input type="text" class="form-control internal" name="io_internal" id="io_internal" required></td>
								<td><input type="text" class="form-control internal" name="allergen_internal" id="allergen_internal" required></td>
							</tr>
							<tr>
								<td><input type="text" class="form-control" name="" id="" value="Persiapan (Maklon)" readonly></td>
								<td>
									<select name="lini_maklon" id="lini_maklon" class="form-control maklon" required>
										<option value="">-->Select One<--</option>
									</select>
								</td>
								<td><input type="text" class="form-control maklon" name="io_maklon" id="io_maklon" required></td>
								<td><input type="text" class="form-control maklon" name="allergen_maklon" id="allergen_maklon" required></td>
							</tr>
							<tr>
								<td><input type="text" class="form-control" name="" id="" value="Proses" readonly></td>
								<td>
									<select name="lini_proses" id="lini_proses" class="form-control proses" required>
										<option value="Vacuum cooker">Vacuum cooker</option>
									</select>
								</td>
								<td><input type="text" class="form-control proses" name="io_proses" id="io_proses" required></td>
								<td><input type="text" class="form-control proses" name="allergen_proses" id="allergen_proses" required></td>
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
    <div class="x_title">
      <h4><li class="fa fa-folder-open-o"></li> C. Dokumentasi Terkait Formula  </h4>
    </div>
    <div class="card-block">
			<div class="form-group row">
        <label class="control-label col-md-1 col-sm-1 col-xs-12"></label>
				<div class="col-md-10 col-sm-10 col-xs-12">
					<table class="table table-striped table-bordered nowrap">
						<thead>
							<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
								<th>Nama Dokument</th>
								<th>Nama Lini</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><input type="checkbox"  name="" id="for"> Formula Product (FOR)</td>
								<td>
									<input type="radio" name="for" class="for" value="f1" required> System FormulaOne &nbsp &nbsp &nbsp &nbsp
									<input type="radio" name="for" class="for" value="upload" required> Upload
								</td>
							</tr>
							<tr>
								<td><input type="checkbox"  name="" id="kfp_internal"> Kartu Formula Produk (KFP) Internal</td>
								<td>
									<input type="radio" name="kfp_internal" class="kfp_internal" value="f1" required> System FormulaOne &nbsp &nbsp &nbsp &nbsp
									<input type="radio" name="kfp_internal" class="kfp_internal" value="upload" required> Upload
								</td>
							</tr>
							<tr>
								<td><input type="checkbox"  name="" id="kfp_maklon"> Kartu Formula Produk (KFP) Maklon</td>
								<td>
									<input type="radio" name="kfp_maklon" class="kfp_maklon" value="f1" required> System FormulaOne &nbsp &nbsp &nbsp &nbsp
									<input type="radio" name="kfp_maklon" class="kfp_maklon" value="upload" required> Upload
								</td>
							</tr>
							<tr>
								<td><input type="checkbox"  name="" id="intruksi_proses"> Intruksi Proses</td>
								<td>
									<input type="radio" name="intruksi_proses" class="intruksi_proses" value="f1" required> System FormulaOne &nbsp &nbsp &nbsp &nbsp
									<input type="radio" name="intruksi_proses" class="intruksi_proses" value="upload" required> Upload
								</td>
							</tr>
						</tbody>
					</table>
				</div>
      </div>
    	<div class="form-group row">
      	<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12"> Catatan Task </label>
      	<div class="col-md-7 col-sm-7 col-xs-12">
      	  <input type="text" name="catatan" id="catatan" class="form-control col-md-12 col-xs-12" required>
      	</div>
    	</div>
    </div>
  </div>
</div>

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
<script type="text/javascript">
		// category
    $(function () {
        $("input[name='categori']").click(function () {
            if ($("#wip").is(":checked")) {
                $("#data_category").removeAttr("disabled");
                $("#data_category").focus();
            } else {
                $("#data_category").attr("disabled", "disabled");
            }
        });
    });

		// rasio
		$(function () {
        $("input[name='rasio']").click(function () {
            if ($("#koma").is(":checked")) {
                $("#batch_koma").removeAttr("disabled");
                $("#batch_koma").focus();
                $("#batch_multiple").removeAttr("disabled");
                $("#batch_multiple").focus();
            } else {
                $("#batch_koma").attr("disabled", "disabled");
                $("#batch_multiple").attr("disabled", "disabled");
            }
            if ($("#multiple").is(":checked")) {
                $("#batch_multiple").removeAttr("disabled");
                $("#batch_multiple").focus();
            } else {;
                $("#batch_multiple").attr("disabled", "disabled");
            }
        });
    });

		// lokasi proses persiapan maklon
    $(function() {
			enable_maklon();
			$("#maklon").click(enable_maklon);
		});

		function enable_maklon() {
			if (this.checked) {
				$("input.maklon").removeAttr("disabled");
				$("select.maklon").removeAttr("disabled");
				$("input.proses").removeAttr("disabled");
				$("select.proses").removeAttr("disabled");
			} else {
				$("input.maklon").attr("disabled", true);
				$("select.maklon").attr("disabled", true);
				$("input.proses").attr("disabled", true);
				$("select.proses").attr("disabled", true);
			}
		}

		// lokasi proses persiapan internal
		$(function() {
			enable_internal();
			$("#internal").click(enable_internal);
		});

		function enable_internal() {
			if (this.checked) {
				$("input.internal").removeAttr("disabled");
				$("select.internal").removeAttr("disabled");
				$("input.proses").removeAttr("disabled");
				$("select.proses").removeAttr("disabled");
			} else {
				$("input.internal").attr("disabled", true);
				$("select.internal").attr("disabled", true);
				$("input.proses").attr("disabled", true);
				$("select.proses").attr("disabled", true);
			}
		}

		// For
		$(function() {
			enable_for();
			$("#for").click(enable_for);
			enable_kfp_maklon();
			$("#kfp_maklon").click(enable_kfp_maklon);
			enable_kfp_internal();
			$("#kfp_internal").click(enable_kfp_internal);
			enable_proses();
			$("#intruksi_proses").click(enable_proses);
		});

		function enable_for() {
			if (this.checked) {
				$("input.for").removeAttr("disabled");
			} else {
				$("input.for").attr("disabled", true);
			}
		}

		function enable_kfp_maklon() {
			if (this.checked) {
				$("input.kfp_maklon").removeAttr("disabled");
			} else {
				$("input.kfp_maklon").attr("disabled", true);
			}
		}

		function enable_kfp_internal() {
			if (this.checked) {
				$("input.kfp_internal").removeAttr("disabled");
			} else {
				$("input.kfp_internal").attr("disabled", true);
			}
		}
		
		function enable_proses() {
			if (this.checked) {
				$("input.intruksi_proses").removeAttr("disabled");
			} else {
				$("input.intruksi_proses").attr("disabled", true);
			}
		}
		
</script>
@endsection