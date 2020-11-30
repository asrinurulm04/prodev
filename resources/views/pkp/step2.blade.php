@extends('formula.tempformula')
@section('title', 'Edit Formula')
@section('judul', 'Edit Formula')
@section('content')

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
    /* color: rgb(51, 122, 183); */
	}
</style>

<div class="row">
  @include('formerrors')
  <div class="col-md-4"></div>
  <div class="col-md-7">
    <div class="tabbable">
      <ul class="nav nav-tabs wizard">
        <li class="active"><a href="{{ route('step1',[ $idfor, $idf]) }}"><span class="nmbr">1</span>Information</a></li>
        <li class="completed"><a href="{{ route('step2',[ $idfor, $idf]) }}"><span class="nmbr">2</span>Penyusunan</a></li>
        <li class="active"><a href="{{ route('summarry',[ $idfor, $idf]) }}"><span class="nmbr">3</span>Summary</a></li>
      </ul>
    </div>
  </div>
</div>

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

@php $c_mybase = 1; @endphp

<div class="row">
  <div class="col-md-12 col-sm-12 content-panel" >
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4><i class="fa fa-folder-open"></i> Summary</h4>
      </div>
      <div class="panel-body">
        <div class="col-md-4">
          <table>
            <tr>
              <th>Nama Produk</th><td>&nbsp; : {{ $formula->Workbook->datapkpp->project_name }}</td>                    
            </tr>
            <tr>
              <th>Versi</th><td>&nbsp; : {{ $formula->versi }}.{{ $formula->turunan }}</td>
            </tr>
            <tr>
              <th>PV</th><td>&nbsp; : {{ $formula->workbook->perevisi2->name }} </td>
            </tr>
          </table>
        </div>
        <div class="col-md-4">
          <table>
            <tr>
              <th>Target Serving</th><td>&nbsp; : 
              @if($formula->satuan=='Ml')
              {{ $formula->serving_size }} ({{$formula->serving_size / $formula->berat_jenis}} {{ $formula->satuan }})
              @else
              {{ $formula->serving_size }} {{$formula->satuan}}
              @endif</td>
            </tr>
            <tr>
              <th>Jumlah Batch</th><td>&nbsp; : {{ $formula->batch }} Gram</td>
            </tr>
            <tr>                    
              <th>Jumlah Serving</th><td>&nbsp; : {{ $formula->serving }} Gram</td>
            </tr>
          </table>
        </div>
        <div class="col-md-4">
          <table>
            <tr>
              <th>Status PV</th><td>&nbsp; :
                @if ($formula->vv == 'proses')
                <span class="label label-warning">Proses</span>                        
                @endif
                @if ($formula->vv == 'tidak')
                <span class="label label-danger">Rejected</span>                        
                @endif 
                @if ($formula->vv == 'ya')
                <span class="label label-success">Approved</span>                        
                @endif 
                @if ($formula->vv == '')
                <span class="label label-primary">Belum Diajukan</span>                        
                @endif                                                              
              </td>                    
            </tr>
            <tr>
              <th>Status Feasibility</th><td>&nbsp; :
                @if ($formula->status_fisibility == 'proses')
                <span class="label label-warning">Proses</span>                        
                @endif
                @if ($formula->status_fisibility == 'not_approved')
                <span class="label label-danger">Rejected</span>                        
                @endif 
                @if ($formula->status_fisibility == 'approved')
                <span class="label label-success">Approved</span>                        
                @endif 
                @if ($formula->status_fisibility == '')
                <span class="label label-primary">Belum Diajukan</span>                        
                @endif    
              </td>                    
            </tr>
            <tr>
              <th>Status Nutfact</th><td>&nbsp; :  
                @if ($formula->status_nutfact == 'proses')
                  <span class="label label-warning">Proses</span>                        
                @endif
                @if ($formula->status_nutfact == 'not_approved')
                  <span class="label label-danger">Rejected</span>                        
                @endif 
                @if ($formula->status_nutfact == 'approved')
                  <span class="label label-success">Approved</span>                        
                @endif 
                @if ($formula->status_nutfact == '')
                  <span class="label label-primary">Belum Diajukan</span>                        
                @endif  
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>  

<div class="row">
  <div class="col-md-12 col-sm-12 content-panel" >
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4><i class="fa fa-plus"></i> Tambah Bahan Baku</h4>
      </div>
      <div class="panel-body">
        <div class="row">
          <form id="submitbahan" method="POST" action="{{ route('step2insert',$idf) }}">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <table style="border-spacing: 10px;border-collapse: separate;">
            	<tr>
                <td>
                  @if($formula->kategori=='granulasi')
                  <input type="hidden" name="cgranulasi" value="ya">
                  @elseif($formula->kategori=='premix')
                  <input type="hidden" name="cpremix" value="ya">
                  @endif
									<label for="" class="control-label">Bahan Baku</label><br>
									<select class="bahan form-control" style="width:190px;" id="prioritas" name="prioritas">
										<option value="" disabled selected>Pilih BahanBaku</option>
										@foreach($bahans as $bahan)
										<option value="{{ $bahan->id }}" {{ old('prioritas') == $bahan->id ? 'selected' : '' }}>{{ $bahan->nama_sederhana }}( {{$bahan->nama_bahan}} )</option>
										@endforeach
									</select>
									<button class="btn btn-primary btn-sm" id="t1" type="button"><i class="fa fa-plus"></i></button>
                </td>
         
                <td class="A1" style="display:none">
									<label for="" class="control-label">Alternatif 1</label><br>
									<select class="bahan form-control" style="width:190px;display:none;" id="alternatif" name="alternatif[1]">
										<option value="" disabled selected>Pilih Alternatif 1</option>                                
									</select>
									<button class="btn btn-primary btn-sm" id="t2" type="button"><i class="fa fa-plus"></i></button>
									<button class="btn btn-danger btn-sm" id="k1" type="button"><i class="fa fa-minus"></i></button>
                </td>

                <td class="A2" style="display:none">
									<label for="" class="control-label">Alternatif 2</label><br>
									<select class="bahan form-control" style="width:190px;display:none;" id="alternatif2" name="alternatif[2]">
										<option value="" disabled selected>Pilih Alternatif 2</option>                                
									</select>
									<button class="btn btn-primary btn-sm" id="t3" type="button"><i class="fa fa-plus"></i></button>
									<button class="btn btn-danger btn-sm" id="k2" type="button"><i class="fa fa-minus"></i></button>
                </td>

                <td class="A3" style="display:none">
									<label for="" class="control-label">Alternatif 3</label><br>
									<select class="bahan form-control" style="width:190px;display:none;" id="alternatif3" name="alternatif[3]">
										<option value="" disabled selected>Pilih Alternatif 3</option>                                
									</select>
									<button class="btn btn-primary btn-sm" id="t4" type="button"><i class="fa fa-plus"></i></button>
									<button class="btn btn-danger btn-sm" id="k3" type="button"><i class="fa fa-minus"></i></button>
                </td>
              </tr>

              <tr>
                <td class="A4" style="display:none">
									<label for="" class="control-label">Alternatif 4</label><br>
									<select class="bahan form-control" style="width:190px;display:none;" id="alternatif4" name="alternatif[4]">
										<option value="" disabled selected>Pilih Alternatif 4</option>                                
									</select>
									<button class="btn btn-primary btn-sm" id="t5" type="button"><i class="fa fa-plus"></i></button>
									<button class="btn btn-danger btn-sm" id="k4" type="button"><i class="fa fa-minus"></i></button>
                </td>
 
                <td class="A5" style="display:none">
									<label for="" class="control-label">Alternatif 5</label><br>
									<select class="bahan form-control" style="width:190px;display:none;" id="alternatif5" name="alternatif[5]">
										<option value="" disabled selected>Pilih Alternatif 5</option>                                
									</select>
									<button class="btn btn-primary btn-sm" id="t6" type="button"><i class="fa fa-plus"></i></button>
									<button class="btn btn-danger btn-sm" id="k5" type="button"><i class="fa fa-minus"></i></button>
                </td>

                <td class="A6" style="display:none">
									<label for="" class="control-label">Alternatif 6</label><br>
									<select class="bahan form-control" style="width:190px;display:none;" id="alternatif6" name="alternatif[6]">
										<option value="" disabled selected>Pilih Alternatif 6</option>                                
									</select>
									<button class="btn btn-primary btn-sm" id="t7" type="button"><i class="fa fa-plus"></i></button>
									<button class="btn btn-danger btn-sm" id="k6" type="button"><i class="fa fa-minus"></i></button>
                </td>

                <td class="A7" style="display:none">
									<label for="" class="control-label">Alternatif 7</label><br>
									<select class="bahan form-control" style="width:180px;display:none;" id="alternatif7" name="alternatif[7]">
									  <option value="" disabled selected>Pilih Alternatif 7</option>                                
									</select>
									<button class="btn btn-danger btn-sm" id="k7" type="button"><i class="fa fa-minus"></i></button>
                </td>
              </tr>
            </table>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="row">
              <div class="col-md-2">
                <label for="" class="control-label">Per Serving(Gram)</label>
                <input type="number" step=any id="per_serving"  name="per_serving" placeholder="0" class="form-control" value="{{ old('per_serving') }}" required />
                <input type="hidden" id="c"  name="c" value="0"/> 
              </div>
              @if ($mybase == 0)
              <div class="col-md-2"> 
                <label for="" class="control-label">Per Batch(Gram)</label>
                <input type="number" step=any id="per_batch" name="per_batch" placeholder="0" class="form-control" value="{{ old('per_batch') }}" />                    
              </div>
              @endif
              @if ($mybase == 0)
              <div class="col-md-2"><br>
                <input type="checkbox" value="yes" name="cbase" id="cbase">
                <label for="cbase" >Jadikan Base Perhitungan</label>                                        
              </div>                                                                 
              @endif  
              <!-- <div class="col-md-2"><br>
                <input type="radio" value="yes" name="cgranulasi" id="cgranulasi"><label for="cgranulasi" >Granulasi</label> &nbsp &nbsp
                <input type="radio" value="yes" name="cpremix" id="cpremix"><label for="cpremix" >Premix</label>
              </div>                              -->
              <div class="col-md-6"><br>
              	{{ csrf_field()}}
              	<input type="submit" class="btn btn-primary btn-sm" value="+ Masukan Bahan"></td>
              </div>
            </div>    
          </div>
        </div>
        </form>
			</div>
		</div>
  </div>
</div>

<div class="row">
  <div class="col-md-12 col-sm-12 content-panel" >
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4><i class="fa fa-edit"></i> Penyusunan Formula</h4>
      </div>
      <div class="panel-body">
        {{-- start --}}
        <div>
          <div class="row">      
            <div class="col-md-2 col-sm-2">
              <div style="margin-left:10px">
              </div>                                    
            </div>                          
            <div class="col-md-9">                                                                        
              <div style="float:right">
                @if ($mybase != 0)
                <a class="btn btn-primary btn-sm" type="button" id="buttonformsavescale"><i class="fa fa-save"></i> Save Scale</a>
                <a class="btn btn-warning btn-sm" type="button" id="buttonformcheckscale"><i class="fa fa-eye"></i> Check Scale</a>
                @endif
                @if ($mybase != 0)
                <a type="button" class="btn btn-dark btn-sm" id="buttongantibase"><i class="fa fa-exchange"></i> Ganti Base</a>
                <a type="button" class="btn btn-danger btn-sm" href="{{ route('hapusall',$idf) }}" onclick="return confirm('Hapus Data ?')"><i class="fa fa-times"></i> Delete Data</a>
                @endif
              </div>                                    
            </div>
            <div class="col-md-1">
              {{-- Method --}}
              <select class="form-control" id="scale_option" onChange="SO(this.id)">
                <option value="gram">G</option>
              </select>                                        
              {{-- History--}}
              <input type="hidden" id="history_target_scale" placeholder="history_target_scale">                                               
              {{-- end History --}}
              {{-- end Method --}}
            </div>                                
          </div>

          @if($ada<1)
            <h3>Data Masih Kosong !</h3>
            @php $no = 0; @endphp  
          @endif

          @if($ada>0) <br>
          <table class="table table-sm table-bordered">
            <thead>
              <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                <th style="width:5%" class="text-center">#</th>                        
                <th style="width:25%">Nama Sederhana</th>      
                <th style="width:10%"><i class="fa fa-edit"></i>PerServing (gram)</th> 
                <th style="width:10%">PerBatch  (gram)</th>
                <th style="width:10%;"><i class="fa fa-plus"></i>ScaleServing</th>
                <th style="width:10%;"><i class="fa fa-plus"></i>ScaleBatch</th>
                <th style="width:8%;">BasePerhitungan</th>
              </tr>
            </thead>
            <tbody>
              {{-- Bahan Bukan Granulasi --}}                                    
              @foreach($scalecollect as $fortail)
              @if($fortail['granulasi'] == 'tidak')                                                                       
              <tr>
                @php
                  $no = $fortail['no'];
                  $rowspan = $ada;
                @endphp                      
                <td class="text-center">
                  <a type="button" href=""><i class="fa fa-edit" ></i></a>
                  <a type="button" onclick="return confirm('Hapus Bahan Baku ?')" href="{{ route('step2destroy',['id'=>$fortail['id'],'vf'=>$idf]) }}"><i class="fa fa-trash"></i></a>
                </td>
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
                {{-- ID Fortail--}}
                <input type="hidden" id="ftid{{$no}}" name="ftid[{{$no}}]" value="{{$fortail['id']}}">
                {{-- Granulasi --}}
                <input type="hidden" id="granulasi{{$no}}" value="{{ $fortail['granulasi'] }}">
                {{-- For Reset and Check what change --}}
                <input type="hidden" placeholder="0" id="rServing{{$no}}"   value="{{ $fortail['per_serving'] }}">
                <input type="hidden" placeholder="0" id="rBatch{{$no}}"     value="{{ $fortail['per_batch'] }}">
                <input type="hidden" placeholder="0" id="rsServing{{$no}}"  value="{{ $fortail['scale_serving'] }}">
                <input type="hidden" placeholder="0" id="rsBatch{{$no}}"    value="{{ $fortail['scale_batch'] }}">

                  {{-- Akhir --}}
                <td><input type="number" placeholder="0" onkeyup="jServing(this.id)"  id="Serving{{$no}}"  value="{{ $fortail['per_serving'] }}"   name="Serving[{{ $no }}]"></td>
                <td><input type="number" placeholder="0" onkeyup="jBatch(this.id)"    id="Batch{{$no}}"    value="{{ $fortail['per_batch'] }}"     name="Batch[{{ $no }}]"></td>
                <td style="background-color:#ffffb3" ><input type="number" placeholder="0" onkeyup="jsServing(this.id)" id="sServing{{$no}}" value="{{ $fortail['scale_serving'] }}" name="sServing[{{$no}}]"></td>
                <td style="background-color:#ffffb3" ><input type="number" placeholder="0" onkeyup="jsBatch(this.id)"   id="sBatch{{$no}}"   value="{{ $fortail['scale_batch'] }}"   name="sBatch[{{$no}}]"></td>
                @if ($c_mybase == 1)
                <td class="base" style="background-color:#f2f2f2">
                  <input type="hidden" id="rBase" id="rBase" value="{{ $mybase }}">
                  X <input type="number" id="base" name="base" onkeyup="BASE(this.id)"  value="{{ $mybase }}">
                </td>
                @php $c_mybase = 2; @endphp 
                @endif
              </tr>
              @endif                        
              @endforeach                                                                         

              {{-- Bahan Granulasi --}}  
              @if($granulasi > 0 )
              @php $rowspan = $ada + 1; @endphp

              <tr style="background-color:#eaeaea;color:red">
                <td colspan="7">Granulasi &nbsp;
                  % <input type="number" id="gp" placeholder="0" disabled>  
                </td>                                            
              </tr>            
              @foreach($scalecollect as $fortail)
              @if($fortail['granulasi'] == 'ya')                                                                       
              <tr>
                @php $no = $fortail['no']; @endphp                      
                <td class="text-center">
                  <a type="button" href="" title="edit"><i class="fa fa-edit" ></i></a>
                  <a type="button" onclick="return confirm('Hapus Bahan Baku ?')" href="{{ route('step2destroy',['id'=>$fortail['id'],'vf'=>$idf]) }}"><i class="fa fa-trash"></i></a>
                </td>
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
                {{-- ID Fortail--}}
                <input type="hidden" id="ftid{{$no}}" name="ftid[{{$no}}]" value="{{$fortail['id']}}">
                {{-- Granulasi --}}
                <input type="hidden" id="granulasi{{$no}}" value="{{ $fortail['granulasi'] }}">
                {{-- For Reset and Check what change --}}
                <input type="hidden" placeholder="0" id="rServing{{$no}}" value="{{ $fortail['per_serving'] }}">
                <input type="hidden" placeholder="0" id="rBatch{{$no}}" value="{{ $fortail['per_batch'] }}">
                <input type="hidden" placeholder="0" id="rsServing{{$no}}" value="{{ $fortail['scale_serving'] }}">
                <input type="hidden" placeholder="0" id="rsBatch{{$no}}" value="{{ $fortail['scale_batch'] }}">

                {{-- Akhir --}}
                <td><input type="number" placeholder="0" onkeyup="jServing(this.id)"  id="Serving{{$no}}"  value="{{ $fortail['per_serving'] }}"   name="Serving[{{ $no }}]"></td>
                <td><input type="number" placeholder="0" onkeyup="jBatch(this.id)"    id="Batch{{$no}}"    value="{{ $fortail['per_batch'] }}"     name="Batch[{{ $no }}]"></td>
                <td style="background-color:#ffffb3"><input type="number" placeholder="0" onkeyup="jsServing(this.id)" id="sServing{{$no}}" value="{{ $fortail['scale_serving'] }}" name="sServing[{{$no}}]"></td>                                        
                <td style="background-color:#ffffb3"><input type="number" placeholder="0" onkeyup="jsBatch(this.id)"   id="sBatch{{$no}}"   value="{{ $fortail['scale_batch'] }}"   name="sBatch[{{$no}}]"></td>
                @if ($c_mybase == 1)
                <td class="base" style="background-color:#f2f2f2">
                  <input type="hidden" id="rBase" id="rBase" value="{{ $mybase }}">
                  X <input type="number" id="base" name="base" value="{{ $mybase }}">
                </td>
                @php $c_mybase = 2;@endphp 
                @endif
              </tr>
              @endif                                                                
              @endforeach 
              @endif

              

              <tr class="tototal">
                {{-- For Reset Jumlah --}}
                <input type="hidden" id="rjsServing" value="">
                <td colspan="2">Jumlah</td>
                <input type="hidden" id="rjsBatch" value="">
                <td><input type="number" placeholder="0" id="jServing" disabled></td>
                <td><input type="number" placeholder="0" id="jBatch" disabled></td>
                <td ><input onkeyup="cjsServing(this.id)" type="number" placeholder="0" id="jsServing" name="jsServing"></td>
                <td ><input onkeyup="cjsBatch(this.id)" type="number" placeholder="0" id="jsBatch" name="jsBatch"></td>
                <td></td>
              </tr>

              <tr class="toserving">
                <td colspan="2">Target Serving</td>
                <td style="background-color:#f2f2f2;color:black;"><input type="number" id="tServing" value="{{ $target_serving }}" disabled></td>
                <td colspan="4"></td>
              </tr>

            </tbody>                            
          </table>
          <!-- Tambah Bahan Baru -->
          <!-- Tambah -->
          @endif 
          <div class="row">
            <div class="col-md-8">
              @if($ada==0)                                    
              <a type="button" class="btn btn-warning btn-sm" href="{{ route('getTemplate',[$idfor,$idf]) }}"><i class="fa fa-download"></i> Import Template Formula</a>        
              @else
              <a class="btn btn-success btn-sm" href="{{ route('getTemplate',[$idfor,$idf]) }}" type="button" id="buttonformcheckscale"><i class="fa fa-eye"></i> Import Granulasi/Premix</a>
              <a class="btn btn-primary btn-sm" type="button" id="buttonformsavechanges"><i class="fa fa-save"></i> Save Serving</a>                            
              @endif                                                      
              <a class="btn btn-danger btn-sm" href="{{ route('showworkbook',$formula->workbook_id) }}"><i class="fa fa-ban"></i> Cencel</a>
            </div>
            <div class="col-md-4">
              <div>
                @if($ada>0)
                  @if($sesuai_target != 0)                                    
                  <div class="alert alert-danger" style="color:white">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    @if($sesuai_target > 0)
                    Number of Serving Exceeds Target ({{ $sesuai_target }}) !
                    @endif
                    @if($sesuai_target < 0)
                    Number of Serving Less Than Target ({{ $sesuai_target }}) !
                    @endif
                  </div>
                  @endif
                @endif
              </div>
            </div>
          </div>
        </div>  
        <hr>
        <form class="form-horizontal form-label-left" method="POST" action="{{ route('updatenote',[$formula->id,$formula->workbook_id]) }}">
        <div class="row">
          <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-12">Note RD <br><font style="color:red;font-size:11px">* max 200 character</font></label>
            <div class="col-md-4 col-sm-4 col-xs-12">
              <textarea name="keterangan" id="keterangan" value="{{ $formula->catatan_rd }}" maxlength="200" placeholder="max 200 character" class="col-md-12 col-sm-12 col-xs-12" rows="5">{{ $formula->catatan_rd }}</textarea>
            </div>
            <label class="control-label col-md-1 col-sm-1 col-xs-12">Note Formula</label>
            <div class="col-md-4 col-sm-4 col-xs-12">
              <textarea name="formula" id="formula" value="{{ $formula->note_formula }}" class="col-md-12 col-sm-12 col-xs-12" rows="5">{{ $formula->note_formula }}</textarea>
            </div>
            <button type="submit" class="btn status btn-primary btn-sm"><li class="fa fa-check"></li> Submit Note</button>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            {{ method_field('PATCH') }}
          </div>
          @if($formula->catatan_manager!=NULL)
          <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-12">Note Manager</label>
            <div class="col-md-10 col-sm-10 col-xs-12">
              <textarea name="formula" id="formula" disabled value="{{ $formula->catatan_manager }}" class="col-md-12 col-sm-12 col-xs-12" rows="2">{{ $formula->catatan_manager }}</textarea>
            </div>
          </div>
          @endif
        </div>
        </form>       
      </div>
    </div>
  </div>

  @php
    $no = $ada;
    if($ada < 1){
      $rowspan = 1;
    }
  @endphp

	<div class="row panel" hidden>    
  	<div class="row" style="margin:20px">
      <div class="col-md-2" >
        <form action="{{ route('gantibase',$idf) }}" id="formgantibase" method="POST">
          {{-- Form Ganti Base --}}
          <label for="thebase">Ganti Base</label><br>
          <input type="number" id="thebase" name="thebase" placeholder="0" value="{{ $mybase }}">
          {{ csrf_field()}}
        </form>
      </div>
      <div class="col-md-2">
        <form action="{{ route('cekscale',[ $idfor, $idf]) }}" id="formcheckscale" method="POST">
          {{-- Form Check Scale --}}
          <label>Check Scale</label><br>
          <input type="text" id="scale_option2" name="scale_option" value="gram">
            <select id="scale_method" name="scale_method">
              <option id="Z" value="Z" selected>Belum Memilih</option>
              <option id="A" value="A">Jumlah Scale Serving</option>
              <option id="B" value="B">Scale Serving</option>
              <option id="C" value="C">Scale Batch</option>
              <option id="D" value="D">Jumlah Scale Batch</option>
            </select>
          <br><label for="thebase">target_scale</label><br>
          <input type="text" id="target_scale" name="target_scale" placeholder="0">
          <br><label for="thebase">FTID</label><br>
          <input type="number" id="target_number" name="target_number" placeholder="0">
          {{-- JumlahFortail --}}
          <br><label>Jumlah Fortail</label><br>
          <input type="number" name="jFortail" value="{{$ada}}">
          {{ csrf_field()}}
        </form>
      </div>
      <div class="col-md-8">
        {{-- form save scale --}}
        <form action="{{ route('savescale',$idf) }}" id="formsavescale" method="POST">
          <table class="table">
            <tbody>
              @foreach($scalecollect as $fortail)                                                                      
              <tr>
								<td>{{ $fortail['nama_sederhana'] }}</td>
								{{-- ID Fortail--}}
								<input type="hidden" name="ftid[{{ $fortail['no'] }}]" value="{{$fortail['id']}}">                               
								<td><input type="number" placeholder="0" value="{{ $fortail['scale_batch'] }}"   name="sBatch[{{ $fortail['no'] }}]"></td>
								<td><input type="number" placeholder="0" id="justcheckscale" value="{{ $fortail['scale_serving'] }}" name="sServing[{{ $fortail['no'] }}]"></td>                               
              </tr>                                                       
              @endforeach  
              <tr>
                <td colspan="3">
									{{-- JumlahFortail --}}
									<br><label>Jumlah Fortail</label><br>
									<input type="number" name="jFortail" value="{{$ada}}">
									{{ csrf_field()}}
                </td>
              </tr>
            </tbody>
          </table>                    
        </form>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <form action="{{ route('savechanges',$idf) }}" id="formsavechanges" method="POST">
          <table class="table">
            <tbody>
              @foreach($scalecollect as $fortail)                                                                      
              <tr>
								<td>{{ $fortail['nama_sederhana'] }}</td>
								{{-- ID Fortail--}}
								<input type="hidden" name="ftid[{{ $fortail['no'] }}]" value="{{$fortail['id']}}">                               
								<td><input type="number" placeholder="0" id="Serving2{{ $fortail['no'] }}"  value="{{ $fortail['per_serving'] }}"   name="Serving[{{ $fortail['no'] }}]"></td>                              
              </tr>                                                       
              @endforeach  
              <tr>
                <td colspan="3">
                  {{-- JumlahFortail --}}
									<br><label>Jumlah Fortail</label><br>
									<input type="number" name="jFortail" value="{{$ada}}">
									{{ csrf_field()}}
                </td>
              </tr>
            </tbody>
          </table>                    
        </form>
      </div>
    </div>
  </div>
</div>    


@endsection    

@section('s')
<script type="text/javascript">
  $(document).ready(function(){        
    // Hitung Jumlah Serving dan Batch dan Scale Batch dan Scale Serving
    var i = {{ $no }};
    var total  = 0;
    var total2 = 0;
    var tsb = 0;
    var tss = 0;
    var total_granulasi = 0;
    var total_premix = 0;

  	for(y=1;y<=i;y++){
      batch = parseFloat($('#Batch'+y).val());
      serving = parseFloat($('#Serving'+y).val());
      sBatch = parseFloat($('#sBatch'+y).val());                    
      sServing = parseFloat($('#sServing'+y).val());
      csBatch = $('#sBatch'+y).val();                    
      csServing = $('#sServing'+y).val();
      cgranulasi = $('#granulasi'+y).val();
      cpremix = $('#premix'+y).val();

      if(csBatch == ''){
        sBatch = 0;
      }
      if(csServing == ''){
        sServing = 0;
      }
                                                
      total   = total + batch;
      total2  = total2 + serving;
      tsb     = tsb + sBatch;
      tss     = tss + sServing;                                           

      if(cpremix == 'ya'){
        total_premix = total_premix + serving;
      } 
      if(cgranulasi == 'ya'){
        total_granulasi = total_granulasi + serving;
      }  
    }
    if(tsb == 0){
      tsb = '';
    }
    if(tss == 0){
      tss = '';
    }
    if(tsb != 0){
      tsb     = parseFloat(tsb.toFixed(5));
      tss     = parseFloat(tss.toFixed(5));
    }     
            
    $('#jBatch').val(total);
    $('#jServing').val(total2);
    $('#jsBatch').val(tsb);
    $('#jsServing').val(tss);
            
      // Hitung Persen Granulasi            
    var one_persen  = total2/100;
    total_persen    = total_granulasi / one_persen;
    total_persen    = parseFloat(total_persen.toFixed(2));
    total_persen_premix    = total_premix / one_persen;
    total_persen_premix    = parseFloat(total_persen_premix.toFixed(2)); 
    $('#gp').val(total_persen);                      
    $('#pr').val(total_persen_premix);    
  });

  // ONCHANGE SCALE OPTION
  function SO(myId){
    var so = $('#'+myId).val();
    $('#scale_option2').val(so);
  }
        
  // KEYUP BATCH
  function jBatch(myId){
    var urutan = myId.substring(5);
    var i = {{ $no }};
    var total= 0;
    for(y=1;y<=i;y++){
      batch = parseFloat($('#Batch'+y).val());
      cek_batch = $('#Batch'+y).val();
        if(cek_batch == ''){
          batch = 0;
        }
      total = total + batch;
    }
    $('#jBatch').val(total);
            
    x = $('#Batch'+urutan).val();
    y = $('#rBatch'+urutan).val();
    if(x != y ){
      $('#'+myId).css("border", "1px solid cyan");                
    }
    else{
      $('#'+myId).css("border", "");
    }
  }
        
  // KEYUP SERVING
  function jServing(myId){
    var urutan = myId.substring(7);
    var i = {{ $no }};
    var total= 0;
    for(y=1;y<=i;y++){
      serving = parseFloat($('#Serving'+y).val());
      cek_serving = $('#Serving'+y).val();
        if(cek_serving == ''){
          serving = 0;
        }
      total = total + serving;
      }
    $('#jServing').val(total);

    var x = parseFloat($('#Serving'+urutan).val());
    var y = parseFloat($('#rServing'+urutan).val());
    $('#Serving2'+urutan).val(x);
    if(x != y ){
      $('#'+myId).css("border", "1px solid cyan");                
    }
    else{
      $('#'+myId).css("border", "");
    }
  }

  // KEYUP SCALE BATCH
  function jsBatch(myId){
    var urutan = myId.substring(6);
    x = $('#sBatch'+urutan).val();
    y = $('#rsBatch'+urutan).val();
    if(x != y ){
      $('#'+myId).css("border", "1px solid cyan");
      // Get The Target
      $('#scale_method').val("C");
      var name = $('#'+myId).val();
      var ftid = $('#'+'ftid'+urutan).val();
      $('#target_scale').val(name);
      $('#target_number').val(ftid);
      //Checking History
      var history = $('#history_target_scale').val();
      if(history != myId){
        // Reset History
        history_target = $('#history_target_scale').val();
        history_value = $('#r'+history_target).val();
        $('#'+history_target).val(history_value);
        $('#'+history_target).css("border","");
        // Make New History
        $('#history_target_scale').val(myId);
      }
    }
    else{
      $('#'+myId).css("border", "");
      // Reset The Target
      $('#scale_method').val("Z");
      $('#target_scale').val('');
      $('#target_number').val('');
    }                               
  }
        
  // KEYUP SCALE SERVING
  function jsServing(myId){
    var urutan = myId.substring(8);
    x = $('#sServing'+urutan).val();
    y = $('#rsServing'+urutan).val();
    if(x != y ){
      $('#'+myId).css("border", "1px solid cyan");
      // Get The Target
      $('#scale_method').val("B");
      var name = $('#'+myId).val();
      var ftid = $('#'+'ftid'+urutan).val();
      $('#target_scale').val(name);
      $('#target_number').val(ftid);
      //Checking History
      var history = $('#history_target_scale').val();
      if(history != myId){
        // Reset History
        history_target = $('#history_target_scale').val();
        history_value = $('#r'+history_target).val();
        $('#'+history_target).val(history_value);
        $('#'+history_target).css("border","");
        // Make New History
        $('#history_target_scale').val(myId);
      }
    }
    else{
      $('#'+myId).css("border", "");
      // Reset The Target
      $('#scale_method').val("Z");
      $('#target_scale').val('');
      $('#target_number').val('');
    }
  }

  // KEYUP JUMLAH SCALE BATCH
  function cjsBatch(myId){
    x = $('#jsBatch').val();
    y = $('#rjsBatch').val();
    if(x != y ){
      $('#'+myId).css("border", "1px solid red");
      // Get The Target
      $('#scale_method').val("D");
      var name = $('#'+myId).val();
      $('#target_scale').val(name);
      $('#target_number').val("");
      //Checking History
      var history = $('#history_target_scale').val();
      if(history != myId){
        // Reset History
        history_target = $('#history_target_scale').val();
        history_value = $('#r'+history_target).val();
        $('#'+history_target).val(history_value);
        $('#'+history_target).css("border","");
        // Make New History
        $('#history_target_scale').val(myId);
      }    
    }
    else{
      $('#'+myId).css("border", "");
      // Reset The Target
      $('#scale_method').val("Z");
      $('#target_scale').val('');
      $('#target_number').val('');
    }
  }

  // KEYUP JUMLAH SCALE SERVING
  function cjsServing(myId){
  	x = $('#jsServing').val();
  	y = $('#rjsServing').val();
  	if(x != y ){
      $('#'+myId).css("border", "1px solid red");
      // Get The Target
      $('#scale_method').val("A");
      var name = $('#'+myId).val();
      $('#target_scale').val(name);
      $('#target_number').val("");
      //Checking History
      var history = $('#history_target_scale').val();
      if(history != myId){
        // Reset History
        history_target = $('#history_target_scale').val();
        history_value = $('#r'+history_target).val();
        $('#'+history_target).val(history_value);
        $('#'+history_target).css("border","");
        // Make New History
        $('#history_target_scale').val(myId);
      }
    }
    else{
      $('#'+myId).css("border", "");
      // Reset The Target
      $('#scale_method').val("Z");
      $('#target_scale').val('');
      $('#target_number').val('');
    }
  }

  // BASE PERHITUNGAN FUNCTION-----------------------------
  function BASE(myId){
    var thebase = $('#'+myId).val();
    $('#thebase').val(thebase);
    x = $('#'+myId).val();
    y = $('#rBase').val();
    if(x != y ){
      $('#'+myId).css("border", "1px solid cyan");
      var name = $('#'+myId).attr('name');                    
    }
    else{
      $('#'+myId).css("border", "");
    }
  }
  
  /* The Button */  
  $("#buttongantibase").click( function() {            
    if(confirm("Ganti Base Perhitungan?")){
      x = $('#base').val();
      y = $('#rBase').val();
      if(x != y ){
        $('#formgantibase').submit();
        return false;                  
      }
              else{
        alert('Maaf Base Belum Diganti');
        return false;
      }                
    }
          else{
      return false;
    }            
  });    

  // CHECK SCALE BUTTON ------------------------------
  $('#buttonformcheckscale').click( function(){
    if(confirm("Check Scale ?")){
      var check = $('#scale_method').val();
      if(check == 'Z'){
        alert('Anda Belum Memilih Target Scale');
        return false
              }
      else{
        $('#formcheckscale').submit();
        return false;
      }                
    }
    else{
      return false;
    }
  });

  // SAVE SCALE BUTTON ----------------        
  $('#buttonformsavescale').click( function(){
    if(confirm("Simpan Scale ?")){
    var check = $('#justcheckscale').val();
      if(check != ''){
        $('#formsavescale').submit();
        return false;
      }
      else{
        alert('Maaf Scale Kosong !');
        return false;
      }                   
    }
    else{
      return false;
    }
  });

  // FORM SAVE CHANGES ------
  $('#buttonformsavechanges').click( function(){
    if(confirm("Simpan Perubahan Serving ?")){
      $('#formsavechanges').submit();
      return false;               
    }
    else{
      return false;
    }
  });
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
    $('.base').attr('rowspan',{{$rowspan}});
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