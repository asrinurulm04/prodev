<!DOCTYPE html>
<html lang="en">

<head>
<title>Download PKP</title>
<link href="{{ asset('img/prod.png') }}" rel="icon">
<link href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/asrul.css') }}" rel="stylesheet">
</head>
<body>
  <style type="text/css">
    .satu {
    font-size: 13px;
    }
 </style>

<div id="pcoded" class="pcoded">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="" >
      <div class="row" style="margin:20px">
        <div id="exTab2" class="container">
          <div class="tab-content" style="background-image:url(img/biru.jpg);">
            <div class="tab-pane active" id="1">
              @php
              	$no = 0;
              @endphp
              <div class="panel-default">
                <table align="left" border="0" cellpadding="0" cellspacing="0" width="600">
                  <div class="panel-body badan" >
                    <p class="satu">PT. NUTRIFOOD INDONESIA</p>
                      @foreach($pkpp as $pkp)
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
                      <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="row">
                          <div class="col-sm-6">
                            <table ALIGN="left">
                              <tr><th class="text-right">Revision No</th> <th>: {{$pkp->revisi}}.{{$pkp->turunan}}</th></tr>
                              <tr>
                                <button><a href="{{route('approveemailpkp',$pkp->id_pkp)}}" class="btn btn-info">Approve</a></button>
                                <button><a href="{{route('rejectemailpkp',$pkp->id_pkp)}}" class="btn btn-info">Reject</a></button>
                              </tr>
                            </table>
                          </div>
                          <div class="col-sm-6">
                          <table ALIGN="right">
                            <tr><td class="text-right">Author</td><td>: {{$pkp->datapkpp->author1->name}}</td></tr>
                            <tr><td class="text-right">Created date</td> <td>: {{$pkp->created_date}}</td></tr>
                            <tr><td class="text-right">Last Upadate On</td> <td>: {{$pkp->last_update}}</td></tr>
                            <tr><td class="text-right">Revised By</td><td>: @if($pkp->perevisi!=NULL) {{$pkp->perevisi2->name}} @endif</td></tr>
                          </table><br><br><br><br><br><br>
                        </div>
                      </div>
                      </div>
                      @endforeach
                      <table border="1" style="font-size:15px" class="table table-bordered" width="800">
                      <tr>
                          <th colspan="3" class="text-center"><span style="font-weight: bold;font-size: 20px;" class="card-title">Background</span></th>
                        </tr>
                        <tr>
                          <td width="300px">Idea</td>
                          <td colspan="2" width="700px"> <?php $ideas = []; foreach ($pkp1 as $key => $data) If (!$ideas || !in_array($data->idea, $ideas)) {$ideas += array($key => $data->idea);
                          if($data->turunan!=$pkp->turunan){ echo" <s><font color='#6594c5'>$data->idea<br></font></s>"; }if($data->turunan==$pkp->turunan){ echo" $data->idea<br>"; } } ?></td>
                        </tr>
                        <tr>
                          <td>Target market</td>
                          <td colspan="2">
                            <table>
    
                              <tr><td>Gender </td><td><?php $dataG = []; foreach ($pkp1 as $key => $data) If (!$dataG || !in_array($data->gender, $dataG)) { $dataG += array( $key => $data->gender );if($data->turunan!=$pkp->turunan){
                              echo"<s><font color='#6594c5'>:  $data->gender<br></font></s>"; } if($data->turunan==$pkp->turunan){ echo": $data->gender <br>"; } } ?></th></td></tr>
                              
                              <tr><td>Usia </td><td><?php $dariumur = []; foreach ($pkp1 as $key => $data) If (!$dariumur || !in_array($data->dariumur, $dariumur)) { $dariumur += array( $key => $data->dariumur ); if($data->turunan!=$pkp->turunan){
                              echo": <s><font color='#6594c5'>$data->dariumur - $data->sampaiumur<br></font></s>";} if($data->turunan==$pkp->turunan){ echo": $data->dariumur - $data->sampaiumur <br>";} } ?> </td></tr>
                              
                              <tr><td>SES <td></td><?php $ses = []; foreach ($datases as $key => $data) If (!$ses || !in_array($data->ses, $ses)) { $ses += array( $key => $data->ses ); 
                              if($data->turunan!=$pkp->turunan){ echo": <s><font color='#6594c5'>$data->ses<br></font></s>"; }if($data->turunan==$pkp->turunan){ echo": $data->ses <br>"; } } ?></td></tr>
                            
                            </table>
                          </td>
                        </tr>
                        <tr>
                        <td>Uniqueness of idea</td>
                          <td colspan="2"><?php $Uniqueness = []; foreach ($pkp1 as $key => $data) If (!$Uniqueness || !in_array($data->Uniqueness, $Uniqueness)) { $Uniqueness += array( $key => $data->Uniqueness ); 
                          if($data->turunan!=$pkp->turunan){ echo": <s><font color='#6594c5'>$data->Uniqueness <br></font></s>"; } if($data->turunan==$pkp->turunan){ echo": $data->Uniqueness <br>";} } ?></td>
                        </tr>
                        <tr>
                        <td>Estimated potential market</td>
                          <td colspan="2"><?php $Estimated = []; foreach ($pkp1 as $key => $data) If (!$Estimated || !in_array($data->Estimated, $Estimated)) {  $Estimated += array(  $key => $data->Estimated ); 
                          if($data->turunan!=$pkp->turunan){ echo": <s><font color='#6594c5'>$data->Estimated <br></font></s>"; } if($data->turunan==$pkp->turunan){ echo": $data->Estimated <br>"; } } ?></td>
                        </tr>
                        <tr class="table-highlight">
                          <td>Reason(s)</td>
                          <td colspan="2"><?php $reason = []; foreach ($pkp1 as $key => $data) If (!$reason || !in_array($data->reason, $reason)) { $reason += array( $key => $data->reason ); 
                          if($data->turunan!=$pkp->turunan){ echo": <s><font color='#6594c5'>$data->reason<br></font></s>";} if($data->turunan==$pkp->turunan){ echo": $data->reason <br>"; } } ?></td>
                        </tr>
                        <tr>
                          <th colspan="3" class="text-center"><span style="font-weight: bold;font-size: 20px;" class="card-title">Market Analysis</span></th>
                        </tr>
                        <tr>
                          <td>Launch Deadline</td>
                          <td colspan="2">
                            <table>
                              <tr>
                              <?php $launch = []; foreach ($pkp1 as $key => $data) If (!$launch || !in_array($data->launch, $launch)) { $launch += array( $key => $data->launch ); 
                              if($data->turunan!=$pkp->turunan){ echo": <s><font color='#6594c5'>$data->launch $data->years<br></font></s>"; } if($data->turunan==$pkp->turunan){ echo": $data->launch $data->years<br>"; } } ?>

                              <?php $tgl_launch = []; foreach ($pkp1 as $key => $data) If (!$tgl_launch || !in_array($data->tgl_launch, $tgl_launch)) { $tgl_launch += array( $key => $data->tgl_launch ); 
                              if($data->turunan!=$pkp->turunan){ echo": <s><font color='#6594c5'>$data->tgl_launch<br></font></s>"; } if($data->turunan==$pkp->turunan){ echo": $data->tgl_launch<br>"; } } ?>
                              </tr>
                            </table>
                          </td>
                        </tr>
                        <tr>
                          <td>Aisle Placement</td>
                          <td colspan="2"><?php $aisle = []; foreach ($pkp1 as $key => $data) If (!$aisle || !in_array($data->aisle, $aisle)) { $aisle += array( $key => $data->aisle ); 
                          if($data->turunan!=$pkp->turunan){ echo": <s><font color='#6594c5'>$data->aisle<br></font></s>"; } if($data->turunan==$pkp->turunan){ echo": $data->aisle<br>"; } } ?></td>
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
                                  <td>{{$for->satuan}} = <?php $angka_format = number_format($for->forecast,2,",","."); echo "Rp. ".$angka_format;?></td>
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
                                  <td><?php $angka_format = number_format($for->nfi_price,2,",","."); echo "Rp. ".$angka_format;?></td>
                                  <td><?php $angka_format = number_format($for->costumer,2,",","."); echo "Rp. ".$angka_format;?></td>
                                </tr>
                                @endforeach
                              </tbody>
                            </table>
                          </td>
                        </tr>
                        <tr class="table-highlight">
                          <td>Main Competitor</td>
                          <td colspan="2"><?php $competitor = []; foreach ($pkp1 as $key => $data) If (!$competitor || !in_array($data->competitor, $competitor)) {$competitor += array( $key => $data->competitor ); 
                          if($data->turunan!=$pkp->turunan){ echo": <s><font color='#6594c5'>$data->competitor <br></font></s>"; } if($data->turunan==$pkp->turunan){ echo": $data->competitor <br>"; } }  ?></td>
                        </tr>
                        <tr class="table-highlight">
                          <td>Competitive Analysis</td>
                          <td colspan="2"><?php $competitive = []; foreach ($pkp1 as $key => $data) If (!$competitive || !in_array($data->competitive, $competitive)) { $competitive += array( $key => $data->competitive ); 
                          if($data->turunan!=$pkp->turunan){ echo": <s><font color='#6594c5'>$data->competitive <br></font></s>"; } if($data->turunan==$pkp->turunan){ echo": $data->competitive <br>"; } }  ?></td>
                        </tr>
                        <tr>
                          <th colspan="3" class="text-center"><span style="font-weight: bold;font-size: 20px;" class="card-title">Product features</span></th>
                        </tr>
                        <tr>
                          <td>Product Form</td>
                          <td colspan="2"><?php $product_form = []; foreach ($pkp1 as $key => $data) If (!$product_form || !in_array($data->product_form, $product_form)) { $product_form += array( $key => $data->product_form  ); 
                          if($data->turunan!=$pkp->turunan){ echo": <s><font color='#6594c5'>$data->product_form<br></font></s>"; } if($data->turunan==$pkp->turunan){ echo": $data->product_form<br>"; } }  ?></td>
                        </tr>
                        <tr>
                        <td>Product Packaging</td>
                          <td colspan="2">
                            <table>
                              <tr>
                              @if($pkp->kemas_eksis!=NULL)
                              <?php $eksis = []; foreach ($pkp1 as $key => $data) If (!$eksis || !in_array($data->kemas->nama, $eksis)) { $eksis += array( $key => $data->kemas->nama ); 
                              if($data->turunan!=$pkp->turunan){ echo": <s><font color='#6594c5'>".$data->kemas->nama." <br></font></s>"; } if($data->turunan==$pkp->turunan){ echo $data->kemas->nama." <br>"; } }  ?>
                              (
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
                              @endif
                              )
                              @elseif($pkp->primer==NULL)
                                @if($pkp->kemas_eksis==NULL)
                                @endif
                              @endif
                            </tr>
                              <br>
                              <?php $primery = []; foreach ($pkp1 as $key => $data) If (!$primery || !in_array($data->primery, $primery)) { $primery += array( $key => $data->primery ); } ?>
                              <?php $secondary = []; foreach ($pkp1 as $key => $data) If (!$secondary || !in_array($data->secondary, $secondary)) { $secondary += array( $key => $data->secondary ); } ?>
                              <?php $tertiary = []; foreach ($pkp1 as $key => $data) If (!$tertiary || !in_array($data->tertiary, $tertiary)) { $tertiary += array( $key => $data->tertiary ); } ?>
                              <tr><td style="border:none;">Primary information</td><td style="border:none;">@foreach($primery as $primery) : {{ $primery }} <br>@endforeach</td></tr>
                              <tr><td style="border:none;">Secondary information</td><td style="border:none;">@foreach($secondary as $secondary) : {{ $secondary }} <br>@endforeach</td></tr>
                              <tr><td style="border:none;">Teriery information</td><td style="border:none;">@foreach($tertiary as $tertiary) : {{ $pkp->tertiary }} <br>@endforeach</td></tr>
                            </table>
                          </td>
                        </tr>
                        <tr>
                          <td>Food Category (BPOM)</td>
                          <td colspan="2"><?php $pangan = []; foreach ($pkp1 as $key => $data) If (!$pangan || !in_array($data->katpangan->kategori, $pangan)) { $pangan += array( $key => $data->katpangan->kategori );  
                          if($data->turunan!=$pkp->turunan){ echo" <s><font color='#6594c5'>".$data->katpangan->kategori." <br></font></s>"; } if($data->turunan==$pkp->turunan){ echo $data->katpangan->kategori." <br>"; } }  ?> </td>
                        </tr>
                        <tr class="table-highlight">
                          <td>AKG</td>
                          <td colspan="2"><?php $tarkon = []; foreach ($pkp1 as $key => $data) If (!$tarkon || !in_array($data->tarkon->tarkon, $tarkon)) { $tarkon += array( $key => $data->tarkon->tarkon ); 
                          if($data->turunan!=$pkp->turunan){ echo"<s><font color='#6594c5'>".$data->tarkon->tarkon."<br></font></s>"; } if($data->turunan==$pkp->turunan){ echo"". $data->tarkon->tarkon."<br>"; } }  ?></td>
                        </tr>
                        <tr class="table-highlight">
                          <td>Prefered Flavour</td>
                          <td colspan="2"><?php $prefered_flavour = []; foreach ($pkp1 as $key => $data) If (!$prefered_flavour || !in_array($data->prefered_flavour, $prefered_flavour)) { $prefered_flavour += array( $key => $data->prefered_flavour ); 
                          if($data->turunan!=$pkp->turunan){  echo": <s><font color='#6594c5'>$data->prefered_flavour<br></font></s>";  } if($data->turunan==$pkp->turunan){ echo": $data->prefered_flavour<br>"; } }  ?></td>
                        </tr>
                        <tr>
                          <td>Product Benefits</td>
                          <td colspan="2">
                            <table>
                            <?php $product_benefits = []; foreach ($pkp1 as $key => $data) If (!$product_benefits || !in_array($data->product_benefits, $product_benefits)) { $product_benefits += array( $key => $data->product_benefits ); } ?>
                              <tr>@foreach($product_benefits as $product_benefits){{ $product_benefits }} <br>@endforeach</tr>
                            </table><br>
                            <table class="table table-bordered table-hover" id="table">
                              <tbody>
                                <tr>
                                  <td>Komponen</td>
                                  <td>Klaim</td>
                                <td>Detail</td>
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
                                </tr>
                              </tbody>
                            </table>
                          </td>
                        </tr>
                      <tr>
                        <td>Serving Suggestion</td>
                        <td colspan="2"><?php $serving = []; foreach ($pkp1 as $key => $data) If (!$serving || !in_array($data->serving_suggestion, $serving)) { $serving += array( $key => $data->serving_suggestion ); 
                        if($data->turunan!=$pkp->turunan){ echo" <s><font color='#6594c5'>$data->serving_suggestion<br></font></s>"; } if($data->turunan==$pkp->turunan){ echo" $data->serving_suggestion<br>"; } }  ?></td>
                      </tr>
                        <tr>
                          <td>Mandatory Ingredients</td>
                          <td colspan="2"><?php $mandatory_ingredient = []; foreach ($pkp1 as $key => $data) If (!$mandatory_ingredient || !in_array($data->mandatory_ingredient, $mandatory_ingredient)) { $mandatory_ingredient += array( $key => $data->mandatory_ingredient ); 
                          if($data->turunan!=$pkp->turunan){ echo": <s><font color='#6594c5'>$data->mandatory_ingredient<br></font></s>"; } if($data->turunan==$pkp->turunan){ echo": $data->mandatory_ingredient<br>"; } }  ?></td>
                        </tr>
                      </table>
                  </div>
                </table>
							</div>
        	  </div>
          </div>
        </div>
      </div>
    </div>
	</div>
</body>

</html>
<script src="{{ asset('vendors/jquery/dist/jquery.min.js') }}"></script>
<script>
  $(document).ready(function() {
    window.print()
  });
</script>
