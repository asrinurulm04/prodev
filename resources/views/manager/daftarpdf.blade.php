@extends('manager.tempmanager')
@section('title', 'Daftar PDF')
@section('judulhalaman','Daftar PDF')
@section('content')

<div class="row">
  <div class="col-md-5 col-xs-12">
		@foreach($data as $data)
    <div class="x_panel" style="min-height:95px">
      <a href="{{ route('listpdfrka')}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-share"></li> Back</a>
      @if($data->status_project!='close')
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
              <form class="form-horizontal form-label-left" method="POST" action="{{ route('alihkanpdf',$data->id_project_pdf) }}" novalidate>
                <div class="form-group row">
                  <label class="control-label text-bold col-md-1 col-sm-3 col-xs-12 text-center">Dept1</label>
                  <div class="col-md-11 col-sm-9 col-xs-12">
                    <select name="tujuankirim" class="form-control form-control-line" id="type">
                      <option disabled selected>{{$data->departement->dept}} ({{$data->departement->nama_dept}})</option>
                      @foreach($dept as $dept)
                      @if($dept->Divisi=='RND')
                        <option value="{{$dept->id}}">{{$dept->dept}} ({{$dept->nama_dept}})</option>
                        @endif
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label text-bold col-md-1 col-sm-3 col-xs-12 text-center">Dept2</label>
                  <div class="col-md-11 col-sm-9 col-xs-12">
                    <select name="tujuankirim2" class="form-control form-control-line" id="type">
                      @if($data->tujuankirim2==0)
                      <option value="0" selected>No Departement Selected</option>
                      @elseif($data->tujuanlirim2==1)
                      <option selected>{{$data->departement2->dept}} ({{$data->departement2->nama_dept}})</option>
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
      @foreach($pdf as $data1)
      <a class="btn btn-info btn-sm" href="{{ Route('pdflihat',['id_project_pdf' => $data1->id_project_pdf, 'revisi' => $data1->revisi, 'turunan' => $data1->turunan]) }}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i> Show</a>
      @endforeach
      <?php $last = Date('j-F-Y'); ?>
      @if(Auth::user()->departement->dept!='RKA')
        @if($data->status_terima=='proses')
        @elseif($data->status_terima!='proses')
        <button class="btn btn-dark btn-sm" data-toggle="modal" data-target="#sample{{$data1->id_project_pdf}}"><i class="fa fa-check"></i> Submit Sample</a></button>
        <!-- modal -->
        <div class="modal" id="sample{{$data1->id_project_pdf}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h3 class="modal-title text-left" id="exampleModalLabel">Submit Sample
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></h3>
                </button>
              </div>
              <div class="modal-body">
                <form class="form-horizontal form-label-left" method="POST" action="{{route('samplepdf',$data1->id_project_pdf)}}" novalidate>
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
                    <input type="hidden" value="{{$data1->id_project_pdf}}" name="id">
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
      @endif
    </div>

    <div class="x_panel" style="min-height:310px">
      <div class="x_title">
        <h3><li class="fa fa-star"></li> Project Name : {{ $data->project_name}}</h3>
      </div>
      <div class="card-block">
        <div class="x_content">
          <table>
						<thead>
							<tr><td>Brand</td><td> : {{$data->id_brand}} </td></tr>
							<tr><td>Type</td><td> : {{$data->type->type}} </td></tr>
              <tr><td>PDF Number</td><td> : {{$data->pdf_number}}{{$data->ket_no}} </td></tr>
              <tr><td>Created</td><td> : {{$data->created_date}} </td></tr>
              <tr><td>Priority</td><td> : 
                @if($data->prioritas=='1')
                <span class="label label-danger">High Priority</span>
                @elseif($data->prioritas=='2')
                <span class="label label-warning">Standar Priority</span>
                @elseif($data->prioritas=='3')
                <span class="label label-primary">Low Priority</span>
                @endif
              </td></tr>
							<tr><td>Author</td><td> : {{$data->author1->name}} </td></tr>
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
        <h3><li class="fa fa-list"></li> Sample Submission List </h3>
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