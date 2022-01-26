@extends('pv.tempvv')
@section('title', 'PRODEV|Draf PKP')
@section('content')

@if (session('status'))
<div class="col-lg-12 col-md-12 col-sm-12">
  <div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{ session('status') }}
  </div>
</div>
@endif

<div class="">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel" style="min-height:500px">
        <div class="x_title">
          <h3><li class="fa fa-file-zip-o"> </li> Template User Email (Launching Project)</h3>
        </div>
        <div class="x_content">
          <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add" type="button"><li class="fa fa-plus"></li><b> Add Email</b></button>
          <!-- add -->
          <div class="modal" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title" id="exampleModalLabel"><li class="fa fa-envelope"></li> Add Email 
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button> </h3>
                </div>
                <form class="form-horizontal form-label-left" method="POST" action="{{ route('addTempemail') }}">
                <div class="modal-body">
                  <div class="form-group row">
                    <label for="middle-name" class="control-label col-md-2 col-sm-3 col-xs-12">Name</label>
                    <div class="col-md-9 col-sm-8 col-xs-12">
                      <input type="text" name="name" id="name" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="middle-name" class="control-label col-md-2 col-sm-3 col-xs-12">Email</label>
                    <div class="col-md-9 col-sm-8 col-xs-12">
                      <input type="text" name="email" id="email" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary btn-sm"><li class="fa fa-check"></li> Submit</button>
                  {{ csrf_field() }}
                </div>
                </form>
              </div>
            </div>
          </div>
          <!-- Selesai -->
          <table id="datatable" class="table table-striped table-bordered" style="width:100%">
            <thead>
              <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                <th class="text-center">#</th>
                <th class="text-center">name</th>
                <th class="text-center">Email</th>
                <th class="text-center">Status</th>
                <th width="11%" class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              @php $no = 0; @endphp
              @foreach($email as $email)
              <tr style="">
                <td class="text-center">{{ ++$no}}</td>
                <td>{{ $email->name }}</td>
                <td>{{ $email->email }}</td>
                <td>{{ $email->status }}</td>
                <td class="text-center">
                  <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#NW{{$email->id}}" type="button"><li class="fa fa-edit"></li></button>
                </td>
              </tr>
              <!-- Edit -->
              <div class="modal" id="NW{{$email->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h3 class="modal-title" id="exampleModalLabel">Edit
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button> </h3>
                    </div>
                    <form class="form-horizontal form-label-left" method="POST" action="{{ route('editTempemail',$email->id) }}">
                    <div class="modal-body">
                      <div class="form-group row">
                        <label for="middle-name" class="control-label col-md-2 col-sm-3 col-xs-12">Name</label>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                          <input type="text" name="name" id="name" value="{{$email->name}}" class="form-control">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="middle-name" class="control-label col-md-2 col-sm-3 col-xs-12">Email</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" name="mail" id="mail" value="{{$email->email}}" class="form-control">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="middle-name" class="control-label col-md-2 col-sm-3 col-xs-12">Status</label>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                          @if($email->status=='active')
                          <input type="radio" name="status" id="status" checked value="active"> Active
                          <input type="radio" name="status" id="status" value="inactive"> inactive
                          @elseif($email->status=='inactive')
                          <input type="radio" name="status" id="status" value="active"> Active
                          <input type="radio" name="status" id="status" checked value="inactive"> inactive
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary btn-sm"><li class="fa fa-check"></li> Submit</button>
                      {{ csrf_field() }}
                    </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- Selesai -->
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
<link href="{{ asset('lib/advanced-datatable/css/jquery.dataTables.css') }}" rel="stylesheet" />
<script src="{{ asset('js/datatables.min.js')}}"></script>
@endsection