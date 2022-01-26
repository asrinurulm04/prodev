<table cellpadding="0" cellspacing="0" width="700">
  <tr><?php $last = Date('j-F-Y'); ?>
    <td><br>
			Dear All, <br>
			Berikut adalah informasi launching untuk project pkp {{$pkp->project_name}} :
    </td>
  </tr>
  <tr>
		<td bgcolor="#ffffff" style="padding: 10px 10px 10px 10px;">
      <table border="1">
        <tr>
					<td width="200px" class="text-center">
						<center>{{$pkp->nama_produk}}</center>
    			</td>
					<td width="700px">
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
								<td>:{{$pkp->formula_baku}}</td>
							</tr>
							<tr>
								<td>Formula Kemas</td>
								<td>: {!! nl2br(htmlspecialchars($pkp->formula_kemas)) !!} <br>
								: RML = {{$pkp->rml}}
								</td>
							</tr>
							<tr>
								<td>Pricelist (before Ppn)</td>
								<td>: {{$pkp->price_list}}</td>
							</tr>
							<tr>
								<td>Forecast (Rp/ month)</td>
								<td>: {{$pkp->forecast}}</td>
							</tr>
							<tr>
								<td>Selling Channel </td>
								<td>: {{$pkp->selling_channel}}</td>
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
  </tr>
</table>