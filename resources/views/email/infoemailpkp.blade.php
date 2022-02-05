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
        <td class="wrapper">
          <p>Hi</p>
          <p>{{$info}}</p>
          <table border="2" cellpadding="0" cellspacing="0">
            @foreach($app as $pkp)
            <tr><td width="200px">PKP</td><td>:</td><td width="450px"> PKP {{$pkp->jenis}}</td></tr>
            <tr><td>PKP Number</td><td>:</td><td> {{$pkp->pkp_number}}{{$pkp->ket_no}}</td></tr>
            <tr><td>Project Name</td><td>:</td><td> {{$pkp->project_name}}</td></tr>
            <tr><td>Brand</td><td>:</td><td> {{$pkp->id_brand}}</td></tr>
            <tr><td>Idea</td><td>:</td><td> {{$pkp->idea}}</td></tr>
            <tr><td>PV</td><td>:</td><td> {{$pkp->perevisi2->name}}</td></tr>
            <tr><td>Forecast</td><td>:</td><td> @foreach($for as $data) {{$data->satuan}} = <?php $angka_format = number_format($data->forecast,2,",","."); echo "Rp. ".$angka_format;?> <br> @endforeach</td></tr>
            <tr><td>NF Selling Price</td><td>:</td><td> {{$pkp->selling_price}}</td></tr>
            <tr><td>Packaging Concept</td><td>:</td><td>
            @if($pkp->kemas_eksis!=NULL)(
              @if($pkp->kemas->tersier!=NULL)
              {{ $pkp->kemas->tersier }}{{ $pkp->kemas->s_tersier }}
              @endif

              @if($pkp->kemas->sekunder1!=NULL)
              X {{ $pkp->kemas->sekunder1 }}{{ $pkp->kemas->s_sekunder1}}
              @endif

              @if($pkp->kemas->sekunder2!=NULL)
              X {{ $pkp->kemas->sekunder2 }}{{ $pkp->kemas->s_sekunder2 }}
              @endif

              @if($pkp->kemas->primer!=NULL)
              X{{ $pkp->kemas->primer }}{{ $pkp->kemas->s_primer }}
              @endif )
            @endif
            </td></tr>
            <tr><td>Launch Deadline</td><td>:</td><td> {{$pkp->launch}} {{$pkp->years}}</td></tr>
            @endforeach
          </table><hr>
          Untuk melihat data PKP lengkap, silahkan masuk ke link berikut : https://prodev.nutrifood.co.id </p><br><br><br>
          Terimakasih,<br>
          Admin PRODEV
        </td>
    	</tr>
		</table>
	</body>
</html>