@extends('pv.tempvv')
@section('title', 'Kemas')
@section('judulhalaman','Kemas')
@section('content')

<div class="row">
	<div class="x_panel">
	<a href="{{route('export')}}" class="btn btn-info"><li class="fa fa-download"></li> Export Data Kemas</a>
		<table class="Table table-bordered">
			<thead>
				<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
					<td width="10px">No</td>
					<td>Data kemas</td>
				</tr>
			</thead>
			<tbody>
				@php $no = 0; @endphp
				@foreach($kemas as $kemas)
				<tr>
					<td>{{++$no}}</td>
					<td>{{$kemas->tersier}}{{$kemas->s_tersier}}
					@if($kemas->sekunder1!='NULL')
					X{{$kemas->sekunder1}}{{$kemas->s_sekunder1}}
					@elseif($kemas->sekunder2!='NULL')
					X{{$kemas->sekunder2}}{{$kemas->s_sekunder2}}
					@endif
					X{{$kemas->primer}}{{$kemas->s_primer}}
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection