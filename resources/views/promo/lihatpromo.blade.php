@extends('pv.tempvv')
@section('title', 'Data promo')
@section('judulhalaman','Draf promo')
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
          <ul class="nav nav-tabs">
					<div class="col-md-11" align="left">
          @foreach($promoo as $promo)
          @if($promo->status_promo=="draf")
          <a class="btn btn-danger" href="{{ route('rekappromo',$promo->id_pkp_promo)}}"><i class="fa fa-share"></i>Back</a>
            @if(auth()->user()->role->namaRule === 'pv_lokal')
            @if($promo->datapromoo->approval=='approve')
            <button class="btn btn-primary" data-toggle="modal" data-target="#NW{{ $promo->id_pkp_promo  }}{{$promo->turunan}}"><i class="fa fa-paper-plane"></i> Sent To RND</a></button>
            @endif
            <!-- modal -->
            <div class="modal" id="NW{{ $promo->id_pkp_promo  }}{{$promo->turunan}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h3 class="modal-title text-left" id="exampleModalLabel">Sent Data
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></h3>
                  </div>
                  <div class="modal-body">
                  <form class="form-horizontal form-label-left" method="POST" action="{{Route('editpromo',['id_pkp_promo' => $promo->id_pkp_promo, 'revisi' => $promo->revisi, 'turunan' => $promo->turunan])}}" novalidate>
                    <div class="form-group row">
                      <label class="control-label text-bold col-md-2 col-sm-3 col-xs-12 text-center"> Departement</label>
                      <div class="col-md-5 col-sm-9 col-xs-12">
                        <select name="kirim" class="form-control form-control-line" id="kirim">
                          <option disabled selected> Departement</option>
                          @foreach($dept as $dept)
                          @if($dept->Divisi=='RND')
                          <option value="{{$dept->id}}">{{ $dept->dept }} ({{ $dept->nama_dept }})</option>
                          @endif
                          @endforeach
                        </select>
                      </div>
                      <div class="col-md-4 col-sm-9 col-xs-12">
                        <select name="rka" class="form-control form-control-line" id="rka">
                          <option Value="1">RKA</option>
                           <option value="0">Tidak Ada</option>
                        </select>
                      </div>
                    </div>
                    @foreach($picture as $pic)
                      <input type="text" value="{{$pic->lokasi}}" name="pic[]" id="pic">
                    @endforeach
                    <input type="hidden" value="{{$nopromo}}" name="nopromo" id="nopromo">
                    <?php
                      $tanggal = Date("Y");
                    ?>
                    @if($promo->type=='Maklon')
                    <input type="hidden" value="_{{$tanggal}}/PROMO-M_{{ $promo->project_name }}_{{ $promo->revisi }}.{{ $promo->turunan }}" name="ket_no" id="ket_no">
                    @elseif($promo->type!='Maklon')
                    <input type="hidden" value="_{{$tanggal}}/PROMO_{{ $promo->project_name }}_{{ $promo->revisi }}.{{ $promo->turunan }}" name="ket_no" id="ket_no">
                    @endif
                    <div class="form-group row">
                      <label class="control-label text-bold col-md-2 col-sm-3 col-xs-12 text-center">Project priority</label>
                      <div class="col-md-2 col-sm-9 col-xs-12">
                        <select name="prioritas" class="form-control form-control-line" id="prioritas">
                          <option disabled selected>Prioritas</option>
                          <option value="1">prioritas 1</option>
                          <option value="2">prioritas 2</option>
                          <option value="3">prioritas 3</option>
                        </select>
                      </div>
                      <label class="control-label text-bold col-md-2 col-sm-3 col-xs-12 text-center">Deadline for sending Sample</label>
                      <div class="col-md-2 col-sm-9 col-xs-12">
                        <input type="date" class="form-control" name="jangka" id="jangka" placeholder="start date">
                      </div>
                      <div class="col-md-1 col-sm-9 col-xs-12"><center> To </center></div>
                      <div class="col-md-2 col-sm-9 col-xs-12">
                        <input type="date" class="form-control" name="waktu" id="waktu" placeholder="end date">
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
            @if($promo->datapromoo->approval!='approve')
            <button class="btn btn-info" data-toggle="modal" data-target="#approve{{$promo->id_pkp_promoo}}{{$promo->turunan}}"><i class="fa fa-paper-plane"></i> Request approval</a></button>
            @endif
            <!-- modal -->
            <div class="modal" id="approve{{$promo->id_pkp_promoo}}{{$promo->turunan}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h3 class="modal-title text-left" id="exampleModalLabel">Request Approval
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></h3>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form class="form-horizontal form-label-left" method="POST" action="{{ url('emailpromo',['id_pkp_promo' => $promo->id_pkp_promo, 'revisi' => $promo->revisi, 'turunan' => $promo->turunan]) }}" novalidate>
                    <div class="form-group row">
                      <label class="control-label text-bold col-md-1 col-sm-3 col-xs-12 text-center">Email</label>
                      <label class="control-label text-bold col-md-1 col-sm-3 col-xs-12 text-center">To</label>
                      <div class="col-md-9 col-sm-10 col-xs-12">
                        <input id="email" class="form-control " type="email" name="email" required>
                        <input type="hidden" value="Pengajuan Promo-{{$promo->datapromoo->project_name}}" name="judul" id="judul">
                        @foreach($picture as $pic)
                        <input type="text" value="{{$pic->lokasi}}" name="pic[]" id="pic">
                        @endforeach
                        <label style="color:red;">* Only allowed one E-mail</label>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="control-label text-bold col-md-1 col-sm-3 col-xs-12 text-center"></label>
                      <label class="control-label text-bold col-md-1 col-sm-3 col-xs-12 text-center">Cc</label>
                      <div class="col-md-3 col-sm-10 col-xs-12">
                        <input type="text" class="form-control" readonly value="{{auth()->user()->email}}" name="pengirim" id="pengirim">
                      </div>
                      <div class="col-md-3 col-sm-10 col-xs-12">
                        <input type="text" class="form-control" readonly value="{{$promo->datapromoo->author1->email}}" name="pengirim1" id="pengirim1">
                      </div>
                      <div class="col-md-3 col-sm-10 col-xs-12">
                        @if($promo->perevisi!=null)
                          <input type="text" class="form-control" readonly value="{{$promo->perevisi2->email}}" name="pengirim2" id="pengirim2">
                        @endif
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
            @endif
          @elseif($promo->status_promo=="revisi")
            @if(auth()->user()->role->namaRule === 'pv_lokal')
            @if($promo->datapromoo->approval=='approve')
            <button class="btn btn-primary" data-toggle="modal" data-target="#revisi{{ $promo->id_pkp_promo  }}{{$promo->turunan}}"><i class="fa fa-paper-plane"></i> Sent To RND</a></button>
            @endif<!-- modal -->
            <div class="modal" id="revisi{{ $promo->id_pkp_promo  }}{{$promo->turunan}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h3 class="modal-title text-left" id="exampleModalLabel">Sent Data
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button></h3>
                  </div>
                  <div class="modal-body">
                    <form class="form-horizontal form-label-left" method="POST" action="{{Route('sentpromo',['id_pkp_promo' => $promo->id_pkp_promo, 'revisi' => $promo->revisi, 'turunan' => $promo->turunan])}}" novalidate>
                    <div class="form-group row">
                      <label class="control-label text-bold col-md-2 col-sm-3 col-xs-12 text-center">Dept 1</label>
                      <div class="col-md-4 col-sm-9 col-xs-12">
                        <select name="kirim" class="form-control form-control-line" id="kirim">
                          <option value="{{$promo->tujuankirim}}">{{$promo->departement->dept}}</option>
                          @foreach($dept1 as $dept)
                          @if($dept->Divisi=='RND')
                          <option value="{{$dept->id}}">{{ $dept->dept }} ({{ $dept->nama_dept }})</option>
                          @endif
                          @endforeach
                        </select>
                      </div>
                      <label class="control-label text-bold col-md-1 col-sm-3 col-xs-12 text-center">Dept 2</label>
                      <div class="col-md-4 col-sm-9 col-xs-12">
                        <select name="rka" class="form-control form-control-line" id="rka">
                          <option Value="0">-->Select One<--</option>
                          <option Value="1">RKA</option>
                          <option value="0">Tidak Ada</option>
                        </select>
                      </div>
                    </div>
                    <input type="hidden" value="{{$promo->promo_number}}" name="nopromo" id="nopromo">
                    <?php $tanggal = Date("Y"); ?>
                    @if($promo->type=='Maklon')
                    <input type="hidden" value="_{{$tanggal}}/PROMO-M_{{ $promo->project_name }}_{{ $promo->revisi }}.{{ $promo->turunan }}" name="ket_no" id="ket_no">
                    @elseif($promo->type!='Maklon')
                    <input type="hidden" value="_{{$tanggal}}/PROMO_{{ $promo->project_name }}_{{ $promo->revisi }}.{{ $promo->turunan }}" name="ket_no" id="ket_no">
                    @endif
                    <div class="form-group row">
                      <label class="control-label text-bold col-md-2 col-sm-3 col-xs-12 text-center">Project Priority</label>
                      <div class="col-md-2 col-sm-9 col-xs-12">
                        <select name="prioritas" class="form-control form-control-line" id="prioritas">
                          <option value="{{$promo->prioritas}}" readonly>
                          @if($promo->prioritas==1) prioritas 1
                          @elseif($promo->prioritas==2) prioritas 2
                          @elseif($promo->prioritas==3) prioritas 3
                          @endif</option>
                          <option value="1">prioritas 1</option>
                          <option value="2">prioritas 2</option>
                          <option value="3">prioritas 3</option>
                        </select>
                      </div>
                      <label class="control-label text-bold col-md-2 col-sm-3 col-xs-12 text-center">Deadline for sending Sample</label>
                      <div class="col-md-2 col-sm-9 col-xs-12">
                        <input type="date" class="form-control" value="{{$promo->jangka}}" name="jangka" id="jangka" placeholder="start date">
                      </div>
                      <div class="col-md-1 col-sm-9 col-xs-12"><center> To </center></div>
                      <div class="col-md-2 col-sm-9 col-xs-12">
                        <input type="date" class="form-control" value="{{$promo->waktu}}" name="waktu" id="waktu" placeholder="end date">
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
            @endif
          @elseif($promo->datapromoo->status_project=='revisi')
            @if(auth()->user()->role->namaRule === 'pv_lokal' || auth()->user()->role->namaRule === 'marketing')
              @if($pengajuanpromo!=0)
          	   <a class="btn btn-info" onclick="return confirm('Naik Versi PKP Promo ?')" href="{{Route('naikversipromo',['id_pkp_promo' => $promo->id_pkp_promo, 'revisi' => $promo->revisi, 'turunan' => $promo->turunan])}}"><i class="fa fa-arrow-up"></i> Naik Versi</a>
              @endif
            @endif
          @endif
          <a class="btn btn-warning" href="{{route('downloadpromo',['id_pkp_promo' => $promo->id_pkp_promo, 'revisi' => $promo->revisi, 'turunan' => $promo->turunan])}}" onclick="return confirm('Print this data PROMO ?')"><i class="fa fa-download"></i> Download/print PROMO</a>
          <br><br>
				  </div>
         </ul>
          <div class="tab-content panel ">
            <div class="tab-pane active" id="1">
              @php
                $no = 0;
              @endphp
              <div class="panel-default">
							  <div class="panel-body badan">
								  <label>PT. NUTRIFOOD INDONESIA</label>
								  <center> <h2 style="font-size: 22px;font-weight: bold;">PENGEMBANGAN KONSEP AWAL PRODUK BARU</h2> </center>
  							  <center> <h2 style="font-size: 20px;font-weight: bold;">( PKP Promo )</h2> </center>
								  <br>
								  <center> <h2 style="font-weight: bold;"> {{ $promo->brand }} &reg;</h2> </center>
      					  <center> <h2 style="font-weight: bold;">Project Name : {{ $promo->project_name }} </h2> </center>
                  @if($promo->status_project=='draf')
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
                      <td colspan="2">:@if($promo->perevisi!=null) {{$promo->perevisi2->name}} @endif</td>
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
                      <td colspan="2"> :
                      @if($promo->type==1) Maklon
                      @elseif($promo->type==2) Internal
                      @elseif($promo->type==3) Maklon & Internal
                      @endif
                      </td>
                    </tr>
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
                      <td colspan="2"><?php $application = []; foreach ($promo1 as $key => $data) If (!$application || !in_array($data->application, $application)) { $application += array( $key => $data->application );
                      if($data->turunan!=$promo->turunan){ echo": <s><font color='#6594c5'>$data->application<br></font></s>"; } if($data->turunan==$promo->turunan){ echo": $data->application<br>"; } } ?></td>
                    </tr>
                    <tr class="table-highlight">
                      <td width="25%"><b>Item Promo Readiness</td>
                      <td colspan="2"><?php $promo_readiness = []; foreach ($promo1 as $key => $data) If (!$promo_readiness || !in_array($data->promo_readiness, $promo_readiness)) { $promo_readiness += array( $key => $data->promo_readiness );
                      if($data->turunan!=$promo->turunan){ echo": <s><font color='#6594c5'>$data->promo_readiness<br></font></s>"; } if($data->turunan==$promo->turunan){ echo": $data->promo_readiness<br>"; } } ?></td>
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
                  @elseif($promo->status_project!='draf')
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
                      <td colspan="2">: @if($promo->perevisi!=null) {{$promo->perevisi2->name}} @endif</td>
                    </tr>
                    <tr>
                      <td width="25%"><b>Revisi No</td>
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
                    <tr>
                      <td width="25%"><b>Promo Idea</td>
                      <td colspan="2"><?php $promo_idea = []; foreach ($promo2 as $key => $data)If (!$promo_idea || !in_array($data->promo_idea, $promo_idea)) {$promo_idea += array($key => $data->promo_idea);
                      if($data->revisi!=$promo->revisi){ echo": <s><font color='#ffa2a2'>$data->promo_idea<br></font></s>"; } if($data->revisi==$promo->revisi){ echo": $data->promo_idea<br>"; } } ?></td>
                    </tr>
                    <tr>
                      <td width="25%"><b>Dimension</td>
                      <td colspan="2"><?php $dimension = []; foreach ($promo2 as $key => $data) If (!$dimension || !in_array($data->dimension, $dimension)) { $dimension += array( $key => $data->dimension );
                      if($data->revisi!=$promo->revisi){ echo": <s><font color='#ffa2a2'>$data->dimension<br></font></s>"; } if($data->revisi==$promo->revisi){ echo": $data->dimension<br>"; } } ?></td>
                    </tr>
                    <tr>
                      <td width="25%"><b>Application</td>
                      <td colspan="2"><?php $application = []; foreach ($promo2 as $key => $data) If (!$application || !in_array($data->application, $application)) { $application += array( $key => $data->application );
                      if($data->revisi!=$promo->revisi){ echo": <s><font color='#ffa2a2'>$data->application <br></font></s>"; } if($data->revisi==$promo->revisi){ echo": $data->application<br>"; } } ?></td>
                    </tr>
                    <tr class="table-highlight">
                      <td width="25%"><b>Item Promo Readiness</td>
                      <td colspan="2"><?php $promo_readiness = []; foreach ($promo2 as $key => $data) If (!$promo_readiness || !in_array($data->promo_readiness, $promo_readiness)) { $promo_readiness += array( $key => $data->promo_readiness );
                      if($data->revisi!=$promo->revisi){ echo": <s><font color='#ffa2a2'>$data->promo_readiness<br></font></s>"; } if($data->revisi==$promo->revisi){ echo": $data->promo_readiness<br>"; } } ?></td>
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
                        <td>Allocation (pcs)</td>
                        <td>Remarks</td>
                        <td>Start</td>
                        <td>End</td>
                        <td>RTO</td>
                        <td>Opsi</td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><?php $product_sku = []; foreach ($app2 as $key => $data) If (!$product_sku || !in_array($data->product_sku, $product_sku)) { $product_sku += array( $key => $data->product_sku );
                        if($data->revisi!=$promo->revisi){ echo"<s><font color='#ffa2a2'>".$data->sku->nama_sku."<br></font></s>"; } if($data->revisi==$promo->revisi){ echo"".$data->sku->nama_sku."<br>"; } } ?></td>
                        <td><?php $allocation = []; foreach ($app2 as $key => $data) If (!$allocation || !in_array($data->allocation, $allocation)) { $allocation += array( $key => $data->allocation );
                        if($data->revisi!=$promo->revisi){ echo"<s><font color='#ffa2a2'>$data->allocation<br></font></s>"; } if($data->revisi==$promo->revisi){ echo"$data->allocation<br>"; } } ?></td>
                        <td><?php $remarks = []; foreach ($app2 as $key => $data) If (!$remarks || !in_array($data->remarks, $remarks)) { $remarks += array( $key => $data->remarks );
                        if($data->revisi!=$promo->revisi){ echo"<s><font color='#ffa2a2'>$data->remarks<br></font></s>"; } if($data->revisi==$promo->revisi){ echo"$data->remarks<br>"; } } ?></td>
                        <td><?php $start = []; foreach ($app2 as $key => $data) If (!$start || !in_array($data->start, $start)) { $start += array( $key => $data->start );
                        if($data->revisi!=$promo->revisi){ echo"<s><font color='#ffa2a2'>$data->start<br></font></s>"; } if($data->revisi==$promo->revisi){ echo"$data->start<br>"; } } ?></td>
                        <td><?php $end = []; foreach ($app2 as $key => $data) If (!$end || !in_array($data->end, $end)) { $end += array( $key => $data->end );
                        if($data->revisi!=$promo->revisi){ echo"<s><font color='#ffa2a2'>$data->end<br></font></s>"; } if($data->revisi==$promo->revisi){ echo"$data->end<br>"; } } ?></td>
                        <td><?php $rto = []; foreach ($app2 as $key => $data) If (!$rto || !in_array($data->rto, $rto)) { $rto += array( $key => $data->rto );
                         if($data->revisi!=$promo->revisi){ echo"<s><font color='#ffa2a2'>$data->rto<br></font></s>"; } if($data->revisi==$promo->revisi){ echo"$data->rto<br>"; } } ?></td>
                        <td><?php $opsi = []; foreach ($app2 as $key => $data) If (!$opsi || !in_array($data->opsi, $opsi)) { $opsi += array( $key => $data->opsi );
                          if($data->revisi!=$promo->revisi){ echo"<s><font color='#ffa2a2'>$data->opsi<br></font></s>"; } if($data->revisi==$promo->revisi){ echo"$data->opsi<br>"; } } ?></td>
                      </tr>
                    </tbody>
                  </table>
                  @endif
                  @endforeach
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

@endsection
