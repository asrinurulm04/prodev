<!DOCTYPE html>
<html lang="en">

<head>
<title>Download PKP</title>
<link href="{{ asset('img/prod.png') }}" rel="icon">
<link href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/asrul.css') }}" rel="stylesheet">
</head>
<body>

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
								<div class="panel-body badan" >
									<label>PT. NUTRIFOOD INDONESIA</label>
										<table ALIGN="right">
    									<tr>
    									  <td class="text-right">KODE FORM : F.Q.201</td>
    									</tr>
  									</table>
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
                            <tr><th class="text-right">Revisi No</th> <th>: {{$pkp->revisi}}.{{$pkp->turunan}}</th></tr>
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
										<table border="1" style="font-size:15px" class="table table-bordered">
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
                        <td>Sales Forecast</td>
                        <td colspan="2"><?php $seles = []; foreach ($for as $key => $data) If (!$seles || !in_array($data->forecast, $seles)) { $seles += array( $key => $data->forecast ); 
                        if($data->turunan!=$pkp->turunan){ echo": <s><font color='#6594c5'>$data->satuan = $data->forecast<br></font></s>"; } if($data->turunan==$pkp->turunan){ echo": $data->satuan = $data->forecast <br>";  } } ?></td>
											</tr>
											<tr>
                        <td>NF Selling Price (Before ppn)</td>
                        <td colspan="2">
                          <table>
                            <tr>
                              <td>
                                <?php $selling_price = []; foreach ($pkp1 as $key => $data) If (!$selling_price || !in_array($data->selling_price, $selling_price)) { $selling_price += array( $key => $data->selling_price ); 
                                if($data->turunan!=$pkp->turunan){ echo": <s><font color='#6594c5'>$data->selling_price<br></font></s>"; } if($data->turunan==$pkp->turunan){ echo": $data->selling_price <br>"; } }  ?>
                              </td>
                              <td>
                                <?php $uom = []; foreach ($pkp1 as $key => $data) If (!$uom || !in_array($data->UOM, $uom)) { $uom += array( $key => $data->UOM ); 
                                if($data->turunan!=$pkp->turunan){ echo"/ <s><font color='#6594c5'>".$data->UOM."<br></font></s>"; } if($data->turunan==$pkp->turunan){ echo"/ ".$data->UOM."<br>"; } }  ?>
                              </td>
                            </tr>
                          </table>
                        </td>
											</tr>
                        <td>Consumer price target</td>
                        <td colspan="2">
                          <table>
                            <tr>
                              <td>
                                <?php $price = []; foreach ($pkp1 as $key => $data) If (!$price || !in_array($data->price, $price)) { $price += array( $key => $data->price ); 
                                if($data->turunan!=$pkp->turunan){ echo": <s><font color='#6594c5'>$data->price<br></font></s>"; } if($data->turunan==$pkp->turunan){ echo": $data->price <br>"; } } ?>
                              </td>
                              <td>
                                <?php $uom = []; foreach ($pkp1 as $key => $data) If (!$uom || !in_array($data->UOM, $uom)) { $uom += array( $key => $data->UOM ); 
                                if($data->turunan!=$pkp->turunan){ echo"/ <s><font color='#6594c5'>".$data->UOM."<br></font></s>"; } if($data->turunan==$pkp->turunan){ echo"/ ".$data->UOM."<br>"; } }  ?>  
                              </td>
                            </tr>
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
                        if($data->turunan!=$pkp->turunan){ echo" <s><font color='#6594c5'>".$data->katpangan->kategori." <br></font></s>"; } if($data->turunan==$pkp->turunan){ echo $data->katpangan->kategori." <br>"; } }  ?>  
                        <br><?php $tarkon = []; foreach ($pkp1 as $key => $data) If (!$tarkon || !in_array($data->tarkon->tarkon, $tarkon)) { $tarkon += array( $key => $data->tarkon->tarkon ); 
                        if($data->turunan!=$pkp->turunan){ echo"AKG : <s><font color='#6594c5'>".$data->tarkon->tarkon."<br></font></s>"; } if($data->turunan==$pkp->turunan){ echo"AKG :". $data->tarkon->tarkon."<br>"; } }  ?></td>
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
                        <td>Mandatory Ingredients</td>
                        <td colspan="2"><?php $mandatory_ingredient = []; foreach ($pkp1 as $key => $data) If (!$mandatory_ingredient || !in_array($data->mandatory_ingredient, $mandatory_ingredient)) { $mandatory_ingredient += array( $key => $data->mandatory_ingredient ); 
                        if($data->turunan!=$pkp->turunan){ echo": <s><font color='#6594c5'>$data->mandatory_ingredient<br></font></s>"; } if($data->turunan==$pkp->turunan){ echo": $data->mandatory_ingredient<br>"; } }  ?></td>
                      </tr>
                      <tr>
                        <td>Related Picture</td>
                        <td colspan="2">@foreach($picture as $pic){{$pic->filename}} ({{$pic->informasi}})
                        <embed src="{{asset('data_file/'.$pic->filename)}}" width="765px" height="670" type=""><br> @endforeach</td>
                      </tr>
                    </table>
                    <table class="table table-striped table-bordered" style="font-size: 16px;">
                      <tdead>
                        <tr style="background-color:#bfc2c5;"><td class="text-center" colspan="5">ATTENTION</td></tr>
                        <tr><td style="background-color:#ffffff;" widtd="30%"></td><td style="border:none;background-color:#bfc2c5;"> compulsory; filled by QBX (brand function) Managers</td></tr>
                        <tr><td style="background-color:#13699a;" widtd="30%"></td><td style="border:none;background-color:#bfc2c5;">should only be filled witd great certainty</td></tr>
                        <tr><td style="background-color:#e41356;" widtd="30%"></td><td style="border:none;background-color:#bfc2c5;"> should only be filled after discussion witd QPA</td></tr>
                        <tr><td style="background-color:#bfc2c5;">Service Level Agreements</td>
                        <td style="background-color:#bfc2c5;">
                          <table>
                            <tdead>
                              <tr><td style="border:none;">Lead Time QBX (brand function)</td><td style="border:none;">5 workdays</td></tr>
                              <tr><td style="border:none;">Lead Time QPA (product development function)</td><td style="border:none;">[1 (benefits) + 2 (COGS)] = 2 workdays</td></tr>
                              <tr><td style="border:none;">Lead Time Revision </td><td style="border:none;">2 workdays</td></tr>
                            </tdead>
                          </table>
                        </td></tr>
                        <tr><td style="background-color:#bfc2c5;">Process</td>
                        <td style="background-color:#bfc2c5;">
                          <table>
                            <tdead>
                              <tr><td style="border:none;">After being filled. HOD approval request. tden, forward to RD as low priority project. Will be furtder</td></tr>
                              <tr><td style="border:none;">prioritized in PV Cross Funct Mtg. </td></tr>
                              <tr><td style="border:none;">Meanwhile, RD can prepare SLA projection to propose into PV's SLA for tde project based on</td></tr>
                              <tr><td style="border:none;">capacity and feasibility.</td></tr>
                            </tdead>
                          </table>
                        </td></tr>
                      </tdead>
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
</body>

</html>
<script src="{{ asset('vendors/jquery/dist/jquery.min.js') }}"></script>
<script>
  $(document).ready(function() {
    window.print()
  });
</script>
