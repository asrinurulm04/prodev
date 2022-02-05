@extends('layout.tempvv')
@section('title', 'PRODEV|Tabulasi Project')
@section('content')

<div class="x_panel">
  <div class="">
  <div class="x_title">
      <h3><li class="fa fa-list"></li> Tabulasi Project</h3>
    </div>
    <div class="container"> 
      <section id="fancyTabWidget" class="tabs t-tabs">
      <ul class="nav nav-tabs fancyTabs" role="tablist">
        <li class="tab fancyTab active col-md-6 col-sm-12 col-xs-12">
          @if(auth()->user()->role->namaRule === 'pv_lokal' || auth()->user()->role->namaRule === 'marketing' || auth()->user()->role->namaRule === 'manager')
          <div style="font-weight: bold;color:white;background-color: #2a3f54;" class="arrow-down"><div class="arrow-down-inner"></div></div>	
            <a id="tab0" href="#tabBody0" role="tab" aria-controls="tabBody0" style="font-weight: bold;color:white;background-color: #2a3f54;" aria-selected="true" data-toggle="tab" tabindex="0"><span class="hidden-xs"> </span>PKP</a>
        	<div class="whiteBlock"></div>
          @endif
        </li>
                  
        <li class="tab fancyTab col-md-6 col-sm-12 col-xs-12">
          @if(auth()->user()->role->namaRule === 'pv_global' || auth()->user()->role->namaRule === 'manager')
          <div class="arrow-down" style="font-weight: bold;color:white;background-color: #2a3f54;"><div class="arrow-down-inner"></div></div>
            <a id="tab1" style="font-weight: bold;color:white;background-color: #2a3f54;" href="#tabBody1" role="tab" aria-controls="tabBody1" aria-selected="true" data-toggle="tab" tabindex="0"><span class="hidden-xs"> PDF</span></a>
          <div class="whiteBlock"></div>
          @endif
        </li>
               
      </ul>
      <div id="myTabContent" class="tab-content fancyTabContent">
        <!-- PKP -->
        @if(auth()->user()->role->namaRule === 'pv_lokal' || auth()->user()->role->namaRule === 'marketing' || auth()->user()->role->namaRule === 'manager')
        <div class="tab-pane  fade active in" id="tabBody0" role="tabpanel" aria-labelledby="tab0" aria-hidden="false" tabindex="0" >
          <div><br>
            <div class="row"  >
              <div class="col-md-12">
                @if(auth()->user()->role->namaRule === 'pv_lokal')
                <button class="btn btn-info btn-sm" type="button" data-toggle="modal" data-target="#notulen"><li class="fa fa-book"></li> create Notulen PKP</button>
                @endif
                <a href="{{route('cetak')}}" class="btn btn-sm btn-warning"><li class="fa fa-cloud-download"></li> Download</a>
                <label><input type="checkbox" id="checkAllpkpp1"/> Check all</label>
                <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                  <thead>
                    <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                      <th></th>
                      <th class="text-center">Priority</th>
                      <th class="text-center">No</th>
                      <th class="text-center" style="min-width:110px">Sent to RND</th>
                      <th class="text-center" style="min-width:110px">Brand</th>
                      <th class="text-center" style="min-width:230px">Idea</th>
                      <th class="text-center" style="min-width:110px">Target Launch</th>
                      <th class="text-center">Type</th>
                      <th class="text-center">Age</th>
                      <th class="text-center" style="min-width:110px">Gender</th>
                      <th class="text-center" style="min-width:200px">Forecast</th>
                      <th class="text-center">Uniquenes of idea</th>
                      <th class="text-center">Potential market</th>
                      <th class="text-center" style="min-width:230px">Reason</th>
                      <th class="text-center" style="min-width:230px">Aisle placement</th>
                      <th class="text-center">selling price</th>
                      <th class="text-center">Consumer price</th>
                      <th class="text-center" style="min-width:200px">Configuration</th>
                      <th class="text-center" style="min-width:170px">Main Competitor</th>
                      <th class="text-center" style="min-width:230px">Competitive</th>
                      <th class="text-center">Product Form</th>
                      <th class="text-center" style="min-width:130px">AKG</th>
                      <th class="text-center" style="min-width:130px">BPOM</th>
                      <th class="text-center" style="min-width:130px">prefered flavour</th>
                      <th class="text-center" style="min-width:130px">product benefits</th>
                      <th class="text-center" style="min-width:130px">mandatory ingredient</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($datapkp as $Dpkp)
                    <tr>
                      <td><input type="checkbox" class="cekbox1" name="datapkpp[]" id="cekbox" value="{{$Dpkp->id_project}}"></td>
                      <td class="text-center">
                      @if($Dpkp->prioritas!=NULL)
                      {{$Dpkp->prioritas}}
                      @elseif($Dpkp->prioritas==NULL)
                        @if($Dpkp->status_pkp=='drop') Stop
                        @elseif($Dpkp->status_pkp=='close') Launch
                        @endif
                      @endif
                      </td>
                      <td>{{$Dpkp->pkp_number}}{{$Dpkp->ket_no}}</td>
                      <td>{{$Dpkp->tgl_kirim}}</td>
                      <td>{{$Dpkp->id_brand}}</td>
                      <td width="8%">{{$Dpkp->idea}}</td>
                      <td>{{$Dpkp->launch}} {{$Dpkp->years}}{{$Dpkp->tgl_launch}}</td>
                      <td>
                        @if($Dpkp->type=='1') Maklon  
                        @elseif($Dpkp->type=='2') Internal  
                        @elseif($Dpkp->type=='3') Maklon & Internal
                        @endif
                      </td>
                      <td>{{$Dpkp->dariumur}}-{{$Dpkp->sampaiumur}}</td>
                      <td>{{$Dpkp->gender}}</td>
                      <td>@foreach($for as $data) @if($data->id_project==$Dpkp->id_project &&$data->id_pkp==$Dpkp->id_pkp && $data->turunan==$Dpkp->turunan && $data->revisi==$Dpkp->revisi && $data->revisi_kemas==$Dpkp->revisi_kemas) {{$data->satuan}} = <?php $angka_format = number_format($data->forecast,2,",","."); echo "Rp. ".$angka_format;?> <br> @endif @endforeach</td></td>
                      <td>{{$Dpkp->Uniqueness}}</td>
                      <td>{{$Dpkp->Estimated}}</td>
                      <td width="8%">{{$Dpkp->reason}}</td>
                      <td>{{$Dpkp->aisle}}</td>
                      <td>{{$Dpkp->price}}</td>
                      <td>{{$Dpkp->selling_price}}</td>
                      <td>
                        @if($Dpkp->kemas_eksis!=NULL)(
                          @if($Dpkp->kemas->tersier!=NULL)
                          {{ $Dpkp->kemas->tersier }}{{ $Dpkp->kemas->s_tersier }}
                          @endif

                          @if($Dpkp->kemas->sekunder1!=NULL)
                          X {{ $Dpkp->kemas->sekunder1 }}{{ $Dpkp->kemas->s_sekunder1}}
                          @endif

                          @if($Dpkp->kemas->sekunder2!=NULL)
                          X {{ $Dpkp->kemas->sekunder2 }}{{ $Dpkp->kemas->s_sekunder2 }}
                          @endif

                          @if($Dpkp->kemas->primer!=NULL)
                          X{{ $Dpkp->kemas->primer }}{{ $Dpkp->kemas->s_primer }}
                          @endif )
                        @endif
                      </td>
                      <td>{{$Dpkp->competitor}}</td>
                      <td>{{$Dpkp->competitive}}</td>
                      <td>{{$Dpkp->product_form}}</td>
                      <td>@if($Dpkp->akg!=NULL){{$Dpkp->tarkon->tarkon}}@endif</td>
                      <td>@if($Dpkp->bpom!=NULL && $Dpkp->kategori_bpom!=NULL)({{$Dpkp->katpangan->no_kategori}}) {{$Dpkp->katpangan->pangan}}@endif</td>
                      <td width="5%">{{$Dpkp->prefered_flavour}}</td>
                      <td>{{$Dpkp->product_benefits}}</td>
                      <td>{{$Dpkp->mandatory_ingredient}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        @endif
        <!-- PDF -->
        @if(auth()->user()->role->namaRule === 'pv_global')
        <div class="tab-pane  fade active in" id="tabBody1" role="tabpanel" aria-labelledby="tab1" aria-hidden="true" tabindex="0">
        @elseif( auth()->user()->role->namaRule === 'manager')
        <div class="tab-pane  fade" id="tabBody1" role="tabpanel" aria-labelledby="tab1" aria-hidden="true" tabindex="0">
        @endif
          @if(auth()->user()->role->namaRule === 'pv_global' || auth()->user()->role->namaRule === 'manager')
          <div class="row"><br>
            <div class="col-md-12">
              <a href="{{route('cetak_pdf')}}" class="btn btn-sm btn-warning"><li class="fa fa-cloud-download"></li> Download</a>
              <label><input type="checkbox" id="checkAllpdff1"/> Check all</label>
              <table id="Table" class="Table table-striped table-bordered" style="width:100%">
                <thead>
                  <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                    <td></td>
                    <td class="text-center">No</td>
                    <td class="text-center">Sent to RND</td>
                    <th class="text-center">Brand</th>
                    <th class="text-center">Type</th>
                    <th class="text-center">Prioritas</th>
                    <th class="text-center" style="min-width:200px">Configuration</th>
                    <th class="text-center">country</th>
                    <th class="text-center">reference</th>
                    <th class="text-center">Age</th>
                    <th class="text-center">Gender</th>
                    <th class="text-center" style="min-width:230px">Background / Insight</th>
                    <th class="text-center">Attracttiveness</th>
                    <th class="text-center">Target RTO</th>
                    <th class="text-center">Name Competitor</th>
                    <th class="text-center">Retailer price</th>
                    <th class="text-center">Wight/serving</th>
                    <th class="text-center">Inggredients</th>
                    <th class="text-center">What's Special</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($datapdf as $Dpdf)
                  <tr>
                    <td><input type="checkbox" name="datapdf[]" class="form-control cekboxpdf1" value="{{$Dpdf->id_project_pdf}}"></td>
                    <td>{{$Dpdf->pdf_number}}{{$Dpdf->ket_no}}</td>
                    <td>{{$Dpdf->tgl_kirim}}</td>
                    <td>{{$Dpdf->id_brand}}</td>
                    <td>{{$Dpdf->datapdf->type->type}}</td>
                    <td>
                      @if($Dpdf->prioritas==1)
                      <span class="label label-danger">Priority 1</span>
                      @elseif($Dpdf->prioritas==2)
                      <span class="label label-warning">Priority 2</span>
                      @elseif($Dpdf->prioritas==3)
                      <span class="label label-primary">Priority 3</span>
                      @endif
                    </td>
                    <td>
                    @if($Dpdf->kemas_eksis!=NULL)
                      ( @if($Dpdf->kemas->primer!=NULL)
                        {{ $Dpdf->kemas->primer }}{{ $Dpdf->kemas->s_primer }} X
                      @endif

                      @if($Dpdf->kemas->sekunder1!=NULL)
                        {{ $Dpdf->kemas->sekunder1 }}{{ $Dpdf->kemas->s_sekunder1}} X
                      @endif

                      @if($Dpdf->kemas->sekunder2!=NULL)
                        {{ $Dpdf->kemas->sekunder2 }}{{ $Dpdf->kemas->s_sekunder2 }} X
                      @endif

                      @if($Dpdf->kemas->tersier!=NULL)
                        {{ $Dpdf->kemas->tersier }}{{ $Dpdf->kemas->s_tersier }}
                      @endif )
                    @endif
                    </td>
                    <td>{{$Dpdf->country}}</td>
                    <td>{{$Dpdf->reference}}</td>
                    <td>{{$Dpdf->dariusia}} - {{$Dpdf->sampaiusia}}</td>
                    <td>{{$Dpdf->gender}}</td>
                    <td>{{$Dpdf->background}}</td>
                    <td>{{$Dpdf->attractiveness}}</td>
                    <td>{{$Dpdf->rto}}</td>
                    <td>{{$Dpdf->name}}</td>
                    <td>{{$Dpdf->retailer_price}}</td>
                    <td>{{$Dpdf->wight}}\{{$Dpdf->serving}}</td>
                    <td>{{$Dpdf->ingredient}}</td>
                    <td>{{$Dpdf->special}}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          @endif
        </div>
      </div>
      </section>
    </div>
  </div>
</div>
<!-- modal -->
<div class="modal" id="notulen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title text-left" id="exampleModalLabel">Konfirmasi Meeting
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></h3>
        </button>
      </div>
      <form class="form-horizontal form-label-left" method="POST" action="{{route('konfirmasi_notulen')}}" novalidate>
      <div class="modal-body">
        <div class="form-panel"><?php $last = Date('F'); ?>
          <div class="form-group">
            <div class="col-md-4 col-sm-4 col-xs-12">
              <select class="form-control" name="tgl" id="tgl">
                <?php
                  $tgl=array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31");
                  $jlh_bln=count($tgl);
                  for($c=0; $c<$jlh_bln; $c+=1){ echo"<option value=$tgl[$c]> $tgl[$c] </option>"; }
                ?>
              </select>
            </div>
            <div class="col-md-8 col-sm-8 col-xs-12">
              <select class="form-control" name="bulan" id="bulan">
                <?php
                  $bulan=array("January","February","March","April","May","June","july","August","September","October","November","December");
                  $jlh_bln=count($bulan);
                  for($c=0; $c<$jlh_bln; $c+=1){ echo"<option value=$bulan[$c]> $bulan[$c] </option>"; }
                ?>
              </select>
            </div>
          </div>
          <input type="radio" value="2" id="info" name="info" checked> PV & Marketing <br>
          <input type="radio" value="1" id="info" name="info"> PV & RD <br>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-paper-plane"></i> Submit</button>
        {{ csrf_field() }}
      </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal Selesai -->
@endsection
@section('s')
<link href="{{ asset('lib/advanced-datatable/css/jquery.dataTables.css') }}" rel="stylesheet" />
<script src="{{ asset('js/datatables.min.js')}}"></script>
<script>
  // PKP
  $("#checkAllpkp").change(function () {
    $(".data").prop('checked', $(this).prop("checked"));
  });

  $("#checkAllpkpp").change(function () {
    $(".cekbox").prop('checked', $(this).prop("checked"));
  });

  $("#checkAllpkpp1").change(function () {
    $(".cekbox1").prop('checked', $(this).prop("checked"));
  });

  // PDF
  $("#checkAllpdf").change(function () {
    $(".check").prop('checked', $(this).prop("checked"));
  });

  $("#checkAllpdff").change(function () {
    $(".cekboxpdf").prop('checked', $(this).prop("checked"));
  });

  $("#checkAllpdff1").change(function () {
    $(".cekboxpdf1").prop('checked', $(this).prop("checked"));
  });
</script>
<script type="text/javascript">$('.Table').DataTable({
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
});</script>
@endsection