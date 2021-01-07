@extends('pv.tempvv')
@section('title', 'PRODEV|Daftar PROMO')
@section('content')

<div class="row">
  <div class="col-md-12 col-xs-12">
		@foreach($pkp as $data)
    <div class="x_panel">
      <div class="col-md-5">
        <h3><li class="fa fa-star"></li> Project Name : {{ $data->datapromoo->project_name}}</h3>
      </div>
      <div class="col-md-7" align="right">
        @if($promo==0)
          <a href="{{ route('datapromo',$data->id_pkp_promoo)}}" class="btn btn-primary btn-sm" type="button"><li class="fa fa-plus"></li> Add Data</a>
        @endif
        <a class="btn btn-info btn-sm" href="{{ Route('lihatpromo',['id_pkp_promo' => $data->id_pkp_promoo, 'revisi' => $data->revisi, 'turunan' => $data->turunan]) }}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i> Show</a>
        @if($data->status_promo=='draf' || $data->status_promo=='revisi')
        <a class="btn btn-warning btn-sm" href="{{ route('datapromo11', ['id_pkp_promo' => $data->id_pkp_promoo, 'revisi' => $data->revisi, 'turunan' => $data->turunan]) }}" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i> Edit</a>
        @endif
        @if(auth()->user()->role->namaRule == 'pv_lokal')
          @if($data->datapromoo->status_project=="revisi")
            <button class="btn btn-primary btn-sm" title="note" data-toggle="modal" data-target="#data{{ $data->id_pkp_promoo  }}"><i class="fa fa-edit"></i> Edit Timeline</a></button>
            <!-- Modal -->
            <div class="modal" id="data{{ $data->id_pkp_promoo  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Timeline Project : {{$data->datapromoo->project_name}}
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></h3>
                  </div>
                  <div class="modal-body">
                    <div class="row x_panel">
                      <form class="form-horizontal form-label-left" method="POST" action="{{ Route('TMubah',$data->id_pkp_promoo)}}" novalidate>
                      <label class="control-label col-md-3 col-sm-3 col-xs-12 text-center">Deadline for sending Sample</label>
                      <div class="col-md-4 col-sm-9 col-xs-12">
                        <input type="date" class="form-control" value="{{$data->datapromoo->jangka}}" name="jangka" id="jangka" placeholder="start date">
                      </div>
                      <div class="col-md-4 col-sm-9 col-xs-12">
                        <input type="date" class="form-control" value="{{$data->datapromoo->waktu}}" name="waktu" id="waktu" placeholder="end date">
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
            <a href="{{ route('datapengajuan')}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-share"></li> Back</a>
          @elseif($data->datapromoo->status_project=="draf")
            <a href="{{ route('drafpromo')}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-share"></li> Back</a>
          @elseif($data->datapromoo->status_project=="sent" || $data->datapromoo->status_project=="proses")
            <a href="{{ route('listpromo')}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-share"></li> Back</a>
          @endif
        @elseif(auth()->user()->role->namaRule == 'user_produk')
          <a href="{{ route('listprojectpromo')}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-share"></li> Back</a>
        @endif
      </div>

      <div class="x_panel">
        <div class="col-md-5">
          <div class="x_content">
            <table>
              <thead>
                <tr><td>Promo Number</td><td> : {{$data->datapromoo->promo_number}}{{$data->datapromoo->ket_no}}</td></tr>
                <tr><td>Brand</td><td> : {{$data->datapromoo->brand}}</td></tr>
                <tr><td>Type PKP</td><td> :
                @if($data->datapromoo->type==1) Maklon
                @elseif($data->datapromoo->type==2)Internal
                @elseif($data->datapromoo->type==3)Maklon/Internal
                @endif</td></tr>
                <tr><td>Created</td><td> : {{$data->datapromoo->created_date}}</td></tr>
                <tr><td>PV</td><td> : {{$data->perevisi2->name}}</td></tr>
              </thead>
            </table><br>
          </div>
        </div>
        <div class="col-md-5">
          <div class="x_content">
            <table>
              <thead>
                <tr><td>Last update</td><td> : {{$data->last_update}}</td></tr>
                <tr><td>Country</td><td> : {{$data->datapromoo->country}}</td></tr>
                <tr><td>Application</td><td> : {{$data->application}}</td></tr>
                <tr><td>Item Promo Readiness</td><td> : {{$data->promo_readiness}}</td></tr>
              </thead>
            </table><br>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>  
</div>
@endsection