@extends('pv.tempvv')
@section('title', 'Request PKP')
@section('judulhalaman','Request PKP')
@section('content')

@if (session('status'))
<div class="col-lg-12 col-md-12 col-sm-12">
  <div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{ session('status') }}
  </div>
</div>
@elseif(session('error'))
<div class="col-lg-12 col-md-12 col-sm-12">
  <div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{ session('error') }}
  </div>
</div>
@endif

<div class="row">
  @include('formerrors')
  <div class="col-md-3"></div>
  <div class="col-md-8">
    <div class="tabbable">
      <ul class="nav nav-tabs wizard">
        <li class="completed"><a href="" ><span class="nmbr">1</span>information</a></li>
        <li class="active"><a href=""><span class="nmbr">2</span>PDF</a></li>
        <li class="active"><a href=""><span class="nmbr">3</span>File & Image</a></li>
      </ul>
    </div>
  </div>
</div><br>

<div class="row">
  <div class="col-md-12 col-xs-12">
    <table class="table table-bordered">
      <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
        <td>Information</td>
        <td>* : Diisi oleh marketing</td>
        <td>^ : Diisi oleh PV</td>
        <td>** : Boleh Diisi Oleh Marketing atau PV</td>
      </tr>
    </table>
  </div>
</div>

@foreach($pdf as $pdf)
<div class="">
  <form class="form-horizontal form-label-left" method="POST" action="{{ route('pertama',$pdf->id_project_pdf) }}" novalidate>
  <div class="row">
    <div class="col-md-6 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h3><li class="fa fa-file-archive-o"></li> {{$pdf->project_name}}</h3>
        </div>
        <div class="card-block">
          <div class="x_content">
            <div class="col-md-12 col-xs-12">
              <div class="form-group row">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" style="color:#258039">Created Date**</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input disabled value="{{$pdf->created_date}}" id="last" class="form-control col-md-12 col-xs-12" name="last" required="required" type="text">
                </div>
              </div>
              <div class="form-group row">
              <input type="hidden" name="edit" value="{{$pdf->edit}}">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" style="color:#258039">Project name**</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input id="name" value="{{$pdf->project_name}}" class="form-control col-md-12 col-xs-12" type="text" name="name">
                </div>
              </div>
              <div class="form-group row">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" style="color:#258039">County**</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input id="revisi" value="{{$pdf->country}}" class="form-control col-md-12 col-xs-12" type="text" name="country">
                </div>
              </div>
              <div class="form-group row">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" style="color:#258039">Type**</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input id="revisi" value="{{$pdf->type->type}}" disabled class="form-control col-md-12 col-xs-12" type="text" name="revisi">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-xs-12">
      <div class="x_panel" style="min-height:280px">
        <div class="x_title">
          <h3><li class="fa fa-file-archive-o"></li> {{$pdf->project_name}}</h3>
        </div>
        <div class="form-group row">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" style="color:#258039">type project**</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input id="name" value="{{ $pdf->product_type }}" disabled class="form-control col-md-12 col-xs-12" type="text" name="name" required>
          </div>
        </div>
        <div class="form-group row">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" style="color:#258039">Brand **</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <select name="brand" id="brand" class="form-control">
              <option value="{{ $pdf->id_brand }}" readoly selected>{{ $pdf->id_brand }}</option>
              @foreach($brand as $brand)
              <option value="{{$brand->brand}}">{{$brand->brand}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <input id="author" disabled value="{{ $pdf->author }}" class="form-control col-md-12 col-xs-12" type="hidden" name="author">
				<?php $date = Date('j-F-Y'); ?>
        <input id="perevisi" value="{{ Auth::user()->id }}" readonly class="form-control col-md-12 col-xs-12" type="hidden" name="perevisi">
        <input required id="date" value="{{$date}}" required="required" class="form-control col-md-12 col-xs-12" type="hidden" name="date">
        <div class="form-group row">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" style="color:#258039">Request**</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input id="perevisi" value="{{ $pdf->reference }}" class="form-control col-md-12 col-xs-12" type="text" name="request">
				  </div>
        </div>
        <div class="form-group row">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" style="color:#258039">Last Update**</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
            <input id="perevisi" readonly value="{{ $pdf->last_update }}" class="form-control col-md-12 col-xs-12" type="text" name="">
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
<div class="x_panel">
  <div class="card-block col-md-6 col-md-offset-5">
    <a href="{{route('rekappdf',$pdf->id_project_pdf)}}" type="button" class="btn btn-danger">Back</a>
    <button type="submit" class="btn btn-primary">Save And Next</button>
    {{ csrf_field() }}
  </div>
</div>
  @endforeach
  </form>
</div>
@endsection
