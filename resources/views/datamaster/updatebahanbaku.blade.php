@extends('pv.tempvv')
@section('title', 'Edit Bahan Baku')
@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="form-panel" >
      <form method="POST" action="{{ route('storeupdatebahan',$bahan->id) }}">
      <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6">
          <label for="nama_sederhana" class="control-label">Nama Sederhana</label>
          <input class="form-control" id="nama_sederhana" name="nama_sederhana"  type="text" value="{{ $bahan->nama_sederhana }}" required />
          <label for="nama_bahan" class="control-label">Nama Bahan</label>
          <input class="form-control" id="nama_bahan" name="nama_bahan"  type="text" value="{{ $bahan->nama_bahan }}" required />
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
              <label for="kode_oracle" class="control-label">Kode_Oracle</label>
              <input class="form-control" id="kode_oracle" name="kode_oracle"  type="text" value="{{ $bahan->kode_oracle }}" required />
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
              <label for="kode_komputer" class="control-label">Kode_Komputer</label>
              <input class="form-control" id="kode_komputer" name="kode_komputer"  type="text" value="{{ $bahan->kode_komputer }}" required />
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
              <label for="supplier" class="control-label">Supplier</label>
              <input class="form-control" id="supplier" name="supplier"  type="text" value="{{ $bahan->supplier }}" required />
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
              <label for="principle" class="control-label">Principle</label>
              <input class="form-control" id="principle" name="principle"  type="text" value="{{ $bahan->principle }}" required />
            </div>
          </div>
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4">
              <label for="no_HEIPBR" class="control-label">No HEIPBR</label>
              <input class="form-control" id="no_HEIPBR" name="no_HEIPBR"  type="text" value="{{ $bahan->no_HEIPBR }}" required />
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
              <label for="PIC" class="control-label">PIC</label>
              <input class="form-control" id="PIC" name="PIC"  type="text" value="{{ $bahan->PIC }}" required />
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
              <label for="cek_halal" class="control-label">Cek Halal</label>
              <input class="form-control" id="cek_halal" name="cek_halal"  type="text" value="{{ $bahan->cek_halal }}" required />
            </div>
          </div>     
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
        	<div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
              <label for="" class="control-label">Kategori</label><br>
              <select id="subkategori" name="subkategori" class="form-control" style="width:200px;">
              	@foreach($subkategoris as $subkategori) 
              	<option value="{{  $subkategori->id }}" {{ $bahan->subkategori_id == $subkategori->id ? 'selected' : '' }}>{{ $subkategori->subkategori }}</option>
              	@endforeach
              </select>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
              <label for="" class="control-label">kelompok</label><br>
              <select id="kelompok" name="kelompok" class="form-control" style="width:200px;">
              	@foreach($kelompoks as $kelompok) 
              	<option value="{{  $kelompok->id }}" {{ $bahan->kelompok_id == $kelompok->id ? 'selected' : '' }}>{{ $kelompok->nama }}</option>
              	@endforeach
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
              <label for="berat" class="control-label">Berat</label>
            	<input type="number" step="any" class="form-control" id="berat" name="berat" value="{{ $bahan->berat }}" required />
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
              <label for="" class="control-label">Satuan</label><br>
            	<select id="satuan" name="satuan" class="form-control" style="width:200px;">
                @foreach($satuans as $satuan) 
                <option value="{{  $satuan->id }}" {{ $bahan->satuan_id == $satuan->id ? 'selected' : '' }} >{{ $satuan->satuan }}</option>
                @endforeach
            	</select>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
              <label for="harga_satuan" class="control-label">Harga Satuan</label>
              <input type="number" step="any" class="form-control" id="harga_satuan" name="harga_satuan" value="{{ $bahan->harga_satuan }}" required />
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
              <label for="" class="control-label">Currency</label><br>
              <select id="curren" name="curren" class="form-control" style="width:200px;">
                @foreach($currens as $curren) 
                <option value="{{  $curren->id }}" {{ $bahan->curren_id == $curren->id ? 'selected' : '' }}>{{ $curren->currency }}</option>
                @endforeach
              </select>
            </div>
          </div><br><br>
          {{ csrf_field() }}
          {{ method_field('PATCH') }}
          <input type="hidden" name="user" value="{{ Auth::id() }}">
          <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Simpan Perubahan</button>
          <a type="button" class="btn btn-danger btn-sm" id="xx" href="{{ route('bahanbaku') }}"><i class="fa fa-times"></i> BATAL</a>
          </form>
        </div>
      </div>
    </div>
	</div>
</div>

@endsection

@section('s')
<script type="text/javascript">
	$('#subkategori').select2();
	$('#kelompok').select2();
	$('#satuan').select2();
	$('#curren').select2();
</script>
@endsection

