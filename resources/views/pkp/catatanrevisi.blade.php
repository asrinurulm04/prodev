@extends('pv.tempvv')
@section('title', 'Catatan Revisi')
@section('judulhalaman','Catatan Revisi')
@section('content')

<div class="row">
	<div class="x_panel">
		<div class="x_title">
      <h3><li class="fa fa-file"></li> Revision Info</h3>
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
						</td>{{$ps->id_notif}}</td>
						<td>
							@if($ps->id_pkp!=NULL)
              <span>{{$ps->project->project_name}}</span>
              @elseif($ps->id_pdf!=NULL)
              <span>{{$ps->pdf->project_name}}</span>
              @elseif($ps->id_promo!=NULL)
              <span>{{$ps->promo->project_name}}</span>
              @endif
						</td>
						<td>@if($ps->perevisi!=null){{$ps->users->name}}@endif</td>
						<td>{{$ps->created_at}}</td>
						<td class="text-center">
							@if($ps->status=='active')
								@if($ps->id_pkp!=NULL)
								<a href="{{route('bacapesan',$ps->id)}}" class="btn btn-info btn-sm"><li class="fa fa-folder-open"></li> Show</a>
								@elseif($ps->id_pdf!=NULL)
								<a href="{{route('bacapesan',$ps->id)}}" class="btn btn-info btn-sm"><li class="fa fa-folder-open"></li> Show</a>
								@elseif($ps->id_promo!=NULL)
								<a href="{{route('bacapesan',$ps->id)}}" class="btn btn-info btn-sm"><li class="fa fa-folder-open"></li> Show</a>
								@endif
							@endif
							</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

@endsection