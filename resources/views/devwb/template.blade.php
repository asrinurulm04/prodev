@extends('formula.tempformula')
@section('title', 'Template Formula')
@section('content')

<div class="row mt">
  <div class="col-lg-12 col-md-12 col-sm-12">
    <div class="x_panel">
      <div class="x_title">
        <h3><li class="fa fa-file"> FORMULA Yang Dapat Dijadikan Template
        <a href="{{ route('step2',[$ftujuan,$for]) }}" class="btn btn-danger" ><i class="fa fa-times"></i> Batal</a></h3>
      </div> 
      <table class="Table table-striped table-advance table-hover" id="Table">
        <thead>
          <tr>
            <th>Kode Formula</th>
            <th>Nama Produk</th>
            <th class="text-center">Revisi</th>
            <th class="text-center">Versi</th>
            <th class="text-center">Feasibility</th>
            <th class="text-center">Nutfact</th>
            <th class="text-center">Status</th>
            <th class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($formulas as $formula)
          @if($formula->id != $ftujuan)
          <tr style="background-color:white">
            <td class="text-center">({{$formula->id}}){{ $formula->kode_formula}}</td>
            <td>{{ $formula->workbook->datapkpp->project_name}}</td>
            <td class="text-center">{{ $formula->revisi}}</td>
            <td class="text-center">{{ $formula->versi}}</td>
            <td class="text-center">{{ $formula->status_fisibility}}</td>
            <td class="text-center">{{ $formula->status_nutfact}}</td>
            <td class="text-center">{{ $formula->status}}</td>
            <td class="text-center">
              {{csrf_field()}}
              <a class="btn btn-warning btn-sm" href="{{ route('insertTemplate',['ftujuan'=>$for,'fasal'=>$formula->id]) }}"><i class="fa fa-download"></i> Jadikan Template</a>
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