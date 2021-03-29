@extends('pv.tempvv')
@section('title', 'PRODEV| Information')
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
  <div class="col-md-4"></div>
  <div class="col-md-7">
    <div class="tabbable">
      <ul class="nav nav-tabs wizard">
        <li class="completed"><a href="{{ route('step1',[ $idfor_pdf, $idf]) }}"><span class="nmbr">1</span>Information</a></li>
        <li class="active"><a href="{{ route('step2',[ $idfor_pdf, $idf]) }}"><span class="nmbr">2</span>Drafting</a></li>
        <li class="active"><a href="{{ route('summarry',[ $idfor_pdf, $idf]) }}"><span class="nmbr">3</span>Summary</a></li>
      </ul>
    </div>
  </div>
</div>

<form method="post" class="form-horizontal form-label-left" action="{{ route('step1update',[$formula->id,$formula->workbook_pdf_id]) }}" enctype="multipart/form-data">
<div class="col-md-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h4><li class="fa fa-list"></li> Formula Information  </h4>
    </div>
    <div class="card-block">
    	<div class="form-group row">
      	<label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12"> Project Name </label>
      	<div class="col-md-3 col-sm-3 col-xs-12">
          <input class="form-control edit" id="nama_produk" name="nama_produk" minlength="2" type="text" value="{{ $formula->workbook_pdf->datapdf->project_name }}" readonly />
      	</div>
      	<label for="middle-name" class="control-label col-md-1 col-sm-1 col-xs-12"> PKP Number </label>
      	<div class="col-md-4 col-sm-4 col-xs-12">
          <input class="form-control edit" id="pdf" name="pdf" type="text" value="{{ $formula->workbook_pdf->datapdf->pdf_number }}{{ $formula->workbook_pdf->datapdf->ket_no }}" readonly />  
      	</div>
    	</div>

			<div class="form-group row">
        <label class="control-label col-md-2 col-sm-2 col-xs-12">PV </label>
				<div class="col-md-2 col-sm-2 col-xs-12">
          <input class="form-control edit" id="pv" name="pv" minlength="2" type="text" value="{{ $formula->workbook_pdf->perevisi2->name }}" readonly />
      	</div>
        <label class="control-label col-md-1 col-sm-1 col-xs-12">Kategori </label>
        @if($formula->kategori=='fg')
        <div class="col-md-2">
          <input type="radio" name="kategori" checked oninput="finis_good()" id="id_finis" value="finish good"> Finished Good &nbsp
          <input type="radio" name="kategori" oninput="wip()" id="id_wip"> WIP
        </div>
        <div class="col-md-3" id="ditampilkan">
          <select name="kategori_formula" id="" disabled class="form-control">
            <option disabled selected>--> Select One <--</option>
            <option value="granulasi">Granulasi</option>
            <option value="premix">Premix</option>
          </select>
        </div>
        @elseif($formula->kategori!='fg')
        <div class="col-md-2">
          <input type="radio" name="kategori" oninput="finis_good()" id="id_finis" value="finish good"> Finished Good &nbsp
          <input type="radio" name="kategori" checked oninput="wip()" id="id_wip"> WIP
        </div>
        <div class="col-md-3" id="ditampilkan">
          <select name="kategori_formula" id="" class="form-control">
            <option readonly value="{{$formula->kategori}}" selected>{{$formula->kategori}}</option>
            <option value="granulasi">Granulasi</option>
            <option value="premix">Premix</option>
          </select>
        </div>
        @endif
      </div>

      <div class="form-group row">
        <label class="control-label col-md-2 col-sm-2 col-xs-12">Formula </label>
				<div class="col-md-2 col-sm-2 col-xs-12">
          <input class="form-control edit" id="sample" name="sample" type="text" value="{{ $formula->formula }}" required/>  
      	</div>
        <label class="control-label col-md-1 col-sm-1 col-xs-12">Versi </label>
				<div class="col-md-2 col-sm-2 col-xs-12">
          <input class="form-control edit" id="versi" name="versi" type="text" value="{{ $formula->versi }}.{{ $formula->turunan }}" Readonly />
      	</div>
        <label class="control-label col-md-1 col-sm-1 col-xs-12">Brand </label>
				<div class="col-md-2 col-sm-2 col-xs-12">
          <select class="form-control edit" id="subbrand" name="subbrand" disabled>
            @foreach($subbrands as $subbrand)
            <option value="{{  $subbrand->id }}"{{ ( $subbrand->id == $formula->subbrand_id ) ? ' selected' : '' }} >{{ $formula->workbook_pdf->datapdf->id_brand }}</option>
            @endforeach
          </select>
      	</div>
      </div>

			<div class="form-group row">
        <label class="control-label col-md-2 col-sm-2 col-xs-12">Target Serving </label>
        @if($formula->satuan=='gram')
				<div class="col-md-3 col-sm-3 col-xs-12">
        @else
				<div class="col-md-2 col-sm-2 col-xs-12">
        @endif
          <input class="form-control edit" id="serving" name="serving" type="number" step=any value="{{ $formula->serving_size }}" required />
      	</div>
        <div class="col-md-2 col-sm-2 col-xs-12" >
          @if($formula->satuan=='Gram')
          <center><input type="radio" name="satuan" oninput="satuan_gram()" checked id="id_gram" value="Gram"> Gram
          <input type="radio" name="satuan" oninput="satuan_ml()" id="id_ml" value="Ml"> Add BJ
          @elseif($formula->satuan=='Ml')
          <center><input type="radio" name="satuan" oninput="satuan_gram()" id="id_gram" value="gram"> Gram
          <input type="radio" name="satuan" checked oninput="satuan_ml()" id="id_ml" value="Ml"> Add BJ
          @endif
      	</div>
      	<label for="middle-name" class="control-label col-md-1 col-sm-1 col-xs-12"> Berat Jenis </label>
        @if($formula->satuan=='Gram')
        <div class="col-md-2 col-sm-2 col-xs-12" id="tampilkan">
          <input class="form-control" placeholder='Berat Jenis' id="" value="{{$formula->berat_jenis}}" readonly name="berat_jenis" type="number" />
      	</div>
        @elseif($formula->satuan=='Ml')
        <div class="col-md-2 col-sm-2 col-xs-12" id="tampilkan">
          <input class="form-control" placeholder='Berat Jenis' id="" value="{{$formula->berat_jenis}}" name="berat_jenis" type="number" />
      	</div>
        <div class="col-md-1 col-sm-1 col-xs-12">
        <input class="form-control" placeholder='{{$formula->serving_size / $formula->berat_jenis}} ML' id="" readonly name="" type="number"/>
        </div>
        @endif
      </div>

    	<div class="form-group row">
      	<label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12"> Idea </label>
      	<div class="col-md-8 col-sm-8 col-xs-12">
          <input class="form-control edit" id="idea" name="idea" minlength="2" type="text" value="{{ $formula->workbook_pdf->background }}" readonly />
      	</div>
    	</div>
      <div class="form-group row">
      	<label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12"> Note RD <br><font style="color:red;font-size:11px">* max 200 character</font></label>
      	<div class="col-md-8 col-sm-8 col-xs-12">
          <textarea class="form-control edit" placeholder="max 200 character" style="min-width: 100%" name="keterangan" id="keterangan">{{ old('keterangan',$formula->catatan_rd) }}</textarea>
      	</div>
    	</div>
      <div class="form-group row">
      	<label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12"> Note Formula* </label>
      	<div class="col-md-8 col-sm-8 col-xs-12">
          <textarea class="form-control edit" style="min-width: 100%" name="formula" id="formula">{{ old('keterangan',$formula->note_formula) }}</textarea>
      	</div>
    	</div>
      <div class="item form-group">
        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">File</label>
        <div class="col-md-8 col-sm-8 col-xs-12">
          <input type="file" class="form-control" id="data" name="filename[]" multiple><label for="" style="color:red">*Max 5Mb</label>
        </div>
      </div>
      <div class="item form-group">
        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name"></label>
        <div class="col-md-8 col-sm-8 col-xs-12">
        @foreach($data as $data)
        <a href="{{asset('data_file/'.$data->file)}}" download="{{$data->file}}" title="Download file"><li class="fa fa-download"></li></a> {{$data->file}} <a href="{{route('hapus_file',$data->id_data)}}" title="Delete File"><li class="fa fa-times"></li></a><br>
        @endforeach
        </div>
      </div>
    </div>
  </div>
</div>

<div class="col-md-12 col-xs-12">
  <div class="x_panel">
    <div class="card-block">
			<div class="col-md-4 col-md-offset-5">
        @if(auth()->user()->role->namaRule == 'manager')
        <a class="btn btn-danger btn-sm" href="{{ route('daftarpdf',$formula->workbook_pdf_id) }}"><i class="fa fa-ban"></i> Back</a>
        @elseif(auth()->user()->role->namaRule == 'user_produk')
        <a class="btn btn-danger btn-sm" href="{{ route('rekappdf',$formula->workbook_pdf_id) }}"><i class="fa fa-ban"></i> Back</a>
        @endif
				<button type="reset" class="btn btn-warning btn-sm"><li class="fa fa-repeat"></li> Reset</button>
				<button type="submit" class="btn btn-primary btn-sm"><li class="fa fa-check"></li> Edit And Next</button>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        {{ csrf_field() }}
        @include('formerrors')
			</div>
    </div>
  </div>
</div>
</form>
@endsection

@section('s')
<script type="text/javascript">
  function satuan_ml(){
    var satuan_ml = document.getElementById('id_ml')
    if(satuan_ml.checked != true){
      document.getElementById('tampilkan').innerHTML = "";
    }else{
      document.getElementById('tampilkan').innerHTML =
        "<div class='col-md-12 col-sm-12 col-xs-12'>"+
        "  <input class='form-control' placeholder='Berat Jenis' id='' name='' type='number' required/>"+
      	"</div>"
    }
  }

  function satuan_gram(){
    var satuan_gram = document.getElementById('id_gram')
    if(satuan_gram.checked != true){
      document.getElementById('tampilkan').innerHTML = "";
    }else{
      document.getElementById('tampilkan').innerHTML =
        "<div class='col-md-12 col-sm-12 col-xs-12'>"+
        "  <input class='form-control' disabled placeholder='Berat Jenis' id='' name='' type='number' required/>"+
      	"</div>"
    }
  }

  function finis_good(){
    var finis_good = document.getElementById('id_finis')
    if(finis_good.checked != true){
      document.getElementById('ditampilkan').innerHTML = "";
    }else{
      document.getElementById('ditampilkan').innerHTML =
        "<select name='' disabled id='' class='form-control'>"+
        "  <option disabled selected>--> Select One <--</option>"+
        "  <option value='granulasi'>Granulasi</option>"+
        "  <option value='premix'>Premix</option>"+
        "</select>"
    }
  }

  function wip(){
    var wip = document.getElementById('id_wip')
    if(wip.checked != true){
      document.getElementById('ditampilkan').innerHTML = "";
    }else{
      document.getElementById('ditampilkan').innerHTML =
        "<select name='kategori_formula' id='' class='form-control' required>"+
        "  <option disabled selected>--> Select One <--</option>"+
        "  <option value='granulasi'>Granulasi</option>"+
        "  <option value='premix'>Premix</option>"+
        "</select>"
    }
  }
</script>
@endsection