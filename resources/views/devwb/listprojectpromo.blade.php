@extends('formula.tempformula')
@section('title', 'Data PKP promo')
@section('judulhalaman','Draf PKP pPromo')
@section('content')

<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="row">
    <!-- filter data -->
    <div class="panel panel-default">
	    <div class="panel-heading">
        <h2><li class="fa fa-filter"></li> Filter Project PKP</h2>
      </div>
      <div>
        <div>
          <form id="clear">        
          <!--project-->
          <div class="col-md-4 pl-1">
            <div class="form-group" id="filter_col" data-column="1">
              <label>Project Name</label>
              <select name="name" class="form-control column_filter" id="col1_filter">
                <option disabled selected>-->Select One<--</option>
                @foreach($promo as $pkp1)
                  @if($pkp1->status_project=='proses' || $pkp1->status_project=='close')
                  <option>{{$pkp1->project_name}}</option>
                  @endif
                @endforeach
              </select>
            </div>
          </div>       
          <!--brand-->
          <div class="col-md-4 pl-1">
            <div class="form-group" id="filter_col1" data-column="3">
              <label>Brand</label>
              <select name="brand" class="form-control column_filter" id="col3_filter" >
                <option disabled selected>-->Select One<--</option>
                @foreach($brand as $br)
                <option>{{$br->brand}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <!--Data-->
          <div class="col-md-3 pl-1">
            <div class="form-group" id="filter_col1" data-column="5">
              <label>Status</label>
              <select name="status" class="form-control column_filter" id="col5_filter" >
                <option disabled selected>-->Select One<--</option>
                @foreach($promo as $pkp2)
                  @if($pkp1->status_project=='proses' || $pkp1->status_project=='close')
                  <option>{{$pkp2->status_project}}</option>
                  @endif
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-md-1 pl-1">
            <div class="form-group" id="filter_col1" data-column="5">
              <label class="text-center">refresh</label>    
              <a href="" class="btn btn-info btn-sm"><li class="fa fa-refresh"></li></a>
            </div>
          </div>
          </form>
        </div>
      </div>
    </div>
    <!-- filter data selesai -->
  </div>
</div>

<div class="">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h3>List PKP Promo</h3>
        </div>
        <div class="clearfix"></div>
        <div class="x_content" style="overflow-x: scroll;">
          <table class="Table table-striped no-border" id="ex">
            <thead>
              <tr style="font-weight: bold;color:white;background-color: #2a3f54;" >
                <th>#</th>
                <th>PKP Promo Number</th>
                <th>Brand</th>
                <th>Project</th>
                <th>Author</th>
                <th>Created Date</th>
                <th>Last Update</th>
                <th width="11%" class="text-center">Status</th>
                <th width="15%" class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                @php $no = 0; @endphp
                @foreach($promo as $pkp)
                @if($pkp->userpenerima2==NULL)
                  @if($pkp->userpenerima==Auth::user()->id)
                  <th>{{ ++$no }}</th>
                  <th>{{ $pkp->promo_number }}{{ $pkp->ket_no }}</th>
                  <th>{{ $pkp->brand }}</th>
                  <th>{{ $pkp->project_name }}</th>
                  <th>{{ $pkp->author1->name }}</th>
                  <th>{{ $pkp->created_date }}</th>
                  <th>{{ $pkp->last_update }}</th>
                  <th class="text-center">
                    @if($pkp->status_project=='proses')
                    <span  class="label label-success" style="color:white">Proses</span>
                    @elseif($pkp->status_project=='close')
                    <span  class="label label-info" style="color:white">Close</span>
                    @elseif($pkp->status_project=='revisi')
                    <span  class="label label-danger" style="color:white">revisi</span>
                    @endif
                  </th>
                  <th class="text-center">
                    @if($pkp->status_project=='proses')
                      <a class="btn btn-info btn-sm" href="{{ Route('rekappromo',$pkp->id_pkp_promo)}}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a>
                      {{csrf_field()}}
                    @elseif($pkp->status_project=='close')
                      <a class="btn btn-info btn-sm" href="{{ Route('rekappromo',$pkp->id_pkp_promo)}}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a>
                      <button class="btn btn-info btn-sm" disabled><li class="fa fa-smile-o" title="close"></li></button>
                    @elseif($pkp->status_project=='revisi')
                      <a class="btn btn-info btn-sm" href="{{ Route('rekappromo',$pkp->id_pkp_promo)}}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a>
                    @endif
                  </th>
                  @endif
                @elseif($pkp->userpenerima2!=NULL)
                  @if($pkp->userpenerima==Auth::user()->id || $pkp->userpenerima2==Auth::user()->id)
                  <th>{{ ++$no }}</th>
                  <th>{{ $pkp->promo_number }}{{ $pkp->ket_no }}</th>
                  <th>{{ $pkp->brand }}</th>
                  <th>{{ $pkp->project_name }}</th>
                  <th>{{ $pkp->Author }}</th>
                  <th>{{ $pkp->created_date }}</th>
                  <th>{{$pkp->waktu}}</th>
                  <th>{{ $pkp->last_update }}</th>
                  <th class="text-center">
                    @if($pkp->status_project=='proses')
                    <span  class="label label-success" style="color:white">Proses</span>
                    @elseif($pkp->status_project=='close')
                    <span  class="label label-info" style="color:white">Close</span>
                    @elseif($pkp->status_project=='revisi')
                    <span  class="label label-info" style="color:white">revisi</span>
                    @endif
                  </th>
                  <th class="text-center">
                    @if($pkp->status_project=='proses')
                      <a class="btn btn-info btn-sm" href="{{ Route('rekappromo',$pkp->id_pkp_promo)}}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a>
                      {{csrf_field()}}
                    @elseif($pkp->status_project=='close')
                      <a class="btn btn-info btn-sm" href="{{ Route('rekappromo',$pkp->id_pkp_promo)}}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a>
                      <button class="btn btn-info btn-sm" disabled><li class="fa fa-smile-o" title="close"></li></button>
                    @elseif($pkp->status_project=='revisi')
                      <a class="btn btn-info btn-sm" href="{{ Route('rekappromo',$pkp->id_pkp_promo)}}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a>
                    @endif
                  </th>
                  @endif
                @endif
                @endforeach
              </tr>
            </tbody>
          </table>
        </div>  
      </div>
    </div>
  </div>
</div>

@endsection
@section('s')
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
    });
    $('select.column_filter').on('change', function () {
      filterColumn( $(this).parents('div').attr('data-column') );
  } );
</script>
@endsection