<!DOCTYPE html>
<html lang="en">
  <head>
    <title>@yield('title')</title>
    <link href="{{ asset('img/prod.png') }}" rel="icon">
    <link href="{{ asset('vendors/fullcalendar/dist/fullcalendar.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/fullcalendar/dist/fullcalendar.print.css') }}" rel="stylesheet" media="print">
    <link href="{{ asset('css/asrul.css') }}" rel="stylesheet">
    <link href="{{ asset('css/asri.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('build/css/custom.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/advanced-datatable/css/jquery.dataTables.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sheila.css') }}" rel="stylesheet">
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
                <span style="font-weight: bold;color:white;">Welcome, {{ Auth::user()->role->role }} ({{ Auth::user()->Departement->dept }})</span>
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
                @if(Auth::user()->role->namaRule!='manager')
                <li><a><i class="fa fa-folder-open"></i> PKP / PDF / PROMO <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="{{ route('listprojectpkp') }}"> List   PKP</a></li>
                    <li><a href="{{ route('listprojectpdf') }}"> List   PDF</a></li>
                    <li><a href="{{ route('listprojectpromo') }}"> List   PROMO</a></li>
                  </ul>
                </li>
                <li><a><i class="fa fa-file-text"></i> Project Recapitulation <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="{{ route('datareport') }}">Data Project Summary</a></li>
                    <li><a href="{{ route('allproject') }}">Data Project Tabulation</a></li>
                  </ul>
                </li>
                @elseif(Auth::user()->role->namaRule=='manager')
                <li><a><i class="fa fa-folder-open"></i> PKP / PDF / PROMO <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="{{ route('listpkprka') }}">List PKP </a></li>
                    <li><a href="{{ route('listpromoo') }}">List Promo </a></li>
                    <li><a href="{{ route('listpdfrka') }}">List PDF</a></li>
                  </ul>
                </li>
                @endif
                <li><a><i class="fa fa-book"></i> Master Data <span class="label label-success"></span> <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="{{ route('datapangan') }}">Microbiology</a></li>
                    <li><a href="{{ route('akg') }}">Data AKG</a></li>
                    <li><a href="{{ route('sku') }}">Data Kemas</a></li>
                    <li><a href="{{ route('klaim') }}">Komponen Klaim</a></li>
                      <li><a href="{{ route('arsen')}}">Logam Berat</a></li>
                    @if(auth()->user()->role->namaRule == 'user_produk')
                      <li><a href="{{ route('allergen') }}">Allergen</a></li>
                      <li><a href="{{ route('bahanbaku') }}">Bahan Baku</a></li>
                      <!-- <li><a href="{{ route('bbrd') }}">Bahan Baku RD</a></li> -->
                    @endif
                  </ul>
                </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img width="30px" height="30px" src="{{ asset('img/prod.png') }}" alt="">{{ Auth::user()->name }}
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

        <div class="right_col" role="main">
          <div class="">
          @yield('content')
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="text-right">
            Created By Asrul4238 :)
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
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
      });
    </script>
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