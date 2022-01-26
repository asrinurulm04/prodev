@extends('layout.tempmanager')
@section('title', 'PRODEV|Data PKP promo')
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

<div class="">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h3><li class="fa fa-wpforms"> List PKP Promo</h3>
        </div>
        <div class="card-box table-responsive">
          <table id="datatable" class="table table-striped table-bordered ex" style="width:100%">
            <thead>
              <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                <td>No</td>
                <td>PKP Promo Number</td>
                <td>Brand</td>
                <td width="10%">PV</td>
                <td class="text-center">Sent</td>
                <td class="text-center">Status RD Kemas</td>
                <td class="text-center">Status RD Produk</td>
                <td class="text-center">Priority</td>
                <td width="8%" class="text-center">Action</td>
                <td width="15%">Information</td>
              </tr>
            </thead>
            <tbody>
              @php $no = 0; @endphp
              @foreach($pkp as $pkp)
              @if($pkp->tujuankirim2=="1")
                @if($pkp->departement->dept==Auth::user()->departement->dept || $pkp->departement2->dept==Auth::user()->departement->dept)
                <tr>
                  <td class="text-center">{{ ++$no }}</td>
                  <td>{{ $pkp->promo_number}}{{$pkp->ket_no}}</td>
                  <td>{{ $pkp->brand }}</td>
                  <td>@if($pkp->datapromo->perevisi!=null){{ $pkp->datapromo->perevisi2->name}}@endif</td>
                  <td class="text-center">{{ $pkp->tgl_kirim }}</td>
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
                    @if($pkp->prioritas==1) <span class="label label-primary" style="color:white">prioritas 1</span>
                    @elseif($pkp->prioritas==2) <span class="label label-warning" style="color:white">prioritas 2</span>
                    @elseif($pkp->prioritas==3) <span class="label label-success" style="color:white">prioritas 3</span>
                    @endif
                  </td>
                  @if($pkp->status_project=='sent')
                  <td class="text-center"><a class="btn btn-info btn-sm" href="{{ Route('daftarpromo',$pkp->id_pkp_promo)}}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a></td>
                  <td>
                    @if($pkp->status_freeze=="inactive")
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
                    @elseif($pkp->status_freeze=="active")
                      Project Is Inactive
                    @endif
                  </td>
                  @elseif($pkp->status_project=='revisi')
                  <td class="text-center"><a class="btn btn-info btn-sm" href="{{ Route('daftarpromo',$pkp->id_pkp_promo) }}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a></td>
                  <td>Data In The Revision Process</td>
                  @elseif($pkp->status_project=='proses')
                  <td class="text-center">
                    <a class="btn btn-info btn-sm" href="{{ Route('daftarpromo',$pkp->id_pkp_promo) }}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a>
                  </td>
                  <td>
                    @if($pkp->status_freeze=='inactive')
                      @if($pkp->userpenerima2==NULL)
                        Has been sent to {{$pkp->users->name}}
                      @elseif($pkp->userpenerima==NULL)
                        Has been sent to {{$pkp->users2->name}}
                      @elseif($pkp->userpenerima!=NULL && $pkp->userpenerima2!==NULL)
                        Has been sent to  {{$pkp->users->name}} & {{$pkp->users2->name}}
                      @endif
                    @elseif($pkp->status_freeze=='active')
                      Project Is Inactive
                    @endif
                  </td>
                  @elseif($pkp->status_project=='close')
                  <td class="text-center">
                    <a class="btn btn-info btn-sm" href="{{ Route('rekappromo',$pkp->id_pkp_promo)}}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a>
                    <a class="btn btn-success btn-sm" data-toggle="tooltip" title="Project Finish" disabled><li class="fa fa-smile-o"></li></a>
                  </td>
                  <td>Project Finish</td>
                  @endif
                </tr>
                @endif
              @elseif($pkp->tujuankirim2=="0") 
                @if($pkp->departement->dept==Auth::user()->departement->dept)
                <tr>
                  <td class="text-center">{{ ++$no }}</td>
                  <td>{{ $pkp->promo_number}}{{$pkp->ket_no}}</td>
                  <td>{{ $pkp->brand }}</td>
                  <td>{{ $pkp->datapromo->perevisi2->name}}</td>
                  <td class="text-center">{{ $pkp->tgl_kirim }}</td>
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
                    @if($pkp->prioritas==1)<span class="label label-primary" style="color:white">prioritas 1</span>
                    @elseif($pkp->prioritas==2)<span class="label label-warning" style="color:white">prioritas 2</span>
                    @elseif($pkp->prioritas==3)<span class="label label-success" style="color:white">prioritas 3</span>
                    @endif
                  </td>
                  @if($pkp->status_project=='sent')
                  <td class="text-center">
                    <a class="btn btn-info btn-sm" href="{{ Route('daftarpromo',$pkp->id_pkp_promo)}}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a>
                  </td>
                  <td>
                    @if($pkp->status_freeze=="inactive")
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
                    @elseif($pkp->status_freeze=="active")
                    Project Is Inactive
                    @endif
                  </td>
                  @elseif($pkp->status_project=='revisi')
                  <td class="text-center"><a class="btn btn-info btn-sm" href="{{ Route('daftarpromo',$pkp->id_pkp_promo) }}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a></td>
                  <td>Data In The Revision Process</td>
                  @elseif($pkp->status_project=='proses')
                  <td class="text-center">
                    <a class="btn btn-info btn-sm" href="{{ Route('daftarpromo',$pkp->id_pkp_promo) }}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a>
                  </td>
                  <td>
                    @if($pkp->status_freeze=='inactive')
                      @if($pkp->userpenerima2==NULL)
                        Has been sent to {{$pkp->users->name}}
                      @elseif($pkp->userpenerima==NULL)
                        Has been sent to {{$pkp->users2->name}}
                      @elseif($pkp->userpenerima!=NULL && $pkp->userpenerima2!==NULL)
                        Has been sent to  {{$pkp->users->name}} & {{$pkp->users2->name}}
                      @endif
                    @elseif($pkp->status_freeze=='active')
                      Project Is Inactive
                    @endif
                  </td>
                  @elseif($pkp->status_project=='close')
                  <td class="text-center">
                    <a class="btn btn-info btn-sm" href="{{ Route('rekappromo',$pkp->id_pkp_promo)}}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a>
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
  </div>
</div>
@endsection