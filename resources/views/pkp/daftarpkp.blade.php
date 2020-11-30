@extends('pv.tempvv')
@section('title', 'Daftar PKP')
@section('judulhalaman','Form PKP')
@section('content')

<div class="row">
  <div class="col-md-5 col-xs-12">
		@foreach($data as $data)
    <div class="x_panel" style="min-height:90px">
      @if($hitung==0)
        <a href="{{ route('buatpkp1',$data->id_project)}}" class="btn btn-primary btn-sm" type="button"><li class="fa fa-plus"></li> Add Data</a>
      @endif
      @if(auth()->user()->role->namaRule != 'user_produk' && auth()->user()->role->namaRule != 'kemas')
        @if($data->status_project=="revisi")
          <a href="{{ route('datapengajuan')}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-share"></li> Back</a>
        @elseif($data->status_project=="draf" )
          <a href="{{ route('drafpkp')}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-share"></li> Back</a>
        @elseif($data->status_project=="sent" || $data->status_project=="close" || $data->status_project=="proses")
          <a href="{{ route('listpkp')}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-share"></li> Back</a>
          @if(auth()->user()->role->namaRule == 'pv_lokal')
          <button class="btn btn-success btn-sm"  data-toggle="modal" data-target="#edit"><li class="fa fa-edit"></li> Edit Type PKP</button>
          <!-- modal -->
          <div class="modal" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">                 
                  <h3 class="modal-title" id="exampleModalLabel">Confirm Type PKP
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button> </h3>
                </div>
                <div class="modal-body">
                <form class="form-horizontal form-label-left" method="POST" action="{{ route('edittype',$data->id_project) }}" novalidate>
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
                        @endif
                      </option>
                      @endforeach
                      <option value="1">Maklon</option>
                      <option value="2">Internal</option>
                      <option value="3">Maklon & Internal</option>
                      </select>
                    </div>
                  </div>
                </div>
                @foreach($user as $user)
                  @if($user->role_id=='1' || $user->role_id=='5' || $user->role_id=='14')
                  <input type="hidden" value="{{$user->name}}" name="namatujuan[]" id="namatujuan">
                  <input type="hidden" value="{{$user->email}}" name="emailtujuan[]" id="emailtujuan">
                  @endif
                @endforeach
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> Submit</button>
                  {{ csrf_field() }}
                </div>
                </form>
              </div>
            </div>
          </div>
          <!-- modal selesai -->
          <button class="btn btn-primary btn-sm" title="note" data-toggle="modal" data-target="#data1{{ $data->id_project  }}"><i class="fa fa-edit"></i> Edit Timeline</a></button>
          <!-- Modal -->
          <div class="modal" id="data1{{ $data->id_project  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <form class="form-horizontal form-label-left" method="POST" action="{{ Route('TMubahpkp',$data->id_project)}}" novalidate>
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
          @endif
        @endif
      @elseif( auth()->user()->role->namaRule === 'kemas')
        <a href="{{ route('listprojectpkp')}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-share"></li> Back</a>
      @elseif(auth()->user()->role->namaRule === 'user_produk') 
        <a href="{{ route('listprojectpkp')}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-share"></li> Back</a>
      @endif

      @foreach($datapkp as $pkp)
      @if($pkp->kemas_eksis!=NULL)
      <a class="btn btn-info btn-sm" href="{{ Route('lihatpkp',['id_pkp' => $pkp->id_pkp,'revisi' => $pkp->revisi, 'turunan' => $pkp->turunan]) }}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i> Show</a>
      @elseif($pkp->kemas_eksis==NULL)
      <a class="btn btn-info btn-sm" disabled data-toggle="tooltip" title="Please complete the data, to see the final data"><i class="fa fa-folder-open"></i> Show</a>
      @endif
      @if($pkp->status_pkp=='revisi' || $pkp->status_pkp=='draf')
        @if($pkp->status_data=='active')
        <a class="btn btn-warning btn-sm" href="{{ route('buatpkp', ['id_pkp' => $pkp->id_pkp,'revisi' => $pkp->revisi, 'turunan' => $pkp->turunan]) }}" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i> Edit</a>
        @endif
      @endif
      @endforeach
      
      @if($data->author1->Role->id==1 || $data->author1->Role->id==14)
      @else
        <a href="{{route('pkpklaim',$data->id_project)}}" class="btn btn-primary btn-sm" type="submut"><li class="fa fa-tags"></li> Klaim</a>
      @endif
      
      @if(auth()->user()->role->namaRule === 'user_produk')
      @if($data->workbook>0)
      <a href="{{route('showworkbook',$pkp->id_pkp)}}" class="btn btn-success btn-sm"><li class=" fa fa-eye"></li> Show Workbook</a>
      @elseif($data->workbook==0)
      <a href="{{route('showworkbook',$pkp->id_pkp)}}" class="btn btn-success btn-sm"><li class=" fa fa-plus"></li> Add Workbook</a>
      @endif
      @endif
    </div>

    <div class="x_panel" style="min-height:295px">
      <div class="x_title">
        <h3><li class="fa fa-star"></li> Project Name : {{ $data->project_name}}</h3>
      </div>
      <div class="card-block">
        <div class="x_content">
          <table>
						<thead>
							<tr><td>Brand</td><td> : {{$data->id_brand}}</td></tr>
							<tr><td>Type PKP</td><td> :
                @if($data->type==1)
                Maklon
                @elseif($data->type==2)
                Internal
                @elseif($data->type==3)
                Maklon/Internal
                @endif
              </td></tr>
              <tr><td width="25%">PKP Number</td><td> : {{$data->pkp_number}}{{$data->ket_no}}</td></tr>
              @if($data->datapkp!=null)
              @foreach($data1 as $data)
              <tr><td>Idea</td> <td> : {{$data->idea}}</td></tr>
              <tr><td>Packaging Concept</td><td>: 
                @if($data->kemas_eksis!=NULL)
                (
                @if($data->kemas->tersier!=NULL)
                {{ $data->kemas->tersier }}{{ $pkp->kemas->s_tersier }}
                @elseif($data->kemas->tersier==NULL)
                @endif

								@if($data->kemas->sekunder1!=NULL)
								X {{ $data->kemas->sekunder1 }}{{ $data->kemas->s_sekunder1}}
								@elseif($data->kemas->sekunder1==NULL)
								@endif

								@if($data->kemas->sekunder2!=NULL)
								X {{ $data->kemas->sekunder2 }}{{ $data->kemas->s_sekunder2 }}
								@elseif($data->kemas->sekunder2==NULL)
								@endif

                @if($data->kemas->primer!=NULL)
								X{{ $data->kemas->primer }}{{ $pkp->kemas->s_primer }}
								@elseif($data->kemas->primer==NULL)
								@endif
                )
                @elseif($data->kemas->primer==NULL)
                  @if($data->kemas_eksis==NULL)
                  @endif
                @endif
              </td></tr>
              <tr><td>Launch Deadline</td><td>: {{$data->launch}}{{$data->years}}{{$data->tgl_launch}}</td></tr>
              <tr><td>Sample Deadline</td><td>: {{$data->jangka}}-  {{$data->waktu}}</td></tr>
              <tr><td>PV</td><td> : {{$data->perevisi2->name}}</td></tr>
              @endforeach
              @endif
							<tr><td>Status</td><td> : {{$data->status_data}}</td></tr>
							<tr><td>Created</td><td> : {{$data->created_date}}</td></tr>
						</thead>
					</table><br>
				</div>
      </div>
			@endforeach
    </div>
  </div>

  
  @if(auth()->user()->role->namaRule =='user_produk')
  <div class="col-md-7 col-xs-12">
    <div class="x_panel" style="min-height:380px">
      <div class="x_title">
        <h3><li class="fa fa-list"></li> Approved Sample  </h3>
      </div>
      <div class="card-block">
        <div class="x_content">
					<table class="table table-striped table-bordered">
            <thead>
              <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                <th class="text-center">Versi</th>
                <th class="text-center">Sample</th>
                <th class="text-center">Note</th>
                <th class="text-center">Approval</th>
                <th class="text-center">Information</th>
              </tr>
            </thead>
            <tbody>
              @foreach($sample as $pkp)
              @if($pkp->status=='final')
              <tr style="background-color:springgreen">
              @else
              <tr>
              @endif
                <td class="text-center"></td>
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
  @elseif(auth()->user()->role->namaRule == 'kemas' || auth()->user()->role->namaRule == 'evaluator' || auth()->user()->role->namaRule =='produksi' || auth()->user()->role->namaRule =='lab' || auth()->user()->role->namaRule =='finance')
  <div class="col-md-7 col-xs-12">
    <div class="x_panel" style="min-height:380px">
      <div class="x_title">
        <h3><li class="fa fa-list"></li> List request Feasibility  </h3>
      </div>
      <div class="card-block">
        <div class="x_content">
					<table class="table table-striped table-bordered">
            <thead>
              <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                <th class="text-center" width="10%">Versi</th>
                <th class="text-center">Sample</th>
                <th class="text-center" width="10%">Status</th>
                <th class="text-center" width="10%">Action</th>
              </tr>
            </thead>
            <tbody>
              @if($hformula >= 1)
              @foreach($formula as $pkp)
              @if($pkp->vv=='final')
              <tr style="background-color:springgreen">
              @elseif($pkp->vv=='reject')
              <tr style="background-color:slategray;color:white">
              @else
              <tr>
              @endif
                <td class="text-center">{{ $pkp->versi }}.{{ $pkp->turunan }}</td>
                <td class="text-center">
                  {{$pkp->formula}}
                </td>
                <td class="text-center">
                  @if($pkp->vv=='approve')
                    @if($pkp->status_fisibility=='proses')
                    <span class="label label-warning" style="color:white">Request Feasibility</span>
                    @else
                    <span class="label label-primary" style="color:white">Approve</span>
                    @endif
                  @elseif($pkp->vv=='reject')
                  <span class="label label-danger" style="color:white">Reject</span>
                  @elseif($pkp->vv=='final')
                  <span class="label label-info" style="color:white">Final Approval</span>
                  @endif
                </td>
                <td class="text-center">
                  @if($pkp->vv=='approve')
                    @if($pkp->status_fisibility=='proses')
                      @if(auth()->user()->role->namaRule == 'evaluator')
                      <a href="{{route('myFeasibility',[$pkp->id])}}" class="btn btn-primary btn-sm" title="lanjut tahap feasibility"><li class="fa fa-edit"></li></a>
                      @elseif(auth()->user()->role->namaRule == 'kemas' || auth()->user()->role->namaRule == 'lab' || auth()->user()->role->namaRule == 'maklon')
                      <a href="{{route('workbook.Feasibility',[$pkp->id])}}" class="btn btn-primary btn-sm" title="lanjut tahap feasibility"><li class="fa fa-edit"></li></a>
                      @endif
                    @elseif($pkp->status_fisibility=='selesai')
                    <a href="{{route('myFeasibility',[$pkp->id])}}" class="btn btn-info btn-sm" title="lanjut tahap feasibility"><li class="fa fa-eye"></li></a>
                    @endif
                  @endif
                </td>
              </tr>
              @endforeach
              @endif
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
					
          <table class="table table-striped table-bordered">
            <thead>
              <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                <th class="text-center" width="8%">Versi</th>
                <th class="text-center">Sample</th>
                <th class="text-center" width="30%">Note</th>
                <th class="text-center" width="10%">Status</th>
                <th class="text-center" width="15%">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($formula as $for)
              @if($for!='proses')
              @if($for->vv=='final')
              <tr style="background-color:springgreen">
              @elseif($for->vv=='reject')
              <tr style="background-color:slategray;color:white">
              @else
              <tr>
              @endif
                <td class="text-center">{{$for->versi}}.{{$for->turunan}}</td>
                <td>{{$for->formula}}</td>
                <td>{{$for->catatan_pv}}</td>
                <td class="text-center">
                  @if($for->vv=='proses')
                  <span class="label label-primary" style="color:white">New Sample</span>
                  @elseif($for->vv=='approve')
                    @if($for->status_fisibility=='not_approved')
                      @if($hasilpanel>=1)
                      <span class="label label-info" style="color:white">sample Approved</span>
                      @elseif($hasilpanel==0)
                      <span class="label label-success" style="color:white">Waiting panel Results</span>
                      @endif
                    @elseif($for->status_fisibility=='proses')
                      <span class="label label-warning" style="color:white">Proses Feasibility And Panel</span>
                    @elseif($for->status_fisibility=='selesai')
                      <span class="label label-warning" style="color:white">New Data Feasibility</span>
                    @endif
                  @elseif($for->vv=='reject')
                    <span class="label label-danger" style="color:white">Project rejected</span>
                  @elseif($for->vv=='final')
                  <span class="label label-info" style="color:white">Final data Data</span>
                  @endif
                </td>
                <td class="text-center"> 
                  @if($for->vv=='proses')
                    <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#rejectsample{{ $for->id  }}" title="Reject"><li class="fa fa-times"></li></a>  
                      <!-- Modal -->
                      <div class="modal" id="rejectsample{{ $for->id  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h3 class="modal-title" id="exampleModalLabel">Reject Sample
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button></h3>
                            </div>
                            
                            <div class="modal-body">
                              <form class="form-horizontal form-label-left" method="POST" action="{{route('rejectsample',$for->id)}}">
                                <textarea name="note" id="note" rows="2" class="form-control" required></textarea><br>
                                <div class="modal-footer">
                                <button class="btn btn-sm btn-primary" type="submit"><li class="fa fa-check"></li> submit</button>
                                {{ csrf_field() }}
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Modal Selesai -->
                    <button class="btn btn-success btn-sm" title="Approve" data-toggle="modal" data-target="#fs{{ $for->id  }}"><i class="fa fa-check"></i></a></button>
                      <!-- Modal -->
                      <div class="modal" id="fs{{ $for->id  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h3 class="modal-title" id="exampleModalLabel">Approve Sample
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button></h3>
                            </div>
                            
                            <div class="modal-body">
                              <form class="form-horizontal form-label-left" method="POST" action="{{route('approvesample',$for->id)}}">
                                <textarea name="note" id="note" rows="2" class="form-control" required></textarea><br>
                                <div class="modal-footer">
                                <button class="btn btn-sm btn-primary" type="submit"><li class="fa fa-check"></li> submit</button>
                                {{ csrf_field() }}
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Modal Selesai -->
                  @elseif($for->vv=='approve')
                    @if($for->status_fisibility=='not_approved')
                      @if($hasilpanel>=1)
                      <a href="{{route('finalsample',$for->id)}}" class="btn btn-success btn-sm" title="Final Approva"><li class="fa fa-tag"></li></a>
                      @endif
                    @elseif($for->status_fisibility=='selesai')
                      @if($hasilpanel>=1)
                      <a href="{{route('finalsample',$for->id)}}" class="btn btn-success btn-sm" title="Final Approval"><li class="fa fa-tag"></li></a>
                      @endif
                    @endif
                  @elseif($for->vv=='final')
                    <a href="{{route('unfinalsample',$for->id)}}" class="btn btn-warning btn-sm" title="Unfinal Approve"><li class="fa fa-times"></li> Unfinal</a>
                  @endif
                </td>
              </tr>
              @endif
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