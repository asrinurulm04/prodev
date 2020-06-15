<!DOCTYPE html>
<html lang="en">

<head>
  <title> Project PROMO</title><link href="{{ asset('img/prod.png') }}" rel="icon">
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
    <li class="breadcrumb-item"><a href="#!"> Project PROMO</a>
    </li>
  </ul>
</div>

<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel" style="min-height:466px">
    <div class="x_title">
      <h3><li class="fa fa-edit"></li>Edit Project PROMO</h3>
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
					<form class="form-horizontal form-label-left" method="POST" action="{{route('update_promo')}}" novalidate>
            <table class="Table table-bordered">
              <thead>
                <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                  <td></td>
                  @foreach($par as $pr)
                  @if($pr->form1=='ya')<td class="text-center">Project Name</td>@endif
                  @if($pr->form2=='ya')<th class="text-center">Brand</th>@endif
                  @if($pr->form3=='ya')<th class="text-center">Type</th>@endif
                  @if($pr->form4=='ya')<th class="text-center">country</th>@endif
                  @if($pr->form5=='ya')<th class="text-center">Item promo type</th>@endif
                  @if($pr->form6=='ya')<th class="text-center">Promo Idea</th>@endif
                  @if($pr->form7=='ya')<th class="text-center">Dimension</th>@endif
                  @if($pr->form8=='ya')<th class="text-center">Application</th>@endif
                  @if($pr->form9=='ya')<th class="text-center">Promo readines</th>@endif
                  @if($pr->form10=='ya')<th class="text-center">RTO</th>@endif 
                  @endforeach
                </tr>
              </thead>
              <tbody>
                @foreach($datapromo as $Dpromo)
                <tr>
                  <input type="hidden" name="datapromo[{{$loop->index}}][id_promo]" value="{{$Dpromo->id_pkp_promoo}}">
                  <input type="hidden" name="datapromo[{{$loop->index}}][turun]" value="{{$Dpromo->turunan}}" class="form-control">
                  <input type="hidden" name="datapromo[{{$loop->index}}][gambaran_proses]" value="{{$Dpromo->gambaran_proses}}" class="form-control">
                  <input type="hidden" name="datapromo[{{$loop->index}}][revisi]" value="{{$Dpromo->revisi}}" class="form-control">
                  <input type="hidden" name="datapromo[{{$loop->index}}][rev]" value="{{$Dpromo->revisi+1}}" class="form-control">
                  <input type="hidden" name="datapromo[{{$loop->index}}][status]" value="inactive" class="form-control">
                  <?php $tanggal = Date("Y"); ?>
                  @if($Dpromo->type=='Maklon')
                  <input type="hidden" value="_{{$tanggal}}/PKP_PROMO-M_{{ $Dpromo->project_name }}_{{ $Dpromo->revisi+1 }}.{{$Dpromo->turunan}}" name="datapromo[{{$loop->index}}][ket]" id="ket_no">
                  @elseif($Dpromo->type!='Maklon')
                  <input type="hidden" value="_{{$tanggal}}/PKP_PROMO_{{ $Dpromo->project_name }}_{{ $Dpromo->revisi+1 }}.{{$Dpromo->turunan}}" name="datapromo[{{$loop->index}}][ket]" id="ket_no">
                  @endif
                  <td><a href="{{route('deletepromo1',$Dpromo->id_pkp_promo)}}"" class="btn btn-danger" type="button"><li class="fa fa-trash"></li></a></td>
                  @if($Dpromo->form1=='ya')<td><input type="text" name="datapromo[{{$loop->index}}][name]" class="form-control" value="{{$Dpromo->project_name}}"></td>
                  @elseif($Dpromo->form1=='')<input type="hidden" name="datapromo[{{$loop->index}}][name]" class="form-control" value="{{$Dpromo->project_name}}">@endif
                  @if($Dpromo->form2=='ya')<td>
                    <select name="datapromo[{{$loop->index}}][brand]" class="form-control">
                      <option value="{{$Dpromo->brand}}">{{$Dpromo->brand}}</option>
                      @foreach($brand as $br)
                      <option value="{{$br->brand}}">{{$br->brand}}</option>
                      @endforeach
                    </select>
                    @elseif($Dpromo->form2=='')<select style="display:none;" name="datapromo[{{$loop->index}}][brand]" class="form-control">
                      <option value="{{$Dpromo->brand}}">{{$Dpromo->brand}}</option>
                      @foreach($brand as $br)
                      <option value="{{$br->brand}}">{{$br->brand}}</option>
                      @endforeach
                    </select>
                  </td>@endif
                  @if($Dpromo->form3=='ya')<td>
                    <select name="datapromo[{{$loop->index}}][type]" class="form-control">
                      <option value="{{$Dpromo->type}}" readonly>
                        @if($Dpromo->type==1)
                        Maklon
                        @elseif($Dpromo->type==2)
                        Internal
                        @elseif($Dpromo->type==3)
                        Maklon/Internal
                        @endif
                      </option>
                      <option value="1">Maklon</option>
                      <option value="2">Internal</option>
                      <option value="3">Maklon/Internal</option>
                    </select>
                    @elseif($Dpromo->form3=='')<select style="display:none;" name="datapromo[{{$loop->index}}][type]" class="form-control">
                      <option value="{{$Dpromo->type}}" readonly>
                        @if($Dpromo->type==1)
                        Maklon
                        @elseif($Dpromo->type==2)
                        Internal
                        @elseif($Dpromo->type==3)
                        Maklon/Internal
                        @endif
                      </option>
                    </select>
                  </td>@endif
                  @if($Dpromo->form4=='ya')<td><input type="text" name="datapromo[{{$loop->index}}][country]" class="form-control" value="{{$Dpromo->country}}"></td>
                  @elseif($Dpromo->form4=='')<input type="hidden" name="datapromo[{{$loop->index}}][country]" class="form-control" value="{{$Dpromo->country}}">@endif
                  @if($Dpromo->form5=='ya')<td><input type="text" name="datapromo[{{$loop->index}}][promotype]" class="form-control" value="{{$Dpromo->promo_type}}"></td>
                  @elseif($Dpromo->form5=='')<input type="hidden" name="datapromo[{{$loop->index}}][promotype]" class="form-control" value="{{$Dpromo->promo_type}}">@endif
                  @if($Dpromo->form6=='ya')<td><input type="text" name="datapromo[{{$loop->index}}][idea]" class="form-control" value="{{$Dpromo->promo_idea}}"></td>
                  @elseif($Dpromo->form6=='')<input type="hidden" name="datapromo[{{$loop->index}}][idea]" class="form-control" value="{{$Dpromo->promo_idea}}">@endif
                  @if($Dpromo->form7=='ya')<td><input type="text" name="datapromo[{{$loop->index}}][dimension]" class="form-control" value="{{$Dpromo->dimension}}"></td>
                  @elseif($Dpromo->form7=='')<input type="hidden" name="datapromo[{{$loop->index}}][dimension]" class="form-control" value="{{$Dpromo->dimension}}">@endif
                  @if($Dpromo->form8=='ya')<td><input type="text" name="datapromo[{{$loop->index}}][app]" class="form-control" value="{{$Dpromo->application}}"></td>
                  @elseif($Dpromo->form8=='')<input type="hidden" name="datapromo[{{$loop->index}}][app]" class="form-control" value="{{$Dpromo->application}}">@endif
                  @if($Dpromo->form9=='ya')<td><input type="date" name="datapromo[{{$loop->index}}][readines]" class="form-control" value="{{$Dpromo->promo_readiness}}"></td>
                  @elseif($Dpromo->form9=='')<input type="hidden" name="datapromo[{{$loop->index}}][readines]" class="form-control" value="{{$Dpromo->promo_readiness}}"><@endif
                  @if($Dpromo->form10=='ya')<td><input type="date" name="datapromo[{{$loop->index}}][rto]" class="form-control" value="{{$Dpromo->rto}}"></td>
                  @elseif($Dpromo->form10=='')<input type="hidden" name="datapromo[{{$loop->index}}][rto]" class="form-control" value="{{$Dpromo->rto}}">@endif
                  <textarea name="note[{{$loop->index}}][note]" value="" style="display:none;" id="" cols="30" rows="10"></textarea>
                </tr>
                 @endforeach
              </tbody>
            </table>
            @foreach($datapromo as $Dpromo)
            <input type="hidden" name="datapromo1[{{$loop->index}}][id_promo]" value="{{$Dpromo->id_pkp_promoo}}">
            <input type="hidden" name="note[{{$loop->index}}][promo]" value="{{$Dpromo->id_pkp_promoo}}">
            <input type="hidden" name="datapromo1[{{$loop->index}}][turun]" value="{{$Dpromo->turunan}}" class="form-control">
            <input type="hidden" name="datapromo1[{{$loop->index}}][gambaran_proses]" value="{{$Dpromo->gambaran_proses}}" class="form-control">
            <input type="hidden" name="datapromo1[{{$loop->index}}][revisi]" value="{{$Dpromo->revisi}}" class="form-control">
            <input type="hidden" name="datapromo1[{{$loop->index}}][rev]" value="{{$Dpromo->revisi+1}}" class="form-control">
            <input type="hidden" name="datapromo1[{{$loop->index}}][status]" value="inactive" class="form-control">
            <?php $tanggal = Date("Y"); ?>
            @if($Dpromo->type=='Maklon')
            <input type="hidden" value="_{{$tanggal}}/PKP_PROMO-M_{{ $Dpromo->project_name }}_{{ $Dpromo->revisi+1 }}.{{$Dpromo->turunan}}" name="datapromo1[{{$loop->index}}][ket]" id="ket_no">
            @elseif($Dpromo->type!='Maklon')
            <input type="hidden" value="_{{$tanggal}}/PKP_PROMO_{{ $Dpromo->project_name }}_{{ $Dpromo->revisi+1 }}.{{$Dpromo->turunan}}" name="datapromo1[{{$loop->index}}][ket]" id="ket_no">
            @endif
            @if($Dpromo->form1=='ya')<input type="hidden" name="datapromo1[{{$loop->index}}][name]" class="form-control" value="{{$Dpromo->project_name}}">
            @elseif($Dpromo->form1=='')<input type="hidden" name="datapromo1[{{$loop->index}}][name]" class="form-control" value="{{$Dpromo->project_name}}">@endif
            @if($Dpromo->form2=='ya')
              <select style="display:none;" name="datapromo1[{{$loop->index}}][brand]" class="form-control">
                <option value="{{$Dpromo->brand}}">{{$Dpromo->brand}}</option>
                @foreach($brand as $br)
                <option value="{{$br->brand}}">{{$br->brand}}</option>
                @endforeach
              </select>
            @elseif($Dpromo->form2=='')
              <select style="display:none;" name="datapromo1[{{$loop->index}}][brand]" class="form-control">
                <option value="{{$Dpromo->brand}}">{{$Dpromo->brand}}</option>
                @foreach($brand as $br)
                <option value="{{$br->brand}}">{{$br->brand}}</option>
                @endforeach
              </select>
            @endif
            @if($Dpromo->form3=='ya')
              <select style="display:none;" name="datapromo1[{{$loop->index}}][type]" class="form-control">
                <option value="{{$Dpromo->type}}" readonly>
                  @if($Dpromo->type==1)
                    Maklon
                  @elseif($Dpromo->type==2)
                    Internal
                  @elseif($Dpromo->type==3)
                    Maklon/Internal
                  @endif
                </option>
              </select>
            @elseif($Dpromo->form3=='')
              <select style="display:none;" name="datapromo1[{{$loop->index}}][type]" class="form-control">
                <option value="{{$Dpromo->type}}" readonly>
                  @if($Dpromo->type==1)
                    Maklon
                  @elseif($Dpromo->type==2)
                    Internal
                  @elseif($Dpromo->type==3)
                    Maklon/Internal
                  @endif
                </option>
              </select>
            @endif
            @if($Dpromo->form4=='ya')<input type="hidden" name="datapromo1[{{$loop->index}}][country]" class="form-control" value="{{$Dpromo->country}}">
            @elseif($Dpromo->form4=='')<input type="hidden" name="datapromo1[{{$loop->index}}][country]" class="form-control" value="{{$Dpromo->country}}">@endif
            @if($Dpromo->form5=='ya')<input type="hidden" name="datapromo1[{{$loop->index}}][promotype]" class="form-control" value="{{$Dpromo->promo_type}}">
            @elseif($Dpromo->form5=='')<input type="hidden" name="datapromo1[{{$loop->index}}][promotype]" class="form-control" value="{{$Dpromo->promo_type}}">@endif
            @if($Dpromo->form6=='ya')<input type="hidden" name="datapromo1[{{$loop->index}}][idea]" class="form-control" value="{{$Dpromo->promo_idea}}">
            @elseif($Dpromo->form6=='')<input type="hidden" name="datapromo1[{{$loop->index}}][idea]" class="form-control" value="{{$Dpromo->promo_idea}}">@endif
            @if($Dpromo->form7=='ya')<input type="hidden" name="datapromo1[{{$loop->index}}][dimension]" class="form-control" value="{{$Dpromo->dimension}}">
            @elseif($Dpromo->form7=='')<input type="hidden" name="datapromo1[{{$loop->index}}][dimension]" class="form-control" value="{{$Dpromo->dimension}}">@endif
            @if($Dpromo->form8=='ya')<input type="hidden" name="datapromo1[{{$loop->index}}][app]" class="form-control" value="{{$Dpromo->application}}">
            @elseif($Dpromo->form8=='')<input type="hidden" name="datapromo1[{{$loop->index}}][app]" class="form-control" value="{{$Dpromo->application}}">@endif
            @if($Dpromo->form9=='ya')<input type="hidden" name="datapromo1[{{$loop->index}}][readines]" class="form-control" value="{{$Dpromo->promo_readiness}}">
            @elseif($Dpromo->form9=='')<input type="hidden" name="datapromo1[{{$loop->index}}][readines]" class="form-control" value="{{$Dpromo->promo_readiness}}"><@endif
            @if($Dpromo->form10=='ya')<input type="hidden" name="datapromo1[{{$loop->index}}][rto]" class="form-control" value="{{$Dpromo->rto}}">
            @elseif($Dpromo->form10=='')<input type="hidden" name="datapromo1[{{$loop->index}}][rto]" class="form-control" value="{{$Dpromo->rto}}">@endif
            @endforeach
            <button class="btn btn-primary" type="submit"><li class="fa fa-check"></li> Submit</button>
            {{ csrf_field() }}
            <a href="{{route('hapuscheckpromo')}}" class="btn btn-danger"><li class="fa fa-arrow-left"></li> Back</a>
          </form>
          </div>
        </div>
        <h3 class="text-center"></h3>
        <h6 class="text-center"></h6>
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
  <script src="{{ asset('vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
  <script type="text/javascript" language="javascript" src="{{ asset('lib/advanced-datatable/js/jquery.dataTables.js')}}"></script>
  <script type="text/javascript" language="javascript" src="{{ asset('lib/advanced-datatable/js/jquery.dataTables.min.js')}}"></scrip
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