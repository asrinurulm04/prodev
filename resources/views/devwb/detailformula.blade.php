@extends('pv.tempvv')
@section('title', 'PRODEV|Summarry Formula')
@section('content')

<div class="x_panel">
  <div class="x_title">
    <h3><li class="fa fa-wpforms"> Summary Formula</h3>
  </div>
	<div class="row">
		<div class="col-md-4">
      <table>
				@if($formula->workbook_id!=NULL)
        <tr><th>Product Name</th><td>&nbsp; : {{ $formula->Workbook->datapkpp->project_name }}</td></tr>
				<tr><th>No.PKP</th><td>&nbsp; : {{ $formula->Workbook->datapkpp->pkp_number }}{{$formula->Workbook->datapkpp->ket_no}}</td></tr>
        <tr><th>Revised By</th><td>&nbsp; : {{ $formula->workbook->perevisi2->name }} </td></tr>
				@elseif($formula->workbook_pdf_id!=NULL)
        <tr><th>Product Name</th><td>&nbsp; : {{ $formula->Workbook_pdf->datapdf->project_name }}</td></tr>
				<tr><th>PKP Number</th><td>&nbsp; : {{ $formula->Workbook_pdf->datapdf->pdf_number }}{{$formula->Workbook_pdf->datapdf->ket_no}}</td></tr>
        <tr><th>Revised By</th><td>&nbsp; : {{ $formula->Workbook_pdf->perevisi2->name }} </td></tr>
				@endif
        <tr><th>Version</th><td>&nbsp; : {{ $formula->versi }}.{{ $formula->turunan }}</td></tr>
      </table>
    </div>
    <div class="col-md-3">
      <table>
        <tr><th>Batch</th><td>&nbsp; : {{ $formula->batch }} &nbsp;Gram</td></tr>
        <tr><th>Serving</th><td>&nbsp; : {{ $formula->serving }} &nbsp;Gram</td></tr>
      </table>
    </div>
		<div class="col-md-2"></div>
    <div class="col-md-3">
			@if($formula->workbook_id!=NULL)
      	<a class="btn btn-warning btn-sm" href="{{ route('FOR_pkp',$formula->id) }}" title="Download FOR"><i class="fa fa-download"></i> FOR</a>
      	<a class="btn btn-warning btn-sm" href="{{ route('nutfact_bayangan_pkp',$formula->id) }}" title="Download Nutfact"><i class="fa fa-download"></i> Nutfact</a>
				@if(auth()->user()->role->namaRule == 'user_produk' || auth()->user()->role->namaRule == 'pv_lokal')
				<a href="{{ route('rekappkp',$formula->workbook_id) }}" type="button" class="btn btn-sm btn-danger"><li class="fa fa-share"></li> Back</a>
				@elseif(auth()->user()->role->namaRule == 'manager')
				<a href="{{ route('daftarpkp',$formula->workbook_id) }}" type="button" class="btn btn-sm btn-danger"><li class="fa fa-share"></li> Back</a>
				@endif
			@elseif($formula->workbook_pdf_id!=NULL)
      	<a class="btn btn-warning btn-sm" href="{{ route('FOR_pdf',$formula->id) }}"  title="Download FOR"><i class="fa fa-download"></i> FOR</a>
      	<a class="btn btn-warning btn-sm" href="{{ route('nutfact_bayangan_pkp',$formula->id) }}" title="Download Nutfact"><i class="fa fa-download"></i> Nutfact</a>
				@if(auth()->user()->role->namaRule == 'user_produk' || auth()->user()->role->namaRule == 'pv_global')
				<a href="{{ route('rekappdf',$formula->workbook_pdf_id) }}" type="button" class="btn btn-sm btn-danger"><li class="fa fa-share"></li> Back</a>
				@elseif(auth()->user()->role->namaRule == 'manager')
				<a href="{{ route('daftarpdf',$formula->workbook_pdf_id) }}" type="button" class="btn btn-sm btn-danger"><li class="fa fa-share"></li> Back</a>
				@endif
			@endif
    </div>
  </div>
  <div class="card-block">
    <div class="row" style="margin:20px">
			<div id="exTab2" class="container">	
				<ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
					<li class="nav-item"><a class="nav-link  active" href="#1" data-toggle="tab"><i class="fa fa-list"></i><b> Formula </b></a></li>
					<li class="nav-item"><a class="nav-link" href="#2" data-toggle="tab"><i class="fa fa-clipboard"></i><b> Nutfact </b></a></li>
				<li class="nav-item"><a class="nav-link" href="#3" data-toggle="tab"><i class="fa fa-clipboard"></i><b> Logam berat & Mikro Biologi</b></a></li>
					<li class="nav-item"><a class="nav-link" href="#4" data-toggle="tab"><i class="fa fa-usd"></i><b> HPP Formula </b></a></li>
					@if($formula->status_panel=='proses')
					<li class="nav-item"><a class="nav-link" style="background-color:grey;color:white" ><i class="fa fa-glass"></i><b> PANEL </b></a></li>
					@elseif($formula->status_panel!='proses')
					<li class="nav-item"><a class="nav-link" href="#5" data-toggle="tab"><i class="fa fa-glass"></i><b> PANEL </b></a></li>
					@endif

					@if($formula->status_storage=='proses')
					<li class="nav-item"><a class="nav-link"  style="background-color:grey;color:white"><i class="fa fa-flask"></i><b> STORAGE </b></a></li>
					@elseif($formula->status_storage!='proses')
					<li class="nav-item"><a class="nav-link" href="#6" data-toggle="tab"><i class="fa fa-flask"></i><b> STORAGE </b></a></li>
					@endif

					@if($hfile>=1)
					<li class="nav-item"><a class="nav-link" href="#7" data-toggle="tab"><i class="fa fa-folder-open-o"></i><b> File </b></a></li>
					@elseif($hfile==0)
					<li class="nav-item"><a class="nav-link" disabled  style="background-color:grey;color:white"><i class="fa fa-folder-open-o"></i><b> File </b></a></li>
					@endif
				</ul><br>
				<div class="tab-content ">
					<div class="tab-content ">
						<!-- Data Formula -->
						<div class="tab-pane active" id="1">
							@php $no = 0; @endphp 
							@if ($ada > 0)
							<div class="panel-default">	
								<div class="panel-body badan">
									<label>PT. NUTRIFOOD INDONESIA</label>
									<center> <h2 style="font-size: 22px;font-weight: bold;">FORMULA PRODUK</h2> </center>
									<center> <h2 style="font-size: 20px;font-weight: bold;">( FOR )</h2> </center>
									<table class="col-md-5 col-sm- col-xs-12">
										<tr>
											<th width="10%">Product Name </th>
											@if($formula->workbook_id!=NULL)
											<th width="45%">: {{ $formula->Workbook->datapkpp->project_name }}</th>
											@elseif($formula->workbook_pdf_id!=NULL)
											<th width="45%">: {{ $formula->Workbook_pdf->datapdf->project_name }}</th>
											@endif
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
												<th class="text-center" style="width:20%">Material</th>
												<th class="text-center" style="width:25%">Principle</th>
												<th class="text-center" style="width:8%">Serving (gr)</th>
												<th class="text-center" style="width:8%">Batch (gr)</th>
												<th class="text-center" style="width:5%">%</th>
											</tr>
										</thead>
										<tbody>
											@foreach ($fortails as $fortail)
											@if ($fortail['granulasi'] == 'tidak' && $fortail['premix'] == 'tidak')
											<tr>
												<td>{{ ++$no }}</td>
												<td>
													<table class="table-bordered table">
														<tbody>
															<tr><td><b>{{ $fortail->nama_sederhana }}</td></tr>
															@if($fortail->alternatif1!=NULL)<tr><td>{{ $fortail->alternatif1}}</td></tr>@endif
															@if($fortail->alternatif2!=NULL)<tr><td>{{ $fortail->alternatif2}}</td></tr>@endif
															@if($fortail->alternatif3!=NULL)<tr><td>{{ $fortail->alternatif3}}</td></tr>@endif
															@if($fortail->alternatif4!=NULL)<tr><td>{{ $fortail->alternatif4}}</td></tr>@endif
															@if($fortail->alternatif5!=NULL)<tr><td>{{ $fortail->alternatif5}}</td></tr>@endif
															@if($fortail->alternatif6!=NULL)<tr><td>{{ $fortail->alternatif6}}</td></tr>@endif
															@if($fortail->alternatif7!=NULL)<tr><td>{{ $fortail->alternatif7}}</td></tr>@endif
														</tbody>
													</table>
												</td>
												<td>
													<table class="table-bordered table">
														<tbody>
															<tr><td><b>{{ $fortail['nama_bahan'] }}</td></tr>
															@if($fortail->nama_bahan1!= Null)<tr><td>{{ $fortail->nama_bahan1 }}</td></tr>@endif
															@if($fortail->nama_bahan2!= Null)<tr><td>{{ $fortail->nama_bahan2 }}</td></tr>@endif
															@if($fortail->nama_bahan3!= Null)<tr><td>{{ $fortail->nama_bahan3 }}</td></tr>@endif
															@if($fortail->nama_bahan4!= Null)<tr><td>{{ $fortail->nama_bahan4 }}</td></tr>@endif
															@if($fortail->nama_bahan5!= Null)<tr><td>{{ $fortail->nama_bahan5 }}</td></tr>@endif
															@if($fortail->nama_bahan6!= Null)<tr><td>{{ $fortail->nama_bahan6 }}</td></tr>@endif
															@if($fortail->nama_bahan7!= Null)<tr><td>{{ $fortail->nama_bahan7 }}</td></tr>@endif
														</tbody>
													</table>
												</td>
												<td>
													<table class="table-bordered table">
														<tbody>
															<tr><td><b>{{ $fortail['principle'] }}</td></tr>
															@if($fortail->principle1!= Null)<tr><td>{{ $fortail->principle1 }}</td></tr>@endif
															@if($fortail->principle2!= Null)<tr><td>{{ $fortail->principle2 }}</td></tr>@endif
															@if($fortail->principle3!= Null)<tr><td>{{ $fortail->principle3 }}</td></tr>@endif
															@if($fortail->principle4!= Null)<tr><td>{{ $fortail->principle4 }}</td></tr>@endif
															@if($fortail->principle5!= Null)<tr><td>{{ $fortail->principle5 }}</td></tr>@endif
															@if($fortail->principle6!= Null)<tr><td>{{ $fortail->principle6 }}</td></tr>@endif
															@if($fortail->principle7!= Null)<tr><td>{{ $fortail->principle7 }}</td></tr>@endif
														</tbody>
													</table>
												</td>
												<td>{{ $fortail->per_serving }}</td>
												<td>{{ $fortail->per_batch }}</td>
												<td>{{ ($fortail->per_serving / $formula->serving)*100 }} &nbsp;%</td>
											</tr>                                                        
											@endif
											@endforeach

											@if($granulasi > 0 )
											<tr style="background-color:#eaeaea;color:red">
												<td colspan="7">Granulasi &nbsp; 	% &nbsp; </td>                                            
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
											@endif
											
											@if($premix > 0 )
											<tr style="background-color:#eaeaea;color:red">
												<td colspan="7">Premix &nbsp; 	% &nbsp; 	</td>                                            
											</tr>
										
											@foreach ($detail_formula->sortByDesc('per_batch') as $fortail)
											@if ($fortail['premix'] == 'ya')
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
											@endif
											
											<tr style="font-size: 12px;font-weight: bold; color:black;background-color: rgb(78, 205, 196, 0.5);">
												<td colspan="4">Total</td>
												<td>{{ $formula->serving }}</td>
												<td>{{ $formula->batch }}</td>
												<td> 100 % </td>
											</tr>
										</tbody>
									</table>
										
									<div class="row">
									@if(auth()->user()->role->namaRule =='manager')
										@if($formula->workbook_id!=NULL)
										<form class="form-horizontal form-label-left" method="POST" action="{{ route('updatenote',[$formula->id,$formula->workbook_id]) }}">
										@elseif($formula->workbook_pdf_id!=NULL)
										<form class="form-horizontal form-label-left" method="POST" action="{{ route('updatenote',[$formula->id,$formula->workbook_pdf_id]) }}">
										@endif
										<div class="form-group">
											<label class="control-label col-md-1 col-sm-1 col-xs-12">Note Formula</label>
											<div class="col-md-4 col-sm-4 col-xs-12">
												<textarea name="formula" id="formula" maxlength="200" readonly placeholder="max 200 character" value="{{ $formula->catatan_rd }}" class="col-md-12 col-sm-12 col-xs-12" rows="4">{{ $formula->catatan_rd }}</textarea>
												<textarea name="keterangan" id="keterangan" maxlength="200" hidden placeholder="max 200 character" value="{{ $formula->note_formula }}" class="col-md-12 col-sm-12 col-xs-12" rows="4">{{ $formula->note_formula }}</textarea>
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
												<tr><td colspan="3"><b> This Formula Contains Allergens </b></td></tr>
												<tr><td><b> Contain </b></td><td>: 	@foreach($allergen_bb as $allergen) {{$allergen->allergen_countain}},@endforeach</td><td></td></tr>
												<tr><td><b> May Contain </b></td><td>:</td><td></td></tr>
											</table>
										</div>
									</div>
								</div>
							</div>
							@endif
						</div>
						<!-- Nutfact -->
						<div class="tab-pane" id="2">
							<div class="row">
								<div class="panel">
									<div class="panel-body">    
										<div class="accordion" id="accordionExample">
											<div class="panel panel-info">
												<div aria-labelledby="headingOne" data-parent="#accordionExample"><br>
													<button class="btn btn-success btn-sm" type="button" data-toggle="modal" data-target="#parampkp"><i class="fa fa-hand-o-right"></i> Custom Header</a></button>
													<!-- modal -->
													<div class="modal" id="parampkp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
														<div class="modal-dialog" role="document">
															<div class="modal-content">
																<div class="modal-header">
																	<h3 class="modal-title text-left" id="exampleModalLabel">Select Header
																	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																		<span aria-hidden="true">&times;</span></h3>
																	</button>
																</div>
																<form class="form-horizontal form-label-left" method="POST" action="{{route('header',$formula->id)}}">
																<div class="modal-body">
																	<div class="form-group row">
																		<table class="table">
																			<td><label><input type="checkbox" checked id="checkbahan"/> Check all</label></td>
																			<td><label><input type="checkbox" class="data1" checked id="checkmakro"/> Makro</label></td>
																			<td><label><input type="checkbox" class="data1" checked id="checkmineral"/> Mineral</label></td>
																			<td><label><input type="checkbox" class="data1" checked id="checkvitamin"/> Vitamin</label></td>
																			<td><label><input type="checkbox" class="data1" checked id="checkasam"/> Asam Amino</label></td>
																		</table>
																		<table class="table table-bordered">
																			@foreach($form as $data)
																			<thead>
																				<tr><td><input type="checkbox" class="" hidden checked name="form1" value="yes"> Nama Bahan </td>
																						<td><input type="checkbox" class="" hidden checked name="form2" value="yes"> Dosis </td>
																						<td><input type="checkbox" class="" hidden checked name="form3" value="yes"> % </td>
																						<td>Harga</td></tr>
																				<!-- Makro -->
																				<tr>@if($data->form4=='yes')<th><input type="checkbox" class="data1 makro" checked name="form4" value="yes"> @elseif($data->form4!='yes')<th><input type="checkbox" class="data1 makro" name="form4" value="yes">@endif Karbohidrat </th>
																						@if($data->form5=='yes')<th><input type="checkbox" class="data1 makro" checked name="form5" value="yes"> @elseif($data->form5!='yes')<th><input type="checkbox" class="data1 makro" name="form5" value="yes">@endif Glukosa </th>
																						@if($data->form6=='yes')<th><input type="checkbox" class="data1 makro" checked name="form6" value="yes"> @elseif($data->form6!='yes')<th><input type="checkbox" class="data1 makro" name="form6" value="yes">@endif	Serat</th>
																						@if($data->form7=='yes')<th><input type="checkbox" class="data1 makro" checked name="form7" value="yes"> @elseif($data->form7!='yes')<th><input type="checkbox" class="data1 makro" name="form7" value="yes">@endif	Beta</th></tr>
																				<tr>@if($data->form8=='yes')<th><input type="checkbox" class="data1 makro" checked name="form8" value="yes"> @elseif($data->form8!='yes')<th><input type="checkbox" class="data1 makro" name="form8" value="yes">@endif	Sorbitol</th>     
																						@if($data->form9=='yes')<th><input type="checkbox" class="data1 makro" checked name="form9" value="yes"> @elseif($data->form9!='yes')<th><input type="checkbox" class="data1 makro" name="form9" value="yes">@endif	Maltitol</th>
																						@if($data->form10=='yes')<th><input type="checkbox" class="data1 makro" checked name="form10" value="yes"> @elseif($data->form10!='yes')<th><input type="checkbox" class="data1 makro" name="form10" value="yes">@endif	Laktosa</th>
																						@if($data->form11=='yes')<th><input type="checkbox" class="data1 makro" checked name="form11" value="yes"> @elseif($data->form11!='yes')<th><input type="checkbox" class="data1 makro" name="form11" value="yes">@endif	Sukrosa</th></tr>
																				<tr>@if($data->form12=='yes')<th><input type="checkbox" class="data1 makro" checked name="form12" value="yes"> @elseif($data->form12!='yes')<th><input type="checkbox" class="data1 makro" name="form12" value="yes">@endif	Gula</th>
																						@if($data->form13=='yes')<th><input type="checkbox" class="data1 makro" checked name="form13" value="yes"> @elseif($data->form13!='yes')<th><input type="checkbox" class="data1 makro" name="form13" value="yes">@endif	Erythritol</th>
																						@if($data->form14=='yes')<th><input type="checkbox" class="data1 makro" checked name="form14" value="yes"> @elseif($data->form14!='yes')<th><input type="checkbox" class="data1 makro" name="form14" value="yes">@endif	DHA</th>          
																						@if($data->form15=='yes')<th><input type="checkbox" class="data1 makro" checked name="form15" value="yes"> @elseif($data->form15!='yes')<th><input type="checkbox" class="data1 makro" name="form15" value="yes">@endif	EPA</th></tr>
																				<tr>@if($data->form16=='yes')<th><input type="checkbox" class="data1 makro" checked name="form16" value="yes"> @elseif($data->form16!='yes')<th><input type="checkbox" class="data1 makro" name="form16" value="yes">@endif	Omega3</th>
																						@if($data->form17=='yes')<th><input type="checkbox" class="data1 makro" checked name="form17" value="yes"> @elseif($data->form17!='yes')<th><input type="checkbox" class="data1 makro" name="form17" value="yes">@endif	Lemak Trans</th>       
																						@if($data->form18=='yes')<th><input type="checkbox" class="data1 makro" checked name="form18" value="yes"> @elseif($data->form18!='yes')<th><input type="checkbox" class="data1 makro" name="form18" value="yes">@endif	MUFA</th>
																						@if($data->form19=='yes')<th><input type="checkbox" class="data1 makro" checked name="form19" value="yes"> @elseif($data->form19!='yes')<th><input type="checkbox" class="data1 makro" name="form19" value="yes">@endif	Lemak Jenuh</th></tr>
																				<tr>@if($data->form21=='yes')<th><input type="checkbox" class="data1 makro" checked name="form21" value="yes"> @elseif($data->form21!='yes')<th><input type="checkbox" class="data1 makro" name="form21" value="yes">@endif	Omega6</th>
																						@if($data->form22=='yes')<th><input type="checkbox" class="data1 makro" checked name="form22" value="yes"> @elseif($data->form22!='yes')<th><input type="checkbox" class="data1 makro" name="form22" value="yes">@endif	Kolestrol</th>    
																						@if($data->form23=='yes')<th><input type="checkbox" class="data1 makro" checked name="form23" value="yes"> @elseif($data->form23!='yes')<th><input type="checkbox" class="data1 makro" name="form23" value="yes">@endif	Protein</th>
																						@if($data->form70=='yes')<th><input type="checkbox" class="data1 makro" checked name="form70" value="yes"> @elseif($data->form70!='yes')<th><input type="checkbox" class="data1 makro" name="form70" value="yes">@endif	FAT</th></tr>
																				<!-- Mineral -->
																				<tr>@if($data->form25=='yes')<th><input type="checkbox" class="data1 mineral" checked name="form25" value="yes"> @elseif($data->form25!='yes')<th><input type="checkbox" class="data1 mineral" name="form25" value="yes">@endif	Ca </th>   
																						@if($data->form26=='yes')<th><input type="checkbox" class="data1 mineral" checked name="form26" value="yes"> @elseif($data->form26!='yes')<th><input type="checkbox" class="data1 mineral" name="form26" value="yes">@endif	Fe</th>   
																						@if($data->form27=='yes')<th><input type="checkbox" class="data1 mineral" checked name="form27" value="yes"> @elseif($data->form27!='yes')<th><input type="checkbox" class="data1 mineral" name="form27" value="yes">@endif	Mg </th>
																						@if($data->form28=='yes')<th><input type="checkbox" class="data1 mineral" checked name="form28" value="yes"> @elseif($data->form28!='yes')<th><input type="checkbox" class="data1 mineral" name="form28" value="yes">@endif	K </th></tr>   
																				<tr>@if($data->form29=='yes')<th><input type="checkbox" class="data1 mineral" checked name="form29" value="yes"> @elseif($data->form29!='yes')<th><input type="checkbox" class="data1 mineral" name="form29" value="yes">@endif	Cr</th>     
																						@if($data->form30=='yes')<th><input type="checkbox" class="data1 mineral" checked name="form30" value="yes"> @elseif($data->form30!='yes')<th><input type="checkbox" class="data1 mineral" name="form30" value="yes">@endif	Zink</th>
																						@if($data->form32=='yes')<th><input type="checkbox" class="data1 mineral" checked name="form32" value="yes"> @elseif($data->form32!='yes')<th><input type="checkbox" class="data1 mineral" name="form32" value="yes">@endif	Fosfor</th>  
																						@if($data->form33=='yes')<th><input type="checkbox" class="data1 mineral" checked name="form33" value="yes"> @elseif($data->form33!='yes')<th><input type="checkbox" class="data1 mineral" name="form33" value="yes">@endif	Na </th></tr> 
																				<tr>@if($data->form34=='yes')<th><input type="checkbox" class="data1 mineral" checked name="form34" value="yes"> @elseif($data->form34!='yes')<th><input type="checkbox" class="data1 mineral" name="form34" value="yes">@endif	NaCi</th>    
																						@if($data->form35=='yes')<th><input type="checkbox" class="data1 mineral" checked name="form35" value="yes"> @elseif($data->form35!='yes')<th><input type="checkbox" class="data1 mineral" name="form35" value="yes">@endif	Mn</th>  
																						@if($data->form36=='yes')<th><input type="checkbox" class="data1 mineral" checked name="form36" value="yes"> @elseif($data->form36!='yes')<th><input type="checkbox" class="data1 mineral" name="form36" value="yes">@endif	Energi</th>
																				<!-- Vitamin -->	
																						@if($data->form37=='yes')<th><input type="checkbox" class="data1 vitamin" checked name="form37" value="yes"> @elseif($data->form37!='yes')<th><input type="checkbox" class="data1 vitamin" name="form37" value="yes">@endif	VitA </th> </tr> 
																				<tr>@if($data->form38=='yes')<th><input type="checkbox" class="data1 vitamin" checked name="form38" value="yes"> @elseif($data->form38!='yes')<th><input type="checkbox" class="data1 vitamin" name="form38" value="yes">@endif	Biotin</th>    
																						@if($data->form39=='yes')<th><input type="checkbox" class="data1 vitamin" checked name="form39" value="yes"> @elseif($data->form39!='yes')<th><input type="checkbox" class="data1 vitamin" name="form39" value="yes">@endif	VitB1 </th>
																						@if($data->form40=='yes')<th><input type="checkbox" class="data1 vitamin" checked name="form40" value="yes"> @elseif($data->form40!='yes')<th><input type="checkbox" class="data1 vitamin" name="form40" value="yes">@endif	VitB2 </th> 
																						@if($data->form41=='yes')<th><input type="checkbox" class="data1 vitamin" checked name="form41" value="yes"> @elseif($data->form41!='yes')<th><input type="checkbox" class="data1 vitamin" name="form41" value="yes">@endif	Kolin </th></tr> 
																				<tr>@if($data->form42=='yes')<th><input type="checkbox" class="data1 vitamin" checked name="form42" value="yes"> @elseif($data->form42!='yes')<th><input type="checkbox" class="data1 vitamin" name="form42" value="yes">@endif	VitB3 </th>
																						@if($data->form43=='yes')<th><input type="checkbox" class="data1 vitamin" checked name="form43" value="yes"> @elseif($data->form43!='yes')<th><input type="checkbox" class="data1 vitamin" name="form43" value="yes">@endif	VitB5 </th>
																						@if($data->form44=='yes')<th><input type="checkbox" class="data1 vitamin" checked name="form44" value="yes"> @elseif($data->form44!='yes')<th><input type="checkbox" class="data1 vitamin" name="form44" value="yes">@endif	VitK </th>
																						@if($data->form45=='yes')<th><input type="checkbox" class="data1 vitamin" checked name="form45" value="yes"> @elseif($data->form45!='yes')<th><input type="checkbox" class="data1 vitamin" name="form45" value="yes">@endif	VitB6 </th> </tr>
																				<tr>@if($data->form46=='yes')<th><input type="checkbox" class="data1 vitamin" checked name="form46" value="yes"> @elseif($data->form46!='yes')<th><input type="checkbox" class="data1 vitamin" name="form46" value="yes">@endif	VitB12 </th> 
																						@if($data->form47=='yes')<th><input type="checkbox" class="data1 vitamin" checked name="form47" value="yes"> @elseif($data->form47!='yes')<th><input type="checkbox" class="data1 vitamin" name="form47" value="yes">@endif	VitE </th>
																						@if($data->form48=='yes')<th><input type="checkbox" class="data1 vitamin" checked name="form48" value="yes"> @elseif($data->form48!='yes')<th><input type="checkbox" class="data1 vitamin" name="form48" value="yes">@endif	VitC </th>
																						@if($data->form49=='yes')<th><input type="checkbox" class="data1 vitamin" checked name="form49" value="yes"> @elseif($data->form59!='yes')<th><input type="checkbox" class="data1 vitamin" name="form49" value="yes">@endif	VitD </th></tr>
																				<tr>@if($data->form50=='yes')<th><input type="checkbox" class="data1 vitamin" checked name="form50" value="yes"> @elseif($data->form50!='yes')<th><input type="checkbox" class="data1 vitamin" name="form50" value="yes">@endif	Folat</th>
																				<!-- asam amino -->
																						@if($data->form51=='yes')<th><input type="checkbox" class="data1 asam" checked name="form51" value="yes"> @elseif($data->form51!='yes')<th><input type="checkbox" class="data1 asam" name="form51" value="yes">@endif	Lisin</th>
																						@if($data->form52=='yes')<th><input type="checkbox" class="data1 asam" checked name="form52" value="yes"> @elseif($data->form52!='yes')<th><input type="checkbox" class="data1 asam" name="form52" value="yes">@endif	L-Glutamine</th>
																						@if($data->form53=='yes')<th><input type="checkbox" class="data1 asam" checked name="form53" value="yes"> @elseif($data->form53!='yes')<th><input type="checkbox" class="data1 asam" name="form53" value="yes">@endif	Proline</th> </tr> 
																				<tr>@if($data->form54=='yes')<th><input type="checkbox" class="data1 asam" checked name="form54" value="yes"> @elseif($data->form54!='yes')<th><input type="checkbox" class="data1 asam" name="form54" value="yes">@endif	Methionin</th>
																						@if($data->form55=='yes')<th><input type="checkbox" class="data1 asam" checked name="form55" value="yes"> @elseif($data->form55!='yes')<th><input type="checkbox" class="data1 asam" name="form55" value="yes">@endif	Histidin</th>  
																						@if($data->form56=='yes')<th><input type="checkbox" class="data1 asam" checked name="form56" value="yes"> @elseif($data->form56!='yes')<th><input type="checkbox" class="data1 asam" name="form56" value="yes">@endif	Tyrosin</th> 
																						@if($data->form57=='yes')<th><input type="checkbox" class="data1 asam" checked name="form57" value="yes"> @elseif($data->form57!='yes')<th><input type="checkbox" class="data1 asam" name="form57" value="yes">@endif	BCAA</th></tr> 
																				<tr>@if($data->form58=='yes')<th><input type="checkbox" class="data1 asam" checked name="form58" value="yes"> @elseif($data->form58!='yes')<th><input type="checkbox" class="data1 asam" name="form58" value="yes">@endif	Leusin</th>   
																						@if($data->form59=='yes')<th><input type="checkbox" class="data1 asam" checked name="form59" value="yes"> @elseif($data->form59!='yes')<th><input type="checkbox" class="data1 asam" name="form59" value="yes">@endif	Glisin</th>  
																						@if($data->form60=='yes')<th><input type="checkbox" class="data1 asam" checked name="form60" value="yes"> @elseif($data->form60!='yes')<th><input type="checkbox" class="data1 asam" name="form60" value="yes">@endif	Aspartat</th>
																						@if($data->form61=='yes')<th><input type="checkbox" class="data1 asam" checked name="form61" value="yes"> @elseif($data->form61!='yes')<th><input type="checkbox" class="data1 asam" name="form61" value="yes">@endif	Serin</th>   </tr> 
																				<tr>@if($data->form62=='yes')<th><input type="checkbox" class="data1 asam" checked name="form62" value="yes"> @elseif($data->form62!='yes')<th><input type="checkbox" class="data1 asam" name="form62" value="yes">@endif	Alanin</th>    
																						@if($data->form63=='yes')<th><input type="checkbox" class="data1 asam" checked name="form63" value="yes"> @elseif($data->form63!='yes')<th><input type="checkbox" class="data1 asam" name="form63" value="yes">@endif	Glutamat</th>
																						@if($data->form64=='yes')<th><input type="checkbox" class="data1 asam" checked name="form64" value="yes"> @elseif($data->form64!='yes')<th><input type="checkbox" class="data1 asam" name="form64" value="yes">@endif	Arginine</th>   
																						@if($data->form65=='yes')<th><input type="checkbox" class="data1 asam" checked name="form65" value="yes"> @elseif($data->form65!='yes')<th><input type="checkbox" class="data1 asam" name="form65" value="yes">@endif	Sistein</th> </tr>  
																				<tr>@if($data->form66=='yes')<th><input type="checkbox" class="data1 asam" checked name="form66" value="yes"> @elseif($data->form66!='yes')<th><input type="checkbox" class="data1 asam" name="form66" value="yes">@endif	Isoleusin</th>
																						@if($data->form67=='yes')<th><input type="checkbox" class="data1 asam" checked name="form67" value="yes"> @elseif($data->form67!='yes')<th><input type="checkbox" class="data1 asam" name="form67" value="yes">@endif	Threonin</th> 
																						@if($data->form68=='yes')<th><input type="checkbox" class="data1 asam" checked name="form68" value="yes"> @elseif($data->form68!='yes')<th><input type="checkbox" class="data1 asam" name="form68" value="yes">@endif	Phenilalanin</th>
																						@if($data->form69=='yes')<th><input type="checkbox" class="data1 asam" checked name="form69" value="yes"> @elseif($data->form69!='yes')<th><input type="checkbox" class="data1 asam" name="form69" value="yes">@endif	Valin</th></tr>
																			</thead>
																			@endforeach
																		</table>
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
													<div style="overflow-x: scroll;">
														@foreach($form as $header)
														<table class="table table-advanced table-bordered" >
															<thead>
																<tr class="text-center" style="font-weight: bold;color:white;background-color: #2a3f54;">
																	<th class="text-center sticky-col first-col"  class="text-center" style="font-weight: bold;color:white;background-color: #2a3f54;">Nama Sederhana</th>
																	<th class="text-center sticky-col second-col" style="font-weight: bold;color:white;background-color: #2a3f54;min-width:120px">Dosis (Gram)</th>
																	<th class="text-center sticky-col third-col" style="font-weight: bold;color:white;background-color: #2a3f54;">%</th>
																	<th class="text-center" style="font-weight: bold;color:white;background-color: #2a3f54;min-width:100px">Harga</th>
																	<!-- Makro -->
																	@if($header->form4=='yes')<th class="text-center">Karbohidrata</th>@endif  @if($header->form5=='yes')<th class="text-center">Glukosa</th>@endif
																	@if($header->form6=='yes')<th class="text-center">Serat</th>@endif        @if($header->form7=='yes')<th class="text-center">Beta</th>@endif
																	@if($header->form8=='yes')<th class="text-center">Sorbitol</th>@endif     @if($header->form9=='yes')<th class="text-center">Maltitol</th>@endif
																	@if($header->form10=='yes')<th class="text-center">Laktosa</th>@endif     @if($header->form11=='yes')<th class="text-center">Sukrosa</th>@endif
																	@if($header->form12=='yes')<th class="text-center">Gula</th>@endif        @if($header->form13=='yes')<th class="text-center">Erythritol</th>@endif
																	@if($header->form14=='yes')<th class="text-center">DHA</th>@endif         @if($header->form15=='yes')<th class="text-center">EPA</th>@endif
																	@if($header->form16=='yes')<th class="text-center">Omega3</th>@endif      @if($header->form18=='yes')<th class="text-center">MUFA</th>@endif
																	@if($header->form17=='yes')<th class="text-center">Lemak Trans</th>@endif @if($header->form19=='yes')<th class="text-center">Lemak Jenuh</th>@endif
																	@if($header->form21=='yes')<th class="text-center">Omega6</th>@endif
																	@if($header->form57=='yes')<th class="text-center">Omega9</th>@endif 			@if($header->form22=='yes')<th class="text-center">Kolestrol</th>@endif   
																	@if($header->form23=='yes')<th class="text-center">Protein</th>@endif 		@if($header->form70=='yes')<th class="text-center">FAT</th>@endif
																	<!-- Mineral -->
																	@if($header->form25=='yes')<th class="text-center">Ca </th>@endif     		@if($header->form27=='yes')<th class="text-center">Mg </th>@endif
																	@if($header->form28=='yes')<th class="text-center">K </th>@endif    		  @if($header->form30=='yes')<th class="text-center">Zink</th>@endif
																	@if($header->form32=='yes')<th class="text-center">Na </th>@endif
																	@if($header->form34=='yes')<th class="text-center">NaCi</th>@endif        @if($header->form36=='yes')<th class="text-center">Energi</th>@endif
																	@if($header->form32=='yes')<th class="text-center">Fosfor</th>@endif      @if($header->form35=='yes')<th class="text-center">Mn</th>@endif
																	@if($header->form29=='yes')<th class="text-center">Cr</th>@endif     			@if($header->form26=='yes')<th class="text-center">Fe</th>@endif
																	<!-- Vitamin -->
																	@if($header->form37=='yes')<th class="text-center">VitA </th>@endif   		@if($header->form39=='yes')<th class="text-center">VitB1 </th>@endif
																	@if($header->form40=='yes')<th class="text-center">VitB2 </th>@endif  		@if($header->form42=='yes')<th class="text-center">VitB3 </th>@endif
																	@if($header->form43=='yes')<th class="text-center">VitB5 </th>@endif 	 		@if($header->form45=='yes')<th class="text-center">VitB6 </th>@endif
																	@if($header->form46=='yes')<th class="text-center">VitB12 </th>@endif 		@if($header->form48=='yes')<th class="text-center">VitC </th>@endif
																	@if($header->form49=='yes')<th class="text-center">VitD </th>@endif   		@if($header->form47=='yes')<th class="text-center">VitE </th>@endif
																	@if($header->form44=='yes')<th class="text-center">VitK </th>@endif   		@if($header->form50=='yes')<th class="text-center">Folat</th>@endif
																	@if($header->form38=='yes')<th class="text-center">Biotin</th>@endif      @if($header->form41=='yes')<th class="text-center">Kolin </th>@endif
																	<!-- asam amino -->
																	@if($header->form52=='yes')<th class="text-center">L-Glutamine</th>@endif  @if($header->form54=='yes')<th class="text-center">Methionin</th>@endif
																	@if($header->form55=='yes')<th class="text-center">Histidin</th>@endif     @if($header->form57=='yes')<th class="text-center">BCAA</th>@endif
																	@if($header->form58=='yes')<th class="text-center">Leusin</th>@endif       @if($header->form60=='yes')<th class="text-center">Aspartat</th>@endif
																	@if($header->form61=='yes')<th class="text-center">Serin</th>@endif        @if($header->form63=='yes')<th class="text-center">Glutamat</th>@endif
																	@if($header->form64=='yes')<th class="text-center">Arginine</th>@endif     @if($header->form66=='yes')<th class="text-center">Isoleusin</th>@endif
																	@if($header->form67=='yes')<th class="text-center">Threonin</th>@endif     @if($header->form68=='yes')<th class="text-center">Phenilalanin</th>@endif
																	@if($header->form51=='yes')<th class="text-center">Lisin</th>@endif        @if($header->form69=='yes')<th class="text-center">Valin</th>@endif
																	@if($header->form65=='yes')<th class="text-center">Sistein</th>@endif      @if($header->form62=='yes')<th class="text-center">Alanin</th>@endif
																	@if($header->form59=='yes')<th class="text-center">Glisin</th>@endif       @if($header->form56=='yes')<th class="text-center">Tyrosin</th>@endif
																	@if($header->form53=='yes')<th class="text-center">Proline</th>@endif
																	<th  class="text-center" style="font-weight: bold;color:white;background-color: #2a3f54;" width="20%">Data_BTP_CarryOver_Bahan_Baku</th>
																</tr>
															</thead>
															<tbody>
																@php $nom = 0; @endphp
																@foreach ($detail_harga->sortByDesc('per_batch') as $fortail)
																<tr >
																	<td class="sticky-col first-col">{{ $fortail['nama_sederhana'] }}</td>
																	<td class="sticky-col second-col"><input type="number" placeholder="0" onkeyup="jServing(this.id)" class="form-control" readonly id="Serving{{ $fortail['no'] }}"  value="{{ $fortail['per_serving'] }}"   name="Serving[{{ $fortail['no'] }}]"></td>
																	<td class="sticky-col third-col">{{ $fortail['persen'] }}</td>
																	<td><?php echo"Rp. ". number_format($fortail['harga_per_serving'], 2, ",", ".")  ?></td>
																	@if($header->form4=='yes')<td>{{ $fortail['karbohidrat'] }}</td>@endif
																	@if($header->form5=='yes')<td>{{ $fortail['glukosa'] }}</td>@endif
																	@if($header->form6=='yes')<td>{{ $fortail['serat'] }}</td>@endif
																	@if($header->form7=='yes')<td>{{ $fortail['beta'] }}</td>@endif
																	@if($header->form8=='yes')<td>{{ $fortail['sorbitol'] }}</td>@endif
																	@if($header->form9=='yes')<td>{{ $fortail['maltitol'] }}</td>@endif
																	@if($header->form10=='yes')<td>{{ $fortail['laktosa'] }}</td>@endif
																	@if($header->form11=='yes')<td>{{ $fortail['sukrosa'] }}</td>@endif
																	@if($header->form12=='yes')<td>{{ $fortail['gula'] }}</td>@endif
																	@if($header->form13=='yes')<td>{{ $fortail['erythritol'] }}</td>@endif
																	@if($header->form14=='yes')<td>{{ $fortail['dha'] }}</td>@endif
																	@if($header->form15=='yes')<td>{{ $fortail['epa'] }}</td>@endif
																	@if($header->form16=='yes')<td>{{ $fortail['omega3'] }}</td>@endif
																	@if($header->form18=='yes')<td>{{ $fortail['mufa'] }}</td>@endif
																	@if($header->form17=='yes')<td>{{ $fortail['lemak_trans'] }}</td>@endif
																	@if($header->form19=='yes')<td>{{ $fortail['lemak_jenuh'] }}</td>@endif
																	@if($header->form21=='yes')<td>{{ $fortail['omega6'] }}</td>@endif
																	@if($header->form57=='yes')<td>{{ $fortail['omega9'] }}</td>@endif
																	@if($header->form22=='yes')<td>{{ $fortail['kolestrol'] }}</td>@endif
																	@if($header->form23=='yes')<td>{{ $fortail['protein'] }}</td>@endif
																	@if($header->form70=='yes')<td>{{ $fortail['fat'] }}</td>@endif

																	@if($header->form25=='yes')<td>{{ $fortail['ca'] }}</td>@endif
																	@if($header->form27=='yes')<td>{{ $fortail['mg'] }}</td>@endif
																	@if($header->form28=='yes')<td>{{ $fortail['k'] }}</td>@endif
																	@if($header->form30=='yes')<td>{{ $fortail['zink'] }}</td>@endif
																	@if($header->form33=='yes')<td>{{ $fortail['na'] }}</td>@endif
																	@if($header->form34=='yes')<td>{{ $fortail['naci'] }}</td>@endif
																	@if($header->form36=='yes')<td>{{ $fortail['energi'] }}</td>@endif
																	@if($header->form32=='yes')<td>{{ $fortail['fosfor'] }}</td>@endif
																	@if($header->form35=='yes')<td>{{ $fortail['mn'] }}</td>@endif
																	@if($header->form29=='yes')<td>{{ $fortail['cr'] }}</td>@endif
																	@if($header->form26=='yes')<td>{{ $fortail['fe'] }}</td>@endif

																	@if($header->form37=='yes')<td>{{ $fortail['vitA'] }}</td>@endif
																	@if($header->form39=='yes')<td>{{ $fortail['vitB1'] }}</td>@endif
																	@if($header->form40=='yes')<td>{{ $fortail['vitB2'] }}</td>@endif
																	@if($header->form42=='yes')<td>{{ $fortail['vitB3'] }}</td>@endif
																	@if($header->form43=='yes')<td>{{ $fortail['vitB5'] }}</td>@endif
																	@if($header->form45=='yes')<td>{{ $fortail['vitB6'] }}</td>@endif
																	@if($header->form46=='yes')<td>{{ $fortail['vitB12'] }}</td>@endif
																	@if($header->form48=='yes')<td>{{ $fortail['vitC'] }}</td>@endif
																	@if($header->form49=='yes')<td>{{ $fortail['vitD'] }}</td>@endif
																	@if($header->form47=='yes')<td>{{ $fortail['vitE'] }}</td>@endif
																	@if($header->form44=='yes')<td>{{ $fortail['vitK'] }}</td>@endif
																	@if($header->form50=='yes')<td>{{ $fortail['folat'] }}</td>@endif
																	@if($header->form38=='yes')<td>{{ $fortail['biotin'] }}</td>@endif
																	@if($header->form41=='yes')<td>{{ $fortail['kolin'] }}</td>@endif

																	@if($header->form52=='yes')<td>{{ $fortail['l_glutamine'] }}</td>@endif
																	@if($header->form68=='yes')<td>{{ $fortail['threonin'] }}</td>@endif
																	@if($header->form54=='yes')<td>{{ $fortail['methionin'] }}</td>@endif
																	@if($header->form68=='yes')<td>{{ $fortail['phenilalanin'] }}</td>@endif
																	@if($header->form55=='yes')<td>{{ $fortail['histidin'] }}</td>@endif
																	@if($header->form51=='yes')<td>{{ $fortail['lisin'] }}</td>@endif
																	@if($header->form57=='yes')<td>{{ $fortail['BCAA'] }}</td>@endif
																	@if($header->form69=='yes')<td>{{ $fortail['valin'] }}</td>@endif
																	@if($header->form58=='yes')<td>{{ $fortail['leusin'] }}</td>@endif
																	@if($header->form60=='yes')<td>{{ $fortail['sistein'] }}</td>@endif
																	@if($header->form62=='yes')<td>{{ $fortail['aspartat'] }}</td>@endif
																	@if($header->form65=='yes')<td>{{ $fortail['alanin'] }}</td>@endif
																	@if($header->form61=='yes')<td>{{ $fortail['serin'] }}</td>@endif
																	@if($header->form59=='yes')<td>{{ $fortail['glisin'] }}</td>@endif
																	@if($header->form63=='yes')<td>{{ $fortail['glutamat'] }}</td>@endif
																	@if($header->form56=='yes')<td>{{ $fortail['tyrosin'] }}</td>@endif
																	@if($header->form53=='yes')<td>{{ $fortail['arginine'] }}</td>@endif
																	@if($header->form64=='yes')<td>{{ $fortail['proline'] }}</td>@endif
																	@if($header->form66=='yes')<td>{{ $fortail['Isoleusin'] }}</td>@endif
																	<td style="width:120px">@if( $fortail['hitung_btp'] !=NULL)@foreach($carryover as $co)@if($fortail['bahan']==$co->id_bahan) {{ $co->btp }}/<br>@endif @endforeach @endif</td>
																</tr> 
																@endforeach
																<tr style="font-size: 12px;font-weight: bold; color:black;background-color: #ddd;">
																	<td class="text-center sticky-col first-col" style="font-size: 12px;font-weight: bold; color:black;background-color: #ddd;">Total : </td>
																	<td class="text-center sticky-col second-col" style="font-size: 12px;font-weight: bold; color:black;background-color: #ddd;">{{ $formula['serving_size'] }}</td>
																	<td class="text-center sticky-col third-col" style="font-size: 12px;font-weight: bold; color:black;background-color: #ddd;"> 100 </td>
																	<td><?php echo"Rp. ". number_format($total_harga['total_harga_per_serving'], 2, ",", ".")  ?></td>
																	@if($header->form4=='yes')<td>{{ $total_harga['total_karbohidrat'] }}</td>@endif
																	@if($header->form5=='yes')<td>{{ $total_harga['total_glukosa'] }}</td>@endif
																	@if($header->form6=='yes')<td>{{ $total_harga['total_serat'] }}</td>@endif
																	@if($header->form7=='yes')<td>{{ $total_harga['total_beta'] }}</td>@endif
																	@if($header->form8=='yes')<td>{{ $total_harga['total_sorbitol'] }}</td>@endif
																	@if($header->form9=='yes')<td>{{ $total_harga['total_maltitol'] }}</td>@endif
																	@if($header->form10=='yes')<td>{{ $total_harga['total_laktosa'] }}</td>@endif
																	@if($header->form11=='yes')<td>{{ $total_harga['total_sukrosa'] }}</td>@endif
																	@if($header->form12=='yes')<td>{{ $total_harga['total_gula'] }}</td>@endif
																	@if($header->form13=='yes')<td>{{ $total_harga['total_erythritol'] }}</td>@endif
																	@if($header->form14=='yes')<td>{{ $total_harga['total_dha'] }}</td>@endif
																	@if($header->form15=='yes')<td>{{ $total_harga['total_epa'] }}</td>@endif
																	@if($header->form16=='yes')<td>{{ $total_harga['total_omega3'] }}</td>@endif
																	@if($header->form18=='yes')<td>{{ $total_harga['total_mufa'] }}</td>@endif
																	@if($header->form17=='yes')<td>{{ $total_harga['total_lemak_total'] }}</td>@endif
																	@if($header->form19=='yes')<td>{{ $total_harga['total_lemak_jenuh'] }}</td>@endif
																	@if($header->form21=='yes')<td>{{ $total_harga['total_omega6'] }}</td>@endif
																	@if($header->form57=='yes')<td>{{ $total_harga['total_omega9'] }}</td>@endif
																	@if($header->form22=='yes')<td>{{ $total_harga['total_kolestrol'] }}</td>@endif
																	@if($header->form23=='yes')<td>{{ $total_harga['total_protein'] }}</td>@endif
																	@if($header->form70=='yes')<td>{{ $total_harga['total_fat'] }}</td>@endif

																	@if($header->form25=='yes')<td>{{ $total_harga['total_ca'] }}</td>@endif
																	@if($header->form27=='yes')<td>{{ $total_harga['total_mg'] }}</td>@endif
																	@if($header->form28=='yes')<td>{{ $total_harga['total_k'] }}</td>@endif
																	@if($header->form30=='yes')<td>{{ $total_harga['total_zink'] }}</td>@endif
																	@if($header->form33=='yes')<td>{{ $total_harga['total_na'] }}</td>@endif
																	@if($header->form34=='yes')<td>{{ $total_harga['total_naci'] }}</td>@endif
																	@if($header->form36=='yes')<td>{{ $total_harga['total_energi'] }}</td>@endif
																	@if($header->form32=='yes')<td>{{ $total_harga['total_fosfor']}}</td>@endif
																	@if($header->form35=='yes')<td>{{ $total_harga['total_mn']}}</td>@endif
																	@if($header->form29=='yes')<td>{{ $total_harga['total_cr'] }}</td>@endif
																	@if($header->form26=='yes')<td>{{ $total_harga['total_fe'] }}</td>@endif

																	@if($header->form37=='yes')<td>{{ $total_harga['total_vitA'] }}</td>@endif
																	@if($header->form39=='yes')<td>{{ $total_harga['total_vitB1'] }}</td>@endif
																	@if($header->form40=='yes')<td>{{ $total_harga['total_vitB2'] }}</td>@endif	
																	@if($header->form42=='yes')<td>{{ $total_harga['total_vitB3'] }}</td>@endif
																	@if($header->form43=='yes')<td>{{ $total_harga['total_vitB5'] }}</td>@endif
																	@if($header->form45=='yes')<td>{{ $total_harga['total_vitB6'] }}</td>@endif
																	@if($header->form46=='yes')<td>{{ $total_harga['total_vitB12'] }}</td>@endif
																	@if($header->form48=='yes')<td>{{ $total_harga['total_vitC'] }}</td>@endif
																	@if($header->form49=='yes')<td>{{ $total_harga['total_vitD'] }}</td>@endif
																	@if($header->form47=='yes')<td>{{ $total_harga['total_vitE'] }}</td>@endif
																	@if($header->form44=='yes')<td>{{ $total_harga['total_vitK'] }}</td>@endif
																	@if($header->form50=='yes')<td>{{ $total_harga['total_folat'] }}</td>@endif
																	@if($header->form38=='yes')<td>{{ $total_harga['total_biotin'] }}</td>@endif
																	@if($header->form41=='yes')<td>{{ $total_harga['total_kolin'] }}</td>@endif
																	
																	@if($header->form52=='yes')<td>{{ $total_harga['total_l_glutamine'] }}</td>@endif
																	@if($header->form68=='yes')<td>{{ $total_harga['total_threonin'] }}</td>@endif
																	@if($header->form54=='yes')<td>{{ $total_harga['total_methionin'] }}</td>@endif	
																	@if($header->form68=='yes')<td>{{ $total_harga['total_phenilalanin'] }}</td>@endif
																	@if($header->form55=='yes')<td>{{ $total_harga['total_histidin'] }}</td>@endif
																	@if($header->form51=='yes')<td>{{ $total_harga['total_lisin'] }}</td>@endif
																	@if($header->form57=='yes')<td>{{ $total_harga['total_BCAA'] }}</td>@endif
																	@if($header->form69=='yes')<td>{{ $total_harga['total_valin'] }}</td>@endif
																	@if($header->form58=='yes')<td>{{ $total_harga['total_leusin'] }}</td>@endif
																	@if($header->form60=='yes')<td>{{ $total_harga['total_aspartat'] }}</td>@endif
																	@if($header->form62=='yes')<td>{{ $total_harga['total_alanin'] }}</td>@endif
																	@if($header->form65=='yes')<td>{{ $total_harga['total_sistein'] }}</td>@endif
																	@if($header->form61=='yes')<td>{{ $total_harga['total_serin'] }}</td>@endif
																	@if($header->form59=='yes')<td>{{ $total_harga['total_glisin'] }}</td>@endif
																	@if($header->form63=='yes')<td>{{ $total_harga['total_glutamat'] }}</td>@endif
																	@if($header->form56=='yes')<td>{{ $total_harga['total_tyrosin'] }}</td>@endif
																	@if($header->form53=='yes')<td>{{ $total_harga['total_proline'] }}</td>@endif
																	@if($header->form64=='yes')<td>{{ $total_harga['total_arginine'] }}</td>@endif
																	@if($header->form66=='yes')<td>{{ $total_harga['total_Isoleusin'] }}</td>@endif
																	<td ></td>
																</tr>
															</tbody>
														</table>
														@endforeach
														&nbsp
													</div>
												</div>
											</div> 

											<div aria-labelledby="headingTwo" data-parent="#accordionExample">
												<div class="panel-body">
													<div class="col-md-6">
														<div class="form-group row">
															<label class="control-label col-md-2 col-sm-2 col-xs-12">Overage</label>
															<div class="col-md-5 col-sm-5 col-xs-12">
																<input type="number" name="overage" min="0" readonly value="{{$formula->overage}}" class="form-control" required>
															</div>
															<label class="control-label col-md-1 col-sm-1 col-xs-12">%</label>
														</div>
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
																	<th>Overage</th>
																</tr>
															</thead>
															<tbody>
																@foreach($akg as $akg)
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_energi_total!='yes')<input type="checkbox" class="data1" name="energi_total" value="yes" id="energi_total">
																		@else<input type="checkbox" class="data1" value="yes" checked name="energi_total" id="energi_total">@endif
																	</td>
																	<td>Energi Total</td>
																	<td class="text-right">{{ $total_harga['total_energi'] }}</td><td class="text-center">kkal</td>
																	<td class="text-right"></td><td class="text-right">{{$akg->energi}}</td><td class="text-center">kkal</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->overage_energi_total!='yes'){{ $total_harga['total_energi'] }}
																		@else($akg->overage_energi_total!='no'){{ $total_harga['total_energi'] * ($formula->overage/100) }}@endif
																	</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_energi_lemak!='yes')<input type="checkbox" class="data1" name="energi_lemak" value="yes" id="energi_lemak">
																		@else<input type="checkbox" class="data1" value="yes" checked name="energi_lemak" id="energi_lemak">@endif
																	</td>
																	<td>Energi Dari Lemak</td>
																	<td class="text-right">{{ $total_harga['total_lemak_total']*9 }}</td><td class="text-center">kkal</td>
																	<td class="text-right">NA</td><td class="text-right">NA</td><td class="text-center">kkal</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->overage_energi_lemak!='yes'){{ $total_harga['total_lemak_total']*9 }}
																		@else {{ ($total_harga['total_lemak_total']*9) * ($formula->overage/100) }} @endif
																	</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_energi_lemak_jenuh!='yes')<input type="checkbox" class="data1" name="energi_lemak_jenuh" value="yes" id="energi_lemak_jenuh">
																		@else<input type="checkbox" class="data1" value="yes" checked name="energi_lemak_jenuh" id="energi_lemak_jenuh">@endif
																	</td>
																	<td>Energi Dari Lemak Jenuh</td>
																	<td class="text-right">{{ $total_harga['total_lemak_jenuh']*9 }}</td><td class="text-center">kkal</td>
																	<td class="text-right">NA</td><td class="text-right">NA</td><td class="text-center">kkal</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->overage_energi_lemak_jenuh!='yes'){{ $total_harga['total_lemak_jenuh']*9 }}
																		@else {{ ($total_harga['total_lemak_jenuh']*9) * ($formula->overage/100) }} @endif
																	</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_karbohidrat!='yes')<input type="checkbox" class="data1" name="karbohidrat" value="yes" id="karbohidrat">
																		@else<input type="checkbox" class="data1" value="yes" checked name="karbohidrat" id="karbohidrat">@endif
																	</td>
																	<td>Karbohidrat Total</td>
																	<td class="text-right">{{ $total_harga['total_karbohidrat'] }}</td><td class="text-center">g</td>
																	<td class="text-right"><?php $angka = $total_harga['total_karbohidrat']*($akg->karbohidrat_total/100); $angka_format = number_format($angka,2,",","."); echo $angka_format; ?></td>
																	<td class="text-right">{{$akg->karbohidrat_total}}</td><td class="text-center">g</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->overage_karbohidrat!='yes') {{ $total_harga['total_karbohidrat'] }}
																		@else {{ $total_harga['total_karbohidrat'] * ($formula->overage/100) }} @endif
																	</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_protein1!='yes')<input type="checkbox" class="data1" name="protein1" value="yes" id="protein1">
																		@else<input type="checkbox" class="data1" value="yes" checked name="protein1" id="protein1">@endif
																	</td>
																	<td>Protein</td>
																	<td class="text-right">{{ $total_harga['total_protein'] }}</td><td class="text-center">g</td>
																	<td class="text-right"><?php $protein = $total_harga['total_protein']*($akg->protein/100); $angka_protein = number_format($protein,2,",","."); echo $angka_protein; ?></td>
																	<td class="text-right">{{$akg->protein}}</td><td class="text-center">g</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->overage_protein1!='yes') {{ $total_harga['total_protein'] }}
																		@else {{ $total_harga['total_protein'] * ($formula->overage/100) }} @endif
																	</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_lemak_trans!='yes')<input type="checkbox" class="data1" name="lemak_trans" value="yes" id="lemak_trans">
																		@else<input type="checkbox" class="data1" value="yes" checked name="lemak_trans" id="lemak_trans">@endif
																	</td>
																	<td>Lemak Total</td>
																	<td class="text-right">{{ $total_harga['total_lemak_total'] }}</td><td class="text-center">g</td>
																	<td class="text-right">NA</td><td class="text-right">{{$akg->lemak_total}}</td><td class="text-center">g</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->overage_lemak_total!='yes') {{ $total_harga['total_lemak_total'] }}
																		@else {{ $total_harga['total_lemak_total'] * ($formula->overage/100) }} @endif
																	</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_lemak_trans!='yes')<input type="checkbox" class="data1" name="lemak_trans" value="yes" id="lemak_trans">
																		@else<input type="checkbox" class="data1" value="yes" checked name="lemak_trans" id="lemak_trans">@endif
																	</td>
																	<td>Lemak Trans</td>
																	<td class="text-right">NA</td><td class="text-center">g</td>
																	<td class="text-right">NA</td><td class="text-right"></td><td class="text-center">g</td>
																	<td class="text-right" style="background-color:#d1d1d1;">NA</td>
																</tr>
															<tr class="" style=" color: black;">
																<td>
																	@if($akg->overage_lemak_jenuh!='yes')<input type="checkbox" class="data1" name="lemak_jenuh" value="yes" id="lemak_jenuh">
																	@else<input type="checkbox" class="data1" value="yes" checked name="lemak_jenuh" id="lemak_jenuh">@endif
																</td>
																<td>Lemak Jenuh</td>
																<td class="text-right">{{ $total_harga['total_lemak_jenuh'] }}</td><td class="text-center">g</td>
																<td class="text-right"><?php $sfa = $total_harga['total_lemak_jenuh']*($akg->lemak_jenuh/100); $angka_sfa = number_format($sfa,2,",","."); echo $angka_sfa; ?></td>
																<td class="text-right">{{$akg->lemak_jenuh}}</td><td class="text-center">g</td>
																<td class="text-right" style="background-color:#d1d1d1;">
																	@if($akg->overage_lemak_jenuh!='yes') {{ $total_harga['total_lemak_jenuh'] }}
																	@else {{ $total_harga['total_lemak_jenuh'] * ($formula->overage/100) }} @endif
																</td>
															</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_lemak_tidak_jenuh_tunggal!='yes')<input type="checkbox" class="data1" name="lemak_jenuh" value="yes" id="lemak_jenuh">
																		@else<input type="checkbox" class="data1" value="yes" checked name="lemak_jenuh" id="lemak_jenuh">@endif
																	</td>
																	<td>Lemak Tidak Jenuh Tunggal</td>
																	<td class="text-right">NA</td><td class="text-center">g</td><td class="text-right">NA</td>
																	<td class="text-right">NA</td><td class="text-center">g</td>
																	<td class="text-right" style="background-color:#d1d1d1;">NA</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_lemak_tidak_jenuh_ganda!='yes')<input type="checkbox" class="data1" name="lemak_jenuh" value="yes" id="lemak_jenuh">
																		@else<input type="checkbox" class="data1" value="yes" checked name="lemak_jenuh" id="lemak_jenuh">@endif
																	</td>
																	<td>Lemak Tidak Jenuh Ganda</td>
																	<td class="text-right">NA</td><td class="text-center">g</td><td class="text-right">NA</td>
																	<td class="text-right">NA</td><td class="text-center">g</td>
																	<td class="text-right" style="background-color:#d1d1d1;">NA</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_kolestrol!='yes')<input type="checkbox" class="data1" name="kolestrol" value="yes" id="kolestrol">
																		@else<input type="checkbox" class="data1" value="yes" checked name="kolestrol" id="kolestrol">@endif
																	</td>
																	<td>Kolestrol</td>
																	<td class="text-right">{{ $total_harga['total_kolestrol'] }}</td><td class="text-center">mg</td>
																	<td class="text-right">NA</td><td class="text-right">{{$akg->kolesterol}}</td><td class="text-center">mg</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->overage_kolestrol!='yes'){{ $total_harga['total_kolestrol'] }}
																		@else	{{ $total_harga['total_kolestrol'] * ($formula->overage/100) }} @endif
																	</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_gula!='yes')<input type="checkbox" class="data1" name="gula" value="yes" id="gula">
																		@else<input type="checkbox" class="data1" value="yes" checked name="gula" id="gula">@endif
																	</td>
																	<td>Gula</td>
																	<td class="text-right">{{ $total_harga['total_gula'] }}</td>  <td class="text-center">g</td>
																	<td class="text-right">NA</td><td class="text-right">NA</td><td class="text-center">g</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->overage_gula!='yes'){{ $total_harga['total_gula'] }}
																		@else	{{ $total_harga['total_gula'] * ($formula->overage/100) }} @endif
																	</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_serat_pangan!='yes')<input type="checkbox" class="data1" name="serat_pangan" value="yes" id="serat_pangan">
																		@else<input type="checkbox" class="data1" value="yes" checked name="serat_pangan" id="serat_pangan">@endif
																	</td>
																	<td>Serat Pangan</td>
																	<td class="text-right">{{ $total_harga['total_serat'] }}</td><td class="text-center">g</td>
																	<td class="text-right"><?php $serat = $total_harga['total_serat']*($akg->serat_pangan/100); $angka_serat = number_format($serat,2,",","."); echo $angka_serat; ?></td>
																	<td class="text-right">{{$akg->serat_pangan}}</td><td class="text-center">g</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->overage_serat_pangan!='yes'){{ $total_harga['total_serat'] }}
																		@else	{{ $total_harga['total_serat'] * ($formula->overage/100) }} @endif
																	</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_serat_pangan_larut!='yes')<input type="checkbox" class="data1" name="serat_pangan_larut" value="yes" id="serat_pangan_larut">
																		@else<input type="checkbox" class="data1" value="yes" checked name="serat_pangan_larut" id="serat_pangan_larut">@endif
																	</td>
																	<td>Serat Pangan Larut</td>
																	<td class="text-right">{{ $total_harga['total_serat'] }}</td><td class="text-center">g</td>
																	<td class="text-right">NA</td><td class="text-right">NA</td><td class="text-center">g</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->overage_serat_pangan_larut!='yes'){{ $total_harga['total_serat'] }}
																		@else {{ $total_harga['total_serat'] * ($formula->overage/100) }} @endif
																	</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_serat_pangan_tidaklarut!='yes')<input type="checkbox" class="data1" name="serat_pangan_larut" value="yes" id="serat_pangan_larut">
																		@else<input type="checkbox" class="data1" value="yes" checked name="serat_pangan_larut" id="serat_pangan_larut">@endif
																	</td>
																	<td>Serat Pangan Tidak Larut</td>
																	<td class="text-right">NA</td><td class="text-center">g</td>
																	<td class="text-right">NA</td><td class="text-right">NA</td><td class="text-center">g</td>
																	<td class="text-right" style="background-color:#d1d1d1;">NA</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_sukrosa!='yes')<input type="checkbox" class="data1" name="laktosa" value="yes" id="laktosa">
																		@else<input type="checkbox" class="data1" value="yes" checked name="laktosa" id="laktosa">@endif
																	</td>
																	<td>Sukrosa</td>
																	<td class="text-right">{{ $total_harga['total_sukrosa'] }}</td><td class="text-center">g</td>
																	<td class="text-right">NA</td><td class="text-right">NA</td><td class="text-center">g</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->overage_laktosa!='yes'){{ $total_harga['total_sukrosa'] }}
																		@else	{{ $total_harga['total_sukrosa'] * ($formula->overage/100) }} @endif
																	</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_laktosa!='yes')<input type="checkbox" class="data1" name="laktosa" value="yes" id="laktosa">
																		@else<input type="checkbox" class="data1" value="yes" checked name="laktosa" id="laktosa">@endif
																	</td>
																	<td>Laktosa</td>
																	<td class="text-right">{{ $total_harga['total_laktosa'] }}</td><td class="text-center">g</td>
																	<td class="text-right">NA</td><td class="text-right">NA</td><td class="text-center">g</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->overage_laktosa!='yes'){{ $total_harga['total_laktosa'] }}
																		@else	{{ $total_harga['total_laktosa'] * ($formula->overage/100) }} @endif
																	</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_natrium!='yes')<input type="checkbox" class="data1" name="natrium" value="yes" id="natrium">
																		@else<input type="checkbox" class="data1" value="yes" checked name="natrium" id="natrium">@endif
																	</td>
																	<td>Natrium</td>
																	<td class="text-right">{{ $total_harga['total_na'] }}</td><td class="text-center">mg</td>
																	<td class="text-right"><?php $na = $total_harga['total_na']*($akg->natrium/100); $angka_na = number_format($na,2,",","."); echo $angka_na; ?></td>
																	<td class="text-right">{{$akg->natrium}}</td><td class="text-center">mg</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->overage_natrium!='yes'){{ $total_harga['total_na'] }}
																		@else	{{ $total_harga['total_na'] * ($formula->overage/100) }} @endif
																	</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_kalium!='yes')<input type="checkbox" class="data1" name="kalium" value="yes" id="kalium">
																		@else<input type="checkbox" class="data1" value="yes" checked name="kalium" id="kalium">@endif
																	</td>
																	<td>Kalium</td>
																	<td class="text-right">{{ $total_harga['total_k'] }}</td><td class="text-center">mg</td>
																	<td class="text-right"><?php $k = $total_harga['total_k']* ($akg->kalium/100); $angka_k = number_format($k,2,",","."); echo $angka_k; ?></td>
																	<td class="text-right">{{$akg->kalium}}</td><td class="text-center">mg</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->overage_kalium!='yes'){{ $total_harga['total_k'] }}
																		@else	{{ $total_harga['total_k'] * ($formula->overage/100) }} @endif
																	</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_kalsium!='yes')<input type="checkbox" class="data1" name="kalsium" value="yes" id="kalsium">
																		@else<input type="checkbox" class="data1" value="yes" checked name="kalsium" id="kalsium">@endif
																	</td>
																	<td>Kalsium</td>
																	<td class="text-right">{{ $total_harga['total_ca'] }}</td><td class="text-center">mg</td>
																	<td class="text-right"><?php $ca = $total_harga['total_ca']*($akg->kalsium/100); $angka_ca = number_format($ca,2,",","."); echo $angka_ca; ?></td>
																	<td class="text-right">{{$akg->kalsium}}</td><td class="text-center">mg</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->overage_kalsium!='yes'){{ $total_harga['total_ca'] }}
																		@else	{{ $total_harga['total_ca'] * ($formula->overage/100) }} @endif
																	</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_zat_besi!='yes')<input type="checkbox" class="data1" name="zat_besi" value="yes" id="zat_besi">
																		@else<input type="checkbox" class="data1" value="yes" checked name="zat_besi" id="zat_besi">@endif
																	</td>
																	<td>Zat Besi</td>
																	<td class="text-right">NA</td><td class="text-center">mg</td>
																	<td class="text-right">NA</td><td class="text-right">{{$akg->besi}}</td><td class="text-center">mg</td>
																	<td class="text-right" style="background-color:#d1d1d1;">NA</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_fosfor!='yes')<input type="checkbox" class="data1" name="fosfor" value="yes" id="fosfor">
																		@else<input type="checkbox" class="data1" value="yes" checked name="fosfor" id="fosfor">@endif
																	</td>
																	<td>Fosfor</td>
																	<td class="text-right">{{ $total_harga['total_p'] }}</td><td class="text-center">mg</td>
																	<td class="text-right"><?php $p = $total_harga['total_p']*($akg->fosfor/100); $angka_p = number_format($p,2,",","."); echo $angka_p; ?></td>
																	<td class="text-right">{{$akg->fosfor}}</td><td class="text-center">mg</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->overage_fosfor!='yes'){{ $total_harga['total_p'] }}
																		@else	{{ $total_harga['total_p'] * ($formula->overage/100) }} @endif
																	</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_magnesium!='yes')<input type="checkbox" class="data1" name="magnesium" value="yes" id="magnesium">
																		@else<input type="checkbox" class="data1" value="yes" checked name="magnesium" id="magnesium">@endif
																	</td>
																	<td>Magnesium</td>
																	<td class="text-right">{{ $total_harga['total_mg'] }}</td><td class="text-center">mg</td>
																	<td class="text-right"><?php $mg = $total_harga['total_mg']*($akg->magnesium*100); $angka_mg = number_format($mg,2,",","."); echo $angka_mg; ?></td>
																	<td class="text-right">{{$akg->magnesium}}</td><td class="text-center">mg</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->overage_magnesium!='yes') {{ $total_harga['total_mg'] }}
																		@else	{{ $total_harga['total_mg'] * ($formula->overage/100) }} @endif
																	</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_seng!='yes')<input type="checkbox" class="data1" name="seng" value="yes" id="seng">
																		@else<input type="checkbox" class="data1" value="yes" checked name="seng" id="seng">@endif
																	</td>
																	<td>Seng</td>
																	<td class="text-right">NA</td><td class="text-center">mg</td>
																	<td class="text-right">NA</td><td class="text-right">{{$akg->seng}}</td><td class="text-center">mg</td>
																	<td class="text-right" style="background-color:#d1d1d1;">NA</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_selenium!='yes')<input type="checkbox" class="data1" name="selenium" value="yes" id="selenium">
																		@else<input type="checkbox" class="data1" value="yes" checked name="selenium" id="selenium">@endif
																	</td>
																	<td>Selenium</td>
																	<td class="text-right">NA</td><td class="text-center">mcg</td>
																	<td class="text-right">NA</td><td class="text-right">{{$akg->selenium}}</td><td class="text-center">mcg</td>
																	<td class="text-right" style="background-color:#d1d1d1;">NA</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_lodium!='yes')<input type="checkbox" class="data1" name="lodium" value="yes" id="lodium">
																		@else<input type="checkbox" class="data1" value="yes" checked name="lodium" id="lodium">@endif
																	</td>
																	<td>Lodium</td>
																	<td class="text-right">NA</td><td class="text-center">mg</td>
																	<td class="text-right">NA</td><td class="text-right">{{$akg->lodium}}</td><td class="text-center">mcg</td>
																	<td class="text-right" style="background-color:#d1d1d1;">NA</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_mangan!='yes')<input type="checkbox" class="data1" name="mangan" value="yes" id="mangan">
																		@else<input type="checkbox" class="data1" value="yes" checked name="mangan" id="mangan">@endif
																	</td>
																	<td>Mangan</td>
																	<td class="text-right">NA</td><td class="text-center">mg</td>
																	<td class="text-right">NA</td><td class="text-right">{{$akg->mangan}}</td><td class="text-center">mg</td>
																	<td class="text-right" style="background-color:#d1d1d1;">NA</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_flour!='yes')<input type="checkbox" class="data1" name="flour" value="yes" id="flour">
																		@else<input type="checkbox" class="data1" value="yes" checked name="flour" id="flour">@endif
																	</td>
																	<td>Flour</td>
																	<td class="text-right">NA</td><td class="text-center">mg</td>
																	<td class="text-right">NA</td><td class="text-right">{{$akg->fluor}}</td><td class="text-center">mg</td>
																	<td class="text-right" style="background-color:#d1d1d1;">NA</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_vitA!='yes')<input type="checkbox" class="data1" name="vitA" value="yes" id="vitA">
																		@else<input type="checkbox" class="data1" value="yes" checked name="vitA" id="vitA">@endif
																	</td>
																	<td>Vitamin A</td>
																	<td class="text-right">{{ $total_harga['total_vitA'] }}</td><td class="text-center">IU</td>
																	<td class="text-right">{{ $total_harga['total_vitA'] * ($akg->vitamin_a/100) }}</td>
																	<td class="text-right">{{$akg->vitamin_a}}</td><td class="text-center">IU</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->overage_vitA!='yes') {{ $total_harga['total_vitA'] }}
																		@else	{{ $total_harga['total_vitA']* ($formula->overage/100) }} @endif
																	</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_vitB1!='yes')<input type="checkbox" class="data1" name="vitB1" value="yes" id="vitB1">
																		@else<input type="checkbox" class="data1" value="yes" checked name="vitB1" id="vitB1">@endif
																	</td>
																	<td>Vitamin B1</td>
																	<td class="text-right">{{ $total_harga['total_vitB1'] }}</td><td class="text-center">mg</td>
																	<td class="text-right">{{ $total_harga['total_vitB1'] * ($akg->vitamin_b1/100) }}</td>
																	<td class="text-right">{{$akg->vitamin_b1}}</td><td class="text-center">mg</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->overage_vitB1!='yes') {{ $total_harga['total_vitB1'] }}
																		@else	{{ $total_harga['total_vitB1']* ($formula->overage/100) }} @endif
																	</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_vitB2!='yes')<input type="checkbox" class="data1" name="vitB2" value="yes" id="vitB2">
																		@else<input type="checkbox" class="data1" value="yes" checked name="vitB2" id="vitB2">@endif
																	</td>
																	<td>Vitamin B2</td>
																	<td class="text-right">{{ $total_harga['total_vitB2'] }}</td><td class="text-center">mg</td>
																	<td class="text-right">{{ $total_harga['total_vitB2'] * ($akg->vitamin_b2/100) }}</td>
																	<td class="text-right">{{$akg->vitamin_b2}}</td><td class="text-center">mg</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->overage_vitB2!='yes') {{ $total_harga['total_vitB2'] }}
																		@else	{{ $total_harga['total_vitB2']* ($formula->overage/100) }} @endif
																	</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_vitB3!='yes')<input type="checkbox" class="data1" name="vitB3" value="yes" id="vitB3">
																		@else<input type="checkbox" class="data1" value="yes" checked name="vitB3" id="vitB3">@endif
																	</td>
																	<td>Vitamin B3</td>
																	<td class="text-right">{{ $total_harga['total_vitB3'] }}</td><td class="text-center">mg</td>
																	<td class="text-right">{{ $total_harga['total_vitB3'] * ($akg->vitamin_b3/100) }}</td>
																	<td class="text-right">{{$akg->vitamin_b3}}</td><td class="text-center">mg</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->overage_vitB3!='yes') {{ $total_harga['total_vitB3'] }}
																		@else	{{ $total_harga['total_vitB3']* ($formula->overage/100) }} @endif
																	</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_vitB5!='yes')<input type="checkbox" class="data1" name="vitB5" value="yes" id="vitB5">
																		@else<input type="checkbox" class="data1" value="yes" checked name="vitB5" id="vitB5">@endif
																	</td>
																	<td>Vitamin B5</td>
																	<td class="text-right">{{ $total_harga['total_vitB5'] }}</td><td class="text-center">mg</td>
																	<td class="text-right">{{ $total_harga['total_vitB5'] * ($akg->vitamin_b5/100) }}</td>
																	<td class="text-right">{{$akg->vitamin_b5}}</td><td class="text-center">mg</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->overage_vitB5!='yes') {{ $total_harga['total_vitB5'] }}
																		@else	{{ $total_harga['total_vitB5']* ($formula->overage/100) }} @endif
																	</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_vitB6!='yes')<input type="checkbox" class="data1" name="vitB6" value="yes" id="vitB6">
																		@else<input type="checkbox" class="data1" value="yes" checked name="vitB6" id="vitB6">@endif
																	</td>
																	<td>Vitamin B6</td>
																	<td class="text-right">{{ $total_harga['total_vitB6'] }}</td><td class="text-center">mg</td>
																	<td class="text-right">{{ $total_harga['total_vitB6'] * ($akg->vitamin_b6/100) }}</td>
																	<td class="text-right">{{$akg->vitamin_b6}}</td><td class="text-center">mg</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->overage_vitB6!='yes') {{ $total_harga['total_vitB6'] }}
																		@else	{{ $total_harga['total_vitB6']* ($formula->overage/100) }} @endif
																	</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_vitB12!='yes')<input type="checkbox" class="data1" name="vitB12" value="yes" id="vitB12">
																		@else<input type="checkbox" class="data1" value="yes" checked name="vitB12" id="vitB12">@endif
																	</td>
																	<td>Vitamin B12</td>
																	<td class="text-right">{{ $total_harga['total_vitB12'] }}</td><td class="text-center">mcg</td>
																	<td class="text-right">{{ $total_harga['total_vitB12'] * ($akg->vitamin_b12/100) }}</td>
																	<td class="text-right">{{$akg->vitamin_b12}}</td><td class="text-center">mcg</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->overage_vitB12!='yes') {{ $total_harga['total_vitB12'] }}
																		@else	{{ $total_harga['total_vitB12']* ($formula->overage/100) }} @endif
																	</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_vitC!='yes')<input type="checkbox" class="data1" name="vitC" value="yes" id="vitC">
																		@else<input type="checkbox" class="data1" value="yes" checked name="vitC" id="vitC">@endif
																	</td>
																	<td>Vitamin C</td>
																	<td class="text-right">{{ $total_harga['total_vitC'] }}</td><td class="text-center">mg</td>
																	<td class="text-right">{{ $total_harga['total_vitC'] * ($akg->vitamin_c/100) }}</td>
																	<td class="text-right">{{$akg->vitamin_c}}</td><td class="text-center">mg</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->overage_vitC!='yes') {{ $total_harga['total_vitC'] }}
																		@else	{{ $total_harga['total_vitC']* ($formula->overage/100) }} @endif
																	</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_vitD3!='yes')<input type="checkbox" class="data1" name="vitD3" value="yes" id="vitD3">
																		@else<input type="checkbox" class="data1" value="yes" checked name="vitD3" id="vitD3">@endif
																	</td>
																	<td>Vitamin D3</td>
																	<td class="text-right">{{ $total_harga['total_vitD'] }}</td><td class="text-center">IU</td>
																	<td class="text-right">{{ $total_harga['total_vitD'] * ($akg->vitamin_d/100) }}</td>
																	<td class="text-right">{{$akg->vitamin_d}}</td><td class="text-center">IU</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->overage_vitD3!='yes') {{ $total_harga['total_vitD'] }}
																		@else	{{ $total_harga['total_vitD']* ($formula->overage/100) }} @endif
																	</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_vitE!='yes')<input type="checkbox" class="data1" name="vitE" value="yes" id="vitE">
																		@else<input type="checkbox" class="data1" value="yes" checked name="vitE" id="vitE">@endif
																	</td>
																	<td>Vitamin E</td>
																	<td class="text-right">{{ $total_harga['total_vitE'] }}</td><td class="text-center">mg</td>
																	<td class="text-right">{{ $total_harga['total_vitE'] * ($akg->vitamin_e/100) }}</td>
																	<td class="text-right">{{$akg->vitamin_e}}</td><td class="text-center">mg</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->overage_vitE!='yes') {{ $total_harga['total_vitE']}}
																		@else	{{ $total_harga['total_vitE']* ($formula->overage/100)}} @endif
																	</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_vitK!='yes')<input type="checkbox" class="data1" name="vitE" value="yes" id="vitE">
																		@else<input type="checkbox" class="data1" value="yes" checked name="vitE" id="vitE">@endif
																	</td>
																	<td>Vitamin K</td>
																	<td class="text-right">{{ $total_harga['total_vitK'] }}</td><td class="text-center">mg</td>
																	<td class="text-right">{{ $total_harga['total_vitK'] * ($akg->vitamin_k/100) }}</td>
																	<td class="text-right">{{$akg->vitamin_k}}</td><td class="text-center">mg</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->overage_vitK!='yes') {{ $total_harga['total_vitK']}}
																		@else	{{ $total_harga['total_vitK']* ($formula->overage/100)}} @endif
																	</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_asam_folat!='yes')<input type="checkbox" class="data1" name="asam_folat" value="yes" id="asam_folat">
																		@else<input type="checkbox" class="data1" value="yes" checked name="asam_folat" id="asam_folat">@endif
																	</td>
																	<td>Asam Folat</td>
																	<td class="text-right">{{ $total_harga['total_folat'] }}</td><td class="text-center">mcg</td>
																	<td class="text-right">NA</td><td class="text-right">NA</td><td class="text-center">mcg</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->overage_asam_folat!='yes') {{ $total_harga['total_folat']}}
																		@else	{{ $total_harga['total_folat']* ($formula->overage/100)}} @endif
																	</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_magnesium_aspartat!='yes')<input type="checkbox" class="data1" name="magnesium_aspartat" value="yes" id="magnesium_aspartat">
																		@else<input type="checkbox" class="data1" value="yes" checked name="magnesium_aspartat" id="magnesium_aspartat">@endif
																	</td>
																	<td>Magnesium Aspartat</td>
																	<td class="text-right">{{ $total_harga['total_aspartat'] }}</td><td class="text-center">mg</td>
																	<td class="text-right">NA</td><td class="text-right">NA</td><td class="text-center">mg</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->overage_magnesium_aspartat!='yes') {{ $total_harga['total_aspartat']}}
																		@else	{{ $total_harga['total_aspartat']* ($formula->overage/100)}} @endif
																	</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_kolin!='yes')<input type="checkbox" class="data1" name="kolin" value="yes" id="kolin">
																		@else<input type="checkbox" class="data1" value="yes" checked name="kolin" id="kolin">@endif
																	</td>
																	<td>Kolin</td>
																	<td class="text-right">{{ $total_harga['total_kolin']}}</td><td class="text-center">mg</td>
																	<td class="text-right"><?php $kolin = $total_harga['total_kolin']*($akg->kolin*100); $angka_kolin = number_format($kolin,2,",","."); echo $angka_kolin; ?></td>
																	<td class="text-right">{{$akg->kolin}}</td><td class="text-center">mg</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->overage_kolin!='yes') {{ $total_harga['total_kolin']}}
																		@else	{{ $total_harga['total_kolin']* ($formula->overage/100)}} @endif
																	</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_biotin!='yes')<input type="checkbox" class="data1" name="biotin" value="yes" id="biotin">
																		@else<input type="checkbox" class="data1" value="yes" checked name="biotin" id="biotin">@endif
																	</td>
																	<td>Biotin</td>
																	<td class="text-right">{{ $total_harga['total_biotin'] }}</td><td class="text-center">mcg</td>
																	<td class="text-right">{{ $total_harga['total_biotin'] * ($akg->biotin/100) }}</td>
																	<td class="text-right">{{$akg->biotin}}</td><td class="text-center">mcg</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->overage_biotin!='yes') {{ $total_harga['total_biotin']}}
																		@else	{{ $total_harga['total_biotin']* ($formula->overage/100)}} @endif
																	</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_Kromium!='yes')<input type="checkbox" class="data1" name="Kromium" value="yes" id="Kromium">
																		@else<input type="checkbox" class="data1" value="yes" checked name="Kromium" id="Kromium">@endif
																	</td>
																	<td>Kromium</td>
																	<td class="text-right">{{ $total_harga['total_cr'] }}</td><td class="text-center">mcg</td>
																	<td class="text-right"><?php $cr = $total_harga['total_cr']*($akg->kromium*100); $angka_cr = number_format($cr,2,",","."); echo $angka_cr; ?></td>
																	<td class="text-right">{{$akg->kromium}}</td><td class="text-center">mcg</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->overage_Kromium!='yes') {{ $total_harga['total_cr'] }}
																		@else	{{ $total_harga['total_cr']* ($formula->overage/100) }} @endif
																	</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_EPA!='yes')<input type="checkbox" class="data1" name="EPA" value="yes" id="EPA">
																		@else<input type="checkbox" class="data1" value="yes" checked name="EPA" id="EPA">@endif
																	</td>
																	<td>EPA</td>
																	<td class="text-right">{{ $total_harga['total_epa'] }}</td><td class="text-center">mg</td>
																	<td class="text-right">Na</td><td class="text-right">Na</td><td class="text-center">mg</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->overage_EPA!='yes') {{ $total_harga['total_epa'] }} 
																		@else	{{ $total_harga['total_epa']* ($formula->overage/100) }} @endif
																	</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_DHA!='yes')<input type="checkbox" class="data1" name="DHA" value="yes" id="DHA">
																		@else<input type="checkbox" class="data1" value="yes" checked name="DHA" id="DHA">@endif
																	</td>
																	<td>DHA</td>
																	<td class="text-right">{{ $total_harga['total_dha'] }}</td><td class="text-center">mg</td>
																	<td class="text-right">NA</td><td class="text-right">NA</td><td class="text-center">mg</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->overage_DHA!='yes') {{ $total_harga['total_dha'] }}
																		@else	{{ $total_harga['total_dha']* ($formula->overage/100) }} @endif
																	</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_Glukosamin!='yes')<input type="checkbox" class="data1" name="Glukosamin" value="yes" id="Glukosamin">
																		@else<input type="checkbox" class="data1" value="yes" checked name="Glukosamin" id="Glukosamin">@endif
																	</td>
																	<td>Glukosamin</td>
																	<td class="text-right">{{ $total_harga['total_glukosa']}}</td><td class="text-center">mg</td>
																	<td class="text-right">NA</td><td class="text-right">NA</td><td class="text-center">mg</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->overage_Glukosamin!='yes'){{ $total_harga['total_glukosa']}}
																		@else	{{ $total_harga['total_glukosa']* ($formula->overage/100)}} @endif
																	</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_omega3!='yes')<input type="checkbox" class="data1" name="omega3" value="yes" id="omega3">
																		@else<input type="checkbox" class="data1" value="yes" checked name="omega3" id="omega3">@endif
																	</td>
																	<td>Omega 3</td>
																	<td class="text-right">{{ $total_harga['total_omega3'] }}</td><td class="text-center">g</td>
																	<td class="text-right">NA</td><td class="text-right">NA</td><td class="text-center">g</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->overage_omega3!='yes'){{ $total_harga['total_omega3'] }}
																		@else	{{ $total_harga['total_omega3']* ($formula->overage/100) }} @endif
																	</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_omega6!='yes')<input type="checkbox" class="data1" name="omega9" value="yes" id="omega9">
																		@else<input type="checkbox" class="data1" value="yes" checked name="omega9" id="omega9">@endif
																	</td>
																	<td>Omega 6</td>
																	<td class="text-right">{{ $total_harga['total_omega6'] }}</td><td class="text-center">g</td>
																	<td class="text-right">NA</td><td class="text-right">NA</td><td class="text-center">g</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->overage_omega6!='yes'){{ $total_harga['total_omega6'] }}
																		@else	{{ $total_harga['total_omega6']* ($formula->overage/100) }} @endif
																	</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_omega9!='yes')<input type="checkbox" class="data1" name="omega9" value="yes" id="omega9">
																		@else<input type="checkbox" class="data1" value="yes" checked name="omega9" id="omega9">@endif
																	</td>
																	<td>Omega 9</td>
																	<td class="text-right">{{ $total_harga['total_omega9'] }}</td><td class="text-center">g</td>
																	<td class="text-right">NA</td><td class="text-right">NA</td><td class="text-center">g</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->overage_omega9!='yes'){{ $total_harga['total_omega9'] }}
																		@else	{{ $total_harga['total_omega9']* ($formula->overage/100) }} @endif
																	</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_Klorida!='yes')<input type="checkbox" class="data1" name="omega9" value="yes" id="omega9">
																		@else<input type="checkbox" class="data1" value="yes" checked name="omega9" id="omega9">@endif
																	</td>
																	<td>Klorida</td>
																	<td class="text-right">NA</td><td class="text-center">mg</td>
																	<td class="text-right">NA</td><td class="text-right">NA</td><td class="text-center">mg</td>
																	<td class="text-right" style="background-color:#d1d1d1;">NA</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_asam_linoleat!='yes')<input type="checkbox" class="data1" name="omega9" value="yes" id="omega9">
																		@else<input type="checkbox" class="data1" value="yes" checked name="omega9" id="omega9">@endif
																	</td>
																	<td>Asam linoleat</td>
																	<td class="text-right">{{ $total_harga['total_omega6'] }}</td><td class="text-center">g</td>
																	<td class="text-right">NA</td><td class="text-right">NA</td><td class="text-center">g</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->overage_asam_linoleat!='yes'){{ $total_harga['total_omega6'] }}
																		@else	{{ $total_harga['total_omega6']* ($formula->overage/100) }} @endif
																	</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_energi_asam_linoleat!='yes')<input type="checkbox" class="data1" name="omega9" value="yes" id="omega9">
																		@else<input type="checkbox" class="data1" value="yes" checked name="omega9" id="omega9">@endif
																	</td>
																	<td>Energi dari asam linoleat </td>
																	<td class="text-right">NA</td><td class="text-center">kkal</td>
																	<td class="text-right">NA</td><td class="text-right">NA</td><td class="text-center">kkal</td>
																	<td class="text-right" style="background-color:#d1d1d1;">NA</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_energi_protein!='yes')<input type="checkbox" class="data1" name="energi_protein" value="yes" id="energi_protein">
																		@else<input type="checkbox" class="data1" value="yes" checked name="energi_protein" id="energi_protein">@endif
																	</td>
																	<td>Energi dari Protein</td>
																	<td class="text-right">{{ $total_harga['total_protein']*4 }}</td><td class="text-center">kkal</td>
																	<td class="text-right">NA</td><td class="text-right">NA</td><td class="text-center">kkal</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->overage_energi_protein!='yes'){{ $total_harga['total_protein']*4 }}
																		@else	{{ ($total_harga['total_protein']*4)* ($formula->overage/100) }} @endif
																	</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_l_glutamin!='yes')<input type="checkbox" class="data1" name="l_glutamin" value="yes" id="l_glutamin">
																		@else<input type="checkbox" class="data1" value="yes" checked name="l_glutamin" id="l_glutamin">@endif
																	</td>
																	<td>L-Glutamin</td>
																	<td class="text-right">{{ $total_harga['total_l_glutamine'] }}</td><td class="text-center">mg</td>
																	<td class="text-right">NA</td><td class="text-right">NA</td><td class="text-center">mg</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->overage_l_glutamin!='yes'){{ $total_harga['total_l_glutamine'] }}
																		@else	{{ ($total_harga['total_l_glutamine'])* ($formula->overage/100) }} @endif
																	</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_Thereonin!='yes')<input type="checkbox" class="data1" name="Thereonin" value="yes" id="Thereonin">
																		@else<input type="checkbox" class="data1" value="yes" checked name="Thereonin" id="Thereonin">@endif
																	</td>
																	<td>**Thereonin</td>
																	<td class="text-right">{{ $total_harga['total_threonin'] }}</td><td class="text-center">mg</td>
																	<td class="text-right"></td><td class="text-right"></td><td class="text-center">mg</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->overage_Thereonin!='yes'){{ $total_harga['total_threonin'] }}
																		@else	{{ ($total_harga['total_threonin'])* ($formula->overage/100) }} @endif
																	</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_Methionin!='yes')<input type="checkbox" class="data1" name="Methionin" value="yes" id="Methionin">
																		@else<input type="checkbox" class="data1" value="yes" checked name="Methionin" id="Methionin">@endif
																	</td>
																	<td>**Methionin</td>
																	<td class="text-right">{{ $total_harga['total_methionin'] }}</td><td class="text-center">mg</td>
																	<td class="text-right"></td><td class="text-right"></td><td class="text-center">mg</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->overage_Methionin!='yes'){{ $total_harga['total_methionin'] }}
																		@else	{{ ($total_harga['total_methionin'])* ($formula->overage/100) }} @endif
																	</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_Phenilalanin!='yes')<input type="checkbox" class="data1" name="Phenilalanin" value="yes" id="Phenilalanin">
																		@else<input type="checkbox" class="data1" value="yes" checked name="Phenilalanin" id="Phenilalanin">@endif
																	</td>
																	<td>**Phenilalanin</td>
																	<td class="text-right">{{ $total_harga['total_phenilalanin'] }}</td><td class="text-center">mg</td>
																	<td class="text-right"></td><td class="text-right"></td><td class="text-center">mg</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->overage_Phenilalanin!='yes'){{ $total_harga['total_phenilalanin'] }}
																		@else	{{ ($total_harga['total_phenilalanin'])* ($formula->overage/100) }} @endif
																	</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_Histidin!='yes')<input type="checkbox" class="data1" name="Histidin" value="yes" id="Histidin">
																		@else<input type="checkbox" class="data1" value="yes" checked name="Histidin" id="Histidin">@endif
																	</td>
																	<td>**Histidin</td>
																	<td class="text-right">{{ $total_harga['total_histidin'] }}</td><td class="text-center">mg</td>
																	<td class="text-right"></td><td class="text-right"></td><td class="text-center">mg</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->overage_Histidin!='yes'){{ $total_harga['total_histidin'] }}
																		@else	{{ ($total_harga['total_histidin'])* ($formula->overage/100) }} @endif
																	</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_Lisin!='yes')<input type="checkbox" class="data1" name="Lisin" value="yes" id="Lisin">
																		@else<input type="checkbox" class="data1" value="yes" checked name="Lisin" id="Lisin">@endif
																	</td>
																	<td>**Lisin</td>
																	<td class="text-right">{{ $total_harga['total_lisin'] }}</td><td class="text-center">mg</td>
																	<td class="text-right"></td><td class="text-right"></td><td class="text-center">mg</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->overage_Lisin!='yes'){{ $total_harga['total_lisin'] }}
																		@else	{{ ($total_harga['total_lisin'])* ($formula->overage/100) }} @endif
																	</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_BCAA!='yes')<input type="checkbox" class="data1" name="BCAA" value="yes" id="BCAA">
																		@else<input type="checkbox" class="data1" value="yes" checked name="BCAA" id="BCAA">@endif
																	</td>
																	<td>**BCAA</td>
																	<td class="text-right">{{ $total_harga['total_BCAA'] }}</td><td class="text-center">mg</td>
																	<td class="text-right"></td><td class="text-right"></td><td class="text-center">mg</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->overage_BCAA!='yes'){{ $total_harga['total_BCAA'] }}
																		@else	{{ ($total_harga['total_BCAA'])* ($formula->overage/100) }} @endif
																	</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_Valin!='yes')<input type="checkbox" class="data1" name="Valin" value="yes" id="Valin">
																		@else<input type="checkbox" class="data1" value="yes" checked name="Valin" id="Valin">@endif
																	</td>
																	<td>**Valin</td>
																	<td class="text-right">{{ $total_harga['total_valin'] }}</td><td class="text-center">mg</td>
																	<td class="text-right"></td><td class="text-right"></td><td class="text-center">mg</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->overage_Valin!='yes'){{ $total_harga['total_valin'] }}
																		@else	{{ ($total_harga['total_valin'])* ($formula->overage/100) }} @endif
																	</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_Isoleusin!='yes')<input type="checkbox" class="data1" name="Isoleusin" value="yes" id="Isoleusin">
																		@else<input type="checkbox" class="data1" value="yes" checked name="Isoleusin" id="Isoleusin">@endif
																	</td>
																	<td>**Isoleusin</td>
																	<td class="text-right">{{ $total_harga['total_Isoleusin'] }}</td><td class="text-center">mg</td>
																	<td class="text-right"></td><td class="text-right"></td><td class="text-center">mg</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->Isoleusin!='yes'){{ $total_harga['total_Isoleusin'] }}
																		@else	{{ ($total_harga['total_Isoleusin'])* ($formula->overage/100) }} @endif
																	</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_Leusin!='yes')<input type="checkbox" class="data1" name="Leusin" value="yes" id="Leusin">
																		@else<input type="checkbox" class="data1" value="yes" checked name="Leusin" id="Leusin">@endif
																	</td>
																	<td>**Leusin</td>
																	<td class="text-right">{{ $total_harga['total_leusin'] }}</td><td class="text-center">mg</td>
																	<td class="text-right"></td><td class="text-right"></td><td class="text-center">mg</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->overage_Leusin!='yes'){{ $total_harga['total_leusin'] }}
																		@else	{{ ($total_harga['total_leusin'])* ($formula->overage/100) }} @endif
																	</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_Alanin!='yes')<input type="checkbox" class="data1" name="Alanin" value="yes" id="Alanin">
																		@else<input type="checkbox" class="data1" value="yes" checked name="Alanin" id="Alanin">@endif
																	</td>
																	<td>Alanin</td>
																	<td class="text-right">{{ $total_harga['total_alanin'] }}</td><td class="text-center">mg</td>
																	<td class="text-right"></td><td class="text-right"></td><td class="text-center">mg</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->overage_Alanin!='yes'){{ $total_harga['total_alanin'] }}
																		@else	{{ ($total_harga['total_alanin'])* ($formula->overage/100) }} @endif
																	</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_asam_aspartat!='yes')<input type="checkbox" class="data1" name="asam_aspartat" value="yes" id="asam_aspartat">
																		@else<input type="checkbox" class="data1" value="yes" checked name="asam_aspartat" id="asam_aspartat">@endif
																	</td>
																	<td>Asam Aspartat</td>
																	<td class="text-right">{{ $total_harga['total_aspartat'] }}</td><td class="text-center">mg</td>
																	<td class="text-right"></td><td class="text-right"></td><td class="text-center">mg</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->overage_asam_aspartat!='yes'){{ $total_harga['total_aspartat'] }}
																		@else	{{ ($total_harga['total_aspartat'])* ($formula->overage/100) }} @endif
																	</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_asam_glutamat!='yes')<input type="checkbox" class="data1" name="asam_glutamat" value="yes" id="asam_glutamat">
																		@else<input type="checkbox" class="data1" value="yes" checked name="asam_glutamat" id="asam_glutamat">@endif
																	</td>
																	<td>Asam Glutamat</td>
																	<td class="text-right">{{ $total_harga['total_glutamat'] }}</td><td class="text-center">mg</td>
																	<td class="text-right"></td><td class="text-right"></td><td class="text-center">mg</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->overage_asam_glutamat!='yes'){{ $total_harga['total_glutamat'] }}
																		@else	{{ ($total_harga['total_glutamat'])* ($formula->overage/100) }} @endif
																	</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_sistein!='yes')<input type="checkbox" class="data1" name="sistein" value="yes" id="sistein">
																		@else<input type="checkbox" class="data1" value="yes" checked name="sistein" id="sistein">@endif
																	</td>
																	<td>Sistein</td>
																	<td class="text-right">{{ $total_harga['total_sistein'] }}</td><td class="text-center">mg</td>
																	<td class="text-right"></td><td class="text-right"></td><td class="text-center">mg</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->overage_sistein!='yes'){{ $total_harga['total_sistein'] }}
																		@else	{{ ($total_harga['total_sistein'])* ($formula->overage/100) }} @endif
																	</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_serin!='yes')<input type="checkbox" class="data1" name="serin" value="yes" id="serin">
																		@else<input type="checkbox" class="data1" value="yes" checked name="serin" id="serin">@endif
																	</td>
																	<td>Serin</td>
																	<td class="text-right">{{ $total_harga['total_serin'] }}</td><td class="text-center">mg</td>
																	<td class="text-right"></td><td class="text-right"></td><td class="text-center">mg</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->overage_serin!='yes'){{ $total_harga['total_serin'] }}
																		@else	{{ ($total_harga['total_serin'])* ($formula->overage/100) }} @endif
																	</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_glisin!='yes')<input type="checkbox" class="data1" name="glisin" value="yes" id="glisin">
																		@else<input type="checkbox" class="data1" value="yes" checked name="glisin" id="glisin">@endif
																	</td>
																	<td>Glisin</td>
																	<td class="text-right">{{ $total_harga['total_glisin'] }}</td><td class="text-center">mg</td>
																	<td class="text-right"></td><td class="text-right"></td><td class="text-center">mg</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->overage_glisin!='yes'){{ $total_harga['total_glisin'] }}
																		@else	{{ ($total_harga['total_glisin'])* ($formula->overage/100) }} @endif
																	</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_tyrosin!='yes')<input type="checkbox" class="data1" name="tyrosin" value="yes" id="tyrosin">
																		@else<input type="checkbox" class="data1" value="yes" checked name="tyrosin" id="tyrosin">@endif
																	</td>
																	<td>Tyrosin</td>
																	<td class="text-right">{{ $total_harga['total_tyrosin'] }}</td><td class="text-center">mg</td>
																	<td class="text-right"></td><td class="text-right"></td><td class="text-center">mg</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->overage_tyrosin!='yes'){{ $total_harga['total_tyrosin'] }}
																		@else	{{ ($total_harga['total_tyrosin'])* ($formula->overage/100) }} @endif
																	</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_proline!='yes')<input type="checkbox" class="data1" name="proline" value="yes" id="proline">
																		@else<input type="checkbox" class="data1" value="yes" checked name="proline" id="proline">@endif
																	</td>
																	<td>Proline</td>
																	<td class="text-right">{{ $total_harga['total_proline'] }}</td><td class="text-center">mg</td>
																	<td class="text-right"></td><td class="text-right"></td><td class="text-center">mg</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->overage_proline!='yes'){{ $total_harga['total_proline'] }}
																		@else	{{ ($total_harga['total_proline'])* ($formula->overage/100) }} @endif
																	</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_arginine!='yes')<input type="checkbox" class="data1" name="arginine" value="yes" id="arginine">
																		@else<input type="checkbox" class="data1" value="yes" checked name="arginine" id="arginine">@endif
																	</td>
																	<td>Arginine</td>
																	<td class="text-right">{{ $total_harga['total_arginine'] }}</td><td class="text-center">mg</td>
																	<td class="text-right"></td><td class="text-right"></td><td class="text-center">mg</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->overage_arginine!='yes'){{ $total_harga['total_arginine'] }}
																		@else	{{ ($total_harga['total_arginine'])* ($formula->overage/100) }} @endif
																	</td>
																</tr>
																<tr class="" style=" color: black;">
																	<td>
																		@if($akg->overage_air!='yes')<input type="checkbox" class="data1" name="arginine" value="yes" id="arginine">
																		@else<input type="checkbox" class="data1" value="yes" checked name="arginine" id="arginine">@endif
																	</td>
																	<td>Kadar Air</td>
																	<td class="text-right">{{ $total_harga['total_air'] }}</td><td class="text-center">mg</td>
																	<td class="text-right"></td><td class="text-right"></td><td class="text-center">mg</td>
																	<td class="text-right" style="background-color:#d1d1d1;">
																		@if($akg->overage_air!='yes'){{ $total_harga['total_air'] }}
																		@else	{{ ($total_harga['total_air'])* ($formula->overage/100) }} @endif
																	</td>
																</tr>
															</tbody>
															@endforeach
														</table>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Logam berat & Mikro Biologi -->
						<div class="tab-pane" id="3">
							<div class="row">
								<div class="panel">
									<div class="panel-body">    
										<div class="accordion" id="accordionExample">
											<div class="panel panel-info">
												<div aria-labelledby="headingOne" data-parent="#accordionExample"><br> 
													<form class="form-horizontal form-label-left" method="POST" action="{{route('savedosis',$idf)}}">
													{{ csrf_field() }}
													<div style="overflow-x: scroll;">
														@foreach($form as $header)
														<table class="table table-advanced table-bordered" >
															<thead>
																<tr class="text-center" style="font-weight: bold;color:white;background-color: #2a3f54;">
																	<th rowspan="2" class="text-center sticky-col first-col"  class="text-center" style="font-weight: bold;color:white;background-color: #2a3f54;">Nama Sederhana</th>
																	<th rowspan="2" class="text-center sticky-col second-col" style="font-weight: bold;color:white;background-color: #2a3f54;min-width:120px">PerServing (Gram)</th>
																	<th rowspan="2" class="text-center sticky-col third-col" style="font-weight: bold;color:white;background-color: #2a3f54;">%</th>
																	<th rowspan ="2" class="text-center  sticky-col fourth-col" style="font-weight: bold;color:white;background-color: #2a3f54;min-width:100px">Kadar Air</th>
																	<th rowspan ="2" class="text-center" style="font-weight: bold;color:white;background-color: #2a3f54;"></th>
																	<th colspan ="8" class="text-center" style="font-weight: bold;color:white;background-color: #2a3f54;min-width:100px">Mikroba</th>
																	<th colspan ="5" class="text-center" style="font-weight: bold;color:white;background-color: #2a3f54;min-width:100px">Logam Berat</th>
																</tr>
																<tr class="text-center" style="font-weight: bold;color:white;background-color: #7e7d7d;">
																	<!-- Makro -->
																	<th class="text-center" style="min-width:90px">Enterobacter (CFU/g)</th>  	<th class="text-center" style="min-width:90px">Salmonella (CFU/g)</th>
																	<th class="text-center" style="min-width:90px">S.aureus (CFU/g)</th>       <th class="text-center" style="min-width:90px">TPC (CFU/g)</th>
																	<th class="text-center" style="min-width:90px">Yeast/Mold (CFU/g)</th>     <th class="text-center" style="min-width:90px">Coliform (CFU/g)</th>
																	<th class="text-center" style="min-width:90px">E.Coli (CFU/g)</th>     		<th class="text-center" style="min-width:90px">Bacillus cereus(CFU/g)</th>
																	<th class="text-center" style="min-width:90px">As (mg/kg)</th>        			<th class="text-center" style="min-width:90px">Hg (mg/kg)</th>
																	<th class="text-center" style="min-width:90px">Pb (mg/kg)</th>         		<th class="text-center" style="min-width:90px">Sn (mg/kg)</th>
																	<th class="text-center" style="min-width:90px">Cd (mg/kg)</th>     
																</tr>
															</thead>
															<tbody>
																@php $nom = 0; @endphp
																@foreach ($detail_harga->sortByDesc('per_batch') as $fortail)
																<tr class="text-right">
																	<td class="text-left sticky-col first-col">{{ $fortail['nama_sederhana'] }}</td>
																	<input type="number" name="scores[{{$loop->index}}][id]" value="{{ $fortail['id'] }}" hidden>
																	<td class="sticky-col second-col text-center">{{ $fortail['per_serving'] }}</td>
																	<td class="sticky-col third-col text-center">{{ $fortail['persen'] }}</td>
																	<td class="text-center sticky-col fourth-col">{{ $fortail['air'] }}</td>
																	<td></td>
																	<td><?php $Enterobacter = $fortail['Enterobacter']; $angka_Enterobacter = number_format($Enterobacter,2,",","."); echo $angka_Enterobacter; ?></td>
																	<td><?php $Salmonella = $fortail['Salmonella']; $angka_Salmonella = number_format($Salmonella,2,",","."); echo $angka_Salmonella; ?></td>
																	<td><?php $aureus = $fortail['aureus']; $angka_aureus = number_format($aureus,2,",","."); echo $angka_aureus; ?></td>
																	<td><?php $TPC = $fortail['TPC']; $angka_TPC = number_format($TPC,2,",","."); echo $angka_TPC; ?></td>
																	<td><?php $Yeast = $fortail['Yeast']; $angka_Yeast = number_format($Yeast,2,",","."); echo $angka_Yeast; ?></td>
																	<td><?php $Coliform = $fortail['Coliform']; $angka_Coliform = number_format($Coliform,2,",","."); echo $angka_Coliform; ?></td>
																	<td><?php $Coli = $fortail['Coli']; $angka_Coli = number_format($Coli,2,",","."); echo $angka_Coli; ?></td>
																	<td><?php $Bacilluscereus = $fortail['Bacilluscereus']; $angka_Bacilluscereus = number_format($Bacilluscereus,2,",","."); echo $angka_Bacilluscereus; ?></td>
																	<td><?php $as = $fortail['as']; $angka_as = number_format($as,2,",","."); echo $angka_as; ?></td>
																	<td><?php $hg = $fortail['hg']; $angka_hg = number_format($hg,2,",","."); echo $angka_hg; ?></td>
																	<td><?php $pb = $fortail['pb']; $angka_pb = number_format($pb,2,",","."); echo $angka_pb; ?></td>
																	<td><?php $sn = $fortail['sn']; $angka_sn = number_format($sn,2,",","."); echo $angka_sn; ?></td>
																	<td><?php $cd = $fortail['cd']; $angka_cd = number_format($cd,2,",","."); echo $angka_cd; ?></td>
																</tr>  
																@endforeach
																<tr class="text-right" style="font-size:12px;font-weight: bold; color:black;background-color: #ddd;">
																	<td class="text-center sticky-col first-col" style="font-size: 12px;font-weight: bold; color:black;background-color: #ddd;">Total : </td>
																	<td class="text-center sticky-col second-col" style="font-size: 12px;font-weight: bold; color:black;background-color: #ddd;">{{ $formula['serving_size'] }}</td>
																	<td class="text-center sticky-col third-col" style="font-size: 12px;font-weight: bold; color:black;background-color: #ddd;"> 100 </td>
																	<td class="text-center sticky-col fourth-col" style="font-size: 12px;font-weight: bold; color:black;background-color: #ddd;">{{ $total_harga['total_air'] }}</td>
																	<td></td>
																	<td><?php $aureus = $total_harga['total_Enterobacter']; $angka_aureus = number_format($aureus,2,",","."); echo $angka_aureus; ?></td>
																	<td><?php $aureus = $total_harga['total_Salmonella']; $angka_aureus = number_format($aureus,2,",","."); echo $angka_aureus; ?></td>
																	<td><?php $aureus = $total_harga['total_aureus']; $angka_aureus = number_format($aureus,2,",","."); echo $angka_aureus; ?></td>
																	<td><?php $TPC = $total_harga['total_TPC']; $angka_TPC = number_format($TPC,2,",","."); echo $angka_TPC; ?></td>
																	<td><?php $Yeast = $total_harga['total_Yeast']; $angka_Yeast = number_format($Yeast,2,",","."); echo $angka_Yeast; ?></td>
																	<td><?php $Coliform = $total_harga['total_Coliform']; $angka_Coliform = number_format($Coliform,2,",","."); echo $angka_Coliform; ?></td>
																	<td><?php $Coli = $total_harga['total_Coli']; $angka_Coli = number_format($Coli,2,",","."); echo $angka_Coli; ?></td>
																	<td><?php $Bacilluscereus = $total_harga['total_Bacilluscereus']; $angka_Bacilluscereus = number_format($Bacilluscereus,2,",","."); echo $angka_Bacilluscereus; ?></td>
																	<td><?php $as = $total_harga['total_as']; $angka_as = number_format($as,2,",","."); echo $angka_as; ?></td>
																	<td><?php $hg = $total_harga['total_hg']; $angka_hg = number_format($hg,2,",","."); echo $angka_hg; ?></td>
																	<td><?php $pb = $total_harga['total_pb']; $angka_pb = number_format($pb,2,",","."); echo $angka_pb; ?></td>
																	<td><?php $sn = $total_harga['total_sn']; $angka_sn = number_format($sn,2,",","."); echo $angka_sn; ?></td>
																	<td><?php $cd = $total_harga['total_cd']; $angka_cd = number_format($cd,2,",","."); echo $angka_cd; ?></td>
																</tr>
															</tbody>
															<tbody>
																<tr>
																	<th class="text-center sticky-col first-col">Saran penyajian</th>
																	<th class="text-center sticky-col second-col">{{$formula->saran_saji}}</th>
																	<th class="text-center sticky-col third-col">ML</th>
																	<th class="text-center sticky-col fourth-col"></th><th></th><th colspan="7"></th>
																	<th class="text-right" style="font-size: 12px;font-weight: bold; color:white;background-color: #157c16;">RTC</th>
																	<th class="text-right">{{$total_harga['total_rpc_as']}}</th>
																	<th class="text-right">{{$total_harga['total_rpc_hg']}}</th>
																	<th class="text-right">{{$total_harga['total_rpc_pb']}}</th>
																	<th class="text-right">{{$total_harga['total_rpc_sn']}}</th>
																	<th class="text-right">{{$total_harga['total_rpc_cd']}}</th>
																</tr>
																<tr>
																<th  colspan="17">
																</tr>
																<tr>
																	<th class="text-center sticky-col first-col" style="font-size: 12px;font-weight: bold; color:white;background-color: #4f4d4d;" rowspan="2">Number Kategori Pangan</th>
																	<td class="text-center sticky-col second-col" rowspan="2">@if($formula->pangan!=NULL){{$formula->katpang->no_katpang}}@endif</td>
																	<th class="text-center sticky-col third-col" rowspan="2">Batas % Air</th>
																	<th class="text-center sticky-col fourth-col" rowspan="2">
																	@if($formula->pangan!=NULL)<input type="number" readonly class="form-control" value="{{$formula->katpang->batas_air}}" name="batas" id="batas">
																	@else<input type="number" readonly class="form-control" value="" name="batas" id="batas">@endif</th>
																	<th style="font-size: 12px;font-weight: bold; color:white;background-color: #157c16;">m</th>
																	<th class="text-center">@if($formula->pangan!=NULL){{$formula->katpang->mk_Enterobacter}}@endif</th>
																	<th class="text-center">@if($formula->pangan!=NULL){{$formula->katpang->mk_Salmonella}}@endif</th>
																	<th class="text-center">@if($formula->pangan!=NULL){{$formula->katpang->mk_aureus}}@endif</th>
																	<th class="text-center">@if($formula->pangan!=NULL){{$formula->katpang->mk_TPC}}@endif</th>
																	<th class="text-center">@if($formula->pangan!=NULL){{$formula->katpang->mk_Yeast}}@endif</th>
																	<th class="text-center">@if($formula->pangan!=NULL){{$formula->katpang->mk_Coliform}}@endif</th>
																	<th class="text-center">@if($formula->pangan!=NULL){{$formula->katpang->mk_Coli}}@endif</th>
																	<th class="text-center">@if($formula->pangan!=NULL){{$formula->katpang->mk_Bacilluscereus}}@endif</th>
																	<th class="text-center" rowspan="2">@if($formula->pangan!=NULL){{$formula->katpang->as}}@endif</th>
																	<th class="text-center" rowspan="2">@if($formula->pangan!=NULL){{$formula->katpang->hg}}@endif</th>
																	<th class="text-center" rowspan="2">@if($formula->pangan!=NULL){{$formula->katpang->pb}}@endif</th>
																	<th class="text-center" rowspan="2">@if($formula->pangan!=NULL){{$formula->katpang->sn}}@endif</th>
																	<th class="text-center" rowspan="2">@if($formula->pangan!=NULL){{$formula->katpang->cd}}@endif</th>
																</tr>
																<tr>
																	<th class="text-center" style="font-size: 12px;font-weight: bold; color:white;background-color: #157c16;">M</th>
																	<th class="text-center">@if($formula->pangan!=NULL){{$formula->katpang->mb_Enterobacter}}@endif</th>
																	<th class="text-center">@if($formula->pangan!=NULL){{$formula->katpang->mb_Salmonella}}@endif</th>
																	<th class="text-center">@if($formula->pangan!=NULL){{$formula->katpang->mb_aureus}}@endif</th>
																	<th class="text-center">@if($formula->pangan!=NULL){{$formula->katpang->mb_TPC}}@endif</th>
																	<th class="text-center">@if($formula->pangan!=NULL){{$formula->katpang->mb_Yeast}}@endif</th>
																	<th class="text-center">@if($formula->pangan!=NULL){{$formula->katpang->mb_Coliform}}@endif</th>
																	<th class="text-center">@if($formula->pangan!=NULL){{$formula->katpang->mb_Coli}}@endif</th>
																	<th class="text-center">@if($formula->pangan!=NULL){{$formula->katpang->mb_Bacilluscereus}}@endif</th>
																</tr>
																<tr>
																	<th class="text-center sticky-col first-col" colspan="3">Status</th>
																	<th style="background-color: #eff897" class="text-center sticky-col fourth-col">
																	@if($formula->pangan!=NULL)	
																		@if($formula->katpang->batas_air==NULL)
																		@elseif($total_harga['total_air'] >= $formula->katpang->batas_air)OK
																		@elseif($total_harga['total_air'] <= $formula->katpang->batas_air)NOT OK
																		@endif
																	@endif
																	</th>
																	<th></th>
																	<th class="text-center">
																	@if($formula->pangan!=NULL)
																		@if($total_harga['total_Enterobacter'] <= $formula->katpang->mk_Enterobacter && $total_harga['total_Enterobacter'] <= $formula->katpang->mb_Enterobacter && $formula->katpang->mb_Enterobacter!='N/S')OK
																		@elseif($total_harga['total_Enterobacter'] >= $formula->katpang->mk_Enterobacter && $total_harga['total_Enterobacter'] <= $formula->katpang->mb_Enterobacter && $formula->katpang->mb_Enterobacter!='N/S')Lihat N
																		@elseif($total_harga['total_Enterobacter'] >= $formula->katpang->mk_Enterobacter && $total_harga['total_Enterobacter'] >= $formula->katpang->mb_Enterobacter && $formula->katpang->mb_Enterobacter!='N/S' )NOT OK
																		@elseif($formula->katpang->mk_Enterobacter=='N/S' || $formula->katpang->mb_Enterobacter=='N/S')N/S
																		@endif
																	@endif
																	</th>
																	<th class="text-center">
																	@if($formula->pangan!=NULL)
																		@if($total_harga['total_Salmonella'] <= $formula->katpang->mk_Salmonella && $total_harga['total_Salmonella'] <= $formula->katpang->mb_Salmonella && $formula->katpang->mk_Salmonella!='N/S')OK
																		@elseif($total_harga['total_Salmonella'] >= $formula->katpang->mk_Salmonella && $total_harga['total_Salmonella'] <= $formula->katpang->mb_Salmonella && $formula->katpang->mk_Salmonella!='N/S')Lihat N
																		@elseif($total_harga['total_Salmonella'] >= $formula->katpang->mk_Salmonella && $total_harga['total_Salmonella'] >= $formula->katpang->mb_Salmonella && $formula->katpang->mk_Salmonella!='N/S')NOT OK
																		@elseif($formula->katpang->mk_Salmonella=='N/S' || $formula->katpang->mb_Salmonella=='N/S')N/S
																		@endif
																	@endif
																	</th>
																	<th class="text-center">
																	@if($formula->pangan!=NULL)
																		@if($total_harga['total_aureus'] <= $formula->katpang->mk_aureus && $total_harga['total_aureus'] <= $formula->katpang->mb_aureus && $formula->katpang->mb_aureus!='N/S')OK
																		@elseif($total_harga['total_aureus'] >= $formula->katpang->mk_aureus && $total_harga['total_aureus'] <= $formula->katpang->mb_aureus && $formula->katpang->mb_aureus!='N/S')Lihat N
																		@elseif($total_harga['total_aureus'] >= $formula->katpang->mk_aureus && $total_harga['total_aureus'] >= $formula->katpang->mb_aureus && $formula->katpang->mb_aureus!='N/S')NOT OK
																		@elseif($formula->katpang->mk_aureus=='N/S' || $formula->katpang->mb_aureus=='N/S')N/S
																		@endif
																	@endif
																	</th>
																	<th class="text-center">
																	@if($formula->pangan!=NULL)
																		@if($total_harga['total_TPC'] <= $formula->katpang->mk_TPC && $total_harga['total_TPC'] <= $formula->katpang->mb_TPC && $formula->katpang->mb_TPC!='N/S')OK
																		@elseif($total_harga['total_TPC'] >= $formula->katpang->mk_TPC && $total_harga['total_TPC'] <= $formula->katpang->mb_TPC && $formula->katpang->mb_TPC!='N/S')Lihat N
																		@elseif($total_harga['total_TPC'] >= $formula->katpang->mk_TPC && $total_harga['total_TPC'] >= $formula->katpang->mb_TPC && $formula->katpang->mb_TPC!='N/S')NOT OK
																		@elseif($formula->katpang->mk_TPC=='N/S' || $formula->katpang->mb_TPC=='N/S')N/S
																		@endif
																	@endif
																	</th>
																	<th class="text-center">
																	@if($formula->pangan!=NULL)
																		@if($total_harga['total_Yeast'] <= $formula->katpang->mk_Yeast && $total_harga['total_Yeast'] <= $formula->katpang->mb_Yeast && $formula->katpang->mb_Yeast!='N/S' )OK
																		@elseif($total_harga['total_Yeast'] >= $formula->katpang->mk_Yeast && $total_harga['total_Yeast'] <= $formula->katpang->mb_Yeast && $formula->katpang->mb_Yeast!='N/S' )Lihat N
																		@elseif($total_harga['total_Yeast'] >= $formula->katpang->mk_Yeast && $total_harga['total_Yeast'] >= $formula->katpang->mb_Yeast && $formula->katpang->mb_Yeast!='N/S' )NOT OK
																		@elseif($formula->katpang->mk_Yeast=='N/S' || $formula->katpang->mb_Yeast=='N/S')N/S
																		@endif
																	@endif
																	</th>
																	<th class="text-center">
																	@if($formula->pangan!=NULL)
																		@if($total_harga['total_Coliform'] <= $formula->katpang->mk_Coliform && $total_harga['total_Coliform'] <= $formula->katpang->mb_Coliform && $formula->katpang->mb_Coliform!='N/S' )OK
																		@elseif($total_harga['total_Coliform'] >= $formula->katpang->mk_Coliform && $total_harga['total_Coliform'] <= $formula->katpang->mb_Coliform && $formula->katpang->mb_Coliform!='N/S' )Lihat N
																		@elseif($total_harga['total_Coliform'] >= $formula->katpang->mk_Coliform && $total_harga['total_Coliform'] >= $formula->katpang->mb_Coliform && $formula->katpang->mb_Coliform!='N/S' )NOT OK
																		@elseif($formula->katpang->mk_Coliform=='N/S' || $formula->katpang->mb_Coliform=='N/S')N/S
																		@endif
																	@endif
																	</th>
																	<th class="text-center">
																	@if($formula->pangan!=NULL)
																		@if($total_harga['total_Coli'] <= $formula->katpang->mk_Coli && $total_harga['total_Coli'] <= $formula->katpang->mb_Coli && $formula->katpang->mb_Coli!='N/S' )OK
																		@elseif($total_harga['total_Coli'] >= $formula->katpang->mk_Coli && $total_harga['total_Coli'] <= $formula->katpang->mb_Coli && $formula->katpang->mb_Coli!='N/S' )Lihat N
																		@elseif($total_harga['total_Coli'] >= $formula->katpang->mk_Coli && $total_harga['total_Coli'] >= $formula->katpang->mb_Coli && $formula->katpang->mb_Coli!='N/S' )NOT OK
																		@elseif($formula->katpang->mk_Coli=='N/S' || $formula->katpang->mb_Coli=='N/S')N/S
																		@endif
																	@endif
																	</th>
																	<th class="text-center">
																	@if($formula->pangan!=NULL)
																		@if($total_harga['total_Bacilluscereus'] <= $formula->katpang->mk_Bacilluscereus && $total_harga['total_Bacilluscereus'] <= $formula->katpang->mb_Bacilluscereus && $formula->katpang->mb_Bacilluscereus!='N/S')OK
																		@elseif($total_harga['total_Bacilluscereus'] >= $formula->katpang->mk_Bacilluscereus && $total_harga['total_Bacilluscereus'] <= $formula->katpang->mb_Bacilluscereus && $formula->katpang->mb_Bacilluscereus!='N/S' )Lihat N
																		@elseif($total_harga['total_Bacilluscereus'] >= $formula->katpang->mk_Bacilluscereus && $total_harga['total_Bacilluscereus'] >= $formula->katpang->mb_Bacilluscereus && $formula->katpang->mb_Bacilluscereus!='N/S' )NOT OK
																		@elseif($formula->katpang->mk_Bacilluscereus=='N/S' || $formula->katpang->mb_Bacilluscereus=='N/S')N/S
																		@endif
																	@endif
																	</th>
																	<th class="text-center">
																	@if($formula->pangan!=NULL)
																		@if($total_harga['total_rpc_as'] >= $formula->katpang->as)OK
																		@elseif($total_harga['total_rpc_as'] <= $formula->katpang->as)NOT OK
																		@endif
																	@endif
																	</th>
																	<th class="text-center">
																	@if($formula->pangan!=NULL)
																		@if($total_harga['total_rpc_hg'] >= $formula->katpang->hg)OK
																		@elseif($total_harga['total_rpc_hg'] <= $formula->katpang->hg)NOT OK
																		@endif
																	@endif
																	</th>
																	<th class="text-center">
																	@if($formula->pangan!=NULL)
																		@if($total_harga['total_rpc_pb'] >= $formula->katpang->pb)OK
																		@elseif($total_harga['total_rpc_pb'] <= $formula->katpang->pb)NOT OK
																		@endif
																	@endif
																	</th>
																	<th class="text-center">
																	@if($formula->pangan!=NULL)
																		@if($total_harga['total_rpc_sn'] >= $formula->katpang->sn)OK
																		@elseif($total_harga['total_rpc_sn'] <= $formula->katpang->sn)NOT OK
																		@endif
																	@endif
																	</th>
																	<th class="text-center">
																	@if($formula->pangan!=NULL)
																		@if($total_harga['total_rpc_cd'] >= $formula->katpang->cd)OK
																		@elseif($total_harga['total_rpc_cd'] <= $formula->katpang->cd)NOT OK
																		@endif
																	@endif
																	</th>
																</tr>
															</tbody>
														</table>
														@endforeach
														&nbsp
													</div>
													</form>
												</div>
											</div> 
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- HPP -->
						<div class="tab-pane" id="4">
							@php $no = 0; @endphp
							@if ($ada > 0)
							<div class="row">
								<div class="col-md-5">
									<table class="table table-bordered" style="font-size:12px">
										<thead>
											<th colspan="4" style="font-weight: bold;color:white;background-color: #2a3f54;"><center>Bahan Baku</center></th>
										</thead>
										<thead>
											<th>No</th>
											<th>Kode Oracle</th>
											<th>Nama Bahan</th>
											<th>Harga PerGram</th>
										</thead>
										<tbody>
											@foreach ($detail_harga->sortByDesc('harga_per_serving') as $fortail)
											<tr>
												<td>{{ ++$no }}</td>
												<td>{{ $fortail['kode_oracle'] }}</td>
												<td>{{ $fortail['nama_sederhana'] }}</td>
												<td><?php echo"Rp. ". number_format($fortail['hpg'], 2, ",", ".")  ?></td>
											</tr>
											@endforeach
											<tr style="font-weight: bold;color:black;background-color: #ddd;">
												<td colspan="3">Jumlah</td>
												<td><?php echo"Rp. ". number_format($total_harga['total_harga_per_gram'], 2, ",", ".")  ?></td>
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
												<td><?php echo"Rp. ". number_format($fortail['harga_per_serving'], 2, ",", ".")  ?></td>
											</tr>
											@endforeach
											<tr style="font-weight: bold;color:black;background-color: #ddd;">
												<td>{{ $total_harga['total_berat_per_serving'] }}</td>
												<td>{{ $total_harga['total_persen'] }}</td>
												<td><?php echo"Rp. ". number_format($total_harga['total_harga_per_serving'], 2, ",", ".")  ?></td>
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
												<td><?php echo"Rp. ". number_format($fortail['harga_per_batch'], 2, ",", ".")  ?></td>
											</tr>
											@endforeach
											<tr style="font-weight: bold;color:black;background-color: #ddd;">
												<td>{{ $total_harga['total_berat_per_batch'] }}</td>
												<td><?php echo"Rp. ". number_format($total_harga['total_harga_per_batch'], 2, ",", ".")  ?></td>                                                        
											</tr> 
										</tbody>
									</table>
								</div>
								<div class="col-md-2">
									<table class="table table-bordered" style="font-size:12px">
										<thead>
											<th colspan="1" style="font-weight: bold;color:white;background-color: #2a3f54;"><center>Per Kg</center></th>
										</thead>
										<thead>
											<th>Harga</th>
										</thead>
										<tbody>
											@foreach ($detail_harga->sortByDesc('harga_per_serving') as $fortail)
											<tr>
												<td><?php echo"Rp. ". number_format($fortail['harga_per_kg'], 2, ",", ".")  ?></td>
											</tr>
											@endforeach
											<tr style="font-weight: bold;color:black;background-color: #ddd;">
												<td><?php echo"Rp. ". number_format($total_harga['total_harga_per_kg'], 2, ",", ".")  ?></td>
											</tr> 
										</tbody>
									</table>
								</div>
							</div>
							@endif
						</div>
						<!-- Panel -->
						<div class="tab-pane" id="5">
							<h4><i class="fa fa-angle-right"></i> PANEL</h4>
							<div class="row">
								<div class="col-md-12">
									<table class="table table-bordered" style="font-size:12px">
										<thead>
											<tr  style="font-weight: bold;color:white;background-color: #2a3f54;">
												<th class="text-center" width="5%">No</th>
												<th class="text-center">Panel</th>
												<th class="text-center">Tanggal Panel</th>
												<th class="text-center">HUS</th>
												<th class="text-center">Note</th>
											</tr>
										</thead>
										<tbody>
											@php $no = 0; @endphp
											@foreach ($panel as $value)
											<tr>
												<td>{{ ++$no }}</td>
												<td>{{ $value->panel }}</td>
												<td>{{ $value->tgl_panel }}</td>
												<td>{{ $value->hus }}</td>
												<td>{{ $value->kesimpulan }}</td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<!-- Storage -->
						<div class="tab-pane" id="6">
							<h4><i class="fa fa-angle-right"></i> Storage</h4>
							<div class="row">
								<div class="col-md-12">
									<table class="table table-bordered" style="font-size:12px">
										<thead>
											<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
												<th class="text-center" width="5%">No</th>
												<th class="text-center">No PST</th>
												<th class="text-center">Suhu</th>
												<th class="text-center">Estimasi Selesai</th>
												<th class="text-center">No HSA</th>
												<th class="text-center">Kesimpulan</th>
												<th class="text-center">Tanggal Selesai</th>
												<th class="text-center">File</th>
											</tr>
										</thead>
										<tbody>
											@php $no = 0; @endphp
											@foreach ($storage as $value)
											<tr>
											<td class="text-center" width="3%">{{ ++$no }}</td>
											<td>{{ $value->no_PST }}</td>
											<td>{{ $value->suhu }}</td>
											<td>{{ $value->estimasi_selesai }}</td>
											<td>{{ $value->no_HSA }}</td>
											<td>{{ $value->keterangan }}</td>
											<td>{{ $value->selesai }}</td>
											<td>
												<table>
													<tr>
														<td>@if($value->data_file!=NULL)<a href="{{asset('data_file/'.$value->data_file)}}" download="{{$value->data_file}}" title="download file"><button class="btn btn-primary btn-sm"><li class="fa fa-download"></li></button></a>@endif</td>
														<td> {{ $value->data_file }}</td>
													</tr>
												</table>
											</td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<!-- FILE -->
						<div class="tab-pane" id="7">
							<div class="row">
								<div class="col-md-12">
									<table class="table table-bordered">
										<thead>
											<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
												<th class="text-center">File</th>
												<th class="text-center">Download</th>
											</tr>
										</thead>
										<tbody>
											@foreach($file as $data)
											<tr>
												<td> {{$data->file}}</td>
												<td><a href="{{asset('data_file/'.$data->file)}}" download="{{$data->file}}" title="download file"><button class="btn btn-primary btn-sm"><li class="fa fa-download"></li></button></a></td>
											</tr>
											@endforeach
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
@endsection
@section('s')
<script>
	$(function() {
		$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
			localStorage.setItem('lastTab', $(this).attr('href'));
		});
		var lastTab = localStorage.getItem('lastTab');
		if (lastTab) {
			$('[href="' + lastTab + '"]').tab('show');
		}
	});
</script>

<script>
  // PKP
  $("#checkAllpkp1").change(function () {
    $(".data1").prop('checked', $(this).prop("checked"));
  });
  // Header ALl
  $("#checkbahan").change(function () {
    $(".data1").prop('checked', $(this).prop("checked"));
  });
  // Header makro
  $("#checkmakro").change(function () {
    $(".makro").prop('checked', $(this).prop("checked"));
  });
  // Header vitamin
  $("#checkvitamin").change(function () {
    $(".vitamin").prop('checked', $(this).prop("checked"));
  });
  // Header mineral
  $("#checkmineral").change(function () {
    $(".mineral").prop('checked', $(this).prop("checked"));
  });
  // Header asam
  $("#checkasam").change(function () {
    $(".asam").prop('checked', $(this).prop("checked"));
  });
  // Bahan
  $("#bahan2").change(function () {
    $(".cekbox1").prop('checked', $(this).prop("checked"));
  });
</script>
@endsection