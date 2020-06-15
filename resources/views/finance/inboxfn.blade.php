@extends('finance.tempfinance')
@section('title', 'feasibility|Finance')
@section('judulnya', 'List Feasibility')
@section('content')

<div class="row mt">
  <div class="col-sm-3">
    <section class="panel">
      <div class="panel-body">
        <a href="" type="submit" class="btn btn-compose btn-lg btn-block" disable>
          <i class="fa fa-pencil"></i>  Compose Mail
          </a>@foreach($dataF as $dF)  
        <ul class="nav nav-pills nav-stacked mail-nav text-center"> Pilih penerima :
          <li><a href="{{ route('komentar',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}"> <i class="fa fa-user"></i>Evaluator</a></li>
          <li><a href="{{ route('pesan',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}"> <i class="fa fa-user"></i>Produksi</a></li>
          <li><a href="{{ route('Kkemas',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}"> <i class="fa fa-user"></i>Kemas</a></li>
        </ul>@endforeach
      </div>
    </section>
  </div>
  <div class="col-sm-9">
    <section class="panel">
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
                    <td> </td>  
                    <td class="text-center">Penerima</td>
                    <td class="text-center">Subject</td>
                    <td class="text-center">Message</td>
                    <td class="text-center">Waktu</td>
                  </tr>
                  @foreach($inboxs as $box)
                  <tr>
                    <td class="inbox-small-cells fa fa-user"></td>  
                    <td>{{ $box->user }}</td>
                    <td>{{ $box->subject }}</td>
                    <td>{{ $box->message }}</td>
                    <td>{{ $box->created_at }}</td>
                  </tr>
                  @endforeach
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    </section>
  </div>
</div>

@endsection