@extends('layout.tempvv')
@section('title', 'PRODEV|Report Notulen')
@section('content')

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
			<div class="x_title">
				<h3><li class="fa fa-edit"></li> Report Notulen PKP</h3>
			</div>
			<div class="" style="overflow-x: scroll;">
        <div id="exTab2" class="container"> 
          <section id="fancyTabWidget" class="tabs t-tabs">
						<ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
							<li class="nav-item"><a class="nav-link  active" href="#1" data-toggle="tab"><b> January </b></a></li>
							<li class="nav-item"><a class="nav-link" href="#2" data-toggle="tab"><b> February </b></a></li>
							<li class="nav-item"><a class="nav-link" href="#3" data-toggle="tab"><b> March</b></a></li>
							<li class="nav-item"><a class="nav-link" href="#4" data-toggle="tab"><b> April </b></a></li>
							<li class="nav-item"><a class="nav-link" href="#5" data-toggle="tab"><b> May</b></a></li>
							<li class="nav-item"><a class="nav-link" href="#6" data-toggle="tab"><b> June </b></a></li>
							<li class="nav-item"><a class="nav-link" href="#7" data-toggle="tab"><b> july</b></a></li>
							<li class="nav-item"><a class="nav-link" href="#8" data-toggle="tab"><b> August </b></a></li>
							<li class="nav-item"><a class="nav-link" href="#9" data-toggle="tab"><b> September</b></a></li>
							<li class="nav-item"><a class="nav-link" href="#10" data-toggle="tab"><b> October</b></a></li>
							<li class="nav-item"><a class="nav-link" href="#11" data-toggle="tab"><b> November </b></a></li>
							<li class="nav-item"><a class="nav-link" href="#12" data-toggle="tab"><b> December</b></a></li>
						</ul><br>
						<div class="tab-content ">
							<div class="tab-content ">
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
								<!-- Jan -->
								<div class="tab-pane active" id="1">
									<div class="row">
										<div class="col-md-12">
											<table id="datatable" class="table table-striped table-bordered" style="width:100%">
												<thead>
													<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
														<th class="text-center" width="3%" rowspan="3">Prioritas</th>
														<th class="text-center" rowspan="3">PKP Number</th>
														<th class="text-center" style="min-width:300px" colspan="6">January</th>
													</tr>
													<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
														<th class="text-center" style="min-width:300px" colspan="3">Meeting PV & Marketing</th>
														<th class="text-center" style="min-width:300px" colspan="3">Meeting PV & RD</th>
													</tr>
													<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
														<th class="text-center">Notulen</th>
														<th class="text-center">Priority</th>
														<th class="text-center">Launch Deadline</th>
														<th class="text-center">Notulen</th>
														<th class="text-center">Priority</th>
														<th class="text-center">Launch Deadline</th>
													</tr>
												</thead>
												<tbody>
													@foreach ($DNpkp as $npkp)
													@if($npkp->Bulan=='January')
													<tr>
														<td class="text-center">{{ $npkp->prioritas }}</td>
														<td>{{$npkp->pkp_number}}{{$npkp->ket_no}}</td>
														@if($npkp->Bulan=='January' && $npkp->note_pv_marketing!=null)
															<td>{{$npkp->note_pv_marketing}}</td>
															<td>{{$npkp->prioritas}}</td>
															<td>{{$npkp->launch}} {{$npkp->launch_years}}</td>
														@elseif($npkp->Bulan=='January' && $npkp->note_pv_marketing==null) 
															<td></td>
															<td></td>
															<td></td>
														@endif
														@if($npkp->Bulan=='January' && $npkp->note_rd_pv!=null)
															<td>{{$npkp->note_rd_pv}}</td>
															<td>{{$npkp->prioritas}}</td>
															<td>{{$npkp->launch}} {{$npkp->launch_years}}</td>
														@elseif($npkp->Bulan=='January' && $npkp->note_rd_pv==null) 
															<td></td>
															<td></td>
															<td></td>
														@endif 
													</tr>
													@endif
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<!-- Feb -->
								<div class="tab-pane" id="2">
									<div class="row">
										<div class="col-md-12">
											<table id="datatable" class="table table-striped table-bordered" style="width:100%">
												<thead>
													<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
														<th class="text-center" width="3%" rowspan="3">Prioritas</th>
														<th class="text-center" rowspan="3">PKP Number</th>
														<th class="text-center" style="min-width:300px" colspan="6">February</th>
													</tr>
													<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
														<th class="text-center" style="min-width:300px" colspan="3">Meeting PV & Marketing</th>
														<th class="text-center" style="min-width:300px" colspan="3">Meeting PV & RD</th>
													</tr>
													<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
														<th class="text-center">Notulen</th>
														<th class="text-center">Priority</th>
														<th class="text-center">Launch Deadline</th>
														<th class="text-center">Notulen</th>
														<th class="text-center">Priority</th>
														<th class="text-center">Launch Deadline</th>
													</tr>
												</thead>
												<tbody>
													@foreach ($DNpkp as $npkp)
													@if($npkp->Bulan=='February')
													<tr>
														<td class="text-center">{{ $npkp->prioritas }}</td>
														<td>{{$npkp->pkp_number}}{{$npkp->ket_no}}</td>
														@if($npkp->Bulan=='February' && $npkp->note_pv_marketing!=null)
															<td>{{$npkp->note_pv_marketing}}</td>
															<td>{{$npkp->prioritas}}</td>
															<td>{{$npkp->launch}} {{$npkp->launch_years}}</td>
														@elseif($npkp->Bulan=='February' && $npkp->note_pv_marketing==null) 
															<td></td>
															<td></td>
															<td></td>
														@endif
														@if($npkp->Bulan=='February' && $npkp->note_rd_pv!=null)
															<td>{{$npkp->note_rd_pv}}</td>
															<td>{{$npkp->prioritas}}</td>
															<td>{{$npkp->launch}} {{$npkp->launch_years}}</td>
														@elseif($npkp->Bulan=='February' && $npkp->note_rd_pv==null) 
															<td></td>
															<td></td>
															<td></td>
														@endif 
													</tr>
													@endif
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<!-- Maret -->
								<div class="tab-pane" id="3">
									<div class="row">
										<div class="col-md-12">
											<table id="datatable" class="table table-striped table-bordered" style="width:100%">
												<thead>
													<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
														<th class="text-center" width="3%" rowspan="3">Prioritas</th>
														<th class="text-center" rowspan="3">PKP Number</th>
														<th class="text-center" style="min-width:300px" colspan="6">March</th>
													</tr>
													<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
														<th class="text-center" style="min-width:300px" colspan="3">Meeting PV & Marketing</th>
														<th class="text-center" style="min-width:300px" colspan="3">Meeting PV & RD</th>
													</tr>
													<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
														<th class="text-center">Notulen</th>
														<th class="text-center">Priority</th>
														<th class="text-center">Launch Deadline</th>
														<th class="text-center">Notulen</th>
														<th class="text-center">Priority</th>
														<th class="text-center">Launch Deadline</th>
													</tr>
												</thead>
												<tbody>
													@foreach ($DNpkp as $npkp)
													@if($npkp->Bulan=='March')
													<tr>
														<td class="text-center">{{ $npkp->prioritas }}</td>
														<td>{{$npkp->pkp_number}}{{$npkp->ket_no}}</td>
														@if($npkp->Bulan=='March' && $npkp->note_pv_marketing!=null)
															<td>{{$npkp->note_pv_marketing}}</td>
															<td>{{$npkp->prioritas}}</td>
															<td>{{$npkp->launch}} {{$npkp->launch_years}}</td>
														@elseif($npkp->Bulan=='March' && $npkp->note_pv_marketing==null) 
															<td></td>
															<td></td>
															<td></td>
														@endif
														@if($npkp->Bulan=='March' && $npkp->note_rd_pv!=null)
															<td>{{$npkp->note_rd_pv}}</td>
															<td>{{$npkp->prioritas}}</td>
															<td>{{$npkp->launch}} {{$npkp->launch_years}}</td>
														@elseif($npkp->Bulan=='March' && $npkp->note_rd_pv==null) 
															<td></td>
															<td></td>
															<td></td>
														@endif 
													</tr>
													@endif
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<!-- April -->
								<div class="tab-pane" id="4">
									<div class="row">
										<div class="col-md-12">
											<table id="datatable" class="table table-striped table-bordered" style="width:100%">
												<thead>
													<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
														<th class="text-center" width="3%" rowspan="3">Prioritas</th>
														<th class="text-center" rowspan="3">PKP Number</th>
														<th class="text-center" style="min-width:300px" colspan="6">April</th>
													</tr>
													<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
														<th class="text-center" style="min-width:300px" colspan="3">Meeting PV & Marketing</th>
														<th class="text-center" style="min-width:300px" colspan="3">Meeting PV & RD</th>
													</tr>
													<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
														<th class="text-center">Notulen</th>
														<th class="text-center">Priority</th>
														<th class="text-center">Launch Deadline</th>
														<th class="text-center">Notulen</th>
														<th class="text-center">Priority</th>
														<th class="text-center">Launch Deadline</th>
													</tr>
												</thead>
												<tbody>
													@foreach ($DNpkp as $npkp)
													@if($npkp->Bulan=='April')
													<tr>
														<td class="text-center">{{ $npkp->prioritas }}</td>
														<td>{{$npkp->pkp_number}}{{$npkp->ket_no}}</td>
														@if($npkp->Bulan=='April' && $npkp->note_pv_marketing!=null)
															<td>{{$npkp->note_pv_marketing}}</td>
															<td>{{$npkp->prioritas}}</td>
															<td>{{$npkp->launch}} {{$npkp->launch_years}}</td>
														@elseif($npkp->Bulan=='April' && $npkp->note_pv_marketing==null) 
															<td></td>
															<td></td>
															<td></td>
														@endif
														@if($npkp->Bulan=='April' && $npkp->note_rd_pv!=null)
															<td>{{$npkp->note_rd_pv}}</td>
															<td>{{$npkp->prioritas}}</td>
															<td>{{$npkp->launch}} {{$npkp->launch_years}}</td>
														@elseif($npkp->Bulan=='April' && $npkp->note_rd_pv==null) 
															<td></td>
															<td></td>
															<td></td>
														@endif 
													</tr>
													@endif
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<!-- Mei -->
								<div class="tab-pane" id="5">
									<div class="row">
										<div class="col-md-12">
											<table id="datatable" class="table table-striped table-bordered" style="width:100%">
												<thead>
													<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
														<th class="text-center" width="3%" rowspan="3">Prioritas</th>
														<th class="text-center" rowspan="3">PKP Number</th>
														<th class="text-center" style="min-width:300px" colspan="6">May</th>
													</tr>
													<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
														<th class="text-center" style="min-width:300px" colspan="3">Meeting PV & Marketing</th>
														<th class="text-center" style="min-width:300px" colspan="3">Meeting PV & RD</th>
													</tr>
													<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
														<th class="text-center">Notulen</th>
														<th class="text-center">Priority</th>
														<th class="text-center">Launch Deadline</th>
														<th class="text-center">Notulen</th>
														<th class="text-center">Priority</th>
														<th class="text-center">Launch Deadline</th>
													</tr>
												</thead>
												<tbody>
													@foreach ($DNpkp as $npkp)
													@if($npkp->Bulan=='May')
													<tr>
														<td class="text-center">{{ $npkp->prioritas }}</td>
														<td>{{$npkp->pkp_number}}{{$npkp->ket_no}}</td>
														@if($npkp->Bulan=='May' && $npkp->note_pv_marketing!=null)
															<td>{{$npkp->note_pv_marketing}}</td>
															<td>{{$npkp->prioritas}}</td>
															<td>{{$npkp->launch}} {{$npkp->launch_years}}</td>
														@elseif($npkp->Bulan=='May' && $npkp->note_pv_marketing==null) 
															<td></td>
															<td></td>
															<td></td>
														@endif
														@if($npkp->Bulan=='May' && $npkp->note_rd_pv!=null)
															<td>{{$npkp->note_rd_pv}}</td>
															<td>{{$npkp->prioritas}}</td>
															<td>{{$npkp->launch}} {{$npkp->launch_years}}</td>
														@elseif($npkp->Bulan=='May' && $npkp->note_rd_pv==null) 
															<td></td>
															<td></td>
															<td></td>
														@endif 
													</tr>
													@endif
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<!-- Jun -->
								<div class="tab-pane" id="6">
									<div class="row">
										<div class="col-md-12">
											<table id="datatable" class="table table-striped table-bordered" style="width:100%">
												<thead>
													<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
														<th class="text-center" width="3%" rowspan="3">Prioritas</th>
														<th class="text-center" rowspan="3">PKP Number</th>
														<th class="text-center" style="min-width:300px" colspan="6">June</th>
													</tr>
													<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
														<th class="text-center" style="min-width:300px" colspan="3">Meeting PV & Marketing</th>
														<th class="text-center" style="min-width:300px" colspan="3">Meeting PV & RD</th>
													</tr>
													<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
														<th class="text-center">Notulen</th>
														<th class="text-center">Priority</th>
														<th class="text-center">Launch Deadline</th>
														<th class="text-center">Notulen</th>
														<th class="text-center">Priority</th>
														<th class="text-center">Launch Deadline</th>
													</tr>
												</thead>
												<tbody>
													@foreach ($DNpkp as $npkp)
													@if($npkp->Bulan=='June')
													<tr>
														<td class="text-center">{{ $npkp->prioritas }}</td>
														<td>{{$npkp->pkp_number}}{{$npkp->ket_no}}</td>
														@if($npkp->Bulan=='June' && $npkp->note_pv_marketing!=null)
															<td>{{$npkp->note_pv_marketing}}</td>
															<td>{{$npkp->prioritas}}</td>
															<td>{{$npkp->launch}} {{$npkp->launch_years}}</td>
														@elseif($npkp->Bulan=='June' && $npkp->note_pv_marketing==null) 
															<td></td>
															<td></td>
															<td></td>
														@endif
														@if($npkp->Bulan=='June' && $npkp->note_rd_pv!=null)
															<td>{{$npkp->note_rd_pv}}</td>
															<td>{{$npkp->prioritas}}</td>
															<td>{{$npkp->launch}} {{$npkp->launch_years}}</td>
														@elseif($npkp->Bulan=='June' && $npkp->note_rd_pv==null) 
															<td></td>
															<td></td>
															<td></td>
														@endif 
													</tr>
													@endif
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<!-- Jul -->
								<div class="tab-pane" id="7">
									<div class="row">
										<div class="col-md-12">
											<table id="datatable" class="table table-striped table-bordered" style="width:100%">
												<thead>
													<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
														<th class="text-center" width="3%" rowspan="3">Prioritas</th>
														<th class="text-center" rowspan="3">PKP Number</th>
														<th class="text-center" style="min-width:300px" colspan="6">July</th>
													</tr>
													<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
														<th class="text-center" style="min-width:300px" colspan="3">Meeting PV & Marketing</th>
														<th class="text-center" style="min-width:300px" colspan="3">Meeting PV & RD</th>
													</tr>
													<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
														<th class="text-center">Notulen</th>
														<th class="text-center">Priority</th>
														<th class="text-center">Launch Deadline</th>
														<th class="text-center">Notulen</th>
														<th class="text-center">Priority</th>
														<th class="text-center">Launch Deadline</th>
													</tr>
												</thead>
												<tbody>
													@foreach ($DNpkp as $npkp)
													@if($npkp->Bulan=='July')
													<tr>
														<td class="text-center">{{ $npkp->prioritas }}</td>
														<td>{{$npkp->pkp_number}}{{$npkp->ket_no}}</td>
														@if($npkp->Bulan=='July' && $npkp->note_pv_marketing!=null)
															<td>{{$npkp->note_pv_marketing}}</td>
															<td>{{$npkp->prioritas}}</td>
															<td>{{$npkp->launch}} {{$npkp->launch_years}}</td>
														@elseif($npkp->Bulan=='July' && $npkp->note_pv_marketing==null) 
															<td></td>
															<td></td>
															<td></td>
														@endif
														@if($npkp->Bulan=='July' && $npkp->note_rd_pv!=null)
															<td>{{$npkp->note_rd_pv}}</td>
															<td>{{$npkp->prioritas}}</td>
															<td>{{$npkp->launch}} {{$npkp->launch_years}}</td>
														@elseif($npkp->Bulan=='July' && $npkp->note_rd_pv==null) 
															<td></td>
															<td></td>
															<td></td>
														@endif 
													</tr>
													@endif
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<!-- Agustus -->
								<div class="tab-pane" id="8">
									<div class="row">
										<div class="col-md-12">
											<table id="datatable" class="table table-striped table-bordered" style="width:100%">
												<thead>
													<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
														<th class="text-center" width="3%" rowspan="3">Prioritas</th>
														<th class="text-center" rowspan="3">PKP Number</th>
														<th class="text-center" style="min-width:300px" colspan="6">August</th>
													</tr>
													<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
														<th class="text-center" style="min-width:300px" colspan="3">Meeting PV & Marketing</th>
														<th class="text-center" style="min-width:300px" colspan="3">Meeting PV & RD</th>
													</tr>
													<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
														<th class="text-center">Notulen</th>
														<th class="text-center">Priority</th>
														<th class="text-center">Launch Deadline</th>
														<th class="text-center">Notulen</th>
														<th class="text-center">Priority</th>
														<th class="text-center">Launch Deadline</th>
													</tr>
												</thead>
												<tbody>
													@foreach ($DNpkp as $npkp)
													@if($npkp->Bulan=='August')
													<tr>
														<td class="text-center">{{ $npkp->prioritas }}</td>
														<td>{{$npkp->pkp_number}}{{$npkp->ket_no}}</td>
														@if($npkp->Bulan=='August' && $npkp->note_pv_marketing!=null)
															<td>{{$npkp->note_pv_marketing}}</td>
															<td>{{$npkp->prioritas}}</td>
															<td>{{$npkp->launch}} {{$npkp->launch_years}}</td>
														@elseif($npkp->Bulan=='August' && $npkp->note_pv_marketing==null) 
															<td></td>
															<td></td>
															<td></td>
														@endif
														@if($npkp->Bulan=='August' && $npkp->note_rd_pv!=null)
															<td>{{$npkp->note_rd_pv}}</td>
															<td>{{$npkp->prioritas}}</td>
															<td>{{$npkp->launch}} {{$npkp->launch_years}}</td>
														@elseif($npkp->Bulan=='August' && $npkp->note_rd_pv==null) 
															<td></td>
															<td></td>
															<td></td>
														@endif 
													</tr>
													@endif
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<!-- Sept -->
								<div class="tab-pane" id="9">
									<div class="row">
										<div class="col-md-12">
											<table id="datatable" class="table table-striped table-bordered" style="width:100%">
												<thead>
													<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
														<th class="text-center" width="3%" rowspan="3">Prioritas</th>
														<th class="text-center" rowspan="3">PKP Number</th>
														<th class="text-center" style="min-width:300px" colspan="6">September</th>
													</tr>
													<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
														<th class="text-center" style="min-width:300px" colspan="3">Meeting PV & Marketing</th>
														<th class="text-center" style="min-width:300px" colspan="3">Meeting PV & RD</th>
													</tr>
													<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
														<th class="text-center">Notulen</th>
														<th class="text-center">Priority</th>
														<th class="text-center">Launch Deadline</th>
														<th class="text-center">Notulen</th>
														<th class="text-center">Priority</th>
														<th class="text-center">Launch Deadline</th>
													</tr>
												</thead>
												<tbody>
													@foreach ($DNpkp as $npkp)
													@if($npkp->Bulan=='September')
													<tr>
														<td class="text-center">{{ $npkp->prioritas }}</td>
														<td>{{$npkp->pkp_number}}{{$npkp->ket_no}}</td>
														@if($npkp->Bulan=='September' && $npkp->note_pv_marketing!=null)
															<td>{{$npkp->note_pv_marketing}}</td>
															<td>{{$npkp->prioritas}}</td>
															<td>{{$npkp->launch}} {{$npkp->launch_years}}</td>
														@elseif($npkp->Bulan=='September' && $npkp->note_pv_marketing==null) 
															<td></td>
															<td></td>
															<td></td>
														@endif
														@if($npkp->Bulan=='September' && $npkp->note_rd_pv!=null)
															<td>{{$npkp->note_rd_pv}}</td>
															<td>{{$npkp->prioritas}}</td>
															<td>{{$npkp->launch}} {{$npkp->launch_years}}</td>
														@elseif($npkp->Bulan=='September' && $npkp->note_rd_pv==null) 
															<td></td>
															<td></td>
															<td></td>
														@endif 
													</tr>
													@endif
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<!-- Oct -->
								<div class="tab-pane" id="10">
									<div class="row">
										<div class="col-md-12">
											<table id="datatable" class="table table-striped table-bordered" style="width:100%">
												<thead>
													<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
														<th class="text-center" width="3%" rowspan="3">Prioritas</th>
														<th class="text-center" rowspan="3">PKP Number</th>
														<th class="text-center" style="min-width:300px" colspan="6">October</th>
													</tr>
													<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
														<th class="text-center" style="min-width:300px" colspan="3">Meeting PV & Marketing</th>
														<th class="text-center" style="min-width:300px" colspan="3">Meeting PV & RD</th>
													</tr>
													<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
														<th class="text-center">Notulen</th>
														<th class="text-center">Priority</th>
														<th class="text-center">Launch Deadline</th>
														<th class="text-center">Notulen</th>
														<th class="text-center">Priority</th>
														<th class="text-center">Launch Deadline</th>
													</tr>
												</thead>
												<tbody>
													@foreach ($DNpkp as $npkp)
													@if($npkp->Bulan=='October')
													<tr>
														<td class="text-center">{{ $npkp->prioritas }}</td>
														<td>{{$npkp->pkp_number}}{{$npkp->ket_no}}</td>
														@if($npkp->Bulan=='October' && $npkp->note_pv_marketing!=null)
															<td>{{$npkp->note_pv_marketing}}</td>
															<td>{{$npkp->prioritas}}</td>
															<td>{{$npkp->launch}} {{$npkp->launch_years}}</td>
														@elseif($npkp->Bulan=='October' && $npkp->note_pv_marketing==null) 
															<td></td>
															<td></td>
															<td></td>
														@endif
														@if($npkp->Bulan=='October' && $npkp->note_rd_pv!=null)
															<td>{{$npkp->note_rd_pv}}</td>
															<td>{{$npkp->prioritas}}</td>
															<td>{{$npkp->launch}} {{$npkp->launch_years}}</td>
														@elseif($npkp->Bulan=='October' && $npkp->note_rd_pv==null) 
															<td></td>
															<td></td>
															<td></td>
														@endif 
													</tr>
													@endif
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<!-- Nov -->
								<div class="tab-pane" id="11">
									<div class="row">
										<div class="col-md-12">
											<table id="datatable" class="table table-striped table-bordered" style="width:100%">
												<thead>
													<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
														<th class="text-center" width="3%" rowspan="3">Prioritas</th>
														<th class="text-center" rowspan="3">PKP Number</th>
														<th class="text-center" style="min-width:300px" colspan="6">November</th>
													</tr>
													<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
														<th class="text-center" style="min-width:300px" colspan="3">Meeting PV & Marketing</th>
														<th class="text-center" style="min-width:300px" colspan="3">Meeting PV & RD</th>
													</tr>
													<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
														<th class="text-center">Notulen</th>
														<th class="text-center">Priority</th>
														<th class="text-center">Launch Deadline</th>
														<th class="text-center">Notulen</th>
														<th class="text-center">Priority</th>
														<th class="text-center">Launch Deadline</th>
													</tr>
												</thead>
												<tbody>
													@foreach ($DNpkp as $npkp)
													@if($npkp->Bulan=='November')
													<tr>
														<td class="text-center">{{ $npkp->prioritas }}</td>
														<td>{{$npkp->pkp_number}}{{$npkp->ket_no}}</td>
														@if($npkp->Bulan=='November' && $npkp->note_pv_marketing!=null)
															<td>{{$npkp->note_pv_marketing}}</td>
															<td>{{$npkp->prioritas}}</td>
															<td>{{$npkp->launch}} {{$npkp->launch_years}}</td>
														@elseif($npkp->Bulan=='November' && $npkp->note_pv_marketing==null) 
															<td></td>
															<td></td>
															<td></td>
														@endif
														@if($npkp->Bulan=='November' && $npkp->note_rd_pv!=null)
															<td>{{$npkp->note_rd_pv}}</td>
															<td>{{$npkp->prioritas}}</td>
															<td>{{$npkp->launch}} {{$npkp->launch_years}}</td>
														@elseif($npkp->Bulan=='November' && $npkp->note_rd_pv==null) 
															<td></td>
															<td></td>
															<td></td>
														@endif 
													</tr>
													@endif
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<!-- Des -->
								<div class="tab-pane" id="12">
									<div class="row">
										<div class="col-md-12">
											<table id="datatable" class="table table-striped table-bordered" style="width:100%">
												<thead>
													<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
														<th class="text-center" width="3%" rowspan="3">Prioritas</th>
														<th class="text-center" rowspan="3">PKP Number</th>
														<th class="text-center" style="min-width:300px" colspan="6">December</th>
													</tr>
													<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
														<th class="text-center" style="min-width:300px" colspan="3">Meeting PV & Marketing</th>
														<th class="text-center" style="min-width:300px" colspan="3">Meeting PV & RD</th>
													</tr>
													<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
														<th class="text-center">Notulen</th>
														<th class="text-center">Priority</th>
														<th class="text-center">Launch Deadline</th>
														<th class="text-center">Notulen</th>
														<th class="text-center">Priority</th>
														<th class="text-center">Launch Deadline</th>
													</tr>
												</thead>
												<tbody>
													@foreach ($DNpkp as $npkp)
													@if($npkp->Bulan=='December')
													<tr>
														<td class="text-center">{{ $npkp->prioritas }}</td>
														<td>{{$npkp->pkp_number}}{{$npkp->ket_no}}</td>
														@if($npkp->Bulan=='December' && $npkp->note_pv_marketing!=null)
															<td>{{$npkp->note_pv_marketing}}</td>
															<td>{{$npkp->prioritas}}</td>
															<td>{{$npkp->launch}} {{$npkp->launch_years}}</td>
														@elseif($npkp->Bulan=='December' && $npkp->note_pv_marketing==null) 
															<td></td>
															<td></td>
															<td></td>
														@endif
														@if($npkp->Bulan=='December' && $npkp->note_rd_pv!=null)
															<td>{{$npkp->note_rd_pv}}</td>
															<td>{{$npkp->prioritas}}</td>
															<td>{{$npkp->launch}} {{$npkp->launch_years}}</td>
														@elseif($npkp->Bulan=='December' && $npkp->note_rd_pv==null) 
															<td></td>
															<td></td>
															<td></td>
														@endif 
													</tr>
													@endif
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<!-- Selesai -->
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