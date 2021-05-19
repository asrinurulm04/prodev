<!DOCTYPE html>
<html lang="en">

<head>
<title>Download PKP</title>
<link href="{{ asset('img/prod.png') }}" rel="icon">
<link href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/asrul.css') }}" rel="stylesheet">
</head>
<body>

<div class="watermarked">
  <img src="{{ asset('img/aul.png') }}" alt="Photo">
</div>

<div id="pcoded" class="pcoded">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="" >
      <div class="row" style="margin:20px">
        <div id="exTab2" class="container">
          <div class="tab-content">
            <div class="tab-pane active" id="1">
              @php $no = 0; @endphp
              <div class="panel-default">
								<div class="panel-body badan">
									<label>PT. NUTRIFOOD INDONESIA</label>
                    @foreach($pkpp as $pkp)
										<center> <h2 style="font-size: 22px;font-weight: bold;">PENGEMBANGAN KONSEP AWAL PRODUK BARU</h2> </center>
  									<center> <h2 style="font-size: 20px;font-weight: bold;">( PKP )</h2> </center><br>
										<center> <h2 style="font-weight: bold;">[ {{ $pkp->id_brand }} ] &reg;</h2> </center>
      							<table class="table table-bordered" style="font-size:12px">
                      <tr><th style="background-color:#13699a;font-weight: bold;color:white;font-size: 20px;" class="text-center">{{ $pkp->project_name }}</th></tr>
										</table>
										<div class="row">
                      <div class="col-sm-6">
                        <table ALIGN="left">
                          <tr><th class="text-right">Revisi No</th> <th>: {{$pkp->revisi}}.{{$pkp->turunan}}</th></tr>
                        </table>
                      </div>
                      <div class="col-sm-6">
                        <table ALIGN="right">
                          <tr><th class="text-right">Author </th><th>: {{$pkp->datapkpp->author1->name}}</th></tr>
                          <tr><th class="text-right">Created date</th> <th>: {{$pkp->created_date}}</th></tr>
                          <tr><th class="text-right">Last Upadate On</th> <th>: {{$pkp->last_update}}</th></tr>
                          <tr><th class="text-right">Revised By</th><th>: @if($pkp->perevisi!=NULL) {{$pkp->perevisi2->name}} @endif</th></tr>
                        </table><br><br>
                      </div>
                    </div>
                    @endforeach
										<table class=" table table-bordered">
                      <tr><th colspan="3" class="text-center"><span style="font-weight: bold;font-size: 20px;" class="card-title">Background</span></th></tr>
                      <tr>
                        <th style="min-width:200px">Idea</th>
                        <td colspan="2"> <?php $ideas = []; foreach ($pkp1 as $key => $data) If (!$ideas || !in_array($data->idea, $ideas)) {$ideas += array($key => $data->idea);
                        if($data->turunan!=$pkp->turunan){ echo" <s><font color='#6594c5'>$data->idea<br></font></s>"; }if($data->turunan==$pkp->turunan){ echo" $data->idea<br>"; } } ?></td>
                      </tr>
                      <tr>
                        <th>Target market</th>
                        <td colspan="2">
                          <table>
                            <tr><th style="border:none;">Gender </th><td style="border:none;"> 
                            <?php $dataG = []; foreach ($pkp1 as $key => $data) If (!$dataG || !in_array($data->gender, $dataG)) { $dataG += array( $key => $data->gender );if($data->turunan!=$pkp->turunan){
                            echo"<s><font color='#6594c5'>:  $data->gender<br></font></s>"; } if($data->turunan==$pkp->turunan){ echo": $data->gender <br>"; } } ?></td></tr>
                              
                            <tr><th style="border:none;">Usia </th><td style="border:none;"> 
                            <?php $dariumur = []; foreach ($pkp1 as $key => $data) If (!$dariumur || !in_array($data->dariumur, $dariumur)) { $dariumur += array( $key => $data->dariumur ); if($data->turunan!=$pkp->turunan){
                            echo" <s><font color='#6594c5'>: $data->dariumur</font></s>";} if($data->turunan==$pkp->turunan){ echo": $data->dariumur ";} } ?>
                            <?php $sampaiumur = []; foreach ($pkp1 as $key => $data) If (!$sampaiumur || !in_array($data->sampaiumur, $sampaiumur)) { $sampaiumur += array( $key => $data->sampaiumur ); if($data->turunan!=$pkp->turunan){
                            echo" <s><font color='#6594c5'> $data->sampaiumur</font></s>";} if($data->turunan==$pkp->turunan){ echo" $data->sampaiumur ";} } ?> </th></tr>
                              
                            <tr><th style="border:none;">SES </th><td style="border:none;"> 
                            <?php $ses = []; foreach ($datases as $key => $data) If (!$ses || !in_array($data->ses, $ses)) { $ses += array( $key => $data->ses ); 
                            if($data->turunan!=$pkp->turunan){ echo" <s><font color='#6594c5'>: $data->ses,</font></s>"; }if($data->turunan==$pkp->turunan){ echo" : $data->ses,"; } } ?></th></tr>
                            
                            <tr><th style="border:none;">Remarks SES </th><td style="border:none;"> 
                            <?php $remarks_ses = []; foreach ($pkp1 as $key => $data) If (!$remarks_ses || !in_array($data->remarks_ses, $remarks_ses)) { $remarks_ses += array( $key => $data->remarks_ses ); if($data->turunan!=$pkp->turunan){
                            echo" <s><font color='#6594c5'>$data->remarks_ses</font></s>";} if($data->turunan==$pkp->turunan){ echo" : $data->remarks_ses ";} } ?></td></tr>
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
                        if($data->turunan!=$pkp->turunan){ echo" <s><font color='#6594c5'>$data->reason<br></font></s>";} if($data->turunan==$pkp->turunan){ echo" $data->reason <br>"; } } ?></td>
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
                        <td colspan="2"><?php $seles = []; foreach ($for as $key => $data) If (!$seles || !in_array($data->forecast, $seles)) { $seles += array( $key => $data->forecast ); 
                        if($data->turunan!=$pkp->turunan){ echo" <s><font color='#6594c5'>$data->satuan = $data->forecast<br></font></s>"; } if($data->turunan==$pkp->turunan){ echo" $data->satuan = $data->forecast <br>";  } } ?><br>
                        
                        <?php $remarks_forecash = []; foreach ($for as $key => $data) If (!$remarks_forecash || !in_array($data->remarks_forecash, $remarks_forecash)) { $remarks_forecash += array( $key => $data->remarks_forecash ); 
                        if($data->turunan!=$pkp->turunan){ echo"Remarks Forecash: <s><font color='#6594c5'>$data->remarks_forecash<br></font></s>"; } if($data->turunan==$pkp->turunan){ echo"Remarks Forecash: $data->remarks_forecash <br>";  } } ?></td>
                      </tr>
                      <tr>
                        <th>NF Selling Price (Before ppn)</th>
                        <td colspan="2">
                          <table>
                            <tr>
                              <td>
                                <?php $selling_price = []; foreach ($pkp1 as $key => $data) If (!$selling_price || !in_array($data->selling_price, $selling_price)) { $selling_price += array( $key => $data->selling_price ); 
                                if($data->turunan!=$pkp->turunan){ echo" <s><font color='#6594c5'>$data->selling_price<br></font></s>"; } if($data->turunan==$pkp->turunan){ echo" $data->selling_price <br>"; } }  ?>
                              </td>
                              <td>
                                <?php $uom = []; foreach ($pkp1 as $key => $data) If (!$uom || !in_array($data->UOM, $uom)) { $uom += array( $key => $data->UOM ); 
                                if($data->turunan!=$pkp->turunan){ echo"/ <s><font color='#6594c5'>".$data->UOM."<br></font></s>"; } if($data->turunan==$pkp->turunan){ echo"/ ".$data->UOM."<br>"; } }  ?>
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                        <th>Consumer price target</th>
                        <td colspan="2">
                          <table>
                            <tr>
                              <td>
                                <?php $price = []; foreach ($pkp1 as $key => $data) If (!$price || !in_array($data->price, $price)) { $price += array( $key => $data->price ); 
                                if($data->turunan!=$pkp->turunan){ echo" <s><font color='#6594c5'>$data->price<br></font></s>"; } if($data->turunan==$pkp->turunan){ echo" $data->price <br>"; } } ?>
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
                          <th>Main Competitor</th>
                          <td colspan="2"><?php $competitor = []; foreach ($pkp1 as $key => $data) If (!$competitor || !in_array($data->competitor, $competitor)) {$competitor += array( $key => $data->competitor ); 
                          if($data->turunan!=$pkp->turunan){ echo" <s><font color='#6594c5'>$data->competitor <br></font></s>"; } if($data->turunan==$pkp->turunan){ echo" $data->competitor <br>"; } }  ?></td>
                        </tr>
                        <tr class="table-highlight">
                          <th>Competitive Analysis</th>
                          <td colspan="2"><?php $competitive = []; foreach ($pkp1 as $key => $data) If (!$competitive || !in_array($data->competitive, $competitive)) { $competitive += array( $key => $data->competitive ); 
                          if($data->turunan!=$pkp->turunan){ echo" <s><font color='#6594c5'>$data->competitive <br></font></s>"; } if($data->turunan==$pkp->turunan){ echo" $data->competitive <br>"; } }  ?></td>
                        </tr>
                        <tr class="table-highlight">
                          <th>UOM</th>
                          <td colspan="2"><?php $uom = []; foreach ($pkp1 as $key => $data) If (!$uom || !in_array($data->UOM, $uom)) { $uom += array( $key => $data->UOM ); 
                          if($data->turunan!=$pkp->turunan){ echo" <s><font color='#6594c5'>".$data->UOM."<br></font></s>"; } if($data->turunan==$pkp->turunan){ echo" ".$data->UOM."<br>"; } }  ?></td>
                        </tr>
                        <tr><th colspan="3" class="text-center"><span style="font-weight: bold;font-size: 20px;" class="card-title">Product features</span></th></tr>
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
                          <td>@if($pkp->akg!=NULL)
                            <?php $tarkon = []; foreach ($pkp1 as $key => $data) If (!$tarkon || !in_array($data->tarkon, $tarkon)) { $tarkon += array( $key => $data->tarkon ); 
                            if($data->turunan==$pkp->turunan){ echo"". $data->tarkon->tarkon."<br>"; } }  ?>@endif
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
                            <?php $product_benefits = []; foreach ($pkp1 as $key => $data) If (!$product_benefits || !in_array($data->product_benefits, $product_benefits)) { $product_benefits += array( $key => $data->product_benefits ); } ?>
                              <tr>@foreach($product_benefits as $product_benefits){{ $product_benefits }} <br>@endforeach</tr>
                            </table><br>
                            <table class="table table-bordered table-hover" id="table">
                            <tbody>
                                <tr><th>Komponen</th><td><?php $komponen = []; foreach ($dataklaim as $key => $data) If (!$komponen || !in_array($data->datakp->komponen, $komponen)) { $komponen += array( $key => $data->datakp->komponen ); 
                                if($data->turunan!=$pkp->turunan){ echo" <s><font color='#ffa2a2'>".$data->datakp->komponen."<br></font></s>"; } if($data->turunan==$pkp->turunan){ echo"". $data->datakp->komponen."<br>"; } }  ?></td><tr>
                                <tr><th>Kliam</th><td><?php $klaim = []; foreach ($dataklaim as $key => $data) If (!$klaim || !in_array($data->id, $klaim)) { $klaim += array( $key => $data->id );
                                if($data->turunan!=$pkp->turunan){ echo" <s><font color='#ffa2a2'>".$data->klaim."<br></font></s>"; } if($data->turunan==$pkp->turunan){ echo"". $data->klaim."<br>"; } }  ?></td></tr>
                                <tr><th>Detail</th><td><?php $detail = []; foreach ($datadetail as $key => $data) If (!$detail || !in_array($data->datadl->detail, $detail)) { $detail += array( $key => $data->datadl->detail );
                                if($data->turunan!=$pkp->turunan){ echo" <s><font color='#ffa2a2'>".$data->datadl->detail."<br></font></s>"; } if($data->turunan==$pkp->turunan){ echo"". $data->datadl->detail."<br>"; } }  ?></td></tr>
                                <tr><th>Note</th><td><?php $note = []; foreach ($dataklaim as $key => $data) If (!$note || !in_array($data->note, $note)) { $note += array( $key => $data->note ); 
                                if($data->turunan!=$pkp->turunan){ echo" <s><font color='#ffa2a2'>".$data->note."<br></font></s>"; } if($data->turunan==$pkp->turunan){ echo"". $data->note."<br>"; } }  ?></td><tr></tbody>
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
                              <tr class="text-center">
                                <th>Filename</th>
                                <th>File</th>
                                <th>Information</th>
                              </tr>
                              @foreach($picture as $pic)
                              <tr>
                                <td>{{$pic->filename}} </td>
                                <td class="text-center"><embed src="{{asset('data_file/'.$pic->filename)}}" width="90px" height="90" type=""></td>
                                <td width="40%"> &nbsp{{$pic->informasi}}</td>  
                              </tr>
                              @endforeach
                            </table>
                          </td>
                        </tr>
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