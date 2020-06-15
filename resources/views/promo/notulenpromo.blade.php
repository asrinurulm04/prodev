<!DOCTYPE html>
<html lang="en">

<head>
  <title> Project PROMO</title><link href="{{ asset('img/prod.png') }}" rel="icon">
  <link href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
  <link href="{{ asset('build/css/custom.min.css') }}" rel="stylesheet">
  <link href="{{ asset('lib/advanced-datatable/css/jquery.dataTables.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/dataTables.min.css') }}" rel="stylesheet">
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
    <li class="breadcrumb-item"><a href="#!"> Project PROMO</a>
    </li>
  </ul>
</div>

<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel" style="min-height:466px">
    <div class="x_title">
      <h3><li class="fa fa-edit"></li>Create Notulen Project PROMO</h3>
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
					<form class="form-horizontal form-label-left" method="POST" action="{{route('notulenpromoo')}}" novalidate>
            <table class="Table table-bordered">
              <thead>
                <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                  <td class="text-center">Project Name</td>
                  <th class="text-center">Brand</th>
                  <th class="text-center">Prioritas</th>
                  <th class="text-center">Type</th>
                  <th class="text-center">Idea</th>
                  <th class="text-center">Note</th>
                </tr>
              </thead>
              <tbody>
                @foreach($datapromo as $Dpromo)
                <tr>
                	<input type="hidden" name="note[{{$loop->index}}][promo]" value="{{$Dpromo->id_pkp_promoo}}">
                  <?php $date = Date('j-F-Y'); ?>
                  <input type="hidden" name="note[{{$loop->index}}][date]" value="{{$date}}">
                  <td><input type="text" disabled name="datapromo[{{$loop->index}}][name]" class="form-control" value="{{$Dpromo->project_name}}"></td>
                  <td><input type="text" disabled name="datapromo[{{$loop->index}}][brand]" class="form-control" value="{{$Dpromo->brand}}"></td>
                  <td>
                    <select name="datapromo[{{$loop->index}}][prioritas]" id="prioritas">
                      @if($Dpromo->prioritas==1)
                      <option value="1" style="font-weight: bold;color:white;background-color: #2a3f54;">priority 1</option>
                      @elseif($Dpromo->prioritas==2)
                      <option value="2" style="font-weight: bold;color:white;background-color: #2a3f54;">priority 2</option>
                      @elseif($Dpromo->prioritas==3)
                      <option value="3" style="font-weight: bold;color:white;background-color: #2a3f54;">priority 3</option>
                      @endif
                      <option value="1">priority 1</option>
                      <option value="2">priority 2</option>
                      <option value="3">priority 3</option>
                    </select>
                  </td>
                  <td><input type="text" disabled name="datapromo[{{$loop->index}}][type]" class="form-control" value="{{$Dpromo->type}}"></td>
                  <td><input type="text" disabled name="datapromo[{{$loop->index}}][country]" class="form-control" value="{{$Dpromo->country}}"></td>
                  <td><textarea name="note[{{$loop->index}}][note]" clas="col-md-12 col-sm-12 col-xs-12" value="{{$Dpromo->note}}" rows="2">{{$Dpromo->note}}</textarea></td>
                </tr>
                 @endforeach
              </tbody>
            </table>
            <button class="btn btn-primary" type="submit"><li class="fa fa-check"></li> Submit</button>
            {{ csrf_field() }}
            <a href="{{route('hapuscheckpromo')}}" class="btn btn-danger"><li class="fa fa-arrow-left"></li> Back</a>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

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