<!DOCTYPE html>
<html lang="en">

<head>
  <title> PDF Project</title><link href="{{ asset('img/prod.png') }}" rel="icon">
  <link href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
  <link href="{{ asset('build/css/custom.min.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('lib/advanced-datatable/css/jquery.dataTables.css') }}" rel="stylesheet" />
  <link href="{{ URL::asset('css/dataTables.min.css') }}" rel="stylesheet">
</head>
<body class="nav-md">

<!-- top navigation -->
<div class="top_nav">
  <div class="nav_menu">
    <nav>
      <ul class="nav navbar-left">
        <img src="{{ asset('img/logo.png') }}" style="padding-top:10px" width="50%">
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="">
          <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <img src="img/prod.png" alt="">{{ Auth::user()->name }}
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
<div class="col-md-12" >
  <ul class="breadcrumb">
    <li class="breadcrumb-item" style="padding-left:1000px">
      <a href="{{route('lala')}}"> <i class="fa fa-home"></i> Dasboard</a>
    </li>
    <li class="breadcrumb-item">
      <a href="{{route('tabulasi')}}"> <i class="fa fa-folder"></i> Project All</a>
    </li>
    <li class="breadcrumb-item"><a href="#!">PDF Project</a>
    </li>
  </ul>
</div>

<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel" style="min-height:466px">
    <div class="x_title">
      <h3><li class="fa fa-edit"></li>Create Notulen Project PDF</h3>
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
					  <form class="form-horizontal form-label-left" method="POST" action="{{route('notulenpdff')}}" novalidate>
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
										<td><input type="checkbox" class="cekbox1" name="datapkpp[]" id="cekbox" value="{{$bahan->id}}"></td>
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
              <button class="btn btn-primary btn-sm" type="submit"><li class="fa fa-check"></li> Submit</button>
              {{ csrf_field() }}
              <a href="{{route('hapuscheckpdf')}}" class="btn btn-danger btn-sm"><li class="fa fa-arrow-left"></li> Back</a>
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
