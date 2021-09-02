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
          {{-- <a href="{{ route('formula.selesai') }}" type="submit" data-toggle="tooltip" title="Lihat" class="btn btn-info fa fa-folder-open"> Formula Yang Sudah Selesai</a> --}}
        </div><br>
        <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
          <th class="text-center" width="5%">No</th>
          <th class="text-center">PV</th>
          <th class="text-center">no pkp</th>
          <th class="text-center">Nama Produk</th>
          <th class="text-center">Status Sample</th>
          <th class="text-center">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @php $no = 0; @endphp
        @foreach($formulas as $formula)
        @php ++$no; @endphp
        <tr>
          <td class="text-center">{{ $no }}</td>
          <td class="text-center">{{ $formula->perevisi2->name}}</td>
          <td>{{ $formula->datapkpp->pkp_number }}{{ $formula->datapkpp->ket_no }}</td>
          <td>{{ $formula->datapkpp->project_name }}</td>
          <td>{{ $formula->datapkpp->pengajuan_sample }}</td>
          <td class="text-center">
            <div class="btn-group">
              <a href="{{ route('myFeasibility',$formula->id_pkp) }}" type="submit" data-toggle="tooltip" title="Lihat" class="btn btn-info fa fa-folder-open"></a>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection