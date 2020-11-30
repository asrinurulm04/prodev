@extends('manager.tempmanager')
@section('title', 'Daftar PKP')
@section('judulhalaman','Form PKP')
@section('content')

<div class="row">
  <div class="col-md-5 col-xs-12">
		@foreach($listpkp as $listpkp)
    <div class="x_panel" style="min-height:90px">
      <a href="{{ route('listpkprka')}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-share"></li> Back</a>
      @if($listpkp->status_terima!='proses' || $listpkp->status_terima2!='proses')
        @if(Auth::user()->departement->dept!='RKA')
        <button class="btn btn-success btn-sm"  data-toggle="modal" data-target="#edit"><li class="fa fa-edit"></li> Edit Type PKP</button>
        <!-- modal -->
        <div class="modal" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">                 
                <h3 class="modal-title" id="exampleModalLabel">Edit Type PKP
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button> </h3>
              </div>
              <div class="modal-body">
              <form class="form-horizontal form-label-left" method="POST" action="{{ route('edittype',$listpkp->id_project) }}" novalidate>
                <div class="form-group row">
                  <label class="control-label text-bold col-md-1 col-sm-3 col-xs-12 text-center">Type</label>
                  <div class="col-md-11 col-sm-9 col-xs-12">
                    <select name="type" class="form-control form-control-line" id="type">
                    @foreach($pkp1 as $pkp1)
                    <option disabled selected value="{{$pkp1->type}}">
                    @if($pkp1->type==1)
                    Maklon
                    @elseif($pkp1->type==2)
                    Internal
                    @elseif($pkp1->type==3)
                    Maklon/Internal
                    @endif</option>
                    @endforeach
                    <option value="1">Maklon</option>
                    <option value="2">Internal</option>
                    <option value="3">Maklon & Internal</option>
                    </select>
                  </div>
                  @foreach($user as $user)
                  @if($user->role_id=='1' || $user->role_id=='5' || $user->role_id=='14')
                  <input type="hidden" value="{{$user->name}}" name="namatujuan[]" id="namatujuan">
                  <input type="hidden" value="{{$user->email}}" name="emailtujuan[]" id="emailtujuan">
                  @endif
                  @endforeach
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Submit</button>
                {{ csrf_field() }}
              </div>
              </form>
            </div>
          </div>
        </div>
        <!-- modal selesai -->
        @endif
      @endif
      @if($listpkp->status_project!='close' && $listpkp->status_project!='revisi')
      <button class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#alihkan"><li class="fa fa-paper-plane"></li> Divert Project</button>
      <!-- modal -->
      <div class="modal" id="alihkan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">                 
              <h3 class="modal-title" id="exampleModalLabel">Divert Project
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button> </h3>
            </div>
            <div class="modal-body">
            <form class="form-horizontal form-label-left" method="POST" action="{{ route('alihkan',$listpkp->id_project) }}" novalidate>
              <div class="form-group row">
                <label class="control-label text-bold col-md-1 col-sm-3 col-xs-12 text-center">Dept1</label>
                <div class="col-md-11 col-sm-9 col-xs-12">
                  <select name="tujuankirim" class="form-control form-control-line" id="type">
                  <option disabled selected>{{$listpkp->departement->dept}} ({{$listpkp->departement->nama_dept}})</option>
                  @foreach($dept as $dept)
                    <option value="{{$dept->id}}">{{$dept->dept}} ({{$dept->nama_dept}})</option>
                  @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="control-label text-bold col-md-1 col-sm-3 col-xs-12 text-center">Dept2</label>
                <div class="col-md-11 col-sm-9 col-xs-12">
                  <select name="tujuankirim2" class="form-control form-control-line" id="type">
                  @if($listpkp->tujuankirim2==0)
                    <option value="0" disabled selected>No Departement Selected</option>
                    @elseif($listpkp->tujuanlirim2==1)
                    <option selected>{{$listpkp->departement2->dept}} ({{$listpkp->departement2->nama_dept}})</option>
                    
                    @endif<option value="1">RKA</option>
                    <option value="0">No Departement Selected</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Submit</button>
              {{ csrf_field() }}
            </div>
            </form>
          </div>
        </div>
      </div>
      <!-- modal selesai -->
      @endif
      @foreach($datapkp as $pkp)
        @if($pkp->datapkpp->type==1 && $pkp->gambaran_proses==NULL)
          <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#maklon{{$pkp->id_pkp}}" totle="show"><i class="fa fa-folder-open"></i></a> Show</button>
          {{-- modal --}}
          <div class="modal" id="maklon{{$pkp->id_pkp}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title text-left" id="exampleModalLabel">Tambah Data Maklon
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></h3>
                  </button>
                </div>
                <div class="modal-body">
                  <form class="form-horizontal form-label-left" method="POST" action="{{ Route('Gproses',['id_pkp' => $pkp->id_pkp, 'revisi' => $pkp->revisi, 'turunan' => $pkp->turunan]) }}" novalidate>
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-3 col-xs-12">Gambaran Proses</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <textarea name="proses" id="proses"30" rows="5" class="form-control col-md-12 col-xs-12"></textarea>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Submit</button>
                    {{ csrf_field() }}
                  </div>
                </form>
                </div>
              </div>
            </div>
          </div>
        @else
          <a class="btn btn-info btn-sm" href="{{ Route('pkplihat',['id_pkp' => $pkp->id_pkp, 'revisi' => $pkp->revisi, 'turunan' => $pkp->turunan]) }}" data-toggle="tooltip" title="show"><i class="fa fa-folder-open"></i> Show</a>
        @endif
      @endforeach
      <?php $last = Date('j-F-Y'); ?>
      @if(Auth::user()->departement->dept!='RKA')
        @if($listpkp->status_terima=='proses')
        <form class="form-horizontal form-label-left" method="POST" action="{{ route('approve1',$listpkp->id_project) }}" novalidate>
          <input type="hidden" value="{{$last}}" name="tgl">
          {{-- <button type="submit" class="btn btn-dark btn-sm"><li class="fa fa-check"></li> Approve data</button> --}}
          {{ csrf_field() }}
        </form>
        @endif
      @elseif(Auth::user()->departement->dept=='RKA')
        @if($listpkp->status_terima2=='proses')
        <form class="form-horizontal form-label-left" method="POST" action="{{ route('approve2',$listpkp->id_project) }}" novalidate>
          <input type="hidden" value="{{$last}}" name="tgl">
          {{-- <button type="submit" class="btn btn-dark btn-sm"><li class="fa fa-check"></li> Approve data</button> --}}
          {{ csrf_field() }}
        </form>
        @endif
      @endif
    </div>

    <div class="x_panel" style="min-height:280px">
      <div class="x_title">
        <h3><li class="fa fa-star"></li> Project Name : {{ $listpkp->project_name}}</h3>
      </div>
      <div class="card-block">
        <div class="x_content">
          <table>
						<thead>
							<tr><td>Brand</td><td>: </td><td> {{$listpkp->id_brand}}</td></tr>
							<tr><td>Type PKP</td><td>: </td><td> 
              @if($listpkp->type==1)
              Maklon
              @elseif($listpkp->type==2)
              Internal
              @elseif($listpkp->type==3)
              Maklon/Internal
              @endif</td></tr>
              <tr><td width="20%">PKP Number</td><td>: </td><td> {{$listpkp->pkp_number}}{{$listpkp->ket_no}}</td></tr>
              <tr><td>Last Update</td><td>: </td><td> {{ $listpkp->last_update}}</td></tr>
              <tr><td>Created</td><td>: </td><td> {{$listpkp->created_date}}</td></tr>
              <tr><td>Prioritas</td><td>: </td><td> 
                @if($listpkp->prioritas=='1')
                <span class="label label-danger">High Priority</span>
                @elseif($listpkp->prioritas=='2')
                <span class="label label-warning">Standar Priority</span>
                @elseif($listpkp->prioritas=='3')
                <span class="label label-primary">Low Priority</span>
                @endif  
              </td></tr>
              <tr><td>Perevisi</td><td>:</td><td> {{$listpkp->perevisi2->name}}</td></tr>
              <tr><td>Idea</td><td>:</td> <td> {{$listpkp->idea}}</td></tr>
              <tr><td>Packaging</td><td> : </td><td>
              @if($listpkp->kemas_eksis!=NULL)
                            (
                            @if($listpkp->kemas->tersier!=NULL)
                            {{ $listpkp->kemas->tersier }}{{ $pkp->kemas->s_tersier }}
                            @elseif($listpkp->kemas->tersier==NULL)
                            @endif

														@if($listpkp->kemas->sekunder1!=NULL)
														X {{ $listpkp->kemas->sekunder1 }}{{ $listpkp->kemas->s_sekunder1}}
														@elseif($listpkp->kemas->sekunder1==NULL)
														@endif

														@if($listpkp->kemas->sekunder2!=NULL)
														X {{ $listpkp->kemas->sekunder2 }}{{ $listpkp->kemas->s_sekunder2 }}
														@elseif($listpkp->kemas->sekunder2==NULL)
														@endif

                            @if($listpkp->kemas->primer!=NULL)
														X{{ $listpkp->kemas->primer }}{{ $pkp->kemas->s_primer }}
														@elseif($listpkp->kemas->primer==NULL)
														@endif
                            )
                            @elseif($listpkp->kemas->primer==NULL)
                              @if($listpkp->kemas_eksis==NULL)
                              @endif
                            @endif
              </td></tr>
						</thead>
					</table><br>
        </div>
      </div>
			@endforeach
    </div>
  </div>    

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
              @php
                $no = 0;
              @endphp
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