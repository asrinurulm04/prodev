@extends('formula.tempformula')
@section('title', 'Summarry Formula')
@section('judul', 'Summarry Formula')
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
        <li class="active"><a href="{{ route('step1',[ $idfor, $idf]) }}"><span class="nmbr">1</span>Information</a></li>
        <li class="active"><a href="{{ route('step2',[ $idfor, $idf]) }}"><span class="nmbr">2</span>Penyusunan</a></li>
        <li class="completed"><a href="{{ route('summarry',[ $idfor, $idf]) }}"><span class="nmbr">3</span>Summary</a></li>
      </ul>
    </div>
  </div>
</div>

<div class="x_panel">
    <div class="x_title">
      <h3><li class="fa fa-wpforms"> Penyusunan Formula</h3>
    </div>
  <div class="card-block">
  	<div class="row">
      <div class="col-md-4">
        <table>
          {{-- <tr>
						@foreach($ingredient as $ig)
						{{ $ig->fat/100 }}
						@endforeach
            <td>Nama Produk</td><td>&nbsp; : {{ $formula->Workbook->datapkpp->project_name }}</td>                    
					</tr> --}}
					<tr>
					<td>No.PKP</td><td>&nbsp; : {{ $formula->Workbook->datapkpp->pkp_number }}{{$formula->Workbook->datapkpp->ket_no}}</td>
          </tr>
          <tr>
            <td>Versi</td><td>&nbsp; : {{ $formula->versi }}.{{ $formula->turunan }}</td>
          </tr>
          <tr>
            <td>Perevisi</td><td>&nbsp; : {{ $formula->workbook->perevisi2->name }} </td>
          </tr>
        </table>
      </div>
      <div class="col-md-3">
        <table>
          <tr>
            <td>Jenis Formula</td><td>&nbsp; : 
              @if ($formula->jenis == 'baru')
                <span class="label label-info">Baru</span> 
              @else
                <span class="label label-warning">Proses</span> 
              @endif
            </td>
          </tr>
          <tr>
            <td>Jumlah Batch</td><td>&nbsp; : {{ $formula->batch }} &nbsp;Gram</td>
          </tr>
          <tr>                    
            <td>Jumlah Serving</td><td>&nbsp; : {{ $formula->serving }} &nbsp;Gram</td>
          </tr>
        </table>
      </div>
      <div class="col-md-3">
        <table>
          <tr>
            <td>Status PV</td><td>&nbsp; :
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
            <td>Status Feasibility</td><td>&nbsp; :
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
            <td>Status Nutfact</td><td>&nbsp; :  
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
      <div class="col-md-2">
        <a class="btn btn-danger btn-sm" href="{{ route('showworkbook',$formula->workbook_id) }}"><i class="fa fa-ban"></i> Bact To Workbook</a>
      </div>
    </div>

    {{-- Start Start --}}
    <div class="row" style="margin:20px">
			<div id="exTab2" class="container">	
				<ul class="nav nav-tabs  tabs" role="tablist">
					<li class="nav-item"><a class="nav-link  active" href="#1" data-toggle="tab"><i class="fa fa-list"></i> Formula</a></li>
					<li class="nav-item"><a class="nav-link" href="#2" data-toggle="tab"><i class="fa fa-clipboard"></i> Nutfact</a></li>
					<li class="nav-item"><a class="nav-link" href="#3" data-toggle="tab"><i class="fa fa-usd"></i> HPP Formula</a></li>
				</ul><br>
				<!-- Data Formula -->
				<div class="tab-content ">
					<div class="tab-content ">
						<div class="tab-pane active" id="1">
							@php $no = 0; @endphp 
							@if ($ada > 0)
							<div class="panel-default">	
								<div class="panel-body badan">
									<label>PT NUTRIFOOD INDONESIA</label>
									<center> <h2 style="font-size: 22px;font-weight: bold;">FORMULA PRODUK</h2> </center>
									<center> <h2 style="font-size: 20px;font-weight: bold;">( FOR )</h2> </center>
				
									<table class="col-md-5 col-sm- col-xs-12">
										<tr>
											<th width="10%">Nama Produk </th>
											<th width="45%">: {{ $formula->Workbook->datapkpp->project_name }}</th>
										<tr>
											<th width="10%">Gd. Baku | IO</th>
											<th width="45%">:</th>
										</tr><br><br>
									</table>
				
									<table ALIGN="right">
										<tr><th class="text-right">Tanggal : {{ $formula->created_at}} </th></tr>
										<tr><th class="text-right">jumlah/batch : {{ $formula->batch }}  g</th></tr>
									</table><br><br>
				
									<table class="table table-bordered" style="font-size:12px">
										<thead style="font-weight: bold;color:white;background-color: #2a3f54;">
											<tr>
												<th class="text-center" style="width:3%">No</th>                      
												<th class="text-center" style="width:20%">Nama Sederhana</th>
												<th class="text-center" style="width:20%">Nama Bahan</th>
												<th class="text-center" style="width:25%">Principle</th>
												<th class="text-center" style="width:8%">PerBatch (gr)</th>
												<th class="text-center" style="width:8%">PerServing (gr)</th>
												<th class="text-center" style="width:5%">Persen</th>
											</tr>
										</thead>
										<tbody>
											{{-- Non Granulasi --}}
											@foreach ($detail_formula->sortByDesc('per_batch') as $fortail)
											@if ($fortail['granulasi'] == 'tidak')
											<tr>
												<td>{{ ++$no }}</td>
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
												<td>{{ $fortail['per_batch'] }}</td>
												<td>{{ $fortail['per_serving'] }}</td>
												<td>{{ $fortail['persen'] }} &nbsp;%</td>
											</tr>                                                        
											@endif
											@endforeach
											{{-- Granulasi --}}
											<tr style="background-color:#eaeaea;color:red">
												<td colspan="7">Granulasi &nbsp;
													% &nbsp;
												</td>                                            
											</tr>
									
											@foreach ($detail_formula->sortByDesc('per_batch') as $fortail)
											@if ($fortail['granulasi'] == 'ya')
											<tr>
												<td>{{ ++$no }}</td>
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
												<td>{{ $fortail['per_batch'] }}</td>
												<td>{{ $fortail['per_serving'] }}</td>
												<td>{{ $fortail['persen'] }} &nbsp;%</td>
											</tr>                                                       
											@endif
											@endforeach
											{{-- Jumlah --}}
											<tr style="font-size: 12px;font-weight: bold; color:black;background-color: rgb(78, 205, 196, 0.5);">
												<td colspan="4">Jumlah</td>
												<td>{{ $formula->batch }}</td>
												<td>{{ $formula->serving }}</td>
												<td> 100 % </td>
											</tr>
										</tbody>
									</table>
									
									<div class="row">
										<div class="col-md-6">
											<table>
												<tr><td colspan="3"><b> Formula Ini mengandung Allergen </b></td></tr>
												<tr><td><b> Contain </b></td><td>:</td><td></td></tr>
												<tr><td><b> May Contain </b></td><td>:</td><td></td></tr>
											</table>
										</div>
									</div>
								</div>
							</div>
							@endif
						</div>
						<div class="tab-pane" id="2">
							<div class="row">
								<div class="col-md-12">
									<div class="panel">
										<div class="panel-body">    
											{{--DATA FORMULA YANG DIPILIH--}}
											@foreach($data as $datas) @endforeach
											<div class="accordion" id="accordionExample">
												{{--LIST INGREDIENT--}}
												<div class="panel panel-info">
													<div class="panel-heading" id="headingOne">
														<h5 class="mb-0">
															<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseTwo"><b>LIST INGREDIENT</b></button>
														</h5>
													</div>
													<div aria-labelledby="headingOne" data-parent="#accordionExample">
														<div class="panel-body" style="overflow-x: scroll;">
															<table class="table table-advanced">
																<thead>
																<tr>
																		<th rowspan="2"  class="text-center" style="font-weight: bold;color:white;background-color: #2a3f54;">Nama Sederhana</th>
																		<th colspan="2"  class="text-center" style="font-weight: bold;color:white;background-color: #2a3f54;">BTP Carry Over</th>
																		<th rowspan="2"  class="text-center" style="font-weight: bold;color:white;background-color: #2a3f54;">Dosis</th>
																		<th rowspan="2"  class="text-center" style="font-weight: bold;color:white;background-color: #2a3f54;">%</th>
																		<th colspan="39" class="text-center" style="font-size: 12px;font-weight: bold; color:black;background-color: #898686;">Nutrition Data</th>
																	</tr>
																	<tr>
																		<th class="text-center" style="font-weight: bold;color:white;background-color: #2a3f54;">Carry Over</th>
																		<th class="text-center" style="font-weight: bold;color:white;background-color: #2a3f54;">Carry Over dicantumkan dalam penulisan ing list</th>
																		<th class="text-center" style="font-weight: bold;color:white;background-color: #3a5e82;">Lemak</th>
																		<th class="text-center" style="font-weight: bold;color:white;background-color: #3a5e82;">SFA</th>
																		<th class="text-center" style="font-weight: bold;color:white;background-color: #3a5e82;">Karbohidrat</th>
																		<th class="text-center" style="font-weight: bold;color:white;background-color: #3a5e82;">Gula</th>
																		<th class="text-center" style="font-weight: bold;color:white;background-color: #3a5e82;">Laktosa</th>
																		<th class="text-center" style="font-weight: bold;color:white;background-color: #3a5e82;">Sukrosa</th>
																		<th class="text-center" style="font-weight: bold;color:white;background-color: #3a5e82;">Serat</th>
																		<th class="text-center" style="font-weight: bold;color:white;background-color: #3a5e82;">Serat Larut</th>
																		<th class="text-center" style="font-weight: bold;color:white;background-color: #3a5e82;">Protein</th>
																		<th class="text-center" style="font-weight: bold;color:white;background-color: #3a5e82;">Kalori</th>
																		<th class="text-center" style="font-weight: bold;color:white;background-color: #3a5e82;">Na (mg)</th>
																		<th class="text-center" style="font-weight: bold;color:white;background-color: #3a5e82;">K (mg)</th>
																		<th class="text-center" style="font-weight: bold;color:white;background-color: #3a5e82;">Ca (mg)</th>
																		<th class="text-center" style="font-weight: bold;color:white;background-color: #3a5e82;">Mg (mg)</th>
																		<th class="text-center" style="font-weight: bold;color:white;background-color: #3a5e82;">P (mg)</th>
																		<th class="text-center" style="font-weight: bold;color:white;background-color: #3a5e82;">Beta Glucan</th>  
																		<th class="text-center" style="font-weight: bold;color:white;background-color: #3a5e82;">Cr(mcg)</th>
																		<th class="text-center" style="font-weight: bold;color:white;background-color: #3a5e82;">Vit C (mg)</th>
																		<th class="text-center" style="font-weight: bold;color:white;background-color: #3a5e82;">Vit E (mg)</th>
																		<th class="text-center" style="font-weight: bold;color:white;background-color: #3a5e82;">Vit D (mg)</th>
																		<th class="text-center" style="font-weight: bold;color:white;background-color: #3a5e82;">Carnitin (mg)</th>
																		<th class="text-center" style="font-weight: bold;color:white;background-color: #3a5e82;">CLA (mg)</th>
																		<th class="text-center" style="font-weight: bold;color:white;background-color: #3a5e82;">Sterol Ester (mg)</th>
																		<th class="text-center" style="font-weight: bold;color:white;background-color: #3a5e82;">Chondroitin (mg)</th>
																		<th class="text-center" style="font-weight: bold;color:white;background-color: #3a5e82;">Omega 3</th>
																		<th class="text-center" style="font-weight: bold;color:white;background-color: #3a5e82;">DHA</th>
																		<th class="text-center" style="font-weight: bold;color:white;background-color: #3a5e82;">EPA</th>
																		<th class="text-center" style="font-weight: bold;color:white;background-color: #3a5e82;">Creatine</th>
																		<th class="text-center" style="font-weight: bold;color:white;background-color: #3a5e82;">Lysine</th>
																		<th class="text-center" style="font-weight: bold;color:white;background-color: #3a5e82;">Glucosamine (mg)</th>
																		<th class="text-center" style="font-weight: bold;color:white;background-color: #3a5e82;">Kolin </th>
																		<th class="text-center" style="font-weight: bold;color:white;background-color: #3a5e82;">MUFA</th>
																		<th class="text-center" style="font-weight: bold;color:white;background-color: #3a5e82;">Linoleic Acid (Omega 6)</th>
																		<th class="text-center" style="font-weight: bold;color:white;background-color: #3a5e82;">Linolenic Acid</th>
																		<th class="text-center" style="font-weight: bold;color:white;background-color: #3a5e82;">Sorbitol</th>
																		<th class="text-center" style="font-weight: bold;color:white;background-color: #3a5e82;">Maltitol</th>
																	</tr>
																</thead>
																<tbody>
																	@php $no = 0; @endphp
																	@foreach ($detail_harga->sortByDesc('per_batch') as $fortail)
																	<tr>
																		<td>{{ $fortail['nama_sederhana'] }}</td>
																		<td>{{ $fortail['btp'] }}</td>
																		<td>{{ $fortail['list'] }}</td>
																		<td>{{ $fortail['per_serving'] }}</td>
																		<td>{{ $fortail['persen'] }}</td>
																		<td>{{ $fortail['lemak'] }}</td>
																		<td>{{ $fortail['sfa'] }}</td>
																		<td>{{ $fortail['karbohidrat'] }}</td>
																		<td>{{ $fortail['gula'] }}</td>
																		<td>{{ $fortail['laktosa'] }}</td>
																		<td>{{ $fortail['sukrosa'] }}</td>
																		<td>{{ $fortail['serat'] }}</td>
																		<td>{{ $fortail['seratL'] }}</td>
																		<td>{{ $fortail['protein'] }}</td>
																		<td>{{ $fortail['kalori'] }}</td>
																		<td>{{ $fortail['na'] }}</td>
																		<td>{{ $fortail['k'] }}</td>
																		<td>{{ $fortail['ca'] }}</td>
																		<td>{{ $fortail['mg'] }}</td>
																		<td>{{ $fortail['p'] }}</td>
																		<td>{{ $fortail['beta'] }}</td>
																		<td>{{ $fortail['cr'] }}</td>
																		<td>{{ $fortail['vitC'] }}</td>
																		<td>{{ $fortail['vitE'] }}</td>
																		<td>{{ $fortail['vitD'] }}</td>
																		<td>{{ $fortail['carnitin'] }}</td>
																		<td>{{ $fortail['cla'] }}</td>
																		<td>{{ $fortail['sterol'] }}</td>
																		<td>{{ $fortail['chondroitin'] }}</td>
																		<td>{{ $fortail['omega3'] }}</td>
																		<td>{{ $fortail['dha'] }}</td>
																		<td>{{ $fortail['epa'] }}</td>
																		<td>{{ $fortail['creatine'] }}</td>
																		<td>{{ $fortail['lysine'] }}</td>
																		<td>{{ $fortail['glucosamine'] }}</td>
																		<td>{{ $fortail['kolin'] }}</td>
																		<td>{{ $fortail['mufa'] }}</td>
																		<td>{{ $fortail['linoleic6'] }}</td>
																		<td>{{ $fortail['linolenic'] }}</td>
																		<td>{{ $fortail['sorbitol'] }}</td>
																		<td>{{ $fortail['maltitol'] }}</td>
																	</tr>  
																	@endforeach
																	<tr style="font-size: 12px;font-weight: bold; color:black;background-color: #ddd;">
																		<td colspan="4" class="text-center">Total : </td>
																		<td> 100 </td>
																		<td>{{ $total_harga['total_lemak'] }}</td>
																		<td>{{ $total_harga['total_sfa'] }}</td>
																		<td>{{ $total_harga['total_karbohidrat'] }}</td>
																		<td>{{ $total_harga['total_gula'] }}</td>
																		<td>{{ $total_harga['total_laktosa'] }}</td>
																		<td>{{ $total_harga['total_sukrosa'] }}</td>
																		<td>{{ $total_harga['total_serat'] }}</td>
																		<td>{{ $total_harga['total_seratL'] }}</td>
																		<td>{{ $total_harga['total_protein'] }}</td>
																		<td>{{ $total_harga['total_kalori'] }}</td>
																		<td>{{ $total_harga['total_na'] }}</td>
																		<td>{{ $total_harga['total_k'] }}</td>
																		<td>{{ $total_harga['total_ca'] }}</td>
																		<td>{{ $total_harga['total_mg'] }}</td>
																		<td>{{ $total_harga['total_p'] }}</td>
																		<td>{{ $total_harga['total_beta'] }}</td>
																		<td>{{ $total_harga['total_cr'] }}</td>
																		<td>{{ $total_harga['total_vitC'] }}</td>
																		<td>{{ $total_harga['total_vitD'] }}</td>
																		<td>{{ $total_harga['total_vitE'] }}</td>
																		<td>{{ $total_harga['total_carnitin'] }}</td>
																		<td>{{ $total_harga['total_cla'] }}</td>
																		<td>{{ $total_harga['total_sterol'] }}</td>
																		<td>{{ $total_harga['total_chondroitin'] }}</td>
																		<td>{{ $total_harga['total_omega3'] }}</td>
																		<td>{{ $total_harga['total_dha'] }}</td>
																		<td>{{ $total_harga['total_epa'] }}</td>
																		<td>{{ $total_harga['total_creatine'] }}</td>
																		<td>{{ $total_harga['total_lysine'] }}</td>
																		<td class="text-center">0</td>
																		<td class="text-center">0</td>
																		<td>{{ $total_harga['total_mufa'] }}</td>
																		<td>{{ $total_harga['total_linoleic6'] }}</td>
																		<td>{{ $total_harga['total_linolenic'] }}</td>
																		<td>{{ $total_harga['total_sarbitol'] }}</td>
																		<td>{{ $total_harga['total_maltitol'] }}</td>
																	</tr>
																</tbody>
															</table>
														</div>
													</div>
												</div> 

												{{--CCT FORMAT & NUTFACT BAYANGAN--}}
												<div aria-labelledby="headingTwo" data-parent="#accordionExample">
													<div class="panel-body">
														<div class="col-md-6">
															<table style="background-color:lightblue;" class="table table-hover table-condensed table-bordered">
																<thead>
																	<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
																		<th class="text-center">Parameter</th>
																		<th class="text-center">Gramasi</th>
																		<th class="text-center">unit</th>
																		<th class="text-center">%AKG</th>
																		<th class="text-center">AKG</th>
																		<th class="text-center">unit</th>
																	</tr>
																</thead>
																<tbody>
																	<tr class="" style=" color: black;">
																		<td>Energi Total</td>
																		<td class="text-right">{{ $total_harga['total_kalori'] }}</td>
																		<td class="text-center">kkal</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td>
																		<td class="text-center">kkal</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Energi Dari Lemak</td>
																		<td class="text-right">{{ $total_harga['total_lemak']*9 }}</td>
																		<td class="text-center">kkal</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td>
																		<td class="text-center">kkal</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Energi Dari Lemak Jenuh</td>
																		<td class="text-right">{{ $total_harga['total_lemak']*9 }}</td>
																		<td class="text-center">kkal</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td>
																		<td class="text-center">kkal</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Karbohidrat Total</td>
																		<td class="text-right">{{ $total_harga['total_karbohidrat'] }}</td>
																		<td class="text-center">g</td>
																		<td class="text-right"><?php $angka = $total_harga['total_karbohidrat']/326*100; $angka_format = number_format($angka,2,",","."); echo $angka_format; ?></td>
																		<td class="text-right">325</td>
																		<td class="text-center">g</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Protein</td>
																		<td class="text-right">{{ $total_harga['total_protein'] }}</td>
																		<td class="text-center">g</td>
																		<td class="text-right"><?php $protein = $total_harga['total_protein']/60*100; $angka_protein = number_format($protein,2,",","."); echo $angka_protein; ?></td>
																		<td class="text-right">60</td>
																		<td class="text-center">g</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Lemak Total</td>
																		<td class="text-right">{{ $total_harga['total_lemak'] }}</td>
																		<td class="text-center">g</td>
																		<td class="text-right"><?php $lemak = $total_harga['total_lemak']/67*100; $angka_lemak = number_format($lemak,2,",","."); echo $angka_lemak; ?></td>
																		<td class="text-right">67</td>
																		<td class="text-center">g</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Lemak Trans</td>
																		<td class="text-right"></td>
																		<td class="text-center">g</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td>
																		<td class="text-center">g</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Lemak Jenuh</td>
																		<td class="text-right">{{ $total_harga['total_sfa'] }}</td>
																		<td class="text-center">g</td>
																		<td class="text-right"><?php $sfa = $total_harga['total_sfa']/20*100; $angka_sfa = number_format($sfa,2,",","."); echo $angka_sfa; ?></td>
																		<td class="text-right">20</td>
																		<td class="text-center">g</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Lemak Tidak Jenuh Tunggal</td>
																		<td class="text-right"></td>
																		<td class="text-center">g</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td>
																		<td class="text-center">g</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Lemak Tidak Jenuh Ganda</td>
																		<td class="text-right"></td>
																		<td class="text-center">g</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td>
																		<td class="text-center">g</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Kolestrol</td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right">300</td>
																		<td class="text-center">mg</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Gula</td>
																		<td class="text-right">{{ $total_harga['total_gula'] }}</td>
																		<td class="text-center">g</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td>
																		<td class="text-center">g</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Serat Pangan</td>
																		<td class="text-right">{{ $total_harga['total_serat'] }}</td>
																		<td class="text-center">g</td>
																				<td class="text-right"></td>
																		<td class="text-right">30</td>
																		<td class="text-center">g</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Serat Pangan Larut</td>
																		<td class="text-right">{{ $total_harga['total_seratL'] }}</td>
																		<td class="text-center">g</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td>
																		<td class="text-center">g</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Serat Pangan Tidak Larut</td>
																		<td class="text-right"></td>
																		<td class="text-center">g</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td>
																		<td class="text-center"></td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Sukrosa</td>
																		<td class="text-right">{{ $total_harga['total_sukrosa'] }}</td>
																		<td class="text-center">g</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td>
																		<td class="text-center">g</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Laktosa</td>
																		<td class="text-right">{{ $total_harga['total_laktosa'] }}</td>
																		<td class="text-center">g</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td>
																		<td class="text-center">g</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Gula Alkohol</td>
																		<td class="text-right"></td>
																		<td class="text-center">g</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td>
																		<td class="text-center">g</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Natrium</td>
																		<td class="text-right">{{ $total_harga['total_na'] }}</td>
																		<td class="text-center">mg</td>
																		<td class="text-right"><?php $na = $total_harga['total_na']/1500*100; $angka_na = number_format($na,2,",","."); echo $angka_na; ?></td>
																		<td class="text-right">1500</td>
																		<td class="text-center">mg</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Kalium</td>
																		<td class="text-right">{{ $total_harga['total_k'] }}</td>
																		<td class="text-center">mg</td>
																		<td class="text-right"><?php $k = $total_harga['total_k']/4700*100; $angka_k = number_format($k,2,",","."); echo $angka_k; ?></td>
																		<td class="text-right">4700</td>
																		<td class="text-center">mg</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Kalsium</td>
																		<td class="text-right">{{ $total_harga['total_ca'] }}</td>
																		<td class="text-center">mg</td>
																		<td class="text-right"><?php $ca = $total_harga['total_ca']/1100*100; $angka_ca = number_format($ca,2,",","."); echo $angka_ca; ?></td>
																		<td class="text-right">1100</td>
																		<td class="text-center">mg</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Zat Besi</td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right">22</td>
																		<td class="text-center">mg</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Fosfor</td>
																		<td class="text-right">{{ $total_harga['total_p'] }}</td>
																		<td class="text-center">mg</td>
																		<td class="text-right"><?php $p = $total_harga['total_p']/700*100; $angka_p = number_format($p,2,",","."); echo $angka_p; ?></td>
																		<td class="text-right">700</td>
																		<td class="text-center">mg</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Magnesium</td>
																		<td class="text-right">{{ $total_harga['total_mg'] }}</td>
																		<td class="text-center">mg</td>
																		<td class="text-right"><?php $mg = $total_harga['total_mg']/350*100; $angka_mg = number_format($mg,2,",","."); echo $angka_mg; ?></td>
																		<td class="text-right">350</td>
																		<td class="text-center">mg</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Seng</td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																		<td class="text-right"></td>    
																		<td class="text-right">13</td>
																		<td class="text-center">mg</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Selenium</td>
																		<td class="text-right"></td>
																		<td class="text-center">mcg</td>
																		<td class="text-right"></td>
																		<td class="text-right">30</td>
																		<td class="text-center">mcg</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Lodium</td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right">150</td>
																		<td class="text-center">mcg</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Mangan</td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right">2000</td>
																		<td class="text-center">mg</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Flour</td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right">2.5</td>
																		<td class="text-center">mg</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Tembaga</td>
																		<td class="text-right"></td>
																		<td class="text-center"></td>
																		<td class="text-right"></td>
																		<td class="text-right"></td>
																		<td class="text-center"></td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Vitamin A</td>
																		<td class="text-right"></td>
																		<td class="text-center">IU</td>
																		<td class="text-right"></td>
																		<td class="text-right">1980</td>
																		<td class="text-center">IU</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Vitamin B1</td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right">1.4</td>
																		<td class="text-center">mg</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Vitamin B2</td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right">1.6</td>
																		<td class="text-center">mg</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Vitamin B3</td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right">15</td>
																		<td class="text-center">mg</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Vitamin B5</td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right">5</td>
																		<td class="text-center">mg</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Vitamin B6</td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right">1.3</td>
																		<td class="text-center">mg</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Vitamin B12</td>
																		<td class="text-right"></td>
																		<td class="text-center">mcg</td>
																		<td class="text-right"></td>
																		<td class="text-right">2.4</td>
																		<td class="text-center">mcg</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Vitamin C</td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right">90</td>
																		<td class="text-center">mg</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Vitamin D3</td>
																		<td class="text-right"></td>
																		<td class="text-center">IU</td>
																		<td class="text-right"></td>
																		<td class="text-right">400</td>
																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																										<td class="text-center">IU</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Vitamin E</td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right">15</td>
																		<td class="text-center">mg</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Asam Folat</td>
																		<td class="text-right"></td>
																		<td class="text-center">mcg</td>
																		<td class="text-right"></td>
																		<td class="text-right">400</td>
																		<td class="text-center">mcg</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Magnesium Aspartat</td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Kolin</td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Biotin</td>
																		<td class="text-right"></td>
																		<td class="text-center">mcg</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td>
																		<td class="text-center">mcg</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Inositol</td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Molibdenum</td>
																		<td class="text-right"></td>
																		<td class="text-center">mcg</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td>
																		<td class="text-center">mcg</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Kromium</td>
																		<td class="text-right"></td>
																		<td class="text-center">mcg</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td>
																		<td class="text-center">mcg</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>EPA</td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>DHA</td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Glukosamin</td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Kondroitin</td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Kolagen</td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>EGCG</td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Kreatina</td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>MCT</td>
																		<td class="text-right"></td>
																		<td class="text-center">g</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td>
																		<td class="text-center">g</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>CLA</td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Omega 3</td>
																		<td class="text-right"></td>
																		<td class="text-center">g</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td>
																		<td class="text-center">g</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Omega 6</td>
																		<td class="text-right"></td>
																		<td class="text-center">g</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td>
																		<td class="text-center">g</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Omega 9</td>
																		<td class="text-right"></td>
																		<td class="text-center">g</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td>
																		<td class="text-center">g</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Klorida</td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Asam Linoleat</td>
																		<td class="text-right"></td>
																		<td class="text-center">g</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td>
																		<td class="text-center">g</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Energi dari Asam Linoleat</td>
																		<td class="text-right"></td>
																		<td class="text-center">kkal</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td>
																		<td class="text-center">kkal</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Energi dari Protein</td>
																		<td class="text-right"></td>
																		<td class="text-center">kkal</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td>
																		<td class="text-center">kkal</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>L-Karnitin</td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>L-Glutamin</td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>**Thereonin</td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>**Methionin</td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>**Phenilalanin</td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>**Histidin</td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>**Lisin</td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>**BCAA</td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>**Valin</td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>**Isoleusin</td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>**Leusin</td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Alanin</td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Asam Aspartat</td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Asam Glutamat</td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Sistein</td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Serin</td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Glisin</td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Tyrosin</td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Proline</td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Arginine</td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>Gluten</td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td>
																		<td class="text-center">mg</td>
																	</tr>
																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="3">
							@php $no = 0; @endphp
							<h4><i class="fa fa-angle-right"></i> HPP FORMULA</h4>
							@if ($ada > 0)
							<div class="row">
								<div class="col-md-5">
									<table class="table table-bordered" style="font-size:12px">
										<thead>
											<th colspan="4" style="font-weight: bold;color:white;background-color: #2a3f54;"><center>Bahan Baku</center></th>
										</thead>
										<thead>
											<th>No</th>
											<th>Kode Item</th>
											<th>Nama Bahan</th>
											<th>Harga PerGram</th>
										</thead>
										<tbody>
											@foreach ($detail_harga->sortByDesc('harga_per_serving') as $fortail)
											<tr>
												<td>{{ ++$no }}</td>
												<td>{{ $fortail['kode_komputer'] }}</td>
												<td>{{ $fortail['nama_sederhana'] }}</td>
												<td>Rp.{{ $fortail['hpg'] }}</td>
											</tr>
											@endforeach
											<tr style="font-weight: bold;color:black;background-color: #ddd;">
												<td colspan="3">Jumlah</td>
												<td>Rp.{{ $total_harga['total_harga_per_gram'] }}</td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="col-md-2">
									<table class="table table-bordered" style="font-size:12px">
										<thead>
											<th colspan="3" style="font-weight: bold;color:white;background-color: #2a3f54;"><center>Per Serving</center></th>                                                                                                                
										</thead>
										<thead>
											<th>Berat</th>
											<th>%</th>
											<th>Harga</th>
										</thead>
										<tbody>
											@foreach ($detail_harga->sortByDesc('harga_per_serving') as $fortail)
											<tr>
												<td>{{ $fortail['per_serving'] }}</td>
												<td>{{ $fortail['persen'] }}</td>
												<td>Rp.{{ $fortail['harga_per_serving'] }}</td>
											</tr>
											@endforeach
											<tr style="font-weight: bold;color:black;background-color: #ddd;">
												<td>{{ $total_harga['total_berat_per_serving'] }}</td>
												<td>{{ $total_harga['total_persen'] }}</td>
												<td>Rp.{{ $total_harga['total_harga_per_serving'] }}</td>
											</tr>                                                        
										</tbody>
									</table>
								</div>
								<div class="col-md-3">
									<table class="table table-bordered" style="font-size:12px">
										<thead>
											<th colspan="2" style="font-weight: bold;color:white;background-color: #2a3f54;"><center>Per Batch</center></th>
										</thead>
										<thead>
											<th>Berat</th>
											<th>Harga</th>
										</thead>
										<tbody>
											@foreach ($detail_harga->sortByDesc('harga_per_serving') as $fortail)
											<tr>
												<td>{{ $fortail['per_batch'] }}</td>
												<td>Rp.{{ $fortail['harga_per_batch'] }}</td>
											</tr>
											@endforeach
											<tr style="font-weight: bold;color:black;background-color: #ddd;">
												<td>{{ $total_harga['total_berat_per_batch'] }}</td>
												<td>Rp.{{ $total_harga['total_harga_per_batch'] }}</td>                                                        
											</tr> 
										</tbody>
									</table>
								</div>
								<div class="col-md-2">
									<table class="table table-bordered" style="font-size:12px">
										<thead>
											<th colspan="2" style="font-weight: bold;color:white;background-color: #2a3f54;"><center>Per Kg</center></th>
										</thead>
										<thead>
											<th>Berat</th>
											<th>Harga</th>
										</thead>
										<tbody>
											@foreach ($detail_harga->sortByDesc('harga_per_serving') as $fortail)
											<tr>
												<td>{{ $fortail['per_kg'] }}</td>
												<td>Rp.{{ $fortail['harga_per_kg'] }}</td>
											</tr>
											@endforeach
											<tr style="font-weight: bold;color:black;background-color: #ddd;">
												{{-- <td>{{ $total_harga['total_berat_per_kg'] }}</td> --}}
												<td>1000</td>
												<td>Rp.{{ $total_harga['total_harga_per_kg'] }}</td>
											</tr> 
										</tbody>
									</table>
								</div>
							</div>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>    
	</div>

  {{-- Modal Chat --}}
  <div class="modal fade" id="myModalChat" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-envelope-o"></i> Pesan Baru</h4>
        </div>
        <div class="modal-body">
          <form action="{{ route('send.email') }}" method="POST">
          {{-- Hidden Input --}}
          <input type="hidden" name="workbook_id" value="{{ $formula->workbook->id }}">
          <input type="hidden" name="jenis" value="dev">
          <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
          {{-- Start--}}
          <div class="row">
            <div class="col-md-6">
              <label class="label label-primary">Kirim Ke :</label><br>                      
              <select name="jenis2" class="form-control">
                <option value="pv">PV(Manager)</option>
                <option value="finance">Tim Finance</option>
                <option value="admin">Admin</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="label label-info">Formula :</label><br>                      
              <select name=formula_id class="form-control">
                <option value="no">Pilih Formula</option>
                <option value="{{ $formula->id }}">Versi {{ $formula->versi }}.{{ $formula->turunan }}</option>                                
              </select>
            </div>
          </div>
          <div style="margin-top: 15px;height:300px">
            <textarea class="form-control edit" style="min-width: 100%;min-height: 100%" name="pesan"></textarea>                
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> Kirim</button>
          </form>
        </div>
      </div>
    </div>
	</div>
</div>
@endsection