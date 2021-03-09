<!DOCTYPE html>
<html lang="en">

<head>
  <title>@yield('title')</title>
  <link href="{{ asset('img/prod.png') }}" rel="icon">
  <link href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/asrul.css') }}" rel="stylesheet">
</head>
<body>
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
                      <div class="col-sm-6">
                        <table ALIGN="left">
                          <tr><td class="text-right">Revisi No</td> <td>: {{$pdf->revisi}}.{{$pdf->turunan}}</td></tr>
                          <tr>
                              <button><a href="{{route('approveemailpdf',$pdf->pdf_id)}}" class="btn btn-info">Approve</a></button>
                              <button><a href="{{route('rejectemailpdf',$pdf->pdf_id)}}" class="btn btn-info">Reject</a></button>
                            </tr>
                        </table>
                      </div>
                      <div class="col-sm-6">
                        <table ALIGN="right">
                          <tr><td class="text-right">Author </td><td>: {{$pdf->author1->name}}</td></tr>
                          <tr><td class="text-right">Last Upadate On</td> <td>: {{$pdf->created_date}}</td></tr>
                          <tr><td class="text-right">Revised By </td><td>: {{$pdf->perevisi1->name}}</td></tr>
                          <tr><td class="text-right">Project Name</td><td>: {{ $pdf->project_name }}</td></tr>
                          <tr><td class="text-right">Country</td><td>: {{ $pdf->country }}</td></tr>
                          <tr><td class="text-right">Reference Regulation</td><td>: {{ $pdf->reference }}</td></tr>
                        </table><br><br><br><br><br>
                      </div>
                      @endforeach
                      <br>
                      <div  class="col-sm-12">
                        <table width="100%" border="1" class="table table-bordered">
                          <thead>
                            <tr>
                              <td width="300px">Target market</td>
                              <td colspan="2" width="800px">
                                <table>
                                  <?php $dariusia = []; foreach ($pdf1 as $key => $data) If (!$dariusia || !in_array($data->dariusia, $dariusia)) { $dariusia += array( $key => $data->dariusia );} ?>
                                  <tr><td style="border:none;">Age </td><td style="border:none;">@foreach($dariusia as $dariusia): {{$dariusia}}   Tahun - {{$pdf->sampaiusia}} Tahun <br>@endforeach</td></tr>
                                  <?php $ses = []; foreach ($datases as $key => $data) If (!$ses || !in_array($data->ses, $ses)) { $ses += array( $key => $data->ses );} ?>
                                  <tr><td style="border:none;">SES </td><td style="border:none;"> @foreach($ses as $ses): {{$ses}}<br>@endforeach</td></tr>
                                  <?php $gender = []; foreach ($pdf1 as $key => $data) If (!$gender || !in_array($data->gender, $gender)) { $gender += array( $key => $data->gender );} ?>
                                  <tr><td style="border:none;">Gender </td><td style="border:none;"> @foreach($gender as $gender): {{$gender}}<br>@endforeach</td></tr>
                                </table>
                              </td>
                            </tr>
                            <tr>
                              <td>Background / Insight</td>
                              <?php $background = []; foreach ($pdf1 as $key => $data) If (!$background || !in_array($data->background, $background)) { $background += array( $key => $data->background );} ?>
                              <td colspan="2">@foreach($background as $background){{$background}}<br>@endforeach</td>
                            </tr>
                            <tr>
                              <td>Attracttiveness</td>
                              <?php $attractiveness = []; foreach ($pdf1 as $key => $data) If (!$attractiveness || !in_array($data->attractiveness, $attractiveness)) { $attractiveness += array( $key => $data->attractiveness );} ?>
                              <td colspan="2">@foreach($attractiveness as $attractiveness){{$pdf->attractiveness}}<br>@endforeach</td>
                            </tr>
                            <tr>
                              <td>Target RTO</td>
                              <?php $rto = []; foreach ($pdf1 as $key => $data) If (!$rto || !in_array($data->rto, $rto)) { $rto += array( $key => $data->rto );} ?>
                              <td colspan="2">@foreach($rto as $rto){{$rto}}<br>@endforeach</td>
                            </tr>
                            <tr>
                              <td>Sales Forecast</td>
                              <td colspan="2"><?php $seles = []; foreach ($for as $key => $data) If (!$seles || !in_array($data->forecast, $seles)) { $seles += array( $key => $data->forecast ); 
                              if($data->turunan!=$pdf->turunan){ echo" <s><font color='#6594c5'>$data->satuan = $data->forecast<br></font></s>"; } if($data->turunan==$pdf->turunan){ echo" $data->satuan = $data->forecast <br>";  } } ?></td>
                            </tr>
                            <tr class="text-left">
                              <td>Competitor</td>
                              <td colspan="2">
                              <table>
                                <tr><td>Name</td><td style="border:none;"><?php $name = []; foreach ($pdf1 as $key => $data) If (!$name || !in_array($data->name, $name)) { $name += array( $key => $data->name );
                                if($data->turunan!=$pdf->turunan){ echo" : <s><font color='#6594c5'>$data->name <br></font></s>"; } if($data->turunan==$pdf->turunan){ echo" : $data->name <br>"; } } ?></td></tr>
                                <tr><td>Retailer price</td><td style="border:none;"><?php $retailer_price = []; foreach ($pdf1 as $key => $data) If (!$retailer_price || !in_array($data->retailer_price, $retailer_price)) { $retailer_price += array( $key => $data->retailer_price );
                                if($data->turunan!=$pdf->turunan){ echo" : <s><font color='#6594c5'>: Rp. ". number_format( $data->retailer_price, 0, ".", "."). "<br></font></s>"; } if($data->turunan==$pdf->turunan){ echo": Rp. ". number_format( $data->retailer_price, 0, ".", "."). "<br>"; } } ?></td></tr>
                                <tr><td>What's Special</td><td style="border:none;"><?php $special = []; foreach ($pdf1 as $key => $data) If (!$special || !in_array($data->special, $special)) { $special += array( $key => $data->special );
                                if($data->turunan!=$pdf->turunan){ echo" <s><font color='#6594c5'> :$data->special <br></font></s>"; } if($data->turunan==$pdf->turunan){ echo" : $data->special <br>"; } } ?></tr>
                              </table>
                              </td>
                            </tr>
                            <tr class="text-left">
                              <td>Product Concept</td>
                              <td colspan="2">
                                <table>
                                  <tr><td style="border:none;">Weight/Serving </td><td style="border:none;"><?php $wight = []; foreach ($pdf1 as $key => $data) If (!$wight || !in_array($data->wight, $wight)) { $wight += array( $key => $data->wight );
                                  if($data->turunan!=$pdf->turunan){ echo"<s><font color='#6594c5'>: $data->wight/$data->serving<br></font></s>"; } if($data->turunan==$pdf->turunan){ echo": $data->wight/$data->serving<br>"; } } ?></td></tr>
                                  <tr><td>Target NFI price / ctn</td><td style="border:none;"><?php $target_price = [];foreach ($pdf1 as $key => $data)If (!$target_price || !in_array($data->target_price, $target_price)) { $target_price += array($key => $data->target_price);
                                  if($data->turunan!=$pdf->turunan){ echo" <s><font color='#6594c5'>: Rp. ". number_format( $data->target_price, 0, ".", "."). "<br></font></s>"; } if($data->turunan==$pdf->turunan){ echo": Rp. ". number_format( $data->target_price, 0, ".", "."). "<br>"; } } ?></td></tr>
                                  <tr><td>Special Ingredient </td><td style="border:none;"><?php $ingredient = []; foreach ($pdf1 as $key => $data) If (!$ingredient || !in_array($data->ingredient, $ingredient)) { $ingredient += array( $key => $data->ingredient );
                                  if($data->turunan!=$pdf->turunan){ echo"<s><font color='#6594c5'>:$data->ingredient <br></font></s>"; } if($data->turunan==$pdf->turunan){ echo" : $data->ingredient <br>"; } } ?></td></tr>
                                </table><br><br>
                                <table class="table table-bordered" >
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
                                        if($data->turunan!=$pdf->turunan){ echo" <s><font color='#6594c5'>".$data->datakp->komponen."<br></font></s>"; } if($data->turunan==$pdf->turunan){ echo"". $data->datakp->komponen."<br>"; } }  ?>
                                      </td>
                                      <td>
                                        <?php $klaim = []; foreach ($dataklaim as $key => $data) If (!$klaim || !in_array($data->klaim, $klaim)) { $klaim += array( $key => $data->klaim );
                                        if($data->turunan!=$pdf->turunan){ echo" <s><font color='#6594c5'>".$data->klaim."<br></font></s>"; } if($data->turunan==$pdf->turunan){ echo"". $data->klaim."<br>"; } }  ?>
                                      </td>
                                      <td>
                                        <?php $detail = []; foreach ($datadetail as $key => $data) If (!$detail || !in_array($data->datadl->detail, $detail)) { $detail += array( $key => $data->datadl->detail );
                                        if($data->turunan!=$pdf->turunan){ echo" <s><font color='#6594c5'>".$data->datadl->detail."<br></font></s>"; } if($data->turunan==$pdf->turunan){ echo"". $data->datadl->detail."<br>"; } }  ?>
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
                                <table>
                                @foreach($pdf1 as $pdf)
                                @if($pdf->primer!=NULL)
                                  {{ $pdf->primer }}{{ $pdf->s_primer }} 
                                  @elseif($pdf->primer==NULL)
                                  @endif
  
                                  @if($pdf->sekunder1!=NULL)
                                  X {{ $pdf->sekunder1 }}{{ $pdf->s_sekunder1}} 
                                  @elseif($pdf->sekunder1==NULL)
                                  @endif
  
                                  @if($pdf->sekunder2!=NULL)
                                  X {{ $pdf->sekunder2 }}{{ $pdf->s_sekunder2 }}
                                  @elseif($pdf->sekunder2==NULL)
                                  @endif
  
                                  @if($pdf->tersier!=NULL)
                                  X {{ $pdf->tersier }}{{ $pdf->s_tersier }}
                                  @elseif($pdf->tersier==NULL)
                                  @endif
  
                                  @if($pdf->primer==NULL)
                                  {{$pdf->kemas->nama}}
                                  (
                                  @if($pdf->kemas->primer!=NULL)
                                  {{ $pdf->kemas->primer }}{{ $pdf->kemas->s_primer }}
                                  @elseif($pdf->kemas->primer==NULL)
                                  @endif
  
                                  @if($pdf->kemas->sekunder1!=NULL)
                                  X {{ $pdf->kemas->sekunder1 }}{{ $pdf->kemas->s_sekunder1}} 
                                  @elseif($pdf->kemas->sekunder1==NULL)
                                  @endif
  
                                  @if($pdf->kemas->sekunder2!=NULL)
                                  X {{ $pdf->kemas->sekunder2 }}{{ $pdf->kemas->s_sekunder2 }}
                                  @elseif($pdf->sekunder2==NULL)
                                  @endif
  
                                  @if($pdf->kemas->tersier!=NULL)
                                  X {{ $pdf->kemas->tersier }}{{ $pdf->kemas->s_tersier }} 
                                  @elseif($pdf->tersier==NULL)
                                  @endif
                                  )
                                @endif
                                <br> @endforeach <br>
                                @if($pdf->primery!=NULL)
                                <tr><td style="border:1px;" width="55%">Primary</td><th>:</th><td style="border:none;"><?php $primery = []; foreach ($pdf1 as $key => $data) If (!$primery || !in_array($data->primery, $primery)) { $primery += array( $key => $data->primery ); 
                                if($data->turunan!=$pdf->turunan){  echo" <s><font color='#6594c5'>$data->primery<br></font></s>";  } if($data->turunan==$pdf->turunan){ echo" $data->primery<br>"; } }  ?></td></tr>
                                @endif
                                @if($pdf->secondery!=NULL)
                                <tr><td style="border:none;" width="55%">Secondary</td><th>:</th><td style="border:none;"><?php $secondery = []; foreach ($pdf1 as $key => $data) If (!$secondery || !in_array($data->secondery, $secondery)) { $secondery += array( $key => $data->secondery ); 
                                if($data->turunan!=$pdf->turunan){  echo" <s><font color='#6594c5'>$data->secondery<br></font></s>";  } if($data->turunan==$pdf->turunan){ echo" $data->secondery<br>"; } }  ?></td></tr>
                                @endif
                                @if($pdf->Tertiary!=NULL)
                                <tr><td style="border:none;" width="55%">Teriery</td><th>:</th><td style="border:none;"><?php $Tertiary = []; foreach ($pdf1 as $key => $data) If (!$Tertiary || !in_array($data->Tertiary, $Tertiary)) { $Tertiary += array( $key => $data->Tertiary ); 
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
</body>

</html>
<script src="{{ asset('vendors/jquery/dist/jquery.min.js') }}"></script>
<script>
  $(document).ready(function() {
    window.print()
  });
</script>
