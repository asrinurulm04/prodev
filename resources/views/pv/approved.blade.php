@extends('pv.tempvv')
@section('title', 'Approved')
@section('judulhalaman','Approved')
@section('content')

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h3>Approved</h3>
        <div class="x_content" style="overflow-x: scroll;">
        <table class="table table-striped table-advance table-hover" id="Table">
          <thead>
            <tr>
              <th>ID</th>
              <th>User</th>
              <th>Departement</th>
              <th>Kode Formula</th>
              <th>Nama Produk</th>
              <th>Revisi</th>
              <th>Versi</th>
              <th>PV</th>
              <th>Feasibility</th>
              <th>Nutfact</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          @foreach ($formulas as $formula)
          @if($formula->vv != null)
            <tr>
              <td>{{ $formula->id}}</td>
              <td>{{ $formula->workbook->user->name }}</td>
              <td>{{ $formula->workbook->user->departement->dept }}</td>
              <td>{{ $formula->kode_formula}}</td>
              <td>{{ $formula->nama_produk}}</td>
              <td>{{ $formula->revisi}}</td>
              <td>{{ $formula->versi}}</td>
              <td>{{ $formula->vv}}</td>
              <td>{{ $formula->status_fisibility}}</td>
              <td>{{ $formula->status_nutfact}}</td>
              <td>{{ $formula->status}}</td>
              <td>
                {{csrf_field()}}
                <a class="btn btn-info" href="">Lihat</a>
              </td>
            </tr>
            @endif
            @endforeach
          </tbody>
        </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection