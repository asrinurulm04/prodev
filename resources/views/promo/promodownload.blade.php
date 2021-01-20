<!DOCTYPE html>
<html lang="en">

<head>
<title>Download</title>
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
		<div class="tab-content panel ">
      <div class="tab-pane active" id="1">
        @php
          $no = 0;
        @endphp
        @foreach($promoo as $promo)
        <div class="panel-default">
					<div class="panel-body ">
						<label>PT. NUTRIFOOD INDONESIA</label>
						<center> <h2 style="font-size: 22px;font-weight: bold;">PENGEMBANGAN KONSEP AWAL PRODUK BARU</h2> </center>
  					<center> <h2 style="font-size: 20px;font-weight: bold;">( PKP Promo )</h2> </center><br>
						<center> <h2 style="font-weight: bold;"> {{ $promo->brand }} &reg;</h2> </center>
      			<center> <h2 style="font-weight: bold;">Project Name : {{ $promo->project_name }} </h2> </center>
						<table class=" table">
              <tr>
                <td width="25%"><b>Author</td>
                <td colspan="2">{{$promo->Author}}</td>
              </tr>
              <tr>
                <td width="25%"><b>Created date</td>
                <td colspan="2">{{$promo->created_date}}</td>
              </tr>
              <tr>
                <td width="25%"><b>Last Upadate On</td>
                <td colspan="2">{{$promo->last_update}}</td>
              </tr>
              <tr>
                <td width="25%"><b>No Revisi</td>
                <td colspan="2">{{$promo->revisi}}.{{$promo->turunan}}</td>
              </tr>
              <tr>
                <td width="25%"><b>Revised By</td>
                <td colspan="2">@if($promo->perevisi!=NULL) {{$promo->perevisi2->name}} @endif</td>
              </tr>
              <tr>
                <td width="25%"><b>Country</td>
                <td colspan="2">{{$promo->country}}</td>
              </tr>
              <tr>
                <td width="25%"><b>Item Promo type</td>
                <td colspan="2">{{$promo->promo_type}}</td>
              </tr>
              <tr>
                <td width="25%"><b>Type</td>
                <td colspan="2">{{$promo->type}}</td>
              </tr>
              <tr>
                <td width="25%"><b>Promo</td>
                <td width="65%">
                  <table class="table table-striped table-bordered nowrap">
                    <thead>
                      <tr style="background-color:#13699a;color:white;">
                        <th class="text-center">Idea</th>
                        <th class="text-center">Dimension</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($idea as $idea)
                      <tr>
                        <td>{{$idea->promo_idea}}</td>
                        <td>{{$idea->dimension}}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </td>
              </tr>
              <tr>
                <td width="25%"><b>Application</td>
                <td colspan="2">	{{ $promo->application }}</td>
              </tr>
              <tr class="table-highlight">
                <td width="25%"><b>Item Promo Readiness</td>
                <td colspan="2">	{{$promo->promo_readiness}}</td>
              </tr>
              <tr>
                <td width="25%"><b>Related Picture</td>
                <td colspan="2">@foreach($picture as $pic)<embed src="{{asset('data_file/'.$promo->filename)}}" width="150px" height="170" type="">@endforeach</td>
              </tr>
            </table>
            @endforeach
            <label for="">Product And Allocation :</label>
            <table class="table table-striped table-bordered nowrap" id="table">
              <thead>
                <tr style="background-color:#13699a;color:white;">
                  <td>Product SKU Name</td>
                  <td>Allocation (pcs)</td>
                  <td>Remarks</td>
									<td>Start</td>
									<td>RTO</td>
                  <td>End</td>
                  <td>Opsi</td>
                </tr>
              </thead>
              <tbody>
                @foreach($app as $data)
                <tr>
                  <td>{{$data->product_sku}}</td>
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
</body>

</html>
<script src="{{ asset('vendors/jquery/dist/jquery.min.js') }}"></script>
<script>
  $(document).ready(function() {
    window.print()
  });
</script>
