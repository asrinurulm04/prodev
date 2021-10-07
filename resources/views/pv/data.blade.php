@extends('layout.tempvv')
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
				<table id="Table" class="table table-bordered">
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
@endsection