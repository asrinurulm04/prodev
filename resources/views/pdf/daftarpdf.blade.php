@extends('pv.tempvv')
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
        @foreach($pdf as $pdf)
        <a class="btn btn-info btn-sm" href="{{ Route('lihatpdf',['pdf_id' => $pdf->pdf_id,'revisi' => $pdf->revisi, 'turunan' => $pdf->turunan]) }}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i> Show</a>
        @if($pdf->status_data=='revisi' || $pdf->status_data=='draf')
          @if($pdf->status_pdf=='active')
          <a class="btn btn-warning btn-sm" href="{{ route('buatpdf1', ['pdf_id' => $pdf->pdf_id,'revisi' => $pdf->revisi, 'turunan' => $pdf->turunan]) }}" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i> Edit</a>
          @endif
        @endif
        @endforeach
        @if($cf != 0)
          @if($data->file==NULL)
          <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#upload"><i class="fa fa-upload"></i> Upload LHP
          @endif
        @endif
        @if($hitung==0)
          <a href="{{ route('buatpdf',$data->id_project_pdf)}}" class="btn btn-primary btn-sm" type="button"><li class="fa fa-plus"></li> Add Data</a>
        @endif

        @if(auth()->user()->role->namaRule=='pv_global')
          @if($data->status_project=='draf')
          <a href="{{ route('drafpdf')}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-share"></li> Back</a>
          @elseif($data->status_project=="revisi")
          <a href="{{ route('datapengajuan')}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-share"></li> Back</a>
          @elseif($data->status_project=="sent" || $data->status_project=="close" || $data->status_project=="proses")
          <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#data{{ $data->id_project_pdf  }}"><i class="fa fa-edit"></i> Edit Timeline</a>
          <a href="{{ route('listpdf')}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-share"></li> Back</a>
          @endif
        @elseif(auth()->user()->role->namaRule === 'kemas')
        <a href="{{ route('listprojectpdf')}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-share"></li> Back</a>
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
                    <form class="cmxform form-horizontal style-form" method="POST" action="{{ route('addformula') }}">
                    <input class="form-control " id="workbook_pdf_id" name="workbook_pdf_id" type="hidden" value="{{ $data->id_project_pdf}}"/>   
                    <input class="form-control " id="akg" name="akg" type="hidden" value="6"/>                                      
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
                           <div class="col-md-12"><input class="form-control" placeholder='Berat Jenis' id="" disabled name="" type="text" required/></div>
                        </div>
                        <label for="" style="color:red">* gunakan (.) untuk pengganti (,)</label>
                       </div>
                     </div>
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
          <a href="{{ route('listprojectpdf')}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-share"></li> Back</a>
        @endif
      </div>
      <div class="x_panel">
        <div class="card-block">
          <div class="x_content">
            <table>
              <thead>
                <tr><th>Brand</th><td> : {{$data->id_brand}}</td></tr>
                <tr><th>Type</th><td> : {{$data->type->type}}</td></tr>
                <tr><th>PDF Number</th><td> : {{$data->pdf_number}}{{$data->ket_no}}</td></tr>
                <tr><th>Created</th><td> : {{$data->created_date}}</td></tr>
                @foreach($data1 as $data1)
                <tr><th>PV/Global</th><td> : {{$data1->perevisi2->name}}</td></tr>
                <tr><th>Configuration</th><td>: 
                  @if($data1->kemas_eksis!=NULL)
                    (
                    @if($data1->kemas->tersier!=NULL)
                    {{ $data1->kemas->tersier }}{{ $data1->kemas->s_tersier }}
                    @elseif($data1->kemas->tersier==NULL)
                    @endif

                    @if($data1->kemas->sekunder1!=NULL)
                    X {{ $data1->kemas->sekunder1 }}{{ $data1->kemas->s_sekunder1}}
                    @elseif($data1->kemas->sekunder1==NULL)
                    @endif

                    @if($data1->kemas->sekunder2!=NULL)
                    X {{ $data1->kemas->sekunder2 }}{{ $data1->kemas->s_sekunder2 }}
                    @elseif($data1->kemas->sekunder2==NULL)
                    @endif

                    @if($data1->kemas->primer!=NULL)
                    X{{ $data1->kemas->primer }}{{ $data1->kemas->s_primer }}
                    @elseif($data1->kemas->primer==NULL)
                    @endif
                    )
                  @endif
                </td></tr>
                @endforeach
                @if($data->file!=NULL)
                <tr><th>File</th><td> : <a href="{{asset('data_file/'.$data->file)}}" download="{{$data->file}}" title="Download file"><li class="fa fa-download"></li></a> {{$data->file}} </a><a href="{{route('hapus_upload_pdf',$data->id_project_pdf)}}" title="Delete"><li class="fa fa-times"></li></a></td></tr>
                @endif
              </thead>
            </table><br>
          </div>
        </div>
      </div>
    </div>
    @endforeach

    @if(auth()->user()->role->namaRule == 'user_produk')
    <div class="col-md-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h3><li class="fa fa-list"></li> Sample Submission List  </h3>
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
                @foreach($sample as $sample)
                @if($sample->status=='final')
                <tr style="background-color:springgreen">
                @elseif($sample->vv=='reject')
                <tr style="background-color:slategray;color:white">
                @else
                <tr>
                @endif
                  <td width="2%" class="text-center">
                    <a href="{{ route('deleteFormula',$sample->id) }}" onclick="return confirm('Hapus Formula ?')"><i style="font-size:12px;" class="fa fa-trash" data-toggle="tooltip" title="Delete"></i></a>
                  </td> 
                  <td>{{ $sample->versi }}.{{ $sample->turunan }}</td>
                  <td>
                    @if($sample->kategori!='fg')
                    {{$sample->kategori}}
                    @elseif($sample->kategori=='fg')
                    Finished Good
                    @endif
                  </td>
                  <td>{{ $sample->formula}}</td>
                  <td class="text-center" width="10%">
                    @if ($sample->vv == 'proses')<span class="label label-warning">Proses</span>@endif
                    @if ($sample->vv == 'reject')<span class="label label-danger">Rejected</span>@endif 
                    @if ($sample->vv == 'approve')<span class="label label-success">Approved</span>@endif 
                    @if ($sample->vv == 'final')<span class="label label-info">Final Approved</span>@endif 
                    @if ($sample->vv == '')<span class="label label-primary">Belum Diajukan</span>@endif   
                  </td>
                  <td class="text-center">{{$sample->catatan_rd}}</td>
                  <td class="text-center">{{$sample->catatan_pv}}</td>
                  <td class="text-center">
                    {{csrf_field()}}
                    <a class="btn btn-info btn-sm" href="{{ route('formula.detail',[$sample->workbook_pdf_id,$sample->id]) }}" data-toggle="tooltip" title="Show"><i style="font-size:12px;" class="fa fa-eye"></i></a>
                    <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#update{{$sample->id}}" data-toggle="tooltip" title="Updata"><i style="font-size:12px;" class="fa fa-arrow-circle-up"></i></a>
                    <!-- UpVersion -->
                    <div class="modal fade" id="update{{$sample->id}}" role="dialog" aria-labelledby="hm" aria-hidden="true">
                      <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="hm" style="font-weight: bold;color:black;"> Update Data</h4>
                          </div>
                          <div class="modal-body">
                            <a class="btn btn-primary btn-sm" href="{{ route('upversion',[$sample->id,$sample->workbook_pdf_id]) }}" onclick="return confirm('Up Version ?')"><i style="font-size:12px;" class="fa fa-arrow-circle-up"></i> Up Version</a><br><br>
                            <a class="btn btn-warning btn-sm" href="{{ route('upversion2',[$sample->id,$sample->versi]) }}" onclick="return confirm('Up Sub Version ?')"><i style="font-size:12px;" class="fa fa-arrow-circle-up"></i> Up Sub Version</a>
                          </div
                          <div class="modal-footer">
                          </div>
                        </div>
                      </div>
                    </div>
                    @if($sample->status!='proses')
                    <a class="btn btn-primary btn-sm" href="{{ route('step1_pdf',[$sample->workbook_pdf_id,$sample->id]) }}"><i style="font-size:12px;" class="fa fa-edit" data-toggle="tooltip" title="Edit"></i></a>
                    <a class="btn btn-dark btn-sm" href="{{ route('ajukanvp',[$sample->workbook_pdf_id,$sample->id]) }}" onclick="return confirm('Ajukan Formula Kepada PV?')" data-toggle="tooltip" title="Ajukan Global"><li class="fa fa-paper-plane"></li></a>
                    @elseif($sample->vv == 'approve' || $sample->vv == 'proses')
                      <a class="btn btn-primary btn-sm" href="{{ route('panel',[$sample->workbook_pdf_id,$sample->id]) }}" data-toggle="tooltip" title="Lanjutkan Panel"><li class="fa fa-glass"></li></a>
                      <a class="btn btn-warning btn-sm" href="{{ route('st',[$sample->workbook_pdf_id,$sample->id]) }}" data-toggle="tooltip" title="Lanjutkan Storage"><li class="fa fa-flask"></li></a>
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
    @else
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
                  <th class="text-center" width="3%">#</th>                                  
                  <th class="text-center" width="5%">Versi</th>
                  <th class="text-center" width="10%">Category</th>  
                  <th class="text-center">Formula</th>
                  <th class="text-center">Note RD</th>
                  <th class="text-center">Note PV/Global</th>
                  <th class="text-center" width="16%">Action</th>
                </tr>
              </thead> 
              <tbody>
                @foreach($sample_pv as $sample1)
                @if($sample1->status=='final')
                <tr style="background-color:springgreen">
                @elseif($sample1->vv=='reject')
                <tr style="background-color:slategray;color:white">
                @else
                <tr>
                @endif
                  <td width="2%" class="text-center"></td> 
                  <td>{{ $sample1->versi }}.{{ $sample1->turunan }}</td>
                  <td>
                    @if($sample1->kategori!='fg')
                    {{$sample1->kategori}}
                    @elseif($sample1->kategori=='fg')
                    Finished Good
                    @endif
                  </td>
                  <td>{{ $sample1->formula}}</td>
                  <td class="text-center">{{$sample1->catatan_rd}}</td>
                  <td class="text-center">{{$sample1->catatan_pv}}</td>
                  <td class="text-center"> 
                    <a class="btn btn-info btn-sm" href="{{ route('formula.detail',[$sample1->workbook_pdf_id,$sample1->id]) }}" data-toggle="tooltip" title="Show"><i style="font-size:12px;" class="fa fa-eye"></i></a>
                  @if($sample1->vv=='proses')
                    <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#rejectsample{{ $sample1->id  }}" title="Reject"><li class="fa fa-times"></li></a>  
                    <!-- Modal -->
                    <div class="modal" id="rejectsample{{ $sample1->id  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h3 class="modal-title" id="exampleModalLabel">Reject Sample
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button></h3>
                          </div>
                          
                          <div class="modal-body">
                            <form class="form-horizontal form-label-left" method="POST" action="{{route('rejectsample',$sample1->id)}}">
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
                    <button class="btn btn-success btn-sm" title="Approve" data-toggle="modal" data-target="#fs{{ $sample1->id  }}"><i class="fa fa-check"></i></a></button>
                    <!-- Modal -->
                    <div class="modal" id="fs{{ $sample1->id  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h3 class="modal-title" id="exampleModalLabel">Approve Sample
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button></h3>
                          </div>
                          <div class="modal-body">
                            <form class="form-horizontal form-label-left" method="POST" action="{{route('approvesample',$sample1->id)}}">
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
                  @elseif($sample1->vv=='approve')
                    <a href="" disabled class="btn btn-primary btn-sm" title="Ajukan FS"><li class="fa fa-paper-plane"></li></a>
                    <a href="{{route('finalsample',$sample1->id)}}" class="btn btn-success btn-sm" title="Final Approval"><li class="fa fa-tag"></li></a>
                  @elseif($sample1->vv=='final')
                    <a href="{{route('unfinalsample',$sample1->id)}}" class="btn btn-warning btn-sm" title="Unfinal Approve"><li class="fa fa-times"></li> Unfinal</a>
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
    @endif
  </div>
</div>

<!-- Modal -->
<div class="modal" id="data{{ $data->id_project_pdf  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h3 class="modal-title text-center" id="exampleModalLabel">Timeline Project : {{$data->project_name}}
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button></h3>
      </div>
      <form class="form-horizontal form-label-left" method="POST" action="{{ Route('TMubahpdf',$data->id_project_pdf)}}" novalidate>    
      <div class="modal-body">
        <div class="row x_panel">
          <label class="control-label col-md-3 col-sm-3 col-xs-12 text-center">Deadline for sending Sample</label>
          <div class="col-md-4 col-sm-9 col-xs-12">
            <input type="date" class="form-control" value="{{$data->jangka}}" name="jangka" id="jangka" placeholder="start date">
          </div>
          <div class="col-md-4 col-sm-9 col-xs-12">
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
<!-- Modal Selesai -->


<!-- Formula Baru -->
<div class="modal" id="upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
@endsection
@section('s')
<script type="text/javascript">
  function satuan_ml(){
    var satuan_ml = document.getElementById('id_ml')
    if(satuan_ml.checked != true){
      document.getElementById('tampilkan').innerHTML = "";
    }else{
      document.getElementById('tampilkan').innerHTML =
      "<div class='form-group row'>"+
        "<label class='control-label col-md-3 col-sm-3 col-xs-12'>Berat Jenis</label>"+
        "<div class='col-md-8 col-sm-9 col-xs-12'>"+
          "<input type='text' placeholder='Berat Jenis' name='berat_jenis' id='berat_jenis' class='form-control col-md-12 col-xs-12' required>"+
        "</div>"+
      "</div>"
    }
  }

  function satuan_gram(){
    var satuan_gram = document.getElementById('id_gram')
    if(satuan_gram.checked != true){
      document.getElementById('tampilkan').innerHTML = "";
    }else{
      document.getElementById('tampilkan').innerHTML =
      "<div class='form-group row'>"+
        "<label class='control-label col-md-3 col-sm-3 col-xs-12'>Berat Jenis</label>"+
        "<div class='col-md-8 col-sm-9 col-xs-12'>"+
          "<input type='text' placeholder='Berat Jenis' disabled name='' id='' class='form-control col-md-12 col-xs-12'>"+
        "</div>"+
      "</div>"
    }
  }

  function finis_good(){
    var finis_good = document.getElementById('id_finis')
    if(finis_good.checked != true){
      document.getElementById('ditampilkan').innerHTML = "";
    }else{
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
    if(wip.checked != true){
      document.getElementById('ditampilkan').innerHTML = "";
    }else{
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