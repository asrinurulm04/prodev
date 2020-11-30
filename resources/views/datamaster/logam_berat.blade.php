@extends('pv.tempvv')
@section('title', 'Logam Berat')
@section('content')

<div class="row">
	<div class="x_panel">
		<div class="x_title">
			<h3><li class="fa fa-file"></li> Logam Berat</h3>
		</div>
		<table class="Table table-bordered">
			<thead>
				<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
					<td width="10px">No</td>
					<td>Jenis Makanan</td>
          <td>Arsen (As)</td>
          <td>Timbal (Pb)</td>
          <td>Merkuri (Hg)</td>
          <td>Kadmium (Cd)</td>
          <td>Logam</td>
				</tr>
			</thead>
			<tbody>
				@php
					$no = 0;
				@endphp
				@foreach($logam as $logam)
				<tr>
					<td>{{++$no}}</td>
					<td>{{$logam->pangan}}</td>
          <td>{{$logam->arsen}}</td>
          <td>{{$logam->timbal}}</td>
          <td>{{$logam->merkuri	}}</td>
          <td>{{$logam->kadmium}}</td>
          <td>{{$logam->logam}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection