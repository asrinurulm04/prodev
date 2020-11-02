<table align="center" cellpadding="0" cellspacing="0" width="600">
  <tr>
    <td align="center" bgcolor="#70bbd9" style="padding: 10px 0 10px 0;">
      <img src="{{ $message->embed('img/logo.png') }}" alt="Creating Email Magic" width="150" height="90" style="display: block;" />
    </td>
  </tr>
  <tr>
    <td><br>
			Dear All,
			<br><br>
			Berikut adalah Konfirmasi launching, dengan data sebagai berikut :
   </td>
  </tr>
  <tr>
		<td bgcolor="#ffffff" style="padding: 30px 20px 30px 20px;">
			@foreach($launch as $pkp)
      <table border="1">
        <tr>
					<td width="300px" class="text-center">{{$pkp->launch->nama_produk}}</td>
					<td width="600px">
						<table>
							<tr>
								<td width="30%">tanggal</td>
								<td>: {{$pkp->launch->tanggal}}</td>
							</tr>
							<tr>
								<td>Nama Project</td>
								<td>: {{$pkp->project_name}}</td>
							</tr>
							<tr>
								<td>Nama Product</td>
								<td>: {{$pkp->launch->nama_produk}}</td>
							</tr>
							<tr>
								<td>Formula baku</td>
								<td>: {{$pkp->launch->formula_baku}}</td>
							</tr>
							<tr>
								<td>Formula Kemas</td>
								<td>: {{$pkp->launch->formula_kemas}}</td>
							</tr>
							<tr>
								<td>Price List</td>
								<td>: {{$pkp->launch->price_list}}</td>
							</tr>
							<tr>
								<td>Forecash</td>
								<td>: {{$pkp->launch->forecast}}</td>
							</tr>
							<tr>
								<td>Target RTO</td>
								<td>: {{$pkp->launch->rto}}</td>
							</tr>
							<tr>
								<td>Note</td>
								<td>: {{$pkp->launch->note}}</td>
							</tr>
						</table>
					</td>
      	</tr> 
			</table>
			@endforeach
    </td>
  </tr>
</table>