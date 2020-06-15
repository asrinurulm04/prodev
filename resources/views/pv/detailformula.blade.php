@extends('pv.tempvv')
@section('title', 'Detail Formula')
@section('halaman')
<ul class="breadcrumb">
  <li class="breadcrumb-item"><a href="{{ route('approvalformula') }}"> <i class="fa fa-home"></i> </a></li>@foreach ($projects as $project)
  <li class="breadcrumb-item"><a href="{{ route('detailproject',$project['id']) }}">Detail Project</a></li>@endforeach
  <li class="breadcrumb-item"><a href="#">Detail Formula</a></li>
</ul>
@endsection

@section('content')

@if (session('status'))
<div class="row">
  <div class="col-md-12">
    <div class="alert alert-success" style="margin:20px">
      <button type="button" class="close" data-dismiss="alert">×</button>
      {{ session('status') }}
    </div>
  </div>
</div>  
@endif

<div class="pcoded-inner-content">
  <div class="main-body">
    <div class="page-wrapper">
      <div class="page-body">
      	<div class="row">
          <div class="col-sm-12">
						<br>
						<div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
  							<div class="form-panel" style="margin-left:20px;margin-right:20px">
    							<div class="row" >
      							<div class="col-md-6">
        						</div>
          					<div class="col-md-6" style="align:right">
            					<div style="float:right">
            						@if($formula->vv!="ok")
                        @if($formula->vv!="tidak")
                        <a class="btn btn-out-dashed waves-effect waves-light btn-info btn-square"     href="{{ route('approveformula',$formula->id) }}" onclick="return confirm('Approve Formula Ini ?')"><i class="fa fa-check"></i> Approve</a>
                        @endif
                        @endif
                        @if($formula->status_fisibility!="proses")
                        @if($formula->vv=="ok")
                        <a class="btn btn-out-dashed waves-effect waves-light btn-success btn-square"  href="{{ route('ajukanfs',$formula->id) }}"       onclick="return confirm('Ajukan Formula Ini Kepada Tim Finance ?')"><i class="fa fa-usd"></i> Finance</a>
                        @endif @endif
                        @if($formula->status_nutfact!="proses")
                        @if($formula->vv=="ok")
                        <a class="btn btn-out-dashed waves-effect waves-light btn-primary btn-square"  href="{{ route('ajukanfn',$formula->id) }}"       onclick="return confirm('Ajukan Formula Ini Kepada Tim Nutfact ?')"><i class="fa fa-flask"></i> Nutfact</a>
                        @endif @endif
                        @if($formula->vv!="tidak")
                        <a class="btn btn-out-dashed waves-effect waves-light btn-danger btn-square"   href="{{ route('rejectformula',$formula->id) }}"  onclick="return confirm('Reject Formula Ini ?')"><i class="fa fa-times"></i> Reject</a>
                        @endif
                        <a class="btn btn-out-dashed waves-effect waves-light btn-warning btn-square"  href="{{ route('detailproject',$formula->workbook_id) }}"><i class="fa fa-share"></i> Kembali</a>
                			</div>
            				</div>       
        					</div><br>
        					<div class="row">
            				<div class="col-md-4">
                			<table>
                    		<tr>
                        	<td>Nama Produk</td><td>&nbsp; : {{ $formula->nama_produk }}</td>                    
                    		</tr>
                    		<tr>
                        	<td>Kode Formula</td><td>&nbsp; : {{ $formula->kode_formula }}</td>
                    		</tr>
                    		<tr>
                        	<td>Revisi</td><td>&nbsp; : {{ $formula->revisi }}</td>
                    		</tr>
                    		<tr>
                        	<td>Versi</td><td>&nbsp; : {{ $formula->versi }}.{{ $formula->turunan }}</td>
                    		</tr>
                			</table>
            				</div>
            				<div class="col-md-4">
                		<table>
                    	<tr>
                        <td>User</td><td>&nbsp; : {{ $formula->workbook->user->name }} </td>
                    	</tr>
                    	<tr>
                        <td>Jumlah Batch</td><td>&nbsp; : {{ $formula->batch }} &nbsp;Gram</td>
                    	</tr>
                    	<tr>                    
                        <td>Jumlah Serving</td><td>&nbsp; : {{ $formula->serving }} &nbsp;Gram</td>
                    	</tr>
                		</table>
            			</div>
            			<div class="col-md-4">
                		<table>
                    	<tr>
                        <td>Status PV</td><td>&nbsp; :
                          @if ($formula->vv == 'proses')
                          <span class="label label-warning">Proses</span>                        
                          @endif
                          @if ($formula->vv == 'tidak')
                          <span class="label label-danger">Rejected</span>                        
                          @endif 
                          @if ($formula->vv == 'ok')
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
        				</div>
        				<div calss="row">
                  <ul class="nav nav-tabs md-tabs " role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" data-toggle="tab" href="#home7" role="tab"><i class="fa fa-list"></i> Formula</a>
                      <div class="slide"></div>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#profile7" role="tab"><i class="fa fa-folder "></i> Nutfact</a>
                      <div class="slide"></div>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#messages7" role="tab"><i class="fa fa-usd"></i> HPP FORMULA</a>
                      <div class="slide"></div>
                    </li>
                	</ul>
                  <div class="tab-content card-block">
                    <div class="tab-pane active" id="home7" role="tabpanel">
                      <div class="tab-pane active" id="1">
                        @php
                          $no = 0;
                        @endphp 
                        @if ($ada > 0)
                        <div class="panel-default">	
													<div class="panel-body badan">
													<label>PT NUTRIFOOD INDONESIA</label>
													<table ALIGN="right">
														<tr>
															<th class="text-right">KODE FORM : F.R.15003</th>
														</tr>
													</table>
													<center> <h2 style="font-size: 22px;font-weight: bold;">FORMULA PRODUK</h2> </center>
													<center> <h2 style="font-size: 20px;font-weight: bold;">( FOR )</h2> </center>
													<button type="button" class=" btn-primary btn-lg" ALIGN="center">PRODUKSI DI PLANT  A</button>
													<table class="col-md-5 col-sm- col-xs-12">
														<tr>
															<th width="10%">Nama Produk </th>
															<th width="45%">: {{ $formula->nama_produk }}</th>
														<tr>
															<th width="10%">No. Formula</th>
															<th width="45%">: {{ $formula->kode_formula }}</th>
														<tr>
															<th width="10%">Revisi</th>
															<th width="45%">: {{ $formula->revisi }}</th>
														</tr>
														<tr>
															<th width="10%">Gd. Baku | IO</th>
															<th width="45%">:</th>
														</tr>
														<br><br>
													</table>

													<table ALIGN="right">
														<tr><th class="text-right">Tanggal : {{ $formula->created_at}} </th></tr>
														<tr><th class="text-right">jumlah/batch : {{ $formula->batch }}  g</th></tr>
													</table>
													<br><br>
					
													<table class="table">
														<thead>
															<tr style="font-size: 12px;font-weight: bold; color:black;background-color: #ddd">  
																<th class="text-center">No</th>
																<th class="text-center">kode komputer bahan</th>
																<th class="text-center">Nama Sederhana</th>
																<th class="text-center">Nama bahan</th>
																<th class="text-center">Per Batch (Gr) </th>
																<th class="text-center">Per Serving (Gr) </th>
																<th class="text-center">%</th>
															</tr>
														</thead>
														<tbody>

															{{-- Non Granulasi --}}
															<?php $no = 0;?>
          										@foreach ($detail_formula->sortByDesc('per_batch') as $fortail)
															<?php $no++ ;?>
          										@if ($fortail['granulasi'] == 'tidak')
          										<tr>
          										  <td>{{ $no }}</td>
          										  <td>{{ $fortail['kode_komputer'] }}</td>
          										  <td>{{ $fortail['nama_sederhana'] }}</td>
          										  <td>{{ $fortail['nama_bahan'] }}</td>
          										  <td>{{ $fortail['per_batch'] }}</td>
          										  <td>{{ $fortail['per_serving'] }}</td>
          										  <td>{{ $fortail['persen'] }} &nbsp;%</td>
          										</tr>                                                        
															@endif
          										@endforeach
          										{{-- Granulasi --}}
															<tr style="background-color:#eaeaea;color:grey">
          										  <td colspan="7">Granulasi &nbsp;  % &nbsp; {{ $gp }}</td>                                            
          										</tr>
					                    <?php $no = 0;?>
                              @foreach ($detail_formula->sortByDesc('per_batch') as $fortail)
					                    <?php $no++ ;?>
                              @if ($fortail['granulasi'] == 'ya')
                              <tr>
                                <td>{{ $no }}</td>
                                <td>{{ $fortail['kode_komputer'] }}</td>
                                <td>{{ $fortail['nama_sederhana'] }}</td>
                                <td>{{ $fortail['nama_bahan'] }}</td>
                                <td class="text-left">{{ $fortail['per_batch'] }}</td>
                                <td>{{ $fortail['per_serving'] }}</td>
                                <td class="text-right">{{ $fortail['persen'] }} &nbsp;</td>
                              </tr>                                                        
                              @endif
                              @endforeach
					                    <tr style="font-size: 12px;font-weight: bold; color:black;background-color: rgb(78, 205, 196, 0.5);">
					                    	<td colspan="4" class="text-center">Total</td>
					                    	<td class="text-center">{{ $formula->batch }}</td>
                                <td class="text-center">{{ $formula->serving }}</td>
                                <td class="text-center"> 100 % </td>
					                    </tr>
				                    </tbody>
			                    </table>
					
			                    <table ALIGN="right" class="table-bordered">
			                    	<thead>
			                    		<tr>
			                    			<th class="text-center" colspan="2">Dibuat Oleh :</th>
			                    			<th class="text-center">Mengetahui  *): </th>
		                    			</tr>
			                    	</thead>
			                    	<tbody>
			                    		<tr class="text-center">
		                    				<td class="text-center"><br><br><br><br><br></td>
			                    			<td class="text-center"><br><br><br><br><br></td>
					                    </tr>
			                    		<tr>
			                    			<td class="text-center" width="35%">RD Sourcing</td>
			                    			<td class="text-center" width="45%">RD Sourcing Asso Mgr</td>
			                    			<td class="text-center">RPE Manager</td>
			                    		</tr>
			                    	</tbody>
			                    </table>
                          <br><br><br><br><br><br><br><br>
                          <table ALIGN="right">
                            <tr><td>Revisi/Berlaku : {{ $formula->created_at }} </td></tr>
                            <tr><td>Masa Berlaku : Selamanya</td></tr>
                          </table>

                          <table>
                          <tr>*) Ditandatangani jika perubahan formula berasal/ diajukan oleh RD sourcing</tr>
                          </table>
	                        </div>
                        </div>
                        @endif
                      </div>
                    </div>
                    <div class="tab-pane" id="profile7" role="tabpanel">
                      <p class="m-0">2.Cras consequat in enim ut efficitur. Nulla posuere elit quis auctor interdum praesent sit amet nulla vel enim amet. Donec convallis tellus neque, et imperdiet felis amet.</p>
                    </div>
                    <div class="tab-pane" id="messages7" role="tabpanel">
                      <div class="tab-pane" id="3">
                        @php
                          $no = 0;
                        @endphp
                        @if ($ada > 0)
                        <div class="row">
                          <div class="col-md-5">
                            <table class="table table-bordered" style="font-size:12px">
                              <thead>
                                <th colspan="4" style="font-size: 12px;font-weight: bold; color:black;background-color: #ddd;"><center>Bahan Baku</center></th>
                              </thead>
                              <thead>
                                <th>Kode Item</th>
                                <th>Nama Bahan</th>
                                <th>Harga</th>
                              </thead>
                              <tbody>
                                @foreach ($detail_harga->sortByDesc('harga_per_serving') as $fortail)
                                <tr>
                                  <td>{{ $fortail['kode_komputer'] }}</td>
                                  <td>{{ $fortail['nama_sederhana'] }}</td>
                                  <td>Rp.{{ $fortail['hpg'] }}</td>
                                </tr>
                                @endforeach
                                <tr style="font-size: 12px;font-weight: bold; color:black;background-color: rgb(78, 205, 196, 0.5);">
                                  <td colspan="2">Jumlah</td>
                                  <td>Rp.{{ $total_harga['total_harga_per_gram'] }}</td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                          <div class="col-md-3">
                            <table class="table table-bordered" style="font-size:12px">
                              <thead>
                                <th colspan="3" style="font-size: 12px;font-weight: bold; color:black;background-color: #ddd;"><center>Per Serving</center></th>                                                                                                                
                              </thead>
                              <thead>
                                <th>Berat</th>
                                <th width="10%">%</th>
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
                                <tr style="font-size: 12px;font-weight: bold; color:black;background-color: rgb(78, 205, 196, 0.5);">
                                  <td>{{ $total_harga['total_berat_per_serving'] }}</td>
                                  <td>{{ $total_harga['total_persen'] }}</td>
                                  <td>Rp.{{ $total_harga['total_harga_per_serving'] }}</td>
                                </tr>                                                        
                              </tbody>
                            </table>
                          </div>
                          <div class="col-md-2">
                            <table class="table table-bordered" style="font-size:12px">
                              <thead>
                                <th colspan="2" style="font-size: 12px;font-weight: bold; color:black;background-color: #ddd;"><center>Per Batch</center></th>
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
                                <tr style="font-size: 12px;font-weight: bold; color:black;background-color: rgb(78, 205, 196, 0.5);">
                                  <td>{{ $total_harga['total_berat_per_batch'] }}</td>
                                  <td>Rp.{{ $total_harga['total_harga_per_batch'] }}</td>                                                        
                                </tr> 
                              </tbody>
                            </table>
                          </div>
                          <div class="col-md-2">
                            <table class="table table-bordered" style="font-size:12px">
                              <thead>
                                <th colspan="2" style="font-size: 12px;font-weight: bold; color:black;background-color: #ddd;"><center>Per Kg</center></th>
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
                                <tr style="font-size: 12px;font-weight: bold; color:black;background-color: rgb(78, 205, 196, 0.5);">
                                  <td>{{ $total_harga['total_berat_per_kg'] }}</td> --}}
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
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
{{-- Start --}}

@endsection