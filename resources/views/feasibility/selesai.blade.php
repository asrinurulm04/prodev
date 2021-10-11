@extends('layout.tempvv')
@section('title', 'Formula')
@section('judulnya', 'FORMULA LIST YANG SUDAH SELESAI')
@section('content')

<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="card">
    <div class="card-header"><br>
      <div class="showback" style="border-radius:3px;">
        <div class="btn-group">
          <a href="{{ route('formula.feasibility') }}" type="submit" data-toggle="tooltip" title="Lihat" class="btn btn-info fa fa-folder-open"> Data Yang belum Selesai</a> 
        </div><br>
        <table class="table table-striped table-advance table-hover" id="Table">
          <thead>
            <tr>
              <th class="text-center">No</th>
              <th class="text-center">pic pv</th>
              <th class="text-center">no pkp</th>
              <th class="text-center">desc singkat</th>
              <th class="text-center">Nama Produk</th>
              <th class="text-center">Tanggal Masuk</th>
              <th class="text-center">status PV</th>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
          @php $no = 0; @endphp
          @foreach($formulas as $formula)
          @php ++$no; @endphp
          <tr>
            <td class="text-center">{{ $no }}</td>
            <!-- <td class="text-center">{{ $formula->workbook->user->name}}</td> -->
            <td class="text-center">{{ $formula->workbook->user->name}}</td>
            <td class="text-center">{{ $formula->workbook->NO_PKP }}</td>
            <td>{{ $formula->workbook->deskripsi }}</td>
            <td>{{ $formula->nama_produk}}</td>
            <td class="text-center">{{ $formula->updated_at }}</td>
            <td class="text-center">{{ $formula->vv }}</td>
            <div class="btn-group">
            <td class="text-center"><a href="{{ route('myFeasibility',$formula->id) }}" type="submit" data-toggle="tooltip" title="Lihat" class="btn btn-info fa fa-folder-open"></a>
            </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection