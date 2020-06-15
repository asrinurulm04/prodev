<!DOCTYPE html>
<html lang="en">

<head>
  <title> PKP Project</title><link href="{{ asset('img/prod.png') }}" rel="icon">
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
    <li class="breadcrumb-item"><a href="#!">PKP Project</a>
    </li>
  </ul>
</div>
<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel" style="min-height:496px">
    <div class="x_title">
      <h3><li class="fa fa-edit"></li>Create Notulen Project PKP</h3>
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
            <form class="form-horizontal form-label-left" method="POST" action="{{route('notulenpkpp')}}" novalidate>
              <table class="table table-bordered">
                <thead>
                  <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                    <th class="text-center">Project name</th>
                    <th class="text-center" width="10%">Brand</th>
                    <th class="text-center" width="8%">Priority</th>
                    <th class="text-center">Idea</th>
                    <th class="text-center" width="10%">Deadline Launching</th>
                    <th class="text-center" width="15%">Forecash</th>
                    <th width="20%" class="text-center">Note</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($datapkp as $Dpkp)
                  <!-- perbandingan 1 -->
                  <tr>
                      <input type="hidden" name="note[{{$loop->index}}][pkp]" value="{{$Dpkp->id_pkp}}">
                      <?php $date = Date('j-F-Y'); ?>
                      <input type="hidden" name="note[{{$loop->index}}][date]" value="{{$date}}">
                    <td><input type="text" disabled name="scores[{{$loop->index}}][name]" class="form-control" value="{{$Dpkp->project_name}}"></td>
                    <td><input type="text" disabled name="scores[{{$loop->index}}][brand]" class="form-control" value="{{$Dpkp->id_brand}}"></td>
                    <td>
                      <select name="note[{{$loop->index}}][prioritas]" class="form-control" id="prioritas">
                        @if($Dpkp->prioritas=='1')
                        <option value="1" style="font-weight: bold;color:white;background-color: #2a3f54;">1</option>
                        @elseif($Dpkp->prioritas=='2')
                        <option value="2" style="font-weight: bold;color:white;background-color: #2a3f54;">2</option>
                        @elseif($Dpkp->prioritas=='3')
                        <option value="3" style="font-weight: bold;color:white;background-color: #2a3f54;">3</option>
                        @endif
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                      </select>
                    </td>
                    <input type="hidden" disabled name="scores[{{$loop->index}}][type]" class="form-control" value="{{$Dpkp->type}}">
                    <td><textarea cols="30" name="scores[{{$loop->index}}][idea]" disabled class="col-md-12 col-sm-12 col-xs-12" value="{{$Dpkp->idea}}" rows="3">{{$Dpkp->idea}}</textarea></td>
                    <td>
                      @if($Dpkp->launch!=NULL)
                      <input type="text" disabled name="scores[{{$loop->index}}][launch]" class="form-control" value="{{$Dpkp->launch}}">
                      <input type="text" disabled name="scores[{{$loop->index}}][years]" class="form-control" value="{{$Dpkp->years}}">
                      @elseif($Dpkp->launch==NULL)
                      <input type="text" disabled name="scores[{{$loop->index}}][tgl_launch]" class="form-control" value="{{$Dpkp->tgl_launch}}">
                      @endif
                    </td>
                    <td>
                      <input type="text" disabled name="scores[{{$loop->index}}][forecash]" class="form-control" value="{{$Dpkp->for1->forecast}}">
                      <input type="text" disabled name="scores[{{$loop->index}}][forecash]" class="form-control" value="{{$Dpkp->for1->satuan}}"></td>
                    <td width="90px"><textarea cols="30" name="note[{{$loop->index}}][note]" class="col-md-12 col-sm-12 col-xs-12" value="{{$Dpkp->note}}" rows="3">{{$Dpkp->note}}</textarea></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              <button class="btn btn-primary" type="submit"><li class="fa fa-check"></li> Submit</button>
              {{ csrf_field() }}
              <a href="{{route('hapuscheck')}}" class="btn btn-danger"><li class="fa fa-arrow-left"></li> Back</a>
            </form>
          </div>
        </div>
        <h3 class="text-center"></h3>
        <h6 class="text-center"></h6>
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
