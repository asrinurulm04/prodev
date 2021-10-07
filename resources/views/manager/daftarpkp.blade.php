@extends('layout.tempmanager')
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
		@foreach($listpkp as $listpkp)
    <div class="x_panel">
      <div class="col-md-6">
        <h3><li class="fa fa-star"></li> Project Name : {{ $listpkp->project_name}}@if($listpkp->jenis!='Baku')_{{$listpkp->no_kemas}}@endif</h3>
      </div>
      <div class="col-md-6" align="right">
        @if($listpkp->status_project!='close' && $listpkp->status_project!='revisi')
        <button class="btn btn-dark btn-sm"  data-toggle="modal" data-target="#alihkan"><li class="fa fa-paper-plane"></li> Divert Project</button>
        <!-- modal -->
        <div class="modal" id="alihkan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h3 class="modal-title text-left" id="exampleModalLabel">Divert Project
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></h3>
                </button>
              </div>
              <div class="modal-body">
              <form class="form-horizontal form-label-left" method="POST" action="{{ route('alihkan',$listpkp->id_project) }}" novalidate>
                <div class="form-group row">
                  <label class="control-label text-bold col-md-2 col-sm-3 col-xs-12 text-center">Dept Product</label>
                  <div class="col-md-10 col-sm-9 col-xs-12">
                    <select name="tujuankirim" class="form-control form-control-line" id="type">
                    <option Value="{{$listpkp->tujuankirim}}" selected>{{$listpkp->departement->dept}} ({{$listpkp->departement->nama_dept}})</option>
                    @foreach($dept as $dept)
                      <option value="{{$dept->id}}">{{$dept->dept}} ({{$dept->nama_dept}})</option>
                    @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label text-bold col-md-2 col-sm-3 col-xs-12 text-center">Dept kemas</label>
                  <div class="col-md-10 col-sm-9 col-xs-12">
                    <select name="tujuankirim2" class="form-control form-control-line" id="type">
                    @if($listpkp->tujuankirim2==0)
                      <option value="0" disabled selected>No Departement Selected</option>
                      @elseif($listpkp->tujuanlirim2==1)
                      <option  Value="{{$listpkp->tujuankirim2}}" selected>{{$listpkp->departement2->dept}} ({{$listpkp->departement2->nama_dept}})</option>
                      @endif<option value="1">RKA</option>
                      <option value="0">No Departement Selected</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> Submit</button>
                {{ csrf_field() }}
              </div>
              </form>
            </div>
          </div>
        </div>
        <!-- modal selesai -->
        @endif
          @if($cf != 0)
            <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#upload"><i class="fa fa-upload"></i> Upload LHP</a>
            <!-- Formula Baru -->
            <div class="modal fade" id="upload" role="dialog" aria-labelledby="hm" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title text-center" id="hm"> Upload FIle</h4>
                  </div>
                  <div class="modal-body">
                    <form method="post" action="{{route('uploadfile',$listpkp->id_pkp)}}" enctype="multipart/form-data">                                    
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
            <a class="btn btn-info btn-sm" href="{{ Route('pkplihat',$listpkp->id_project) }}" data-toggle="tooltip" title="show"><i class="fa fa-folder-open"></i> Show</a>
        <a href="{{ route('listpkprka')}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-share"></li> Back</a>
      </div>

      <div class="x_panel">
        <div class="col-md-5">
          <table>
						<thead>
              <tr><th width="20%">PKP Number</th><td>: </td><td> {{$listpkp->pkp_number}}{{$listpkp->ket_no}}</td></tr>
							<tr><th>Brand</th><td>: </td><td> {{$listpkp->id_brand}}</td></tr>
							<tr><th>Type PKP</th><td>: </td><td> 
              @if($listpkp->type==1)
              Maklon
              @elseif($listpkp->type==2)
              Internal
              @elseif($listpkp->type==3)
              Maklon/Internal
              @endif</td></tr>
              <tr><th>Last Update</th><td>: </td><td> {{ $listpkp->last_update}}</td></tr>
              <tr><th>Created</th><td>: </td><td> {{$listpkp->created_date}}</td></tr>
						</thead>
					</table>
        </div>
        <div class="col-md-5">
          <table>
						<thead>
              <tr><th>Prioritas</th><td>: </td><td> {{$listpkp->prioritas}}</td></tr>
              <tr><th>Perevisi</th><td>:</td><td> {{$listpkp->perevisi2->name}}</td></tr>
              <tr><th>Idea</th><td>:</td> <td> {{$listpkp->idea}}</td></tr>
              <tr><th>Configuration</th><td>: </td><td>
                @if($listpkp->kemas_eksis!=NULL)
                  (
                  @if($listpkp->kemas->tersier!=NULL)
                  {{ $listpkp->kemas->tersier }}{{ $listpkp->kemas->s_tersier }}
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
                  X{{ $listpkp->kemas->primer }}{{ $listpkp->kemas->s_primer }}
                  @elseif($listpkp->kemas->primer==NULL)
                  @endif
                  )
                @endif
              </td></tr>
              @if($listpkp->file!=NULL)
              <tr><th>File</th><td>:</td><td> <a href="{{asset('data_file/'.$listpkp->file)}}" download="{{$listpkp->file}}" title="download file"><li class="fa fa-download"></li></a> {{$listpkp->file}}</td></tr>
              @endif
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
            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr style="font-weight: bold;color:white;background-color: #2a3f54;">     
                  <th class="text-center" width="3%">No</th>                                  
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
                @foreach($sample as $wb)
                @if($wb->status=='final')
                <tr style="background-color:springgreen">
                @elseif($wb->vv=='reject')
                <tr style="background-color:slategray;color:white">
                @else
                <tr>
                @endif
                  <td class="text-center">{{++$no}}</td>
                  <td>{{ $wb->versi }}.{{ $wb->turunan }}</td>
                  <td>
                    @if($wb->kategori!='fg')
                    {{$wb->kategori}}
                    @elseif($wb->kategori=='fg')
                    Finished Good
                    @endif
                  </td>
                  <td>{{ $wb->formula}}</td>
                  <td class="text-center" width="10%">
                    @if ($wb->vv == 'proses') <span class="label label-warning">Proses</span> @endif
                    @if ($wb->vv == 'reject') <span class="label label-danger">Rejected</span> @endif 
                    @if ($wb->vv == 'approve') <span class="label label-success">Approved</span> @endif 
                    @if ($wb->vv == 'final') <span class="label label-info">Final Approved</span> @endif 
                    @if ($wb->vv == '') <span class="label label-primary">Belum Diajukan</span> @endif   
                  </td>
                  <td class="text-center"> {{$wb->catatan_rd}} </td>
                  <td class="text-center"> {{$wb->catatan_pv}} </td>
                  <td class="text-center">
                  @if(auth()->user()->departement_id == '3' || auth()->user()->departement_id == '4' || auth()->user()->departement_id == '5' || auth()->user()->departement_id == '6')
                    {{csrf_field()}}
                    <a class="btn btn-info btn-sm" href="{{ route('formula.detail',[$wb->id,$pkp->id_project,$wb->workbook_id]) }}" data-toggle="tooltip" title="Show"><i style="font-size:12px;" class="fa fa-eye"></i></a>
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
                          <a class="btn btn-primary btn-sm" href="{{ route('upversion',[$wb->id,$pkp->id_project,$wb->workbook_id]) }}" onclick="return confirm('Up Version ?')"><i style="font-size:12px;" class="fa fa-arrow-circle-up"></i> Up Version</a><br><br>
                          <a class="btn btn-warning btn-sm" href="{{ route('upversion2',[$wb->id,$pkp->id_project,$wb->workbook_id]) }}" onclick="return confirm('Up Sub Version ?')"><i style="font-size:12px;" class="fa fa-arrow-circle-up"></i> Up Sub Version</a>
                          </div>
                          <div class="modal-footer">
                          </div>
                        </div>
                      </div>
                    </div>
                    @if($wb->status!='proses')
                    <a class="btn btn-primary btn-sm" href="{{ route('step1',[$wb->id,$pkp->id_project,$pkp->workbook_id]) }}"><i style="font-size:12px;" class="fa fa-edit" data-toggle="tooltip" title="Edit"></i></a>
                    <a class="btn btn-dark btn-sm" href="{{ route('ajukanvp',[$wb->workbook_id,$pkp->id]) }}" onclick="return confirm('Ajukan Formula Kepada PV?')" data-toggle="tooltip" title="Ajukan PV"><li class="fa fa-paper-plane"></li></a>
                    @elseif($wb->vv == 'approve' || $wb->vv == 'proses')
                    <a class="btn btn-primary btn-sm" href="{{ route('panel',[$wb->id,$pkp->id_project,$wb->workbook_id]) }}" data-toggle="tooltip" title="Lanjutkan Panel"><li class="fa fa-glass"></li></a>
                    <a class="btn btn-warning btn-sm" href="{{ route('st',[$wb->id,$pkp->id_project,$wb->workbook_id]) }}" data-toggle="tooltip" title="Lanjutkan Storage"><li class="fa fa-flask"></li></a>
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