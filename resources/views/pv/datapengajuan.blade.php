@extends('layout.tempvv')
@section('title', 'PRODEV|Pengajuan Revisi')
@section('content')

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h3><li class="fa fa-envelope"></li> Revision Request</h3>
        </div>
        <div>
          <div class="container"> 
            <section id="fancyTabWidget" class="tabs t-tabs">
            <ul class="nav nav-tabs fancyTabs" role="tablist">
              <li class="tab fancyTab active col-md-4 col-sm-12 col-xs-12">
                <div style="font-weight: bold;color:white;background-color: #2a3f54;" class="arrow-down"><div class="arrow-down-inner"></div></div>	
                  <a id="tab0" href="#tabBody0" role="tab" aria-controls="tabBody0" style="font-weight: bold;color:white;background-color: #2a3f54;" aria-selected="true" data-toggle="tab" tabindex="0"><span class="hidden-xs"> PKP</span></a>
              	<div class="whiteBlock"></div>
              </li>
              <li class="tab fancyTab col-md-4 col-sm-12 col-xs-12">
                <div class="arrow-down" style="font-weight: bold;color:white;background-color: #2a3f54;"><div class="arrow-down-inner"></div></div>
                  <a id="tab1" style="font-weight: bold;color:white;background-color: #2a3f54;" href="#tabBody1" role="tab" aria-controls="tabBody1" aria-selected="true" data-toggle="tab" tabindex="0"><span class="hidden-xs"> PDF</span></a>
                <div class="whiteBlock"></div>
              </li>
              <li class="tab fancyTab col-md-4 col-sm-12 col-xs-12">
                <div class="arrow-down" style="font-weight: bold;color:white;background-color: #2a3f54;"><div class="arrow-down-inner"></div></div>
                  <a id="tab2" style="font-weight: bold;color:white;background-color: #2a3f54;" href="#tabBody2" role="tab" aria-controls="tabBody2" aria-selected="true" data-toggle="tab" tabindex="0"><span class="hidden-xs"> PKP Promo</span></a>
                <div class="whiteBlock"></div>
              </li>
            </ul><br><br>
            <div id="myTabContent" class="tab-content fancyTabContent" aria-live="polite">
              <!-- PKP Pengajuan -->
              <div class="tab-pane  fade active in" id="tabBody0" role="tabpanel" aria-labelledby="tab0" aria-hidden="false" tabindex="0">
                <div>
                  <div class="row">
                    <div class="col-md-12">
                      <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                          <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                            <th class="text-center">Project Name</th>
                            <th class="text-center">Priority</th>
                            <th class="text-center">receiver</th>
                            <th class="text-center">Information</th>
                            <th width="5%">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($pengajuanpkp as $pkp)
                          <tr>
                            <td>{{$pkp->project_name}}</td>
                            <td class="text-center">
                              @if($pkp->prioritas_pengajuan=='1')
                              <span class="label label-danger" style="color:#ffff">High Priority</span>
                              @elseif($pkp->prioritas_pengajuan=='2')
                              <span class="label label-warning" style="color:#ffff">Standar Priority</span>
                              @elseif($pkp->prioritas_pengajuan=='3')
                              <span class="label label-primary" style="color:#ffff">Low Priority</span>
                              @endif
                            </td>
                            <th class="text-center">
                            {{$pkp->user->role}}
                            </th>
                            <td width="25%">{{$pkp->alasan_pengajuan}}</td>
                            <td width="10%">
                              <a href="{{Route('rekappkp',[$pkp->id_project,$pkp->id_pkp])}}" class="btn btn-info btn-sm" type="button"><li class="fa fa-edit"> Start revision</li></a>
            	              </td>
                          </tr>
                        @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Pengajuan PDF -->
              <div class="tab-pane  fade" id="tabBody1" role="tabpanel" aria-labelledby="tab1" aria-hidden="true" tabindex="0">
                <div class="row">
                  <div class="col-md-12">
                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                      <thead>
                        <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                          <td class="text-center" width="5%">No</td>
                          <th class="text-center">From</th>
                          <th class="text-center">Project Name</th>
                          <th class="text-center">Priority</th>
                          <th class="text-center">receiver</th>
                          <th class="text-center">Information</th>
                          <th width="5%">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      @php $nol = 0; @endphp
                      @foreach($pengajuanpdf as $pdf)
                      @php ++$nol; @endphp
                        <tr>
                          <td width="3%"  class="text-center">{{$nol}}</td>
                          <td width="10%">Manager {{$pdf->datapdf->departement->dept}}</td>
                          <td>{{$pdf->datapdf->project_name}}</td>
                          <td class="text-center">
                            @if($pdf->prioritas_pengajuan=='1')
                            <span class="label label-danger" style="color:#ffff">High Priority</span>
                            @elseif($pdf->prioritas_pengajuan=='2')
                            <span class="label label-warning" style="color:#ffff">Standar Priority</span>
                            @elseif($pdf->prioritas_pengajuan=='3')
                            <span class="label label-primary" style="color:#ffff">Low Priority</span>
                            @endif
                          </td>
                          <td class="text-center">
                            @if($pdf->penerima==NULL)
                            @elseif($pdf->penerima!=NULL)
                              {{$pdf->user->role	}}
                            @endif
                          </td>
                          <td width="25%">{{$pdf->alasan_pengajuan}}</td>
                          <td width="10%"><a href="{{Route('rekappdf',$pdf->id_pdf)}}" class="btn btn-info btn-sm" type="button"><li class="fa fa-edit"> Start revision</li></a></td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <!-- Pengajuan Promo -->
              <div class="tab-pane  fade" id="tabBody2" role="tabpanel" aria-labelledby="tab2" aria-hidden="true" tabindex="0">
                <div class="row">
                  <div class="col-md-12">
                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                      <thead>
                        <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                          <td class="text-center" width="5%">No</td>
                          <th class="text-center">From</th>
                          <th class="text-center">Project Name</th>
                          <th class="text-center">Priority</th>
                          <th class="text-center">receiver</th>
                          <th class="text-center">Information</th>
                          <th width="5%">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php $satu = 0; @endphp
                        @foreach($pengajuanpromo as $promo)
                        @php ++$satu; @endphp
                        <tr>
                          <td width="3%"  class="text-center">{{$satu}}</td>
                          <td width="10%">Manager {{$promo->datapromo->departement->dept}}</td>
                          <td>{{$promo->datapromo->project_name}}</td>
                          <td class="text-center">
                            @if($promo->prioritas_pengajuan=='1')
                            <span class="label label-danger" style="color:#ffff">High Priority</span>
                            @elseif($promo->prioritas_pengajuan=='2')
                            <span class="label label-warning" style="color:#ffff">Standar Priority</span>
                            @elseif($promo->prioritas_pengajuan=='3')
                           <span class="label label-primary" style="color:#ffff">Low Priority</span>
                            @endif
                          </td>
                          <td class="text-center">
                            @if($promo->penerima!=NULL)
                            {{$promo->user->role}}
                            @endif
                          </td>
                          <td width="25%">{{$promo->alasan_pengajuan}}</td>
                          <td width="10%">
                              <a href="{{Route('rekappromo',$promo->id_promo)}}" class="btn btn-info btn-sm" type="button"><li class="fa fa-edit"> Start revision</li></a>
                          </td>
                          </tr>
                        @endforeach
                        </tbody>
                      </table>
                  </div>
                </div>
              </div>
            </div>
            </section>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>  
@endsection