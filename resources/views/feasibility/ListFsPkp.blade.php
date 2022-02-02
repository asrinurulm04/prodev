@extends('layout.tempvv')
@section('title', 'PRODEV|feasibility')
@section('content')

<div class="x_panel">
  <div class="x_panel">
    <div class="col-md-6"><h4><li class="fa fa-star"></li> List Feasibility </h4></div>
    <div class="col-md-6" align="right">
      @if(auth()->user()->role->namaRule === 'manager')
      <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#sent{{$pkp->id_project}}"><i class="fa fa-paper-plane"></i> Sent To User</a></button>
      @endif 
      @if($pkp->pengajuan_fs=='proses')
      <a href="{{route('compare',[$data,$pkp->id_project])}}" class="btn btn-sm btn-dark" type="button"><li class="fa fa-balance-scale"></li> Compare</a> 
      <a href="{{route('reportinfo',['PKP',$pkp->id_project])}}" class="btn btn-sm btn-success" type="button"><li class="fa fa-files-o"></li> Report</a> 
      @endif
      <a href="{{ Route('lihatpkp',$pkp->id_project) }}" class="btn btn-sm btn-info" type="button"><li class="fa fa-folder-open"></li> Show PKP</a> 
      <a href="{{route('FsPKP')}}" class="btn btn-sm btn-danger" type="button"><li class="fa fa-arrow-left"></li> Back</a> 
    </div>
  </div>
  <div class="row">
    <div class="col-md-5">
      <table>
        <tr><th width="10%">Project Name</th><th width="45%">: {{$pkp->project_name}}</th>
        <tr><th width="10%">PKP Number</th><th width="45%">: {{$pkp->pkp_number}}{{$pkp->ket_no}}</th>
        <tr><th width="10%">Brand</th><th>: {{$pkp->id_brand}}</th>
      </table><br>
    </div>
    <div class="col-md-7">
      <table>
        <tr><th width="10%">Idea</th><th width="45%">: {{$pkp->idea}}</th></tr>
        <tr><th width="10%">Configuration</th><th>: {{$pkp->id_brand}}</th>
        @if(auth()->user()->Departement->dept === 'REA')
        <tr><th width="10%">User Proses</th><th>: @if($pkp->user_fs!=NULL) {{$pkp->proses->name}} @endif</th>
        @endif
      </table><br>
    </div>
  </div>
</div>
<div class="x_panel">
    <div class="card-block">
      <div class="dt-responsive table-responsive"><br>
        <table id="datatable" class="table table-striped table-bordered">
          <thead>
            <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
              <th class="text-center" width="10%">Versi</th>
              <th class="text-center" width="12%">Kode Formula</th>
              <th class="text-center" width="10%">Fillpack Lokasi</th>
              <th class="text-center" width="10%">Production Location</th>
              <th class="text-center" width="15%">Note</th>
              <th class="text-center" width="15%">Action</th>
              <th class="text-center" width="8%">Product</th>
              <th class="text-center" width="8%">Proses</th>
              <th class="text-center" width="8%">Kemas</th>
              <th class="text-center" width="8%">Lab</th>
              <th class="text-center" width="8%">Maklon</th>
            </tr>
          </thead>
          <tbody>
            @foreach($fs as $fs)
              @if($fs->status=='approve')
              <tr style="background-color:#fea">
              @elseif($fs->status=='reject')
              <tr style="background-color:#848d96">
              @elseif($fs->status_feasibility=='batal')
              <tr style="background-color:#e6a8a8">
              @else
              <tr>
              @endif
                <td class="text-center">
                  {{$fs->revisi}}.
                  @if($fs->revisi_proses!=NULL) {{$fs->revisi_proses}}.
                  @elseif($fs->revisi_proses==NULL) X.
                  @endif

                  @if($fs->revisi_kemas!=NULL) {{$fs->revisi_kemas}}.
                  @elseif($fs->revisi_kemas==NULL) X.
                  @endif

                  @if($fs->revisi_lab!=NULL) {{$fs->revisi_lab}}
                  @elseif($fs->revisi_lab==NULL) X
                  @endif
                </td>
                <td>{{$fs->workbook->formula}}</td>
                <td class="text-center">@foreach($lokasi2 as $lk2)  @if($fs->id_wb_kemas!=NULL) {{$lk2->IO}} @endif ,@endforeach</td>
                <td class="text-center">@foreach($lokasi as $lk)  @if($fs->id_wb_proses!=NULL) {{$lk->IO}} @endif ,@endforeach</td>
                <td>
                  @if($fs->status_feasibility!='batal')
                    @foreach($report as $rp) @if($rp->id_fs==$fs->id) {{$rp->note}} @endif @endforeach
                  @elseif($fs->status_feasibility=='batal')
                    <center><span class="label label-danger" style="color:white">Project Dibatalkan</span></center>
                  @endif
                </td>
                <td class="text-center">
                  @if($fs->status_feasibility=='pengajuan')
                    @if($pkp->user_fs!=NULL)
                    <a href="{{route('DetailPengajuanFsPKP',[$fs->id_project,$fs->id_formula,$fs->id])}}" class="btn btn-sm btn-dark" type="button"><li class="fa fa-file"></li> Pengajuan</a>
                    @endif  
                  @elseif($fs->status_feasibility!='pengajuan' && $fs->status_feasibility!='batal')
                    @if($fs->revisi_kemas!='' && $fs->revisi_proses!='' && $fs->revisi_lab!='')
                      @if($fs->status_proses=='sending' && $fs->status_maklon=='sending' && $fs->status_kemas=='sending' && $fs->status_lab=='sending')
                        @if(auth()->user()->Departement->dept === 'REA')
                          <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#sent2{{$fs->id}}" title="Kirim"><i class="fa fa-paper-plane"></i></a></button>
                        @endif
                      @endif
                      @if($fs->status_proses!='ajukan' && $fs->status_maklon!='ajukan' && $fs->status_kemas!='ajukan' && $fs->status_lab!='ajukan')
                      <a href="{{route('overview',[$fs->id,$fs->id_wb_proses,$fs->id_wb_kemas])}}" class="btn btn-sm btn-info" type="button" title="Overview"><li class="fa fa-file"></li></a>
                      @endif
                    @endif
                    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#up{{$fs->id}}" title="Up"><i class="fa fa-arrow-circle-o-up"></i></a></button>
                  @endif
                </td>
                <!-- Action user product -->
                <td class="text-center">
                  <a href="{{ route('formula.detail',[$fs->workbook->id,$fs->id_project,$fs->workbook->workbook_id]) }}" class="btn btn-sm btn-info" type="button" title="Show"><li class="fa fa-folder"></li></a>
                </td>
                <!-- Action user Proses -->
                <td class="text-center">
                  @if(auth()->user()->Departement->dept === 'REA')
                    @if($fs->revisi_proses!=NULL)
                      @if($fs->status_proses=='ajukan')
                        <a href=" {{route('workbookfs',[$fs->id_project,$fs->id])}}" class="btn btn-sm btn-warning" type="button" title="request"><li class="fa fa-edit"></li></a>
                      @elseif($fs->status_proses=='selesai')
                        <a href="{{ route('datamesin',[$fs->id_project,$fs->id,$fs->id_wb_proses]) }}" class="btn btn-sm btn-info" type="button" title="Show"><li class="fa fa-folder"></li></a>
                      @elseif($fs->status_proses=='sending')
                        <a href="{{route('workbookfs',[$fs->id_project,$fs->id])}}" class="btn btn-sm btn-info" type="button" title="Show"><li class="fa fa-folder"></li></a>
                      @endif 
                    @elseif($fs->revisi_proses==NULL)
                      <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#konfirmasi{{$fs->id}}" title="Show"><li class="fa fa-exclamation"></li></button>
                    @endif
                  @else
                    @if($fs->status_proses=='ajukan')
                      <a disabled class="btn btn-sm btn-warning" type="button" title="request"><li class="fa fa-edit"></li></a>
                    @elseif($fs->status_proses=='sending' || $fs->status_proses=='selesai')
                      <a disabled class="btn btn-sm btn-info" type="button" title="Show"><li class="fa fa-folder"></li></a>
                    @endif 
                  @endif
                </td>
                <!-- Action user Kemas -->
                <td class="text-center">
                  @if(auth()->user()->Departement->dept === 'RKA')
                    @if($fs->revisi_kemas!=NULL)
                      @if($fs->status_kemas=='ajukan')
                        <a href=" {{route('workbookfs',[$fs->id_project,$fs->id])}}" class="btn btn-sm btn-warning" type="button" title="request"><li class="fa fa-edit"></li></a>
                      @elseif($fs->status_kemas=='selesai')
                        <a href="{{ route('hasilnya',[$fs->id_project,$fs->id,$fs->id_wb_kemas]) }}" class="btn btn-sm btn-info" type="button" title="Show"><li class="fa fa-folder"></li></a>
                      @elseif($fs->status_kemas=='sending')
                        <a href="{{route('workbookfs',[$fs->id_project,$fs->id])}}" class="btn btn-sm btn-info" type="button" title="Show"><li class="fa fa-folder"></li></a>
                      @endif
                    @elseif($fs->revisi_kemas==NULL)
                      <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#konfirmasi{{$fs->id}}" title="Show"><li class="fa fa-exclamation"></li></button>
                    @endif
                  @else
                    @if($fs->status_kemas=='ajukan')
                      <a disabled class="btn btn-sm btn-warning" type="button" title="request"><li class="fa fa-edit"></li></a>
                    @elseif($fs->status_kemas=='selesai' || $fs->status_kemas=='sending')
                      <a disabled class="btn btn-sm btn-info" type="button" title="Show"><li class="fa fa-folder"></li></a>
                    @endif
                  @endif 
                </td>
                <!-- Action user Lab -->
                <td class="text-center">
                  @if(auth()->user()->role->namaRule === 'lab') 
                    @if($fs->revisi_lab!=NULL)
                      @if($fs->status_lab=='ajukan')
                        <a href=" {{route('datalab',[$fs->id_project,$fs->id])}}" class="btn btn-sm btn-warning" type="button" title="request"><li class="fa fa-edit"></li></a>
                      @elseif($fs->status_lab=='selesai' || $fs->status_lab=='sending')
                        <a href=" {{route('datalab',[$fs->id_project,$fs->id])}}" class="btn btn-sm btn-info" type="button" title="show"><li class="fa fa-folder"></li></a>
                      @endif
                    @elseif($fs->revisi_lab==NULL)
                      <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#konfirmasi{{$fs->id}}" title="Show"><li class="fa fa-exclamation"></li></button>
                    @endif
                  @else
                    @if($fs->status_lab=='ajukan')
                      <a disabled class="btn btn-sm btn-warning" type="button" title="request"><li class="fa fa-edit"></li></a>
                    @elseif($fs->status_lab=='proses' || $fs->status_lab=='selesai' || $fs->status_lab=='sending')
                      <a disabled class="btn btn-sm btn-info" type="button" title="show"><li class="fa fa-folder"></li></a>
                    @endif
                  @endif
                </td>
                <!-- Action user Maklon -->
                <td class="text-center">
                  @if(auth()->user()->Departement->dept === 'REA' || auth()->user()->role->namaRule === 'maklon')
                    @if($fs->status_maklon=='ajukan')  
                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#maklon{{$fs->id}}" title="Request"><li class="fa fa-edit"></li></button>
                    @elseif($fs->status_maklon=='sending' || $fs->status_maklon=='selesai')
                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#maklon2{{$fs->id}}" title="Show"><li class="fa fa-folder"></li></button>
                    @endif
                  @else
                    @if($fs->status_maklon=='ajukan')  
                      <button class="btn btn-warning btn-sm" disabled title="Request"><li class="fa fa-edit"></li></button>
                    @elseif($fs->status_maklon=='sending' || $fs->status_maklon=='selesai')
                      <button class="btn btn-info btn-sm" disabled title="Show"><li class="fa fa-folder"></li></button>
                    @endif
                  @endif
                </td>
              </tr>
              <!-- modal maklon-->
              <div class="modal" id="maklon{{$fs->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog " role="document">
                  <div class="modal-content">
                    <div class="modal-header">                 
                      <center><h3 class="modal-title" id="exampleModalLabel">Data Maklon 
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button></h3></center>
                    </div>
                    <div class="modal-body">
                      <form class="form-horizontal form-label-left" method="POST" action="{{route('FsMaklon',$fs->id)}}">
                      <input type="hidden" value="{{$fs->id}}" name="id_fs" id="id_fs">
                      <div class="form-group row">
                        <label class="control-label text-bold col-md-3 col-sm-3 col-xs-12"> Biaya Maklon/UOM*</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="number" class="form-control" name="biaya" id="biaya" required>
                        </div>
                        <label class="control-label text-bold col-md-1 col-sm-1 col-xs-12">Satuan*</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" class="form-control" name="satuan" id="satuan" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="control-label text-bold col-md-3 col-sm-3 col-xs-12">Remarks</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" name="remarks_biaya" id="remarks_biaya">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="control-label text-bold col-md-3 col-sm-3 col-xs-12">Biaya Transport/UOM*</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="number" class="form-control" name="transportasi" id="transportasi" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="control-label text-bold col-md-3 col-sm-3 col-xs-12">Remarks</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" name="remarks_transport" id="remarks_transport">
                        </div>
                      </div><br>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-check"></i> Submit</button>
                        {{ csrf_field() }}
                      </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Modal Selesai -->
              
              <!-- modal maklon detail-->
              <div class="modal" id="maklon2{{$fs->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog " role="document">
                  <div class="modal-content">
                    <div class="modal-header">                 
                      <center><h3 class="modal-title" id="exampleModalLabel">Data Maklon 
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button></h3></center>
                    </div>
                    <div class="modal-body">
                    @foreach($maklon as $mk)
                      @if($mk->id_fs==$fs->id)
                      <div class="form-group row">
                        <label class="control-label text-bold col-md-3 col-sm-3 col-xs-12"> Biaya Maklon/UOM</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="number" class="form-control" value="{{$mk->biaya_maklon}}" name="" id="" readonly>
                        </div>
                        <label class="control-label text-bold col-md-1 col-sm-1 col-xs-12 text-center">Satuan</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" class="form-control" value="{{$mk->satuan}}" name="" id="" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="control-label text-bold col-md-3 col-sm-3 col-xs-12">Remarks</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" value="{{$mk->remarks_biaya}}" name="" id="" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="control-label text-bold col-md-3 col-sm-3 col-xs-12">Biaya Transport/UOM</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="number" class="form-control" value="{{$mk->biaya_transport}}" name="" id="" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="control-label text-bold col-md-3 col-sm-3 col-xs-12">Remarks</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" value="{{$mk->remarks_transport}}" name="" id="" readonly>
                        </div>
                      </div><hr>
                      @endif
                    @endforeach
                    </div>
                  </div>
                </div>
              </div>
              <!-- Modal Selesai -->

              <!-- modal -->
              <div class="modal" id="up{{$fs->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">                 
                      <h3 class="modal-title" id="exampleModalLabel">Up Version
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button></h3>
                    </div>
                    <div class="modal-body">
                      <form class="form-horizontal form-label-left" method="POST" action="{{route('up',$fs->id)}}">
                      <div class=" row">
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <label class="control-label text-center">User Terdampak:</label><br>
                          &nbsp &nbsp<input type="checkbox" name="kemas" id="kemas" value="yes"> Kemas <br>
                          &nbsp &nbsp<input type="checkbox" name="lab" id="lab" value="yes"> Lab <br>
                          &nbsp &nbsp<input type="checkbox" name="maklon" id="maklon" value="yes"> Maklon <br>
                          &nbsp &nbsp<input type="checkbox" name="proses" id="proses" value="yes"> Proses <br>
                        </div>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <label class="control-label text-bold col-md-4 col-sm-4 col-xs-12 text-center">Alasan Naik Versi :</label>
                          <input type="hidden" name="perevisi" id="perevisi" value="{{Auth::user()->id}}">
                          <?php $last = Date('j-F-Y'); ?><input id="last_up" value="{{ $last }}" type="hidden" name="last_up">
                          <textarea class="col-md-11 col-sm-11 col-xs-12" name="note" id="note" rows="4" required></textarea>
                        </div>
                      </div><br>
                      <div class="modal-footer">
                        <button type="submit" onclick="return confirm('Are You Sure ?')" class="btn btn-primary btn-sm"><i class="fa fa-arrow-circle-o-up"></i> up</button>
                        {{ csrf_field() }}
                      </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Modal Selesai -->

              <!-- modal Sent FS-->
              <div class="modal" id="sent2{{$fs->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog " role="document">
                  <div class="modal-content">
                    <div class="modal-header">                 
                      <h3 class="modal-title" id="exampleModalLabel">Sent Feasibility
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button></h3>
                    </div>
                    <form class="form-horizontal form-label-left" method="POST" action="{{route('final',$fs->id)}}">
                    <div class="modal-body">
                      <div class=" row">
                        <?php $date = Date('j-F-Y'); ?>
                        <input id="tgl" value="{{ $date }}"type="hidden" name="tgl">
                        <label class="control-label text-bold col-md-1 col-sm-1 col-xs-12 text-center">Email</label>
                        <label class="control-label text-bold col-md-1 col-sm-1 col-xs-12 text-center">To </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input id="email" required class="form-control " type="email" name="email" required>
                          <label style="color:red;">* only allowed one E-mail</label>
                        </div>
                      </div>
                      <div class=" row">
                        <?php $date = Date('j-F-Y'); ?>
                        <input id="tgl" value="{{ $date }}" type="hidden" name="tgl">
                        <input id="tgl" value="PKP "type="hidden" name="type">
                        <label class="control-label text-bold col-md-1 col-sm-1 col-xs-12 text-center"></label>
                        <label class="control-label text-bold col-md-1 col-sm-1 col-xs-12 text-center">Note </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <textarea name="note" id="note" class="form-control" rows="4"></textarea>
                        </div>
                      </div><br>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sm" onclick="return confirm('Are you sure??')"><i class="fa fa-paper-plane"></i> Assign</button>
                        {{ csrf_field() }}
                      </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Modal Selesai -->

              <!-- modal Konfirmasi-->
              <div class="modal" id="konfirmasi{{$fs->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                  <div class="modal-content">
                    <div class="modal-header">                 
                      <h3 class="modal-title" id="exampleModalLabel">Confirmation
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button></h3>
                    </div>
                    <div class="modal-body">
                      <div class=" row">
                        <center>
                        Catatan Revisi : <br>
                        @foreach($report as $rp) @if($rp->id_fs==$fs->id) {{$rp->note}} @endif @endforeach
                        <br><hr>
                        <a href="{{route('revisifs',$fs->id)}}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure??')" type="button"><li class="fa fa-times"></li> Revisi</a>
                        <a href="{{route('comfirmfs',$fs->id)}}" class="btn btn-sm btn-primary" onclick="return confirm('Are you sure??')" type="button"><li class="fa fa-check"></li> Comfirm</a>
                        </center>
                      </div>
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
</div>

<!-- modal -->
<div class="modal" id="sent{{$pkp->id_project}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">                 
        <h3 class="modal-title" id="exampleModalLabel">Sent Feasibility
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button></h3>
      </div>
      <div class="modal-body">
        <form class="form-horizontal form-label-left" method="POST" action="{{ Route('user_fs',$pkp->id_project)}}" novalidate>
        <div class=" row">
          <label class="control-label text-bold col-md-2 col-sm-2 col-xs-12 text-center"> User</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="hidden" name="info" id="info" value="PKP">
            <select required name="user" class="form-control form-control-line" id="user">
              <option disabled selected>Select User</option>
              @foreach($users as $user)
                @if($user->id!=Auth::user()->id)
                <option required value="{{$user->id}}">{{ $user->name }}</option>
                @endif
              @endforeach
            </select>
          </div>
        </div><br>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-paper-plane"></i> Assign</button>
          {{ csrf_field() }}
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal Selesai -->
@endsection
@section('s')
<link href="{{ asset('lib/advanced-datatable/css/jquery.dataTables.css') }}" rel="stylesheet" />
<script src="{{ asset('js/datatables.min.js')}}"></script>
@endsection