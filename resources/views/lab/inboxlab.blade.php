@extends('lab.templab')
@section('title', 'feasibility|Lab')
@section('judulnya', 'List Feasibility')
@section('content')
<!-- page start-->
<div class="row mt">
  <div class="col-md-12 col-sm-12 col-xs-12 content-panel">
	  <div class="panel panel-default">
		  <div class="panel-heading">
			  <h2>Inbox</h2>
		  </div>
      <div class="panel-body minimal">
        <div class="table-inbox-wrap ">
          <table class="table table-inbox table-hover">
            <tbody>
              <tr class="unread">
                <tr>
                  <td></td>
                  <td class="text-center">Pengirim</td>
                  <td class="text-center">Subject</td>
                  <td class="text-center"></td>
                  <td class="text-center">Waktu</td>
                  <td></td>
                </tr>
                @foreach($inboxs as $box)
                <tr> 
                  <td class="inbox-small-cells"><i class="fa fa-star"></i></td>
                  <td class="text-center">{{ $box->pengirim }}</td>
                  <td class="text-center">{{ $box->subject }}</td>
                  <td class="view-message  inbox-small-cells"><i class="fa fa-paperclip"></i></td>
                  <td class="text-center">{{ $box->created_at }}</td>
                  <td class="text-center"><button type="button" class="btn btn-warning fa fa-folder-open" data-toggle="modal" data-target="#exampleModal{{ $box->id }}" data-toggle="tooltip" data-placement="top" title="Edit"></button>
                    <div class="modal fade" id="exampleModal{{ $box->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content text-left ">
                          <div class="modal-header">
                            <h3 class="modal-title" id="exampleModalLabel">	Message
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button><h3>
                          </div>
                          <div class="modal-body">
                            <form >
                            <div class="form-group">
                              <label for="recipient-name" class="col-form-label">Pengirim : {{ $box->pengirim }}</label>
                            </div>
                            <div class="form-group">
                              <label for="recipient-name" class="col-form-label">subject : {{ $box->subject}}</label>
                            </div>
                            <div class="form-group">
                              <textarea name="mail" value="{{$box->message}}" class="form-control" rows="10" disabled>{{$box->message}}</textarea>
                            </div>
                          </div>
                          <div class="modal-footer">
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  <a href="{{ route('delete', $box->id) }}" class="btn btn-danger fa fa-trash-o" data-toggle="tooltip" data-placement="top" title="Hapus"></a>
                </tr>
                @endforeach
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection