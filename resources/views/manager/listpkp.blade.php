@extends('layout.tempvv')
@section('title', 'PRODEV|List PKP')
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
    <a href="{{route('cetak_my_project')}}" class="btn btn-warning btn-sm" type="button"><li class="fa fa-download"></li> Download My Project</a>
      <table id="datatable"  class="table table-striped table-bordered ex" style="width:100%" id="ex">
        <thead>
          <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
            <th class="text-center">No</th>
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
            @if($pkp->tujuankirim2=="1")
              @if($pkp->departement->dept==Auth::user()->departement->dept ||  $pkp->departement2->dept==Auth::user()->departement->dept)
              <tr>
                <td class="text-center">{{{ ++$no}}}</td>
                <td>{{$pkp->pkp_number}}{{$pkp->ket_no}}</td>
                <td>{{$pkp->id_brand}}</td>
                <td>@if($pkp->perevisi!=null){{$pkp->perevisi2->name}}@endif</td>
                <td class="text-center">{{$pkp->tgl_kirim}}</td>
                <td>
                  @if($pkp->status_pkp=='sent')
                    @if($pkp->status_terima2=='proses')
                      New PKP - {{$pkp->departement2->dept}} ({{$pkp->departement2->users->name}})
                    @elseif($pkp->status_terima2=='terima')
                      Approve - {{$pkp->departement2->dept}} ({{$pkp->departement2->users->name}})
                    @endif
                  @elseif($pkp->status_pkp=='revisi')
                  <span class="label label-danger" style="color:white">Revision proses</span>
                  @elseif($pkp->status_pkp=='proses')
                    @if($pkp->userpenerima2!=NULL)
                      Sent to ({{$pkp->users2->name}})
                    @elseif($pkp->userpenerima2==NULL)
                      @if($pkp->status_terima2=='proses')
                        New PKP - {{$pkp->departement2->dept}} ({{$pkp->departement2->users->name}})
                      @elseif($pkp->status_terima2=='terima')
                        Approve - {{$pkp->departement2->dept}} ({{$pkp->departement2->users->name}})
                      @endif
                    @endif
                  @elseif($pkp->status_pkp=='close')
                    Project has finished
                  @endif
                </td>
                <td>
                  @if($pkp->tujuankirim!=1)
                    @if($pkp->status_pkp=='sent')
                      @if($pkp->status_terima=='proses')
                        New PKP - {{$pkp->departement->dept}} ({{$pkp->departement->users->name}})
                      @elseif($pkp->status_terima=='terima')
                        Approve - {{$pkp->departement->dept}} ({{$pkp->departement->users->name}})
                      @endif
                    @elseif($pkp->status_pkp=='revisi')
                    <span class="label label-danger" style="color:white">Revision proses</span>
                    @elseif($pkp->status_pkp=='proses')
                      @if($pkp->userpenerima!=NULL)
                        Sent to ({{$pkp->users1->name}}) 
                      @elseif($pkp->userpenerima==NULL)
                        @if($pkp->status_terima=='proses')
                          New PKP - {{$pkp->departement->dept}} ({{$pkp->departement->users->name}})
                        @elseif($pkp->status_terima=='terima')
                          Approve - {{$pkp->departement->dept}} ({{$pkp->departement->users->name}})
                        @endif
                      @endif 
                    @elseif($pkp->status_pkp=='close')
                      Project has finished
                    @endif
                  @else
                    No Prosess
                  @endif
                </td>
                <td class="text-center">{{$pkp->prioritas}}</td>
                <td class="text-center">
                  @if($pkp->launch!=null)
                    {{$pkp->launch}} {{$pkp->years}}
                  @endif
                </td>
                <td class="text-center">
                  @if($pkp->workbook==0)
                  <a class="btn btn-info btn-sm" href="{{ Route('daftarpkp',$pkp->id_project) }}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a>
                  @elseif($pkp->workbook>=1)
                  <a class="btn btn-primary btn-sm" href="{{ Route('daftarpkp',$pkp->id_project) }}" data-toggle="tooltip" title="Show Workbook"><i class="fa fa-book"></i></a>
                  @endif
                </td>
                <td>
                  @if($pkp->status_freeze=='inactive')
                    @if($pkp->tujuankirim!=1)
                      @if($pkp->status_pkp=='sent' || $pkp->status_pkp=='proses')
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
                          <span class="label label-success" style="color:white">sample approved</span>
                        @endif
                      @elseif($pkp->status_pkp=='revisi')<span class="label label-danger" style="color:white">Revision proses</span>
                      @elseif($pkp->status_pkp=='close')Project Finish
                      @endif
                    @elseif($pkp->tujuankirim==1) 
                      No Prosess
                    @endif
                  @endif
                </td>
              </tr>
              @endif
            @elseif($pkp->tujuankirim2==0)  
              @if($pkp->departement->dept==Auth::user()->departement->dept )
              <tr>
                <td class="text-center">{{ ++$no}}</td>
                <td>{{$pkp->pkp_number}}{{$pkp->ket_no}}</td>
                <td>{{$pkp->id_brand}}</td>
                <td>
                  @if($pkp->perevisi!=null){{$pkp->perevisi2->name}}
                  @elseif($pkp->perevisi==null){{$pkp->author1->name}}
                  @endif
                </td>
                <td class="text-center">{{$pkp->tgl_kirim}}</td>
                <td>No Prosess</td>
                <td>
                  @if($pkp->tujuankirim!=1)
                    @if($pkp->status_pkp=='sent')
                      @if($pkp->status_terima=='proses')
                      New PKP - {{$pkp->departement->dept}} ({{$pkp->departement->users->name}})
                      @elseif($pkp->status_terima=='terima')
                      Approve - {{$pkp->departement->dept}} ({{$pkp->departement->users->name}})
                      @endif
                    @elseif($pkp->status_pkp=='revisi')
                    <span class="label label-danger" style="color:white">Revision proses</span>
                    @elseif($pkp->status_pkp=='proses')
                      @if($pkp->userpenerima!=NULL)
                      Sent to ({{$pkp->users1->name}}) 
                      @elseif($pkp->userpenerima==NULL)
                        @if($pkp->status_terima=='proses')
                        New PKP - {{$pkp->departement->dept}} ({{$pkp->departement->users->name}})
                        @elseif($pkp->status_terima=='terima')
                        Approve - {{$pkp->departement->dept}} ({{$pkp->departement->users->name}})
                        @endif
                      @endif
                    @elseif($pkp->status_pkp=='close')
                    Project has finished
                    @endif
                  @else
                  No Prosess
                  @endif
                </td>
                <td class="text-center">{{$pkp->prioritas}}</td>
                <td class="text-center">
                  @if($pkp->launch!=null)
                  {{$pkp->launch}} {{$pkp->years}}
                  @endif
                </td>
                <td class="text-center">
                  @if($pkp->workbook==0)
                  <a class="btn btn-info btn-sm" href="{{ Route('daftarpkp',$pkp->id_project) }}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a>
                  @elseif($pkp->workbook>=1)
                  <a class="btn btn-primary btn-sm" href="{{ Route('daftarpkp',$pkp->id_project) }}" data-toggle="tooltip" title="Show Workbook"><i class="fa fa-book"></i></a>
                  @endif
                </td>
                <td>
                  @if($pkp->status_freeze=="inactive")
                    @if($pkp->status_pkp=='sent' || $pkp->status_pkp=='proses')
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
                      <span class="label label-success" style="color:white">sample approved</span>
                      @endif
                    @elseif($pkp->status_pkp=='revisi')<span class="label label-danger" style="color:white">Revision proses</span>
                    @elseif($pkp->status_pkp=='close')Project Finish
                    @endif
                  @elseif($pkp->status_freeze=="active")
                  Project Is Inactive
                  @endif
                </td>
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
@endsection