@extends('layout.tempvv')
@section('title', 'PRODEV|Daftar PROMO')
@section('content')

<div class="row">
  <div class="col-md-12 col-xs-12">
    <div class="x_panel">
      <div class="col-md-5">
        <h3><li class="fa fa-star"></li> Project Name : {{ $pkp->project_name}}</h3>
      </div>
      <div class="col-md-7" align="right">
        @if($promo==0)
          <a href="{{ route('datapromo',$pkp->id_pkp_promo)}}" class="btn btn-primary btn-sm" type="button"><li class="fa fa-plus"></li> Add Data</a>
        @else
          <a class="btn btn-info btn-sm" href="{{ Route('lihatpromo',['id_pkp_promo' => $data->id_pkp_promoo, 'revisi' => $data->revisi, 'turunan' => $data->turunan]) }}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i> Show</a>
          @if($data->status_promo=='draf' || $data->status_promo=='revisi')
          <a class="btn btn-warning btn-sm" href="{{ route('datapromo11', ['id_pkp_promo' => $data->id_pkp_promoo, 'revisi' => $data->revisi, 'turunan' => $data->turunan]) }}" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i> Edit</a>
          @endif
        @endif
        @if(auth()->user()->role->namaRule == 'pv_lokal')
          @if($pkp->status_project=="revisi")
            <button class="btn btn-primary btn-sm" title="note" data-toggle="modal" data-target="#data{{ $pkp->id_pkp_promo  }}"><i class="fa fa-edit"></i> Edit Timeline</a></button>
            <!-- Modal -->
            <div class="modal" id="data{{ $pkp->id_pkp_promo  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Timeline Project : {{$pkp->project_name}}
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></h3>
                  </div>
                  <div class="modal-body">
                    <div class="row x_panel">
                      <form class="form-horizontal form-label-left" method="POST" action="{{ Route('TMubah',$pkp->id_pkp_promo)}}" novalidate>
                      <label class="control-label col-md-3 col-sm-3 col-xs-12 text-center">Deadline for sending Sample</label>
                      <div class="col-md-4 col-sm-9 col-xs-12">
                        <input type="date" class="form-control" value="{{$pkp->jangka}}" name="jangka" id="jangka" placeholder="start date">
                      </div>
                      <div class="col-md-4 col-sm-9 col-xs-12">
                        <input type="date" class="form-control" value="{{$pkp->waktu}}" name="waktu" id="waktu" placeholder="end date">
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
          @elseif($pkp->status_project=="draf")
            <a href="{{ route('drafpromo')}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-share"></li> Back</a>
          @elseif($pkp->status_project=="sent" || $pkp->status_project=="proses")
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
                <tr><td>Promo Number</td><td> : {{$pkp->promo_number}}{{$pkp->ket_no}}</td></tr>
                <tr><td>Brand</td><td> : {{$pkp->brand}}</td></tr>
                <tr><td>Type PKP</td><td> :
                @if($pkp->type==1) Maklon
                @elseif($pkp->type==2)Internal
                @elseif($pkp->type==3)Maklon/Internal
                @endif</td></tr>
                <tr><td>Created</td><td> : {{$pkp->created_date}}</td></tr>
                <tr><td>PV</td><td> : @if($promo!=0){{$pkp->datapromo->perevisi2->name}}@endif</td></tr>
              </thead>
            </table><br>
          </div>
        </div>
        <div class="col-md-5">
          <div class="x_content">
            <table>
              <thead>
                <tr><td>Last update</td><td> : @if($promo!=0){{$data->last_update}}@endif</td></tr>
                <tr><td>Country</td><td> : {{$pkp->country}}</td></tr>
                <tr><td>Application</td><td> : @if($promo!=0){{$data->application}}@endif</td></tr>
                <tr><td>Item Promo Readiness</td><td> : @if($promo!=0){{$data->promo_readiness}}@endif</td></tr>
              </thead>
            </table><br>
          </div>
        </div>
      </div>
    </div>
  </div>  
</div>
@endsection