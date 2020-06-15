@extends('manager.tempmanager')
@section('title', 'List promo')
@section('judulhalaman','List promo')
@section('content')

@if (session('status'))
<div class="row">
  <div class="col-md-12">
    <div class="alert alert-success" style="margin:20px">
      <button type="button" class="close" data-dismiss="alert">×</button>
      {{ session('status') }}
    </div>
  </div>
</div>  
@endif

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="row" style="margin:20px">
        <div id="exTab2" class="container">                   
					<div class="col-md-11" align="left">
            @foreach($promoo as $promo)
            
            <?php $last = Date('j-F-Y'); ?>
            @if(Auth::user()->departement->dept!='RKA')
              @if($promo->status_terima=='proses')
              <form class="form-horizontal form-label-left" method="POST" action="{{ route('approvepromo1',$promo->id_pkp_promo) }}" novalidate>
                <a class="btn btn-danger btn-sm" href="{{ route('daftarpromo',$promo->id_pkp_promo)}}"><i class="fa fa-share"></i>Back</a>
                <a class="btn btn-warning btn-sm" href="" onclick="return confirm('Print this data PROMO ?')"><i class="fa fa-download"></i> Download/print PROMO</a>
                <input type="hidden" value="{{$last}}" name="tgl">
                <button type="submit" class="btn btn-dark btn-sm"><li class="fa fa-check"></li> Approve data</button>
                {{ csrf_field() }}
              </form>
              @elseif($promo->status_terima!='proses')
              <a class="btn btn-danger btn-sm" href="{{ route('daftarpromo',$promo->id_pkp_promo)}}"><i class="fa fa-share"></i>Back</a>
              <a class="btn btn-warning btn-sm" href="" onclick="return confirm('Print this data PROMO ?')"><i class="fa fa-download"></i> Download/print PROMO</a>
              @endif
            @elseif(Auth::user()->departement->dept=='RKA')
              @if($promo->status_terima2=='proses')
              <form class="form-horizontal form-label-left" method="POST" action="{{ route('approvepromo2',$promo->id_pkp_promo) }}" novalidate>
                <a class="btn btn-danger btn-sm" href="{{ route('daftarpromo',$promo->id_pkp_promo)}}"><i class="fa fa-share"></i>Back</a>
                <a class="btn btn-warning btn-sm" href="" onclick="return confirm('Print this data PROMO ?')"><i class="fa fa-download"></i> Download/print PROMO</a>
                <input type="hidden" value="{{$last}}" name="tgl">
                <button type="submit" class="btn btn-dark btn-sm"><li class="fa fa-check"></li> Approve data</button>
                {{ csrf_field() }}
              </form>
              @endif
            @endif
            @if($promo->status_project=='sent' || $promo->status_project=='proses')
              @if(Auth::user()->departement->dept!='RKA')
                @if($promo->status_terima=='terima')
                  @if($hitung==0)
                  <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#kirim{{ $promo->id_pkp_promo  }}"><i class="fa fa-paper-plane"></i> Assign</a></button>
                  @endif
                  @endif
              <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#ajukan{{ $promo->id_pkp_promo  }}"><i class="fa fa-comments-o"></i> Sent Revision request</a></button>
                @elseif(Auth::user()->departement->dept=='RKA')
                @if($promo->status_terima2=='terima')
                  @if($hitung==0)
                  <a class="btn btn-danger btn-sm" href="{{ route('daftarpromo',$promo->id_pkp_promo)}}"><i class="fa fa-share"></i>Back</a>
                   <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#kirim{{ $promo->id_pkp_promo  }}"><i class="fa fa-paper-plane"></i> Assign</a></button>
                  @endif
                  <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#ajukan{{ $promo->id_pkp_promo  }}"><i class="fa fa-comments-o"></i> Sent Revision request</a></button>
                  
                @endif
              @endif
            @endif
          </div> 
          <div class="tab-content panel ">
            <div class="tab-pane active" id="1">
            @php $no = 0; @endphp 
              <div class="panel-default">	
							  <div class="panel-body badan">
								<label>PT. NUTRIFOOD INDONESIA</label>
								<center> <h2 style="font-size: 22px;font-weight: bold;">PENGEMBANGAN KONSEP AWAL PRODUK BARU</h2> </center>
  							<center> <h2 style="font-size: 20px;font-weight: bold;">( PKP Promo )</h2> </center><br>
								<center> <h2 style="font-weight: bold;"> {{ $promo->brand }} &reg;</h2> </center>
      					<center> <h2 style="font-weight: bold;">Project Name : {{ $promo->project_name }} </h2> </center>
								<table class=" table">
                  <tr>
                    <td width="25%"><b>Author</td>
                    <td colspan="2">: {{$promo->datapromoo->author1->name}}</td>
                  </tr>
                  <tr>
                    <td width="25%"><b>Created date</td>
                    <td colspan="2">: {{$promo->created_date}}</td>
                  </tr>
                  <tr>
                    <td width="25%"><b>Last update </td>
                    <td colspan="2">: {{$promo->last_update}}</td>
                  </tr>
                    <tr>
                      <td width="25%">Revised By</td>
                      <td colspan="2">: {{$promo->perevisi2->name}}</td>
                    </tr>
                  <tr>
                    <td width="25%"><b>Revision Number</td>
                    <td colspan="2">: {{$promo->revisi}}.{{$promo->turunan}}</td>
                  </tr>
                  <tr>
                    <td width="25%"><b>Country</td>
                    <td colspan="2">: {{$promo->country}}</td>
                  </tr>
                  <tr>
                    <td width="25%"><b>Item Promo type</td>
                    <td colspan="2">: {{$promo->promo_type}}</td>
                  </tr>
                  <tr>
                    <td width="25%"><b>Type</td>
                    <td colspan="2">:
                      @if($promo->type==1) Maklon
                      @elseif($promo->type==2) Internal
                      @elseif($promo->type==3) Maklon & Internal
                      @endif
                    </td>
                  </tr>
                    @endforeach
                  <tr>
                    <td width="25%"><b>Promo</td>
                    <td width="65%">
                      <table class="table table-striped table-bordered nowrap">
                        <thead>
                          <tr style="background-color:#13699a;color:white;">
                            <th class="text-center">Idea</th>
                            <th class="text-center">Dimension</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td><?php $promo_idea = []; foreach ($idea as $key => $data)If (!$promo_idea || !in_array($data->promo_idea, $promo_idea)) {$promo_idea += array($key => $data->promo_idea);
                              if($data->turunan!=$promo->turunan){ echo" <s><font color='#6594c5'>".$data->idea ."(".$data->turunan.")" ."<br></font></s>"; } if($data->turunan==$promo->turunan){ echo $data->promo_idea ."(".$data->turunan.")<br>"; } } ?></td>
                            <td><?php $dimension = []; foreach ($idea as $key => $data)If (!$dimension || !in_array($data->dimension, $dimension)) {$dimension += array($key => $data->dimension);
                              if($data->turunan!=$promo->turunan){ echo" <s><font color='#6594c5'>".$data->dimension ."(".$data->turunan.")<br></font></s>"; } if($data->turunan==$promo->turunan){ echo $data->dimension ."(".$data->turunan.")<br>"; } } ?></td>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                  </tr>
                  <tr>
                    <td width="25%"><b>Application</td>
                    <?php $application = []; foreach ($promo1 as $key => $data) If (!$application || !in_array($data->application, $application)) { $application += array( $key => $data->application );}  ?>
                    <td colspan="2">	@foreach($application as $application){{ $application }} <br>@endforeach</td>
                  </tr>
                  <tr class="table-highlight">
                    <?php $promo_readiness = []; foreach ($promo1 as $key => $data) If (!$promo_readiness || !in_array($data->promo_readiness, $promo_readiness)) { $promo_readiness += array( $key => $data->promo_readiness );}  ?>
                    <td width="25%"><b>Item Promo Readiness</td>
                    <td colspan="2">	@foreach($promo_readiness as $promo_readiness){{ $promo_readiness }} <br>@endforeach</td>
                  </tr>
                  <tr>
                    <td width="25%"><b>Related Picture</td>
                    <td colspan="2">@foreach($picture as $pic): {{$pic->filename}} <a href="{{asset('data_file/'.$pic->filename)}}" download="{{$pic->filename}}"><button class="btn btn-primary btn-sm"><li class="fa fa-download"></li></button></a><br>@endforeach</td>
                  </tr>
                </table>
                <label for="">Product And Allocation :</label>
                <table class="table table-striped table-bordered nowrap" id="table">
                    <thead>
                        <tr style="background-color:#13699a;color:white;">
                          <td>Product SKU Name</td>
                          <td>Allocation</td>
                          <td>Remarks</td>
                          <td>Start</td>
                          <td>End</td>
                          <td>RTO</td>
                          <td>Opsi</td>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><?php $product_sku = []; foreach ($app as $key => $data) If (!$product_sku || !in_array($data->product_sku, $product_sku)) { $product_sku += array( $key => $data->product_sku );
                          if($data->turunan!=$promo->turunan){ echo"<s><font color='#6594c5'>".$data->sku->nama_sku."<br></font></s>"; } if($data->turunan==$promo->turunan){ echo"".$data->sku->nama_sku."<br>"; } } ?></td>
                          <td><?php $allocation = []; foreach ($app as $key => $data) If (!$allocation || !in_array($data->allocation, $allocation)) { $allocation += array( $key => $data->allocation );
                          if($data->turunan!=$promo->turunan){ echo"<s><font color='#6594c5'>$data->allocation<br></font></s>"; } if($data->turunan==$promo->turunan){ echo"$data->allocation<br>"; } } ?></td>
                          <td><?php $remarks = []; foreach ($app as $key => $data) If (!$remarks || !in_array($data->remarks, $remarks)) { $remarks += array( $key => $data->remarks );
                          if($data->turunan!=$promo->turunan){ echo"<s><font color='#6594c5'>$data->remarks<br></font></s>"; } if($data->turunan==$promo->turunan){ echo"$data->remarks<br>"; } } ?></td>
                          <td><?php $start = []; foreach ($app as $key => $data) If (!$start || !in_array($data->start, $start)) { $start += array( $key => $data->start );
                          if($data->turunan!=$promo->turunan){ echo"<s><font color='#6594c5'>$data->start<br></font></s>"; } if($data->turunan==$promo->turunan){ echo"$data->start<br>"; } } ?></td>
                          <td><?php $end = []; foreach ($app as $key => $data) If (!$end || !in_array($data->end, $end)) { $end += array( $key => $data->end );
                          if($data->turunan!=$promo->turunan){ echo"<s><font color='#6594c5'>$data->end<br></font></s>"; } if($data->turunan==$promo->turunan){ echo"$data->end<br>"; } } ?></td>
                          <td><?php $rto = []; foreach ($app as $key => $data) If (!$rto || !in_array($data->rto, $rto)) { $rto += array( $key => $data->rto );
                           if($data->turunan!=$promo->turunan){ echo"<s><font color='#6594c5'>$data->rto<br></font></s>"; } if($data->turunan==$promo->turunan){ echo"$data->rto<br>"; } } ?></td>
                          <td><?php $opsi = []; foreach ($app as $key => $data) If (!$opsi || !in_array($data->opsi, $opsi)) { $opsi += array( $key => $data->opsi );
                            if($data->turunan!=$promo->turunan){ echo"<s><font color='#6594c5'>$data->opsi<br></font></s>"; } if($data->turunan==$promo->turunan){ echo"$data->opsi<br>"; } } ?></td>
                        </tr>
                      </tbody>
                </table>
        				<table ALIGN="right">
        					<tr><td>Revisi/Berlaku :  </td></tr>
        					<tr><td>Masa Berlaku : Selamanya</td></tr>
        				</table>
								</div>
							</div>
            </div>
        	</div>
				</div>
				</div>
    	</div>
    </div>    
	</div>
</div>

<!-- modal -->
<div class="modal" id="kirim{{ $promo->id_pkp_promo  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">                 
        <h3 class="modal-title" id="exampleModalLabel">Sent Data
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button></h3>
      </div>
      <div class="modal-body">
        <form class="form-horizontal form-label-left" method="POST" action="{{Route('edituser',$promo->id_pkp_promo)}}" novalidate>
        <div class="form-group row">
          <label class="control-label text-bold col-md-2 col-sm-3 col-xs-12 text-center"> User</label>
          @if(Auth::user()->departement->dept!="RKA")
          @if($promo->userpenerima2!='NULL')
          <input type="hidden" value="{{$promo->userpenerima2}}" name="user2">
          @endif
          <div class="col-md-9 col-sm-9 col-xs-12">
            <select name="user" class="form-control form-control-line" id="user">
            <option disabled selected>--> select One <--</option>
            @foreach($user as $user)
              @if($user->id!=Auth::user()->id)
              <option value="{{$user->id}}">{{ $user->name }}</option>
              @endif
              @endforeach
            </select>
          </div>
          @elseif(Auth::user()->departement->dept=="RKA")
          @if($promo->userpenerima!='NULL')
          <input type="hidden" value="{{$promo->userpenerima}}" name="user">
          @endif
          <div class="col-md-9 col-sm-9 col-xs-12">
            <select name="user2" class="form-control form-control-line" id="user2">
            <option disabled selected>--> select One <--</option>
            @foreach($user as $user)
            @if($user->id!=Auth::user()->id)
            <option value="{{$user->id}}">{{ $user->name }}</option>
            @endif
              @endforeach
            </select>
          </div>
          @endif
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Sent</button>
          {{ csrf_field() }}
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal Selesai -->

<!-- Modal -->
<div class="modal" id="ajukan{{ $promo->id_pkp_promo  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">                 
        <h3 class="modal-title" id="exampleModalLabel">Sent Revision request
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button></h3>
      </div>
      <div class="modal-body">
        <form class="form-horizontal form-label-left" method="POST" action="{{ Route('pengajuanpromo')}}" novalidate>
        <div class="form-group row">
        <input type="hidden" value="{{$promo->id_pkp_promo}}" name="promo">
        <input type="hidden" value="{{$promo->turunan}}" name="turunan">
          <label class="control-label text-bold col-md-2 col-sm-3 col-xs-12 text-center">Destination</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <select name="penerima" class="form-control form-control-line" id="penerima">
            <option disabled selected>--> Select One <--</option>
            <option value="14">PV</option>
            <option value="1">Marketing</option>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label class="control-label text-bold col-md-2 col-sm-3 col-xs-12 text-center">Note</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <textarea name="catatan" id="catatan" class="col-md-12 col-sm-12 col-xs-12"></textarea>
          </div>
        </div>
        <div class="form-group row">
          <label class="control-label text-bold col-md-2 col-sm-3 col-xs-12 text-center">Request Priority</label>
          <div class="col-md-3 col-sm-3 col-xs-12">
            <select name="prioritas" id="prioritas" class="form-control form-control-line">
              <option value="1">High Priority</option>
              <option value="2">Standar Priority</option>
              <option value="3">Low Priority</option>
            </select>
          </div>
          <div class="col-md-6 col-sm-3 col-xs-12">
          <label class="control-label text-bold col-md-2 col-sm-3 col-xs-12 text-center">time</label>
          <div class="col-md-3 col-sm-3 col-xs-12">
            <input type="number" class="form-control form-control-line col-md-12 col-sm-12 col-xs-12" name="jangka" id="jangka">
          </div>
          <div class="col-md-6 col-sm-3 col-xs-12">
            <select name="waktu" id="waktu" class="form-control form-control-line col-md-12 col-sm-12 col-xs-12">
              <option value="Month">Month</option>
              <option value="Week">Week</option>
              <option value="Day">Day</option>
            </select>
          </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Sent</button>
          {{ csrf_field() }}
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal Selesai -->
@endsection