@extends('pv.tempvv')
@section('title', 'PRODEV|Request PDF')
@section('content')

<div class="row">
  @if(session('error'))
  <div class="col-lg-12 col-md-12 col-sm-12">
    <div class="alert alert-danger">
    	<button type="button" class="close" data-dismiss="alert">×</button>
      {{ session('error') }}
    </div>
  </div>
  @endif
</div>

<div class="row">
  <div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
      <div class="x_title">
				<h2><li class="fa fa-table"></li> Tabulasi Bahan Baku</h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link" hidden><i class="fa fa-chevron-up"></i></a></li>
        </ul>
        <div class="clearfix"></div>
      </div>
			<form class="form-horizontal form-label-left" method="POST" action="{{route('checktabulasi')}}" novalidate>
      <div class="x_content">
        <div class="row">
          <div class="col-sm-12">
            <div class="card-box">
							<button class="btn btn-primary btn-sm" type="button" data-toggle="modal" data-target="#parampkp"><i class="fa fa-hand-o-right"></i> Custom Tabular</a></button>
              <!-- modal -->
              <div class="modal" id="parampkp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h3 class="modal-title text-left" id="exampleModalLabel">Select Header
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></h3>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group row">
												<table class="table">
													<td><label><input type="checkbox" checked id="checkbahan"/> Check all</label></td>
													<td><label><input type="checkbox" class="data1" checked id="checkmakro"/> Makro</label></td>
													<td><label><input type="checkbox" class="data1" checked id="checkmineral"/> Mineral</label></td>
													<td><label><input type="checkbox" class="data1" checked id="checkvitamin"/> Vitamin</label></td>
													<td><label><input type="checkbox" class="data1" checked id="checkasam"/> Asam Amino</label></td>
												</table>
                        <table class="table table-bordered">
                          <thead>
                            <input type="hidden" value="{{ Auth::user()->id }}" name="user">
														<tr><td><input type="checkbox" class="" hidden checked name="form1" value="yes"> Nama Bahan </td>
                            		<td><input type="checkbox" class="" hidden checked name="form2" value="yes"> Nama Sederhana </td>
                            		<td><input type="checkbox" class="" hidden checked name="form3" value="yes"> Status </td></tr>
														<!-- Makro -->
														<tr><th><input type="checkbox" class="data1 makro" checked name="form4" value="yes"> Karbohidrat </th>
																<th><input type="checkbox" class="data1 makro" checked name="form5" value="yes"> Glukosa </th>
																<th><input type="checkbox" class="data1 makro" checked name="form6" value="yes">	Serat</th></tr>
														<tr><th><input type="checkbox" class="data1 makro" checked name="form7" value="yes">	Beta</th>
																<th><input type="checkbox" class="data1 makro" checked name="form8" value="yes">	Sorbitol</th>     
																<th><input type="checkbox" class="data1 makro" checked name="form9" value="yes">	Maltitol</th></tr>
														<tr><th><input type="checkbox" class="data1 makro" checked name="form10" value="yes">	Laktosa</th>
																<th><input type="checkbox" class="data1 makro" checked name="form11" value="yes">	Sukrosa</th>
																<th><input type="checkbox" class="data1 makro" checked name="form12" value="yes">	Gula</th></tr>
														<tr><th><input type="checkbox" class="data1 makro" checked name="form13" value="yes">	Erythritol</th>
																<th><input type="checkbox" class="data1 makro" checked name="form14" value="yes">	DHA</th>          
																<th><input type="checkbox" class="data1 makro" checked name="form15" value="yes">	EPA</th></tr>
														<tr><th><input type="checkbox" class="data1 makro" checked name="form16" value="yes">	Omega3</th>
																<th><input type="checkbox" class="data1 makro" checked name="form17" value="yes">	Lemak Trans</th>       
																<th><input type="checkbox" class="data1 makro" checked name="form18" value="yes">	MUFA</th></tr>
														<tr><th><input type="checkbox" class="data1 makro" checked name="form19" value="yes">	Lemak Jenuh</th>
																<th><input type="checkbox" class="data1 makro" checked name="form20" value="yes">	SFA</th>          
																<th><input type="checkbox" class="data1 makro" checked name="form21" value="yes">	Omega6</th></tr>
														<tr><th><input type="checkbox" class="data1 makro" checked name="form22" value="yes">	Kolestrol</th>    
																<th><input type="checkbox" class="data1 makro" checked name="form23" value="yes">	Protein</th>
																<th><input type="checkbox" class="data1 makro" checked name="form24" value="yes">	Kadar Air</th></tr>
														<!-- Mineral -->
														<tr><th><input type="checkbox" class="data1 mineral" checked name="form25" value="yes">	Ca (mg)</th>   
																<th><input type="checkbox" class="data1 mineral" checked name="form26" value="yes">	Fe</th>   
																<th><input type="checkbox" class="data1 mineral" checked name="form27" value="yes">	Mg (mg)</th></tr>
														<tr><th><input type="checkbox" class="data1 mineral" checked name="form28" value="yes">	K (mg)</th>   
																<th><input type="checkbox" class="data1 mineral" checked name="form29" value="yes">	Cr(mcg)</th>     
																<th><input type="checkbox" class="data1 mineral" checked name="form30" value="yes">	Zink</th></tr>
														<tr><th><input type="checkbox" class="data1 mineral" checked name="form31" value="yes">	P (mg)</th>    
																<th><input type="checkbox" class="data1 mineral" checked name="form32" value="yes">	Fosfor</th>   
																<th><input type="checkbox" class="data1 mineral" checked name="form33" value="yes">	Na (mg)</th></tr>
														<tr><th><input type="checkbox" class="data1 mineral" checked name="form34" value="yes">	NaCi</th>    
																<th><input type="checkbox" class="data1 mineral" checked name="form35" value="yes">	Mn</th>     
																<th><input type="checkbox" class="data1 mineral" checked name="form36" value="yes">	Energi</th></tr>
														<!-- Vitamin -->	
														<tr><th><input type="checkbox" class="data1 vitamin" checked name="form37" value="yes">	VitA (mg)</th> 
																<th><input type="checkbox" class="data1 vitamin" checked name="form38" value="yes">	Biotin</th>    
																<th><input type="checkbox" class="data1 vitamin" checked name="form39" value="yes">	VitB1 (mg)</th></tr>
														<tr><th><input type="checkbox" class="data1 vitamin" checked name="form40" value="yes">	VitB2 (mg)</th> 
																<th><input type="checkbox" class="data1 vitamin" checked name="form41" value="yes">	Kolin </th> 
																<th><input type="checkbox" class="data1 vitamin" checked name="form42" value="yes">	VitB3 (mg)</th></tr>
														<tr><th><input type="checkbox" class="data1 vitamin" checked name="form43" value="yes">	VitB5 (mg)</th>  
																<th><input type="checkbox" class="data1 vitamin" checked name="form44" value="yes">	VitK (mg)</th> 
																<th><input type="checkbox" class="data1 vitamin" checked name="form45" value="yes">	VitB6 (mg)</th></tr>
														<tr><th><input type="checkbox" class="data1 vitamin" checked name="form46" value="yes">	VitB12 (mg)</th> 
																<th><input type="checkbox" class="data1 vitamin" checked name="form47" value="yes">	VitE (mg)</th> 
																<th><input type="checkbox" class="data1 vitamin" checked name="form48" value="yes">	VitC (mg)</th></tr>
														<tr><th><input type="checkbox" class="data1 vitamin" checked name="form49" value="yes">	VitD (mg)</th>
																<th><input type="checkbox" class="data1 vitamin" checked name="form50" value="yes">	Folat</th>
														<!-- asam amino -->
																<th><input type="checkbox" class="data1 asam" checked name="form51" value="yes">	Lisin</th></tr>
														<tr><th><input type="checkbox" class="data1 asam" checked name="form52" value="yes">	L-Glutamine</th> 
																<th><input type="checkbox" class="data1 asam" checked name="form53" value="yes">	Proline</th> 
																<th><input type="checkbox" class="data1 asam" checked name="form54" value="yes">	Methionin</th></tr>
														<tr><th><input type="checkbox" class="data1 asam" checked name="form55" value="yes">	Histidin</th>   
																<th><input type="checkbox" class="data1 asam" checked name="form56" value="yes">	Tyrosin</th>  
																<th><input type="checkbox" class="data1 asam" checked name="form57" value="yes">	BCAA</th></tr>
														<tr><th><input type="checkbox" class="data1 asam" checked name="form58" value="yes">	Leusin</th>   
																<th><input type="checkbox" class="data1 asam" checked name="form59" value="yes">	Glisin</th>     
																<th><input type="checkbox" class="data1 asam" checked name="form60" value="yes">	Aspartat</th></tr>
														<tr><th><input type="checkbox" class="data1 asam" checked name="form61" value="yes">	Serin</th>    
																<th><input type="checkbox" class="data1 asam" checked name="form62" value="yes">	Alanin</th>    
																<th><input type="checkbox" class="data1 asam" checked name="form63" value="yes">	Glutamat</th></tr>
														<tr><th><input type="checkbox" class="data1 asam" checked name="form64" value="yes">	Arginine</th>   
																<th><input type="checkbox" class="data1 asam" checked name="form65" value="yes">	Sistein</th>   
																<th><input type="checkbox" class="data1 asam" checked name="form66" value="yes">	Isoleusin</th></tr>
														<tr><th><input type="checkbox" class="data1 asam" checked name="form67" value="yes">	Threonin</th>     
																<th><input type="checkbox" class="data1 asam" checked name="form68" value="yes">	Phenilalanin</th>
																<th><input type="checkbox" class="data1 asam" checked name="form69" value="yes">	Valin</th></tr>
                          </thead>
                        </table>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-paper-plane"></i> Submit</button>
                      {{ csrf_field() }}
                    </div>
                  </div>
                </div>
              </div>
              <!-- Modal Selesai -->
							<label><input type="checkbox" id="bahan2"/> Check all</label>
        			<table id="datatable" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th rowspan="2"  class="text-center" style="font-weight: bold;color:white;background-color: #2a3f54;">#</th>
										<th colspan="3"  class="text-center" style="font-weight: bold;color:white;background-color: #2a3f54;" width="20%">Material</th>
										<th colspan="19"  class="text-center" style="font-weight: bold;color:white;background-color: #2a3f54;">Makro</th>
										<th rowspan="2"  class="text-center" style="font-weight: bold;color:white;background-color: #2a3f54;">Protein</th>
										<th colspan="12"  class="text-center" style="font-weight: bold;color:white;background-color: #2a3f54;">MIneral</th>
										<th colspan="14"  class="text-center" style="font-weight: bold;color:white;background-color: #2a3f54;">Vitamin</th>
										<th colspan="19" class="text-center" style="font-size: 12px;font-weight: bold; color:black;background-color: #898686;">Asam Amino</th>
									</tr>
									<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
										<!-- Bahan Baku -->
										<th>Nama_Bahan</th>
										<th>Nama Sederhana</th><th>Status</th>
										<!-- Makro -->
										<th >Karbohidrat</th>  <th >Glukosa</th>
										<th >Serat</th>        <th >Beta</th>
										<th >Sorbitol</th>     <th >Maltitol</th>
										<th >Laktosa</th>      <th >Sukrosa</th>
										<th >Gula</th>         <th >Erythritol</th>
										<th >DHA</th>          <th >EPA</th>
										<th >Omega3</th>       <th >MUFA</th>
										<th >Lemak Trans</th>  <th >Lemak Jenuh</th>
										<th >SFA</th>          <th >Omega6</th>
										<th >Kolestrol</th>    
										<!-- Mineral -->
										<th >Ca (mg)</th>      <th >Mg (mg)</th>
										<th >K (mg)</th>       <th >Zink</th>
										<th >Na (mg)</th> 		 <th >NaCi</th>
										<th >Energi</th> 		   <th >Fosfor</th>       
										<th >Mn</th> 					 <th >Cr(mcg)</th>
							      <th >Fe</th>
										<!-- Vitamin -->
										<th >VitA (mg)</th>   <th >VitB1 (mg)</th>
										<th >VitB2 (mg)</th>  <th >VitB3 (mg)</th>
										<th >VitB5 (mg)</th>  <th >VitB6 (mg)</th>
										<th >VitB12 (mg)</th> <th >VitC (mg)</th>
										<th >VitD (mg)</th>   <th >VitE (mg)</th>
										<th >VitK (mg)</th>   <th >Folat</th>
										<th >Biotin</th>       <th >Kolin </th>
										<!-- asam amino -->
										<th >L-Glutamine</th>  <th >Methionin</th>
										<th >Histidin</th>     <th >BCAA</th>
										<th >Leusin</th>       <th >Aspartat</th>
										<th >Serin</th>        <th >Glutamat</th>
										<th >Arginine</th>     <th >Isoleusin</th>
										<th >Threonin</th>     <th >Phenilalanin</th>
										<th >Lisin</th>        <th >Valin</th>
										<th >Sistein</th>      <th >Alanin</th>
										<th >Glisin</th>       <th >Tyrosin</th>
										<th >Proline</th>
									</tr>
								</thead>
								<tbody>
									@foreach($bahan as $bahan)
										<tr>
											<td><input type="checkbox" class="cekbox1" name="id[]" id="cekbox" value="{{$bahan->id_bahan}}"></td>
											<td>{{$bahan->nama_bahan}}</td>			<td>{{$bahan->nama_sederhana}}</td>
											<td>{{$bahan->status}}</td>					<td>{{$bahan->karbohidrat}}g</td>
											<td>{{$bahan->glukosa}}g</td>				<td>{{$bahan->serat_pangan}}g</td>
											<td>{{$bahan->beta_glucan}}g</td>		<td>{{$bahan->sorbitol}}g</td>
											<td>{{$bahan->maltitol}}g</td>			<td>{{$bahan->laktosa}}g</td>
											<td>{{$bahan->sukrosa}}g</td>				<td>{{$bahan->gula}}g</td>
											<td>{{$bahan->erythritol}}g</td>		<td>{{$bahan->DHA}}g</td>
											<td>{{$bahan->EPA}}g</td>						<td>{{$bahan->Omega3}}g</td>
											<td>{{$bahan->mufa}}g</td>					<td>{{$bahan->lemak_trans}}g</td>
											<td>{{$bahan->lemak_jenuh}}g</td>		<td>{{$bahan->sfa}}g</td>
											<td>{{$bahan->omega6}}g</td>				<td>{{$bahan->kolesterol}}g</td>
											<td>{{$bahan->protein}}g</td>				<td>{{$bahan->ca}}Mg</td>
											<td>{{$bahan->mg}}Mg</td> 					<td>{{$bahan->k}}Mg</td>						
											<td>{{$bahan->zink}}Mg</td> 				<td>{{$bahan->na}}Mg</td>
											<td>{{$bahan->naci}}Mg</td>					<td>{{$bahan->energi}}Mg</td>
											<td>{{$bahan->fosfor}}Mg</td>				<td>{{$bahan->mn}}Mg</td>
											<td>{{$bahan->cr}}Mcg</td>					<td>{{$bahan->fe}}Mg</td>
											<td>{{$bahan->vitA}}IU</td>					<td>{{$bahan->vitB1}}Mg</td>
											<td>{{$bahan->vitB2}}Mg</td>				<td>{{$bahan->vitB3}}Mg</td>
											<td>{{$bahan->vitB5}}Mg</td>				<td>{{$bahan->vitB6}}Mg</td>
											<td>{{$bahan->vitB12}}Mcg</td>			<td>{{$bahan->vitC}}Mg</td>
											<td>{{$bahan->vitD}}Iu</td>					<td>{{$bahan->vitE}}Mg</td>
											<td>{{$bahan->vitK}}Mg</td>					<td>{{$bahan->folat}}Mcg</td>
											<td>{{$bahan->biotin}}Mcg</td>			<td>{{$bahan->kolin}}Mg</td>
											<td>{{$bahan->l_glutamin}}Mg</td>		<td>{{$bahan->Threonin}}Mg</td>
											<td>{{$bahan->Methioni}}Mg</td>			<td>{{$bahan->Phenilalanin}}Mg</td>
											<td>{{$bahan->Histidin}}Mg</td>			<td>{{$bahan->lisin}}Mg</td>
											<td>{{$bahan->BCAA}}Mg</td>					<td>{{$bahan->Valin}}Mg</td>
											<td>{{$bahan->Leusin}}Mg</td>				<td>{{$bahan->Aspartat}}Mg</td>
											<td>{{$bahan->Alanin}}Mg</td>				<td>{{$bahan->Sistein}}Mg</td>
											<td>{{$bahan->Serin}}Mg</td>					<td>{{$bahan->Glisin}}Mg</td>
											<td>{{$bahan->Glutamat}}Mg</td>			<td>{{$bahan->Tyrosin}}Mg</td>
											<td>{{$bahan->Proline}}Mg</td>				<td>{{$bahan->Arginine}}Mg</td>
											<td>{{$bahan->Isoleusin}}Mg</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			</form>
		</div>
	</div>
</div>			
@endsection
@section('s')
<script>
  // Header ALl
  $("#checkbahan").change(function () {
    $(".data1").prop('checked', $(this).prop("checked"));
  });
  // Header makro
  $("#checkmakro").change(function () {
    $(".makro").prop('checked', $(this).prop("checked"));
  });
  // Header vitamin
  $("#checkvitamin").change(function () {
    $(".vitamin").prop('checked', $(this).prop("checked"));
  });
  // Header mineral
  $("#checkmineral").change(function () {
    $(".mineral").prop('checked', $(this).prop("checked"));
  });
  // Header asam
  $("#checkasam").change(function () {
    $(".asam").prop('checked', $(this).prop("checked"));
  });
  // Bahan
  $("#bahan2").change(function () {
    $(".cekbox1").prop('checked', $(this).prop("checked"));
  });
</script>
@endsection