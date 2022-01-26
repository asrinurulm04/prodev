@extends('layout.tempvv')
@section('title', 'PRODEV|feasibility')
@section('content')

<div class="x_panel">
  <div class="x_title">
    <h3><li class="fa fa-list"> List PDF-Feasibility</li></h3>
    </div>
    <div class="card-block">
      <div class="dt-responsive table-responsive">
        <table id="datatable" class="table table-striped table-bordered">
          <thead>
            <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
              <th class="text-center" width="5%">No</th>
              <th class="text-center">PDF Number</th>
              <th class="text-center">Project Name</th>
              <th class="text-center">Brand</th>
              <th class="text-center">PV</th>
              <th class="text-center">Tgl Kirim</th>
              <th class="text-center">Status</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          @if(auth()->user()->role->namaRule === 'manager')
          <tbody>
            @php $no = 0; @endphp
            @foreach($pdf as $pdf)
              <tr>
                <td class="text-center">{{++$no}}</td>
                <td>{{$pdf->pdf_number}}{{$pdf->ket_no}}</td>
                <td>{{$pdf->project_name}}</td>
                <td>{{$pdf->id_brand}}</td>
                <td>{{$pdf->author1->name}}</td>
                <td>{{$pdf->tgl_pengajuan_fs}}</td>
                @if($pdf->user_fs==NULL)
                <td class="text-center">New</td>
                @elseif($pdf->user_fs!=NULL)
                <td class="text-center">Sent to "{{$pdf->proses->name}}"</td>
                @endif
                <td class="text-center">
									<a href="{{route('listPdfFs',$pdf->id_project_pdf)}}" class="btn-info btn-sm btn" type="button"><li class="fa fa-folder"></li></a>
								</td>
              </tr>
            @endforeach
          </tbody>
          @elseif(auth()->user()->role->namaRule === 'user_rd_proses')
          <tbody>
            @php $no = 0; @endphp
            @foreach($pdf2 as $pdf)
              <tr>
                <td class="text-center">{{++$no}}</td>
                <td>{{$pdf->pdf_number}}{{$pdf->ket_no}}</td>
                <td>{{$pdf->project_name}}</td>
                <td>{{$pdf->id_brand}}</td>
                <td>{{$pdf->author1->name}}</td>
                <td>{{$pdf->tgl_pengajuan_fs}}</td>
                <td class="text-center">{{$pdf->pengajuan_fs}}</td>
                <td class="text-center">
									<a href="{{route('listPdfFs',$pdf->id_project_pdf)}}" class="btn-info btn-sm btn" type="button"><li class="fa fa-folder"></li></a>
								</td>
              </tr>
            @endforeach
          </tbody>
          @elseif(auth()->user()->role->namaRule === 'maklon' || auth()->user()->role->namaRule === 'lab')
          <tbody>
            @php $no = 0; @endphp
            @foreach($pdf3 as $pdf)
              <tr>
                <td class="text-center">{{++$no}}</td>
                <td>{{$pdf->pdf_number}}{{$pdf->ket_no}}</td>
                <td>{{$pdf->project_name}}</td>
                <td>{{$pdf->id_brand}}</td>
                <td>{{$pdf->author1->name}}</td>
                <td>{{$pdf->tgl_pengajuan_fs}}</td>
                <td class="text-center">{{$pdf->pengajuan_fs}}</td>
                <td class="text-center">
									<a href="{{route('listPdfFs',$pdf->id_project_pdf)}}" class="btn-info btn-sm btn" type="button"><li class="fa fa-folder"></li></a>
								</td>
              </tr>
            @endforeach
          </tbody>
          @elseif(auth()->user()->role->namaRule === 'kemas')
          <tbody>
            @php $no = 0; @endphp
            @foreach($pdf4 as $pdf)
              <tr>
                <td class="text-center">{{++$no}}</td>
                <td>{{$pdf->pdf_number}}{{$pdf->ket_no}}</td>
                <td>{{$pdf->project_name}}</td>
                <td>{{$pdf->id_brand}}</td>
                <td>{{$pdf->author1->name}}</td>
                <td>{{$pdf->tgl_pengajuan_fs}}</td>
                <td class="text-center">{{$pdf->pengajuan_fs}}</td>
                <td class="text-center">
									<a href="{{route('listPdfFs',$pdf->id_project_pdf)}}" class="btn-info btn-sm btn" type="button"><li class="fa fa-folder"></li></a>
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