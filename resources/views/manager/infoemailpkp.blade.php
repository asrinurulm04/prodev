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
                                              <tr><td>Forecast</td><td>: {{$pkp->for1->satuan}} = <?php $angka_format = number_format($pkp->for1->forecast,2,",","."); echo "Rp. ".$angka_format;?></td></tr>
                                              <tr><td>NF Selling Price</td><td>: {{$pkp->selling_price}}</td></tr>
                                              <tr><td>Packaging Concept</td><td>:
                                                @if($pkp->kemas->tersier!=NULL)
                                                  {{ $pkp->kemas->tersier }}{{ $pkp->kemas->s_tersier }}
                                                  @elseif($pkp->tersier==NULL)
                                                  @endif  
                          
                                                  @if($pkp->kemas->sekunder1!=NULL)
                                                  X {{ $pkp->kemas->sekunder1 }}{{ $pkp->kemas->s_sekunder1}}
                                                  @elseif($pkp->kemas->sekunder1==NULL)
                                                  @endif
                          
                                                  @if($pkp->kemas->sekunder2!=NULL)
                                                  X {{ $pkp->kemas->sekunder2 }}{{ $pkp->kemas->s_sekunder2 }}
                                                  @elseif($pkp->sekunder2==NULL)
                                                  @endif
                          
                                                  @if($pkp->kemas->primer!=NULL)
                                                  X{{ $pkp->kemas->primer }}{{ $pkp->kemas->s_primer }}
                                                @elseif($pkp->kemas->primer==NULL)
                                                @endif
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