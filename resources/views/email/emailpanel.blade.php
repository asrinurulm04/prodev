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
          <p>Hi</p>
          <p>{{$info}}</p><hr>
          Dengan data sebagai berikut : <br>
          <table>
            @if($formula->workbook_id!=NULL)
            <tr><td>PKP Number</td><td>: {{$formula->Workbook->pkp_number}}{{$formula->Workbook->ket_no}}</td></tr>
            @elseif($formula->workbook_pdf_id!=NULL)
            <tr><td>PDF Number</td><td>: {{$formula->Workbook_pdf->datapdf->pkp_number}}{{$formula->Workbook_pdf->datapdf->ket_no}}</td></tr>
            @endif
            <tr><td>Formula</td><td>: {{$formula->formula}}</td></tr>
          </table>
					<table>
						<thead>
							<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
								<th>Panel</th>
								<th>Tanggal Panel</th>
								<th>No HUS</th>
								<th>Note</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>{{$app->panel}}</td>
								<td>{{$app->tgl_panel}}</td>
								<td>{{$app->hus}}</td>
								<td>{{$app->kesimpulan}}</td>
							</tr>
						</tbody>
          </table><hr>
           Untuk melihat data PKP lengkap, silahkan masuk ke link berikut : https://prodev.nutrifood.co.id </p><br><br><br>
           Terimakasih,<br>
           Admin PRODEV
        </td>
      </tr>
    </table>
	</body>
</html>