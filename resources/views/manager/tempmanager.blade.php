<!DOCTYPE html>
<html lang="en">
  <head>

    <title>@yield('title')</title>
    <link href="{{ asset('img/prod.png') }}" rel="icon">
    <link href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('build/css/custom.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('lib/advanced-datatable/css/jquery.dataTables.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('css/dataTables.bootstrap4.min.css') }}">
    <link href="{{ URL::asset('css/dataTables.min.css') }}">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col" style="position:fixed; min-height:880;">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 2;">
              <center><a href="{{route('lala')}}" class="site_title"><img src="{{ asset('img/logo.png') }}" width="70%" alt="..."></a></center>
            </div>
            <div class="clearfix"></div>
            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <center>
                <a href="{{route('lala')}}"><img style="width:100px" src="{{ asset('img/pro.png') }}" alt="..." class="profile_img"></a><br>
                <span style="font-weight: bold;color:white;">Welcome, {{ Auth::user()->role->role }} </span>
                  @if( auth()->check() )
                  <h2 style="color:white;">{{ Auth::user()->name }}</h2>
                  @endif
                </center>
              <div class="clearfix"></div>
            </div><br>
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-user"></i> User Management <span class="label label-success"></span> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ route('MyProfile') }}">Profile settings</a></li>
                    </ul>
                  </li>
                  @if(Auth::user()->departement->dept!='RKA')
								  <li><a><i class="fa fa-sitemap"></i> PKP / PDF / PROMO <span class="label label-success pull-right">{{$hitungnotif}}</span></a>
                    <ul class="nav child_menu">
                      <li><a>My Project<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="{{Route('listpkprka')}}">List PKP <span class="label label-success pull-right">{{$hitungpkpselesai}}</span></a> </li>
                          <li><a href="{{Route('listpromoo')}}">List PROMO <span class="label label-success pull-right">{{$hitungpromoselesai}}</span></a> </li>
                          <li><a href="{{Route('listpdfrka')}}">List PDF (Export) <span class="label label-success pull-right">{{$hitungpdfselesai}}</span></a> </li>
                        </ul>
                      </li>
                      <li><a>All Project<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="{{Route('listpkp')}}">List  PKP</a> </li>
                          <li><a href="{{Route('listpromo')}}">List  PROMO</a> </li>
                          <li><a href="{{Route('listpdf')}}">List PDF (Export)</a> </li>
                        </ul>
                      </li>
                    </ul>
                  </li>
                  @elseif(Auth::user()->departement->dept=='RKA')
                  <li><a><i class="fa fa-sitemap"></i> PKP / PDF / PROMO <span class="label label-success pull-right">{{$hitungnotif2}}</span></a>
                    <ul class="nav child_menu">
                      <li><a>My Project<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="{{Route('listpkprka')}}">List PKP <span class="label label-success pull-right">{{$hitungpkpselesai2}}</span></a> </li>
                          <li><a href="{{Route('listpromoo')}}">List PROMO  <span class="label label-success pull-right">{{$hitungpromoselesai}}</span></a> </li>
                          <li><a href="{{Route('listpdfrka')}}">List PDF (Export) <span class="label label-success pull-right">{{$hitungpdfselesai2}}</span></a> </li>
                        </ul>
                      </li>
                      <li><a>All Project<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="{{Route('listpkp')}}">List  PKP</a> </li>
                          <li><a href="{{Route('listpromo')}}">List  PROMO</a> </li>
                          <li><a href="{{Route('listpdf')}}">List PDF (Export)</a> </li>
                        </ul>
                      </li>
                    </ul>
                  </li>
                  @endif
                  <li><a><i class="fa fa-file-text"></i> Project Recapitulation <span class="label label-success"></span> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ route('datareport') }}">Data Project Summary</a></li>
                      <li><a href="{{ route('tabulasi') }}">Data Project Tabulation</a></li>
                      <li><a href="{{ route('reportnotulen') }}">Meeting Minutes</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-book"></i> Master Data <span class="label label-success"></span> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ route('datapangan') }}">Microbiology</a></li>
                      <li><a href="{{ route('akg') }}">Data AKG</a></li>
                      <li><a href="{{ route('sku') }}">Active SKU</a></li>
                      <li><a href="{{ route('klaim') }}">Claim Regulation</a></li>
                      <li><a href="{{ route('logam.berat')}}">Logam Berat</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->
          </div>
        </div>
        <!-- top navigation -->
        <div class="top_nav" >
          <div class="nav_menu" >
            <nav >
              <div class="nav toggle" >
                <a id="menu_toggle" style="color:#353d48"><i class="fa fa-bars" ></i></a>
              </div>
              <ul class="nav navbar-nav navbar-right">
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
                </nav>
              </div>
            </div>
         <!-- /top navigation -->

        <!-- page content -->

        <div class="right_col" role="main">
          <div class="">
            @yield('content')
          </div>
        </div>
        <footer>
          <div class="text-right">
            Created By Asrul4238 :)
          </div>
          <div class="clearfix"></div>
        </footer>
      </div>
    </div>

   
    <!-- jQuery -->
    <script src="{{ asset('vendors/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('lib/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendors/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendors/fastclick/lib/fastclick.js') }}"></script>
    <script src="{{ asset('lib/dropzoneJS/dropzone.js')}}"></script>
    <script type="text/javascript" language="javascript" src="{{ asset('lib/advanced-datatable/js/jquery.dataTables.js')}}"></script>
    <script type="text/javascript" language="javascript" src="{{ asset('lib/advanced-datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('vendors/nprogress/nprogress.js') }}"></script>
    <script src="{{ asset('js/datatables.min.js')}}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('build/js/custom.min.js') }}"></script>
    <script>
      $(document).ready(function(){
        $.ajaxSetup({
          headers:{
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
          }
        });
      });
    </script>
    <script src="{{ asset('vendors/validator/validator.js') }}"></script>
    @yield('s')
    <script type="text/javascript">$('.Table').DataTable({
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
    });</script>
    <script>
      $('#exampleModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var recipient = button.data('whatever') 
      var modal = $(this)
      modal.find('.modal-body input').val(recipient)
      })
    </script>
  </body>
</html>
