@extends('formula.tempformula')
@section('title', 'BahanBaku Baru')
@section('judul', 'BahanBaku Baru')
@section('content')


<form method="POST" action="{{ route('MyRamen.insert',$idf) }}">
  <div class="col-md-6">
    <div class="form-panel" >
      <div class="panel-default">
        <div class="panel-heading panel">
          <h4><i class="fa fa-plus"></i> Tambah Bahan Baku</h4>
        </div>
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-6">
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6">
                <label for="" class="control-label">Kategori</label><br>
                <select id="subkategori" name="subkategori" class="form-control" style="width:290px;">
                  @foreach($subkategoris as $subkategori) 
                  <option value="{{  $subkategori->id }}" {{ old('subkategori') == $subkategori->id ? 'selected' : '' }}>{{ $subkategori->subkategori }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6">
                <label for="" class="control-label">kelompok</label><br>
                <select id="kelompok" name="kelompok" class="form-control" style="width:273px;">
                  @foreach($kelompoks as $kelompok) 
                  <option value="{{  $kelompok->id }}" {{ old('kelompok') == $kelompok->id ? 'selected' : '' }}>{{ $kelompok->nama }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <label for="nama_bahan" class="control-label">Nama Bahan</label>
            <input class="form-control" id="nama_bahan" name="nama_bahan"  type="text" value="{{ old('nama_bahan') }}" required />
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6">
                <label for="supplier" class="control-label">Supplier</label>
                <input class="form-control" id="supplier" name="supplier"  type="text" value="{{ old('supplier') }}" required />
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6">
                <label for="principle" class="control-label">Principle</label>
                <input class="form-control" id="principle" name="principle"  type="text" value="{{ old('principle') }}" required />
              </div>
            </div>
            <div class="row">
              <div class="col-lg-4 col-md-4 col-sm-4">
                <label for="no_HEIPBR" class="control-label">No HEIPBR</label>
                <input class="form-control" id="no_HEIPBR" name="no_HEIPBR"  type="text" value="{{ old('no_HEIPBR') }}" />
              </div>
              <div class="col-lg-4 col-md-4 col-sm-4">
                <label for="PIC" class="control-label">PIC</label>
                <input class="form-control" id="PIC" name="PIC"  type="text" value="{{ old('PIC') }}" />
              </div>
              <div class="col-lg-4 col-md-4 col-sm-4">
                <label for="cek_halal" class="control-label">Alamat principle</label>
                <input class="form-control" id="cek_halal" name="cek_halal"  type="text" value="{{ old('cek_halal') }}" />
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12 col-md-10 col-sm-10">
                <label for="uom" class="control-label">Primary UOM </label>
                <select id="uom" name="uom" class="form-control">
                  @foreach($uom as $uom) 
                  <option value="{{  $uom->id_uom }}">{{ $uom->primary_uom }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6">
                <label for="berat" class="control-label">Berat (KG) </label>
                <input type="number" step="any" class="form-control" id="berat" name="berat" value="{{ old('berat') }}" required />
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6">
                <label for="" class="control-label">Jenis kemas</label>
                <select id="satuan" name="satuan" class="form-control" style="width:273px;">
                  @foreach($satuans as $satuan) 
                  <option value="{{  $satuan->id }}" {{ old('satuan') == $satuan->id ? 'selected' : '' }} >{{ $satuan->satuan }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6">
                <label for="harga_satuan" class="control-label">Harga Satuan/KG</label>
                <input type="number" step="any" class="form-control" id="harga_satuan" name="harga_satuan" value="{{ old('harga_satuan') }}" required />
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6">
                <label for="" class="control-label">Currency</label>
                  <select id="curren" name="curren" class="form-control" style="width:273px;">
                    @foreach($currens as $curren) 
                    <option value="{{  $curren->id }}" {{ old('curren') == $curren->id ? 'selected' : '' }}>{{ $curren->currency }}</option>
                    @endforeach
                  </select>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label for="custom_kelompok" class="control-label"></label>
                  <input type="text"  class="form-control" name="custom_kelompok" id="custom_kelompok" placeholder="Kelompok Baru">
                  <input type="checkbox" name="c_kelompok" id="c_kelompok" class="control-label">
                <label for="c_kelompok">Jadikan Kelompok Bahan ?</label>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6">
                <label for="lama_simpan" class="control-label"></label>
                <input type="number" step="any" class="form-control" placeholder="Lama simpan (Bulan)" id="lama" name="lama" required />
              </div>
            </div><br><br>
          </div>                    
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-panel" >
      <div class="panel-default">
        <div class="panel-heading panel">
          <h4><i class="fa fa-plus"></i> Data ingradient bahan baku baru</h4>
        </div>
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-6">
            <div class="row">
              <div class="col-lg-2 col-md-4 col-sm-4">
                <input class="form-control" id="no_HEIPBR" placeholder="FAT" name="fat"  type="text" value="{{ old('no_HEIPBR') }}" />
              </div>
              <div class="col-lg-2 col-md-4 col-sm-4">
                <input class="form-control" id="PIC" placeholder="SFA" name="sfa"  type="text" value="{{ old('PIC') }}" />
              </div>
              <div class="col-lg-2 col-md-4 col-sm-4">
                <input class="form-control" id="cek_halal" placeholder="karbo" name="karbohidrat"  type="text" value="{{ old('cek_halal') }}" />
              </div>
              <div class="col-lg-2 col-md-4 col-sm-4">
                <input class="form-control" id="cek_halal" name="gula" placeholder="gula"  type="text" value="{{ old('cek_halal') }}" />
              </div>
              <div class="col-lg-2 col-md-4 col-sm-4">
                <input class="form-control" id="cek_halal" name="sukrosa" placeholder="Sukrosa"  type="text" value="{{ old('cek_halal') }}" />
              </div>
              <div class="col-lg-2 col-md-4 col-sm-4">
                <input class="form-control" id="cek_halal" name="serat" placeholder="Serat"  type="text" value="{{ old('cek_halal') }}" />
              </div>
            </div><br>
            <div class="row">
              <div class="col-lg-3 col-md-10 col-sm-10">
                <input class="form-control" id="cek_halal" name="seratL" placeholder="serat larut"  type="text" value="{{ old('cek_halal') }}" />
              </div>
              <div class="col-lg-3 col-md-10 col-sm-10">
                <input class="form-control" id="cek_halal" name="protein" placeholder="protein" type="text" value="{{ old('cek_halal') }}" />
              </div>
              <div class="col-lg-3 col-md-10 col-sm-10">
                <input class="form-control" id="cek_halal" name="kalori" placeholder="kalori" type="text" value="{{ old('cek_halal') }}" />
              </div>
              <div class="col-lg-3 col-md-10 col-sm-10">
                <input class="form-control" id="cek_halal" name="na" placeholder="Na (mg)" type="text" value="{{ old('cek_halal') }}" />
              </div>
            </div><br>
            <div class="row">
              <div class="col-lg-2 col-md-4 col-sm-4">
                <input class="form-control" id="no_HEIPBR" name="k" placeholder="K(mg)"  type="text" value="{{ old('no_HEIPBR') }}" />
              </div>
              <div class="col-lg-2 col-md-4 col-sm-4">
                <input class="form-control" id="PIC" name="ca" placeholder="Ca(mg)" type="text" value="{{ old('PIC') }}" />
              </div>
              <div class="col-lg-2 col-md-4 col-sm-4">
                <input class="form-control" id="cek_halal" name="mg" placeholder="Mg(mg)" type="text" value="{{ old('cek_halal') }}" />
              </div>
              <div class="col-lg-2 col-md-4 col-sm-4">
                <input class="form-control" id="cek_halal" name="p" placeholder="P(mg)" type="text" value="{{ old('cek_halal') }}" />
              </div>
              <div class="col-lg-2 col-md-4 col-sm-4">
                <input class="form-control" id="cek_halal" name="cla" placeholder="CLA(mg)"  type="text" value="{{ old('cek_halal') }}" />
              </div>
              <div class="col-lg-2 col-md-4 col-sm-4">
                <input class="form-control" id="cek_halal" name="cr" placeholder="cr(mcg)" type="text" value="{{ old('cek_halal') }}" />
              </div>
            </div><br>
            <div class="row">
              <div class="col-lg-4 col-md-4 col-sm-4">
                <input class="form-control" id="cek_halal" placeholder="VitC(mg)" name="vitc"  type="text" value="{{ old('cek_halal') }}" />
              </div>
              <div class="col-lg-4 col-md-4 col-sm-4">
                <input class="form-control" id="cek_halal" name="vite" placeholder="VitE(mg)" type="text" value="{{ old('cek_halal') }}" />
              </div>
              <div class="col-lg-4 col-md-4 col-sm-4">
                <input class="form-control" id="cek_halal" name="vitd" placeholder="VitD(iu)" type="text" value="{{ old('cek_halal') }}" />
              </div>
            </div><br>
            <div class="row">
              <div class="col-lg-4 col-md-4 col-sm-4">
                <input class="form-control" id="cek_halal" placeholder="carnitin(mg)" name="carnitin"  type="text" value="{{ old('cek_halal') }}" />
              </div>
              <div class="col-lg-4 col-md-4 col-sm-4">
                <input class="form-control" id="cek_halal" name="beta" placeholder="beta glucan" type="text" value="{{ old('cek_halal') }}" />
              </div>
              <div class="col-lg-4 col-md-4 col-sm-4">
                <input class="form-control" id="cek_halal" name="sterol" placeholder="Sterol ester" type="text" value="{{ old('cek_halal') }}" />
              </div>
            </div>
            <div class="row">
              <div class="col-lg-4 col-md-6 col-sm-6">
                <label for="lama_simpan" class="control-label"></label>
                <input type="number" step="any" class="form-control" placeholder="chondroitin(mg)" id="lama" name="chondroitin" required />
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6">
                <label for="lama_simpan" class="control-label"></label>
                <input type="number" step="any" class="form-control" placeholder="Linoleic acid (omega3)" id="lama" name="linoleic3" required />
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6">
                <label for="lama_simpan" class="control-label"></label>
                <input type="number" step="any" class="form-control" placeholder="omega 3" id="lama" name="omega3" required />
              </div>
            </div><br>
            <div class="row">
              <div class="col-lg-2 col-md-4 col-sm-4">
                <input class="form-control" id="no_HEIPBR" name="dha" placeholder="DHA"  type="text" value="{{ old('no_HEIPBR') }}" />
              </div>
              <div class="col-lg-2 col-md-4 col-sm-4">
                <input class="form-control" id="PIC" name="epa" placeholder="EPA" type="text" value="{{ old('PIC') }}" />
              </div>
              <div class="col-lg-2 col-md-4 col-sm-4">
                <input class="form-control" id="cek_halal" name="creatine" placeholder="Creatine" type="text" value="{{ old('cek_halal') }}" />
              </div>
              <div class="col-lg-2 col-md-4 col-sm-4">
                <input class="form-control" id="cek_halal" name="lysine" placeholder="lysine" type="text" value="{{ old('cek_halal') }}" />
              </div>
              <div class="col-lg-2 col-md-4 col-sm-4">
                <input class="form-control" id="cek_halal" name="kolin" placeholder="kolin"  type="text" value="{{ old('cek_halal') }}" />
              </div>
              <div class="col-lg-2 col-md-4 col-sm-4">
                <input class="form-control" id="cek_halal" name="mufa" placeholder="MUFA" type="text" value="{{ old('cek_halal') }}" />
              </div>
            </div><br>
            <div class="row">
              <div class="col-lg-6 col-md-4 col-sm-4">
                <input class="form-control" id="no_HEIPBR" name="glucasamine" placeholder="glucosamine (mg)"  type="text" value="{{ old('no_HEIPBR') }}" />
              </div>
              <div class="col-lg-6 col-md-4 col-sm-4">
                <input class="form-control" id="PIC" name="linoleic" placeholder="linoleic acid" type="text" value="{{ old('PIC') }}" />
              </div>
            </div><br>
            <div class="row">
              <div class="col-lg-6 col-md-4 col-sm-4">
                <input class="form-control" id="no_HEIPBR" name="sorbitol" placeholder="sorbitol"  type="text" value="{{ old('no_HEIPBR') }}" />
              </div>
              <div class="col-lg-6 col-md-4 col-sm-4">
                <input class="form-control" id="PIC" name="maltitol" placeholder="maltitol" type="text" value="{{ old('PIC') }}" />
              </div>
            </div><br>
          </div>
        </div>
        <div class="col-lg-12 col-md-6 col-sm-6">     
          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4">
            {{ csrf_field() }}
            <input type="hidden" name="user" value="{{ Auth::id() }}">
            <a type="button" class="btn btn-danger" id="xx" href="{{ route('step2',$idf) }}"><i class="fa fa-times"></i> BATAL</a>
            <input type="submit" class="btn btn-primary" value="+ Submit">
          </div>
        </div>
      </div>
    </div>
  </div>
</form>

@endsection

@section('s')
<script type="text/javascript">
$('#subkategori').select2();
$('#kelompok').select2();
$('#satuan').select2();
$('#curren').select2();
</script>
@endsection