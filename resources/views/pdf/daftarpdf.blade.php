@extends('pv.tempvv')
@section('title', 'Daftar PDF')
@section('judulhalaman','Daftar PDF')
@section('content')

<div class="row">
  <div class="col-md-12 col-xs-12">
    @foreach($pdff as $data)
    <div class="x_panel">
      <div class="col-md-5">
        <h3><li class="fa fa-star"></li> Project Name: {{ $data->project_name}}</h3>
      </div>
      <div class="col-md-7" align="right">
        @if($hitung==0)
        <a href="{{ route('buatpdf',$data->id_project_pdf)}}" class="btn btn-primary btn-sm" type="button"><li class="fa fa-plus"></li> Add Data</a>
        @endif
        <a class="btn btn-info btn-sm" href="{{ Route('lihatpdf',['id_project_pdf' => $data->id_project_pdf, 'revisi' => $data->revisi, 'turunan' => $data->turunan]) }}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i> Show</a>
      
        @if(auth()->user()->role->namaRule=='pv_global')
          @if($data->status_data=='draf')
          <a class="btn btn-warning btn-sm" href="{{ route('buatpdf1',['id_project_pdf' => $data->id_project_pdf, 'revisi' => $data->revisi, 'turunan' => $data->turunan])}}" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i> Edit</a>
          <a href="{{ route('drafpdf')}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-share"></li> Back</a>
          @elseif($data->status_project=="revisi")
          <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#data{{ $data->id_project_pdf  }}" ><i class="fa fa-edit"></i> Edit Timeline</a></button>
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
          <a class="btn btn-warning btn-sm" href="{{ route('buatpdf1',['id_project_pdf' => $data->id_project_pdf, 'revisi' => $data->revisi, 'turunan' => $data->turunan])}}" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i> Edit</a>
          <a href="{{ route('datapengajuan')}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-share"></li> Back</a>
          @elseif($data->status_project=="sent" && $data->status_project=="proses")
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
                       <label class="col-lg-3 control-label">Target Serving</label>
                       <div class="col-lg-8">
                         <div class="row">
                           <div class="col-md-6"><input class="form-control " id="target_serving" name="target_serving" type="number" required/></div>
                           <div class="col-md-6">
                             <input type="radio" checked name="satuan" oninput="satuan_gram()" id="id_gram" value="Gram"> Gram
                             <input type="radio" name="satuan" oninput="satuan_ml()" id="id_ml" value="Ml"> Ml
                           </div>
                         </div>
                       </div>
                     </div>
                     <div id="tampilkan" class="form-group">
                       <label class="col-lg-3 control-label">Berat Jenis</label>
                       <div class="col-lg-8">
                         <div class="row">
                           <div class="col-md-12"><input class="form-control" placeholder='Berat Jenis' id="" disabled name="" type="number" required/></div>
                         </div>
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
                <tr><td>Brand</td><td> : {{$data->id_brand}}</td></tr>
                <tr><td>Type</td><td> : {{$data->type->type}}</td></tr>
                <tr><td>PDF Number</td><td> : {{$data->pdf_number}}{{$data->ket_no}}</td></tr>
                <tr><td>Created</td><td> : {{$data->created_date}}</td></tr>
                <tr><td>Author</td><td> : {{$data->author1->name}}</td></tr>
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
            <table class="Table table-striped table-bordered">
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
                  @if ($sample->vv == 'proses')
                  <span class="label label-warning">Proses</span>                        
                  @endif
                  @if ($sample->vv == 'reject')
                  <span class="label label-danger">Rejected</span>                        
                  @endif 
                  @if ($sample->vv == 'approve')
                  <span class="label label-success">Approved</span>                        
                  @endif 
                  @if ($sample->vv == 'final')
                  <span class="label label-info">Final Approved</span>                        
                  @endif 
                  @if ($sample->vv == '')
                  <span class="label label-primary">Belum Diajukan</span>                        
                  @endif   
                </td>
                <td class="text-center">
                {{$sample->catatan_rd}}
                </td>
                <td class="text-center">
                  @if($sample->vv == 'reject')
                  {{$sample->catatan_pv}}    
                  @endif
                </td>
                <td class="text-center">
                  {{csrf_field()}}
                  <a class="btn btn-info btn-sm" href="{{ route('formula.detail',[$sample->workbook_pdf_id,$sample->id]) }}" data-toggle="tooltip" title="Show"><i style="font-size:12px;" class="fa fa-eye"></i></a>
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
                          <a class="btn btn-primary btn-sm" href="{{ route('upversion',$sample->workbook_pdf_id) }}" onclick="return confirm('Up Version ?')"><i style="font-size:12px;" class="fa fa-arrow-circle-up"></i> Up Version</a><br><br>
                          <a class="btn btn-warning btn-sm" href="{{ route('upversion2',[$sample->id,$sample->versi]) }}" onclick="return confirm('Up Sub Version ?')"><i style="font-size:12px;" class="fa fa-arrow-circle-up"></i> Up Sub Version</a>
                        </div
                        <div class="modal-footer">
                        </div>
                      </div>
                    </div>
                  </div>
                  @if($sample->status!='proses')
                  <a class="btn btn-primary btn-sm" href="{{ route('step1_pdf',[$sample->workbook_pdf_id,$sample->id]) }}"><i style="font-size:12px;" class="fa fa-edit" data-toggle="tooltip" title="Edit"></i></a>
                  <a class="btn btn-dark btn-sm" href="{{ route('ajukanvp',[$sample->workbook_pdf_id,$sample->id]) }}" onclick="return confirm('Ajukan Formula Kepada PV?')" data-toggle="tooltip" title="Ajukan PV"><li class="fa fa-paper-plane"></li></a>
                  @elseif($sample->vv == 'approve')
                    @if($sample->status_panel=='proses')
                    <a class="btn btn-primary btn-sm" href="{{ route('panel',[$sample->workbook_pdf_id,$sample->id]) }}" data-toggle="tooltip" title="Lanjutkan Panel"><li class="fa fa-glass"></li></a>
                    @endif
                    @if($sample->status_storage=='proses')
                    <a class="btn btn-warning btn-sm" href="{{ route('st',[$sample->workbook_pdf_id,$sample->id]) }}" data-toggle="tooltip" title="Lanjutkan Storage"><li class="fa fa-flask"></li></a>
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
    @else
    <div class="col-md-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h3><li class="fa fa-list"></li> List Sample Project</h3>
        </div>
        <div class="card-block">
          <div class="x_content">
            <form action="">
            <table class="Table table-bordered table-striped table-bordered">
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
                @foreach($sample as $pdf)
                @if($pdf->status=='final')
                <tr style="background-color:springgreen">
                @elseif($pdf->vv=='reject')
                <tr style="background-color:slategray;color:white">
                @else
                <tr>
                @endif
                  <td>{{ $pdf->sample }}</td>
                  <td>{{ $pdf->note }}</td>
                  <td class="text-center">
                    @if(auth()->user()->role->namaRule == 'pv_global')
                      @if($pdf->status=='send')
                      <a href="{{route('approvesamplepdf',$pdf->id_sample)}}" class="btn btn-primary btn-sm" title="Approve"><li class="fa fa-check"></li></a>  
                      <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#reject{{ $pdf->id_sample  }}" title="Reject"><li class="fa fa-times"></li></a>  
                      <!-- Modal -->
                      <div class="modal" id="reject{{ $pdf->id_sample  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h3 class="modal-title" id="exampleModalLabel">Reject Sample {{ $pdf->id_sample  }}
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button></h3>
                            </div>
                            
                            <div class="modal-body">
                              <form action=""></form>
                              <form class="form-horizontal form-label-left" method="POST" action="{{route('rejectsamplepdf',$pdf->id_sample)}}">
                                <label for="">Note</label>
                                <textarea name="note" id="note" rows="2" class="form-control" required></textarea>
                              <div class="modal-footer">
                                <button class="btn btn-sm btn-primary btn-sm" type="submit">submit</button>
                                {{ csrf_field() }}
                              </div>
                            </div>
                          </form>
                          </div>
                        </div>
                      </div>
                      <!-- Modal Selesai -->
                      @elseif($pdf->status=='reject')
                      <span class="label label-danger" style="color:white">sample rejected</span>
                      @elseif($pdf->status=='approve')
                        @if($status_sample==1)
                        <span class="label label-info" style="color:white">sample Approved</span>
                        @else
                        <a href="{{route('finalsamplepdf',[ 'id_project_pdf' => $pdf->id_pdf, 'sample' => $pdf->id_sample])}}" class="btn btn-info btn-sm" title="Final Approval"><li class="fa fa-tag"></li> Final Approval</a>
                        @endif
                      @elseif($pdf->status=='final')
                        <a href="{{route('unfinalsamplepdf',[ 'id_project_pdf' => $pdf->id_pdf, 'sample' => $pdf->id_sample])}}" class="btn btn-warning btn-sm" title="Unfinal Approve"><li class="fa fa-times"></li> Unfinal</a>
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
    @endif
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
            "  <label class='control-label col-md-3 col-sm-3 col-xs-12'>Berat Jenis</label>"+
            "  <div class='col-md-8 col-sm-9 col-xs-12'>"+
            "    <input type='number' placeholder='Berat Jenis' name='berat_jenis' id='berat_jenis' class='form-control col-md-12 col-xs-12' required>"+
            "  </div>"+
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
            "  <label class='control-label col-md-3 col-sm-3 col-xs-12'>Berat Jenis</label>"+
            "  <div class='col-md-8 col-sm-9 col-xs-12'>"+
            "    <input type='number' placeholder='Berat Jenis' disabled name='' id='' class='form-control col-md-12 col-xs-12'>"+
            "  </div>"+
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