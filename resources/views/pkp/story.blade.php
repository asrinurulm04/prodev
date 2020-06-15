@extends('pv.tempvv')
@section('title', 'History')
@section('judulhalaman','History')
@section('content')

<div class="row">
	<div class="x_panel">
		<div class="x_title">
      <h3><li class="fa fa-history"></li> History</h3>
    </div>
		<div class="x_content">
			<table class="Table table-bordered">
				<thead>
					<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
						<td width="5%">No</td>
						<td>No Project</td>
						<td>Type Project</td>
						<td>Project Name</td>
						<td>Perevisi</td>
						<td>Tanggal Revisi</td>
						<td width="17%" class="text-center">Action</td>
					</tr>
				</thead>
				<tbody>
					@php $no = 1; @endphp
					@foreach($pesan as $ps)
					<tr>
						<td>{{$no++}}</td>
						<td>
						@if($ps->id_pkp!=NULL)
              <span>{{$ps->project->pkp_number}}{{$ps->project->ket_no}}</span>
              @elseif($ps->id_pdf!=NULL)
              <span>{{$ps->pdf->pdf_number}}{{$ps->pdf->ket_no}}</span>
              @elseif($ps->id_promo!=NULL)
              <span>{{$ps->promo->promo_number}}{{$ps->promo->ket_no}}</span>
              @endif
						</td>
						<td>
							@if($ps->id_pkp!=NULL)
							PKP
							@elseif($ps->id_pdf!=NULL)
							PDF
							@elseif($ps->id_promo!=NULL)
							PROMO
							@endif
						</td>
						{{$ps->id_notif}}
						<td>
							@if($ps->id_pkp!=NULL)
              <span>{{$ps->project->project_name}}</span>
              @elseif($ps->id_pdf!=NULL)
              <span>{{$ps->pdf->project_name}}</span>
              @elseif($ps->id_promo!=NULL)
              <span>{{$ps->promo->project_name}}</span>
              @endif
						</td>
						<td>{{$ps->users->name}}</td>
						<td>{{$ps->created_at}}</td>
						<td class="text-center">
							@if($ps->id_pkp!=NULL)
							<button class="btn btn-info" data-toggle="modal" data-target="#pkp{{$ps->id_pkp}}"><i class="fa fa-folder-open"></i> Show</a></button>
								{{-- modal --}}
								<div class="modal" id="pkp{{$ps->id_pkp}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h3 class="modal-title text-left" id="exampleModalLabel" >{{$ps->project->project_name}}
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span></h3>
												</button>
											</div>
											<div class="modal-body">
												<table class="table table-bordered">
													<thead>
														<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
															<td>versi</td>
															<td>No.PKP</td>
															<td>Project Name</td>
															<td>Author</td>
															<td>Action</td>
														</tr>
													</thead>
													<tbody>
														@foreach ($pkp as $data)
														@if($data->id_pkp==$ps->id_pkp)
														<tr>
														<td>{{$data->revisi}}.{{$data->turunan}}</td>
														<td>{{$data->datapkpp->pkp_number}}{{$data->datapkpp->ket_no}}</td>
														<td>{{$data->datapkpp->project_name}}</td>
														<td>{{$data->datapkpp->author1->name}}</td>
														<td><a href="{{route('rekappkp',$data->id_pkp)}}" class="btn btn-info btn-sm"><li class="fa fa-folder-open"></li> Show</a></td>
														@endif
														@endforeach
														</tr>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								{{-- modal selesai --}}
							@elseif($ps->id_pdf!=NULL)
							<button class="btn btn-info" data-toggle="modal" data-target="#pdf{{$ps->id_pdf}}"><i class="fa fa-folder-open"></i> Show</a></button>
								{{-- modal --}}
								<div class="modal" id="pdf{{$ps->id_pdf}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h3 class="modal-title text-left" id="exampleModalLabel" >{{$ps->pdf->project_name}}
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span></h3>
												</button>
											</div>
											<div class="modal-body">
												<table class="table table-bordered">
													<thead>
														<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
															<td>versi</td>
															<td>No.PKP</td>
															<td>Project Name</td>
															<td>Author</td>
															<td>Action</td>
														</tr>
													</thead>
													<tbody>
														@foreach ($pdf1 as $data1)
														@if($data1->pdf_id==$ps->id_pdf)
														<tr>
															<td>{{$data1->revisi}}.{{$data1->turunan}}</td>
															<td>{{$data1->datapdf->pdf_number}}{{$data1->datapdf->ket_no}}</td>
															<td>{{$data1->datapdf->project_name}}</td>
															<td>{{$data1->datapdf->author1->name}}</td>
															<td><a href="{{route('rekappdf',$data1->pdf_id)}}" class="btn btn-info btn-sm"><li class="fa fa-folder-open"></li> Show</a></td>
														@endif
														@endforeach
														</tr>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								{{-- modal selesai --}}
							@elseif($ps->id_promo!=NULL)
							<button class="btn btn-info" data-toggle="modal" data-target="#promo{{$ps->id_promo}}"><i class="fa fa-folder-open"></i> Show</a></button>
								{{-- modal --}}
								<div class="modal" id="promo{{$ps->id_promo}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h3 class="modal-title text-left" id="exampleModalLabel" >{{$ps->promo->project_name}}
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span></h3>
												</button>
											</div>
											<div class="modal-body">
												<table class="table table-bordered">
													<thead>
														<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
															<td>versi</td>
															<td>No.PKP</td>
															<td>Project Name</td>
															<td>Author</td>
															<td>Action</td>
														</tr>
													</thead>
													<tbody>
														@foreach ($promo as $data1)
														@if($data1->id_pkp_promo==$ps->id_promo)
														<tr>
															<td>{{$data1->datapromo->revisi}}.{{$data1->datapromo->turunan}}</td>
															<td>{{$data1->pdf_number}}{{$data1->ket_no}}</td>
															<td>{{$data1->project_name}}</td>
															<td>{{$data1->author1->name}}</td>
															<td><a href="{{route('rekappromo',$data1->id_pkp_promo)}}" class="btn btn-info btn-sm"><li class="fa fa-folder-open"></li> Show</a></td>
														@endif
														@endforeach
														</tr>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								{{-- modal selesai --}}
							@endif
						</td>
					</tr>
					
						
					@endforeach
				</tbody>
			</table>
			<!-- modal -->
				
				<!-- Modal Selesai -->
		</div>
	</div>
</div>

@endsection