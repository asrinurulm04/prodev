<!doctype html>
<html>
	<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Boardicle Email</title>
	</head>
	<body class="">
    
    <table border="0" cellpadding="0" cellspacing="0" class="body">
    	<tr>
        <td>&nbsp;</td>
        <td class="container">
          <div class="content">
            <!-- START CENTERED WHITE CONTAINER -->
            <table class="main">
              <!-- START MAIN CONTENT AREA -->
              <tr>
                <td class="wrapper">
                  <table border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td>
                        <p>Hi</p>
                        <p>{{$info}}</p>
                          <table border="0" cellpadding="0" cellspacing="0">
                            <tbody>
                              <tr>
                                <td align="left">
                                  <table border="0" cellpadding="0" cellspacing="0">
                                    <tbody>
                                    	<tr>
                                        <td> 
																					<div class="container">
                                            <hr>
                                            Dengan data sebagai berikut : <br>
                                            <table>
                                              @foreach($app as $pkp)
                                              <tr><td>PKP</td><td>: PKP {{$pkp->datapkpp->jenis}}</td></tr>
                                              <tr><td>PKP Number</td><td>: {{$pkp->datapkpp->pkp_number}}{{$pkp->datapkpp->ket_no}}</td></tr>
                                              <tr><td>Project Name</td><td>: {{$pkp->datapkpp->project_name}}</td></tr>
                                              <tr><td>Brand</td><td>: {{$pkp->datapkpp->id_brand}}</td></tr>
                                              <tr><td>Idea</td><td>: {{$pkp->idea}}</td></tr>
                                              <tr><td>PV</td><td>: {{$pkp->perevisi2->name}}</td></tr>
                                              <tr><td>Packaging Concept</td><td>
                                                <table class="table table-bordered table-hover">
                                                  <thead>
                                                    <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                                                      <th>Forecash</th>
                                                      <th>Configuration</th>
                                                      <th>UOM</th>
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
                                                      <td>{{$for->jlh_uom}}{{$for->uom}}</td>
                                                      <td><?php $angka_format = number_format($for->nfi_price,2,",","."); echo "Rp. ".$angka_format;?></td>
                                                      <td><?php $angka_format = number_format($for->costumer,2,",","."); echo "Rp. ".$angka_format;?></td>
                                                    </tr>
                                                    @endforeach
                                                  </tbody>
                                                </table>
                                              </td></tr>
                                              <tr><td>Deadline for sending Sample</td><td>: {{$pkp->datapkpp->jangka}} To {{$pkp->datapkpp->waktu}}</td></tr>
                                              <tr><td>Launch Deadline</td><td>: {{$pkp->launch}} {{$pkp->years}} {{$pkp->tgl_launch}}</td></tr>
                                              @endforeach
                                            </table>
                                            <hr>
                                            Untuk melihat data PKP lengkap, silahkan masuk ke link berikut : https://prodev.nutrifood.co.id </p><br><br><br>
                                            Terimakasih,<br>
                                            Admin PRODEV
                                          </div>
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                      </td>
                    </tr>
                  </table>
                </td>
							</tr>	
            </table>
          </div>
        </td>
        <td>&nbsp;</td>
    	</tr>
		</table>
	</body>
</html>