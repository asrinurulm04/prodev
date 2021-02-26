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
                        <td align="left">
												<div class="container">
                          <hr>
													Dengan data sebagai berikut : <br>
													<table>
                            @foreach($app as $promo)
                            <tr><td>Promo Number</td><td>: {{$promo->datapromoo->promo_number}}{{$promo->datapromoo->kat_no}}</td></tr>
														<tr><td>Brand</td><td>: {{$promo->datapromoo->brand}}</td></tr>
														<tr><td>Created date</td><td>: {{$promo->datapromoo->created_date}}</td></tr>
														<tr><td>Country</td><td>: {{$promo->datapromoo->country}}</td></tr>
                            <tr><td>PV</td><td>: {{$promo->perevisi2->name}}</td></tr>
														<tr><td>RTO</td><td>: {{$promo->rto}}</td></tr>
														@endforeach
													</table>
                          <hr>
                          Untuk melihat data PKP PROMO lengkap, silahkan masuk ke link berikut : https://prodev.nutrifood.co.id </p><br><br><br>
													Terimakasih,<br>
													Admin PRODEV
                        </div>
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