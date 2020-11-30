@extends('manager.tempmanager')
@section('title', 'List PKP')
@section('judulhalaman','List PKP')
@section('content')

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
          <!--brand-->
          <div class="col-md-2 pl-1">
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
          <!--Data-->
          <div class="col-md-3 pl-1">
            <div class="form-group" id="filter_col1" data-column="5">
              <label>Status RD Kemas</label>
              <select name="status" class="form-control column_filter" id="col5_filter" >
                <option disabled selected>-->Select One<--</option>
                <option>New</option>
                <option>Approve</option>
                <option>Sent</option>
                <option>Revision</option>
                <option>No proses</option>
              </select>
            </div>
          </div>  
          <!--Data-->
          <div class="col-md-3 pl-1">
            <div class="form-group" id="filter_col1" data-column="6">
              <label>Status RD Product</label>
              <select name="status" class="form-control column_filter" id="col6_filter" >
                <option disabled selected>-->Select One<--</option>
                <option>New</option>
                <option>Approve</option>
                <option>Sent</option>
                <option>Revision</option>
                <option>No proses</option>
              </select>
            </div>
          </div>      
          <!--project-->
          <div class="col-md-3 pl-1">
            <div class="form-group" id="filter_col1" data-column="7">
              <label>Priority</label>
              <select name="name" class="form-control column_filter" id="col7_filter">
                <option disabled selected>-->Select One<--</option>
                <option>prioritas 1</option>
                <option>prioritas 2</option>
                <option>prioritas 3</option>
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

<div class="x_panel">
  <div class="x_title">
    <h3><li class="fa fa-wpforms"> List PKP</h3>
  </div>
  <div class="card-block">
    <div class="clearfix"></div>
    <div class="x_content">
    <a href="{{route('cetak_my_project')}}" class="btn btn-warning btn-sm" type="button"><li class="fa fa-download"></li> Download My Project</a>
      <table class="Table table-striped no-border" id="ex"> 
        <thead>
          <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
            <th>No</th>
            <th>Project Name</th>
            <th>Brand</th>
            <th class="text-center">PV</th>
            <th class="text-center">Sent</th>
            <th class="text-center" width="13%">Status RD Kemas</th>
            <th class="text-center" width="13%">Status RD Product</th>
            <th class="text-center">Priority</th>
            <th class="text-center">Launch Deadline</th>
            <th class="text-center" width="3%">Action</th>
            <th class="text-center" width="12%">Prototype Sample submission status</th>
          </tr>
        </thead>
        <tbody> 
          @php $no = 0; @endphp
          @foreach($pkp as $pkp)
          @if($pkp->status_freeze=='inactive')
            @if($pkp->tujuankirim2=="1")
              @if($pkp->datapkpp->departement->dept==Auth::user()->departement->dept ||  $pkp->datapkpp->departement2->dept==Auth::user()->departement->dept)
              <tr>
                <td>{{ ++$no}}</td>
                <td>{{$pkp->pkp_number}}{{$pkp->ket_no}}</td>
                <td>{{$pkp->id_brand}}</td>
                <td>
                  @if($pkp->perevisi!=null){{$pkp->perevisi2->name}}
                  @elseif($pkp->perevisi==null){{$pkp->author1->name}}
                  @endif
                </td>
                <td>{{$pkp->tgl_kirim}}</td>
                <td>
                  @if($pkp->status_project=='sent')
                    @if($pkp->status_terima2=='proses')
                    New PKP - {{$pkp->datapkpp->departement2->dept}} ({{$pkp->datapkpp->departement2->users->name}})
                    @elseif($pkp->status_terima2=='terima')
                    Approve - {{$pkp->datapkpp->departement2->dept}} ({{$pkp->datapkpp->departement2->users->name}})
                    @endif
                  @elseif($pkp->status_project=='revisi')
                  <span class="label label-danger" style="color:white">Revision proses</span>
                  @elseif($pkp->status_project=='proses')
                    @if($pkp->userpenerima2!=NULL)
                    Sent to ({{$pkp->datapkpp->users2->name}})
                    @elseif($pkp->userpenerima2==NULL)
                      @if($pkp->status_terima2=='proses')
                      New PKP - {{$pkp->datapkpp->departement2->dept}} ({{$pkp->datapkpp->departement2->users->name}})
                      @elseif($pkp->status_terima2=='terima')
                      Approve - {{$pkp->datapkpp->departement2->dept}} ({{$pkp->datapkpp->departement2->users->name}})
                      @endif
                    @endif
                  @elseif($pkp->status_project=='close')
                  Project has finished
                  @endif
                </td>
                <td>
                  @if($pkp->tujuankirim!=1)
                    @if($pkp->status_project=='sent')
                      @if($pkp->status_terima=='proses')
                      New PKP - {{$pkp->datapkpp->departement->dept}} ({{$pkp->datapkpp->departement->users->name}})
                      @elseif($pkp->status_terima=='terima')
                      Approve - {{$pkp->datapkpp->departement->dept}} ({{$pkp->datapkpp->departement->users->name}})
                      @endif
                    @elseif($pkp->status_project=='revisi')
                    <span class="label label-danger" style="color:white">Revision proses</span>
                    @elseif($pkp->status_project=='proses')
                      @if($pkp->userpenerima!=NULL)
                      Sent to ({{$pkp->datapkpp->users->name}}) 
                      @elseif($pkp->userpenerima==NULL)
                      @if($pkp->status_terima=='proses')
                      New PKP - {{$pkp->datapkpp->departement->dept}} ({{$pkp->datapkpp->departement->users->name}})
                      @elseif($pkp->status_terima=='terima')
                      Approve - {{$pkp->datapkpp->departement->dept}} ({{$pkp->datapkpp->departement->users->name}})
                      @endif
                      @endif 
                    @elseif($pkp->status_project=='close')
                    Project has finished
                    @endif
                  @else
                  No Prosess
                  @endif
                </td>
                <td class="text-center">
                  @if($pkp->prioritas==1)
                  <span class="label label-primary" style="color:white">prioritas 1</span>
                  @elseif($pkp->prioritas==2)
                  <span class="label label-warning" style="color:white">prioritas 2</span>
                  @elseif($pkp->prioritas==3)
                  <span class="label label-success" style="color:white">prioritas 3</span>
                  @endif
                </td>
                <td class="text-center">
                  @if($pkp->launch!=null)
                  {{$pkp->launch}} {{$pkp->years}}
                  @else
                  {{$pkp->tgl_launch}}
                  @endif
                </td>
                @if($pkp->status_project=='sent')
                <td class="text-center">
                  <a class="btn btn-info btn-sm" href="{{ Route('daftarpkp',$pkp->id_project) }}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a>
                </td>
                <td>
                  @if($pkp->tujuankirim!=1)
                    @if($pkp->status_freeze=="inactive")
                      @if($pkp->status_freeze=='inactive')
                        @if($pkp->pengajuan_sample=='proses')
                        <?php
                          $awal  = date_create( $pkp->waktu );
                          $akhir = date_create(); // waktu sekarang
                          if($akhir<=$awal)
                          {
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
                        <span class="label label-success" style="color:white">sample approved</span>
                        @endif
                      @elseif($pkp->status_freeze=='active')
                        Project Is Inactive
                      @endif
                    @elseif($pkp->status_freeze=="active")
                    Project Is Inactive
                    @endif
                  @elseif($pkp->tujuankirim==1)
                  No Prosess
                  @endif
                </td>
                @elseif($pkp->status_project=='revisi')
                <td class="text-center"><a class="btn btn-info btn-sm" href="{{ Route('daftarpkp',$pkp->id_project) }}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a></td>
                <td><span class="label label-danger" style="color:white">Revision proses</span></td>
                @elseif($pkp->status_project=='proses')
                <td class="text-center">
                  <a class="btn btn-info btn-sm" href="{{ Route('daftarpkp',$pkp->id_project) }}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a>
                </td>
                <td>
                  @if($pkp->tujuankirim!=1)
                    @if($pkp->status_freeze=='inactive')
                      @if($pkp->pengajuan_sample=='proses')
                      <?php
                        $awal  = date_create( $pkp->waktu );
                        $akhir = date_create(); // waktu sekarang
                        if($akhir<=$awal)
                        {
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
                      <span class="label label-success" style="color:white">sample approved</span>
                      @endif
                    @elseif($pkp->status_freeze=='active')
                      Project Is Inactive
                    @endif
                  @else
                  No Prosess
                  @endif
                </td>
                @elseif($pkp->status_project=='close')
                <td class="text-center">
                <a class="btn btn-info btn-sm" href="{{ Route('daftarpkp',$pkp->id_project) }}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a></td>
                <td>Project Finish</td>
              </tr>
              @endif
              @endif
            @elseif($pkp->tujuankirim2==0)  
              @if($pkp->departement->dept==Auth::user()->departement->dept )
              <tr>
                <td>{{ ++$no}}</td>
                <td>{{$pkp->pkp_number}}{{$pkp->ket_no}}</td>
                <td>{{$pkp->id_brand}}</td>
                <td>
                  @if($pkp->perevisi!=null){{$pkp->perevisi2->name}}
                  @elseif($pkp->perevisi==null){{$pkp->author1->name}}
                  @endif
                </td>
                <td>{{$pkp->tgl_kirim}}</td>
                <td>No Prosess</td>
                <td>
                  @if($pkp->tujuankirim!=1)
                    @if($pkp->status_project=='sent')
                      @if($pkp->status_terima=='proses')
                      New PKP - {{$pkp->departement->dept}} ({{$pkp->departement->users->name}})
                      @elseif($pkp->status_terima=='terima')
                      Approve - {{$pkp->departement->dept}} ({{$pkp->departement->users->name}})
                      @endif
                    @elseif($pkp->status_project=='revisi')
                    <span class="label label-danger" style="color:white">Revision proses</span>
                    @elseif($pkp->status_project=='proses')
                      @if($pkp->userpenerima!=NULL)
                      Sent to ({{$pkp->users->name}})
                      @elseif($pkp->userpenerima==NULL)
                        @if($pkp->status_terima=='proses')
                        New PKP - {{$pkp->departement->dept}} ({{$pkp->departement->users->name}})
                        @elseif($pkp->status_terima=='terima')
                        Approve - {{$pkp->departement->dept}} ({{$pkp->departement->users->name}})
                        @endif
                      @endif
                    @elseif($pkp->status_project=='close')
                    Project has finished
                    @endif
                  @else
                  No Prosess
                  @endif
                </td>
                <td class="text-center">
                  @if($pkp->prioritas==1)
                  <span class="label label-primary" style="color:white">prioritas 1</span>
                  @elseif($pkp->prioritas==2)
                  <span class="label label-warning" style="color:white">prioritas 2</span>
                  @elseif($pkp->prioritas==3)
                  <span class="label label-success" style="color:white">prioritas 3</span>
                  @endif
                </td>
                <td class="text-center">
                  @if($pkp->launch!=null)
                  {{$pkp->launch}} {{$pkp->years}}
                  @else
                  {{$pkp->tgl_launch}}
                  @endif
                </td>
                @if($pkp->status_project=='sent')
                <td class="text-center">
                  <a class="btn btn-info btn-sm" href="{{ Route('daftarpkp',$pkp->id_project) }}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a>
                </td>
                <td>
                  @if($pkp->status_freeze=="inactive")
                    @if($pkp->status_freeze=='inactive')
                      @if($pkp->pengajuan_sample=='proses')
                      <?php
                        $awal  = date_create( $pkp->waktu );
                        $akhir = date_create(); // waktu sekarang
                        if($akhir<=$awal)
                        {
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
                      <span class="label label-success" style="color:white">sample approved</span>
                      @endif
                    @elseif($pkp->status_freeze=='active')
                      Project Is Inactive
                    @endif
                  @elseif($pkp->status_freeze=="active")
                  Project Is Inactive
                  @endif
                </td>
                @elseif($pkp->status_project=='revisi')
                <td class="text-center"><a class="btn btn-info btn-sm" href="{{ Route('daftarpkp',$pkp->id_project) }}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a></td>
                <td><span class="label label-danger" style="color:white">Revision proses</span></td>
                @elseif($pkp->status_project=='proses')
                <td class="text-center">
                  <a class="btn btn-info btn-sm" href="{{ Route('daftarpkp',$pkp->id_project) }}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a>
                  @if(Auth::user()->departement->dept!='RKA')
                  <button class="btn btn-primary btn-sm" title="Project Finish" data-toggle="tooltip" data-toggle="modal" data-target="#close{{$pkp->id_project}}"><i class="fa fa-power-off"></i></a></button>    
                    @endif
                </td>
                <!-- modal -->
                <div class="modal" id="close{{$pkp->id_project}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">                 
                        <h3 class="modal-title text-left" id="exampleModalLabel" >Close Data
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></h3>
                        </button>
                      </div>
                      <div class="modal-body">
                      <form class="form-horizontal form-label-left" method="POST" action="{{route('closepkp',$pkp->id_project)}}" novalidate>
                        <div class="form-group row">
                          <label class="control-label text-bold col-md-1 col-sm-3 col-xs-12 text-center">Note</label>
                            <textarea name="note" id="note" class="col-md-12 col-sm-12 col-xs-12"></textarea>
                        </div>
                        <div class="modal-footer">
                          <button class="btn btn-success" title="Close Project"><li class="fa fa-check"></li> Close</button>
                          {{ csrf_field() }}
                        </div>
                      </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Modal Selesai -->
                <td>
                  @if($pkp->status_freeze=='inactive')
                    @if($pkp->pengajuan_sample=='proses')
                    <?php
                      $awal  = date_create( $pkp->waktu );
                      $akhir = date_create(); // waktu sekarang
                      if($akhir<=$awal)
                      {
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
                    <span class="label label-success" style="color:white">sample approved</span>
                    @endif
                    @elseif($pkp->status_freeze=='active')
                      Project Is Inactive
                    @endif
                </td>
                @elseif($pkp->status_project=='close')
                <td class="text-center">
                <a class="btn btn-info btn-sm" href="{{ Route('daftarpkp',$pkp->id_project) }}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a>
                <button class="btn btn-success btn-sm" data-toggle="tooltip" title="Project Finish" disabled><li class="fa fa-smile-o"></li></button></td>
                <td>Project Finish</td>
                @endif
              </tr>
              @endif
            @endif
          @endif
          @endforeach
        </tbody>
      </table>
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
    });
    $('input.column_filter').on( 'keyup click', function () {
      filterColumn( $(this).parents('div').attr('data-column') );
    } );
  });
  $('select.column_filter').on('change', function () {
    filterColumn( $(this).parents('div').attr('data-column') );
  } );
</script>
@endsection