<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link href="{{ asset('img/prod.png') }}" rel="icon">
    <link href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('build/css/custom.min.css') }}" rel="stylesheet">
  </head>

  <body class="nav-md ">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col" style="min-height:880;">
          <div class="left_col scroll-view" >
            <div class="navbar nav_title" style="border: 2;">
            <center><a href="{{route('lala')}}" class="site_title"><img src="{{ asset('img/logo.png') }}" width="70%" alt="..."></a></center>
            </div>
            <div class="clearfix"></div>
            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <center>
                <a href="{{route('lala')}}"><img style="width:110px" src="{{ asset('img/pro.png') }}" alt="..." class="profile_img"></a><br>
                <span style="font-weight: bold;color:white;">Welcome, {{ Auth::user()->role->role }}</span>
                @if( auth()->check() )
                <h2 style="color:white;">{{ Auth::user()->name }}</h2>
                @endif</center>
              <div class="clearfix"></div>
            </div><br>
            <!-- menu profile quick info end -->
            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-user"></i> User Management <span class="label label-success"></span> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ route('MyProfile') }}">Profile settings</a></li>
                      @if(auth()->user()->role->namaRule === 'admin')
                      <li><a href="{{ route('usermanagement') }}">List Users</a></li>
                      <li><a href="{{ route('userapproval') }}">Approval</a></li>
                      @endif
                    </ul>
                  </li>
                  @if(auth()->user()->role->namaRule == 'pv_lokal')
                  <li><a><i class="fa fa-folder-open"></i> PKP / PDF / PROMO <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                    <li><a>Input Project<span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="{{Route('formpkp')}}">Input PKP</a> </li>
                        <li><a href="{{Route('promo')}}">Input PROMO</a> </li>
                      </ul>
                    </li>
                    <li><a>Draf Project<span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="{{Route('drafpkp')}}">Draf PKP</a> </li>
                        <li><a href="{{Route('drafpromo')}}">Draf PROMO</a> </li>
                      </ul>
                    </li>
                    <li><a>List Project<span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="{{Route('listpkp')}}">List PKP</a> </li>
                        <li><a href="{{Route('listpromo')}}">List PROMO</a> </li>
                      </ul>
                    </li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-file-text"></i> Project Recapitulation <span class="label label-success"></span> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ route('tabulasi') }}">Data Project Tabulation</a></li>
                      <li><a href="{{ route('reportnotulen') }}">Meeting Minutes</a></li>
                      <li><a href="{{ route('datapengajuan') }}">Revision Request</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-book"></i> Master Data <span class="label label-success"></span> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ route('datapangan') }}">Microbiology</a></li>
                      <li><a href="{{ route('sku') }}">Active SKU</a></li>
                      <li><a href="{{ route('klaim') }}">Claim Regulation</a></li>
                      <li><a href="{{ route('brand.index') }}">Brand</a></li>
                    </ul>
                  </li>
                  @elseif(auth()->user()->role->namaRule == 'pv_global')
                  <li><a><i class="fa fa-folder-open"></i> PKP / PDF / PROMO <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                    <li><a>Input Project<span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="{{Route('formpdf')}}">Input PDF</a> </li>
                      </ul>
                    </li>
                    <li><a>Draf Project<span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="{{Route('drafpdf')}}">Draf PDF</a> </li>
                      </ul>
                    </li>
                    <li><a>List Project<span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="{{Route('listpdf')}}">List PDF</a> </li>
                      </ul>
                    </li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-file-text"></i> Project Recapitulation <span class="label label-success"></span> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ route('tabulasi') }}">Data Project Tabulation</a></li>
                      <li><a href="{{ route('reportnotulen') }}">Meeting Minutes</a></li>
                      <li><a href="{{ route('datapengajuan') }}">Revision Request</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-book"></i> Master Data <span class="label label-success"></span> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ route('datapangan') }}">Microbiology</a></li>
                      <li><a href="{{ route('sku') }}">Active SKU</a></li>
                      <li><a href="{{ route('klaim') }}">Claim Regulation</a></li>
                      <li><a href="{{ route('supplier') }}">Supplier</a></li>
                      <li><a href="{{ route('principal') }}">Principle</a></li>
                    </ul>
                  </li>
                  @elseif(auth()->user()->role->namaRule == 'marketing' || auth()->user()->role->namaRule == 'NR')
                  <li><a><i class="fa fa-folder-open"></i> PKP / PDF / PROMO <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                    <li><a>Input Project<span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="{{Route('formpkp')}}">Input PKP</a> </li>
                        <li><a href="{{Route('formpdf')}}">Input PDF</a> </li>
                        <li><a href="{{Route('promo')}}">Input PROMO</a> </li>
                      </ul>
                    </li>
                    <li><a>Draf Project<span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="{{Route('drafpkp')}}">Draf PKP</a> </li>
                        <li><a href="{{Route('drafpdf')}}">Draf PDF</a> </li>
                        <li><a href="{{Route('drafpromo')}}">Draf PROMO</a> </li>
                      </ul>
                    </li>
                    <li><a>List Project<span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="{{Route('listpkp')}}">List PKP</a> </li>
                        <li><a href="{{Route('listpdf')}}">List PDF</a> </li>
                        <li><a href="{{Route('listpromo')}}">List PROMO</a> </li>
                      </ul>
                    </li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-file-text"></i> Project Recapitulation <span class="label label-success"></span> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ route('tabulasi') }}">Data Project Tabulation</a></li>
                      <li><a href="{{ route('reportnotulen') }}">Meeting Minutes</a></li>
                      <li><a href="{{ route('datapengajuan') }}">Revision Request</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-book"></i> Master Data <span class="label label-success"></span> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ route('datapangan') }}">Microbiology</a></li>
                      <li><a href="{{ route('sku') }}">Active SKU</a></li>
                      <li><a href="{{ route('klaim') }}">Claim Regulation</a></li>
                      <li><a href="{{ route('supplier') }}">Supplier</a></li>
                      <li><a href="{{ route('principal') }}">Principle</a></li>
                    </ul>
                  </li>
                  @elseif(auth()->user()->role->namaRule == 'CS')
                  <li><a><i class="fa fa-folder-open"></i> PKP / PDF / PROMO <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a>List Project<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="{{Route('listpkp')}}">List PKP</a> </li>
                          <li><a href="{{Route('listpdf')}}">List PDF</a> </li>
                          <li><a href="{{Route('listpromo')}}">List PROMO</a> </li>
                        </ul>
                      </li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-book"></i> Master Data <span class="label label-success"></span> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ route('datapangan') }}">Microbiology</a></li>
                      <li><a href="{{ route('sku') }}">Active SKU</a></li>
                      <li><a href="{{ route('klaim') }}">Claim Regulation</a></li>
                      <li><a href="{{ route('supplier') }}">Supplier</a></li>
                      <li><a href="{{ route('principal') }}">Principle</a></li>
                    </ul>
                  </li>
                  @elseif(auth()->user()->role->namaRule === 'user_produk' || auth()->user()->role->namaRule === 'kemas')
                  <li><a><i class="fa fa-folder-open"></i> PKP/PDF & Workbook <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ route('listprojectpkp') }}">List PKP</a> </li>
                      <li><a href="{{ route('listprojectpdf') }}">List PDF</a> </li>
                      <li><a href="{{ route('listprojectpromo') }}">List PROMO</a> </li>
                    </ul>
                  </li>
                  <li><a href="{{ route('registrasi_bb_rd') }}"><i class="fa fa-registered"></i> Material Registration </a></li>
                  <li><a><i class="fa fa-book"></i> Master Data <span class="label label-success"></span> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ route('sku') }}">Active SKU</a></li>
                      <li><a href="{{ route('curren.index') }}">Currency</a></li>
                      <li><a href="{{ route('supplier') }}">Supplier</a></li>
                      <li><a href="{{ route('principal') }}">Principle</a></li>
                      <li><a href="{{ route('bahanbaku') }}">Bahan Baku Eksis</a></li>
                      <li><a href="{{ route('bahan_rd') }}">Bahan Baku RD</a></li>
                    </ul>
                  </li>
                  @elseif(auth()->user()->role->namaRule === 'user_rd_proses' || auth()->user()->role->namaRule === 'maklon'  || auth()->user()->role->namaRule === 'lab')
                  <li><a><i class="fa fa-cogs"></i> Feasibility <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{Route('FsPKP')}}">List FS PKP</a> </li>
                      <li><a href="{{Route('FsPDF')}}">List FS PDF</a> </li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-book"></i> Master Data <span class="label label-success"></span> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ route('allergen') }}">Allergen</a></li>
                      <li><a href="{{ route('bahanbaku') }}">Bahan Baku Eksis</a></li>
                      <li><a href="{{ route('bahan_rd') }}">Bahan Baku RD</a></li>
                      <li><a href="{{ route('mesin') }}">Data Mesin</a></li>
                      <li><a href="{{ route('itemdesc') }}">Item Desc</a></li>
                    </ul>
                  </li>
                  @elseif(auth()->user()->role->namaRule === 'manager')
                    @if(auth()->user()->departement_id!='2')
                    <li><a><i class="fa fa-sitemap"></i> PKP / PDF / PROMO <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a>My Project<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li><a href="{{Route('listpkprka')}}">List PKP</a> </li>
                            <li><a href="{{Route('listpromoo')}}">List PROMO</a> </li>
                            <li><a href="{{Route('listpdfrka')}}">List PDF</a> </li>
                          </ul>
                        </li>
                        <li><a>List All Project<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li><a href="{{Route('listpkp')}}">List  PKP</a> </li>
                            <li><a href="{{Route('listpromo')}}">List  PROMO</a> </li>
                            <li><a href="{{Route('listpdf')}}">List  PDF</a> </li>
                          </ul>
                        </li>
                      </ul>
                    </li>
                    @elseif(auth()->user()->departement_id=='2' || auth()->user()->departement_id=='1')
                    <li><a><i class="fa fa-cogs"></i> Feasibility <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="{{Route('FsPKP')}}">List FS PKP</a> </li>
                        <li><a href="{{Route('listpdfrka')}}">List FS PDF</a> </li>
                      </ul>
                    </li>
                    @endif
                  <li><a><i class="fa fa-file-text"></i> Project Recapitulation <span class="label label-success"></span> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ route('tabulasi') }}">Data Project Tabulation</a></li>
                      <li><a href="{{ route('reportnotulen') }}">Meeting Minutes</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-book"></i> Master Data <span class="label label-success"></span> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ route('datapangan') }}">Microbiology</a></li>
                      <li><a href="{{ route('sku') }}">Active SKU</a></li>
                      <li><a href="{{ route('klaim') }}">Claim Regulation</a></li>
                      <li><a href="{{ route('supplier') }}">Supplier</a></li>
                      <li><a href="{{ route('principal') }}">Principle</a></li>
                      <li><a href="{{ route('mesin') }}">Data Mesin</a></li>
                    </ul>
                  </li>
                  @elseif(auth()->user()->role->namaRule === 'admin')
                  <li><a><i class="fa fa-folder-open"></i> PKP / PDF / PROMO <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                    <!-- <li><a><i class="fa fa-edit"></i>Input Project<span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="{{Route('formpkp')}}">Input PKP</a> </li>
                        <li><a href="{{Route('formpdf')}}">Input PDF</a> </li>
                        <li><a href="{{Route('promo')}}">Input PROMO</a> </li>
                      </ul>
                    </li> -->
                    <li><a><i class="fa fa-archive"></i>Draf Project<span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="{{Route('drafpkp')}}">Draf PKP</a> </li>
                        <li><a href="{{Route('drafpdf')}}">Draf PDF</a> </li>
                        <li><a href="{{Route('drafpromo')}}">Draf PROMO</a> </li>
                      </ul>
                    </li>
                    <li><a><i class="fa fa-list"></i>List Project<span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="{{Route('listpkp')}}">List PKP</a> </li>
                        <li><a href="{{Route('listpdf')}}">List PROMO</a> </li>
                        <li><a href="{{Route('listpromo')}}">List PDF</a> </li>
                      </ul>
                    </li>
                    </ul>
                  </li>
                  <li><a href="{{ route('registrasi_bb_rd') }}"><i class="fa fa-registered"></i> Material Registration </a></li>
								  <li><a><i class="fa fa-book"></i> Master Data <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ route('dept') }}">Departement</a></li>
                      <li><a href="{{ route('datauom')}}">UOM</a></li>
                      <li><a href="{{ route('datapangan') }}">Microbiology</a></li>
                      <li><a href="{{ route('allergen') }}">Allergen</a></li>
                      <li><a href="{{ route('itemdesc') }}">Item Desc</a></li>
                      <li><a href="{{ route('sku') }}">Active SKU</a></li>
                      <li><a href="{{ route('klaim') }}">Claim Regulation</a></li>
                      <li><a href="{{ route('supplier') }}">Supplier</a></li>
                      <li><a href="{{ route('principal') }}">Principle</a></li>
                      <li><a href="{{ route('bahanbaku') }}">Bahan Baku Eksis</a></li>
                      <li><a href="{{ route('bahan_rd') }}">Bahan Baku RD</a></li>
                      <li><a href="{{ route('brand.index') }}">Brand</a></li>
                      <li><a href="{{ route('curren.index') }}">Currency</a></li>
                      <li><a href="{{ route('kategori.index') }}">Kategori</a></li>
                      <li><a href="{{ route('subkategori.index') }}">Sub Kategori</a></li>
                      <li><a href="{{ route('mesin') }}">Data Mesin</a></li>
                    </ul>
                  </li>
                  @endif
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
        <div class="right_col" role="main">
          <div class="">
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                @yield('content')
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class=" text-right">
            Created By @asrinurulm
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <script src="{{ asset('js/vendor/jquery-2.2.4.min.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('build/js/custom.min.js') }}"></script>
    @yield('s')
  </body>
</html>
