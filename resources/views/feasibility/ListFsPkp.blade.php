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
      <a href="{{route('reportinfo',$pkp->id_project)}}" class="btn btn-sm btn-success" type="button"><li class="fa fa-files-o"></li> Report</a> 
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
              <th class="text-center" width="8%">Versi</th>
              <th class="text-center" width="15%">Kode Formula</th>
              <th class="text-center" width="12%">Lokasi</th>
              <th class="text-center" width="12%">Batch Size (g)</th>
              <th class="text-center" width="20%">Action</th>
              <th class="text-center" width="8%">Product</th>
              <th class="text-center" width="8%">Proses</th>
              <th class="text-center" width="8%">Kemas</th>
              <th class="text-center" width="8%">Lab</th>
              <th class="text-center" width="8%">Maklon</th>
            </tr>
          </thead>
          <tbody>
            @foreach($fs as $fs)
              <tr>
                <td class="text-center">{{$fs->revisi}}.{{$fs->revisi_kemas}}.{{$fs->revisi_proses}}.{{$fs->revisi_produk}}</td>
                <td>{{$fs->workbook->formula}}</td>
                <td class="text-center">{{$fs->lokasi}}</td>
                <td>{{$fs->batchsize}}</td>
                <td class="text-center">
                  @if($fs->status_feasibility=='pengajuan')
                    <a href="{{route('DetailPengajuanFsPKP',[$fs->id_project,$fs->id_formula,$fs->id])}}" class="btn btn-sm btn-dark" type="button"><li class="fa fa-file"></li> Pengajuan</a>
                  @elseif($fs->status_feasibility=='proses')
                    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#sent{{$fs->id_project}}{{$fs->id_formula}}" title="Up"><i class="fa fa-arrow-circle-o-up"></i></a></button>
                    <a href="{{route('DetailPengajuanFsPKP',[$fs->id_project,$fs->id_formula,$fs->id])}}" class="btn btn-sm btn-primary" type="button" title="sent"><li class="fa fa-paper-plane"></li></a>
                    <a href="{{route('info',[$fs->id_project,$fs->id_formula])}}" class="btn btn-sm btn-info" type="button" title="Information"><li class="fa fa-file"></li></a>
                  @endif
                </td>
                <!-- Action user product -->
                <td class="text-center">
                  @if($fs->status_product=='proses')
                    <a href="{{ route('formula.detail',[$fs->workbook->id,$fs->id_project,$fs->workbook->workbook_id]) }}" class="btn btn-sm btn-info" type="button" title="Show"><li class="fa fa-edit"></li></a>
                  @elseif($fs->status_product=='selesai' || $fs->status_product=='sending')
                    <a href="{{ route('formula.detail',[$fs->workbook->id,$fs->id_project,$fs->workbook->workbook_id]) }}" class="btn btn-sm btn-info" type="button" title="Show"><li class="fa fa-folder"></li></a>
                  @endif  
                </td>
                <!-- Action user Proses -->
                <td class="text-center">
                  @if(auth()->user()->role->namaRule === 'user_rd_proses' || auth()->user()->role->namaRule === 'manager')
                    @if($fs->status_proses=='ajukan')
                    <a href=" {{route('workbookfs',$fs->id_project)}}" class="btn btn-sm btn-danger" type="button" title="request"><li class="fa fa-warning"></li></a>
                    @elseif($fs->status_proses=='proses' )
                    <a href="{{ route('formula.detail',[$fs->workbook->id,$fs->id_project,$fs->workbook->workbook_id]) }}" class="btn btn-sm btn-info" type="button" title="Show"><li class="fa fa-edit"></li></a>
                    @elseif($fs->status_proses=='sending' || $fs->status_proses=='selesai')
                      <a href="{{ route('formula.detail',[$fs->workbook->id,$fs->id_project,$fs->workbook->workbook_id]) }}" class="btn btn-sm btn-info" type="button" title="Show"><li class="fa fa-folder"></li></a>
                    @endif 
                  @else
                    <a disabled class="btn btn-sm btn-danger" type="button" title="request"><li class="fa fa-warning"></li></a>
                  @endif
                </td>
                <!-- Action user Kemas -->
                <td class="text-center">
                  @if(auth()->user()->role->namaRule === 'kemas' || auth()->user()->role->namaRule === 'manager')
                    @if($fs->status_kemas=='ajukan')
                      <a href=" {{route('workbookfs',$fs->id_project)}}" class="btn btn-sm btn-danger" type="button" title="request"><li class="fa fa-warning"></li></a>
                    @elseif($fs->status_kemas=='proses')
                      <a href="{{ route('formula.detail',[$fs->workbook->id,$fs->id_project,$fs->workbook->workbook_id]) }}" class="btn btn-sm btn-info" type="button" title="Show"><li class="fa fa-edit"></li></a>
                    @elseif($fs->status_kemas=='selesai' || $fs->status_kemas=='sending')
                      <a href="{{ route('formula.detail',[$fs->workbook->id,$fs->id_project,$fs->workbook->workbook_id]) }}" class="btn btn-sm btn-info" type="button" title="Show"><li class="fa fa-folder"></li></a>
                    @endif
                  @else
                    <a disabled class="btn btn-sm btn-info" type="button" title="show"><li class="fa fa-warning"></li></a>
                  @endif 
                </td>
                <!-- Action user Lab -->
                <td class="text-center">
                  @if(auth()->user()->role->namaRule === 'lab')
                    @if($fs->status_lab!='sending' || $fs->status_lab!='')
                    <a href=" {{route('datalab',[$fs->id_project,$fs->id])}}" class="btn btn-sm btn-danger" type="button" title="request"><li class="fa fa-warning"></li></a>
                    @elseif($fs->status_lab=='sending')
                    <a href="{{ route('formula.detail',[$fs->workbook->id,$fs->id_project,$fs->workbook->workbook_id]) }}" class="btn btn-sm btn-info" type="button" title="Show"><li class="fa fa-folder"></li></a>
                    @endif
                  @else
                    <a disabled class="btn btn-sm btn-danger" type="button" title="request"><li class="fa fa-warning"></li></a>
                  @endif
                </td>
                <!-- Action user Maklon -->
                <td class="text-center">
                  @if(auth()->user()->role->namaRule === 'user_rd_proses' || auth()->user()->role->namaRule === 'manager' || auth()->user()->role->namaRule === 'maklon')
                    @if($fs->status_maklon=='ajukan')  
                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#maklon{{$fs->id}}"><li class="fa fa-warning"></li></button>
                    @elseif($fs->status_maklon=='proses' || $fs->status_maklon=='selesai')
                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#maklon2{{$fs->id}}"><li class="fa fa-warning"></li></button>
                    @elseif($fs->status_maklon=='sending')
                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#maklon2{{$fs->id}}"><li class="fa fa-warning"></li></button>
                    @endif
                  @else
                    <a disabled class="btn btn-sm btn-info" type="button" title="show"><li class="fa fa-warning"></li></a>
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

<!-- modal maklon-->
<div class="modal" id="maklon{{$fs->id}}"" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
          <input type="text" value="{{$fs->id}}" name="id_fs" id="id_fs">
        <div class="form-group row">
          <label class="control-label text-bold col-md-3 col-sm-3 col-xs-12 text-center"> Biaya Maklon/UOM*</label>
          <div class="col-md-4 col-sm-4 col-xs-12">
            <input type="number" class="form-control" name="biaya" id="biaya" required>
          </div>
          <label class="control-label text-bold col-md-1 col-sm-1 col-xs-12 text-center">Satuan*</label>
          <div class="col-md-4 col-sm-4 col-xs-12">
            <input type="text" class="form-control" name="satuan" id="satuan" required>
          </div>
        </div>
        <div class="form-group row">
          <label class="control-label text-bold col-md-3 col-sm-3 col-xs-12 text-center">Remarks</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="remarks_biaya" id="remarks_biaya">
          </div>
        </div><div class="form-group row">
          <label class="control-label text-bold col-md-3 col-sm-3 col-xs-12 text-center">Biaya Transport*</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="number" class="form-control" name="transportasi" id="transportasi" required>
          </div>
        </div><div class="form-group row">
          <label class="control-label text-bold col-md-3 col-sm-3 col-xs-12 text-center">Remarks</label>
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
<div class="modal" id="maklon2{{$fs->id}}"" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">                 
        <center><h3 class="modal-title" id="exampleModalLabel">Data Maklon 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button></h3></center>
      </div>
      <div class="modal-body">
        @foreach($maklon as $maklon)
        @if($maklon->id_fs==$fs->id)
        <div class="form-group row">
          <label class="control-label text-bold col-md-3 col-sm-3 col-xs-12 text-center"> Biaya Maklon/UOM</label>
          <div class="col-md-4 col-sm-4 col-xs-12">
            <input type="number" class="form-control" value="{{$maklon->biaya_maklon}}" name="" id="" readonly>
          </div>
          <label class="control-label text-bold col-md-1 col-sm-1 col-xs-12 text-center">Satuan</label>
          <div class="col-md-4 col-sm-4 col-xs-12">
            <input type="text" class="form-control" value="{{$maklon->satuan}}" name="" id="" readonly>
          </div>
        </div>
        <div class="form-group row">
          <label class="control-label text-bold col-md-3 col-sm-3 col-xs-12 text-center">Remarks</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control" value="{{$maklon->remarks_biaya}}" name="" id="" readonly>
          </div>
        </div><div class="form-group row">
          <label class="control-label text-bold col-md-3 col-sm-3 col-xs-12 text-center">Biaya Transport</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="number" class="form-control" value="{{$maklon->biaya_transport}}" name="" id="" readonly>
          </div>
        </div><div class="form-group row">
          <label class="control-label text-bold col-md-3 col-sm-3 col-xs-12 text-center">Remarks</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control" value="{{$maklon->remarks_transport}}" name="" id="" readonly>
          </div>
        </div><hr>
        @endif
        @endforeach
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