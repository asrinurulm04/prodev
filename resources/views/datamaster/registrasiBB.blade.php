@extends('layout.tempvv')
@section('title', 'PRODEV|Registrasi Bahan Baku')
@section('content')

<!-- Bahan -->
<form class="form-horizontal form-label-left" method="POST" action="{{route('addbahanrd')}}">
<div class="row">
  <div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
      <div class="x_title">
				<h2><li class="fa fa-table"></li> Registrasi Bahan Baku</h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link" hidden><i class="fa fa-chevron-up"></i></a></li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="row">
          <?php $last = Date('j-F-Y'); ?>
          <input id="last" value="{{ $last }}" class="form-control col-md-12 col-xs-12" name="last" type="hidden" readonly>
          <div class="form-group">
            <label  class="control-label col-md-2 col-sm-2 col-xs-12">Nama Sederhana*</label>
            <div class="col-md-2 col-sm-2 col-xs-12">
              <input type="text" class="form-control" required name="sederhana" id="sederhana">
            </div>
            <label  class="control-label col-md-1 col-sm-1 col-xs-12">Nama Bahan*</label>
            <div class="col-md-2 col-sm-2 col-xs-12">
              <input type="text" required class="form-control" name="nama" id="nama">
            </div>
            <label  class="control-label col-md-1 col-sm-1 col-xs-12">Status</label>
            <div class="col-md-2 col-sm-2 col-xs-12">
              <select name="status" class="form-control" id="status">
                <option value="Baru">Baru</option>
                <option value="Eksis">Eksis</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label  class="control-label col-md-2 col-sm-2 col-xs-12">Kode Komputer</label>
            <div class="col-md-2 col-sm-3 col-xs-12">
              <input type="text" class="form-control" name="komputer" id="komputer">
            </div>
            <label  class="control-label col-md-1 col-sm-1 col-xs-12">Shelf life </label>
            <div class="col-md-2 col-sm-3 col-xs-12">
              <input type="text" class="form-control" name="shelf_life" id="shelf_life">
            </div>
            <label  class="control-label col-md-1 col-sm-1 col-xs-12">Kode Oracle</label>
            <div class="col-md-2 col-sm-3 col-xs-12">
              <input type="text" class="form-control" name="oracle" id="oracle">
            </div>
          </div>
          <div class="form-group">
            <label  class="control-label col-md-2 col-sm-2 col-xs-12">PIC</label>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <input type="text" class="form-control" name="pic" id="pic">
            </div>
            <label  class="control-label col-md-2 col-sm-2 col-xs-12">No HEIPBR</label>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <input type="text" class="form-control" name="heipbr" id="heipbr">
            </div>
          </div>
          <div class="form-group">
            <label  class="control-label col-md-2 col-sm-2 col-xs-12">Harga</label>
            <div class="col-md-2 col-sm-2 col-xs-12">
              <input type="number" min="1" value="1" step="0.0001" class="form-control" name="harga" id="harga">
            </div>
            <div class="col-md-1 col-sm-1 col-xs-12">
              <select name="currency" id="currency" class="form-control select">
                @foreach($curren as $curren)
                <option value="{{$curren->id}}">{{$curren->currency}}</option>
                @endforeach
              </select>
            </div>
            <label  class="control-label col-md-2 col-sm-2 col-xs-12">Berat</label>
            <div class="col-md-2 col-sm-2 col-xs-12">
              <input type="number" step="0.0001" value="1" class="form-control" name="berat" id="berat">
            </div>
            <div class="col-md-1 col-sm-1 col-xs-12">
              <select name="satuan" id="satuan" class="form-control select">
                <option value="Kg">Kg</option>
                <option value="G">G</option>
                <option value="Mg">Mg</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label  class="control-label col-md-2 col-sm-2 col-xs-12">Ketegori</label>
            <div class="col-md-4 col-sm-4 col-xs-12">
              <select name="kategori" id="kategori" class="form-control select">
                <option disabled selected>-->Select One<--</option>
                @foreach($kategori as $kategori)
                <option value="{{$kategori->id}}">{{$kategori->kategori}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
              <select name="subkategori" id="subkategori" class="form-control select"></select>
            </div>
          </div>
          <div class="form-group">
            <label  class="control-label col-md-2 col-sm-2 col-xs-12">Supplier</label>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <select name="supplier" id="supplier" class="form-control select">
                @foreach($supplier as $sp)
                <option value="{{$sp->nama_supplier_principal}}">{{$sp->nama_supplier_principal}}</option>
                @endforeach
              </select>
            </div>
            <label  class="control-label col-md-2 col-sm-2 col-xs-12">Principle</label>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <select class="form-control select" name="principle" id="principle">
                @foreach($principal as $pc)
                <option value="{{$pc->nama_cp}}">{{$pc->nama_cp}}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>    

<div class="x_panel">
  <div class="x_title">
    <h3><li class="fa fa-flask"></li> Registrasi Nutrition <small for="" style="color:red">* Gunakan (.) sebagai pengganti (,)</small></h3>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
  <!-- Makro -->
    <h4><li class="fa fa-tags"></li> Makro (g/ 100 g)</h4>
    <div class="form-group">
      <label  style="font-size:14px" class="control-label col-md-1 col-sm-1 col-xs-12">Karbohidrat</label>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Karbohidrat</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="karbohidrat" id="karbohidrat">
      </div>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Glukosa</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="glukosa" id="glukosa">
      </div>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Serat Pangan</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="serat_pangan" id="serat_pangan">
      </div>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Beta glucan</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="beta_glucan" id="beta_glucan">
      </div>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Sorbitol</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="sorbitol" id="sorbitol">
      </div>
    </div>
    <div class="form-group">
      <label  class="control-label col-md-1 col-sm-1 col-xs-12"></label>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Martitol</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="maltitol" id="maltitol">
      </div>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Laktosa</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="laktosa" id="laktosa">
      </div>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Sukrosa</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="sukrosa" id="sukrosa">
      </div>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Gula</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="gula" id="gula">
      </div>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Erythritol </label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="erythritol" id="erythritol">
      </div>
    </div><br>
    <div class="form-group">
      <label  style="font-size:14px" class="control-label col-md-1 col-sm-1 col-xs-12">Lemak</label>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Lemak</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="lemak" id="lemak">
      </div>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">DHA</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="dha" id="dha">
      </div>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">EPA</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="epa" id="epa">
      </div>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Omega3</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="omega3" id="omega3">
      </div>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">MUFA</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="mufa" id="mufa">
      </div>
    </div>
    <div class="form-group">
      <label  class="control-label col-md-1 col-sm-1 col-xs-12"></label>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Lemak Trans</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="lemak_trans" id="lemak_trans">
      </div>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Lemak Jenuh</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="lemak_jenuh" id="lemak_jenuh">
      </div>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Omega6</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="omega6" id="omega6">
      </div>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Kolesterol</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="kolesterol" id="kolesterol">
      </div>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Linoleat</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="linoleat" id="linoleat">
      </div>
    </div>
    <div class="form-group">
      <label  class="control-label col-md-1 col-sm-1 col-xs-12"></label>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Omega9</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="omega9" id="omega9">
      </div>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">FAT</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="fat" id="fat">
      </div>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">GI</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="gi" id="gi">
      </div>
    </div><br>
    <div class="form-group">
      <label  style="font-size:14px" class="control-label col-md-1 col-sm-1 col-xs-12">Protein</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="protein" id="protein">
      </div>
    </div><hr>
    <!-- Mikro -->
    <h4><li class="fa fa-tags"></li> Mirkro</h4>
    <div class="form-group">
      <label  style="font-size:14px" class="control-label col-md-1 col-sm-1 col-xs-12">Vitamin</label>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Vitamin A</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="vitA" id="vitA">
      </div>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <select name="id_satuan_vitA" id="id_satuan_vitA" class="form-control">
          <option value="1">IU</option>
        </select>
      </div>

      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Vitamin B1</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="vitB1" id="vitB1">
      </div>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <select name="id_satuan_vitB1" id="id_satuan_vitB1" class="form-control">
          <option value="3">Mg</option>
        </select>
      </div>

      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Vitamin B2</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="vitB2" id="vitB2">
      </div>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <select name="id_satuan_vitB2" id="id_satuan_vitB2" class="form-control">
          <option value="3">Mg</option>
        </select>
      </div>
    </div>
    
    <div class="form-group">
      <label  class="control-label col-md-1 col-sm-1 col-xs-12"></label>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Vitamin B3</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="vitB3" id="vitB3">
      </div>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <select name="id_satuan_vitB3" id="id_satuan_vitB3" class="form-control">
          <option value="3">Mg</option>
        </select>
      </div>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Vitamin B5 </label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="vitB5" id="vitB5">
      </div>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <select name="id_satuan_vitB5" id="id_satuan_vitB5" class="form-control">
          <option value="3">Mg</option>
        </select>
      </div>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Vitamin B6</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="vitB6" id="vitB6">
      </div>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <select name="id_satuan_vitB6" id="id_satuan_vitB6" class="form-control">
          <option value="3">Mg</option>
        </select>
      </div>
    </div>
    
    <div class="form-group">
      <label  class="control-label col-md-1 col-sm-1 col-xs-12"></label>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Vitamin B12</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="vitB12" id="vitB12">
      </div>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <select name="id_satuan_vitB12" id="id_satuan_vitB12" class="form-control">
          <option value="2">Mcg</option>
        </select>
      </div>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Vitamin C</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="vitC" id="vitC">
      </div>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <select name="id_satuan_vitC" id="id_satuan_vitC" class="form-control">
          <option value="3">Mg</option>
        </select>
      </div>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Vitamin D</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="vitD" id="vitD">
      </div>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <select name="id_satuan_vitD" id="id_satuan_vitD" class="form-control">
          <option value="1">IU</option>
        </select>
      </div>
    </div>
    
    <div class="form-group">
      <label  class="control-label col-md-1 col-sm-1 col-xs-12"></label>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Vitamin E </label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="vitE" id="vitE">
      </div>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <select name="id_satuan_vitE" id="id_satuan_vitE" class="form-control">
          <option value="3">Mg</option>
        </select>
      </div>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Vitamin K</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="vitK" id="vitK">
      </div>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <select name="id_satuan_vitK" id="id_satuan_vitK" class="form-control">
          @foreach($satuan_vit as $vit)
          <option value="{{$vit->id_satuan_vit}}">{{$vit->satuan}}</option>
          @endforeach
        </select>
      </div>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Folat</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="folat" id="folat">
      </div>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <select name="id_satuan_folat" id="id_satuan_folat" class="form-control">
          <option value="2">Mcg</option>
        </select>
      </div>
    </div>
    
    <div class="form-group">
      <label  class="control-label col-md-1 col-sm-1 col-xs-12"></label>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Biotin</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="biotin" id="biotin">
      </div>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <select name="id_satuan_biotin" id="id_satuan_biotin" class="form-control">
          <option value="2">Mcg</option>
        </select>
      </div>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Kolin</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="kolin" id="kolin">
      </div>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <select name="id_satuan_kolin" id="id_satuan_kolin" class="form-control">
          <option value="3">Mg</option>
        </select>
      </div>
    </div><br>

    <!-- Mineral -->
    <div class="form-group">
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Mineral</label>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Ca</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="ca" id="ca">
      </div>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <select name="satuan_ca" id="satuan_ca" class="form-control">
          <option value="Mg">Mg</option>
        </select>
      </div>  
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Mg</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="mg" id="mg">
      </div>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <select name="satuan_mg" id="satuan_mg" class="form-control">
          <option value="Mg">Mg</option>
        </select>
      </div>  
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">K</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="k" id="k">
      </div>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <select name="satuan_k" id="satuan_k" class="form-control">
          <option value="Mg">Mg</option>
        </select>
      </div>  
    </div>
    <div class="form-group">
      <label  class="control-label col-md-1 col-sm-1 col-xs-12"></label>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Zink</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="zink" id="zink">
      </div>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <select name="satuan_zink" id="satuan_zink" class="form-control">
          <option value="Mg">Mg</option>
        </select>
      </div>  
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Cu</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="cu" id="cu">
      </div>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <select name="satuan_cu" id="satuan_cu" class="form-control">
          <option value="Mg">Mg</option>
        </select>
      </div>  
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Na</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="na" id="na">
      </div>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <select name="satuan_na" id="satuan_na" class="form-control">
          <option value="Mg">Mg</option>
        </select>
      </div>  
    </div>
    <div class="form-group">
      <label  class="control-label col-md-1 col-sm-1 col-xs-12"></label>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">NaCi</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="naci" id="naci">
      </div>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <select name="satuan_naci" id="satuan_naci" class="form-control">
          <option value="Mg">Mg</option>
        </select>
      </div>  
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Energi</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="energi" id="energi">
      </div>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <select name="satuan_energi" id="satuan_energi" class="form-control">
          <option value="Mg">Mg</option>
        </select>
      </div>  
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Fosfor</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="fosfor" id="fosfor">
      </div>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <select name="satuan_fosfor" id="satuan_fosfor" class="form-control">
          <option value="Mg">Mg</option>
        </select>
      </div>  
    </div>
    <div class="form-group">
      <label  class="control-label col-md-1 col-sm-1 col-xs-12"></label>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Mn</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="mn" id="mn">
      </div>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <select name="satuan_mn" id="satuan_mn" class="form-control">
          <option value="Mg">Mg</option>
        </select>
      </div>  
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Cr</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="cr" id="cr">
      </div>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <select name="satuan_cr" id="satuan_cr" class="form-control">
          <option value="Mcg">Mcg</option>
        </select>
      </div>  
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Fe</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="fe" id="fe">
      </div>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <select name="satuan_fe" id="satuan_fe" class="form-control">
          <option value="Mg">Mg</option>
        </select>
      </div>  
    </div>
    <div class="form-group">
      <label  class="control-label col-md-1 col-sm-1 col-xs-12"></label>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Yodium</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="yodium" id="yodium">
      </div>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <select name="satuan_yodium" id="satuan_yodium" class="form-control">
          <option value="Mcg">Mcg</option>
        </select>
      </div>  
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Selenium</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="selenium" id="selenium">
      </div>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <select name="satuan_selenium" id="satuan_selenium" class="form-control">
          <option value="Mcg">Mcg</option>
        </select>
      </div>  
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Fluor</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="fluor" id="fluor">
      </div>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <select name="satuan_fluor" id="satuan_fluor" class="form-control">
          <option value="Mg">Mg</option>
        </select>
      </div>  
    </div>
    <!-- Zat Aktif -->
    <table class="table table-bordered" id="tablezat">
      <thead>
        <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
          <th class="text-center" width="65%">Zat Aktif(mg/100g)</th>
          <th class="text-center">Jumlah</th>
          <th class="text-center">Satuan</th>
          <th class="text-center" width="8%">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="text-center">
            <select name="zat_aktif[]" id="zat_aktif" class="form-control select">
              <option disabled selected>-->Select One<--</option>
              @foreach($zat as $zat)
              <option value="{{$zat->zat_aktif}}">{{$zat->zat_aktif}}</option>
              @endforeach
            </select>
          </td>
          <td><input type="number" step="0.0001" value="0" min="0" class="form-control" name="zat[]" id="zat"></td>
          <td class="text-center">
            <select name="satuan_zat[]" id="satuan_zat" class="form-control select">
              <option disabled selected>-->Select One<--</option>
              @foreach($satuan_vit as $vit)
              <option value="{{$vit->id_satuan_vit}}">{{$vit->satuan}}</option>
              @endforeach
            </select>
          </td>
          <td class="text-center"><button class="btn btn-info btn-sm" id='add_zat' type="button"><li class="fa fa-plus"></li></button></td>
        </tr>
        <tr id='addzat1'></tr>
      </tbody>
    </table><hr>
    <!-- BTP Carry Over -->
    <table class="table table-bordered" id="tablebtp">
      <thead>
        <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
          <th class="text-center" width="65%">BTP Carry Over</th>
          <th class="text-center">Jumlah</th>
          <th class="text-center">Satuan</th>
          <th class="text-center" width="8%">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="text-center">
            <select name="btp_carry_over[]" id="btp_carry_over" class="form-control select">
              <option disabled selected>-->Select One<--</option>
              @foreach($btp2 as $btp)
              <option value="{{$btp->btp}}">{{$btp->btp}}</option>
              @endforeach
            </select>
          </td>
          <td><input type="number" step="0.0001" value="0" min="0" class="form-control" name="btp[]" id="btp"></td>
          <td class="text-center">
            <select name="satuan_btp[]" id="satuan_btp" class="form-control select">
              <option disabled selected>-->Select One<--</option>
              @foreach($satuan_vit as $vit)
              <option value="{{$vit->id_satuan_vit}}">{{$vit->satuan}}</option>
              @endforeach
            </select>
          </td>
          <td class="text-center"><button class="btn btn-info btn-sm" id='add_btp' type="button"><li class="fa fa-plus"></li></button></td>
        </tr>
        <tr id='addbtp1'></tr>
      </tbody>
    </table><hr>
    <!-- Asam Amino -->
    <h4><li class="fa fa-tags"></li> Asam Amino (mg/ 100 gram)</h4>
    <div class="form-group">
      <label  class="control-label col-md-2 col-sm-2 col-xs-12">L-Glutamin</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="l_glutamin" id="l_glutamin">
      </div>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Threonin</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="threonin" id="threonin">
      </div>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Methionin</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="methionin" id="methionin">
      </div>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Phenilalanin</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="phenilalanin" id="phenilalanin">
      </div>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Histidin</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="histidin" id="histidin">
      </div>
    </div>
    <div class="form-group">
      <label  class="control-label col-md-2 col-sm-2 col-xs-12">Lisin</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="lisin" id="lisin">
      </div>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">BCAA</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="bcaa" id="bcaa">
      </div>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Valin</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="valin" id="valin">
      </div>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Isoleusin </label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="Isoleusin" id="Isoleusin">
      </div>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Leusin</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="leusin" id="leusin">
      </div>
    </div>
    <div class="form-group">
      <label  class="control-label col-md-2 col-sm-2 col-xs-12">Alanin</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="alanin" id="alanin">
      </div>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Aspartat</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="aspartat" id="aspartat">
      </div>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Glutamat</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="glutamat" id="glutamat">
      </div>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Sistein</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="sistein" id="sistein">
      </div>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Serin</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="serin" id="serin">
      </div>
    </div>
    <div class="form-group">
      <label  class="control-label col-md-2 col-sm-2 col-xs-12">Glisin</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="glisin" id="glisin">
      </div>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Tyrosin</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="tyrosin" id="tyrosin">
      </div>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Arginine</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="arginine" id="arginine">
      </div>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Proline </label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="proline" id="proline">
      </div>
    </div><hr>
    <!-- Logam Berat -->
    <div class="form-group">
      <label  style="font-size:13px" class="control-label col-md-1 col-sm-1 col-xs-12">Logam Berat (ppm)</label>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">As</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="as" id="as">
      </div>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Pb</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="pb" id="pb">
      </div>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Hg</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="hg" id="hg">
      </div>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Cd</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="cd" id="cd">
      </div>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Sn</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="sn" id="sn">
      </div>
    </div><hr>
    <!-- Mikro -->
    <div class="form-group">
      <label  style="font-size:13px" class="control-label col-md-1 col-sm-1 col-xs-12">Mikro(CFU/g)</label>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Enterobacter</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="Enterobacter" id="Enterobacter">
      </div>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Salmonella</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="Salmonella" id="Salmonella">
      </div>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">S.aureus</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="aureus" id="aureus">
      </div>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">TPC</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="TPC" id="TPC">
      </div>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Yeast/Mold</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="Yeast" id="Yeast">
      </div>
    </div>
    <div class="form-group">
      <label  style="font-size:13px" class="control-label col-md-1 col-sm-1 col-xs-12"></label>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Coliform</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="Coliform" id="Coliform">
      </div>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">E.Coli</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="Coli" id="Coli">
      </div>
      <label  class="control-label col-md-1 col-sm-1 col-xs-12">Bacilluscereus</label>
      <div class="col-md-1 col-sm-1 col-xs-12">
        <input type="number" step="0.0001" value="0" min="0" class="form-control" name="Bacilluscereus" id="Bacilluscereus">
      </div>
    </div>
  </div>
</div>

<div class="x_panel">
  <div class="x_title">
		<h2><li class="fa fa-table"></li> Registrasi</h2>
    <ul class="nav navbar-right panel_toolbox">
      <li><a class="collapse-link" hidden><i class="fa fa-chevron-up"></i></a></li>
    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
    <div class="form-group">
      <label  class="control-label col-md-2 col-sm-2 col-xs-12">Allergen (Contain)</label>
      <div class="col-md-9 col-sm-9 col-xs-12">
        <select name="contain[]" id="contain" multiple="multiple" class="form-control select">
          @foreach($allergen as $Contain)
          <option value="{{$Contain->allergen}}">{{$Contain->allergen}}</option>
          @endforeach
        </select>
      </div>
    </div>
		<div class="form-group">
      <label  class="control-label col-md-2 col-sm-2 col-xs-12">Allergen (May Contain)</label>
      <div class="col-md-9 col-sm-9 col-xs-12">
        <select name="may_contain[]" id="may_contain" multiple="multiple" class="form-control select">
          @foreach($allergen as $MayContain)
          <option value="{{$MayContain->allergen}}">{{$MayContain->allergen}}</option>
          @endforeach
        </select>
      </div>
    </div>
		<div class="form-group">
      <label  class="control-label col-md-2 col-sm-2 col-xs-12">Kadar Air</label>
      <div class="col-md-3 col-sm-3 col-xs-12">
        <input type="number" step="0.0001" class="form-control" name="kadar_air" id="kadar_air">
      </div>
    </div>
		<div class="form-group">
      <label  class="control-label col-md-2 col-sm-2 col-xs-12">Mikro Biologi</label>
      <div class="col-md-3 col-sm-3 col-xs-12">
        <input type="radio" name="micro_biologi" oninput="bpom()" id="radio_bpom"> BPOM
        <input type="radio" name="micro_biologi" oninput="custom()" id="radio_custom"> Custom
      </div>
      <div id="tampilkan"></div>
    </div>
  </div>
</div>
<div class="x_panel">
  <div class="card-block col-md-6 col-sm-offset-5 col-md-offset-5">
    <button type="reset" class="btn btn-warning btn-sm"><li class="fa fa-repeat"></li> Reset</button>
    <button type="submit" class="btn btn-primary btn-sm"><li class="fa fa-check"></li> Submit</button>
    {{ csrf_field() }}
  </div>
</div>
</form>
@endsection
@section('s')
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
<script src="{{ asset('js/select2/select2.min.js') }}"></script>
<script>
  $('.select').select2({
    placeholder: '-->Select One<--',
    allowClear: true
  });

  var pangan = []
  <?php foreach($pangan as $key => $value) { ?>
  if(!pangan){
    pangan += [ { '<?php echo $key; ?>' : '<?php echo $value->no_kategori; ?>', } ];
  } else { pangan.push({ '<?php echo $key; ?>' : '<?php echo $value->no_kategori; ?>', }) }
  <?php } ?>

  var id_pangan = []
  <?php foreach($pangan as $key => $value) { ?>
  if(!id_pangan){
    id_pangan += [ { '<?php echo $key; ?>' : '<?php echo $value->id_pangan; ?>', } ];
  } else { id_pangan.push({ '<?php echo $key; ?>' : '<?php echo $value->id_pangan; ?>', }) }
  <?php } ?>

  var pilihan = '';
  for(var i = 0; i < Object.keys(pangan).length; i++){
    pilihan += '<option value="'+id_pangan[i][i]+'">'+pangan[i][i]+'</option>';
  }

  function bpom(){
    var baru = document.getElementById('radio_bpom')
    if(baru.checked != true){
      document.getElementById('tampilkan').innerHTML = "";
    }else{
      document.getElementById('tampilkan').innerHTML =
      "<hr><div class='form-group row'>"+
        "<label class='control-label col-md-2 col-sm-2 col-xs-12'>BPOM</label>"+
        "<div class='col-md-4 col-sm-4 col-xs-12'>"+
          "<select class='form-control form-control-line' name='bpom' id='bpom'>"+
          "<option disabled selected>-->Select One<--</option>"+pilihan+"</select>"+
        "</div>"+
        "<div class='col-md-4 col-sm-4 col-xs-12'>"+
          "<select class='form-control form-control-line' name='katbpom' id='katbpom'></select>"+
        "</div>"+
      "</div>"+
        "<table class='table table-bordered'>"+
          "<thead>"+
            "<tr style='font-weight: bold;color:white;background-color: #2a3f54;'>"+
              "<th>Jenis Mikro</th>"+
              "<th>n</th>"+
              "<th>c</th>"+
              "<th>m</th>"+
              "<th>M</th>"+
              "<th>Metode Analisa</th>"+
            "</tr>"+
          "</thead>"+
          "<tbody id='jenismikro1' name='jenismikro1'>"+
            "<tr>"+
            "</tr>"+
          "</tbody>"+
        "</table>"+
      "<div class='ln_solid'></div>"

      $(document).ready(function(){
        // Get BPOM
        $('#bpom').on('change', function(){
          var myId = $(this).val();
          if(myId){
            $.ajax({
              url: '{{URL::to('getpangan')}}/'+myId,
              type: "GET",
              dataType: "json",
              beforeSend: function(){
                $('#loader').css("visibility", "visible");
              },
              success:function(data){
                $('#katbpom').empty();
                $.each(data, function(key, value){
                  $('#katbpom').append('<option value="'+ key +'">' + value + '</option>');
                });
              },
              complete: function(){
                $('#loader').css("visibility","hidden");
              }
            });
          }else{
            $('#katbpom').empty();
          }
        });
      });

      $('#katbpom').on('change', function(){
        var myId = $(this).val();
        if(myId){
          $.ajax({
            url: '{{URL::to('getkatpangan')}}/'+myId,
            type: "GET",
            dataType: "json",
            beforeSend: function(){
              $('#loader').css("visibility", "visible");
            },
            success:function(data){
              $('#bpom').empty();
              $.each(data, function(key, value){
                $('#bpom').append('<option value="'+ key +'">' + value + '</option>');
              });
            },
            complete: function(){
              $('#loader').css("visibility","hidden");
            }
          });
        }else{
          $('#bpom').empty();
        }
      });

      $(document).ready(function(){
        // Get BPOM
        $('#bpom').on('change', function(){
          var myId = $(this).val();
          if(myId){
            $.ajax({
              url: '{{URL::to('jenismikroba')}}/'+myId,
              type: "GET",
              dataType: "json",
              beforeSend: function(){
                $('#loader').css("visibility", "visible");
              },
              success:function(data){
                $('#jenismikro1').empty();
                $.each(data, function(index, element){
                  $('#jenismikro1').append("<tr><td>"+element.jenis_mikroba+"</td><td>"+element.n+"</td><td>"+element.c+"</td><td>"+element.mk+"</td><td>"+element.Mb+"</td><td>"+element.metode_analisa+"</td></tr>");
                });
              },
              complete: function(){
                $('#loader').css("visibility","hidden");
              }
            });
          }else{
            $('#jenismikro1').empty();
          }
        });
      });
    }
  }

  var id_jenis = []
  <?php foreach($jenis as $key => $value) { ?>
  if(!id_jenis){
    id_jenis += [ { '<?php echo $key; ?>' : '<?php echo $value->id; ?>', } ];
  } else { id_jenis.push({ '<?php echo $key; ?>' : '<?php echo $value->id; ?>', }) }
  <?php } ?>

  var mikro = []
  <?php foreach($jenis as $key => $value) { ?>
  if(!mikro){
    mikro += [ { '<?php echo $key; ?>' : '<?php echo $value->mikro; ?>', } ];
  } else { mikro.push({ '<?php echo $key; ?>' : '<?php echo $value->mikro; ?>', }) }
  <?php } ?>

  var pilihan_mikro = '';
  for(var i = 0; i < Object.keys(mikro).length; i++){
    pilihan_mikro += '<option value="'+id_jenis[i][i]+'">'+mikro[i][i]+'</option>';
  }

  var satuan_bpom = []
  <?php foreach($satuan_bpom as $key => $value) { ?>
  if(!satuan_bpom){
    satuan_bpom += [ { '<?php echo $key; ?>' : '<?php echo $value->satuan; ?>', } ];
  } else { satuan_bpom.push({ '<?php echo $key; ?>' : '<?php echo $value->satuan; ?>', }) }
  <?php } ?>

  var pilihan_satuan_bpom = '';
  for(var i = 0; i < Object.keys(satuan_bpom).length; i++){
    pilihan_satuan_bpom += '<option value="'+satuan_bpom[i][i]+'">'+satuan_bpom[i][i]+'</option>';
  }

  function custom(){
    var dua = document.getElementById('radio_custom');
    if(dua.checked != true){
      document.getElementById('tampilkan').innerHTML = "";
    }else{
      document.getElementById('tampilkan').innerHTML = "<hr><div class='panel panel-default'>"+
	    "<div class='panel-heading'><h5>Mikro Biologi</h5></div>"+
	      "<div class='panel-body'>"+
          '<table class="table table-bordered table-hover" id="tabledata">'+
            "<thead>"+
              "<tr style='font-weight: bold;color:white;background-color: #2a3f54;'>"+
                "<th class='text-center' width='25%'>Jenis Mikro</th>"+
                "<th class='text-center' width='12%'>n</th>"+
                "<th class='text-center' width='12%'>c</th>"+
                "<th class='text-center' width='12%'>m</th>"+
                "<th class='text-center' width='12%'>M</th>"+
                "<th class='text-center'>Satuan</th>"+
                "<th class='text-center' width='8%'>Action</th>"+
              "</tr>"+
            "</thead>"+
            "<tbody>"+
              "<tr>"+
                "<td><select name='mikro[]' id='mikro' class='form-control'>"+pilihan_mikro+"</select></td>"+
                "<td><input type='number' step='0.0001' name='n[]' id='n' class='form-control'></td>"+
                "<td><input type='number' step='0.0001' name='c[]' id='c' class='form-control'></td>"+
                "<td><input type='text' step='0.0001' name='m[]' id='m' class='form-control'></td>"+
                "<td><input type='text' step='0.0001' name='M2[]' id='M2' class='form-control'></td>"+
                "<td><select name='satuan_mikro[]' id='satuan_mikro' class='form-control'>"+pilihan_satuan_bpom+"</select></td>"+
                "<td class='text-center'><button class='btn btn-info btn-sm' id='add_data' type='button'><li class='fa fa-plus'></li></button></td>"+
              "</tr>"+
              "<tr id='addmikro1'></tr>"
            "</tbody>"+
          "</table>"+
        "</div>"+
      "</div>"

      var i = 1;
      $("#add_data").click(function() {
        $('#addmikro' + i).html( 
          "<td><select name='mikro[]' id='mikro' class='form-control'>"+pilihan_mikro+"</select></td>"+
          "<td><input type='number' step='0.0001' name='n[]' id='n' class='form-control'></td>"+
          "<td><input type='number' step='0.0001' name='c[]' id='c' class='form-control'></td>"+
          "<td><input type='text' step='0.0001' name='m[]' id='m' class='form-control'></td>"+
          "<td><input type='text' step='0.0001' name='M2[]' id='M' class='form-control'></td>"+
          "<td><select name='satuan_mikro[]' id='satuan_mikro' class='form-control'>"+pilihan_satuan_bpom+"</select></td>"+
          "<td class='text-center'><a hreaf='' class='btn btn-danger btn-sm'><li class='fa fa-trash'></li></a></td>");
        $('#tabledata').append('<tr id="addmikro' + (i + 1) + '"></tr>');
        i++;
      });

      $(document).ready(function() {
        $('#tabledata').on('click', 'tr a', function(e) {
        e.preventDefault();
            $(this).parents('tr').remove();
        });
      });
    }
  }
</script>

<script>
  $(document).ready(function() {
    $('#tablezat').on('click', 'tr a', function(e) {
    e.preventDefault();
        $(this).parents('tr').remove();
    });
  });

  var id_vit = []
  <?php foreach($satuan_vit as $key => $value) { ?>
  if(!id_vit){
    id_vit += [ { '<?php echo $key; ?>' : '<?php echo $value->id_satuan_vit; ?>', } ];
  } else { id_vit.push({ '<?php echo $key; ?>' : '<?php echo $value->id_satuan_vit; ?>', }) }
  <?php } ?>

  var satuan = []
  <?php foreach($satuan_vit as $key => $value) { ?>
  if(!satuan){
    satuan += [ { '<?php echo $key; ?>' : '<?php echo $value->satuan; ?>', } ];
  } else { satuan.push({ '<?php echo $key; ?>' : '<?php echo $value->satuan; ?>', }) }
  <?php } ?>

  var pilihan_vitamin = '';
  for(var i = 0; i < Object.keys(satuan).length; i++){
    pilihan_vitamin += '<option value="'+id_vit[i][i]+'">'+satuan[i][i]+'</option>';
  }
  
  var zat_aktif = []
  <?php foreach($zat1 as $key => $value) { ?>
  if(!zat_aktif){
    zat_aktif += [ { '<?php echo $key; ?>' : '<?php echo $value->zat_aktif; ?>', } ];
  } else { zat_aktif.push({ '<?php echo $key; ?>' : '<?php echo $value->zat_aktif; ?>', }) }
  <?php } ?>

  var pilihan_zat_aktif = '';
  for(var i = 0; i < Object.keys(zat_aktif).length; i++){
    pilihan_zat_aktif += '<option value="'+zat_aktif[i][i]+'">'+zat_aktif[i][i]+'</option>';
  }

  var b = 1;
  $("#add_zat").click(function() {
    $('#addzat' + b).html( 
    "<td><select name='zat_aktif[]' id='zat_aktif' class='form-control items'>"+pilihan_zat_aktif+"</select></td>"+
    "<td><input type='number' name='zat[]' id='zat' class='form-control'></td>"+
    "<td><select name='satuan_zat[]' id='satuan_zat' class='form-control items'>"+pilihan_vitamin+"</select></td>"+
    "<td class='text-center'><a hreaf='' class='btn btn-danger btn-sm'><li class='fa fa-trash'></li></a></td>");
    
    $('#tablezat').append('<tr id="addzat' + (b + 1) + '"></tr>');
    b++;
  });
</script>

<script>
  $(document).ready(function() {
    $('#tablebtp').on('click', 'tr a', function(e) {
    e.preventDefault();
        $(this).parents('tr').remove();
    });
  });

  var btp = []
  <?php foreach($btp2 as $key => $value) { ?>
  if(!btp){
    btp += [ { '<?php echo $key; ?>' : '<?php echo $value->btp; ?>', } ];
  } else { btp.push({ '<?php echo $key; ?>' : '<?php echo $value->btp; ?>', }) }
  <?php } ?>

  var pilihan_btp = '';
  for(var i = 0; i < Object.keys(btp).length; i++){
    pilihan_btp += '<option value="'+btp[i][i]+'">'+btp[i][i]+'</option>';
  }

  var a = 1;
  $("#add_btp").click(function() {
    $('#addbtp' + a).html( 
    "<td><select name='btp_carry_over[]' class='form-control items'>"+pilihan_btp+"</select></td>"+
    "<td><input type='number' name='btp[]' id='btp' class='form-control'></td>"+
    "<td><select name='satuan_btp[]' class='form-control items'>"+pilihan_vitamin+"</select></td>"+
    "<td class='text-center'><a hreaf='' class='btn btn-danger btn-sm'><li class='fa fa-trash'></li></a></td>");
    
    $('#tablebtp').append('<tr id="addbtp' + (a + 1) + '"></tr>');
    a++;
  });

  $('#kategori').on('change', function(){
      var myId = $(this).val();
        if(myId){
          $.ajax({
          url: '{{URL::to('subkategori')}}/'+myId,
          type: "GET",
          dataType: "json",
          beforeSend: function(){
              $('#loader').css("visibility", "visible");
          },
          success:function(data){
              $('#subkategori').empty();
              $.each(data, function(key, value){
                  $('#subkategori').append('<option value="'+ key +'">' + value + '</option>');
              });
          },
          complete: function(){
                $('#loader').css("visibility","hidden");
            }
        });
        }
        else{
            $('#subkategori').empty();
        }
    });
</script>
@endsection