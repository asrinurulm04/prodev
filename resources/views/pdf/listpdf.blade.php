@extends('layout.tempvv')
@section('title', 'PRODEV|List PDF')
@section('content')

@if (session('status'))
<div class="col-lg-12 col-md-12 col-sm-12">
  <div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{ session('status') }}
  </div>
</div>
@endif

<div class="x_panel">
  <div class="x_title">
    <h3><li class="fa fa-file"> </li> List PDF</h3>
  </div>
  <div class="card-block">
    <div class="clearfix"></div>
    <div class="x_content">
      <table id="datatable" class="table table-striped table-bordered" style="width:100%">
        <thead>
          <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
            <th class="text-center" width="22%">PDF Number</th>
            <th class="text-center">Brand</th>
            <th class="text-center">Status RD Kemas</td>
            <th class="text-center">Status RD Product</th>
            <th class="text-center" width="11%">Destination</th>
            <th class="text-center">Priority</th>
            <th class="text-center" width="13%">Action</th>
            <th width="14%">Prototype Sample submission status</th>
          </tr>
        </thead>
        <tbody>
          @foreach($pdf as $pdf)
          <tr>
            <td>{{ $pdf->pdf_number}}{{$pdf->ket_no}}</td>
            <td>{{ $pdf->id_brand }}</td>
            <td>
              @if($pdf->tujuankirim2!=null)
                @if($pdf->status_project=='sent')
                  @if($pdf->status_terima2=='proses')
                    The project has been sent to the manager
                  @elseif($pdf->status_terima2=='terima')
                    Approve manager
                  @endif
                @elseif($pdf->status_project=='revisi')
                  The Project in the revised proses
                @elseif($pdf->status_project=='proses')
                  @if($pdf->userpenerima2!=NULL)
                    Sent to ({{$pdf->users2->name}})
                  @elseif($pdf->userpenerima2==NULL)
                    @if($pdf->status_terima2=='proses')
                      The project has been sent to the manager
                    @elseif($pdf->status_terima2=='terima')
                      Approve manager
                    @endif
                  @endif
                @elseif($pdf->status_project=='close')
                  Project has finished
                @endif
              @else
                No Prosess
              @endif
            </td>
            <td>
              @if($pdf->tujuankirim!=1)
                @if($pdf->status_project=='sent')
                  @if($pdf->status_terima=='proses')
                    The project has been sent to the manager
                  @elseif($pdf->status_terima=='terima')
                    Approve manager
                  @endif
                @elseif($pdf->status_project=='revisi')
                  The Project in the revised proses
                @elseif($pdf->status_project=='proses')
                  @if($pdf->userpenerima!=NULL)
                    Sent to ({{$pdf->users->name}})
                  @elseif($pdf->userpenerima==NULL)
                    @if($pdf->status_terima=='proses')
                      The project has been sent to the manager
                    @elseif($pdf->status_terima=='terima')
                      Approve
                    @endif
                  @endif
                @elseif($pdf->status_project=='close')
                  Project has finished
                @endif
              @else
                No Prosess
              @endif
            </td>
            <td>
              @if($pdf->tujuankirim2=='0')
              {{$pdf->departement->dept}}
              @elseif($pdf->tujuankirim2=='1')
                @if($pdf->tujuankirim!='1')
                {{$pdf->departement->dept}} And {{$pdf->departement2->dept}}
                @elseif($pdf->tujuankirim=='1')
                {{$pdf->departement2->dept}}
                @endif
              @endif
            </td>
            <td class="text-center">
              @if($pdf->prioritas==1) <span class="label label-primary" style="color:white">prioritas 1</span>
              @elseif($pdf->prioritas==2) <span class="label label-warning" style="color:white">prioritas 2</span>
              @elseif($pdf->prioritas==3) <span class="label label-success" style="color:white">prioritas 3</span>
              @endif
            </td>
            <td class="text-center">
              <a class="btn btn-info btn-sm" href="{{ Route('rekappdf',$pdf->id_project_pdf )}}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a>
              @if($pdf->status_freeze=='inactive')
                @if(auth()->user()->role->namaRule === 'pv_global')
                  <button title="Freeze" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#freezedata{{ $pdf->id_project_pdf  }}"  data-toggle="tooltip"><li class="fa fa-exclamation-triangle"></i></a></button>
                @endif
                <!-- Modal -->
                <div class="modal" id="freezedata{{ $pdf->id_project_pdf }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">{{$pdf->project_name}}
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button></h3>
                      </div>
                      <div class="modal-body">
                        <form class="form-horizontal form-label-left" method="POST" action="{{route('freezepdf',$pdf->id_project_pdf)}}" novalidate>
                        <div class="row x_panel">
                          <label for="" style="color:red;">*required</label><textarea name="notefreeze" required class="col-md-12 col-sm-12 col-xs-12"></textarea>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-dark" onclick="return confirm('Are you sure you deactivated this project ?')"><i class="fa fa-cubes"></i> Freeze</button>
                          {{ csrf_field() }}
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Modal Selesai -->
              @elseif($pdf->status_freeze=='active')
                @if($pdf->freeze==Auth::user()->id)
                  <button title="note"  class="btn btn-default btn-sm" data-toggle="modal" data-target="#freeze{{ $pdf->id_project_pdf  }}"  data-toggle="tooltip"><i class="fa fa-dropbox"></i></a></button>
                  <!-- Modal -->
                  <div class="modal" id="freeze{{ $pdf->id_project_pdf }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h3 class="modal-title" id="exampleModalLabel">{{$pdf->project_name}}
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button></h3>
                        </div>
                        <div class="modal-body">
                        <form class="form-horizontal form-label-left" method="POST" action="{{ Route('ubahTMpdf',$pdf->id_project_pdf)}}" novalidate>
                          <div class="row x_panel">
                            <textarea name="" disabled class="col-md-12 col-sm-10 col-xs-12 text-center" rows="3" style="color:red;">{{$pdf->note_freeze}}</textarea><br><br><br><br><br>
                            <label style="color:blue;">Timeline : {{$pdf->jangka}} To {{$pdf->waktu}} <br>
                            <?php
                              $awal  = date_create( $pdf->waktu );
                              $akhir = date_create(); // waktu sekarang
                              if($akhir<=$awal)
                              {
                                $diff  = date_diff( $akhir, $awal );
                                echo ' You Have ';
                                echo $diff->m . ' Month, ';
                                echo $diff->d . ' Days, ';
                                echo $diff->h . ' Hours, ';
                                echo ' To Complite This Project ';
                              }else{
                                echo ' Your Time Is Up ';
                              }
                            ?><br>
                            </lable>
                            <input type="hidden" name="lamafreeze" value="Revisi Timeline (Date of data freezeing : {{$pdf->waktu_freeze}})">
                            <input type="hidden" value="{{$pdf->id_project_pdf}}" name="pdf" id="pdf">
                          </div>
                          <div class="modal-footer">
                            @if($pdf->status_project!='revisi')
                            <a href="{{route('activepdf',$pdf->id_project_pdf)}}" type="button" class="btn btn-info btn-sm"><li class="fa fa-check"> Active</li></a>
                            @endif
                          </div>
                        </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Modal Selesai -->
                @endif
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
                @elseif($pdf->pengajuan_sample=='sent') <span class="label label-primary" style="color:white">RD send a sample</span>
                @elseif($pdf->pengajuan_sample=='reject') <span class="label label-danger" style="color:white">Sample rejected</span>
                @elseif($pdf->pengajuan_sample=='approve') <span class="label label-info" style="color:white">Sample have been approved</span>
                @endif
              @elseif($pdf->status_freeze=='active')
                Project Is Inactive
              @endif
            </td>
          </tr>
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