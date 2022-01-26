@extends('layout.tempmanager')
@section('title', 'PRODEV|Daftar PKP')
@section('content')

<div class="row">
  <div class="col-md-12 col-xs-12">
		@foreach($data as $data)
    <div class="x_panel">
      <div class="col-md-5">
        <h3><li class="fa fa-star"></li> Project Name : {{ $data->project_name}}</h3>
      </div>
      <div class="col-md-7" align="right">
        <button class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#alihkan"><li class="fa fa-paper-plane"></li> Divert Project</button>
        @foreach($pkp as $pkp1)
        <a class="btn btn-info btn-sm" href="{{ Route('promolihat',['id_pkp_promo' => $pkp1->id_pkp_promoo, 'revisi' => $pkp1->revisi, 'turunan' => $pkp1->turunan]) }}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i> Show</a>
        @endforeach
        <a href="{{ route('listpromoo')}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-share"></li> Back</a>
      </div>
      <div class="x_panel">
        <div class="col-md-5">
          <div class="x_content">
            <table>
              <thead>
                <tr><td>Brand</td><td> : {{$data->brand}}</td></tr>
                <tr><td>Type PKP</td><td> : 
                @if($data->type==1) Maklon
                @elseif($data->type==2) Internal
                @elseif($data->type==3) Maklon/Internal
                @endif</td></tr>
                <tr><td width="20%">Promo Number</td><td> : {{$data->promo_number}}{{$data->ket_no}}</td></tr>
                <tr><td width="20%">Created</td><td> : {{$data->created_date}}</td></tr>
                <tr><td width="20%">Author</td><td> : {{$data->author1->name}}</td></tr>
              </thead>
            </table><br>
          </div>
        </div>
        
        <div class="col-md-7">
          <div class="x_content">
            <table>
              <thead>
                <tr><td width="15%">Last update</td><td> : {{$data->datapromo->last_update}}</td></tr>
                <tr><td width="15%">Country</td><td> : {{$data->country}}</td></tr>
                <tr><td width="15%">Application</td><td> : {{$data->datapromo->application}}</td></tr>
                <tr><td width="15%">Promo Readiness</td><td> : {{$data->datapromo->promo_readiness}}</td></tr>
              </thead>
            </table><br>
          </div>
        </div>
        @endforeach
      </div>
    </div>       
  </div>
</div>  

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
      <form class="form-horizontal form-label-left" method="POST" action="{{ route('alihkanpromo',$data->id_pkp_promo) }}" novalidate>
        <div class="form-group row">
          <label class="control-label text-bold col-md-1 col-sm-3 col-xs-12 text-center">Dept1</label>
          <div class="col-md-11 col-sm-9 col-xs-12">
            <select name="tujuankirim" class="form-control form-control-line" id="type">
              <option disabled selected>{{$data->departement->dept}} ({{$data->departement->nama_dept}})</option>
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
              @if($data->tujuankirim2==0)
              <option value="0" selected>No Departement Selected</option>
              @elseif($data->tujuanlirim2==1)
              <option selected>{{$data->departement2->dept}} ({{$data->departement2->nama_dept}})</option>
              @endif
              <option value="1">RKA</option>
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
@endsection