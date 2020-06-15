@extends('formula.tempformula')
@section('title', 'Edit Formula')
@section('judul', 'Edit Formula')
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
  <div class="col-md-8">
    <div class="tabbable">
      <ul class="nav nav-tabs wizard">
        <li class="completed"><a href="{{ route('step1',$idf) }}" ><span class="nmbr">1</span>Informasi</a></li>
        <li class="active"><a href="{{ route('step2',$idf) }}"><span class="nmbr">2</span>Penyusunan</a></li>
        <li class="active"><a href="{{ route('summarry',$idf) }}"><span class="nmbr">3</span>Summary</a></li>
        <li class="active"><a href="{{ route('panel',$idf) }}"><span class="nmbr">4</span>Data Panel</a></li>
      </ul>
    </div>
  </div>
</div>

<div class="card">
  <div class="card-header">
    <h5>INFORMASI FORMULA</h5>
  </div>
  <div class="card-block">
		<div class="form-group row">
			<div class="col-md-6">
        <form method="POST" action="{{ route('step1update',$formula->id) }}">
        <label for="" class="control-label">Jenis Formula</label>
        <label for="nama_produk" class="control-label">Nama Produk</label>
        <input class="form-control edit" id="nama_produk" name="nama_produk" minlength="2" type="text" value="{{ old('nama_produk',$formula->nama_produk) }}" readonly />
                    
        <div class="row">
          <div class="col-md-4">
            <label for="revisi" class="control-label">Revisi</label>
            <input class="form-control edit" id="revisi" name="revisi" type="text" value="{{ $formula->revisi }}" readonly/>
          </div>
          <div class="col-md-4">
            <label for="versi" class="control-label">Versi</label>
            <input class="form-control edit" id="versi" name="versi" type="text" value="{{ $formula->versi }}.{{ $formula->turunan }}" Readonly />
          </div>
          <div class="col-md-4">
            <label for="kode_formula" class="control-label">Kode Formula</label>
            <input class="form-control edit" id="kode_formula" name="kode_formula" type="text" value="{{ old('kode_formula',$formula->kode_formula) }}" />  
          </div>
        </div>  

        <div class="row">
          <div class="col-md-6">
            <label for="" class="control-label">Subbrand</label>
            <select class="form-control edit" id="subbrand" name="subbrand" disabled>
							@foreach($subbrands as $subbrand)
							<option value="{{  $subbrand->id }}"{{ ( $subbrand->id == $formula->subbrand_id ) ? ' selected' : '' }} >{{ $subbrand->subbrand }}</option>
							@endforeach
            </select>
          </div>
          <div class="col-md-6">
            <label for="" class="control-label">Gudang</label>
            <select class="form-control edit" id="gudang" name="gudang" disabled>
							@foreach($gudangs as $gudang)
							<option value="">Pilih Gudang</option>
							<option value="{{  $gudang->id }}"{{ ( $gudang->id == $formula->gudang_id ) ? ' selected' : '' }} >{{ $gudang->gudang }}</option>
							@endforeach
            </select>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <label for="" class="control-label">Tarkon</label>
            <input class="form-control edit" id="tarkon" name="tarkon" type="text" value="{{ $formula->workbook->tarkon }}" readonly />  
          </div>
          <div class="col-md-6" id="dm">
            <label for="" class="control-label">No PKP</label>
            <input class="form-control edit" id="pkp" name="pkp" type="text" value="{{ $formula->workbook->NO_PKP }}" readonly />  
          </div>
        </div>
			</div>
                    
      <!-- Nyebrang -->
			<div class="col-md-6">
        <!-- <div class="row">
          <div class="col-md-6">
            <label for="revisi" class="control-label">Main Item</label>
            <input class="form-control edit" id="main_item" name="main_item" type="text" value="{{ old('main_item',$formula->main_item) }}" />
          </div>
          <div class="col-md-6">
            <label for="revisi" class="control-label">Main Item Eks</label>
            <input class="form-control edit" id="main_item_eks" name="main_item_eks" type="text" value="{{ old('main_item_eks',$formula->main_item_eks) }}" />            
          </div>
        </div> -->
                                            
        <div class="row">
          <div class="col-md-6">
            <label for="bj" class="control-label">Berat Jenis</label>
            <input class="form-control edit" id="bj" name="bj" type="number" step=any value="{{ old('bj',$formula->bj) }}"  disabled/>
          </div>
          <div class="col-md-6">
            <label for="batch" class="control-label">Batch</label>
            <input class="form-control edit" id="batch" name="batch" type="number" step=any value="{{ old('batch',$formula->batch) }}"  disabled/>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <label for="serving" class="control-label">Target Serving</label>
            <input class="form-control edit" id="serving" name="serving" type="number" step=any value="{{ $formula->workbook->target_serving }}"  disabled/>
          </div>
          <div class="col-md-6">
            <label for="liter" class="control-label">Liter</label>
            <input class="form-control edit" id="liter" name="liter" type="number" step=any value="{{ old('liter',$formula->liter) }}" disabled/>
          </div>
        </div>
                        
        <label for="nama_produk" class="control-label">Keterangan</label><br>
        <textarea class="form-control edit" style="min-width: 100%" name="keterangan" id="keterangan">{{ old('keterangan',$formula->keterangan) }}</textarea><br><br>
        <button type="submit" class="btn status btn-primary">Simpan dan Lanjutkan</button>
        <a class="btn btn-danger" href="{{ route('showworkbook',$formula->workbook_id) }}"><i class="fa fa-share"></i>Kembali</a>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        {{ method_field('PATCH') }}
        @include('formerrors')
        </form>
			</div>
		</div>
	</div>
</div>
@endsection

@section('s')
<script type="text/javascript">
	// $(document).ready(function(){
	//     var produksi = document.getElementById("produksi");
	//     if(produksi.value == "1") {
	//         document.getElementById("dm").style.visibility = "visible";
	//         $('#maklon').removeAttr('disabled');        
	//     } else {
	//        document.getElementById("dm").style.visibility = "hidden";
	//        document.getElementById("maklon").value = "0";
	//     }
	//   });
	// function profunc() {
	//     var produksi = document.getElementById("produksi");
	//     if(produksi.value == "1") {
	//         document.getElementById("dm").style.visibility = "visible";
	//         $('#maklon').removeAttr('disabled');        
	//     } else {
	//        document.getElementById("dm").style.visibility = "hidden";
	//        document.getElementById("maklon").value = "0";
	//     }
	// }
</script>
@endsection