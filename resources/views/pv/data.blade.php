@extends('pv.tempvv')
@section('title', 'PRODEV|Data')
@section('content')

<div class="row">
  <div class="x_panel">
		<div class="x_title">
			<h3><li class="fa fa-folder"></li> Active project list</h3>
		</div>
		<div class="x_content">
			<table class="table table-bordered">
				<thead>
					<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
						<th>Brand</th>
						<th class="text-center">Hilo</th>
						<th class="text-center">L-Men</th>
						<th class="text-center">Nutrisari</th>
						<th class="text-center">Tropicana Slim</th>
						<th class="text-center">Ekspor</th>
					</tr>
					<tr>
						<th>jumlah</th>
						<td class="text-center"><a data-toggle="modal" data-target="#hillo">{{$hhilo}} Project Hilo</a></td>
						<td class="text-center"><a data-toggle="modal" data-target="#lmen">{{$hlmen}} Project Lmen</a></td>
						<td class="text-center"><a data-toggle="modal" data-target="#nr">{{$hnr}} Project Nutrisari</a></td>
						<td class="text-center"><a data-toggle="modal" data-target="#ts">{{$hts}} Project Tropicana Slim</a></td>
						<td class="text-center"><a data-toggle="modal" data-target="#eks">{{$hekspor}} Project Ekspor</a></td>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>
<!-- modal -->
<div class="modal" id="hillo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title text-left" id="exampleModalLabel" >Data Project Hilo
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></h3>
        </button>
      </div>
      <div class="modal-body">
				<table class="table table-bordered">
					<thead>
						<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
							<td>Project Name</td>
							<td>created date</td>
							<td>Revisi</td>
							<td>Status</td>
							<td>Type</td>
						</tr>
					</thead>
					<tbody>
						@foreach ($dhilo1 as $dhilo)
						<tr>
							<td>{{$dhilo->project_name}}</td>
							<td>{{$dhilo->created_date}}</td>
							<td class="text-center">{{$dhilo->revisi}}.{{$dhilo->turunan}}</td>
							<td>{{$dhilo->status_project}}</td>
							<td>PKP</td>
						@endforeach
						</tr>
						@foreach ($dhilo2 as $dhilo2)
						<tr>
							<td>{{$dhilo2->project_name}}</td>
							<td>{{$dhilo2->created_date}}</td>	
							<td class="text-center">{{$dhilo->revisi}}.{{$dhilo->turunan}}</td>
							<td>{{$dhilo->status_project}}</td>
							<td>PDF</td>
						@endforeach
						</tr>
					</tbody>
				</table>
      </div>
    </div>
  </div>
</div>
<!-- Modal Selesai -->

<!-- modal -->
<div class="modal" id="lmen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title text-left" id="exampleModalLabel" >Data Project L-Men
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></h3>
        </button>
      </div>
      <div class="modal-body">
				<table class="table table-bordered">
					<thead>
						<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
							<td>Project Name</td>
							<td>created date</td>
							<td>Revisi</td>
							<td>Status</td>
							<td>Type</td>
						</tr>
					</thead>
					<tbody>
						@foreach ($dlmen1 as $dlmen1)
						<tr>
							<td>{{$dlmen1->project_name}}</td>
							<td>{{$dlmen1->created_date}}</td>
							<td class="text-center">{{$dhilo->revisi}}.{{$dhilo->turunan}}</td>
							<td>{{$dhilo->status_project}}</td>
							<td>PKP</td>
						@endforeach
						</tr>
						@foreach ($dlmen2 as $dlmen2)
						<tr>
							<td>{{$dlmen2->project_name}}</td>
							<td>{{$dlmen2->created_date}}</td>	
							<td class="text-center">{{$dhilo->revisi}}.{{$dhilo->turunan}}</td>
							<td>{{$dhilo->status_project}}</td>
							<td>PDF</td>
						@endforeach
						</tr>
					</tbody>
				</table>
      </div>
    </div>
  </div>
</div>
<!-- Modal Selesai -->

<!-- modal -->
<div class="modal" id="nr" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title text-left" id="exampleModalLabel" >Data Project Nutrisari
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></h3>
        </button>
      </div>
      <div class="modal-body">
				<table class="table table-bordered">
					<thead>
						<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
							<td>Project Name</td>
							<td>created date</td>
							<td>Revisi</td>
							<td>Status</td>
							<td>Type</td>
						</tr>
					</thead>
					<tbody>
						@foreach ($dnr1 as $dnr1)
						<tr>
							<td>{{$dnr1->project_name}}</td>
							<td>{{$dnr1->created_date}}</td>
							<td class="text-center">{{$dhilo->revisi}}.{{$dhilo->turunan}}</td>
							<td>{{$dhilo->status_project}}</td>
							<td>PKP</td>
						@endforeach
						</tr>
						@foreach ($dnr2 as $dnr2)
						<tr>
							<td>{{$dnr2->project_name}}</td>
							<td>{{$dnr2->created_date}}</td>	
							<td class="text-center">{{$dhilo->revisi}}.{{$dhilo->turunan}}</td>
							<td>{{$dhilo->status_project}}</td>
							<td>PDF</td>
						@endforeach
						</tr>
					</tbody>
				</table>
      </div>
    </div>
  </div>
</div>
<!-- Modal Selesai -->

<!-- modal -->
<div class="modal" id="ts" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title text-left" id="exampleModalLabel" >Data Project Tropicana Slim
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></h3>
				</button>
			</div>
			<div class="modal-body">
				<table class="table table-bordered">
					<thead>
						<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
							<td>Project Name</td>
							<td>created date</td>
							<td>Revisi</td>
							<td>Status</td>
							<td>Type</td>
						</tr>
					</thead>
					<tbody>
						@foreach ($dts1 as $dts1)
						<tr>
							<td>{{$dts1->project_name}}</td>
							<td>{{$dts1->created_date}}</td>
							<td class="text-center">{{$dhilo->revisi}}.{{$dhilo->turunan}}</td>
							<td>{{$dhilo->status_project}}</td>
							<td>PKP</td>
						@endforeach
						</tr>
						@foreach ($dts2 as $dts2)
						<tr>
							<td>{{$dts2->project_name}}</td>
							<td>{{$dts2->created_date}}</td>	
							<td class="text-center">{{$dhilo->revisi}}.{{$dhilo->turunan}}</td>
							<td>{{$dhilo->status_project}}</td>
							<td>PDF</td>
						@endforeach
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- Modal Selesai -->

<!-- modal -->
<div class="modal" id="eks" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title text-left" id="exampleModalLabel" >Data Project Ekspor
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></h3>
				</button>
			</div>
			<div class="modal-body">
				<table class="table table-bordered">
					<thead>
						<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
							<td>Project Name</td>
							<td>created date</td>
							<td>Revisi</td>
							<td>Status</td>
							<td>Type</td>
						</tr>
					</thead>
					<tbody>
						@foreach ($dekspor1 as $dekspor1)
						<tr>
							<td>{{$dekspor1->project_name}}</td>
							<td>{{$dekspor1->created_date}}</td>
							<td class="text-center">{{$dhilo->revisi}}.{{$dhilo->turunan}}</td>
							<td>{{$dhilo->status_project}}</td>
							<td>PKP</td>
						@endforeach
						</tr>
						@foreach ($dekspor2 as $dekspor2)
						<tr>
							<td>{{$dekspor2->project_name}}</td>
							<td>{{$dekspor2->created_date}}</td>	
							<td class="text-center">{{$dhilo->revisi}}.{{$dhilo->turunan}}</td>
							<td>{{$dhilo->status_project}}</td>
							<td>PDF</td>
						@endforeach
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- Modal Selesai -->

<div class="row">
  <div class="x_panel">
		<div class="x_title">
			<h3><li class="fa fa-folder"></li> Project's Milestones</h3>
		</div>
		<div class="x_content">
			<table class="table table-bordered">
				<thead>
					<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
						<th>Status</th>
						<th class="text-center">Draft</th>
						<th class="text-center">Sent</th>
						<th class="text-center">Revision</th>
						<th class="text-center">Prosess</th>
						<th class="text-center">Close</th>
					</tr>
					<tr>
						<th>jumlah</th>
						<td class="text-center"><a data-toggle="modal" data-target="#draf"> {{$hdraf}} Project</td>
						<td class="text-center"><a data-toggle="modal" data-target="#sent"> {{$hsent}} Project</td>
						<td class="text-center"><a data-toggle="modal" data-target="#revisi"> {{$hrevisi}} Project</td>
						<td class="text-center"><a data-toggle="modal" data-target="#proses"> {{$hproses}} Project</td>
						<td class="text-center"><a data-toggle="modal" data-target="#close"> {{$hclose}} Project</td>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>

<!-- modal -->
<div class="modal" id="draf" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title text-left" id="exampleModalLabel" >Data Project Draf
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></h3>
				</button>
			</div>
			<div class="modal-body">
				<table class="table table-bordered">
					<thead>
						<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
							<td>Project Name</td>
							<td>created date</td>
							<td>Brand</td>
							<td>Type</td>
						</tr>
					</thead>
					<tbody>
						@foreach ($ddraf as $ddraf)
						<tr>
							<td>{{$ddraf->project_name}}</td>
							<td>{{$ddraf->created_date}}</td>
							<td></td>
							<td>PKP</td>
						@endforeach
						</tr>
						@foreach ($ddraf1 as $ddraf1)
						<tr>
							<td>{{$ddraf1->project_name}}</td>
							<td>{{$ddraf1->created_date}}</td>	
							<td></td>
							<td>PDF</td>
						@endforeach
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- Modal Selesai -->

<!-- modal -->
<div class="modal" id="sent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title text-left" id="exampleModalLabel" >Data Project Sent
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></h3>
				</button>
			</div>
			<div class="modal-body">
				<table class="table table-bordered">
					<thead>
						<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
							<td>Project Name</td>
							<td>created date</td>
							<td>Brand</td>
							<td>Type</td>
						</tr>
					</thead>
					<tbody>
						@foreach ($dsent as $dsent)
						<tr>
							<td>{{$dsent->project_name}}</td>
							<td>{{$dsent->created_date}}</td>
							<td></td>
							<td>PKP</td>
						@endforeach
						</tr>
						@foreach ($dsent1 as $dsent1)
						<tr>
							<td>{{$dsent1->project_name}}</td>
							<td>{{$dsent1->created_date}}</td>	
							<td></td>
							<td>PDF</td>
						@endforeach
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- Modal Selesai -->

<!-- modal -->
<div class="modal" id="revisi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title text-left" id="exampleModalLabel" >Data Project Revisi
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></h3>
				</button>
			</div>
			<div class="modal-body">
				<table class="table table-bordered">
					<thead>
						<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
							<td>Project Name</td>
							<td>created date</td>
							<td>Brand</td>
							<td>Type</td>
						</tr>
					</thead>
					<tbody>
						@foreach ($drevisi as $drevisi)
						<tr>
							<td>{{$drevisi->project_name}}</td>
							<td>{{$drevisi->created_date}}</td>
							<td></td>
							<td>PKP</td>
						@endforeach
						</tr>
						@foreach ($drevisi1 as $drevisi1)
						<tr>
							<td>{{$drevisi1->project_name}}</td>
							<td>{{$drevisi1->created_date}}</td>	
							<td></td>
							<td>PDF</td>
						@endforeach
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- Modal Selesai -->

<!-- modal -->
<div class="modal" id="close" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title text-left" id="exampleModalLabel" >Data Project Close
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></h3>
				</button>
			</div>
			<div class="modal-body">
				<table class="table table-bordered">
					<thead>
						<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
							<td>Project Name</td>
							<td>created date</td>
							<td>Brand</td>
							<td>Type</td>
						</tr>
					</thead>
					<tbody>
						@foreach ($dclose as $dclose)
						<tr>
							<td>{{$dclose->project_name}}</td>
							<td>{{$dclose->created_date}}</td>
							<td></td>
							<td>PKP</td>
						@endforeach
						</tr>
						@foreach ($dclose1 as $dclose1)
						<tr>
							<td>{{$dclose1->project_name}}</td>
							<td>{{$dclose1->created_date}}</td>	
							<td></td>
							<td>PDF</td>
						@endforeach
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- Modal Selesai -->

<!-- modal -->
<div class="modal" id="proses" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title text-left" id="exampleModalLabel" >Data Project Proses
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></h3>
				</button>
			</div>
			<div class="modal-body">
				<table class="table table-bordered">
					<thead>
						<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
							<td>Project Name</td>
							<td>created date</td>
							<td>Brand</td>
							<td>Type</td>
						</tr>
					</thead>
					<tbody>
						@foreach ($dproses as $dproses)
						<tr>
							<td>{{$dproses->project_name}}</td>
							<td>{{$dproses->created_date}}</td>
							<td></td>
							<td>PKP</td>
						@endforeach
						</tr>
						@foreach ($dproses1 as $dproses1)
						<tr>
							<td>{{$dproses1->project_name}}</td>
							<td>{{$dproses1->created_date}}</td>	
							<td></td>
							<td>PDF</td>
						@endforeach
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- Modal Selesai -->

@endsection