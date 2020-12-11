@extends('pv.tempvv')
@section('title', 'data PKP')
@section('judul', 'Data PKP')
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

<div class="row" >
  <div class="col-md-12 col-sm-12 col-xs-12" >
    <div class="x_panel" >
      <div class="row"  style="margin:20px">
        <div id="exTab2" class="container">
					<div class="col-md-11" align="left">
            @foreach($pkpp as $pkp)
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
                          <h3 class="modal-title text-left" id="exampleModalLabel">Sent Data
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></h3>
                          </button>
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
                                  @if($dept->dept!='RKA')
                                  <option value="{{$dept->id}}"> Manager {{ $dept->dept }} ({{$dept->users->name}})</option>
                                  @endif
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
                          @foreach($picture as $pic)
                            <input type="hidden" value="{{$pic->lokasi}}" name="pic[]" id="pic">
                          @endforeach
                          <input type="hidden" value="{{$nopkp}}" name="nopkp" id="nopkp">
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
                            <label class="control-label text-bold col-md-2 col-sm-3 col-xs-12 text-center">Priority</label>
                            <div class="col-md-1 col-sm-1 col-xs-12">
                              <select name="prioritas" class="form-control form-control-line" id="prioritas" required>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                              </select>
                            </div>
                            <?php $tgl2 = date('Y-m-d', strtotime('+30 days')); ?>
                            <label class="control-label text-bold col-md-2 col-sm-3 col-xs-12 text-center">sample deadline</label>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                              <input type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" name="jangka" id="jangka" placeholder="start date">
                            </div>
                            <div class="col-md-1 col-sm-1 col-xs-12"><center> To </center></div>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                              <input type="date" class="form-control" value="{{$tgl2}}" name="waktu" id="waktu" placeholder="end date">
                            </div>
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
                          <form class="form-horizontal form-label-left" method="POST" action="{{ url('emailpkp',['id_pkp' => $pkp->id_pkp, 'revisi' => $pkp->revisi, 'turunan' => $pkp->turunan]) }}" novalidate>
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
                            <div class="col-md-3 col-sm-10 col-xs-12">
                            <input type="text" readonly class="form-control " value="{{auth()->user()->email}}" name="pengirim" id="pengirim">
                            </div>
                            <div class="col-md-3 col-sm-10 col-xs-12">
                            <input type="text" class="form-control" readonly value="{{$pkp->datapkpp->author1->email}}" name="pengirim1" id="pengirim1">
                            </div>
                            <div class="col-md-3 col-sm-10 col-xs-12">
                            @if($pkp->perevisi!=NULL)<input type="text" readonly class="form-control " value="{{$pkp->perevisi2->email}}" name="pengirim2" id="pengirim2">@endif
                            </div>
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
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></h3>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form class="form-horizontal form-label-left" method="POST" action="{{ Route('sentpkp',['id_pkp' => $pkp->id_pkp, 'revisi' => $pkp->revisi, 'turunan' => $pkp->turunan])}}" novalidate>
                          <div class="form-group row">
                            <label class="control-label text-bold col-md-2 col-sm-3 col-xs-12 text-center">Dept Product</label>
                            <div class="col-md-4 col-sm-9 col-xs-12">
                              <select name="kirim" class="form-control form-control-line" id="kirim">
                                <option readonly value="{{$pkp->tujuankirim}}" selected>{{$pkp->departement->dept}}</option>
                                @foreach($dept1 as $dept)
                                @if($dept->Divisi=='RND')
                                <option value="{{$dept->id}}"> Manager {{ $dept->dept }} ({{$dept->users->name}})</option>
                                @endif
                                @endforeach
                              </select>
                            </div>
                            <?php $last = Date('j-F-Y'); ?>
                            <input id="date" value="{{ $last }}" class="form-control col-md-12 col-xs-12" name="date" required="required" type="hidden" readonly>
                            <input type="hidden" value="{{$pkp->project_name}}" name="name" id="name">
                            <label class="control-label text-bold col-md-2 col-sm-3 col-xs-12 text-center">Dept Product</label>
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
                            <div class="col-md-3 col-sm-3 col-xs-12">
                              <input type="date" class="form-control" value="{{$pkp->jangka}}" name="jangka" id="jangka" placeholder="start date">
                            </div>
                            <div class="col-md-1 col-sm-1 col-xs-12"><center> To </center></div>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                              <input type="date" class="form-control" value="{{$pkp->waktu}}" name="waktu" id="waktu" placeholder="end date">
                            </div>
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
              @elseif($pkp->status_pkp!='draf')
                @if(auth()->user()->role->namaRule === 'pv_lokal' || auth()->user()->role->namaRule === 'marketing')
                  @if($pkp->status_data=='active')
                    <a class="btn btn-info btn-sm" onclick="return confirm('Up PKP Version ?')" href="{{Route('naikversipkp',['id_project' => $pkp->id_project, 'revisi' => $pkp->revisi, 'turunan' => $pkp->turunan])}}"><i class="fa fa-arrow-up" onclick="return confirm('Up PKP Version ?')"></i> Edit And Up Version</a>
                  @endif
                @endif
              @endif
              <a class="btn btn-warning btn-sm" onclick="return confirm('Print this data PKP ?')" href="{{ Route('download',['id_pkp' => $pkp->id_pkp, 'revisi' => $pkp->revisi, 'turunan' => $pkp->turunan]) }}"><i class="fa fa-print"></i> Download/print PKP</a>
					</div><br><br>
          <div  class="tab-content panel ">
            <div class="tab-pane active" id="1">
              @php $no = 0; @endphp
              <div class="panel-default">
								<div class="panel-body badan" >
									<label>PT. NUTRIFOOD INDONESIA</label>
										<center> <h2 style="font-size: 22px;font-weight: bold;">PENGEMBANGAN KONSEP AWAL PRODUK BARU</h2> </center>
  									<center> <h2 style="font-size: 20px;font-weight: bold;">( PKP )</h2> </center><br>
										<center> <h2 style="font-weight: bold;">[ {{ $pkp->id_brand }} ] &reg;</h2> </center>
      							<table class="table table-bordered" style="font-size:12px">
                      <thead style="background-color:#13699a;font-weight: bold;color:white;font-size: 20px;">
                        <tr>
                          <th style="width:5%" class="text-center">{{ $pkp->project_name }}</th>
                        </tr>
                      </thead>
                    </table>
                    <div class="row">
                      <div class="col-sm-6">
                        <table ALIGN="left">
                          <tr><th class="text-left">Revision Number</th> <th> : {{$pkp->revisi}}.{{$pkp->turunan}}</th></tr>
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
                      <tr>
                        <th colspan="3" class="text-center"><span style="font-weight: bold;font-size: 20px;" class="card-title">Background</span></th>
                      </tr>
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
                      <tr>
                        <th colspan="3" class="text-center"><span style="font-weight: bold;font-size: 20px;" class="card-title">Market Analysis</span></th>
                      </tr>
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
                        <td colspan="2">
                          <table class="table table-bordered table-hover">
                            <thead>
                              <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                                <th>Forecash</th>
                                <th>Configuration</th>
                                <th colspan="2">UOM</th>
                                <th>NFI Price</th>
                                <th>Costumer Price</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($for as $for)
                              <tr>
                                <td>{{$for->satuan}} = {{$for->forecast}}</td>
                                <td>
                                @if($for->kemas_eksis!=NULL)
                                (
                                @if($for->kemas->tersier!=NULL)
                                {{ $for->kemas->tersier }}{{ $for->kemas->s_tersier }}
                                @elseif($for->tersier==NULL)
                                @endif

                                @if($for->kemas->sekunder1!=NULL)
                                X {{ $for->kemas->sekunder1 }}{{ $for->kemas->s_sekunder1}}
                                @elseif($for->kemas->sekunder1==NULL)
                                @endif

                                @if($for->kemas->sekunder2!=NULL)
                                X {{ $for->kemas->sekunder2 }}{{ $for->kemas->s_sekunder2 }}
                                @elseif($for->sekunder2==NULL)
                                @endif

                                @if($for->kemas->primer!=NULL)
                                X{{ $for->kemas->primer }}{{ $for->kemas->s_primer }}
                                @elseif($for->kemas->primer==NULL)
                                @endif
                                )
                                @endif
                                </td>
                                <td>{{$for->jlh_uom}}</td>
                                <td>{{$for->uom}}</td>
                                <td>{{$for->nfi_price}}</td>
                                <td>{{$for->costumer}}</td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
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
                        if($data->turunan!=$pkp->turunan){ echo" <s><font color='#6594c5'>$data->product_form<br></font></s>"; } if($data->turunan==$pkp->turunan){ echo" $data->product_form<br>"; } }  ?>
                        <br><br>
                        <?php $remarks_product_form = []; foreach ($pkp1 as $key => $data) If (!$remarks_product_form || !in_array($data->remarks_product_form, $remarks_product_form)) { $remarks_product_form += array( $key => $data->remarks_product_form  ); 
                          if($data->turunan!=$pkp->turunan){ echo"Remarks : <s><font color='#6594c5'>$data->remarks_product_form<br></font></s>"; } if($data->turunan==$pkp->turunan){ echo"Remarks: $data->remarks_product_form<br>"; } }  ?></td>
                      </tr>
                      <tr>
                      <tr>
                        <th>Food Category (BPOM)</th>
                        @if($pkp->bpom!=NULL && $pkp->kategori_bpom!=NULL)
                        <td colspan="2"><?php $pangan = []; foreach ($pkp1 as $key => $data) If (!$pangan || !in_array($data->katpangan, $pangan)) { $pangan += array( $key => $data->katpangan );  
                        if($data->turunan==$pkp->turunan){ echo "(".$data->katpangan->no_kategori .") ". $data->katpangan->pangan ." <br>"; } }  ?>  
                        <br></td>@endif
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
													<table>
                            <?php $product_benefits= []; foreach ($pkp1 as $key => $data) If (!$product_benefits|| !in_array($data->product_benefits, $product_benefits)) { $product_benefits+= array( $key => $data->product_benefits ); 
                              if($data->turunan!=$pkp->turunan){ echo" <s><font color='#6594c5'>$data->product_benefits <br></font></s>"; } if($data->turunan==$pkp->turunan){ echo" $data->product_benefits<br>"; } }  ?>
                          </table><br>
                          <table class="Table table-bordered" >
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

                    </table>
                    @else
                    <table class=" table table-bordered">
                      <tr>
                        <th colspan="3" class="text-center"><span style="font-weight: bold;font-size: 20px;" class="card-title">Background</span></th>
                      </tr>
                      <tr>
                        <th width="300px">Idea</th>
                        <td colspan="2"> <?php $ideas = []; foreach ($pkp2 as $key => $data) If (!$ideas || !in_array($data->idea, $ideas)) {$ideas += array($key => $data->idea);
                        if($data->revisi!=$pkp->revisi){ echo" <s><font color='#ffa2a2'>$data->idea<br></font></s>"; }if($data->revisi==$pkp->revisi){ echo" $data->idea<br>"; } } ?></td>
                      </tr>
                      <tr>
                        <th>Target market</th>
                        <td colspan="2">
													<table>
	
                            <tr><th style="border:none;">Gender </th><td style="border:none;"> 
                            <?php $dataG = []; foreach ($pkp2 as $key => $data) If (!$dataG || !in_array($data->gender, $dataG)) { $dataG += array( $key => $data->gender );if($data->revisi!=$pkp->revisi){
                            echo": <s><font color='#ffa2a2'>$data->gender<br></font></s>"; } if($data->revisi==$pkp->revisi){ echo": $data->gender <br>"; } } ?></td></tr>
														
                            <tr><th style="border:none;">Usia </th><td style="border:none;"> 
                            <?php $dariumur = []; foreach ($pkp2 as $key => $data) If (!$dariumur || !in_array($data->dariumur, $dariumur)) { $dariumur += array( $key => $data->dariumur ); if($data->revisi!=$pkp->revisi){
                            echo": <s><font color='#ffa2a2'>$data->dariumur - $data->sampaiumur<br></font></s>";} if($data->revisi==$pkp->revisi){ echo": $data->dariumur - $data->sampaiumur <br>";} } ?> </td></tr>
														
                            <tr><th style="border:none;">SES </th><td style="border:none;"> 
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
                        <td colspan="2"><?php $Uniqueness = []; foreach ($pkp2 as $key => $data) If (!$Uniqueness || !in_array($data->Uniqueness, $Uniqueness)) { $Uniqueness += array( $key => $data->Uniqueness ); 
                        if($data->revisi!=$pkp->revisi){ echo" <s><font color='#ffa2a2'>$data->Uniqueness <br></font></s>"; } if($data->revisi==$pkp->revisi){ echo" $data->Uniqueness <br>";} } ?></td>
                      </tr>
                      <tr>
                      <th>Estimated potential market</th>
                        <td colspan="2"><?php $Estimated = []; foreach ($pkp2 as $key => $data) If (!$Estimated || !in_array($data->Estimated, $Estimated)) {  $Estimated += array(  $key => $data->Estimated ); 
                        if($data->revisi!=$pkp->revisi){ echo" <s><font color='#ffa2a2'>$data->Estimated <br></font></s>"; } if($data->revisi==$pkp->revisi){ echo" $data->Estimated <br>"; } } ?></td>
                      </tr>
                      <tr class="table-highlight">
                        <th>Reason(s)</th>
                        <td colspan="2"><?php $reason = []; foreach ($pkp2 as $key => $data) If (!$reason || !in_array($data->reason, $reason)) { $reason += array( $key => $data->reason ); 
                        if($data->revisi!=$pkp->revisi){ echo" <s><font color='#ffa2a2'>$data->reason<br></font></s>";} if($data->revisi==$pkp->revisi){ echo" $data->reason <br>"; } } ?></td>
                      </tr>
                      <tr>
                        <th colspan="3" class="text-center"><span style="font-weight: bold;font-size: 20px;" class="card-title">Market Analysis</span></th>
                      </tr>
                      <tr>
                        <th>Launch Deadline</th>
                        <td colspan="2">
													<table>
                            <tr>
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
                        <td colspan="2"><?php $aisle = []; foreach ($pkp2 as $key => $data) If (!$aisle || !in_array($data->aisle, $aisle)) { $aisle += array( $key => $data->aisle ); 
                        if($data->revisi!=$pkp->revisi){ echo" <s><font color='#ffa2a2'>$data->aisle<br></font></s>"; } if($data->revisi==$pkp->revisi){ echo" $data->aisle<br>"; } } ?></td>
                      </tr>
                      <tr>
                        <th>Sales Forecast</th>
                        <td colspan="2">
                          <table class="table table-bordered table-hover">
                            <thead>
                              <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                                <th>Forecash</th>
                                <th>Configuration</th>
                                <th colspan="2">UOM</th>
                                <th>NFI Price</th>
                                <th>Costumer Price</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($for as $for)
                              <tr>
                                <td>{{$for->satuan}} = {{$for->forecast}}</td>
                                <td>
                                @if($for->kemas_eksis!=NULL)
                                (
                                @if($for->kemas->tersier!=NULL)
                                {{ $for->kemas->tersier }}{{ $for->kemas->s_tersier }}
                                @elseif($for->tersier==NULL)
                                @endif

                                @if($for->kemas->sekunder1!=NULL)
                                X {{ $for->kemas->sekunder1 }}{{ $for->kemas->s_sekunder1}}
                                @elseif($for->kemas->sekunder1==NULL)
                                @endif

                                @if($for->kemas->sekunder2!=NULL)
                                X {{ $for->kemas->sekunder2 }}{{ $for->kemas->s_sekunder2 }}
                                @elseif($for->sekunder2==NULL)
                                @endif

                                @if($for->kemas->primer!=NULL)
                                X{{ $for->kemas->primer }}{{ $for->kemas->s_primer }}
                                @elseif($for->kemas->primer==NULL)
                                @endif
                                )
                                @endif
                                </td>
                                <td>{{$for->jlh_uom}}</td>
                                <td>{{$for->uom}}</td>
                                <td>{{$for->nfi_price}}</td>
                                <td>{{$for->costumer}}</td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                        </td>
                      </tr>
                      <tr class="table-highlight">
                        <th>Main Competitor</th>
                        <td colspan="2"><?php $competitor = []; foreach ($pkp2 as $key => $data) If (!$competitor || !in_array($data->competitor, $competitor)) {$competitor += array( $key => $data->competitor ); 
                        if($data->revisi!=$pkp->revisi){ echo" <s><font color='#ffa2a2'>$data->competitor <br></font></s>"; } if($data->revisi==$pkp->revisi){ echo" $data->competitor <br>"; } }  ?></td>
                      </tr>
                      <tr class="table-highlight">
                        <th>Competitive Analysis</th>
                        <td colspan="2"><?php $competitive = []; foreach ($pkp2 as $key => $data) If (!$competitive || !in_array($data->competitive, $competitive)) { $competitive += array( $key => $data->competitive ); 
                        if($data->revisi!=$pkp->revisi){ echo" <s><font color='#ffa2a2'>$data->competitive <br></font></s>"; } if($data->revisi==$pkp->revisi){ echo" $data->competitive <br>"; } }  ?></td>
                      </tr>
                      <tr>
                        <th colspan="3" class="text-center"><span style="font-weight: bold;font-size: 20px;" class="card-title">Product features</span></th>
                      </tr>
                      <tr>
                        <th>Product Form</th>
                        <td colspan="2"><?php $product_form = []; foreach ($pkp2 as $key => $data) If (!$product_form || !in_array($data->product_form, $product_form)) { $product_form += array( $key => $data->product_form  ); 
                        if($data->revisi!=$pkp->revisi){ echo":<s><font color='#ffa2a2'>$data->product_form<br></font></s>"; } if($data->revisi==$pkp->revisi){ echo" $data->product_form<br>"; } }  ?>
                        <br><br>
                        <?php $remarks_product_form = []; foreach ($pkp2 as $key => $data) If (!$remarks_product_form || !in_array($data->remarks_product_form, $remarks_product_form)) { $remarks_product_form += array( $key => $data->remarks_product_form  ); 
                        if($data->revisi!=$pkp->revisi){ echo"Remarks : <s><font color='#ffa2a2'>$data->remarks_product_form<br></font></s>"; } if($data->revisi==$pkp->revisi){ echo"Remarks: $data->remarks_product_form<br>"; } }  ?></td>
                      </tr>
                      <tr>
                        <th>Food Category (BPOM)</th>
                        @if($pkp->bpom!=NULL && $pkp->kategori_bpom!=NULL)
                        <td colspan="2"><?php $pangan = []; foreach ($pkp2 as $key => $data) If (!$pangan || !in_array($data->katpangan, $pangan)) { $pangan += array( $key => $data->katpangan );  
                        if($data->revisi==$pkp->revisi){ echo "(".$data->katpangan->no_kategori .") ". $data->katpangan->pangan." <br>"; } }  ?>  
                        <br></td>@endif
                      </tr>
                      <tr>
                        <th>AKG</th>
                        <td>
                          <?php $tarkon = []; foreach ($pkp2 as $key => $data) If (!$tarkon || !in_array($data->tarkon, $tarkon)) { $tarkon += array( $key => $data->tarkon ); 
                          if($data->revisi==$pkp->revisi){ echo"". $data->tarkon->tarkon."<br>"; } }  ?>
                        </td>
                      </tr>
                      <tr class="table-highlight">
                        <th>Prefered Flavour</th>
                        <td colspan="2"><?php $prefered_flavour = []; foreach ($pkp2 as $key => $data) If (!$prefered_flavour || !in_array($data->prefered_flavour, $prefered_flavour)) { $prefered_flavour += array( $key => $data->prefered_flavour ); 
                        if($data->revisi!=$pkp->revisi){  echo" <s><font color='#ffa2a2'>$data->prefered_flavour<br></font></s>";  } if($data->revisi==$pkp->revisi){ echo" $data->prefered_flavour<br>"; } }  ?></td>
                      </tr>
                      <tr>
                        <th>Product Benefits</th>
                        <td colspan="2">
													<table>
                            <?php $product_benefits = []; foreach ($pkp2 as $key => $data) If (!$product_benefits || !in_array($data->product_benefits, $product_benefits)) { $product_benefits += array( $key => $data->product_benefits ); 
                            if($data->revisi!=$pkp->revisi){  echo" <s><font color='#ffa2a2'>$data->product_benefits<br></font></s>";  } if($data->revisi==$pkp->revisi){ echo" $data->product_benefits<br>"; } }  ?>
													</table><br>
                          <table class="table table-bordered table-hover" id="table">
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
                            </tbody>
      					          </table>
												</td>
                      </tr>
                      
                      <tr>
                        <th>Serving Suggestion</th>
                        <td colspan="2"><?php $serving = []; foreach ($pkp2 as $key => $data) If (!$serving || !in_array($data->serving_suggestion, $serving)) { $serving += array( $key => $data->serving_suggestion ); 
                        if($data->revisi!=$pkp->revisi){ echo" <s><font color='#ffa2a2'>$data->serving_suggestion<br></font></s>"; } if($data->revisi==$pkp->revisi){ echo" $data->serving_suggestion<br>"; } }  ?></td>
                      </tr>
                      <tr>
                        <th>Mandatory Ingredients</th>
                        <td colspan="2"><?php $mandatory_ingredient = []; foreach ($pkp2 as $key => $data) If (!$mandatory_ingredient || !in_array($data->mandatory_ingredient, $mandatory_ingredient)) { $mandatory_ingredient += array( $key => $data->mandatory_ingredient ); 
                        if($data->revisi!=$pkp->revisi){ echo" <s><font color='#ffa2a2'>$data->mandatory_ingredient<br></font></s>"; } if($data->revisi==$pkp->revisi){ echo" $data->mandatory_ingredient<br>"; } }  ?></td>
                      </tr>

                    </table>
                    @endif
                    @endforeach
                    <table class="table table-striped table-bordered">
                      <thead>
                        <tr style="background-color:#bfc2c5;"><td class="text-center" colspan="5">ATTENTION</td></tr>
                        <tr><td style="background-color:#ffffff;" width="30%"></td><td style="border:none;background-color:#bfc2c5;"> compulsory; filled by QBX (brand function) Managers</td></tr>
                        <tr><td style="background-color:#13699a;" width="30%"></td><td style="border:none;background-color:#bfc2c5;">should only be filled with great certainty</td></tr>
                        <tr><td style="background-color:#e41356;" width="30%"></td><td style="border:none;background-color:#bfc2c5;"> should only be filled after discussion with QPA</td></tr>
                        <tr><td style="background-color:#bfc2c5;">Service Level Agreements</td>
                        <td style="background-color:#bfc2c5;">
                          <table>
                            <thead>
                              <tr><td style="border:none;">Lead Time QBX (brand function)</td><td style="border:none;">5 workdays</td></tr>
                              <tr><td style="border:none;">Lead Time QPA (product development function)</td><td style="border:none;">[1 (benefits) + 2 (COGS)] = 2 workdays</td></tr>
                              <tr><td style="border:none;">Lead Time Revision </td><td style="border:none;">2 workdays</td></tr>
                            </thead>
                          </table>
                        </td></tr>
                        <tr><td style="background-color:#bfc2c5;">Process</td>
                        <td style="background-color:#bfc2c5;">
                          <table>
                            <thead>
                              <tr><td style="border:none;">After being filled. HOD approval request. Then, forward to RD as low priority project. Will be further</td></tr>
                              <tr><td style="border:none;">prioritized in PV Cross Funct Mtg. </td></tr>
                              <tr><td style="border:none;">Meanwhile, RD can prepare SLA projection to propose into PV's SLA for the project based on</td></tr>
                              <tr><td style="border:none;">capacity and feasibility.</td></tr>
                            </thead>
                          </table>
                        </td></tr>
                      </thead>
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