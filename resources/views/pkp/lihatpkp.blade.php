@extends('pv.tempvv')
@section('title', 'PRODEV|data PKP')
@section('content')

@if (session('status'))
<div class="col-lg-12 col-md-12 col-sm-12">
  <div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{ session('status') }}
  </div>
</div>
@endif

<div class="row" >
  <div class="col-md-12 col-sm-12 col-xs-12" >
    <div class="x_panel" >
      <div class="row"  style="margin:20px">
        <div id="exTab2" class="container">
          @foreach($pkpp as $pkp)
					<div class="col-md-11" align="left">
            <a class="btn btn-danger btn-sm" href="{{ route('rekappkp',$pkp->id_project)}}"><i class="fa fa-share"></i> Back</a>
            @if($pkp->status_pkp=="draf")
              @if(auth()->user()->role->namaRule === 'pv_lokal')
                @if($pkp->datapkpp->approval=='approve')
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#NW{{$pkp->id_pkp}}{{$pkp->revisi}}{{$pkp->turunan}}"><i class="fa fa-paper-plane"></i> Sent To RND</a></button>
                @endif  
                <!-- modal -->
                <div class="modal" id="NW{{$pkp->id_pkp}}{{$pkp->revisi}}{{$pkp->turunan}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h3 class="modal-title text-left" id="exampleModalLabel">Sent Data<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></h3></button>
                      </div>
                      <div class="modal-body">
                        <form class="form-horizontal form-label-left" method="POST" action="{{ Route('editt',$pkp->id_pkp)}}">
                        <div class="form-group row">
                          <label class="control-label text-bold col-md-2 col-sm-2 col-xs-12 text-center">Dept Produk</label>
                          <div class="col-md-4 col-sm-9 col-xs-12">
                            <select name="kirim" class="form-control form-control-line" id="kirim">
                              <option disabled selected>Departement</option>
                              @foreach($dept as $dept)
                              @if($dept->Divisi=='RND')
                                <option value="{{$dept->id}}"> Manager {{ $dept->dept }} ({{$dept->users->name}})</option>
                              @endif
                              @endforeach
                            </select>
                            <?php $last = Date('j-F-Y'); ?>
                            <input id="date" value="{{ $last }}" class="form-control col-md-12 col-xs-12" name="date" required="required" type="hidden" readonly>
                          </div>
                          <input type="hidden" value="{{$pkp->project_name}}" name="name" id="name">
                          <label class="control-label text-bold col-md-2 col-sm-2 col-xs-12 text-center">Dept Kemas</label>
                          <div class="col-md-4 col-sm-9 col-xs-12">
                            <select name="rka" class="form-control form-control-line" id="rka">
                              <option value="1">RKA</option>
                              <option value="0">No Departement Selected</option>
                            </select>
                          </div>
                        </div>
                        @foreach($picture as $pic)<input type="hidden" value="{{$pic->lokasi}}" name="pic[]" id="pic">@endforeach
                        <input type="hidden" value="{{$nopkp}}" name="nopkp" id="nopkp">
                        <?php $tanggal = Date("Y"); ?>
                          @if($pkp->type=='Maklon')
                          <input type="hidden" value="_{{$tanggal}}/PKP{{$pkp->jenis}}-M_{{ $pkp->project_name }}_{{ $pkp->revisi }}.{{ $pkp->turunan }}" name="ket_no" id="ket_no">
                          @elseif($pkp->type!='Maklon')
                          <input type="hidden" value="_{{$tanggal}}/PKP{{$pkp->jenis}}_{{ $pkp->project_name }} _{{ $pkp->revisi }}.{{ $pkp->turunan }}" name="ket_no" id="ket_no">
                          @endif
                        <div class="form-group row">
                          <label class="control-label text-bold col-md-2 col-sm-2 col-xs-12 text-center">Priority</label>
                          <div class="col-md-1 col-sm-1 col-xs-12">
                            <select name="prioritas" class="form-control form-control-line" id="prioritas" required>
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                            </select>
                          </div>
                          <?php $tgl2 = date('Y-m-d', strtotime('+30 days')); ?>
                          <label class="control-label text-bold col-md-2 col-sm-2 col-xs-12 text-center">sample deadline</label>
                          <div class="col-md-3 col-sm-3 col-xs-12"><input type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" name="jangka" id="jangka" placeholder="start date"></div>
                          <div class="col-md-1 col-sm-1 col-xs-12"><center> To </center></div>
                          <div class="col-md-3 col-sm-3 col-xs-12"><input type="date" class="form-control" value="{{$tgl2}}" name="waktu" id="waktu" placeholder="end date"></div>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-paper-plane"></i> Sent</button>
                          {{ csrf_field() }}
                        </div>
                      </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Modal Selesai -->
                @if($pkp->datapkpp->approval!='approve')
                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#approve{{$pkp->id_pkp}}{{$pkp->turunan}}"><i class="fa fa-paper-plane"></i> Request Approval</a></button>
                @endif
                <!-- modal -->
                <div class="modal" id="approve{{$pkp->id_pkp}}{{$pkp->turunan}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h3 class="modal-title text-left" id="exampleModalLabel">Request Approval
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></h3>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form class="form-horizontal form-label-left" method="POST" action="{{ url('emailpkp',['id_pkp' => $pkp->id_pkp, 'revisi' => $pkp->revisi, 'turunan' => $pkp->turunan]) }}">
                        <div class="form-group row">
                          <label class="control-label text-bold col-md-1 col-sm-1 col-xs-12 text-center">Email</label>
                          <label class="control-label text-bold col-md-1 col-sm-1 col-xs-12 text-center">To</label>
                          <div class="col-md-9 col-sm-9 col-xs-12">
                            <input id="email" required class="form-control " type="email" name="email" required>
                            <input type="hidden" value="Pengajuan PKP-{{$pkp->project_name}}" name="judul" id="judul">
                            @foreach($picture as $pic)
                            <input type="hidden" value="{{$pic->lokasi}}" name="pic[]" id="pic">
                            @endforeach
                            <label stayle="color:red;">* only allowed one E-mail</label>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="control-label text-bold col-md-1 col-sm-1 col-xs-12 text-center"></label>
                          <label class="control-label text-bold col-md-1 col-sm-1 col-xs-12 text-center">Cc</label>
                          <div class="col-md-3 col-sm-10 col-xs-12">@if($pkp->perevisi!=NULL)<input type="text" required class="form-control " value="{{$pkp->perevisi2->email}}" name="pengirim2" id="pengirim2">@endif</div>
                          <div class="col-md-3 col-sm-10 col-xs-12"><input type="text" required class="form-control " value="{{auth()->user()->email}}" name="pengirim" id="pengirim"></div>
                          <div class="col-md-3 col-sm-10 col-xs-12"><input type="text" class="form-control" required value="{{$pkp->datapkpp->author1->email}}" name="pengirim1" id="pengirim1"></div>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-paper-plane"></i> Sent</button>
                          {{ csrf_field() }}
                        </div>
                      </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Modal Selesai -->
              @endif
            @elseif($pkp->status_pkp=='revisi')
              @if(auth()->user()->role->namaRule === 'pv_lokal')
                @if($pkp->datapkpp->approval=='approve')
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#revisi{{$pkp->id_pkp}}{{$pkp->turunan}}"><i class="fa fa-paper-plane"></i> Sent To RND</a></button>
                @endif
                <!-- modal -->
                <div class="modal" id="revisi{{$pkp->id_pkp}}{{$pkp->turunan}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h3 class="modal-title text-left" id="exampleModalLabel" >Sent Data Revision
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></h3></button>
                      </div>
                      <div class="modal-body">
                        <form class="form-horizontal form-label-left" method="POST" action="{{ Route('sentpkp',['id_pkp' => $pkp->id_pkp, 'revisi' => $pkp->revisi, 'turunan' => $pkp->turunan])}}">
                        <div class="form-group row">
                          <label class="control-label text-bold col-md-2 col-sm-3 col-xs-12 text-center">Dept Product</label>
                          <div class="col-md-4 col-sm-9 col-xs-12">
                            <select name="kirim" class="form-control form-control-line" id="kirim">
                              <option readonly value="{{$pkp->tujuankirim}}" selected>{{$pkp->departement->dept}}</option>
                              @foreach($dept as $dept)
                                @if($dept->Divisi=='RND')
                                <option value="{{$dept->id}}"> Manager {{ $dept->dept }} ({{$dept->users->name}})</option>
                                @endif
                              @endforeach
                            </select>
                          </div>
                          <?php $last = Date('j-F-Y'); ?>
                          <input id="date" value="{{ $last }}" class="form-control col-md-12 col-xs-12" name="date" required="required" type="hidden" readonly>
                          <input type="hidden" value="{{$pkp->project_name}}" name="name" id="name">
                          <label class="control-label text-bold col-md-2 col-sm-3 col-xs-12 text-center">Dept Kemas</label>
                          <div class="col-md-4 col-sm-9 col-xs-12">
                            <select name="rka" class="form-control form-control-line" id="rka">
                              <option value="1">RKA</option>
                              <option value="0">No Departement Selected</option>
                            </select>
                          </div>
                        </div>
                        <input type="hidden" value="{{$pkp->pkp_number}}" name="nopkp" id="nopkp">
                        <?php $tanggal = Date("Y"); ?>
                        @if($pkp->jenis!='Umum')
                          @if($pkp->type=='Maklon')
                          <input type="hidden" value="_{{$tanggal}}/PKP{{$pkp->jenis}}-M_{{ $pkp->project_name }}_{{ $pkp->revisi }}.{{ $pkp->turunan }}" name="ket_no" id="ket_no">
                          @elseif($pkp->type!='Maklon')
                          <input type="hidden" value="_{{$tanggal}}/PKP{{$pkp->jenis}}_{{ $pkp->project_name }} _{{ $pkp->revisi }}.{{ $pkp->turunan }}" name="ket_no" id="ket_no">
                          @endif
                        @elseif($pkp->jenis=='Umum')
                          @if($pkp->type=='Maklon')
                          <input type="hidden" value="_{{$tanggal}}/PKP-M_{{ $pkp->project_name }}_{{ $pkp->revisi }}.{{ $pkp->turunan }}" name="ket_no" id="ket_no">
                          @elseif($pkp->type!='Maklon')
                          <input type="hidden" value="_{{$tanggal}}/PKP_{{ $pkp->project_name }} _{{ $pkp->revisi }}.{{ $pkp->turunan }}" name="ket_no" id="ket_no">
                          @endif
                        @endif
                        <div class="form-group row">
                        <label class="control-label text-bold col-md-2 col-sm-3 col-xs-12 text-center">Prioritas Project</label>
                          <div class="col-md-1 col-sm-1 col-xs-12">
                            <select name="prioritas" class="form-control form-control-line" id="prioritas">
                              <option  selected value="{{$pkp->prioritas}}" readonly>
                                @if($pkp->prioritas==1)1
                                @elseif($pkp->prioritas==2)2
                                @elseif($pkp->prioritas==3)3
                                @endif
                              </option>
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                            </select>
                          </div>
                          <label class="control-label text-bold col-md-2 col-sm-3 col-xs-12 text-center">sending Sample</label>
                          <div class="col-md-3 col-sm-3 col-xs-12"><input type="date" class="form-control" value="{{$pkp->jangka}}" name="jangka" id="jangka" placeholder="start date"></div>
                          <div class="col-md-1 col-sm-1 col-xs-12"><center> To </center></div>
                          <div class="col-md-3 col-sm-3 col-xs-12"><input type="date" class="form-control" value="{{$pkp->waktu}}" name="waktu" id="waktu" placeholder="end date"></div>
                        </div>
                        <div class="form-group row">
                          <label class="control-label text-bold col-md-2 col-sm-3 col-xs-12 text-center">Alasan Revisi</label>
                          <div class="col-md-10 col-sm-10 col-xs-12"><textarea name="alasan" id="alasan" class="col-md-12 col-sm-12 col-xs-12" cols="10" required></textarea> </div>
                        </div>
                        <input type="hidden" value="{{$pkp->userpenerima}}" name="userpenerima">
                        <input type="hidden" value="{{$pkp->userpenerima2}}" name="userpenerima2">
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-paper-plane"></i> Sent</button>
                          {{ csrf_field() }}
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Modal Selesai -->
              @endif
            @elseif($pkp->status_pkp!='draf')
              @if(auth()->user()->role->namaRule === 'pv_lokal' || auth()->user()->role->namaRule === 'marketing')
                @if($pkp->status_data=='active')
                  <a class="btn btn-info btn-sm" onclick="return confirm('Up PKP Version ?')" href="{{Route('naikversipkp',['id_project' => $pkp->id_project, 'revisi' => $pkp->revisi, 'turunan' => $pkp->turunan])}}"><i class="fa fa-arrow-up" onclick="return confirm('Up PKP Version ?')"></i> Edit And Up Version</a>
                @endif
              @endif
            @endif
            <a class="btn btn-warning btn-sm" onclick="return confirm('Print this data PKP ?')" href="{{ Route('download',['id_pkp' => $pkp->id_pkp, 'revisi' => $pkp->revisi, 'turunan' => $pkp->turunan]) }}"><i class="fa fa-print"></i> Download/print PKP</a>
					</div>
          <form class="form-horizontal form-label-left" name="person" method="POST" >
          <div  class="tab-content panel ">
            <div class="tab-pane active" id="1">
              <div class="panel-default">
								<div class="panel-body badan" >
									<label>PT. NUTRIFOOD INDONESIA</label>
										<center> <h2 style="font-size: 22px;font-weight: bold;">PENGEMBANGAN KONSEP AWAL PRODUK BARU</h2> </center>
  									<center> <h2 style="font-size: 20px;font-weight: bold;">( PKP )</h2> </center><br>
										<center> <h2 style="font-weight: bold;">[ {{ $pkp->id_brand }} ] &reg;</h2> </center>
      							<table class="table table-bordered" style="font-size:12px">
                      <thead style="background-color:#13699a;font-weight: bold;color:white;font-size: 20px;">
                        <tr><th style="width:5%" class="text-center"><input type="hidden" name="nama_project" value="{{$pkp->project_name}}">{{ $pkp->project_name }}</th></tr>
                      </thead>
                    </table>
                    <div class="row">
                      <div class="col-sm-6">
                        <table ALIGN="left">
                          <tr><th class="text-left">Revision Number</th> <th> : {{$pkp->revisi}}.{{$pkp->turunan}}</th></tr>
                          <input type="hidden" id="type" value="{{$pkp->type}}"><input type="hidden" id="status" value="{{$pkp->status_pkp}}">
                          <input type="hidden" name="id_project" value="{{$pkp->id_project}}">
                          <input type="hidden" name="revisi" value="{{$pkp->revisi}}">
                          <input type="hidden" name="turunan" value="{{$pkp->turunan}}">
                          <input type="hidden" name="brand" value="L-Men">
                          <input type="hidden" name="ket_no" value="{{$pkp->ket_no}}">
                          <input type="hidden" name="id_pkp" value="{{$pkp->pkp_number}}">
                          <input type="hidden" name="priority_project" value="{{$pkp->prioritas}}">
                          <input type="hidden" name="status_freeze" value="{{$pkp->status_freeze}}">
                          <input type="hidden" name="note_freeze" value="{{$pkp->note_freeze}}">
                          <input type="hidden" name="selling_price" value="{{$pkp->price}}">
                          <input type="hidden" name="price" value="{{$pkp->price}}">
                          <input type="hidden" name="status_data" value="{{$pkp->status_data}}">
                          <input type="hidden" name="UOM" value="{{$pkp->UOM}}">
                          <tr><th class="text-left">PKP Number</th> <th> : {{$pkp->pkp_number}}{{$pkp->ket_no}}</th></tr>
                        </table>
                      </div>
                      <div class="col-sm-6">
                        <table ALIGN="right">
                          <tr><th class="text-right">Author </th><th>: {{$pkp->datapkpp->author1->name}}</th></tr>
                          <tr><th class="text-right">Created date</th> <th>: {{$pkp->created_date}}</th></tr>
                          <tr><th class="text-right">Last Upadate On</th> <th>: {{$pkp->last_update}}</th></tr>
                          <tr><th class="text-right">Last Sent</th> <th>: {{$pkp->datapkpp->tgl_kirim}}</th></tr>
                          <tr><th class="text-right">Revised By</th><th>: @if($pkp->perevisi!=NULL) {{$pkp->perevisi2->name}}@endif</th></tr>
                        </table><br><br>
                      </div>
                    </div>
                    @if($pkp->status_project=='draf')
										<table class=" table table-bordered">
                      <tr><th colspan="3" class="text-center"><span style="font-weight: bold;font-size: 20px;" class="card-title">Background</span></th></tr>
                      <tr>
                        <th width="300px">Idea</th>
                        <td colspan="2"> <?php $ideas = []; foreach ($pkp1 as $key => $data) If (!$ideas || !in_array($data->idea, $ideas)) {$ideas += array($key => $data->idea);
                        if($data->turunan!=$pkp->turunan){ echo" <s><font color='#6594c5'>$data->idea <br></font></s>"; }if($data->turunan==$pkp->turunan){ echo" $data->idea<br>"; } } ?></td>
                      </tr>
                      <tr>
                        <th>Target market</th>
                        <td colspan="2">
													<table>
                            <tr><th style="border:none;">Gender </th><td style="border:none;">
                            <?php $dataG = []; foreach ($pkp1 as $key => $data) If (!$dataG || !in_array($data->gender, $dataG)) { $dataG += array( $key => $data->gender );if($data->turunan!=$pkp->turunan){
                            echo"<s><font color='#6594c5'>: $data->gender<br></font></s>"; } if($data->turunan==$pkp->turunan){ echo" : $data->gender <br>"; } } ?></td></tr>
														
                            <tr><th style="border:none;">Age </th><td style="border:none;"> 
                            <?php $dariumur = []; foreach ($pkp1 as $key => $data) If (!$dariumur || !in_array($data->dariumur, $dariumur)) { $dariumur += array( $key => $data->dariumur ); if($data->turunan!=$pkp->turunan){
                            echo": <s><font color='#6594c5'>$data->dariumur</font></s>";} if($data->turunan==$pkp->turunan){ echo": $data->dariumur ";} } ?>
                            - <?php $sampaiumur = []; foreach ($pkp1 as $key => $data) If (!$sampaiumur || !in_array($data->sampaiumur, $sampaiumur)) { $sampaiumur += array( $key => $data->sampaiumur ); if($data->turunan!=$pkp->turunan){
                            echo" <s><font color='#6594c5'>$data->sampaiumur</font></s>";} if($data->turunan==$pkp->turunan){ echo" $data->sampaiumur ";} } ?> </td></tr>
														
                            <tr><th style="border:none;">SES </th><td style="border:none;"> 
                            <?php $ses = []; foreach ($datases as $key => $data) If (!$ses || !in_array($data->ses, $ses)) { $ses += array( $key => $data->ses ); 
                            if($data->turunan!=$pkp->turunan){ echo": <s><font color='#6594c5'>$data->ses<br></font></s>"; }if($data->turunan==$pkp->turunan){ echo": $data->ses <br>"; } } ?></td></tr>
                          
                            <tr><th style="border:none;">Remarks SES </th><td style="border:none;"> 
                            @if($pkp->remarks_ses!=NULL)
                            <?php $remarks_ses = []; foreach ($pkp1 as $key => $data) If (!$remarks_ses || !in_array($data->remarks_ses, $remarks_ses)) { $remarks_ses += array( $key => $data->remarks_ses ); if($data->turunan!=$pkp->turunan){
                            echo": <s><font color='#6594c5'>$data->remarks_ses</font></s>";} if($data->turunan==$pkp->turunan){ echo" : $data->remarks_ses ";} } ?></td></tr>
                            @endif
                          </table>
												</td>
                      </tr>
                      <tr>
                      <th>Uniqueness of idea</th>
                        <td colspan="2"><?php $Uniqueness = []; foreach ($pkp1 as $key => $data) If (!$Uniqueness || !in_array($data->Uniqueness, $Uniqueness)) { $Uniqueness += array( $key => $data->Uniqueness ); 
                        if($data->turunan!=$pkp->turunan){ echo" <s><font color='#6594c5'>$data->Uniqueness <br></font></s>"; } if($data->turunan==$pkp->turunan){ echo" $data->Uniqueness <br>";} } ?></td>
                      </tr>
                      <tr>
                        <th>Estimated potential market</th>
                        <td colspan="2"><?php $Estimated = []; foreach ($pkp1 as $key => $data) If (!$Estimated || !in_array($data->Estimated, $Estimated)) {  $Estimated += array(  $key => $data->Estimated ); 
                        if($data->turunan!=$pkp->turunan){ echo" <s><font color='#6594c5'>$data->Estimated <br></font></s>"; } if($data->turunan==$pkp->turunan){ echo" $data->Estimated <br>"; } } ?></td>
                      </tr>
                      <tr class="table-highlight">
                        <th>Reason(s)</th>
                        <td colspan="2"><?php $reason = []; foreach ($pkp1 as $key => $data) If (!$reason || !in_array($data->reason, $reason)) { $reason += array( $key => $data->reason ); 
                         if($data->turunan==$pkp->turunan){ echo" $data->reason <br>"; } } ?></td>
                      </tr>
                      <tr><th colspan="3" class="text-center"><span style="font-weight: bold;font-size: 20px;" class="card-title">Market Analysis</span></th></tr>
                      <tr>
                        <th>Launch Deadline</th>
                        <td colspan="2">
													<table>
                            <tr>
                            <?php $launch = []; foreach ($pkp1 as $key => $data) If (!$launch || !in_array($data->launch, $launch)) { $launch += array( $key => $data->launch ); 
                            if($data->turunan!=$pkp->turunan){ echo" <s><font color='#6594c5'>$data->launch $data->years<br></font></s>"; } if($data->turunan==$pkp->turunan){ echo" $data->launch $data->years<br>"; } } ?>

                            <?php $tgl_launch = []; foreach ($pkp1 as $key => $data) If (!$tgl_launch || !in_array($data->tgl_launch, $tgl_launch)) { $tgl_launch += array( $key => $data->tgl_launch ); 
                            if($data->turunan!=$pkp->turunan){ echo" <s><font color='#6594c5'>$data->tgl_launch<br></font></s>"; } if($data->turunan==$pkp->turunan){ echo" $data->tgl_launch<br>"; } } ?>
                            </tr>
													</table>
												</td>
                      </tr>
                      <tr>
                        <th>Aisle Placement</th>
                        <td colspan="2"><?php $aisle = []; foreach ($pkp1 as $key => $data) If (!$aisle || !in_array($data->aisle, $aisle)) { $aisle += array( $key => $data->aisle ); 
                        if($data->turunan!=$pkp->turunan){ echo" <s><font color='#6594c5'>$data->aisle<br></font></s>"; } if($data->turunan==$pkp->turunan){ echo" $data->aisle<br>"; } } ?></td>
                      </tr>
                      <tr>
                        <th>Sales Forecast</th>
                        <td colspan="2">@foreach($for as $data){{$data->satuan}} = <?php $angka_format = number_format($data->forecast,2,",","."); echo "Rp. ".$angka_format;?><br> @endforeach
                        <br>
                        @if($pkp->remarks_forecash!='NULL')
                        <?php $remarks_forecash = []; foreach ($for as $key => $data) If (!$remarks_forecash || !in_array($data->remarks_forecash, $remarks_forecash)) { $remarks_forecash += array( $key => $data->remarks_forecash ); 
                        if($data->turunan!=$pkp->turunan){ echo"Remarks forecast: <s><font color='#6594c5'>$data->remarks_forecash<br></font></s>"; } if($data->turunan==$pkp->turunan){ echo"Remarks forecast: $data->remarks_forecash <br>";  } } ?></td>
                        @endif
                      </tr>
											<tr>
                        <th>NF Selling Price (Before ppn)</th>
                        <td colspan="2">
                          <?php $selling_price = []; foreach ($pkp1 as $key => $data) If (!$selling_price || !in_array($data->selling_price, $selling_price)) { $selling_price += array( $key => $data->selling_price ); 
                          if($data->turunan!=$pkp->turunan){ echo" <s><font color='#6594c5'>Rp. ". number_format($data->selling_price, 0, ".", "."). "<br></font></s>"; } if($data->turunan==$pkp->turunan){ echo" Rp. ". number_format($data->selling_price, 0, ".", "."). "<br>"; } }  ?>
                        </td>
											</tr>
                      <tr>
                        <th>Consumer price target</th>
                        <td colspan="2">
                          <?php $price = []; foreach ($pkp1 as $key => $data) If (!$price || !in_array($data->price, $price)) { $price += array( $key => $data->price ); 
                          if($data->turunan!=$pkp->turunan){ echo" <s><font color='#6594c5'>Rp. ". number_format($data->price, 0, ".", "."). "<br></font></s>"; } if($data->turunan==$pkp->turunan){ echo"Rp. ". number_format($data->price, 0, ".", "."). "<br>"; } } ?>
                        </td>
                      </tr>
                      <tr>
                        <th>UOM</th>
                        <td colspan="2">
                          <?php $uom = []; foreach ($pkp1 as $key => $data) If (!$uom || !in_array($data->uom, $uom)) { $uom += array( $key => $data->uom ); 
                          if($data->turunan!=$pkp->turunan){ echo" <s><font color='#6594c5'>$data->UOM<br></font></s>"; } if($data->turunan==$pkp->turunan){ echo"$data->UOM<br>"; } } ?>
                        </td>
                      </tr>
                      <tr class="table-highlight">
                        <th>Main Competitor</th>
                        <td colspan="2"><?php $competitor = []; foreach ($pkp1 as $key => $data) If (!$competitor || !in_array($data->competitor, $competitor)) {$competitor += array( $key => $data->competitor ); 
                        if($data->turunan!=$pkp->turunan){ echo" <s><font color='#6594c5'>$data->competitor <br></font></s>"; } if($data->turunan==$pkp->turunan){ echo" $data->competitor <br>"; } }  ?></td>
                      </tr>
                      <tr class="table-highlight">
                        <th>Competitive Analysis</th>
                        <td colspan="2"><?php $competitive = []; foreach ($pkp1 as $key => $data) If (!$competitive || !in_array($data->competitive, $competitive)) { $competitive += array( $key => $data->competitive ); 
                        if($data->turunan!=$pkp->turunan){ echo" <s><font color='#6594c5'>$data->competitive <br></font></s>"; } if($data->turunan==$pkp->turunan){ echo" $data->competitive <br>"; } }  ?></td>
                      </tr>
                      <tr>
                        <th colspan="3" class="text-center"><span style="font-weight: bold;font-size: 20px;" class="card-title">Product features</span></th>
                      </tr>
                      <tr>
                        <th>Product Form</th>
                        <td colspan="2"><?php $product_form = []; foreach ($pkp1 as $key => $data) If (!$product_form || !in_array($data->product_form, $product_form)) { $product_form += array( $key => $data->product_form  ); 
                        if($data->turunan!=$pkp->turunan){ echo" <s><font color='#6594c5'>$data->product_form<br></font></s>"; } if($data->turunan==$pkp->turunan){ echo" $data->product_form<br>"; } }  ?><br>

                        <?php $remarks_product_form = []; foreach ($pkp1 as $key => $data) If (!$remarks_product_form || !in_array($data->remarks_product_form, $remarks_product_form)) { $remarks_product_form += array( $key => $data->remarks_product_form  ); 
                         if($data->turunan!=$pkp->turunan){ echo"Remarks : <s><font color='#6594c5'>$data->remarks_product_form<br></font></s>"; } if($data->turunan==$pkp->turunan){ echo"Remarks: $data->remarks_product_form<br>"; } }  ?></td>
                      </tr>
                      <tr>
                        <th>Product Packaging</th>
                        <td colspan="2">
													<table>
                            @if($pkp->kemas_eksis!=NULL)(
                              @if($pkp->kemas->primer!=NULL)
                              {{ $pkp->kemas->primer }}{{ $pkp->kemas->s_primer }}
                              @elseif($pkp->kemas->primer==NULL)
                              @endif

                              @if($pkp->kemas->sekunder1!=NULL)
                              X {{ $pkp->kemas->sekunder1 }}{{ $pkp->kemas->s_sekunder1}}
                              @elseif($pkp->kemas->sekunder1==NULL)
                              @endif

                              @if($pkp->kemas->sekunder2!=NULL)
                              X {{ $pkp->kemas->sekunder2 }}{{ $pkp->kemas->s_sekunder2 }}
                              @elseif($pkp->sekunder2==NULL)
                              @endif

                              @if($pkp->kemas->tersier!=NULL)
                              X {{ $pkp->kemas->tersier }}{{ $pkp->kemas->s_tersier }}
                              @elseif($pkp->tersier==NULL)
                              @endif )
                            @elseif($pkp->primer==NULL)
                              @if($pkp->kemas_eksis==NULL)
                              @endif
                            @endif
                            <br><br>
                            @if($pkp->primery!=NULL)
														<tr><th width="35%">Primary information</th><th>:</th><td style="border:none;"><?php $primery = []; foreach ($pkp1 as $key => $data) If (!$primery || !in_array($data->primery, $primery)) { $primery += array( $key => $data->primery ); 
                              if($data->revisi!=$pkp->revisi){  echo" <s><font color='#6594c5'>$data->primery<br></font></s>";  } if($data->revisi==$pkp->revisi){ echo" $data->primery<br>"; } }  ?></td></tr>
                            @endif
                            @if($pkp->secondary!=NULL)
                            <tr><th width="35%">Secondary information</th><th>:</th><td style="border:none;"><?php $secondary = []; foreach ($pkp1 as $key => $data) If (!$secondary || !in_array($data->secondary, $secondary)) { $secondary += array( $key => $data->secondary ); 
                              if($data->revisi!=$pkp->revisi){  echo" <s><font color='#6594c5'>$data->secondary<br></font></s>";  } if($data->revisi==$pkp->revisi){ echo" $data->secondary<br>"; } }  ?></td></tr>
                            @endif
                            @if($pkp->tertiary!=NULL)
                            <tr><th width="35%">Teriery information</th><th>:</th><td style="border:none;"><?php $tertiary = []; foreach ($pkp1 as $key => $data) If (!$tertiary || !in_array($data->tertiary, $tertiary)) { $tertiary += array( $key => $data->tertiary ); 
                              if($data->revisi!=$pkp->revisi){  echo" <s><font color='#6594c5'>$data->tertiary<br></font></s>";  } if($data->revisi==$pkp->revisi){ echo" $data->tertiary<br>"; } }  ?></td></tr>
                            @endif
                          </table>
												</td>
                      </tr>
                      <tr>
                        <th>Food Category (BPOM)</th>
                        @if($pkp->bpom!=NULL && $pkp->kategori_bpom!=NULL)
                        <td colspan="2"><?php $pangan = []; foreach ($pkp1 as $key => $data) If (!$pangan || !in_array($data->katpangan, $pangan)) { $pangan += array( $key => $data->katpangan );  
                        if($data->turunan==$pkp->turunan){ echo "(".$data->katpangan->no_kategori .") ". $data->katpangan->pangan ." <br>"; } }  ?>  
                        </td>@endif
                      </tr>
                      <tr>
                        <th>AKG</th>
                        <td>
                          <?php $tarkon = []; foreach ($pkp1 as $key => $data) If (!$tarkon || !in_array($data->tarkon, $tarkon)) { $tarkon += array( $key => $data->tarkon ); 
                           if($data->turunan==$pkp->turunan){ echo"". $data->tarkon->tarkon."<br>"; } }  ?>
                        </td>
                      </tr>
                      <tr class="table-highlight">
                        <th>Prefered Flavour</th>
                        <td colspan="2"><?php $prefered_flavour = []; foreach ($pkp1 as $key => $data) If (!$prefered_flavour || !in_array($data->prefered_flavour, $prefered_flavour)) { $prefered_flavour += array( $key => $data->prefered_flavour ); 
                        if($data->turunan!=$pkp->turunan){  echo" <s><font color='#6594c5'>$data->prefered_flavour<br></font></s>";  } if($data->turunan==$pkp->turunan){ echo" $data->prefered_flavour<br>"; } }  ?></td>
                      </tr>
                      <tr>
                        <th>Product Benefits</th>
                        <td colspan="2">
                          <?php $product_benefits= []; foreach ($pkp1 as $key => $data) If (!$product_benefits|| !in_array($data->product_benefits, $product_benefits)) { $product_benefits+= array( $key => $data->product_benefits ); 
                          if($data->turunan!=$pkp->turunan){ echo" <s><font color='#6594c5'>$data->product_benefits <br></font></s>"; } if($data->turunan==$pkp->turunan){ echo" $data->product_benefits<br>"; } }  ?><br>
                          <table class="table table-bordered" >
                            <tbody>
                              <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                                <td class="text-center">Komponen</td>
                                <td class="text-center">Klaim</td>
                                <td class="text-center">Detail</td>
                                <td class="text-center">Information</td>
                              </tr>
                              <tr>
                                <td>
                                  <?php $komponen = []; foreach ($dataklaim as $key => $data) If (!$komponen || !in_array($data->datakp->komponen, $komponen)) { $komponen += array( $key => $data->datakp->komponen ); 
                                  if($data->revisi!=$pkp->revisi){ echo" <s><font color='#6594c5'>".$data->datakp->komponen."<br></font></s>"; } if($data->revisi==$pkp->revisi){ echo"". $data->datakp->komponen."<br>"; } }  ?>
                                </td>
                                <td>
                                  <?php $klaim = []; foreach ($dataklaim as $key => $data) If (!$klaim || !in_array($data->klaim, $klaim)) { $klaim += array( $key => $data->klaim );
                                  if($data->revisi!=$pkp->revisi){ echo" <s><font color='#6594c5'>".$data->klaim."<br></font></s>"; } if($data->revisi==$pkp->revisi){ echo"". $data->klaim."<br>"; } }  ?>
                                </td>
                                <td>
                                  <?php $detail = []; foreach ($datadetail as $key => $data) If (!$detail || !in_array($data->datadl->detail, $detail)) { $detail += array( $key => $data->datadl->detail );
                                  if($data->revisi!=$pkp->revisi){ echo" <s><font color='#6594c5'>".$data->datadl->detail."<br></font></s>"; } if($data->revisi==$pkp->revisi){ echo"". $data->datadl->detail."<br>"; } }  ?>
                                </td>
                                <td>
                                  <?php $note = []; foreach ($dataklaim as $key => $data) If (!$note || !in_array($data->note, $note)) { $note += array( $key => $data->note );
                                  if($data->revisi!=$pkp->revisi){ echo" <s><font color='#6594c5'>".$data->note."<br></font></s>"; } if($data->revisi==$pkp->revisi){ echo"". $data->note."<br>"; } }  ?>
                                </td>
                              </tr>
                            </tbody>
                          </table>
												</td>
                      </tr>
                      <tr>
                        <th>Serving Suggestion</th>
                        <td colspan="2"><?php $serving = []; foreach ($pkp1 as $key => $data) If (!$serving || !in_array($data->serving_suggestion, $serving)) { $serving += array( $key => $data->serving_suggestion ); 
                        if($data->turunan!=$pkp->turunan){ echo" <s><font color='#6594c5'>$data->serving_suggestion<br></font></s>"; } if($data->turunan==$pkp->turunan){ echo" $data->serving_suggestion<br>"; } }  ?></td>
                      </tr>
                      <tr>
                        <th>Mandatory Ingredients</th>
                        <td colspan="2"><?php $mandatory_ingredient = []; foreach ($pkp1 as $key => $data) If (!$mandatory_ingredient || !in_array($data->mandatory_ingredient, $mandatory_ingredient)) { $mandatory_ingredient += array( $key => $data->mandatory_ingredient ); 
                        if($data->turunan!=$pkp->turunan){ echo" <s><font color='#6594c5'>$data->mandatory_ingredient<br></font></s>"; } if($data->turunan==$pkp->turunan){ echo" $data->mandatory_ingredient<br>"; } }  ?></td>
                      </tr>
                      <tr>
                        <th>Related Picture</th>
                        <td colspan="2">
                          <table class="table table-bordered">
                            <tr class="text-center" style="font-weight: bold;color:white;background-color: #2a3f54;">
                              <td class="text-center">Filename</td>
                              <td class="text-center">Information</td>
                              <td class="text-center"></td>
                            </tr>
                            @foreach($picture as $pic)
                            <tr>
                              <td>{{$pic->filename}} </td>
                              <td width="40%"> &nbsp{{$pic->informasi}}</td>  
                              <td width="10%" class="text-center"><a href="{{asset('data_file/'.$pic->filename)}}" class="btn btn-warning btn-sm" download="{{$pic->filename}}" title="Download file"><li class="fa fa-download"></li></a></td>
                            </tr>
                            @endforeach
                          </table>
                        </td>
                      </tr>
                    </table>
                    @else
                    <table class=" table table-bordered">
                      <tr><th colspan="3" class="text-center"><span style="font-weight: bold;font-size: 20px;" class="card-title">Background</span></th></tr>
                      <tr>
                        <th width="300px">Idea</th>
                        <td colspan="2"><input type="hidden" name="idea" value="{{$pkp->idea}}"> <?php $ideas = []; foreach ($pkp2 as $key => $data) If (!$ideas || !in_array($data->idea, $ideas)) {$ideas += array($key => $data->idea);
                        if($data->revisi!=$pkp->revisi){ echo" <s><font color='#ffa2a2'>$data->idea<br></font></s>"; }if($data->revisi==$pkp->revisi){ echo" $data->idea<br>"; } } ?></td>
                      </tr>
                      <tr>
                        <th>Target market</th>
                        <td colspan="2">
													<table>
                            <tr><th style="border:none;">Gender </th><td style="border:none;"> 
                            <input type="hidden" name="gender" value="{{$pkp->gender}}"><?php $dataG = []; foreach ($pkp2 as $key => $data) If (!$dataG || !in_array($data->gender, $dataG)) { $dataG += array( $key => $data->gender );if($data->revisi!=$pkp->revisi){
                            echo": <s><font color='#ffa2a2'>$data->gender<br></font></s>"; } if($data->revisi==$pkp->revisi){ echo": $data->gender <br>"; } } ?></td></tr>
														
                            <tr><th style="border:none;">Usia </th><td style="border:none;"> 
                            <input type="hidden" name="dari_umur" value="{{$pkp->dariumur}}"><input type="hidden" name="sampai_umur" value="{{$pkp->sampaiumur}}">
                            <?php $dariumur = []; foreach ($pkp2 as $key => $data) If (!$dariumur || !in_array($data->dariumur, $dariumur)) { $dariumur += array( $key => $data->dariumur ); if($data->revisi!=$pkp->revisi){
                            echo": <s><font color='#ffa2a2'>$data->dariumur - $data->sampaiumur<br></font></s>";} if($data->revisi==$pkp->revisi){ echo": $data->dariumur - $data->sampaiumur <br>";} } ?> </td></tr>
														
                            <tr><th style="border:none;">SES </th><td style="border:none;"> 
                            @foreach ($datases as $data)<input type="hidden" name="ses" value="{{$data->ses}}">@endforeach
                            <?php $ses = []; foreach ($datases as $key => $data) If (!$ses || !in_array($data->ses, $ses)) { $ses += array( $key => $data->ses ); 
                            if($data->revisi!=$pkp->revisi){ echo": <s><font color='#ffa2a2'>$data->ses<br></font></s>"; }if($data->revisi==$pkp->revisi){ echo": $data->ses <br>"; } } ?></td></tr>
                            
                            <tr><th style="border:none;">Remarks SES </th><td style="border:none;">
                            <?php $remarks_ses = []; foreach ($pkp2 as $key => $data) If (!$remarks_ses || !in_array($data->remarks_ses, $remarks_ses)) { $remarks_ses += array( $key => $data->remarks_ses ); if($data->revisi!=$pkp->revisi){
                            echo": <s><font color='#ffa2a2'>$data->remarks_ses</font></s>";} if($data->revisi==$pkp->revisi){ echo" : $data->remarks_ses ";} } ?></td></tr>
                          </table>
												</td>
                      </tr>
                      <tr>
                        <th>Uniqueness of idea</th>
                        <input type="hidden" name="uniqueness" value="{{$pkp->Uniqueness}}"><td colspan="2"><?php $Uniqueness = []; foreach ($pkp2 as $key => $data) If (!$Uniqueness || !in_array($data->Uniqueness, $Uniqueness)) { $Uniqueness += array( $key => $data->Uniqueness ); 
                        if($data->revisi!=$pkp->revisi){ echo" <s><font color='#ffa2a2'>$data->Uniqueness <br></font></s>"; } if($data->revisi==$pkp->revisi){ echo" $data->Uniqueness <br>";} } ?></td>
                      </tr>
                      <tr>
                      <th>Estimated potential market</th>
                        <input type="hidden" name="estimated" value="{{$pkp->Estimated}}"><td colspan="2"><?php $Estimated = []; foreach ($pkp2 as $key => $data) If (!$Estimated || !in_array($data->Estimated, $Estimated)) {  $Estimated += array(  $key => $data->Estimated ); 
                        if($data->revisi!=$pkp->revisi){ echo" <s><font color='#ffa2a2'>$data->Estimated <br></font></s>"; } if($data->revisi==$pkp->revisi){ echo" $data->Estimated <br>"; } } ?></td>
                      </tr>
                      <tr class="table-highlight">
                        <th>Reason(s)</th>
                        <input type="hidden" name="reason" value="{{$pkp->reason}}"><td colspan="2"><?php $reason = []; foreach ($pkp2 as $key => $data) If (!$reason || !in_array($data->reason, $reason)) { $reason += array( $key => $data->reason ); 
                        if($data->revisi!=$pkp->revisi){ echo" <s><font color='#ffa2a2'>$data->reason<br></font></s>";} if($data->revisi==$pkp->revisi){ echo" $data->reason <br>"; } } ?></td>
                      </tr>
                      <tr><th colspan="3" class="text-center"><span style="font-weight: bold;font-size: 20px;" class="card-title">Market Analysis</span></th></tr>
                      <tr>
                        <th>Launch Deadline</th>
                        <td colspan="2">
													<table>
                            <tr>
                            <input type="hidden" name="launch" value="{{$pkp->launch}}"><input type="hidden" name="years" value="{{$pkp->years}}"><input type="hidden" name="tgl_launch" value="{{$pkp->tgl_launch}}">
                            <?php $launch = []; foreach ($pkp2 as $key => $data) If (!$launch || !in_array($data->launch, $launch)) { $launch += array( $key => $data->launch ); 
                            if($data->revisi!=$pkp->revisi){ echo" <s><font color='#ffa2a2'>$data->launch $data->years<br></font></s>"; } if($data->revisi==$pkp->revisi){ echo" $data->launch $data->years<br>"; } } ?>

                            <?php $tgl_launch = []; foreach ($pkp2 as $key => $data) If (!$tgl_launch || !in_array($data->tgl_launch, $tgl_launch)) { $tgl_launch += array( $key => $data->tgl_launch ); 
                            if($data->revisi!=$pkp->revisi){ echo" <s><font color='#ffa2a2'>$data->tgl_launch<br></font></s>"; } if($data->revisi==$pkp->revisi){ echo" $data->tgl_launch<br>"; } } ?>
                            </tr>
													</table>
												</td>
                      </tr>
                      <tr>
                        <th>Aisle Placement</th>
                        <input type="hidden" name="aisle" id="aisle" value="{{$pkp->aisle}}"><td colspan="2"><?php $aisle = []; foreach ($pkp2 as $key => $data) If (!$aisle || !in_array($data->aisle, $aisle)) { $aisle += array( $key => $data->aisle ); 
                        if($data->revisi!=$pkp->revisi){ echo" <s><font color='#ffa2a2'>$data->aisle<br></font></s>"; } if($data->revisi==$pkp->revisi){ echo" $data->aisle<br>"; } } ?></td>
                      </tr>
                      <tr>
                        <th>Sales Forecast </th>
                        <td colspan="2">@foreach($for as $data){{$data->satuan}} = <?php $angka_format = number_format($data->forecast,2,",","."); echo "Rp. ".$angka_format;?><br> @endforeach
                        <br>
                          @if($pkp->remarks_forecash!='NULL')<input type="hidden" name="data_forecast" value="{{$pkp->remarks_forecash}}">
                          <?php $remarks_forecash = []; foreach ($for as $key => $data) If (!$remarks_forecash || !in_array($data->remarks_forecash, $remarks_forecash)) { $remarks_forecash += array( $key => $data->remarks_forecash ); 
                          if($data->revisi!=$pkp->revisi){ echo"Remarks forecast: <s><font color='#ffa2a2'>$data->remarks_forecash<br></font></s>"; } if($data->revisi==$pkp->revisi){ echo"Remarks forecast: $data->remarks_forecash <br>";  } } ?>
                          @endif
                        </td>
                      </tr>
                      <tr>
                        <th>NFI Selling Price (Before ppn)</th>
                        <td colspan="2">
                          <input type="hidden" name="nfi_price" value="{{$pkp->selling_price}}"><?php $selling_price = []; foreach ($pkp2 as $key => $data) If (!$selling_price || !in_array($data->selling_price, $selling_price)) { $selling_price += array( $key => $data->selling_price ); 
                          if($data->revisi!=$pkp->revisi){ echo" <s><font color='#ffa2a2'>Rp. ". number_format($data->selling_price, 0, ".", "."). "<br></font></s>"; } if($data->revisi==$pkp->revisi){ echo" Rp. ". number_format($data->selling_price, 0, ".", "."). " <br>"; } }  ?>
                        </td>
											</tr>
                      <tr>
                        <th>Consumer price target</th>
                        <td colspan="2">
                          <input type="hidden" name="costumer_price" value="{{$pkp->price}}"><?php $price = []; foreach ($pkp2 as $key => $data) If (!$price || !in_array($data->price, $price)) { $price += array( $key => $data->price ); 
                          if($data->revisi!=$pkp->revisi){ echo" <s><font color='#ffa2a2'>Rp. ". number_format($data->price, 0, ".", "."). "<br></font></s>"; } if($data->revisi==$pkp->revisi){ echo" Rp. ". number_format($data->price, 0, ".", "."). "<br>"; } } ?>
                        </td>
                      </tr>
                      <tr>
                        <th>UOM</th>
                        <td colspan="2">
                          <?php $uom = []; foreach ($pkp1 as $key => $data) If (!$uom || !in_array($data->uom, $uom)) { $uom += array( $key => $data->uom ); 
                          if($data->revisi!=$pkp->revisi){ echo" <s><font color='#6594c5'>$data->UOM<br></font></s>"; } if($data->revisi==$pkp->revisi){ echo"$data->UOM"; } } ?>
                        </td>
                      </tr>
                      <tr class="table-highlight">
                        <th>Main Competitor</th>
                        <input type="hidden" name="competitor" value="{{$pkp->competitor}}"><td colspan="2"><?php $competitor = []; foreach ($pkp2 as $key => $data) If (!$competitor || !in_array($data->competitor, $competitor)) {$competitor += array( $key => $data->competitor ); 
                        if($data->revisi!=$pkp->revisi){ echo" <s><font color='#ffa2a2'>$data->competitor <br></font></s>"; } if($data->revisi==$pkp->revisi){ echo" $data->competitor <br>"; } }  ?></td>
                      </tr>
                      <tr class="table-highlight">
                        <th>Competitive Analysis</th>
                        <input type="hidden" name="competitive" value="{{$pkp->competitive}}"><td colspan="2"><?php $competitive = []; foreach ($pkp2 as $key => $data) If (!$competitive || !in_array($data->competitive, $competitive)) { $competitive += array( $key => $data->competitive ); 
                        if($data->revisi!=$pkp->revisi){ echo" <s><font color='#ffa2a2'>$data->competitive <br></font></s>"; } if($data->revisi==$pkp->revisi){ echo" $data->competitive <br>"; } }  ?></td>
                      </tr>
                      <tr>
                        <th colspan="3" class="text-center"><span style="font-weight: bold;font-size: 20px;" class="card-title">Product features</span></th>
                      </tr>
                      <tr>
                        <th>Product Form</th>
                        <td colspan="2">
                        <input type="hidden" name="product_form" value="{{$pkp->product_form}}"><?php $product_form = []; foreach ($pkp2 as $key => $data) If (!$product_form || !in_array($data->product_form, $product_form)) { $product_form += array( $key => $data->product_form  ); 
                        if($data->revisi!=$pkp->revisi){ echo":<s><font color='#ffa2a2'>$data->product_form<br></font></s>"; } if($data->revisi==$pkp->revisi){ echo" $data->product_form<br>"; } }  ?>
                        <br><br>
                        <input type="hidden" name="data_form" value="{{$pkp->remarks_product_form}}">
                        <?php $remarks_product_form = []; foreach ($pkp2 as $key => $data) If (!$remarks_product_form || !in_array($data->remarks_product_form, $remarks_product_form)) { $remarks_product_form += array( $key => $data->remarks_product_form  ); 
                        if($data->revisi!=$pkp->revisi){ echo"Remarks : <s><font color='#ffa2a2'>$data->remarks_product_form<br></font></s>"; } if($data->revisi==$pkp->revisi){ echo"Remarks: $data->remarks_product_form<br>"; } }  ?></td>
                      </tr>
                      <tr>
                        <th>Product Packaging</th>
                        <td colspan="2">
													<table>
                            @if($pkp->kemas_eksis!=NULL)
                              (<input type="hidden" name="configuration" value="{{ $pkp->kemas->primer }}{{ $pkp->kemas->s_primer }} X {{ $pkp->kemas->sekunder1 }}{{ $pkp->kemas->s_sekunder1}} X {{ $pkp->kemas->sekunder2 }}{{ $pkp->kemas->s_sekunder2 }} X {{ $pkp->kemas->tersier }}{{ $pkp->kemas->s_tersier }}">
                              @if($pkp->kemas->tersier!=NULL)
                              {{ $pkp->kemas->tersier }}{{ $pkp->kemas->s_tersier }} X
                              @endif

                              @if($pkp->kemas->sekunder1!=NULL)
                             {{ $pkp->kemas->sekunder1 }}{{ $pkp->kemas->s_sekunder1}} X
                              @endif

                              @if($pkp->kemas->sekunder2!=NULL)
                              {{ $pkp->kemas->sekunder2 }}{{ $pkp->kemas->s_sekunder2 }} X
                              @endif

                              @if($pkp->kemas->primer!=NULL)
                              {{ $pkp->kemas->primer }}{{ $pkp->kemas->s_primer }}
                              @endif )
                            @endif
                            <br><br>
                            @if($pkp->primery!=NULL)
														<input type="hidden" name="primary" value="{{$pkp->primery}}"><tr><th width="35%">Primary information</th><th>:</th><td style="border:none;"><?php $primery = []; foreach ($pkp1 as $key => $data) If (!$primery || !in_array($data->primery, $primery)) { $primery += array( $key => $data->primery ); 
                              if($data->revisi!=$pkp->revisi){  echo" <s><font color='#ffa2a2'>$data->primery<br></font></s>";  } if($data->revisi==$pkp->revisi){ echo" $data->primery<br>"; } }  ?></td></tr>
                            @endif
                            @if($pkp->secondary!=NULL)
                            <input type="hidden" name="secondary" value="{{$pkp->secondary}}"><tr><th width="35%">Secondary information</th><th>:</th><td style="border:none;"><?php $secondary = []; foreach ($pkp1 as $key => $data) If (!$secondary || !in_array($data->secondary, $secondary)) { $secondary += array( $key => $data->secondary ); 
                              if($data->revisi!=$pkp->revisi){  echo" <s><font color='#ffa2a2'>$data->secondary<br></font></s>";  } if($data->revisi==$pkp->revisi){ echo" $data->secondary<br>"; } }  ?></td></tr>
                            @endif
                            @if($pkp->tertiary!=NULL)
                            <input type="hidden" name="tertiary" value="{{$pkp->tertiary}}"><tr><th width="35%">Teriery information</th><th>:</th><td style="border:none;"><?php $tertiary = []; foreach ($pkp1 as $key => $data) If (!$tertiary || !in_array($data->tertiary, $tertiary)) { $tertiary += array( $key => $data->tertiary ); 
                              if($data->revisi!=$pkp->revisi){  echo" <s><font color='#ffa2a2'>$data->tertiary<br></font></s>";  } if($data->revisi==$pkp->revisi){ echo" $data->tertiary<br>"; } }  ?></td></tr>
                            @endif
                          </table>
												</td>
                      </tr>
                      <tr>
                        <th>Food Category (BPOM)</th>
                        <td colspan="2">
                        @if($pkp->bpom!=NULL && $pkp->kategori_bpom!=NULL)
                        <input type="hidden" name="bpom" value="{{$pkp->katpangan->no_kategori}}"><input type="hidden" name="olahan" value="{{$pkp->katpangan->pangan}}"><input type="hidden" name="kategori_bpom" value="{{$pkp->kategori_bpom}}">
                        <?php $pangan = []; foreach ($pkp2 as $key => $data) If (!$pangan || !in_array($data->katpangan, $pangan)) { $pangan += array( $key => $data->katpangan );  
                        if($data->revisi==$pkp->revisi){ echo "(".$data->katpangan->no_kategori .") ". $data->katpangan->pangan." <br>"; } }  ?>  @endif
                        </td>
                      </tr>
                      <tr>
                        <th>AKG</th>
                        <td>
                          @if($pkp->akg!=NULL)
                          <input type="hidden" name="akg" value="{{$pkp->tarkon->tarkon}}"><?php $tarkon = []; foreach ($pkp2 as $key => $data) If (!$tarkon || !in_array($data->tarkon, $tarkon)) { $tarkon += array( $key => $data->tarkon ); 
                          if($data->revisi==$pkp->revisi){ echo"". $data->tarkon->tarkon."<br>"; } }  ?>@endif
                        </td>
                      </tr>
                      <tr class="table-highlight">
                        <th>Prefered Flavour</th>
                        <td colspan="2">
                        <input type="hidden" name="prefered_flavour" value="{{$pkp->prefered_flavour}}"><?php $prefered_flavour = []; foreach ($pkp2 as $key => $data) If (!$prefered_flavour || !in_array($data->prefered_flavour, $prefered_flavour)) { $prefered_flavour += array( $key => $data->prefered_flavour ); 
                        if($data->revisi!=$pkp->revisi){  echo" <s><font color='#ffa2a2'>$data->prefered_flavour<br></font></s>";  } if($data->revisi==$pkp->revisi){ echo" $data->prefered_flavour<br>"; } }  ?></td>
                      </tr>
                      <tr>
                        <th>Product Benefits</th>
                        <td colspan="2">
                          <input type="hidden" name="product_benefits" value="{{$pkp->product_benefits}}"><?php $product_benefits = []; foreach ($pkp2 as $key => $data) If (!$product_benefits || !in_array($data->product_benefits, $product_benefits)) { $product_benefits += array( $key => $data->product_benefits ); 
                          if($data->revisi!=$pkp->revisi){  echo" <s><font color='#ffa2a2'>$data->product_benefits<br></font></s>";  } if($data->revisi==$pkp->revisi){ echo" $data->product_benefits<br>"; } }  ?><br>
                          <table class="table table-bordered table-hover" id="table">
        					          <tbody>
                              <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                                <td class="text-center">Komponen</td>
                                <td class="text-center">Klaim</td>
                                <td class="text-center">Detail</td>
                                <td class="text-center">Information</td>
                              </tr>
                              @foreach($dataklaim as $data)
                              <tr>
                                <td>
                                  <?php $komponen = []; foreach ($dataklaim as $key => $data) If (!$komponen || !in_array($data->datakp->komponen, $komponen)) { $komponen += array( $key => $data->datakp->komponen ); 
                                  if($data->revisi!=$pkp->revisi){ echo" <s><font color='#ffa2a2'>".$data->datakp->komponen."<br></font></s>"; } if($data->revisi==$pkp->revisi){ echo"". $data->datakp->komponen."<br>"; } }  ?>
                                </td>
                                <td>
                                  <?php $klaim = []; foreach ($dataklaim as $key => $data) If (!$klaim || !in_array($data->klaim, $klaim)) { $klaim += array( $key => $data->klaim );
                                  if($data->revisi!=$pkp->revisi){ echo" <s><font color='#ffa2a2'>".$data->klaim."<br></font></s>"; } if($data->revisi==$pkp->revisi){ echo"". $data->klaim."<br>"; } }  ?>
                                </td>
                                <td>
                                  <?php $detail = []; foreach ($datadetail as $key => $data) If (!$detail || !in_array($data->datadl->detail, $detail)) { $detail += array( $key => $data->datadl->detail );
                                  if($data->revisi!=$pkp->revisi){ echo" <s><font color='#ffa2a2'>".$data->datadl->detail."<br></font></s>"; } if($data->revisi==$pkp->revisi){ echo"". $data->datadl->detail."<br>"; } }  ?>
                                </td>
                                <td>
                                  <?php $note = []; foreach ($dataklaim as $key => $data) If (!$note || !in_array($data->note, $note)) { $note += array( $key => $data->note );
                                  if($data->revisi!=$pkp->revisi){ echo" <s><font color='#ffa2a2'>".$data->note."<br></font></s>"; } if($data->revisi==$pkp->revisi){ echo"". $data->note."<br>"; } }  ?>
                                </td>
                              </tr>
                              @endforeach
                            </tbody>
      					          </table>
												</td>
                      </tr>
                      <tr>
                        <th>Serving Suggestion</th>
                        <input type="hidden" name="serving_suggestion" value="{{$pkp->serving_suggestion}}"><td colspan="2"><?php $serving = []; foreach ($pkp2 as $key => $data) If (!$serving || !in_array($data->serving_suggestion, $serving)) { $serving += array( $key => $data->serving_suggestion ); 
                        if($data->revisi!=$pkp->revisi){ echo" <s><font color='#ffa2a2'>$data->serving_suggestion<br></font></s>"; } if($data->revisi==$pkp->revisi){ echo" $data->serving_suggestion<br>"; } }  ?></td>
                      </tr>
                      <tr>
                        <th>Mandatory Ingredients</th>
                        <input type="hidden" name="mandatory_ingredient" value="{{$pkp->mandatory_ingredient}}"><td colspan="2"><?php $mandatory_ingredient = []; foreach ($pkp2 as $key => $data) If (!$mandatory_ingredient || !in_array($data->mandatory_ingredient, $mandatory_ingredient)) { $mandatory_ingredient += array( $key => $data->mandatory_ingredient ); 
                        if($data->revisi!=$pkp->revisi){ echo" <s><font color='#ffa2a2'>$data->mandatory_ingredient<br></font></s>"; } if($data->revisi==$pkp->revisi){ echo" $data->mandatory_ingredient<br>"; } }  ?></td>
                      </tr>
                      <tr>
                        <th>Related Picture</th>
                        <td colspan="2">
                          <table class="table table-bordered">
                            <tr class="text-center" style="font-weight: bold;color:white;background-color: #2a3f54;">
                              <td class="text-center">Filename</td>
                              <td class="text-center">Information</td>
                              <td class="text-center"></td>
                            </tr>
                            @foreach($picture as $pic)
                            <tr>
                              <td>{{$pic->filename}} </td>
                              <td width="40%"> &nbsp{{$pic->informasi}}</td>  
                              <td width="10%" class="text-center"> <a href="{{asset('data_file/'.$pic->filename)}}" class="btn btn-warning btn-sm" download="{{$pic->filename}}" title="Download file"><li class="fa fa-download"></li></a></td>
                            </tr>
                            @endforeach
                          </table>
                        </td>
                      </tr>
                    </table>
                    @endif
                    @endforeach
								</div>
							</div>
            </div>
        	</div>
          </form>
				</div>
    	</div>
    </div>
	</div>
</div>
@endsection
@section('s')
<script>
  var banding = 1;
  var type =document.getElementById("type").value;
  var status =document.getElementById("status").value;
  var hasil = type == banding;
  var sent = status == 'sent';
  var proses = status == 'revisi';

    console.log(status);
  if(hasil == true){
    if(sent == true){
      let formData = new FormData(document.forms.person);
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "http://baf-staging-x2:9080/api/create");
      xhr.send(formData);
      xhr.onload = () => alert(xhr.response);
    }  
    if(proses == true){
      let formData = new FormData(document.forms.person);
      let xhr = new XMLHttpRequest();
      xhr.open("POST","http://baf-staging-x2:9080/api/update");
      xhr.send(formData);
      xhr.onload = () => alert(xhr.response);
    }  
  }
</script>
@endsection