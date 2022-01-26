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
        <td>
          <p>Hi {{ $nama }}</p>
          <p>Terimakasih telah Membuat akun di aplikasi PRODEV :)</p>
					<div class="container"><hr>
            <center><p>{{ $pesan }}</p></center>
						Dengan data sebagai berikut : <br>
						<table>
              <tr><td>Nama</td><td>: {{$nama}}</td></tr>
              <tr><td>username</td><td>: {{$username}}</td></tr>
              <tr><td>Email</td><td>: {{$email}}</td></tr>
              <tr><td>Departement</td><td>: {{$dept}}</td></tr>
              <tr><td>Terdaftar sebagai</td><td>: {{$role}}</td></tr>
						</table><hr>
						Terimakasih,<br>
						Admin PRODEV
          </div>
        </td>
    	</tr>
		</table>
	</body>
</html>