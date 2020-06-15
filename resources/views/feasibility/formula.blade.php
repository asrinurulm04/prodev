@extends('feasibility.tempfeasibility')
@section('title', 'Formula')
@section('content')

<div class="x_panel">
  <div class="x_title">
    <h3><li class="fa fa-list"> List project</li></h3>
  </div>
  <div class="showback" style="border-radius:3px;">
    <table class="Table table-striped table-advance table-hover table-bordered" id="Table">
      <thead>
        <div class="btn-group">
          <a href="{{ route('formula.selesai') }}" type="submit" data-toggle="tooltip" title="Lihat" class="btn btn-info fa fa-folder-open"> Formula Yang Sudah Selesai</a>
        </div><br>
        <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
          <th class="text-center">No</th>
          <th class="text-center">pic pv</th>
          <th class="text-center">no pkp</th>
          <th class="text-center">desc singkat</th>
          <th class="text-center">Nama Produk</th>
          <th class="text-center">Tanggal Masuk</th>
          <th class="text-center">status PV</th>
          <th class="text-center">status Feasibility</th>
          <th class="text-center">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @php $no = 0; @endphp
        @foreach($formulas as $formula)
        @php ++$no; @endphp
        <tr>
          <td class="text-center">{{ $no }}</td>
          <td class="text-center">{{ $formula->workbook->user->name}}</td>
          <td class="text-center">{{ $formula->workbook->user->name}}</td>
          <td class="text-center">{{ $formula->workbook->NO_PKP }}</td>
          <td class="text-center">{{ $formula->workbook->deskripsi }}</td>
          <td class="text-center">{{ $formula->nama_produk}}</td>
          <td class="text-center">{{ $formula->updated_at }}</td>
          <td class="text-center">{{ $formula->vv }}</td>
          <td class="text-center">{{ $formula->status_fisibility }}</td>
          <td class="text-center">
            <div class="btn-group">
              <a href="{{ route('myFeasibility',$formula->id) }}" type="submit" data-toggle="tooltip" title="Lihat" class="btn btn-info fa fa-folder-open"></a>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection