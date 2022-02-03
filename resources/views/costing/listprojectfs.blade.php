<!DOCTYPE html>
<html lang="en">

<head>
  <title> PKP Project</title><link href="{{ asset('img/prod.png') }}" rel="icon">
  <link href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/advanced-datatable/css/jquery.dataTables.css') }}" rel="stylesheet" />
  <link href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
  <link href="{{ asset('build/css/custom.min.css') }}" rel="stylesheet">
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="nav-md">

<!-- top navigation -->
<div class="top_nav">
  <div class="nav_menu">
    <nav>
      <ul class="nav navbar-left">
        <img src="{{ asset('img/logo.png') }}" style="padding-top:20px" width="50%">
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="">
          <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <img src="{{ asset('img/prod.png') }}" alt="">{{ Auth::user()->name }}
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
  <div class="x_panel" style="min-height:618px">
    <div class="x_title">
      <h3><li class="fa fa-list"></li> List Project</h3>
    </div>
    <div class="x_content">
      <div class="col-md-12 col-sm-12 col-xs-12 profile_left">
        <div class="x_panel">
          <div>
            <div class="container"> 
              <section id="fancyTabWidget" class="tabs t-tabs">
              <ul class="nav nav-tabs fancyTabs" role="tablist">
                <li class="tab fancyTab active col-md-6 col-sm-12 col-xs-12">
                  <div style="font-weight: bold;color:white;background-color: #2a3f54;" class="arrow-down"><div class="arrow-down-inner"></div></div>	
                    <a id="tab0" href="#tabBody0" role="tab" aria-controls="tabBody0" style="font-weight: bold;color:white;background-color: #2a3f54;" aria-selected="true" data-toggle="tab" tabindex="0"><span class="hidden-xs"> List Project FS PKP</span></a>
                  <div class="whiteBlock"></div>
                </li>
                <li class="tab fancyTab col-md-6 col-sm-12 col-xs-12">
                  <div class="arrow-down" style="font-weight: bold;color:white;background-color: #2a3f54;"><div class="arrow-down-inner"></div></div>
                    <a id="tab1" style="font-weight: bold;color:white;background-color: #2a3f54;" href="#tabBody1" role="tab" aria-controls="tabBody1" aria-selected="true" data-toggle="tab" tabindex="0"><span class="hidden-xs"> List Project FS PDF</span></a>
                  <div class="whiteBlock"></div>
                </li>
              </ul><br><br>
              <div id="myTabContent" class="tab-content fancyTabContent" aria-live="polite">
                <!-- List Project FSPKP -->
                <div class="tab-pane  fade active in" id="tabBody0" role="tabpanel" aria-labelledby="tab0" aria-hidden="false" tabindex="0">
                  <div>
                    <div class="row">
                      <div class="col-md-12">
                        <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                          <thead>
                            <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                              <th class="text-center">#</th>
                              <th width="22%">PKP Number</th>
                              <th class="text-center">Project Name</th>
                              <th class="text-center">Brand</th>
                              <th class="text-center">PV</th>
                              <th class="text-center">Status</th>
                              <th class="text-center" width="5%">Priority</th>
                              <th class="text-center" width="15%">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @php $no = 0; @endphp
                            @foreach($pkp as $pkp)
                            @php ++$no; @endphp
                            <tr>
                              <td class="text-center">{{$no}}</td>
                              <td>{{$pkp->pkp_number}}{{$pkp->ket_no}}</td>
                              <td>{{$pkp->project_name}}</td>
                              <td>{{$pkp->id_brand}}</td>
                              <td>{{$pkp->perevisi2->name}}</td>
                              <td>{{$pkp->status_pkp}}</td>
                              <td class="text-center">{{$pkp->prioritas}}</td>
                              <td class="text-center"><a title="Show" href="{{route('listPkpFs',$pkp->id_project)}}" class="btn-info btn-sm btn" type="button"><li class="fa fa-folder"></li></a></td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- List Project FSPDF -->
                <div class="tab-pane  fade" id="tabBody1" role="tabpanel" aria-labelledby="tab1" aria-hidden="true" tabindex="0">
                  <div class="row">
                    <div class="col-md-12">
                      <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                          <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                            <th class="text-center">#</th>
                            <th width="22%">PDF Number</th>
                            <th class="text-center">Project Name</th>
                            <th class="text-center">Brand</th>
                            <th class="text-center">Status</th>
                            <th class="text-center" width="5%">Priority</th>
                            <th class="text-center" width="15%">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @php $nol = 0; @endphp
                          @foreach($pdf as $pdf)
                          @php ++$nol; @endphp
                          <tr>
                            <td class="text-center">{{$nol}}</td>
                            <td>{{$pdf->pdf_number}}{{$pdf->ket_no}}</td>
                            <td>{{$pdf->project_name}}</td>
                            <td>{{$pdf->id_brand}}</td>
                            <td>{{$pdf->status_project}}</td>
                            <td>{{$pdf->prioritas}}</td>
                            <td class="text-center"><a title="Show" href="{{route('listPdfFs',$pdf->id_project_pdf)}}" class="btn-info btn-sm btn" type="button"><li class="fa fa-folder"></li></a></td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              </section>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

  <!-- jQuery -->
  <script src="{{ asset('js/vendor/jquery-2.2.4.min.js') }}"></script>
  <script src="{{ asset('vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('build/js/custom.min.js') }}"></script>
  <script src="{{ asset('js/datatables.min.js')}}"></script>
</body>
</html>