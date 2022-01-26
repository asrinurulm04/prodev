@extends('layout.tempvv')
@section('title', 'feasibility|Lab')
@section('content')

<div class="row">
  <div class="col-md-12 col-xs-12">
    <div class="x_panel">
      <div class="col-md-6"><h4><li class="fa fa-flask"></li> Workbook </h4></div>
      <div class="col-md-6" align="right">
        <a href="{{route('dataOH',[$pkp->id_project,$fs,$ws])}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-arrow-left"></li> Back</a>
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
              <tr><th>PV</th><td> : {{$pdf->perevisi2->name}}</td></tr>
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
  </div>  
</div>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h3><li class="fa fa-list"> Alergen</li></h3>
      </div>
      <br>
			<form class="form-horizontal form-label-left" method="POST" action="{{ route('lini') }}">
      <table class="table table-bordered">
				<thead>
					<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
						<th colspan="7" class="text-center">HASIL REVIEW PENCANTUMAN ALERGEN PADA PRODUK</th>
					</tr>
					<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
						<th colspan="3" class="text-center">Alergen di Produk</th>
						<th colspan="3" class="text-center">Alergen Baru Lini Proses</th>
						<th rowspan="2" width="15%" class="text-center">No Reference</th>
					</tr>
					</tr>
					<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
						<th width="15%" class="text-center">Alergen Contain Dari BB</th>
						<th width="15%" class="text-center">Sumber BB Alergen Contain</th>
						<th width="15%" class="text-center">Alergen May Contain Dari Lini</th>
						<th width="15%" class="text-center">Alergen Baru</th>
						<th width="15%" class="text-center">Lini yang Terdampak</th>
						<th width="15%" class="text-center">Note</th>
				</thead>
				<tbody>
          <input type="hidden" value="{{$pkp->id_project}}" name="id" id="id">
          <input type="hidden" value="{{$ws->id}}" name="ws" id="ws">
          <input type="hidden" value="{{$fs}}" name="fs" id="fs">
					<td width="15%">
            @if($all!=NULL)
              @foreach($all as $all)
                - {{$all->allergen_countain}} <br>
              @endforeach
            @endif
          </td>
					<td width="15%">
            @if($bahan!=NULL)
              @foreach($bahan as $bahan)
                * {{$bahan->bb->nama_bahan}} <br>
              @endforeach
            @endif
          </td>
          @if($count==0)
					<td><textarea class="form-control" name="my_contain" id="allergen" cols="0" rows="4"></textarea></td>
					<td><textarea class="form-control" name="allergen" id="allergen" cols="0" rows="4"></textarea></td>
					<td><textarea class="form-control" name="lini" id="lini" cols="0" rows="4"></textarea></td>
					<td><textarea class="form-control" name="note" id="note" cols="0" rows="4"></textarea></td>
					<td><textarea class="form-control" name="ref" id="ref" cols="0" rows="4"></textarea></td>
          @elseif($count<=1)
					<td><textarea class="form-control" value="{{$lini->my_contain}}" name="my_contain" id="my_contain" cols="0" rows="4">{{$lini->my_contain}}</textarea></td>
					<td><textarea class="form-control" value="{{$lini->allergen_baru}}" name="allergen" id="allergen" cols="0" rows="4">{{$lini->allergen_baru}}</textarea></td>
					<td><textarea class="form-control" value="{{$lini->lini_terdampak}}" name="lini" id="lini" cols="0" rows="4">{{$lini->lini_terdampak}}</textarea></td>
					<td><textarea class="form-control" value="{{$lini->catatan}}" name="note" id="note" cols="0" rows="4">{{$lini->catatan}}</textarea></td>
					<td><textarea class="form-control" value="{{$lini->no_ref}}" name="ref" id="ref" cols="0" rows="4">{{$lini->no_ref}}</textarea></td>
          @endif
				</tbody>
			</table>
      <div class="col-md-6 col-md-offset-5">
        @if($count==0)
        <button type="submit" class="btn btn-primary btn-sm"><li class="fa fa-check"></li> Save</button>
        {{ csrf_field() }}
        @elseif($count!=0)
        <button type="submit" class="btn btn-warning btn-sm"><li class="fa fa-edit"></li> Edit</button>
        {{ csrf_field() }}
        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#NW1" type="button"><li class="fa fa-check"></li> Finish</button>
        @endif
      </div>
      </form>
		</div>
	</div>
</div>

<!-- Template -->
<div class="modal" id="NW1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Note
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> </h3>
      </div>
      <form class="form-horizontal form-label-left" method="POST" action="{{ route('judul') }}">
      <div class="modal-body">
        <div class="form-group row">
          <input type="hidden" value="{{$pkp->id_project}}" name="id" id="id">
          <input type="hidden" value="{{$ws->id}}" name="ws" id="ws">
          <input type="hidden" value="{{$fs->id}}" name="fs" id="fs">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Judul Workbook</label>
          <div class="col-md-9 col-sm-8 col-xs-12">
            <input type="text" name="judul" value="WB Proses-{{$ws->opsi}}" id="judul" class="form-control col-md-12 col-xs-12" readonly>
          </div>
        </div>
        <div class="form-group row">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Remarks</label>
          <div class="col-md-9 col-sm-8 col-xs-12">
            <textarea name="remarks" value="{{$ws->note}}" id="remarks" cols="0" rows="3" class="form-control">{{$ws->note}}</textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary btn-sm" onclick="return confirm('Yakin Dengan Data Yang Anda Masukan??')"><i class="fa fa-check"></i> Submit</button>
          {{ csrf_field() }}
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Selesai -->
@endsection
@section('s')
<link href="{{ asset('lib/advanced-datatable/css/jquery.dataTables.css') }}" rel="stylesheet" />
<script src="{{ asset('js/datatables.min.js')}}"></script>
@endsection