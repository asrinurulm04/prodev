@extends('formula.tempformula')
@section('title', 'Edit BahanBaku')
@section('judulnya', 'Edit BahanBaku')
@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="x_panel">
          <table class="table table-sm table-bordered">
        <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
          <th>Nama Sederhana</th>
          <th>Nama_Bahan</th>
          <th>Principle</th>
          <th>Per_Batch</th>
          <th>Per_Serving</th>
        </tr>  
        @foreach($fortail as $fortail)  
        <tr>
          <td>
            <table class="table-bordered table">
              <tbody>
                <tr><td><b>{{ $fortail['nama_sederhana'] }}</td></tr>
                @if($fortail['alternatif1'] != Null)<tr><td>{{ $fortail['alternatif1'] }}</td></tr>@endif
                @if($fortail['alternatif2'] != Null)<tr><td>{{ $fortail['alternatif2'] }}</td></tr>@endif
                @if($fortail['alternatif3'] != Null)<tr><td>{{ $fortail['alternatif3'] }}</td></tr>@endif
                @if($fortail['alternatif4'] != Null)<tr><td>{{ $fortail['alternatif4'] }}</td></tr>@endif
                @if($fortail['alternatif5'] != Null)<tr><td>{{ $fortail['alternatif5'] }}</td></tr>@endif
                @if($fortail['alternatif6'] != Null)<tr><td>{{ $fortail['alternatif6'] }}</td></tr>@endif
                @if($fortail['alternatif7'] != Null)<tr><td>{{ $fortail['alternatif7'] }}</td></tr>@endif
              </tbody>
            </table>
          </td>
          <td>
            <table class="table-bordered table">
              <tbody>
								<tr><td><b>{{ $fortail['nama_bahan'] }}</td></tr>
								@if($fortail['nama_bahan1'] != Null)<tr><td>{{ $fortail['nama_bahan1'] }}</td></tr>@endif
								@if($fortail['nama_bahan2'] != Null)<tr><td>{{ $fortail['nama_bahan2'] }}</td></tr>@endif
								@if($fortail['nama_bahan3'] != Null)<tr><td>{{ $fortail['nama_bahan3'] }}</td></tr>@endif
								@if($fortail['nama_bahan4'] != Null)<tr><td>{{ $fortail['nama_bahan4'] }}</td></tr>@endif
								@if($fortail['nama_bahan5'] != Null)<tr><td>{{ $fortail['nama_bahan5'] }}</td></tr>@endif
								@if($fortail['nama_bahan6'] != Null)<tr><td>{{ $fortail['nama_bahan6'] }}</td></tr>@endif
								@if($fortail['nama_bahan7'] != Null)<tr><td>{{ $fortail['nama_bahan7'] }}</td></tr>@endif
              </tbody>
            </table>
          </td>
          <td>
					  <table class="table-bordered table">
					  	<tbody>
					  		<tr><td><b>{{ $fortail['principle'] }}</td></tr>
					  		@if($fortail['principle1'] != Null)<tr><td>{{ $fortail['principle1'] }}</td></tr>@endif
					  		@if($fortail['principle2'] != Null)<tr><td>{{ $fortail['principle2'] }}</td></tr>@endif
					  		@if($fortail['principle3'] != Null)<tr><td>{{ $fortail['principle3'] }}</td></tr>@endif
					  		@if($fortail['principle4'] != Null)<tr><td>{{ $fortail['principle4'] }}</td></tr>@endif
					  		@if($fortail['principle5'] != Null)<tr><td>{{ $fortail['principle5'] }}</td></tr>@endif
					  		@if($fortail['principle6'] != Null)<tr><td>{{ $fortail['principle6'] }}</td></tr>@endif
					  		@if($fortail['principle7'] != Null)<tr><td>{{ $fortail['principle7'] }}</td></tr>@endif
					  	</tbody>
					  </table>
          </td>
          <td>{{ $fortail->per_batch }}</td>
          <td>{{ $fortail->per_serving }}</td>
        </tr>   
        @endforeach     
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
             @foreach($edit as $edit)
              <tr>
                <td>
                  <label for="" class="control-label">Bahan Baku</label><br>
                  <select class="bahan form-control" style="width:230px;" id="prioritas" name="prioritas">
                    <option value="{{ $edit->bahan_id }}">{{$edit->nama_sederhana}}</option>
                    @foreach($alternatifs as $bahan)
                    <option value="{{ $bahan->id }}">{{ $bahan->nama_sederhana }}</option>
                    @endforeach
                  </select>
                  @if($edit->alternatif1==NULL)
                  <button class="btn btn-success btn-sm" id="t1" type="button"><i class="fa fa-plus"></i></button>
                  @endif
                </td>   

                @if($edit->alternatif1!=NULL)
                <td>
                  <label for="" class="control-label">Alternatif 1</label><br>
                  <select class="bahan2 form-control" style="width:230px;" id="alternatif" name="alternatif[1]">
                    <option value="NULL">-> Not Selected <-</option>
                    @foreach($alternatifs as $bahan)
                    @if($bahan->nama_sederhana==$edit->alternatif1)
                    <option value="{{$bahan->id}}" selected>{{$edit->alternatif1}}</option>
                    @endif
                    <option value="{{ $bahan->id }}">{{ $bahan->nama_sederhana }}</option>
                    @endforeach
                  </select>
                  @if($edit->alternatif2==NULL)
                  <button class="btn btn-success btn-sm" id="t2" type="button"><i class="fa fa-plus"></i></button>
                  @endif
                </td>
                @else
                <td class="A1" style="display:none">
                  <label for="" class="control-label">Alternatif 1</label><br>
                  <select class="bahan2 form-control" style="width:230px;display:none;" id="alternatif" name="alternatif[1]">
                    @foreach($alternatifs as $bahan)
                    <option value="{{ $bahan->id }}">{{ $bahan->nama_sederhana }}</option>
                    @endforeach
                  </select>
                  @if($edit->alternatif2==NULL)
                  <button class="btn btn-success btn-sm" id="t2" type="button"><i class="fa fa-plus"></i></button>
                  <button class="btn btn-danger btn-sm" id="k1" type="button"><i class="fa fa-minus"></i></button>
                  @endif
                </td>
                @endif

                @if($edit->alternatif2!=NULL)
                <td >
                  <label for="A2" class="control-label">Alternatif 2</label><br>
                  <select class="bahan3 form-control" style="width:230px;" id="alternatif2" name="alternatif[2]">
                    <option value="NULL">-> Not Selected <-</option>
                    @foreach($alternatifs as $bahan)
                    @if($bahan->nama_sederhana==$edit->alternatif2)
                    <option value="{{$bahan->id}}" selected>{{$edit->alternatif2}}</option>
                    @endif
                    <option value="{{ $bahan->id }}">{{ $bahan->nama_sederhana }}</option>
                    @endforeach
                  </select>
                  @if($edit->alternatif3==NULL)
                  <button class="btn btn-success btn-sm" id="t3" type="button"><i class="fa fa-plus"></i></button>
                  @endif
                </td>
                @else
                <td class="A2" style="display:none">
                  <label for="" class="control-label">Alternatif 2</label><br>
                  <select class="bahan3 form-control" style="width:230px;display:none;" id="alternatif2" name="alternatif[2]">
                    @foreach($alternatifs as $bahan)
                    <option value="{{ $bahan->id }}">{{ $bahan->nama_sederhana }}</option>
                    @endforeach
                  </select>
                  @if($edit->alternatif3==NULL)
                  <button class="btn btn-success btn-sm" id="t3" type="button"><i class="fa fa-plus"></i></button>
                  <button class="btn btn-danger btn-sm" id="k2" type="button"><i class="fa fa-minus"></i></button>
                  @endif
                </td>
                @endif

                @if($edit->alternatif3!=NULL)
                <td>
                  <label for="" class="control-label">Alternatif 3</label><br>
                  <select class="bahan3 form-control" style="width:230px;display:none;" id="alternatif3" name="alternatif[3]">
                    <option value="NULL">-> Not Selected <-</option>
                    @foreach($alternatifs as $bahan)
                    @if($bahan->nama_sederhana==$edit->alternatif3)
                    <option value="{{$bahan->id}}" selected>{{$edit->alternatif3}}</option>
                    @endif
                    <option value="{{ $bahan->id }}">{{ $bahan->nama_sederhana }}</option>
                    @endforeach
                  </select>
                  @if($edit->alternatif4==NULL)
                  <button class="btn btn-success btn-sm" id="t4" type="button"><i class="fa fa-plus"></i></button>
                  @endif
                </td>
                @else
                <td class="A3" style="display:none">
                  <label for="" class="control-label">Alternatif 3</label><br>
                  <select class="bahan3 form-control" style="width:230px;display:none;" id="alternatif3" name="alternatif[3]">
                    @foreach($alternatifs as $bahan)
                    <option value="{{ $bahan->id }}">{{ $bahan->nama_sederhana }}</option>
                    @endforeach
                  </select>
                  @if($edit->alternatif4==NULL)
                  <button class="btn btn-success btn-sm" id="t4" type="button"><i class="fa fa-plus"></i></button>
                  <button class="btn btn-danger btn-sm" id="k3" type="button"><i class="fa fa-minus"></i></button>
                  @endif
                </td>
                @endif
              </tr>

              <tr> 
                @if($edit->alternatif4!=NULL)
                <td>
                  <label for="" class="control-label">Alternatif 4</label><br>
                  <select class="bahan4 form-control" style="width:230px;display:none;" id="alternatif4" name="alternatif[4]">
                    <option value="NULL">-> Not Selected <-</option>
                    @foreach($alternatifs as $bahan)
                    @if($bahan->nama_sederhana==$edit->alternatif4)
                    <option value="{{$bahan->id}}" selected>{{$edit->alternatif4}}</option>
                    @endif
                    <option value="{{ $bahan->id }}">{{ $bahan->nama_sederhana }}</option>
                    @endforeach
                  </select>
                  @if($edit->alternatif5==NULL)
                  <button class="btn btn-success btn-sm" id="t5" type="button"><i class="fa fa-plus"></i></button>
                  @endif
                </td>
                @else
                <td class="A4" style="display:none">
                  <label for="" class="control-label">Alternatif 4</label><br>
                  <select class="bahan4 form-control" style="width:230px;display:none;" id="alternatif4" name="alternatif[4]">
                    @foreach($alternatifs as $bahan)
                    <option value="{{ $bahan->id }}">{{ $bahan->nama_sederhana }}</option>
                    @endforeach
                  </select>
                  @if($edit->alternatif5==NULL)
                  <button class="btn btn-success btn-sm" id="t5" type="button"><i class="fa fa-plus"></i></button>
                  <button class="btn btn-danger btn-sm" id="k4" type="button"><i class="fa fa-minus"></i></button>
                  @endif
                </td>
                @endif

                
                @if($edit->alternatif5!=NULL)
                <td>
                  <label for="" class="control-label">Alternatif 5</label><br>
                  <select class="bahan3 form-control" style="width:230px;display:none;" id="alternatif5" name="alternatif[5]">
                    <option value="NULL">-> Not Selected <-</option>
                    @foreach($alternatifs as $bahan)
                    @if($bahan->nama_sederhana==$edit->alternatif5)
                    <option value="{{$bahan->id}}" selected>{{$edit->alternatif5}}</option>
                    @endif
                    <option value="{{ $bahan->id }}">{{ $bahan->nama_sederhana }}</option>
                    @endforeach
                  </select>
                  @if($edit->alternatif6==NULL)
                  <button class="btn btn-success btn-sm" id="t6" type="button"><i class="fa fa-plus"></i></button>
                  @endif
                </td>
                @else
                <td class="A5" style="display:none">
                  <label for="" class="control-label">Alternatif 5</label><br>
                  <select class="bahan3 form-control" style="width:230px;display:none;" id="alternatif5" name="alternatif[5]">
                    @foreach($alternatifs as $bahan)
                    <option value="{{ $bahan->id }}">{{ $bahan->nama_sederhana }}</option>
                    @endforeach
                  </select>
                  @if($edit->alternatif6==NULL)
                  <button class="btn btn-success btn-sm" id="t6" type="button"><i class="fa fa-plus"></i></button>
                  <button class="btn btn-danger btn-sm" id="k5" type="button"><i class="fa fa-minus"></i></button>
                  @endif
                </td>
                @endif

                
                @if($edit->alternatif6!=NULL)
                <td>
                  <label for="" class="control-label">Alternatif 6</label><br>
                  <select class="bahan3 form-control" style="width:230px;display:none;" id="alternatif6" name="alternatif[6]">
                    <option value="NULL">-> Not Selected <-</option>
                    @foreach($alternatifs as $bahan)
                    @if($bahan->nama_sederhana==$edit->alternatif6)
                    <option value="{{$bahan->id}}" selected>{{$edit->alternatif6}}</option>
                    @endif
                    <option value="{{ $bahan->id }}">{{ $bahan->nama_sederhana }}</option>
                    @endforeach
                  </select>
                  @if($edit->alternatif7==NULL)
                  <button class="btn btn-success btn-sm" id="t7" type="button"><i class="fa fa-plus"></i></button>
                  @endif
                </td>
                @else
                <td class="A6" style="display:none">
                  <label for="" class="control-label">Alternatif 6</label><br>
                  <select class="bahan3 form-control" style="width:230px;display:none;" id="alternatif6" name="alternatif[6]">
                    @foreach($alternatifs as $bahan)
                    <option value="{{ $bahan->id }}">{{ $bahan->nama_sederhana }}</option>
                    @endforeach
                  </select>
                  @if($edit->alternatif7==NULL)
                  <button class="btn btn-success btn-sm" id="t7" type="button"><i class="fa fa-plus"></i></button>
                  <button class="btn btn-danger btn-sm" id="k6" type="button"><i class="fa fa-minus"></i></button>
                  @endif
                </td>
                @endif

                
                @if($edit->alternatif7!=NULL)
                <td>
                  <label for="" class="control-label">Alternatif 7</label><br>
                  <select class="bahan3 form-control" style="width:230px;display:none;" id="alternatif7" name="alternatif[7]">
                    <option value="NULL">-> Not Selected <-</option>
                    @foreach($alternatifs as $bahan)
                    @if($bahan->nama_sederhana==$edit->alternatif7)
                    <option value="{{$bahan->id}}" selected>{{$edit->alternatif7}}</option>
                    @endif
                    <option value="{{ $bahan->id }}">{{ $bahan->nama_sederhana }}</option>
                    @endforeach
                  </select>
                </td>
                @else
                <td class="A7" style="display:none">
                  <label for="" class="control-label">Alternatif 7</label><br>
                  <select class="bahan3 form-control" style="width:230px;display:none;" id="alternatif7" name="alternatif[7]">
                    @foreach($alternatifs as $bahan)
                    <option value="{{ $bahan->id }}">{{ $bahan->nama_sederhana }}</option>
                    @endforeach
                  </select>
                  <button class="btn btn-danger btn-sm" id="k7" type="button"><i class="fa fa-minus"></i></button>
                </td>
                @endif
              </tr>
              @endforeach
            </table>
          <label style="color:red">* select "-> Not Selected <-" to delete alternatif</label>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="row">
              <div class="col-md-6">
                <input type="hidden" id="c"  name="c" value="{{ $count_alternatif }}" /><br>
                {{ csrf_field()}}
                {{ method_field('PATCH')}}
                @foreach($for as $for)
                <a type="button" class="btn btn-danger btn-sm" href="{{route('step2',[$for->workbook_id,$for->id])}}"><i class="fa fa-ban"></i> Cencel</a>                
                <button type="submit" class="btn btn-info btn-sm" onclick="return confirm('Save Data ?')"><i class="fa fa-edit"></i> Save</button>
                @endforeach
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
            $('#alternatif5').empty();
            $('#alternatif6').empty();
            $('#alternatif7').empty();

            $('#alternatif').append('<option value="0" disabled selected> Pilih Alternatif  </option>');
            $('#alternatif2').append('<option value="0" disabled selected> Pilih Alternatif 2</option>');
            $('#alternatif3').append('<option value="0" disabled selected> Pilih Alternatif 3</option>');
            $('#alternatif4').append('<option value="0" disabled selected> Pilih Alternatif 4</option>');
            $('#alternatif5').append('<option value="0" disabled selected> Pilih Alternatif 5</option>');
            $('#alternatif6').append('<option value="0" disabled selected> Pilih Alternatif 6</option>');
            $('#alternatif7').append('<option value="0" disabled selected> Pilih Alternatif 7</option>');

            $.each(data, function(key, value){
              $('#alternatif').append('<option value="'+ key +'">' + value + '</option>');
              $('#alternatif2').append('<option value="'+ key +'">' + value + '</option>');
              $('#alternatif3').append('<option value="'+ key +'">' + value + '</option>');
              $('#alternatif4').append('<option value="'+ key +'">' + value + '</option>');
              $('#alternatif5').append('<option value="'+ key +'">' + value + '</option>');
              $('#alternatif6').append('<option value="'+ key +'">' + value + '</option>');
              $('#alternatif7').append('<option value="'+ key +'">' + value + '</option>');
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
        $('#alternatif5').empty();
        $('#alternatif6').empty();
        $('#alternatif7').empty();
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
	$('#alternatif5').select2();
	$('#alternatif6').select2();
	$('#alternatif7').select2();

	$(document).ready(function(){
    $('#submitbahan').submit(function () {
			// Get the c
			var c = $('#c').val();
			var bahanbaku = $('#prioritas').val();
			var alternatif = $('#alternatif').val();
			var alternatif2 = $('#alternatif2').val();
			var alternatif3 = $('#alternatif3').val();
			var alternatif4 = $('#alternatif4').val();
			var alternatif2 = $('#alternatif5').val();
			var alternatif3 = $('#alternatif6').val();
			var alternatif4 = $('#alternatif7').val();

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
      else if(c === '5'){
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
				if(alternatif5 === ''){
					alert('Alternatif 5 Tidak Boleh Kosong');
					return false;
				}
    	}
		});
 
		$("#xx").click(function(e) {
				$('#add').hide();
		});

    $('.A7').hide();
    $('.A6').hide();
    $('.A5').hide();
    $('.A4').hide();
    $('.A3').hide();
    $('.A2').hide();
    $('.A1').hide();
    
    $("#k7").click(function(e) {
      $('.A7').hide();
      $('#k6').show();
      $("#t7").show();
      $('#c').val(6);
    });

    $("#k6").click(function(e) {
      $('.A6').hide();
      $('#k5').show();
      $("#t6").show();
      $('#c').val(5);
    });

    $("#k5").click(function(e) {
      $('.A5').hide();
      $('#k4').show();
      $("#t5").show();
      $('#c').val(4);
    });

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

    $("#t7").click(function(e) {
      $('.A7').show();
      $('#k6').hide();
      $("#t7").hide();
      $('#c').val(7);
  	});

    $("#t6").click(function(e) {
      $('.A6').show();
      $('#k5').hide();
      $("#t6").hide();
      $('#c').val(6);
  	});

    $("#t5").click(function(e) {
      $('.A5').show();
      $('#k4').hide();
      $("#t5").hide();
      $('#c').val(5);
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