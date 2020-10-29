@extends('formula.tempformula')
@section('title', 'Template Formula')
@section('content')

<div class="row mt">
  <div class="col-lg-12 col-md-12 col-sm-12">
    <div class="x_panel">
      <div class="x_title">
        <h4><li class="fa fa-clone"> FORMULA Yang Dapat Dijadikan Template</h4>
      </div> 
      <table class="Table table-striped table-advance table-hover" id="Table">
        <thead>
          <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
            <th>Nama Produk</th>
            <th class="text-center">Formula</th>
            <th class="text-center">Versi</th>
            <th class="text-center">Status PV</th>
            <th class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($formulas as $formula)
          <tr style="background-color:white">
            <td>{{ $formula->workbook->datapkpp->project_name}}</td>
            <td class="text-center">{{ $formula->formula}}</td>
            <td class="text-center">{{ $formula->versi}}.{{ $formula->turunan }}</td>
            <td class="text-center">{{ $formula->vv}}</td>
            <td class="text-center">
              {{csrf_field()}}
              <a class="btn btn-warning btn-sm" href="{{ route('insertTemplate',['ftujuan'=>$for,'fasal'=>$formula->id]) }}"><i class="fa fa-download"></i> Jadikan Template</a>
            </td>
          </tr>
        @endforeach
        </tbody>        
      </table>
      
      <a href="{{ route('step2',[$ftujuan,$for]) }}" class="btn btn-danger btn-sm" ><i class="fa fa-arrow-left"></i> Back</a>
    </div>
  </div>
</div>
@endsection