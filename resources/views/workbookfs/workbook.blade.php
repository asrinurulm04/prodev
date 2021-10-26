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
              <th class="text-center" width="5%">Versi</th>
              <th class="text-center" width="25%">Name</th>
              <th class="text-center" width="25%">Note</th>
              <th class="text-center" width="25%">Status</th>
              <th class="text-center" width="15%">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($list as $list)
              <tr>
                <td class="text-center">{{$list->opsi}}</td>
                <td>{{$list->name}}</td>
                <td>{{$list->note}}</td>
                <td>{{$list->status}}</td>
                <td class="text-center">
                  @if(auth()->user()->role->namaRule === 'user_rd_proses' && $ws!='0')
                <a class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Edit Data" href="{{route('datamesin',[$pkp->id_project,$list->id])}}"><li class="fa fa-edit"></li></a>
                @elseif(auth()->user()->role->namaRule === 'kemas' && $ws!='0')
                <a class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Edit Data" href="{{route('datakemas',[$pkp->id_project,$list->id])}}"><li class="fa fa-edit"></li></a>
                @endif
                  <button class="btn btn-success btn-sm" title="Update"><li class="fa fa-arrow-circle-up"></li></button>
                  <button class="btn btn-dark btn-sm" data-toggle="modal" data-target="#sent{{ $list->id  }}" title="Up"><i class="fa fa-paper-plane"></i></a></button>
                  <!-- modal maklon-->
                  <div class="modal" id="sent{{$list->id}}"" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog " role="document">
                      <div class="modal-content">
                        <div class="modal-header">                 
                          <center><h3 class="modal-title" id="exampleModalLabel">Sent
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button></h3></center>
                        </div>
                        <div class="modal-body">
                          <div class=" row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <Table class="table table-bordered">
                                <thead>
                                  <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                                    <th class="text-center" width="12%">Revisi</th>
                                    <th class="text-center" width="75%">Note</th>
                                    <th class="text-center" width="13%">Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach($fs as $f)
                                  <tr>
                                    <td class="text-center">{{$f->revisi}}.{{$f->revisi_kemas}}.{{$f->revisi_proses}}.{{$f->revisi_produk}}</td>
                                    <td>{{$f->note}}</td>
                                    <td class="text-center"><a href="{{route('gabung',[$list->id,$f->id])}}" class="btn btn-sm btn-primary" type="button"><li class="fa fa-check"></li> Tetapkan</a></td>
                                  </tr>
                                  @endforeach
                                </tbody>
                              </Table>
                            </div>
                          </div><br>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Modal Selesai -->
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@endsection
@section('s')
<link href="{{ asset('lib/advanced-datatable/css/jquery.dataTables.css') }}" rel="stylesheet" />
<script src="{{ asset('js/datatables.min.js')}}"></script>
@endsection