<!DOCTYPE html>
<html lang="en">

<head>
  <title> PRODEV|Tabulasi Bahan</title><link href="{{ asset('img/prod.png') }}" rel="icon">
  <link href="{{ asset('img/prod.png') }}" rel="icon">
    <link href="{{ asset('vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('build/css/custom.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/advanced-datatable/css/jquery.dataTables.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sheila.css') }}" rel="stylesheet">
</head>
<body class="nav-md">

<!-- top navigation -->
<div class="top_nav" >
  <div class="nav_menu" >
    <nav >
      <ul class="nav navbar-left">
        <img src="{{ asset('img/logo.png') }}" style="padding-top:15px;padding-left:20px" width="150">
      </ul>
      <ul class=" navbar-right">
				<li class="">
					<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
						<img src="{{ asset('img/pro.png') }}" alt="">{{ Auth::user()->name }}
						<span class=" fa fa-angle-down"></span>
					</a>
					<ul class="dropdown-menu dropdown-usermenu pull-right">
						<li><a href="{{ route('MyProfile') }}"> Profile</a></li>
						<li><a href="{{ route('signout') }}"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
					</ul>
				</li>
				</ul>
    </nav>
  </div>
</div>
<!-- /top navigation -->

<!-- page content -->

<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel" style="min-height:466px">
    <div class="x_title">
      <h3><li class="fa fa-edit"></li>Edit Tabulasi Bahan</h3>
    </div>
    <div class="x_content">
      @if (session('status'))
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="alert alert-success">
          <button type="button" class="close" data-dismiss="alert">×</button>
          {{ session('status') }}
        </div>
      </div>
      @elseif(session('error'))
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="alert alert-danger">
          <button type="button" class="close" data-dismiss="alert">×</button>
          {{ session('error') }}
        </div>
      </div>
      @endif
      <div class="col-md-12 col-sm-12 col-xs-12 profile_left">
        <div class="profile_img">
          <div id="crop-avatar">
					  <form class="form-horizontal form-label-left" method="POST" action="{{route('update_bahan')}}" novalidate>
							<table class="Table table-striped table-bordered" style="width:100">
								<thead>
									<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
										<!-- Bahan Baku -->
										<th>Nama_Bahan</th> <th>Nama Sederhana</th>
										<!-- Makro -->
										@if($form->form4=='yes')<th class="text-center">Karbohidrat</th>@endif   @if($form->form5=='yes')<th class="text-center">Glukosa</th>@endif
										@if($form->form6=='yes')<th class="text-center">Serat</th>@endif         @if($form->form7=='yes')<th class="text-center">Beta</th>@endif
										@if($form->form8=='yes')<th class="text-center">Sorbitol</th>@endif      @if($form->form9=='yes')<th class="text-center">Maltitol</th>@endif
										@if($form->form10=='yes')<th class="text-center">Laktosa</th>@endif      @if($form->form11=='yes')<th class="text-center">Sukrosa</th>@endif
										@if($form->form12=='yes')<th class="text-center">Gula</th>@endif         @if($form->form13=='yes')<th class="text-center">Erythritol</th>@endif
										@if($form->form14=='yes')<th class="text-center">DHA</th>@endif          @if($form->form15=='yes')<th class="text-center">EPA</th>@endif
										@if($form->form16=='yes')<th class="text-center">Omega3</th>@endif       @if($form->form18=='yes')<th class="text-center">MUFA</th>@endif
										@if($form->form17=='yes')<th class="text-center">Lemak Trans</th>@endif  @if($form->form19=='yes')<th class="text-center">Lemak Jenuh</th>@endif
										@if($form->form20=='yes')<th class="text-center">SFA</th>@endif          @if($form->form21=='yes')<th class="text-center">Omega6</th>@endif
										@if($form->form22=='yes')<th class="text-center">Kolestrol</th>@endif    @if($form->form23=='yes')<th class="text-center">Protein</th>@endif
										@if($form->form24=='yes')<th class="text-center">Kadar Air</th>@endif
										<!-- Mineral -->
										@if($form->form25=='yes')<th class="text-center">Ca (mg)</th>@endif      @if($form->form27=='yes')<th class="text-center">Mg (mg)</th>@endif
										@if($form->form28=='yes')<th class="text-center">K (mg)</th>@endif       @if($form->form30=='yes')<th class="text-center">Zink</th>@endif
										@if($form->form31=='yes')<th class="text-center">P (mg)</th>@endif       @if($form->form33=='yes')<th class="text-center">Na (mg)</th>@endif
										@if($form->form34=='yes')<th class="text-center">NaCi</th>@endif         @if($form->form36=='yes')<th class="text-center">Energi</th>@endif
										@if($form->form32=='yes')<th class="text-center">Fosfor</th>@endif       @if($form->form35=='yes')<th class="text-center">Mn</th>@endif
										@if($form->form29=='yes')<th class="text-center">Cr(mcg)</th>@endif      @if($form->form26=='yes')<th class="text-center">Fe</th>@endif
										<!-- Vitamin -->
										@if($form->form37=='yes')<th class="text-center">VitA (mg)</th>@endif   @if($form->form39=='yes')<th class="text-center">VitB1 (mg)</th>@endif
										@if($form->form40=='yes')<th class="text-center">VitB2 (mg)</th>@endif  @if($form->form42=='yes')<th class="text-center">VitB3 (mg)</th>@endif
										@if($form->form43=='yes')<th class="text-center">VitB5 (mg)</th>@endif  @if($form->form45=='yes')<th class="text-center">VitB6 (mg)</th>@endif
										@if($form->form46=='yes')<th class="text-center">VitB12 (mg)</th>@endif @if($form->form48=='yes')<th class="text-center">VitC (mg)</th>@endif
										@if($form->form49=='yes')<th class="text-center">VitD (mg)</th>@endif   @if($form->form47=='yes')<th class="text-center">VitE (mg)</th>@endif
										@if($form->form44=='yes')<th class="text-center">VitK (mg)</th>@endif   @if($form->form50=='yes')<th class="text-center">Folat</th>@endif
										@if($form->form38=='yes')<th class="text-center">Biotin</th>@endif      @if($form->form41=='yes')<th class="text-center">Kolin </th>@endif
										<!-- asam amino -->
										@if($form->form52=='yes')<th class="text-center">L-Glutamine</th>@endif @if($form->form54=='yes')<th class="text-center">Methionin</th>@endif
										@if($form->form55=='yes')<th class="text-center">Histidin</th>@endif    @if($form->form57=='yes')<th class="text-center">BCAA</th>@endif
										@if($form->form58=='yes')<th class="text-center">Leusin</th>@endif      @if($form->form60=='yes')<th class="text-center">Aspartat</th>@endif
										@if($form->form61=='yes')<th class="text-center">Serin</th>@endif       @if($form->form63=='yes')<th class="text-center">Glutamat</th>@endif
										@if($form->form64=='yes')<th class="text-center">Arginine</th>@endif    @if($form->form66=='yes')<th class="text-center">Isoleusin</th>@endif
										@if($form->form67=='yes')<th class="text-center">Threonin</th>@endif    @if($form->form68=='yes')<th class="text-center">Phenilalanin</th>@endif
										@if($form->form51=='yes')<th class="text-center">Lisin</th>@endif       @if($form->form69=='yes')<th class="text-center">Valin</th>@endif
										@if($form->form65=='yes')<th class="text-center">Sistein</th>@endif     @if($form->form62=='yes')<th class="text-center">Alanin</th>@endif
										@if($form->form59=='yes')<th class="text-center">Glisin</th>@endif      @if($form->form56=='yes')<th class="text-center">Tyrosin</th>@endif
										@if($form->form53=='yes')<th class="text-center">Proline</th>@endif
									</tr>
								</thead>
								<tbody>
									@foreach($bahan as $bahan)
										<tr>
											<td>{{$bahan->nama_bahan}}</td>      <td>{{$bahan->nama_sederhana}}</td>
											<input type="hidden" class="form-control" name="scores[{{$loop->index}}][id]" id="" value="{{$bahan->id_bahan}}">
											@if($bahan->form4=='yes')<td ><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][karbohidrat]" id="" value="{{$bahan->karbohidrat}}"></td>@endif
											@if($bahan->form5=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][glukosa]" id="" value="{{$bahan->glukosa}}"></td>@endif
											@if($bahan->form6=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][serat_pangan]" id="" value="{{$bahan->serat_pangan}}"></td>@endif
											@if($bahan->form7=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][beta_glucan]" id="" value="{{$bahan->beta_glucan}}"></td>@endif
											@if($bahan->form8=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][sorbitol]" id="" value="{{$bahan->sorbitol}}"></td>@endif
											@if($bahan->form9=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][maltitol]" id="" value="{{$bahan->maltitol}}"></td>@endif
											@if($bahan->form10=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][laktosa]" id="" value="{{$bahan->laktosa}}"></td>@endif
											@if($bahan->form11=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][sukrosa]" id="" value="{{$bahan->sukrosa}}"></td>@endif
											@if($bahan->form12=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][gula]" id="" value="{{$bahan->gula}}"></td>@endif
											@if($bahan->form13=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][erythritol]" id="" value="{{$bahan->erythritol}}"></td>@endif
											@if($bahan->form14=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][DHA]" id="" value="{{$bahan->DHA}}"></td>@endif
											@if($bahan->form15=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][EPA]" id="" value="{{$bahan->EPA}}"></td>@endif
											@if($bahan->form16=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][Omega3]" id="" value="{{$bahan->Omega3}}"></td>@endif
											@if($bahan->form18=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][mufa]" id="" value="{{$bahan->mufa}}"></td>@endif
											@if($bahan->form17=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][lemak_trans]" id="" value="{{$bahan->lemak_trans}}"></td>@endif
											@if($bahan->form19=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][lemak_jenuh]" id="" value="{{$bahan->lemak_jenuh}}"></td>@endif
											@if($bahan->form20=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][sfa]" id="" value="{{$bahan->sfa}}"></td>@endif
											@if($bahan->form21=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][omega6]" id="" value="{{$bahan->omega6}}"></td>@endif
											@if($bahan->form22=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][kolesterol]" id="" value="{{$bahan->kolesterol}}"></td>@endif
											@if($bahan->form23=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][protein]" id="" value="{{$bahan->protein}}"></td>@endif
											@if($bahan->form24=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][kadar_air]" id="" value="{{$bahan->kadar_air}}"></td>@endif

											@if($bahan->form25=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][ca]" id="" value="{{$bahan->ca}}"></td>@endif
											@if($bahan->form27=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][mg]" id="" value="{{$bahan->mg}}"></td>@endif
											@if($bahan->form28=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][k]" id="" value="{{$bahan->k}}"></td>@endif
											@if($bahan->form30=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][zink]" id="" value="{{$bahan->zink}}"></td>@endif
											@if($bahan->form31=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][p]" id="" value="{{$bahan->p}}"></td>@endif
											@if($bahan->form33=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][na]" id="" value="{{$bahan->na}}"></td>@endif
											@if($bahan->form34=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][naci]" id="" value="{{$bahan->naci}}"></td>@endif
											@if($bahan->form36=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][energi]" id="" value="{{$bahan->energi}}"></td>@endif
											@if($bahan->form32=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][fosfor]" id="" value="{{$bahan->fosfor}}"></td>@endif
											@if($bahan->form35=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][mn]" id="" value="{{$bahan->mn}}"></td>@endif
											@if($bahan->form29=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][cr]" id="" value="{{$bahan->cr}}"></td>@endif
											@if($bahan->form26=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][fe]" id="" value="{{$bahan->fe}}"></td>@endif

											@if($bahan->form37=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][vitA]" id="" value="{{$bahan->vitA}}"></td>@endif
											@if($bahan->form39=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][vitB1]" id="" value="{{$bahan->vitB1}}"></td>@endif
											@if($bahan->form40=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][vitB2]" id="" value="{{$bahan->vitB2}}"></td>@endif
											@if($bahan->form42=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][vitB3]" id="" value="{{$bahan->vitB3}}"></td>@endif
											@if($bahan->form43=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][vitB5]" id="" value="{{$bahan->vitB5}}"></td>@endif
											@if($bahan->form45=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][vitB6]" id="" value="{{$bahan->vitB6}}"></td>@endif
											@if($bahan->form46=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][vitB12]" id="" value="{{$bahan->vitB12}}"></td>@endif
											@if($bahan->form48=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][vitC]" id="" value="{{$bahan->vitC}}"></td>@endif
											@if($bahan->form49=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][vitD]" id="" value="{{$bahan->vitD}}"></td>@endif
											@if($bahan->form47=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][vitE]" id="" value="{{$bahan->vitE}}"></td>@endif
											@if($bahan->form44=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][vitK]" id="" value="{{$bahan->vitK}}"></td>@endif
											@if($bahan->form50=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][folat]" id="" value="{{$bahan->folat}}"></td>@endif
											@if($bahan->form38=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][biotin]" id="" value="{{$bahan->biotin}}"></td>@endif
											@if($bahan->form41=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][kolin]" id="" value="{{$bahan->kolin}}"></td>@endif

											@if($bahan->form52=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][l_glutamin]" id="" value="{{$bahan->l_glutamin}}"></td>@endif
											@if($bahan->form67=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][Threonin]" id="" value="{{$bahan->Threonin}}"></td>@endif
											@if($bahan->form54=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][Methionin]" id="" value="{{$bahan->Methionin}}"></td>@endif
											@if($bahan->form68=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][Phenilalanin]" id="" value="{{$bahan->Phenilalanin}}"></td>@endif
											@if($bahan->form55=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][Histidin]" id="" value="{{$bahan->Histidin}}"></td>@endif
											@if($bahan->form51=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][lisin]" id="" value="{{$bahan->lisin}}"></td>@endif
											@if($bahan->form57=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][BCAA]" id="" value="{{$bahan->BCAA}}"></td>@endif
											@if($bahan->form69=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][Valin]" id="" value="{{$bahan->Valin}}"></td>@endif
											@if($bahan->form58=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][Leusin]" id="" value="{{$bahan->Leusin}}"></td>@endif
											@if($bahan->form60=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][Aspartat]" id="" value="{{$bahan->Aspartat}}"></td>@endif
											@if($bahan->form62=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][Alanin]" id="" value="{{$bahan->Alanin}}"></td>@endif
											@if($bahan->form65=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][Sistein]" id="" value="{{$bahan->Sistein}}"></td>@endif
											@if($bahan->form61=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][Serin]" id="" value="{{$bahan->Serin}}"></td>@endif
											@if($bahan->form59=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][Glisin]" id="" value="{{$bahan->Glisin}}"></td>@endif
											@if($bahan->form63=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][Glutamat]" id="" value="{{$bahan->Glutamat}}"></td>@endif
											@if($bahan->form56=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][Tyrosin]" id="" value="{{$bahan->Tyrosin}}"></td>@endif
											@if($bahan->form53=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][Proline]" id="" value="{{$bahan->Proline}}"></td>@endif
											@if($bahan->form64=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][Arginine]" id="" value="{{$bahan->Arginine}}"></td>@endif
											@if($bahan->form66=='yes')<td><input style="max-width:90px" type="number" class="form-control" name="scores[{{$loop->index}}][Isoleusin]" id="" value="{{$bahan->Isoleusin}}"></td>@endif

											@if($bahan->form4==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][karbohidrat]" id="" value="{{$bahan->karbohidrat}}">@endif
											@if($bahan->form5==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][glukosa]" id="" value="{{$bahan->glukosa}}">@endif
											@if($bahan->form6==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][serat_pangan]" id="" value="{{$bahan->serat_pangan}}">@endif
											@if($bahan->form7==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][beta_glucan]" id="" value="{{$bahan->beta_glucan}}">@endif
											@if($bahan->form8==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][sorbitol]" id="" value="{{$bahan->sorbitol}}">@endif
											@if($bahan->form9==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][maltitol]" id="" value="{{$bahan->maltitol}}">@endif
											@if($bahan->form10==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][laktosa]" id="" value="{{$bahan->laktosa}}">@endif
											@if($bahan->form11==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][sukrosa]" id="" value="{{$bahan->sukrosa}}">@endif
											@if($bahan->form12==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][gula]" id="" value="{{$bahan->gula}}">@endif
											@if($bahan->form13==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][erythritol]" id="" value="{{$bahan->erythritol}}">@endif
											@if($bahan->form14==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][DHA]" id="" value="{{$bahan->DHA}}">@endif
											@if($bahan->form15==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][EPA]" id="" value="{{$bahan->EPA}}">@endif
											@if($bahan->form16==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][Omega3]" id="" value="{{$bahan->Omega3}}">@endif
											@if($bahan->form18==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][mufa]" id="" value="{{$bahan->mufa}}">@endif
											@if($bahan->form17==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][lemak_trans]" id="" value="{{$bahan->lemak_trans}}">@endif
											@if($bahan->form19==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][lemak_jenuh]" id="" value="{{$bahan->lemak_jenuh}}">@endif
											@if($bahan->form20==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][sfa]" id="" value="{{$bahan->sfa}}">@endif
											@if($bahan->form21==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][omega6]" id="" value="{{$bahan->omega6}}">@endif
											@if($bahan->form22==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][kolesterol]" id="" value="{{$bahan->kolesterol}}">@endif
											@if($bahan->form23==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][protein]" id="" value="{{$bahan->protein}}">@endif
											@if($bahan->form24==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][kadar_air]" id="" value="{{$bahan->kadar_air}}">@endif

											@if($bahan->form25==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][ca]" id="" value="{{$bahan->ca}}">@endif
											@if($bahan->form27==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][mg]" id="" value="{{$bahan->mg}}">@endif
											@if($bahan->form28==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][k]" id="" value="{{$bahan->k}}">@endif
											@if($bahan->form30==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][zink]" id="" value="{{$bahan->zink}}">@endif
											@if($bahan->form31==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][p]" id="" value="{{$bahan->p}}">@endif
											@if($bahan->form33==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][na]" id="" value="{{$bahan->na}}">@endif
											@if($bahan->form34==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][naci]" id="" value="{{$bahan->naci}}">@endif
											@if($bahan->form36==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][energi]" id="" value="{{$bahan->energi}}">@endif
											@if($bahan->form32==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][fosfor]" id="" value="{{$bahan->fosfor}}">@endif
											@if($bahan->form35==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][mn]" id="" value="{{$bahan->mn}}">@endif
											@if($bahan->form29==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][cr]" id="" value="{{$bahan->cr}}">@endif
											@if($bahan->form26==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][fe]" id="" value="{{$bahan->fe}}">@endif

											@if($bahan->form37==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][vitA]" id="" value="{{$bahan->vitA}}">@endif
											@if($bahan->form39==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][vitB1]" id="" value="{{$bahan->vitB1}}">@endif
											@if($bahan->form40==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][vitB2]" id="" value="{{$bahan->vitB2}}">@endif
											@if($bahan->form42==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][vitB3]" id="" value="{{$bahan->vitB3}}">@endif
											@if($bahan->form43==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][vitB5]" id="" value="{{$bahan->vitB5}}">@endif
											@if($bahan->form45==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][vitB6]" id="" value="{{$bahan->vitB6}}">@endif
											@if($bahan->form46==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][vitB12]" id="" value="{{$bahan->vitB12}}">@endif
											@if($bahan->form48==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][vitC]" id="" value="{{$bahan->vitC}}">@endif
											@if($bahan->form49==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][vitD]" id="" value="{{$bahan->vitD}}">@endif
											@if($bahan->form47==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][vitE]" id="" value="{{$bahan->vitE}}">@endif
											@if($bahan->form44==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][vitK]" id="" value="{{$bahan->vitK}}">@endif
											@if($bahan->form50==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][folat]" id="" value="{{$bahan->folat}}">@endif
											@if($bahan->form38==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][biotin]" id="" value="{{$bahan->biotin}}">@endif
											@if($bahan->form41==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][kolin]" id="" value="{{$bahan->kolin}}">@endif

											@if($bahan->form52==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][l_glutamin]" id="" value="{{$bahan->l_glutamin}}">@endif
											@if($bahan->form67==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][Threonin]" id="" value="{{$bahan->Threonin}}">@endif
											@if($bahan->form54==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][Methionin]" id="" value="{{$bahan->Methionin}}">@endif
											@if($bahan->form68==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][Phenilalanin]" id="" value="{{$bahan->Phenilalanin}}">@endif
											@if($bahan->form55==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][Histidin]" id="" value="{{$bahan->Histidin}}">@endif
											@if($bahan->form51==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][lisin]" id="" value="{{$bahan->lisin}}">@endif
											@if($bahan->form57==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][BCAA]" id="" value="{{$bahan->BCAA}}">@endif
											@if($bahan->form69==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][Valin]" id="" value="{{$bahan->Valin}}">@endif
											@if($bahan->form58==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][Leusin]" id="" value="{{$bahan->Leusin}}">@endif
											@if($bahan->form60==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][Aspartat]" id="" value="{{$bahan->Aspartat}}">@endif
											@if($bahan->form62==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][Alanin]" id="" value="{{$bahan->Alanin}}">@endif
											@if($bahan->form65==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][Sistein]" id="" value="{{$bahan->Sistein}}">@endif
											@if($bahan->form61==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][Serin]" id="" value="{{$bahan->Serin}}">@endif
											@if($bahan->form59==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][Glisin]" id="" value="{{$bahan->Glisin}}">@endif
											@if($bahan->form63==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][Glutamat]" id="" value="{{$bahan->Glutamat}}">@endif
											@if($bahan->form56==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][Tyrosin]" id="" value="{{$bahan->Tyrosin}}">@endif
											@if($bahan->form53==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][Proline]" id="" value="{{$bahan->Proline}}">@endif
											@if($bahan->form64==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][Arginine]" id="" value="{{$bahan->Arginine}}">@endif
											@if($bahan->form66==NULL)<input type="hidden" class="form-control" name="scores[{{$loop->index}}][Isoleusin]" id="" value="{{$bahan->Isoleusin}}">@endif
										</tr>
									@endforeach
								</tbody>
							</table>
              <button class="btn btn-primary btn-sm" type="submit"><li class="fa fa-check"></li> Submit</button>
              {{ csrf_field() }}
              <a href="{{route('hapustabulasibb')}}" class="btn btn-danger btn-sm"><li class="fa fa-ban"></li> Back</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->

<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel text-right">
    Created By Asrul :)
  </div>
  <div class="clearfix"></div>
</div>

  <!-- jQuery -->
  <script src="{{ asset('js/vendor/jquery-2.2.4.min.js') }}"></script>
  <!-- Bootstrap -->
  <script src="{{ asset('vendors/moment/min/moment.min.js') }}"></script>
  <script src="{{ asset('vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
  <script type="text/javascript" language="javascript" src="{{ asset('lib/advanced-datatable/js/jquery.dataTables.js')}}"></script>
  <script type="text/javascript" language="javascript" src="{{ asset('lib/advanced-datatable/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{ asset('js/datatables.min.js')}}"></script>
  <script src="{{ asset('build/js/custom.min.js') }}"></script>
  @yield('s')
  <script
    type="text/javascript">$('.Table').DataTable({
      "language": {
      "search": "Cari :",
      "lengthMenu": "Tampilkan _MENU_ data",
      "zeroRecords": "Tidak ada data",
      "emptyTable": "Tidak ada data",
      "info": "Menampilkan data _START_  - _END_  dari _TOTAL_ data",
      "infoEmpty": "Tidak ada data",
      "paginate": {
      "first": "Awal",
      "last": "Akhir",
      "next": ">",
      "previous": "<"
      }
    }
    });
  </script>
</body>
</html>
