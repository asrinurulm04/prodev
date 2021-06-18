@extends('pv.tempvv')
@section('title', 'PRODEV|List PDF')
@section('content')

@if (session('status'))
<div class="col-lg-12 col-md-12 col-sm-12">
  <div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{ session('status') }}
  </div>
</div>
@elseif(session('error'))
<div class="col-lg-12 col-md-12 col-sm-12">
  <div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{ session('error') }}
  </div>
</div>
@endif

<div class="x_panel">
  <div class="x_title">
    <h3><li class="fa fa-wpforms"></li> List PDF</h3>
  </div>
  <div class="card-block">
    <div class="clearfix"></div>
    <div class="x_content">
      <table id="datatable" class="table table-striped table-bordered ex" style="width:100%">
        <thead>
          <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
            <th>#</th>
            <th>PDF Number</th>
            <th>Project Name</th>
            <th>Brand</th>
            <th width="13%">PV</th>
            <th class="text-center">Priority</th>
            <th class="text-center">Prototype Sample submission status</th>
            <th width="15%" class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          @php $no = 0; @endphp
          @foreach($pdf as $pdf)
          @if($pdf->userpenerima2=='NULL')
            @if($pdf->userpenerima==Auth::user()->id)
            <tr>
              <td>{{ ++$no }}</td>
              <td>{{$pdf->pdf_number}}{{$pdf->ket_no}}</td>
              <td>{{ $pdf->project_name }}</td>
              <td>{{ $pdf->id_brand }}</td>
              <td>{{ $pdf->datappdf->perevisi2->name }}</td>
              <td class="text-center">
                @if($pdf->prioritas=='1')
                <span class="label label-danger">Prioritas 1</span>
                @elseif($pdf->prioritas=='2')
                <span class="label label-warning">Prioritas 2</span>
                @elseif($pdf->prioritas=='3')
                <span class="label label-primary">Prioritas 3</span>
                @endif
              </td>
              <td>
                @if($pdf->status_freeze=='inactive')
                  @if($pdf->pengajuan_sample=='proses')
                  <?php
                    $awal  = date_create( $pdf->waktu );
                    $akhir = date_create(); // waktu sekarang
                    if($akhir<=$awal) {
                      $diff  = date_diff( $akhir, $awal );
                      echo ' You Have ';
                      echo $diff->m . ' Month, ';
                      echo $diff->d . ' Days, ';
                      echo $diff->h . ' Hours, ';
                      echo ' To sending Sample ';
                    }else{
                      echo ' Your Time Is Up ';
                    }
                  ?>
                  @elseif($pdf->pengajuan_sample=='sent')
                  Sample has been sent to PV
                  @elseif($pdf->pengajuan_sample=='reject')
                  Sample rejected by PV
                  @elseif($pdf->pengajuan_sample=='approve')
                  Sample has been approved by PV
                  @endif
                @elseif($pdf->status_freeze=='active')
                  Project Is Inactive
                @endif
              </td>
              <td class="text-center">
                @if($pdf->status_project=='proses')  
                  <a class="btn btn-info btn-sm" href="{{ Route('rekappdf',$pdf->id_project_pdf)}}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a>
                @elseif($pdf->status_project=='revisi')
                  The Project in the revised proses
                @elseif($pdf->status_project=='close')
                <a class="btn btn-info btn-sm" href="{{ Route('rekappdf',$pdf->id_project_pdf)}}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a>
                <button class="btn btn-info btn-sm" disabled><li class="fa fa-smile-o" title="close"></li></button>
                @endif
              </td>
            </tr>
            @endif
          @else($pdf->userpenerima2!='NULL')
            @if($pdf->userpenerima==Auth::user()->id || $pdf->userpenerima2==Auth::user()->id)
            <tr>
              <td>{{ ++$no }}</td>
              <td>{{$pdf->pdf_number}}{{$pdf->ket_no}}</td>
              <td>{{ $pdf->project_name }}</td>
              <td>{{ $pdf->id_brand }}</td>
              <td>{{ $pdf->datappdf->perevisi2->name }}</td>
              <td class="text-center">
                @if($pdf->prioritas=='1')
                <span class="label label-danger">Prioritas 1</span>
                @elseif($pdf->prioritas=='2')
                <span class="label label-warning">Prioritas 2</span>
                @elseif($pdf->prioritas=='3')
                <span class="label label-primary">Prioritas 3</span>
                @endif
              </td>
              <td>
                @if($pdf->status_freeze=='inactive')
                  @if($pdf->pengajuan_sample=='proses')
                  <?php
                    $awal  = date_create( $pdf->waktu );
                    $akhir = date_create(); // waktu sekarang
                    if($akhir<=$awal){
                      $diff  = date_diff( $akhir, $awal );
                      echo ' You Have ';
                      echo $diff->m . ' Month, ';
                      echo $diff->d . ' Days, ';
                      echo $diff->h . ' Hours, ';
                      echo ' To sending Sample ';
                    }else{
                      echo ' Your Time Is Up ';
                    }
                  ?>
                  @elseif($pdf->pengajuan_sample=='sent')
                  Sample has been sent to PV
                  @elseif($pdf->pengajuan_sample=='reject')
                  Sample rejected by PV
                  @elseif($pdf->pengajuan_sample=='approve')
                  Sample has been approved by PV
                  @endif
                @elseif($pdf->status_freeze=='active')
                  Project Is Inactive
                @endif
              </td>
              <td class="text-center">
                @if($pdf->status_project=='proses')
                  @if($pdf->workbook!='0')
                  <a class="btn btn-primary btn-sm" href="{{ Route('rekappdf',$pdf->id_project_pdf)}}" data-toggle="tooltip" title="Show"><i class="fa fa-book"></i></a>
                  @elseif($pdf->workbook=='0')
                  <a class="btn btn-info btn-sm" href="{{ Route('rekappdf',$pdf->id_project_pdf)}}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a>
                  @endif
                @elseif($pdf->status_project=='revisi')
                  The Project in the revised proses
                @elseif($pdf->status_project=='close')
                  <a class="btn btn-info btn-sm" href="{{ Route('rekappdf',$pdf->id_project_pdf)}}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a>
                @endif
              </td>
            </tr>
            @endif
          @endif
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection

@section('s')
<link href="{{ asset('lib/advanced-datatable/css/jquery.dataTables.css') }}" rel="stylesheet" />
<script src="{{ asset('js/datatables.min.js')}}"></script>
@endsection