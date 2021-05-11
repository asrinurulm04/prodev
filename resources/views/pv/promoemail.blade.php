<!DOCTYPE html>
<html lang="en">

<head>
<title>Download</title>
  <link href="{{ asset('img/prod.png') }}" rel="icon">
  <link href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/asrul.css') }}" rel="stylesheet">
  </head>
  <body>

<div id="pcoded" class="pcoded">
  <div class="col-md-12 col-sm-12 col-xs-12">
		<div class="tab-content panel ">
      <div class="tab-pane active" id="1">
        @php
          $no = 0;
        @endphp
        <table align="left" border="0" cellpadding="0" cellspacing="0" width="750">
          <div class="panel-default">
            <div class="panel-body badan">
              <label>PT. NUTRIFOOD INDONESIA</label>
              <center> <h2 style="font-size: 22px;font-weight: bold;">PENGEMBANGAN KONSEP AWAL PRODUK BARU</h2> </center>
              <center> <h2 style="font-size: 20px;font-weight: bold;">( PKP PROMO )</h2> </center><br>
              <center> <h2 style="font-weight: bold;"> {{ $promo->datapromoo->brand }} &reg;</h2> </center>
              <center> <h2 style="font-weight: bold;">Project Name : {{ $promo->datapromoo->project_name }} </h2> </center>
              <div class="row">
                <table ALIGN="left">
                  <tr>
                    <button><a href="{{route('approveemailpromo',$promo->id_pkp_promoo)}}" class="btn btn-info">Approve</a></button>
                    <button><a href="{{route('rejectemailpromo',$promo->id_pkp_promoo)}}" class="btn btn-info">Reject</a></button>
                  </tr>
                </table>
              </div><br><br>
            </div>
              <table border="1" style="font-size:15px" class="table table-bordered">
                <tr>
                  <td style="width:530px"><b>Author</td>
                  <td colspan="2">{{$promo->datapromoo->author1->name}}</td>
                </tr>
                <tr>
                  <td width="25%"><b>Last Upadate On</td>
                  <td colspan="2">{{$promo->last_update}}</td>
                </tr>
                <tr>
                  <td width="25%"><b>Revisi No</td>
                  <td colspan="2">{{$promo->revisi}}.{{$promo->turunan}}</td>
                </tr>
                <tr>
                  <td style="width:530px"><b>Perevisi</td>
                  <td colspan="2">@if($promo->perevisi!=null){{$promo->perevisi2->name}}@endif</td>
                </tr>
                <tr>
                  <td width="25%"><b>Country</td>
                  <td colspan="2">{{$promo->datapromoo->country}}</td>
                </tr>
                <tr>
                  <td width="25%"><b>Item Promo type</td>
                  <td colspan="2">{{$promo->datapromoo->promo_type}}</td>
                </tr>
                <tr>
                  <td width="25%"><b>Type</td>
                  <td colspan="2">{{$promo->datapromoo->type}}</td>
                </tr>
                <tr>
                  <td width="25%"><b>Promo</td>
                  <td>
                    <table class="table table-striped table-bordered nowrap">
                      <thead>
                        <tr style="background-color:#13699a;color:white;">
                          <th class="text-center">Idea</th>
                          <th class="text-center">Dimension</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($idea as $data)
                        <tr>
                          <td>{{$data->promo_idea }}</td>
                          <td>{{$data->dimension }}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </td>
                </tr>
                <tr>
                  <td><b>Application</td>
                  <td>{{$promo->application}}</td>
                </tr>
                <tr class="table-highlight">
                  <td width="25%"><b>Item Promo Readiness</td>
                  <td width="25%">{{$promo->promo_readiness}}</td>
                </tr>
              </table><br><br>
              <label for="">Product And Allocation :</label>
              <table border="1" style="font-size:15px" class="table table-striped table-bordered nowrap" id="table">
                <thead>
                  <tr style="background-color:#13699a;color:white;">
                    <td>Product SKU Name</td>
                    <td>Allocation (pcs)</td>
                    <td>Remarks</td>
                    <td>Start</td>
                    <td>End</td>
                    <td>RTO</td>
                    <td>Opsi</td>
                  </tr>
                </thead>
                <tbody>
                @foreach($app as $data)
                  <tr>
                    <td>{{$data->sku->nama_sku}}</td>
                    <td>{{$data->allocation}}</td>
                    <td>{{$data->remarks}}</td>
                    <td>{{$data->start}}</td>
                    <td>{{$data->end}}</td>
                    <td>{{$data->rto}}</td>
                    <td>{{$data->opsi}}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </table>
      </div>
    </div>
	</div>
</div>
</body>

</html>
