@extends('layout.tempvv')
@section('title', 'feasibility|Proses')
@section('content')

<div class="row">
  <div class="col-md-12 col-xs-12">
    <div class="x_panel">
      <div class="col-md-6"><h4><li class="fa fa-flask"></li> Workbook </h4></div>
      <div class="col-md-6" align="right">
        <a href="{{route('datamesin',[$pkp->id_project,$fs->id,$ws])}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-arrow-left"></li> Back</a>
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
  <div class="col-md-12 col-sm-12 col-xs-12 form-panel">
    <div class="x_panel">
      <div class="x_title">
        <h3><li class="fa fa-usd"> Information</li></h3>
      </div>
      <!-- table pilih mesin -->
      <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{route('ohOther')}}" method="post">
      <table id="tabledata" class="table table-striped table-bordered nowrap">
        <thead>
          <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
            <th width="30%" class="text-center">Informasi Biaya Lain-Lain</th>
            <th width="10%" class="text-center">Curren</th>
            <th width="17%" class="text-center">Nominal</th>
            <th width="35%" class="text-center">Note</th>
            <th width="15%" class="text-center"></th>
          </tr>
        </thead>
        <tbody>
          <input type="hidden" value="{{$ws}}" name="id_ws" id="id_ws">
          <input type="hidden" value="{{$fs->id}}" name="fs" id="fs">
          <input type="hidden" value="{{$pkp->id_project}}" name="id" id="id">
          @foreach($dataO as $dO)
          <tr>
            <td><input type="text" name="mesin[]" id="mesin" class="form-control" value="{{$dO->mesin}}"></td>
            <td>
              <select name="curren[]" id="curren" class="form-control">
                <option value="{{$dO->Curren}}">{{$dO->Curren}}</option>
                @foreach($Curren as $cs)
                <option value="{{$cs->currency}}">{{$cs->currency}}</option>
                @endforeach
              </select>
            </td>
            <td><input type="number" name="nominal[]" id="nominal" class="form-control" value="{{$dO->nominal}}"></td>
            <td><textarea name="note[]" id="note" rows="3" class="form-control" value="{{$dO->note}}">{{$dO->note}}</textarea></td>
            <td class="text-center">
              <a class='btn btn-danger btn-sm'><li class='fa fa-trash'></li></a>
              <button id="add_data" type="button" class="btn btn-info btn-sm pull-left tr_clone_add"><li class="fa fa-plus"></li> </button>
            </td>
          </tr>
          @endforeach
          @if($countO=='0')
          <tr>
            <td><input type="text" name="mesin[]" id="mesin" class="form-control"></td>
            <td>
              <select name="curren[]" id="curren" class="form-control">
                @foreach($Curren as $cs)
                <option value="{{$cs->currency}}">{{$cs->currency}}</option>
                @endforeach
              </select>
            </td>
            <td><input type="number" name="nominal[]" id="nominal" class="form-control"></td>
            <td><textarea name="note[]" id="note" rows="3" class="form-control"></textarea></td>
            <td class="text-center">
              <button id="add_data" type="button" class="btn btn-info btn-sm pull-left tr_clone_add"><li class="fa fa-plus"></li> </button>
            </td>
          </tr>
          @endif
        </tbody>
      </table>
      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">                        
        <button type="submit" class="btn btn-primary btn-sm" onclick="return confirm('Yakin Dengan Data Yang Anda Masukan??')"><li class="fa fa-check"></li> Save And Next</button>
        {{ csrf_field() }}
      </div>
      </form>
    </div>
  </div>
</div>

@endsection
@section('s')
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

  var nama = []
	<?php foreach($Curren as $key => $value) { ?>
		if(!nama){
			nama += [ { '<?php echo $key; ?>' : '<?php echo $value->currency; ?>', } ];
		} else { nama.push({ '<?php echo $key; ?>' : '<?php echo $value->currency; ?>', }) }
	<?php } ?>

	var curren = '';
		for(var i = 0; i < Object.keys(nama).length; i++){
		curren += '<option value="'+nama[i][i]+'">'+nama[i][i]+'</option>';
	}

  var i = 1;
		$("#add_data").click(function() {
			$('#addrow' + i).html( "<td><input type='text' name='mesin[]' placeholder='Mesin ' class='form-control data' /></td>"+
				"<td><select name='curren[]' class='form-control items'>"+curren+"</select></td>"+
				"<td><input type='number' required name='nominal[]' placeholder='Nominal' class='form-control' /></td>"+
				"<td><textarea type='text' required name='note[]' placeholder='Note' class='form-control' rows='3'></textarea></td>"+
				"<td class='text-center'><a class='btn btn-danger btn-sm'><li class='fa fa-trash'></li></a>"+
				"</td>");

			$('#tabledata').append('<tr id="addrow' + (i + 1) + '"></tr>');
			i++;
		});
</script>
@endsection