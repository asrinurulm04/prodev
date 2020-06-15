@extends('admin.tempadmin')
@section('title', 'Data Maklon')
@section('judulnya','Data Maklon')
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

<!-- Maklon -->
<div class="x_panel">
  <div class="x_title">
    <h3><li class="fa fa-list"> List Maklon</li></h3>
  </div>
  <div class="card-block">
    <a type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#add_maklon"><i class="fa fa-plus"></i> Tambah Maklon </a>
	  <div class="dt-responsive table-responsive">
      <table class="Table table-striped table-bordered nowrap">
        <thead>
          <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
            <th>ID</th>
            <th>Maklon</th>
            <th>Keterangan</th>
            <th class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
        @foreach($maklons as $maklon)
        @if($maklon->id)
          <tr>
            <td>{{ $maklon->id }}</td>
            <td>{{ $maklon->maklon }}</td>
            <td>{{ $maklon->keterangan }}</td>
            <td class="text-center">
              <button class=" btn-primary btn-sm" data-toggle="modal" data-target="#edit_maklon{{ $maklon->id }}"><i class="fa fa-edit"></i></a></button>
              <button class="btn-sm btn-danger" onclick="return confirm('Hapus Maklon ?')"  data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"></i></button>
              {!! Form::close() !!}
            </td>
          </tr>
          <!-- Add New Maklon-->
          <div class="modal fade" id="edit_maklon{{ $maklon->id }}" role="dialog" aria-labelledby="EWBModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="EWBModalLabel"><i class="fa fa-plus"></i> Tambah Maklon
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></h4>
                </div>
                <div class="modal-body">
                  <form method="POST" action="{{ route('maklon.update',$maklon->id) }}">
                    <label for="" class="control-label">Maklon</label>
                    <input class="form-control" id="maklon" name="maklon" placeholder="Maklon" value="{{ $maklon->maklon }}" required />
                    <label for="" class="control-label">Keterangan</label>
                    <input class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan" value="{{ $maklon->keterangan }}" required />
                </div>
                <div class="modal-footer">
                  <button class="btn btn-primary" type="submit"><i class="fa fa-edit"></i> Submit</button>
                  <a type="button" class="btn btn-danger" id="xx" href="#"><i class="fa fa-times"></i> Cencel</a>
                  {{ csrf_field() }}
                  {{ method_field('PATCH') }}
                  </form>        
                </div>
              </div>
            </div>
          </div>
          {{-- selesai --}}
         @endif
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>

<!-- Add New Maklon-->
<div class="modal fade" id="add_maklon" role="dialog" aria-labelledby="EWBModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="EWBModalLabel"><i class="fa fa-plus"></i> Tambah Maklon
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></h4>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('maklon.store') }}">
        <label for="" class="control-label">Maklon</label>
        <input class="form-control" id="maklon" name="maklon" placeholder="Maklon" value="{{ old('maklon') }}" required />
        <label for="" class="control-label">Keterangan</label>
        <input class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan" value="{{ old('keterangan') }}" required />
        {{ csrf_field() }}              
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" type="submit"><i class="fa fa-plus"></i> Submit</button>
        <a type="button" class="btn btn-danger" id="xx" href="#"><i class="fa fa-times"></i> BATAL</a>
        </form>        
      </div>
    </div>
  </div>
</div>
{{-- selesai --}}
@endsection



@section('s')
<script type="text/javascript">
</script>
@endsection

