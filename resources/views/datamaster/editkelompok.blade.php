@extends('admin.tempadmin')
@section('title', 'Data Kelompok')
@section('judulhalaman','Data Master')
@section('content')

<div class="card">
  <div class="card-header">
    <h5>Edit Data</h5>
  </div>
  <div class="card-block">
    <form method="POST" action="{{ route('kelompok.update',$kelompok->id) }}">
      <label for="" class="control-label">Kelompok</label>
      <input class="form-control" id="Kelompok" name="kelompok" placeholder="kelompok" value="{{ $kelompok->nama }}" required />
      {{ csrf_field() }}
      {{ method_field('PATCH') }}
      <br><br>
      <button class="btn btn-primary" type="submit"><i class="fa fa-edit"></i> Simpan Perubahan</button>
      <a type="button" class="btn btn-danger" id="xx" href="{{ route('kelompok.index') }}"><i class="fa fa-times"></i> BATAL</a>
    </form>
  </div>
</div>

@endsection