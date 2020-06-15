@extends('admin.tempadmin')

@section("content")
<div class="row">
	<div class="col-md-14">
		<div class="showback">
			<div class="row">
			  <div class="col-md-6"><h4><i class="fa fa-cube"></i> Data Bahan Baku</h4> </div>
			  <div class="col-md-6 text-right"><h5><i class="fa fa-home"></i> Data Bahan Baku</a></h5></div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="showback" style="border-radius:3px;">
			<table class="table table-hover table-bordered" id="Table" style="overflow-x: scroll;">
				<thead>
					<tr>
						<th class="text-center" style="width: 5%;">No</th>
						<th class="text-center">Ingredient</th>
						<th class="text-center">Lemak</th>
						<th class="text-center">SFA</th>
						<th class="text-center">Karbohidrat</th>
						<th class="text-center">Gula</th>
						<th class="text-center">Laktosa</th>
						<th class="text-center">Sukrosa</th>
						<th class="text-center">Serat</th>
						<th class="text-center">Serat Larut</th>
						<th class="text-center">Protein</th>
						<th class="text-center">Kalori</th>
						<th class="text-center">Na (mg)</th>
						<th class="text-center">K (mg)</th>
						<th class="text-center">Ca (mg)</th>
						<th class="text-center">Mg (mg)</th>
						<th class="text-center">P (mg)</th>
						<th class="text-center">Beta Glucan</th>
						<th class="text-center">Cr(mcg)</th>
						<th class="text-center">Vit C (mg)</th>
						<th class="text-center">Vit E (mg)</th>
						<th class="text-center">Vit D (mg)</th>
						<th class="text-center">Carnitin (mg)</th>
						<th class="text-center">CLA (mg)</th>
						<th class="text-center">Sterol Ester (mg)</th>
						<th class="text-center">Chondroitin (mg)</th>
						<th class="text-center">Omega 3</th>
						<th class="text-center">DHA</th>
						<th class="text-center">EPA</th>
						<th class="text-center">Creatine</th>
						<th class="text-center">Lysine</th>
						<th class="text-center">Glucosamine (mg)</th>
						<th class="text-center">Kolin </th>
						<th class="text-center">MUFA</th>
						<th class="text-center">Linoleic Acid (Omega 6)</th>
						<th class="text-center">Linolenic Acid</th>
						<th class="text-center">Sorbitol</th>
						<th class="text-center">Maltitol</th>
						<th class="text-center">Kafein</th>
						<th class="text-center">Kolestrol</th>
					</tr>
				</thead>
				@foreach($tampil as $i)		
				<tbody>
				<tr>
					<td class="text-center">{{$loop->iteration}}</td>
					<td class="text-left">{{$i->get_bahan->nama_sederhana}}</td>
					<td class="text-center">{{$i->Lemak}} %</td>
					<td class="text-center">{{$i->SFA}} %</td>
					<td class="text-center">{{$i->karbohidrat}} %</td>
					<td class="text-center">{{$i->gula_total}} %</td>
					<td class="text-center">{{$i->laktosa}} %</td>
					<td class="text-center">{{$i->sukrosa}} %</td>
					<td class="text-center">{{$i->serat}} %</td>
					<td class="text-center">{{$i->serat_larut}} %</td>
					<td class="text-center">{{$i->protein}} %</td>
					<td class="text-center">{{$i->na}} %</td>
					<td class="text-center">{{$i->k}} %</td>
					<td class="text-center">{{$i->ca}} %</td>
					<td class="text-center">{{$i->mg}} %</td>
					<td class="text-center">{{$i->p}} %</td>
					<td class="text-center">{{$i->beta_glucan}} %</td>
					<td class="text-center">{{$i->cr}} %</td>
					<td class="text-center">{{$i->vit_c}} %</td>
					<td class="text-center">{{$i->vit_e}} %</td>
					<td class="text-center">{{$i->vit_d}} %</td>
					<td class="text-center">{{$i->carnitin}} %</td>
					<td class="text-center">{{$i->cla}} %</td>
					<td class="text-center">{{$i->sterol_ester}} %</td>
					<td class="text-center">{{$i->chondroitin}} %</td>
					<td class="text-center">{{$i->omega_3}} %</td>
					<td class="text-center">{{$i->dha}} %</td>
					<td class="text-center">{{$i->epa}} %</td>
					<td class="text-center">{{$i->creatine}} %</td>
					<td class="text-center">{{$i->lysine}} %</td>
					<td class="text-center">{{$i->glucosamine}} %</td>
					<td class="text-center">{{$i->kolin}} %</td>
					<td class="text-center">{{$i->mufa}} %</td>
					<td class="text-center">{{$i->linoleic_acido6}} %</td>
					<td class="text-center">{{$i->linoleic_acid}} %</td>
					<td class="text-center">{{$i->oleic_acid}} %</td>
					<td class="text-center">{{$i->sorbitol}} %</td>
					<td class="text-center">{{$i->maltitol}} %</td>
					<td class="text-center">{{$i->kafein}} %</td>
					<td class="text-center">{{$i->kolestrol}} %</td>		
				</tr>
				</tbody>
				@endforeach
			</table>
		</div>
	</div>
</div>
@endsection