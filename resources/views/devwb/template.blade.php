@extends('pv.tempvv')
@section('title', 'PRODEV|Template Formula')
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
            <th>Category Formula</th>
            <th class="text-center">Formula</th>
            <th class="text-center">Versi</th>
            <th class="text-center">Status PV</th>
            <th class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
        <!-- Untuk Project PKP -->
        @if(auth()->user()->departement_id != '6')
          @foreach ($formulas as $formula)
          @if($ada==0)
            @if($for!=$formula->id)
            <tr style="background-color:white">
              <td>{{ $formula->pkp_number}}{{ $formula->ket_no}}</td>
              <td class="text-center" width="15%">
                @if($formula->kategori!='fg')
                {{$formula->kategori}}
                @elseif($formula->kategori=='fg')
                Finished Good
                @endif
              </td>
              <td class="text-center">{{ $formula->formula}}</td>
              <td class="text-center">{{ $formula->versi}}.{{ $formula->turunan }}</td>
              <td class="text-center">
                @if ($formula->vv == 'proses') <span class="label label-warning">Proses</span> @endif
                @if ($formula->vv == 'reject') <span class="label label-danger">Rejected</span> @endif 
                @if ($formula->vv == 'approve') <span class="label label-success">Approved</span> @endif 
                @if ($formula->vv == 'final') <span class="label label-info">Final Approved</span> @endif 
                @if ($formula->vv == '') <span class="label label-primary">Belum Diajukan</span> @endif  
              </td>
              <td class="text-center">
                <a class="btn btn-warning btn-sm" href="{{ route('insertTemplate',['ftujuan'=>$for,'fasal'=>$formula->id]) }}" onclick="return confirm('Jadikan Template ?')"><i class="fa fa-download"></i> Jadikan Template</a>
              </td>
            </tr>
            @endif
          @else
            @if($formula->kategori=='granulasi')
            <tr style="background-color:white">
              <td>{{ $formula->pkp_number}}{{ $formula->ket_no}}</td>
              <td class="text-center" width="15%">
                @if($formula->kategori!='fg')
                {{$formula->kategori}}
                @elseif($formula->kategori=='fg')
                Finished Good
                @endif
              </td>
              <td class="text-center">{{ $formula->formula}}</td>
              <td class="text-center">{{ $formula->versi}}.{{ $formula->turunan }}</td>
              <td class="text-center">
                @if ($formula->vv == 'proses') <span class="label label-warning">Proses</span> @endif
                @if ($formula->vv == 'reject') <span class="label label-danger">Rejected</span> @endif 
                @if ($formula->vv == 'approve') <span class="label label-success">Approved</span> @endif 
                @if ($formula->vv == 'final') <span class="label label-info">Final Approved</span> @endif 
                @if ($formula->vv == '') <span class="label label-primary">Belum Diajukan</span> @endif
              </td>
              <td class="text-center">
                <a class="btn btn-warning btn-sm" href="{{ route('insertTemplate',['ftujuan'=>$for,'fasal'=>$formula->id]) }}" onclick="return confirm('Jadikan Template ?')"><i class="fa fa-download"></i> Jadikan Template</a>
              </td>
            </tr>
            @endif
          @endif
          @endforeach

        <!-- Untuk Project PDF -->
        @elseif(auth()->user()->departement_id == '6')
          @foreach ($formulas_pdf as $formula)
          @if($ada==0)
            @if($for!=$formula->id)
            <tr style="background-color:white">
              <td>{{ $formula->pdf_number}}{{ $formula->ket_no}}</td>
              <td class="text-center" width="15%">
                @if($formula->kategori!='fg')
                {{$formula->kategori}}
                @elseif($formula->kategori=='fg')
                Finished Good
                @endif
              </td>
              <td class="text-center">{{ $formula->formula}}</td>
              <td class="text-center">{{ $formula->versi}}.{{ $formula->turunan }}</td>
              <td class="text-center">
                @if ($formula->vv == 'proses') <span class="label label-warning">Proses</span> @endif
                @if ($formula->vv == 'reject') <span class="label label-danger">Rejected</span> @endif 
                @if ($formula->vv == 'approve') <span class="label label-success">Approved</span> @endif 
                @if ($formula->vv == 'final') <span class="label label-info">Final Approved</span> @endif 
                @if ($formula->vv == '') <span class="label label-primary">Belum Diajukan</span> @endif
              </td>
              <td class="text-center">
                <a class="btn btn-warning btn-sm" href="{{ route('insertTemplate',['ftujuan'=>$for,'fasal'=>$formula->id]) }}" onclick="return confirm('Jadikan Template ?')"><i class="fa fa-download"></i> Jadikan Template</a>
              </td>
            </tr>
            @endif
          @else
            @if($formula->kategori=='granulasi')
            <tr style="background-color:white">
              <td>{{ $formula->pkp_number}}{{ $formula->ket_no}}</td>
              <td class="text-center" width="15%">
                @if($formula->kategori!='fg')
                {{$formula->kategori}}
                @elseif($formula->kategori=='fg')
                Finished Good
                @endif
              </td>
              <td class="text-center">{{ $formula->formula}}</td>
              <td class="text-center">{{ $formula->versi}}.{{ $formula->turunan }}</td>
              <td class="text-center">
                @if ($formula->vv == 'proses') <span class="label label-warning">Proses</span> @endif
                @if ($formula->vv == 'reject') <span class="label label-danger">Rejected</span> @endif 
                @if ($formula->vv == 'approve') <span class="label label-success">Approved</span> @endif 
                @if ($formula->vv == 'final') <span class="label label-info">Final Approved</span> @endif 
                @if ($formula->vv == '') <span class="label label-primary">Belum Diajukan</span> @endif
              </td>
              <td class="text-center">
                <a class="btn btn-warning btn-sm" href="{{ route('insertTemplate',['ftujuan'=>$for,'fasal'=>$formula->id]) }}" onclick="return confirm('Jadikan Template ?')"><i class="fa fa-download"></i> Jadikan Template</a>
              </td>
            </tr>
            @endif
          @endif
          @endforeach
        @endif
        </tbody>        
      </table>
      <a href="{{ route('step2',[$ftujuan,$for]) }}" class="btn btn-danger btn-sm" ><i class="fa fa-arrow-left"></i> Back</a>
    </div>
  </div>
</div>
@endsection