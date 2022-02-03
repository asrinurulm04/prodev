<!doctype html>
<html>
	<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	</head>
	<body class="">
    
    <table border="0" cellpadding="0" cellspacing="0" class="body">
    	<tr>
        <td class="wrapper">
          <p>Hi</p>
          <p>{{$info}}</p><hr>
          <table border="0" cellpadding="0" cellspacing="0">
            @if($data->id_project!=NULL)
            <tr><td>PKP</td><td>: PKP {{$data->jenis}}</td></tr>
            <tr><td>PKP Number</td><td>: {{$data->pkp_number}}{{$data->ket_no}}</td></tr>
            <tr><td>Project Name</td><td>: {{$data->project_name}}</td></tr>
            @elseif($data->id_project_pdf!=NULL)
            <tr><td>PDF</td><td>: {{$data->product_type}}</td></tr>
            <tr><td>PDF Number</td><td>: {{$data->pdf_number}}{{$data->ket_no}}</td></tr>
            <tr><td>Project Name</td><td>: {{$data->project_name}}</td></tr>
            @endif
            <tr><td>Info</td><td>: {{$alasan}}</td></tr>
          </table><hr>
          <p>{{$catatan}}</p>
          <p>Untuk melihat data lengkap, silahkan masuk ke link berikut : https://prodev.nutrifood.co.id </p><br><br><br>
          Terimakasih,<br>
          Admin PRODEV
        </td>
    	</tr>
		</table>
	</body>
</html>