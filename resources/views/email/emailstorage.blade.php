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
          <p>Hi</p>
          <p>{{$info}}</p><hr>
          Dengan data sebagai berikut : <br>
          <table>
						@if($formula->workbook_id!=NULL)
            <tr><td>PKP Number</td><td>: {{$formula->Workbook->pdf_nnumber}}{{$formula->Workbook->ket_no}}</td></tr>
            @elseif($formula->workbook_pdf_id!=NULL)
            <tr><td>PDF Number</td><td>: {{$formula->Workbook_pdf->datapdf->pdf_nnumber}}{{$formula->Workbook_pdf->datapdf->ket_no}}</td></tr>
            @endif
            <tr><td>Formula</td><td>: {{$formula->formula}}</td></tr>
          </table>
					<table>
						<thead>
							<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
								<th>No.PST</th>
								<th>Suhu</th>
								<th>Estimasi Selesai</th>
								<th>Tanggal Selesai</th>
								<th>Note</th>
								<th>No.HSA</th>
								<th>Kesimpulan Akhir</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>{{$app->no_PST}}</td>
								<td>{{$app->suhu}}</td>
								<td>{{$app->estimasi_selesai}}</td>
								<td>{{$app->keterangan}}</td>
								<td>{{$app->no_hsa}}</td>
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