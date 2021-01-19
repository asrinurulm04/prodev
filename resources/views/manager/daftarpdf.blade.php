@extends('manager.tempmanager')
@section('title', 'PRODEV|Daftar PDF')
@section('content')

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
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button> </h3>
                </div>
                <div class="modal-body">
                <form class="form-horizontal form-label-left" method="POST" action="{{ route('alihkanpdf',$data->id_project_pdf) }}" novalidate>
                  <div class="form-group row">
                    <label class="control-label text-bold col-md-1 col-sm-3 col-xs-12 text-center">Dept1</label>
                    <div class="col-md-11 col-sm-9 col-xs-12">
                      <select name="tujuankirim" class="form-control form-control-line" id="type">
                        <option disabled selected>{{$data->departement->dept}} ({{$data->departement->nama_dept}})</option>
                        @foreach($dept as $dept)
                          @if($dept->dept=='RPE')
                          <option value="{{$dept->id}}">{{$dept->dept}} ({{$dept->nama_dept}})</option>
                          @endif
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="control-label text-bold col-md-1 col-sm-3 col-xs-12 text-center">Dept2</label>
                    <div class="col-md-11 col-sm-9 col-xs-12">
                      <select name="tujuankirim2" class="form-control form-control-line" id="type">
                        @if($data->tujuankirim2==0)
                        <option value="0" selected>No Departement Selected</option>
                        @elseif($data->tujuanlirim2==1)
                        <option selected>{{$data->departement2->dept}} ({{$data->departement2->nama_dept}})</option>
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
          <div class="col-md-5">
            <table>
              <thead>
                <tr><td>PDF Number</td><td> : {{$data->pdf_number}}{{$data->ket_no}} </td></tr>
                <tr><td>Brand</td><td> : {{$data->id_brand}} </td></tr>
                <tr><td>Type</td><td> : {{$data->datapdf->type->type}} </td></tr>
                <tr><td>Priority</td><td> : 
                  @if($data->prioritas=='1')
                  <span class="label label-danger">High Priority</span>
                  @elseif($data->prioritas=='2')
                  <span class="label label-warning">Standar Priority</span>
                  @elseif($data->prioritas=='3')
                  <span class="label label-primary">Low Priority</span>
                  @endif
                </td></tr>
                <tr><td>PV</td><td> : {{$data->perevisi2->name}} </td></tr>
              </thead>
            </table><br>
          </div>
          <div class="col-md-5">
            <table>
              <thead>
                <tr><td>Created</td><td> : {{$data->created_date}} </td></tr>
                <tr><td>Last Update</td><td> : {{$data->last_update}} </td></tr>
                <tr><td>Background</td><td> : {{$data->background}} </td></tr>
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
              @foreach($sample as $pdf)
              @if($pdf->status=='final')
              <tr style="background-color:springgreen">
              @elseif($pdf->vv=='reject')
              <tr style="background-color:slategray;color:white">
              @else
              <tr>
              @endif
                <td class="text-center">{{++$no}}</td>
                <td>{{ $pdf->versi }}.{{ $pdf->turunan }}</td>
                <td>
                  @if($pdf->kategori!='fg')
                  {{$pdf->kategori}}
                  @elseif($pdf->kategori=='fg')
                  Finished Good
                  @endif
                </td>
                <td>{{ $pdf->formula}}</td>
                <td class="text-center" width="10%">
                  @if ($pdf->vv == 'proses')
                  <span class="label label-warning">Proses</span>                        
                  @endif
                  @if ($pdf->vv == 'reject')
                  <span class="label label-danger">Rejected</span>                        
                  @endif 
                  @if ($pdf->vv == 'approve')
                  <span class="label label-success">Approved</span>                        
                  @endif 
                  @if ($pdf->vv == 'final')
                  <span class="label label-info">Final Approved</span>                        
                  @endif 
                  @if ($pdf->vv == '')
                  <span class="label label-primary">Belum Diajukan</span>                        
                  @endif   
                </td>
                <td class="text-center">{{$pdf->catatan_rd}}</td>
                <td class="text-center">{{$pdf->catatan_pv}}</td>
                <td class="text-center">
                @if(auth()->user()->departement_id == '3' || auth()->user()->departement_id == '4' || auth()->user()->departement_id == '5' || auth()->user()->departement_id == '6')
                  {{csrf_field()}}
                  <a class="btn btn-info btn-sm" href="{{ route('formula.detail',[$pdf->workbook_pdf_id,$pdf->id]) }}" data-toggle="tooltip" title="Show"><i style="font-size:12px;" class="fa fa-eye"></i></a>
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
                          <a class="btn btn-primary btn-sm" href="{{ route('upversion',[$pdf->id,$pdf->workbook_pdf_id]) }}" onclick="return confirm('Up Version ?')"><i style="font-size:12px;" class="fa fa-arrow-circle-up"></i> Up Version</a><br><br>
                          <a class="btn btn-warning btn-sm" href="{{ route('upversion2',[$pdf->id,$pdf->versi]) }}" onclick="return confirm('Up Sub Version ?')"><i style="font-size:12px;" class="fa fa-arrow-circle-up"></i> Up Sub Version</a>
                        </div
                        <div class="modal-footer">
                        </div>
                      </div>
                    </div>
                  </div>
                  @if($pdf->status!='proses')
                  <a class="btn btn-primary btn-sm" href="{{ route('step1',[$pdf->workbook_pdf_id,$pdf->id]) }}"><i style="font-size:12px;" class="fa fa-edit" data-toggle="tooltip" title="Edit"></i></a>
                  <a class="btn btn-dark btn-sm" href="{{ route('ajukanvp',[$pdf->workbook_pdf_id,$pdf->id]) }}" onclick="return confirm('Ajukan Formula Kepada PV?')" data-toggle="tooltip" title="Ajukan PV"><li class="fa fa-paper-plane"></li></a>
                  @elseif($pdf->vv == 'approve' || $pdf->vv == 'proses')
                    <a class="btn btn-primary btn-sm" href="{{ route('panel',[$pdf->workbook_pdf_id,$pdf->id]) }}" data-toggle="tooltip" title="Lanjutkan Panel"><li class="fa fa-glass"></li></a>
                    <a class="btn btn-warning btn-sm" href="{{ route('st',[$pdf->workbook_pdf_id,$pdf->id]) }}" data-toggle="tooltip" title="Lanjutkan Storage"><li class="fa fa-flask"></li></a>
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