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
                            <table>
                              <tr><th>Name</th><td style="border:none;"><?php $name = []; foreach ($pdf1 as $key => $data) If (!$name || !in_array($data->name, $name)) { $name += array( $key => $data->name );
                              if($data->turunan!=$pdf->turunan){ echo" : <s><font color='#6594c5'>$data->name <br></font></s>"; } if($data->turunan==$pdf->turunan){ echo" : $data->name <br>"; } } ?></td></tr>
													    <tr><th>What's Special</th><td style="border:none;"><?php $special = []; foreach ($pdf1 as $key => $data) If (!$special || !in_array($data->special, $special)) { $special += array( $key => $data->special );
                              if($data->turunan!=$pdf->turunan){ echo" <s><font color='#6594c5'> :$data->special <br></font></s>"; } if($data->turunan==$pdf->turunan){ echo" : $data->special <br>"; } } ?></tr>
													  </table>
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
 </div> 
</body>

</html>
<script src="{{ asset('vendors/jquery/dist/jquery.min.js') }}"></script>
<script>
  $(document).ready(function() {
    window.print()
  });
</script>
