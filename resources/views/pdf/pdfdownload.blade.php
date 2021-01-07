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
                    @foreach($pdf1 as $pdf)
                    <div  class="col-sm-12">
                    <table width="100%" class="table table-bordered">
                        <thead>
                          <tr style="background-color:grey;font-weight: bold;color:white;font-size: 15px;"><td colspan="2" class="text-center">{{$pdf->project_name}}</td></tr>
                          <tr>
                            <td>Target market</td>
                            <td colspan="2">
													    <table>
                                <tr><th>Age</th><td>: {{$pdf->dariusia}} To {{$pdf->sampaiusia}}</td></tr>
													      <tr><th>SES</th><td><?php $ses = []; foreach ($datases as $key => $data) If (!$ses || !in_array($data->ses, $ses)) { $ses += array( $key => $data->ses );if($data->turunan!=$pdf->turunan){
                                echo" : <s><font color='#6594c5'>$data->ses </font><br></s>"; } if($data->turunan==$pdf->turunan){ echo" : $data->ses <br>";} } ?></td></tr>
														    <tr><th>Gender</th><td>: {{$pdf->gender}}</td></tr>
                                <tr><th>Other</th><td>: {{$pdf->other}}</td></tr>
                              </table>
												    </td>
                          </tr>
                          <tr>
                            <td>Background / Insight</td>
                            <td>: {{$pdf->background}}</td>
                          </tr>
                          <tr>
                            <td>Attracttiveness</td>
                            <td colspan="2">{{$pdf->attractiveness}}</td>
                          </tr>
                          <tr>
                            <td>Target RTO</td>
                            <td colspan="2">{{$pdf->rto}}</td>
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
                              <tr><th>Name</th><td style="border:none;">: {{$pdf->name}}</td></tr>
													    <tr><th>What's Special</th><td style="border:none;">: {{$pdf->special}}</td></tr>
													  </table>
												    </td>
                          </tr>
                          <tr>
                            <td>Product Concept</td>
                            <td colspan="2">
													    <table>
                                <tr><th style="border:none;">Weight/Serving </th><td style="border:none;">: {{$pdf->wight}}/{{$pdf->serving}}</td></tr>
														    <tr><th>Special Ingredient </th><td style="border:none;">: {{$pdf->ingredient}}</td></tr>
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
                        </thead>
                      </table>
                    </div>
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
</body>

</html>
<script src="{{ asset('vendors/jquery/dist/jquery.min.js') }}"></script>
<script>
  $(document).ready(function() {
    window.print()
  });
</script>
