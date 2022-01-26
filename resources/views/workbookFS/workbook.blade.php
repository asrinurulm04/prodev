@extends('layout.tempvv')
@section('title', 'PRODEV|feasibility')
@section('content')

<div class="x_panel">
  <div class="x_panel">
    <div class="col-md-6"><h4><li class="fa fa-star"></li> List Workbook Feasibility </h4></div>
    <div class="col-md-6" align="right">
      @if(auth()->user()->role->namaRule === 'user_rd_proses' && $wsproses=='0')<a href="{{route('addFs',[$id,$fs->id])}}" class="btn btn-sm btn-primary" type="button"><li class="fa fa-plus"></li> Add</a> 
      @elseif(auth()->user()->role->namaRule === 'kemas' && $wskemas=='0')<a href="{{route('addFs',[$id,$fs->id])}}" class="btn btn-sm btn-primary" type="button"><li class="fa fa-plus"></li> Add</a> 
      @endif
      @if($fs->id_project!=NULL)
      <a href="{{ Route('lihatpkp',$pkp->id_project) }}" class="btn btn-sm btn-info" type="button"><li class="fa fa-folder-open"></li> Show PKP</a> 
      <a href="{{route('listPkpFs',$pkp->id_project)}}" class="btn btn-sm btn-danger" type="button"><li class="fa fa-arrow-left"></li> Back</a> 
      @elseif($fs->id_project_pdf!=NULL)
      <a href="{{route('listPdfFs',$pdf->id_project_pdf)}}" class="btn btn-sm btn-danger" type="button"><li class="fa fa-arrow-left"></li> Back</a> 
      @endif
    </div>
  </div>
  @if($fs->id_project!=NULL)
      <div class="x_panel">
        <div class="col-md-5">
          <table>
            <thead>
              <tr><th>Brand</th><td> : {{$pkp->id_brand}}</td></tr>
              <tr><th>Type PKP</th><td> :
                @if($pkp->type==1)Maklon
                @elseif($pkp->type==2)Internal
                @elseif($pkp->type==3)Maklon/Internal
                @endif
              </td></tr>
              <tr><th width="25%">PKP Number</th><td> : {{$pkp->pkp_number}}{{$pkp->ket_no}}</td></tr>
              <tr><th>Status</th><td> : {{$pkp->status_project}}</td></tr>
              <tr><th>Created</th><td> : {{$pkp->created_date}}</td></tr>
            </thead>
          </table>
        </div>
        <div class="col-md-7">
          <table>
            <thead>
              <tr><th>Idea</td> <td> : {{$pkp->idea}}</td></tr>
              <tr><th>Configuration</th><td>: 
                @if($pkp->kemas_eksis!=NULL)(
                  @if($pkp->kemas->tersier!=NULL)
                  {{ $pkp->kemas->tersier }}{{ $pkp->kemas->s_tersier }}
                  @endif

                  @if($pkp->kemas->sekunder1!=NULL)
                  X {{ $pkp->kemas->sekunder1 }}{{ $pkp->kemas->s_sekunder1}}
                  @endif

                  @if($pkp->kemas->sekunder2!=NULL)
                  X {{ $pkp->kemas->sekunder2 }}{{ $pkp->kemas->s_sekunder2 }}
                  @endif

                  @if($pkp->kemas->primer!=NULL)
                  X{{ $pkp->kemas->primer }}{{ $pkp->kemas->s_primer }}
                  @endif )
                @endif
              </td></tr>
              <tr><th width="25%">Launch Deadline</th><td>: {{$pkp->launch}} {{$pkp->years}}</td></tr>
              <tr><th>Sample Deadline</th><td>: {{$pkp->jangka}}-  {{$pkp->waktu}}</td></tr>
              <tr><th>PV</th><td> : {{$pkp->perevisi2->name}}</td></tr>
            </thead>
          </table>
        </div>
      </div>
      @elseif($fs->id_project_pdf!=NULL)
      <div class="x_panel">
        <div class="col-md-5">
          <table>
            <thead>
              <tr><th>Brand</th><td> : {{$pdf->id_brand}}</td></tr>
              <tr><th width="25%">PDf Number</th><td> : {{$pdf->pdf_number}}{{$pdf->ket_no}}</td></tr>
              <tr><th>Status</th><td> : {{$pdf->status_pdf}}</td></tr>
              <tr><th>Created</th><td> : {{$pdf->created_date}}</td></tr>
            </thead>
          </table>
        </div>
        <div class="col-md-7">
          <table>
            <thead>
              <tr><th>Background</td> <td> : {{$pdf->background}}</td></tr>
              <tr><th>Configuration</th><td>: 
                @if($pdf->kemas_eksis!=NULL)(
                  @if($pdf->kemas->tersier!=NULL)
                  {{ $pdf->kemas->tersier }}{{ $pdf->kemas->s_tersier }}
                  @endif

                  @if($pdf->kemas->sekunder1!=NULL)
                  X {{ $pdf->kemas->sekunder1 }}{{ $pdf->kemas->s_sekunder1}}
                  @endif

                  @if($pdf->kemas->sekunder2!=NULL)
                  X {{ $pdf->kemas->sekunder2 }}{{ $pdf->kemas->s_sekunder2 }}
                  @endif

                  @if($pdf->kemas->primer!=NULL)
                  X{{ $pdf->kemas->primer }}{{ $pdf->kemas->s_primer }}
                  @endif )
                @endif
              </td></tr>
              <tr><th width="25%">RTO</th><td>: {{$pdf->rto}}</td></tr>
              <tr><th>Sample Deadline</th><td>: {{$pdf->jangka}}-  {{$pdf->waktu}}</td></tr>
            </thead>
          </table>
        </div>
      </div>
      @endif
</div>
<div class="x_panel">
    <div class="card-block">
      <div class="dt-responsive table-responsive"><br>
        <table id="datatable" class="table table-striped table-bordered">
          <thead>
            <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
              <th class="text-center" width="5%">#</th>
              <th class="text-center" width="25%">Name</th>
              <th class="text-center" width="25%">Note</th>
              <th class="text-center" width="25%">Status</th>
              <th class="text-center" width="15%">Action</th>
            </tr>
          </thead>
          @if($fs->id_project!=NULL)
          <tbody>
            @foreach($list as $list)
              <tr>
                <td class="text-center">{{$list->opsi}}</td>
                <td>{{$list->name}}</td>
                <td>{{$list->note}}</td>
                <td>{{$list->status}}</td>
                <td class="text-center">
                  @if(auth()->user()->role->namaRule === 'user_rd_proses')
                    @if($list->status=='Draf')
                    <a class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Edit Data" href="{{route('datamesin',[$pkp->id_project,$fs,$list->id])}}"><li class="fa fa-edit"></li></a>
                    @endif
                    <a class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Update" href="{{route('upProses',$list->id)}}"><li class="fa fa-arrow-circle-up"></li></a>
                    @if($wsproses2==0)
                      <a class="btn btn-dark btn-sm" data-toggle="tooltip" data-placement="top" title="Gabungkan" href="{{route('gabung',[$list->id,$fs->id])}}"><li class="fa fa-paper-plane"></li></a>
                    @elseif($wsproses2=!0)
                      @if($list->status=='Sent')
                      <a class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Show" href="{{route('datamesin',[$pkp->id_project,$fs,$list->id])}}"><li class="fa fa-eye"></li></a>
                      <a class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Batalkan Penggabungan" href="{{route('batalgabung',[$list->id,$fs->id])}}"><li class="fa fa-times"></li></a>
                      @endif
                    @endif
                  @elseif(auth()->user()->role->namaRule === 'kemas')
                    @if($list->status=='Draf')
                    <a class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Edit Data" href="{{route('datakemas',[$pkp->id_project,$fs,$list->id])}}"><li class="fa fa-edit"></li></a>
                    @endif
                    <a class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Update" href="{{route('upKemas',$list->id)}}"><li class="fa fa-arrow-circle-up"></li></a>
                    @if($wskemas2==0)
                      <a class="btn btn-dark btn-sm" data-toggle="tooltip" data-placement="top" title="Gabungkan" href="{{route('gabung',[$list->id,$fs->id])}}"><li class="fa fa-paper-plane"></li></a>
                    @elseif($wskemas2=!0)
                      @if($list->status=='Sent')
                      <a class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Show" href="{{route('datakemas',[$pkp->id_project,$fs,$list->id])}}"><li class="fa fa-eye"></li></a>
                      <a class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Batalkan Penggabungan" href="{{route('batalgabung',[$list->id,$fs->id])}}"><li class="fa fa-times"></li></a>
                      @endif
                    @endif  
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
          @elseif($fs->id_project_pdf!=NULL)
          <tbody>
            @foreach($list as $list)
              <tr>
                <td class="text-center">{{$list->opsi}}</td>
                <td>{{$list->name}}</td>
                <td>{{$list->note}}</td>
                <td>{{$list->status}}</td>
                <td class="text-center">
                  @if(auth()->user()->role->namaRule === 'user_rd_proses')
                    @if($list->status=='Draf')
                    <a class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Edit Data" href="{{route('datamesin',[$pdf->id_project_pdf,$fs,$list->id])}}"><li class="fa fa-edit"></li></a>
                    @endif
                    <a class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Update" href="{{route('upProses',$list->id)}}"><li class="fa fa-arrow-circle-up"></li></a>
                    @if($wsproses2==0)
                      <a class="btn btn-dark btn-sm" data-toggle="tooltip" data-placement="top" title="Gabungkan" href="{{route('gabung',[$list->id,$fs->id])}}"><li class="fa fa-paper-plane"></li></a>
                    @elseif($wsproses2=!0)
                      @if($list->status=='Sent')
                      <a class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Show" href="{{route('datamesin',[$pdf->id_project_pdf,$fs,$list->id])}}"><li class="fa fa-eye"></li></a>
                      <a class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Batalkan Penggabungan" href="{{route('batalgabung',[$list->id,$fs->id])}}"><li class="fa fa-times"></li></a>
                      @endif
                    @endif
                  @elseif(auth()->user()->role->namaRule === 'kemas')
                    @if($list->status=='Draf')
                    <a class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Edit Data" href="{{route('datakemas',[$pdf->id_project_pdf,$fs,$list->id])}}"><li class="fa fa-edit"></li></a>
                    @endif
                    <a class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Update" href="{{route('upKemas',$list->id)}}"><li class="fa fa-arrow-circle-up"></li></a>
                    @if($wskemas2==0)
                      <a class="btn btn-dark btn-sm" data-toggle="tooltip" data-placement="top" title="Gabungkan" href="{{route('gabung',[$list->id,$fs->id])}}"><li class="fa fa-paper-plane"></li></a>
                    @elseif($wskemas2=!0)
                      @if($list->status=='Sent')
                      <a class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Show" href="{{route('datakemas',[$pdf->id_project_pdf,$fs,$list->id])}}"><li class="fa fa-eye"></li></a>
                      <a class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Batalkan Penggabungan" href="{{route('batalgabung',[$list->id,$fs->id])}}"><li class="fa fa-times"></li></a>
                      @endif
                    @endif  
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
          @endif
        </table>
      </div>
    </div>
  </div>
</div>

@endsection
@section('s')
<link href="{{ asset('lib/advanced-datatable/css/jquery.dataTables.css') }}" rel="stylesheet" />
<script src="{{ asset('js/datatables.min.js')}}"></script>
@endsection