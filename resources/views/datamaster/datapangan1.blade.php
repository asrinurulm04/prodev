@extends('pv.tempvv')
@section('title', 'PRODEV|Data Pangan')
@section('content')

<div class="row">
	<div class="x_panel">
		<div class="x_title">
			<h3><li class="fa fa-file"></li> PKBPOM No 16 thn.2016 tentang kriteria Mikrobiologi dalam olahan pangan</h3>
		</div>  
		<table id="datatable" class="table table-striped table-bordered" style="width:100%">
			<thead>
				<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
					<th class="text-center" width="10">No Category</th>
					<th class="text-center" width="20%">Food Category</th>
					<th class="text-center" width="15%">Microba Parameters</th>
					<th class="text-center">n</th>
					<th class="text-center">c</th>
					<th class="text-center" width="13%">m</th>
					<th class="text-center" width="13%">M</th>
					<th class="text-center" width="20%">Method</th>
				</tr>
			</thead>
			<tbody>
				@php $no = 0; @endphp
				@foreach ($Kjenispangan as $item)
					<tr>
					<td>{{$item->no_kategori}}</td>
					<td>{{$item->kategori}}</td>
					<td>
						@foreach($mikroba as $mikro)
						@if($item->no_kategori == $mikro->no)
						=> {{$mikro->jenis_mikroba}} <br>
						@else
						@endif
						@endforeach
					</td>
					<td>
						@foreach($mikroba as $mikro)
						@if($item->no_kategori == $mikro->no)
						=> {{$mikro->n}} <br>
						@else
						@endif
						@endforeach
					</td>
					<td>
						@foreach($mikroba as $mikro)
						@if($item->no_kategori == $mikro->no)
						=> {{$mikro->c}} <br>
						@else
						@endif
						@endforeach
					</td>
					<td>
						@foreach($mikroba as $mikro)
						@if($item->no_kategori == $mikro->no)
						=> {{$mikro->mk}} <br>
						@else
						@endif
						@endforeach
					</td>
					<td>
						@foreach($mikroba as $mikro)
						@if($item->no_kategori == $mikro->no)
						=> {{$mikro->Mb}} <br>
						@else
						@endif
						@endforeach
					</td>
					<td>
						@foreach($mikroba as $mikro)
						@if($item->no_kategori == $mikro->no)
						=> {{$mikro->metode_analisa}} <br>
						@else
						@endif
						@endforeach
					</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection
@section('s')
    <link href="{{ asset('lib/advanced-datatable/css/jquery.dataTables.css') }}" rel="stylesheet" />
    <script src="{{ asset('js/datatables.min.js')}}"></script>
@endsection