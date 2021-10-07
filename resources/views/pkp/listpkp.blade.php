@extends('layout.tempvv')
@section('title', 'PRODEV|List PKP')
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
    <h3><li class="fa fa-file"> </li> List PKP</h3>
  </div>
  <div class="card-block">
    <div class="clearfix"></div>
    <div class="x_content" >
      <table id="datatable" class="table table-striped table-bordered" style="width:100%">
        <thead>
          <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
            <th width="22%">PKP Number</th>
            <th>Status RD Kemas</td>
            <th class="text-center">Status RD Product</th>
            <th class="text-center" width="11%">Destination</th>
            <th class="text-center" width="5%">Priority</th>
            <th class="text-center" width="15%">Action</th>
            <th width="14%">Prototype Sample submission status</th>
          </tr>
        </thead>
        <tbody>
          @php $no = 0; @endphp
          @foreach($pkp as $pkp)
          <tr >
            <td>{{$pkp->pkp_number}}{{$pkp->ket_no}}</td>
            <td>
              @if($pkp->tujuankirim2!=null)
                @if($pkp->status_pkp=='sent')
                  @if($pkp->status_terima2=='proses')
                  The project has been sent to the manager
                  @elseif($pkp->status_terima2=='terima')
                  Approve manager
                  @endif
                @elseif($pkp->status_pkp=='revisi')
                The Project in the revised proses
                @elseif($pkp->status_pkp=='proses')
                  @if($pkp->userpenerima2!=NULL)
                  Sent to ({{$pkp->users2->name}})
                  @elseif($pkp->userpenerima2==NULL)
                    @if($pkp->status_terima2=='proses')
                    The project has been sent to the manager
                    @elseif($pkp->status_terima2=='terima')
                    Approve manager
                    @endif
                  @endif
                @elseif($pkp->status_pkp=='close')
                Project has finished
                @endif
              @else
              No Prosess
              @endif
            </td>
            <td>
              @if($pkp->tujuankirim!=1)
                @if($pkp->status_pkp=='sent')
                  @if($pkp->status_terima=='proses')
                  The project has been sent to the manager
                  @elseif($pkp->status_terima=='terima')
                  Approve manager
                  @endif
                @elseif($pkp->status_pkp=='revisi')
                The Project in the revised proses
                @elseif($pkp->status_pkp=='proses')
                  @if($pkp->userpenerima!=NULL)
                  Sent to ({{$pkp->users1->name}})
                  @elseif($pkp->userpenerima==NULL)
                    @if($pkp->status_terima=='proses')
                    New PKP
                    @elseif($pkp->status_terima=='terima')
                    Approve
                    @endif
                  @endif
                @elseif($pkp->status_pkp=='close')
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
            @if($pkp->prioritas!=NULL)
            {{$pkp->prioritas}}
            @elseif($pkp->prioritas==NULL)
              @if($pkp->status_pkp=='drop') Stop
              @elseif($pkp->status_pkp=='close') Launch
              @endif
            @endif
            </td>
            <td class="text-center">
              <a class="btn btn-info btn-sm" href="{{ Route('rekappkp',[$pkp->id_project,$pkp->id_pkp]) }}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a>
              @if($pkp->status_pkp!='close' && $pkp->status_pkp!='drop')
                @if($pkp->status_freeze=='inactive')
                  @if(auth()->user()->role->namaRule === 'pv_lokal')
                  <button title="freeze" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#freezedata{{ $pkp->id_project  }}" data-toggle="tooltip"><li class="fa fa-exclamation-triangle"></i></a></button>
                    @if($pkp->status_pkp=='proses')
                    <button title="Launch" class="btn btn-success btn-sm" data-toggle="modal" data-target="#closedata{{ $pkp->id_project  }}" data-toggle="tooltip"><li class="fa fa-power-off"></i></a></button>
                    @elseif($pkp->status_pkp=='proses' || $pkp->status_pkp=='sent')
                    <a href="{{route('droppkp',$pkp->id_project)}}" title="Drop" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><li class="fa fa-ban"></li></a>
                    @endif
                  @endif
                @elseif($pkp->status_freeze=='active')
                  <button title="active" class="btn btn-default btn-sm" data-toggle="modal" data-target="#freeze{{ $pkp->id_project }}" data-toggle="tooltip" ><i class="fa fa-dropbox"></i></a></button>
                @endif
              @elseif($pkp->status_pkp=='close')
                <a  class="btn btn-warning btn-sm" title="Note Launch" data-toggle="modal" data-target="#ajukan{{ $pkp->id_project  }}" data-toggle="tooltip"><i class="fa fa-sticky-note"></i></a>
                <a  class="btn btn-success btn-sm" title="Improvement" data-toggle="modal" data-target="#imp{{ $pkp->id_project  }}" data-toggle="tooltip"><i class="fa fa-check"></i></a>
              @endif
            </td>
            <td>
            @if($pkp->status_pkp=='sent' || $pkp->status_pkp=='proses')
              @if($pkp->tujuankirim!=1)
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
                  @elseif($pkp->pengajuan_sample=='sent') <span class="label label-primary" style="color:white">RD send a sample</span>
                  @elseif($pkp->pengajuan_sample=='reject') <span class="label label-danger" style="color:white">Sample rejected</span>
                  @elseif($pkp->pengajuan_sample=='approve') <span class="label label-info" style="color:white">Sample have been approved</span>
                  @endif
                @elseif($pkp->status_freeze=='active')
                Project Is Inactive
                @endif
              @else
              No Prosess
              @endif
            @elseif($pkp->status_pkp=='revisi')
            <span class="label label-danger" style="color:white">RD subbmitted a revision for this project</span>
            @elseif($pkp->status_pkp=='close')
            <span class="label label-success" style="color:white"> This Project Is Finished</span>
            @elseif($pkp->status_pkp=='drop')
            <span class="label label-danger" style="color:white"> Drop</span>
            @else
            @endif
            </td>
          </tr>

          <!-- Kumpulan Modal -->
            <!-- Modal info akhir close project-->
            @if($pkp->status_pkp=='close')
            <div class="modal" id="ajukan{{ $pkp->id_project  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Note Launch Project 
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></h3>
                  </div>
                  @foreach($launch as $lc)
                  @if($pkp->id_project==$lc->id_pkp)
                  <div class="modal-body">
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Close Date</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input required id="date" value="{{$lc->tanggal}}" required="required" class="form-control col-md-12 col-xs-12" type="text" name="date" readonly>
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Project Name</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input required id="project" value="{{$lc->project_name}}" required="required" class="form-control col-md-12 col-xs-12" type="text" name="project" readonly>
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Name</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input required id="product" required="required" value="{{$lc->nama_produk}}" class="form-control col-md-12 col-xs-12" type="text" name="product" readonly>
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Formula Baku</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input required id="baku" required="required" value="{{$lc->formula_baku}}" class="form-control col-md-12 col-xs-12" type="text" name="baku" readonly>
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Formula Kemas</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <textarea name="kemas" id="kemas" value="{{$lc->formula_kemas}}" class="form-control col-md-12 col-xs-12" rows="2" disabled>{{$lc->formula_kemas}}</textarea>
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Price List</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input required id="price" required="required" value="{{$lc->price_list}}" class="form-control col-md-12 col-xs-12" type="text" name="price" readonly>
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Forecast</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input required id="forecast" required="required" value="{{$lc->forecast}}" class="form-control col-md-12 col-xs-12" type="text" name="forecast" readonly>
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">RTO</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input required id="rto" required="required" value="{{$lc->rto}}" class="form-control col-md-12 col-xs-12" type="text" name="rto" readonly>
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Note</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <textarea required id="note" required="required" value="{{$lc->note}}" class="form-control col-md-12 col-xs-12" rows="2" readonly>{{$lc->note}}</textarea>
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Attachment</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        @if($lc->barcode!=NULL)
                        <embed src="{{asset('data_file/'.$lc->barcode)}}" width="200px" height="200" type="">
                        <a href="{{asset('data_file/'.$lc->barcode)}}" class="btn btn-warning btn-sm" download="{{$lc->barcode}}" title="Download file"><li class="fa fa-download"></li></a>{{$lc->barcode}} 
                        @endif
                      </div>
                    </div>
                  </div>
                  @endif
                  @endforeach
                </div>
              </div>
            </div>

            <div class="modal" id="imp{{ $pkp->id_project  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Improvement <small>({{$pkp->id_project}})</small>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></h4>
                  </div>
                  <form class="form-horizontal form-label-left" method="POST" action="{{Route('improve',[$pkp->id_project,$pkp->revisi,$pkp->turunan,$pkp->revisi_kemas])}}">
                  <div class="modal-body">
                    <input type="radio" name="imp" value="umum" id="imp_umum"> PKP Umum <br>
                    <input type="radio" name="imp" value="baku" id="imp_baku"> PKP Baku
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Are you sure?')"><i class="fa fa-check"></i> improvement</button>
                    {{ csrf_field() }}
                  </div>
                  </form>
                </div>
              </div>
            </div>
            @endif
            <!-- Modal Selesai -->
            <!-- Modal -->
            <div class="modal fade" id="closedata{{ $pkp->id_project }}" role="dialog" aria-labelledby="NWModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title text-center" id="exampleModalLabel">Launching Project {{$pkp->project_name}}
                  </div>
                  <div class="modal-body">
                    <form class="form-horizontal form-label-left" method="POST" action="{{route('closeproject',$pkp->id_project)}}" enctype="multipart/form-data">
                    <div class="item form-group">
                      <label class="control-label col-md-2 col-sm-2 col-xs-12">Cc (Email)*</label>
                      <div class="col-md-3 col-sm-3 col-xs-12">
                        <input required id="project" required="required" class="form-control col-md-12 col-xs-12" type="email" name="cc1">
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12">
                        <input required id="project" required="required" class="form-control col-md-12 col-xs-12" type="email" name="cc2">
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12">
                        <input required id="project" required="required" class="form-control col-md-12 col-xs-12" type="email" name="cc3">
                      </div>
                    </div><hr><hr>
                    <div class="item form-group">
                      <?php $date = Date('j-F-Y'); ?>
                      <label class="control-label col-md-2 col-sm-2 col-xs-12">Close Date*</label>
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <input id="date" value="{{$date}}" required="required" class="form-control col-md-12 col-xs-12" type="text" name="date" readonly>
                      </div>
                      <label class="control-label col-md-2 col-sm-2 col-xs-12">RTO*</label>
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <input required id="rto" required="required" class="form-control col-md-12 col-xs-12" type="date" name="rto" >
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-2 col-sm-2 col-xs-12">Project Name*</label>
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <input required id="project" value="{{$pkp->project_name}}" required="required" class="form-control col-md-12 col-xs-12" type="text" name="project" readonly>
                      </div>
                      <label class="control-label col-md-2 col-sm-2 col-xs-12">Product Name*</label>
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <input required id="produk" required="required" class="form-control col-md-12 col-xs-12" type="text" name="produk" >
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-2 col-sm-2 col-xs-12">Formula Baku*</label>
                      <div class="col-md-10 col-sm-10 col-xs-12">
                        <input required id="baku" required="required" class="form-control col-md-12 col-xs-12" type="text" name="baku" >
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-2 col-sm-2 col-xs-12">Formula Kemas*</label>
                      <div class="col-md-10 col-sm-10 col-xs-12">
                        <textarea name="kemas" id="kemas" required="required" class="form-control col-md-12 col-xs-12" rows="2"></textarea>
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-2 col-sm-2 col-xs-12">Price List (Before PPN)*</label>
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <input required id="price" required="required" class="form-control col-md-12 col-xs-12" type="text" name="price" >
                      </div>
                      <label class="control-label col-md-2 col-sm-2 col-xs-12">Forecast*</label>
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <input required id="forecast" required="required" class="form-control col-md-12 col-xs-12" type="text" name="forecast" >
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-2 col-sm-2 col-xs-12">Note</label>
                      <div class="col-md-10 col-sm-10 col-xs-12">
                        <textarea required id="note" required="required" class="form-control col-md-12 col-xs-12" name="note" rows="2"></textarea>
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-2 col-sm-2 col-xs-12">Attachment (2MB)*</label>
                      <div class="col-md-10 col-sm-10 col-xs-12">
                        <input type="file" name="filename" required class="form-control">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Are you sure close this project ?')"><i class="fa fa-power-off"></i> Send Launching</button>
                      {{ csrf_field() }}
                    </div>
                      <input type="hidden" value="{{$pkp->author1->email}}" name="author" id="author">
                      <input type="hidden" value="{{auth()->user()->email}}" name="pv" id="pv">
                      @if($pkp->tujuankirim!=1)<input type="hidden" value="{{$pkp->departement->users->email}}" name="rd1" id="managerproduk">@endif
                      @if($pkp->userpenerima!=0)<input type="hidden" value="{{$pkp->users1->email}}" name="user1" id="userproduk">@endif
                      @if($pkp->tujuankirim2!=0)<input type="hidden" value="{{$pkp->departement2->users->email}}" name="rd2" id="managerkemas">@endif
                      @if($pkp->userpenerima2!=0)<input type="hidden" value="{{$pkp->users2->email}}" name="user2" id="userkemas">@endif
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- Modal Selesai -->
            <!-- Modal unfreeze-->
            <div class="modal" id="freeze{{ $pkp->id_project }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <center><h4 class="modal-title" id="exampleModalLabel">Note Freeze {{$pkp->project_name}}
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></h4></center>
                  </div>
                  <div class="modal-body">
                    <form class="form-horizontal form-label-left" method="POST" action="{{ Route('activepkp',$pkp->id_project)}}" novalidate>
                    <div class="row x_panel"><textarea name="" disabled class="col-md-12 col-sm-10 col-xs-12 text-center" rows="3" style="color:red;">{{$pkp->note_freeze}}</textarea>
                      <label class="text-center">Timeline sending sample : {{$pkp->jangka}} To {{$pkp->waktu}}
                      <?php $tgl2 = date('Y-m-d', strtotime('+30 days')); ?>
                      <input type="hidden" class="form-control" value="<?php echo date('Y-m-d'); ?>" name="jangka" id="jangka" placeholder="start date">
                      <input type="hidden" class="form-control" value="{{$tgl2}}" name="waktu" id="waktu" placeholder="end date">
                      <input type="hidden" value="{{$pkp->id_project}}" name="pkp" id="pkp">
                    </div>
                    <div hidden>
                      <input id="id_prodev" value="{{$pkp->id_pkp}}"><input id="status_freeze" value="unactive">
                    </div>
                    <div class="modal-footer">
                      <button type="submit" onclick="revisi2loadXMLDoc()" class="btn btn-primary btn-sm"><li class="fa fa-check"> Active</li></button>
                      {{ csrf_field() }}
                    </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- Modal Selesai -->
            <!-- Modal -->
                <div class="modal" id="freezedata{{ $pkp->id_project }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h3 class="modal-title text-center" id="exampleModalLabel" > {{$pkp->project_name}} 
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button></h3>
                      </div>
                      <div class="modal-body">
                        <form class="form-horizontal form-label-left" method="POST" action="{{route('freeze',$pkp->id_project)}}">
                        <div class="row x_panel">
                          <label for="" style="color:red;">Note *required</label><textarea name="notefreeze" id="note_freeze" required class="col-md-12 col-sm-12 col-xs-12"></textarea>
                        </div>
                        <div hidden>
                          <input id="id_prodev" value="{{$pkp->id_pkp}}"><input id="revisi" value="{{$pkp->revisi}}"><input id="status_freeze" value="active">
                        </div>
                        <div class="modal-footer">
                          <button type="submit" onclick="revisiloadXMLDoc()" class="btn btn-dark btn-sm"><i class="fa fa-paper-plane"></i> Sent</button>
                          {{ csrf_field() }}
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
          <!-- Modal Selesai -->
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
<script>
  function revisiloadXMLDoc() {
    let formData = new FormData();
 
    formData.append("status_freeze", document.getElementById("status_freeze").value);
    formData.append("note_freeze", document.getElementById("note_freeze").value);
    formData.append("id_prodev", document.getElementById("id_prodev").value);
 
    fetch('https://smo.nutrifood.co.id/api/update',{
                method : 'POST',
                body : formData         
    })
    .then(res => res.text())
    .then(teks => console.log(teks))
    .catch(err => console.log(err));
  }
</script>

<script>
  function revisi2loadXMLDoc() {
    let formData = new FormData();
 
    formData.append("status_freeze", document.getElementById("status_freeze").value);
    formData.append("id_prodev", document.getElementById("id_prodev").value);
 
    fetch('https://smo.nutrifood.co.id/api/update',{
                method : 'POST',
                body : formData         
    })
    .then(res => res.text())
    .then(teks => console.log(teks))
    .catch(err => console.log(err));
  }
</script>
@endsection