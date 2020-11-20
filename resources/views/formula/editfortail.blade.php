@extends('formula.tempformula')
@section('title', 'Edit BahanBaku')
@section('judulnya', 'Edit BahanBaku')
@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="x_panel">
      <table class="table table-striped table-advance table-hover">
        <tr>
          <th>Kode Komputer</th>
          <th>Nama Sederhana</th>
          <th>Kode Oracle</th>
          <th>Prioritas</th>
          <th>Nama_Bahan</th>
          <th>Per_Batch</th>
          <th>Per_Serving</th>
        </tr>    
        <tr>
          <td>{{ $fortail->kode_komputer }}</td>
          <td>{{ $fortail->nama_sederhana }}</td>
          <td>{{ $fortail->kode_oracle }}</td>
          <td>{{ $fortail->bahan->nama_sederhana }}</td>
          <td>{{ $fortail->nama_bahan }}</td>
          <td>{{ $fortail->per_batch }}</td>
          <td>{{ $fortail->per_serving }}</td>
        </tr>        
      </table>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12 content-panel" >
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4><i class="fa fa-plus"></i> Tambah Bahan Baku</h4>
      </div>
      <div class="panel-body">
        <div class="row">
          <form method="POST" action="{{ route('updatefortail',['idf'=>$idf,'id'=>$fortail->id]) }}">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <table style="border-spacing: 15px;border-collapse: separate;">
              <tr>
                <td>
                  <label for="" class="control-label">Bahan Baku</label><br>
                  <select class="bahan form-control" style="width:230px;" id="prioritas" name="prioritas">
                    @foreach($bahans as $bahan)
                    <option value="{{ $bahan->id }}" {{ $fortail->bahan_id == $bahan->id ? 'selected' : '' }}>{{ $bahan->nama_sederhana }}</option>
                    @endforeach
                  </select>
                  <button class="btn btn-success btn-sm" id="t1" type="button"><i class="fa fa-plus"></i></button>
                </td>   
                <td class="A1" style="display:none">
                  <label for="" class="control-label">Alternatif 1</label><br>
                  <select class="bahan2 form-control" style="width:230px;display:none;" id="alternatif" name="alternatif[1]">
                    @foreach($alternatifs as $bahan)
                    <option value="{{ $bahan->id }}" {{ $fortail->kode_komputer2 == $bahan->kode_komputer ? 'selected' : '' }}>{{ $bahan->nama_sederhana }}</option>
                    @endforeach
                  </select>
                  <button class="btn btn-success btn-sm" id="t2" type="button"><i class="fa fa-plus"></i></button>
                  <button class="btn btn-danger btn-sm" id="k1" type="button"><i class="fa fa-minus"></i></button>
                </td>
                <td class="A2" style="display:none">
                  <label for="" class="control-label">Alternatif 2</label><br>
                  <select class="bahan3 form-control" style="width:230px;display:none;" id="alternatif2" name="alternatif[2]">
                    @foreach($alternatifs as $bahan)
                    <option value="{{ $bahan->id }}" {{ $fortail->kode_komputer3 == $bahan->kode_komputer ? 'selected' : '' }}>{{ $bahan->nama_sederhana }}</option>
                    @endforeach
                  </select>
                  <button class="btn btn-success btn-sm" id="t3" type="button"><i class="fa fa-plus"></i></button>
                  <button class="btn btn-danger btn-sm" id="k2" type="button"><i class="fa fa-minus"></i></button>
                </td>

                <td class="A3" style="display:none">
                  <label for="" class="control-label">Alternatif 3</label><br>
                  <select class="bahan3 form-control" style="width:230px;display:none;" id="alternatif3" name="alternatif[3]">
                    @foreach($alternatifs as $bahan)
                    <option value="{{ $bahan->id }}" {{ $fortail->kode_komputer4 == $bahan->kode_komputer ? 'selected' : '' }}>{{ $bahan->nama_sederhana }}</option>
                    @endforeach
                  </select>
                  <button class="btn btn-success btn-sm" id="t4" type="button"><i class="fa fa-plus"></i></button>
                  <button class="btn btn-danger btn-sm" id="k3" type="button"><i class="fa fa-minus"></i></button>
                </td>
                    
                <td class="A4" style="display:none">
                  <label for="" class="control-label">Alternatif 4</label><br>
                  <select class="bahan3 form-control" style="width:230px;display:none;" id="alternatif4" name="alternatif[4]">
                    @foreach($alternatifs as $bahan)
                    <option value="{{ $bahan->id }}" {{ $fortail->kode_komputer4 == $bahan->kode_komputer ? 'selected' : '' }}>{{ $bahan->nama_sederhana }}</option>
                    @endforeach
                  </select>
                  <button class="btn btn-danger btn-sm" id="k4" type="button"><i class="fa fa-minus"></i></button>
                </td>
              </tr>
            </table>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="row">
              <div class="col-md-6">
                <input type="hidden" id="c"  name="c" value="{{ $count_alternatif }}" /><br>
                {{ csrf_field()}}
                {{ method_field('PATCH')}}
                <button type="submit" class="btn btn-info btn-sm" onclick="return confirm('Simpan Perubahan ?')"><i class="fa fa-edit"></i> Simpan Perubahan</button>
                <a type="button" class="btn btn-danger btn-sm" href="{{ route('step2',$idf) }}"><i class="fa fa-times"></i> BATAL</a>                
              </div>
            </div>
          </div>
          </form>
        </div>
      </div>
		</div>
	</div>
</div>

@endsection

@section('s')
<script type="text/javascript">
	$('#prioritas').select2();
	$('#alternatif').select2();
	$('#alternatif2').select2();
	$('#alternatif3').select2();
	$('#alternatif4').select2();

	$(document).ready(function(){ 

  	$("#xx").click(function(e) {
      $('#add').hide();
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

    var what = $('#c').val();
    if(what == '4'){
      $('#t1').hide();
      $('.A1').show();
      $('#t2').hide();
      $('#k1').hide();
      $('.A2').show();
      $('#t3').hide();
      $('#k2').hide();
      $('.A3').show();
      $('#t4').hide();
      $('#k3').hide();
      $('.A4').show();
      $('#k4').show();
    }
    else if(what == '3'){
      $('#t1').hide();
      $('.A1').show();
      $('#t2').hide();
      $('#k1').hide();
      $('.A2').show();
      $('#t3').hide();
      $('#k2').hide();
      $('.A3').show();
      $('#t4').show();
      $('#k3').show();
    }
    else if(what == '2'){
      $('#t1').hide();
      $('.A1').show();
      $('#t2').hide();
      $('#k1').hide();
      $('.A2').show();
      $('#t3').show();
      $('#k2').show();
    }
    else if(what == '1'){
      $('#t1').hide();
      $('.A1').show();
      $('#t2').show();
      $('#k1').show();
    }
    
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
	});
</script>
@endsection