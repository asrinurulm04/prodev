@extends('pv.tempvv')
@section('title', 'PRODEV|Report Notulen')
@section('content')

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
			<div class="x_title">
				<h3><li class="fa fa-edit"></li> Report Notulen PKP</h3>
			</div>
			<div class="" style="overflow-x: scroll;">
        <div class="container"> 
          <section id="fancyTabWidget" class="tabs t-tabs">
						<div id="myTabContent" class="tab-content fancyTabContent" aria-live="polite">
							<!-- PKP Pengajuan -->
								<button class="btn btn-warning btn-sm" type="button" data-toggle="modal" data-target="#parampkp"><i class="fa fa-download"></i> Export Excel</a></button>
                <!-- modal -->
                <div class="modal" id="parampkp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h3 class="modal-title text-left" id="exampleModalLabel">Export
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></h3>
                        </button>
                      </div>
											<form class="form-horizontal form-label-left" method="POST" action="{{ route('export_notulen_pkp') }}">
                      <div class="modal-body">
                        <div class="form-group row">
													@foreach($not as $not)
													<input type="radio" checked name="tahun" id="tahun" value="{{$not->tahun}}"> Tahun {{$not->tahun}} <br>
													@endforeach
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-paper-plane"></i> Submit</button>
                        {{ csrf_field() }}
                      </div>
											</form>
                    </div>
                  </div>
                </div>
                <!-- Modal Selesai -->
								<div>
									<div class="row">
										<div class="col-md-12">
											<table id="datatable" class="table table-striped table-bordered" style="width:100%">
												<thead>
													<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
														<th class="text-center" width="3%" rowspan="3">No</th>
														<th class="text-center" rowspan="3">PKP Number</th>
														@if($des>=1)<th class="text-center" style="min-width:300px" colspan="8">December</th>@endif
														@if($nov>=1)<th class="text-center" style="min-width:300px" colspan="8">November</th>@endif
														@if($oct>=1)<th class="text-center" style="min-width:300px" colspan="8">October</th>@endif
														@if($sep>=1)<th class="text-center" style="min-width:300px" colspan="8">September</th>@endif
														@if($aug>=1)<th class="text-center" style="min-width:300px" colspan="8">August</th>@endif
														@if($jul>=1)<th class="text-center" style="min-width:300px" colspan="8">july</th>@endif
														@if($jun>=1)<th class="text-center" style="min-width:300px" colspan="8">June</th>@endif
														@if($may>=1)<th class="text-center" style="min-width:300px" colspan="8">May</th>@endif
														@if($apr>=1)<th class="text-center" style="min-width:300px" colspan="8">April</th>@endif
														@if($mar>=1)<th class="text-center" style="min-width:300px" colspan="8">March</th>@endif
														@if($feb>=1)<th class="text-center" style="min-width:300px" colspan="8">February</th>@endif
														@if($jan>=1)<th class="text-center" style="min-width:300px" colspan="8">January</th>@endif
													</tr>
													<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
														@if($des>=1)
														<th class="text-center" style="min-width:300px" colspan="4">Meeting PV & Marketing</th>
														<th class="text-center" style="min-width:300px" colspan="4">Meeting PV & RD</th>
														@endif
														@if($nov>=1)
														<th class="text-center" style="min-width:300px" colspan="4">Meeting PV & Marketing</th>
														<th class="text-center" style="min-width:300px" colspan="4">Meeting PV & RD</th>
														@endif
														@if($oct>=1)
														<th class="text-center" style="min-width:300px" colspan="4">Meeting PV & Marketing</th>
														<th class="text-center" style="min-width:300px" colspan="4">Meeting PV & RD</th>
														@endif
														@if($sep>=1)
														<th class="text-center" style="min-width:300px" colspan="4">Meeting PV & Marketing</th>
														<th class="text-center" style="min-width:300px" colspan="4">Meeting PV & RD</th>
														@endif
														@if($aug>=1)
														<th class="text-center" style="min-width:300px" colspan="4">Meeting PV & Marketing</th>
														<th class="text-center" style="min-width:300px" colspan="4">Meeting PV & RD</th>
														@endif
														@if($jul>=1)
														<th class="text-center" style="min-width:300px" colspan="4">Meeting PV & Marketing</th>
														<th class="text-center" style="min-width:300px" colspan="4">Meeting PV & RD</th>
														@endif
														@if($jun>=1)
														<th class="text-center" style="min-width:300px" colspan="4">Meeting PV & Marketing</th>
														<th class="text-center" style="min-width:300px" colspan="4">Meeting PV & RD</th>
														@endif
														@if($may>=1)
														<th class="text-center" style="min-width:300px" colspan="4">Meeting PV & Marketing</th>
														<th class="text-center" style="min-width:300px" colspan="4">Meeting PV & RD</th>
														@endif
														@if($apr>=1)
														<th class="text-center" style="min-width:300px" colspan="4">Meeting PV & Marketing</th>
														<th class="text-center" style="min-width:300px" colspan="4">Meeting PV & RD</th>
														@endif
														@if($mar>=1)
														<th class="text-center" style="min-width:300px" colspan="4">Meeting PV & Marketing</th>
														<th class="text-center" style="min-width:300px" colspan="4">Meeting PV & RD</th>
														@endif
														@if($feb>=1)
														<th class="text-center" style="min-width:300px" colspan="4">Meeting PV & Marketing</th>
														<th class="text-center" style="min-width:300px" colspan="4">Meeting PV & RD</th>
														@endif
														@if($jan>=1)
														<th class="text-center" style="min-width:300px" colspan="4">Meeting PV & Marketing</th>
														<th class="text-center" style="min-width:300px" colspan="4">Meeting PV & RD</th>
														@endif
													</tr>
													<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
														@if($des>=1)
															<th class="text-center">Notulen</th>
															<th class="text-center">Priority</th>
															<th class="text-center">Launch Deadline</th>
															<th width="15%" class="text-center">Forecast</th>
															<th class="text-center">Notulen</th>
															<th class="text-center">Priority</th>
															<th class="text-center">Launch Deadline</th>
															<th width="15%" class="text-center">Forecast</th>
														@endif
														@if($nov>=1)
															<th class="text-center">Notulen</th>
															<th class="text-center">Priority</th>
															<th class="text-center">Launch Deadline</th>
															<th width="15%" class="text-center">Forecast</th>
															<th class="text-center">Notulen</th>
															<th class="text-center">Priority</th>
															<th class="text-center">Launch Deadline</th>
															<th width="15%" class="text-center">Forecast</th>
														@endif
														@if($oct>=1)
															<th class="text-center">Notulen</th>
															<th class="text-center">Priority</th>
															<th class="text-center">Launch Deadline</th>
															<th width="15%" class="text-center">Forecast</th>
															<th class="text-center">Notulen</th>
															<th class="text-center">Priority</th>
															<th class="text-center">Launch Deadline</th>
															<th width="15%" class="text-center">Forecast</th>
														@endif
														@if($sep>=1)
															<th class="text-center">Notulen</th>
															<th class="text-center">Priority</th>
															<th class="text-center">Launch Deadline</th>
															<th width="15%" class="text-center">Forecast</th>
															<th class="text-center">Notulen</th>
															<th class="text-center">Priority</th>
															<th class="text-center">Launch Deadline</th>
															<th width="15%" class="text-center">Forecast</th>
														@endif
														@if($aug>=1)
															<th class="text-center">Notulen</th>
															<th class="text-center">Priority</th>
															<th class="text-center">Launch Deadline</th>
															<th width="15%" class="text-center">Forecast</th>
															<th class="text-center">Notulen</th>
															<th class="text-center">Priority</th>
															<th class="text-center">Launch Deadline</th>
															<th width="15%" class="text-center">Forecast</th>
														@endif
														@if($jul>=1)
															<th class="text-center">Notulen</th>
															<th class="text-center">Priority</th>
															<th class="text-center">Launch Deadline</th>
															<th width="15%" class="text-center">Forecast</th>
															<th class="text-center">Notulen</th>
															<th class="text-center">Priority</th>
															<th class="text-center">Launch Deadline</th>
															<th width="15%" class="text-center">Forecast</th>
														@endif
														@if($jun>=1)
															<th class="text-center">Notulen</th>
															<th class="text-center">Priority</th>
															<th class="text-center">Launch Deadline</th>
															<th width="15%" class="text-center">Forecast</th>
															<th class="text-center">Notulen</th>
															<th class="text-center">Priority</th>
															<th class="text-center">Launch Deadline</th>
															<th width="15%" class="text-center">Forecast</th>
														@endif
														@if($may>=1)
															<th class="text-center">Notulen</th>
															<th class="text-center">Priority</th>
															<th class="text-center">Launch Deadline</th>
															<th width="15%" class="text-center">Forecast</th>
															<th class="text-center">Notulen</th>
															<th class="text-center">Priority</th>
															<th class="text-center">Launch Deadline</th>
															<th width="15%" class="text-center">Forecast</th>
														@endif
														@if($apr>=1)
															<th class="text-center">Notulen</th>
															<th class="text-center">Priority</th>
															<th class="text-center">Launch Deadline</th>
															<th width="15%" class="text-center">Forecast</th>
															<th class="text-center">Notulen</th>
															<th class="text-center">Priority</th>
															<th class="text-center">Launch Deadline</th>
															<th width="15%" class="text-center">Forecast</th>
														@endif
														@if($mar>=1)
															<th class="text-center">Notulen</th>
															<th class="text-center">Priority</th>
															<th class="text-center">Launch Deadline</th>
															<th width="15%" class="text-center">Forecast</th>
															<th class="text-center">Notulen</th>
															<th class="text-center">Priority</th>
															<th class="text-center">Launch Deadline</th>
															<th width="15%" class="text-center">Forecast</th>
														@endif
														@if($feb>=1)
															<th class="text-center">Notulen</th>
															<th class="text-center">Priority</th>
															<th class="text-center">Launch Deadline</th>
															<th width="15%" class="text-center">Forecast</th>
															<th class="text-center">Notulen</th>
															<th class="text-center">Priority</th>
															<th class="text-center">Launch Deadline</th>
															<th width="15%" class="text-center">Forecast</th>
														@endif
														@if($jan>=1)
															<th class="text-center">Notulen</th>
															<th class="text-center">Priority</th>
															<th class="text-center">Launch Deadline</th>
															<th width="15%" class="text-center">Forecast</th>
															<th class="text-center">Notulen</th>
															<th class="text-center">Priority</th>
															<th class="text-center">Launch Deadline</th>
															<th width="15%" class="text-center">Forecast</th>
														@endif
													</tr>
												</thead>
												<tbody>
													@php $no = 0; @endphp
													@foreach ($DNpkp as $dnpkp)
													<tr>
														<td class="text-center">{{ ++$no }}</td>
														<td>{{$dnpkp->pkp_number}}{{$dnpkp->ket_no}}</td>
														@foreach($Npkp as $npkp) 
															@if($npkp->Bulan=='December' && $npkp->id_pkp==$dnpkp->id_project)
																@if($judesn>=1 && $npkp->note_pv_marketing!=null)
																	<td>{{$npkp->note_pv_marketing}}</td>
																	<td>{{$npkp->prioritas}}</td>
																	<td>{{$npkp->launch}} {{$npkp->launch_years}}</td>
																	<td>
																		@foreach($NForecast as $nf)
																			@if($nf->id_pkp==$dnpkp->id_project && $nf->id_pkp==$npkp->id_pkp)
																				@if($nf->info=='2' && $npkp->created==$nf->date) {{$nf->satuan}} = {{$nf->forecash}}<br>@endif
																			@endif
																		@endforeach
																	</td>
																@elseif($des=='0') 
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																@endif
																@if($des2>=1 && $npkp->note_rd_pv!=null)
																	<td>{{$npkp->note_rd_pv}}</td>
																	<td>{{$npkp->prioritas}}</td>
																	<td>{{$npkp->launch}} {{$npkp->launch_years}}</td>
																	<td>
																		@foreach($NForecast as $nf)
																			@if($nf->id_pkp==$dnpkp->id_project && $nf->id_pkp==$npkp->id_pkp)
																				@if($nf->info=='1' && $npkp->created==$nf->date) {{$nf->satuan}} = {{$nf->forecash}}<br>@endif
																			@endif
																		@endforeach
																	</td>
																@elseif($des2=='0') 
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																@endif 
															@endif
														@endforeach
														@foreach($Npkp as $npkp) 
															@if($npkp->Bulan=='November' && $npkp->id_pkp==$dnpkp->id_project)
																@if($nov>=1 && $npkp->note_pv_marketing!=null)
																	<td>{{$npkp->note_pv_marketing}}</td>
																	<td>{{$npkp->prioritas}}</td>
																	<td>{{$npkp->launch}} {{$npkp->launch_years}}</td>
																	<td>
																		@foreach($NForecast as $nf)
																			@if($nf->id_pkp==$dnpkp->id_project && $nf->id_pkp==$npkp->id_pkp)
																				@if($nf->info=='2' && $npkp->created==$nf->date) {{$nf->satuan}} = {{$nf->forecash}}<br>@endif
																			@endif
																		@endforeach
																	</td>
																@elseif($nov=='0') 
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																@endif
																@if($nov2>=1 && $npkp->note_rd_pv!=null)
																	<td>{{$npkp->note_rd_pv}}</td>
																	<td>{{$npkp->prioritas}}</td>
																	<td>{{$npkp->launch}} {{$npkp->launch_years}}</td>
																	<td>
																		@foreach($NForecast as $nf)
																			@if($nf->id_pkp==$dnpkp->id_project && $nf->id_pkp==$npkp->id_pkp)
																				@if($nf->info=='1' && $npkp->created==$nf->date) {{$nf->satuan}} = {{$nf->forecash}}<br>@endif
																			@endif
																		@endforeach
																	</td>
																@elseif($nov2=='0') 
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																@endif 
															@endif
														@endforeach
														@foreach($Npkp as $npkp) 
															@if($npkp->Bulan=='October' && $npkp->id_pkp==$dnpkp->id_project)
																@if($oct>=1 && $npkp->note_pv_marketing!=null)
																	<td>{{$npkp->note_pv_marketing}}</td>
																	<td>{{$npkp->prioritas}}</td>
																	<td>{{$npkp->launch}} {{$npkp->launch_years}}</td>
																	<td>
																		@foreach($NForecast as $nf)
																			@if($nf->id_pkp==$dnpkp->id_project && $nf->id_pkp==$npkp->id_pkp)
																				@if($nf->info=='2' && $npkp->created==$nf->date) {{$nf->satuan}} = {{$nf->forecash}}<br>@endif
																			@endif
																		@endforeach
																	</td>
																@elseif($oct=='0') 
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																@endif
																@if($oct2>=1 && $npkp->note_rd_pv!=null)
																	<td>{{$npkp->note_rd_pv}}</td>
																	<td>{{$npkp->prioritas}}</td>
																	<td>{{$npkp->launch}} {{$npkp->launch_years}}</td>
																	<td>
																		@foreach($NForecast as $nf)
																			@if($nf->id_pkp==$dnpkp->id_project && $nf->id_pkp==$npkp->id_pkp)
																				@if($nf->info=='1' && $npkp->created==$nf->date) {{$nf->satuan}} = {{$nf->forecash}}<br>@endif
																			@endif
																		@endforeach
																	</td>
																@elseif($oct2=='0') 
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																@endif 
															@endif
														@endforeach
														@foreach($Npkp as $npkp) 
															@if($npkp->Bulan=='September' && $npkp->id_pkp==$dnpkp->id_project)
																@if($sep>=1 && $npkp->note_pv_marketing!=null)
																	<td>{{$npkp->note_pv_marketing}}</td>
																	<td>{{$npkp->prioritas}}</td>
																	<td>{{$npkp->launch}} {{$npkp->launch_years}}</td>
																	<td>
																		@foreach($NForecast as $nf)
																			@if($nf->id_pkp==$dnpkp->id_project && $nf->id_pkp==$npkp->id_pkp)
																				@if($nf->info=='2' && $npkp->created==$nf->date) {{$nf->satuan}} = {{$nf->forecash}}<br>@endif
																			@endif
																		@endforeach
																	</td>
																@elseif($sep=='0') 
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																@endif
																@if($sep2>=1 && $npkp->note_rd_pv!=null)
																	<td>{{$npkp->note_rd_pv}}</td>
																	<td>{{$npkp->prioritas}}</td>
																	<td>{{$npkp->launch}} {{$npkp->launch_years}}</td>
																	<td>
																		@foreach($NForecast as $nf)
																			@if($nf->id_pkp==$dnpkp->id_project && $nf->id_pkp==$npkp->id_pkp)
																				@if($nf->info=='1' && $npkp->created==$nf->date) {{$nf->satuan}} = {{$nf->forecash}}<br>@endif
																			@endif
																		@endforeach
																	</td>
																@elseif($sep2=='0') 
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																@endif 
															@endif
														@endforeach
														@foreach($Npkp as $npkp) 
															@if($npkp->Bulan=='August' && $npkp->id_pkp==$dnpkp->id_project)
																@if($aug>=1 && $npkp->note_pv_marketing!=null)
																	<td>{{$npkp->note_pv_marketing}}</td>
																	<td>{{$npkp->prioritas}}</td>
																	<td>{{$npkp->launch}} {{$npkp->launch_years}}</td>
																	<td>
																		@foreach($NForecast as $nf)
																			@if($nf->id_pkp==$dnpkp->id_project && $nf->id_pkp==$npkp->id_pkp)
																				@if($nf->info=='2' && $npkp->created==$nf->date) {{$nf->satuan}} = {{$nf->forecash}}<br>@endif
																			@endif
																		@endforeach
																	</td>
																@elseif($aug=='0') 
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																@endif
																@if($aug2>=1 && $npkp->note_rd_pv!=null)
																	<td>{{$npkp->note_rd_pv}}</td>
																	<td>{{$npkp->prioritas}}</td>
																	<td>{{$npkp->launch}} {{$npkp->launch_years}}</td>
																	<td>
																		@foreach($NForecast as $nf)
																			@if($nf->id_pkp==$dnpkp->id_project && $nf->id_pkp==$npkp->id_pkp)
																				@if($nf->info=='1' && $npkp->created==$nf->date) {{$nf->satuan}} = {{$nf->forecash}}<br>@endif
																			@endif
																		@endforeach
																	</td>
																@elseif($aug2=='0') 
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																@endif 
															@endif
														@endforeach
														@foreach($Npkp as $npkp) 
															@if($npkp->Bulan=='July' && $npkp->id_pkp==$dnpkp->id_project)
																@if($jul>=1 && $npkp->note_pv_marketing!=null)
																	<td>{{$npkp->note_pv_marketing}}</td>
																	<td>{{$npkp->prioritas}}</td>
																	<td>{{$npkp->launch}} {{$npkp->launch_years}}</td>
																	<td>
																		@foreach($NForecast as $nf)
																			@if($nf->id_pkp==$dnpkp->id_project && $nf->id_pkp==$npkp->id_pkp)
																				@if($nf->info=='2' && $npkp->created==$nf->date) {{$nf->satuan}} = {{$nf->forecash}}<br>@endif
																			@endif
																		@endforeach
																	</td>
																@elseif($jul=='0') 
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																@endif
																@if($jul2>=1 && $npkp->note_rd_pv!=null)
																	<td>{{$npkp->note_rd_pv}}</td>
																	<td>{{$npkp->prioritas}}</td>
																	<td>{{$npkp->launch}} {{$npkp->launch_years}}</td>
																	<td>
																		@foreach($NForecast as $nf)
																			@if($nf->id_pkp==$dnpkp->id_project && $nf->id_pkp==$npkp->id_pkp)
																				@if($nf->info=='1' && $npkp->created==$nf->date) {{$nf->satuan}} = {{$nf->forecash}}<br>@endif
																			@endif
																		@endforeach
																	</td>
																@elseif($jul2=='0') 
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																@endif 
															@endif
														@endforeach
														@foreach($Npkp as $npkp) 
															@if($npkp->Bulan=='June' && $npkp->id_pkp==$dnpkp->id_project)
																@if($jun>=1 && $npkp->note_pv_marketing!=null)
																	<td>{{$npkp->note_pv_marketing}}</td>
																	<td>{{$npkp->prioritas}}</td>
																	<td>{{$npkp->launch}} {{$npkp->launch_years}}</td>
																	<td>
																		@foreach($NForecast as $nf)
																			@if($nf->id_pkp==$dnpkp->id_project && $nf->id_pkp==$npkp->id_pkp)
																				@if($nf->info=='2' && $npkp->created==$nf->date) {{$nf->satuan}} = {{$nf->forecash}}<br>@endif
																			@endif
																		@endforeach
																	</td>
																@elseif($jun=='0') 
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																@endif
																@if($jun2>=1 && $npkp->note_rd_pv!=null)
																	<td>{{$npkp->note_rd_pv}}</td>
																	<td>{{$npkp->prioritas}}</td>
																	<td>{{$npkp->launch}} {{$npkp->launch_years}}</td>
																	<td>
																		@foreach($NForecast as $nf)
																			@if($nf->id_pkp==$dnpkp->id_project && $nf->id_pkp==$npkp->id_pkp)
																				@if($nf->info=='1' && $npkp->created==$nf->date) {{$nf->satuan}} = {{$nf->forecash}}<br>@endif
																			@endif
																		@endforeach
																	</td>
																@elseif($jun2=='0') 
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																@endif 
															@endif
														@endforeach
														@foreach($Npkp as $npkp) 
															@if($npkp->Bulan=='May' && $npkp->id_pkp==$dnpkp->id_project)
																@if($may>=1 && $npkp->note_pv_marketing!=null)
																	<td>{{$npkp->note_pv_marketing}}</td>
																	<td>{{$npkp->prioritas}}</td>
																	<td>{{$npkp->launch}} {{$npkp->launch_years}}</td>
																	<td>
																		@foreach($NForecast as $nf)
																			@if($nf->id_pkp==$dnpkp->id_project && $nf->id_pkp==$npkp->id_pkp)
																				@if($nf->info=='2' && $npkp->created==$nf->date) {{$nf->satuan}} = {{$nf->forecash}}<br>@endif
																			@endif
																		@endforeach
																	</td>
																@elseif($may=='0') 
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																@endif
																@if($may2>=1 && $npkp->note_rd_pv!=null)
																	<td>{{$npkp->note_rd_pv}}</td>
																	<td>{{$npkp->prioritas}}</td>
																	<td>{{$npkp->launch}} {{$npkp->launch_years}}</td>
																	<td>
																		@foreach($NForecast as $nf)
																			@if($nf->id_pkp==$dnpkp->id_project && $nf->id_pkp==$npkp->id_pkp)
																				@if($nf->info=='1' && $npkp->created==$nf->date) {{$nf->satuan}} = {{$nf->forecash}}<br>@endif
																			@endif
																		@endforeach
																	</td>
																@elseif($may2=='0') 
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																@endif 
															@endif
														@endforeach
														@foreach($Npkp as $npkp) 
															@if($npkp->Bulan=='April' && $npkp->id_pkp==$dnpkp->id_project)
																@if($apr>=1 && $npkp->note_pv_marketing!=null)
																	<td>{{$npkp->note_pv_marketing}}</td>
																	<td>{{$npkp->prioritas}}</td>
																	<td>{{$npkp->launch}} {{$npkp->launch_years}}</td>
																	<td>
																		@foreach($NForecast as $nf)
																			@if($nf->id_pkp==$dnpkp->id_project && $nf->id_pkp==$npkp->id_pkp)
																				@if($nf->info=='2' && $npkp->created==$nf->date) {{$nf->satuan}} = {{$nf->forecash}}<br>@endif
																			@endif
																		@endforeach
																	</td>
																@elseif($apr=='0') 
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																@endif
																@if($apr2>=1 && $npkp->note_rd_pv!=null)
																	<td>{{$npkp->note_rd_pv}}</td>
																	<td>{{$npkp->prioritas}}</td>
																	<td>{{$npkp->launch}} {{$npkp->launch_years}}</td>
																	<td>
																		@foreach($NForecast as $nf)
																			@if($nf->id_pkp==$dnpkp->id_project && $nf->id_pkp==$npkp->id_pkp)
																				@if($nf->info=='1' && $npkp->created==$nf->date) {{$nf->satuan}} = {{$nf->forecash}}<br>@endif
																			@endif
																		@endforeach
																	</td>
																@elseif($apr2=='0') 
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																@endif 
															@endif
														@endforeach
														@foreach($Npkp as $npkp) 
															@if($npkp->Bulan=='March' && $npkp->id_pkp==$dnpkp->id_project)
																@if($mar>=1 && $npkp->note_pv_marketing!=null)
																	<td>{{$npkp->note_pv_marketing}}</td>
																	<td>{{$npkp->prioritas}}</td>
																	<td>{{$npkp->launch}} {{$npkp->launch_years}}</td>
																	<td>
																		@foreach($NForecast as $nf)
																			@if($nf->id_pkp==$dnpkp->id_project && $nf->id_pkp==$npkp->id_pkp)
																				@if($nf->info=='2' && $npkp->created==$nf->date) {{$nf->satuan}} = {{$nf->forecash}}<br>@endif
																			@endif
																		@endforeach
																	</td>
																@elseif($mar=='0') 
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																@endif
																@if($mar2>=1 && $npkp->note_rd_pv!=null)
																	<td>{{$npkp->note_rd_pv}}</td>
																	<td>{{$npkp->prioritas}}</td>
																	<td>{{$npkp->launch}} {{$npkp->launch_years}}</td>
																	<td>
																		@foreach($NForecast as $nf)
																			@if($nf->id_pkp==$dnpkp->id_project && $nf->id_pkp==$npkp->id_pkp)
																				@if($nf->info=='1' && $npkp->created==$nf->date) {{$nf->satuan}} = {{$nf->forecash}}<br>@endif
																			@endif
																		@endforeach
																	</td>
																@elseif($mar2=='0') 
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																@endif 
															@endif
														@endforeach
														@foreach($Npkp as $npkp) 
															@if($npkp->Bulan=='February' && $npkp->id_pkp==$dnpkp->id_project)
																@if($feb>=1 && $npkp->note_pv_marketing!=null)
																	<td>{{$npkp->note_pv_marketing}}</td>
																	<td>{{$npkp->prioritas}}</td>
																	<td>{{$npkp->launch}} {{$npkp->launch_years}}</td>
																	<td>
																		@foreach($NForecast as $nf)
																			@if($nf->id_pkp==$dnpkp->id_project && $nf->id_pkp==$npkp->id_pkp)
																				@if($nf->info=='2' && $npkp->created==$nf->date) {{$nf->satuan}} = {{$nf->forecash}}<br>@endif
																			@endif
																		@endforeach
																	</td>
																@elseif($feb=='0') 
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																@endif
																@if($feb2>=1 && $npkp->note_rd_pv!=null)
																	<td>{{$npkp->note_rd_pv}}</td>
																	<td>{{$npkp->prioritas}}</td>
																	<td>{{$npkp->launch}} {{$npkp->launch_years}}</td>
																	<td>
																		@foreach($NForecast as $nf)
																			@if($nf->id_pkp==$dnpkp->id_project && $nf->id_pkp==$npkp->id_pkp)
																				@if($nf->info=='1' && $npkp->created==$nf->date) {{$nf->satuan}} = {{$nf->forecash}}<br>@endif
																			@endif
																		@endforeach
																	</td>
																@elseif($feb2=='0') 
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																@endif 
															@endif
														@endforeach
														@foreach($Npkp as $npkp) 
															@if($npkp->Bulan=='January' && $npkp->id_pkp==$dnpkp->id_project)
																@if($jan>=1 && $npkp->note_pv_marketing!=null)
																	<td>{{$npkp->note_pv_marketing}}</td>
																	<td>{{$npkp->prioritas}}</td>
																	<td>{{$npkp->launch}} {{$npkp->launch_years}}</td>
																	<td>
																		@foreach($NForecast as $nf)
																			@if($nf->id_pkp==$dnpkp->id_project && $nf->id_pkp==$npkp->id_pkp)
																				@if($nf->info=='2' && $npkp->created==$nf->date) {{$nf->satuan}} = {{$nf->forecash}}<br>@endif
																			@endif
																		@endforeach
																	</td>
																@elseif($jan=='0') 
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																@endif
																@if($jan2>=1 && $npkp->note_rd_pv!=null)
																	<td>{{$npkp->note_rd_pv}}</td>
																	<td>{{$npkp->prioritas}}</td>
																	<td>{{$npkp->launch}} {{$npkp->launch_years}}</td>
																	<td>
																		@foreach($NForecast as $nf)
																			@if($nf->id_pkp==$dnpkp->id_project && $nf->id_pkp==$npkp->id_pkp)
																				@if($nf->info=='1' && $npkp->created==$nf->date) {{$nf->satuan}} = {{$nf->forecash}}<br>@endif
																			@endif
																		@endforeach
																	</td>
																@elseif($jan2=='0') 
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																@endif 
															@endif
														@endforeach
													</tr>
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
								</div>
						</div>
          </section>
        </div>
      </div>
		</div>
	</div>
</div>
@endsection