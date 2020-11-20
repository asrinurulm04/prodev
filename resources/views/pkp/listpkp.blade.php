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
            <th width="22%">PKP Number</th>
            <th>Brand</th>
            <th>Status RD Kemas</td>
            <th class="text-center">Status RD Product</th>
            <th class="text-center" width="11%">Destination</th>
            <th>Priority</th>
            <th class="text-center" width="15%">Action</th>
            <th width="14%">Prototype Sample submission status</th>
          </tr>
        </thead>
        <tbody>
          @php
            $no = 0;
          @endphp
          @foreach($pkp as $pkp)
          @if($pkp->status_project!='draf')
          <tr >
            <td>{{$pkp->pkp_number}}{{$pkp->ket_no}}</td>
            <td>{{$pkp->id_brand}}</td>
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
            </td>
            <td class="text-center">
            @if($pkp->prioritas==1)
            <span class="label label-primary" style="color:white">prioritas 1</span>
            @elseif($pkp->prioritas==2)
            <span class="label label-warning" style="color:white">prioritas 2</span>
            @elseif($pkp->prioritas==3)
            <span class="label label-success" style="color:white">prioritas 3</span>
            @endif
            </td>
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
                          <label for="" style="color:red;">Note *required</label><textarea name="notefreeze" required class="col-md-12 col-sm-12 col-xs-12"></textarea>
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
                          {{-- <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-paper-plane"></i> Sent</button> --}}
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
            </td>
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
            </td>
            @elseif($pkp->status_project=='revisi')
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
                          <label for="" style="color:red;">Note *required</label>
                          <textarea name="notefreeze" required class="col-md-12 col-sm-12 col-xs-12"></textarea>
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
                              <h3><span class="label label-danger" style="color:white">Revisi</span></h3>
                             @endif
                             <input type="hidden" name="lamafreeze" value="Revisi Timeline (Date of data freezeing : {{$pkp->waktu_freeze}})">
                             <input type="hidden" value="{{$pkp->id_project}}" name="pkp" id="pkp">
                          </div>
                          <div class="modal-footer">
                            @if($pkp->status_project=='revisi')
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
            </td>
            <td><span class="label label-danger" style="color:white">RD subbmitted a revision for this project</span></th>
            @elseif($pkp->status_project=='proses')
            <td class="text-center">
              <a class="btn btn-info btn-sm" href="{{ Route('rekappkp',$pkp->id_project) }}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a>
              @if($pkp->status_freeze=='inactive')
                @if(auth()->user()->role->namaRule === 'pv_lokal')
                <button title="freeze" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#freezedata{{ $pkp->id_project  }}" data-toggle="tooltip"><li class="fa fa-exclamation-triangle"></i></a></button>
                <button title="Close" class="btn btn-success btn-sm" data-toggle="modal" data-target="#closedata{{ $pkp->id_project  }}" data-toggle="tooltip" titel="close"><li class="fa fa-power-off"></i></a></button>
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
                          <label for="" style="color:red;">Note *required</label>
                          <textarea name="notefreeze" required class="col-md-12 col-sm-12 col-xs-12"></textarea>
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
                <!-- Modal -->
                <div class="modal" id="closedata{{ $pkp->id_project }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h3 class="modal-title text-center" id="exampleModalLabel">Close Project {{$pkp->project_name}}
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button></h3>
                      </div>
                      <div class="modal-body text-left">
                        <form class="form-horizontal form-label-left" method="POST" action="{{route('closeproject',$pkp->id_project)}}" enctype="multipart/form-data">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="x_panel">
                                <div class="card-block">
                                  <?php $date = Date('j-F-Y'); ?>
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Date</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                      <input required id="date" value="{{$date}}" required="required" class="form-control col-md-12 col-xs-12" type="text" name="date" readonly><br><br><br>
                                    </div>
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Project Name</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input required id="project" value="{{$pkp->project_name}}" required="required" class="form-control col-md-12 col-xs-12" type="text" name="project" readonly><br><br><br>
                                    </div>
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Name</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                      <input required id="product" required="required" class="form-control col-md-12 col-xs-12" type="text" name="product" ><br><br><br>
                                    </div>
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Pormula Baku</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                      <input required id="baku" required="required" class="form-control col-md-12 col-xs-12" type="text" name="baku" ><br><br><br>
                                    </div>
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Formula Kemas</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                      <textarea name="kemas" id="kemas" cols="30" rows="2"></textarea><br><br>
                                    </div>
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Price List</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                      <input required id="price" required="required" class="form-control col-md-12 col-xs-12" type="text" name="price" ><br><br><br>
                                    </div>
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Forecast</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                      <input required id="forecast" required="required" class="form-control col-md-12 col-xs-12" type="text" name="forecast" ><br><br><br>
                                    </div>
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">RTO</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                      <input required id="rto" required="required" class="form-control col-md-12 col-xs-12" type="text" name="rto" ><br><br><br>
                                    </div>
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Note</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                      <input required id="note" required="required" class="form-control col-md-12 col-xs-12" type="text" name="note" ><br><br><br>
                                    </div>
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Barcode</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                      <input type="file" name="filename[]" class="form-control">
                                    </div>
                                </div>
                              </div>
                            </div>
                          </div>
                      </div>
                      @if($pkp->tujuankirim2!=NULL)
                        @if ($pkp->userpenerima2!=Null && $pkp->userpenerima!=Null)
                        <input type="hidden" name="penerima1" id="penerima1" value="{{$pkp->departement->users->email}}">
                        <input type="hidden" name="penerima2" id="penerima2" value="{{$pkp->departement2->users->email}}">
                        <input type="hidden" name="penerima3" id="penerima3" value="{{$pkp->users->email}}">
                        <input type="hidden" name="penerima4" id="penerima4" value="{{$pkp->users2->email}}">
                        @elseif($pkp->userpenerima==NULL)
                        <input type="hidden" name="penerima1" id="penerima1" value="{{$pkp->departement->users->email}}">
                        <input type="hidden" name="penerima2" id="penerima2" value="{{$pkp->departement2->users->email}}">
                        <input type="hidden" name="penerima4" id="penerima4" value="{{$pkp->users2->email}}">
                        @elseif($pkp->userpenerima2==NULL)
                        <input type="hidden" name="penerima1" id="penerima1" value="{{$pkp->departement->users->email}}">
                        <input type="hidden" name="penerima2" id="penerima2" value="{{$pkp->departement2->users->email}}">
                        <input type="hidden" name="penerima3" id="penerima3" value="{{$pkp->users->email}}">
                        @endif
                      @elseif($pkp->tujuankirim2==NULL)
                        @if($pkp->userpenerima!=NULL)
                        <input type="hidden" name="penerima1" id="penerima1" value="{{$pkp->departement->users->email}}">
                        <input type="hidden" name="penerima3" id="penerima3" value="{{$pkp->users->email}}">
                        @else
                        <input type="hidden" name="penerima1" id="penerima1" value="{{$pkp->departement->users->email}}">
                        @endif
                      @endif
                      <input type="hidden" value="{{$pkp->author1->email}}" name="author" id="author">
                      <!-- <input type="text" value="{{$pkp->datapkp->perevisi2}}" name="perevisi" id="perevisi"> -->
                      <input type="hidden" value="{{auth()->user()->email}}" name="perevisi" id="user">
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Are you sure close this project ?')"><i class="fa fa-power-off"></i> Close</button>
                        {{ csrf_field() }}
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Modal Selesai -->
              @elseif($pkp->status_freeze=='active')
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
                              <h3><span class="label label-danger" style="color:white">Revisi</span></h3>
                             @endif
                             <input type="hidden" name="lamafreeze" value="Revisi Timeline (Date of data freezeing : {{$pkp->waktu_freeze}})">
                             <input type="hidden" value="{{$pkp->id_project}}" name="pkp" id="pkp">
                          </div>
                          <div class="modal-footer">
                            @if($pkp->status_project!='revisi')
                            {{-- <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-paper-plane"></i> Sent</button> --}}
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
            </td>
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
            </td>
            @elseif($pkp->status_project=='close')
            <td class="text-center">
              <a class="btn btn-info btn-sm" href="{{ Route('rekappkp',$pkp->id_project) }}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a>
              <button  class="btn btn-warning btn-sm" title="note launch" data-toggle="modal" data-target="#ajukan{{ $pkp->id_project  }}" data-toggle="tooltip"><i class="fa fa-sticky-note"></i></a></button>
              <!-- Modal -->
              <div class="modal" id="ajukan{{ $pkp->id_project  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h3 class="modal-title" id="exampleModalLabel">Note Launch Project
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button></h3>
                    </div>
                    <div class="modal-body">
                      <div class="row text-left">
                        <div class="col-md-12">
                          <div class="x_panel">
                            <div class="card-block">
                              <?php $date = Date('j-F-Y'); ?>
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Date</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                  <input required id="date" value="{{$date}}" required="required" class="form-control col-md-12 col-xs-12" type="text" name="date" readonly><br><br><br>
                                </div>
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Project Name</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                <input required id="project" value="{{$pkp->project_name}}" required="required" class="form-control col-md-12 col-xs-12" type="text" name="project" readonly><br><br><br>
                                </div>
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Name</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                  <input required id="product" required="required" value="{{$pkp->launch->nama_produk}}" class="form-control col-md-12 col-xs-12" type="text" name="product" readonly><br><br><br>
                                </div>
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Formula Baku</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                  <input required id="baku" required="required" value="{{$pkp->launch->formula_baku}}" class="form-control col-md-12 col-xs-12" type="text" name="baku" readonly><br><br><br>
                                </div>
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Formula Kemas</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                  <textarea name="kemas" id="kemas" value="{{$pkp->launch->formula_kemas}}" cols="30" rows="2" disabled>{{$pkp->launch->formula_kemas}}</textarea><br><br>
                                </div>
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Price List</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                  <input required id="price" required="required" value="{{$pkp->launch->price_list}}" class="form-control col-md-12 col-xs-12" type="text" name="price" readonly><br><br><br>
                                </div>
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Forecast</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                  <input required id="forecast" required="required" value="{{$pkp->launch->forecast}}" class="form-control col-md-12 col-xs-12" type="text" name="forecast" readonly><br><br><br>
                                </div>
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">RTO</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                  <input required id="rto" required="required" value="{{$pkp->launch->rto}}" class="form-control col-md-12 col-xs-12" type="text" name="rto" readonly><br><br><br>
                                </div>
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Note</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                  <input required id="note" required="required" value="{{$pkp->launch->note}}" class="form-control col-md-12 col-xs-12" type="text" name="note" readonly><br><br><br>
                                </div>
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Barcode</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                  <embed src="{{asset('data_file/'.$pkp->launch->barcode)}}" width="200px" height="200" type="">
                                </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Modal Selesai -->
            </td>
            <td>
              this project is finished
            </td>
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