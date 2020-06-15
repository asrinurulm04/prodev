@extends('pv.tempvv')
@section('title', 'List PDF')
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
    <h3><li class="fa fa-file"> </li> List PDF</h3>
  </div>
  <div class="card-block">
    <div class="clearfix"></div>
    <div class="x_content">
      <table class="Table stylish-table table-striped table-bordered dtables">
        <thead>
          <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
            <td>#</td>
            <td>No PDF</td>
            <td>Brand</td>
            <td>Status</td>
            <td>Status Project</td>
            <td class="text-center">Destination</td>
            <td>Priority</td>
            <td width="15%" class="text-center">Action</td>
            <td width="15%">Information</td>
          </tr>
        </thead>
        <tbody>
          <tr>
          @php $no = 0; @endphp
          @foreach($pdf as $pdf)
          @if($pdf->status_project!="draf")
          <td class="text-center">{{ ++$no }}</td>
          <td>{{ $pdf->pdf_number}}{{$pdf->ket_no}}</td>
          <td>{{ $pdf->id_brand }}</td>
          <td class="text-center">{{ $pdf->approval }}</td>
          <td>
            @if($pdf->status_project=='sent')
            The project has been sent to the manager
            @elseif($pdf->status_project=='revisi')
            The Project in the revised proses
            @elseif($pdf->status_project=='proses')
            The project has been sent to the manager and user
            @elseif($pdf->status_project=='close')
            Project has finished
            @endif
          </td>
          <td>
          @if($pdf->tujuankirim2=='0')
          Manager {{$pdf->departement->dept}}
          @elseif($pdf->tujuankirim2=='1')
          Manager {{$pdf->departement->dept}} and Manager {{$pdf->departement2->dept}}
          @endif
          </td>
            <td class="text-center">
              @if($pdf->prioritas==1)
              <span class="label label-primary" style="color:white">prioritas 1</span>
              @elseif($pdf->prioritas==2)
              <span class="label label-warning" style="color:white">prioritas 2</span>
              @elseif($pdf->prioritas==3)
              <span class="label label-success" style="color:white">prioritas 3</span>
              @endif
            </td>
          @if($pdf->status_project=='sent')
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
              <button title="note"  data-toggle="tooltip" class="btn btn-default btn-sm" data-toggle="modal" data-target="#freeze{{ $pdf->id_project_pdf  }}"><i class="fa fa-dropbox"></i></a></button>
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
                        <textarea name="" disabled class="col-md-12 col-sm-10 col-xs-12 text-center" rows="3" style="color:red;">{{$pdf->note_freeze}}</textarea><br><br>
                        <br><br><br>
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
                          ?> <br></lable>
                          @if($pdf->status_project!='revisi')
                          <h3> Sent request for a change in schedule </h3>
                          @elseif($pdf->status_project=='revisi')
                          <h3>Data In The Revision Process</h3>
                          @endif
                          <input type="hidden" name="lamafreeze" value="Revisi Timeline (Date of data freezeing : {{$pdf->waktu_freeze}})">
                              <input type="hidden" value="{{$pdf->id_project_pdf}}" name="pdf" id="pdf">
                        </div>
                        <div class="modal-footer">
                          @if($pdf->status_project!='revisi')
                          <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-paper-plane"></i> Sent</button>
                          {{ csrf_field() }}
                          <a href="{{route('activepdf',$pdf->id_project_pdf)}}" type="button" class="btn btn-info"><li class="fa fa-check"> Active</li></a>
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
                      if($akhir<=$awal)
                      {
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
                    <span class="label label-primary" style="color:white">RD send a sample</span>
                    @elseif($pdf->pengajuan_sample=='reject')
                    <span class="label label-danger" style="color:white">Sample rejected</span>
                    @elseif($pdf->pengajuan_sample=='approve')
                    <span class="label label-info" style="color:white">Sample have been approved</span>
                    @endif
              @elseif($pdf->status_freeze=='active')
                Project Is Inactive
              @endif
          </td>
          @elseif($pdf->status_project=='revisi')
          <td class="text-center"><a class="btn btn-info btn-sm" href="{{ Route('rekappdf',$pdf->id_project_pdf )}}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a></td>
          <td>Data In The Revision Process</td>
          @elseif($pdf->status_project=='proses')
          <td class="text-center">
            <a class="btn btn-info btn-sm" href="{{ Route('rekappdf',$pdf->id_project_pdf )}}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a>
            @if($pdf->status_freeze=='inactive')
            @if(auth()->user()->role->namaRule === 'pv_global')
            <button title="Freeze" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#freezedata{{ $pdf->id_project_pdf  }}" data-toggle="tooltip"><li class="fa fa-exclamation-triangle"></i></a></button>
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
              <button title="note"  data-toggle="tooltip" class="btn btn-default btn-sm" data-toggle="modal" data-target="#freeze{{ $pdf->id_project_pdf  }}"><i class="fa fa-dropbox"></i></a></button>
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
                      <textarea name="" disabled class="col-md-12 col-sm-10 col-xs-12 text-center" rows="3" style="color:red;">{{$pdf->note_freeze}}</textarea><br><br>
                        <br><br><br>
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
                        ?> <br></lable>
                        @if($pdf->status_project!='revisi')
                        <h3> Sent request for a change in schedule </h3>
                        @elseif($pdf->status_project=='revisi')
                        <h3>Data In The Revision Process</h3>
                        @endif
                        <input type="hidden" name="lamafreeze" value="Revisi Timeline (Date of data freezeing : {{$pdf->waktu_freeze}})">
                             <input type="hidden" value="{{$pdf->id_project_pdf}}" name="pdf" id="pdf">
                      </div>
                      <div class="modal-footer">
                        @if($pdf->status_project!='revisi')
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-paper-plane"></i> Sent</button>
                        {{ csrf_field() }}
                        <a href="{{route('activepdf',$pdf->id_project_pdf)}}" type="button" class="btn btn-info"><li class="fa fa-check"> Active</li></a>
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
              Has been sent to {{$pdf->users->name}}
            @elseif($pdf->status_freeze=='active')
              Project Is Inactive
             @endif
          </td>
          @elseif($pdf->status_project=='close')
          <td class="text-center"><a class="btn btn-info btn-sm" href="{{ Route('rekappdf',$pdf->id_project_pdf )}}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a>
          <button class="btn btn-info btn-sm" data-toggle="tooltip" disabled title="close"><li class="fa fa-smile-o"></li></button>
          </td>
          <td>Project Finish</td>
            @endif
            @endif
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection