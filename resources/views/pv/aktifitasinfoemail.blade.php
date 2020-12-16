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
                        <p>Hi,</p>
                        <p>Saat ini terdapat perubahan data PKP</p>
                          <table border="0" cellpadding="0" cellspacing="0">
                            <tbody>
                              <tr>
                                <td align="left">
                                  <table border="0" cellpadding="0" cellspacing="0">
                                    <tbody>
                                    	<tr>
                                        <td> 
																					<div class="container"><hr>
                                            Dengan data sebagai berikut : <br>
                                            <table>
                                            @foreach($app as $pkp)
                                            <tr><td>PKP</td><td>: PKP {{$pkp->datapkpp->jenis}}</td></tr>
                                            <tr><td>Project Name</td><td>: {{$pkp->datapkpp->project_name}}</td></tr>
                                            <tr><td>Brand</td><td>: {{$pkp->datapkpp->id_brand}}</td></tr>
                                            <tr><td>Forecast</td><td>: {{$pkp->for1->satuan}} = {{$pkp->for1->forecast}}</td></tr>
                                            <tr><td>NF Selling Price</td><td>: {{$pkp->selling_price}}</td></tr>
                                            @endforeach
                                            </table>
                                            <hr>
                                            Untuk melihat data PKP lengkap, silahkan masuk ke link berikut : https://prodev.nutrifood.co.id </p><br><br><br>
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