@extends('pv.tempvv')
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
            <a class="btn btn-danger btn-sm" href="{{ route('rekappdf',$pdf->id_project_pdf)}}"><i class="fa fa-share"></i> Back</a>
            @if($pdf->status_data=="draf")
              @if(auth()->user()->role->namaRule === 'pv_global')
                @if($pdf->approval=='approve')
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#NW{{ $pdf->id_project_pdf  }}"><i class="fa fa-paper-plane"></i> Sent To RND</a></button>
                @endif
                <!-- Modal -->
                <div class="modal" id="NW{{ $pdf->id_project_pdf  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h3 class="modal-title text-left" id="exampleModalLabel">Sent Data
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button></h3>
                      </div>
                      <div class="modal-body">
                        <form class="form-horizontal form-label-left" method="POST" action="{{ Route('eedit',['pdf_id' => $pdf->id_project_pdf, 'revisi' => $pdf->revisi, 'turunan' => $pdf->turunan])}}" novalidate>
                        <div class="form-group row">
                          <label class="control-label text-bold col-md-2 col-sm-2 col-xs-12 text-center">Dept Produk</label>
                          <div class="col-md-4 col-sm-9 col-xs-12">
                            <select name="kirim" class="form-control form-control-line" id="kirim">
                              @foreach($dept as $dept)
                              @if($dept->dept=='RPE')
                              <option value="{{$dept->id}}">{{ $dept->dept }} ({{ $dept->nama_dept }})</option>
                              <option value="1">Not Selected</option>
                              @endif
                              @endforeach
                            </select>
                            <input type="hidden" value="{{$pdf->project_name}}" name="name" id="name">
                            <?php $last = Date('j-F-Y'); ?>
                            <input id="date" value="{{ $last }}" class="form-control col-md-12 col-xs-12" name="date" required="required" type="hidden" readonly>
                          </div>
                          <label class="control-label text-bold col-md-2 col-sm-2 col-xs-12 text-center">Dept Kemas</label>
                          <div class="col-md-4 col-sm-9 col-xs-12">
                            <select name="rka" class="form-control form-control-line" id="rka">
                              <option value="1">RKA</option>
                              <option value="0">Not Selected</option>
                            </select>
                          </div>
                        </div>
                        <input type="hidden" value="{{$nopdf}}" name="nopdf" id="nopdf">
                        <?php $tanggal = Date("Y"); ?>
                        <input type="hidden" value="_{{$tanggal}}/{{$pdf->product_type}}_{{ $pdf->project_name }}_{{ $pdf->revisi }}.{{ $pdf->turunan }}" name="ket_no" id="ket_no">
                        <div class="form-group row">
                          <label class="control-label text-bold col-md-2 col-sm-3 col-xs-12 text-center">Project priority</label>
                          <div class="col-md-2 col-sm-9 col-xs-12">
                            <select name="prioritas" class="form-control form-control-line" id="prioritas">
                              <option value="1">prioritas 1</option>
                              <option value="2">prioritas 2</option>
                              <option value="3">prioritas 3</option>
                            </select>
                          </div>
                          <?php $tgl2 = date('Y-m-d', strtotime('+30 days')); ?>
                          <label class="control-label text-bold col-md-2 col-sm-3 col-xs-12 text-center">sample deadline</label>
                          <div class="col-md-3 col-sm-3 col-xs-12">
                            <input type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" name="jangka" id="jangka" placeholder="start date">
                          </div>
                          <div class="col-md-1 col-sm-1 col-xs-12"><center> To </center></div>
                          <div class="col-md-2 col-sm-2 col-xs-12">
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
              
                @if($pdf->approval!='approve')
                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#approve{{$pdf->id_pdf}}{{$pdf->turunan}}"><i class="fa fa-paper-plane"></i> Request Approval</a></button>
                @endif
                <!-- modal -->
                <div class="modal" id="approve{{$pdf->id_pdf}}{{$pdf->turunan}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h3 class="modal-title text-left" id="exampleModalLabel">Request Approval
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></h3>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form class="form-horizontal form-label-left" method="POST" action="{{ url('emailpdf',['pdf_id' => $pdf->id_project_pdf, 'revisi' => $pdf->revisi, 'turunan' => $pdf->turunan]) }}">
                        <div class="form-group row">
                          <label class="control-label text-bold col-md-1 col-sm-3 col-xs-12 text-center">Email</label>
                          <label class="control-label text-bold col-md-1 col-sm-3 col-xs-12 text-center">To</label>
                          <div class="col-md-9 col-sm-10 col-xs-12">
                            <input required id="email" class="form-control" type="email" name="email">
                            <input type="hidden" value="Pengajuan pdf-{{$pdf->project_name}}" name="judul" id="judul">
                            @foreach($picture as $pic):
                            <input type="hidden" value="{{$pic->lokasi}}" name="pic[]" id="pic" required>
                            @endforeach
                            <label style="color:red;">* Only allowed one E-mail</label>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="control-label text-bold col-md-1 col-sm-3 col-xs-12 text-center"></label>
                          <label class="control-label text-bold col-md-1 col-sm-3 col-xs-12 text-center">Cc</label>
                          <div class="col-md-3 col-sm-10 col-xs-12">
                           <input type="text" class="form-control" name="pengirim2" id="pengirim2" required>
                          </div>
                          <div class="col-md-3 col-sm-10 col-xs-12">
                            <input type="text" class="form-control" readonly value="{{auth()->user()->email}}" name="pengirim" id="pengirim">
                          </div>
                          <div class="col-md-3 col-sm-10 col-xs-12">
                            <input type="text" class="form-control" readonly value="{{$pdf->datapdf->author1->email}}" name="pengirim1" id="pengirim1">
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
            @elseif($pdf->status_data=="revisi")
              @if(auth()->user()->role->namaRule === 'pv_global')
                @if($pdf->approval=='approve')
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#revisi{{ $pdf->id_project_pdf  }}"><i class="fa fa-paper-plane"></i> Sent To RND</a></button>
                @endif
                <!-- Modal -->
                <div class="modal" id="revisi{{ $pdf->id_project_pdf  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h3 class="modal-title text-left" id="exampleModalLabel">Sent PDF
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button></h3>
                      </div>
                      <div class="modal-body">
                        <form class="form-horizontal form-label-left" method="POST" action="{{ Route('sentpdf',['pdf_id' => $pdf->id_project_pdf, 'revisi' => $pdf->revisi, 'turunan' => $pdf->turunan])}}" novalidate>
                        <div class="form-group row">
                          <label class="control-label text-bold col-md-2 col-sm-2 col-xs-12 text-center">Dept Produk</label>
                          <div class="col-md-4 col-sm-9 col-xs-12">
                            <select name="kirim" class="form-control form-control-line" id="kirim">
                              <option value="{{$pdf->tujuankirim}}">{{$pdf->departement->dept}}</option>
                              @foreach($dept1 as $dept)
                              @if($dept->dept=='RPE')
                              <option value="{{$dept->id}}">{{ $dept->dept }} ({{ $dept->nama_dept }})</option>
                              <option value="1"></option>
                              @endif
                              @endforeach
                            </select>
                          </div>
                          <input type="hidden" value="{{$pdf->project_name}}" name="name" id="name">
                          <label class="control-label text-bold col-md-2 col-sm-2 col-xs-12 text-center">Dept Kemas</label>
                          <div class="col-md-4 col-sm-9 col-xs-12">
                            <select name="rka" class="form-control form-control-line" id="rka">
                              <option value="1">RKA</option>
                              <option value="0">Tidak Ada</option>
                            </select>
                          </div>
                        </div>
                        <input type="hidden" value="{{$pdf->pdf_number}}" name="nopdf" id="nopdf">
                        <?php $tanggal = Date("Y"); ?>
                        <input type="hidden" value="_{{$tanggal}}/PDF_{{ $pdf->project_name }}_{{ $pdf->revisi }}.{{ $pdf->turunan }}" name="ket_no" id="ket_no">
                        <div class="form-group row">
                          <label class="control-label text-bold col-md-2 col-sm-3 col-xs-12 text-center">Project priority</label>
                          <div class="col-md-3 col-sm-9 col-xs-12">
                            <select name="prioritas" class="form-control form-control-line" id="prioritas">
                              <option value="{{$pdf->prioritas}}" readonly>
                                @if($pdf->prioritas==1) prioritas 1
                                @elseif($pdf->prioritas==2) prioritas 2
                                @elseif($pdf->prioritas==3) prioritas 3 @endif
                              </option>
                              <option value="1">prioritas 1</option>
                              <option value="2">prioritas 2</option>
                              <option value="3">prioritas 3</option>
                            </select>
                          </div>
                          <label class="control-label text-bold col-md-3 col-sm-3 col-xs-12 text-center">Deadline for sending Sample</label>
                          <div class="col-md-2 col-sm-9 col-xs-12">
                            <input type="date" class="form-control" value="{{$pdf->jangka}}" name="jangka" id="jangka" placeholder="start date">
                          </div>
                          <div class="col-md-2 col-sm-9 col-xs-12">
                            <input type="date" class="form-control" value="{{$pdf->waktu}}" name="waktu" id="waktu" placeholder="end date">
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
            @elseif($pdf->status_data!="draf")
              @if(auth()->user()->role->namaRule === 'pv_global' || auth()->user()->role->namaRule === 'marketing')
                @if($pdf->status_pdf=='active')
                  <a class="btn btn-info btn-sm" onclick="return confirm('Naik Versi PDF ?')" href="{{Route('naikversipdf',['id_project_pdf' => $pdf->id_project_pdf, 'revisi' => $pdf->revisi, 'turunan' => $pdf->turunan])}}"><i class="fa fa-arrow-up"></i> Edit And Up Version</a>
                @endif
              @endif
            @endif
            <a class="btn btn-warning btn-sm" onclick="return confirm('Print this data PDF ?')" href="{{ Route('downloadpdf',['id_project_pdf' => $pdf->id_project_pdf, 'revisi' => $pdf->revisi, 'turunan' => $pdf->turunan]) }}"><li class="fa fa-print"></li> Download/print PDF</a>
          </div>
          <div class="tab-content panel ">
            <div class="tab-pane active" id="1">
              @php $no = 0; @endphp
              <div class="panel-default badan">
								<div class="panel-body badan"  style="background-image:url(img/aul.jpg);">
                  <table class="table table-bordered" style="font-size:12px">
                    <thead style="background-color:#e22b3c;font-weight: bold;color:white;font-size: 20px;">
                      <tr><th style="width:5%" class="text-center">PRODUCT DEVELOPMENT FORM</th></tr>
                      <tr><th style="width:5%" class="text-center">( PDF )</th></tr>
                    </thead>
									</table>
									<center> <h2 style="font-weight: bold;">[ {{ $pdf->id_brand }} ] &reg;</h2> </center><hr style="color:black;">
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
                    <div class="col-sm-12">
                      @if($pdf->status_project=='draf')
                      <table width="100%" class="table table-bordered">
                        <thead>
                          <tr style="background-color:grey;font-weight: bold;color:white;font-size: 15px;"><td colspan="2" class="text-center">{{$pdf->project_name}}</td></tr>
                          <tr>
                            <th>Target market</th>
                            <td colspan="2">
													    <table>
                                <tr><th>Age</th><td><?php $dariusia = []; foreach ($pdf1 as $key => $data) If (!$dariusia || !in_array($data->dariusia, $dariusia)) { $dariusia += array( $key => $data->dariusia );
                                if($data->turunan!=$pdf->turunan){ echo" : <s><font color='#6594c5'>$data->dariusia To $data->sampaiusia </font><br></s>"; } if($data->turunan==$pdf->turunan){ echo" : $data->dariusia To $data->sampaiusia <br>"; } }?></td></tr>
													      <tr><th>SES</th><td><?php $ses = []; foreach ($datases as $key => $data) If (!$ses || !in_array($data->ses, $ses)) { $ses += array( $key => $data->ses );if($data->turunan!=$pdf->turunan){
                                echo" : <s><font color='#6594c5'>$data->ses </font><br></s>"; } if($data->turunan==$pdf->turunan){ echo" : $data->ses <br>";} } ?></td></tr>
														    <tr><th>Gender</th><td><?php $gender = []; foreach ($pdf1 as $key => $data) If (!$gender || !in_array($data->gender, $gender)) { $gender += array( $key => $data->gender );
                                if($data->turunan!=$pdf->turunan){ echo"<s><font color='#6594c5'>  : $data->gender </font><br></s>"; }  if($data->turunan==$pdf->turunan){  echo" : $data->gender <br>";} }  ?></td></tr>
                                <tr><th>Other</th><td><?php $other = []; foreach ($pdf1 as $key => $data) If (!$other || !in_array($data->other, $other)) { $other += array( $key => $data->other );
                                if($data->turunan!=$pdf->turunan){ echo" : <s><font color='#6594c5'>$data->other </font><br></s>"; } if($data->turunan==$pdf->turunan){ echo" : $data->other <br>"; } }?></td></tr>
                              </table>
												    </td>
                          </tr>
                          <tr>
                            <th>Background / Insight</th>
                            <td><?php $background = []; foreach ($pdf1 as $key => $data) If (!$background || !in_array($data->background , $background )) { $background += array( $key => $data->background );
                            if($data->turunan!=$pdf->turunan){ echo" <s><font color='#6594c5'>$data->background </font><br></s>"; } if($data->turunan==$pdf->turunan){ echo"$data->background <br>"; } }?></td>
                          </tr>
                          <tr>
                            <th>Attracttiveness</th>
                            <td colspan="2"><?php $attractiveness = []; foreach ($pdf1 as $key => $data) If (!$attractiveness || !in_array($data->attractiveness, $attractiveness)) { $attractiveness += array( $key => $data->attractiveness );
                            if($data->turunan!=$pdf->turunan){ echo"<s><font color='#6594c5'>$data->attractiveness <br></font></s>"; } if($data->turunan==$pdf->turunan){ echo"$data->attractiveness <br>";} }  ?></td>
                          </tr>
                          <tr>
                            <th>Target RTO</th>
                            <td colspan="2"><?php $rto = []; foreach ($pdf1 as $key => $data) If (!$rto || !in_array($data->rto, $rto)) { $rto += array( $key => $data->rto );
                            if($data->turunan!=$pdf->turunan){ echo"<s><font color='#6594c5'>$data->rto </font><br></s>"; } if($data->turunan==$pdf->turunan){ echo"$data->rto <br>"; } } ?></td>
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
                            <th>Competitor</th>
                            <td colspan="2">
                            <table>
                              <tr><th>Name</th><td style="border:none;"><?php $name = []; foreach ($pdf1 as $key => $data) If (!$name || !in_array($data->name, $name)) { $name += array( $key => $data->name );
                              if($data->turunan!=$pdf->turunan){ echo" : <s><font color='#6594c5'>$data->name <br></font></s>"; } if($data->turunan==$pdf->turunan){ echo" : $data->name <br>"; } } ?></td></tr>
													    <tr><th>What's Special</th><td style="border:none;"><?php $special = []; foreach ($pdf1 as $key => $data) If (!$special || !in_array($data->special, $special)) { $special += array( $key => $data->special );
                              if($data->turunan!=$pdf->turunan){ echo" <s><font color='#6594c5'> :$data->special <br></font></s>"; } if($data->turunan==$pdf->turunan){ echo" : $data->special <br>"; } } ?></tr>
													  </table>
												    </td>
                          </tr>
                          <tr>
                            <th>Product Concept</th>
                            <td colspan="2">
													    <table>
                                <tr><th style="border:none;">Weight/Serving </th><th style="border:none;"><?php $wight = []; foreach ($pdf1 as $key => $data) If (!$wight || !in_array($data->wight, $wight)) { $wight += array( $key => $data->wight );
                                if($data->turunan!=$pdf->turunan){ echo"<s><font color='#6594c5'>: $data->wight/$data->serving<br></font></s>"; } if($data->turunan==$pdf->turunan){ echo": $data->wight/$data->serving<br>"; } } ?></th></tr>
														    <tr><th>Special Ingredient </th><th style="border:none;"><?php $ingredient = []; foreach ($pdf1 as $key => $data) If (!$ingredient || !in_array($data->ingredient, $ingredient)) { $ingredient += array( $key => $data->ingredient );
                                if($data->turunan!=$pdf->turunan){ echo"<s><font color='#6594c5'>:$data->ingredient <br></font></s>"; } if($data->turunan==$pdf->turunan){ echo" : $data->ingredient <br>"; } } ?></th></tr>
                              </table><br><br>
                              <table class="Table table-bordered" >
                                <tbody>
                                  <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                                    <th class="text-center">Komponen</th>
                                    <th class="text-center">Klaim</th>
                                    <th class="text-center">Detail</th>
                                    <th class="text-center">Information</th>
                                  </tr>
                                  <tr>
                                    <td>
                                      <?php $komponen = []; foreach ($dataklaim as $key => $data) If (!$komponen || !in_array($data->datakp->komponen, $komponen)) { $komponen += array( $key => $data->datakp->komponen ); 
                                      if($data->turunan!=$pdf->turunan){ echo" <s><font color='#ffa2a2'>".$data->datakp->komponen."<br></font></s>"; } if($data->turunan==$pdf->turunan){ echo"". $data->datakp->komponen."<br>"; } }  ?>
                                    </td>
                                    <td>
                                      <?php $klaim = []; foreach ($dataklaim as $key => $data) If (!$klaim || !in_array($data->klaim, $klaim)) { $klaim += array( $key => $data->klaim );
                                      if($data->turunan!=$pdf->turunan){ echo" <s><font color='#ffa2a2'>".$data->klaim."<br></font></s>"; } if($data->turunan==$pdf->turunan){ echo"". $data->klaim."<br>"; } }  ?>
                                    </td>
                                    <td>
                                      <?php $detail = []; foreach ($datadetail as $key => $data) If (!$detail || !in_array($data->datadl->detail, $detail)) { $detail += array( $key => $data->datadl->detail );
                                      if($data->turunan!=$pdf->turunan){ echo" <s><font color='#ffa2a2'>".$data->datadl->detail."<br></font></s>"; } if($data->turunan==$pdf->turunan){ echo"". $data->datadl->detail."<br>"; } }  ?>
                                    </td>
                                    <td>
                                      <?php $note = []; foreach ($dataklaim as $key => $data) If (!$note || !in_array($data->note, $note)) { $note += array( $key => $data->note );
                                      if($data->turunan!=$pdf->turunan){ echo" <s><font color='#6594c5'>".$data->note."<br></font></s>"; } if($data->turunan==$pdf->turunan){ echo"". $data->note."<br>"; } }  ?>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
												    </td>
                          </tr>
                        </thead>
                      </table>
                      @elseif($pdf->status_project!='draf')
                      <table width="100%" class="table table-bordered">
                        <thead>
                          <tr>
                            <td>Target market</td>
                            <td colspan="2">
													  <table>
                              <tr><?php $dariusia = []; foreach ($pdf2 as $key => $data) If (!$dariusia || !in_array($data->dariusia, $dariusia)) { $dariusia += array( $key => $data->dariusia );
                              if($data->revisi!=$pdf->revisi){ echo"Age: <s><font color='#ffa2a2'>$data->dariusia To $data->sampaiusia </font><br></s>"; } if($data->revisi==$pdf->revisi){ echo"Age : $data->dariusia To $data->sampaiusia<br>"; } }?></tr>
													    <tr><?php $ses = []; foreach ($datases as $key => $data) If (!$ses || !in_array($data->ses, $ses)) { $ses += array( $key => $data->ses );if($data->revisi!=$pdf->revisi){
                              echo"SES : <s><font color='#ffa2a2'>$data->ses </font><br></s>"; } if($data->revisi==$pdf->revisi){ echo"SES : $data->ses <br>";} } ?></tr>
														  <tr><?php $gender = []; foreach ($pdf2 as $key => $data) If (!$gender || !in_array($data->gender, $gender)) { $gender += array( $key => $data->gender );
                              if($data->revisi!=$pdf->revisi){ echo"<s><font color='#ffa2a2'> Gender : $data->gender </font><br></s>"; }  if($data->revisi==$pdf->revisi){  echo"Gender : $data->gender <br>";} }  ?></tr>
													    <tr><?php $other = []; foreach ($pdf2 as $key => $data) If (!$other || !in_array($data->other, $other)) { $other += array( $key => $data->other );
                              if($data->revisi!=$pdf->revisi){ echo"other : <s><font color='#ffa2a2'>".$data->other ."</font><br></s>"; } if($data->revisi==$pdf->revisi){ echo"other : $data->other <br>"; } }?></tr>
                            </table>
												    </td>
                          </tr>
                          <tr>
                            <td>Background / Insight</td>
                            <td><?php $background = []; foreach ($pdf2 as $key => $data) If (!$background || !in_array($data->background , $background )) { $background += array( $key => $data->background );
                            if($data->revisi!=$pdf->revisi){ echo" <s><font color='#ffa2a2'>$data->background <br></font></s>"; } if($data->revisi==$pdf->revisi){ echo"$data->background <br>"; } }?></td>
                          </tr>
                          <tr>
                            <td>Attracttiveness</td>
                            <td colspan="2"><?php $attractiveness = []; foreach ($pdf2 as $key => $data) If (!$attractiveness || !in_array($data->attractiveness, $attractiveness)) { $attractiveness += array( $key => $data->attractiveness );
                            if($data->revisi!=$pdf->revisi){ echo"<s><font color='#ffa2a2'>$data->attractiveness <br></font></s>"; } if($data->revisi==$pdf->revisi){ echo"$data->attractiveness <br>";} }  ?></td>
                          </tr>
                          <tr>
                            <td>Target RTO</td>
                            <td colspan="2"><?php $rto = []; foreach ($pdf2 as $key => $data) If (!$rto || !in_array($data->rto, $rto)) { $rto += array( $key => $data->rto );
                            if($data->revisi!=$pdf->revisi){ echo"<s><font color='#ffa2a2'>$data->rto <br></font></s>"; } if($data->revisi==$pdf->revisi){ echo"$data->rto <br>"; } } ?></td>
                          </tr>
                          <tr>
                            <td>Sales Forecast</td>
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
                                <tr><td>Nama</td><td style="border:none;"><?php $name = []; foreach ($pdf2 as $key => $data) If (!$name || !in_array($data->name, $name)) { $name += array( $key => $data->name );
                                if($data->revisi!=$pdf->revisi){ echo"<s><font color='#ffa2a2'>  : $data->name </font><br></s>"; } if($data->revisi==$pdf->revisi){ echo" : $data->name <br>"; } } ?></td></tr>
													      <tr><td>What's Special</td><td style="border:none;"><?php $special = []; foreach ($pdf2 as $key => $data) If (!$special || !in_array($data->special, $special)) { $special += array( $key => $data->special );
                                if($data->revisi!=$pdf->revisi){ echo" <s><font color='#ffa2a2'> :$data->special <br></font></s>"; } if($data->revisi==$pdf->revisi){ echo" : $data->special <br>"; } } ?></tr>
													    </table>
												    </td>
                          </tr>
                          <tr>
                            <td>Product Concept</td>
                            <td colspan="2">
													    <table>
                                <tr><td style="border:none;">Weight/Serving </td><td style="border:none;"><?php $wight = []; foreach ($pdf2 as $key => $data) If (!$wight || !in_array($data->wight, $wight)) { $wight += array( $key => $data->wight );
                                if($data->revisi!=$pdf->revisi){ echo"<s><font color='#6594c5'>: $data->wight<br></font></s>"; } if($data->revisi==$pdf->revisi){ echo": $data->wight"; } } ?> /
                                <?php $serving = []; foreach ($pdf2 as $key => $data) If (!$serving || !in_array($data->serving, $serving)) { $serving += array( $key => $data->serving );
                                if($data->revisi!=$pdf->revisi){ echo"<s><font color='#6594c5'>$data->serving<br></font></s>"; } if($data->revisi==$pdf->revisi){ echo"$data->serving"; } } ?></td></tr>
														    <tr><td>Claim / function</td><td style="border:none;"><?php $claim = []; foreach ($pdf2 as $key => $data) If (!$claim || !in_array($data->claim, $claim)) { $claim += array( $key => $data->claim );
                                if($data->revisi!=$pdf->revisi){ echo"<s><font color='#ffa2a2'> :$data->claim <br></font></s>"; } if($data->revisi==$pdf->revisi){ echo" : $data->claim <br>"; } } ?></td></tr>
														    <tr><td>Special Ingredient</td><td style="border:none;"><?php $ingredient = []; foreach ($pdf2 as $key => $data) If (!$ingredient || !in_array($data->ingredient, $ingredient)) { $ingredient += array( $key => $data->ingredient );
                                if($data->revisi!=$pdf->revisi){ echo"<s><font color='#ffa2a2'> :$data->ingredient <br></font></s>"; } if($data->revisi==$pdf->revisi){ echo" : $data->ingredient <br>"; } } ?></td></tr>
													    </table>
												    </td>
                          </tr>
                        </thead>
                      </table>
                      @endif
                      @endforeach
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
</div>
@endsection
