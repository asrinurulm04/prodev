@extends('formula.tempformula')
@section('title', 'Template Formula')
@section('content')

<div class="row mt">
  <div class="col-lg-12 col-md-12 col-sm-12">
    <div class="showback">
      <div class="col-md-3"><h4>FORMULA Yang Dapat Dijadikan Template</h4></div>
      <div class="col-md-4">
        <a href="{{ route('step2',$ftujuan) }}" class="btn btn-danger"><i class="fa fa-times"></i> Batal</a>
      </div>
      <table class="table table-striped table-advance table-hover" id="Table">
        <thead>
          <tr>
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
          @if($formula->id != $ftujuan)
          <tr style="background-color:white">
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
              <a class="btn btn-warning btn-sm" href="{{ route('insertTemplate',['ftujuan'=>$ftujuan,'fasal'=>$formula->id]) }}"><i class="fa fa-download"></i> Jadikan Template</a>
            </td>
          </tr>
          @endif
        @endforeach
        </tbody>        
      </table>
    </div>
  </div>
</div>
@endsection