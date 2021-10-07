<table cellpadding="0" cellspacing="0" width="700">
  <tr>
    <td><br>
			Dear All,
			Berikut adalah Konfirmasi launching dari project PKP {{$pkp->project_name}}, dengan data sebagai berikut :
   </td>
  </tr>
  <tr>
		<td bgcolor="#ffffff" style="padding: 10px 10px 10px 10px;">
      <table border="1">
        <tr>
					<td width="200px" class="text-center">
					
					<img src="{{ $message->embed('data_file/'.$pkp->barcode) }}" align="center" alt="Creating Email Magic" width="220px" height="220px" style="display: block;" />
					<td width="600px">
						<table>
							<tr>
								<td width="35%">Tanggal</td>
								<td>: {{$pkp->tanggal}}</td>
							</tr>
							<tr>
								<td>Nama Project</td>
								<td>: {{$pkp->project_name}}</td>
							</tr>
							<tr>
								<td>Nama Product</td>
								<td>: {{$pkp->nama_produk}}</td>
							</tr>
							<tr>
								<td>Formula baku</td>
								<td>: {{$pkp->formula_baku}}</td>
							</tr>
							<tr>
								<td>Formula Kemas</td>
								<td>: {{$pkp->formula_kemas}}</td>
							</tr>
							<tr>
								<td>Price List</td>
								<td>: {{$pkp->price_list}}</td>
							</tr>
							<tr>
								<td>Forecash</td>
								<td>: {{$pkp->forecast}}</td>
							</tr>
							<tr>
								<td>Target RTO</td>
								<td>: {{$pkp->rto}}</td>
							</tr>
							<tr>
								<td>Note</td>
								<td>: {{$pkp->note}}</td>
							</tr>
						</table>
					</td>
      	</tr> 
			</table>
    </td>
  </tr>
</table>