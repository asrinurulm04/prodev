@extends('layout.tempvv')
@section('title', 'feasibility|Lab')
@section('content')

<div class="row">
  <div class="col-md-12 col-xs-12">
    <div class="x_panel">
      <div class="col-md-6"><h4><li class="fa fa-flask"></li> Workbook </h4></div>
      <div class="col-md-6" align="right">
        <a href="" class="btn btn-danger btn-sm" type="button"><li class="fa fa-arrow-left"></li> Back</a>
      </div>
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
			<table class="table table-bordered">
				<thead>
					<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
						<th colspan="6" class="text-center">HASIL REVIEW PENCANTUMAN ALERGEN PADA PRODUK</th>
					</tr>
					<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
						<th colspan="3" class="text-center">Alergen di Produk</th>
						<th colspan="3" class="text-center">Alergen Baru di Lini Proses</th>
					</tr>
					<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
						<th width="18%" class="text-center">Alergen Contain</th>
						<th width="18%" class="text-center">Alergen May Contain</th>
						<th width="18%" class="text-center">Sumber BB Alergen Contain</th>
						<th width="18%" class="text-center">Alergen Baru</th>
						<th width="18%" class="text-center">Lini yang Terdampak</th>
						<th width="18%" class="text-center">Catatan</th>
					</tr>
				</thead>
				<tbody>
					<td></td>
					<td></td>
					<td></td>
					<td><textarea name="" id="" cols="0" rows="4"></textarea></td>
					<td><textarea name="" id="" cols="0" rows="4"></textarea></td>
					<td><textarea name="" id="" cols="0" rows="4"></textarea></td>
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