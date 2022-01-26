<!DOCTYPE html>
<html lang="en">

<head>
  <title>@yield('title')</title>
  <link href="{{ asset('img/prod.png') }}" rel="icon">
  <link href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/asrul.css') }}" rel="stylesheet">
</head>
<body>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="row" style="margin:20px">
          <div class="panel-body">
            <table class="Table table-bordered" style="font-size:12px">
              <thead style="background-color:#e22b3c;font-weight: bold;color:white;font-size: 20px;">
                <tr><th style="width:5%" class="text-center">PRODUCT DEVELOPMENT FORM</th></tr>
                <tr><th style="width:5%" class="text-center">( PDF )</th></tr>
              </thead>
            </table>
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
              <div  class="col-sm-12">
                <table width="100%" border="1" class="table table-bordered">
                  <thead>
                    <tr style="background-color:grey;font-weight: bold;color:white;font-size: 15px;"><td colspan="2" class="text-center">{{$pdf->project_name}}</td></tr>
                    <tr>
                      <td width="300px">Target market</td>
                      <td colspan="2" width="800px">
                        <table>
                          <tr><td style="border:none;">Age </td><td style="border:none;">{{$pdf->dariusia}} {{$pdf->sampaiusia}} Tahun</td></tr>
                          <tr><td style="border:none;">SES </td><td style="border:none;"> @foreach($datases as $ses): {{$ses->ses}}<br>@endforeach</td></tr>
                          <tr><td style="border:none;">Gender </td><td style="border:none;">{{$pdf->gender}}</td></tr>
                        </table>
                      </td>
                    </tr>
                    <tr>
                      <td>Background / Insight</td>
                      <td colspan="2">{{$pdf->background}}</td>
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
                      <td>Sales Forecast</td>
                      <td colspan="2">
                      @foreach($for as $data) {{$data->satuan}} = <?php $angka_format = number_format($data->forecast,2,",","."); echo "Rp. ".$angka_format;?> <br> @endforeach</td>
                    </tr>
                    <tr class="text-left">
                      <td>Competitor</td>
                      <td colspan="2">
                      <table>
                        <tr><td>Name</td><td style="border:none;">{{$pdf->name}}</td></tr>
                        <tr><td>Retailer price</td><td style="border:none;"><?php $angka_format = number_format($pdf->retailer_price,2,",","."); echo "Rp. ".$angka_format;?></td></tr>
                        <tr><td>What's Special</td><td style="border:none;">{{$pdf->special}} </td></tr>
                      </table>
                      </td>
                    </tr>
                    <tr class="text-left">
                      <td>Product Concept</td>
                      <td colspan="2">
                        <table>
                          <tr><td style="border:none;">Weight/Serving </td><td style="border:none;">{{$pdf->wight}} / {{$pdf->serving}}</td></tr>
                          <tr><td style="border:none;">Target NFI price / ctn </td><td style="border:none;">{{$pdf->target_price}}}</td></tr>
                          <tr><td style="border:none;">Special Ingredient </td><td style="border:none;">{{$pdf->ingredient}}</td></tr>
                        </table><br><br>
                        <table class="table table-bordered" >
                          <tbody>
                            <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                              <th class="text-center">Komponen</th>
                              <th class="text-center">Klaim</th>
                              <th class="text-center">Information</th>
                            </tr>
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
                      <td>Packaging Concept</td>
                      <td colspan="2">
                        <table>
                        @if($pdf->primer!=NULL)
                          (
                          @if($pdf->kemas->primer!=NULL)
                          {{ $pdf->kemas->primer }}{{ $pdf->kemas->s_primer }} X
                          @endif
  
                          @if($pdf->kemas->sekunder1!=NULL)
                          {{ $pdf->kemas->sekunder1 }}{{ $pdf->kemas->s_sekunder1}} X
                          @endif
  
                          @if($pdf->kemas->sekunder2!=NULL)
                          {{ $pdf->kemas->sekunder2 }}{{ $pdf->kemas->s_sekunder2 }} X
                          @endif
  
                          @if($pdf->kemas->tersier!=NULL)
                          {{ $pdf->kemas->tersier }}{{ $pdf->kemas->s_tersier }} 
                          @endif
                          )
                        @endif 
                        @if($pdf->primery!=NULL)
                        <tr><th width="35%">Primary information</th><th>:</th><td style="border:none;">: {{$pdf->primery}}</td></tr>
                        @elseif($pdf->secondary!=NULL)
                        <tr><th width="35%">Secondary information</th><th>:</th><td style="border:none;">: {{$pdf->secondary}}</td></tr>
                        @elseif($pdf->tertiary!=NULL)
                        <tr><th width="35%">Teriery information</th><th>:</th><td style="border:none;">: {{$pdf->tertiary}}</td></tr>
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
</body>

</html>
<script src="{{ asset('vendors/jquery/dist/jquery.min.js') }}"></script>
<script>
  $(document).ready(function() {
    window.print()
  });
</script>