@extends('formula.tempformula')
@section('title', 'Summarry Formula')
@section('judul', 'Summarry Formula')
@section('content')

<div class="x_panel">
  <div class="x_title">
    <h3><li class="fa fa-wpforms"> Summary Formula</h3>
  </div>
  <div class="card-block">
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
											<th width="10%">Product Name </th>
											<th width="45%">: {{ $formula->Workbook->datapkpp->project_name }}</th>
										<tr>
									</table>
				
									<table ALIGN="right">
										<tr><th class="text-right">Created Date : {{ $formula->created_at}} </th></tr>
										<tr><th class="text-right">jumlah/batch : {{ $formula->batch }}  g</th></tr>
									</table><br><br>
				
									<table class="table table-bordered" style="font-size:12px">
										<thead style="font-weight: bold;color:white;background-color: #2a3f54;">
											<tr>
												<th class="text-center" style="width:3%">No</th>                      
												<th class="text-center" style="width:20%">Nama Sederhana</th>
												<th class="text-center" style="width:20%">Nama Bahan</th>
												<th class="text-center" style="width:25%">Principle</th>
												<th class="text-center" style="width:8%">PerServing (gr)</th>
												<th class="text-center" style="width:8%">PerBatch (gr)</th>
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
												<td>{{ $fortail['per_serving'] }}</td>
												<td>{{ $fortail['per_batch'] }}</td>
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
												<td>{{ $fortail['per_serving'] }}</td>
												<td>{{ $fortail['per_batch'] }}</td>
												<td>{{ $fortail['persen'] }} &nbsp;%</td>
											</tr>                                                       
											@endif
											@endforeach
											{{-- Jumlah --}}
											<tr style="font-size: 12px;font-weight: bold; color:black;background-color: rgb(78, 205, 196, 0.5);">
												<td colspan="4">Jumlah</td>
												<td>{{ $formula->serving }}</td>
												<td>{{ $formula->batch }}</td>
												<td> 100 % </td>
											</tr>
										</tbody>
									</table>
									
									
									<div class="row">
										@if(auth()->user()->role->namaRule =='manager')
										<form class="form-horizontal form-label-left" method="POST" action="{{ route('updatenote',[$formula->id,$formula->workbook_id]) }}">
										<div class="form-group">
											<label class="control-label col-md-1 col-sm-1 col-xs-12">Note Formula</label>
											<div class="col-md-4 col-sm-4 col-xs-12">
												<textarea name="formula" id="formula" maxlength="200" disabled placeholder="max 200 character" value="{{ $formula->note_formula }}" class="col-md-12 col-sm-12 col-xs-12" rows="4">{{ $formula->note_formula }}</textarea>
											</div>
											<label class="control-label col-md-1 col-sm-1 col-xs-12">Note Manager</label>
											<div class="col-md-4 col-sm-4 col-xs-12">
												<textarea name="manager" id="manager" value="{{ $formula->catatan_manager }}" class="col-md-12 col-sm-12 col-xs-12" rows="4">{{ $formula->catatan_manager }}</textarea>
											</div>
											<button type="submit" class="btn status btn-primary btn-sm"><li class="fa fa-check"></li> Submit Note</button>
											<input type="hidden" name="_token" value="{{ csrf_token() }}">
											{{ method_field('PATCH') }}
										</div>
										</form>
										@elseif(auth()->user()->role->namaRule =='user_produk')
										<div class="form-group">
											<label class="control-label col-md-2 col-sm-2 col-xs-12">Note Formula</label>
											<div class="col-md-4 col-sm-4 col-xs-12">
												<textarea name="formula" id="formula" maxlength="200" disabled placeholder="max 200 character" value="{{ $formula->note_formula }}" class="col-md-12 col-sm-12 col-xs-12" rows="4">{{ $formula->note_formula }}</textarea>
											</div>
											<label class="control-label col-md-2 col-sm-2 col-xs-12">Note Manager</label>
											<div class="col-md-4 col-sm-4 col-xs-12">
												<textarea name="manager" disabled id="manager" value="{{ $formula->catatan_manager }}" class="col-md-12 col-sm-12 col-xs-12" rows="4">{{ $formula->catatan_manager }}</textarea>
											</div>
										</div>
										@else
										<div class="form-group">
											<label class="control-label col-md-2 col-sm-2 col-xs-12">Note Formula</label>
											<div class="col-md-9 col-sm-9 col-xs-12">
												<textarea name="formula" id="formula" maxlength="200" disabled placeholder="max 200 character" value="{{ $formula->note_formula }}" class="col-md-12 col-sm-12 col-xs-12" rows="4">{{ $formula->note_formula }}</textarea>
											</div>
										</div>
										@endif
									</div><br>
									<div class="row">
										<div class="col-md-6">
											<table>
												<tr><td colspan="3"><b> Formula Ini mengandung Allergen </b></td></tr>
												<tr><td><b> Contain </b></td><td>: 	@foreach($allergen_bb as $allergen) {{$allergen->allergen_countain}},@endforeach</td><td></td></tr>
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
															<table class="table table-advanced table-bordered">
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
																		<td colspan="3" class="text-center">Total : </td>
																		<td>{{ $formula->serving }}</td>
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
																		<td>{{ $total_harga['total_glucosamine']}}</td>
																		<td>{{ $total_harga['total_kolin']}}</td>
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
																		<td></td>
																		<th class="text-center">Parameter</th>
																		<th class="text-center">Gramasi</th>
																		<th class="text-center">unit</th>
																		<th class="text-center">%AKG</th>
																		<th class="text-center">AKG</th>
																		<th class="text-center">unit</th>
																		<th>Overrage</th>
																	</tr>
																</thead>
																<tbody>
																	@foreach($akg as $akg)
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->energi_total!='yes')<input type="checkbox" name="energi_total" value="yes" id="energi_total">
																			@else<input type="checkbox" value="yes" checked name="energi_total" id="energi_total">@endif
																		</td>
																		<td>Energi Total</td>
																		<td class="text-right">{{ $total_harga['total_kalori'] }}</td><td class="text-center">kkal</td>
																		<td class="text-right"></td>
																		<td class="text-right">{{$akg->energi}}</td><td class="text-center">kkal</td>
																		<td class="text-right" style="background-color:#d1d1d1;">
																			@if($akg->energi_total!='yes'){{ $total_harga['total_kalori'] }}
																			@else($akg->energi_total!='no'){{ $total_harga['total_kalori'] * ($formula->overage/100) }}@endif
																		</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->energi_lemak!='yes')<input type="checkbox" name="energi_lemak" value="yes" id="energi_lemak">
																			@else<input type="checkbox" value="yes" checked name="energi_lemak" id="energi_lemak">@endif
																		</td>
																		<td>Energi Dari Lemak</td>
																		<td class="text-right">{{ $total_harga['total_lemak']*9 }}</td><td class="text-center">kkal</td>
																		<td class="text-right">NA</td>
																		<td class="text-right">NA</td><td class="text-center">kkal</td>
																		<td class="text-right" style="background-color:#d1d1d1;">
																			@if($akg->energi_lemak!='yes'){{ $total_harga['total_lemak']*9 }}
																			@else {{ ($total_harga['total_lemak']*9) * ($formula->overage/100) }} @endif
																		</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->energi_lemak_jenuh!='yes')<input type="checkbox" name="energi_lemak_jenuh" value="yes" id="energi_lemak_jenuh">
																			@else<input type="checkbox" value="yes" checked name="energi_lemak_jenuh" id="energi_lemak_jenuh">@endif
																		</td>
																		<td>Energi Dari Lemak Jenuh</td>
																		<td class="text-right">{{ $total_harga['total_lemak']*9 }}</td>
																		<td class="text-center">kkal</td>
																		<td class="text-right">NA</td>
																		<td class="text-right">NA</td>
																		<td class="text-center">kkal</td>
																		<td class="text-right" style="background-color:#d1d1d1;">
																			@if($akg->energi_lemak_jenuh!='yes'){{ $total_harga['total_lemak']*9 }}
																			@else {{ ($total_harga['total_lemak']*9) * ($formula->overage/100) }} @endif
																		</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->karbohidrat!='yes')<input type="checkbox" name="karbohidrat" value="yes" id="karbohidrat">
																			@else<input type="checkbox" value="yes" checked name="karbohidrat" id="karbohidrat">@endif
																		</td>
																		<td>Karbohidrat Total</td>
																		<td class="text-right">{{ $total_harga['total_karbohidrat'] }}</td>
																		<td class="text-center">g</td>
																		<td class="text-right"><?php $angka = $total_harga['total_karbohidrat']*($akg->karbohidrat_total/100); $angka_format = number_format($angka,2,",","."); echo $angka_format; ?></td>
																		<td class="text-right">{{$akg->karbohidrat_total}}</td>
																		<td class="text-center">g</td>
																		<td class="text-right" style="background-color:#d1d1d1;">
																			@if($akg->karbohidrat!='yes') {{ $total_harga['total_karbohidrat'] }}
																			@else {{ $total_harga['total_karbohidrat'] * ($formula->overage/100) }} @endif
																		</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->protein1!='yes')<input type="checkbox" name="protein1" value="yes" id="protein1">
																			@else<input type="checkbox" value="yes" checked name="protein1" id="protein1">@endif
																		</td>
																		<td>Protein</td>
																		<td class="text-right">{{ $total_harga['total_protein'] }}</td><td class="text-center">g</td>
																		<td class="text-right"><?php $protein = $total_harga['total_protein']*($akg->protein/100); $angka_protein = number_format($protein,2,",","."); echo $angka_protein; ?></td>
																		<td class="text-right">{{$akg->protein}}</td><td class="text-center">g</td>
																		<td class="text-right" style="background-color:#d1d1d1;">
																			@if($akg->protein1!='yes') {{ $total_harga['total_protein'] }}
																			@else {{ $total_harga['total_protein'] * ($formula->overage/100) }} @endif
																		</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->lemak_total!='yes')<input type="checkbox" name="lemak_total" value="yes" id="lemak_total">
																			@else<input type="checkbox" value="yes" checked name="lemak_total" id="lemak_total">@endif
																		</td>
																		<td>Lemak Total</td>
																		<td class="text-right">{{ $total_harga['total_lemak'] }}</td><td class="text-center">g</td>
																		<td class="text-right"><?php $lemak = $total_harga['total_lemak']* ($akg->lemak_total*100); $angka_lemak = number_format($lemak,2,",","."); echo $angka_lemak; ?></td>
																		<td class="text-right">{{$akg->lemak_total}}</td><td class="text-center">g</td>
																		<td class="text-right" style="background-color:#d1d1d1;">
																			@if($akg->lemak_total!='yes') {{ $total_harga['total_lemak'] }}
																			@else {{ $total_harga['total_lemak'] * ($formula->overage/100) }} @endif
																		</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->lemak_trans!='yes')<input type="checkbox" name="lemak_trans" value="yes" id="lemak_trans">
																			@else<input type="checkbox" value="yes" checked name="lemak_trans" id="lemak_trans">@endif
																		</td>
																		<td>Lemak Trans</td>
																		<td class="text-right">NA</td><td class="text-center">g</td>
																		<td class="text-right">NA</td>
																		<td class="text-right">NA</td><td class="text-center">g</td>
																		<td class="text-right" style="background-color:#d1d1d1;">NA</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->lemak_jenuh!='yes')<input type="checkbox" name="lemak_jenuh" value="yes" id="lemak_jenuh">
																			@else<input type="checkbox" value="yes" checked name="lemak_jenuh" id="lemak_jenuh">@endif
																		</td>
																		<td>Lemak Jenuh</td>
																		<td class="text-right">{{ $total_harga['total_sfa'] }}</td><td class="text-center">g</td>
																		<td class="text-right"><?php $sfa = $total_harga['total_sfa']*($akg->lemak_jenuh/100); $angka_sfa = number_format($sfa,2,",","."); echo $angka_sfa; ?></td>
																		<td class="text-right">{{$akg->lemak_jenuh}}</td><td class="text-center">g</td>
																		<td class="text-right" style="background-color:#d1d1d1;">
																			@if($akg->lemak_jenuh!='yes') {{ $total_harga['total_sfa'] }}
																			@else {{ $total_harga['total_sfa'] * ($formula->overage/100) }} @endif
																		</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->lemak_tidak_jenuh_tunggal!='yes')<input type="checkbox" name="lemak_tidak_jenuh_tunggal" value="yes" id="lemak_tidak_jenuh_tunggal">
																			@else<input type="checkbox" value="yes" checked name="lemak_tidak_jenuh_tunggal" id="lemak_tidak_jenuh_tunggal">@endif
																		</td>
																		<td>Lemak Tidak Jenuh Tunggal</td>
																		<td class="text-right">NA</td><td class="text-center">g</td>
																		<td class="text-right">NA</td>
																		<td class="text-right">NA</td><td class="text-center">g</td>
																		<td class="text-right" style="background-color:#d1d1d1;">NA</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->lemak_tidak_jenuh_ganda!='yes')<input type="checkbox" name="lemak_tidak_jenuh_ganda" value="yes" id="lemak_tidak_jenuh_ganda">
																			@else<input type="checkbox" value="yes" checked name="lemak_tidak_jenuh_ganda" id="lemak_tidak_jenuh_ganda">@endif
																		</td>
																		<td>Lemak Tidak Jenuh Ganda</td>
																		<td class="text-right">NA</td><td class="text-center">g</td>
																		<td class="text-right">NA</td>
																		<td class="text-right">NA</td><td class="text-center">g</td>
																		<td class="text-right" style="background-color:#d1d1d1;">NA</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->kolestrol!='yes')<input type="checkbox" name="kolestrol" value="yes" id="kolestrol">
																			@else<input type="checkbox" value="yes" checked name="kolestrol" id="kolestrol">@endif
																		</td>
																		<td>Kolestrol</td>
																		<td class="text-right">NA</td><td class="text-center">mg</td>
																		<td class="text-right">NA</td>
																		<td class="text-right">{{$akg->kolesterol}}</td><td class="text-center">mg</td>
																		<td class="text-right" style="background-color:#d1d1d1;">NA</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->gula!='yes')<input type="checkbox" name="gula" value="yes" id="gula">
																			@else<input type="checkbox" value="yes" checked name="gula" id="gula">@endif
																		</td>
																		<td>Gula</td>
																		<td class="text-right">{{ $total_harga['total_gula'] }}</td>  <td class="text-center">g</td>
																		<td class="text-right">NA</td>
																		<td class="text-right">NA</td><td class="text-center">g</td>
																		<td class="text-right" style="background-color:#d1d1d1;">
																			@if($akg->gula!='yes'){{ $total_harga['total_gula'] }}
																			@else	{{ $total_harga['total_gula'] * ($formula->overage/100) }} @endif
																		</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->serat_pangan!='yes')<input type="checkbox" name="serat_pangan" value="yes" id="serat_pangan">
																			@else<input type="checkbox" value="yes" checked name="serat_pangan" id="serat_pangan">@endif
																		</td>
																		<td>Serat Pangan</td>
																		<td class="text-right">{{ $total_harga['total_serat'] }}</td><td class="text-center">g</td>
																		<td class="text-right"><?php $serat = $total_harga['total_serat']*($akg->serat_pangan/100); $angka_serat = number_format($serat,2,",","."); echo $angka_serat; ?></td>
																		<td class="text-right">{{$akg->serat_pangan}}</td><td class="text-center">g</td>
																		<td class="text-right" style="background-color:#d1d1d1;">
																			@if($akg->serat_pangan!='yes'){{ $total_harga['total_serat'] }}
																			@else	{{ $total_harga['total_serat'] * ($formula->overage/100) }} @endif
																		</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->serat_pangan_larut!='yes')<input type="checkbox" name="serat_pangan_larut" value="yes" id="serat_pangan_larut">
																			@else<input type="checkbox" value="yes" checked name="serat_pangan_larut" id="serat_pangan_larut">@endif
																		</td>
																		<td>Serat Pangan Larut</td>
																		<td class="text-right">{{ $total_harga['total_seratL'] }}</td><td class="text-center">g</td>
																		<td class="text-right">NA</td>
																		<td class="text-right">NA</td><td class="text-center">g</td>
																		<td class="text-right" style="background-color:#d1d1d1;">
																			@if($akg->serat_pangan_larut!='yes'){{ $total_harga['total_seratL'] }}
																			@else {{ $total_harga['total_seratL'] * ($formula->overage/100) }} @endif
																		</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->sukrosa!='yes')<input type="checkbox" name="sukrosa" value="yes" id="sukrosa">
																			@else<input type="checkbox" value="yes" checked name="sukrosa" id="sukrosa">@endif
																		</td>
																		<td>Serat Pangan Tidak Larut</td>
																		<td class="text-right">NA</td><td class="text-center">g</td>
																		<td class="text-right">NA</td>
																		<td class="text-right">NA</td><td class="text-center">g</td>
																		<td class="text-right" style="background-color:#d1d1d1;">NA</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->laktosa!='yes')<input type="checkbox" name="laktosa" value="yes" id="laktosa">
																			@else<input type="checkbox" value="yes" checked name="laktosa" id="laktosa">@endif
																		</td>
																		<td>Sukrosa</td>
																		<td class="text-right">{{ $total_harga['total_sukrosa'] }}</td><td class="text-center">g</td>
																		<td class="text-right">NA</td>
																		<td class="text-right">NA</td><td class="text-center">g</td>
																		<td class="text-right" style="background-color:#d1d1d1;">
																			@if($akg->laktosa!='yes'){{ $total_harga['total_sukrosa'] }}
																			@else	{{ $total_harga['total_sukrosa'] * ($formula->overage/100) }} @endif
																		</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->laktosa!='yes')<input type="checkbox" name="laktosa" value="yes" id="laktosa">
																			@else<input type="checkbox" value="yes" checked name="laktosa" id="laktosa">@endif
																		</td>
																		<td>Laktosa</td>
																		<td class="text-right">{{ $total_harga['total_laktosa'] }}</td><td class="text-center">g</td>
																		<td class="text-right">NA</td>
																		<td class="text-right">NA</td><td class="text-center">g</td>
																		<td class="text-right" style="background-color:#d1d1d1;">
																			@if($akg->laktosa!='yes'){{ $total_harga['total_laktosa'] }}
																			@else	{{ $total_harga['total_laktosa'] * ($formula->overage/100) }} @endif
																		</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->gula_alkohol!='yes')<input type="checkbox" name="gula_alkohol" value="yes" id="gula_alkohol">
																			@else<input type="checkbox" value="yes" checked name="gula_alkohol" id="gula_alkohol">@endif
																		</td>
																		<td>Gula Alkohol</td>
																		<td class="text-right">NA</td><td class="text-center">g</td>
																		<td class="text-right">NA</td>
																		<td class="text-right">NA</td><td class="text-center">g</td>
																		<td class="text-right" style="background-color:#d1d1d1;">NA</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->natrium!='yes')<input type="checkbox" name="natrium" value="yes" id="natrium">
																			@else<input type="checkbox" value="yes" checked name="natrium" id="natrium">@endif
																		</td>
																		<td>Natrium</td>
																		<td class="text-right">{{ $total_harga['total_na'] }}</td><td class="text-center">mg</td>
																		<td class="text-right"><?php $na = $total_harga['total_na']*($akg->natrium/100); $angka_na = number_format($na,2,",","."); echo $angka_na; ?></td>
																		<td class="text-right">{{$akg->natrium}}</td><td class="text-center">mg</td>
																		<td class="text-right" style="background-color:#d1d1d1;">
																			@if($akg->natrium!='yes'){{ $total_harga['total_na'] }}
																			@else	{{ $total_harga['total_na'] * ($formula->overage/100) }} @endif
																		</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->kalium!='yes')<input type="checkbox" name="kalium" value="yes" id="kalium">
																			@else<input type="checkbox" value="yes" checked name="kalium" id="kalium">@endif
																		</td>
																		<td>Kalium</td>
																		<td class="text-right">{{ $total_harga['total_k'] }}</td><td class="text-center">mg</td>
																		<td class="text-right"><?php $k = $total_harga['total_k']* ($akg->kalium/100); $angka_k = number_format($k,2,",","."); echo $angka_k; ?></td>
																		<td class="text-right">{{$akg->kalium}}</td><td class="text-center">mg</td>
																		<td class="text-right" style="background-color:#d1d1d1;">
																			@if($akg->kalium!='yes'){{ $total_harga['total_k'] }}
																			@else	{{ $total_harga['total_k'] * ($formula->overage/100) }} @endif
																		</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->kalsium!='yes')<input type="checkbox" name="kalsium" value="yes" id="kalsium">
																			@else<input type="checkbox" value="yes" checked name="kalsium" id="kalsium">@endif
																		</td>
																		<td>Kalsium</td>
																		<td class="text-right">{{ $total_harga['total_ca'] }}</td><td class="text-center">mg</td>
																		<td class="text-right"><?php $ca = $total_harga['total_ca']*($akg->kalsium/100); $angka_ca = number_format($ca,2,",","."); echo $angka_ca; ?></td>
																		<td class="text-right">{{$akg->kalsium}}</td><td class="text-center">mg</td>
																		<td class="text-right" style="background-color:#d1d1d1;">
																			@if($akg->kalsium!='yes'){{ $total_harga['total_ca'] }}
																			@else	{{ $total_harga['total_ca'] * ($formula->overage/100) }} @endif
																		</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->zat_besi!='yes')<input type="checkbox" name="zat_besi" value="yes" id="zat_besi">
																			@else<input type="checkbox" value="yes" checked name="zat_besi" id="zat_besi">@endif
																		</td>
																		<td>Zat Besi</td>
																		<td class="text-right">NA</td><td class="text-center">mg</td>
																		<td class="text-right">NA</td>
																		<td class="text-right">{{$akg->besi}}</td><td class="text-center">mg</td>
																		<td class="text-right" style="background-color:#d1d1d1;">NA</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->fosfor!='yes')<input type="checkbox" name="fosfor" value="yes" id="fosfor">
																			@else<input type="checkbox" value="yes" checked name="fosfor" id="fosfor">@endif
																		</td>
																		<td>Fosfor</td>
																		<td class="text-right">{{ $total_harga['total_p'] }}</td><td class="text-center">mg</td>
																		<td class="text-right"><?php $p = $total_harga['total_p']*($akg->fosfor/100); $angka_p = number_format($p,2,",","."); echo $angka_p; ?></td>
																		<td class="text-right">{{$akg->fosfor}}</td><td class="text-center">mg</td>
																		<td class="text-right" style="background-color:#d1d1d1;">
																			@if($akg->fosfor!='yes'){{ $total_harga['total_p'] }}
																			@else	{{ $total_harga['total_p'] * ($formula->overage/100) }} @endif
																		</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->magnesium!='yes')<input type="checkbox" name="magnesium" value="yes" id="magnesium">
																			@else<input type="checkbox" value="yes" checked name="magnesium" id="magnesium">@endif
																		</td>
																		<td>Magnesium</td>
																		<td class="text-right">{{ $total_harga['total_mg'] }}</td><td class="text-center">mg</td>
																		<td class="text-right"><?php $mg = $total_harga['total_mg']*($akg->magnesium*100); $angka_mg = number_format($mg,2,",","."); echo $angka_mg; ?></td>
																		<td class="text-right">{{$akg->magnesium}}</td><td class="text-center">mg</td>
																		<td class="text-right" style="background-color:#d1d1d1;">
																			@if($akg->magnesium!='yes') {{ $total_harga['total_mg'] }}
																			@else	{{ $total_harga['total_mg'] * ($formula->overage/100) }} @endif
																		</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->seng!='yes')<input type="checkbox" name="seng" value="yes" id="seng">
																			@else<input type="checkbox" value="yes" checked name="seng" id="seng">@endif
																		</td>
																		<td>Seng</td>
																		<td class="text-right">NA</td><td class="text-center">mg</td>
																		<td class="text-right">NA</td>    
																		<td class="text-right">{{$akg->seng}}</td><td class="text-center">mg</td>
																		<td class="text-right" style="background-color:#d1d1d1;">NA</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->selenium!='yes')<input type="checkbox" name="selenium" value="yes" id="selenium">
																			@else<input type="checkbox" value="yes" checked name="selenium" id="selenium">@endif
																		</td>
																		<td>Selenium</td>
																		<td class="text-right">NA</td><td class="text-center">mcg</td>
																		<td class="text-right">NA</td>
																		<td class="text-right">{{$akg->selenium}}</td><td class="text-center">mcg</td>
																		<td class="text-right" style="background-color:#d1d1d1;">NA</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->lodium!='yes')<input type="checkbox" name="lodium" value="yes" id="lodium">
																			@else<input type="checkbox" value="yes" checked name="lodium" id="lodium">@endif
																		</td>
																		<td>Lodium</td>
																		<td class="text-right">NA</td><td class="text-center">mg</td>
																		<td class="text-right">NA</td>
																		<td class="text-right">{{$akg->lodium}}</td><td class="text-center">mcg</td>
																		<td class="text-right" style="background-color:#d1d1d1;">NA</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->mangan!='yes')<input type="checkbox" name="mangan" value="yes" id="mangan">
																			@else<input type="checkbox" value="yes" checked name="mangan" id="mangan">@endif
																		</td>
																		<td>Mangan</td>
																		<td class="text-right">NA</td><td class="text-center">mg</td>
																		<td class="text-right">NA</td>
																		<td class="text-right">{{$akg->mangan}}</td><td class="text-center">mg</td>
																		<td class="text-right" style="background-color:#d1d1d1;">NA</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->flour!='yes')<input type="checkbox" name="flour" value="yes" id="flour">
																			@else<input type="checkbox" value="yes" checked name="flour" id="flour">@endif
																		</td>
																		<td>Flour</td>
																		<td class="text-right">NA</td><td class="text-center">mg</td>
																		<td class="text-right">NA</td>
																		<td class="text-right">{{$akg->fluor}}</td><td class="text-center">mg</td>
																		<td class="text-right" style="background-color:#d1d1d1;">NA</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->tembaga!='yes')<input type="checkbox" name="tembaga" value="yes" id="tembaga">
																			@else<input type="checkbox" value="yes" checked name="tembaga" id="tembaga">@endif
																		</td>
																		<td>Tembaga</td>
																		<td class="text-right">NA</td><td class="text-center"></td>
																		<td class="text-right">NA</td>
																		<td class="text-right">{{$akg->tembaga}}</td><td class="text-center"></td>
																		<td class="text-right" style="background-color:#d1d1d1;">NA</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->vitA!='yes')<input type="checkbox" name="vitA" value="yes" id="vitA">
																			@else<input type="checkbox" value="yes" checked name="vitA" id="vitA">@endif
																		</td>
																		<td>Vitamin A</td>
																		<td class="text-right"></td><td class="text-center">IU</td>
																		<td class="text-right"></td>
																		<td class="text-right">{{$akg->vitamin_a}}</td><td class="text-center">IU</td>
																		<td class="text-right" style="background-color:#d1d1d1;"></td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->vitB1!='yes')<input type="checkbox" name="vitB1" value="yes" id="vitB1">
																			@else<input type="checkbox" value="yes" checked name="vitB1" id="vitB1">@endif
																		</td>
																		<td>Vitamin B1</td>
																		<td class="text-right"></td><td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right">{{$akg->vitamin_b1}}</td><td class="text-center">mg</td>
																		<td class="text-right" style="background-color:#d1d1d1;"></td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->vitB2!='yes')<input type="checkbox" name="vitB2" value="yes" id="vitB2">
																			@else<input type="checkbox" value="yes" checked name="vitB2" id="vitB2">@endif
																		</td>
																		<td>Vitamin B2</td>
																		<td class="text-right">NA</td><td class="text-center">mg</td>
																		<td class="text-right">NA</td>
																		<td class="text-right">{{$akg->vitamin_b2}}</td><td class="text-center">mg</td>
																		<td class="text-right" style="background-color:#d1d1d1;">NA</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->vitB3!='yes')<input type="checkbox" name="vitB3" value="yes" id="vitB3">
																			@else<input type="checkbox" value="yes" checked name="vitB3" id="vitB3">@endif
																		</td>
																		<td>Vitamin B3</td>
																		<td class="text-right"></td><td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right">{{$akg->vitamin_b3}}</td><td class="text-center">mg</td>
																		<td class="text-right" style="background-color:#d1d1d1;"></td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->vitB5!='yes')<input type="checkbox" name="vitB5" value="yes" id="vitB5">
																			@else<input type="checkbox" value="yes" checked name="vitB5" id="vitB5">@endif
																		</td>
																		<td>Vitamin B5</td>
																		<td class="text-right">NA</td><td class="text-center">mg</td>
																		<td class="text-right">NA</td>
																		<td class="text-right">{{$akg->vitamin_b5}}</td><td class="text-center">mg</td>
																		<td class="text-right" style="background-color:#d1d1d1;">NA</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->vitB6!='yes')<input type="checkbox" name="vitB6" value="yes" id="vitB6">
																			@else<input type="checkbox" value="yes" checked name="vitB6" id="vitB6">@endif
																		</td>
																		<td>Vitamin B6</td>
																		<td class="text-right"></td><td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right">{{$akg->vitamin_b6}}</td><td class="text-center">mg</td>
																		<td class="text-right" style="background-color:#d1d1d1;"></td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->vitB12!='yes')<input type="checkbox" name="vitB12" value="yes" id="vitB12">
																			@else<input type="checkbox" value="yes" checked name="vitB12" id="vitB12">@endif
																		</td>
																		<td>Vitamin B12</td>
																		<td class="text-right">NA</td><td class="text-center">mcg</td>
																		<td class="text-right">NA</td>
																		<td class="text-right">{{$akg->vitamin_b12}}</td><td class="text-center">mcg</td>
																		<td class="text-right" style="background-color:#d1d1d1;">NA</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->vitC!='yes')<input type="checkbox" name="vitC" value="yes" id="vitC">
																			@else<input type="checkbox" value="yes" checked name="vitC" id="vitC">@endif
																		</td>
																		<td>Vitamin C</td><td class="text-right"></td>
																		<td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right">{{$akg->vitamin_c}}</td><td class="text-center">mg</td>
																		<td class="text-right" style="background-color:#d1d1d1;"></td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->vitD3!='yes')<input type="checkbox" name="vitD3" value="yes" id="vitD3">
																			@else<input type="checkbox" value="yes" checked name="vitD3" id="vitD3">@endif
																		</td>
																		<td>Vitamin D3</td>
																		<td class="text-right">{{ $total_harga['total_vitD'] }}</td><td class="text-center">IU</td>
																		<td class="text-right">{{ $total_harga['total_vitD'] * ($akg->vitamin_d/100) }}</td>
																		<td class="text-right">{{$akg->vitamin_d}}</td><td class="text-center">IU</td>
																		<td class="text-right" style="background-color:#d1d1d1;">
																			@if($akg->vitD3!='yes') {{ $total_harga['total_vitD'] }}
																			@else	{{ $total_harga['total_vitD']* ($formula->overage/100) }} @endif
																		</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->vitE!='yes')<input type="checkbox" name="vitE" value="yes" id="vitE">
																			@else<input type="checkbox" value="yes" checked name="vitE" id="vitE">@endif
																		</td>
																		<td>Vitamin E</td>
																		<td class="text-right"></td><td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right">{{$akg->vitamin_e}}</td><td class="text-center">mg</td>
																		<td class="text-right" style="background-color:#d1d1d1;"></td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->asam_folat!='yes')<input type="checkbox" name="asam_folat" value="yes" id="asam_folat">
																			@else<input type="checkbox" value="yes" checked name="asam_folat" id="asam_folat">@endif
																		</td>
																		<td>Asam Folat</td>
																		<td class="text-right"></td><td class="text-center">mcg</td>
																		<td class="text-right">NA</td>
																		<td class="text-right">NA</td><td class="text-center">mcg</td>
																		<td class="text-right" style="background-color:#d1d1d1;"></td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->magnesium_aspartat!='yes')<input type="checkbox" name="magnesium_aspartat" value="yes" id="magnesium_aspartat">
																			@else<input type="checkbox" value="yes" checked name="magnesium_aspartat" id="magnesium_aspartat">@endif
																		</td>
																		<td>Magnesium Aspartat</td>
																		<td class="text-right">NA</td><td class="text-center">mg</td>
																		<td class="text-right">NA</td>
																		<td class="text-right">NA</td><td class="text-center">mg</td>
																		<td class="text-right" style="background-color:#d1d1d1;">NA</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->kolin!='yes')<input type="checkbox" name="kolin" value="yes" id="kolin">
																			@else<input type="checkbox" value="yes" checked name="kolin" id="kolin">@endif
																		</td>
																		<td>Kolin</td>
																		<td class="text-right">{{ $total_harga['total_kolin']}}</td><td class="text-center">mg</td>
																		<td class="text-right"><?php $kolin = $total_harga['total_kolin']*($akg->kolin*100); $angka_kolin = number_format($kolin,2,",","."); echo $angka_kolin; ?></td>
																		<td class="text-right">{{$akg->kolin}}</td><td class="text-center">mg</td>
																		<td class="text-right" style="background-color:#d1d1d1;">
																			@if($akg->kolin!='yes') {{ $total_harga['total_kolin']}}
																			@else	{{ $total_harga['total_kolin']* ($formula->overage/100)}} @endif
																		</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->biotin!='yes')<input type="checkbox" name="biotin" value="yes" id="biotin">
																			@else<input type="checkbox" value="yes" checked name="biotin" id="biotin">@endif
																		</td>
																		<td>Biotin</td>
																		<td class="text-right">NA</td><td class="text-center">mcg</td>
																		<td class="text-right">NA</td>
																		<td class="text-right">{{$akg->biotin}}</td><td class="text-center">mcg</td>
																		<td class="text-right" style="background-color:#d1d1d1;">NA</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->Inositol!='yes')<input type="checkbox" name="Inositol" value="yes" id="Inositol">
																			@else<input type="checkbox" value="yes" checked name="Inositol" id="Inositol">@endif
																		</td>
																		<td>Inositol</td>
																		<td class="text-right">NA</td><td class="text-center">mg</td>
																		<td class="text-right">NA</td>
																		<td class="text-right">{{$akg->myo_inositol}}</td><td class="text-center">mg</td>
																		<td class="text-right" style="background-color:#d1d1d1;">NA</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->Molibdenum!='yes')<input type="checkbox" name="Molibdenum" value="yes" id="Molibdenum">
																			@else<input type="checkbox" value="yes" checked name="Molibdenum" id="Molibdenum">@endif
																		</td>
																		<td>Molibdenum</td>
																		<td class="text-right">NA</td><td class="text-center">mcg</td>
																		<td class="text-right">NA</td>
																		<td class="text-right">NA</td><td class="text-center">mcg</td>
																		<td class="text-right" style="background-color:#d1d1d1;">NA</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->Kromium!='yes')<input type="checkbox" name="Kromium" value="yes" id="Kromium">
																			@else<input type="checkbox" value="yes" checked name="Kromium" id="Kromium">@endif
																		</td>
																		<td>Kromium</td>
																		<td class="text-right">{{ $total_harga['total_cr'] }}</td><td class="text-center">mcg</td>
																		<td class="text-right"><?php $cr = $total_harga['total_cr']*($akg->kromium*100); $angka_cr = number_format($cr,2,",","."); echo $angka_cr; ?></td>
																		<td class="text-right">{{$akg->kromium}}</td><td class="text-center">mcg</td>
																		<td class="text-right" style="background-color:#d1d1d1;">
																			@if($akg->Kromium!='yes') {{ $total_harga['total_cr'] }}
																			@else	{{ $total_harga['total_cr']* ($formula->overage/100) }} @endif
																		</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->EPA!='yes')<input type="checkbox" name="EPA" value="yes" id="EPA">
																			@else<input type="checkbox" value="yes" checked name="EPA" id="EPA">@endif
																		</td>
																		<td>EPA</td>
																		<td class="text-right">{{ $total_harga['total_epa'] }}</td><td class="text-center">mg</td>
																		<td class="text-right">na</td>
																		<td class="text-right">na</td><td class="text-center">mg</td>
																		<td class="text-right" style="background-color:#d1d1d1;">
																			@if($akg->EPA!='yes') {{ $total_harga['total_epa'] }} 
																			@else	{{ $total_harga['total_epa']* ($formula->overage/100) }} @endif
																		</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->DHA!='yes')<input type="checkbox" name="DHA" value="yes" id="DHA">
																			@else<input type="checkbox" value="yes" checked name="DHA" id="DHA">@endif
																		</td>
																		<td>DHA</td>
																		<td class="text-right">{{ $total_harga['total_dha'] }}</td><td class="text-center">mg</td>
																		<td class="text-right">NA</td>
																		<td class="text-right">NA</td><td class="text-center">mg</td>
																		<td class="text-right" style="background-color:#d1d1d1;">
																			@if($akg->DHA!='yes') {{ $total_harga['total_dha'] }}
																			@else	{{ $total_harga['total_dha']* ($formula->overage/100) }} @endif
																		</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->Glukosamin!='yes')<input type="checkbox" name="Glukosamin" value="yes" id="Glukosamin">
																			@else<input type="checkbox" value="yes" checked name="Glukosamin" id="Glukosamin">@endif
																		</td>
																		<td>Glukosamin</td>
																		<td class="text-right">{{ $total_harga['total_glucosamine']}}</td><td class="text-center">mg</td>
																		<td class="text-right">NA</td>
																		<td class="text-right">NA</td><td class="text-center">mg</td>
																		<td class="text-right" style="background-color:#d1d1d1;">
																			@if($akg->Glukosamin!='yes'){{ $total_harga['total_glucosamine']}}
																			@else	{{ $total_harga['total_glucosamine']* ($formula->overage/100)}} @endif
																		</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->Kondroitin!='yes')<input type="checkbox" name="Kondroitin" value="yes" id="Kondroitin">
																			@else<input type="checkbox" value="yes" checked name="Kondroitin" id="Kondroitin">@endif
																		</td>
																		<td>Kondroitin</td>
																		<td class="text-right">{{ $total_harga['total_chondroitin'] }}</td><td class="text-center">mg</td>
																		<td class="text-right">NA</td>
																		<td class="text-right">NA</td><td class="text-center">mg</td>
																		<td class="text-right" style="background-color:#d1d1d1;">
																			@if($akg->Kondroitin!='yes') {{ $total_harga['total_chondroitin'] }}
																			@else	{{ $total_harga['total_chondroitin']* ($formula->overage/100) }} @endif
																		</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->Kolagen!='yes')<input type="checkbox" name="Kolagen" value="yes" id="Kolagen">
																			@else<input type="checkbox" value="yes" checked name="Kolagen" id="Kolagen">@endif
																		</td>
																		<td>Kolagen</td>
																		<td class="text-right">NA</td><td class="text-center">mg</td>
																		<td class="text-right">NA</td>
																		<td class="text-right">NA</td><td class="text-center">mg</td>
																		<td class="text-right" style="background-color:#d1d1d1;">NA</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->EGCG!='yes')<input type="checkbox" name="EGCG" value="yes" id="EGCG">
																			@else<input type="checkbox" value="yes" checked name="EGCG" id="EGCG">@endif
																		</td>
																		<td>EGCG</td>
																		<td class="text-right">NA</td><td class="text-center">mg</td>
																		<td class="text-right">NA</td>
																		<td class="text-right">NA</td><td class="text-center">mg</td>
																		<td class="text-right" style="background-color:#d1d1d1;">NA</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->Kreatina!='yes')<input type="checkbox" name="Kreatina" value="yes" id="Kreatina">
																			@else<input type="checkbox" value="yes" checked name="Kreatina" id="Kreatina">@endif
																		</td>
																		<td>Kreatina</td>
																		<td class="text-right">{{ $total_harga['total_creatine'] }}</td><td class="text-center">mg</td>
																		<td class="text-right">NA</td>
																		<td class="text-right">NA</td><td class="text-center">mg</td>
																		<td class="text-right" style="background-color:#d1d1d1;">
																			@if($akg->Kreatina!='yes') {{ $total_harga['total_creatine'] }}
																			@else	{{ $total_harga['total_creatine']* ($formula->overage/100) }} @endif
																		</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->MCT!='yes')<input type="checkbox" name="MCT" value="yes" id="MCT">
																			@else<input type="checkbox" value="yes" checked name="MCT" id="MCT">@endif
																		</td>
																		<td>MCT</td>
																		<td class="text-right">NA</td><td class="text-center">g</td>
																		<td class="text-right">NA</td>
																		<td class="text-right">NA</td><td class="text-center">g</td>
																		<td class="text-right" style="background-color:#d1d1d1;">NA</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->CLA!='yes')<input type="checkbox" name="CLA" value="yes" id="CLA">
																			@else<input type="checkbox" value="yes" checked name="CLA" id="CLA">@endif
																		</td>
																		<td>CLA</td>
																		<td class="text-right">{{ $total_harga['total_cla'] }}</td><td class="text-center">mg</td>
																		<td class="text-right">NA</td>
																		<td class="text-right">NA</td><td class="text-center">mg</td>
																		<td class="text-right" style="background-color:#d1d1d1;">
																			@if($akg->CLA!='yes') {{ $total_harga['total_cla'] }}
																			@else	{{ $total_harga['total_cla']* ($formula->overage/100) }} @endif
																		</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->omega3!='yes')<input type="checkbox" name="omega3" value="yes" id="omega3">
																			@else<input type="checkbox" value="yes" checked name="omega3" id="omega3">@endif
																		</td>
																		<td>Omega 3</td>
																		<td class="text-right">{{ $total_harga['total_omega3'] }}</td><td class="text-center">g</td>
																		<td class="text-right">NA</td>
																		<td class="text-right">NA</td><td class="text-center">g</td>
																		<td class="text-right" style="background-color:#d1d1d1;">
																			@if($akg->omega3!='yes'){{ $total_harga['total_omega3'] }}
																			@else	{{ $total_harga['total_omega3']* ($formula->overage/100) }} @endif
																		</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->omega6!='yes')<input type="checkbox" name="omega6" value="yes" id="omega6">
																			@else<input type="checkbox" value="yes" checked name="omega6" id="omega6">@endif
																		</td>
																		<td>Omega 6</td>
																		<td class="text-right">{{ $total_harga['total_linoleic6'] }}</td><td class="text-center">g</td>
																		<td class="text-right">NA</td>
																		<td class="text-right">NA</td><td class="text-center">g</td>
																		<td class="text-right" style="background-color:#d1d1d1;">
																			@if($akg->omega6!='yes'){{ $total_harga['total_linoleic6'] }}
																			@else	{{ $total_harga['total_linoleic6']* ($formula->overage/100) }} @endif
																		</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->omega9!='yes')<input type="checkbox" name="omega9" value="yes" id="omega9">
																			@else<input type="checkbox" value="yes" checked name="omega9" id="omega9">@endif
																		</td>
																		<td>Omega 9</td>
																		<td class="text-right">NA</td><td class="text-center">g</td>
																		<td class="text-right">NA</td>
																		<td class="text-right">NA</td><td class="text-center">g</td>
																		<td class="text-right" style="background-color:#d1d1d1;">NA</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->Klorida!='yes')<input type="checkbox" name="Klorida" value="yes" id="Klorida">
																			@else<input type="checkbox" value="yes" checked name="Klorida" id="Klorida">@endif
																		</td>
																		<td>Klorida</td>
																		<td class="text-right">NA</td><td class="text-center">mg</td>
																		<td class="text-right">NA</td>
																		<td class="text-right">NA</td><td class="text-center">mg</td>
																		<td class="text-right" style="background-color:#d1d1d1;">NA</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->asam_linoleat!='yes')<input type="checkbox" name="asam_linoleat" value="yes" id="asam_linoleat">
																			@else<input type="checkbox" value="yes" checked name="asam_linoleat" id="asam_linoleat">@endif
																		</td>
																		<td>Asam Linoleat</td>
																		<td class="text-right">{{ $total_harga['total_linoleic6'] }}</td><td class="text-center">g</td>
																		<td class="text-right"><?php $linoleat = $total_harga['total_linoleic6']*($akg->asam_linoleat*100); $angka_linoleat = number_format($linoleat,2,",","."); echo $angka_linoleat; ?></td>
																		<td class="text-right">{{$akg->asam_linoleat}}</td><td class="text-center">g</td>
																		<td class="text-right" style="background-color:#d1d1d1;">
																			@if($akg->asam_linoleat!='yes') {{ $total_harga['total_linoleic6'] }}
																			@else	{{ $total_harga['total_linoleic6']* ($formula->overage/100) }} @endif
																		</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->energi_asam_linoleat!='yes')<input type="checkbox" name="energi_asam_linoleat" value="yes" id="energi_asam_linoleat">
																			@else<input type="checkbox" value="yes" checked name="energi_asam_linoleat" id="energi_asam_linoleat">@endif
																		</td>
																		<td>Energi dari Asam Linoleat</td>
																		<td class="text-right"><NA/td><td class="text-center">kkal</td>
																		<td class="text-right">NA</td>
																		<td class="text-right">NA</td><td class="text-center">kkal</td>
																		<td class="text-right" style="background-color:#d1d1d1;">NA</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->energi_protein!='yes')<input type="checkbox" name="energi_protein" value="yes" id="energi_protein">
																			@else<input type="checkbox" value="yes" checked name="energi_protein" id="energi_protein">@endif
																		</td>
																		<td>Energi dari Protein</td>
																		<td class="text-right">{{ $total_harga['total_protein']*4 }}</td><td class="text-center">kkal</td>
																		<td class="text-right">NA</td>
																		<td class="text-right">NA</td><td class="text-center">kkal</td>
																		<td class="text-right" style="background-color:#d1d1d1;">
																			@if($akg->energi_protein!='yes'){{ $total_harga['total_protein']*4 }}
																			@else	{{ ($total_harga['total_protein']*4)* ($formula->overage/100) }} @endif
																		</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->l_karnitin!='yes')<input type="checkbox" name="l_karnitin" value="yes" id="l_karnitin">
																			@else<input type="checkbox" value="yes" checked name="l_karnitin" id="l_karnitin">@endif
																		</td>
																		<td>L-Karnitin</td>
																		<td class="text-right">{{ $total_harga['total_carnitin'] }}</td><td class="text-center">mg</td>
																		<td class="text-right"><?php $carnitin = $total_harga['total_carnitin']*($akg->l_karnitin*100); $angka_carnitin = number_format($carnitin,2,",","."); echo $angka_carnitin; ?></td>
																		<td class="text-right">{{$akg->l_karnitin}}</td><td class="text-center">mg</td>
																		<td class="text-right" style="background-color:#d1d1d1;">
																			@if($akg->l_karnitin!='yes'){{ $total_harga['total_carnitin'] }}
																			@else	{{ $total_harga['total_carnitin']* ($formula->overage/100) }} @endif
																		</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->l_glutamin!='yes')<input type="checkbox" name="l_glutamin" value="yes" id="l_glutamin">
																			@else<input type="checkbox" value="yes" checked name="l_glutamin" id="l_glutamin">@endif
																		</td>
																		<td>L-Glutamin</td>
																		<td class="text-right">NA</td><td class="text-center">mg</td>
																		<td class="text-right">NA</td>
																		<td class="text-right">NA</td><td class="text-center">mg</td>
																		<td class="text-right" style="background-color:#d1d1d1;">NA</td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->Thereonin!='yes')<input type="checkbox" name="Thereonin" value="yes" id="Thereonin">
																			@else<input type="checkbox" value="yes" checked name="Thereonin" id="Thereonin">@endif
																		</td>
																		<td>**Thereonin</td>
																		<td class="text-right"></td><td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td><td class="text-center">mg</td>
																		<td class="text-right" style="background-color:#d1d1d1;"></td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->Methionin!='yes')<input type="checkbox" name="Methionin" value="yes" id="Methionin">
																			@else<input type="checkbox" value="yes" checked name="Methionin" id="Methionin">@endif
																		</td>
																		<td>**Methionin</td>
																		<td class="text-right"></td><td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td><td class="text-center">mg</td>
																		<td class="text-right" style="background-color:#d1d1d1;"></td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->Phenilalanin!='yes')<input type="checkbox" name="Phenilalanin" value="yes" id="Phenilalanin">
																			@else<input type="checkbox" value="yes" checked name="Phenilalanin" id="Phenilalanin">@endif
																		</td>
																		<td>**Phenilalanin</td>
																		<td class="text-right"></td><td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td><td class="text-center">mg</td>
																		<td class="text-right" style="background-color:#d1d1d1;"></td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->Histidin!='yes')<input type="checkbox" name="Histidin" value="yes" id="Histidin">
																			@else<input type="checkbox" value="yes" checked name="Histidin" id="Histidin">@endif
																		</td>
																		<td>**Histidin</td>
																		<td class="text-right"></td><td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td><td class="text-center">mg</td>
																		<td class="text-right" style="background-color:#d1d1d1;"></td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->Lisin!='yes')<input type="checkbox" name="Lisin" value="yes" id="Lisin">
																			@else<input type="checkbox" value="yes" checked name="Lisin" id="Lisin">@endif
																		</td>
																		<td>**Lisin</td>
																		<td class="text-right"></td><td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td><td class="text-center">mg</td>
																		<td class="text-right" style="background-color:#d1d1d1;"></td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->BCAA!='yes')<input type="checkbox" name="BCAA" value="yes" id="BCAA">
																			@else<input type="checkbox" value="yes" checked name="BCAA" id="BCAA">@endif
																		</td>
																		<td>**BCAA</td>
																		<td class="text-right"></td><td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td><td class="text-center">mg</td>
																		<td class="text-right" style="background-color:#d1d1d1;"></td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->Valin!='yes')<input type="checkbox" name="Valin" value="yes" id="Valin">
																			@else<input type="checkbox" value="yes" checked name="Valin" id="Valin">@endif
																		</td>
																		<td>**Valin</td>
																		<td class="text-right"></td><td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td><td class="text-center">mg</td>
																		<td class="text-right" style="background-color:#d1d1d1;"></td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->Isoleusin!='yes')<input type="checkbox" name="Isoleusin" value="yes" id="Isoleusin">
																			@else<input type="checkbox" value="yes" checked name="Isoleusin" id="Isoleusin">@endif
																		</td>
																		<td>**Isoleusin</td>
																		<td class="text-right"></td><td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td><td class="text-center">mg</td>
																		<td class="text-right" style="background-color:#d1d1d1;"></td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->Leusin!='yes')<input type="checkbox" name="Leusin" value="yes" id="Leusin">
																			@else<input type="checkbox" value="yes" checked name="Leusin" id="Leusin">@endif
																		</td>
																		<td>**Leusin</td>
																		<td class="text-right"></td><td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td><td class="text-center">mg</td>
																		<td class="text-right" style="background-color:#d1d1d1;"></td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->Alanin!='yes')<input type="checkbox" name="Alanin" value="yes" id="Alanin">
																			@else<input type="checkbox" value="yes" checked name="Alanin" id="Alanin">@endif
																		</td>
																		<td>Alanin</td>
																		<td class="text-right"></td><td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td><td class="text-center">mg</td>
																		<td class="text-right" style="background-color:#d1d1d1;"></td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->asam_aspartat!='yes')<input type="checkbox" name="asam_aspartat" value="yes" id="asam_aspartat">
																			@else<input type="checkbox" value="yes" checked name="asam_aspartat" id="asam_aspartat">@endif
																		</td>
																		<td>Asam Aspartat</td>
																		<td class="text-right"></td><td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td><td class="text-center">mg</td>
																		<td class="text-right" style="background-color:#d1d1d1;"></td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->asam_glutamat!='yes')<input type="checkbox" name="asam_glutamat" value="yes" id="asam_glutamat">
																			@else<input type="checkbox" value="yes" checked name="asam_glutamat" id="asam_glutamat">@endif
																		</td>
																		<td>Asam Glutamat</td>
																		<td class="text-right"></td><td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td><td class="text-center">mg</td>
																		<td class="text-right" style="background-color:#d1d1d1;"></td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->sistein!='yes')<input type="checkbox" name="sistein" value="yes" id="sistein">
																			@else<input type="checkbox" value="yes" checked name="sistein" id="sistein">@endif
																		</td>
																		<td>Sistein</td>
																		<td class="text-right"></td><td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td><td class="text-center">mg</td>
																		<td class="text-right" style="background-color:#d1d1d1;"></td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->serin!='yes')<input type="checkbox" name="serin" value="yes" id="serin">
																			@else<input type="checkbox" value="yes" checked name="serin" id="serin">@endif
																		</td>
																		<td>Serin</td>
																		<td class="text-right"></td><td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td><td class="text-center">mg</td>
																		<td class="text-right" style="background-color:#d1d1d1;"></td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->glisin!='yes')<input type="checkbox" name="glisin" value="yes" id="glisin">
																			@else<input type="checkbox" value="yes" checked name="glisin" id="glisin">@endif
																		</td>
																		<td>Glisin</td>
																		<td class="text-right"></td><td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td><td class="text-center">mg</td>
																		<td class="text-right" style="background-color:#d1d1d1;"></td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->tyrosin!='yes')<input type="checkbox" name="tyrosin" value="yes" id="tyrosin">
																			@else<input type="checkbox" value="yes" checked name="tyrosin" id="tyrosin">@endif
																		</td>
																		<td>Tyrosin</td>
																		<td class="text-right"></td><td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td><td class="text-center">mg</td>
																		<td class="text-right" style="background-color:#d1d1d1;"></td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->proline!='yes')<input type="checkbox" name="proline" value="yes" id="proline">
																			@else<input type="checkbox" value="yes" checked name="proline" id="proline">@endif
																		</td>
																		<td>Proline</td>
																		<td class="text-right"></td><td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td><td class="text-center">mg</td>
																		<td class="text-right" style="background-color:#d1d1d1;"></td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->arginine!='yes')<input type="checkbox" name="arginine" value="yes" id="arginine">
																			@else<input type="checkbox" value="yes" checked name="arginine" id="arginine">@endif
																		</td>
																		<td>Arginine</td>
																		<td class="text-right"></td><td class="text-center">mg</td>
																		<td class="text-right"></td>
																		<td class="text-right"></td><td class="text-center">mg</td>
																		<td class="text-right" style="background-color:#d1d1d1;"></td>
																	</tr>
																	<tr class="" style=" color: black;">
																		<td>
																			@if($akg->gluten!='yes')<input type="checkbox" name="gluten" value="yes" id="gluten">
																			@else<input type="checkbox" value="yes" checked name="gluten" id="gluten">@endif
																		</td>
																		<td>Gluten</td>
																		<td class="text-right">NA</td><td class="text-center">mg</td>
																		<td class="text-right">NA</td>
																		<td class="text-right">NA</td><td class="text-center">mg</td>
																		<td class="text-right" style="background-color:#d1d1d1;">NA</td>
																	</tr>
																</tbody>
															</table>
															</form>
														</div>
														@endforeach
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
			<div class="col-md-offset-5 col-sm-offset-5"><br>
				@if(auth()->user()->role->namaRule == 'user_produk')
				<a href="{{ route('showworkbook',$formula->workbook_id) }}" type="button" class="btn btn-sm btn-danger"><li class="fa fa-arrow-left"></li> Back</a>
				@elseif(auth()->user()->role->namaRule == 'pv_global' || auth()->user()->role->namaRule == 'pv_lokal')
				<a href="{{ route('rekappkp',$formula->workbook_id) }}" type="button" class="btn btn-sm btn-danger"><li class="fa fa-arrow-left"></li> Back</a>
				@elseif(auth()->user()->role->namaRule == 'manager')
				<a href="{{ route('daftarpkp',$formula->workbook_id) }}" type="button" class="btn btn-sm btn-danger"><li class="fa fa-arrow-left"></li> Back</a>
				@endif
			</div>
		</div>    
	</div>
</div>
@endsection