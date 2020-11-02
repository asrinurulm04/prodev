@extends('manager.tempmanager')
@section('title', 'data PKP')
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
            @foreach($pkpp as $pkp)
            @if($pkp->status_project=='sent' || $pkp->status_project=='proses')
              @if(Auth::user()->departement->dept!='RKA')
                @if($pkp->status_terima=='terima')
                <a class="btn btn-sm btn-danger" href="{{ route('daftarpkp',$pkp->id_project)}}"><i class="fa fa-share"></i>Back</a>
                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#kirim{{ $pkp->id_project  }}"><i class="fa fa-paper-plane"></i> Assign</a></button>
                  @if($pengajuan==0)
                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#ajukan{{ $pkp->id_project  }}"><i class="fa fa-comments-o"></i> Sent Revision request</a></button>
                  @endif
                  <a class="btn btn-sm btn-warning" onclick="return confirm('Print this data PKP ?')" href="{{ Route('download',['id_project' => $pkp->id_project, 'revisi' => $pkp->revisi, 'turunan' => $pkp->turunan]) }}"><li class="fa fa-print"></li> Download/print PKP</a>
                @elseif($pkp->status_terima=='proses')
                <?php $last = Date('j-F-Y'); ?>
                <form class="form-horizontal form-label-left" method="POST" action="{{ route('approve1',$pkp->id_project) }}" novalidate>
                  <a class="btn btn-sm btn-danger" href="{{ route('daftarpkp',$pkp->id_project)}}"><i class="fa fa-share"></i>Back</a>
                  <input type="hidden" value="{{$last}}" name="tgl">
                  @if($pengajuan==0)
                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#ajukan{{ $pkp->id_project  }}"><i class="fa fa-comments-o"></i> Sent Revision request</a></button>
                  @endif
                  <button type="submit" class="btn btn-dark btn-sm"><li class="fa fa-check"></li> Approve data</button>
                  <a class="btn btn-sm btn-warning" onclick="return confirm('Print this data PKP ?')" href="{{ Route('download',['id_project' => $pkp->id_project, 'revisi' => $pkp->revisi, 'turunan' => $pkp->turunan]) }}"><li class="fa fa-print"></li> Download/print PKP</a>
                  {{ csrf_field() }}
                </form>
                @endif
              @elseif(Auth::user()->departement->dept=='RKA')
                @if($pkp->status_terima2=='terima')
                <a class="btn btn-sm btn-danger" href="{{ route('daftarpkp',$pkp->id_project)}}"><i class="fa fa-share"></i>Back</a>
                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#kirim{{ $pkp->id_project  }}"><i class="fa fa-paper-plane"></i> Assign</a></button>
                  @if($pengajuan==0)
                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#ajukan{{ $pkp->id_project  }}"><i class="fa fa-comments-o"></i> Sent Revision request</a></button>
                  @endif
                  <a class="btn btn-sm btn-warning" onclick="return confirm('Print this data PKP ?')" href="{{ Route('download',['id_project' => $pkp->id_project, 'revisi' => $pkp->revisi, 'turunan' => $pkp->turunan]) }}"><li class="fa fa-print"></li> Download/print PKP</a>
                @elseif($pkp->status_terima2=='proses')
                <?php $last = Date('j-F-Y'); ?>
                <form class="form-horizontal form-label-left" method="POST" action="{{ route('approve2',$pkp->id_project) }}" novalidate>
                  <a class="btn btn-sm btn-danger" href="{{ route('daftarpkp',$pkp->id_project)}}"><i class="fa fa-share"></i>Back</a>
                  <input type="hidden" value="{{$last}}" name="tgl">
                  @if($pengajuan==0)
                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#ajukan{{ $pkp->id_project  }}"><i class="fa fa-comments-o"></i> Sent Revision request</a></button>
                  @endif
                  <button type="submit" class="btn btn-dark btn-sm"><li class="fa fa-check"></li> Approve data</button>
                  {{ csrf_field() }}<a class="btn btn-sm btn-warning" onclick="return confirm('Print this data PKP ?')" href="{{ Route('download',['id_project' => $pkp->id_project, 'revisi' => $pkp->revisi, 'turunan' => $pkp->turunan]) }}"><li class="fa fa-print"></li> Download/print PKP</a>
                </form>
                @endif
              @endif
            @else
              <a class="btn btn-sm btn-danger" href="{{ route('daftarpkp',$pkp->id_project)}}"><i class="fa fa-share"></i>Back</a>
              <a class="btn btn-sm btn-warning" onclick="return confirm('Print this data PKP ?')" href="{{ Route('download',['id_project' => $pkp->id_project, 'revisi' => $pkp->revisi, 'turunan' => $pkp->turunan]) }}"><li class="fa fa-print"></li> Download/print PKP</a>
            @endif
            
            
          </div> 
          <div class="tab-content panel ">
            <div class="tab-pane active" id="1">
              @php $no = 0; @endphp 
              <div class="panel-default">	
						  	<div class="panel-body badan">
							  	<label>PT. NUTRIFOOD INDONESIA</label>
									<table ALIGN="right">
    								<tr>
    								  <th class="text-right">KODE FORM : F.Q.201</th>
    								</tr>
  								</table>
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
									<div class="row">
                    <div class="col-sm-6">
                      <table ALIGN="left">
    								    <tr><th class="text-left">Revision Number</th> <th> : {{$pkp->revisi}}.{{$pkp->turunan}}</th></tr>
    								    <tr><th class="text-left">PKP Number</th> <th> : {{$pkp->pkp_number}}{{$pkp->ket_no}}</th></tr>
                      </table>
                    </div>
                    <div class="col-sm-6">
                      <table ALIGN="right">
                        <tr><th class="text-right">Author </th><th>: {{$pkp->datapkpp->author1->name}}</th></tr>
                        <tr><th class="text-right">Created date</th> <th>: {{$pkp->created_date}}</th></tr>
                        <tr><th class="text-right">Last Upadate On</th> <th>: {{$pkp->last_update}}</th></tr>
                        <tr><th class="text-right">Last Sent</th> <th>: {{$pkp->datapkpp->tgl_kirim}}</th></tr>
                        <tr><th class="text-right">Revised By</th><th>: @if($pkp->perevisi!=NULL) {{$pkp->perevisi2->name}}@endif</th></tr>
                      </table><br><br>
                    </div>
                  </div>
                  @endforeach
									  <table class=" table table-bordered">
                      <tr>
                        <th colspan="3" class="text-center"><span style="font-weight: bold;font-size: 20px;" class="card-title">Background</span></th>
                      </tr>
                      <tr>
                        <td width="300px">Idea</td>
                        <td colspan="2"> <?php $ideas = []; foreach ($pkp1 as $key => $data) If (!$ideas || !in_array($data->idea, $ideas)) {$ideas += array($key => $data->idea);
                        if($data->revisi!=$pkp->revisi){ echo" <s><font color='#6594c5'>$data->idea<br></font></s>"; }if($data->revisi==$pkp->revisi){ echo" $data->idea<br>"; } } ?></td>
                      </tr>
                      <tr>
                        <td>Target market</td>
                        <td colspan="2">
													<table>
	
                            <tr><td style="border:none;">Gender </td><td style="border:none;"> 
                            <?php $dataG = []; foreach ($pkp1 as $key => $data) If (!$dataG || !in_array($data->gender, $dataG)) { $dataG += array( $key => $data->gender );if($data->revisi!=$pkp->revisi){
                            echo"<s><font color='#6594c5'>:  $data->gender<br></font></s>"; } if($data->revisi==$pkp->revisi){ echo": $data->gender <br>"; } } ?></td></tr>
														
                            <tr><td style="border:none;">Age </td><td style="border:none;"> 
                            <?php $dariumur = []; foreach ($pkp1 as $key => $data) If (!$dariumur || !in_array($data->dariumur, $dariumur)) { $dariumur += array( $key => $data->dariumur ); if($data->revisi!=$pkp->revisi){
                            echo": <s><font color='#6594c5'>$data->dariumur</font></s>";} if($data->revisi==$pkp->revisi){ echo": $data->dariumur ";} } ?>
                            -<?php $sampaiumur = []; foreach ($pkp1 as $key => $data) If (!$sampaiumur || !in_array($data->sampaiumur, $sampaiumur)) { $sampaiumur += array( $key => $data->sampaiumur ); if($data->revisi!=$pkp->revisi){
                              echo" <s><font color='#6594c5'>$data->sampaiumur</font></s>";} if($data->revisi==$pkp->revisi){ echo" $data->sampaiumur ";} } ?> </td></tr>
														
                            <tr><td style="border:none;">SES </td><td style="border:none;"> 
                            <?php $ses = []; foreach ($datases as $key => $data) If (!$ses || !in_array($data->ses, $ses)) { $ses += array( $key => $data->ses ); 
                             echo": $data->ses<br>"; } ?></td></tr>
                          
                          <tr><td style="border:none;">Remarks SES </td><td style="border:none;"> 
                          <?php $remarks_ses = []; foreach ($pkp1 as $key => $data) If (!$remarks_ses || !in_array($data->remarks_ses, $remarks_ses)) { $remarks_ses += array( $key => $data->remarks_ses ); if($data->revisi!=$pkp->revisi){
                            echo": <s><font color='#6594c5'>$data->remarks_ses</font></s>";} if($data->revisi==$pkp->revisi){ echo" : $data->remarks_ses ";} } ?></td></tr>
                          </table>
												</td>
                      </tr>
                      <tr>
                      <td>Uniqueness of idea</td>
                        <td colspan="2"><?php $Uniqueness = []; foreach ($pkp1 as $key => $data) If (!$Uniqueness || !in_array($data->Uniqueness, $Uniqueness)) { $Uniqueness += array( $key => $data->Uniqueness ); 
                        if($data->revisi!=$pkp->revisi){ echo" <s><font color='#6594c5'>$data->Uniqueness <br></font></s>"; } if($data->revisi==$pkp->revisi){ echo" $data->Uniqueness <br>";} } ?></td>
                      </tr>
                      <tr>
                      <td>Estimated potential market</td>
                        <td colspan="2"><?php $Estimated = []; foreach ($pkp1 as $key => $data) If (!$Estimated || !in_array($data->Estimated, $Estimated)) {  $Estimated += array(  $key => $data->Estimated ); 
                        if($data->revisi!=$pkp->revisi){ echo" <s><font color='#6594c5'>$data->Estimated <br></font></s>"; } if($data->revisi==$pkp->revisi){ echo" $data->Estimated <br>"; } } ?></td>
                      </tr>
                      <tr class="table-highlight">
                        <td>Reason(s)</td>
                        <td colspan="2"><?php $reason = []; foreach ($pkp1 as $key => $data) If (!$reason || !in_array($data->reason, $reason)) { $reason += array( $key => $data->reason ); 
                        if($data->revisi!=$pkp->revisi){ echo" <s><font color='#6594c5'>$data->reason<br></font></s>";} if($data->revisi==$pkp->revisi){ echo" $data->reason <br>"; } } ?></td>
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
                            if($data->revisi!=$pkp->revisi){ echo" <s><font color='#6594c5'>$data->launch $data->years<br></font></s>"; } if($data->revisi==$pkp->revisi){ echo" $data->launch $data->years<br>"; } } ?>

                            <?php $tgl_launch = []; foreach ($pkp1 as $key => $data) If (!$tgl_launch || !in_array($data->tgl_launch, $tgl_launch)) { $tgl_launch += array( $key => $data->tgl_launch ); 
                            if($data->revisi!=$pkp->revisi){ echo" <s><font color='#6594c5'>$data->tgl_launch<br></font></s>"; } if($data->revisi==$pkp->revisi){ echo" $data->tgl_launch<br>"; } } ?>
                            </tr>
													</table>
												</td>
                      </tr>
                      <tr>
                        <td>Aisle Placement</td>
                        <td colspan="2"><?php $aisle = []; foreach ($pkp1 as $key => $data) If (!$aisle || !in_array($data->aisle, $aisle)) { $aisle += array( $key => $data->aisle ); 
                        if($data->revisi!=$pkp->revisi){ echo" <s><font color='#6594c5'>$data->aisle<br></font></s>"; } if($data->revisi==$pkp->revisi){ echo" $data->aisle<br>"; } } ?></td>
                      </tr>
                      <tr>
                        <td>Sales Forecast</td>
                        <td colspan="2"><?php $seles = []; foreach ($for as $key => $data) If (!$seles || !in_array($data->forecast, $seles)) { $seles += array( $key => $data->forecast ); 
                        if($data->forecast!=null){ echo"Rp. ". number_format($data->forecast, 0, ".", "."). " ($data->satuan)  <br>"; } } ?>
                      <br>
                        <?php $remarks_forecash = []; foreach ($for as $key => $data) If (!$remarks_forecash || !in_array($data->remarks_forecash, $remarks_forecash)) { $remarks_forecash += array( $key => $data->remarks_forecash ); 
                        if($data->revisi!=$pkp->revisi){ echo"remarks forecast: <s><font color='#6594c5'>$data->remarks_forecash<br></font></s>"; } if($data->revisi==$pkp->revisi){ echo"remarks forecast: $data->remarks_forecash <br>";  } } ?></td>
                      </tr>
											<tr>
                        <td>NF Selling Price (Before ppn)</td>
                        <td colspan="2">
                          <table>
                            <tr>
                              <td>
                                <?php $selling_price = []; foreach ($pkp1 as $key => $data) If (!$selling_price || !in_array($data->selling_price, $selling_price)) { $selling_price += array( $key => $data->selling_price ); 
                                if($data->revisi!=$pkp->revisi){ echo" <s><font color='#6594c5'>Rp. ". number_format($data->selling_price, 0, ".", "."). " <br></font></s>"; } if($data->revisi==$pkp->revisi){ echo"Rp. ". number_format($data->selling_price, 0, ".", "."). "  <br>"; } }  ?>
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>Consumer price target</td>
                        <td colspan="2">
                          <table>
                            <tr>
                              <td>
                                <?php $price = []; foreach ($pkp1 as $key => $data) If (!$price || !in_array($data->price, $price)) { $price += array( $key => $data->price ); 
                                if($data->revisi!=$pkp->revisi){ echo" <s><font color='#6594c5'>Rp. ". number_format($data->price, 0, ".", "."). " <br></font></s>"; } if($data->revisi==$pkp->revisi){ echo"Rp. ". number_format($data->price, 0, ".", "."). " <br>"; } } ?>
                              </td>
                            </tr>
                          </table>
                        </td>
											</tr>
                      <tr class="table-highlight">
                        <td>UOM</td>
                        <td colspan="2"><?php $uom = []; foreach ($pkp1 as $key => $data) If (!$uom || !in_array($data->UOM, $uom)) { $uom += array( $key => $data->UOM ); 
                        if($data->revisi!=$pkp->revisi){ echo" <s><font color='#6594c5'>".$data->UOM."<br></font></s>"; } if($data->revisi==$pkp->revisi){ echo" ".$data->UOM."<br>"; } }  ?></td>
                      </tr>
                      <tr class="table-highlight">
                        <td>Competitive Analysis</td>
                        <td colspan="2"><?php $competitive = []; foreach ($pkp1 as $key => $data) If (!$competitive || !in_array($data->competitive, $competitive)) { $competitive += array( $key => $data->competitive ); 
                        if($data->revisi!=$pkp->revisi){ echo" <s><font color='#6594c5'>$data->competitive <br></font></s>"; } if($data->revisi==$pkp->revisi){ echo" $data->competitive <br>"; } }  ?></td>
                      </tr>
                      <tr class="table-highlight">
                        <td>Main Competitor</td>
                        <td colspan="2"><?php $competitor = []; foreach ($pkp1 as $key => $data) If (!$competitor || !in_array($data->competitor, $competitor)) {$competitor += array( $key => $data->competitor ); 
                        if($data->revisi!=$pkp->revisi){ echo" <s><font color='#6594c5'>$data->competitor <br></font></s>"; } if($data->revisi==$pkp->revisi){ echo" $data->competitor <br>"; } }  ?></td>
                      </tr>
                      <tr>
                        <th colspan="3" class="text-center"><span style="font-weight: bold;font-size: 20px;" class="card-title">Product features</span></th>
                      </tr>
                      <tr>
                        <td>Product Form</td>
                        <td colspan="2"><?php $product_form = []; foreach ($pkp1 as $key => $data) If (!$product_form || !in_array($data->product_form, $product_form)) { $product_form += array( $key => $data->product_form  ); 
                        if($data->revisi!=$pkp->revisi){ echo" <s><font color='#6594c5'>$data->product_form<br></font></s>"; } if($data->revisi==$pkp->revisi){ echo" $data->product_form<br>"; } }  ?>
                        <br>
                        <?php $remarks_product_form = []; foreach ($pkp1 as $key => $data) If (!$remarks_product_form || !in_array($data->remarks_product_form, $remarks_product_form)) { $remarks_product_form += array( $key => $data->remarks_product_form  ); 
                        if($data->revisi!=$pkp->revisi){ echo"Remarks : <s><font color='#6594c5'>$data->remarks_product_form<br></font></s>"; } if($data->revisi==$pkp->revisi){ echo"Remarks: $data->remarks_product_form<br>"; } }  ?></td>
                      </tr>
                      <tr>
                      <td>Product Packaging</td>
                        <td colspan="2">
													<table>

                            @if($pkp->kemas_eksis!=NULL)
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
                            <br>
														<br>
														<tr><th style="border:none;"> Optional</th></tr>
                            @if($pkp->primery!=NULL)
														<tr><th width="35%">Primary information</th><th>:</th><th style="border:none;"><?php $primery = []; foreach ($pkp1 as $key => $data) If (!$primery || !in_array($data->primery, $primery)) { $primery += array( $key => $data->primery ); 
                              if($data->revisi!=$pkp->revisi){  echo" <s><font color='#ffa2a2'>$data->primery<br></font></s>";  } if($data->revisi==$pkp->revisi){ echo" $data->primery<br>"; } }  ?></th></tr>
                            @endif
                            @if($pkp->secondary!=NULL)
                            <tr><th width="35%">Secondary information</th><th>:</th><th style="border:none;"><?php $secondary = []; foreach ($pkp1 as $key => $data) If (!$secondary || !in_array($data->secondary, $secondary)) { $secondary += array( $key => $data->secondary ); 
                              if($data->revisi!=$pkp->revisi){  echo" <s><font color='#ffa2a2'>$data->secondary<br></font></s>";  } if($data->revisi==$pkp->revisi){ echo" $data->secondary<br>"; } }  ?></th></tr>
                            @endif
                            @if($pkp->tertiary!=NULL)
                            <tr><th width="35%">Teriery information</th><th>:</th><th style="border:none;"><?php $tertiary = []; foreach ($pkp1 as $key => $data) If (!$tertiary || !in_array($data->tertiary, $tertiary)) { $tertiary += array( $key => $data->tertiary ); 
                              if($data->revisi!=$pkp->revisi){  echo" <s><font color='#ffa2a2'>$data->tertiary<br></font></s>";  } if($data->revisi==$pkp->revisi){ echo" $data->tertiary<br>"; } }  ?></th></tr>
                            @endif
													</table>
												</td>
                      </tr>
                      <tr>
                        <td>Food Category (BPOM)</td>
                        <td colspan="2"><?php $pangan = []; foreach ($pkp1 as $key => $data) If (!$pangan || !in_array($data->katpangan->kategori, $pangan)) { $pangan += array( $key => $data->katpangan->kategori );  
                        if($data->revisi!=$pkp->revisi){ echo" <s><font color='#6594c5'>"."(".$data->katpangan->no_kategori .") ". $data->katpangan->kategori." <br></font></s>"; } if($data->revisi==$pkp->revisi){ echo "(".$data->katpangan->no_kategori .") ". $data->katpangan->kategori." <br>"; } }  ?>  
                        <br></td>
                      </tr>
                      <tr>
                        <td>AKG</td>
                        <td>
                          <?php $tarkon = []; foreach ($pkp1 as $key => $data) If (!$tarkon || !in_array($data->tarkon->tarkon, $tarkon)) { $tarkon += array( $key => $data->tarkon->tarkon ); 
                          if($data->revisi!=$pkp->revisi){ echo" <s><font color='#6594c5'>".$data->tarkon->tarkon."<br></font></s>"; } if($data->revisi==$pkp->revisi){ echo"". $data->tarkon->tarkon."<br>"; } }  ?>
                        </td>
                      </tr>
                      <tr class="table-highlight">
                        <td>Prefered Flavour</td>
                        <td colspan="2"><?php $prefered_flavour = []; foreach ($pkp1 as $key => $data) If (!$prefered_flavour || !in_array($data->prefered_flavour, $prefered_flavour)) { $prefered_flavour += array( $key => $data->prefered_flavour ); 
                        if($data->revisi!=$pkp->revisi){  echo" <s><font color='#6594c5'>$data->prefered_flavour<br></font></s>";  } if($data->revisi==$pkp->revisi){ echo" $data->prefered_flavour<br>"; } }  ?></td>
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
                              <tbody>
                                  <tr>
                                    <td>Komponen</td>
                                    <td>Klaim</td>
                                    <td>Detail</td>
                                    <td></td>
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
                                    <td>
                                      <?php $note = []; foreach ($dataklaim as $key => $data) If (!$note || !in_array($data->note, $note)) { $note += array( $key => $data->note );
                                      if($data->revisi!=$pkp->revisi){ echo" <s><font color='#ffa2a2'>".$data->note."<br></font></s>"; } if($data->revisi==$pkp->revisi){ echo"". $data->note."<br>"; } }  ?>
                                    </td>
                                  </tr>
                                </tbody>
      					          </table>
												</td>
                      </tr>
                      <tr>
                        <td>Serving Suggestion</td>
                        <td colspan="2"><?php $serving = []; foreach ($pkp1 as $key => $data) If (!$serving || !in_array($data->serving_suggestion, $serving)) { $serving += array( $key => $data->serving_suggestion ); 
                        if($data->revisi!=$pkp->revisi){ echo" <s><font color='#6594c5'>$data->serving_suggestion<br></font></s>"; } if($data->revisi==$pkp->revisi){ echo" $data->serving_suggestion<br>"; } }  ?></td>
                      </tr>
                      <tr>
                        <td>Mandatory Ingredients</td>
                        <td colspan="2"><?php $mandatory_ingredient = []; foreach ($pkp1 as $key => $data) If (!$mandatory_ingredient || !in_array($data->mandatory_ingredient, $mandatory_ingredient)) { $mandatory_ingredient += array( $key => $data->mandatory_ingredient ); 
                        if($data->revisi!=$pkp->revisi){ echo" <s><font color='#6594c5'>$data->mandatory_ingredient<br></font></s>"; } if($data->revisi==$pkp->revisi){ echo" $data->mandatory_ingredient<br>"; } }  ?></td>
                      </tr>
                      {{-- <tr>
                        <td>Related Picture</td>
                        <td colspan="2">
                          <table class="table table-bordered">
                            <tr class="text-center">
                              <td>Filename</td>
                              <td>File</td>
                              <td>Information</td>
                              <td></td>
                            </tr>
                            @foreach($picture as $pic)
                            <tr>
                              <td>{{$pic->filename}} </td>
                              <td class="text-center"><embed src="{{asset('data_file/'.$pic->filename)}}" width="90px" height="90" type=""></td>
                              <td width="40%"> &nbsp{{$pic->informasi}}</td>  
                              <td width="10%" class="text-center"><a href="{{asset('data_file/'.$pic->filename)}}" download="{{$pic->filename}}"><button class="btn btn-primary btn-sm"><li class="fa fa-download"></li></button></a></td>
                            </tr>
                            @endforeach
                          </table>
                        </td>
                      </tr> --}}

                    </table>
                  <table class="table table-striped table-bordered">
                    <thead>
                      <tr style="background-color:#bfc2c5;"><td class="text-center" colspan="5">ATTENTION</td></tr>
                      <tr><td style="background-color:#ffffff;" width="30%"></td><td style="border:none;background-color:#bfc2c5;"> compulsory; filled by QBX (brand function) Managers</td></tr>
                      <tr><td style="background-color:#13699a;" width="30%"></td><td style="border:none;background-color:#bfc2c5;">should only be filled with great certainty</td></tr>
                      <tr><td style="background-color:#e41356;" width="30%"></td><td style="border:none;background-color:#bfc2c5;"> should only be filled after discussion with QPA</td></tr>
                      <tr>
                        <td style="background-color:#bfc2c5;">Service Level Agreements</td>
                        <td style="background-color:#bfc2c5;">
                          <table>
                            <thead>
                              <tr><td style="border:none;">Lead Time QBX (brand function)</td><td style="border:none;">5 workdays</td></tr>
                              <tr><td style="border:none;">Lead Time QPA (product development function)</td><td style="border:none;">[1 (benefits) + 2 (COGS)] = 2 workdays</td></tr>
                              <tr><td style="border:none;">Lead Time Revision </td><td style="border:none;">2 workdays</td></tr>
                            </thead>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td style="background-color:#bfc2c5;">Process</td>
                        <td style="background-color:#bfc2c5;">
                          <table>
                            <thead>
                              <tr><td style="border:none;">After being filled. HOD approval request. Then, forward to RD as low priority project. Will be further</td></tr>
                              <tr><td style="border:none;">prioritized in PV Cross Funct Mtg. </td></tr>
                              <tr><td style="border:none;">Meanwhile, RD can prepare SLA projection to propose into PV's SLA for the project based on</td></tr>
                              <tr><td style="border:none;">capacity and feasibility.</td></tr>
                            </thead>
                          </table>
                        </td>
                      </tr>
                    </thead>
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
</div>

<!-- modal -->
<div class="modal" id="kirim{{ $pkp->id_project  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">                 
        <h3 class="modal-title" id="exampleModalLabel">Sent PKP
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button></h3>
      </div>
      <div class="modal-body">
        <form class="form-horizontal form-label-left" method="POST" action="{{ Route('edittuser',$pkp->id_project)}}" novalidate>
        <div class="form-group row">
          <label class="control-label text-bold col-md-2 col-sm-3 col-xs-12 text-center"> User</label>
          @if(Auth::user()->departement->dept!="RKA")
          @if($pkp->userpenerima2!='NULL')
          <input type="hidden" value="{{$pkp->userpenerima2}}" name="user2">
          @endif
          <div class="col-md-9 col-sm-9 col-xs-12">
            <select required name="user" class="form-control form-control-line" id="user">
            <option disabled selected>Select User</option>
            @foreach($user as $user)
            @if($user->id!=Auth::user()->id)
              <option required value="{{$user->id}}">{{ $user->name }}</option>
              @endif
              @endforeach
            </select>
          </div>
          @elseif(Auth::user()->departement->dept=="RKA")
          @if($pkp->userpenerima!='NULL')
          <input type="hidden" value="{{$pkp->userpenerima}}" name="user">
          @endif
          <div class="col-md-9 col-sm-9 col-xs-12">
            <select required name="user2" class="form-control form-control-line" id="user2">
            <option disabled selected>Select User</option>
            @foreach($user as $user)
            @if($user->id!=Auth::user()->id)
            <option required value="{{$user->id}}">{{ $user->name }}</option>
            @endif
              @endforeach
            </select>
          </div>
          @endif
        </div>
        
        @foreach($picture as $pic)
          <input type="hidden" value="{{$pic->lokasi}}" name="pic[]" id="pic">
        @endforeach
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Assign</button>
          {{ csrf_field() }}
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal Selesai -->

<!-- Modal -->
<div class="modal" id="ajukan{{ $pkp->id_project  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">                 
        <h3 class="modal-title" id="exampleModalLabel">Sent Revision request
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button></h3>
      </div>
      <div class="modal-body">
        <form class="form-horizontal form-label-left" method="POST" action="{{ Route('pengajuan')}}" novalidate>
        <div class="form-group row">
        <input type="hidden" value="{{$pkp->id_project}}" name="pkp">
        <input type="hidden" value="{{$pkp->revisi}}" name="turunan">
        <input type="hidden" value="{{$pkp->author}}" name="kirimauthor">
          <label class="control-label text-bold col-md-2 col-sm-3 col-xs-12 text-center">Destination</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="hidden" value="{{$pkp->perevisi}}" name="kirim">
            <input type="text" value="{{$pkp->perevisi2->name}}" disabled class="form-control">
          </div>
        </div>
        <div class="form-group row">
          <label class="control-label text-bold col-md-2 col-sm-3 col-xs-12 text-center">Note</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <textarea name="catatan" id="catatan" class="col-md-12 col-sm-12 col-xs-12"></textarea>
          </div>
        </div>
        <div class="form-group row">
          <label class="control-label text-bold col-md-2 col-sm-3 col-xs-12 text-center">request priority</label>
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
          <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Sent</button>
          {{ csrf_field() }}
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal Selesai -->
@endsection