@extends('layout.tempvv')
@section('title', 'feasibility|Lab')
@section('content')

<div class="row">
  <div class="col-md-12 col-xs-12">
    <div class="x_panel">
      <div class="col-md-6"><h4><li class="fa fa-flask"></li> Workbook </h4></div>
      <div class="col-md-6" align="right">
        <a href="{{ route('listPkpFs',$pkp->id_project)}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-arrow-left"></li> Back</a>
      </div>
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
    </div>
  </div>  
</div>

<div class="row">
  <div class="col-md-5 col-sm-5 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h3><li class="fa fa-list"> Item Desc</li></h3>
      </div>
      <br>
      <div>
        <table class="table table-bordered">
          <thead>
            <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
              <th class="text-center">#</th>
              <th class="text-center">Item Desc</th>
            </tr>
          </thead>
          <tbody>
            @foreach($desc as $desc)
            <tr>
              <td width="5%"><input type="radio" name="desc" id="desc" value="{{$desc->id}}"></td>
              <th> {{$desc->item_desc}}</th>
            </tr>
            @endforeach
          </tbody>
        </table>
        
      </div>
    </div>
  </div>

  <div class="col-md-7 col-sm-7 col-xs-12 card">
    <div class="x_panel">
      <div class="x_title">
        <h3><li class="fa fa-outdent"> Detail Item Desc</li> </h3>
      </div>
      <div class="form-group row" style="overflow-x: scroll;min-height:250px">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <form action="" method="post">
          <table id="myTable" class="table table-hover table-bordered">
            <thead>
              <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                <th class="text-center">Jenis Mikroba</th>
                <th class="text-center">Harian</th>
                <th class="text-center" width="15%">Jlh Analisa</th>
                <th class="text-center">Tahunan</th>
                <th class="text-center" width="15%">Jlh Analisa</th>
                <th class="text-center">Input kode</th>
                <th class="text-center">rate</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
          <center>
            <a href="{{route('AddItem',[$pkp->id_project,$fs])}}" class="btn btn-warning btn-sm" type="button"> <li class="fa fa-plus"></li> New Desc</a>
            <button type="submit" onclick="return confirm('Yakin Dengan Data Yang Anda Masukan??')" class="btn btn-primary btn-sm"><li class="fa fa-check"></li> Use Item Desc</button>
            {{ csrf_field() }}
          </center>  
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->

@endsection

@section ('s')
<script src="{{asset('/js/jquery.cookie.js')}}" charset="utf-8"></script>
@endsection