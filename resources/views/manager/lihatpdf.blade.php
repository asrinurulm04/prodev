@extends('manager.tempmanager')
@section('title', 'data PDF')
@section('judul', 'Data PDF')
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
            @foreach($pdf as $pdf)
            <?php $last = Date('j-F-Y'); ?>
              <a class="btn btn-danger btn-sm" href="{{ route('daftarpdf',$pdf->id_project_pdf)}}"><i class="fa fa-share"></i> Back</a>
              <a class="btn btn-warning btn-sm" onclick="return confirm('Print this data PDF ?')" href="{{ Route('downloadpdf',['id_project_pdf' => $pdf->id_project_pdf, 'revisi' => $pdf->revisi, 'turunan' => $pdf->turunan]) }}"><li class="fa fa-print"></li> Download/print PDF</a>
              
              @if($hitung==0)
						    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#ajukan{{ $pdf->id_project_pdf  }}"><i class="fa fa-comments-o"></i> Sent Revision request</a></button>
                <!-- Modal -->
                <div class="modal" id="ajukan{{ $pdf->id_project_pdf  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">                 
                        <h3 class="modal-title text-left" id="exampleModalLabel">Sent Revision request
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button></h3>
                      </div>
                      <div class="modal-body">
                      <form class="form-horizontal form-label-left" method="POST" action="{{ Route('pengajuanpdf')}}" novalidate>
                        <div class="form-group row">
                          <input type="hidden" value="{{$pdf->id_project_pdf}}" name="pdf">
                          <input type="hidden" value="{{$pdf->turunan}}" name="turunan">
                          <label class="control-label text-bold col-md-2 col-sm-3 col-xs-12 text-center">Destination</label>
                          <div class="col-md-9 col-sm-9 col-xs-12">
                            <select name="penerima" class="form-control form-control-line" id="penerima">
                              <option disabled selected>--> Select One <--</option>
                              <option value="5">PV</option>
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
                          <label class="control-label text-bold col-md-2 col-sm-3 col-xs-12 text-center">request Priority</label>
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

              @if(Auth::user()->departement->dept!='RKA')
                @if($pdf->status_terima=='proses')
                  <form class="form-horizontal form-label-left" method="POST" action="{{ route('approvepdf1',$pdf->id_project_pdf) }}" novalidate>
                    <input type="hidden" value="{{$last}}" name="tgl">
                    <button type="submit" class="btn btn-dark btn-sm"><li class="fa fa-check"></li> Approve data</button>
                    {{ csrf_field() }}
                  </form>
                @elseif($pdf->status_terima=='terima')
                  <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#kirim{{ $pdf->id_project_pdf  }}"><i class="fa fa-paper-plane"></i> Assign</a></button>
                  <!-- Modal -->
                  <div class="modal" id="kirim{{ $pdf->id_project_pdf  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">                 
                          <h3 class="modal-title text-left" id="exampleModalLabel">Sent Data
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button></h3>
                        </div>
                        <div class="modal-body">
                          <form class="form-horizontal form-label-left" method="POST" action="{{ Route('eedituser',$pdf->id_project_pdf)}}" novalidate>
                          <div class="form-group row">
                            <label class="control-label text-bold col-md-2 col-sm-3 col-xs-12 text-center"> User</label>
                            @if(Auth::user()->departement->dept!="RKA")
                            @if($pdf->userpenerima2!='NULL')
                            <input type="hidden" value="{{$pdf->userpenerima2}}" name="user2">
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
                              @if($pdf->userpenerima!='NULL')
                              <input type="hidden" value="{{$pdf->userpenerima}}" name="user">
                              @endif
                              <div class="col-md-9 col-sm-9 col-xs-12">
                                <select name="user2" class="form-control form-control-line" id="user2">
                                  <option disabled selected>--> select One <--</option>
                                  @foreach($user as $user)
                                    @if($user->id!=Auth::user()->id)
                                    <option required value="{{$user->id}}">{{ $user->name }}</option>
                                    @endif
                                  @endforeach
                                </select>
                              </div>
                              @endif
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
              @elseif(Auth::user()->departement->dept=='RKA')
                  @if($pdf->status_terima2=='proses')
                  <form class="form-horizontal form-label-left" method="POST" action="{{ route('approvepdf2',$pdf->id_project_pdf) }}" novalidate>
                    <input type="hidden" value="{{$last}}" name="tgl">
                    <button type="submit" class="btn btn-dark btn-sm"><li class="fa fa-check"></li> Approve data</button>
                    {{ csrf_field() }}
                  </form>
                @elseif($pdf->status_terima2=='terima')
                  <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#kirim{{ $pdf->id_project_pdf  }}"><i class="fa fa-paper-plane"></i> Assign</a></button>
                  <!-- Modal -->
                  <div class="modal" id="kirim{{ $pdf->id_project_pdf  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">                 
                          <h3 class="modal-title text-left" id="exampleModalLabel">Sent Data
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button></h3>
                        </div>
                        <div class="modal-body">
                          <form class="form-horizontal form-label-left" method="POST" action="{{ Route('eedituser',$pdf->id_project_pdf)}}" novalidate>
                          <div class="form-group row">
                            <label class="control-label text-bold col-md-2 col-sm-3 col-xs-12 text-center"> User</label>
                            @if(Auth::user()->departement->dept!="RKA")
                            @if($pdf->userpenerima2!='NULL')
                            <input type="hidden" value="{{$pdf->userpenerima2}}" name="user2">
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
                              @if($pdf->userpenerima!='NULL')
                              <input type="hidden" value="{{$pdf->userpenerima}}" name="user">
                              @endif
                              <div class="col-md-9 col-sm-9 col-xs-12">
                                <select name="user2" class="form-control form-control-line" id="user2">
                                  <option disabled selected>--> select One <--</option>
                                  @foreach($user as $user)
                                  <option value="{{$user->id}}">{{ $user->name }}</option>
                                  @endforeach
                                </select>
                              </div>
                              @endif
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
              @endif
              
          </div> 
          <div class="tab-content panel ">
            <div class="tab-pane active" id="1">
              @php $no = 0; @endphp 
              <div class="panel-default">	
								<div class="panel-body badan">
                  <table class="table table-bordered" style="font-size:12px">
                    <thead style="background-color:#e22b3c;font-weight: bold;color:white;font-size: 20px;">
                      <tr><th style="width:5%" class="text-center">PRODUCT DEVELOPMENT FORM</th></tr>
                      <tr><th style="width:5%" class="text-center">( PDF )</th></tr>
                    </thead>
									</table>
									<center> <h2 style="font-weight: bold;">[ {{ $pdf->id_brand }} ] &reg;</h2> </center>
      						<hr style="color:black;">
                  <div class="row">
                    <div class="col-sm-6">
                      <table ALIGN="left">
    								    <tr><th class="text-left" width="20%">Revision Number</th> <th>&nbsp:</th> <th> {{$pdf->revisi}}.{{$pdf->turunan}}</th></tr>
    								    <tr><th class="text-left">PDF Number</th><th>&nbsp:</th> <th> {{$pdf->pdf_number}}.{{$pdf->ket_no}}</th></tr>
    								    <tr><th class="text-left">Type</th><th>&nbsp:</th> <th> {{$pdf->datapdf->type->type}}</th></tr>
                      </table>
                    </div>
                    <div class="col-sm-6">
									    <table ALIGN="right">
    								    <tr><th class="text-left">Author </th><th>: {{$pdf->datapdf->author1->name}}</th></tr>
										    <tr><th class="text-left">Created date</th> <th>: {{$pdf->created_date}}</th></tr>
										    <tr><th class="text-left">Last Upadate On</th> <th>: {{$pdf->last_update}}</th></tr>
										    <tr><th class="text-left">Last Sent</th> <th>: {{$pdf->tgl_kirim}}</th></tr>
                        <tr><th class="text-left">Revised By</th><th> : {{$pdf->perevisi2->name}}</th></tr>
                        <tr><th class="text-left">Country</th><th>: {{ $pdf->country }}</th></tr>
                        <tr><th class="text-left">Reference Regulation</th><th>: {{ $pdf->reference }}</th></tr>
  								    </table>
                    </div><br>
                    <div  class="col-sm-12">
                    <table width="100%" class="table table-bordered">
                        <thead>
                          <tr style="background-color:grey;font-weight: bold;color:white;font-size: 15px;"><td colspan="2" class="text-center">{{$pdf->project_name}}</td></tr>
                          <tr>
                            <td>Target market</td>
                            <td colspan="2">
													  <table>
                              <tr><th>Age </th><th>&nbsp :</th><td><?php $dariusia = []; foreach ($pdf1 as $key => $data) If (!$dariusia || !in_array($data->dariusia, $dariusia)) { $dariusia += array( $key => $data->dariusia );
                              if($data->revisi!=$pdf->revisi){ echo" <s><font color='#ffa2a2'>$data->dariusia To $data->sampaiusia </font><br></s>"; } if($data->revisi==$pdf->revisi){ echo"$data->dariusia To $data->sampaiusia<br>"; } }?></td></tr>
													    <tr><th>SES </th><th>&nbsp :</th><td><?php $ses = []; foreach ($datases as $key => $data) If (!$ses || !in_array($data->ses, $ses)) { $ses += array( $key => $data->ses );if($data->revisi!=$pdf->revisi){
                              echo" <s><font color='#ffa2a2'>$data->ses </font><br></s>"; } if($data->revisi==$pdf->revisi){ echo" $data->ses <br>";} } ?></td></tr>
														  <tr><th>Gender </th><th>&nbsp :</th><td><?php $gender = []; foreach ($pdf1 as $key => $data) If (!$gender || !in_array($data->gender, $gender)) { $gender += array( $key => $data->gender );
                              if($data->revisi!=$pdf->revisi){ echo"<s><font color='#ffa2a2'> $data->gender </font><br></s>"; }  if($data->revisi==$pdf->revisi){  echo" $data->gender <br>";} }  ?></td></tr>
													    <tr><th>Other</th><th>&nbsp :</th><td><?php $other = []; foreach ($pdf1 as $key => $data) If (!$other || !in_array($data->other, $other)) { $other += array( $key => $data->other );
                              if($data->revisi!=$pdf->revisi){ echo"<s><font color='#ffa2a2'>".$data->other ."</font><br></s>"; } if($data->revisi==$pdf->revisi){ echo"$data->other <br>"; } }?></td></tr>
                            </table>
												    </td>
                          </tr>
                          <tr>
                            <td>Background / Insight</td>
                            <td><?php $background = []; foreach ($pdf1 as $key => $data) If (!$background || !in_array($data->background , $background )) { $background += array( $key => $data->background );
                            if($data->revisi!=$pdf->revisi){ echo" <s><font color='#ffa2a2'>$data->background <br></font></s>"; } if($data->revisi==$pdf->revisi){ echo"$data->background <br>"; } }?></td>
                          </tr>
                          <tr>
                            <td>Attracttiveness</td>
                            <td colspan="2"><?php $attractiveness = []; foreach ($pdf1 as $key => $data) If (!$attractiveness || !in_array($data->attractiveness, $attractiveness)) { $attractiveness += array( $key => $data->attractiveness );
                            if($data->revisi!=$pdf->revisi){ echo"<s><font color='#ffa2a2'>$data->attractiveness <br></font></s>"; } if($data->revisi==$pdf->revisi){ echo"$data->attractiveness <br>";} }  ?></td>
                          </tr>
                          <tr>
                            <td>Target RTO</td>
                            <td colspan="2"><?php $rto = []; foreach ($pdf1 as $key => $data) If (!$rto || !in_array($data->rto, $rto)) { $rto += array( $key => $data->rto );
                            if($data->revisi!=$pdf->revisi){ echo"<s><font color='#ffa2a2'>$data->rto <br></font></s>"; } if($data->revisi==$pdf->revisi){ echo"$data->rto <br>"; } } ?></td>
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
                              
                              @if($hitungkemaspdf>=0)
                              <table class="table table-bordered">
                                <thead>
                                  <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                                    <th class="text-center">Oracle</th>
                                    <th class="text-center">KK Code</th>
                                    <th class="text-center">Note</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach($kemaspdf as $kf)
                                  <tr>
                                    <td>{{$kf->oracle}}</td>
                                    <td>{{$kf->kk}}</td>
                                    <td>{{$kf->information}}</td>
                                  </tr>
                                  @endforeach
                                </tbody>
                              </table>
                              @endif
                            </td>
											    </tr>
                          <tr>
                            <td>Competitor</td>
                            <td colspan="2">
                              <table>
                                <tr><th>Nama</th><th>&nbsp :</th><td style="border:none;"><?php $name = []; foreach ($pdf1 as $key => $data) If (!$name || !in_array($data->name, $name)) { $name += array( $key => $data->name );
                                if($data->revisi!=$pdf->revisi){ echo"<s><font color='#ffa2a2'> $data->name </font><br></s>"; } if($data->revisi==$pdf->revisi){ echo" $data->name <br>"; } } ?></td></tr>
													      <tr><th>What's Special</th><th>&nbsp :</th><td style="border:none;"><?php $special = []; foreach ($pdf1 as $key => $data) If (!$special || !in_array($data->special, $special)) { $special += array( $key => $data->special );
                                if($data->revisi!=$pdf->revisi){ echo" <s><font color='#ffa2a2'> $data->special <br></font></s>"; } if($data->revisi==$pdf->revisi){ echo" $data->special <br>"; } } ?></tr>
													    </table>
												    </td>
                          </tr>
                          <tr>
                            <td>Product Concept</td>
                            <td colspan="2">
													    <table>
                                <tr><th>Weight/Serving </th><th>&nbsp :</th><td style="border:none;"><?php $wight = []; foreach ($pdf1 as $key => $data) If (!$wight || !in_array($data->wight, $wight)) { $wight += array( $key => $data->wight );
                                if($data->revisi!=$pdf->revisi){ echo"<s><font color='#6594c5'> $data->wight<br></font></s>"; } if($data->revisi==$pdf->revisi){ echo" $data->wight"; } } ?> /
                                <?php $serving = []; foreach ($pdf1 as $key => $data) If (!$serving || !in_array($data->serving, $serving)) { $serving += array( $key => $data->serving );
                                if($data->revisi!=$pdf->revisi){ echo"<s><font color='#6594c5'>$data->serving<br></font></s>"; } if($data->revisi==$pdf->revisi){ echo"$data->serving"; } } ?></td></tr>
														    <tr><th>Claim / function</th><th>&nbsp :</th><td style="border:none;"><?php $claim = []; foreach ($pdf1 as $key => $data) If (!$claim || !in_array($data->claim, $claim)) { $claim += array( $key => $data->claim );
                                if($data->revisi!=$pdf->revisi){ echo"<s><font color='#ffa2a2'> $data->claim <br></font></s>"; } if($data->revisi==$pdf->revisi){ echo"  $data->claim <br>"; } } ?></td></tr>
														    <tr><th>Special Ingredient</th><th>&nbsp :</th><td style="border:none;"><?php $ingredient = []; foreach ($pdf1 as $key => $data) If (!$ingredient || !in_array($data->ingredient, $ingredient)) { $ingredient += array( $key => $data->ingredient );
                                if($data->revisi!=$pdf->revisi){ echo"<s><font color='#ffa2a2'> $data->ingredient <br></font></s>"; } if($data->revisi==$pdf->revisi){ echo"  $data->ingredient <br>"; } } ?></td></tr>
													    </table>
												    </td>
                          </tr>
                        </thead>
                      </table>
                    </div>
                  </div>
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