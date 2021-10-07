@extends('layout.tempmanager')
@section('title', 'PRODEV|Daftar PDF')
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
		@foreach($data as $data)
    <div class="x_panel">
      <div class="col-md-5">
        <h3><li class="fa fa-star"></li> Project Name: {{ $data->project_name}}</h3>
      </div>
      <div class="col-md-7" align="right">
        @if($data->status_project!='close')
        <button class="btn btn-dark btn-sm"  data-toggle="modal" data-target="#alihkan"><li class="fa fa-paper-plane"></li> Divert Project</button>
          <!-- modal -->
          <div class="modal" id="alihkan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">                 
                  <h3 class="modal-title text-center" id="exampleModalLabel">Divert Project
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </h3>
                </div>
                <div class="modal-body">
                <form class="form-horizontal form-label-left" method="POST" action="{{ route('alihkanpdf',$data->id_project_pdf) }}" novalidate>
                  <div class="form-group row">
                    <label class="control-label text-bold col-md-1 col-sm-3 col-xs-12 text-center">Dept1</label>
                    <div class="col-md-11 col-sm-9 col-xs-12">
                      <select name="tujuankirim" class="form-control form-control-line" id="type">
                        @if($data->tujuankirim!='6')
                        <option value="{{$data->tujuankirim}}" disabled selected>Not Selected</option>
                        <option value="6">RPE (R&D Product Export Departement)</option>
                        @elseif($data->tujuankirim=='6')
                        <option value="{{$data->tujuankirim}}" disabled selected>{{$data->departement->dept}} ({{$data->departement->nama_dept}})</option>
                        <option value="1">Not Selected</option>
                        @endif
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="control-label text-bold col-md-1 col-sm-3 col-xs-12 text-center">Dept2</label>
                    <div class="col-md-11 col-sm-9 col-xs-12">
                      <select name="tujuankirim2" class="form-control form-control-line" id="type">
                        @if($data->tujuankirim2!='1') 
                        <option value="0" selected>No Departement Selected</option>
                        <option value="1">RKA (R&D Kemas & service Departement)</option>
                        @else($data->tujuanlirim2=='1')
                        <option value="{{$data->tujuankirim2}}" selected>{{$data->departement2->dept}} ({{$data->departement2->nama_dept}})</option>
                        <option value="0">No Departement Selected</option>
                        @endif
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
                  <form method="post" action="{{route('uploadfile_pdf',$data->id_project_pdf)}}" enctype="multipart/form-data">                                    
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
        @foreach($pdf as $data1)
        <a class="btn btn-info btn-sm" href="{{ Route('pdflihat',['id_project_pdf' => $data1->id_project_pdf, 'revisi' => $data1->revisi, 'turunan' => $data1->turunan]) }}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i> Show</a>
        @endforeach
        <a href="{{ route('listpdfrka')}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-share"></li> Back</a>
      </div>

      <div class="x_panel">
        <div class="card-block">
          <div class="col-md-6">
            <table>
              <thead>
                <tr><th>PDF Number</th><td> : {{$data->pdf_number}}{{$data->ket_no}} </td></tr>
                <tr><th>Brand</th><td> : {{$data->id_brand}} </td></tr>
                <tr><th>Type</th><td> : {{$data->datapdf->type->type}} </td></tr>
                <tr><th>Priority</th><td> : 
                  @if($data->prioritas=='1') <span class="label label-danger">High Priority</span>
                  @elseif($data->prioritas=='2') <span class="label label-warning">Standar Priority</span>
                  @elseif($data->prioritas=='3') <span class="label label-primary">Low Priority</span>
                  @endif
                </td></tr>
                <tr><th>PV</th><td> : {{$data->perevisi2->name}} </td></tr>
              </thead>
            </table><br>
          </div>
          <div class="col-md-5">
            <table>
              <thead>
                <tr><th>Created</th><td> : {{$data->created_date}} </td></tr>
                <tr><th>Last Update</th><td> : {{$data->last_update}} </td></tr>
                <tr><th>Background</hd><td> : {{$data->background}} </td></tr>
                <tr><th>Configuration</th><td>: 
                  @if($data->kemas_eksis!=NULL)
                    (
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
                    @endif
                    )
                  @endif
                </td></tr>
                @if($data->file!=NULL)
                <tr><th>File</th><td> : <a href="{{asset('data_file/'.$data->file)}}" download="{{$data->file}}" title="download file"><li class="fa fa-download"></li></a> {{$data->file}}</td></tr>
                @endif
              </thead>
            </table><br>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>    

  <div class="col-md-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h3><li class="fa fa-list"></li> Workbook </h3>
      </div>
      <div class="card-block">
        <div class="x_content">
          <table id="datatable" class="table table-striped table-bordered" style="width:100%">
            <thead>
              <tr style="font-weight: bold;color:white;background-color: #2a3f54;">     
                <th class="text-center" width="3%">#</th>                                  
                <th class="text-center" width="5%">Versi</th>
                <th class="text-center" width="10%">Category Formula</th>  
                <th class="text-center">Formula</th>
                <th class="text-center">Status Sample</th>
                <th class="text-center">Note RD</th>
                <th class="text-center">Note PV</th>
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
                  @if($wb->kategori!='fg') {{$wb->kategori}}
                  @elseif($wb->kategori=='fg') Finished Good
                  @endif
                </td>
                <td>{{ $wb->formula}}</td>
                <td class="text-center" width="10%">
                  @if($wb->vv == 'proses') <span class="label label-warning">Proses</span>    
                  @elseif($wb->vv == 'reject') <span class="label label-danger">Rejected</span>  
                  @elseif($wb->vv == 'approve') <span class="label label-success">Approved</span>    
                  @elseif($wb->vv == 'final') <span class="label label-info">Final Approved</span>      
                  @elseif($wb->vv == '') <span class="label label-primary">Belum Diajukan</span>                        
                  @endif   
                </td>
                <td class="text-center">{{$wb->catatan_rd}}</td>
                <td class="text-center">{{$wb->catatan_pv}}</td>
                <td class="text-center">
                @if(auth()->user()->departement_id == '3' || auth()->user()->departement_id == '4' || auth()->user()->departement_id == '5' || auth()->user()->departement_id == '6')
                  {{csrf_field()}}
                  <a class="btn btn-info btn-sm" href="{{ route('formula.detail',[$wb->id,$id->id_project_pdf,$wb->workbook_pdf_id]) }}" data-toggle="tooltip" title="Show"><i style="font-size:12px;" class="fa fa-eye"></i></a>
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
                          <a class="btn btn-primary btn-sm" href="{{ route('upversion',[$wb->id,$id->id_project_pdf,$wb->workbook_pdf_id]) }}" onclick="return confirm('Up Version ?')"><i style="font-size:12px;" class="fa fa-arrow-circle-up"></i> Up Version</a><br><br>
                          <a class="btn btn-warning btn-sm" href="{{ route('upversion2',[$wb->id,$id->id_project_pdf,$wb->workbook_pdf_id]) }}" onclick="return confirm('Up Sub Version ?')"><i style="font-size:12px;" class="fa fa-arrow-circle-up"></i> Up Sub Version</a>
                        </div
                        <div class="modal-footer">
                        </div>
                      </div>
                    </div>
                  </div>
                  @if($wb->status!='proses')
                  <a class="btn btn-primary btn-sm" href="{{ route('step1_pdf',[$wb->workbook_pdf_id,$wb->id]) }}"><i style="font-size:12px;" class="fa fa-edit" data-toggle="tooltip" title="Edit"></i></a>
                  <a class="btn btn-dark btn-sm" href="{{ route('ajukanvp',[$wb->id,$wb->workbook_pdf_id]) }}" onclick="return confirm('Ajukan Formula Kepada PV?')" data-toggle="tooltip" title="Ajukan PV"><li class="fa fa-paper-plane"></li></a>
                  @elseif($wb->vv == 'approve' || $wb->vv == 'proses')
                    <a class="btn btn-primary btn-sm" href="{{ route('panel',[$wb->id,$id->id_project_pdf,$wb->workbook_pdf_id]) }}" data-toggle="tooltip" title="Lanjutkan Panel"><li class="fa fa-glass"></li></a>
                    <a class="btn btn-warning btn-sm" href="{{ route('st',[$wb->id,$id->id_project_pdf,$wb->workbook_pdf_id]) }}" data-toggle="tooltip" title="Lanjutkan Storage"><li class="fa fa-flask"></li></a>
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
@endsection