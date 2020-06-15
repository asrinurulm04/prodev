@extends('pv.tempvv')
@section('title', 'List PKP')
@section('judulhalaman','Data PKP')
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
    <h3><li class="fa fa-file"> </li> List PKP</h3>
  </div>
    <div class="card-block">
      <div class="clearfix"></div>
      <div class="x_content" >
      <table class="Table table-striped table-bordered">
        <thead>
          <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
            <td width="22%">PKP Number</th>
            <td>Brand</th>
            <td>Status RD Kemas</td>
            <td class="text-center">Status RD Product</th>
            <td class="text-center" width="11%">Destination</th>
            <td>Priority</th>
            <td class="text-center" width="13%">Action</th>
            <td width="14%">Prototype Sample submission status</th>
          </tr>
        </thead>
        <tbody>
          @php
            $no = 0;
          @endphp
          @foreach($pkp as $pkp)
          @if($pkp->status_project!='draf')
          <tr >
            <td>{{$pkp->pkp_number}}{{$pkp->ket_no}}</th>
            <td>{{$pkp->id_brand}}</th>
            </td>
            <td>
              @if($pkp->tujuankirim2!=null)
                @if($pkp->status_project=='sent')
                  @if($pkp->status_terima2=='proses')
                  The project has been sent to the manager
                  @elseif($pkp->status_terima2=='terima')
                  Approve manager
                  @endif
                @elseif($pkp->status_project=='revisi')
                The Project in the revised proses
                @elseif($pkp->status_project=='proses')
                @if($pkp->userpenerima2!=NULL)
                Sent to ({{$pkp->users2->name}})
                @elseif($pkp->userpenerima2==NULL)
                @if($pkp->status_terima2=='proses')
                The project has been sent to the manager
                @elseif($pkp->status_terima2=='terima')
                Approve manager
                @endif
                @endif
                @elseif($pkp->status_project=='close')
                Project has finished
                @endif
              @else
              No Prosess
              @endif
            </td>
            <td>
              @if($pkp->tujuankirim!=1)
                @if($pkp->status_project=='sent')
                  @if($pkp->status_terima=='proses')
                  The project has been sent to the manager
                  @elseif($pkp->status_terima=='terima')
                  Approve manager
                  @endif
                @elseif($pkp->status_project=='revisi')
                The Project in the revised proses
                @elseif($pkp->status_project=='proses')
                @if($pkp->userpenerima!=NULL)
                Sent to ({{$pkp->users->name}})
                @elseif($pkp->userpenerima==NULL)
                @if($pkp->status_terima=='proses')
                New PKP
                @elseif($pkp->status_terima=='terima')
                Approve
                @endif
                @endif
                @elseif($pkp->status_project=='close')
                Project has finished
                @endif
              @else
              No Prosess
              @endif
            </td>
            <td>
              @if($pkp->tujuankirim2=='0')
               {{$pkp->departement->dept}}
              @elseif($pkp->tujuankirim2=='1')
                @if($pkp->tujuankirim!='1')
               {{$pkp->departement->dept}} & {{$pkp->departement2->dept}}
               @elseif($pkp->tujuankirim=='1')
               {{$pkp->departement2->dept}}
               @endif
              @endif
            </th>
            <td class="text-center">
            @if($pkp->prioritas==1)
            <span class="label label-primary" style="color:white">prioritas 1</span>
            @elseif($pkp->prioritas==2)
            <span class="label label-warning" style="color:white">prioritas 2</span>
            @elseif($pkp->prioritas==3)
            <span class="label label-success" style="color:white">prioritas 3</span>
            @endif
            </th>
            @if($pkp->status_project=='sent')
            <td class="text-center">
              <a class="btn btn-info btn-sm" href="{{ Route('rekappkp',$pkp->id_project) }}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a>
              @if($pkp->status_freeze=='inactive')
              @if(auth()->user()->role->namaRule === 'pv_lokal')
              <button title="freeze" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#freezedata{{ $pkp->id_project  }}" data-toggle="tooltip"><li class="fa fa-exclamation-triangle"></i></a></button>
              @endif
                <!-- Modal -->
                <div class="modal" id="freezedata{{ $pkp->id_project }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">{{$pkp->project_name}}
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button></h3>
                      </div>
                      <div class="modal-body">
                        <form class="form-horizontal form-label-left" method="POST" action="{{route('freeze',$pkp->id_project)}}" novalidate>
                        <div class="row x_panel">
                          <label for="" style="color:red;">*required</label><textarea name="notefreeze" required class="col-md-12 col-sm-12 col-xs-12"></textarea>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-dark btn-sm" onclick="return confirm('Are you sure you deactivated this project ?')"><i class="fa fa-cubes"></i> Freeze</button>
                          {{ csrf_field() }}
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Modal Selesai -->
              @elseif($pkp->status_freeze=='active')
                @if($pkp->freeze==Auth::user()->id)
                <button title="active" class="btn btn-default btn-sm" data-toggle="modal" data-target="#freeze{{ $pkp->id_project }}" data-toggle="tooltip" ><i class="fa fa-dropbox"></i></a></button>
                  <!-- Modal -->
                  <div class="modal" id="freeze{{ $pkp->id_project }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h3 class="modal-title" id="exampleModalLabel">{{$pkp->project_name}}
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button></h3>
                        </div>
                        <div class="modal-body">
                          <form class="form-horizontal form-label-left" method="POST" action="{{ Route('ubahTMpkp',$pkp->id_project)}}" novalidate>
                          <div class="row x_panel"><textarea name="" disabled class="col-md-12 col-sm-10 col-xs-12 text-center" rows="3" style="color:red;">{{$pkp->note_freeze}}</textarea><br><br>
                          <br><br><br>
                           <label style="">Timeline sending sample : {{$pkp->jangka}} To {{$pkp->waktu}}
                            <br>
                            <?php
                              $awal  = date_create( $pkp->waktu );
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
                              ?> <br></label> 
                              @if($pkp->status_project!='revisi')
                              @elseif($pkp->status_project=='revisi')
                              <h3><span class="label label-danger" style="color:white">RD subbmitted a revision for this project</span></h3>
                             @endif
                             <input type="hidden" name="lamafreeze" value="Revisi Timeline (Date of data freezeing : {{$pkp->waktu_freeze}})">
                             <input type="hidden" value="{{$pkp->id_project}}" name="pkp" id="pkp">
                          </div>
                          <div class="modal-footer">
                            @if($pkp->status_project!='revisi')
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-paper-plane"></i> Sent</button>
                            {{ csrf_field() }}
                            <a href="{{route('activepkp',$pkp->id_project)}}" type="button" class="btn btn-info btn-sm"><li class="fa fa-check"> Active</li></a>
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
            </th>
            <td>
              @if($pkp->status_freeze=='inactive')
                @if($pkp->pengajuan_sample=='proses')
                    <?php
                      $awal  = date_create( $pkp->waktu );
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
                    @elseif($pkp->pengajuan_sample=='sent')
                    <span class="label label-primary" style="color:white">RD send a sample</span>
                    @elseif($pkp->pengajuan_sample=='reject')
                    <span class="label label-danger" style="color:white">Sample rejected</span>
                    @elseif($pkp->pengajuan_sample=='approve')
                    <span class="label label-info" style="color:white">Sample have been approved</span>
                    @endif
              @elseif($pkp->status_freeze=='active')
                Project Is Inactive
              @endif
            </th>
            @elseif($pkp->status_project=='revisi')
            <td class="text-center">
              <a class="btn btn-info btn-sm" href="{{ Route('rekappkp',$pkp->id_project) }}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a>
            </th>
            <td><span class="label label-danger" style="color:white">RD subbmitted a revision for this project</span></th>
            @elseif($pkp->status_project=='proses')
            <td class="text-center">
              <a class="btn btn-info btn-sm" href="{{ Route('rekappkp',$pkp->id_project) }}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a>
              @if($pkp->status_freeze=='inactive')
              @if(auth()->user()->role->namaRule === 'pv_lokal')
              <button title="freeze" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#freezedata{{ $pkp->id_project  }}" data-toggle="tooltip"><li class="fa fa-exclamation-triangle"></i></a></button>
              @endif
                <!-- Modal -->
                  <div class="modal" id="freezedata{{ $pkp->id_project }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h3 class="modal-title" id="exampleModalLabel">{{$pkp->project_name}}
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button></h3>
                        </div>
                        <div class="modal-body">
                          <form class="form-horizontal form-label-left" method="POST" action="{{route('freeze',$pkp->id_project)}}" novalidate>
                          <div class="row x_panel">
                            <label for="" style="color:red;">*required</label><textarea name="notefreeze" required class="col-md-12 col-sm-12 col-xs-12"></textarea>
                          </div>
                          <div class="row x_panel">
                            <textarea name="notefreeze" class="col-md-12 col-sm-12 col-xs-12"></textarea>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-dark btn-sm" onclick="return confirm('Are you sure you deactivated this project ?')"><i class="fa fa-cubes"></i> Freeze</button>
                            {{ csrf_field() }}
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Modal Selesai -->
              @elseif($pkp->status_freeze=='active')
                @if($pkp->freeze==Auth::user()->id)
                <button  title="note" class="btn btn-default btn-sm" data-toggle="modal" data-target="#freeze{{ $pkp->id_project  }}" data-toggle="tooltip"><i class="fa fa-dropbox"></i></a></button>
                  <!-- Modal -->
                  <div class="modal" id="freeze{{ $pkp->id_project }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h3 class="modal-title" id="exampleModalLabel">{{$pkp->project_name}}
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button></h3>
                        </div>
                        <div class="modal-body">
                          <form class="form-horizontal form-label-left" method="POST" action="{{ Route('ubahTMpkp',$pkp->id_project)}}" novalidate>
                          <div class="row x_panel"><textarea name="" disabled class="col-md-12 col-sm-10 col-xs-12 text-center" rows="3" style="color:red;">{{$pkp->note_freeze}}</textarea><br><br>
                          <br><br><br>
                           <label style="">Timeline sending sample : {{$pkp->jangka}} To {{$pkp->waktu}}
                            <br>
                            <?php
                              $awal  = date_create( $pkp->waktu );
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
                              ?> <br></label>
                              @if($pkp->status_project!='revisi')
                              @elseif($pkp->status_project=='revisi')
                              <h3><span class="label label-danger" style="color:white">RD subbmitted a revision for this project</span></h3>
                             @endif
                             <input type="hidden" name="lamafreeze" value="Revisi Timeline (Date of data freezeing : {{$pkp->waktu_freeze}})">
                             <input type="hidden" value="{{$pkp->id_project}}" name="pkp" id="pkp">
                          </div>
                          <div class="modal-footer">
                            @if($pkp->status_project!='revisi')
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-paper-plane"></i> Sent</button>
                            {{ csrf_field() }}
                            <a href="{{route('activepkp',$pkp->id_project)}}" type="button" class="btn btn-info btn-sm"><li class="fa fa-check"> Active</li></a>
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
            </th>
            <td>
              @if($pkp->status_freeze=='inactive')
              @if($pkp->pengajuan_sample=='proses')
              <?php
                $awal  = date_create( $pkp->waktu );
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
              @elseif($pkp->pengajuan_sample=='sent')
              <span class="label label-primary" style="color:white">RD send a sample</span>
              @elseif($pkp->pengajuan_sample=='reject')
              <span class="label label-danger" style="color:white">Sample rejected</span>
              @elseif($pkp->pengajuan_sample=='approve')
              <span class="label label-info" style="color:white">Sample have been approved</span>
              @endif
              @elseif($pkp->status_freeze=='active')
              Project Is Inactive
              @endif
            </th>
            @elseif($pkp->status_project=='close')
            <td class="text-center">
              <a class="btn btn-info btn-sm" href="{{ Route('rekappkp',$pkp->id_project) }}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a>
              <button data-toggle="tooltip" class="btn btn-success btn-sm" title="note" data-toggle="modal" data-target="#ajukan{{ $pkp->id_project  }}"><i class="fa fa-sticky-note"></i></a></button>
              <!-- Modal -->
              <div class="modal" id="ajukan{{ $pkp->id_project  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h3 class="modal-title" id="exampleModalLabel">Note Project
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button></h3>
                    </div>
                    <div class="modal-body">
                      <div class="row x_panel">
                        <textarea name="note" disabled class="col-md-12 col-sm-12 col-xs-12">{{$pkp->catatan}}</textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Modal Selesai -->
            </th>
            <td>
              @if($pkp->userpenerima2==null)
              Has been sent to {{$pkp->users->name}}
              @elseif($pkp->userpenerima2!=null)
              Has been sent to {{$pkp->users->name}} and {{$pkp->users2->name}}
              @endif  
            </th>
            @endif
          </tr>
          @endif
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>

@endsection