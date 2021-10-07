@extends('layout.tempmanager')
@section('title', 'PRODEV|List PDF')
@section('content')

@if (session('status'))
<div class="col-lg-12 col-md-12 col-sm-12">
  <div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{ session('status') }}
  </div>
</div>
@endif

<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="row">
    <!-- filter data -->
    <div class="panel panel-default">
	    <div class="panel-heading">
        <h2><li class="fa fa-filter"></li> Filter Project PDF</h2>
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
          <div class="col-md-3 pl-1">
            <div class="form-group" id="filter_col1" data-column="4">
              <label>Status RD Kemas</label>
              <select name="status" class="form-control column_filter" id="col4_filter" >
                <option disabled selected>-->Select One<--</option>
                <option>New</option>
                <option>approve</option>
                <option>sent</option>
                <option>revised</option>
                <option>no proses</option>
              </select>
            </div>
          </div>  
          <div class="col-md-3 pl-1">
            <div class="form-group" id="filter_col1" data-column="5">
              <label>Status RD Product</label>
              <select name="status" class="form-control column_filter" id="col5_filter" >
                <option disabled selected>-->Select One<--</option>
                <option>New</option>
                <option>approve</option>
                <option>sent</option>
                <option>revised</option>
                <option>no proses</option>
              </select>
            </div>
          </div>      
          <div class="col-md-3 pl-1">
            <div class="form-group" id="filter_col1" data-column="6">
              <label>Priority</label>
              <select name="name" class="form-control column_filter" id="col6_filter">
                <option disabled selected>-->Select One<--</option>
                <option>prioritas 1</option>
                <option>prioritas 2</option>
                <option>prioritas 3</option>
              </select>
            </div>
          </div> 
          <div class="col-md-1 pl-1">
            <div class="form-group" id="filter_col1" data-column="5">
              <label class="text-center">refresh</label><br>    
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
    <h3><li class="fa fa-wpforms"> List PDF</h3>
  </div>
  <a href="{{route('download_my_project_pdf')}}" class="btn btn-warning btn-sm" type="button"><li class="fa fa-download"></li> Download My Project</a>
  <div class="card-block">
    <div class="clearfix"></div>
    <div class="x_content">
      <table id="datatable" class="table table-striped table-bordered ex" style="width:100%"> 
        <thead>
          <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
            <td>no</td>
            <td>PDF Number</td>
            <td>Brand</td>
            <td width="10%">Global</td>
            <td class="text-center">Sent</td>
            <td class="text-center">Status RD Kemas</td>
            <td class="text-center">Status RD Produk</td>
            <td class="text-center">Priority</td>
            <td class="text-center" width="8%">Action</td>
            <td width="15%">Information</td>
          </tr>
        </thead>
        <tbody>
          @php $no = 0; @endphp
          @foreach($pdf as $pdf)
            @if($pdf->tujuankirim2=="1")
              @if($pdf->departement->dept==Auth::user()->departement->dept || $pdf->departement2->dept==Auth::user()->departement->dept) 
              <tr>
                <td>{{ ++$no }}</td>
                <td>{{ $pdf->pdf_number}}{{$pdf->ket_no}}</td>
                <td>{{ $pdf->id_brand }}</td>
                <td>@if($pdf->datappdf->perevisi!='null'){{ $pdf->datappdf->perevisi2->name}}@endif</td>
                <td class="text-center">{{ $pdf->tgl_kirim }}</td>
                <td>
                  @if($pdf->status_project=='sent')
                    @if($pdf->status_terima2=='proses')
                    New PDF - {{$pdf->departement2->dept}} ({{$pdf->departement2->users->name}})
                    @elseif($pdf->status_terima2=='terima')
                    Approve
                    @endif
                  @elseif($pdf->status_project=='revisi') 
                  The Project in the revised proses
                  @elseif($pdf->status_project=='proses')
                    @if($pdf->userpenerima2!=NULL)
                    Sent to ({{$pdf->users2->name}})
                    @elseif($pdf->userpenerima2==NULL)
                      @if($pdf->status_terima2=='proses')
                      New PKP - {{$pdf->departement2->dept}} ({{$pdf->departement2->users->name}})
                      @elseif($pdf->status_terima2=='terima')
                      Approve
                      @endif
                    @endif
                  @elseif($pdf->status_project=='close')
                  Project has finished
                  @endif
                </td>
                <td>
                  @if($pdf->tujuankirim!=1)
                    @if($pdf->status_project=='sent')
                      @if($pdf->status_terima=='proses')
                      New PDF - {{$pdf->departement->dept}} ({{$pdf->departement->users->name}})
                      @elseif($pdf->status_terima=='terima')
                      Approve
                      @endif
                    @elseif($pdf->status_project=='revisi') 
                    The Project in the revised proses
                    @elseif($pdf->status_project=='proses')
                      @if($pdf->userpenerima!=NULL)
                      Sent to ({{$pdf->users->name}})
                      @elseif($pdf->userpenerima==NULL)
                      @if($pdf->status_terima=='proses')
                      New PKP - {{$pdf->departement->dept}} ({{$pdf->departement->users->name}})
                      @elseif($pdf->status_terima=='terima')
                      Approve
                      @endif
                      @endif
                    @elseif($pdf->status_project=='close')
                    Project has finished
                    @endif
                  @else
                  No Prosess
                  @endif
                </td>
                <td class="text-center">
                  @if($pdf->prioritas==1)
                  <span class="label label-primary" style="color:white">prioritas 1</span>
                  @elseif($pdf->prioritas==2)
                  <span class="label label-warning" style="color:white">prioritas 2</span>
                  @elseif($pdf->prioritas==3)
                  <span class="label label-success" style="color:white">prioritas 3</span>
                  @endif
                </td>
                @if($pdf->status_project=='sent')
                <td class="text-center">
                  <a class="btn btn-info btn-sm" href="{{ Route('daftarpdf',$pdf->id_project_pdf )}}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a>
                </td>
                <td>  
                  @if($pdf->status_freeze=="inactive")
                    @if($pdf->status_freeze=='inactive')
                      @if($pdf->pengajuan_sample=='proses')
                      <?php
                        $awal  = date_create( $pdf->waktu );
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
                      @elseif($pdf->pengajuan_sample=='sent')
                      Sample has been sent to PV
                      @elseif($pdf->pengajuan_sample=='reject')
                      Sample rejected by PV
                      @elseif($pdf->pengajuan_sample=='approve')
                      Sample has been approved by PV
                      @endif
                    @elseif($pdf->status_freeze=='active')
                      Project Is Inactive
                    @endif
                  @elseif($pdf->status_freeze=="active")
                  Project Is Inactive
                  @endif
                </td>
                @elseif($pdf->status_project=='revisi')
                <td class="text-center"><a class="btn btn-info btn-sm" href="{{ Route('daftarpdf',$pdf->id_project_pdf )}}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a></td>
                <td>Data In The Revision Process</td>
                @elseif($pdf->status_project=='proses')
                <td class="text-center">
                  @if($pdf->workbook=='0')
                  <a class="btn btn-info btn-sm" href="{{ Route('daftarpdf',$pdf->id_project_pdf )}}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a>
                  @elseif($pdf->workbook>='1')
                  <a class="btn btn-primary btn-sm" href="{{ Route('daftarpdf',$pdf->id_project_pdf )}}" data-toggle="tooltip" title="Show"><i class="fa fa-book"></i></a>
                  @endif
                </td>
                <td>
                  @if($pdf->tujuankirim!=1)
                    @if($pdf->status_freeze=="inactive")
                      @if($pdf->status_freeze=='inactive')
                        @if($pdf->pengajuan_sample=='proses')
                        <?php
                          $awal  = date_create( $pdf->waktu );
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
                        @elseif($pdf->pengajuan_sample=='sent')
                        Sample has been sent to PV
                        @elseif($pdf->pengajuan_sample=='reject')
                        Sample rejected by PV
                        @elseif($pdf->pengajuan_sample=='approve')
                        <span class="label label-success" style="color:white">sample approved</span>
                        @endif
                      @elseif($pdf->status_freeze=='active')
                        Project Is Inactive
                      @endif
                    @elseif($pdf->status_freeze=="active")
                    Project Is Inactive
                    @endif
                  @elseif($pdf->tujuankirim==1)
                  No Prosess
                  @endif
                </td>
                @elseif($pdf->status_project=='close')
                <td class="text-center">
                  <a class="btn btn-info btn-sm" href="{{ Route('daftarpdf',$pdf->id_project_pdf)}}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a>
                  <a class="btn btn-success btn-sm" title="Project Finish" disabled><li class="fa fa-smile-o"></li></a>
                </td>
                <td>Project Finish</td>
              </tr>
              @endif
              @endif
            @elseif($pdf->tujuankirim2=="0")
              @if($pdf->departement->dept==Auth::user()->departement->dept )
              <tr>
                <td>{{ ++$no }}</td>
                <td>{{ $pdf->pdf_number}}{{$pdf->ket_no}}</td>
                <td>{{ $pdf->id_brand }}</td>
                <td>@if($pdf->datappdf->perevisi!=null){{ $pdf->datappdf->perevisi2->name}}@endif</td>
                <td class="text-center">{{ $pdf->tgl_kirim }}</td>
                <td>
                  No Prosess
                </td>
                <td>
                  @if($pdf->tujuankirim!=1)
                    @if($pdf->status_project=='sent')
                      @if($pdf->status_terima=='proses')
                      New PDF - {{$pdf->departement->dept}} ({{$pdf->departement->users->name}})
                      @elseif($pdf->status_terima=='terima')
                      Approve
                      @endif
                    @elseif($pdf->status_project=='revisi') 
                    The Project in the revised proses
                    @elseif($pdf->status_project=='proses')
                      @if($pdf->userpenerima!=NULL)
                      Sent to ({{$pdf->users->name}})
                      @elseif($pdf->userpenerima==NULL)
                        @if($pdf->status_terima=='proses')
                        New PKP - {{$pdf->departement->dept}} ({{$pdf->departement->users->name}})
                        @elseif($pdf->status_terima=='terima')
                        Approve
                        @endif
                      @endif
                    @elseif($pdf->status_project=='close')
                    Project has finished
                    @endif
                  @else
                  No Prosess
                  @endif
                </td>
                <td class="text-center">
                  @if($pdf->prioritas==1)
                  <span class="label label-primary" style="color:white">prioritas 1</span>
                  @elseif($pdf->prioritas==2)
                  <span class="label label-warning" style="color:white">prioritas 2</span>
                  @elseif($pdf->prioritas==3)
                  <span class="label label-success" style="color:white">prioritas 3</span>
                  @endif
                </td>
                @if($pdf->status_project=='sent')
                <td class="text-center">
                  <a class="btn btn-info btn-sm" href="{{ Route('daftarpdf',$pdf->id_project_pdf )}}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a>
                </td>
                <td>  
                  @if($pdf->status_freeze=="inactive")
                    @if($pdf->status_freeze=='inactive')
                      @if($pdf->pengajuan_sample=='proses')
                      <?php
                        $awal  = date_create( $pdf->waktu );
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
                      @elseif($pdf->pengajuan_sample=='sent')
                      Sample has been sent to PV
                      @elseif($pdf->pengajuan_sample=='reject')
                      Sample rejected by PV
                      @elseif($pdf->pengajuan_sample=='approve')
                      Sample has been approved by PV
                      @endif
                    @elseif($pdf->status_freeze=='active')
                      Project Is Inactive
                    @endif
                  @elseif($pdf->status_freeze=="active")
                  Project Is Inactive
                  @endif
                </td>
                @elseif($pdf->status_project=='revisi')
                <td class="text-center"><a class="btn btn-info btn-sm" href="{{ Route('daftarpdf',$pdf->id_project_pdf )}}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a></td>
                <td>Data In The Revision Process</td>
                @elseif($pdf->status_project=='proses')
                <td class="text-center">
                  <a class="btn btn-info btn-sm" href="{{ Route('daftarpdf',$pdf->id_project_pdf )}}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a>
                </td>
                <td>
                  @if($pdf->tujuankirim!=1)
                    @if($pdf->status_freeze=="inactive")
                      @if($pdf->status_freeze=='inactive')
                        @if($pdf->pengajuan_sample=='proses')
                        <?php
                          $awal  = date_create( $pdf->waktu );
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
                        @elseif($pdf->pengajuan_sample=='sent')
                        Sample has been sent to PV
                        @elseif($pdf->pengajuan_sample=='reject')
                        Sample rejected by PV
                        @elseif($pdf->pengajuan_sample=='approve')
                        <span class="label label-success" style="color:white">sample approved</span>
                        @endif
                      @elseif($pdf->status_freeze=='active')
                        Project Is Inactive
                      @endif
                    @elseif($pdf->status_freeze=="active")
                    Project Is Inactive
                    @endif
                  @elseif($pdf->tujuankirim==1)
                  No Prosess
                  @endif
                </td>
                @elseif($pdf->status_project=='close')
                <td class="text-center">
                  <a class="btn btn-info btn-sm" href="{{ Route('daftarpdf',$pdf->id_project_pdf)}}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a>
                  <a class="btn btn-success btn-sm"  data-toggle="tooltip" title="Project Finish" disabled><li class="fa fa-smile-o"></li></a>
                </td>
                <td>Project Finish</td>
                @endif
              </tr>
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
<link href="{{ asset('lib/advanced-datatable/css/jquery.dataTables.css') }}" rel="stylesheet" />
<script src="{{ asset('js/datatables.min.js')}}"></script>
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
    });
  });
  $('select.column_filter').on('change', function () {
    filterColumn( $(this).parents('div').attr('data-column') );
  });
</script>
@endsection