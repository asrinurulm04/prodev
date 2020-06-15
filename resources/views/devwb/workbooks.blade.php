@extends('devwb.tempwb')
@section('title', 'Workbook')
@section('judulnya', 'WORKBOOK LIST')
@section('content')            

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
    
{{-- <div class="col-md-12">
	<div class="card">
    <div  style="margin:20px">
      <table style="font-size:16px;">
        <tbody>
          <tr>
            <td colspan="2"><i class="fa fa-user"></i> {{ Auth::user()->name }}</td>
          </tr>
          <tr>
            <td colspan="2"><i class="fa fa-angle-double-right"></i> {{ Auth::user()->departement->dept }}</td>
          </tr>
          <tr>
            <td colspan="2"><i class="fa fa-angle-double-right"></i> {{ Auth::user()->role->namaRule }}</td>
          </tr>
          <tr>
          	<td><i class="fa fa-angle-double-right"></i> Total Project</td>
          	<td>{{ $cw }}</td>
          </tr>
          <tr>
            <td colspan="2"><button class="btn project btn-block" data-toggle="modal" data-target="#NW"><i class="fa fa-plus-circle"></i> Project Baru</button></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div> --}}

<div class="col-lg-12 col-xl-12">
  <div class="card">
    <div class="card-header">
      <h5>WorkBook</h5>
    </div>
    <div class="card-block" >
      <div class="row" style="margin:20px"> 
        <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#NW"><i class="fa fa-plus-circle"></i> Project Baru</button>
				<div style="overflow-x: scroll;" class="col-lg-12 col-xl-12">
					<table class="table" id="Table">
            <thead>
              <tr style="font-size: 12px;font-weight: bold; color:black;background-color: rgb(78, 205, 196, 0.5);">
                <th>No</th>                            
                <th>Nama Project</th>  
                <th>No PKP</th>
                <th>Jenis</th>
                <th>Revisi</th> 
                <th>Deskripsi</th>                           
                <th>Status</th>
                <th>Total Versi</th>
                <th>Pesan</th>                                  
                <th>__Action__</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($allproject as $workbook)
              <tr style="font-size: 13px;background-color: white;">
              	<td>{{ ++$no }}</td>                            
              	<td>{{ $workbook['nama_project']}}</td>
              	<td>{{ $workbook['NO_PKP'] }}</td>
              	<td>
                	@if ($workbook['jenis'] == 'baru')
                	<span class="label label-info">Baru</span> 
                	@else
                	<span class="label label-warning">Revisi</span> 
                	@endif
              	</td>                                                    
              	<td>{{ $workbook['revisi'] }}</td>          
              	<td>{{ $workbook['deskripsi'] }}</td>  
              	<td>
                  @if ($workbook['status'] == 'proses')
                  	<span class="label label-warning">Proses</span>                        
                  @endif
                  @if ($workbook['status'] == 'selesai')
                    <span class="label label-success">Approved</span>                        
                  @endif 
                  @if ($workbook['status'] == 'batal')
                    <span class="label label-warning">Batal</span>                        
                  @endif
                  @if ($workbook['status'] == '')
                  	<span class="label label-info">Tidak Ada</span>                        
                  @endif 
                </td>    
                <td>{{ $workbook['jv'] }}</td>
                <td>
                  <span class="badge bg-info">{{ $workbook['pt'] }}</span>
                  <span class="badge bg-important">{{ $workbook['pm'] }}</span>
                </td>                         
                <td>
                  {{csrf_field()}}
                  <a class="btn btn-primary btn-sm" href="{{ route('showworkbook',$workbook['id']) }}"><i class="fa fa-edit"></i></a>
                  @if ($workbook['status'] != 'proses')
                  <a class="btn btn-danger btn-sm" onclick="return confirm('Hapus Project ?')" href="{{ route('deleteworkbook',$workbook['id']) }}"><i class="fa fa-trash"></i></a> 
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
				</div>
      </div>
    </div>
  </div> 
</div>            

<div class="modal fade" id="NW" tabindex="-1" role="dialog" aria-labelledby="NWModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Workbook Baru</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
				<form class="cmxform form-horizontal style-form" id="new" method="POST" action="{{ route('newworkbook') }}">
        {{-- hidden--}}
        <input class="form-control " id="user" name="user" type="hidden" value="{{ Auth::user()->id }}"/>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        {{-- start --}}
        <label class="control-label">Nama Project</label>
        <input class="form-control " id="nama" name="nama" type="text" required/>
        <label class="control-label">Mandatory Requirement</label>
        <input class="form-control " id="mnrq" name="mnrq" type="text" required/>
        <label class="control-label">No.PKP</label>
        <input class="form-control " id="pkp" name="pkp" type="text"/>
        <div class="row">
          <div class="col-md-4">
            <label for="revisi" class="control-label">Jenis Formula</label><br>
            <select class="form-control edit" id="jenis" name="jenis">
            	<option value="baru">Baru</option>
              <option value="revisi">Revisi</option>
            </select>
          </div>
          <div class="col-md-4">
            <label for="revisi" class="control-label">Revisi</label>
            <input class="form-control edit" id="revisi" name="revisi" type="text" />
          </div>                    
        </div>
        <div class="row">
          <div class="col-md-4">
            <label class="control-label">Jenis Produk</label><br>
            <select class="form-control" id="jm" name="jm" style="width:240px">
            	<option disabled selected>Pilih Jenis Makanan</option>
            	@foreach($jms as $jm)
            	<option value="{{ $jm->id }}">{{ $jm->jenis_makanan }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="row">
            <div class="col-md-4">
              <label class="control-label">Brand</label><br>
              <select class="form-control" id="brand" name="brand" style="width:240px">
              	<option value="">Pilih Brand</option>
              	@foreach($brands as $brand)
                <option value="{{ $brand->id }}">{{ $brand->brand }}</option>
              	@endforeach
              </select>
            </div>
            <div class="col-md-4">
              <label class="control-label">SubBrand</label><br>
              <select class="form-control" id="subbrand" name="subbrand" style="width:240px">
                <option value="">Pilih SubBrand</option>
              </select>
            </div>
        </div>
        <label class="control-label">Target Konsumen</label><br>
        <input class="form-control " id="tarkon" name="tarkon" type="text" required/>
        <i><h6>*) Diisi Sesuai PKP</h6></i>
        <label class="control-label">Deskripsi</label>
        <textarea class="form-control " rows="4" id="deskripsi" name="deskripsi" type="text"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle"></i> ADD</button>
      </div>
      </form>
    </div>
  </div>
</div>

@endsection

@section('s')
<script type="text/javascript">
	$('#brand').select2();
	$('#subbrand').select2();
	$('#jm').select2();

	$(document).ready(function(){
    $('#jm').on('change', function(){
      var myId = $(this).val();
      if(myId){
        $.ajax({
          url: '{{URL::to('getBatasMax')}}/'+myId,
          type: "GET",
          dataType: "json",
          beforeSend: function(){
            $('#loader').css("visibility", "visible");
          },

          success:function(data){
            $('#batasmax').html(data);                                
          },
          complete: function(){
            $('#loader').css("visibility","hidden");
          }
        });
      }
      else{
        $('#batasmax').empty();
      }           
    });

    // Get Subbrand
    $('#brand').on('change', function(){
      var myId = $(this).val();
      if(myId){
        $.ajax({
          url: '{{URL::to('getSubbrand')}}/'+myId,
          type: "GET",
          dataType: "json",
          beforeSend: function(){
            $('#loader').css("visibility", "visible");
          },

          success:function(data){
            $('#subbrand').empty();
              $.each(data, function(key, value){
                $('#subbrand').append('<option value="'+ key +'">' + value + '</option>');
              });                                
          },
        	complete: function(){
            $('#loader').css("visibility","hidden");
        	}
        });
      }
      else{
        $('#subbrand').empty();
      }           
    });
	});
</script>
@endsection