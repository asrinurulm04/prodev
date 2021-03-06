@extends('layout.tempvv')
@section('title', 'PRODEV|Daftar PKP')
@section('content')

<div class="row">
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
</div>

<div class="row">
  <div class="col-md-12 col-xs-12">
    <div class="x_panel">
      <div class="col-md-6"><h4><li class="fa fa-star"></li> Project Name : {{ $data->project_name}}@if($data->jenis!='Baku')_{{$data->no_kemas}}@endif</h4></div>
      <div class="col-md-6" align="right">
        <a class="btn btn-info btn-sm" href="{{ Route('lihatpkp',$data->id_project) }}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i> Show</a>
        @if($data->status_pkp=='revisi' || $data->status_pkp=='draf')
          @if($data->status_freeze=='inactive')
          <a class="btn btn-warning btn-sm" href="{{ route('buatpkp', [$data->id_project]) }}" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i> Edit</a>
          @endif
        @endif
        @if($cf != 0)
          @if($data->file==NULL)
          <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#upload"><i class="fa fa-upload"></i> Upload LHP</a>
          @endif
          <!-- Formula Baru -->
          <div class="modal fade" id="upload" role="dialog" aria-labelledby="hm" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title text-center" id="hm"> Upload FIle</h4>
                </div>
                <div class="modal-body">
                  <form method="post" action="{{route('uploadfile',$data->id_project)}}" enctype="multipart/form-data">                                    
                  <div class="form-group">
                    <label class="col-lg-2 control-label">LHP</label>
                    <div class="col-lg-9">
                      <input type="file" class="form-control" id="data" name="filename">
                    </div>
                  </div>
                </div>
                 <div class="modal-footer">
                   <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-upload"></i> upload</button>
                  {{ csrf_field() }}
                </div>
                </form>
              </div>
            </div>
          </div>
        @endif

        @if(auth()->user()->role->namaRule == 'pv_lokal' || auth()->user()->role->namaRule == 'marketing')
          <button class="btn btn-success btn-sm"  data-toggle="modal" data-target="#edit"><li class="fa fa-edit"></li> Edit Type PKP</button>
          @if($data->status_pkp=="draf" )
            <a href="{{ route('drafpkp')}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-arrow-left"></li> Back</a>
          @else
            @if($data->status_pkp!="close")
            <button class="btn btn-warning btn-sm" title="note" data-toggle="modal" data-target="#data1{{ $data->id_project  }}"><i class="fa fa-edit"></i> Edit Timeline</a></button>
            @endif
            <a href="{{ route('listpkp')}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-arrow-left"></li> Back</a>
          @endif
        @elseif(auth()->user()->role->namaRule === 'user_produk')
          @if($cf == 0)
            <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#FB"><i class="fa fa-plus"></i> New Formula</a>
            <!-- Formula Baru -->
            <div class="modal fade" id="FB" role="dialog" aria-labelledby="hm" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title text-center" id="hm"> New Formula</h4>
                  </div>
                  <div class="modal-body">
                    <form class="cmxform text-left form-horizontal style-form" method="POST" action="{{ route('addformula') }}">  
                    <input class="form-control " id="pkp" name="pkp" type="hidden" value="{{ $data->id_project}}"/>   
                    <input class="form-control " id="workbook_id" name="workbook_id" type="hidden" value="{{ $data->id_pkp}}"/>   
                    <input class="form-control " id="akg" name="akg" type="hidden" value="{{ $data->akg}}"/>                                      
                    <div class="form-group">
                      <label class="col-lg-3 control-label">Formula</label>
                      <div class="col-lg-8">
                        <input class="form-control " id="formula" name="formula" type="text" required/>
                      </div>
                    </div>
                    <div class="form-group">
                    <?php $last = Date('j-F-Y'); ?>
                      <input id="last" value="{{ $last }}" class="form-control col-md-12 col-xs-12" name="last" required="required" type="hidden">
                      <label class="col-lg-3 control-label">Category Formula</label>
                      <div class="col-lg-8">
                        <div class="row">
                          <div class="col-md-6">
                            <input type="radio" name="kategori" checked oninput="finis_good()" id="id_finis" value="finish good"> Finished Good &nbsp
                            <input type="radio" name="kategori" oninput="wip()" id="id_wip"> WIP
                          </div>
                          <div class="col-md-6" id="ditampilkan">
                            <select name="kategori_formula" id="" disabled class="form-control">
                               <option disabled selected>--> Select One <--</option>
                               <option value="granulasi">Granulasi</option>
                               <option value="premix">Premix</option>
                             </select>
                           </div>
                         </div>
                       </div>
                     </div>
                     <div class="form-group">
                       <label class="col-lg-3 control-label">Target Serving (g)</label>
                       <div class="col-lg-8">
                         <div class="row">
                           <div class="col-md-6"><input class="form-control " id="target_serving" name="target_serving" type="text" required/></div>
                           <div class="col-md-6">
                             <input type="radio" checked name="satuan" oninput="satuan_gram()" id="id_gram" value="Gram"> Gram
                             <input type="radio" name="satuan" oninput="satuan_ml()" id="id_ml" value="Ml"> Add BJ
                           </div>
                         </div>
                       </div>
                     </div>
                     <div id="tampilkan" class="form-group">
                       <label class="col-lg-3 control-label">Berat Jenis</label>
                       <div class="col-lg-8">
                         <div class="row">
                           <div class="col-md-12"><input class="form-control" placeholder='Berat Jenis' id="" disabled name="" type="" required/></div>
                         </div>
                       </div>
                     </div>
                    <label for="" style="color:red">* gunakan (.) untuk pengganti (,)</label>
                   </div>
                   <div class="modal-footer">
                     <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add</button>
                     <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  </div>
                  </form>
                </div>
              </div>
            </div>
          @endif
          <a href="{{ route('listprojectpkp')}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-arrow-left"></li> Back</a>
        @endif
      </div>
      <div class="x_panel">
        <div class="col-md-5">
          <table>
            <thead>
              <tr><th>Brand</th><td> : {{$data->id_brand}}</td></tr>
              <tr><th>Type PKP</th><td> :
                @if($data->type==1)Maklon
                @elseif($data->type==2)Internal
                @elseif($data->type==3)Maklon/Internal
                @endif
              </td></tr>
              <tr><th width="25%">PKP Number</th><td> : {{$data->pkp_number}}{{$data->ket_no}}</td></tr>
              @if($data->project_dev!=NULL)
              <tr><th width="25%">PKP Number Dev</th><td> : {{$data->project_dev}}</td></tr>
              @endif
              <tr><th>Status</th><td> : {{$data->status_project}}</td></tr>
              <tr><th>Created</th><td> : {{$data->created_date}}</td></tr>
            </thead>
          </table><br>
        </div>
        <div class="col-md-7">
          <table>
            <thead>
              <tr><th>Idea</td> <td> : {{$data->idea}}</td></tr>
              <tr><th>Configuration</th><td>: 
                @if($data->kemas_eksis!=NULL)(
                  @if($data->kemas->tersier!=NULL)
                 {{ $data->kemas->tersier }}{{ $data->kemas->s_tersier }}
                  @endif

                  @if($data->kemas->sekunder1!=NULL)
                  X {{ $data->kemas->sekunder1 }}{{ $data->kemas->s_sekunder1}}
                  @endif

                  @if($data->kemas->sekunder2!=NULL)
                  X {{ $data->kemas->sekunder2 }}{{ $data->kemas->s_sekunder2 }}
                  @endif

                  @if($data->kemas->primer!=NULL)
                  X{{ $data->kemas->primer }}{{ $data->kemas->s_primer }}
                  @endif )
                @endif
              </td></tr>
              <tr><th width="25%">Launch Deadline</th><td>: {{$data->launch}} {{$data->years}} {{$data->tgl_launch}}</td></tr>
              <tr><th>Sample Deadline</th><td>: {{$data->jangka}}-  {{$data->waktu}}</td></tr>
              <tr><th>PV</th><td> : {{$data->perevisi2->name}}</td></tr>
              @if($data->file!=NULL)
              <tr><th>File</th><td> : <a href="{{asset('data_file/'.$data->file)}}" download="{{$data->file}}" title="Download file"><li class="fa fa-download"></li></a> {{$data->file}} <a href="{{route('hapus_upload',$data->id_project)}}" title="Delete"><li class="fa fa-times"></li></a></td></tr>
              @endif
            </thead>
          </table><br>
        </div>
      </div>
    </div>
  </div>                
  
  @if(auth()->user()->role->namaRule =='user_produk')
  <div class="col-md-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h4><li class="fa fa-list"></li> Workbook  </h4>
      </div>
      <div class="card-block">
        <div class="x_content">
          <table id="datatable" class="table table-striped table-bordered" style="width:100%">
            <thead>
              <tr style="font-weight: bold;color:white;background-color: #2a3f54;">     
                <th class="text-center" width="5%">#</th>                                  
                <th class="text-center" width="5%">Versi</th>
                <th class="text-center" width="10%">Category</th>  
                <th class="text-center">Formula</th>
                <th class="text-center">Status Sample</th>
                <th class="text-center">Note RD</th>
                <th class="text-center">Note PV</th>
                <th class="text-center" width="16%">Action</th>
              </tr>
            </thead>  
            <tbody>
              @foreach($sample as $wb)
              @if($wb->status=='final')
              <tr style="background-color:springgreen">
              @elseif($wb->vv=='reject')
              <tr style="background-color:slategray;color:white">
              @else
              <tr>
              @endif
                <td width="2%" class="text-center"> <a href="{{ route('deleteFormula',$wb->id) }}" onclick="return confirm('Hapus Formula ?')"><i class="fa fa-trash" data-toggle="tooltip" title="Delete"></i></a></td> 
                <td class="text-center">{{ $wb->versi }}.{{ $wb->turunan }}</td>
                <td>
                  @if($wb->kategori!='fg'){{$wb->kategori}}
                  @elseif($wb->kategori=='fg')Finished Good
                  @endif
                </td>
                <td>{{$wb->formula}}</td>
                <td class="text-center" width="10%">
                  @if($wb->vv == 'proses')<span class="label label-warning">Proses</span>@endif
                  @if($wb->vv == 'reject')<span class="label label-danger">Rejected</span>@endif 
                  @if($wb->vv == 'approve')<span class="label label-success">Approved</span>@endif 
                  @if($wb->vv == 'final')<span class="label label-info">Final Approved</span>@endif 
                  @if($wb->vv == '')<span class="label label-primary">Belum Diajukan</span>@endif    
                </td>
                <td class="text-center">{{$wb->catatan_rd}}</td>
                <td class="text-center">{{$wb->catatan_pv}}</td>
                <td class="text-center">
                  <a class="btn btn-info btn-sm" href="{{ route('formula.detail',[$wb->id,$id->id_project,$wb->workbook_id]) }}" data-toggle="tooltip" title="Show"><i style="font-size:12px;" class="fa fa-eye"></i></a>
                  <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#update{{$wb->id}}" data-toggle="tooltip" title="Updata"><i style="font-size:12px;" class="fa fa-arrow-circle-up"></i></a>
                  <!-- UpVersion -->
                  <div class="modal fade" id="update{{$wb->id}}" role="dialog" aria-labelledby="hm" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title" id="hm" style="font-weight: bold;color:black;"> Update Data</h4>
                        </div>
                        <div class="modal-body">
                          <a class="btn btn-primary btn-sm" href="{{ route('upversion',[$wb->id,$id->id_project,$wb->workbook_id]) }}" onclick="return confirm('Up Version ?')"><i style="font-size:12px;" class="fa fa-arrow-circle-up"></i> Up Version</a><br><br>
                          <a class="btn btn-warning btn-sm" href="{{ route('upversion2',[$wb->id,$id->id_project,$wb->workbook_id]) }}" onclick="return confirm('Up Sub Version ?')"><i style="font-size:12px;" class="fa fa-arrow-circle-up"></i> Up Sub Version</a>
                        </div>
                        <div class="modal-footer">
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  @if($wb->status!='proses')
                  <a class="btn btn-primary btn-sm" href="{{ route('step1',[$wb->id,$id->id_project,$wb->workbook_id]) }}"><i style="font-size:12px;" class="fa fa-edit" data-toggle="tooltip" title="Edit"></i></a>
                  <a class="btn btn-dark btn-sm" href="{{ route('ajukanvp',[$wb->id,$id->id_pkp]) }}" onclick="return confirm('Ajukan Formula Kepada PV?')" data-toggle="tooltip" title="Ajukan PV"><li class="fa fa-paper-plane"></li></a>
                  @elseif($wb->vv == 'approve' || $wb->vv == 'proses' || $wb->vv == 'final')
                  <a class="btn btn-primary btn-sm" href="{{ route('panel',[$wb->id,$id->id_project,$wb->workbook_id]) }}" data-toggle="tooltip" title="Panel"><li class="fa fa-glass"></li></a>
                  <a class="btn btn-warning btn-sm" href="{{ route('st',[$wb->id,$id->id_project,$wb->workbook_id]) }}" data-toggle="tooltip" title="Storage"><li class="fa fa-flask"></li></a>
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>  
  @elseif(auth()->user()->role->namaRule == 'pv_lokal' || auth()->user()->role->namaRule == 'marketing')
  <div class="col-md-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h3><li class="fa fa-list"></li> List Sample Project</h3>
      </div>
      <div class="card-block">
        <div class="x_content">
          <table id="datatable" class="table table-striped table-bordered" style="width:100%">
            <thead>
              <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                <th width="1%"></th>
                <th class="text-center" width="3%">Versi</th>
                <th class="text-center">Formula</th>
                <th class="text-center" width="25%">Note RD</th>
                <th class="text-center" width="25%">Note PV</th>
                <th class="text-center" width="10%">Status</th>
                <th class="text-center" width="13%">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($formula as $for)
              @if($for!='proses')
              @if($for->vv=='final')
              <tr style="background-color:springgreen">
              @elseif($for->vv=='reject')
              <tr style="background-color:slategray;color:white">
              @else
              <tr>
              @endif
                <td width="1%"></td>
                <td>{{$for->versi}}.{{$for->turunan}}</td>
                <td>{{$for->formula}}</td>
                <td width="25%">{{$for->catatan_rd}}</td>
                <td width="25%">{{$for->catatan_pv}}</td>
                <td class="text-center">
                  @if($for->vv=='proses')<span class="label label-primary" style="color:white">New Sample</span>
                  @elseif($for->vv=='approve')<span class="label label-info" style="color:white">Approved</span>
                  @elseif($for->vv=='reject')<span class="label label-danger" style="color:white">Project rejected</span>
                  @elseif($for->vv=='final')<span class="label label-info" style="color:white">Final data Data</span>
                  @endif
                </td>
                <td class="text-center"> 
                  <a class="btn btn-info btn-sm" href="{{ route('formula.detail',[$for->id,$id->id_project,$for->workbook_id]) }}" data-toggle="tooltip" title="Show"><i style="font-size:12px;" class="fa fa-eye"></i></a>
                  @if(auth()->user()->role->namaRule == 'pv_lokal')
                    @if($for->vv=='proses')
                      <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#rejectsample{{ $for->id  }}" title="Reject"><li class="fa fa-times"></li></a>  
                        <!-- Modal -->
                        <div class="modal" id="rejectsample{{ $for->id  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h3 class="modal-title" id="exampleModalLabel">Reject Sample
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button></h3>
                              </div>
                              
                              <div class="modal-body">
                                <form class="form-horizontal form-label-left" method="POST" action="{{route('rejectsample',$for->id)}}">
                                <textarea name="note" id="note" rows="2" cols="60" class="form-control" required></textarea><br>
                              </div>
                              <div class="modal-footer">
                                <button class="btn btn-sm btn-primary" type="submit"><li class="fa fa-check"></li> submit</button>
                                {{ csrf_field() }}
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- Modal Selesai -->
                      <button class="btn btn-success btn-sm" title="Approve" data-toggle="modal" data-target="#fs{{ $for->id  }}"><i class="fa fa-check"></i></a></button>
                        <!-- Modal -->
                        <div class="modal" id="fs{{ $for->id  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h3 class="modal-title" id="exampleModalLabel">Approve Sample
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button></h3>
                              </div>
                              <div class="modal-body">
                                <form class="form-horizontal form-label-left" method="POST" action="{{route('approvesample',$for->id)}}">
                                <textarea name="note" id="note" cols="60" rows="2" class="form-control" required></textarea><br>
                              </div>
                              <div class="modal-footer">
                                <button class="btn btn-sm btn-primary" type="submit"><li class="fa fa-check"></li> submit</button>
                                {{ csrf_field() }}
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- Modal Selesai -->
                    @elseif($for->vv=='approve')
                      @if($for->status_feasibility=='proses' || $for->status_feasibility=='sent' || $for->status_feasibility=='done')
                      <a href="{{route('finalsample',$for->id)}}" class="btn btn-success btn-sm" title="Final Approval"><li class="fa fa-tag"></li></a>
                        <a href="{{route('PengajuanFS_PKP',[$id->id_project,$for->id])}}" class="btn btn-warning btn-sm" title="Pengajuan FS"><li class="fa fa-folder"></li></a>
                      @elseif($for->status_feasibility=='' || $for->status_feasibility=='reject')
                        <a href="{{route('PengajuanFS_PKP',[$id->id_project,$for->id])}}" class="btn btn-primary btn-sm" title="Ajukan FS"><li class="fa fa-paper-plane"></li></a>
                      @endif
                    @elseif($for->vv=='final')
                      <a href="{{route('unfinalsample',$for->id)}}" class="btn btn-warning btn-sm" title="Unfinal Approve"><li class="fa fa-times"></li> Unfinal</a>
                    @endif
                  @endif
                </td>
              </tr>
              @endif
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  @endif
</div>

<!-- modal -->
<div class="modal" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">                 
        <h3 class="modal-title" id="exampleModalLabel">Edit Type PKP
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> </h3>
      </div>
      <div class="modal-body">
      <form class="form-horizontal form-label-left" method="POST" action="{{ route('edittype',$data->id_project) }}" novalidate>
        <div class="form-group row">
          <label class="control-label text-bold col-md-2 col-sm-3 col-xs-12 text-center">Type</label>
          <div class="col-md-10 col-sm-9 col-xs-12">
            <select name="type" class="form-control form-control-line" id="type">
              <option disabled selected value="{{$data->type}}">
                @if($data->type==1)Maklon
                @elseif($data->type==2)Internal
                @elseif($data->type==3)Maklon/Internal
                @endif
              </option>
              <option value="1">Maklon</option>
              <option value="2">Internal</option>
              <option value="3">Maklon & Internal</option>
            </select>
          </div>
        </div>
      </div>
      @foreach($user as $user)
        @if($user->role_id=='1' || $user->role_id=='5' || $user->role_id=='14')
        <input type="hidden" value="{{$user->name}}" name="namatujuan[]" id="namatujuan">
        <input type="hidden" value="{{$user->email}}" name="emailtujuan[]" id="emailtujuan">
        @endif
      @endforeach
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</button>
        {{ csrf_field() }}
      </div>
      </form>
    </div>
  </div>
</div>
<!-- modal selesai -->

<!-- Modal -->
<div class="modal" id="data1{{ $data->id_project  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Timeline Project : {{$data->project_name}}
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button></h3>
      </div>
      <div class="modal-body">
        <div class="row x_panel">
          <form class="form-horizontal form-label-left" method="POST" action="{{ Route('EditTimelinepkp',$data->id_project)}}" novalidate>
          <label class="control-label col-md-2 col-sm-2 col-xs-12 text-center">Deadline</label>
          <div class="col-md-5 col-sm-9 col-xs-12">
            <input type="date" class="form-control" value="{{$data->jangka}}" name="jangka" id="jangka" placeholder="start date">
          </div>
          <div class="col-md-5 col-sm-9 col-xs-12">
            <input type="date" class="form-control" value="{{$data->waktu}}" name="waktu" id="waktu" placeholder="end date">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</button>
        {{ csrf_field() }}
      </div>
      </form>
    </div>
  </div>
</div>
@endsection
@section('s')
<script type="text/javascript">
  function satuan_ml(){
    var satuan_ml = document.getElementById('id_ml')
    if(satuan_ml.checked == true){
      document.getElementById('tampilkan').innerHTML =
        "<div class='form-group row'>"+
        "  <label class='control-label col-md-3 col-sm-3 col-xs-12'>Berat Jenis</label>"+
        "  <div class='col-md-8 col-sm-9 col-xs-12'>"+
        "    <input type='text' placeholder='Berat Jenis' name='berat_jenis' id='berat_jenis' class='form-control col-md-12 col-xs-12'>"+
        "  </div>"+
        "</div>"
    }
  }

  function satuan_gram(){
    var satuan_gram = document.getElementById('id_gram')
    if(satuan_gram.checked == true){
      document.getElementById('tampilkan').innerHTML =
        "<div class='form-group row'>"+
        "  <label class='control-label col-md-3 col-sm-3 col-xs-12'>Berat Jenis</label>"+
        "  <div class='col-md-8 col-sm-9 col-xs-12'>"+
        "    <input type='text' placeholder='Berat Jenis' disabled name='' id='' class='form-control col-md-12 col-xs-12'>"+
        "  </div>"+
        "</div>"
    }
  }

  function finis_good(){
    var finis_good = document.getElementById('id_finis')
    if(finis_good.checked == true){
      document.getElementById('ditampilkan').innerHTML =
        "<select name='' disabled id='' class='form-control'>"+
        "  <option disabled selected>--> Select One <--</option>"+
        "  <option value='granulasi'>Granulasi</option>"+
        "  <option value='premix'>Premix</option>"+
        "</select>"
    }
  }

  function wip(){
    var wip = document.getElementById('id_wip')
    if(wip.checked == true){
      document.getElementById('ditampilkan').innerHTML =
        "<select name='kategori_formula' id='' class='form-control' required>"+
        "  <option disabled selected>--> Select One <--</option>"+
        "  <option value='granulasi'>Granulasi</option>"+
        "  <option value='premix'>Premix</option>"+
        "</select>"
    }
  }
</script>
@endsection