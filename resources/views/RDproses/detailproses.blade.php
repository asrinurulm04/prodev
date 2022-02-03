@extends('layout.tempvv')
@section('title', 'feasibility|Kemas')
@section('judulnya', 'List Feasibility')
@section('content')

<div class="x_panel">
  <div class="col-md-6"><h4><li class="fa fa-cogs"></li> Detail Proses </h4></div>
  <div class="col-md-6" align="right">
		@if($fs->id_project != '')
		<a href="{{ route('listPkpFs',[$pkp->id_project])}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-arrow-left"></li> Back</a>
		@elseif($fs->id_project_pdf != '')
		<a href="{{ route('listPdfFs',[$pdf->pdf_id])}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-arrow-left"></li> Back</a>
		@endif
	</div><br><br><hr>
  <div class="card-block">
    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
		  <li class="nav-item"><a class="nav-link active"href="#1" data-toggle="tab" aria-expanded="true">Data Mesin</a></li>
		  <li class="nav-item"><a class="nav-link" href="#tab_content3" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Data OH</a></li>
		  <li class="nav-item"><a class="nav-link" href="#tab_content4" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Allergen Lini</a></li>
    </ul>
		<div id="myTabContent" class="tab-content"><br>
			<!-- Data Mesin -->
			<div class="tab-pane active" id="1">
				<div class="panel panel-default">			
					<div class="panel-body badan">
						<table class="table table-hover table-bordered">
							<thead>
								<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
									<th></th>
									<th class="text-center" width="30%">Mesin</th>
            			<th class="text-center" width="15%">Runtime (menit/batch granulasi)</th>
									<th class="text-center" width="20%">Runtime (menit/batch)</th>
									<th class="text-center" width="35%">Note</th>
								</tr>
							</thead>
							<tbody>
								@php $nom = 0; @endphp
								@foreach($Mdata as $dM)
								@php ++$nom; @endphp
								<tr id="row{{$dM->id_mesin}}">
									<td>{{$nom}}</td>
									<td>{{ $dM->nama_mesin }}</td>
									<td>{{ $dM->runtime_granulasi }} Menit</td>
									<td>{{ $dM->runtime }} Menit</td>
									<td>{{ $dM->note }}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Data Oh -->
			<div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
				<div class="panel panel-default">
					<div class="panel-body badan">
						<table id="tabledata" class="table table-striped table-bordered nowrap">
							<thead>
								<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
									<th class="text-center">#</th>
									<th width="30%" class="text-center">Informasi Biaya Lain-Lain</th>
									<th width="10%" class="text-center">Curren</th>
									<th width="17%" class="text-center">Nominal</th>
									<th width="35%" class="text-center">Note</th>
								</tr>
							</thead>
							<tbody>
								@php $no = 0; @endphp
								@foreach($dataO as $dO)
								@php ++$no; @endphp
								<tr>
									<td class="text-center">{{$no}}</td>
									<td>{{$dO->mesin}}</td>
									<td>{{$dO->Curren}}</td>
									<td>{{$dO->nominal}}</td>
									<td>{{$dO->note}}</td
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>  
			<!-- Allergergen -->
			<div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="profile-tab">
				<div class="panel panel-default">			
					<div class="panel-body badan">
						<div class="x_panel">
							<div class="x_title">
								<h3><li class="fa fa-list"> Alergen</li></h3>
							</div>
							<br>
							<table class="table table-bordered">
								<thead>
									<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
										<th colspan="7" class="text-center">HASIL REVIEW PENCANTUMAN ALERGEN PADA PRODUK</th>
									</tr>
									<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
										<th colspan="3" class="text-center">Alergen di Produk</th>
										<th colspan="3" class="text-center">Alergen Baru Lini Proses</th>
										<th rowspan="2" width="15%" class="text-center">No Reference</th>
									</tr>
									</tr>
									<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
										<th width="15%" class="text-center">Alergen Contain Dari BB</th>
										<th width="15%" class="text-center">Sumber BB Alergen Contain</th>
										<th width="15%" class="text-center">Alergen May Contain Dari Lini</th>
										<th width="15%" class="text-center">Alergen Baru</th>
										<th width="15%" class="text-center">Lini yang Terdampak</th>
										<th width="15%" class="text-center">Note</th>
								</thead>
								<tbody>
									<td width="15%">
										@if($all!=NULL)
											@foreach($all as $all)
												- {{$all->allergen_countain}} <br>
											@endforeach
										@endif
									</td>
									<td width="15%">
										@if($bahan!=NULL)
											@foreach($bahan as $bahan)
												* {{$bahan->bb->nama_bahan}} <br>
											@endforeach
										@endif
									</td>
									<td>{{$lini->my_contain}}</td>
									<td>{{$lini->allergen_baru}}</td>
									<td>{{$lini->lini_terdampak}}</td>
									<td>{{$lini->catatan}}</td>
									<td>{{$lini->no_ref}}</td>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>  
		</div>
  </div>
</div>
@endsection