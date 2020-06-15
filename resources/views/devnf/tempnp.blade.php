<!DOCTYPE html>
<html lang="en">

<head>
  <title>PRODEV - @yield('title')</title>
  <link href="{{ asset('img/prodev.png') }}" rel="icon">
  <link href="{{ asset('lib/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('lib/advanced-datatable/css/jquery.dataTables.css') }}" rel="stylesheet" />
  <link href="{{ asset('lib/advanced-datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('lib/advanced-datatable/css/dataTables.bootstrap.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/dataTables.bootstrap4.min.css') }}">
  <link href="{{ asset('css/dataTables.min.css') }}">
  <link href="{{ asset('lib/font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/custom.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('css/style-responsive.css') }}" rel="stylesheet">
  <link href="{{ asset('lib/font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
  <!-- Custom Sheila -->
  <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet"> 
  <link href="{{ asset('css/sheila.css') }}" rel="stylesheet"> 
  <link href="{{ asset('css/css.css')}}"></link>   
  <!-- <link rel="stylesheet" href="{{asset('lib/panel-fullscreen/bootstrap.min.css')}}" > -->
</head>
<style> body{color:black;}</style>
<body>
  <section id="container">
    <header class="header black-bg">
      <div class="sidebar-toggle-box">
        </div>
      </div>
       <!--logo start-->
      <a href="#" class="logo"><b>PROD<span>EV</span></b></a>
      <!--logo end-->

      <div class="top-menu"><br>
        <ul class="nav pull-right top-menu">
          @if( auth()->check() )
          <li><a class="btn btn-lg" href="{{ route('MyProfile') }}" style="color:white;"><i class="fa fa-user"></i> Hello,{{ Auth::user()->name }}</a></li>
          @endif
          <li><a class="btn btn-lg" href="{{ route('myworkbooks') }}" style="color:white;"><i class="fa fa-book"></i> Workbook</a></li>
          <li><a class="btn btn-lg" href="{{url('datapn')}}" style="color:white;"><i class="fa fa-bar-chart-o"></i> Nutfact</a></li>
          <li><a class="btn btn-lg" href="{{ route('signout') }}" style="color:white;"><i class="fa fa-sign-out"></i> Logout</a></li>
        </ul>
      </div>
    </header>
    <!--main content start-->    
    <section class="wrapper site-min-height">
      <div class="row" >
        <div class="col-md-16">
          <div class="showback">
            <div class="row">
              <div class="col-md-10"><h4><i class="fa fa-book"></i> @yield('judulnya')</h4> </div>
              <div class="col-md-2"><h4><i class="fa fa-user"></i> {{ Auth::user()->role->namaRule }}</h4> </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt">
        @yield('content')
      </div>
    </section>
    <!--main content end-->
      
    <!--footer start-->
    <footer class="site-footer">
      <div class="text-center">
        <p> &copy; Copyrights <strong>2018</strong>. All Rights Reserved </p>
        <div class="credits">
          Created with Love
        </div>
        <a href="blank.html#" class="go-top"> <i class="fa fa-angle-up"></i> </a>
      </div>
    </footer>
    <!--footer end-->

  </section>
  <!-- sheila script -->
  <script src="{{ asset('js/panel-fullscreen.js') }}"></script>
  <script src="{{ asset('js/sheila.js') }}"></script>
  <script src="{{ asset('lib/jquery/jquery.min.js') }}"></script>
  <script type="text/javascript" language="javascript" src="{{ asset('lib/advanced-datatable/js/jquery.dataTables.js') }}"></script>
  <script type="text/javascript" language="javascript" src="{{ asset('lib/advanced-datatable/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('lib/dataTables.bootstrap.min.js') }}"></script>
  <script src="{{ asset('lib/jquery-ui-1.9.2.custom.min.js') }}"></script>
  <script src="{{ asset('lib/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('lib/jquery-ui-1.9.2.custom.min.js') }}"></script>
  <script src="{{ asset('lib/jquery.ui.touch-punch.min.js') }}"></script>
  <script class="include" type="text/javascript" src="{{ asset('lib/jquery.dcjqaccordion.2.7.js') }}"></script>
  <script src="{{ asset('lib/jquery.scrollTo.min.js') }}"></script>
  <script src="{{ asset('lib/jquery.nicescroll.js') }}" type="text/javascript"></script>
  <script src="{{ asset('lib/common-scripts.js') }}"></script>
	<script src="{{ asset('lib/bootstrap/bootstrap.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('js/datatables.min.js') }}"></script>
  <script src="{{ asset('lib/dataTables.bootstrap4.min.css') }}"></script>
  <script src="{{ asset('js/select2.min.js') }}"></script>
  <script src="{{asset('js/js.js')}}"></script>
  <!-- <script src="{{asset('lib/panel-fullscreen/bootstrap.min.js')}}"></script>
  <script src="{{asset('lib/panel-fullscreen/jquery-1.11.1.min.js.js')}}"></script> -->

  @yield('s')

  <script type="text/javascript">$('#Table').DataTable({
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