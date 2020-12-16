@extends('pv.tempvv')
@section('title', 'Daftar PROMO')
@section('judulhalaman','Daftar PROMO')
@section('content')

<div class="row">
  <div class="col-md-5 col-xs-12">
		@foreach($data as $data)
    <div class="x_panel">
      @if(auth()->user()->role->namaRule == 'pv_lokal')
        @if($data->status_project=="revisi")
          <button class="btn btn-primary btn-sm" title="note" data-toggle="modal" data-target="#data{{ $data->id_pkp_promo  }}"><i class="fa fa-edit"></i> Edit Timeline</a></button>
          <!-- Modal -->
          <div class="modal" id="data{{ $data->id_pkp_promo  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title" id="exampleModalLabel">Timeline Project : {{$data->project_name}}
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button></h3>
                </div>
                <div class="modal-body">
                  <div class="row x_panel">
                    <form class="form-horizontal form-label-left" method="POST" action="{{ Route('TMubah',$data->id_pkp_promo)}}" novalidate>
                    <label class="control-label col-md-3 col-sm-3 col-xs-12 text-center">Deadline for sending Sample</label>
                    <div class="col-md-4 col-sm-9 col-xs-12">
                      <input type="date" class="form-control" value="{{$data->jangka}}" name="jangka" id="jangka" placeholder="start date">
                    </div>
                    <div class="col-md-4 col-sm-9 col-xs-12">
                      <input type="date" class="form-control" value="{{$data->waktu}}" name="waktu" id="waktu" placeholder="end date">
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</button>
                  {{ csrf_field() }}
                </div>
                </form>
              </div>
            </div>
          </div>
          <a href="{{ route('datapengajuan')}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-share"></li> Back</a>
          <!-- Modal Selesai -->
        @elseif($data->status_project=="draf")
          <a href="{{ route('drafpromo')}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-share"></li> Back</a>
        @elseif($data->status_project=="sent" || $data->status_project=="proses")
          <a href="{{ route('listpromo')}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-share"></li> Back</a>
        @endif

      @elseif(auth()->user()->role->namaRule == 'user_produk')
        <a href="{{ route('listprojectpromo')}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-share"></li> Back</a>
        <button class="btn btn-dark btn-sm" data-toggle="modal" data-target="#sample{{$data->id_pkp_promo}}"><i class="fa fa-check"></i> Submit Sample</a></button>
        <!-- modal -->
        <div class="modal" id="sample{{$data->id_pkp_promo}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h3 class="modal-title text-left" id="exampleModalLabel">Submit Sample
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></h3>
                </button>
              </div>
              <div class="modal-body">
                <form class="form-horizontal form-label-left" method="POST" action="{{route('samplepromo',$data->id_pkp_promo)}}" novalidate>
                <table class="table table-bordered table-hover" id="tabledata">
                <thead>
                  <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                    <th class="text-center" >Sample</th>
                    <th class="text-center" >Note</th>
                    <th width="5%"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <input type="hidden" value="{{$data->id_pkp_promo}}" name="id">
                    <td><input type="text" name='sample[]' class="form-control" /></td>
                    <td><textarea rows="2" type="text" required name='note[]' class="form-control" ></textarea></td>
                    <td>
                    <button id="add_data" type="button" class="btn btn-info btn-sm pull-left tr_clone_add"><li class="fa fa-plus"></li> </button>
                    </td>
                  </tr>
                </tbody>
              </table>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-paper-plane"></i> Submit</button>
                  {{ csrf_field() }}
                </div>
              </form>
              </div>
            </div>
          </div>
        </div>
        <!-- Modal Selesai -->
      @endif

      @if($promo==0)
        <a href="{{ route('datapromo',$data->id_pkp_promo)}}" class="btn btn-primary btn-sm" type="button"><li class="fa fa-plus"></li> Add Data</a>
      @endif

      @foreach($pkp as $pkp1)
      <a class="btn btn-info btn-sm" href="{{ Route('lihatpromo',['id_pkp_promo' => $pkp1->id_pkp_promoo, 'revisi' => $pkp1->revisi, 'turunan' => $pkp1->turunan]) }}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i> Show</a>
      @if($pkp1->status_promo=='draf' || $pkp1->status_promo=='revisi')
      <a class="btn btn-warning btn-sm" href="{{ route('datapromo11', ['id_pkp_promo' => $pkp1->id_pkp_promoo, 'revisi' => $pkp1->revisi, 'turunan' => $pkp1->turunan]) }}" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i> Edit</a>
      @endif
      @endforeach
    </div>

    <div class="x_panel" style="min-height:330px">
      <div class="x_title">
        <h3><li class="fa fa-star"></li> Project Name : {{ $data->project_name}}</h3>
      </div>
      <div class="card-block">
        <div class="x_content">
          <table>
						<thead>
							<tr><td>Brand</td><td> : {{$data->brand}}</td></tr>
							<tr><td>Type PKP</td><td> :
              @if($data->type==1)
              Maklon
              @elseif($data->type==2)
              Internal
              @elseif($data->type==3)
              Maklon/Internal
              @endif</td></tr>
              <tr><td>Promo Number</td><td> : {{$data->promo_number}}{{$data->ket_no}}</td></tr>
							<tr><td>Created</td><td> : {{$data->created_date}}</td></tr>
              <tr><td>Author</td><td> : {{$data->author1->name}}</td></tr>
						</thead>
					</table><br>
				</div>
      </div>
			@endforeach
    </div>
  </div>

</div>

@endsection


@section('s')
<script>
  $(document).ready(function() {

		$('#tabledata').on('click', 'tr a', function(e) {

        e.preventDefault();
        var lenRow = $('#tabledata tbody tr').length;
        if (lenRow == 1 || lenRow <= 1) {
            alert("Tidak bisa hapus semua baris!!");
        } else {
            $(this).parents('tr').remove();
        }
    });

  var i = 1;
  $("#add_data").click(function() {
    $('#addrow' + i).html( "<td>"+
			"<input type='text' name='sample[]'class='form-control data' /></td>"+
      "<td><textarea rows='2' type='text' required name='note[]' placeholder='Note' class='form-control' ></textarea></td>"+
			"<td><a href='' class='btn btn-danger btn-sm'><li class='fa fa-trash'></li></a>"+
			"</td>");

    $('#tabledata').append('<tr id="addrow' + (i + 1) + '"></tr>');
    i++;
  });
  });
  
</script>
@endsection