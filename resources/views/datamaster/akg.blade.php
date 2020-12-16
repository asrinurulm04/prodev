@extends('pv.tempvv')
@section('title', 'AKG')
@section('content')

<div class="row">
	<div class="x_panel">
		<div class="x_title">
      <h3><li class="fa fa-file-archive-o"></li> AKG NOMOR 9 TAHUN 2016 TENTANG ACUAN LABEL GIZI</h3>
    </div>
  	<div class="card-block">
			<a href="{{route('exportAkg')}}" class="btn btn-info btn-sm"><li class="fa fa-download"></li> Export Data AKG</a>
			<table class="Table table-bordered">
				<thead>
					<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
						<td width="10px">No</td>
						<td>Zat Gizi</td>
						<td>Satuan</td>
						<td>Umum</td>
						<Td>Bayi</Td>
						<td>Anak 7-23 Bulan</td>
						<td>Anak 2-5 tahun</td>
						<td>Ibu Hamil</td>
						<td>Ibu Menyusui</td>
					</tr>
				</thead>
				<tbody>
					@php
						$no = 0;
					@endphp
					@foreach($akg as $akg)
					<tr>
						<td class="text-center">{{++$no}}</td>
						<td>{{$akg->zat_gizi}}</td>
						<td class="text-center">{{$akg->satuan}}</td>
						<td class="text-right">{{$akg->umum}}</td>
						<td class="text-right">{{$akg->bayi}}</td>
						<td class="text-right">{{$akg->anak7_23bulan}}</td>
						<td class="text-right">{{$akg->anak2_5tahun}}</td>
						<td class="text-right">{{$akg->ibu_hamil}}</td>
						<td class="text-right">{{$akg->ibu_menyusui}}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>	
@endsection