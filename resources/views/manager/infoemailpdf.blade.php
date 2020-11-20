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
                        <p>Hai, </p>
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
                                              @foreach($app as $pdf)
                                            <tr><td>PDF Number</td><td>: {{$pdf->datapdf->pdf_number}} {{$pdf->datapdf->ket_no}}</td></tr>
                                            <tr><td>Brand</td><td>: {{$pdf->datapdf->id_brand}}</td></tr>
                                            <tr><td>Background / Insight</td><td>: {{$pdf->background}}</td></tr>
                                            <tr><td>PV</td><td>: {{$pdf->perevisi2->name}}</td></tr>
                                            <tr><td>Country</td><td>: {{$pdf->datapdf->country}}</td></tr>
                                            <tr><td>Reference</td><td>: {{$pdf->datapdf->reference}}</td></tr>
                                            <tr><td>Deadline for sending Sample</td><td>: {{$pdf->datapdf->jangka}} - {{$pdf->datapdf->waktu}}</td></tr>
																						<tr><td>RTO</td><td>: {{$pdf->rto}} </td></tr>
																						@endforeach
																						</table>
                                            <hr>
                                            Untuk melihat data PDF lengkap, silahkan masuk ke link berikut : https://prodev.nutrifood.co.id </p><br><br><br>
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