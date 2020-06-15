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
                    <div class="col-sm-6">
                      <table ALIGN="left">
    								    <tr><th class="text-right">Revisi No</th> <th>: {{$pdf->revisi}}.{{$pdf->turunan}}</th></tr>
                      </table>
                    </div>
                    <div class="col-sm-6">
									    <table ALIGN="right">
    								    <tr><th class="text-right">Author </th><th>: {{$pdf->author1->name}}</th></tr>
										    <tr><th class="text-right">Last Upadate On</th> <th>: {{$pdf->created_date}}</th></tr>
                        <tr><th class="text-right">Project Name</th><th>: {{ $pdf->project_name }}</th></tr>
                        <tr><th class="text-right">Country</th><th>: {{ $pdf->country }}</th></tr>
                        <tr><th class="text-right">Reference Regulation</th><th>: {{ $pdf->reference }}</th></tr>
                        <tr><th class="text-right">Type</th><th>: {{ $pdf->id_type }}</th></tr>
  								    </table>
                    </div>
                    @endforeach
                    <br>
                    <div  class="col-sm-12">
                      <table width="100%" class="table table-bordered">
                        <thead>
                          <tr>
                            <td>Target market</td>
                            <td colspan="2">
													    <table>
                                <?php $dariusia = []; foreach ($pdf1 as $key => $data) If (!$dariusia || !in_array($data->dariusia, $dariusia)) { $dariusia += array( $key => $data->dariusia );} ?>
														    <tr><th style="border:none;">Age </th><th style="border:none;">@foreach($dariusia as $dariusia): {{$dariusia}}   Tahun - {{$pdf->sampaiusia}} Tahun <br>@endforeach</th></tr>
														    <?php $ses = []; foreach ($datases as $key => $data) If (!$ses || !in_array($data->ses, $ses)) { $ses += array( $key => $data->ses );} ?>
                                <tr><th style="border:none;">SES </th><th style="border:none;"> @foreach($ses as $ses): {{$ses}}<br>@endforeach</th></tr>
														    <?php $gender = []; foreach ($pdf1 as $key => $data) If (!$gender || !in_array($data->gender, $gender)) { $gender += array( $key => $data->gender );} ?>
                                <tr><th style="border:none;">Gender </th><th style="border:none;"> @foreach($gender as $gender): {{$gender}}<br>@endforeach</th></tr>
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
                          <tr>
                            <td>Competitor</td>
                            <td colspan="2">
                              <table>
                                <?php $name = []; foreach ($pdf1 as $key => $data) If (!$name || !in_array($data->name, $name)) { $name += array( $key => $data->name );} ?>
													      <tr><th style="border:none;">Nama </th><th style="border:none;"> @foreach($name as $name) : {{$name}}<br>@endforeach</th></tr>
													      <?php $retailer_price = []; foreach ($pdf1 as $key => $data) If (!$retailer_price || !in_array($data->retailer_price, $retailer_price)) { $retailer_price += array( $key => $data->retailer_price );} ?>
                                <tr><th style="border:none;">Retailer Price </th><th style="border:none;"> @foreach($retailer_price as $retailer_price): {{$retailer_price}}<br>@endforeach</th></tr>
													      <?php $special = []; foreach ($pdf1 as $key => $data) If (!$special || !in_array($data->special, $special)) { $special += array( $key => $data->special );} ?>
                                <tr><th style="border:none;">What's Special </th><th style="border:none;"> @foreach($special as $special): {{$special}}<br>@endforeach</th></tr>
													      <tr><th style="border:none;">Photo </th><th style="border:none;"> :
                                @foreach($picture as $pic)<embed src="{{asset('data_file/'.$pic->filename)}}" width="135px" height="140" type="">
                                @endforeach</th></tr>
													    </table>
												    </td>
                          </tr>
                          <tr>
                            <td>Product Concept</td>
                            <td colspan="2">
													    <table>
                                <?php $wight = []; foreach ($pdf1 as $key => $data) If (!$wight || !in_array($data->wight, $wight)) { $wight += array( $key => $data->wight );} ?>
														    <tr><th style="border:none;">Weight/Serving </th><th style="border:none;"> @foreach($wight as $wight): {{$wight}} / {{$pdf->serving}}<br>@endforeach</th></tr>
														    <?php $target_price = [];foreach ($pdf1 as $key => $data)If (!$target_price || !in_array($data->target_price, $target_price)) { $target_price += array($key => $data->target_price);}?>
                                <tr><th style="border:none;">Target NFI price / ctn </th><th style="border:none;"> @foreach($target_price as $target_price): {{$target_price}}<br>@endforeach</th></tr>
														    <?php $claim = []; foreach ($pdf1 as $key => $data) If (!$claim || !in_array($data->claim, $claim)) { $claim += array( $key => $data->claim );} ?>
                                <tr><th style="border:none;">Claim / function </th><th style="border:none;"> @foreach($claim as $claim): {{$claim}}<br>@endforeach</th></tr>
														    <?php $ingredient = []; foreach ($pdf1 as $key => $data) If (!$ingredient || !in_array($data->ingredient, $ingredient)) { $ingredient += array( $key => $data->ingredient );} ?>
                                <tr><th style="border:none;">Special Ingredient </th><th style="border:none;"> @foreach($ingredient as $ingredient): {{$ingredient}}<br>@endforeach</th></tr>
													    </table>
												    </td>
                          </tr>
                          <tr>
                            <td>Product Concept</td>
                            <td colspan="2">
													    <table>
                              @foreach($pdf1 as $pdf)
                              @if($pdf->primer!=NULL)
														    {{ $pdf->primer }}{{ $pdf->s_primer }} </tr>
														    @elseif($pdf->primer==NULL)
														    @endif

														    @if($pdf->sekunder1!=NULL)
														    X {{ $pdf->sekunder1 }}{{ $pdf->s_sekunder1}} </tr>
														    @elseif($pdf->sekunder1==NULL)
														    @endif

														    @if($pdf->sekunder2!=NULL)
														    X {{ $pdf->sekunder2 }}{{ $pdf->s_sekunder2 }} </tr>
														    @elseif($pdf->sekunder2==NULL)
														    @endif

														    @if($pdf->tersier!=NULL)
														    X {{ $pdf->tersier }}{{ $pdf->s_tersier }} </tr>
														    @elseif($pdf->tersier==NULL)
														    @endif

                                @if($pdf->primer==NULL)
                                {{$pdf->kemas->nama}}
                                (
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
                                )
                                @endif
                                <br> @endforeach <br>
                                <?php $primery = []; foreach ($pdf1 as $key => $data) If (!$primery || !in_array($data->primery, $primery)) { $primery += array( $key => $data->primery );} ?>
														    <tr><th style="border:none;">Primary Information</th><th style="border:none;"> @foreach($primery as $primery): {{$primery}}<br> @endforeach</th></tr>
														    <?php $secondery = []; foreach ($pdf1 as $key => $data) If (!$secondery || !in_array($data->secondery, $secondery)) { $secondery += array( $key => $data->secondery );} ?>
                                <tr><th style="border:none;">Secondary Information</th><th style="border:none;"> @foreach($secondery as $secondery): {{$secondery}}<br> @endforeach</th></tr>
														    <?php $Tertiary = [];foreach ($pdf1 as $key => $data) If (!$Tertiary || !in_array($data->Tertiary, $Tertiary)) { $Tertiary += array( $key => $data->Tertiary );} ?>
                                <tr><th style="border:none;">Tertiary Information</th><th style="border:none;"> @foreach($Tertiary as $Tertiary): {{$Tertiary}}<br> @endforeach</th></tr>
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
</body>

</html>
<script src="{{ asset('vendors/jquery/dist/jquery.min.js') }}"></script>
<script>
  $(document).ready(function() {
    window.print()
  });
</script>
