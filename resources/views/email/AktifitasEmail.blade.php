<!doctype html>
<html>
	<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	</head>
	<body class="">
    <table border="0" cellpadding="0" cellspacing="0" class="body">
    	<tr>
        <td>
          <p>Hi,</p>
          <p>{{$info}}</p>
          <table border="0" cellpadding="0" cellspacing="0">
            <tbody>
              <tr>
                <td> 
									<div class="container"><hr>
                    Dengan data sebagai berikut : <br>
                    <table>
                    @foreach($app as $pkp)
                    <tr><td>PKP</td><td>: PKP {{$pkp->jenis}}</td></tr>
                    <tr><td>Project Name</td><td>: {{$pkp->project_name}}</td></tr>
                    <tr><td>Brand</td><td>: {{$pkp->id_brand}}</td></tr>
                    <tr><td>NF Selling Price</td><td>: {{$pkp->selling_price}}</td></tr>
                    @endforeach
                    </table><hr>
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
		</table>
	</body>
</html>