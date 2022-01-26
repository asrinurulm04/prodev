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
          <div class="tab-content" style="background-image:url(img/biru.jpg);">
            <div class="tab-pane active" id="1">
              @php $no = 0; @endphp
              <div class="panel-default">
								<div class="panel-body badan">
									<label>PT. NUTRIFOOD INDONESIA</label>
										<center> <h2 style="font-size: 22px;font-weight: bold;">PENGEMBANGAN KONSEP AWAL PRODUK BARU</h2> </center>
  									<center> <h2 style="font-size: 20px;font-weight: bold;">( PKP )</h2> </center><br>
										<center> <h2 style="font-weight: bold;">[ {{ $id_pkp->id_brand }} ] &reg;</h2> </center>
      							<table class="table table-bordered" style="font-size:12px">
                      <tr><th style="background-color:#13699a;font-weight: bold;color:white;font-size: 20px;" class="text-center">{{ $id_pkp->project_name }}</th></tr>
										</table>
										<div class="row">
                      <div class="col-sm-6">
                        <table ALIGN="left">
                          <tr><th class="text-right">Revisi No</th> <th>: {{$id_pkp->revisi}}.{{$id_pkp->turunan}}</th></tr>
                        </table>
                      </div>
                      <div class="col-sm-6">
                        <table ALIGN="right">
                          <tr><th class="text-right">Author </th><th>: {{$id_pkp->author1->name}}</th></tr>
                          <tr><th class="text-right">Created date</th> <th>: {{$id_pkp->created_date}}</th></tr>
                          <tr><th class="text-right">Last Upadate On</th> <th>: {{$id_pkp->last_update}}</th></tr>
                          <tr><th class="text-right">Revised By</th><th>: @if($id_pkp->perevisi!=NULL) {{$id_pkp->perevisi2->name}} @endif</th></tr>
                        </table><br><br>
                      </div>
                    </div>
										<table class=" table table-bordered">
                      <tr><th colspan="3" class="text-center"><span style="font-weight: bold;font-size: 20px;" class="card-title">Background</span></th></tr>
                      <tr>
                        <th style="min-width:200px">Idea</th>
                        <td colspan="2">{{$id_pkp->idea}}</td>
                      </tr>
                      <tr>
                        <th>Target market</th>
                        <td colspan="2">
                          <table>
                            <tr><th style="border:none;">Gender </th><td style="border:none;"> {{$id_pkp->gender}}</td></tr>
                            <tr><th style="border:none;">Usia </th><td style="border:none;"> {{$id_pkp->dariumur}} to {{$id_pkp->sampaiumur}}</td></tr>
                            <tr><th style="border:none;">SES </th><td style="border:none;"> @foreach($datases as $data) {{$data->ses}} @endforeach</td></tr>
                            <tr><th style="border:none;">Remarks SES </th><td style="border:none;"> {{$id_pkp->remarks_ses}}</td></tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <th>Uniqueness of idea</th>
                        <td colspan="2">{{$id_pkp->Uniqueness}}</td>
                      </tr>
                      <tr>
                        <th>Estimated potential market</th>
                        <td colspan="2">{{$id_pkp->Estimated}}</td>
                      </tr>
                      <tr class="table-highlight">
                        <th>Reason(s)</th>
                        <td colspan="2">{{$id_pkp->reason}}</td>
                      </tr>
                      <tr><th colspan="3" class="text-center"><span style="font-weight: bold;font-size: 20px;" class="card-title">Market Analysis</span></th></tr>
                      <tr>
                        <th>Launch Deadline</th>
                        <td colspan="2">{{$id_pkp->launch}} {{$id_pkp->years}}</td>
                      </tr>
                      <tr>
                        <th>Aisle Placement</th>
                        <td colspan="2">{{$id_pkp->aisle}}</td>
                      </tr>
                      <tr>
                        <th>Sales Forecast</th>
                        <td colspan="2">@foreach($for as $data) {{$data->satuan}} = {{$data->forecast}} @endforeach
                        <br> {{$id_pkp->remarks_forecash}}
                      </tr>
                      <tr>
                        <th>NF Selling Price (Before ppn)</th>
                        <td colspan="2">{{$id_pkp->selling_price}} / {{$id_pkp->UOM}}</td>
                      </tr>
                        <th>Consumer price target</th>
                        <td colspan="2">{{$id_pkp->price}} / {{$id_pkp->UOM}}</td>
                      </tr>
                      <tr class="table-highlight">
                        <th>Main Competitor</th>
                        <td colspan="2">{{$id_pkp->competitor}}</td>
                      </tr>
                      <tr class="table-highlight">
                        <th>Competitive Analysis</th>
                        <td colspan="2">{{$id_pkp->competitive}}</td>
                      </tr>
                        <tr><th colspan="3" class="text-center"><span style="font-weight: bold;font-size: 20px;" class="card-title">Product features</span></th></tr>
                        <tr>
                          <th>Product Form</th>
                          <td colspan="2">{{$id_pkp->product_form}}<br> {{$id_pkp->remarks_product_form}} </td>
                        </tr>
                        <tr>
                          <th>Product Packaging</th>
                          <td colspan="2">
                            @if($id_pkp->kemas_eksis!=NULL)
                              (@if($id_pkp->kemas->tersier!=NULL)
                              {{ $id_pkp->kemas->tersier }}{{ $id_pkp->kemas->s_tersier }} X
                              @endif

                              @if($id_pkp->kemas->sekunder1!=NULL)
                              {{ $id_pkp->kemas->sekunder1 }}{{ $id_pkp->kemas->s_sekunder1}} X
                              @endif

                              @if($id_pkp->kemas->sekunder2!=NULL)
                              {{ $id_pkp->kemas->sekunder2 }}{{ $id_pkp->kemas->s_sekunder2 }} X
                              @endif

                              @if($id_pkp->kemas->primer!=NULL)
                              {{ $id_pkp->kemas->primer }}{{ $id_pkp->kemas->s_primer }}
                              @endif )
                            @endif
                          </td>
                        </tr>
                        <tr>
                          <th>Food Category (BPOM)</th>
                          <td colspan="2">@if($id_pkp->bpom!=NULL && $id_pkp->kategori_bpom!=NULL) ({{$id_pkp->katpangan->no_kategori}}) {{$id_pkp->katpangan->pangan}}@endif</td>
                        </tr>
                        <tr>
                          <th>AKG</th>
                          <td colspan="2">@if($id_pkp->akg!=NULL) {{$id_pkp->tarkon->tarkon}} @endif </td>
                        </tr>
                        <tr class="table-highlight">
                          <th>Prefered Flavour</th>
                          <td colspan="2">{{$id_pkp->prefered_flavour}} </td>
                        </tr>
                        <tr>
                          <th>Product Benefits</th>
                          <td colspan="2">{{$id_pkp->product_benefits}} <br>
                            <table class="table table-bordered" >
                              <thead>
                                <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                                  <td class="text-center">Komponen</td>
                                  <td class="text-center">Klaim</td>
                                  <td class="text-center">Detail</td>
                                  <td class="text-center">Information</td>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($dataklaim as $data)
                                <tr>
                                  <td>{{$data->datakp->komponen}}</td>
                                  <td>{{$data->klaim}}</td>
                                  <td>@if($data->datadl!=Null){{$data->datadl->detail}}@endif</td>
                                  <td>{{$data->note}}</td>
                                </tr>
                                @endforeach
                              </tbody>
                            </table>
                          </td>
                        </tr>
                        <tr>
                          <th>Serving Suggestion</th>
                          <td colspan="2">{{$id_pkp->serving_suggestion}}</td>
                        </tr>
                        <tr>
                          <th>Mandatory Ingredients</th>
                          <td colspan="2">{{$id_pkp->mandatory_ingredient}}</td>
                        </tr>
                        <tr>
                          <th>Related Picture</th>
                          <td colspan="2">
                            <table class="table table-bordered">
                              <tr class="text-center" style="font-weight: bold;color:white;background-color: #2a3f54;">
                                <td>Filename</td>
                                <td>File</td>
                                <td>Information</td>
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