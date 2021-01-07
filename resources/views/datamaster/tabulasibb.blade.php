@extends('pv.tempvv')
@section('title', 'PRODEV|Request PDF')
@section('content')

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
            <div class="card-box table-responsive">
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
                        <table class="table table-bordered">
                          <thead>
														<p><label><input type="checkbox" checked id="checkbahan"/> Check all</label></p>
                            <input type="hidden" value="{{ Auth::user()->id }}" name="user">
														<tr><td><input type="checkbox" class="" hidden checked name="form1[]" value="ya"> Nama Bahan </td>
                            		<td><input type="checkbox" class="" hidden checked name="form2[]" value="ya"> Nama Sederhana </td>
                            		<td><input type="checkbox" class="" hidden checked name="form3[]" value="ya"> Status </td></tr>
														<tr><td><input type="checkbox" class="data1" checked name="form4[]" value="ya"> Karbohidrat </td>
																<td><input type="checkbox" class="data1" checked name="form5[]" value="ya"> Glukosa </td>
																<th><input type="checkbox" class="data1" checked name="form6[]" value="ya">Serat</th></tr>
														<tr><th><input type="checkbox" class="data1" checked name="form7[]" value="ya">Beta</th>
																<th><input type="checkbox" class="data1" checked name="form8[]" value="ya">Sorbitol</th>     
																<th><input type="checkbox" class="data1" checked name="form9[]" value="ya">Maltitol</th></tr>
														<tr><th><input type="checkbox" class="data1" checked name="form10[]" value="ya">Laktosa</th>
																<th><input type="checkbox" class="data1" checked name="form11[]" value="ya">Sukrosa</th>
																<th><input type="checkbox" class="data1" checked name="form12[]" value="ya">Gula</th></tr>
														<tr><th><input type="checkbox" class="data1" checked name="form13[]" value="ya">Erythritol</th>
																<th><input type="checkbox" class="data1" checked name="form14[]" value="ya">DHA</th>          
																<th><input type="checkbox" class="data1" checked name="form15[]" value="ya">EPA</th></tr>
														<tr><th><input type="checkbox" class="data1" checked name="form16[]" value="ya">Omega3</th>
																<th><input type="checkbox" class="data1" checked name="form17[]" value="ya">Lemak Trans</th>       
																<th><input type="checkbox" class="data1" checked name="form18[]" value="ya">MUFA</th></tr>
														<tr><th><input type="checkbox" class="data1" checked name="form19[]" value="ya">Lemak Jenuh</th>
																<th><input type="checkbox" class="data1" checked name="form20[]" value="ya">SFA</th>          
																<th><input type="checkbox" class="data1" checked name="form21[]" value="ya">Omega6</th></tr>
														<tr><th><input type="checkbox" class="data1" checked name="form22[]" value="ya">Kolestrol</th>    
																<th><input type="checkbox" class="data1" checked name="form23[]" value="ya">Protein</th>
																<th><input type="checkbox" class="data1" checked name="form24[]" value="ya">Kadar Air</th></tr>
														<!-- Mineral -->
														<tr><th><input type="checkbox" class="data1" checked name="form25[]" value="ya">Ca (mg)</th>   
																<th><input type="checkbox" class="data1" checked name="form26[]" value="ya">Fe</th>   
																<th><input type="checkbox" class="data1" checked name="form27[]" value="ya">Mg (mg)</th></tr>
														<tr><th><input type="checkbox" class="data1" checked name="form28[]" value="ya">K (mg)</th>   
																<th><input type="checkbox" class="data1" checked name="form29[]" value="ya">Cr(mcg)</th>     
																<th><input type="checkbox" class="data1" checked name="form30[]" value="ya">Zink</th></tr>
														<tr><th><input type="checkbox" class="data1" checked name="form31[]" value="ya">P (mg)</th>    
																<th><input type="checkbox" class="data1" checked name="form32[]" value="ya">Fosfor</th>   
																<th><input type="checkbox" class="data1" checked name="form33[]" value="ya">Na (mg)</th></tr>
														<tr><th><input type="checkbox" class="data1" checked name="form34[]" value="ya">NaCi</th>    
																<th><input type="checkbox" class="data1" checked name="form35[]" value="ya">Mn</th>     
																<th><input type="checkbox" class="data1" checked name="form36[]" value="ya">Energi</th></tr>
														<!-- Vitamin -->
														<tr><th><input type="checkbox" class="data1" checked name="form37[]" value="ya">VitA (mg)</th> 
																<th><input type="checkbox" class="data1" checked name="form38[]" value="ya">Biotin</th>    
																<th><input type="checkbox" class="data1" checked name="form39[]" value="ya">VitB1 (mg)</th></tr>
														<tr><th><input type="checkbox" class="data1" checked name="form40[]" value="ya">VitB2 (mg)</th> 
																<th><input type="checkbox" class="data1" checked name="form41[]" value="ya">Kolin </th> 
																<th><input type="checkbox" class="data1" checked name="form42[]" value="ya">VitB3 (mg)</th></tr>
														<tr><th><input type="checkbox" class="data1" checked name="form43[]" value="ya">VitB5 (mg)</th>  
																<th><input type="checkbox" class="data1" checked name="form44[]" value="ya">VitK (mg)</th> 
																<th><input type="checkbox" class="data1" checked name="form45[]" value="ya">VitB6 (mg)</th></tr>
														<tr><th><input type="checkbox" class="data1" checked name="form46[]" value="ya">VitB12 (mg)</th> 
																<th><input type="checkbox" class="data1" checked name="form47[]" value="ya">VitE (mg)</th> 
																<th><input type="checkbox" class="data1" checked name="form48[]" value="ya">VitC (mg)</th></tr>
														<tr><th><input type="checkbox" class="data1" checked name="form49[]" value="ya">VitD (mg)</th>
																<th><input type="checkbox" class="data1" checked name="form50[]" value="ya">Folat</th>
																<th><input type="checkbox" class="data1" checked name="form51[]" value="ya">Lisin</th></tr>
														<!-- asam amino -->
														<tr><th><input type="checkbox" class="data1" checked name="form52[]" value="ya">L-Glutamine</th> 
																<th><input type="checkbox" class="data1" checked name="form53[]" value="ya">Proline</th> 
																<th><input type="checkbox" class="data1" checked name="form54[]" value="ya">Methionin</th></tr>
														<tr><th><input type="checkbox" class="data1" checked name="form55[]" value="ya">Histidin</th>   
																<th><input type="checkbox" class="data1" checked name="form56[]" value="ya">Tyrosin</th>  
																<th><input type="checkbox" class="data1" checked name="form57[]" value="ya">BCAA</th></tr>
														<tr><th><input type="checkbox" class="data1" checked name="form58[]" value="ya">Leusin</th>   
																<th><input type="checkbox" class="data1" checked name="form59[]" value="ya">Glisin</th>     
																<th><input type="checkbox" class="data1" checked name="form60[]" value="ya">Aspartat</th></tr>
														<tr><th><input type="checkbox" class="data1" checked name="form61[]" value="ya">Serin</th>    
																<th><input type="checkbox" class="data1" checked name="form62[]" value="ya">Alanin</th>    
																<th><input type="checkbox" class="data1" checked name="form63[]" value="ya">Glutamat</th></tr>
														<tr><th><input type="checkbox" class="data1" checked name="form64[]" value="ya">Arginine</th>   
																<th><input type="checkbox" class="data1" checked name="form65[]" value="ya">Sistein</th>   
																<th><input type="checkbox" class="data1" checked name="form66[]" value="ya">Isoleusin</th></tr>
														<tr><th><input type="checkbox" class="data1" checked name="form67[]" value="ya">Threonin</th>     
																<th><input type="checkbox" class="data1" checked name="form68[]" value="ya">Phenilalanin</th>
																<th><input type="checkbox" class="data1" checked name="form69[]" value="ya">Valin</th></tr>
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
									<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
										<!-- Bahan Baku -->
										<th>#</th>             <th>Nama_Bahan</th>
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
										<th >Kolestrol</th>    <th >Protein</th>
										<th >Kadar Air</th>
										<!-- Mineral -->
										<th >Ca (mg)</th>      <th >Mg (mg)</th>
										<th >K (mg)</th>       <th >Zink</th>
										<th >P (mg)</th>       <th >Na (mg)</th>
										<th >NaCi</th>         <th >Energi</th>
										<th >Fosfor</th>       <th >Mn</th>
										<th >Cr(mcg)</th>      <th >Fe</th>
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
										<td><input type="checkbox" class="cekbox1" name="id[]" id="cekbox" value="{{$bahan->id}}"></td>
											<td>{{$bahan->nama_bahan}}</td>
											<td>{{$bahan->nama_sederhana}}</td>
											<td>{{$bahan->status}}</td>
												<td>{{$bahan->karbohidrat}}%</td>
												<td>{{$bahan->glukosa}}%</td>
												<td>{{$bahan->serat_pangan}}%</td>
												<td>{{$bahan->beta_glucan}}%</td>
												<td>{{$bahan->sorbitol}}%</td>
												<td>{{$bahan->maltitol}}%</td>
												<td>{{$bahan->laktosa}}%</td>
												<td>{{$bahan->sukrosa}}%</td>
												<td>{{$bahan->gula}}%</td>
												<td>{{$bahan->erythritol}}%</td>
												<td>{{$bahan->DHA}}%</td>
												<td>{{$bahan->EPA}}%</td>
												<td>{{$bahan->Omega3}}%</td>
												<td>{{$bahan->mufa}}%</td>
												<td>{{$bahan->lemak_trans}}%</td>
												<td>{{$bahan->lemak_jenuh}}%</td>
												<td>{{$bahan->sfa}}%</td>
												<td>{{$bahan->omega6}}%</td>
												<td>{{$bahan->kolesterol}}%</td>
												<td>{{$bahan->protein}}%</td>
												<td>{{$bahan->kadar_air}}%</td>
												<td>{{$bahan->ca}}%</td>
												<td>{{$bahan->mg}}%</td>
												<td>{{$bahan->k}}%</td>
												<td>{{$bahan->zink}}%</td>
												<td>{{$bahan->p}}%</td>
												<td>{{$bahan->na}}%</td>
												<td>{{$bahan->naci}}%</td>
												<td>{{$bahan->energi}}%</td>
												<td>{{$bahan->fosfor}}%</td>
												<td>{{$bahan->mn}}%</td>
												<td>{{$bahan->cr}}%</td>
												<td>{{$bahan->fe}}%</td>
												<td>{{$bahan->vitA}}%</td>
												<td>{{$bahan->vitB1}}%</td>
												<td>{{$bahan->vitB2}}%</td>
												<td>{{$bahan->vitB3}}%</td>
												<td>{{$bahan->vitB5}}%</td>
												<td>{{$bahan->vitB6}}%</td>
												<td>{{$bahan->vitB12}}%</td>
												<td>{{$bahan->vitC}}%</td>
												<td>{{$bahan->vitD}}%</td>
												<td>{{$bahan->vitE}}%</td>
												<td>{{$bahan->vitK}}%</td>
												<td>{{$bahan->folat}}%</td>
												<td>{{$bahan->biotin}}%</td>
												<td>{{$bahan->kolin}}%</td>
												<td>{{$bahan->l_glutamin}}%</td>
												<td>{{$bahan->Threonin}}%</td>
												<td>{{$bahan->Methioni}}%</td>
												<td>{{$bahan->Phenilalanin}}%</td>
												<td>{{$bahan->Histidin}}%</td>
												<td>{{$bahan->lisin}}%</td>
												<td>{{$bahan->BCAA}}%</td>
												<td>{{$bahan->Valin}}%</td>
												<td>{{$bahan->Leusin}}%</td>
												<td>{{$bahan->Aspartat}}%</td>
												<td>{{$bahan->Alanin}}%</td>
												<td>{{$bahan->Sistein}}%</td>
												<td>{{$bahan->Serin}}%</td>
												<td>{{$bahan->Glisin}}%</td>
												<td>{{$bahan->Glutamat}}%</td>
												<td>{{$bahan->Tyrosin}}%</td>
												<td>{{$bahan->Proline}}%</td>
												<td>{{$bahan->Arginine}}%</td>
												<td>{{$bahan->Isoleusin}}%</td>
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
  // PKP
  $("#checkbahan").change(function () {
    $(".data1").prop('checked', $(this).prop("checked"));
		console.log(data1);
  });

  // PKP2
  $("#bahan2").change(function () {
    $(".cekbox1").prop('checked', $(this).prop("checked"));
  });
</script>
@endsection