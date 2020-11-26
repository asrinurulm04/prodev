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

<div class="x_panel">
  <div class="x_title">
    <h3><li class="fa fa-wpforms"> List PKP</h3>
  </div>
  <div class="card-block">
    <div class="clearfix"></div>
    <div class="x_content">
      <table class="Table table-striped no-border" id="ex"> 
        <thead>
          <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
            <td>No</td>
            <td>Project Name</td>
            <td>Brand</td>
            <td class="text-center">PV</td>
            <td class="text-center" width="15%">Status RD Kemas</td>
            <td class="text-center" width="15%">Status RD Product</td>
            <td>Priority</td>
            <td class="text-center">Launch Deadline</td>
            <td width="13%" class="text-center">Action</td>
            <td width="12%">Prototype Sample submission status</td>
          </tr>
        </thead>
        <tbody> 
          
          @php $no = 0; @endphp
          @foreach($pkp as $pkp)
          @if($pkp->status_freeze=='inactive')
            @if($pkp->tujuankirim2=="1")
              @if($pkp->departement->dept==Auth::user()->departement->dept ||  $pkp->departement2->dept==Auth::user()->departement->dept)
                <tr>
                <td>{{ ++$no}}</td>
                <td>{{$pkp->pkp_number}}{{$pkp->ket_no}}</td>
                <td>{{$pkp->id_brand}}</td>
                <td>
                  @if($pkp->datapkp->perevisi!=null){{$pkp->datapkp->perevisi2->name}}
                  @elseif($pkp->datapkp->perevisi==null){{$pkp->author1->name}}
                  @endif
                </td>
                <td>
                  @if($pkp->status_project=='sent')
                    @if($pkp->status_terima2=='proses')
                    New PKP - {{$pkp->departement2->dept}} ({{$pkp->departement2->users->name}})
                    @elseif($pkp->status_terima2=='terima')
                    Approve
                    @endif
                  @elseif($pkp->status_project=='revisi')
                  The Project in the revised proses
                  @elseif($pkp->status_project=='proses')
                    @if($pkp->userpenerima2!=NULL)
                    Sent to ({{$pkp->users2->name}})
                    @elseif($pkp->userpenerima2==NULL)
                      @if($pkp->status_terima2=='proses')
                      New PKP - {{$pkp->departement2->dept}} ({{$pkp->departement2->users->name}})
                      @elseif($pkp->status_terima2=='terima')
                      Approve
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
                      New PKP - {{$pkp->departement->dept}} ({{$pkp->departement->users->name}})
                      @elseif($pkp->status_terima=='terima')
                      Approve
                      @endif
                    @elseif($pkp->status_project=='revisi')
                    The Project in the revised proses
                    @elseif($pkp->status_project=='proses')
                      @if($pkp->userpenerima!=NULL)
                      Sent to ({{$pkp->users->name}}) 
                      @elseif($pkp->userpenerima==NULL)
                        @if($pkp->status_terima=='proses')
                        New PKP - {{$pkp->departement->dept}} ({{$pkp->departement->users->name}})
                        @elseif($pkp->status_terima=='terima')
                        Approve
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
                  @if($pkp->datapkp->launch!=null)
                  {{$pkp->datapkp->launch}} {{$pkp->datapkp->years}}
                  @else
                  {{$pkp->datapkp->tgl_launch}}
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
                        Sample has been approved by PV
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
                <td>Data In The Revision Process</td>
                @elseif($pkp->status_project=='proses')
                <td class="text-center">
                  <a class="btn btn-info btn-sm" href="{{ Route('daftarpkp',$pkp->id_project) }}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a>
                    @if(Auth::user()->departement->dept!='RKA')
                    <!-- <button class="btn btn-primary btn-sm" data-toggle="tooltip" title="Project Finish" data-toggle="modal" data-target="#close{{$pkp->id_project}}"><i class="fa fa-power-off"></i></a></button>      -->
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
                            <label class="control-label text-bold col-md-1 col-sm-3 col-xs-12 text-center">Note</label>
                          <div class="form-group row">
                            <textarea name="note" id="note" class="col-md-10 col-sm-12 col-xs-12" rows="5"></textarea>
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
                        Sample has been approved by PV
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
                <a class="btn btn-info btn-sm" href="{{ Route('daftarpkp',$pkp->id_project) }}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a>
                <button class="btn btn-success btn-sm"  data-toggle="tooltip" disabled  title="Project Finish"><li class="fa fa-smile-o"></li></button></td>
                <td>Project Finish</td>
                @endif
                </tr>
              @endif
            @elseif($pkp->tujuankirim2==0)  
              @if($pkp->departement->dept==Auth::user()->departement->dept )
                <tr>
                <td>{{ ++$no}}</td>
                <td>{{$pkp->pkp_number}}{{$pkp->ket_no}}</td>
                <td>{{$pkp->id_brand}}</td>
                <td>
                  @if($pkp->datapkp->perevisi!=null){{$pkp->datapkp->perevisi2->name}}
                  @elseif($pkp->datapkp->perevisi==null){{$pkp->author1->name}}
                  @endif
                </td>
                <td>No Prosess</td>
                <td>
                  @if($pkp->tujuankirim!=1)
                    @if($pkp->status_project=='sent')
                      @if($pkp->status_terima=='proses')
                      New PKP - {{$pkp->departement->dept}} ({{$pkp->departement->users->name}})
                      @elseif($pkp->status_terima=='terima')
                      Approve
                      @endif
                    @elseif($pkp->status_project=='revisi')
                    The Project in the revised proses
                    @elseif($pkp->status_project=='proses')
                      @if($pkp->userpenerima!=NULL)
                      Sent to ({{$pkp->users->name}})
                      @elseif($pkp->userpenerima==NULL)
                        @if($pkp->status_terima=='proses')
                        New PKP - {{$pkp->departement->dept}} ({{$pkp->departement->users->name}})
                        @elseif($pkp->status_terima=='terima')
                        Approve
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
                    @if($pkp->datapkp->launch!=null)
                    {{$pkp->datapkp->launch}} {{$pkp->datapkp->years}}
                    @else
                    {{$pkp->datapkp->tgl_launch}}
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
                      Sample has been approved by PV
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
                <td>Data In The Revision Process</td>
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
                    Sample has been approved by PV
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
                </tr>
                @endif
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