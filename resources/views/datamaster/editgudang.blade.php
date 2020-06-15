@extends('admin.tempadmin')
@section('title', 'Edit gudang')
@section('judulnya','Edit gudang')
@section('content')

<div class="card">
  <div class="card-header">
    <h5>Edit Data</h5>
  </div>
  <div class="card-block">
    <form method="POST" action="{{ route('gudang.update',$gudang->id) }}">
      <label for="" class="control-label">Gudang</label>
      <input class="form-control" id="gudang" name="gudang" placeholder="Gudang" value="{{ $gudang->gudang }}" required />
      <label for="" class="control-label">Keterangan</label>
      <input class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan" value="{{ $gudang->keterangan }}" required />
      {{ csrf_field() }}
      {{ method_field('PATCH') }}
      <br><br>
      <button class="btn btn-primary" type="submit"><i class="fa fa-edit"></i> Simpan Perubahan</button>
      <a type="button" class="btn btn-danger" id="xx" href="{{ route('gudang.index') }}"><i class="fa fa-times"></i> BATAL</a>
    </form>
  </div>
</div>

@endsection