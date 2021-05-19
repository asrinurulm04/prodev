@extends('pv.tempvv')
@section('title', 'PRODEV|Request PKP Promo')
@section('content')

@if (session('status'))
<div class="col-lg-12 col-md-12 col-sm-12">
  <div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{ session('status') }}
  </div>
</div>
@endif

<div class="row">
  <div class="col-md-12 col-xs-12">
    <table class="table table-bordered">
      <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
        <td>Mandatory Information</td>
        <td>* : Filled by Marketing</td>
        <td>^ : Filled By PV</td>
        <td>** : Filled by Marketing Or PV</td>
      </tr>
    </table>
  </div>
</div>

<div class="">
  <form class="form-horizontal form-label-left" method="POST" action="{{ route('isipromo') }}" novalidate>
  <div class="row">
    <div class="col-md-6 col-xs-12">
      <div class="x_panel" style="min-height:240px">
        <div class="x_title">
          <h3><li class="fa fa-file-archive-o"></li> Project</h3>
        </div>
        <div class="card-block">
          <div class="x_content">
            <div class="form-group row">
            <?php  $last = Date('j-F-Y');  ?>
              <label class="control-label col-md-3 col-sm-3 col-xs-12" style="color:#258039">Created date**</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input readonly value="{{ $last }}" id="create" class="form-control col-md-12 col-xs-12" name="create" required="required" type="text">
              </div>
            </div>
            <div class="form-group row">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" style="color:#258039">Country**</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input id="county" class="form-control col-md-12 col-xs-12" type="text" name="county">
              </div>
            </div>
            <div class="form-group row">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" style="color:#258039">Promo Type**</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input required id="promo" class="form-control col-md-12 col-xs-12" type="text" name="promo">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

		<div class="col-md-6">
      <div class="x_panel" style="min-height:240px">
        <div class="x_title">
          <h3><li class="fa fa-file-archive-o"></li> Project</h3>
        </div>
        <div class="card-block">
          <div class="form-group row">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" style="color:#258039">Project Name**</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input required id="name" onkeyup="this.value = this.value.toUpperCase()" class="form-control col-md-12 col-xs-12" type="text" name="name" required>
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" style="color:#258039">Brand**</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <select required id="brand" name="brand" class="form-control" >
                <option disabled selected>-- Select One --</option>
                @foreach($brand as $brand)
                <option value="{{  $brand->brand }}">{{  $brand->brand }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <input readonly id="author" readonly value="{{ Auth::user()->id }}" class="form-control col-md-12 col-xs-12" type="hidden" name="author">
          <div class="form-group row">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" style="color:#258039">Type PKP**</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <select required id="type" name="type" class="form-control" >
                <option disabled selected>-- Select One --</option>
                <option value="1">Maklon</option>
                <option value="2">Internal</option>
                <option value="3">Maklon & Internal</option>
              </select>
            </div>
          </div>
        </div>
      </div>
		</div>
  </div>

  <div class="x_panel">
    <div class="card-block col-md-6 col-md-offset-5">
      <button type="reset" class="btn btn-warning btn-sm"><li class="fa fa-repeat"></li> Reset</button>
      <button type="submit" class="btn btn-primary btn-sm"><li class="fa fa-check"></li> Submit And Next</button>
      {{ csrf_field() }}
    </div>
  </div>
  </form>
</div>
@endsection