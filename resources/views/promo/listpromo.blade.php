@extends('pv.tempvv')
@section('title', 'PRODEV|Data PKP promo')
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

<div class="row">
  <div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
      <div class="x_title">
        <h2><li class="fa fa-file"> </li> List PROMO</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="card-box table-responsive">
          <table id="datatable" class="table table-striped table-bordered" style="width:100%">
            <thead>
              <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                <td class="text-center">PKP Number</td>
                <td>Brand</td>
                <td>Author</td>
                <td class="text-center">Status</td>
                <td class="text-center">Destination</td>
                <td>Priority</td>
                <td width="17%" class="text-center">Action</td>
                <td class="text-center" width="15%">Information</td>
              </tr>
            </thead>
            <tbody>
              <tr>
                @php
                  $no = 0;
                @endphp
                @foreach($promo as $pkp)
                @if($pkp->status_project!="draf")
                <td>{{ $pkp->promo_number}}{{$pkp->ket_no}}</td>
                <td>{{ $pkp->brand }}</td>
                <td>{{ $pkp->author1->name }}</td>
                <td>
                  @if($pkp->status_project=='sent')
                  The project has been sent to the manager
                  @elseif($pkp->status_project=='revisi')
                  The Project in the revised proses
                  @elseif($pkp->status_project=='proses')
                  The project has been sent to the manager and user
                  @elseif($pkp->status_project=='close')
                  Project has finished
                  @endif
                </td>
                <td>
                  @if($pkp->tujuankirim2=='0')
                  Manager {{$pkp->departement->dept}}
                  @elseif($pkp->tujuankirim2=='1')
                  Manager {{$pkp->departement->dept}} and Manager {{$pkp->departement2->dept}}
                  @endif
                </td>
                <td class="text-center">
                  @if($pkp->prioritas==1)<span class="label label-primary" style="color:white">prioritas 1</span>
                  @elseif($pkp->prioritas==2)<span class="label label-warning" style="color:white">prioritas 2</span>
                  @elseif($pkp->prioritas==3)<span class="label label-success" style="color:white">prioritas 3</span>
                  @endif
                </td>
                @if($pkp->status_project=='sent')
                <td class="text-center">
                  <a class="btn btn-info btn-sm" href="{{ Route('rekappromo',$pkp->id_pkp_promo)}}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a>
                  @if($pkp->status_freeze=='inactive')
                  @if(auth()->user()->role->namaRule === 'pv_lokal')
                  <button title="Freeze" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#freezedata{{ $pkp->id_pkp_promo  }}" data-toggle="tooltip"><li class="fa fa-exclamation-triangle"></i></a></button>
                  @endif
                    <!-- Modal -->
                  <div class="modal" id="freezedata{{ $pkp->id_pkp_promo }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h3 class="modal-title" id="exampleModalLabel">{{$pkp->project_name}}
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button></h3>
                        </div>
                        <div class="modal-body">
                          <form class="form-horizontal form-label-left" method="POST" action="{{route('freezepromo',$pkp->id_pkp_promo)}}" novalidate>
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
                      <button data-toggle="tooltip" title="note" class="btn btn-default btn-sm" data-toggle="modal" data-target="#freeze{{ $pkp->id_pkp_promo  }}"><i class="fa fa-dropbox"></i></a></button>
                      <!-- Modal -->
                      <div class="modal" id="freeze{{ $pkp->id_pkp_promo }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h3 class="modal-title" id="exampleModalLabel">{{$pkp->project_name}}
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button></h3>
                            </div>
                            <div class="modal-body">
                              <form class="form-horizontal form-label-left" method="POST" action="{{ Route('ubahTM',$pkp->id_pkp_promo)}}" novalidate>
                              <div class="row x_panel">
                              <textarea name="" disabled class="col-md-12 col-sm-10 col-xs-12 text-center" rows="3" style="color:red;">{{$pkp->note_freeze}}</textarea> </textarea><br><br>
                              <br><br><br>
                                <label style="color:blue;">
                                Timeline : {{$pkp->jangka}} To {{$pkp->waktu}}
                                <br>
                                <?php
                                  $awal  = date_create( $pkp->waktu );
                                  $akhir = date_create(); // waktu sekarang
                                  if($akhir<=$awal){
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
                                <h3> Sent request for a change in schedule </h3>
                                @elseif($pkp->status_project=='revisi')
                                <h3>Data In The Revision Process</h3>
                                @endif
                                <input type="hidden" name="lamafreeze" value="Revisi Timeline (Date of data freezeing : {{$pkp->waktu_freeze}})">
                                <input type="hidden" value="{{$pkp->id_pkp_promo}}" name="pkp" id="pkp">
                              </div>
                              <div class="modal-footer">
                              @if($pkp->status_project!='revisi')
                                <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-paper-plane"></i> Sent</button>
                                {{ csrf_field() }}
                                <a href="{{route('activepromo',$pkp->id_pkp_promo)}}" type="button" class="btn btn-info btn-sm"><li class="fa fa-check"> Active</li></a>
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
                  @if($pkp->status_freeze=='inactive')
                    @if($pkp->pengajuan_sample=='proses')
                    <?php
                      $awal  = date_create( $pkp->waktu );
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
                    @elseif($pkp->pengajuan_sample=='sent')<span class="label label-primary" style="color:white">RD send a sample</span>
                    @elseif($pkp->pengajuan_sample=='reject')<span class="label label-danger" style="color:white">Sample rejected</span>
                    @elseif($pkp->pengajuan_sample=='approve')<span class="label label-info" style="color:white">Sample have been approved</span>
                    @endif
                  @elseif($pkp->status_freeze=='active')
                    Project Is Inactive
                  @endif
                </td>
                @elseif($pkp->status_project=='revisi')
                <td class="text-center"><a class="btn btn-info btn-sm" href="{{ Route('rekappromo',$pkp->id_pkp_promo) }}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a></td>
                <td>Data In The Revision Process</td>
                @elseif($pkp->status_project=='proses')
                <td class="text-center">
                  <a class="btn btn-info btn-sm" href="{{ Route('rekappromo',$pkp->id_pkp_promo) }}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a>
                  @if($pkp->status_freeze=='inactive')
                  <button title="Freeze" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#freezedata{{ $pkp->id_pkp_promo  }}" data-toggle="tooltip" ><li class="fa fa-exclamation-triangle"></i></a></button>
                  <!-- Modal -->
                  <div class="modal" id="freezedata{{ $pkp->id_pkp_promo }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h3 class="modal-title" id="exampleModalLabel">{{$pkp->project_name}}
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button></h3>
                        </div>
                        <div class="modal-body">
                          <form class="form-horizontal form-label-left" method="POST" action="{{route('freezepromo',$pkp->id_pkp_promo)}}" novalidate>
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
                    <button data-toggle="tooltip" title="note" class="btn btn-default btn-sm" data-toggle="modal" data-target="#freeze{{ $pkp->id_pkp_promo  }}"><i class="fa fa-dropbox"></i></a></button>
                      <!-- Modal -->
                      <div class="modal" id="freeze{{ $pkp->id_pkp_promo }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h3 class="modal-title" id="exampleModalLabel">{{$pkp->project_name}}
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button></h3>
                            </div>
                            <div class="modal-body">
                              <form class="form-horizontal form-label-left" method="POST" action="{{ Route('ubahTM',$pkp->id_pkp_promo)}}" novalidate>
                              <div class="row x_panel">
                              <textarea name="" disabled class="col-md-12 col-sm-10 col-xs-12 text-center" rows="3" style="color:red;">{{$pkp->note_freeze}}</textarea> </textarea><br><br>
                              <br><br><br>
                              <label style="color:blue;">
                                Timeline : {{$pkp->jangka}} To {{$pkp->waktu}}
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
                                  h3> Sent request for a change in schedule </h3>
                                @elseif($pkp->status_project=='revisi')
                                  <h3>Data In The Revision Process</h3>
                                @endif
                                <input type="hidden" name="lamafreeze" value="Revisi Timeline (Date of data freezeing : {{$pkp->waktu_freeze}})">
                                <input type="hidden" value="{{$pkp->id_pkp_promo}}" name="pkp" id="pkp">
                              </div>
                              <div class="modal-footer">
                                @if($pkp->status_project!='revisi')
                                <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-paper-plane"></i> Sent</button>
                                {{ csrf_field() }}
                                <a href="{{route('activepromo',$pkp->id_pkp_promo)}}" type="button" class="btn btn-info btn-sm"><li class="fa fa-check"> Active</li></a>
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
                <td>Has been sent to</td>
                @elseif($pkp->status_project=='close')
                <td class="text-center">
                  <a class="btn btn-info btn-sm" href="{{ Route('daftarpromo',$pkp->id_pkp_promo) }}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a>
                  <button class="btn btn-success btn-sm" disabled><li class="fa fa-smile-o" title="close"></li></button></td>
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
  </div>
</div>
@endsection