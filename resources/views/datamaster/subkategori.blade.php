@extends('admin.tempadmin')
@section('title', 'Data SubKategori')
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

<!-- SubKategori -->
<div class="x_panel">
  <div class="x_title">
    <h3><li class="fa fa-list"> List SubKategori</li></h3>
  </div>
  <div class="card-block">
    <a type="button" class="btn btn-info" data-toggle="modal" data-target="#add_subkategori"><i class="fa fa-plus"></i> Tambah SubKategori </a>
	  <div class="dt-responsive table-responsive">
      <table class="Table table-striped table-bordered nowrap">
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
              <button class="btn-sm btn-danger" onclick="return confirm('Hapus SubKategori ?')"  data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"></i></button>
              {!! Form::close() !!}
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
                <div class="modal-body">
                  <form method="POST" action="{{ route('subkategori.update',$subkategori->id) }}">
                    <label for="" class="control-label">SubKategori</label>
                    <input class="form-control" id="subkategori" name="subkategori" placeholder="SubKategori" value="{{ $subkategori->subkategori }}" required />
                    <label for="" class="control-label">Pembulatan</label>
                    <input type="number" step=any class="form-control" id="pembulatan" name="pembulatan" placeholder="Harga" required value="{{ $subkategori->pembulatan }}"/>
                    <label for="" class="control-label">Kategori</label><br>
                    <select id="kategori" name="kategori" class="form-control" style="width:500px;">
                      @foreach($kategoris as $kategori) 
                      <option value="{{  $kategori->id }}" {{ $subkategori->kategori_id == $kategori->id ? 'selected' : '' }}>{{ $kategori->kategori}}</option>
                      @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                  <button class="btn btn-primary" type="submit"><i class="fa fa-edit"></i> Submit</button>
                  <a type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cencel</a>
                  {{ csrf_field() }}
                  {{ method_field('PATCH') }}
                  </form>
                </div>  
              </div>
            </div>
          </div>
          {{-- selesai --}}
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
        <h4 class="modal-title" id="EWBModalLabel"><i class="fa fa-plus"></i> Tambah Subkategori
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></h4>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('subkategori.store') }}">
        <label for="" class="control-label">SubKategori</label>
        <input class="form-control" id="subkategori" name="subkategori" placeholder="SubKategori" value="{{ old('subkategori') }}" required />
        <label for="" class="control-label">Pembulatan</label>
        <input type="number" step=any class="form-control" id="pembulatan" name="pembulatan" placeholder="Harga" required value="{{ old('harga') }}"/>
        <label for="" class="control-label">Kategori</label><br>
        <select id="kategori" name="kategori" class="form-control" style="width:500px;">
        @foreach($kategoris as $kategori) 
        <option value="{{  $kategori->id }}" {{ old('kategori') == $kategori->id ? 'selected' : '' }}>{{ $kategori->kategori}}</option>
        @endforeach
        </select>
        {{ csrf_field() }}
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" type="submit"><i class="fa fa-plus"></i> Submit</button>
        <a type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> BATAL</a>
        </form>
      </div>  
    </div>
  </div>
</div>
{{-- selesai --}}
@endsection