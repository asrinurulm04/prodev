@extends('layout.tempvv')
@section('title', 'PRODEV|Data SubKategori')
@section('content')

<div class="row">
  @if (session('status'))
  <div class="col-lg-12 col-md-12 col-sm-12">
    <div class="alert alert-success">
      <button type="button" class="close" data-dismiss="alert">×</button>
      {{ session('status') }}
    </div>
  </div>
  @endif
</div>

<!-- SubKategori -->
<div class="x_panel">
  <div class="x_title">
    <h3><li class="fa fa-list"> List SubKategori</li></h3>
  </div>
  <div class="card-block">
    <a type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#add_subkategori"><i class="fa fa-plus"></i> Add SubKategori </a>
	  <div class="dt-responsive table-responsive">
      <table id="datatable" class="Table table-striped table-bordered nowrap">
        <thead>
          <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
            <th>ID</th>
            <th>Subkategori</th>
            <th>Kategori</th>
            <th width="15%" class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
        @foreach($subkategoris as $subkategori)
          <tr>
            <td>{{ $subkategori->id }}</td>
            <td>{{ $subkategori->subkategori }}</td>
            <td>{{ $subkategori->kategori->kategori }}</td>
            <td class="text-center">
              <button class="btn-primary btn-sm" data-toggle="modal" data-target="#edit_subkategori{{ $subkategori->id }}" data-toggle="tooltip" title="edit"><i class="fa fa-edit"></i></a></button>
            </td>
          </tr>
          <!-- Add New SubKategori-->
          <div class="modal fade" id="edit_subkategori{{ $subkategori->id }}" role="dialog" aria-labelledby="EWBModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="EWBModalLabel"><i class="fa fa-plus"></i> Edit Subkategori
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></h4>
                </div>
                <form method="POST" action="{{ route('subkategori.update',$subkategori->id) }}">
                <div class="modal-body">
                  <label for="" class="control-label">SubKategori</label>
                  <input class="form-control" id="subkategori" name="subkategori" placeholder="SubKategori" value="{{ $subkategori->subkategori }}" required />
                  <label for="" class="control-label">Kategori</label><br>
                  <select id="kategori" name="kategori" class="form-control" style="width:500px;">
                    @foreach($kategoris as $kategori) 
                    <option value="{{  $kategori->id }}">{{ $kategori->kategori}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="modal-footer">
                  <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-edit"></i> Submit</button>
                  {{ csrf_field() }}
                  {{ method_field('PATCH') }}
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

<!-- Add New SubKategori-->
<div class="modal fade" id="add_subkategori" role="dialog" aria-labelledby="EWBModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="EWBModalLabel"><i class="fa fa-plus"></i> Add Subkategori
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></h4>
      </div>
      <form method="POST" action="{{ route('subkategori.store') }}">
      <div class="modal-body">
        <label for="" class="control-label">SubKategori</label>
        <input class="form-control" id="subkategori" name="subkategori" placeholder="SubKategori" value="{{ old('subkategori') }}" required />
        <label for="" class="control-label">Kategori</label><br>
        <select id="kategori" name="kategori" class="form-control" style="width:500px;">
        @foreach($kategoris as $kategori) 
        <option value="{{  $kategori->id }}">{{ $kategori->kategori}}</option>
        @endforeach
        </select>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-plus"></i> Submit</button>
        {{ csrf_field() }}
      </div> 
      </form> 
    </div>
  </div>
</div>
<!-- Selesai -->
@endsection
@section('s')
<link href="{{ asset('lib/advanced-datatable/css/jquery.dataTables.css') }}" rel="stylesheet" />
<script src="{{ asset('js/datatables.min.js')}}"></script>
@endsection