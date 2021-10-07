@extends('layout.tempvv')
@section('title', 'PRODEV|Data PKP promo')
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
          <div class="col-md-4 pl-1">
            <div class="form-group" id="filter_col" data-column="6">
              <label>Priority</label>
              <select name="name" class="form-control column_filter" id="col6_filter">
                <option disabled selected>-->Select One<--</option>
                <option>Prioritas 1</option>
                <option>Prioritas 2</option>
                <option>Prioritas 3</option>
              </select>
            </div>
          </div>      
          <div class="col-md-4 pl-1">
            <div class="form-group" id="filter_col1" data-column="2">
              <label>Brand</label>
              <select name="brand" class="form-control column_filter" id="col2_filter" >
                <option disabled selected>-->Select One<--</option>
                @foreach($brand as $br)
                <option>{{$br->brand}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-md-3 pl-1">
            <div class="form-group" id="filter_col1" data-column="7">
              <label>Status</label>
              <select name="status" class="form-control column_filter" id="col7_filter" >
                <option disabled selected>-->Select One<--</option>
                <option>sending sample</option>
                <option>sent to PV</option>
                <option>approved by PV</option>
                <option>Time is Up</option>
              </select>
            </div>
          </div>
          <div class="col-md-1 pl-1">
            <div class="form-group" id="filter_col1" data-column="5">
              <label class="text-center">refresh</label>   <br> 
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
        <div class="x_content">
          <table id="datatable" class="table table-striped table-bordered ex" style="width:100%">
            <thead>
              <tr style="font-weight: bold;color:white;background-color: #2a3f54;" >
                <th>#</th>
                <th>PKP Promo Number</th>
                <th>Brand</th>
                <th>Project</th>
                <th>Author</th>
                <th>Created Date</th>
                <th>Priority</th>
                <th width="11%" class="text-center">Status</th>
                <th width="15%" class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              @php $no = 0; @endphp
              @foreach($promo as $pkp)
              @if($pkp->userpenerima2==NULL)
              <tr>
                @if($pkp->userpenerima==Auth::user()->id)
                  <td>{{ ++$no }}</td>
                  <td>{{ $pkp->promo_number }}{{ $pkp->ket_no }}</td>
                  <td>{{ $pkp->brand }}</td>
                  <td>{{ $pkp->project_name }}</td>
                  <td>{{ $pkp->author1->name }}</td>
                  <td>{{ $pkp->created_date }}</td>
                  <td>
                    @if($pkp->prioritas==1)
                    <span class="label label-primary" style="color:white">Prioritas 1</span>
                    @elseif($pkp->prioritas==2)
                    <span class="label label-warning" style="color:white">Prioritas 2</span>
                    @elseif($pkp->prioritas==3)
                    <span class="label label-success" style="color:white">Prioritas 3</span>
                    @endif
                  </td>
                  <td class="text-center">
                    @if($pkp->status_freeze=="inactive")
                      @if($pkp->status_freeze=='inactive')
                        @if($pkp->pengajuan_sample=='proses')
                        <?php
                          $awal  = date_create( $pkp->waktu );
                          $akhir = date_create(); // waktu sekarang
                          if($akhir<=$awal){
                            $diff  = date_diff( $akhir, $awal );
                            echo ' You Have ';
                            echo $diff->m . ' Month, ';
                            echo $diff->d . ' Days, ';
                            echo $diff->h . ' Hours, ';
                            echo ' To sending Sample ';
                          }else{
                            echo ' Your Time Is Up ';
                          }
                        ?>
                        @elseif($pkp->pengajuan_sample=='sent')
                        Sample has been sent to PV
                        @elseif($pkp->pengajuan_sample=='reject')
                        Sample rejected by PV
                        @elseif($pkp->pengajuan_sample=='approve')
                        Sample has been approved by PV
                        @endif
                      @elseif($pkp->status_freeze=='active')
                        Project Is Inactive
                      @endif
                    @elseif($pkp->status_freeze=="active")
                    Project Is Inactive
                    @endif
                  </td>
                  <td class="text-center">
                    @if($pkp->status_project=='proses')
                      <a class="btn btn-info btn-sm" href="{{ Route('rekappromo',$pkp->id_pkp_promo)}}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a>
                    @elseif($pkp->status_project=='close')
                      <a class="btn btn-info btn-sm" href="{{ Route('rekappromo',$pkp->id_pkp_promo)}}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a>
                      <button class="btn btn-info btn-sm" disabled><li class="fa fa-smile-o" title="close"></li></button>
                    @elseif($pkp->status_project=='revisi')
                      <a class="btn btn-info btn-sm" href="{{ Route('rekappromo',$pkp->id_pkp_promo)}}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a>
                    @endif
                  </td>
                @endif
              @elseif($pkp->userpenerima2!=NULL)
                @if($pkp->userpenerima==Auth::user()->id || $pkp->userpenerima2==Auth::user()->id)
                  <td>{{ ++$no }}</td>
                  <td>{{ $pkp->promo_number }}{{ $pkp->ket_no }}</td>
                  <td>{{ $pkp->brand }}</td>
                  <td>{{ $pkp->project_name }}</td>
                  <td>{{ $pkp->Author }}</td>
                  <td>{{ $pkp->created_date }}</td>
                  <td>{{$pkp->waktu}}</td>
                  <td>
                    @if($pkp->prioritas==1)
                    <span class="label label-primary" style="color:white">Prioritas 1</span>
                    @elseif($pkp->prioritas==2)
                    <span class="label label-warning" style="color:white">Prioritas 2</span>
                    @elseif($pkp->prioritas==3)
                    <span class="label label-success" style="color:white">Prioritas 3</span>
                    @endif
                  </td>
                  <td class="text-center">
                    @if($pkp->status_freeze=="inactive")
                      @if($pkp->status_freeze=='inactive')
                        @if($pkp->pengajuan_sample=='proses')
                        <?php
                          $awal  = date_create( $pkp->waktu );
                          $akhir = date_create(); // waktu sekarang
                          if($akhir<=$awal) {
                            $diff  = date_diff( $akhir, $awal );
                            echo ' You Have ';
                            echo $diff->m . ' Month, ';
                            echo $diff->d . ' Days, ';
                            echo $diff->h . ' Hours, ';
                            echo ' To sending Sample ';
                          }else{
                            echo ' Your Time Is Up ';
                          }
                        ?>
                        @elseif($pkp->pengajuan_sample=='sent')
                        Sample has been sent to PV
                        @elseif($pkp->pengajuan_sample=='reject')
                        Sample rejected by PV
                        @elseif($pkp->pengajuan_sample=='approve')
                        Sample has been approved by PV
                        @endif
                      @elseif($pkp->status_freeze=='active')
                        Project Is Inactive
                      @endif
                    @elseif($pkp->status_freeze=="active")
                    Project Is Inactive
                    @endif
                  </td>
                  <td class="text-center">
                    @if($pkp->status_project=='proses')
                      <a class="btn btn-info btn-sm" href="{{ Route('rekappromo',$pkp->id_pkp_promo)}}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a>
                    @elseif($pkp->status_project=='close')
                      <a class="btn btn-info btn-sm" href="{{ Route('rekappromo',$pkp->id_pkp_promo)}}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a>
                      <button class="btn btn-info btn-sm" disabled><li class="fa fa-smile-o" title="close"></li></button>
                    @elseif($pkp->status_project=='revisi')
                      <a class="btn btn-info btn-sm" href="{{ Route('rekappromo',$pkp->id_pkp_promo)}}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a>
                    @endif
                  </td>
                @endif
              </tr>
              @endif
              @endforeach
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
    $('.ex').DataTable().search(
      $('#global_filter').val(),
    ).draw();
  }
    
  function filterColumn ( i ) {
    $('.ex').DataTable().column( i ).search(
      $('#col'+i+'_filter').val()
    ).draw();
  }
    
  $(document).ready(function() {
    $('.ex').DataTable();    
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