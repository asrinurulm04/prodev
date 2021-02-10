@extends('pv.tempvv')
@section('title', 'PRODEV|Report Notulen')
@section('content')

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
			<div class="x_title">
				<h3><li class="fa fa-edit"></li>Report Notulen</h3>
			</div>
			<div class="" style="overflow-x: scroll;">
        <div class="container"> 
          <section id="fancyTabWidget" class="tabs t-tabs">
						<ul class="nav nav-tabs fancyTabs" role="tablist">
							<li class="tab fancyTab active col-md-4 col-sm-12 col-xs-12">
								<div style="font-weight: bold;color:white;background-color: #2a3f54;" class="arrow-down"><div class="arrow-down-inner"></div></div>	
									<a id="tab0" href="#tabBody0" role="tab" aria-controls="tabBody0" style="font-weight: bold;color:white;background-color: #2a3f54;" aria-selected="true" data-toggle="tab" tabindex="0"><span class="hidden-xs"> PKP</span></a>
								<div class="whiteBlock"></div>
							</li>
										
							<li class="tab fancyTab col-md-4 col-sm-12 col-xs-12">
								<div class="arrow-down" style="font-weight: bold;color:white;background-color: #2a3f54;"><div class="arrow-down-inner"></div></div>
									<a id="tab1" style="font-weight: bold;color:white;background-color: #2a3f54;" href="#tabBody1" role="tab" aria-controls="tabBody1" aria-selected="true" data-toggle="tab" tabindex="0"><span class="hidden-xs"> PDF</span></a>
								<div class="whiteBlock"></div>
							</li>
										
							<li class="tab fancyTab col-md-4 col-sm-12 col-xs-12">
								<div class="arrow-down" style="font-weight: bold;color:white;background-color: #2a3f54;"><div class="arrow-down-inner"></div></div>
									<a id="tab2" style="font-weight: bold;color:white;background-color: #2a3f54;" href="#tabBody2" role="tab" aria-controls="tabBody2" aria-selected="true" data-toggle="tab" tabindex="0"><span class="hidden-xs"> PKP Promo</span></a>
								<div class="whiteBlock"></div>
							</li>
						</ul>
						<div id="myTabContent" class="tab-content fancyTabContent" aria-live="polite">
							<!-- PKP Pengajuan -->
							<div class="tab-pane  fade active in" id="tabBody0" role="tabpanel" aria-labelledby="tab0" aria-hidden="false" tabindex="0">
								<div>
									<div class="row">
										<div class="col-md-12">
											<table id="datatable" class="table table-striped table-bordered" style="width:100%">
												<thead>
													<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
														<td class="text-center" width="5%">No</td>
														<td class="text-center">Brand</td>
														<th class="text-center">NO.PKP</th>
														<th class="text-center">Launch Deadline</th>
														@foreach($Npkp as $npkp)
														<th class="text-center" width="40%">Meeting {{$npkp->created_date}}</th>
														@endforeach
													</tr>
												</thead>
												<tbody>
													@php $no = 0; @endphp
													@foreach ($DNpkp as $dnpkp)
													@if($dnpkp->pkp->prioritas=='1')
													<tr style="background-color:#a1d6e2">
													@elseif($dnpkp->pkp->prioritas=='2')
													<tr style="background-color:#bcbabe">
													@elseif($dnpkp->pkp->prioritas=='3')
													<tr style="background-color:#f1f1f2">
													@endif
													@php ++$no; @endphp
														<td class="text-center">{{ $no }}</td>
														<td>{{$dnpkp->pkp->id_brand}}</td>
														<td>{{$dnpkp->pkp->pkp_number}}{{$dnpkp->pkp->ket_no}}</td>
														<td>{{$dnpkp->pkp->datapkp->launch}} {{$dnpkp->pkp->datapkp->years}} {{$dnpkp->pkp->datapkp->tgl_launch}}</td>
														@foreach($Npkp as $npkp)
														<td class="text-center">
															@if($npkp->id_pkp==$dnpkp->pkp->id_project)
															{{$npkp->note}}
															@endif
														</td>
														@endforeach
													</tr>
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
							<!-- Pengajuan PDF -->
							<div class="tab-pane  fade" id="tabBody1" role="tabpanel" aria-labelledby="tab1" aria-hidden="true" tabindex="0">
								<div class="row">
									<div class="col-md-12">
										<table id="datatable" class="table table-striped table-bordered" style="width:100%">
											<thead>
												<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
													<td class="text-center" width="5%">No</td>
													<td class="text-center">Brand</td>
													<th class="text-center">NO.PKP</th>
													<th class="text-center">RTO</th>
													@foreach($Npdf as $npdf)
													<th class="text-center">Meeting {{$npdf->created_at}}</th>
													@endforeach
												</tr>
											</thead>
											<tbody>
												@php $no = 0; @endphp
												@foreach ($DNpdf as $dnpdf)
												@if($dnpdf->pdf->prioritas=='1')
												<tr style="background-color:burlywood">
												@elseif($dnpdf->pdf->prioritas=='2')
												<tr style="background-color:coral">
												@elseif($dnpdf->pdf->prioritas=='3')
												<tr style="background-color:darkkhaki">
												@endif
												@php ++$no; @endphp
													<td class="text-center">{{ $no }}</td>
													<td>{{$dnpdf->pdf->id_brand}}</td>
													<td>{{$dnpdf->pdf->pdf_number}}{{$dnpdf->pdf->ket_no}}</td>
													<td>{{$dnpdf->pdf->datappdf->rto}}</td>
													@foreach($Npdf as $npdf)
													<td class="text-center">
														@if($npdf->id_pdf==$dnpdf->pdf->id_project_pdf)
														{{$npdf->note}}
														@endif
													</td>
													@endforeach
												</tr>
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<!-- Pengajuan Promo -->
							<div class="tab-pane  fade" id="tabBody2" role="tabpanel" aria-labelledby="tab2" aria-hidden="true" tabindex="0">
								<div class="row">
									<div class="col-md-12">
										<table id="datatable" class="table table-striped table-bordered" style="width:100%">
											<thead>
												<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
													<td class="text-center" width="5%">No</td>
													<td class="text-center">Brand</td>
													<th class="text-center">NO.PKP</th>
													<th class="text-center">Launch Deadline</th>
													@foreach($Npromo as $npromo)
													<th class="text-center">Meeting {{$npromo->created_at}}</th>
													@endforeach
												</tr>
											</thead>
											<tbody>
												@php $no = 0; @endphp
												@foreach ($DNpromo as $dnpromo)
												@if($dnpromo->promo->prioritas=='1')
												<tr style="background-color:#a1d6e2">
												@elseif($dnpkp->pkp->prioritas=='2')
												<tr style="background-color:#bcbabe">
												@elseif($dnpkp->pkp->prioritas=='3')
												<tr style="background-color:#f1f1f2">
												@endif
												@php ++$no; @endphp
													<td class="text-center">{{ $no }}</td>
													<td>{{$dnpromo->promo->brand}}</td>
													<td>{{$dnpromo->promo->promo_number}}{{$dnpromo->promo->ket_no}}</td>
													<td>{{$dnpromo->promo->datapromo->rto}}</td>
													@foreach($Npromo as $npromo)
													<td class="text-center">
														@if($npromo->id_promo==$dnpromo->promo->id_pkp_promo)
														{{$npromo->note}}
														@endif
													</td>
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