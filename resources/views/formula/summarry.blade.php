@extends('pv.tempvv')
@section('title', 'PRODEV|Summarry Formula')
@section('content')

<div class="row">
  <div class="col-md-4"></div>
  <div class="col-md-7">
    <div class="tabbable">
      <ul class="nav nav-tabs wizard">
        @if($formula->workbook_id!=NULL)
        <li class="active"><a href="{{ route('step1',[ $idfor, $idf]) }}"><span class="nmbr">1</span>Information</a></li>
        <li class="active"><a href="{{ route('step2',[ $idfor, $idf]) }}"><span class="nmbr">2</span>Penyusunan</a></li>
        <li class="completed"><a href="{{ route('summarry',[ $idfor, $idf]) }}"><span class="nmbr">3</span>Summary</a></li>
        @elseif($formula->workbook_pdf_id!=NULL)
        <li class="active"><a href="{{ route('step1_pdf',[ $idfor_pdf, $idf]) }}"><span class="nmbr">1</span>Information</a></li>
        <li class="active"><a href="{{ route('step2',[ $idfor_pdf, $idf]) }}"><span class="nmbr">2</span>Penyusunan</a></li>
        <li class="completed"><a href="{{ route('summarry',[ $idfor_pdf, $idf]) }}"><span class="nmbr">3</span>Summary</a></li>
        @endif
      </ul>
    </div>
  </div>
</div>

<div class="x_panel">
  <div class="x_title">
    <h3><li class="fa fa-wpforms"> Summary Formula</h3>
  </div>
  <div class="row">
    <div class="col-md-4">
      <table>
				@if($formula->workbook_id!=NULL)
        <tr><td>Nama Produk</td><td>&nbsp; : {{ $formula->Workbook->datapkpp->project_name }}</td></tr>
				<tr><td>No.PKP</td><td>&nbsp; : {{ $formula->Workbook->datapkpp->pkp_number }}{{$formula->Workbook->datapkpp->ket_no}}</td></tr>
        <tr><td>Perevisi</td><td>&nbsp; : {{ $formula->workbook->perevisi2->name }} </td></tr>
				@elseif($formula->workbook_pdf_id!=NULL)
        <tr><td>Nama Produk</td><td>&nbsp; : {{ $formula->Workbook_pdf->datapdf->project_name }}</td></tr>
				<tr><td>No.PKP</td><td>&nbsp; : {{ $formula->Workbook_pdf->datapdf->pdf_number }}{{$formula->Workbook_pdf->datapdf->ket_no}}</td></tr>
        <tr><td>Perevisi</td><td>&nbsp; : {{ $formula->Workbook_pdf->perevisi2->name }} </td></tr>
				@endif
        <tr><td>Versi</td><td>&nbsp; : {{ $formula->versi }}.{{ $formula->turunan }}</td></tr>
      </table>
    </div>
    <div class="col-md-3">
      <table>
        <tr><td>Jumlah Batch</td><td>&nbsp; : {{ $formula->batch }} &nbsp;Gram</td></tr>
        <tr><td>Jumlah Serving</td><td>&nbsp; : {{ $formula->serving }} &nbsp;Gram</td></tr>
      </table>
    </div>
    <div class="col-md-2"></div>
    <div class="col-md-3">
			@if($formula->workbook_id!=NULL)
      	<a class="btn btn-warning btn-sm" href="{{ route('FOR_pkp',$formula->id) }}"><i class="fa fa-download"></i> Download FOR</a>
				@if(auth()->user()->role->namaRule == 'manager')
				<a class="btn btn-danger btn-sm" href="{{ route('daftarpkp',$formula->workbook_id) }}"><i class="fa fa-ban"></i> Back To Workbook</a>
				@elseif(auth()->user()->role->namaRule == 'user_produk')
				<a class="btn btn-danger btn-sm" href="{{ route('rekappkp',$formula->workbook_id) }}"><i class="fa fa-ban"></i> Back To Workbook</a>
				@endif
			@elseif($formula->workbook_pdf_id!=NULL)
      	<a class="btn btn-warning btn-sm" href="{{ route('FOR_pdf',$formula->id) }}"><i class="fa fa-download"></i> Download FOR</a>
				@if(auth()->user()->role->namaRule == 'manager')
				<a class="btn btn-danger btn-sm" href="{{ route('daftarpdf',$formula->workbook_pdf_id) }}"><i class="fa fa-ban"></i> Back To Workbook</a>
				@elseif(auth()->user()->role->namaRule == 'user_produk')
				<a class="btn btn-danger btn-sm" href="{{ route('rekappdf',$formula->workbook_pdf_id) }}"><i class="fa fa-ban"></i> Back To Workbook</a>
				@endif
			@endif
    </div>
  </div>

  <div class="row" style="margin:20px">
		<div id="exTab2" class="container">	
			<ul class="nav nav-tabs  tabs" role="tablist">
				<li class="nav-item"><a class="nav-link  active" href="#1" data-toggle="tab"><i class="fa fa-list"></i> Formula</a></li>
				<li class="nav-item"><a class="nav-link" href="#2" data-toggle="tab"><i class="fa fa-clipboard"></i> Nutfact</a></li>
				<li class="nav-item"><a class="nav-link" href="#3" data-toggle="tab"><i class="fa fa-usd"></i> HPP Formula</a></li>
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
											<th class="text-center" style="width:20%">Nama Bahan</th>
											<th class="text-center" style="width:25%">Principle</th>
											<th class="text-center" style="width:8%">PerServing (gr)</th>
											<th class="text-center" style="width:8%">PerBatch (gr)</th>
											<th class="text-center" style="width:5%">Persen</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($detail_formula->sortByDesc('per_batch') as $fortail)
										@if ($fortail['granulasi'] == 'tidak' && $fortail['premix'] == 'tidak')
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
											<td colspan="4">Jumlah</td>
											<td>{{ $formula->serving }}</td>
											<td>{{ $formula->batch }}</td>
											<td> 100 % </td>
										</tr>
									</tbody>
								</table>
									
								<div class="row">
									<div class="col-md-12">
										<label class="control-label col-md-2 col-sm-2 col-xs-12">Note Formula</label>
										<div class="col-md-9 col-sm-9 col-xs-12">
											<textarea name="formula" id="formula" disabled value="{{ $formula->note_formula }}" class="col-md-12 col-sm-12 col-xs-12" rows="3">{{ $formula->note_formula }}</textarea>
										</div>
									</div>
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
					<!-- Nutfact -->
					<div class="tab-pane" id="2">
						<div class="row">
							<div class="panel">
								<div class="panel-body">    
									<div class="accordion" id="accordionExample">
										<div class="panel panel-info">
											<div aria-labelledby="headingOne" data-parent="#accordionExample">
												<div class="panel-body" style="overflow-x: scroll;">
													<table class="table table-advanced table-bordered">
														<thead>
															<tr>
																<th rowspan="2"  class="text-center" style="font-weight: bold;color:white;background-color: #2a3f54;">Nama Sederhana</th>
																<th rowspan="2"  class="text-center" style="font-weight: bold;color:white;background-color: #2a3f54;" width="20%">Data_BTP_CarryOver_Bahan_Baku</th>
																<th rowspan="2"  class="text-center" style="font-weight: bold;color:white;background-color: #2a3f54;">Dosis</th>
																<th rowspan="2"  class="text-center" style="font-weight: bold;color:white;background-color: #2a3f54;">%</th>
																<th colspan="66" class="text-center" style="font-size: 12px;font-weight: bold; color:black;background-color: #898686;">Nutrition Data</th>
															</tr>
															<tr class="text-center" style="font-weight: bold;color:white;background-color: #2a3f54;">
																<!-- Makro -->
																<th >Karbohidrat</th>  <th >Glukosa</th>
																<th >Serat</th>        <th >Beta</th>
																<th >Sorbitol</th>     <th >Maltitol</th>
																<th >Laktosa</th>      <th >Sukrosa</th>
																<th >Gula</th>         <th >Erythritol</th>
																<th >DHA</th>          <th >EPA</th>
																<th >Omega3</th>      <th >MUFA</th>
																<th >Lemak Trans</th>  <th >Lemak Jenuh</th>
																<th >SFA</th>          <th >Omega6</th>
																<th >Kolestrol</th>    <th >Protein</th>
																<th >Kadar Air</th>
																<!-- Mineral -->
																<th >Ca (mg)</th>      <th >Mg (mg)</th>
																<th >K (mg)</th>       <th >Zink</th>
																<th >P (mg)</th>       <th >Na (mg)</th>
																<th >NaCi</th>         <th >Energi</th>
																<th >Fosfor</th>       <th >Mn</th>
																<th >Cr(mcg)</th>      <th >Fe</th>
																<!-- Vitamin -->
																<th >VitA (mg)</th>   <th >VitB1 (mg)</th>
																<th >VitB2 (mg)</th>  <th >VitB3 (mg)</th>
																<th >VitB5 (mg)</th>  <th >VitB6 (mg)</th>
																<th >VitB12 (mg)</th> <th >VitC (mg)</th>
																<th >VitD (mg)</th>   <th >VitE (mg)</th>
																<th >VitK (mg)</th>   <th >Folat</th>
																<th >Biotin</th>       <th >Kolin </th>
																<!-- asam amino -->
																<th >L-Glutamine</th>  <th >Methionin</th>
																<th >Histidin</th>     <th >BCAA</th>
																<th >Leusin</th>       <th >Aspartat</th>
																<th >Serin</th>        <th >Glutamat</th>
																<th >Arginine</th>     <th >Isoleusin</th>
																<th >Threonin</th>     <th >Phenilalanin</th>
																<th >Lisin</th>        <th >Valin</th>
																<th >Sistein</th>      <th >Alanin</th>
																<th >Glisin</th>       <th >Tyrosin</th>
																<th >Proline</th>
															</tr>
														</thead>
														<tbody>
															@php $no = 0; @endphp
															@foreach ($detail_harga->sortByDesc('per_batch') as $fortail)
															<tr>
																<td>{{ $fortail['nama_sederhana'] }}</td>
																<td style="width:120px">@if( $fortail['hitung_btp'] !=NULL)@foreach($carryover as $co)@if($fortail['bahan']==$co->id_bahan) {{ $co->btp }}/@endif @endforeach @endif</td>
																<td>{{ $fortail['per_serving'] }}</td>
																<td>{{ $fortail['persen'] }}</td>
																<td>{{ $fortail['karbohidrat'] }}</td>
																<td>{{ $fortail['glukosa'] }}</td>
																<td>{{ $fortail['serat'] }}</td>
																<td>{{ $fortail['beta'] }}</td>
																<td>{{ $fortail['sorbitol'] }}</td>
																<td>{{ $fortail['maltitol'] }}</td>
																<td>{{ $fortail['laktosa'] }}</td>
																<td>{{ $fortail['sukrosa'] }}</td>
																<td>{{ $fortail['gula'] }}</td>
																<td>{{ $fortail['erythritol'] }}</td>
																<td>{{ $fortail['dha'] }}</td>
																<td>{{ $fortail['epa'] }}</td>
																<td>{{ $fortail['omega3'] }}</td>
																<td>{{ $fortail['mufa'] }}</td>
																<td>{{ $fortail['lemak_trans'] }}</td>
																<td>{{ $fortail['lemak_jenuh'] }}</td>
																<td>{{ $fortail['sfa'] }}</td>
																<td>{{ $fortail['omega6'] }}</td>
																<td>{{ $fortail['kolestrol'] }}</td>
																<td>{{ $fortail['protein'] }}</td>
																<td>{{ $fortail['air'] }}</td>

																<td>{{ $fortail['ca'] }}</td>
																<td>{{ $fortail['mg'] }}</td>
																<td>{{ $fortail['k'] }}</td>
																<td>{{ $fortail['zink'] }}</td>
																<td>{{ $fortail['p'] }}</td>
																<td>{{ $fortail['na'] }}</td>
																<td>{{ $fortail['naci'] }}</td>
																<td>{{ $fortail['energi'] }}</td>
																<td>{{ $fortail['fosfor'] }}</td>
																<td>{{ $fortail['mn'] }}</td>
																<td>{{ $fortail['cr'] }}</td>
																<td>{{ $fortail['fe'] }}</td>

																<td>{{ $fortail['vitA'] }}</td>
																<td>{{ $fortail['vitB1'] }}</td>
																<td>{{ $fortail['vitB2'] }}</td>
																<td>{{ $fortail['vitB3'] }}</td>
																<td>{{ $fortail['vitB5'] }}</td>
																<td>{{ $fortail['vitB6'] }}</td>
																<td>{{ $fortail['vitB12'] }}</td>
																<td>{{ $fortail['vitC'] }}</td>
																<td>{{ $fortail['vitD'] }}</td>
																<td>{{ $fortail['vitE'] }}</td>
																<td>{{ $fortail['vitK'] }}</td>
																<td>{{ $fortail['folat'] }}</td>
																<td>{{ $fortail['biotin'] }}</td>
																<td>{{ $fortail['kolin'] }}</td>

																<td>{{ $fortail['l_glutamine'] }}</td>
																<td>{{ $fortail['threonin'] }}</td>
																<td>{{ $fortail['methionin'] }}</td>
																<td>{{ $fortail['phenilalanin'] }}</td>
																<td>{{ $fortail['histidin'] }}</td>
																<td>{{ $fortail['lisin'] }}</td>
																<td>{{ $fortail['BCAA'] }}</td>
																<td>{{ $fortail['valin'] }}</td>
																<td>{{ $fortail['leusin'] }}</td>
																<td>{{ $fortail['sistein'] }}</td>
																<td>{{ $fortail['aspartat'] }}</td>
																<td>{{ $fortail['alanin'] }}</td>
																<td>{{ $fortail['serin'] }}</td>
																<td>{{ $fortail['glisin'] }}</td>
																<td>{{ $fortail['glutamat'] }}</td>
																<td>{{ $fortail['tyrosin'] }}</td>
																<td>{{ $fortail['arginine'] }}</td>
																<td>{{ $fortail['proline'] }}</td>
																<td>{{ $fortail['Isoleusin'] }}</td>
																
															</tr>  
															@endforeach
															<tr style="font-size: 12px;font-weight: bold; color:black;background-color: #ddd;">
																<td colspan="2" class="text-center">Total : </td>
																<td>{{ $formula->serving }}</td>
																<td> 100 </td>
																<td>{{ $total_harga['total_karbohidrat'] }}</td>
																<td>{{ $total_harga['total_glukosa'] }}</td>
																<td>{{ $total_harga['total_serat'] }}</td>
																<td>{{ $total_harga['total_beta'] }}</td>
																<td>{{ $total_harga['total_sorbitol'] }}</td>
																<td>{{ $total_harga['total_maltitol'] }}</td>
																<td>{{ $total_harga['total_laktosa'] }}</td>
																<td>{{ $total_harga['total_sukrosa'] }}</td>
																<td>{{ $total_harga['total_gula'] }}</td>
																<td>{{ $total_harga['total_erythritol'] }}</td>
																<td>{{ $total_harga['total_dha'] }}</td>
																<td>{{ $total_harga['total_epa'] }}</td>
																<td>{{ $total_harga['total_omega3'] }}</td>
																<td>{{ $total_harga['total_mufa'] }}</td>
																<td>{{ $total_harga['total_lemak_trans'] }}</td>
																<td>{{ $total_harga['total_lemak_jenuh'] }}</td>
																<td>{{ $total_harga['total_sfa'] }}</td>
																<td>{{ $total_harga['total_omega6'] }}</td>
																<td>{{ $total_harga['total_kolestrol'] }}</td>
																<td>{{ $total_harga['total_protein'] }}</td>
																<td>{{ $total_harga['total_air'] }}</td>

																<td>{{ $total_harga['total_ca'] }}</td>
																<td>{{ $total_harga['total_mg'] }}</td>
																<td>{{ $total_harga['total_k'] }}</td>
																<td>{{ $total_harga['total_zink'] }}</td>
																<td>{{ $total_harga['total_p'] }}</td>
																<td>{{ $total_harga['total_na'] }}</td>
																<td>{{ $total_harga['total_naci'] }}</td>
																<td>{{ $total_harga['total_energi'] }}</td>
																<td>{{ $total_harga['total_fosfor']}}</td>
																<td>{{ $total_harga['total_mn']}}</td>
																<td>{{ $total_harga['total_cr'] }}</td>
																<td>{{ $total_harga['total_fe'] }}</td>

																<td>{{ $total_harga['total_vitA'] }}</td>
																<td>{{ $total_harga['total_vitB1'] }}</td>
																<td>{{ $total_harga['total_vitB2'] }}</td>	
																<td>{{ $total_harga['total_vitB3'] }}</td>
																<td>{{ $total_harga['total_vitB5'] }}</td>
																<td>{{ $total_harga['total_vitB6'] }}</td>
																<td>{{ $total_harga['total_vitB12'] }}</td>
																<td>{{ $total_harga['total_vitC'] }}</td>
																<td>{{ $total_harga['total_vitD'] }}</td>
																<td>{{ $total_harga['total_vitE'] }}</td>
																<td>{{ $total_harga['total_vitK'] }}</td>
																<td>{{ $total_harga['total_folat'] }}</td>
																<td>{{ $total_harga['total_biotin'] }}</td>
																<td>{{ $total_harga['total_kolin'] }}</td>
																
																<td>{{ $total_harga['total_l_glutamine'] }}</td>
																<td>{{ $total_harga['total_threonin'] }}</td>
																<td>{{ $total_harga['total_methionin'] }}</td>	
																<td>{{ $total_harga['total_phenilalanin'] }}</td>
																<td>{{ $total_harga['total_histidin'] }}</td>
																<td>{{ $total_harga['total_lisin'] }}</td>
																<td>{{ $total_harga['total_BCAA'] }}</td>
																<td>{{ $total_harga['total_valin'] }}</td>
																<td>{{ $total_harga['total_leusin'] }}</td>
																<td>{{ $total_harga['total_aspartat'] }}</td>
																<td>{{ $total_harga['total_alanin'] }}</td>
																<td>{{ $total_harga['total_sistein'] }}</td>
																<td>{{ $total_harga['total_serin'] }}</td>
																<td>{{ $total_harga['total_glisin'] }}</td>
																<td>{{ $total_harga['total_glutamat'] }}</td>
																<td>{{ $total_harga['total_tyrosin'] }}</td>
																<td>{{ $total_harga['total_proline'] }}</td>
																<td>{{ $total_harga['total_arginine'] }}</td>
																<td>{{ $total_harga['total_Isoleusin'] }}</td>
															</tr>
														</tbody>
													</table>
												</div>
											</div>
										</div> 

										<div aria-labelledby="headingTwo" data-parent="#accordionExample">
											<div class="panel-body">
												<div class="col-md-6">
													<div class="form-group row">
														<form class="form-horizontal form-label-left" method="POST" action="{{ route('overage',$formula->id) }}">
														<label class="control-label col-md-2 col-sm-2 col-xs-12">Overage</label>
														<div class="col-md-5 col-sm-5 col-xs-12">
															<input type="number" name="overage" min="0" value="{{$formula->overage}}" class="form-control" required>
														</div>
														<label class="control-label col-md-1 col-sm-1 col-xs-12">%</label>
														<button class="btn btn-primary btn-sm" type="submit"><li class="fa fa-check"></li></button>
														{{ csrf_field() }}
													</div>
                          <label><input type="checkbox" class="data1" id="checkAllpkp1"/> Check all</label>
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
																<td class="text-right">{{ $total_harga['total_lemak_trans']*9 }}</td><td class="text-center">kkal</td>
																<td class="text-right">NA</td><td class="text-right">NA</td><td class="text-center">kkal</td>
																<td class="text-right" style="background-color:#d1d1d1;">
																	@if($akg->overage_energi_lemak!='yes'){{ $total_harga['total_lemak_trans']*9 }}
																	@else {{ ($total_harga['total_lemak_trans']*9) * ($formula->overage/100) }} @endif
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
																<td class="text-right">{{ $total_harga['total_lemak_trans'] }}</td><td class="text-center">g</td>
																<td class="text-right">NA</td><td class="text-right">{{$akg->lemak_total}}</td><td class="text-center">g</td>
																<td class="text-right" style="background-color:#d1d1d1;">
																	@if($akg->overage_lemak_total!='yes') {{ $total_harga['total_lemak_trans'] }}
																	@else {{ $total_harga['total_lemak_trans'] * ($formula->overage/100) }} @endif
																</td>
															</tr>
															<tr class="" style=" color: black;">
																<td>
																	@if($akg->overage_lemak_jenuh!='yes')<input type="checkbox" class="data1" name="lemak_jenuh" value="yes" id="lemak_jenuh">
																	@else<input type="checkbox" class="data1" value="yes" checked name="lemak_jenuh" id="lemak_jenuh">@endif
																</td>
																<td>Lemak Jenuh</td>
																<td class="text-right">{{ $total_harga['total_sfa'] }}</td><td class="text-center">g</td>
																<td class="text-right"><?php $sfa = $total_harga['total_sfa']*($akg->lemak_jenuh/100); $angka_sfa = number_format($sfa,2,",","."); echo $angka_sfa; ?></td>
																<td class="text-right">{{$akg->lemak_jenuh}}</td><td class="text-center">g</td>
																<td class="text-right" style="background-color:#d1d1d1;">
																	@if($akg->overage_lemak_jenuh!='yes') {{ $total_harga['total_sfa'] }}
																	@else {{ $total_harga['total_sfa'] * ($formula->overage/100) }} @endif
																</td>
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
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- HPP -->
					<div class="tab-pane" id="3">
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

@endsection
@section('s')
<script>
  // PKP
  $("#checkAllpkp1").change(function () {
    $(".data1").prop('checked', $(this).prop("checked"));
  });
</script>
@endsection