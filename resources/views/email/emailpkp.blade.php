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
                  <div class="panel-default">
                    <table align="left" border="0" cellpadding="0" cellspacing="0" width="600">
                      <div class="panel-body badan" >
                      <p class="satu">PT. NUTRIFOOD INDONESIA</p>
                        <center> <h2 style="font-size: 22px;font-weight: bold;">PENGEMBANGAN KONSEP AWAL PRODUK BARU</h2> </center>
                        <center> <h2 style="font-size: 20px;font-weight: bold;">( PKP )</h2> </center><br>
                        <center> <h2 style="font-weight: bold;">[ {{ $pkp->id_brand }} ] &reg;</h2> </center>
                        <table class="table table-bordered" style="font-size:12px">
                          <thead style="background-color:#13699a;font-weight: bold;color:white;font-size: 20px;">
                            <tr><th style="width:5%" class="text-center">{{ $pkp->project_name }}</th></tr>
                          </thead>
                        </table>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <div class="row">
                            <div class="col-sm-6">
                              <table ALIGN="left">
                                <tr><td>Type</td> <td>: PKP-{{$pkp->jenis}}</td></tr>
                                <tr><td>Revision Number</td> <td>: {{$pkp->revisi}}.{{$pkp->turunan}}.{{$pkp->revisi_kemas}}</td></tr>
                                <tr>
                                  <button><a href="{{route('approveemailpkp',$pkp->id_project)}}" class="btn btn-info">Approve</a></button>
                                  <button><a href="{{route('rejectemailpkp',$pkp->id_project)}}" class="btn btn-info">Reject</a></button>
                                </tr>
                              </table>
                            </div>
                            <div class="col-sm-6">
                              <table ALIGN="right">
                                <tr><td>Author</td><td>: {{$pkp->author1->name}}</td></tr>
                                <tr><td>Created date</td> <td>: {{$pkp->created_date}}</td></tr>
                                <tr><td>Last Upadate On</td> <td>: {{$pkp->last_update}}</td></tr>
                                <tr><td>Revised By</td><td>: @if($pkp->perevisi!=NULL) {{$pkp->perevisi2->name}} @endif</td></tr>
                              </table><br><br><br><br><br><br>
                            </div>
                          </div>
                        </div>
                        <table border="1" style="font-size:15px" class="table table-bordered" width="600">
                          <tr><th colspan="3" class="text-center"><span style="font-weight: bold;font-size: 20px;" class="card-title">Background</span></th></tr>
                          <tr>
                            <td width="300px">Idea</td>
                            <td colspan="2" width="700px">{{$pkp->idea}}</td>
                          </tr>
                          <tr>
                            <td>Target market</td>
                            <td colspan="2">
                              <table>
                                <tr><td>Gender </td><td>: {{$pkp->gender}}</td></tr>
                                <tr><td>Usia </td>: {{$pkp->dari_umur}}</td></tr>
                                <tr><td>SES <td></td>: @foreach($datases as $data) {{$data->ses}}, @endforeach</td></tr>
                              </table>
                            </td>
                          </tr>
                          <tr>
                            <td>Uniqueness of idea</td>
                            <td colspan="2">: {{$pkp->Uniqueness}}</td>
                          </tr>
                          <tr>
                            <td>Estimated potential market</td>
                            <td colspan="2">: {{$pkp->Estimated}}</td>
                          </tr>
                          <tr class="table-highlight">
                            <td>Reason(s)</td>
                            <td colspan="2">: {{$pkp->reason}}</td>
                          </tr>
                          <tr><th colspan="3" class="text-center"><span style="font-weight: bold;font-size: 20px;" class="card-title">Market Analysis</span></th></tr>
                          <tr>
                            <td>Launch Deadline</td>
                            <td colspan="2">{{$pkp->launch}} {{$pkp->years}} {{$pkp->tgl_launch}}</td>
                          </tr>
                          <tr>
                            <td>Aisle Placement</td>
                            <td colspan="2">{{$pkp->aisle}}</td>
                          </tr>
                          <tr>
                            <td>Sales Forecast</td>
                            <td colspan="2">
                            @foreach($for as $data) {{$data->satuan}} = <?php $angka_format = number_format($data->forecast,2,",","."); echo "Rp. ".$angka_format;?> <br> @endforeach</td>
                          </tr>
                          <tr>
                            <td>NF Selling Price (Before ppn)</td>
                            <td colspan="2"><?php $angka_format = number_format($pkp->selling_price,2,",","."); echo "Rp. ".$angka_format;?> / {{$pkp->UOM}}</td>
                          </tr>
                            <td>Consumer price target</td>
                            <td colspan="2"><?php $angka_format = number_format($pkp->price,2,",","."); echo "Rp. ".$angka_format;?> / {{$pkp->UOM}}</td>
                          </tr>
                          <tr class="table-highlight">
                            <td>Main Competitor</td>
                            <td colspan="2">{{$pkp->competitor}}</td>
                          </tr>
                          <tr class="table-highlight">
                            <td>Competitive Analysis</td>
                            <td colspan="2">{{$pkp->competitive}}</td>
                          </tr>
                          <tr><th colspan="3" class="text-center"><span style="font-weight: bold;font-size: 20px;" class="card-title">Product features</span></th></tr>
                          <tr>
                            <td>Product Form</td>
                            <td colspan="2">{{$pkp->product_form}}</td>
                          </tr>
                          <tr>
                          <td>Product Packaging</td>
                            <td colspan="2">
                              <table>
                                @if($pkp->kemas_eksis!=NULL)
                                  (
                                  @if($pkp->kemas->primer!=NULL)
                                    {{ $pkp->kemas->primer }}{{ $pkp->kemas->s_primer }} X
                                  @endif

                                  @if($pkp->kemas->sekunder1!=NULL)
                                    {{ $pkp->kemas->sekunder1 }}{{ $pkp->kemas->s_sekunder1}} X
                                  @endif

                                  @if($pkp->kemas->sekunder2!=NULL)
                                    {{ $pkp->kemas->sekunder2 }}{{ $pkp->kemas->s_sekunder2 }} X
                                  @endif

                                  @if($pkp->kemas->tersier!=NULL)
                                    {{ $pkp->kemas->tersier }}{{ $pkp->kemas->s_tersier }}
                                  @endif
                                  )
                                @endif
                                <br>
                                @if($pkp->primery!=NULL)
                                <tr><th width="35%">Primary information</th><th>:</th><td style="border:none;">: {{$pkp->primery}}</td></tr>
                                @endif
                                @if($pkp->secondary!=NULL)
                                <tr><th width="35%">Secondary information</th><th>:</th><td style="border:none;">: {{$pkp->secondary}}</td></tr>
                                @endif
                                @if($pkp->tertiary!=NULL)
                                <tr><th width="35%">Teriery information</th><th>:</th><td style="border:none;">: {{$pkp->tertiary}}</td></tr>
                                @endif
                              </table>
                            </td>
                          </tr>
                          <tr>
                            <td>Food Category (BPOM)</td>
                            <td colspan="2">: @if($pkp->bpom!=NULL && $pkp->kategori_bpom!=NULL)({{$pkp->katpangan->no_kategori}}) {{$pkp->katpangan->pangan}}@endif</td>
                          </tr>
                          <tr>
                            <td>AKG</td>
                            <td>@if($pkp->akg!=NULL) {{$pkp->tarkon->tarkon}} @endif </td>
                          </tr>
                          <tr class="table-highlight">
                            <td>Prefered Flavour</td>
                            <td colspan="2">{{$pkp->prefered_flavour}}</td>
                          </tr>
                          <tr>
                            <td>Product Benefits</td>
                            <td colspan="2">{{$pkp->product_benefits}}<br>
                              <table class="table table-bordered table-hover" id="table">
                                <thead>
                                  <tr>
                                    <td>Komponen</td>
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
                            <td>Serving Suggestion</td>
                            <td colspan="2">{{$pkp->serving_suggestion}}</td>
                          </tr>
                          <tr>
                            <td>Mandatory Ingredients</td>
                            <td colspan="2">{{$pkp->mandatory_ingredient}}</td>
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
    </div>
  </body>
</html>