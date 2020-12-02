@extends('pv.tempvv')
@section('title', 'Daftar PDF')
@section('judulhalaman','Daftar PDF')
@section('content')

@foreach($data as $data)
<div class="row">
  <div class="col-md-5 col-xs-12">
    <div class="x_panel">
      @if($hitung==0)
      <a href="{{ route('buatpdf',$data->id_project_pdf)}}" class="btn btn-primary btn-sm" type="button"><li class="fa fa-plus"></li> Add Data</a>
      @endif
      @if(auth()->user()->role->namaRule!='user_produk' && auth()->user()->role->namaRule != 'kemas')
        @if($data->status_project=="revisi")
        <a href="{{ route('datapengajuan')}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-share"></li> Back</a>
        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#data{{ $data->id_project_pdf  }}" ><i class="fa fa-edit"></i> Edit Timeline</a></button>
        <!-- Modal -->
        <div class="modal" id="data{{ $data->id_project_pdf  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
               <h3 class="modal-title" id="exampleModalLabel">Timeline Project : {{$data->project_name}}
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
               </button></h3>
              </div>
              <form class="form-horizontal form-label-left" method="POST" action="{{ Route('TMubahpdf',$data->id_project_pdf)}}" novalidate>    
              <div class="modal-body">
                <div class="row x_panel">
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
                <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</button>
                {{ csrf_field() }}
              </div>
              </form>
            </div>
          </div>
        </div>
        <!-- Modal Selesai -->
        @elseif($data->status_project!="draf" && $data->status_project!="revisi")
        <a href="{{ route('listpdf')}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-share"></li> Back</a>
        @elseif($data->status_project=="draf")
        <a href="{{ route('drafpdf')}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-share"></li> Back</a>
        @endif
      @elseif(auth()->user()->role->namaRule === 'kemas')
      <a href="{{ route('listprojectpdf')}}" class="btn btn-danger btn-sm" btn-sm type="button"><li class="fa fa-share"></li> Back</a>
      @elseif(auth()->user()->role->namaRule === 'user_produk')
      <a href="{{ route('listprojectpdf')}}" class="btn btn-danger btn-sm" btn-sm type="button"><li class="fa fa-share"></li> Back</a>
        <button class="btn btn-dark btn-sm" data-toggle="modal" data-target="#sample{{$data->id_project_pdf}}"><i class="fa fa-check"></i> Submit Sample</a></button>
        <!-- modal -->
        <div class="modal" id="sample{{$data->id_project_pdf}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h3 class="modal-title text-left" id="exampleModalLabel">Submit Sample
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></h3>
                </button>
              </div>
              <div class="modal-body">
                <form class="form-horizontal form-label-left" method="POST" action="{{route('samplepdf',$data->id_project_pdf)}}" novalidate>
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
                      <input type="hidden" value="{{$data->id_project_pdf}}" name="id">
                      <td><input type="text" name='sample[]' class="form-control" /></td>
                      <td><textarea rows="2" type="text" required name='note[]' class="form-control" ></textarea></td>
                      <td>
                      <button id="add_data" type="button" class="btn btn-info btn-sm pull-left tr_clone_add"><li class="fa fa-plus"></li> </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Submit</button>
                  {{ csrf_field() }}
                </div>
              </form>
              </div>
            </div>
          </div>
        </div>
        <!-- Modal Selesai -->
      @endif

      @foreach($pdff as $data)
      @if($data->kemas_eksis!=NULL)
        <a class="btn btn-info btn-sm" href="{{ Route('lihatpdf',['id_project_pdf' => $data->id_project_pdf, 'revisi' => $data->revisi, 'turunan' => $data->turunan]) }}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i> Show</a>
      @elseif($data->kemas_eksis==NULL)
        <a class="btn btn-info btn-sm" disabled data-toggle="tooltip" title="Please complete the data, to see the final data"><i class="fa fa-folder-open"></i> Show</a>
      @endif
        @if($data->status_data=='draf' || $data->status_data=='revisi')
			  <a class="btn btn-warning btn-sm" href="{{ route('buatpdf1',['id_project_pdf' => $data->id_project_pdf, 'revisi' => $data->revisi, 'turunan' => $data->turunan])}}" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i> Edit</a>
        @endif
        {{csrf_field()}}
      @endforeach
    </div>

    <div class="x_panel">
      <div class="x_title">
        <h3><li class="fa fa-star"></li> Project Name : {{ $data->project_name}}</h3>
      </div>
      <div class="card-block">
        <div class="x_content">
          <table>
						<thead>
							<tr><td>Brand</td><td> : {{$data->id_brand}}</td></tr>
							<tr><td>Type</td><td> : {{$data->type->type}}</td></tr>
              <tr><td>PDF Number</td><td> : {{$data->pdf_number}}{{$data->ket_no}}</td></tr>
							<tr><td>Created</td><td> : {{$data->created_date}}</td></tr>
              <tr><td>Author</td><td> : {{$data->author1->name}}</td></tr>
						</thead>
					</table><br>
				</div>
      </div>
    </div>
    @endforeach
  </div>
  @if(auth()->user()->role->namaRule == 'user_produk')
  <div class="col-md-7 col-xs-12">
    <div class="x_panel" style="min-height:380px">
      <div class="x_title">
        <h3><li class="fa fa-list"></li> Sample Submission List  </h3>
      </div>
      <div class="card-block">
        <div class="x_content">
					<table class="table table-striped table-bordered">
            <thead>
              <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                <th class="text-center">No</th>
                <th class="text-center">Sample</th>
                <th class="text-center">Note</th>
                <th class="text-center">Approval</th>
                <th class="text-center">Information</th>
              </tr>
            </thead>
            <tbody>
              @php $no = 0; @endphp
              @foreach($sample as $pkp)
              @if($pkp->status=='final')
              <tr style="background-color:springgreen">
              @else
              <tr>
              @endif
                <td class="text-center">{{++$no}}</td>
                <td>{{ $pkp->sample }}</td>
                <td>{{ $pkp->note}}</td>
                <td class="text-center">
                  @if($pkp->status=='reject')
                  <span class="label label-danger" style="color:white">Reject</span>
                  @elseif($pkp->status=='approve')
                  <span class="label label-primary" style="color:white">Approve</span>
                  @elseif($pkp->status=='send')
                  <span class="label label-warning" style="color:white">Send</span>
                  @elseif($pkp->status=='final')
                  <span class="label label-info" style="color:white">Final Approval</span>
                  @endif
                </td>
                <td>{{ $pkp->catatan_reject}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div> 
  @else
  <div class="col-md-7 col-xs-12">
    <div class="x_panel" style="min-height:435px">
      <div class="x_title">
        <h3><li class="fa fa-list"></li> List Sample Project</h3>
      </div>
      <div class="card-block">
        <div class="x_content">
          <form action="">
					<table class="table table-bordered table-striped table-bordered">
            <thead>
              <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                <th class="text-center">Sample</th>
                <th class="text-center">Note</th>
                <th class="text-center" width="17%">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($sample as $pdf)
              @if($pdf->status=='final')
              <tr style="background-color:springgreen">
              @else
              <tr>
              @endif
                <td>{{ $pdf->sample }}</td>
                <td>{{ $pdf->note }}</td>
                <td class="text-center">
                  @if(auth()->user()->role->namaRule == 'pv_global')
                    @if($pdf->status=='send')
                    <a href="{{route('approvesamplepdf',$pdf->id_sample)}}" class="btn btn-primary btn-sm" title="Approve"><li class="fa fa-check"></li></a>  
                    <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#reject{{ $pdf->id_sample  }}" title="Reject"><li class="fa fa-times"></li></a>  
                    <!-- Modal -->
                    <div class="modal" id="reject{{ $pdf->id_sample  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h3 class="modal-title" id="exampleModalLabel">Reject Sample {{ $pdf->id_sample  }}
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button></h3>
                          </div>
                          
                          <div class="modal-body">
                            <form action=""></form>
                            <form class="form-horizontal form-label-left" method="POST" action="{{route('rejectsamplepdf',$pdf->id_sample)}}">
                              <label for="">Note</label>
                              <textarea name="note" id="note" rows="2" class="form-control" required></textarea>
                            <div class="modal-footer">
                              <button class="btn btn-sm btn-primary" type="submit">submit</button>
                              {{ csrf_field() }}
                            </div>
                          </div>
                        </form>
                        </div>
                      </div>
                    </div>
                    <!-- Modal Selesai -->
                    @elseif($pdf->status=='reject')
                    <span class="label label-danger" style="color:white">sample rejected</span>
                    @elseif($pdf->status=='approve')
                      @if($status_sample==1)
                      <span class="label label-info" style="color:white">sample Approved</span>
                      @else
                      <a href="{{route('finalsamplepdf',[ 'id_project_pdf' => $pdf->id_pdf, 'sample' => $pdf->id_sample])}}" class="btn btn-info btn-sm" title="Final Approval"><li class="fa fa-tag"></li> Final Approval</a>
                      @endif
                    @elseif($pdf->status=='final')
                      <a href="{{route('unfinalsamplepdf',[ 'id_project_pdf' => $pdf->id_pdf, 'sample' => $pdf->id_sample])}}" class="btn btn-warning btn-sm" title="Unfinal Approve"><li class="fa fa-times"></li> Unfinal</a>
                    @endif
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  @endif
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