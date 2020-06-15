@extends('finance.tempfinance')
@section('title', 'feasibility|Finance')
@section('judulnya', 'List Feasibility')
@section('content')

<div class="panel-body">
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
        </ul>
        @endforeach
      </div>
    </section>
    <section class="panel">
      <div class="panel-body">
      @foreach($dataF as $dF) 
        <a href="{{ route('inboxfn',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}" type="submit" class="btn btn-info btn-lg btn-block" disable>
          <i class="fa fa-reply"></i> Kembali
        </a>
        @endforeach
      </div>
    </section>
  </div>
  <div class="col-sm-9">
    <section class="panel">
      <header class="panel-heading wht-bg">
        <h4 class="gen-case"> Message</h4>
      </header>
      <div class="panel-body">
        <div class="compose-mail">
          <form role="form-horizontal" method="post" action="{{ route('insertpesan',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}">
            <div class="form-group">
              <label for="to" class="">To:</label>
              <div class="col-md-10 col-sm-11 col-xs-12">
                <input type="text" name="user" maxlength="45" required="required" value="Produksi" class="form-control1 col-md-7 col-xs-12" disabled>
              </div>
            </div>
            <div class="col-md-1 col-sm-1 col-xs-12">
              <input type="hidden" name="status" maxlength="45" required="required" value="selesai" class="form-control col-md-7 col-xs-12">
            </div>
            <div class="col-md-1 col-sm-1 col-xs-12">
              <input type="hidden" name="finance" maxlength="45" required="required" value="{{$fe->id_feasibility}}" class="form-control col-md-7 col-xs-12">
            </div>
            <div class="form-group">
              <label for="subject" class="">Subject:</label>
              <input type="text" tabindex="1" id="subject" class="form-control1" name="sub" required="required">
            </div>
            <div class="compose-editor">
              <textarea name="mail" class="form-control" rows="15" required="required"></textarea>
            </div>
            <div class="compose-btn">
              <button type="submit" class="btn btn-success">Send</button>
			        {{ csrf_field() }}
            </div>
          </form>
        </div>
      </div>
    </section>
  </div>
</div>

@endsection