<!DOCTYPE html>
<html lang="en">

<head>
  <title>@yield('title')</title></title>
  <link href="{{ URL::asset('img/prod.png') }}" rel="icon">
  <link href="{{ URL::asset('img/apple-touch-icon.png') }}" rel="apple-touch-icon">
  <link href="{{ URL::asset('lib/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('lib/advanced-datatable/css/jquery.dataTables.css') }}" rel="stylesheet" />
  <link href="{{ URL::asset('lib/advanced-datatable/css/jquery.dataTables4.min.css') }}" rel="stylesheet" />
  <link href="{{ URL::asset('css/custom.min.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('lib/advanced-datatable/css/dataTables.bootstrap.css') }}" rel="stylesheet" />
  <link href="{{ URL::asset('css/dataTables.bootstrap4.min.css') }}">
  <link href="{{ URL::asset('css/dataTables.min.css') }}">
  <link href="{{ URL::asset('css/asri.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('lib/gritter/css/jquery.gritter.css') }}" rel="stylesheet" />
  <link href="{{ URL::asset('css/asri.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('lib/font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
  <link href="{{ URL::asset('css/custom.min.css" rel="stylesheet') }}">
  <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('css/style-responsive.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('lib/font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
</head>

<body>
  <section id="container">
    <!--header start-->
    <header class="header black-bg">
      <div class="sidebar-toggle-box">
        </div>
      </div>
      <!--logo start-->
      <a href="#" class="logo"><img src="{{ asset('img/prod.png')}}"><b>PROD<span>EV</span></b></a>
      <!--logo end-->

      <div class="top-menu"><br>
        <ul class="nav pull-right top-menu">
          @if( auth()->check() )
          <li><a class="btn btn-lg" href="{{ route('MyProfile') }}"><i class="fa fa-user"></i> Hello,{{ Auth::user()->name }}</a></li>
          @endif
          <li><a class="btn btn-lg" href="{{ route('signout') }}"><i class="fa fa-sign-out"></i> Logout</a></li>
        </ul>
      </div>
    </header>
    <!--header end-->

    <section class="wrapperr site-min-height2">
      @yield('content')
    </section>
    <!--footer start-->
    <footer class="site-footer">
      <div class="text-center">
        <p>
          <strong>PKL 2018</strong>
        </p>
        <div class="credits">
          Created By Asrul
        </div>
        <a href="blank.html#" class="go-top"><i class="fa fa-angle-up"></i></a>
      </div>
    </footer>
    <!--footer end-->
  </section>

  <script src="{{ URL::asset('lib/jquery/jquery.min.js')}}"></script>
  <script type="text/javascript" language="javascript" src="{{ URL::asset('lib/advanced-datatable/js/jquery.dataTables.js')}}"></script>
  <script type="text/javascript" language="javascript" src="{{ URL::asset('lib/advanced-datatable/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{ URL::asset('lib/dataTables.bootstrap.min.js')}}"></script>
  <script src="{{ URL::asset('lib/jquery-ui-1.9.2.custom.min.js')}}"></script>
  <script src="{{ URL::asset('lib/jquery-ui-1.9.2.custom.min.js')}}"></script>
  <script src="{{ URL::asset('lib/jquery-ui-1.9.2.custom.min.js')}}"></script>
  <script src="{{ URL::asset('lib/bootstrap/js/bootstrap.min.js')}}"></script>
  <script src="{{ URL::asset('lib/jquery-ui-1.9.2.custom.min.js')}}"></script>
  <script src="{{ URL::asset('lib/jquery.ui.touch-punch.min.js')}}"></script>
  <script class="include" type="text/javascript" src="{{ URL::asset('lib/jquery.dcjqaccordion.2.7.js')}}"></script>
  <script src="{{ URL::asset('lib/jquery.scrollTo.min.js')}}"></script>
  <script src="{{ URL::asset('lib/jquery.nicescroll.js')}}" type="text/javascript"></script>
  <script src="{{ URL::asset('lib/common-scripts.js')}}"></script>
	<script src="{{ URL::asset('lib/bootstrap/bootstrap.min.js')}}" type="text/javascript"></script>
  <script src="{{ URL::asset('js/datatables.min.js')}}"></script>
  <script type="text/javascript" src="{{ URL::asset('lib/gritter/js/jquery.gritter.js')}}"></script>
  <script type="text/javascript" src="{{ URL::asset('lib/gritter-conf.js')}}"></script>
  <script src="{{ URL::asset('js/dynamitable.jquery.min.js')}}"></script>
  <script src="{{ URL::asset('lib/dataTables.bootstrap4.min.css')}}"></script>
	<script src="/js/postsAjax.js"></script> 
  <script type="text/javascript">
    $('.Table').DataTable({
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
  @yield('s');

  <script>
    $('#exampleModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var recipient = button.data('whatever') 
      var modal = $(this)
      modal.find('.modal-body input').val(recipient)
    })
  </script>

  @yield('s');

  <script>
    function filterGlobal () {
      $('#ex').DataTable().search(
        $('#global_filter').val(),
      ).draw();
      }
    
    function filterColumn ( i ) {
      $('#ex').DataTable().column( i ).search(
        $('#col'+i+'_filter').val()
      ).draw();
    }
    
    $(document).ready(function() {
      $('#ex').DataTable();
      $('input.global_filter').on( 'keyup click', function () {
        filterGlobal();
      } );
      $('input.column_filter').on( 'keyup click', function () {
        filterColumn( $(this).parents('div').attr('data-column') );
      } );
    } );
    $('select.column_filter').on('change', function () {
      filterColumn( $(this).parents('div').attr('data-column') );
    } );
  </script>
</body>
</html>