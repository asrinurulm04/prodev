<!DOCTYPE html>
<html lang="en">

<head>
<title>@yield('title')</title>
  <link href="{{ asset('img/prod.png') }}" rel="icon">
  <link href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/asrul.css') }}" rel="stylesheet">
  </head>
  <body>
  <div class="watermarked">
  <img src="{{ asset('img/aul.png') }}" alt="Photo">
</div>
<div id="pcoded" class="pcoded">
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="row" style="margin:20px">
        <div id="exTab2" class="container">
          <div class="tab-content panel ">
            <div class="tab-pane active" id="1">
              @php
              	$no = 0;
              @endphp
              <div class="panel-default">
								<div class="panel-body">
                  <table class="Table table-bordered" style="font-size:12px">
                    <thead style="background-color:#e22b3c;font-weight: bold;color:white;font-size: 20px;">
                      <tr><th style="width:5%" class="text-center">PRODUCT DEVELOPMENT FORM</th></tr>
                      <tr><th style="width:5%" class="text-center">( PDF )</th></tr>
                    </thead>
									</table>
									@foreach($pdf as $pdf)
									<center> <h2 style="font-weight: bold;">[ {{ $pdf->id_brand }} ] &reg;</h2> </center>
      						<hr style="color:black;">
                  <div class="row">
                    <div class="col-sm-12">
                      <table ALIGN="left">
    								    <tr><th class="text-left" width="25%">Revision Number</th> <th>: {{$pdf->revisi}}.{{$pdf->turunan}}</th></tr>
                        <tr><th class="text-left">Project Name</th><th>: {{ $pdf->project_name }}</th></tr>
    								    <tr><th class="text-left">Author </th><th>: {{$pdf->datapdf->author1->name}}</th></tr>
										    <tr><th class="text-left">Last Upadate On</th> <th>: {{$pdf->created_date}}</th></tr>
                        <tr><th class="text-left">Country</th><th>: {{ $pdf->country }}</th></tr>
                        <tr><th class="text-left">Reference Regulation</th><th>: {{ $pdf->reference }}</th></tr>
                        <tr><th class="text-left">Type</th><th>: {{$pdf->datapdf->type->type}}</th></tr>
  								    </table>
                    </div><br><br>
                    @endforeach <br><br>
                    <div  class="col-sm-12">
                    <table width="100%" class="table table-bordered">
                        <thead>
                          <tr style="background-color:grey;font-weight: bold;color:white;font-size: 15px;"><td colspan="2" class="text-center">{{$pdf->project_name}}</td></tr>
                          <tr>
                            <td>Target market</td>
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
                            <td>Background / Insight</td>
                            <td><?php $background = []; foreach ($pdf1 as $key => $data) If (!$background || !in_array($data->background , $background )) { $background += array( $key => $data->background );
                            if($data->turunan!=$pdf->turunan){ echo" <s><font color='#6594c5'>$data->background </font><br></s>"; } if($data->turunan==$pdf->turunan){ echo"$data->background <br>"; } }?></td>
                          </tr>
                          <tr>
                            <td>Attracttiveness</td>
                            <td colspan="2"><?php $attractiveness = []; foreach ($pdf1 as $key => $data) If (!$attractiveness || !in_array($data->attractiveness, $attractiveness)) { $attractiveness += array( $key => $data->attractiveness );
                            if($data->turunan!=$pdf->turunan){ echo"<s><font color='#6594c5'>$data->attractiveness <br></font></s>"; } if($data->turunan==$pdf->turunan){ echo"$data->attractiveness <br>";} }  ?></td>
                          </tr>
                          <tr>
                            <td>Target RTO</td>
                            <td colspan="2"><?php $rto = []; foreach ($pdf1 as $key => $data) If (!$rto || !in_array($data->rto, $rto)) { $rto += array( $key => $data->rto );
                            if($data->turunan!=$pdf->turunan){ echo"<s><font color='#6594c5'>$data->rto </font><br></s>"; } if($data->turunan==$pdf->turunan){ echo"$data->rto <br>"; } } ?></td>
                          </tr>
                          <tr>
                            <td>Sales Forecast</td>
                            <td colspan="2"><?php $seles = []; foreach ($for as $key => $data) If (!$seles || !in_array($data->forecast, $seles)) { $seles += array( $key => $data->forecast ); 
                            if($data->turunan!=$pdf->turunan){ echo" <s><font color='#6594c5'>".$data->satuan ."=". $data->forecast."( Note :".$data->keterangan.")"."<br></font></s>"; } if($data->turunan==$pdf->turunan){ echo" $data->satuan = $data->forecast ( Note : $data->keterangan)<br>";  } } ?></td>
											    </tr>
                          <tr>
                            <td>Competitor</td>
                            <td colspan="2">
                            <table>
                              <tr><th>Name</th><td style="border:none;"><?php $name = []; foreach ($pdf1 as $key => $data) If (!$name || !in_array($data->name, $name)) { $name += array( $key => $data->name );
                              if($data->turunan!=$pdf->turunan){ echo" : <s><font color='#6594c5'>$data->name <br></font></s>"; } if($data->turunan==$pdf->turunan){ echo" : $data->name <br>"; } } ?></td></tr>
													    <tr><th>retailer price</th><td style="border:none;"><?php $retailer_price = []; foreach ($pdf1 as $key => $data) If (!$retailer_price || !in_array($data->retailer_price, $retailer_price)) { $retailer_price += array( $key => $data->retailer_price );
                              if($data->turunan!=$pdf->turunan){ echo" : <s><font color='#6594c5'>$data->retailer_price<br></font></s>"; } if($data->turunan==$pdf->turunan){ echo" : $data->retailer_price<br>"; } } ?></td></tr>
													    <tr><th>What's Special</th><td style="border:none;"><?php $special = []; foreach ($pdf1 as $key => $data) If (!$special || !in_array($data->special, $special)) { $special += array( $key => $data->special );
                              if($data->turunan!=$pdf->turunan){ echo" <s><font color='#6594c5'> :$data->special <br></font></s>"; } if($data->turunan==$pdf->turunan){ echo" : $data->special <br>"; } } ?></tr>
													  </table>
												    </td>
                          </tr>
                          <tr>
                            <td>Product Concept</td>
                            <td colspan="2">
													    <table>
                                <tr><th style="border:none;">Weight/Serving </th><td style="border:none;"><?php $wight = []; foreach ($pdf1 as $key => $data) If (!$wight || !in_array($data->wight, $wight)) { $wight += array( $key => $data->wight );
                                if($data->turunan!=$pdf->turunan){ echo"<s><font color='#6594c5'>: $data->wight/$data->serving<br></font></s>"; } if($data->turunan==$pdf->turunan){ echo": $data->wight/$data->serving<br>"; } } ?></td></tr>
														    <tr><th>Target NFI price / ctn</th><td style="border:none;"><?php $target_price = [];foreach ($pdf1 as $key => $data)If (!$target_price || !in_array($data->target_price, $target_price)) { $target_price += array($key => $data->target_price);
                                if($data->turunan!=$pdf->turunan){ echo" <s><font color='#6594c5'> : $data->target_price<br></font></s>"; } if($data->turunan==$pdf->turunan){ echo"  : $data->target_price<br>"; } } ?></td></tr>
														    <tr><th>Special Ingredient </th><td style="border:none;"><?php $ingredient = []; foreach ($pdf1 as $key => $data) If (!$ingredient || !in_array($data->ingredient, $ingredient)) { $ingredient += array( $key => $data->ingredient );
                                if($data->turunan!=$pdf->turunan){ echo"<s><font color='#6594c5'>:$data->ingredient <br></font></s>"; } if($data->turunan==$pdf->turunan){ echo" : $data->ingredient <br>"; } } ?></td></tr>
                              </table><br><br>
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
                          <tr>
                            <td>Packaging Concept</td>
                            <td colspan="2">
													    <table class="table">
                                @if($pdf->kemas_eksis!=NULL)
                                  @if($pdf->kemas->primer!=NULL)
                                  {{ $pdf->kemas->primer }}{{ $pdf->kemas->s_primer }} </tr>
                                  @elseif($pdf->kemas->primer==NULL)
                                  @endif

                                  @if($pdf->kemas->sekunder1!=NULL)
                                  X {{ $pdf->kemas->sekunder1 }}{{ $pdf->kemas->s_sekunder1}} </tr>
                                  @elseif($pdf->kemas->sekunder1==NULL)
                                  @endif

                                  @if($pdf->kemas->sekunder2!=NULL)
                                  X {{ $pdf->kemas->sekunder2 }}{{ $pdf->kemas->s_sekunder2 }} </tr>
                                  @elseif($pdf->sekunder2==NULL)
                                  @endif

                                  @if($pdf->kemas->tersier!=NULL)
                                  X {{ $pdf->kemas->tersier }}{{ $pdf->kemas->s_tersier }} </tr>
                                  @elseif($pdf->tersier==NULL)
                                  @endif
                                @elseif($pdf->primer==NULL)
                                  @if($pdf->kemas_eksis==NULL)
                                  @endif
                                @endif <br><br>
                                @if($pdf->primery!=NULL)
                                <tr><th style="border:none; width="15%">Primary</th><th style="border:none;">:</th><td style="border:none;"><?php $primery = []; foreach ($pdf1 as $key => $data) If (!$primery || !in_array($data->primery, $primery)) { $primery += array( $key => $data->primery ); 
                                  if($data->turunan!=$pdf->turunan){  echo" <s><font color='#6594c5'>$data->primery<br></font></s>";  } if($data->turunan==$pdf->turunan){ echo" $data->primery<br>"; } }  ?></td></tr>
                                @endif
                                @if($pdf->secondery!=NULL)
                                <tr><th style="border:none;" width="15%">Secondary</th><th style="border:none;">:</th><td style="border:none;"><?php $secondery = []; foreach ($pdf1 as $key => $data) If (!$secondery || !in_array($data->secondery, $secondery)) { $secondery += array( $key => $data->secondery ); 
                                  if($data->turunan!=$pdf->turunan){  echo" <s><font color='#6594c5'>$data->secondery<br></font></s>";  } if($data->turunan==$pdf->turunan){ echo" $data->secondery<br>"; } }  ?></td></tr>
                                @endif
                                @if($pdf->Tertiary!=NULL)
                                <tr><th style="border:none;" width="15%">Teriery</th><th style="border:none;">:</th><td style="border:none;"><?php $Tertiary = []; foreach ($pdf1 as $key => $data) If (!$Tertiary || !in_array($data->Tertiary, $Tertiary)) { $Tertiary += array( $key => $data->Tertiary ); 
                                  if($data->turunan!=$pdf->turunan){  echo" <s><font color='#6594c5'>$data->Tertiary<br></font></s>";  } if($data->turunan==$pdf->turunan){ echo" $data->Tertiary<br>"; } }  ?></td></tr>
                                @endif
                              </table>
                              @if($hitungkemaspdf>=0)
                              <br> Additional data :
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
                        </thead>
                      </table>
                    </div>
                  </div>
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
</body>

</html>
<script src="{{ asset('vendors/jquery/dist/jquery.min.js') }}"></script>
<script>
  $(document).ready(function() {
    window.print()
  });
</script>
