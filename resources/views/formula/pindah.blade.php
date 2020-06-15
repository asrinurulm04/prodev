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

<style>
	input[type="number"]{
    background: transparent !important;
    border: none;
    outline: none;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    box-shadow: none;
    -moz-appearance:textfield;
    width: 70px;
	}

	input::-webkit-outer-spin-button,
	input::-webkit-inner-spin-button {
		-webkit-appearance: none;
	}

	.tototal{
    font-size: 12px;
    font-weight: bold;
    color:black;
    background-color: rgb(78, 205, 196, 0.5);
	}

	.toserving{
    font-size: 12px;
    font-weight: bold;
	}
</style>

<div class="row">
  @include('formerrors')
  <div class="col-md-4"></div>
  <div class="col-md-8">
    <div class="tabbable">
      <ul class="nav nav-tabs wizard">
        <li class="active"><a href="{{ route('step1',$idf) }}" ><span class="nmbr">1</span>Informasi Formula</a></li>
        <li class="completed"><a href="{{ route('step2',$idf) }}"><span class="nmbr">2</span>Penyusunan</a></li>
        <li class="active"><a href="{{ route('step3',$idf) }}"><span class="nmbr">3</span>Premixs</a></li>
      </ul>
    </div>
  </div>
</div>

<div class="row form-panel">
  <div class="col-lg-12 col-md-12 col-sm-12">
    <div class="row">
      <div class="row">
        <div class="col-md-1">
          <select class="form-control" id="scale_option">
            <option value="-">-</option>
            <option value="%">%</option>
          </select>
          <select name="check method" id="scale_method" style="visibility:hidden">
            <option value="A">Jumlah Scale Serving</option>
            <option value="B">Scale Serving</option>
            <option value="C">Scale Batch</option>
            <option value="D">Jumlah Scale Batch</option>
          </select>
        </div>
        <div class="col-md-10">
          @if ($mybase != 0)
          <a class="btn btn-theme" href="{{ route('scale',$idf) }}">Check Scale</a>
          @endif
          @if ($mybase != 0)
          <a class="btn btn-theme01" href="">Ganti Base</a>
          <a class="btn btn-theme02" href="">Hapus Base</a>
          @endif
          <a class="btn btn-info" href="{{route('ramen',$idf)}}">BahanBaku Baru</a>                                    
          <a class="btn btn-warning" href="{{ route('getTemplate',$idf) }}">Pilih Template</a>                                    
          <a class="btn btn-primary" href="{{ route('step3',$idf) }}">Save and continue</a>
          <a class="btn btn-danger" href="{{ route('showworkbook',$formula->workbook_id) }}" type="button" >Batal</a>
        </div>
      </div>

      @if($ada<1)
        <h3>Data Masih Kosong !</h3>
      @endif

      @if($ada>0)<br>
      <table class="table" style="font-size:12px">
        <tr>
					<th style="width:5%" ></th>                        
					<th style="width:60%">Nama Sederhana</th>
					<th style="width:8%"><i class="fa fa-edit"></i>PerBatch</th>
					<th style="width:8%"><i class="fa fa-edit"></i>PerServing</th>
					<th style="width:8%"><i class="fa fa-plus"></i>ScaleBatch</th>
					<th style="width:8%"><i class="fa fa-plus"></i>ScaleServing</th>
					<th style="width:8%">BasePerhitungan</th>
        </tr> 
        <tbody>
          @foreach($fortails as $fortail)                                                                       
          <tr>
         	  @php ++$no @endphp                        
            <td>
              <a data-toggle="modal" data-target="#editpenyusun"><i class="fa fa-edit" ></i></a>
              <a onclick="return confirm('Hapus Bahan Baku ?')" href="{{ route('step2destroy',['id'=>$fortail->id,'vf'=>$idf]) }}"><i class="fa fa-trash"></i></a>
            </td>
            <td>{{ $fortail->nama_sederhana }}</td>
            {{-- ID Fortail--}}
            <input type="hidden" id="ftid{{$no}}" name="ftid[{{$no}}]" value="{{$fortail->id}}">
            {{-- For Reset and Check what change --}}
            <input type="hidden" placeholder="0" id="rBatch{{$no}}" value="{{ $fortail->per_batch }}">
            <input type="hidden" placeholder="0" id="rServing{{$no}}" value="{{ $fortail->per_serving }}">
            <input type="hidden" placeholder="0" id="rjBatch" value="{{$formula->batch}}">
            <input type="hidden" placeholder="0" id="rjServing" value="{{$formula->serving}}">
            <input type="hidden" placeholder="0" id="rsBatch" value="">
            <input type="hidden" placeholder="0" id="rsServing" value="">

            {{-- Akhir --}}
            <td><input type="number" placeholder="0" onkeyup="jBatch(this.id)" id="batch{{$no}}" value="{{ $fortail->per_batch }}" name="batch[{{ $no }}]"></td>
            <td><input type="number" placeholder="0" onkeyup="jServing(this.id)" id="serving{{$no}}" value="{{ $fortail->per_serving }}" name="serving[{{ $no }}]"></td>
            <td><input type="number" placeholder="0" onkeyup="jsBatch(this.id)" id="sBatch{{$no}}" name="sBatch[{{$no}}]"   value="{{ $mycollect }}"></td>
            <td><input type="number" placeholder="0" onkeyup="jsServing(this.id)" id="sServing{{$no}}" name="sServing[{{$no}}]" value="{{ $mycollec }}"></td>
            @if ($no == 1)
              <td class="base" style="background-color:#f2f2f2">
                X <input type="number" id="bPerhitungan" value="{{ $mybase }}">
              </td> 
            @endif
          </tr>                        
          @endforeach                        
          <tr class="tototal">
            <th colspan="2">Jumlah</th>
            <th><input type="number" placeholder="0" id="jBatch"></th>
            <th><input type="number" placeholder="0" id="jServing"></th>
            <th><input type="number" placeholder="0" id="jsBatch"></th>
            <th><input type="number" placeholder="0" id="jsServing"></th>
            <th></th>
          </tr>
          <tr class="toserving">
            <th colspan="3">Target Serving</th>
            <th style="background-color:#f2f2f2;color:black;"><input type="number" placeholder="0" id="tServing"></th>
            <th colspan="3"></th>
          </tr>
        </tbody>
        {{-- JumlahFortail --}}
        <input type="hidden" value="{{$no}}">
      </table>
      @endif
    </div>
 	</div>
</div>

<div class="row">
  <div class="col-md-12" >
    <h4><i class="fa fa-plus"></i> Tambah Bahan Baku</h4>
    <div class="form-panel">
      <div class="row">
        <form id="submitbahan" method="POST" action="{{ route('step2insert',$idf) }}">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <table style="border-spacing: 10px;border-collapse: separate;">
            <tr>
              <td>
              	<label for="" class="control-label">Bahan Baku</label><br>
								<select class="bahan form-control" style="width:230px;" id="prioritas" name="prioritas">
									<option value="" disabled selected>Pilih BahanBaku</option>
									@foreach($bahans as $bahan)
									<option value="{{ $bahan->id }}" {{ old('prioritas') == $bahan->id ? 'selected' : '' }}>{{ $bahan->nama_sederhana }}</option>
									@endforeach
								</select>
								<button class="btn btn-primary" id="t1" type="button"><i class="fa fa-plus"></i></button>
              </td>
                                
              <td class="A1" style="display:none">
								<label for="" class="control-label">Alternatif 1</label><br>
								<select class="bahan form-control" style="width:230px;display:none;" id="alternatif" name="alternatif[1]">
									<option value="" disabled selected>Pilih Alternatif 1</option>                                
								</select>
								<button class="btn btn-primary" id="t2" type="button"><i class="fa fa-plus"></i></button>
								<button class="btn btn-danger" id="k1" type="button"><i class="fa fa-minus"></i></button>
              </td>
        
              <td class="A2" style="display:none">
								<label for="" class="control-label">Alternatif 2</label><br>
								<select class="bahan form-control" style="width:230px;display:none;" id="alternatif2" name="alternatif[2]">
									<option value="" disabled selected>Pilih Alternatif 2</option>                                
								</select>
								<button class="btn btn-primary" id="t3" type="button"><i class="fa fa-plus"></i></button>
								<button class="btn btn-danger" id="k2" type="button"><i class="fa fa-minus"></i></button>
              </td>
        
              <td class="A3" style="display:none">
								<label for="" class="control-label">Alternatif 3</label><br>
								<select class="bahan form-control" style="width:230px;display:none;" id="alternatif3" name="alternatif[3]">
									<option value="" disabled selected>Pilih Alternatif 3</option>                                
								</select>
								<button class="btn btn-primary" id="t4" type="button"><i class="fa fa-plus"></i></button>
								<button class="btn btn-danger" id="k3" type="button"><i class="fa fa-minus"></i></button>
              </td>
                            
              <td class="A4" style="display:none">
								<label for="" class="control-label">Alternatif 4</label><br>
								<select class="bahan form-control" style="width:230px;display:none;" id="alternatif4" name="alternatif[4]">
									<option value="" disabled selected>Pilih Alternatif 4</option>                                
								</select>
								<button class="btn btn-danger" id="k4" type="button"><i class="fa fa-minus"></i></button>
              </td>
            </tr>
          </table>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="row">
            @if ($mybase == 0)
            <div class="col-md-1"> 
              <label for="" class="control-label">Per Batch</label>
              <input type="number" step=any id="per_batch" name="per_batch" placeholder="0" class="form-control" value="{{ old('per_batch') }}" />                    
            </div>
            @endif
            <div class="col-md-1">
              <label for="" class="control-label">Per Serving</label>
              <input type="number" step=any id="per_serving"  name="per_serving" placeholder="0" class="form-control" value="{{ old('per_serving') }}" required />
              <input type="hidden" id="c"  name="c" value="0"/> 
            </div>
            @if ($mybase == 0)
            <div class="col-md-2"><br>
              <input type="checkbox" value="yes" name="cbase" id="cbase">
              <label for="cbase" >Jadikan Base Perhitungan</label>
            </div>                                   
            @endif                                
            <div class="col-md-8"><br>
              {{ csrf_field()}}
              <input type="submit" class="btn btn-primary" value="+ Masukan Bahan"></td>
            </div>
          </div>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>
@endsection    

@section('s')

<script type="text/javascript">
  $(document).ready(function(){
  	$('.base').attr('rowspan',{{ $no }});
      // Hitung Jumlah Serving dan Batch
      var i = {{ $no }};
      var total  = 0;
      var total2 = 0;
      for(y=1;y<=i;y++){
        batch = parseFloat($('#batch'+y).val());
        serving = parseFloat($('#serving'+y).val());
        total = total + batch;
        total2 = total2 + serving;
      }
    $('#jBatch').val(total);
    $('#jServing').val(total2);
  });

  function jBatch(myId){
    var urutan = myId.substring(5);
    var i = {{ $no }};
    var total= 0;
    for(y=1;y<=i;y++){
      batch = parseFloat($('#batch'+y).val());
      cek_batch = $('#batch'+y).val();
        if(cek_batch == ''){
          batch = 0;
        }
      total = total + batch;
    }
    $('#jBatch').val(total);
            
    x = $('#batch'+urutan).val();
    y = $('#rBatch'+urutan).val();
    if(x != y ){
      $('#'+myId).css("border", "1px solid cyan");
    }
    else{
      $('#'+myId).css("border", "");
    }
  }
        
  function jServing(myId)
    var urutan = myId.substring(7);
    var i = {{ $no }};
    var total= 0;
    for(y=1;y<=i;y++){
      serving = parseFloat($('#serving'+y).val());
      cek_serving = $('#serving'+y).val();
      if(cek_serving == ''){
        serving = 0;
      }
      total = total + serving;
    }
    $('#jServing').val(total);

    x = parseFloat($('#serving'+urutan).val());
    y = parseFloat($('#rServing'+urutan).val());
    if(x != y ){
      $('#'+myId).css("border", "1px solid cyan");
    }
    else{
      $('#'+myId).css("border", "");
    }
  }

  function jsBatch(myId){
    var urutan = myId.substring(6);
    x = $('#rsBatch'+urutan).val();
    y = $('#sBatch'+urutan).val();
    if(x != y ){
      $('#'+myId).css("border", "1px solid cyan");
    }
    else{
      $('#'+myId).css("border", "");
    }
  }

</script>

<script type="text/javascript">
  $(document).ready(function(){
    var ckbox = $('#cbase');
    $('#cbase').on('click',function () {
      if (ckbox.is(':checked')) {
        $('#per_batch').removeAttr('disabled');
        $('#per_batch').prop('required',true);;
      } else {
        $('#per_batch').attr('disabled','disabled');
        $('#per_batch').prop('required',false);
      }
    });

    $('#prioritas').on('change', function(){
      var myId = $(this).val();
      if(myId){
    		$.ajax({
      		url: '{{URL::to('getAlternatif')}}/'+myId,
      		type: "GET",
      		dataType: "json",
      		beforeSend: function(){
        		$('#loader').css("visibility", "visible");
      		},

          success:function(data){
            $('#alternatif').empty();
            $('#alternatif2').empty();
            $('#alternatif3').empty();
            $('#alternatif4').empty();

            $('#alternatif').append('<option value="0" disabled selected> Pilih Alternatif  </option>');
            $('#alternatif2').append('<option value="0" disabled selected> Pilih Alternatif 2</option>');
            $('#alternatif3').append('<option value="0" disabled selected> Pilih Alternatif 3</option>');
            $('#alternatif4').append('<option value="0" disabled selected> Pilih Alternatif 4</option>');

            $.each(data, function(key, value){
              $('#alternatif').append('<option value="'+ key +'">' + value + '</option>');
              $('#alternatif2').append('<option value="'+ key +'">' + value + '</option>');
              $('#alternatif3').append('<option value="'+ key +'">' + value + '</option>');
              $('#alternatif4').append('<option value="'+ key +'">' + value + '</option>');
            });
          },
          complete: function(){
            $('#loader').css("visibility","hidden");
          }
        });
      }
      else{
        $('#alternatif').empty();
        $('#alternatif2').empty();
        $('#alternatif3').empty();
        $('#alternatif4').empty();
      }           
    });
  });
</script>

<script type="text/javascript">
	$('#prioritas').select2();
	$('#alternatif').select2();
	$('#alternatif2').select2();
	$('#alternatif3').select2();
	$('#alternatif4').select2();

	$(document).ready(function(){
    $('.base').attr('rowspan',{{ $no }}); 
    $('#submitbahan').submit(function () {
    	// Get the c
    	var c = $('#c').val();
    	var bahanbaku = $('#prioritas').val();
    	var alternatif = $('#alternatif').val();
    	var alternatif2 = $('#alternatif2').val();
    	var alternatif3 = $('#alternatif3').val();
    	var alternatif4 = $('#alternatif4').val();

    	if(c === '0' ){
        if(bahanbaku === null){
          alert('BahanBaku Tidak Boleh Kosong');
          return false;
        }
    	}
    	else if(c === '1'){
        if(bahanbaku === null){
          alert('BahanBaku Tidak Boleh Kosong');
          return false;
        }
        if(alternatif === null){
          alert('Alternatif1 Tidak Boleh Kosong');
          return false;
        }
    	}
    	else if(c === '2'){
        if(bahanbaku === null){
          alert('BahanBaku Tidak Boleh Kosong');
          return false;
        }
        if(alternatif === null){
          alert('Alternatif 1 Tidak Boleh Kosong');
          return false;
        }
        if(alternatif2 === null){
          alert('Alternatif 2 Tidak Boleh Kosong');
          return false;
        }
    	}
    	else if(c === '3'){
        if(bahanbaku === null){
          alert('BahanBaku Tidak Boleh Kosong');
          return false;
        }
        if(alternatif === null){
          alert('Alternatif 1 Tidak Boleh Kosong');
          return false;
        }
        if(alternatif2 === null){
          alert('Alternatif 2 Tidak Boleh Kosong');
          return false;
        }
        if(alternatif3 === null){
          alert('Alternatif 3 Tidak Boleh Kosong');
          return false;
        }
    	}
    	else if(c === '4'){
        if(bahanbaku === null){
          alert('BahanBaku Tidak Boleh Kosong');
          return false;
        }
        if(alternatif === null){
          alert('Alternatif 1 Tidak Boleh Kosong');
          return false;
        }
        if(alternatif2 === null){
          alert('Alternatif 2 Tidak Boleh Kosong');
          return false;
        }
        if(alternatif3 === null){
          alert('Alternatif 3 Tidak Boleh Kosong');
          return false;
        }
        if(alternatif4 === ''){
          alert('Alternatif 4 Tidak Boleh Kosong');
          return false;
        }
    	}
    });

  	$("#xx").click(function(e) {
      $('#add').hide();
  	});

    $('.A4').hide();
    $('.A3').hide();
    $('.A2').hide();
    $('.A1').hide();
    
    $("#k4").click(function(e) {
      $('.A4').hide();
      $('#k3').show();
      $("#t4").show();
      $('#c').val(3);
    });
    
    $("#k3").click(function(e) {
      $('.A3').hide();
      $('#k2').show();
      $("#t3").show();
      $('#c').val(2);
    });

    $("#k2").click(function(e) {
      $('.A2').hide();
      $('#k1').show();
      $('#t2').show();
      $('#c').val(1);
  	});
    $("#k1").click(function(e) {
      $('.A1').hide();
      $('#t1').show();
      $('#c').val(0);
  	});

  	$("#t4").click(function(e) {
      $('.A4').show();
      $('#k3').hide();
      $("#t4").hide();
      $('#c').val(4);
	  });
  
  	$("#t3").click(function(e) {
      $('.A3').show();
      $('#k2').hide();
      $("#t3").hide();
      $('#c').val(3);
	  });
    $("#t2").click(function(e) {
      $('.A2').show();
      $('#k1').hide();
      $('#t2').hide();
      $('#c').val(2);
  	});
    $("#t1").click(function(e) {
      $('.A1').show();
      $('#t1').hide();
      $('#c').val(1);
  	});

  	$('select').on('change', function() {
	    $('select').find('option').prop('disabled', false);
    	$('select').each(function() {
        $('select').not(this).find('option[value="' + this.value + '"]').prop('disabled', true); 
    	});
		});
	});
</script>

@endsection