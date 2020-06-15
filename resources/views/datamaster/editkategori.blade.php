@extends('admin.tempadmin')
@section('title', 'Data Kategori')
@section('judulhalaman','Data Master')
@section('content')

<div class="card">
  <div class="card-header">
    <h5>Edit Data</h5>
  </div>
  <div class="card-block">
    <form method="POST" action="{{ route('kategori.update',$kategori->id) }}">
      <label for="" class="control-label">Kategori</label>
      <input class="form-control" id="kategori" name="kategori" placeholder="Kategori" value="{{ $kategori->kategori }}" required />
      {{ csrf_field() }}
      {{ method_field('PATCH') }} <br><br>
      <button class="btn btn-primary" type="submit"><i class="fa fa-edit"></i> Simpan Perubahan</button>
      <a type="button" class="btn btn-danger" id="xx" href="#"><i class="fa fa-times"></i> BATAL</a>
    </form>
  </div>
</div>

@endsection