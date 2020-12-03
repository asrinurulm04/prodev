@extends('manager.tempmanager')
@section('title', 'Daftar PKP')
@section('judulhalaman','Form PKP')
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
		@foreach($listpkp as $listpkp)
    <div class="x_panel">
      <div class="col-md-5">
        <h3><li class="fa fa-star"></li> Project Name : {{ $listpkp->project_name}}</h3>
      </div>
      <div class="col-md-7" align="right">
        @if($listpkp->status_terima!='proses' || $listpkp->status_terima2!='proses')
          @if(Auth::user()->departement->dept!='RKA')
          <button class="btn btn-success btn-sm"  data-toggle="modal" data-target="#edit"><li class="fa fa-edit"></li> Edit Type PKP</button>
          <!-- modal -->
          <div class="modal" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">                 
                  <h3 class="modal-title" id="exampleModalLabel">Edit Type PKP
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button> </h3>
                </div>
                <div class="modal-body">
                <form class="form-horizontal form-label-left" method="POST" action="{{ route('edittype',$listpkp->id_project) }}" novalidate>
                  <div class="form-group row">
                    <label class="control-label text-bold col-md-1 col-sm-3 col-xs-12 text-center">Type</label>
                    <div class="col-md-11 col-sm-9 col-xs-12">
                      <select name="type" class="form-control form-control-line" id="type">
                      @foreach($pkp1 as $pkp1)
                      <option disabled selected value="{{$pkp1->type}}">
                      @if($pkp1->type==1)
                      Maklon
                      @elseif($pkp1->type==2)
                      Internal
                      @elseif($pkp1->type==3)
                      Maklon/Internal
                      @endif</option>
                      @endforeach
                      <option value="1">Maklon</option>
                      <option value="2">Internal</option>
                      <option value="3">Maklon & Internal</option>
                      </select>
                    </div>
                    @foreach($user as $user)
                    @if($user->role_id=='1' || $user->role_id=='5' || $user->role_id=='14')
                    <input type="hidden" value="{{$user->name}}" name="namatujuan[]" id="namatujuan">
                    <input type="hidden" value="{{$user->email}}" name="emailtujuan[]" id="emailtujuan">
                    @endif
                    @endforeach
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Submit</button>
                  {{ csrf_field() }}
                </div>
                </form>
              </div>
            </div>
          </div>
          <!-- modal selesai -->
          @endif
        @endif
        @if($listpkp->status_project!='close' && $listpkp->status_project!='revisi')
        <button class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#alihkan"><li class="fa fa-paper-plane"></li> Divert Project</button>
        <!-- modal -->
        <div class="modal" id="alihkan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">                 
                <h3 class="modal-title" id="exampleModalLabel">Divert Project
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button> </h3>
              </div>
              <div class="modal-body">
              <form class="form-horizontal form-label-left" method="POST" action="{{ route('alihkan',$listpkp->id_project) }}" novalidate>
                <div class="form-group row">
                  <label class="control-label text-bold col-md-1 col-sm-3 col-xs-12 text-center">Dept1</label>
                  <div class="col-md-11 col-sm-9 col-xs-12">
                    <select name="tujuankirim" class="form-control form-control-line" id="type">
                    <option disabled selected>{{$listpkp->departement->dept}} ({{$listpkp->departement->nama_dept}})</option>
                    @foreach($dept as $dept)
                      <option value="{{$dept->id}}">{{$dept->dept}} ({{$dept->nama_dept}})</option>
                    @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label text-bold col-md-1 col-sm-3 col-xs-12 text-center">Dept2</label>
                  <div class="col-md-11 col-sm-9 col-xs-12">
                    <select name="tujuankirim2" class="form-control form-control-line" id="type">
                    @if($listpkp->tujuankirim2==0)
                      <option value="0" disabled selected>No Departement Selected</option>
                      @elseif($listpkp->tujuanlirim2==1)
                      <option selected>{{$listpkp->departement2->dept}} ({{$listpkp->departement2->nama_dept}})</option>
                      
                      @endif<option value="1">RKA</option>
                      <option value="0">No Departement Selected</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Submit</button>
                {{ csrf_field() }}
              </div>
              </form>
            </div>
          </div>
        </div>
        <!-- modal selesai -->
        @endif
        @foreach($datapkp as $pkp)
          @if($pkp->datapkpp->type==1 && $pkp->gambaran_proses==NULL)
            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#maklon{{$pkp->id_pkp}}" totle="show"><i class="fa fa-folder-open"></i></a> Show</button>
            <!-- Modal -->
            <div class="modal" id="maklon{{$pkp->id_pkp}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h3 class="modal-title text-left" id="exampleModalLabel">Tambah Data Maklon
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></h3>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form class="form-horizontal form-label-left" method="POST" action="{{ Route('Gproses',['id_pkp' => $pkp->id_pkp, 'revisi' => $pkp->revisi, 'turunan' => $pkp->turunan]) }}" novalidate>
                    <div class="form-group">
                      <label class="control-label col-md-2 col-sm-3 col-xs-12">Gambaran Proses</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <textarea name="proses" id="proses"30" rows="5" class="form-control col-md-12 col-xs-12"></textarea>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Submit</button>
                      {{ csrf_field() }}
                    </div>
                  </form>
                  </div>
                </div>
              </div>
            </div>
          @else
            <a class="btn btn-info btn-sm" href="{{ Route('pkplihat',['id_pkp' => $pkp->id_pkp, 'revisi' => $pkp->revisi, 'turunan' => $pkp->turunan]) }}" data-toggle="tooltip" title="show"><i class="fa fa-folder-open"></i> Show</a>
          @endif
        @endforeach
        <a href="{{ route('listpkprka')}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-share"></li> Back</a>
      </div>

      <div class="x_panel">
        <div class="col-md-5">
          <table>
						<thead>
              <tr><td width="20%">PKP Number</td><td>: </td><td> {{$listpkp->pkp_number}}{{$listpkp->ket_no}}</td></tr>
							<tr><td>Brand</td><td>: </td><td> {{$listpkp->id_brand}}</td></tr>
							<tr><td>Type PKP</td><td>: </td><td> 
              @if($listpkp->type==1)
              Maklon
              @elseif($listpkp->type==2)
              Internal
              @elseif($listpkp->type==3)
              Maklon/Internal
              @endif</td></tr>
              <tr><td>Last Update</td><td>: </td><td> {{ $listpkp->last_update}}</td></tr>
              <tr><td>Created</td><td>: </td><td> {{$listpkp->created_date}}</td></tr>
						</thead>
					</table>
        </div>
        <div class="col-md-5">
          <table>
						<thead>
              <tr><td>Prioritas</td><td>: </td><td> 
                @if($listpkp->prioritas=='1')
                <span class="label label-danger">High Priority</span>
                @elseif($listpkp->prioritas=='2')
                <span class="label label-warning">Standar Priority</span>
                @elseif($listpkp->prioritas=='3')
                <span class="label label-primary">Low Priority</span>
                @endif  
              </td></tr>
              <tr><td>Perevisi</td><td>:</td><td> {{$listpkp->perevisi2->name}}</td></tr>
              <tr><td>Idea</td><td>:</td> <td> {{$listpkp->idea}}</td></tr>
              <tr><td>Packaging</td><td> : </td><td>
                @if($listpkp->kemas_eksis!=NULL)
                (
                  @if($listpkp->kemas->tersier!=NULL)
                  {{ $listpkp->kemas->tersier }}{{ $pkp->kemas->s_tersier }}
                  @elseif($listpkp->kemas->tersier==NULL)
                  @endif

                  @if($listpkp->kemas->sekunder1!=NULL)
                  X {{ $listpkp->kemas->sekunder1 }}{{ $listpkp->kemas->s_sekunder1}}
                  @elseif($listpkp->kemas->sekunder1==NULL)
                  @endif

                  @if($listpkp->kemas->sekunder2!=NULL)
                  X {{ $listpkp->kemas->sekunder2 }}{{ $listpkp->kemas->s_sekunder2 }}
                  @elseif($listpkp->kemas->sekunder2==NULL)
                  @endif

                  @if($listpkp->kemas->primer!=NULL)
                  X{{ $listpkp->kemas->primer }}{{ $pkp->kemas->s_primer }}
                  @elseif($listpkp->kemas->primer==NULL)
                  @endif
                )
                @endif
              </td></tr>
						</thead>
					</table>
        </div>
      </div>
			@endforeach
    </div> 

    <div class="col-md-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h3><li class="fa fa-list"></li> List Formula  </h3>
        </div>
        <div class="card-block">
          <div class="x_content">
            <table class="Table table-striped table-bordered">
              <thead>
                <tr style="font-weight: bold;color:white;background-color: #2a3f54;">     
                  <th class="text-center" width="3%">#</th>                                  
                  <th class="text-center" width="5%">Versi</th>
                  <th class="text-center" width="10%">Category Formula</th>  
                  <th class="text-center">Formula</th>
                  <th class="text-center">Status Sample</th>
                  <th class="text-center" width="20%">Note RD</th>
                  <th class="text-center" width="20%">Note PV</th>
                  <th class="text-center" width="16%">Action</th>
                </tr>
              </thead> 
              <tbody>
                @php $no = 0; @endphp
                @foreach($sample as $pkp)
                @if($pkp->status=='final')
                <tr style="background-color:springgreen">
                @elseif($pkp->vv=='reject')
                <tr style="background-color:slategray;color:white">
                @else
                <tr>
                @endif
                  <td class="text-center">{{++$no}}</td>
                  <td>{{ $pkp->versi }}.{{ $pkp->turunan }}</td>
                  <td>
                    @if($pkp->kategori!='fg')
                    {{$pkp->kategori}}
                    @elseif($pkp->kategori=='fg')
                    Finished Good
                    @endif
                  </td>
                  <td>{{ $pkp->formula}}</td>
                  <td class="text-center" width="10%">
                    @if ($pkp->vv == 'proses')
                    <span class="label label-warning">Proses</span>                        
                    @endif
                    @if ($pkp->vv == 'reject')
                    <span class="label label-danger">Rejected</span>                        
                    @endif 
                    @if ($pkp->vv == 'approve')
                    <span class="label label-success">Approved</span>                        
                    @endif 
                    @if ($pkp->vv == 'final')
                    <span class="label label-info">Final Approved</span>                        
                    @endif 
                    @if ($pkp->vv == '')
                    <span class="label label-primary">Belum Diajukan</span>                        
                    @endif   
                  </td>
                  <td class="text-center">
                  {{$pkp->catatan_rd}}
                  </td>
                  <td class="text-center">
                    @if($pkp->vv == 'reject')
                    {{$pkp->catatan_pv}}    
                    @endif
                  </td>
                  <td class="text-center">
                  @if(auth()->user()->departement_id == '3' || auth()->user()->departement_id == '4' || auth()->user()->departement_id == '5' || auth()->user()->departement_id == '6')
                    {{csrf_field()}}
                    <a class="btn btn-info btn-sm" href="{{ route('formula.detail',[$pkp->workbook_id,$pkp->id]) }}" data-toggle="tooltip" title="Show"><i style="font-size:12px;" class="fa fa-eye"></i></a>
                    <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#update" data-toggle="tooltip" title="Updata"><i style="font-size:12px;" class="fa fa-arrow-circle-up"></i></a>
                    <!-- UpVersion -->
                    <div class="modal fade" id="update" role="dialog" aria-labelledby="hm" aria-hidden="true">
                      <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="hm" style="font-weight: bold;color:black;"> Update Data</h4>
                          </div>
                          <div class="modal-body">
                            <a class="btn btn-primary btn-sm" href="{{ route('upversion',$pkp->workbook_id) }}" onclick="return confirm('Up Version ?')"><i style="font-size:12px;" class="fa fa-arrow-circle-up"></i> Up Version</a><br><br>
                            <a class="btn btn-warning btn-sm" href="{{ route('upversion2',[$pkp->id,$pkp->versi]) }}" onclick="return confirm('Up Sub Version ?')"><i style="font-size:12px;" class="fa fa-arrow-circle-up"></i> Up Sub Version</a>
                          </div
                          <div class="modal-footer">
                          </div>
                        </div>
                      </div>
                    </div>
                    @if($pkp->status!='proses')
                    <a class="btn btn-primary btn-sm" href="{{ route('step1',[$pkp->workbook_id,$pkp->id]) }}"><i style="font-size:12px;" class="fa fa-edit" data-toggle="tooltip" title="Edit"></i></a>
                    <a class="btn btn-dark btn-sm" href="{{ route('ajukanvp',[$pkp->workbook_id,$pkp->id]) }}" onclick="return confirm('Ajukan Formula Kepada PV?')" data-toggle="tooltip" title="Ajukan PV"><li class="fa fa-paper-plane"></li></a>
                    @elseif($pkp->vv == 'approve')
                      @if($pkp->status_panel=='proses')
                      <a class="btn btn-primary btn-sm" href="{{ route('panel',[$pkp->workbook_id,$pkp->id]) }}" data-toggle="tooltip" title="Lanjutkan Panel"><li class="fa fa-glass"></li></a>
                      @endif
                      @if($pkp->status_storage=='proses')
                      <a class="btn btn-warning btn-sm" href="{{ route('st',[$pkp->workbook_id,$pkp->id]) }}" data-toggle="tooltip" title="Lanjutkan Storage"><li class="fa fa-flask"></li></a>
                      @endif
                    @endif
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
  </div>
</div>  
@endsection