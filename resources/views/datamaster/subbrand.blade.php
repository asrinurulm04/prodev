@extends('pv.tempvv')
@section('title', 'Data SubBrand')
@section('judulhalaman','Data Master')
@section('content')

<div class="row">
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
</div>

<!-- Subbrand -->
<div class="x_panel">
  <div class="x_title">
    <h3><li class="fa fa-list"> List Brand</li></h3>
  </div>
  <div class="card-block">
    <a type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#add_subbrand" id="tambah"><i class="fa fa-plus"></i> Add Subbrand</a>
	  <div class="dt-responsive table-responsive">
      <table class="Table table-striped table-bordered nowrap">
        <thead>
          <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
            <th>ID</th>
            <th>Subbrand</th>
            <th>Brand</th>
            <th class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
        @foreach($subbrands as $subbrand)
          <tr>
            <td>{{ $subbrand->id }}</td>
            <td>{{ $subbrand->subbrand }}</td>
            <td>{{ $subbrand->databrand->brand }}</td>
            <td  class="text-center">
              <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit_subbrand{{ $subbrand->id }}"><i class="fa fa-edit"></i></a></button>
              <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus Subbrand ?')" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"></i></button>
              {!! Form::close() !!}
            </td>
          </tr>
          <!-- Add New  Subbrand-->
          <div class="modal fade" id="edit_subbrand{{ $subbrand->id }}" role="dialog" aria-labelledby="EWBModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="EWBModalLabel"><i class="fa fa-plus"></i> Edit Subbrand
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></h4>
                </div>
                <div class="modal-body">
                  <form method="POST" action="{{ route('update.subbrand',$subbrand->id) }}">
                  <label for="" class="control-label">Subbrand</label>
                  <input class="form-control" id="subbrand" name="subbrand" placeholder="Subbrand" value="{{ $subbrand->subbrand }}" required /><br>
                  <label for="" class="control-label">Brand</label><br>
                  <select id="brand" name="brand" class="form-control">
                    <option value="{{$subbrand->brand_id}}"> {{$subbrand->databrand->brand}}</option>
                    @foreach($brands as $brand) 
                    <option value="{{  $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->brand}}</option>
                    @endforeach
                  </select>
                  {{ csrf_field() }}
                </div>
                <div class="modal-footer">
                  <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-edit"></i> Save</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          {{-- Selesai --}}
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Add New  Subbrand-->
<div class="modal fade" id="add_subbrand" role="dialog" aria-labelledby="EWBModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="EWBModalLabel"><i class="fa fa-plus"></i> Add Subbrand--
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></h4>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('subbrand.store') }}">
        <label for="" class="control-label">Subbrand</label>
        <input class="form-control" id="subbrand" name="subbrand" placeholder="Subbrand" value="{{ old('subbrand') }}" required /><br>
        <label for="" class="control-label">Brand</label><br>
        <select id="brand" name="brand" class="form-control" style="width:450px;">
          @foreach($brands as $brand) 
          <option value="{{  $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->brand}}</option>
          @endforeach
        </select>
        {{ csrf_field() }}
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-plus"></i> Add</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection