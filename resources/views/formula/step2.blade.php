@extends('pv.tempvv')
@section('title', 'PRODEV|Edit Formula')
@section('content')

<div class="row">
  <div class="col-md-4"></div>
  <div class="col-md-7">
    <div class="tabbable">
      <ul class="nav nav-tabs wizard">
        @if($formula->workbook_id!=NULL) 
        <li class="active"><a href="{{ route('step1',[ $idfor, $idpkp,$idpro]) }}"><span class="nmbr">1</span>Information</a></li>
        <li class="completed"><a href="{{ route('step2',[ $idfor, $idpkp,$idpro]) }}"><span class="nmbr">2</span>Drafting</a></li>
        <li class="active"><a href="{{ route('summarry',[ $idfor, $idpkp,$idpro]) }}"><span class="nmbr">3</span>Summary</a></li>
        @elseif($formula->workbook_pdf_id!=NULL)
        <li class="active"><a href="{{ route('step1_pdf',[ $idfor, $idpkp]) }}"><span class="nmbr">1</span>Information</a></li>
        <li class="completed"><a href="{{ route('step2',[ $idfor,$idpkp,$idpro]) }}"><span class="nmbr">2</span>Drafting</a></li>
        <li class="active"><a href="{{ route('summarry',[ $idfor,$idpkp,$idpro]) }}"><span class="nmbr">3</span>Summary</a></li>
        @endif
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
            @if($formula->workbook_id!=NULL)
            <tr><th>Product Name</th><td>&nbsp; : {{ $project->project_name }}</td></tr>
            <tr><th>PV</th><td>&nbsp; : {{ $project->perevisi2->name }}</td></tr>
            @else
            <tr><th>Product Name</th><td>&nbsp; : {{ $formula->Workbook_pdf->datapdf->project_name }}</td></tr>
            <tr><th>PV</th><td>&nbsp; : {{ $formula->workbook_pdf->perevisi2->name }} </td></tr>
            @endif
            <tr><th>Version</th><td>&nbsp; : {{ $formula->versi }}.{{ $formula->turunan }}</td></tr>
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
              @endif</th>
            </tr>
            <tr><th>Batch</th><td>&nbsp; : {{ $formula->batch }} Gram</td></tr>
            <tr><th>Serving</th><td>&nbsp; : {{ $formula->serving }} Gram</td></tr>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>  

<div class="row">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4><i class="fa fa-plus"></i> Add Materials <small style="color:red">* gunakan (.) untuk pengganti (,)</small></h4>
    </div>
    <div class="panel-body">
      <form id="submitbahan" method="POST" action="{{ route('step2insert',$idfor) }}">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <table style="border-spacing: 10px;border-collapse: separate;">
        	<tr>
            <td>
              @if($formula->kategori=='granulasi')
              <input type="hidden" name="cgranulasi" value="ya">
              @elseif($formula->kategori=='premix')
              <input type="hidden" name="cpremix" value="ya">
              @endif
							<label for="" class="control-label">Materials</label><br>
							<select class="bahan form-control" style="width:190px;" id="prioritas" name="prioritas">
								<option value="" disabled selected>-->Select One<--</option>
								@foreach($bahans as $bahan)
								<option value="{{ $bahan->id }}">{{ $bahan->nama_sederhana }}( {{$bahan->nama_bahan}} )</option>
								@endforeach
							</select>
							<button class="btn btn-primary" id="t1" type="button"><i class="fa fa-plus"></i></button>
            </td>
         
            <td class="A1" style="display:none">
							<label for="" class="control-label">Alternative 1</label><br>
							<select class="bahan form-control" style="width:190px;display:none;" id="alternatif" name="alternatif[1]">
								<option value="" disabled selected>Alternative 1</option>                                
							</select>
							<button class="btn btn-primary" id="t2" type="button"><i class="fa fa-plus"></i></button>
							<button class="btn btn-danger" id="k1" type="button"><i class="fa fa-minus"></i></button>
            </td>

            <td class="A2" style="display:none">
							<label for="" class="control-label">Alternative 2</label><br>
							<select class="bahan form-control" style="width:190px;display:none;" id="alternatif2" name="alternatif[2]">
								<option value="" disabled selected>Alternative 2</option>                                
							</select>
							<button class="btn btn-primary" id="t3" type="button"><i class="fa fa-plus"></i></button>
							<button class="btn btn-danger" id="k2" type="button"><i class="fa fa-minus"></i></button>
            </td>

            <td class="A3" style="display:none">
							<label for="" class="control-label">Alternative 3</label><br>
							<select class="bahan form-control" style="width:190px;display:none;" id="alternatif3" name="alternatif[3]">
								<option value="" disabled selected>Alternative 3</option>                                
							</select>
							<button class="btn btn-primary" id="t4" type="button"><i class="fa fa-plus"></i></button>
							<button class="btn btn-danger" id="k3" type="button"><i class="fa fa-minus"></i></button>
            </td>
          </tr>

          <tr>
            <td class="A4" style="display:none">
							<label for="" class="control-label">Alternative 4</label><br>
							<select class="bahan form-control" style="width:190px;display:none;" id="alternatif4" name="alternatif[4]">
								<option value="" disabled selected>Alternative 4</option>                                
							</select>
							<button class="btn btn-primary" id="t5" type="button"><i class="fa fa-plus"></i></button>
							<button class="btn btn-danger" id="k4" type="button"><i class="fa fa-minus"></i></button>
            </td>
 
            <td class="A5" style="display:none">
							<label for="" class="control-label">Alternative 5</label><br>
							<select class="bahan form-control" style="width:190px;display:none;" id="alternatif5" name="alternatif[5]">
								<option value="" disabled selected>Alternative 5</option>                                
							</select>
							<button class="btn btn-primary" id="t6" type="button"><i class="fa fa-plus"></i></button>
							<button class="btn btn-danger" id="k5" type="button"><i class="fa fa-minus"></i></button>
            </td>

            <td class="A6" style="display:none">
							<label for="" class="control-label">Alternative 6</label><br>
							<select class="bahan form-control" style="width:190px;display:none;" id="alternatif6" name="alternatif[6]">
								<option value="" disabled selected>Alternative 6</option>                                
							</select>
							<button class="btn btn-primary" id="t7" type="button"><i class="fa fa-plus"></i></button>
							<button class="btn btn-danger" id="k6" type="button"><i class="fa fa-minus"></i></button>
            </td>

            <td class="A7" style="display:none">
							<label for="" class="control-label">Alternative 7</label><br>
							<select class="bahan form-control" style="width:180px;display:none;" id="alternatif7" name="alternatif[7]">
							  <option value="" disabled selected>Alternative 7</option>                                
							</select>
							<button class="btn btn-danger" id="k7" type="button"><i class="fa fa-minus"></i></button>
            </td>
          </tr>
        </table>
      </div>
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="col-md-2">
          <label for="" class="control-label">Serving(Gram)</label>
          <input type="number" step=any id="per_serving"  name="per_serving" placeholder="0" class="form-control" value="{{ old('per_serving') }}" required />
          <input type="hidden" id="c"  name="c" value="0"/> 
        </div>
        @if ($mybase == 0)
        <div class="col-md-2"> 
          <label for="" class="control-label">Batch(Gram)</label>
          <input type="number" step=any id="per_batch" name="per_batch" placeholder="0" class="form-control" value="{{ old('per_batch') }}" />                    
        </div>
        @endif
        @if ($mybase == 0)
        <div class="col-md-2"><br>
          <input type="checkbox" value="yes" checked name="cbase" id="cbase">
          <label for="cbase" > Base Calculations</label>                                        
        </div>                                                                 
        @endif 
        <div class="col-md-6"><br>
        	{{ csrf_field()}}
          <button type="submit" class="btn btn-primary btn-sm"><li class="fa fa-plus"></li> Add Materials</button>
        </div>
      </div>  
      </form>  
    </div>
  </div>
</div>

<div class="row">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4><i class="fa fa-edit"></i> Formulation</h4>
    </div>
    <div class="panel-body">
      <div class="row">                            
        <div class="col-md-12">                                                                        
          <div style="float:right">
            @if ($mybase != 0)
            <a class="btn btn-primary btn-sm" type="button" id="buttonformsavescale"><i class="fa fa-save"></i> Save Scale</a>
            <a class="btn btn-warning btn-sm" type="button" id="buttonformcheckscale"><i class="fa fa-eye"></i> Check Scale</a>
            @endif
            @if ($mybase != 0)
            <a type="button" class="btn btn-dark btn-sm" id="buttongantibase"><i class="fa fa-exchange"></i> Ganti Base</a>
            <a type="button" class="btn btn-danger btn-sm" href="{{ route('hapusall',$idfor) }}" onclick="return confirm('Hapus Data ?')"><i class="fa fa-times"></i> Delete Data</a>
            @endif
          </div>                                    
        </div>                             
      </div>

      @if($ada>0)
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
          @foreach($scalecollect as $fortail)
            <!-- Bahan Bukan Granulasi -->
            @if($fortail['granulasi'] == 'tidak' && $fortail['premix'] == 'tidak')                                                                       
            <tr>
              @php $no = $fortail['no']; $rowspan = $ada; @endphp     
              <input type="hidden" id="ftid{{$no}}" name="ftid[{{$no}}]" value="{{$fortail['id']}}">
              <input type="hidden" id="granulasi{{$no}}" value="{{ $fortail['granulasi'] }}">
              <input type="hidden" placeholder="0" id="rServing{{$no}}"   value="{{ $fortail['per_serving'] }}">
              <input type="hidden" placeholder="0" id="rBatch{{$no}}"     value="{{ $fortail['per_batch'] }}">
              <input type="hidden" placeholder="0" id="rsServing{{$no}}"  value="{{ $fortail['scale_serving'] }}">
              <input type="hidden" placeholder="0" id="rsBatch{{$no}}"    value="{{ $fortail['scale_batch'] }}">                 
              <td class="text-center">
                <a type="button" onclick="return confirm('Hapus Bahan Baku ?')" href="{{ route('step2destroy',['id'=>$fortail['id'],'vf'=>$idfor]) }}"><i class="fa fa-trash"></i></a>
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
              <td><input type="number" placeholder="0" onkeyup="jServing(this.id)"  id="Serving{{$no}}"  value="{{ $fortail['per_serving'] }}"   name="Serving[{{ $no }}]"></td>
              <td><input type="number" placeholder="0" onkeyup="jBatch(this.id)"    id="Batch{{$no}}"    value="{{ $fortail['per_batch'] }}"     name="Batch[{{ $no }}]"></td>
              <td style="background-color:#ffffb3" ><input type="number" placeholder="0" onkeyup="jsServing(this.id)" id="sServing{{$no}}" value="{{ $fortail['scale_serving'] }}" name="sServing[{{$no}}]"></td>
              <td style="background-color:#ffffb3" ><input type="number" placeholder="0" onkeyup="jsBatch(this.id)"   id="sBatch{{$no}}"   value="{{ $fortail['scale_batch'] }}"   name="sBatch[{{$no}}]"></td>
              @if ($c_mybase == 1)
              <td class="base" style="background-color:#f2f2f2">{{ $mybase }}</td>
              @php $c_mybase = 2; @endphp 
              @endif
            </tr>
            @endif 
            @endforeach                                                                           
          
          <!-- Bahan Granulasi -->
          @if($granulasi > 0 )
          @php $rowspan = $ada; @endphp
          <tr style="background-color:#eaeaea;color:red">
            <td colspan="7">Granulasi &nbsp;
              % <input type="number" id="gp" placeholder="0" disabled>  
            </td>                                            
          </tr>            
          @foreach($scalecollect as $fortail)
            @if($fortail['granulasi'] == 'ya')                                                                    
            <tr>
              @php $no = $fortail['no']; @endphp   
              <input type="hidden" id="ftid{{$no}}" name="ftid[{{$no}}]" value="{{$fortail['id']}}">
              <input type="hidden" id="granulasi{{$no}}" value="{{ $fortail['granulasi'] }}">
              <input type="hidden" placeholder="0" id="rServing{{$no}}" value="{{ $fortail['per_serving'] }}">
              <input type="hidden" placeholder="0" id="rBatch{{$no}}" value="{{ $fortail['per_batch'] }}">
              <input type="hidden" placeholder="0" id="rsServing{{$no}}" value="{{ $fortail['scale_serving'] }}">
              <input type="hidden" placeholder="0" id="rsBatch{{$no}}" value="{{ $fortail['scale_batch'] }}">                      
              <td class="text-center">
                <a type="button" href="{{ route('editfortail',['id'=>$fortail['id'],'vf'=>$idfor]) }}" title="edit"><i class="fa fa-edit" ></i></a>
                <a type="button" onclick="return confirm('Hapus Bahan Baku ?')" href="{{ route('step2destroy',['id'=>$fortail['id'],'vf'=>$idfor]) }}"><i class="fa fa-trash"></i></a>
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
              <td><input type="number" placeholder="0" onkeyup="jServing(this.id)"  id="Serving{{$no}}"  value="{{ $fortail['per_serving'] }}"   name="Serving[{{ $no }}]"></td>
              <td><input type="number" placeholder="0" onkeyup="jBatch(this.id)"    id="Batch{{$no}}"    value="{{ $fortail['per_batch'] }}"     name="Batch[{{ $no }}]"></td>
              <td style="background-color:#ffffb3"><input type="number" placeholder="0" onkeyup="jsServing(this.id)" id="sServing{{$no}}" value="{{ $fortail['scale_serving'] }}" name="sServing[{{$no}}]"></td>                                        
              <td style="background-color:#ffffb3"><input type="number" placeholder="0" onkeyup="jsBatch(this.id)"   id="sBatch{{$no}}"   value="{{ $fortail['scale_batch'] }}"   name="sBatch[{{$no}}]"></td>
              @if ($c_mybase == 1)
              <td class="base" style="background-color:#f2f2f2">{{ $mybase }}</td>
              @php $c_mybase = 2; @endphp 
              @endif
            </tr>
            @endif 
          @endforeach 
          @endif          

          <!-- Bahan Premix -->
          @if($premix > 0 )
          @php $rowspan = $ada; @endphp
          <tr style="background-color:#eaeaea;color:red">
            <td colspan="7">Premix &nbsp;
              % <input type="number" id="pr" placeholder="0" disabled>  
            </td>                                            
          </tr>            
          @foreach($scalecollect as $fortail)
            @if($fortail['premix'] == 'ya')                                                                       
            <tr>
              @php $no = $fortail['no']; @endphp  
              <input type="hidden" id="ftid{{$no}}" name="ftid[{{$no}}]" value="{{$fortail['id']}}">
              <input type="hidden" id="premix{{$no}}" value="{{ $fortail['premix'] }}">   
              <input type="hidden" placeholder="0" id="rServing{{$no}}" value="{{ $fortail['per_serving'] }}">
              <input type="hidden" placeholder="0" id="rBatch{{$no}}" value="{{ $fortail['per_batch'] }}">
              <input type="hidden" placeholder="0" id="rsServing{{$no}}" value="{{ $fortail['scale_serving'] }}">
              <input type="hidden" placeholder="0" id="rsBatch{{$no}}" value="{{ $fortail['scale_batch'] }}">                 
              <td class="text-center">
                <a type="button" href="{{ route('editfortail',['id'=>$fortail['id'],'vf'=>$idfor]) }}" title="edit"><i class="fa fa-edit" ></i></a>
                <a type="button" onclick="return confirm('Hapus Bahan Baku ?')" href="{{ route('step2destroy',['id'=>$fortail['id'],'vf'=>$idfor]) }}"><i class="fa fa-trash"></i></a>
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
              <td><input type="number" placeholder="0" onkeyup="jServing(this.id)"  id="Serving{{$no}}"  value="{{ $fortail['per_serving'] }}"   name="Serving[{{ $no }}]"></td>
              <td><input type="number" placeholder="0" onkeyup="jBatch(this.id)"    id="Batch{{$no}}"    value="{{ $fortail['per_batch'] }}"     name="Batch[{{ $no }}]"></td>
              <td style="background-color:#ffffb3"><input type="number" placeholder="0" onkeyup="jsServing(this.id)" id="sServing{{$no}}" value="{{ $fortail['scale_serving'] }}" name="sServing[{{$no}}]"></td>                                        
              <td style="background-color:#ffffb3"><input type="number" placeholder="0" onkeyup="jsBatch(this.id)"   id="sBatch{{$no}}"   value="{{ $fortail['scale_batch'] }}"   name="sBatch[{{$no}}]"></td>
              @if ($c_mybase == 1)
              <td class="base" style="background-color:#f2f2f2">{{ $mybase }}</td>
              @php $c_mybase = 2; @endphp 
              @endif
            </tr>
            @endif                                                            
          @endforeach 
          @endif 
          <!-- For Reset Jumlah -->
          <tr class="tototal">
            <input type="hidden" id="rjsServing" value="">
            <td colspan="2">Jumlah</td>
            <input type="hidden" id="rjsBatch" value="">
            <td><input type="number" placeholder="0" id="jServing" disabled></td>
            <td><input onkeyup="ctBatch(this.id)" type="number" placeholder="0" class="tbatch" name="tbatch" id="jBatch"></td>
            <td><input onkeyup="cjsServing(this.id)" type="number" placeholder="0" id="jsServing" name="jsServing"></td>
            <td><input onkeyup="cjsBatch(this.id)" type="number" placeholder="0" id="jsBatch" name="jsBatch"></td>
            <td>
            <input type="hidden" id="rBase" id="rBase" value="{{ $mybase }}">
                X <input type="number" id="base" name="base" onkeyup="BASE(this.id)"  value="{{ $mybase }}">
            </td>
          </tr>

          <tr class="toserving">
            <td colspan="2">Target Serving</td>
            <td style="background-color:#f2f2f2;color:black;"><input type="number" id="tServing" value="{{ $target_serving }}" disabled></td>
            <td colspan="4"></td>
          </tr>
        </tbody>                            
      </table>
      @endif 
      <div class="row">
        <div class="col-md-8">
          @if($formula->workbook_id!=NULL)
            @if($ada==0)                                    
            <a type="hidden" class="btn btn-success btn-sm" href="{{ route('getTemplate',[$idfor,$idpkp,$idpro]) }}"><i class="fa fa-download"></i> Import Formula Template</a>        
            @else
            <a class="btn btn-success btn-sm" href="{{ route('getTemplate',[$idfor,$idpkp,$idpro]) }}" type="button" id="buttonformcheckscale"><i class="fa fa-download"></i> Import Granulasi/Premix</a>
            <a class="btn btn-info btn-sm" type="button" id="buttonformsavechanges"><i class="fa fa-save"></i> Save Changes</a>                            
            @endif
          @elseif($formula->workbook_pdf_id!=NULL)
            @if($ada==0)                                    
            <a type="button" class="btn btn-success btn-sm" href="{{ route('getTemplate',[$idfor,$idpkp,$idpro]) }}"><i class="fa fa-download"></i> Import Formula Template</a>        
            @else
            <a class="btn btn-success btn-sm" href="{{ route('getTemplate',[$idfor,$idpkp,$idpro]) }}" type="button" id="buttonformcheckscale"><i class="fa fa-download"></i> Import Granulasi/Premix</a>
            <a class="btn btn-info btn-sm" type="button" id="buttonformsavechanges"><i class="fa fa-save"></i> Save Changes</a>                            
            @endif
          @endif
        </div>
      </div>
    </div><hr>
    @if($formula->workbook_id!=NULL)
    <form class="form-horizontal form-label-left" method="POST" action="{{ route('updatenote',[$formula->id,$formula->workbook_id]) }}">
    @elseif($formula->workbook_pdf_id!=NULL)
    <form class="form-horizontal form-label-left" method="POST" action="{{ route('updatenote',[$formula->id,$formula->workbook_pdf_id]) }}">
    @endif
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

@php
  $no = $ada;
  if($ada < 1){ $rowspan = 1; }
@endphp

<div class="row panel" hidden>    
  <div class="row" style="margin:20px">
    <div class="col-md-2" >
      <!-- Ganti Base -->
      <form action="{{ route('gantibase',$idfor) }}" id="formgantibase" method="POST">
        <label for="thebase">Ganti Base</label><br>
        <input type="number" id="thebase" name="thebase" placeholder="0" value="{{ $mybase }}">
        {{ csrf_field()}}
      </form>
    </div>
    <div class="col-md-2">
      @if($formula->workbook_id!=NULL)
      <form action="{{ route('cekscale',[ $idfor,$idpkp,$idpro]) }}" id="formcheckscale" method="POST">
      @elseif($formula->workbook_pdf_id!=NULL)
      <form action="{{ route('cekscale',[ $idfor,$idpkp,$idpro]) }}" id="formcheckscale" method="POST">
      @endif
      <!-- Form Check Scale -->
      <label>Check Scale</label><br>
      <input type="text" id="scale_option2" name="scale_option" value="gram">
      <select id="scale_method" class="form-control" name="scale_method">
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
        <br><label>Jumlah Fortail</label><br>
          <input type="number" name="jFortail" value="{{$ada}}">
        {{ csrf_field()}}
      </form>
    </div>
    <div class="col-md-8">
      <!-- form save scale -->
      <form action="{{ route('savescale',[$idfor,$idpkp]) }}" id="formsavescale" method="POST">
        <table class="table">
          <tbody>
            @foreach($scalecollect as $fortail)                                                                      
            <tr>
							<td>{{ $fortail['nama_sederhana'] }}</td>
							<input type="hidden" name="ftid[{{ $fortail['no'] }}]" value="{{$fortail['id']}}">                               
							<td><input type="number" placeholder="0" value="{{ $fortail['scale_batch'] }}"   name="sBatch[{{ $fortail['no'] }}]"></td>
							<td><input type="number" placeholder="0" id="justcheckscale" value="{{ $fortail['scale_serving'] }}" name="sServing[{{ $fortail['no'] }}]"></td>                               
            </tr>                                                       
            @endforeach  
            <tr>
              <td colspan="3">
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
      <form action="{{ route('savechanges',$idfor) }}" id="formsavechanges" method="POST">
      <table class="table">
        <tbody>
          @foreach($scalecollect as $fortail)                                                                      
          <tr>
						<td>{{ $fortail['nama_sederhana'] }}</td>
						<input type="hidden" name="ftid[{{ $fortail['no'] }}]" value="{{$fortail['id']}}">                               
						<td><input type="number" placeholder="0" id="Serving2{{ $fortail['no'] }}"  value="{{ $fortail['per_serving'] }}"   name="Serving[{{ $fortail['no'] }}]"></td>      
						<td><input type="number" placeholder="0" id="Batch2{{ $fortail['no'] }}"  value="{{ $fortail['per_batch'] }}"   name="Batch[{{ $fortail['no'] }}]"></td>                                 
          </tr>                                                       
          @endforeach                                                             
          <tr>
						<td>Total Batch</td>                          
						<td><input type="number" placeholder="0" id="total_svg" name="total_svg"></td>      
						<td><input type="number" placeholder="0" id="total_btc" name="total_btc"></td>                                 
          </tr> 
          <tr>
            <td colspan="3">
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

@endsection    
@section('s')

<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
  <script src="{{ asset('js/select2/select2.min.js') }}"></script>
<link href="{{ asset('css/asrul.css') }}" rel="stylesheet">
<script type="text/javascript">
  $(document).ready(function(){        
    var i = {{ $no }};
    console.log(i);
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
      hbatch = (total.toFixed(3));
      total2  = total2 + serving;
      Hserving = (total2.toFixed(3));
      tsb     = tsb + sBatch;
      tss     = tss + sServing;                                           

      $('#jBatch').val(hbatch);
      $('#jServing').val(Hserving);

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
      tss     = parseFloat(tss.toFixed(3));
    }     
            
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
    $('#Batch2'+urutan).val(x);
    if(x != y ){
      $('#'+myId).css("border", "1px solid cyan");                
    }else{
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
    }else{
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
    }else{
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
    }else{
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
    }else{
      $('#'+myId).css("border", "");
      // Reset The Target
      $('#scale_method').val("Z");
      $('#target_scale').val('');
      $('#target_number').val('');
    }
  }

  function ctBatch(myId){
    x = $('.tbatch').val();
    y = $('#jServing').val();
    console.log(y);
    $('#total_btc').val(x);
    $('#total_svg').val(y);
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
    }else{
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
    }else{
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
      }else{
        alert('Maaf Base Belum Diganti');
        return false;
      }                
    }else{
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
      }else{
        $('#formcheckscale').submit();
        return false;
      }                
    }else{
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
      }else{
        alert('Maaf Scale Kosong !');
        return false;
      }                   
    }else{
      return false;
    }
  });

  // FORM SAVE CHANGES ------
  $('#buttonformsavechanges').click( function(){
    if(confirm("Simpan Perubahan Serving ?")){
      $('#formsavechanges').submit();
      return false;               
    }else{
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
      }else{
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
			}else if(c === '1'){
				if(bahanbaku === null){
					alert('BahanBaku Tidak Boleh Kosong');
					return false;
        }
        if(alternatif === null){
          alert('Alternatif1 Tidak Boleh Kosong');
          return false;
        }
			}else if(c === '2'){
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
			}else if(c === '3'){
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
			}else if(c === '4'){
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
    	}else if(c === '5'){
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
	});
</script>
@endsection