@extends('layout.tempvv')
@section('title', 'feasibility|Kemas')
@section('content')

<div class="x_panel">
  <div class="col-md-6"><h4><li class="fa fa-list"></li> Kemas </h4></div>
  <div class="col-md-6" align="right">
    @if($fs->id_project!=NULL)
    <a href="{{ route('workbookfs',[$pkp->id_project,$fs->id])}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-arrow-left"></li> Back</a>
    @elseif($fs->id_project_pdf!=NULL)
    <a href="{{ route('workbookfs',[$pdf->id_project_pdf,$fs->id])}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-arrow-left"></li> Back</a>
    @endif
  </div><hr><hr>
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
            </td>
          </tr>
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

<div class="row">
  <div class="col-md-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h3><li class="fa fa-file"> Konsep Kemas</li></h3>
      </div>
      <div>
      <form id="demo-form2"  class="form-horizontal form-label-left" action="{{route('insert')}}" method="post" enctype="multipart/form-data">
        <div class="form-group row">
          <input type="hidden" name="id_ws" id="id_ws" value="{{$ws}}">
          <input type="hidden" name="fs" id="fs" value="{{$fs->id}}">
          <input type="hidden" name="id" id="id_ws" value="{{$id}}">
          <?php $last = Date('j-F-Y'); ?>
          <input id="last" value="{{ $last }}" type="hidden" name="last">
          <label class=" col-md-1 col-sm-1 col-xs-12">Keterangan</label>
          <div class="col-md-11 col-sm-11 col-xs-12">
            @if($count=='0')<input type="text" class="form-control col-md-8 col-sm-8 col-xs-12" name="keterangan" id="keterangan" required>
            @else<input type="text" value="{{$kemas->keterangan}}" class="form-control col-md-8 col-sm-8 col-xs-12" name="keterangan" id="keterangan" required>
            @endif
          </div>
        </div>
        <div class="form-group row">
          <label class=" col-md-1 col-sm-1 col-xs-12">Batch Size</label>
          <div class="col-md-3 col-sm-3 col-xs-12">
            <input type="text" value="{{$form->batch_size}}" class="form-control col-md-8 col-sm-8 col-xs-12" name="batch" id="batch" readonly>
          </div>
          <label class=" col-md-1 col-sm-1 col-xs-12">Net/Batch</label>
          <div class="col-md-3 col-sm-3 col-xs-12">
            <input type="text" value="{{$yield}}" class="form-control col-md-8 col-sm-8 col-xs-12" name="yield" id="yield" readonly>
          </div>
          <label class=" col-md-1 col-sm-1 col-xs-12">Jml box/batch</label>
          <div class="col-md-3 col-sm-3 col-xs-12">
            @if($count=='0')<input type="number" class="form-control col-md-8 col-sm-8 col-xs-12" name="box_batch" id="box_batch">
            @else<input type="number" value="{{$kemas->jumlah_box}}" class="form-control col-md-8 col-sm-8 col-xs-12" name="box_batch" id="box_batch">
            @endif
          </div>
        </div>
        <div class="form-group row">
          <label class=" col-md-1 col-sm-1 col-xs-12">Box/palet</label>
          <div class="col-md-3 col-sm-3 col-xs-12">
            @if($count=='0')<input type="number" class="form-control col-md-8 col-sm-8 col-xs-12" name="box_palet" id="box_palet" required>
            @else<input type="number" value="{{$kemas->box_palet}}" class="form-control col-md-8 col-sm-8 col-xs-12" name="box_palet" id="box_palet" required>
            @endif
          </div>
          <label class=" col-md-1 col-sm-1 col-xs-12">Referensi</label>
          <div class="col-md-3 col-sm-3 col-xs-12">
            <select name="referensi" id="referensi" class="form-control items">
              @if($count!='0')
              <option value="{{$kemas->referensi}}">{{$kemas->sku->nama_sku}}</option>
              @endif
              @foreach($sku as $sku)
              <option value="{{$sku->id}}">{{$sku->nama_sku}}</option>
              @endforeach
            </select>
          </div>
          <label class=" col-md-1 col-sm-1 col-xs-12">Kubikasi/batch</label>
          <div class="col-md-3 col-sm-3 col-xs-12">
            @if($count=='0')<input type="text" class="form-control col-md-8 col-sm-8 col-xs-12" name="kubikasi" id="kubikasi" required>
            @else<input type="text" value="{{$kemas->kubikasi}}" class="form-control col-md-8 col-sm-8 col-xs-12" name="kubikasi" id="kubikasi" required>
            @endif
          </div>
        </div>
        <div class="form-group row">
          <center>
            <label class=" col-md-2 col-sm-2 col-xs-12">Upload Formula Kemas</label>
            <div class="col-md-8 col-sm-8 col-xs-12">
              <input type="file" class="form-control" name="file">
            </div>
            <label class=" col-md-2 col-sm-2 col-xs-12">Format File (.xlsx)</label>
          </center>
        </div>
        <div class="form-group row">
          <label class=" col-md-2 col-sm-2 col-xs-12"></label>
          <div class="col-md-8 col-sm-8 col-xs-12">
            <a href="{{route('download_template')}}" class="btn btn-warning btn-sm"><li class="fa fa-download"></li> Template Upload Kemas</a>
          </div>
        </div>
        <div class="ln_solid"></div>
        <div class="form-group"><br>
          <center>
            <button type="submit" onclick="return confirm('Yakin Dengan Data Yang Anda Masukan?? ?')" class="btn btn-primary btn-sm"><li class="fa fa-check"></li> Save And Next</button>
            {{ csrf_field() }}
          </center>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
@section('s')
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
<script src="{{ asset('js/select2/select2.min.js') }}"></script>
<script>
	$('.items').select2({
    placeholder: '-->Select One<--',
    allowClear: true
  });
</script>
<script>
  $('#tabledata').on('click', 'tr a', function(e) {
    e.preventDefault();
    var lenRow = $('#tabledata tbody tr').length;
    if (lenRow == 1 || lenRow <= 1) {
        alert("Tidak bisa hapus semua baris!!");
    } else {
        $(this).parents('tr').remove();
    }
  });

  $(document).ready(function() {
    var idmesin = []
		<?php foreach($mesins as $key => $value) { ?>
			if(!idmesin){
				idmesin += [ { '<?php echo $key; ?>' : '<?php echo $value->id_data_mesin; ?>', } ];
			} else { idmesin.push({ '<?php echo $key; ?>' : '<?php echo $value->id_data_mesin; ?>', }) }
		<?php } ?>
		var namamesin = []
		<?php foreach($mesins as $key => $value) { ?>
			if(!namamesin){
				namamesin += [ { '<?php echo $key; ?>' : '<?php echo $value->aktifitas; ?>', } ];
			} else { namamesin.push({ '<?php echo $key; ?>' : '<?php echo $value->aktifitas; ?>', }) }
		<?php } ?>

		var mesin1 = '';
			for(var i = 0; i < Object.keys(namamesin).length; i++){
			mesin1 += '<option value="'+idmesin[i][i]+'">'+namamesin[i][i]+'</option>';
		}

		var i = 1;
		$("#add_data").click(function() {
			$('#addrow' + i).html( "<td>"+
				"<select name='mesin[]' id='mesin' class='form-control items'>"+mesin1+"</select></td>"+
				"<td><input type='text' name='runtime[]' id='runtime' class='form-control' required></td>"+
				"<td><input type='text' name='note[]' id='note' class='form-control' required></td>"+
				"<td><a type='button' class='btn btn-danger btn-sm'><li class='fa fa-trash'></li></a>"+
				"</td>");

			$('#tabledata').append('<tr id="addrow' + (i + 1) + '"></tr>');
			i++;
		});
  });
</script>
@endsection